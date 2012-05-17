<ul class="breadcrumb">
  <li><a href="/">首页</a> <span class="divider">/</span></li>
  <li><a href="tour.php?act=list">线路</a> <span class="divider">/</span></li>
  <li class="active">编辑#<?php echo $tour['id']; ?></li>
</ul>
<form method="post" action="">
  <?php include('_tour_form.php');?>
  <input type="submit" class="btn btn-primary" />
</form>
