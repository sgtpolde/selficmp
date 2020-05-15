
     <?php
      $query3 = " SELECT images.id, images.file_name, COUNT(article_likes.id) as likes, GROUP_CONCAT(users.username separator '|') as liked FROM images  
      LEFT JOIN article_likes  
      ON article_likes.article = images.id  
      LEFT JOIN users  
      ON article_likes.user = users.id  
      GROUP BY images.id  
 ";  
 $result = mysqli_query($link, $query3);  
 
 while($row3 = mysqli_fetch_array($result))  
 {  
      echo '<h3>'.$row3["file_name"].'</h3>';  
      echo '<a href="index.php?type=article&id='.$row3["id"].'">Like</a>';  
      echo '<p>'.$row3["likes"].' People like this</p>';  
      if(count($row3["liked"]))  
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
           $query = "  INSERT INTO article_likes (users, images)  
           SELECT {$_SESSION['user_id']}, {$id} FROM images   
                WHERE EXISTS(  
                     SELECT id FROM images WHERE id = {$id}) AND  
                     NOT EXISTS(  
                          SELECT id FROM article_likes WHERE user = {$_SESSION['user_id']} AND article = {$id})  
                          LIMIT 1  
           ";  
           mysqli_query($connect, $query);  
           header("location:index.php");  
      }  
 }  
 ?>  