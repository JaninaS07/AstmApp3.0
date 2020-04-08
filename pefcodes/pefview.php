<?php
// jos on painettu submit-buttonia
if(isset($_POST['submitAnswer'])) {

    // talletetaan lomakkeen tiedot sessio-muuttujaan
        $_SESSION['medsInfo'] = $_POST['medsInfo'];
}
// jos lääketietoja ei ole hyväksytty, näytetään info-form
// jos lääketiedot löytyvät sessiosta, kirjoitetaan se näkyviin:
if (!isset($_SESSION['medsInfo'])) {
    include("forms2/fmedsInfo.php");
} else {
    echo("<h2>PEF-mittaus: " . $_SESSION['medsInfo'] . "</h2>");
}
?>