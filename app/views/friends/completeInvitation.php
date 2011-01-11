<h3>Complete Your Account</h3>
<p>Thanks for visiting, <?=$user->name?>. Please choose a username and password to continue.</p>

<?=validation_errors()?>

<?=form_open('acceptinvitation/'.$user->perishable_token)?>
<table>
 <tr>
  <td><label for="username">Choose Username</label></td>
  <td><input type="text" name="username" value="<?=set_value('username')?>"/></td>
 </tr>
 <tr>
  <td><label for="password">Create Password</label></td>
  <td><input type="password" name="password"/></td>
 </tr>
 <tr>
  <td colspan="2"><input type="submit" value="Complete Registration" id="completeInvitation"/></td>
 </tr>
</table>
</form>

