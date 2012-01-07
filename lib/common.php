<?php
define('APP_ROOT', realpath(dirname(__FILE__) . '/../'));
@ini_set('error_reporting', E_ALL);
@ini_set('display_errors', true);
//@ini_set('error_log', APP_ROOT . 'data/log/php_error.log');
if(!spl_autoload_register('todo_autoload'))
{
    die('autoload die');
}
$config = parse_ini_file(APP_ROOT . '/data/config.ini', true);
$config['colors'] = array_values($config['colors']);
$db = Et_Db::instance($config['db']);
if(!$db->fetchCol('show tables like "todo"'))
{
    foreach(loadSqlFile(APP_ROOT . '/data/schema.sql') as $sql)
    {
        $db->query($sql);
    }
}
if($config['mock_data'] && !$db->fetchOne('select count(1) as cnt from todo'))
{
    $colors = $config['colors'];
    $destinations = $config['destinations'];
    $i=0;
    $start_time = time();
    while($i<100)
    {
        $ci = $i%count($colors);
        $days = rand(1, 10);
        $destination= $destinations[array_rand($destinations)];
        $id=Todo::create(array(
            'title' => sprintf('%s', $destination),
            'start_date' => $new_start_time = strtotime(sprintf('+%d days', rand(1, 3)), $start_time),
            'end_date' => $start_time = strtotime(sprintf('+%d days', $days-1), $new_start_time),
            'confirmed' => $i%2,
        ));
        $i++;
    }
}

function todo_autoload($klass)
{
    if(substr($klass, 0, 2)=='Et')
    {
        require APP_ROOT . '/lib/' . str_replace('_', '/', $klass) . '.php';
        return true;
    }
    elseif(file_exists($filename = APP_ROOT . '/lib/models/' . str_replace('_', '/', $klass) . '.php'))
    {
        include_once($filename);
        return true;
    }
    return false;
}
function now()
{
    return date('Y-m-d H:i:s');
}
function loadSqlFile($filename)
{
    $fp = fopen($filename, 'r');
    $sqls = array();
    $sql = '';
    while(($line = fgets($fp, 4096))!==false)
    {
        $line = trim($line);
        if(empty($line) || ($line{0}=='#'))
        {
            continue;
        }
        $sql .= $line;
        if(substr($line, -1)==';')
        {
            $sqls []= $sql;
            $sql = '';
        }

    }
    fclose($fp);
    return $sqls;
}