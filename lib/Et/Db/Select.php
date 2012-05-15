<?php
class Et_Db_Select
{
    public $parts=array(
        'type'=>'SELECT',
        'fields'=>array('*'),
        'from'=>'',
        'join'=>array(),
        'where'=>array(),
        'order_by'=>array(),
        'limit'=>'',
    );
    protected $sep=array(
        "fields"=>"\n,",
        "from"=>"\n,",
        "join"=>"\n",
        "where"=>"\n AND ",
        'order_by'=>"\n,",
    );
    protected $prefix=array(
        'from'=>'FROM',
        'where'=>'WHERE',
        'order_by'=>'ORDER BY',
        'limit'=>'LIMIT',
    );
    protected $db;
    function assemble($parts=array())
    {
        if(!$parts)
        {
            $parts = array_keys($this->parts);
        }
        $sql = '';
        foreach($parts as $part)
        {
            $text = '';
            if(is_array($this->parts[$part]))
            {
                $text = implode($this->sep[$part], $this->parts[$part]);
            }
            else
            {
                $text = $this->parts[$part];
            }
            $sql .= "\n";
            if($text && !empty($this->prefix[$part]))
            {
                $sql .= $this->prefix[$part] . ' ';
            }
            $sql .= $text;
        }
        return $sql;
    }
    function count()
    {
        $old_fields = $this->parts['fields'];
        $this->parts['fields'] = 'COUNT(1) AS CNT';
        $sql = $this->assemble(array('type', 'fields', 'from','join','where'));
        $this->parts['fields'] = $old_fields;
        return $this->db->fetchOne($sql);
    }
    function execute()
    {
        $sql = $this->assemble();
        return $this->db->fetchAll($sql);
    }
    function __construct($db)
    {
        $this->db=$db;
    }
    function fields($fields)
    {
        $this->parts['fields'] = $fields;
        return $this;
    }
    function addField($field)
    {
        $this->parts['fields'][]= $field;
        return $this;
    }
    function clearField()
    {
        $this->parts['fields'] = array();
        return $this;
    }
    function from($table, $alias=null)
    {
        $this->parts['from'] = $table;
        return $this;
    }
    function leftJoin($left_table, $left_column, $right_table, $right_column)
    {
        $this->parts['join'][] = sprintf('LEFT JOIN %3$s ON %1$s.%2$s=%3$s.%4$s', $left_table, $left_column, $right_table, $right_column);
        return $this;
    }
    function where($where)
    {
        $this->parts['where'][] = $where;
        return $this;
    }
    function order_by($field, $dir='DESC')
    {
        $this->parts['order_by'][] = sprintf('%s %s', $field, $dir);
        return $this;
    }
    function limit($limit, $offset=0)
    {
        $this->parts['limit'] = sprintf('%d, %d',$offset, $limit);
        return $this;
    }
}