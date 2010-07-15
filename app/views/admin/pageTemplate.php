<html>
<head>
<title>The Slice-up Cookbook: Admin</title>
<style type="text/css">
.err {
  background-color: black;
  color: white;
  font-weight: bold;
  margin: 1em 0;
  padding: 1.5em;
  text-align: center;
}
label {
  font-weight: bold;
}
</style>
</head>
<body>
<h1><?=isset($title) ? $title : 'Untitled'?></h1>
<h2>The Slice-up Cookbook: Admin</h2>

<?=$content?>

<?php if ($this->session->userdata('admin_logged_in')): ?>
<p><?=anchor('admin/logout', 'Logout')?></p>
<?php endif; ?>

</body>
</html>

