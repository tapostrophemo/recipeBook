<html>
<head>
<title>The Slice-up Cookbook: Admin</title>
<style type="text/css">
.err {
  background-color: black;
  color: white;
  font-weight: bold;
  font-size: 14px;
  margin: 1em 0;
  padding: 1.5em;
  text-align: center;
}
label {
  font-weight: bold;
}
html {
  font-size: 62.5%;
  font-family: sans-serif;
}
.report {
  width: 100%;
  border-collapse: collapse;
  border-top: 1px solid black;
  border-right: 1px solid black;
  font-size: 11px;
}
.report td, .report th {
  border-bottom: 1px solid black;
  border-left: 1px solid black;
  padding: 2px;
}
.report th {
  color: white;
  background-color: #444;
}
.report .alt td {
  background-color: #fafafa;
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

