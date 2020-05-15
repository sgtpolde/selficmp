<!DOCTYPE html>
<html lang="en">
<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;

}
?>
<head>
  <?php
  include_once 'header.php';
  include_once 'config.php';
  ?>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="vendor/bootstrap/css/main.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Selfi competition</title>
  </head>

  <!-- Page Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">

        <h1 class="mt-5">Pozdravljen: <?php echo $_SESSION["username"]?></h1>

        <?php
        $query = $link->query("SELECT * FROM images ORDER BY uploaded_on DESC");
        ?>

        <p class="lead">Complete with pre-defined file paths and responsive navigation!</p>
        <ul class="list-unstyled">
          
        <?php
 
   
if($query->num_rows > 0){
    while($row = $query->fetch_assoc()){
        $usrid = $row['user_id'];
        $query2 = $link->query("SELECT username FROM users WHERE id = $usrid");
        $row2 = $query2->fetch_assoc();
        $usr = $row2['username'];
        $imageURL = 'uploads/'.$row["file_name"]; 
?>
  <div class="border">
    <li class="user">
       <?php echo $usr ;?>
    </li>
    <li class="img">
    <img src="<?php echo $imageURL; ?>" alt="" />
    </li>
    </div>
    <br>
<?php }
}else{ ?>
    <p>No image(s) found...</p>
<?php } ?>



          <li>Bootstrap 4.3.1</li>
          <li>jQuery 3.4.1</li>
        </ul>
      </div>
    </div>
  </div>

  <div class="container">
      <div class="fixed-action-btn">
        <a href="./upload2.php" class="btn-floating red" >
          <i class="material-icons">settings</i>
      </a>
    </div>
          
  </div>
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.slim.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
            
</body>

</html>
