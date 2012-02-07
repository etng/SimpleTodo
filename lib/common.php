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
$db_config = parse_ini_file(APP_ROOT . '/data/database.local.ini', true);
$db = Et_Db::instance($db_config);
if(!$db->fetchCol('show tables like "todo"'))
{
    foreach(loadSqlFile(APP_ROOT . '/data/schema.sql') as $sql)
    {
        $db->query($sql);
    }
}
if($db_config['mock_data'] && !$db->fetchOne('select count(1) as cnt from todo'))
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
if($db_config['mock_data'] && !$db->fetchOne('select count(1) as cnt from tour'))
{
    $destinations = $config['destinations'];
    $i=0;
    $updated=$created = now();
    while($i++<10)
    {
        shuffle($destinations);
        $tour = compact('created', 'updated');
        $tour['name'] = $tour['description'] = implode(' - ', $tour_destinations = array_slice($destinations, 0, rand(3,5)));
        $tour['destination'] = end($tour_destinations);
        $tour['distance'] = rand(10, 50) * 10;
        $tour['market_price'] = rand(10, 50) * 10;
        $tour['price'] = ceil($tour['market_price']*0.8/10)*10;
        $id = $db->insert('tour', $tour);
    }
}
if($db_config['mock_data'] && !$db->fetchOne('select count(1) as cnt from article'))
{
    foreach(explode(',', 'aboutus,contact,hr,tos') as $slug)
    {
        $title = ucfirst($slug);
        $content = "please add it";
        $hits = rand(1, 1000)* 23;
        $created = now();
        $id = $db->insert('article', compact('slug', 'title', 'content', 'hits', 'created'));
    }
}
if($db_config['mock_data'] && !$db->fetchOne('select count(1) as cnt from staff'))
{
    foreach(explode(',', 'demo,contact,hr,tos') as $username)
    {
        $name = ucfirst($username);
        $password = $username."123";
        $created = now();
        $password = md5(md5($username.$password).$username);
        $id = $db->insert('staff', compact('username', 'name', 'password', 'created'));
    }
}


@session_start();
$_SESSION['last_notice'] = @$_SESSION['notice'];unset($_SESSION['notice']);


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

function sub_array($arr, $keys)
{
    $sub_array = array();
    foreach($keys as $key)
    {
        $sub_array[$key] = empty($arr[$key])?'':$arr[$key];
    }
    return $sub_array;
}