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

  if (empty($_POST["comment"])) {
    $comment = "";
  } else {
    $comment = test_input($_POST["comment"]);
  }
  if(empty($_POST["passsword"])){
    $passwordErr="Enter Password";
  } else {
     if(strlen($password)<8)
	 {
	 $passwordErr = "Minimum 8 characters required";
	 }
	 else{
     $password = $_POST["password"];
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
</body>
</html>