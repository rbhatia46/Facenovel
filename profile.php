<?php
    include('includes/header.php');
    include('includes/classes/User.php');
    include('includes/classes/Post.php');

    if(isset($_GET['profile_username'])){
        $username = $_GET['profile_username'];
        $user_details_query = mysqli_query($con,"SELECT * FROM users WHERE userName='$username'");
        $user_array = mysqli_fetch_array($user_details_query);
        $num_friends = (substr_count($user_array['friendArray'],",")) - 1;
    }
?>
<link rel="stylesheet" href="css/header-styles.css">


<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="main_column column">
            <img src="<?php echo $user_array['profilePicture'] ?>" class="profilePic">
            <div class="profile_info">
                <br><p><strong><?php echo "Name : " . $user_array['firstName']." " .$user_array['lastName'];?></strong></p>
                <p><?php echo "Number of Posts : " . $user_array['numPosts'];?></p>
                <p><?php echo "Total Number of Likes : " . $user_array['numLikes'];?></p>
                <p><?php echo "Number of Friends : " . $num_friends?></p>
            </div>

            <form action="<?php echo $username; ?>">
               <?php 
               $profile_user_obj = new User($con,$username);
               if($profile_user_obj->isClosed()){
                   header("Location: user_closed.php");
               }
               $logged_in_user_obj = new User($con,$userLoggedIn);
               if($userLoggedIn != $username){
                   if($logged_in_user_obj->isFriend($username)){
                       echo "<input type='submit' name='remove_friend' class='btn btn-danger' value='Remove Friend'><br>";

                   }
               }
               
               
               ?>



            </form>


            </div>
        </div> <!--End of Col-md-3-->
    <div class="col-md-6">
    <div class="main_column column">
    This is a Profile Page.
    </div>
    </div><!--End col-md-6-->
    </div> <!--End Row-->
	</div><!--End of Container Fluid-->



    

</div> <!--End of Wrapper -->
</body>
</html>


