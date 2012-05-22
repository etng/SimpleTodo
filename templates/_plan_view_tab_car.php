<div>客人要求:　<?php echo $plan['car_request']?></div>
<div>车型及数量:　<?php echo @$config['car_types'][$plan['need_car_type']];?>*<?php echo $plan['need_car_cnt']?></div>
 <div>包车报价：<?php echo $plan['price_per_car'];?>x<?php echo $plan['need_car_cnt']?></div>
<div>司机底价：<?php echo $plan['cost_per_car'];?>x<?php echo $plan['need_car_cnt']?></div>


  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <td>司机</td>
        <td>车型</td>
        <td>民族</td>
        <td>评分</td>
        <td>车号</td>
        <td>电话</td>
        <td>状态</td>
      </tr>
    </thead>
    <tbody>
      <?php if(!empty($plan['need_car_cnt'])):?>
      <?php foreach(range(1, $plan['need_car_cnt']) as $i):?>
      <tr>

        <td><?php echo @$driver['name'];?></td>
        <td><?php echo @$config['car_types'][$driver['car_type']];?></td>
      <td><?php echo @$driver['nationality'];?></td>
      <td><?php echo @$driver['star'];?></td>
      <td><?php echo @$driver['car_plate_num'];?></td>

      <td><?php echo @$driver['phone'];?></td>

        <td>
          <input type="button" value="选择司机" class="btn btn_browse_car"/>
          已安排
          <input type="button" value="取消" class="btn btn_cancel_car"/>
        </td>
      </tr>
      <?php endforeach;?>
      <?php else:?>
      <tr>
        <td colspan="100">整个行程无需用车</td>
      </tr>
      <?php endif;?>
    </tbody>
  </table>

<?php
$query = $db->select()->from('driver')
        ->clearField()
        ->addField('driver.*')
//        ->addField('destination.name as destination_name')
//        ->leftJoin('driver', 'destination_id', 'destination', 'id')
        ->order_by('driver.id', 'DESC')
        ;
    $drivers = $query->execute();
$nationalities = $db->fetchCol('select distinct nationality from driver ');
?>
<div id="table_browse_car">
    <div class="row">
  <div class="span4"><h4>过滤</h4></div>
  <div class="span8"></div>
</div>
<div class="row">
  <div class="span2">车型</div>
  <div class="span10 filter-car_type"><a href="#" class="active">所有</a><?php foreach($config['car_types'] as $car_type=>$text):?>
  <a href="#<?php echo $car_type;?>"><?php echo $text;?></a>
  <?php endforeach;?></div>
</div>
<div class="row">
  <div class="span2">民族</div>
  <div class="span10 filter-nationality"><a href="#" class="active">所有</a><?php foreach($nationalities as $nationality): /* @var Type $row */?>
  <a href="#<?php echo $nationality;?>"><?php echo $nationality;?></a>
  <?php endforeach;?></div>
</div>

  <table class="table table-bordered table-striped table-filter-car">
    <thead>
      <tr>
        <td>司机</td>
        <td>车型</td>
        <td>民族</td>
        <td>评分</td>
        <td>车号</td>
        <td>电话</td>
        <td>状态</td>
      </tr>
    </thead>

      <?php if(!empty($drivers)):?><tbody>
      <?php foreach($drivers as $driver):?>
      <tr data-car_type="<?php echo $driver['car_type'];?>" data-nationality="<?php echo $driver['nationality'];?>" id="driver_tr_<?php echo @$driver['id'];?>">

        <td><?php echo @$driver['name'];?></td>
        <td><?php echo @$config['car_types'][$driver['car_type']];?></td>
      <td><?php echo @$driver['nationality'];?></td>
      <td><?php echo @$driver['star'];?></td>
      <td><?php echo @$driver['car_plate_num'];?></td>

      <td><?php echo @$driver['phone'];?></td>

        <td>

          <span class="chooser"><input type="button" value="选择安排" class="btn btn_select_car"/></span>

          <span class="cancler">已安排
          <input type="button" value="取消" class="btn btn_cancel_car"/></span>
        </td>
      </tr>

      <?php endforeach;?>
      </tbody>
      <?php else:?>
      <tr>
        <td colspan="100">没有车辆，无法安排</td>
      </tr>
      <?php endif;?>

  </table>
  </div>
  <script type="text/javascript">
  <!--
    jQuery(function($){

          $('input.btn_browse_car').live('click', function(){
              jQuery.facebox({ div: '#table_browse_car' });

        $facebox = $('#facebox');
         $('input.btn_select_car', $facebox).live('click', function(){
             $tr = $(this).closest('tr');
             console.log($tr, $tr.attr('id'));
 });
        $trs = $('table.table-filter-car', $facebox).find('tbody tr');
      filters={'car_type':'', 'nationality':''};
      $.each(filters, function(k, v){
        $('.filter-'+k+' a', $facebox).click(function(e){
            $a = $(this);
            $a.parent().find('a').removeClass('active');
            $a.addClass('active');
            filters[k]=$a.attr('href').substr(1);
            doTableFilter();
            e.preventDefault();
        });
      });
      function doTableFilter()
      {
          $trs.show();
            $trs.each(function(i, tr){
                $tr = $(tr);
                var flag=true;

                $.each(filters, function(k, v){
                    if(flag && v.length)
                    {
                        if($tr.data(k)!=v)
                        {
                            flag=false;
                        }
                    }
                });
                console.log(filters, $tr, flag);
                $tr.toggle(flag);
            });
      }
            });


    });
  //-->
  </script>