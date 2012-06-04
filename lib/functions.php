<?php
function dob2age($dob)
{
  list($y, $m, $d) = array_map('intval', explode('-',  $dob));
  $cm = date('n');
  $cd = date('j');
  $age = date('Y')-$y-1;
  if($m<$cm)
  {
    $age++;
  }
  elseif(($m==$cm) && ($d<=$cd))
  {
    $age++;
  }
  return $age;
}

function list2inta($list)
{
    return empty($list)?array():explode(',', $list);
}
function inta2list($a)
{
    return implode(',', $a);
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
function regexInArray($needle, $haystack)
{
    $in = true;
    if($haystack)
    {
        $in = false;
        foreach($haystack as $item)
        {
            $regex = '!'. str_replace(array('\*', '\?'), array('.+', '.'), preg_quote($item)) . '!i';
            if(preg_match($regex, $needle))
            {
                $in = true;
                break;
            }
        }
    }
    return $in;
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
function loadCSV($filename, $first_row_as_header=true)
{
    $rows = array();
    $header = array();
    $tmp_file = tempnam(APP_ROOT . "/files", "csv");
    file_put_contents($tmp_file, iconv('', 'utf-8', file_get_contents($filename)));
    if(($fp = fopen($tmp_file, "r")) !== FALSE) {
        $i=0;
        while (($data = fgetcsv($fp, 1000, "\t")) !== FALSE) {
            $i++;
            if(($i==1) && $first_row_as_header)
            {
                $header =  $data;
            }
            else
            {
                $rows[]=$header?array_combine($header, $data):$data;
            }
        }
        @fclose($fp);
    }
    @unlink($tmp_file);
    return $rows;
}

function http_update_query($qsa)
{
    if(is_string($qsa))
    {
        $qs =$qsa;
        parse_str($qs, $qsa);
    }
    return http_build_query(array_merge($_GET, $qsa));
}
function isHttpPost()
{
    return $_SERVER['REQUEST_METHOD'] == 'POST';
}
function getClientIp($checkProxy = true)
{
    if ($checkProxy && @$_SERVER['HTTP_CLIENT_IP'] != null) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } else if ($checkProxy && @$_SERVER['HTTP_X_FORWARDED_FOR'] != null) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = @$_SERVER['REMOTE_ADDR'];
    }

    return $ip;
}

function writeLog($log_file, $line)
{
    if(func_num_args()>2)
    {
         $args = func_get_args();
         array_shift($args);
         array_unshift($args, date('Y-m-d H:i:s'));
         $line = implode("\t", $args);
    }
    file_put_contents($log_file, $line . PHP_EOL, FILE_APPEND|LOCK_EX);
}

function do404($title, $content='')
{
    global $config,$base_url;
    $title_for_layout = $title;
    include('templates/404.php');
    $content_for_layout = ob_get_clean();
    include('templates/default.layout.php');
    die();
}

function saveFile($filename, $content)
{
    if(is_dir($d=dirname($filename)) || mkdir($d, 0777, true))
    {
        file_put_contents($filename, $content);
    }
    else
    {
        throw new Exception('Can not write file ' . $filename);
    }
}