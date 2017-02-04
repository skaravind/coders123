<html>
<head>
<style>
p{
	word-spacing:30px;
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
echo $staff." ".$food;
?>
<h1 style="text-align : center;">FEEDBACK FORM</h1>
<hr>
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
<input type = "submit" value="submit">
</body>
</html>