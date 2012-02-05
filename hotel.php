<?php
require "lib/common.php";
ob_start();
switch(@$_GET['act'])
{
    case 'add':
        $title_for_layout = "添加酒店";
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
        $created = now();
            $hotel_id = $db->insert('hotel', array_merge($_POST['hotel'], compact('created')));
            header('location:hotel.php?act=view&id='.intval($hotel_id));
            die();
        }
        include('templates/hotel_add.php');
        break;
    case 'view':
        $title_for_layout = "酒店详情";
        $id = intval($_GET['id']);
        $hotel = $db->find('hotel', $id);
        include('templates/hotel_view.php');
        break;
    case 'add-payment':
        $created = now();
        $plan_id = intval($_POST['payment']['plan_id']);
        $plan = $db->find('plan', $plan_id);
        $payment = $_POST['payment'];
        $db->insert('plan_payment', array_merge($payment, compact('created')));
        $paid = $db->fetchOne('select sum(amount) from plan_payment where plan_id=' . $plan_id);
        $balance = $paid-$plan['price'];
        $db->update('plan', compact('paid', 'balance'), array('id'=>$plan_id));
         header('location:plan.php?act=view&id='.$plan_id);
         die();
        break;
    case 'add-room':
        var_dump($_POST);
        die();
        $created = now();
        $plan_id = intval($_POST['payment']['plan_id']);
        $plan = $db->find('plan', $plan_id);
        $payment = $_POST['payment'];
        $db->insert('plan_payment', array_merge($payment, compact('created')));
        $paid = $db->fetchOne('select sum(amount) from plan_payment where plan_id=' . $plan_id);
        $balance = $paid-$plan['price'];
        $db->update('plan', compact('paid', 'balance'), array('id'=>$plan_id));
         header('location:plan.php?act=view&id='.$plan_id);
         die();
        break;
    case 'set-status':
        $operator = '5号操作员'; $created = now();
        $plan_id = intval($_GET['id']);
        $plan = $db->find('plan', $plan_id);
        $status = $_GET['status'];
        $msg = $statuss[$status]['text'];
        $db->insert('plan_history', array_merge(array(
                'operation'=>$msg,
            ), compact('plan_id', 'created', 'operator')));


        $db->update('plan', compact('status'), array('id'=>$plan_id));
         header('location:plan.php?act=view&id='.$plan_id);
         die();
        break;
    case 'list':
    default:
        $title_for_layout = "酒店";
        $where = array();
        $s_where = $where?' where '.implode(' and ', $where):'';
        $hotels = $db->fetchAll('select * from hotel '.$s_where.' order by id desc');
        include('templates/hotel_list.php');
        break;
}
$content_for_layout = ob_get_clean();
include('templates/default.layout.php');