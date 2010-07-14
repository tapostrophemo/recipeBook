<div id="signup">

<h3>Sign Up Today!</h3>

<p>Don't wait! Your dinner will never be better! Fill in the form below with your information and
 press the button to begin:</p>

<?=validation_errors()?>

<?=form_open('signup')?>
<table>
 <tr>
  <td><label for="username">Choose&nbsp;Username</label></td>
  <td><input type="text" name="username" value="<?=set_value('username')?>"/></td>
 </tr>
 <tr>
  <td><label for="email">Email Address</label></td>
  <td><input type="text" name="email" value="<?=set_value('email')?>"/></td>
 </tr>
 <tr>
  <td><label for="password">Password</label></td>
  <td><input type="password" name="password"/></td>
 </tr>
 <tr>
  <td><label for="plan">Choose Plan</label></td>
  <td class="radioGroup">
   <p><input type="radio" name="plan" value="free"<?=set_radio('plan', 'free')?>/> <label for="free">Small (free)</label> 10 recipes, you and 1 friend</p>
   <p><input type="radio" name="plan" value="medium"<?=set_radio('plan', 'medium')?>/> <label for="medium">Medium ($12.99/year)</label> 100 recipes, 10 friends</p>
   <p><input type="radio" name="plan" value="large"<?=set_radio('plan', 'large')?>/> <label for="large">Large ($24.99/year)</label> Unlimited recipes, unlimited friends</p>
  </td>
 </tr>
 <tr>
  <td colspan="2" style="text-align:center">
   <input type="image" src="<?=site_url()?>res/signup.png" id="signupButton"/>
  </td>
 </tr>
</table>
</form>

</div>

