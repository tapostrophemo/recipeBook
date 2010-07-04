<div id="signup">

<h3>Reset Password</h3>

<?=validation_errors()?>

<?=form_open('newpass')?>
<table>
 <tr>
  <td><label for="password">Password</label></td>
  <td><input type="password" name="password"/></td>
 </tr>
 <tr>
  <td><label for="passconf">Confirm Password</label></td>
  <td><input type="password" name="passconf"/></td>
 </tr>
 <tr>
  <td colspan="2"><input type="submit" value="Update Password"/></td>
 </tr>
</table>
</form>

</div>

