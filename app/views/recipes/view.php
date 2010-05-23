<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title><?=$recipe->name?> - The Slice-up Cookbook</title>
<script type="text/javascript" src="<?=base_url()?>res/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>res/jquery.simplemodal-1.3.5.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>res/cb.css"/>
<style type="text/css">
#photo {
  background: black url(<?=base_url()?>res/<?=$recipe->photo?>) center center no-repeat;
}
</style>
</head>
<body>

<div id="wrapper">

<div id="header">
 <h1><?=$recipe->name?></h1>
 <h2><?=anchor('/', 'The <em>Slice-up</em> Cookbook')?></h2>
</div>

<div id="photo"></div>

<ul id="controls">
 <li><?=anchor('edit/'.$recipe->id, 'edit', array('id' => 'editControl'))?></li>
 <li><a href="#">delete</a></li>
</ul>

<div id="dialog" style="display:none"></div>

<div id="content">

<?=$this->load->view('msg')?>

<div id="ingredientsList">
<h3>Ingredients</h3>
<ul>
<?php foreach ($recipe->ingredients as $ingredient): ?>
 <li><?=$ingredient?></li>
<?php endforeach; ?>
</ul>
</div>

<div id="instructionsList">
<h3>Instructions</h3>
<?php foreach ($recipe->instructions as $instruction): ?>
<p><?=$instruction?></p>
<?php endforeach; ?>
</div>

<div style="clear:both"></div>

</div><!-- /#content -->

<div id="footer">
Copyright &copy; 2010, Dan Parks. All Rights Reserved.
</div>

</div><!-- /#wrapper -->

<script type="text/javascript">
$(document).ready(function () {

  $("#editControl").click(function () {
    $("#dialog").load(this.href);
    $("#dialog").modal({
      position: ["15%", "30%"]
    });
    return false;
  });

});
</script>

</body>
</html>
