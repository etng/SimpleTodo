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