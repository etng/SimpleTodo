<?php
require "lib/common.php";

switch(@$_GET['act'])
{
    case 'view':
        $id = intval($_GET['id']);
        $todo = $db->find('todo', $id);
        var_dump($todo);
        break;
    case 'create':
        $id = Todo::create(array(
            'title' => $_POST['title'],
            'all_day' => (bool)$_POST['all_day'],
            'start_date' => $_POST['start'],
            'end_date' =>$_POST['end'],
            'confirmed' => false,
        ));
        $status = $id?'success':'fail';
        $todo = $db->find('todo', $id);
        echo json_encode(compact('status', 'todo'));
        break;
    case 'update':
        $updates = array();
        $id = intval($_POST['id']);
        if(isset($_POST['start']))
        {
            $updates['start_date'] = $_POST['start'];
        }
        if(isset($_POST['end']))
        {
            $updates['end_date'] = $_POST['end'];
        }
        $status = Todo::update($updates, array('id'=>$id))?'success':'fail';
        $todo = $db->find('todo', $id);
        echo json_encode(compact('status', 'todo'));
        break;
    case 'list':
    default:
        $colors = $config['colors'];
        $todos = array();
        $start = $_GET['start'];
        $end = $_GET['end'];
        $sql = 'select * from todo where start_date>="%s" and end_date<="%s"';
        foreach($db->fetchAll(sprintf($sql, date('Y-m-d H:i:s', $start), date('Y-m-d H:i:s', $end))) as $i=>$todo)
        {
            $ci = $i%count($colors);
            $todos []= array(
                'id' => intval($todo['id']),
                'all_day' => (bool)$todo['all_day'],
                'editable' => !$todo['confirmed'],
                'title' => $todo['title'],
                'description' => $todo['description'],
                'url' => $todo['url'],
                'start' => date('Y-m-d H:i:s', strtotime($todo['start_date'])),
                'end' => date('Y-m-d H:i:s', strtotime($todo['end_date'])),
                'textColor' => $todo['text_color']?$todo['text_color']:$colors[$ci]['textColor'],
                'color' => $todo['background_color']?$todo['background_color']:$colors[$ci]['color'],
            );
        }
        echo json_encode($todos);
        break;
}