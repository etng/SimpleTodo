<?php
$nav = array(
//    array('u'=>array('c'=>'calendar', 'a'=>'list'), 'title'=>'我的日程'),
    'plan'=>array('u'=>array('c'=>'plan', 'a'=>'list'), 'title'=>'订单管理', 'children'=>array(
        array('u'=>array('c'=>'plan', 'a'=>'add'), 'title'=>'添加订单'),
        'divider',
    )),

    array('u'=>array('c'=>'driver', 'a'=>'list'), 'title'=>'车辆管理', 'children'=>array(
    array('u'=>array('c'=>'driver', 'a'=>'list'), 'title'=>'所有车辆安排'),
    array('u'=>array('c'=>'driver', 'a'=>'list'), 'title'=>'未完车辆安排'),
    array('u'=>array('c'=>'driver', 'a'=>'list'), 'title'=>'已完成车辆安排'),
    'divider',
    array('u'=>array('c'=>'driver', 'a'=>'list'), 'title'=>'司机列表'),
    array('u'=>array('c'=>'driver', 'a'=>'add'), 'title'=>'添加司机'),
    )),

    array('u'=>array('c'=>'hotel', 'a'=>'list'), 'title'=>'酒店管理', 'children'=>array(
    array('u'=>array('c'=>'hotel', 'a'=>'list'), 'title'=>'所有酒店安排'),
    array('u'=>array('c'=>'hotel', 'a'=>'list'), 'title'=>'未完成酒店安排'),
    array('u'=>array('c'=>'hotel', 'a'=>'list'), 'title'=>'已完成酒店安排'),
    'divider',
    array('u'=>array('c'=>'hotel', 'a'=>'list'), 'title'=>'酒店列表'),
    array('u'=>array('c'=>'hotel', 'a'=>'list'), 'title'=>'酒店价格更新'),
    )),

    array('u'=>array('c'=>'misc', 'a'=>'list'), 'title'=>'票务杂务管理', 'children'=>array(
      array('u'=>array('c'=>'ticket', 'a'=>'list'), 'title'=>'票务'),
      array('u'=>array('c'=>'affair', 'a'=>'list'), 'title'=>'杂务'),
    )),
    array('u'=>array('c'=>'finance', 'a'=>'list'), 'title'=>'财务管理', 'children'=>array(
    )),

    array('u'=>array('c'=>'article', 'a'=>'list'), 'title'=>'产品管理', 'children'=>array(
    array('u'=>array('c'=>'article', 'a'=>'list'), 'title'=>'文章'),
    array('u'=>array('c'=>'destination', 'a'=>'list'), 'title'=>'目的地'),
    array('u'=>array('c'=>'tour', 'a'=>'list'), 'title'=>'线路'),
    'divider',
    array('u'=>array('c'=>'schedule_template', 'a'=>'list'), 'title'=>'行程模版'),
    array('u'=>array('c'=>'schedule_template_cate', 'a'=>'list'), 'title'=>'行程模版分类'),
    )),

    array('u'=>array('c'=>'setting', 'a'=>'list'), 'title'=>'系统设置', 'children'=>array(
      array('u'=>array('c'=>'setting', 'a'=>'list'), 'title'=>'默认值'),
      array('u'=>array('c'=>'staff', 'a'=>'list'), 'title'=>'员工'),
      array('u'=>array('c'=>'staff', 'a'=>'group_list'), 'title'=>'组织架构'),
    )),
);
$nav['plan']['children'][]=array('u'=>array('c'=>'plan', 'a'=>'list', 'st'=>'all'), 'title'=>'所有');
foreach($plan_statuss as $status=>$status_info){

  $nav['plan']['children'][]=array('u'=>array('c'=>'plan', 'a'=>'list', 'st'=>$status), 'title'=>$status_info['text']);
}
return $nav;