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
    case 'add-price':
        $updated = now();
        $record = $_POST['price'];
        $the_date_ts = $start_date_ts = strtotime($_POST['start_date']);
        $end_date_ts = strtotime($_POST['end_date']);
        while($the_date_ts<=$end_date_ts)
        {
            $the_date = date('Y-m-d H:i:s', $the_date_ts);
            $db->insert('room_daily_price', $record = array_merge($record, compact('the_date', 'updated')));
            $the_date_ts+=86400;
        }
        header('location:hotel.php?act=view&id='.$record['hotel_id']);
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