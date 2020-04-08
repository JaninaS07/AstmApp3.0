<?php 
// jos on painettu lääkitystiedot, mutta ei ole painettu submitPefDatoja
// niin näytetään mittaus form
if (isset($_SESSION['medsInfo']) && !isset($_POST['submitPefData1']) &&
 !isset($_POST['submitPefData4']) && !isset($_POST['submitPefData5']) &&
 !isset($_POST['submitSave'])){
    include("forms2/fpefMittaus3.php");
}

//jos on painettu "tallenna"
if (isset($_POST['submitPefData1'])){

    // tarkistetaan, että tulos on viitearvojen sisällä
    if($_POST['given1st'] > 0 && $_POST['given1st'] <= 1000 &&
    $_POST['given2nd'] > 0 && $_POST['given2nd'] <= 1000 &&
    $_POST['given3rd'] > 0 && $_POST['given3rd'] <= 1000) 
    {

    $_SESSION['1st']=$_POST['given1st'];
    $_SESSION['2nd']=$_POST['given2nd'];
    $_SESSION['3rd']=$_POST['given3rd'];
    }else {
        echo("<h4>Anna puhallusarvot välillä 0-1000!</h4>");
        include("forms2/fpefMittaus3.php");
    }
}

    //tehdään muuttujat 1. ja 2. ylimääräisestä mittauksesta
    $mittaus1=$_POST['given4th'];
    $mittaus2=$_POST['given5th'];
    
    //laitetaan 1. 2. 3. mittaustulokset taulukkoon
    $tulokset = array($_SESSION['1st'], $_SESSION['2nd'],  $_SESSION['3rd']);
    rsort($tulokset); // järjestetään mittaukset suurimmasta pienimpään

    // lasketaan 1. ja 2. tuloksen erotus
    $tulos1 = abs($tulokset[0] - $tulokset[1]); 

