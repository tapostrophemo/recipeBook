<h3>Login</h3>

<?=validation_errors()?>

<?=form_open('login', array('name' => 'loginForm'))?>
<table>
 <tr>
  <td><label for="username">Username</label></td>
  <td><input type="text" name="username"/></td>
 </tr>
 <tr>
  <td><label for="password">Password</label></td>
  <td><input type="password" name="password"/></td>
 </tr>
 <tr>
  <td colspan="2"><input type="submit" value="Login"/></td>
 </tr>
</table>
</form>

<script type="text/javascript">
document.forms["loginForm"].elements["username"].focus();
</script>

