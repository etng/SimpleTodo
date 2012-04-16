<ul class="breadcrumb">
<li><a href="/">首页</a> <span class="divider">/</span></li>
<li><a href="staff.php?act=list">员工</a> <span class="divider">/</span></li>
<li class="active">所有</li>
</ul>

<p class="pull-right">
<a href="staff.php?act=add" class="btn">添加员工</a>
</p>


<table class="table table-bordered table-striped">
    <thead><tr>
        <th>编号</th>
        <th>所属组</th>
        <th>用户名</th>
        <th>论坛ID</th>
        <th>姓名</th>
        <th>电话</th>
        <th>Email</th>
        <th>操作</th>
    </tr> </thead><tbody><?php if(!empty($staffs)):?>

    <?php foreach($staffs as $staff):?>
    <tr>
        <td><?php echo $staff['id'];?></td>
        <td><a href="staff.php?act=group_view&id=<?php echo $staff['group_id'];?>"><?php echo $staff['group_name'];?></a></td>
        <td><?php echo $staff['forum_uid'];?></td>
        <td><?php echo $staff['username'];?></td>
        <td><?php echo $staff['name'];?></td>
        <td><?php echo $staff['phone'];?></td>
        <td><?php echo $staff['email'];?></td>
        <td>
        <a href="staff.php?act=view&id=<?php echo $staff['id'];?>" class="btn btn-info">详情</a>
        <a href="staff.php?act=edit&id=<?php echo $staff['id'];?>" class="btn">编辑</a>
        <a href="staff.php?act=delete&id=<?php echo $staff['id'];?>" class="btn btn-danger">删除</a>
        </td>
    </tr>
    <?php endforeach;?>
    <?php else:?>
    <tr>
        <td colspan="100"><a href="staff.php?act=add">找两个丘八</a></td>
    </tr>
    <?php endif;?></tbody>
</table>

  <h4>导入员工</h4>
  <form method="post" enctype="multipart/form-data" action="staff.php?act=import">
    <dl>
      <dt>员工数据CSV文件</dt><dd>
      <label>上传：<input type="file" id="import_staff_list_csv" name="staff_list_csv[]" /></label></dd>
    </dl>
    <input type="submit" value="提交" class="btn" />
  </form>