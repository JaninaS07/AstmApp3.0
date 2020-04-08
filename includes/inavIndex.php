<nav>
<div id="navbar">
<?php
//Käyttäjän tila
if($_SESSION['sloggedIn']=="yes"){

    ?><a href="logOutUser.php">Kirjaudu ulos</a> <a href="index.php">Päävalikko</a>
    
    <?php include("forms/flanguage.php");?>

 <?php

}else{

    ?>
    <!-- <a href="createAccount.php">Create account</a> <a href="logInUser.php">Log in</a> -->
    <a href="logOutUser.php"></a>

    <?php include("forms/flanguage.php");?>

    <?php } ?>

</div>
</nav>