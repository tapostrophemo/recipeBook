<div id="signup">

<h3>Almost Finished</h3>

<p>Please enter a password and choose a plan.</p>

<?=form_open('signup2')?>
<table>
 <tr>
  <td><label for="username">Your&nbsp;Username</label></td>
  <td><?=$this->session->userdata('signup_username')?></td>
 </tr>
 <tr>
  <td><label for="email">Email&nbsp;Address</label></td>
  <td><?=$this->session->userdata('signup_email')?></td>
 </tr>
 <tr>
  <td><label for="password">Password</label></td>
  <td><input type="password" name="password"/></td>
 </tr>
 <tr>
  <td><label for="plan">Plan Size</label></td>
  <td>
   <label for="free"><input type="radio" name="plan" value="free"/> Small (free)</label> 10 recipes, you and 1 editor<br/>
   <label for="medium"><input type="radio" name="plan" value="medium"/> Medium ($12.99/year)</label> 100 recipes, 10 editors<br/>
   <label for="large"><input type="radio" name="plan" value="large"/> Large ($24.99/year)</label> Unlimited recipes, unlimited editors
  </td>
 </tr>
 <tr>
  <td colspan="2" style="text-align:center">
   <?=validation_errors()?>
   <input type="image" src="<?=site_url()?>res/signup2.png" id="signupButton"/>
  </td>
 </tr>
</table>
</form>

</div>

