<?php
    include 'config.php';
    
    # Unset and destroy the session & redirect to homepage
    session_unset();
    session_destroy();
    
    header('Location: index.php');
  ?>
  