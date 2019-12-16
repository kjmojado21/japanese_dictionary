<?php 
include 'userAction.php';
// $page = $_SERVER['PHP_SELF'];
// $sec = "10";

$current_user = $_SESSION['login_id'];
$Users = new Users;

$profile = $Users->getOneUser($current_user);
$postID = $_GET['post_id'];

$post = $Users->getCertainPost($postID);

$getComments = $Users->getComments($postID);

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
                            echo "<div class = 'alert alert-danger w-25'>POST ID: ".$post['post_id']."</div>";
                                   
                                    echo "<div class = 'jumbotron'>";
                                        echo "<p class = 'lead'>Post Content: </p>";
                                        echo "<div class = 'alert alert-success'>".$post['description']."</div>";
                                    echo "</div>";  

                                    if($getComments == false){
                                      echo "<div class = 'alert alert-warning'>No comments Available.. Be the first one! :)</div>";

                                    }else{
                                     
                                      // print_r($getComments);
                                      foreach($getComments as $key => $comment){
                                       echo "<div class = 'alert alert-primary'>".$comment['comment']."</div>";

                                      }
                                    }
                                    
                          ?>
                          <form method="post" action="userAction.php">
                              <div class="form-group">
                                    <input type="text" name="comment" class="form-control">
                                    <input type="hidden" name="post_id" value="<?php echo $postID ?>">
                                    <input type="hidden" name="commentor_name" value="<?php echo $profile['fname']." ".$profile['lname']?>">
                                    <button type="submit" name="add_comment" class="btn btn-primary mt-3 float-right">Post Comment</button>
                              </div>

                          </form>
                          

                            
                            
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