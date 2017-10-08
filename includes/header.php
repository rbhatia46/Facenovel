<?php 
    require 'config/config.php';
     if(isset($_SESSION['username'])){       //Earlier we had set $_SESSION['username'] as username from database
        $userLoggedIn = $_SESSION['username']; 
        $user_details_query = mysqli_query($con,"SELECT * FROM users WHERE userName = '$userLoggedIn'");
        $user = mysqli_fetch_array($user_details_query);

    }
    else{
        header("Location: register.php");
    }
?>

<html>
<head>
<!--CSS-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
<link rel="stylesheet" href="css/header-styles.css">

<!--Javascript-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/react/15.6.1/react.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
<title>Welcome to Facenovel</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-primary">
  <a class="navbar-brand" href="index.php" style="color:#fff;">Facenovel</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    
    
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" id="searchBox">
      <button class="btn btn-success my-2 my-sm-0" type="submit" style="color:#fff;">Search</button>
    </form>

    <div class="navbar-nav" id="navbarLinks">

      <a class="nav-item nav-link mr-3" data-toggle="tooltip" title="Profile" href="<?php echo $userLoggedIn ?>" style="color:#fff;">
          <img class="rounded-circle mr-2" src="<?php echo $user['profilePicture']; ?>"
          width="35" height="32">
          <?php echo $user['firstName'];?></a>
      <a class="nav-item nav-link" href="index.php" data-toggle="tooltip" title="Home"><i class="fa fa-home fa-lg"></i></a>
      <a class="nav-item nav-link" href="#" data-toggle="tooltip" title="Friend Requests"><i class="fa fa-users fa-lg"></i></a>
      <a class="nav-item nav-link" href="#" data-toggle="tooltip" title="Messages"><i class="fa fa-envelope fa-lg"></i></a>
      <a class="nav-item nav-link" href="#" data-toggle="tooltip" title="Notifications"><i class="fa fa-bell-o fa-lg"></i></a>
      <a class="nav-item nav-link" href="#" data-toggle="tooltip" title="Settings"><i class="fa fa-cog fa-lg"></i></a>
      <a class="nav-item nav-link" href="includes/handlers/logout.php" data-toggle="tooltip" title="Sign Out"><i class="fa fa-sign-out fa-lg"></i></a>

    </div>

    <div class="wrapper">

  </div>
</nav>