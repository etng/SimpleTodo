  <h3>备忘</h3>
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>时间</th>
        <th>留言人</th>
        <th>内容</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($plan['notes'] as $i=>$plan_note):?>
      <tr>
        <td><?php echo $plan_note['created'];?></td>
        <td><?php echo $plan_note['staff_name'];?></td>
        <td><?php echo $plan_note['content'];?></td>
      </tr>
      <?php endforeach;?>
    </tbody>
  </table>
  <input type="button" value="添加备忘" class="btn btn_add_note"/>
<script type="text/javascript">
<!--
      jQuery(function($){
          $('input.btn_add_note').click(function(){
             jQuery.facebox({ div: '#add_note_form' });
          });
      });
//-->
</script>
<div id="add_note_form" style="display:none">
  <h4>请留下你想说的话</h4>
  <div class="close">&times;</div>
  <form method="post" action="plan.php?act=add-note">
    <input type="hidden" name="note[plan_id]" value="<?php echo $plan['id']?>" />
    <dl>
      <dt>内容</dt>
      <dd>
        <textarea name="note[content]" id="note_content" rows="3" cols="70"></textarea>
      </dd>
    </dl>
    <input type="submit" value="提交" class="btn" />
  </form>
</div>