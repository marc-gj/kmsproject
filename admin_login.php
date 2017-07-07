<?php
include 'core/init.php';
?>
<h2>Login</h2>
<div id = "inner" class = "w3-container">
	<form action = "login.php" method = "post">
		 <p>
		  <input type="text" name="username" id = "username"  class="w3-input"  value="" required/>
		  <label for = "">Username</label></p>
		  
		  <p>
		  <input type="password" name="password" id = "password" class="w3-input"  value="" required/>
		  <label for = "">Password</label></p>
		  
		  <input type="submit" name="submit" class = "w3-btn w3-light-grey w3-hover-green" value="Log In"/>  
	</form>
</div>