<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title><?php if (isset($title)) echo "$title - "; ?>The Slice-up Cookbook</title>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>res/cb.css"/>
<script type="text/javascript" src="<?=base_url()?>res/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>res/jquery.simplemodal-1.3.5.min.js"></script>
<style type="text/css">
#photo {
<?php if (isset($photo)): ?>
  background: black url(<?=base_url().$photo?>) center center no-repeat;
<?php else: ?>
  display: none;
<?php endif; ?>
}
</style>
</head>
<body class="orangeTricolor">

<div id="wrapper">

<div id="header">
 <h1><?php if (isset($title)) echo $title; ?>&nbsp;</h1>
 <h2>
 <?php if ($this->session->userdata('logged_in')): ?>
  <?=anchor('/toc', $this->session->userdata('bookname') . "'s <em>Slice-up</em> Cookbook")?>
 <?php else: ?>
  <?=anchor('', 'The <em>Slice-up</em> Cookbook')?>
 <?php endif; ?>
 </h2>
</div>

<div id="photo"></div>

<?=$this->load->view('controls')?>

<div id="dialog" style="display:none"></div>

<div id="content">
<?=$this->load->view('messages');?>
<?=$content?>
</div><!-- /#content -->

<div id="footer">
Copyright &copy; 2010, Dan Parks. All Rights Reserved.
</div>

</div><!-- /#wrapper -->

<script type="text/javascript">
$(document).ready(function () {

  $("#addControl, #editControl").click(function () {
    $("#dialog").load(this.href);
    $("#dialog").modal();
    return false;
  });

});
</script>

</body>
</html>
