<p class=""> Welcome to Socialize! </p>
<p class=""> Join us here! </p>
<form action="<?php echo URL ?>user/create" method="post" name="Register">
	<p class="">Username</p>
	<input class="" type="text" name="username" placeholder="Username" onblur="un_val()">
  <p id="error1"></p>
	<p class="">Email address</p>
	<input class="" type="text" name="email" placeholder="Email address">
	<p id="error2"></p>
	<p class="">Create password</p>
	<input class="" type="password" name="password" placeholder="Create password">
	<div class="g-recaptcha" data-sitekey="<?php echo SITEKEY ?>"></div>
	<input class="" onclick="val()" type="submit" value="Register">
</form>
