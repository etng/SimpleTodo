<?php
require "lib/common.php";
switch(@$_GET['act'])
{
   case 'logout':
        unset($_SESSION['staff']);
        alert('退出登录成功');
        break;
   case 'login':
   default:
       $_GET['act']='login';
       if(isHttpPost())
        {
            $name = $_POST['staff']['name'];
            $staff = $db->fetchRow('select * from staff where username="'.$name.'"');
            $password = $_POST['staff']['password'];
            if(false || ($staff && $staff['password']==md5($password.$name)))
            {
                $_SESSION['staff']['username']=$staff['username'];
                $_SESSION['staff']['name']=$staff['name'];
                $group_privileges = $db->fetchOne('select privileges from staff_group where id=' . $staff['group_id']);
                $group_privileges = $group_privileges?explode(',', $group_privileges):array();
                $_SESSION['staff']['privileges'] = array_merge($group_privileges, explode(',', $staff['privileges']));

                $_SESSION['staff']['preference']=json_decode($staff['preference'], true);
                $_SESSION['staff']['id']=$staff['id'];
                alert('登录成功！');
            }
            else
            {
                alert('登录失败！');
            }
        }
        break;
}
@header('location:index.php');