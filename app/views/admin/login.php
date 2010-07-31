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

<script type="text/javascript">
window.onload = function () {
  if (document.forms && document.forms[0] && document.forms[0].elements[0]) {
    if (document.forms[0].elements[0].type == "text" || document.forms[0].elements[0].type == "password") {
      document.forms[0].elements[0].focus();
    }
  }
};
</script>

