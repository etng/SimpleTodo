  <form method="post" action="plan.php?act=add-payment">
 <?php if(!empty($plan['id'])):?>
  <input type="hidden" name="payment[plan_id]" value="<?php echo @$plan['id']?>" />
<?php endif;?>
    <dl>
<?php if(empty($plan['id'])):?>
<dt>所属项目</dt><dd>
<input type="hidden" name="return_url" value="<?php echo $_SERVER['REQUEST_URI'];?>" />
<input type="text" name="payment[plan_id]" value="" /></dd>
<?php endif;?>
      <dt>类目</dt><dd><input type="text" name="payment[cate]" id="payment_cate" value="" /></dd>
      <dt>金额</dt><dd><input type="text" name="payment[amount]" id="payment_amount" value="" /></dd>
      <dt>支付方式</dt><dd><select name="payment[via]" id="payment_via">
      <?php foreach($config['payment_vias'] as $via=>$text): /* @var Array $row */?>
      <option value="<?php echo $via;?>" selected="selected"><?php echo $text;?></option>
      <?php endforeach;?>
      </select></dd>
      <dt>备注</dt>
      <dd><textarea name="payment[memo]" id="payment_memo" rows="3" cols="70"></textarea></dd>
    </dl>
    <input type="submit" value="提交" />
  </form>