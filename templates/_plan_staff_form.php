          <dl>
           <dt>主贴地址</dt>
          <dd>
          <input type="text" id="forum_url" name="plan[forum_url]" value="<?php echo @$plan['forum_url'];?>" size="255" /><a href="<?php echo @$plan['forum_url']?>" target="_blank">打开</a></dd>
            <dt>旅行顾问</dt>
            <dd>
                <select id="plan_consult_staff_id" name="plan[consult_staff_id]">
                <?php foreach($consult_staff_options as $id=>$name):?>
                <option value="<?php echo $id;?>"<?php $id==@$plan['consult_staff_id'] && print(' selected="true"');?>><?php echo $name;?></option>
                <?php endforeach;?>
                </select>
            </dd>

            <dt>业务跟进</dt>
            <dd>
                <select id="plan_market_staff_id" name="plan[market_staff_id]">
                <?php foreach($market_staff_options as $id=>$name):?>
                <option value="<?php echo $id;?>"<?php $id==@$plan['market_staff_id'] && print(' selected="true"');?>><?php echo $name;?></option>
                <?php endforeach;?>
                </select>
            </dd>

            <dt>酒店跟进</dt>
            <dd>
                <select id="plan_room_staff_id" name="plan[room_staff_id]">
                <?php foreach($room_staff_options as $id=>$name):?>
                <option value="<?php echo $id;?>"<?php $id==@$plan['room_staff_id'] && print(' selected="true"');?>><?php echo $name;?></option>
                <?php endforeach;?>
                </select>
            </dd><dt>车辆跟进</dt>
            <dd>
                <select id="plan_car_staff_id" name="plan[car_staff_id]">
                <?php foreach($car_staff_options as $id=>$name):?>
                <option value="<?php echo $id;?>"<?php $id==@$plan['car_staff_id'] && print(' selected="true"');?>><?php echo $name;?></option>
                <?php endforeach;?>
                </select>
            </dd>
          </dl>