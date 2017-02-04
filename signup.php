<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>
<?php




$nameErr = $emailErr = $healthErr = $contactErr = $passwordErr = "";
$name = $email = $health = $contact = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }
    
  if (empty($_POST["contact"])) {
    $contactErr = "Contact is required";
  } else {
    $contact = test_input($_POST["contact"]);
    // check if URL address syntax is valid
    if (!is_numeric($contact)) {
      $contactErr = "Invalid contact";
    }    
  }

  if (empty($_POST["health"])) {
    $health = "";
  } else {
    $health = test_input($_POST["health"]);
  }
  if(empty($_POST["passsword"])){
    $passwordErr="Enter Password";
  } else {
     $password = test_input($_POST["password"]);
	 
  }
  echo $name." ".$email." ".$health." ".$contact." ".$password;

}
	
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
Name : <input type="text" name="name">
<span class="error">* <?php echo $nameErr;?></span>
<br><br>
E-mail:
<input type="text" name="email">
<span class="error">* <?php echo $emailErr;?></span>
<br><br>
Health center:
<input type="text" name="health">
<span class="error">*<?php echo $healthErr;?></span>
<br><br>
contact: <input type="text" name="contact">
<span class="error">*<?php echo $contactErr;?></span>
<br><br>
Password: <input type="password" name="password">
<span class="error">* <?php echo $nameErr;?></span>
<br><br>
<input type="submit" name="submit" value="Submit">
</form>
<?php
$dbhost = 'localhost:3306';
$dbuser = 'root';
$dbpass = 'root';

$con = mysql_connect($dbhost,$dbuser,$dbpass);

mysql_select_db('healthkit');
$sql="insert into health values('$name','$email','$health','$contact',MD5('$password'))";
$result = mysql_query($sql, $con);
if($result){
	echo "You are registered";
}
?>
</body>
</html>