<?php include("forms2/ftuhoaTiedot.php"); ?>

<?php
    //"tuhoa tiedot" button
    if(isset($_POST['submitDestroy'])) {
        unset($_SESSION['1st']); // tuhotaan kaikki sessio muuttujat
        unset($_SESSION['2nd']);
        unset($_SESSION['3rd']);
        unset($_SESSION['4th']);
        unset($_SESSION['5th']);
        unset($_SESSION['medsInfo']);
        // palataan takaisin tälle samalle sivulle, jolloin sessio käynnistyy uudelleen
        header("Location: " . $_SERVER['PHP_SELF']);
    }
?>