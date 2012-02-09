<?php
require "lib/common.php";
switch(@$_GET['act'])
{
   case 'logout':
        unset($_SESSION['staff']);
        $_SESSION['notice'] = '退出登录成功';
        break;
   case 'login':
   default:
       $_GET['act']='login';
       if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $name = $_POST['staff']['name'];
            $staff = $db->fetchRow('select * from staff where username="'.$name.'"');
            $password = $_POST['staff']['password'];
            if($staff && $staff['password']==md5($password.$name))
            {
                $_SESSION['staff']['username']=$staff['username'];
                $_SESSION['staff']['name']=$staff['name'];
                $_SESSION['staff']['privileges']=explode(',', $staff['privileges']);
                $_SESSION['staff']['id']=$staff['id'];
            }
            else
            {
                $_SESSION['notice'] = '登录成功';
            }
        }
        break;
}
@header('location:index.php');