<p>Welcome to the staff entrance. You probably don't have a key...why don't you
 <?=anchor('/', 'go around to the front door?')?></p>

<?=validation_errors()?>

<?=form_open('/admin/login')?>
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

