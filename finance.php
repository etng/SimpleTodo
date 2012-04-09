<?php
require "lib/common.php";
ob_start();
$valid_options = array(
    'all'=>'所有',
    '0'=>'待审核',
    '1'=>'已审核',
);
switch(@$_GET['act'])
{
    case 'save':
        checkPrivilege();
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $valid_by = current_staff('id');
            $valid_at = now();
            $payment = $_REQUEST['payment'];
            $id = intval($payment['id']);
            $is_valid = intval($payment['is_valid']);
            $db->update('plan_payment', compact('valid_by', 'valid_at', 'is_valid'), compact('id'));
        }
        header('location:finance.php?v='.$is_valid);
        break;
    case 'list':
    default:
        checkPrivilege();
        $title_for_layout = "财务管理";
        $where = array();
        $is_valid = 'all';
        if(isset($_REQUEST['v']) && ($_REQUEST['v']!='all'))
        {
            $is_valid = intval($_REQUEST['v']);
            $where[]='plan_payment.is_valid='.$is_valid;
        }
        $s_where = $where?' where '.implode(' and ', $where):'';
        $plan_payments = $db->fetchAll('select plan_payment.*,staff.name as valid_by_name from plan_payment
        left join plan on plan.id=plan_payment.plan_id
        left join staff on staff.id=plan_payment.valid_by
        '.$s_where.' order by plan_payment.created desc', 'id');
        include('templates/finance.php');
        break;
}
$content_for_layout = ob_get_clean();
include('templates/default.layout.php');