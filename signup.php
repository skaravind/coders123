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
    margin:0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type=submit]:hover {
    background-color: #45a049;
}
div {
    margin-bottom: 100px;
    border-radius: 5px;
    background-color: #f2f2f2;
    padding:20px;    
	width:400px;
}
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

<div style="margin:auto">
<h1>SIGN UP</h1>
<hr>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
Name : <input type="text" name="name" size="40">
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
</div>
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
$sql1="insert into crecidentials values('$email',MD5('$password'))";
$result = mysql_query($sql1, $con);
?>
</body>
</html>