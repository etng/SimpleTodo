<?php
define('APP_ROOT', realpath(dirname(__FILE__) . '/../'));
@ini_set('error_reporting', E_ALL);
@ini_set('display_errors', true);
//@ini_set('error_log', APP_ROOT . 'data/log/php_error.log');
if(!spl_autoload_register('todo_autoload'))
{
    die('autoload die');
}
require_once(APP_ROOT . '/lib/functions.php');
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
if($db_config['mock_data'])
{
     mock_data();
}
$setting = array();
foreach($db->fetchAll('select * from setting') as $row)
{
    $setting[$row['var']] = json_decode($row['val']);
}
$plan_statuss = parse_ini_file(APP_ROOT . '/data/status.ini', true);
$car_statuss = parse_ini_file(APP_ROOT . '/data/car_status.ini', true);
$room_statuss = parse_ini_file(APP_ROOT . '/data/room_status.ini', true);
$car_staff_options = $db->fetchOptions('select * from staff where group_id in (select id from staff_group where target="car")', 'name');
$market_staff_options = $db->fetchOptions('select * from staff where group_id in (select id from staff_group where target="business")', 'name');
$room_staff_options = $db->fetchOptions('select * from staff where group_id in (select id from staff_group where target="room")', 'name');
$tour_sep='→';
$destination_options = $db->fetchOptions('select id,name from destination', 'name');
$base_url = str_replace('\\', '/', substr(realpath(dirname(__file__) . '/..//'), strlen(realpath($_SERVER['DOCUMENT_ROOT']))));
$base_url_full = @"http://{$_SERVER['HTTP_HOST']}{$base_url}";
@session_start();
$_SESSION['last_notice'] = @$_SESSION['notice'];unset($_SESSION['notice']);
$thumb_config = array(
//    'middle' => array('width'=>'120', 'height'=>'120', 'watermark'=>''),
//    'small' => array('width'=>'50', 'height'=>'50', 'watermark'=>''),
);
$allowed_types = array('image/*');
$card_photo_base_url = '/files/tourist/card_photo/';
$default_card_photo_url = '/files/tourist/card_photo/default.jpg';

/******************************************************************************************************************************/
function mock_data()
{
    global $db,$config;
    if(!$db->fetchOne('select count(1) as cnt from todo'))
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

    if(!$db->fetchOne('select count(1) as cnt from destination'))
    {
        $updated=$created = now();
        foreach($config['destinations'] as $destination)
        {

            $name = $description = $slug= $destination;
            $destination_id = $db->insert('destination', compact('name', 'description', 'created', 'updated','slug'));
            foreach(array('有间客栈', '希尔顿', '无名招待所') as $name)
            {
                $star = rand(1, 5);
                $description = $name;
                $db->insert('hotel', compact('destination_id', 'name', 'description', 'created', 'destination','star'));
            }
        }
    }
    $destinations = $config['destinations'];
    if(!$db->fetchOne('select count(1) as cnt from tour'))
    {

        $i=0;
        $updated=$created = now();
        while($i++<10)
        {
            shuffle($destinations);
            $tour = compact('created', 'updated');
            $tour['name'] = $tour['description'] = implode(' - ', $tour_destinations = array_slice($destinations, 0, rand(3,5)));
            $tour['destination'] = end($tour_destinations);
            $tour['destination_id'] = $db->fetchOne('select id from destination where name="'.$tour['destination'].'"');
            $tour['distance'] = rand(10, 50) * 10;
            $tour['market_price'] = rand(10, 50) * 10;
            $tour['price'] = ceil($tour['market_price']*0.8/10)*10;
            $id = $db->insert('tour', $tour);
        }
    }
    if(!$db->fetchOne('select count(1) as cnt from article'))
    {
        foreach(explode(',', 'about_us,contact_us,hr,tos') as $slug)
        {
            $title = ucwords(str_replace('_', ' ', $slug));
            $content = "please add it";
            $hits = rand(1, 1000)* 23;
            $updated=$created = now();
            $id = $db->insert('article', compact('slug', 'title', 'content', 'hits', 'created', 'updated'));
        }
    }


    if(!$db->fetchOne('select count(1) as cnt from staff'))
    {
        $created = now();
        $staffs = include(APP_ROOT . '/data/mock_staffs.php');
        foreach($staffs as $group)
        {
            $privileges = implode(',',  $group['privileges']);
            $name = $group['name'];
            $target = $group['target'];
            $group_id = $db->insert('staff_group', compact('name', 'privileges', 'created', 'target'));
            foreach($group['staffs'] as $username => $staff)
            {
                $password = $username."123";
                $name = $staff['name'];
                $password = md5(md5($username.$password).$username);
                $privileges = implode(',',  $staff['privileges']);
                $staff_id = $db->insert('staff', compact('username', 'group_id', 'name', 'password', 'privileges', 'created'));
            }
        }
    }
}


function current_staff($field="name", $default=null)
{
    if(strpos($field, 'preference_')===0)
    {
        $preference = current_staff('preference');
        $key = end(explode('_', $field, 2));
        return empty($preference[$key])?$default:$preference[$key];
    }
    return empty($_SESSION['staff'][$field])?$default:$_SESSION['staff'][$field];
}
function checkPrivilege($controller=null, $action=null)
{
    global $config;
    if(@$_SESSION['staff']['id']==1)
    {
        return true;
    }
    $page_mode= false;
    if(is_null($controller) && is_null($action))
    {
        $page_mode = true;
    }
    if(is_null($controller))
    {
        $controller = basename($_SERVER['SCRIPT_FILENAME'], '.php');
    }
    if(is_null($action))
    {
        $action = $_GET['act'];
    }
    $need_privileges =  array('*', $controller.'.'. $action, '*.'. $action, '*.'. $action);
    $has_privilege = false;
    foreach($need_privileges as $need_privilege)
    {
        if(isset($config['privileges'][$need_privilege]))
        {
            if(in_array($need_privilege, @(array)$_SESSION['staff']['privileges']))
            {
                $has_privilege = true;
                break;
            }
        }
    }
    if(!$has_privilege && $page_mode)
    {
        alert('您的权限不够！', 'error');
        header('location:index.php');
        die('');
    }
    return $has_privilege;
}
function alert($content, $type="success")
{
    $_SESSION['notice'] = compact('type', 'content');
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





function makePager($total, $limit=20, $side=3)
{
    $pager = compact('total', 'limit', 'side');
    $pager['total_page'] = max(1, ceil($pager['total']/$pager['limit']));
    $pager['cur_page'] = min(max(1, intval(@$_GET['page'])), $pager['total_page']);
    $pager['offset'] = ($pager['cur_page'] - 1) * $pager['limit'];
    $pager['start_page'] = max(1, $pager['cur_page'] - $pager['side']);
    $pager['end_page'] = min($pager['total_page'], $pager['cur_page'] + $pager['side']);
    $pager['has_first'] = $pager['cur_page'] > 2;
    $pager['has_prev'] = $pager['cur_page'] > 1;
    $pager['has_next'] = $pager['cur_page'] < ($pager['total_page'] - 1);
    $pager['has_last'] = $pager['cur_page'] < ($pager['total_page'] - 2);
    return $pager;
}

function url_for($controller, $action, $params=array())
{
    $url = $controller . '.php';
    unset($params['c']);
    unset($params['a']);
    if($action!='list')
    {
        $params['act'] = $action;
    }
    if($params)
    {
        $url .= '?' . http_build_query($params);
    }
    return $url;
}
