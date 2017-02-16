<html>
<?php

session_start();
session_destroy();

echo 'Succesfully logged out!!';
?>
<br>
<a href="login.php">Click here </a>to go back
</html>