<h1 class=""> Welcome to Socialize! </h1>
<h2> Join us here! </h2>
<form action="<?php echo URL ?>user/create" method="post" name="Register">
	<p class="ui field title">Username</p>
	<input class="ui field rounded" type="text" name="username" placeholder="Username" onblur="un_val()">
	<p class="ui field error" id="error1"></p>
	<p class="ui field title">Email address</p>
	<input class="ui field rounded" type="email" name="email" placeholder="Email address" onblur="mail_val()">
	<p class="ui field error" id="error2"></p>
	<p class="ui field title">Password</p>
	<input class="ui field rounded" type="password" name="password" placeholder="Password" onblur="pass_val()">
	<p class="ui field error" id="error3"></p>
	<div class="g-recaptcha" data-sitekey="<?php echo SITEKEY ?>"></div>
	<input class="ui button" onclick="val()" type="submit" value="Register">
</form>
<script src='https://www.google.com/recaptcha/api.js'></script>
