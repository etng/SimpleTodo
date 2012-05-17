<ul class="breadcrumb">
  <li><a href="/"><i class="icon-home"></i>首页</a> <span class="divider">/</span></li>
  <li><a href="<?php echo $table['name'];?>.php?act=list"><?php echo $table['comment'];?></a> <span class="divider">/</span></li>
  <li class="active">添加</li>
</ul>
[?php include dirname(__file__) . '/<?php echo $table['name'];?>_form.php';?]