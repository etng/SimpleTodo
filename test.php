<?php
require "lib/common.php";
$id = 1;
var_dump($db->getMeta('article'));
$db->update('article', array('hits'=>'+1'), array('id=' . $id));
var_dump($db->find('article', $id));