 <?php
 //Variable Declaration
    $fname = "";
    $lname = "";
    $em = "";
    $em2 = "";
    $password = "";
    $password2 = "";
    $date = ""; //Sign up date
    $error_array=array(); //Error messages to log to user

    if(isset($_POST['reg_button'])){

        //First Name
        $fname = strip_tags($_POST['reg_firstname']); //Remove the HTML tags if any in the firstname
        $fname = str_replace(' ','',$fname); // Remove spaces in first name
        $fname = ucfirst(strtolower($fname)); // Capitalize the first letter of the name
        $_SESSION['reg_firstname'] = $fname; //Stores first name to session variable

         //Last Name
        $lname = strip_tags($_POST['reg_lastname']); //Remove the HTML tags if any in the lastname
        $lname = str_replace(' ','',$lname); // Remove spaces in first name
        $lname = ucfirst(strtolower($lname)); // Capitalize the first letter of the name
        $_SESSION['reg_lastname'] = $lname; //Stores last name to session variable


        //Email
        $em = strip_tags($_POST['reg_email']); //Remove the HTML tags if any in the email
        $em = str_replace(' ','',$em); // Remove spaces in email
        $_SESSION['reg_email'] = $em; //Stores email to session variable


        //Confirmation Email
        $em2 = strip_tags($_POST['reg_email2']); //Remove the HTML tags if any in the email
        $em2= str_replace(' ','',$em2); // Remove spaces in email
        $_SESSION['reg_email2'] = $em2; //Stores  confirm email to session variable


        //Password
        $password = strip_tags($_POST['reg_password']); //Remove the HTML tags if any in the password

        
        //Confirm Password
        $password2 = strip_tags($_POST['reg_password2']); //Remove the HTML tags if any in the password

        $date = date("Y-m-d"); //Current Date
        if($em == $em2){
            //Check for proper format of the email
            if(filter_var($em,FILTER_VALIDATE_EMAIL)){
                $em = filter_var($em,FILTER_VALIDATE_EMAIL);
                //Check if email already exists
                $e_check = mysqli_query($con," SELECT email from users WHERE email='$em' ");
                //Count the number of rows returned
                $num_rows = mysqli_num_rows($e_check);

                if($num_rows > 0){
                  array_push($error_array,"Email Already Exists<br>");//Email Already exists
                }
            }
            else{
               array_push($error_array,"Invalid Email Format<br>");//Invalid Format
            }
        }
        else{
             array_push($error_array,"Emails don't match<br>");  //Different Emails
        }
        
        if($password != $password2){
              array_push($error_array,"Passwords don't match<br>");//Different passwords
        }

        if(empty($error_array)){ //If there is no error
            $password =  md5($password); //Encrypt password before sending to database.
            $username = strtolower($fname."_".$lname);
            $check_username_query = mysqli_query($con, "SELECT userName FROM users WHERE userName='$username'");
            $i=0;
            //If username exists add number to username
            while(mysqli_num_rows($check_username_query) != 0){
                $i++;
                $username = $username."_".$i;
                $check_username_query = mysqli_query($con,"SELECT userName FROM users WHERE userName='$username'");
            }

            //Assign a Profile Picture
            $rand = rand(1,16); //Random number between 1 and 2
            switch($rand) {
                case 1:
                 $profile_pic= "images/profilepics/default/head_deep_blue.png";
                 break;
                case 2:
                $profile_pic= "images/profilepics/default/head_emerald.png";
                break;
                case 3:
                $profile_pic= "images/profilepics/default/head_alizarin.png";
                break;
                case 4:
                $profile_pic= "images/profilepics/default/head_amethyst.png";
                break;
                case 5:
                $profile_pic= "images/profilepics/default/head_belize_hole.png";
                break;
                case 6:
                $profile_pic= "images/profilepics/default/head_carrot.png";
                break;
                case 7:
                $profile_pic= "images/profilepics/default/head_green_sea.png";
                break;
                case 8:
                $profile_pic= "images/profilepics/default/head_nephritis.png";
                break;
                case 9:
                $profile_pic= "images/profilepics/default/head_pete_river.png";
                break;
                case 10:
                $profile_pic= "images/profilepics/default/head_pomegranate.png";
                break;
                case 11:
                $profile_pic= "images/profilepics/default/head_pumpkin.png";
                break;
                case 12:
                $profile_pic= "images/profilepics/default/head_red.png";
                break;
                case 13:
                $profile_pic= "images/profilepics/default/head_sun_flower.png";
                break;
                case 14:
                $profile_pic= "images/profilepics/default/head_turqoise.png";
                break;
                case 15:
                $profile_pic= "images/profilepics/default/head_wet_asphalt.png";
                break;
                case 16:
                $profile_pic= "images/profilepics/default/head_wisteria.png";
                break;
            }

            $query = mysqli_query($con,"INSERT INTO users VALUES('','$fname','$lname','$username','$em',
            '$password','$date','$profile_pic','0','0','no',',')");

            array_push($error_array,"You are successfully registered.");

            //Clear all the session variables
            $_SESSION['reg_firstname'] = "";
            $_SESSION['reg_lastname'] = "";
            $_SESSION['reg_email'] = "";
            $_SESSION['reg_email2'] = "";
        }
    }

    ?>