
<?php
/*
session_start();

$db = mysqli_connect('localhost', 'root', 'geslo123', 'test');
mysqli_query($db, "SET NAMES 'utf8'");
$salt = 'abc123def235';
 */
?>

<?php 




?>

<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'geslo123');
define('DB_NAME', 'selficmp');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>