<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>
<?php

$emailErr = $passwordErr = "";
$name = $email = $health = $contact = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }
  if(empty($_POST["passsword"])){
    $passwordErr="Enter Password";
  }
	 else{
     $password = $_POST["password"];
	 }
	 
  }
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
Health Center E-mail:
<input type="text" name="email">
<span class="error">* <?php echo $emailErr;?></span>
<br><br>
Password: <input type="password" name="password">
<span class="error">* <?php echo $passwordErr;?></span>
<br><br>
<input type="submit" name="submit" value="Submit">
</form>
<?php
$dbhost = 'localhost:3306';
$dbuser = 'root';
$dbpass = 'root';
session_start();   
$con = mysql_connect($dbhost,$dbuser,$dbpass);

mysql_select_db('healthkit');
$query = mysql_query("SELECT *  FROM health where Email = '$email' AND Password = MD5('$password')");
	$row = mysql_fetch_array($query) or die(mysql_error());
	if(!empty($row['Email']) AND !empty($row['Password']))
	{
		$_SESSION['Email'] = $row['Password'];
		echo "SUCCESSFULLY LOGIN TO USER PROFILE PAGE...";

	}
	else
	{
		echo "SORRY... YOU ENTERD WRONG ID AND PASSWORD... PLEASE RETRY...";
	}
?>
</body>
</html>