<?php
require "lib/common.php";
ob_start();
$staff_groups = $db->fetchAll('select * from staff_group');
$id = current_staff('id');
$staff = $db->find('staff', $id);
function valid_password($username, $password, $stored_password)
{
    return md5($password.$username) == $stored_password;
}
switch(@$_GET['act'])
{
    case 'edit-pass':
    case 'edit-password':
        $_GET['act']='edit-pass';
        checkPrivilege();
        $title_for_layout = "修改密码";
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $data = $_POST['staff'];
            try{
                if($data['new_password'] != $data['new_password_confirm'])
                {
                    throw new Exception('新密码和新确认密码不一致');
                }
                if(empty($data['new_password']))
                {
                    throw new Exception('新密码不能为空');
                }
                if(!valid_password($staff['username'], $data['old_password'], $staff['password']))
                {
                    throw new Exception('旧密码错误');
                }
                $password = md5($data['new_password'].$staff['username']) ;
                $db->update('staff', compact('password'), compact('id'));
                alert('密码修改成功');
                header('location:my.php?act=edit-profile');
                die();
            }
            catch(Exception $e)
            {
                alert($e->getMessage(), 'error');
            }
        }
        include('templates/my-pass.php');
        break;
     case 'edit-preference':
        checkPrivilege();
        $title_for_layout = "修改个人偏好";
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $data = $_POST['staff'];
            $preference = json_encode($data['preference']);
            $_SESSION['staff']['preference']=$data['preference'];
            $db->update('staff', compact('preference'), compact('id'));
            header('location:my.php?act=edit-preference');
            die();
        }
        include('templates/my-preference.php');
        break;
    case 'edit-profile':
    default:
        $_GET['act']='edit-profile';
        checkPrivilege();
        $title_for_layout = "修改个人资料";
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $data = $_POST['staff'];
            $db->update('staff', $data, compact('id'));
            header('location:my.php?act=edit-profile');
            die();
        }
        include('templates/my-profile.php');
        break;

}
$content_for_layout = ob_get_clean();
include('templates/default.layout.php');