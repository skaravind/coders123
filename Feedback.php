<html>
<head>
<style>
p{
	
	line-height: 235%;
}
body {
	background-color: teal;
}
div {
	border-radius: 25px;
	width:600px; height:600px; 
	background-color:white; 
	margin:auto;
	padding: 15px;
}
.button {
    border-radius: 10px;
    color: white;
    padding: 16px 32px;
    text-align: center;
    background-color: #008CBA;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin-left: 230px;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
    cursor: pointer;
}
.button:hover {
    background-color: white;
    color: black;
}
input[type="radio"]{
  margin: 0px 0px 10px 50px;
}
</style>
</head>
<body>
<?php
$staff = $facilities = $hygine = $food = $doctor = $overall  = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $staff = $_POST["staff"];
	$facilities = $_POST["facilities"];
	$hygine = $_POST["hygine"];
	$food = $_POST["food"];
	$doctor = $_POST["doctor"];
	$overall = $_POST["overall"];	
}
?>
<h1 style="text-align : center;color:white;">FEEDBACK FORM</h1>
<hr>
<div>
<form method = "post" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
<b>1. Staff Behavior</b>
<br>
<p><input type="radio" name="staff" value = "1" checked>Very Poor
<input type="radio" name="staff" value = "2">Poor
<input type="radio" name="staff" value = "3">Average
<input type="radio" name="staff" value = "4">Good
<input type="radio" name="staff" value = "5">Very Good</p>
<b>2. Avaibility of Facilities</b>
<p><input type="radio" name="facilities" value = "1" checked>Very Poor
<input type="radio" name="facilities" value = "2">Poor
<input type="radio" name="facilities" value = "3">Average
<input type="radio" name="facilities" value = "4">Good
<input type="radio" name="facilities" value = "5">Very Good</p>
<b>3. Hygine</b>
<p><input type="radio" name="hygine" value = "1" checked>Very Poor
<input type="radio" name="hygine" value = "2">Poor
<input type="radio" name="hygine" value = "3">Average
<input type="radio" name="hygine" value = "4">Good
<input type="radio" name="hygine" value = "5">Very Good</p>
<b>4. Food Quality</b>
<p><input type="radio" name="food" value = "1" checked>Very Poor
<input type="radio" name="food" value = "2">Poor
<input type="radio" name="food" value = "3">Average
<input type="radio" name="food" value = "4">Good
<input type="radio" name="food" value = "5">Very Good</p>
<b>5. Avaibility of Doctors</b>
<p><input type="radio" name="doctor" value = "1" checked>Very Poor
<input type="radio" name="doctor" value = "2">Poor
<input type="radio" name="doctor" value = "3">Average
<input type="radio" name="doctor" value = "4">Good
<input type="radio" name="doctor" value = "5">Very Good</p>
<b>6. Overall Rating</b>
<p><input type="radio" name="overall" value = "1" checked>Very Poor
<input type="radio" name="overall" value = "2">Poor
<input type="radio" name="overall" value = "3">Average
<input type="radio" name="overall" value = "4">Good
<input type="radio" name="overall" value = "5">Very Good</p>
<br><br>
<button class="button" type="submit">
SUBMIT
</button>
<?php
$dbhost = 'localhost:3306';
$dbuser = 'root';
$dbpass = 'root';

$con = mysql_connect($dbhost,$dbuser,$dbpass);

mysql_select_db('healthkit');
$sql = "insert into feedback(a,b,c,d,e,f) values('$staff','$facilities','$hygine','$food','$doctor','$overall')";
mysql_query($sql,$con);
?>
</form>
</div>
</body>
</html>