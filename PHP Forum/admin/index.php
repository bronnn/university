<?php
include '../inc/templates/header.php'; 

if($level==1){
?>
<div class="threadbody container admin">
    <h2 class="text-center"> Admin Area</h2>
    <p class="text-center"> Welcome, <?php echo $_SESSION['username']; ?></p>
    <br>
    <div class="row">

<div class="col-lg-6 col-md-6 col-xs-6 thumb">
    <a class="thumbnail" href="user.php">
        <img class="img-responsive imgy" src="../inc/img/admin/userman.png" alt="">
    </a>
</div>
<div class="col-lg-6 col-md-6 col-xs-6 thumb">
    <a class="thumbnail" href="post.php">
        <img class="img-responsive imgy" src="../inc/img/admin/postmod.png" alt="">
    </a>
</div>

</div>
</div>
<?php }
else {
    header('Location: ../index.php');
}
?>