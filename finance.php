<?php
require "lib/common.php";
ob_start();
switch(@$_GET['act'])
{
    case 'save':
        checkPrivilege();
        if($_SERVER['REQUEST_METHOD']=='POST')
        {

        }
        header('location:setting.php');
        break;
    case 'list':
    default:
        checkPrivilege();
        $title_for_layout = "财务管理";
        $plan_payments = $db->fetchAll('select plan_payment.*,staff.name as valid_by_name from plan_payment
        left join plan on plan.id=plan_payment.plan_id
        left join staff on staff.id=plan_payment.valid_by
        where 1=1 order by plan_payment.created desc', 'id');
        include('templates/finance.php');
        break;
}
$content_for_layout = ob_get_clean();
include('templates/default.layout.php');