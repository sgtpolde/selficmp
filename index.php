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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
        $query = $link->query("SELECT * FROM images ORDER BY likes DESC");

      //za like
      $query3 = " SELECT images.id, images.file_name, COUNT(article_likes.id) as likes, GROUP_CONCAT(users.username separator '|') as liked FROM images  
      LEFT JOIN article_likes  
      ON article_likes.article = images.id  
      LEFT JOIN users  
      ON article_likes.user = users.id  
      GROUP BY images.id  
      ";  
      $result = mysqli_query($link, $query3); 
      if (!$result) {
      printf("Error: %s\n", mysqli_error($link));
      exit();
      }

        ?>

        <p class="lead">Na tej strani so najboljši selfiji</p>
        <ul class="list-unstyled">

         
        <?php
   
if($query->num_rows > 0){
    while($row = $query->fetch_assoc()){
        $usrid = $row['user_id'];
        $msg_id=$row['id']; //Message id
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
    <li class="user">
    
                <?php
      $row3 = mysqli_fetch_array($result);
       // echo $row3["id"];
        echo '<a href="index.php?type=article&id='.$row3["id"].'">Like</a>';  
        echo '<p>'.$row3["likes"].' People like this</p>';  
        $id = $row3['id']; 
        $tmp = $row3["likes"];
        $query5 = "UPDATE images SET likes = $tmp WHERE id = {$id}";
        mysqli_query($link, $query5);
      if(is_countable($row3["liked"]))  
      {  
           $liked = explode("|", $row3["liked"]);  
           echo '<ul>';  
           foreach($liked as $like)  
           {  
            
                echo '<li>'.$like.'</li>';  
           }  
           echo '</ul>';  
      }  
 }  
 if(isset($_GET["type"], $_GET["id"]))  
 {  
      $type = $_GET["type"];  
      $id = (int)$_GET["id"];  
      if($type == "article")  
      {  
           $query4 = "INSERT INTO article_likes (user, article) SELECT {$_SESSION['id']}, {$id} FROM images  
           WHERE EXISTS(SELECT id FROM images WHERE id = {$id}) AND  NOT EXISTS(SELECT id FROM article_likes WHERE user = {$_SESSION['id']} AND article = {$id})  
            LIMIT 1  
           ";  
           echo $tmp;
           mysqli_query($link, $query4); 
           if (!$query4) {
            printf("Error: %s\n", mysqli_error($link));
            exit();
            
        }
      
      }  
     
          ?>
            <meta http-equiv="refresh" content="0;url=index.php"> 
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
          <i class="material-icons">add</i>
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
