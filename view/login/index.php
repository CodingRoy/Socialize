<h2>Login</h2>
<form name="login_form" action="<?php echo URL ?>login/run" method="post">
	<p class="ui field title">Username</p>
	<input class="ui field rounded" type="text" name="username" id="username" placeholder="Username" onblur="un_val()">
	<p class="ui field error" id="error1"></p>
	<p class="ui field title">Password</p>
	<input class="ui field rounded" type="password" name="password" id="password" placeholder="Password" onblur="pass_val()">
	<p class="ui field error" id="error3"></p>
	<input type="submit" class="ui primary button" value="Login" onclick="val()">
</form>
