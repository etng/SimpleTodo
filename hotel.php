<?php
require "lib/common.php";
ob_start();
switch(@$_GET['act'])
{
case 'add':
    checkPrivilege();
    $title_for_layout = "添加酒店";
    if(isHttpPost())
    {
        $created = now();
        $_POST['hotel']['priority'] = 100-intval($_POST['hotel']['priority']);
        $hotel_id = $db->insert('hotel', array_merge($_POST['hotel'], compact('created')));
        header('location:hotel.php?act=view&id='.intval($hotel_id));
        die();
    }
    include('templates/hotel_add.php');
    break;
case 'view':
    checkPrivilege();
    $title_for_layout = "酒店详情";
    $id = intval($_GET['id']);
    $hotel = $db->fetchRow('select hotel.*,destination.name as destination_name from hotel  left join destination on destination.id=hotel.destination_id where hotel.id=' . $id);
    $price_trends = array();
    $today = date('Y-m-d');
    $later = date('Y-m-d',strtotime('+10 days'));
    $sql = "
        SELECT *
        FROM `room_daily_price`
        WHERE `hotel_id`={$id} AND the_date>='{$today}' AND the_date <='{$later}'
        ";
    $price_fields = array('cost'=>'成本', 'public_price'=>'市场价', 'min_price'=>'最低价', 'default_price'=>'默认价', 'max_price'=>'最高价','memo'=>'备注');
    foreach($db->fetchAll($sql) as $row)
    {
        $price_trends[$row['the_date']][$row['room_type']] = sub_array($row, array_keys($price_fields));
    }
    include('templates/hotel_view.php');
    break;
case 'edit':
    checkPrivilege();
    $title_for_layout = "编辑酒店";
    $id = intval($_GET['id']);
    $hotel = $db->find('hotel', $id);
    if(isHttpPost())
    {
        $updated= now();
        $db->update('hotel', array_merge($_POST['hotel'], compact('updated')), compact('id'));
        header('location:hotel.php?act=view&id='.intval($id));
        die();
    }
    include('templates/hotel_edit.php');
    break;
case 'delete':
    checkPrivilege();
    $id = intval($_GET['id']);
    $db->delete('hotel', compact('id'));
    header('location:hotel.php');
    die();
    break;
case 'add-price':
    checkPrivilege();
    $updated = now();
    $record = $_POST['price'];
    $hotel_id = $record['hotel_id'];
    $the_date_ts = $start_date_ts = strtotime($_POST['start_date']);
    $end_date_ts = strtotime($_POST['end_date']);
    while($the_date_ts<=$end_date_ts)
    {
        $the_date = date('Y-m-d H:i:s', $the_date_ts);
        $room_type = $record['room_type'];
        $db->delete('room_daily_price', compact('hotel_id', 'the_date', 'room_type'));
        $db->insert('room_daily_price', $record = array_merge($record, compact('the_date', 'updated')));
        $the_date_ts+=86400;
    }
    header('location:hotel.php?act=view&id='.$record['hotel_id']);
    die();
    break;
case 'list':
default:
    $_GET['act']='list';
    checkPrivilege();
    $title_for_layout = "酒店";


    $query = $db->select()->from('hotel')
        ->clearField()
        ->addField('hotel.*')
        ->addField('destination.name as destination_name')
        ->leftJoin('hotel', 'destination_id', 'destination', 'id')
        ->order_by('hotel.priority', 'ASC')
        ->order_by('hotel.id', 'DESC')
        ;
    $did ='all';
    if(!empty($_REQUEST['did']))
    {
        if(intval($_REQUEST['did']))
        {
            $query->where('hotel.destination_id='.intval($_REQUEST['did']));
            $did = intval($_REQUEST['did']);
        }
    }

    $total = $query->count();
    $pager = makePager($total, current_staff('preference_perpage', 10));
    $query->limit($pager['limit'], $pager['offset']);
    $hotels = $query->execute();

    include('templates/hotel_list.php');
    break;
}
$content_for_layout = ob_get_clean();
include('templates/default.layout.php');
