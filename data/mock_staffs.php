<?php
$staffs = array();
foreach(file(dirname(__file__) . '/mock_staffs.txt') as $line)
{
    $line =  trim($line);
    if(empty($line))
    {
        continue;
    }
    list($path, $value) = explode('=', $line,2);
    $path = explode(',', $path);
    $segments = array_map(create_function('$a', 'return "[\'{$a}\']";'), $path);
    if(end($path)=='privileges')
    {
        if(!$value)
        {
            $value = array();
        }
        else
        {
            $value = explode(',', $value);
        }
        $expression = '$staffs' . implode('', $segments) . '='.var_export($value, true).';';
    }
    else
    {
        $expression = '$staffs' . implode('', $segments) . '="'.$value.'";';
    }
    eval($expression);
}
return $staffs;
