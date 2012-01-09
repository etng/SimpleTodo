<?php
class Todo
{
     public static function preSave($data)
    {
        foreach(array('end_date', 'start_date') as $field)
        {
            if(!empty($data[$field]) && is_numeric($data[$field]))
            {
                $data[$field] = date('Y-m-d H:i:s', $data[$field]);
            }
        }
        return $data;
     }
    public static function create($data)
    {
        global $db;
        $data = self::preSave($data);
        $id=$db->insert('todo', $data);
        $todo = $db->find('todo', $id);
        self::updateInfo($todo);
        return $id;
    }

    public static function update($data, $where)
    {
        global $db;
        $data = self::preSave($data);
        $result = $db->update('todo', $data, $where);
        foreach($db->find('todo', $where) as $todo)
        {
            self::updateInfo($todo);
        }
        return $result;
    }
    public static function updateInfo($todo)
    {
        global $db;
        $start_ts = strtotime($todo['start_date']);
        $end_ts = strtotime($todo['end_date']);
        $db->update('todo', array(
           'url' => 'todo.php?act=view&id=' . $todo['id'],
           'description' => sprintf('从%s到%s,共计%d天', date('Y-m-d', $start_ts), date('Y-m-d', $end_ts),ceil(($end_ts-$start_ts)/86400)+1)
        ), array('id'=>$todo['id']));
    }
}
