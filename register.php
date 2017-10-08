<?php 
    require 'config/config.php';
    require 'includes/form_handlers/register_handler.php';
    require 'includes/form_handlers/login_handler.php';
?>

<html>

    <head>
        <title>Facenovel : The Social Network</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width; initial-scale=1.0;" />
        <link href="css/reset-home.css" type="text/css" rel="stylesheet" />
        <link href="css/home.css" type="text/css" rel="stylesheet" />
        <link href="css/input-home.css" type="text/css" rel="stylesheet" />
        <link href="css/regalerts.css" type="text/css" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet">
    </head>


    <body>
        <header>
			<div id="wrapper" style="overflow:hidden;">
				<img src="img/logo.png" class="logo" style="margin-top:5px;"/>
				

				<div id="wrapper" class="small" style="max-width:600px;">
					<span class="title">Welcome to Facenovel</span>
					<div class="paragraph">The best social network</div>
				</div>
				<form action="register.php" method="POST">
				<div class="login" style="padding:10px;">
					<input type="text" placeholder="Email" name="log_email" id="email-login" value="<?php 
                  if(isset($_SESSION['log_email'])){
                    echo $_SESSION['log_email'];
                   }
                  ?>" required />
					<input type="password" placeholder="Password" name="log_password" id="password-login" />
					<input type="submit" value="Login" name="login_button" id="login-button" />
                    <br><br>
                    <?php
                    if(in_array("Incorrect Email or Password",$error_array)){
                        echo '
                            <div class="alert error animated fadeIn" style="margin-bottom:12px; margin-top:5px; position:relative; bottom:8px;">
                                        <input type="checkbox" id="alert1"/>
                                    <label class="close" title="close" for="alert1">
                                    </label>
                                        <p class="inner">
                                            Incorrect Email or Password
                                        </p>
                                </div> 
                        ';
                    }
                    ?>  

				</div>
                </form>
			</div>
			<div id="wrapper" class="big" style="max-width:600px;">
				<span class="title">Welcome to Facenovel</span>
				<div class="paragraph">The social network you have been looking for.</div>
			</div>
        </header>
        <form method="POST" action="register.php" id="regForm">
        <div class="form" style="max-width:400px;">
            
            <!--Label on signup complete-->
            <?php if(in_array("You are successfully registered.",$error_array)){
                                    echo '
                                <div class="alert success animated fadeIn" style="position:relative; bottom:10px;>
		    <input type="checkbox" id="alert2"/>
		    <label class="close" title="close" for="alert2">
        </label>
                <p class="inner">
                    You are registered successfully. Go ahead and Login!
                </p>
                    </div>                        
                                    ';
                }?>


				<span class="title" style="color:#2980b9;">sign up</span>
                <div class="group">      
                  <input type="text" name="reg_firstname" id="fname" value="<?php 
                  if(isset($_SESSION['reg_firstname'])){
                    echo $_SESSION['reg_firstname'];
                   }
                  ?>" required>
                  <span class="highlight"></span>
                  <span class="bar"></span>
                  <label>First Name</label>
                </div>

                <div class="group">      
                  <input type="text" name="reg_lastname" id="surname" value="<?php 
                  if(isset($_SESSION['reg_lastname'])){
                    echo $_SESSION['reg_lastname'];
                   }
                  ?>" required>
                  <span class="highlight"></span>
                  <span class="bar"></span>
                  <label>Surname</label>
                </div>
				
                <div class="group">      
                  <input type="email" name="reg_email" id="email" value="<?php 
                  if(isset($_SESSION['reg_email'])){
                    echo $_SESSION['reg_email'];
                   }
                  ?>" required>
                  <span class="highlight"></span>
                  <span class="bar"></span>
                  <label>Your Email</label>
                </div>

                <div class="group">      
                  <input type="email" name="reg_email2" id="confirmemail" value="<?php 
                  if(isset($_SESSION['reg_email2'])){
                    echo $_SESSION['reg_email2'];
                   }
                  ?>" required>
                  <span class="highlight"></span>
                  <span class="bar"></span>
                  <label>Confirm Email</label> 
                </div>

                <?php if(in_array("Invalid Email Format<br>",$error_array)){
                                    echo '
                                <div class="alert error animated fadeIn" style="margin-bottom:12px; margin-top:5px; position:relative; bottom:8px;">
                                       
                                        <p class="inner">
                                            Invalid Email format.
                                        </p>
                                </div>                             
                                    ';
                }?>

                <?php if(in_array("Emails don't match<br>",$error_array)){
                                    echo '
                                <div class="alert error animated fadeIn" style="margin-bottom:12px; margin-top:5px; position:relative; bottom:8px;">
                                        
                                        <p class="inner">
                                            Emails don\'t match.
                                        </p>
                                </div>                             
                                    ';
                }?>


                <?php if(in_array("Email Already Exists<br>",$error_array)){
                    echo '
                <div class="alert error animated fadeIn" style="margin-bottom:12px; margin-top:5px; position:relative; bottom:8px;">
                        
                        <p class="inner">
                            Email already exists.
                        </p>
                </div>                             
                    ';
                }?>


				
                <div class="group">      
                  <input type="password" name="reg_password" required>
                  <span class="highlight"></span>
                  <span class="bar"></span>
                  <label>New Password</label>
                </div>

                <div class="group">      
                  <input type="password" name="reg_password2" required>
                  <span class="highlight"></span>
                  <span class="bar"></span>
                  <label>Confirm Password</label>
                </div>

                <?php if(in_array("Passwords don't match<br>",$error_array)){
                                    echo '
                                <div class="alert error animated fadeIn" style="margin-bottom:12px; margin-top:5px; position:relative; bottom:8px;">
                                        <p class="inner">
                                            Passwords don\'t match.
                                        </p>
                                </div>                             
                                    ';
                }?>
				
				<input type="submit" name="reg_button" value="Sign Up"/>
                



		</div>
        </form>
		<footer>
		
		</footer>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </body>
</html>

