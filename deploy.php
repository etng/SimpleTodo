<?php
include('lib/functions.php');
$git_bin = "/usr/bin/env -i /usr/bin/git";
$git_bin = "git";
$log_file = 'data/log/deploy.log';
$client_ip = getClientIp();
$payload = json_decode(@$_POST['payload']);
writeLog($log_file, $client_ip, var_export($payload, true));

header("Content-type: text/plain"); // be explicit to avoid accidental XSS
// example: git root is three levels above the directory that contains this file
chdir(dirname(__FILE__)); // rarely actually an acceptable thing to do
system("{$git_bin} pull 2>&1"); // main repo (current branch)
system("{$git_bin} submodule init 2>&1"); // libs
system("{$git_bin} submodule update 2>&1"); // libs
echo "\nDone.\n";