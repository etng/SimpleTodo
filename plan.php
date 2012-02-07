<?php
require "lib/common.php";
$statuss = parse_ini_file(APP_ROOT . '/data/status.ini', true);
$car_statuss = parse_ini_file(APP_ROOT . '/data/car_status.ini', true);
$room_statuss = parse_ini_file(APP_ROOT . '/data/room_status.ini', true);
$contacts = parse_ini_file(APP_ROOT . '/data/contact.ini', true);
$default_status = key($statuss);
$default_room_status = key($room_statuss);
$default_car_status = key($car_statuss);
ob_start();
$tours = $db->fetchAll('select * from tour');
switch(@$_GET['act'])
{
    case 'add':
        $title_for_layout = "添加计划";
        $tours = $db->fetchAll('select * from tour');
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $contact_id = $db->insert('contact', $_POST['contact']);
            $user_id = 1;
            $plan_tours = array();
            $plan = $_POST['plan'];
            foreach($plan as $field=>$values)
            {
                if(strpos($field, 'item_')===0)
                {
                    $field_name = substr($field, strlen('item_'));
                    foreach($values as $k=>$v)
                    {
                         $plan_tours[$k][$field_name] = $v;
                    }
                    unset($plan[$field]);
                }
            }
            $created = now();
            $status = $default_status;
            $car_status = $default_car_status;
            $room_status = $default_room_status;

            $plan_id = $db->insert('plan', array_merge($plan, compact('status', 'car_status', 'room_status', 'user_id', 'contact_id', 'created')));
            $price=0;
            foreach($plan_tours as $plan_tour)
            {
                if(!empty($plan_tour['need_car']))
                {
                    $plan_tour['car_cnt'] = 1;
                    unset($plan_tour['need_car']);
                }
                if(!empty($plan_tour['need_room']))
                {
                    $plan_tour['room_cnt'] = 1;
                    unset($plan_tour['need_room']);
                }
                $tour = $db->fetchRow('select * from tour where id=' . $plan_tour['tour_id']);
                $plan_tour['price_sum'] =  $tour['price'] * $plan_tour['tourist_cnt'];
                $plan_tour['market_price_sum'] =  $tour['market_price'] * $plan_tour['tourist_cnt'];
                $price += $plan_tour['price_sum'];
                $db->insert('plan_tour', $plan_tour = array_merge($plan_tour, compact('plan_id')));
            }
            $paid = 0;
            $balance = $paid-$price;
            $db->update('plan', compact('price', 'paid', 'balance'), array('id'=>$plan_id));
            $db->insert('plan_history', array_merge(array(
                'operation'=>'您提交了订单，请等待系统确认',
                'operator'=>'客户',
            ), compact('plan_id', 'created')));
            header('location:plan.php');
            die();
        }
        include('templates/plan_add.php');
        break;
    case 'view':
        $title_for_layout = "计划详情";
        $id = intval($_GET['id']);
        $plan = $db->find('plan', $id);
        $contact = $db->find('contact', $plan['contact_id']);
        $plan['tours'] = $db->fetchAll('select *,plan_tour.id as id from plan_tour left join tour on tour.id=plan_tour.tour_id where plan_tour.plan_id=' . $plan['id']);
        $plan['history'] = $db->fetchAll('select * from plan_history where plan_id=' . $plan['id'] . ' order by created desc');
        $plan['payments'] = $db->fetchAll('select * from plan_payment where plan_id=' . $plan['id'] . ' order by created desc');
        include('templates/plan_view.php');
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
    case 'add-car':
        var_dump($_POST);
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
        $title_for_layout = "我的计划";
        $where = array();
        if(!empty($_GET['st']))
        {
            $where []='status="'.$_GET['st'] . '"';
        }
        $s_where = $where?' where '.implode(' and ', $where):'';
        $plans = $db->fetchAll('select * from plan '.$s_where.' order by id desc');
        include('templates/plan_list.php');
        break;
}
$content_for_layout = ob_get_clean();
include('templates/default.layout.php');