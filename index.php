<?php include("includes/iheader.php");?>

<!-- Jos ei kirjautunut, sisäänkirjautumislomake -->
<?php if(!isset($_SESSION['sloggedIn'])){
     include("logincodes/login.php");?>

<!-- Jos kirjautunut, näytä päävalikko -->
    <?php }else{
      include("logincodes/mainmenu.php");}?>
    
<?php include("includes/ifooter.php");?>