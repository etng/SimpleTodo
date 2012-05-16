<?php
require "lib/common.php";
ob_start();
$latest_plans = $db->fetchAll('select * from plan order by id desc limit 0, 5');
include('templates/index.php');
$title_for_layout = '首页';
$content_for_layout = ob_get_clean();
include('templates/default.layout.php');