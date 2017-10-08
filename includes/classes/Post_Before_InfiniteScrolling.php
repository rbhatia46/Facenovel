<link rel="stylsheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<?php
error_reporting(E_ERROR | E_PARSE);

class Post{
    private $user_obj;
    private $con;

    public function __construct($con, $user){
        $this->con = $con;
        $this->user_obj = new User($con, $user); 
    }

    public function submitPost($body, $user_to){
        $body = strip_tags($body); //Removes HTML Tags
        $body = mysqli_real_escape_string($this->con,$body); //Escape single quotes in the user post
        $check_empty = preg_replace('/\s+/','',$body); //Deletes all spaces 
        if($check_empty != ""){

            //Current Date and Time
            $date_added = date("Y-m-d H:i:s");
             
            //Get username
            $added_by = $this->user_obj->getUsername();

            //If user is on own profile, user_to is none
            if($user_to == $added_by){
                 $user_to = "none";
            }

            //Insert posts to database
            $query = mysqli_query($this->con,"INSERT INTO posts VALUES('','$body','$added_by','$user_to','$date_added','no','no','0')");
            $returned_id = mysqli_insert_id($this->con);

            //Insert Notification


            //Update post count for function
            $num_posts = $this->user_obj->getNumPosts();
            $num_posts++;
            $update_query = mysqli_query($this->con,"UPDATE users SET numPosts='$num_posts' WHERE userName='$added_by'");



        }
    }

    public function loadPostsFriends($data, $limit){

        $page = $data['page']; 
		$userLoggedIn = $this->user_obj->getUsername();

		if($page == 1) 
			$start = 0;
		else 
			$start = ($page - 1) * $limit;


		$str = ""; //String to return 
		$data_query = mysqli_query($this->con, "SELECT * FROM posts WHERE deleted='no' ORDER BY id DESC");

		if(mysqli_num_rows($data_query) > 0) {


			$num_iterations = 0; //Number of results checked (not necasserily posted)


        while($row = mysqli_fetch_array($data_query)){
            $id = $row['id'];
            $body = $row['body'];
            $added_by = $row['added_by'];
            $date_time = $row['date_added'];

            //Prepare user_to string so it can be included if not posted to a user
            if($row['user_to']=="none"){
                $user_to="";
            }
            else{
                $user_to_obj = new User($con, $row['user_to']);
                $user_to_name = $user_to_obj->getFirstAndLastName();
                $user_to = "<i class='fa fa-right'></i> <a href='".$row['user_to'] ."'>".$user_to_name."</a>" ;
            }

            //Check if user who posted has a account closed
            $added_by_obj = new User($this->con,$added_by);
            if($added_by_obj->isClosed()){
                continue;
            }

            if($num_iterations++ < $start){
            continue;
            }

            //Once 10 posts have been loaded break
            if($count > $limit){
                break;
            }
            else{
                $count++;
            }


            $user_details_query =   mysqli_query($this->con,"SELECT firstName,lastName,profilePicture FROM users where userName='$added_by'");
            $user_row = mysqli_fetch_array($user_details_query);
            $first_name = $user_row['firstName'];
            $last_name = $user_row['lastName'];
            $profile_pic = $user_row['profilePicture'];




            //Timeframe
            $date_time_now = date("Y-m-d H:i:s");
            $start_date = new DateTime($date_time); //Time of post
            $end_date = new DateTime($date_time_now); // Current time
            $interval = $start_date->diff($end_date); //Difference between dates
            if($interval->y >= 1){
                if($interval==1)
                    $time_message = $interval->y. " year ago"; //1 year ago
                else
                    $time_message = $interval->y. "years ago"; //1+ years ago
            }
            else if($interval->m >= 1){
                if($interval->d == 0)
                $days = " ago";
            }
            else if($interval->d == 1){
                $days = $interval->d. " day ago";
            }
            else{
                $days = $interval->d. " days ago";
            }
             if($interval->m==1){
                $time_message = $interval->m. " month". $days;
            }
            else{
                $time_message = $interval->m. " months". $days;
            }
            if($interval->d >= 1){
            if($interval->d == 1){
                $time_message = "Yesterday";
            }
            else{
                $time_message = $interval->d. " days ago";
            }
        }
        else if($interval->h >= 1){
            if($interval->h == 1){
                $time_message = $interval->h. " hour ago";
            }
            else{
                $time_message = $interval->h. " hours ago";
            }
        }
          else if($interval->i >= 1){
            if($interval->i == 1){
                $time_message = $interval->i. " minute ago";
            }
            else{
                $time_message = $interval->i. " minutes ago";
            }
        }
          else{
            if($interval->s < 30){
                $time_message = "Just now";
            }
            else{
                $time_message = $interval->s. " seconds ago";
            }
        }
        $str .= "<div class='status_post'>
            <div class='post_profile_pic'>
                <img src='$profile_pic' width='60'>
            </div>
                <div class='posted_by' style='color:#ACACAC;'>
                    <a href='$added_by' style='text-decoration:none;'> $first_name $last_name</a> $user_to &nbsp;&nbsp;&nbsp;&nbsp; $time_message
                </div>

            <div id='post_body'> 
                $body
                <br>
            </div>

            </div>
            <hr>
        ";
    } //End of while
if($count > $limit) 
				$str .= "<input type='hidden' class='nextPage' value='" . ($page + 1) . "'>
							<input type='hidden' class='noMorePosts' value='false'>";
			else 
				$str .= "<input type='hidden' class='noMorePosts' value='true'><p style='text-align:center;'>No more posts to show!</p>";
 

}//End of if
        echo $str;

        }
         
}

?>