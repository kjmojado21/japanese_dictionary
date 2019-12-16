<?php
include 'userAction.php';
$input = $_GET['result'];
$results = $Users->searchUser($input);

$current_user = $_SESSION['login_id'];
$Users = new Users;

$profile = $Users->getOneUser($current_user);




?>

<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<style>
img{
    width: 150px;
    height: 150px;
}
</style>

<body>
    <div class="container-fluid">
        <div class="col-md-12">
            <?php
            include 'navigation.php';
            ?>
        </div>

    </div>
    <div class="container mt-5">
        <div class="row">
           
                <div class="col-md-12">

                <form method = 'post' action = 'userAction.php'>
                    <?php
                    foreach ($results as $key => $result) { 
                        echo "<div class = 'card mt-5 w-25 float-left mr-3'>";
                            echo "<div class ='card-header'>";
                                    if(empty($result['user_img'])){
                                        echo "<img src = 'background_images/no_photo.jpg' class = 'card-img-top'>";
                                      

                                    }else{
                                        $img = $result['user_img'];
                                        echo "<img src = 'profile_pictures/$img' class = 'card-img-top'>";
                                    }


                            echo "</div>";
                            echo "<div class ='card-body'>";
                                echo "<input type = 'hidden' name='user_id' value = '".$result['user_id']."'>";
                                echo "<a href = '' role = 'button' class = 'btn btn-secondary'>Check Profile</a>";
                               
                                echo "<button type = 'submit' name ='follow' class='btn btn-primary float-right'>follow</button>";

                                

                            echo "</div>";
                        echo "</div>";
                    }
                    



                    ?>
                    </form>
                </div>
           
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