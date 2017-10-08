<?php
    include('includes/header.php');
    include('includes/classes/User.php');
    include('includes/classes/Post.php');

    if(isset($_POST['post'])){ //If the post button is pressed
        $post = new Post($con,$userLoggedIn);
        $post->submitPost($_POST['post_text'],'none');
    }

?>


<div class="container-fluid">
    <div class="row">
        <div class="col-md-3" style="margin-top:12px;">
<div class="user_details column">
    <a href="<?php echo $userLoggedIn ?>"><img src="<?php echo $user['profilePicture']; ?>"></a>
    <div class="user_details_left_right">
    <a href="<?php echo $userLoggedIn ?>" style="text-decoration:none;">
        
    <?php
        echo $user['firstName']. " " . $user['lastName'];
     ?>
     </a>
     <br>
     <?php 
        echo "Number of Posts: ". $user['numPosts']. "<br>";
        echo "Total Number of Likes: ". $user['numLikes']. "<br>";
        echo "Joined on: ". $user['signupDate'];
     ?>
     </div>
</div>
        </div> <!--End of col-md-3-->
    <div class="col-md-6">
    <div class="main_column column">
    <form class="post_form" action="index.php" method="POST">
        <textarea name="post_text" rows="4" class="form-control" id="post_text" placeholder="What's on your mind?"></textarea>
        <br>
        <input type="submit" class="btn btn-primary" name="post" id="post_button" value="Post">
        <hr>
    </form>
   
    

    <div class="posts_area"></div>
    <img src="images/icons/loading.gif" id="loading">
    </div>
    
    </div><!--End of col-md-6-->
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    var userLoggedIn = '<?php echo $userLoggedIn; ?>';
    $(document).ready(function(){
        $('#loading').show();
        //Original AJAX Requests for loading first posts
        $.ajax({
            url : "includes/handlers/ajax_load_posts.php",
            type : "POST",
            data : "page=1&userLoggedIn=" + userLoggedIn,
            cache:false,
            success: function(data){
                $("#loading").hide();
                $(".posts_area").html(data);
            }
        });

        $(window).scroll(function(){
            var height = $('.posts_area').height(); //div containing posts
            var scroll_top = $(this).scrollTop();
            var page = $('.posts_area').find('.nextPage').val();
            var noMorePosts = $('.posts_area').find('.noMorePosts').val();
            if((document.body.scrollHeight == document.body.scrollTop + window.innerHeight) && noMorePosts == 'false'){
                $('#loading').show();
                  $.ajax({
            url : "includes/handlers/ajax_load_posts.php",
            type : "POST",
            data : "page=" + page +"&userLoggedIn=" + userLoggedIn,
            cache:false,
            success: function(data){
                $('.posts_area').find('.nextPage').remove();
                $('.posts_area').find('.noMorePosts').remove();
                $("#loading").hide();
                $(".posts_area").append(data);
            }
        });
            } //End of if
            return false;
        }); //End $(window).scroll 
    }); //End Document.ready

    
</script>

</div> <!--End of Wrapper -->



</body>
</html>


