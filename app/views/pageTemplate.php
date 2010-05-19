<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title><?php if (isset($title)) echo "$title - "; ?>The Slice-up Cookbook</title>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>res/cb.css"/>
</head>
<body>

<div id="wrapper">

<div id="header">
 <h1><?php if (isset($title)) echo $title; ?>&nbsp;</h1>
 <h2>The <em>Slice-up</em> Cookbook</h2>
</div>

<ul id="controls">
 <li><a href="#">add recipe</a></li>
 <li><a href="#">logout</a></li>
</ul>

<div id="content">
<?=$content?>
</div><!-- /#content -->

<div id="footer">
Copyright &copy; 2010, Dan Parks. All Rights Reserved.
</div>

</div><!-- /#wrapper -->

</body>
</html>