<div id="signup">

<h3>Sign Up Today!</h3>

<p>Don't wait! Your dinner will never be better! Fill in the form below with your information and
 press the button to begin:</p>

<?=form_open('signup1')?>
<table>
 <tr>
  <td><label for="username">Choose a Username</label></td>
  <td><input type="text" name="username"/></td>
 </tr>
 <tr>
  <td><label for="email">Email Address</label></td>
  <td><input type="text" name="email"/></td>
 </tr>
 <tr>
  <td colspan="2" style="text-align:center">
   <?=validation_errors()?>
   <input type="image" src="<?=site_url()?>res/signup.png" id="signupButton"/>
  </td>
 </tr>
</table>
</form>

</div>

