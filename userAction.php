<?php 
session_start();
include 'classes/Users.php';
$Users = new Users;

if(isset($_POST['register'])){
    
    $firstName = $_POST['fname'];
    $lastName = $_POST['lname'];
    $location = $_POST['location'];
    $nationality = $_POST['nationality'];
    $username = $_POST['username'];
    $password =$_POST['password'];

    $Users->addUser($username,$password,$firstName,$lastName,$location,$nationality);
    // echo $firstName,$lastName,$location,$nationality,$username,$password;

    header('location:login.php');



}elseif(isset($_POST['login'])){
    $username = $_POST['username'];
    $password =$_POST['password'];

    $row = $Users->login($username,$password);

    if($row == true){
        $_SESSION['login_id'] = $row['user_id'];
        header('location:profile.php');
    }else{
        echo "User Doesnt Exist";
    }



    

}elseif(isset($_POST['addPost'])){
    $content = $_POST['content'];
    $userID = $_POST['user_id'];

    $Users->addPost($userID,$content,'public');

}elseif(isset($_POST['upload'])){
    $userID = $_POST['user_id'];
    $name = $_POST['picture'];

    $Users->uploadUserProfilePhoto($userID,$name);    
   

}
elseif(isset($_POST['search'])){
    $input = $_POST['searchedName'];
    // echo $input;
    
    $row = $Users->searchUser($input);
    

    if($row == false){
        header('location:failedSearch.php');

    }else{
        header('location:searchResult.php?result='.$input);

    }


}
elseif(isset($_POST['follow'])){
    $followed_user = $_POST['user_id'];
    $currentUserID = $_SESSION['login_id'];
    $status = 'followed';

    $Users->followUser($currentUserID,$currentUserID,$status);



}




?>