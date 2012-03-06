<?php
require "lib/common.php";
@array_shift($argv);
if(!$argv)
{
    die('Table Name Must be provided for code generation');
}
$table_name = array_shift($argv);
$table = $db->getMeta($table_name);
$actions = array(
    'object'=>array(
            'view'=>array('class'=>'btn-info', 'label'=>'详情'),
            'edit'=>array('class'=>'', 'label'=>'<i class="icon-pencil"></i>编辑'),
            'delete'=>array('class'=>'btn-danger', 'label'=>'<i class="icon-trash"></i>删除'),
     ),
    'batch'=>array(
            'delete'=>array('class'=>'btn-danger', 'label'=>'<i class="icon-trash"></i>删除'),
     ),
    'any'=>array(
            'add'=>array('class'=>' ', 'label'=>'<i class="icon-plus-sign"></i>添加'),
     ),
);
foreach(array('list', 'form', 'add', 'edit', 'view') as $part)
{
    ob_start();
    include "templates/cg/{$part}.php";
    $content = ob_get_clean();
    $content = str_replace(array('[?php', '?]'), array('<?php', '?>'), $content);
    file_put_contents("templates/{$table_name}_{$part}.php", $content);
}

    ob_start();
    include "templates/cg/conroller.php";
    $content = ob_get_clean();
    $content = str_replace(array('[?php', '?]'), array('<?php', '?>'), $content);
    file_put_contents("{$table_name}.php", $content);

 echo "done". PHP_EOL;