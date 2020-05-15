<?php 
include_once 'header.php';
include_once 'config.php';

?>
<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;


}
?>

<?php
$usrid = $_SESSION['id'];
$query = $link->query("SELECT * FROM images WHERE user_id = '$usrid' ORDER BY uploaded_on DESC");

if($query->num_rows > 0){
    while($row = $query->fetch_assoc()){
        $imageURL = 'uploads/'.$row["file_name"];
?>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 <link rel="stylesheet" href="vendor/bootstrap/css/main.css">
 <div class="container">
    
 <div class="row">
 <div class="col-lg-12 text-center">
    <ul class="list-unstyled">
        <div class="border">
        <li class="img">
    <img src="<?php echo $imageURL; ?>" alt="" />
    </li>
    </div>
    </ul>
    </div>
    </div>
<?php }
}else{ ?>
    <p>No image(s) found...</p>
<?php } ?>





