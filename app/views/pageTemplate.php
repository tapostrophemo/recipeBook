<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title><?php if (isset($title)) echo "$title - "; ?>The Slice-up Cookbook</title>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>res/cb.css"/>
<script type="text/javascript" src="<?=base_url()?>res/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>res/jquery.simplemodal-1.3.5.min.js"></script>
</head>
<body>

<div id="wrapper">

<div id="header">
 <h1><?php if (isset($title)) echo $title; ?>&nbsp;</h1>
 <h2><?=anchor('/', 'The <em>Slice-up</em> Cookbook')?></h2>
</div>

<ul id="controls">
<?php $segment = $this->uri->segment(1, ''); if ( $segment != 'edit' && $segment != 'add'): ?>
 <li><?=anchor('add', 'add recipe', array('id' => 'addControl'))?></li>
<?php endif; ?>
</ul>

<div id="dialog" style="display:none"></div>

<div id="content">
<?=$this->load->view('msg');?>
<?=$content?>
</div><!-- /#content -->

<div id="footer">
Copyright &copy; 2010, Dan Parks. All Rights Reserved.
</div>

</div><!-- /#wrapper -->

<script type="text/javascript">
$(document).ready(function () {

  $("#addControl").click(function () {
    $("#dialog").load(this.href);
    $("#dialog").modal();
    return false;
  });

});
</script>

</body>
</html>
