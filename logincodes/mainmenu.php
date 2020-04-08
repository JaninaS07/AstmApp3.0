<?php include('config/cconfig.php'); ?>

<div class="pefcontainer">

<?php
//kirjautuneen käyttäjän userID?
$data1['email'] = $_SESSION['suserEmail'];
$sql1 = "SELECT userID FROM users where userEmail =  :email";
$kysely1=$DBH->prepare($sql1);
$kysely1->execute($data1);
$tulos1=$kysely1->fetch();
$currentUserID=$tulos1[0];
$_SESSION['userID'] = $currentUserID;
?>
<h2>Terve, <?php echo($_SESSION['suserName'] . "!"); ?></h2>
<p>Suoritit PEF-mittauksen viimeksi...</p>
<p>Lisäsit oireet viimeksi...</p>



<form method="post" action="mittaus2.php">
 <button type="submit" id="button2" class="buttoncontainer"><i class="fas fa-lungs"></i><span class="buttontext">PEF-mittaus</span></button>
</form>

<form method="post" action="oireet.php">
 <button type="submit" id="button2" class="buttoncontainer"><i class="fas fa-lungs-virus"></i></i><span class="buttontext">Lisää oireet</span></button>
</form>

<form method="post" action="breathe.php">
 <button type="submit" id="button2" class="buttoncontainer"><i class="fas fa-spa"></i><span class="buttontext">Hengitysharjoitus</span></button>
</form>

<form method="post" action="yhteenveto.php">
 <button type="submit" id="button2" class="buttoncontainer"><i class="fas fa-file-medical-alt"></i><span class="buttontext">Yhteenveto</span></button>
</form>