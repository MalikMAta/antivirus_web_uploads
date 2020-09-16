<?php
session_start();

$db = mysqli_connect("localhost", "root", "", "authenticated");

if(isset($_POST['register btn'])){
	
	session_start();
	
	$username=mysql_real_escape_string($_POST['username']);
	$email=mysql_real_escape_string($_POST['email']);
	$password=mysql_real_escape_string($_POST['password']);
	$password2=mysql_real_escape_string($_POST['password2']);

	if($password == $password2){
		
		$passqord=md5($password);
		$sql = "INSERT INTO users(username, email, password) VALUES('$username', '$email','$password')";
		mysqli_query($db, $sql);
		$_SESSION['messahe'] = "You are now logged in";
		$_SESSION['username'] = "the two passwors do not match";
		header("location: home.php");

	}
	else{
		$_SESSION['message'] = "the two passwors do not match";
		
	}
}

?>

<!DOCTYPE html>

<html>

<title>Register</title>

</html>


<body>
<div class="header">
<h1>Register </h1>
</div>


<form method ="post" action ="register.php">
<table>

	<tr>
	<td>Username:</td>
	<td>< input type="text" name ="username" class="textInput"> </td>
	</tr>
	
	<tr>
	<td>Email:</td>
	<td> < input type="email" name ="emal" class="textInput"> </td>
	</tr>
	
		<tr>
	<td>Password:</td>
	<td> < input type="password" name ="password" class="textInput"> </td>
	</tr>
	
		<tr>
	<td>Password again:</td>
	<td> < input type="password" name ="password2" class="textInput"> </td>
	</tr>
	
		<tr>
	<td></td>
	<td> < input type="submit" name ="register btn" value=""></td>
	</tr>
	
	
	
	
	
	
	</tr>


</table>



</form>

</body>


</html>