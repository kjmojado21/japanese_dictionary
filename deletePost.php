<?php 
include 'classes/Users.php';

$User = new Users;

$User->deleteUserPost($_GET['post_id']);


?>