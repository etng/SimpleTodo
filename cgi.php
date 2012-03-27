<?php
require "lib/common.php";
$tables = array();
foreach($db->fetchAll('show table status') as $row)
{
    $tables[$row['Name']] = empty($row['Comment'])?ucwords(str_replace('_', ' ', $row['Name'])):$row['Comment'];
}
if(!empty($_REQUEST['table']) && isset($tables[$_REQUEST['table']]))
{
    $table = $db->getMeta($_REQUEST['table']);

$actions = array();
?>

<table>
    <thead>
    <tr>
        <th> </th>
        <?php foreach($table['fields'] as $field):?>
        <th><?php echo $field->name;?><div><?php echo $field->comment;?></div></th>
         <?php endforeach;?>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td></td>
        <?php foreach($table['fields'] as $field):?>
        <td>设置</td>
         <?php endforeach;?>
    </tr>
    </tbody>
</table>
    <?php }

var_dump($tables, $table);

?>