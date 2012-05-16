<?php
require "lib/common.php";
$schedule_templates = $db->fetchAll('select * from schedule_template', 'id');
ob_start();
$created = $updated = now();
$hotel_options = array();
foreach($db->fetchAll('select * from hotel') as $row)
{
    $hotel_options[$row['destination_id']][$row['id']] = $row['name'];
}
function generatePlanSn($type, $ts)
{
   return $type . date('Ymd',$ts).str_pad(countDailyPlan($ts)+1, 6, 0, STR_PAD_LEFT);
}
function countDailyPlan($ts)
{
    global $db;
    $query = new Et_Db_Select($db);
    $query->from('plan')
    ->where('date(created)="'.date('Y-m-d', $ts).'"')
    ->where('created<"'.date('Y-m-d H:i:s', $ts).'"');

    return $query->count();
}
function isTourLine($line)
{
    return (strpos($line, '，')!==false) || (strpos($line, ',')!==false);
}
function generatePlanTours($plan)
{
  global $tour_sep,$db;
    $plan_id = $plan['id'];
    $start_date = strtotime($plan['start_date']);
    $lines = preg_split('/[\r\n]/', $plan['schedule_txt'], -1, PREG_SPLIT_NO_EMPTY);
    for($i=0,$m=count($lines),$tours=array();$i<$m;$i++)
    {
      $line = trim($lines[$i]);
      if(!empty($line))
      {
        if(isTourLine($line))
        {
            list($dummy, $name) = preg_split("/\s*[,]+\s*/sim", str_replace('，', ',', $line));
            $next_line = trim(@$lines[$i+1]);
            if($next_line && !isTourLine($next_line))
            {
                list($dummy, $attractions) = explode(':', str_replace('：', ':', $next_line), 2);
                $i++;
            }
            $destinations = explode($tour_sep, $name);
            $name = implode($tour_sep, $destinations);
            $destination = end($destinations);
            $destination_id = $db->getOrCreate('destination', array('name'=>$destination, 'slug'=>$destination), compact('created', 'updated'));
            $tour_id = $db->getOrCreate('tour', $values=compact('name', 'destination', 'destination_id', 'attractions'),  compact('created', 'updated'));
            $tours[]=$tour_id;
        }
      }
    }
    $price=0;
    $db->delete('plan_tour', compact('plan_id'));
    $schedule_days = count($tours);
    foreach($tours as $i=>$tour_id)
    {
        $plan_tour = array();
        $plan_tour['the_date'] = date('Y-m-d', $start_date+$i*86400);
        $plan_tour['tourist_cnt'] = $plan['tourist_cnt'];
        $plan_tour['need_room_cnt'] = $plan['need_room_cnt'];
        $plan_tour['need_car_cnt'] = $plan['need_car_cnt'];
        $plan_tour['tour_id'] = $tour_id;
        $plan_tour['plan_id'] = $plan_id;
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
        $plan_tour['hotel_id'] = -1;
        if($hotel_id = getDefaultHotel($tour['destination_id']))
        {
            $plan_tour['hotel_id'] = $hotel_id;
            $plan_tour['room_price_sum'] = $plan_tour['need_room_cnt'] * getHotelStdPrice($plan_tour['hotel_id'], $plan_tour['the_date']);
        }
        $db->insert('plan_tour', $plan_tour);
    }
    $paid = 0;
    $balance = $paid-$price;
    $db->update('plan', compact('price', 'paid', 'balance', 'schedule_days'), array('id'=>$plan_id));
}
$tours = $db->fetchAll('select * from tour');
switch(@$_GET['act'])
{
    case 'add':
        checkPrivilege();
        $title_for_layout = "添加计划";
        $tours = $db->fetchAll('select * from tour');
        $plan = array(
        'start_date'=>date('Y-m-d', strtotime('+'.current_staff('preference_plan_start_date_delay', 15).' day')),
        'arrive_date'=>date('Y-m-d', strtotime('+'.current_staff('preference_plan_arrive_date_delay', 14).' day')),
        'need_insurance'=>0,
        'need_passport'=>0,
        'need_car'=>1,
        'need_hotel'=>1,
        'need_car_cnt'=>1,
        'need_room_cnt'=>2,
        'need_insurance'=>0,
        );
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            if($files = Attachment::fromUpload('tourist_card_photo_file', APP_ROOT . $card_photo_base_url, $allowed_types, $thumb_config))
            {
                foreach($files as $i=>$file)
                {
                    if($file)
                    {
                        $_POST['tourist']['card_photo'][$i] = $card_photo_base_url . 'base/' . $file['filename'];
                    }
                }
            }elseif(!empty($_POST['card_photo_url']))
            {
                if($files = Attachment::fromRemote($_POST['card_photo_url'], APP_ROOT . $card_photo_base_url, $allowed_types, $thumb_config))
                {
                    foreach($files as $i=>$file)
                    {
                        if($file)
                        {
                            $_POST['tourist']['card_photo'][$i] = $card_photo_base_url . 'base/' . $file['filename'];
                        }
                    }
                }
            }

            $contact_id = $db->insert('contact', $_POST['contact']);
            $user_id = 1;
            $status = $default_status;
            $car_status = $default_car_status;
            $room_status = $default_room_status;

            $plan_id = $db->insert('plan', array_merge($_POST['plan'], compact('status', 'car_status', 'room_status', 'user_id', 'contact_id', 'created')));
            $plan = $db->find('plan', $plan_id);
            generatePlanTours($plan);
            foreach($_POST['tourist']['name'] as $i=>$name)
            {
              if(!empty($name))
              {
                $phone= $_POST['tourist']['phone'][$i];
                $card_type= $_POST['tourist']['card_type'][$i];
                $card_number= $_POST['tourist']['card_number'][$i];
                $card_photo= $_POST['tourist']['card_photo'][$i];
                $tourist_id = $db->insert('tourist', compact('name', 'phone', 'card_type', 'card_number', 'card_photo'));
                $tourist_id = $db->insert('plan_tourist', compact('tourist_id', 'plan_id'));
              }
            }
            $db->insert('plan_history', array_merge(array(
                'operation'=>'计划创建完毕，等待进一步确认',
                'operator'=> current_staff(),
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
        $plan['contact'] = $db->find('contact', $plan['contact_id']);
        $plan['schedule_template'] = $db->find('schedule_template', $plan['schedule_template_id']);
        $plan['tourists'] = $db->fetchAll('select * from tourist where id in (select tourist_id from plan_tourist where plan_id=' . $plan['id'] . ')', 'id');
        $plan['notes'] = $db->fetchAll('select plan_note.*,staff.name as staff_name from plan_note left join staff on staff.id=plan_note.staff_id where plan_id=' . $plan['id'] . ' order by plan_note.created desc', 'id');
        $plan['tours'] = $db->fetchAll('select *,plan_tour.id as id from plan_tour left join tour on tour.id=plan_tour.tour_id where plan_tour.plan_id=' . $plan['id'], 'id');
        $plan['history'] = $db->fetchAll('select * from plan_history where plan_id=' . $plan['id'] . ' order by created desc', 'id');
        $plan['payments'] = $db->fetchAll('select * from plan_payment where plan_id=' . $plan['id'] . ' order by created desc', 'id');
        if(empty($plan['sn']))
        {
            $sn=$plan['sn'] = generatePlanSn($plan['type'], strtotime($plan['created']));
            $db->update('plan', compact('sn'), compact('id'));
        }
        include('templates/plan_view.php');
        break;
    case 'edit':
        checkPrivilege();
        $title_for_layout = "修改计划";
        $id = intval($_GET['id']);
        $plan = $db->find('plan', $id);
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $updated= now();
            $db->update('plan', array_merge($_POST['plan'], compact('updated')), compact('id'));
            header('location:plan.php?act=view&id='.intval($id));
            die();
        }
        include('templates/plan_edit.php');
        break;
    case 'update-request':
    case 'update-staff':
    case 'update-schedule':
        checkPrivilege();
        $plan_id = intval($_POST['plan_id']);
        $db->update('plan', $_POST['plan'], array('id'=>$plan_id));
        $plan = $db->find('plan', $plan_id);
        if(@$_GET['act']=='update-schedule')
        {
            generatePlanTours($plan);
        }
         header('location:plan.php?act=view&id='.$plan_id);
         die();
        break;
    case 'update-detail-schedule':
        checkPrivilege();
        $plan_id = intval($_POST['plan_id']);
        foreach($_POST['plan_tour'] as $id=>$data)
        {
            $db->update('plan_tour', $data, compact('id'));
        }
         header('location:plan.php?act=view&id='.$plan_id);
         die();
        break;
    case 'delete':
        checkPrivilege();
        $id = intval($_GET['id']);
        $db->delete('plan', compact('id'));
        header('location:plan.php');
        die();
        break;
    case 'add-payment':
        checkPrivilege();
        $created = now();
        $operator = current_staff();
        $plan_id = intval($_POST['payment']['plan_id']);
        $plan = $db->find('plan', $plan_id);
        if($plan)
        {
            $payment = $_POST['payment'];
            $db->insert('plan_payment', array_merge($payment, compact('created', 'operator')));
            $paid = $db->fetchOne('select sum(amount) from plan_payment where plan_id=' . $plan_id);
            $balance = $paid-$plan['price'];
            $db->update('plan', compact('paid', 'balance'), array('id'=>$plan_id));
            $url = @$_POST['return_url'];
            if(empty($url))
            {
                $url = 'plan.php?act=view&id='.$plan_id;
            }
             header('location:'.$url);
        }
        else
        {
            die('订单号丢失！');
        }
        die();
        break;
    case 'add-note':
        checkPrivilege();
        $created = now();
        $staff_id = current_staff('id');
        $plan_id = intval($_POST['note']['plan_id']);
        $plan = $db->find('plan', $plan_id);
        $note = $_POST['note'];
        $db->insert('plan_note', array_merge($note, compact('created', 'staff_id')));
         header('location:plan.php?act=view&id='.$plan_id);
         die();
        break;
    case 'add-tourist':
        checkPrivilege();
        $created = now();
        $staff_id = current_staff('id');
        $plan_id = intval($_POST['tourist']['plan_id']);
        $plan = $db->find('plan', $plan_id);
        $tourist = array();
        foreach($_POST['tourist'] as $field=>$field_data)
        {
            $tourist[$field] = $field_data['new'];
        }
            if($files = Attachment::fromUpload('tourist_card_photo_file', APP_ROOT . $card_photo_base_url, $allowed_types, $thumb_config))
            {
                foreach($files as $i=>$file)
                {
                    if($file)
                    {
                        $tourist['card_photo'] = $card_photo_base_url . 'base/' . $file['filename'];
                    }
                }
            }elseif(!empty($_POST['tourist_card_photo_url_new']))
            {
                if($files = Attachment::fromRemote($_POST['tourist_card_photo_url'], APP_ROOT . $card_photo_base_url, $allowed_types, $thumb_config))
                {
                    foreach($files as $i=>$file)
                    {
                        if($file)
                        {
                            $tourist['card_photo'] = $card_photo_base_url . 'base/' . $file['filename'];
                        }
                    }
                }
            }
        $tourist_id = $db->insert('tourist', $tourist);
        $db->insert('plan_tourist', compact('plan_id', 'tourist_id'));
        $tourist_cnt = $db->fetchOne('select count(1) as cnt from plan_tourist where plan_id=' . $plan_id);
        $db->update('plan', compact('tourist_cnt'), array('id'=>$plan_id));
         header('location:plan.php?act=view&id='.$plan_id);
         die();
        break;
    case 'update-tourist':
        checkPrivilege();
        $created = now();
        $staff_id = current_staff('id');
        $plan_id = intval($_POST['plan_id']);
        $tourist_id = intval($_POST['tourist']['id']);
        $plan = $db->find('plan', $plan_id);
        $old_tourist = $db->find('tourist', $tourist_id);
        $tourist = $_POST['tourist'];
            if($files = Attachment::fromUpload('tourist_card_photo_file', APP_ROOT . $card_photo_base_url, $allowed_types, $thumb_config))
            {
                foreach($files as $i=>$file)
                {
                    if($file)
                    {
                        $tourist['card_photo'] = $card_photo_base_url . 'base/' . $file['filename'];
                    }
                }
            }elseif(!empty($_POST['tourist_card_photo_url']))
            {
                if($files = Attachment::fromRemote($_POST['tourist_card_photo_url'], APP_ROOT . $card_photo_base_url, $allowed_types, $thumb_config))
                {
                    foreach($files as $i=>$file)
                    {
                        if($file)
                        {
                            $tourist['card_photo'] = $card_photo_base_url . 'base/' . $file['filename'];
                        }
                    }
                }
            }
        $db->update('tourist', $tourist, array('id'=>$tourist_id));
         header('location:plan.php?act=view&id='.$plan_id);
         die();
        break;
    case 'update-contact':
        checkPrivilege();
        $updated = now();
        $staff_id = current_staff('id');
        $plan_id = intval($_POST['plan_id']);
        $plan = $db->find('plan', $plan_id);
        $contact_id = $plan['contact_id'];
        $contact = $_POST['plan']['contact'];
        $db->update('contact', $contact, array('id'=>$contact_id));
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
    case 'hotel-daily-price':
        checkPrivilege();
        $hotel_id = intval($_GET['hotel_id']);
        $the_date = $_GET['the_date'];
        if($price = getHotelStdPrice($hotel_id, $the_date))
        {
            $status = true;
        }
        else
        {
            $status = false;
            $message = '暂无报价' . $the_date;
        }
        $price = intval($price);
        echo json_encode(compact('status', 'message', 'price'));
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
        $operator = current_staff();
        $created = now();
        $plan_id = intval($_GET['id']);
        $plan = $db->find('plan', $plan_id);
        $status = $_GET['status'];
        $msg = $plan_statuss[$status]['text'];
        $db->insert('plan_history', array_merge(array(
                'operation'=>$msg,
            ), compact('plan_id', 'created', 'operator')));
        $extra= array();
        if(!empty($plan_statuss[$status]['unlock_car']))
        {
            $extra['car_status'] = 'pending';
        }
        if(!empty($plan_statuss[$status]['unlock_room']))
        {
            $extra['room_status'] = 'pending';
        }
        if(!empty($plan_statuss[$status]['lock_car']))
        {
            $extra['car_status'] = 'locked';
        }
        if(!empty($plan_statuss[$status]['lock_room']))
        {
            $extra['room_status'] = 'pending';
        }
        if($status=='assignning')
        {
          //确认开始安排后禁止修改行程，并开始安排酒店和车辆
          $extra['schedule_status']='locked';
        }
        $db->update('plan', array_merge(compact('status'), $extra), array('id'=>$plan_id));
        header('location:plan.php?act=view&id='.$plan_id);
        die();
        break;
    case 'set-car-status':
        checkPrivilege();
        $operator = current_staff();
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
        $operator = current_staff();
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

        $query = new Et_Db_Select($db);
        $query->from('plan')
        ->clearField()
        ->addField('plan.*')
        ->addField('contact.name as contact_name')
        ->addField('schedule_template.name as schedule_template_name')
        ->addField('contact.forum_uid')
        ->leftJoin('plan', 'contact_id', 'contact', 'id')
        ->leftJoin('plan', 'schedule_template_id', 'schedule_template',  'id')
        ->order_by('plan.arrive_date', 'DESC')
        ->order_by('plan.id', 'DESC')
        ;
        if(!empty($_GET['st']) && isset($plan_statuss[$_GET['st']]))
        {
            $query->where('status="'.$_GET['st'] . '"');
        }
        if(@$_GET['consult_staff_id'])
        {
            $query->where('consult_staff_id="'.intval($_GET['consult_staff_id']) . '"');
        }
        if(@$_GET['market_staff_id'])
        {
            $query->where('market_staff_id="'.intval($_GET['market_staff_id']) . '"');
        }
        if(@$_GET['arrive_date'])
        {
            $query->where('arrive_date="'.$_GET['arrive_date'] . '"');
        }
        $cur_status = @$_GET['st'];
        if(!$cur_status)
        {
            $cur_status = 'all';
        }
        $total = $query->count();
        $pager = makePager($total, current_staff('preference_perpage', 10));
        $query->limit($pager['limit'], $pager['offset']);
        $plans = $query->execute();
        include('templates/plan_list.php');
        break;
}
$content_for_layout = ob_get_clean();
include('templates/default.layout.php');


