<div id="signup">

<p>Please fill in both fields when updating/resetting your password.</p>

<?=validation_errors()?>

<?=form_open('newpass')?>
<table>
 <tr>
  <td><label for="password">New Password</label></td>
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

