<?php
include('lib/functions.php');
$git_bin = "/usr/bin/env -i /usr/bin/git";
$git_bin = "git";
header("Content-type: text/plain"); // be explicit to avoid accidental XSS
// example: git root is three levels above the directory that contains this file
chdir(dirname(__FILE__)); // rarely actually an acceptable thing to do
system("{$git_bin} pull 2>&1"); // main repo (current branch)
system("{$git_bin} submodule init 2>&1"); // libs
system("{$git_bin} submodule update 2>&1"); // libs
echo "\nDone.\n";

$client_ip = getClientIp();
$payload = json_decode(@$_POST['payload']);
$log_file = 'data/log/deploy.log';
$line = implode("\t", array(date('Y-m-d H:i:s'), $client_ip, var_export($payload, true)));
file_put_contents($log_file, $line, FILE_APPEND|LOCK_EX);