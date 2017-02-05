<html>
<head>
<style>
.error {color: #FF0000;}
body {
    
    background-color: teal; 
}
 input[type=text], select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}
 input[type=password], select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}
input[type=submit] {
    width: 100%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type=submit]:hover {
    background-color: #45a049;
}

div {
    margin-bottom:100px ;
    border-radius: 5px;
    background-color: #f2f2f2;
    padding:20px;    
    width:400px;
}
</style>
</head>
<body>
<?php

$emailErr = $passwordErr = "";
 $email =$password = "";

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
<div style="margin:auto">
<h1 style="text-align:center"> LOGIN </h1>
<hr>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
Health Center E-mail:<span class="error">* <?php echo $emailErr;?></span>
<input type="text" name="email">
<br><br>
Password: <span class="error">* <?php echo $passwordErr;?></span>
<input type="password" name="password">
<br><br>
<input type="submit" name="submit" value="Submit">
</form>
</div>
<?php
$dbhost = 'localhost:3306';
$dbuser = 'root';
$dbpass = 'root';
session_start();   
$con = mysql_connect($dbhost,$dbuser,$dbpass);

mysql_select_db('healthkit');
$query = "SELECT *  FROM health where Email = '$email' AND Password = MD5('$password')";
$sql = mysql_query($query,$con);
	$row = mysql_fetch_array($sql);
	if(!empty($row['Email']) AND !empty($row['Password']))
	{
		$_SESSION['Email'] = $row['Password'];
		header('Location:feedback.php');

	}
	else
	{
		echo "YOU ENTERED WRONG ID AND PASSWORD";
	}
?>
</body>
</html>