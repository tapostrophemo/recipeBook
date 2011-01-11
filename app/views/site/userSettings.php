<h3>Your Account</h3>

<ul>
 <li><label>Name:</label> <?=$name?></li>
 <li><label>Username:</label> <?=$username?></li>
<?php if (isset($plan)): ?>
 <li><label>Account type:</label> <?=$plan?></li>
<?php endif; ?>
 <li><label>Email:</label> <?=$email?></li>
 <li><?=anchor('/newpass', 'reset password')?></li>
</ul>

