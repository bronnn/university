<?php
  # Include the configuration file in the header so it is set on all pages
  # I ran into some issues using the header on the admin section so i found this solution online using the server root variable
    include($_SERVER['DOCUMENT_ROOT'] . "/config.php");

  ?>
  
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>GamePotion</title>
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <!-- Bootstrap core CSS -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>



    <link href="/inc/css/style.css" rel="stylesheet">

  </head>

  <body>
      
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
      <div class="container">
        <a class="navbar-brand" href="/">
          <img src="/inc/img/gp.png" width="120" height="40" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <?php if($logged_in){ # If user is logged in hide signup/login buttons instead display sign out & my account ?> 
            <li class="nav-item">
                <a class="nav-link" href="/account.php">My Account</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="/signout.php">Signout</a>
            </li>
            <?php if ($level == 1){ # If the user is an admin, display the admin panel link ?>
            <li class="nav-item">
              <a class="nav-link" href="/admin">Admin Panel</a>
            </li>
            
            <?php } ?>
            <?php } 
            else {?>
            <li class="nav-item">
              <a class="nav-link" href="/login.php">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/signup.php">Signup</a>
            </li>
            <?php } ?>
          </ul>
        </div>
      </div>
    </nav>