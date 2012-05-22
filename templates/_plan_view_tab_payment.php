  <dl>
    <dt>应付费用</dt>
    <dd><?php echo $plan['price']?></dd>
    <dt>已付费用</dt>
    <dd><?php echo $plan['paid']?></dd>
    <dt>余额</dt>
    <dd><?php echo $plan['balance']?>
      <?php if($plan['balance']!=0 || true):?>
      <input type="button" value="添加支付记录" class="btn btn_add_payment"/>
      <?php endif;?>
    </dd>
    <dt>支付记录</dt>
    <dd>
      <?php $show_plan=false;$plan_payments=$plan['payments'];include('_plan_payment_list.php');?>
    </dd>
  </dl>
  <script type="text/javascript">
  <!--
      jQuery(function($){
          $('input.btn_add_payment').live('click', function(){
              jQuery.facebox({ div: '#payment_add_form' });
            });
      });
  //-->
  </script>
  <div id="payment_add_form" style="display:none">
  <?php include('_payment_add_form.php');?>
</div>
