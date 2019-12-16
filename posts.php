<?php 
include 'userAction.php';
// $page = $_SERVER['PHP_SELF'];
// $sec = "10";

$current_user = $_SESSION['login_id'];
$Users = new Users;

$profile = $Users->getOneUser($current_user);
$posts = $Users->followed_posts($current_user);


?>
<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <!-- <meta http-equiv="refresh" content="<?php //echo $sec?>;URL='<?php // echo $page?>'"> -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
      <div class="container-fluid">
          <div class="row">
              <div class="col-md-12">
                  <?php 
                    include 'navigation.php';
                  
                  ?>
              </div>
      </div>
              </div>
              <div class="container mt-5">
                    <div class="row mt-5">
                        <div class="col-md-3 mt-5">
                            <div class="jumbotron">
                                <?php 
                                  

                                   if (!empty($profile['user_img'])) {
                                       $picture = $profile['user_img'];
                                       echo "<img src = 'profile_pictures/$picture' style = 'height:150px; width: 150px' class = 'rounded-circle mx-auto d-block'>";
                                   } else {
                                       //    echo "<div class = 'alert alert-warning text-center'>Upload Photo</div>";
                                       echo "<form method='post' action='userAction.php' enctype='multipart/form-data'>";
                                       echo '<input type="file" name = "picture" class="form-control">';
                                       echo '<input type = "hidden" name = "user_id" value="'.$current_user.'">';
                                       echo '<button type="submit" name="upload" class="btn btn-secondary d-block mx-auto mt-3">Upload</button>';
               
                                       echo "</form>";
                                   }
               
               
               
                                   
                                ?>

                            </div>
                        </div>
                        <div class="col-md-9 mt-5">
                            <?php 
                                if($posts == false){
                                    echo "<div class = 'alert alert-warning'>No Post is Available :(</div>";
                                }else{
                                    foreach($posts as $key =>$userPost){
                                        $postID = $userPost['post_id'];
                                        echo "<div class = jumbotron>";
                                        echo "<div class ='lead'>".$userPost['fname']." ".$userPost['lname'].": </div>";
                                            echo "<p class = 'lead text-center'>".$userPost['description']."</p>";
                                            echo "<br>";
                                            echo "<a href = 'postThread.php?post_id=$postID' class ='btn btn-outline-primary btn-block' role ='button'>See Thread</a>";
                                        echo "</div>";
                                    }
                                }
                                
                                
                            
                            ?>
                        </div>
                    </div>
              </div>
         
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>