// jos erotus alle 20 ja on lisätty hyväksytysti 3. mittaus, 
//niin näytetään tulokset ja liitetään tallenna tulokset button --> tietokantaan

    if (abs($tulos1 <= 20 ) && isset($_SESSION['3rd'])) {  
        echo("<h3>Mittaustulokset: </br></h3>");
        
        echo("1. mittaus: " . $_SESSION['1st'] . " l/min<br/>");
        echo("2. mittaus: " . $_SESSION['2nd'] . " l/min<br/>");
        echo("3. mittaus: " . $_SESSION['3rd'] . " l/min<br/>");
        $_SESSION['1st']=$tulokset[0];
        $_SESSION['2nd']=$tulokset[1];
        $_SESSION['3rd']=$tulokset[2];

        include("forms2/ftallennusLomake.php");
        
    //jos erotus on yli 20 eikä ole painettu submitPefData4 eikä submitPefData5,
    //niin suoritetaan ylimääräinen mittaus
    }elseif (abs($tulos1 > 20) && !isset($_POST['submitPefData4']) && !isset($_POST['submitPefData5'])) {  
        //näytetään taas mittaustulokset
        echo("<h3>Mittaustulokset: </br></h3>");
        echo("1. mittaus: " . $_SESSION['1st'] . " l/min<br/>");
        echo("2. mittaus: " . $_SESSION['2nd'] . " l/min<br/>");
        echo("3. mittaus: " . $_SESSION['3rd'] . " l/min<br/>");

        echo("<br/>Kahden parhaimman mittauksen tulokset poikkeavat toisistaan yli 20 l/min.<br/>");
        echo("<br/>Ole hyvä ja suorita ylimääräinen mittaus:");
        
        include("forms2/fpefMittausYlim.php");
    } 
        // tarkistetaan, että annettu arvo on välilllä 0-1000
        if (isset($_POST['submitPefData4'])){
            // lasketaan ylim. mittauksen ja parhaimman mittauksen erotus
            $erotus=abs($tulokset[0]-$mittaus1);
            $erotus1=abs($mittaus1-$tulokset[0]);
                if($_POST['given4th'] > 0 && $_POST['given4th'] <= 1000) 
                {   
                    $_SESSION['4th']=$_POST['given4th'];
                    //jos erotus on suurempi kuin 20, liitetään 2. ylim. mittauksen formi
                    //näytetään aiemmat mittaustulokset
                    if($erotus > 20 || $erotus1 > 20){
                        echo("<h3>Mittaustulokset: </br></h3>");
                        echo("1. mittaus: " . $_SESSION['1st'] . " l/min<br/>");
                        echo("2. mittaus: " . $_SESSION['2nd'] . " l/min<br/>");
                        echo("3. mittaus: " . $_SESSION['3rd'] . " l/min<br/>");
                        echo("1. ylimääräinen mittaus: " . $_SESSION['4th'] ." l/min<br />");
                        echo("<br/>Annetun mittaustuloksen erotus on edelleen yli 20 l/min.<br/>");
                        echo("<br/>Ole hyvä ja suorita uusi mittaus:</br>");
                        include("forms2/fpefMittaus2.php");
                    // jos erotus on pienempi 20, näytetään mittaustulokset
                    //tallennetaan tulokset taulukkooon
                    //järjestetään alkiot suurimmasta pienimpään
                    //tallennetaan 3 parasta tulosta
                    }elseif($erotus <= 20 || $erotus1 <= 20){
                        $tulokset = array($_SESSION['1st'], $_SESSION['2nd'],  $_SESSION['3rd'], $_SESSION['4th']);
                        rsort($tulokset);
                        echo("<h3>Mittaustulokset:<br/></h3>");
                        echo("1. mittaus: " . $_SESSION['1st'] . " l/min<br/>");
                        echo("2. mittaus: " . $_SESSION['2nd'] . " l/min<br/>");
                        echo("3. mittaus: " . $_SESSION['3rd'] . " l/min<br/>");
                        echo("1. ylimääräinen mittaus: " . $_SESSION['4th'] ." l/min<br /></br>");
                        // siirretään arraysta 3 parasta tulosta sessiomuuttujiin
                        echo("<h2>3 parasta arvoa tallennetaan.<br/></h2>");
                        $_SESSION['1st']=$tulokset[0];
                        $_SESSION['2nd']=$tulokset[1];
                        $_SESSION['3rd']=$tulokset[2];
                        
                        //liitetään mukaan tallenna kantaan -buttoni
                        include("forms2/ftallennusLomake.php");


                    } 
                }else {
                echo("<h4>Anna puhallusarvo välillä 0-1000!</h4>");
                include("forms2/fpefMittausYlim.php");
                
                }   
        }
    
    //2. ylimääräinen mittaus
    if(isset($_POST['submitPefData5'])) {
            // raja-arvoille ehdot
            if($_POST['given5th'] > 0 && $_POST['given5th'] <= 1000) 
            {
                $_SESSION['5th']=$_POST['given5th']; 
                    
                    //sijoitetaan kaikki 5 tulosta taulukkoon
                    //järjestetään alkiot
                    $tulokset = array($_SESSION['1st'], $_SESSION['2nd'],  $_SESSION['3rd'], $_SESSION['4th'], $_SESSION['5th']);
                    rsort($tulokset);
                    echo("<h3>Mittaustulokset suuruusjärjestyksessä:<br/></h3>");
                    echo("1. mittaus: " . $_SESSION['1st'] . " l/min<br/>");
                    echo("2. mittaus: " . $_SESSION['2nd'] . " l/min<br/>");
                    echo("3. mittaus: " . $_SESSION['3rd'] ." l/min<br />");
                    echo("1. ylimääräinen mittaus: " . $_SESSION['4th'] ." l/min</br>");
                    echo("2. ylimääräinen mittaus: " . $_SESSION['5th'] ." l/min</br>");
                    // siirretään arraysta 3 parasta tulosta sessiomuuttujiin
                    echo("<h2>3 parasta arvoa tallennetaan.<br/></h2>");
                    $_SESSION['1st']=$tulokset[0];
                    $_SESSION['2nd']=$tulokset[1];
                    $_SESSION['3rd']=$tulokset[2];
            
                    include("forms2/ftallennusLomake.php");
               
           }else {
           echo("<h4>Anna puhallusarvo välillä 0-1000!</h4>");
           include("forms2/fpefMittaus2.php");
           }
    }
?>