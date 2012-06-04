<?php
class Et_Db
{
    protected $key = array();
    protected $config = array();
    protected $conn;
    protected $result;
    public static $instances=array();
    public static $debug = true;
    public static function instance($config, $name='default')
    {
        if(!$name)
        {
            $name= md5(serialize($config));
        }
        if(!isset(self::$instances[$name]))
        {
            new self($config, $name);
        }
        return self::$instances[$name];
    }

    protected function __construct($config, $name='default')
    {
        $this->name = $name;
        $this->config = $config;
        self::$instances[$name] = $this;
    }

    function __destruct()
    {
       $this->close();
    }

    function connect()
    {
        if($this->conn)
        {
            return ;
        }
        if(!($this->conn = @mysql_connect($this->config['host'], $this->config['user'], $this->config['pass'])))
        {
            if(self::$debug)
            {
                $this->msg('', "can not connect to database host: {$this->config['user']}@{$this->config['host']}, using password:" . ($this->config['pass']?'YES':'NO'), true);
            }
            else
            {
                $this->msg('', "can not connect to database", true);
            }
        }
        if(! @mysql_select_db($this->config['name'], $this->conn))
        {
            if(self::$debug)
            {
                $this->msg('', 'can not access database: ' . $this->config['name'], true);
            }
            else
            {
                $this->msg('', 'can not access database', true);
            }
        }
        mysql_query('set names utf8', $this->conn);
    }

    function escape($s)
    {
        $this->connect();
        return mysql_real_escape_string($s, $this->conn);
    }

