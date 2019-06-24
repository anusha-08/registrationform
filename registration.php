<?php
/*
Author: Javed Ur Rehman
Website: http://www.allphptricks.com/
*/
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Registration</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<?php
	require('db.php');
    // If form submitted, insert values into the database.
if (isset($_POST['username'])) {
  	$username = $_POST['username'];
  	$sql = "SELECT * FROM users WHERE username='$username'";
  	$results = mysqli_query($con, $sql);
  	if (mysqli_num_rows($results) > 0) {
  	  echo "taken";
  	  exit;	}
  	
  }

    if (isset($_REQUEST['username'])){
		$username = stripslashes($_REQUEST['username']); // removes backslashes
		$username = mysqli_real_escape_string($con,$username); //escapes special characters in a string
		$email = stripslashes($_REQUEST['email']);
		$email = mysqli_real_escape_string($con,$email);
		$phone = stripslashes($_REQUEST['phone']);
		$phone = mysqli_real_escape_string($con,$phone);
		$password = stripslashes($_REQUEST['password']);
		$password = mysqli_real_escape_string($con,$password);
		$confirmpassword = stripslashes($_REQUEST['confirmpassword']);
		$confirmpassword = mysqli_real_escape_string($con,$confirmpassword);
		$error="";
		$pno="";

		if ($password != $confirmpassword) {
			echo("Error... Passwords do not match");
			exit;
			}


		if( strlen($password)<8) {
		$error .= "Password too short! 
		";
		}

		if( strlen($password)>=20) {
		$error .= "Password too long! 
		";
		}

		if( strlen($phone)!=10) {
		$pno .= "Entered phone number should contain 10 digits! 
		";
		}

		if( !preg_match("#[0-9]+#", $password) ) {
		$error .= "Password must include at least one number! 
		";
		}

		if( !preg_match("#[a-z]+#", $password) ) {
		$error .= "Password must include at least one letter! 
		";
		}

		if( !preg_match("#[A-Z]+#", $password) ) {
		$error .= "Password must include at least one CAPS! 
		";
		}

		if( !preg_match("#\W+#", $password) ) {
		$error .= "Password must include at least one symbol! 
		";
		}

		if($error && $pno){
		echo ("Password validation failure(your choise is weak): $error");
		echo ("Phone number error: $pno");
		exit;}

		else if($error){
			echo ("Password validation failure(your choise is weak): $error");
			exit;
		}

		else if($pno){
			echo ("Phone number error: $pno");
			exit;
		} 


		$trn_date = date("Y-m-d H:i:s");
        $query = "INSERT into `users` (username, password, email, phone, trn_date) VALUES ('$username', '".md5($password)."', '$email', '$phone', '$trn_date')";
        $result = mysqli_query($con,$query);
        if($result){
            echo "<div class='form'><h3>You are registered successfully.</h3><br/>Click here to <a href='login.php'>Login</a></div>";
        }
    }else{
?>
<div class="form">
<h1>Registration</h1>
<form name="registration" action="" method="post">
<input type="text" name="username" placeholder="Username" required />
<input type="email" name="email" placeholder="Email" required />
<input type="text" name="phone" placeholder="Phone Number" required />
<input type="password" name="password" placeholder="Password" required />
<input type="password" name="confirmpassword" placeholder="Retype Password" required />
<input type="submit" name="submit" value="Register" />
</form>
<br /><br />
</div>
<?php } 


?>


</body>
</html>
