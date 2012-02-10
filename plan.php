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
        checkPrivilege();
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
                    $plan_tour['car_tourist_cnt'] = $plan_tour['tourist_cnt'];
                    unset($plan_tour['need_car']);
                }
                if(!empty($plan_tour['need_room']))
                {
                    $plan_tour['room_tourist_cnt'] = $plan_tour['tourist_cnt'];
                    unset($plan_tour['need_room']);
                }
                $tour = $db->fetchRow('select * from tour where id=' . $plan_tour['tour_id']);
                $plan_tour['price_sum'] =  $tour['price'] * $plan_tour['tourist_cnt'];
                $plan_tour['market_price_sum'] =  $tour['market_price'] * $plan_tour['tourist_cnt'];
                $price += $plan_tour['price_sum'];
                $plan_tour['destination'] = $tour['destination'];
                $db->insert('plan_tour', $plan_tour = array_merge($plan_tour, compact('plan_id')));
            }
            $paid = 0;
            $balance = $paid-$price;
            $db->update('plan', compact('price', 'paid', 'balance'), array('id'=>$plan_id));
            $db->insert('plan_history', array_merge(array(
                'operation'=>'计划创建完毕，等待进一步确认',
                'operator'=> currrent_staff(),
            ), compact('plan_id', 'created')));
            header('location:plan.php');
            die();
        }
        include('templates/plan_add.php');
        break;
    case 'view':
        checkPrivilege();
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
        checkPrivilege();
        $created = now();
        $operator = currrent_staff();
        $plan_id = intval($_POST['payment']['plan_id']);
        $plan = $db->find('plan', $plan_id);
        $payment = $_POST['payment'];
        $db->insert('plan_payment', array_merge($payment, compact('created', 'operator')));
        $paid = $db->fetchOne('select sum(amount) from plan_payment where plan_id=' . $plan_id);
        $balance = $paid-$plan['price'];
        $db->update('plan', compact('paid', 'balance'), array('id'=>$plan_id));
         header('location:plan.php?act=view&id='.$plan_id);
         die();
        break;
    case 'get-plan-tour_rooms':
        checkPrivilege();
        $plan_tour_id = intval($_GET['plan_tour_id']);
        echo json_encode($db->fetchAll('select plan_tour_room.*,hotel.name as hotel_name from plan_tour_room left join hotel on hotel.id=plan_tour_room.hotel_id where plan_tour_id='.$plan_tour_id));
        die();
        break;
    case 'get-plan-tour_cars':
        checkPrivilege();
        $plan_tour_id = intval($_GET['plan_tour_id']);
        echo json_encode($db->fetchAll('select plan_tour_car.*,driver.name as driver_name from plan_tour_car left join driver on driver.id=plan_tour_car.driver_id where plan_tour_id='.$plan_tour_id));
        die();
        break;
    case 'get-destination-hotels':
        checkPrivilege();
        $plan_tour_id = intval($_GET['plan_tour_id']);
        $tour_id =  $db->fetchOne('select tour_id from plan_tour where id='.$plan_tour_id);
        $destination_id =  $db->fetchOne('select destination_id from tour where id='.$tour_id);
        echo json_encode($db->fetchAll('select id,name from hotel where destination_id='.$destination_id));
        die();
        break;
    case 'get-destination-drivers':
        checkPrivilege();
        $plan_tour_id = intval($_GET['plan_tour_id']);
        $tour_id =  $db->fetchOne('select tour_id from plan_tour where id='.$plan_tour_id);
        $destination_id =  $db->fetchOne('select destination_id from tour where id='.$tour_id);
        echo json_encode($db->fetchAll('select id,name from driver'));
        die();
        break;
    case 'get-room-price':
        checkPrivilege();
        $plan_tour_id = intval($_GET['plan_tour_id']);
        $the_date = $db->fetchOne('select the_date from plan_tour where id='.$plan_tour_id);
        $hotel_id = intval($_GET['hotel_id']);
        $room_type = $_GET['room_type'];
        echo json_encode($db->fetchRow($sql='select * from room_daily_price where the_date="'.$the_date.'" and hotel_id="'.$hotel_id.'" and room_type="'.$room_type.'"'));
        die();
        break;
    case 'add-car':
        checkPrivilege();
        $plan_id = intval($_POST['car']['plan_id']);
        $db->insert('plan_tour_car', $_POST['car']);
        header('location:plan.php?act=view&id='.$plan_id);
        die();
        break;
    case 'add-room':
        checkPrivilege();
        $plan_id = intval($_POST['room']['plan_id']);
        $db->insert('plan_tour_room', $_POST['room']);
        header('location:plan.php?act=view&id='.$plan_id);
        die();
        break;
    case 'set-status':
        checkPrivilege();
        $operator = currrent_staff();
        $created = now();
        $plan_id = intval($_GET['id']);
        $plan = $db->find('plan', $plan_id);
        $status = $_GET['status'];
        $msg = $statuss[$status]['text'];
        $db->insert('plan_history', array_merge(array(
                'operation'=>$msg,
            ), compact('plan_id', 'created', 'operator')));
        $extra= array();
        if(!empty($statuss[$status]['unlock_car']))
        {
            $extra['car_status'] = 'pending';
        }
        if(!empty($statuss[$status]['unlock_room']))
        {
            $extra['room_status'] = 'pending';
        }
        if(!empty($statuss[$status]['lock_car']))
        {
            $extra['car_status'] = 'locked';
        }
        if(!empty($statuss[$status]['lock_room']))
        {
            $extra['room_status'] = 'pending';
        }
        $db->update('plan', array_merge(compact('status'), $extra), array('id'=>$plan_id));
        header('location:plan.php?act=view&id='.$plan_id);
        die();
        break;
    case 'set-car-status':
        checkPrivilege();
        $operator = currrent_staff();
        $created = now();
        $plan_id = intval($_GET['id']);
        $plan = $db->find('plan', $plan_id);
        $car_status = $_GET['status'];
        $msg = '车辆状态调整为：'. $car_statuss[$car_status]['text'];
        $db->insert('plan_history', array_merge(array(
                'operation'=>$msg,
            ), compact('plan_id', 'created', 'operator')));
        $db->update('plan', compact('car_status'), array('id'=>$plan_id));
        header('location:plan.php?act=view&id='.$plan_id);
        die();
        break;
    case 'set-room-status':
        checkPrivilege();
        $operator = currrent_staff();
        $created = now();
        $plan_id = intval($_GET['id']);
        $plan = $db->find('plan', $plan_id);
        $room_status = $_GET['status'];
        $msg = '酒店状态调整为：'. $room_statuss[$room_status]['text'];
        $db->insert('plan_history', array_merge(array(
                'operation'=>$msg,
            ), compact('plan_id', 'created', 'operator')));
        $db->update('plan', compact('room_status'), array('id'=>$plan_id));
        header('location:plan.php?act=view&id='.$plan_id);
        die();
        break;
    case 'list':
    default:
        $_GET['act']='list';
        checkPrivilege();
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