    function query($sql)
    {
        $sql = preg_replace('/\s+/', ' ', $sql);
        $this->connect();
        $this->result = mysql_query($sql, $this->conn);
        if($this->result === false)
        {
            $msg = mysql_error($this->conn);
            $backtraces = debug_backtrace();
            array_shift($backtraces);
            while($caller = array_shift($backtraces))
            {
                $function = $caller['class'] . '::' . $caller['function'];
                $msg .= PHP_EOL . ' file=' . $caller['file'] . ' line=' . $caller['line'] . '';
                if(! empty($caller['function']))
                {
                    $msg .= ' function/method=';
                    if(! empty($caller['class']))
                    {
                        $msg .= $caller['class'] . '::';
                    }
                    $msg .= $caller['function'];
                }
            }

            $this->msg($sql, $msg);
        }
    }
    function getMeta($table)
    {
        $meta = array_change_key_case($this->fetchRow("SHOW TABLE STATUS WHERE name='{$table}'"));
        $field   = 0;
        $type    = 1;
        $null    = 3;
        $key     = 4;
        $default = 5;
        $extra   = 6;
        $comment   = 8;
        $i = 1;
        $p = 1;
        $result = $this->fetchAll("SHOW FULL COLUMNS FROM `{$table}`", MYSQL_NUM);
        foreach ($result as $row) {
            list($length, $scale, $precision, $unsigned, $primary, $primaryPosition, $identity)
                = array(null, null, null, null, false, null, false);
            if (preg_match('/unsigned/', $row[$type])) {
                $unsigned = true;
            }
            if (preg_match('/^((?:var)?char)\((\d+)\)/', $row[$type], $matches)) {
                $row[$type] = $matches[1];
                $length = $matches[2];
            } else if (preg_match('/^decimal\((\d+),(\d+)\)/', $row[$type], $matches)) {
                $row[$type] = 'decimal';
                $precision = $matches[1];
                $scale = $matches[2];
            } else if (preg_match('/^float\((\d+),(\d+)\)/', $row[$type], $matches)) {
                $row[$type] = 'float';
                $precision = $matches[1];
                $scale = $matches[2];
            } else if (preg_match('/^((?:big|medium|small|tiny)?int)\((\d+)\)/', $row[$type], $matches)) {
                $row[$type] = $matches[1];
                // The optional argument of a MySQL int type is not precision
                // or length; it is only a hint for display width.
            }
            if (strtoupper($row[$key]) == 'PRI') {
                $primary = true;
                $primaryPosition = $p;
                if ($row[$extra] == 'auto_increment') {
                    $identity = true;
                } else {
                    $identity = false;
                }
                ++$p;
            }
            $meta['fields'][$row[$field]] = (object)array(
                'schema_name'      => null, // @todo
                'table_name'       => $table,
                'name'              => $row[$field],
                'comment'           => $row[$comment],
                'column_name'      => $row[$field],
                'column_position'  => $i,
                'data_type'        => $row[$type],
                'default'          => $row[$default],
                'nullable'         => (bool) ($row[$null] == 'YES'),
                'length'           => $length,
                'scale'            => $scale,
                'precision'        => $precision,
                'unsigned'         => $unsigned,
                'primary'          => $primary,
                'primary_position' => $primaryPosition,
                'identity'         => $identity
            );
            ++$i;
        }
        return $meta;
    }
    function insert($table, $data)
    {
        $table_meta = $this->getMeta($table);
        $set_fields = array();
        foreach($data as $k => $v)
        {
            if(!isset($table_meta['fields'][$k]))
            {
                continue;
            }
            $set_fields[] = sprintf('`%s`="%s"', $k, $this->escape($v));
        }
        $sql = sprintf('INSERT INTO %s SET %s', $table, implode(',', $set_fields));
        return $this->execute($sql);
    }
    function replace($table, $data)
    {
        $table_meta = $this->getMeta($table);
        $set_fields = array();
        foreach($data as $k => $v)
        {
            if(!isset($table_meta['fields'][$k]))
            {
                continue;
            }
            $set_fields[] = sprintf('`%s`="%s"', $k, $this->escape($v));
        }
        $sql = sprintf('REPLACE INTO %s SET %s', $table, implode(',', $set_fields));
        return $this->execute($sql);
    }
    function delete($table, $where=array())
    {
        $cases = $this->buildWhere((array)$where);
        $sql = sprintf('DELETE FROM %s WHERE %s', $table, implode(' AND ', $cases));
        return $this->execute($sql);
    }
    function update($table, $data, $where = array())
    {
        $table_meta = $this->getMeta($table);
        $set_fields = array();

        foreach($data as $k => $v)
        {
            if(!isset($table_meta['fields'][$k]))
            {
                continue;
            }
            if(!in_array($table_meta['fields'][$k]->data_type, array('char', 'varchar', 'text', 'datetime')) && ($v && in_array($v{0}, array('*','+','-','/'))))
            {
                $set_fields[] = sprintf('`%s`=`%s`%s"%s"', $k, $k, $v{0}, intval(substr($v, 1)));
            }
            else
            {
                $set_fields[] = sprintf('`%s`="%s"', $k, $this->escape($v));
            }
        }
        $cases = $this->buildWhere($where);
        $sql = sprintf('UPDATE %s SET %s WHERE %s', $table, implode(',', $set_fields), implode(' AND ', $cases));
        return $this->execute($sql);
    }
    function getOrCreate($table, $values, $defaults=array())
    {
        $cases = $this->buildWhere($values);
        $id = $this->fetchOne('select id from ' . $table . ' where ' .implode(' AND ', $cases));
        if(!$id)
        {
          $id = $this->insert($table, array_merge($values, $defaults));
        }
        return $id;
    }
    function buildWhere($where=array(), $not_null=true)
    {
        settype($where, 'array');
        $cases = array();
        foreach($where as $k=>$v)
        {
            if(is_int($k))
            {
                $cases[]=$v;
            }
            elseif(strpos($k, '%'))
            {
                $cases[]=sprintf($k, $v);
            }
            else
            {
                $cases[]=sprintf("`%s`='%s'", $k, $v);
            }
        }
        if($not_null && !$cases)
        {
            $cases []= '1=1';
        }
        return $cases;
    }
    function execute($sql)
    {
        $this->connect();
        $this->query(trim($sql));
        if(preg_match('/^insert\b/sim', $sql))
        {
            return mysql_insert_id($this->conn);
        }
        elseif(preg_match('/^(update|delete)\b/sim', $sql))
        {
            return mysql_affected_rows($this->conn);
        }
    }
    function fetchOne($sql)
    {
        $this->query($sql);
        if($this->result && mysql_num_rows($this->result))
        {
             $row = mysql_fetch_array($this->result, MYSQL_NUM);
             return current($row);
        }
        return null;
    }
    function version()
    {
      return $this->fetchOne('SELECT VERSION()');
    }
    function find($table, $id)
    {
        if(is_array($id))
        {
            $where = $this->buildWhere($id);
            $sql = "select * from {$table} where " . implode(' and ', $where);
            return $this->fetchAll($sql);
        }
        elseif(is_numeric($id))
        {
            $sql = "select * from {$table} where id=" . $id;
            return $this->fetchRow($sql);
        }
    }
    function fetchRow($sql, $type = MYSQL_ASSOC)
    {
        $this->query($sql);
        if($this->result)
        {
            return mysql_fetch_array($this->result, $type);
        }
        return null;
    }

