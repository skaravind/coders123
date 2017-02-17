<html>
<head>
<style>
.error {color: #FF0000;}
a{text-decoration:none; }
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
$dbhost = 'localhost:3306';
$dbuser = 'root';
$dbpass = 'root';
session_start();
$con = mysql_connect($dbhost,$dbuser,$dbpass);
mysql_select_db('healthkit');

$nameErr = $emailErr = $healthErr = $contactErr = $passwordErr = "";
$name = $email = $health = $contact = $password = "";
$error=0;

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
	else{
	    $que = mysql_query("select email from health where email= '$email'");
	    $cou = mysql_num_rows($que);
		if($cou!=0)
		{
			$error = 1;
			$errmsg = "Email is already registered";
		}
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
    $healthErr = "Address is required";
  } else {
    $health = test_input($_POST["health"]);
  }
  if(empty($_POST["password"])){
    $passwordErr = "Password is required";
	}
	else
	{
		$password = test_input($_POST["password"]);
	}
if(empty($nameErr)&&empty($emailErr)&&empty($contactErr)&&empty($healthErr)&&empty($passwordErr))
{
  $sql="insert into health(name,email,address,contact,password) values('$name','$email','$health','$contact',md5('$password'))";
  $result = mysql_query($sql,$con);
  if($result){
    $_SESSION["user"] = $name;
    header('Location:registered.php');
  }
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
<h1 style="text-align:center;">SIGN UP</h1>
<hr>
<?php
if($error)
{
	?>

	<span class = "error"><?php echo $errmsg;?></span>
	
<?php
}
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
Name of Health Center: 
<span class="error">* <?php echo $nameErr; ?></span>
<input type="text" name="name" size="40">

<br>
E-mail:
<span class="error">* <?php echo $emailErr;?></span>
<input type="text" name="email">

<br>
Address:
<span class="error">*<?php echo $healthErr;?></span>
<input type="text" name="health">

<br>
Contact:
<span class="error">*<?php echo $contactErr;?></span>
<input type="text" name="contact">

<br>
Password: 
<span class="error">* <?php echo $passwordErr;?></span>
<input type="password" name="password">
<br>
<input type="submit" name="submit" value="Submit">
<p>Alredy registered?...<a href = "login.php">Sign in</a></p>
</form>
</div>
</body>
</html>