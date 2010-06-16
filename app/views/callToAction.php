<div id="ingredientsList">
 <h3>Keep Your Recipes Handy</h3>

 <p>No more digging through the top shelf looking for your recipe cards. Simply come here to our
  easy-to-use website to lookup your recipes. We even have a <a href="#">mobile version</a>.</p>

 <h3>Share Your Cookbook</h3>

 <p>Put your family recipes here, and share them only with your family. Or not...share them with
  the world if you want to! Having your own personalized cookbook on the web makes it easy to pass
  your favorite recipes along to friends, family, and the world.</p>

</div>

<div id="instructionsList">
 <h3>Sign Up Today!</h3>

 <p>Don't wait! Your dinner will never be better! Fill in the form below with your desired cookbook
  title and username and press the button to begin:</p>

 <form method="post">
 <table style="background-color:#eff; padding:10px 30px; -moz-border-radius:10px">
  <tr>
   <td><label for="bookname">Cookbook name</label></td>
   <td><input type="text" name="bookname"/></td>
  </tr>
  <tr>
   <td><label for="username">Username</label></td>
   <td><input type="text" name="username"/></td>
  </tr>
  <tr>
   <td colspan="2" style="text-align:center"><input type="image" src="<?=site_url()?>res/signup.png"/></td>
  </tr>
 </table>
 </form>

 <p><b>Not ready to sign up?</b> <?=anchor('random', 'Take a look')?> at recipes others have already
  entered. Or <?=anchor('features', 'find out more')?> about our features and prices.</p>
</div>

<div style="clear:both"></div>

