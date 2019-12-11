<?php 
include 'Database.php';

class Users extends Database{

    public function addUser($username,$password,$userfname,$userlname,$userlocation,$nationality){
        $insertIntoLogin = "INSERT INTO login(username,password)VALUES('$username','$password')";
        $insertLoginResult = $this->conn->query($insertIntoLogin);

            if($insertLoginResult == true){
                $LoginID = $this->conn->insert_id;
                $insertIntoUsers = "INSERT INTO users(`fname`, `lname`, `location`, `nationality`, `login_id`) VALUES ('$userfname','$userlname','$userlocation','$nationality','$LoginID')";

                $insertUsersResult = $this->conn->query($insertIntoUsers);

                if($insertUsersResult == false){
                    die('addtion failed'.$this->conn->connect_error);
                }else{
                    header('login.php');
                }
            }else{
                echo "adding to login table failed";
            }



}

public function login($username,$password){
    $sql = "select * from login inner join users on login.login_id = users.login_id where login.username = '$username' and  login.password = '$password'";
    $result = $this->conn->query($sql);

    if($result->num_rows==1){
        $row = $result->fetch_assoc();
        return $row;
    }else{
        return FALSE;
    }
}

    public function getOneUser($id){
        $sql = "SELECT * FROM users WHERE user_id = '$id'";
        $result = $this->conn->query($sql);
        if($result == false){
            die($this->conn->connect_error);
        }else{
            return $result->fetch_assoc();
        }

    }
    public function addPost($user_id,$desc,$category){
        $sql = "INSERT INTO posts(user_id,description,category)VALUES('$user_id','$desc','$category')";
        $result = $this->conn->query($sql);

        if($result == false){
            die($this->conn->connect_error);
        }else{
            header('location: profile.php');
        }

    }

    public function getCurrentUserPost($id){
        $sql = "SELECT * FROM posts INNER JOIN users ON posts.user_id = users.user_id WHERE users.user_id = '$id 'ORDER BY posts.post_id DESC";
        $result = $this->conn->query($sql);
        if($result->num_rows>0){
            $row = array();
            while($rows = $result->fetch_assoc()){
                $row[]= $rows;
            }return $row;
        }else{
            return FALSE;
        }

    }
    public function deleteUserPost($id){
        $sql = "DELETE FROM posts WHERE post_id = '$id'";
        $result = $this->conn->query($sql);
        if($result == false){
            die($this->conn->connect_error);
        }else{
            header('location:profile.php');
        }

    }
    public function uploadUserProfilePhoto($id,$name){
        $name = $_FILES['picture']['name'];
        $target_dir = 'profile_pictures/';
        $targetFile = $target_dir.basename($name);

        $sql = "UPDATE users SET user_img = '$name' WHERE user_id = '$id'";
        $result = $this->conn->query($sql);
        if($result == FALSE){
            die($this->conn->connect_error);
        }else{
            move_uploaded_file($_FILES['picture']['tmp_name'],$targetFile);
            header('location:profile.php');
        }

    }



}


?>