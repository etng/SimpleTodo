<?php
require "lib/common.php";
ob_start();
include('templates/index.php');
$title_for_layout = '首页';
$content_for_layout = ob_get_clean();
include('templates/default.layout.php');