    function fetchAll($sql, $type = MYSQL_ASSOC, $key_field=null)
    {
        if(!in_array($type, array(MYSQL_ASSOC, MYSQL_NUM, MYSQL_BOTH)))
        {
            $key_field = $type;
            $type = MYSQL_ASSOC;
        }
        $this->query($sql);
        $rows = array();
        if($this->result)
        {
            while($row = mysql_fetch_array($this->result, $type))
            {
                if($key_field)
                {
                    $rows[$row[$key_field]] = $row;
                }
                else
                {
                    $rows[] = $row;
                }
            }
        }
        return $rows;
    }

    /**
     * 取结果集中的一列组成的数组
     *
     * @param string $sql	sql语句
     * @param mixed $idx 列名
     */
    function fetchCol($sql, $idx = 0)
    {
        $this->query($sql);
        $rows = array();
        if($this->result)
        {
            while($row = mysql_fetch_array($this->result, MYSQL_BOTH))
            {
                $rows[] = $row[$idx];
            }
        }
        return $rows;
    }

    /**
     * 查询sql并取出指定两列组成的关联数组
     *
     * @param string $sql	SQL语句
     * @param mixed $v_idx	关联数组值所在列
     * @param mixed $k_idx	关键数组键所在列
     * @return array
     */
    function fetchOptions($sql, $v_idx, $k_idx = 'id')
    {
        $this->query($sql);
        $options = array();
        if($this->result)
        {
            while($row = mysql_fetch_array($this->result, MYSQL_BOTH))
            {
                $options[$row[$k_idx]] = $row[$v_idx];
            }
        }
        return $options;
    }

    //关闭数据库连接
    function close()
    {
        @mysql_close($this->conn);
        $this->conn = null;
    }
    function select()
    {
        return new Et_Db_Select($this);
    }

    /**
     * 提示SQL错误信息
     *
     * 如果要求停止脚本运行则停止
     *
     * @param string $sql	SQL语句
     * @param string $msg	提示信息
     * @param boolean $halt	是否停止整个脚本的运行
     * @return void
     */
    function msg($sql, $msg, $halt = false)
    {
        $res = '';
        if(ini_get('html_errors'))
        {
            $res .= "<p>error sql : " . nl2br($sql) . "<br/>error msg:" . nl2br($msg) . "</p>";
        }
        else
        {
            if($sql)
            {
                $res .= 'SQL:' . $sql . PHP_EOL;
            }
            if($msg)
            {
                $res .= PHP_EOL . $msg . PHP_EOL;
            }
        }
        echo $res;
        $halt && die();
    }
}