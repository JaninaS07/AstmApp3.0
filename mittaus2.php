<?php include("includes/iheader.php");?>
<div class="pefcontainer">

<?php if(!isset($_SESSION['sloggedIn'])){ 
    header("Location: index.php");
} else { ?>

<!-- Mikä lomake näytetään? -->
<?php include("pefcodes/pefview.php"); ?>

<!-- "Mittausarvot"-lomake & "Tallenna"-näppäin -->
<?php include("pefcodes/pefmeasurements.php"); ?>

<!-- PEF-session unset-näppäin -->
<?php include("pefcodes/pefsessionunset.php"); ?>

<!-- PEF-tiedonsiirto tietokantaan -->
<?php include("pefcodes/databasetransfer.php"); ?>

</br>

</div>
<!-- Tulostetaan ruudulle 3 viimeisintä mittausta -->
<?php include("pefcodes/table.php"); ?>

<?php } ?>

</body>
</html>