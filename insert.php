<?php
require('db.php');
include("auth.php");
$status = "";
if(isset($_POST['new']) && $_POST['new']==1){
    $trn_date = date("Y-m-d H:i:s");
    $username =$_REQUEST['username'];
    $email = $_REQUEST['email'];
    $phone = $_REQUEST['phone'];
    $ins_query="insert into users
    (`trn_date`,`username`,`email`,`phone`)values
    ('$trn_date','$username','$email','$phone')";
    mysqli_query($con,$ins_query)
    or die(mysql_error());
    $status = "New Record Inserted Successfully.
    </br></br><a href='view.php'>View Inserted Record</a>";
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Insert New Record</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<div class="form">
<p><a href="dashboard.php">Dashboard</a> 
| <a href="view.php">View Records</a> 
| <a href="logout.php">Logout</a></p>
<div>
<h1>Insert New Record</h1>
<form name="form" method="post" action=""> 
<input type="hidden" name="new" value="1" />
<p><input type="text" name="username" placeholder="Enter Name" required /></p>
<p><input type="text" name="email" placeholder="Enter email" required /></p>
<p><input type="text" name="phone" placeholder="Phone Number" required /></p>
<p><input name="submit" type="submit" value="Submit" /></p>
</form>
<p style="color:green;"><?php echo $status; ?></p>
</div>
</div>
</body>
</html>