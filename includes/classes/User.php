<?php
class User{
    private $user;
    private $con;

    public function __construct($con, $user){
        $this->con = $con;
        $user_details_query = mysqli_query($con,"SELECT * FROM users WHERE userName='$user'");
        $this->user = mysqli_fetch_array($user_details_query);
    }


    public function getUsername(){
        return $this->user['userName'];
    }

    public function getNumPosts(){
        $username = $this->user['userName'];
        $query = mysqli_query($this->con,"SELECT numPosts FROM users WHERE userName='$username'");
        $row = mysqli_fetch_array($query);
        return $row['numPosts']; 
    }

    public function getFirstAndLastName(){
        $username = $this->user['userName'];
        $query = mysqli_query($this->con,"SELECT firstName,lastName FROM users WHERE userName='$username'");
        $row = mysqli_fetch_array($query);
        return $row['firstName']. " ". $row['lastName'];
    }


    public function getProfilePic(){
        $username = $this->user['userName'];
        $query = mysqli_query($this->con,"SELECT profilePicture FROM users WHERE userName='$username'");
        $row = mysqli_fetch_array($query);
        return $row['profilePicture'];
    }

    public function isClosed(){
        $username = $this->user['userName'];
        $query = mysqli_query($this->con,"SELECT user_closed FROM users WHERE userName='$username'");
        $row = mysqli_fetch_array($query);
        if($row['userClosed'] == 'yes'){
            return true;
        }else{
            return false;
        }
    }

    public function isFriend($username_to_check){
        $usernameComma = ','. $username_to_check . ',';
        if((strstr($this->user['friendArray'],$usernameComma) || $username_to_check == $this->user['userName'])){
            return true;
        }else{
            return false;
        }

    }

}

?>