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