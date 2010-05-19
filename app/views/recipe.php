<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title><?=$recipe->name?> - The Slice-up Cookbook</title>
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
 <li><a href="#">edit</a></li>
 <li><a href="#">delete</a></li>
 <li><a href="#">logout</a></li>
</ul>

<div id="content">

<div id="ingredients">
<h3>Ingredients</h3>
<ul>
<?php foreach ($recipe->ingredients as $ingredient): ?>
 <li><?=$ingredient?></li>
<?php endforeach; ?>
</ul>
</div>

<div id="instructions">
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

</body>
</html>
