<?php
include 'userAction.php';
$current_user = $_SESSION['login_id'];
$Users = new Users;

$profile = $Users->getOneUser($current_user);
$posts = $Users->getCurrentUserPost($current_user);


?>
<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
        * {
            box-sizing: border-box;
        }

        

        .col-md-4 {
            /* height: 100vh; */
            border-right: solid;
            border-width: medium;
            /* background-color: gray; */



        }

        .col-md-8 {
            /* height: 100vh; */
            /* background-image: url('background_images/city.jpg'); */
            background-size: cover;

        }

        #post {
            height: 150px;
        }

        #user_posts {
            height: 75px;


        }
        .postHolder{
            margin-top: 75px;
        }
    </style>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">

</head>

<body>
    <div class="container-fluid">
        
                <?php 
                    include 'navigation.php';
                
                ?>
     </div>
     <div class="container mt-5">
           
        <div class="row">
            <div class="col-md-4">
                <!-- simple details -->
               
                    <?php

                    if (!empty($profile['user_img'])) {
                        $picture = $profile['user_img'];
                        echo "<img src = 'profile_pictures/$picture' style = 'height:150px; width: 150px' class = 'rounded-circle mx-auto d-block'>";
                    } else {
                        //    echo "<div class = 'alert alert-warning text-center'>Upload Photo</div>";
                        echo "<form method='post' action='userAction.php' enctype='multipart/form-data'>";
                        echo '<input type="file" name = "picture" class="form-control">';
                        echo '<input type = "hidden" name = "user_id" value="'.$current_user.'">';
                        echo '<button type = "submit" name = "upload" class = "btn btn-outline-secondary d-block mx-auto mt-3">Upload</button>';

                        echo "</form>";
                    }



                    ?>

               
                <hr>
                <p class="lead text-center">
                    <!-- Search form -->
                    
                </p>


            </div>
            <div class="col-md-8">
          <div class="searchBarHolder pb-5">
          <?php 
                    include 'searchbar.php';
                    
                    
         ?>
          </div>
                <form action="userAction.php" method="post">
                    <!-- detailed information -->
                    <div class="form-group">
                        <input type="text" id="post" name="content" placeholder="Write Something for us" class=" text-center form-control mt-5">

                        <button class="float-right w-25 mt-3 btn btn-secondary" name="addPost">Post</button>
                        <input type="hidden" name="user_id" value="<?php echo $current_user ?>">
                    </div>
                </form>

                <div class="postHolder">
                 
                    <?php
                        if($posts == true){
                            foreach ($posts as $key => $post) {
                                echo "<div class = 'jumbotron mt-5'>";
                                echo "<input type = 'text' class = 'form-control text-center mb-5' id='user_posts' value = '".$post['description']."' disabled>";
        
                                echo  '<a href = "deletePost.php?post_id='.$post['post_id'].'" class = "btn btn-outline-danger float-right" role = "button"><i class=" far fa-trash-alt">Delete Post</i></a>';
                                echo '<button type="submit" name="like" class="btn w-25 btn-outline-primary float-left">Like</button>';
                                echo "</div>";
                        }
                    }else{
                            echo "<div class = 'alert alert-success text-center'>WRITE YOUR FIRST POST NOW</div>";
                        }
                    



                    ?>
                </div>
            </div>

        </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 p-3">
                   <?php 
                    include 'footer.php';
                   
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