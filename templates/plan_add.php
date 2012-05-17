<h3><?php echo $title_for_layout;?></h3>
<?php
$start_date=time();
$forum_url = '';
?>
<form method="post" action="" enctype="multipart/form-data">
  <div class="tabbable tabs-top">
    <ul class="nav nav-tabs">
      <li><a href="#tab_contact" data-toggle="tab">联系人</a></li>
      <li><a href="#tab_tourist" data-toggle="tab">游客</a></li>
      <li class="active"><a href="#tab_schedule" data-toggle="tab">日程</a></li>
      <li><a href="#tab_request" data-toggle="tab">要求</a></li>
      <li><a href="#tab_staff" data-toggle="tab">跟单</a></li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane" id="tab_contact">
        <dl>
          <dt>姓名</dt>
          <dd>
            <input type="text" id="contact_name" name="contact[name]" value="<?php echo @$contact['name'];?>"/>
          </dd>
          <dt>电话</dt>
          <dd>
            <input type="text" id="contact_phone" name="contact[phone]" value="<?php echo @$contact['phone'];?>"/>
          </dd>
          <dt>Email</dt>
          <dd>
            <input type="text" id="contact_email" name="contact[email]" value="<?php echo @$contact['email'];?>"/>
          </dd>
          <dt>论坛Id</dt>
          <dd>
            <input type="text" id="contact_forum_uid" name="contact[forum_uid]" value="<?php echo @$contact['forum_uid'];?>"/>
          </dd>
        </dl>
      </div>
      <div class="tab-pane" id="tab_tourist">
        <label>人数：
          <input type="text" id="tourist_cnt" name="plan[tourist_cnt]" value="<?php echo @$tourist_cnt;?>" size="3" />
        </label>
        <div class="alert alert-notice">旅客信息不用全部填写，仅保存有姓名的信息，可在订单中修改</div>
        <div id="tourists_tabs">
          <?php $i=0;while($i++<6):?>
          <dl>
            <dt>旅客<?php echo $i;?></dt>
            <dd>
              <dl>
                <dt>姓名</dt>
                <dd>
                  <input type="text" id="tourist_name_<?php echo $i;?>" name="tourist[name][<?php echo $i;?>]" value="<?php echo @$tourist['name'];?>"/>
                </dd>
                <dt>电话</dt>
                <dd>
                  <input type="text" id="tourist_phone_<?php echo $i;?>" name="tourist[phone][<?php echo $i;?>]" value="<?php echo @$tourist['phone'];?>"/>
                </dd>
                <dt>证件类型</dt>
                <dd>
                  <select id="tourist_card_type_<?php echo $i;?>" name="tourist[card_type][<?php echo $i;?>]">
                    <?php foreach($config['id_card_types'] as $card_type=>$text):?>
                    <option value="<?php echo $card_type;?>"<?php $card_type==@$tourist['card_type'] && print(' selected="true"');?>><?php echo $text;?></option>
                    <?php endforeach;?>
                  </select>
                </dd>
                <dt>证件号码</dt>
                <dd>
                  <input type="text" id="tourist_card_number_<?php echo $i;?>" name="tourist[card_number][<?php echo $i;?>]" value="<?php echo @$tourist['card_type'];?>"/>
                </dd>
                <dt>证件照片</dt>
                <dd>
                  <label>网址：
                    <input type="text" id="tourist_card_photo_url_<?php echo $i;?>" name="tourist[card_photo_url][<?php echo $i;?>]" size="80" value="<?php echo @$tourist['card_photo'];?>"/>
                  </label>
                  <br />
                  <label>上传：
                    <input type="file" class="span3" id="tourist_card_photo_file_<?php echo $i;?>" name="tourist_card_photo_file[<?php echo $i;?>]" />
                  </label>
                </dd>
              </dl>
            </dd>
          </dl>
          <?php endwhile;?>
        </div>
      </div>
      <div class="tab-pane active" id="tab_schedule">
        <?php include('_plan_schedule_form.php')?>
      </div>
      <div class="tab-pane" id="tab_request">
        <?php include('_plan_request_form.php')?>
      </div>
      <div class="tab-pane" id="tab_staff">
        <?php include('_plan_staff_form.php')?>
      </div>
    </div>
  </div>
  <!-- /tabbable -->
  <input type="submit" class="btn btn-primary" />
</form>
<script type='text/javascript'>
jQuery(function($){
    <?php include(dirname(__file__) .'/plan_edit.js.php');?>
    var titles=[],contents=[];
    $('#tourists_tabs > dl').each(function(i, dl){
        var $dl = $(dl);
        titles.push($('>dt', $dl).html());
        contents.push($('>dd:first', $dl).html());
    	$dl.remove();
    });
    var ul=$('<ul/>');
    $('#tourists_tabs').empty();
    $.each(titles, function(i, title){
        $('#tourists_tabs').append($('<div/>').attr('id', 'tourist_tab_'+i).html(contents[i]));
        ul.append($('<li/>').html($('<a>').html(title).attr('href', '#tourist_tab_'+i)));
    });
    $('#tourists_tabs').prepend(ul).tabs();
});
</script> 
