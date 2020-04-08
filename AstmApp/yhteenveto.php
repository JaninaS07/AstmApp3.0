<?php include("includes/iheader.php");?>


<?php
//kirjautuneen käyttäjän userID?
$dataYhteenveto['email'] = $_SESSION['suserEmail'];
$sqlYhteenveto = "SELECT userID FROM users where userEmail =  :email";
$kyselyYhteenveto=$DBH->prepare($sqlYhteenveto);
$kyselyYhteenveto->execute($dataYhteenveto);
$tulosYhteenveto=$kyselyYhteenveto->fetch();
$currentUserID=$tulosYhteenveto[0];
?>
<?php
//kysely ja laskukaava viitearvoille
$dataViite['userID'] = $currentUserID;
$sqlViite = "SELECT userSex, userHeight, userDOB FROM `users` WHERE userID = :userID";
$kyselyViite=$DBH->prepare($sqlViite);
$kyselyViite->execute($dataViite);				

echo ("<h4>PEF-mittauksen tavoitearvosi on:<br/>");

//echo("<table>
   // <tr>
      //  <th>Viitearvo</th>
   // </tr>");
while	($row=$kyselyViite->fetch()){
        $dateOfBirth=$row['userDOB'];
        $today=date("Y-m-d");
        $diff = date_diff(date_create($dateOfBirth), date_create($today));
        $age=$diff->format('%y');
        $pituus=$row['userHeight'];
        //viitearvo lähde: http://www.gfr.fi/pef.html
        // kaava poimittu inspectistä
        $pef_wmM = exp(0.544*log($age)-0.0151*$age-74.7/$pituus+5.48);
        $pef_wmN = exp(0.376*log($age)-0.012*$age-58.8/$pituus+5.63);
        $pef_euN = -0.0000001116*pow($pef_wmN, 3.0)+0.0008814*pow($pef_wmN, 2.0)+0.4*$pef_wmN+50.356;
        $pef_euM = -0.0000001116*pow($pef_wmM, 3.0)+0.0008814*pow($pef_wmM, 2.0)+0.4*$pef_wmM+50.356;
        //$viitearvoM=(((($pituus/100)*5.48)+1.58)-($age*0.041))*60;
        //$viitearvoN=(((($pituus/100)*3.72)+2.24)-($age*0.03))*60;
       // echo("<tr><td>");
        if($row['userSex'] == "m") {
            echo(ROUND($pef_euM, 0). " l/min</h4>");
        }

        if($row['userSex'] == "n") {
            //echo $viitearvoN;
            echo(ROUND($pef_euN, 0). " l/min</h4>");
            //echo $age;
            //echo $viitearvo;
        }
        //nämä kysymysmerkkiin pop-upiin?
        //echo("Viitearvot määritellään iän, sukupuolen ja pituuden perusteella.<br/>");
        //echo("Viitearvot perustuvat EU standardiin: EU EN-13826 [l/min]");
        // vuorokausivaihtelu: 100 x (suurin PEF- pienin PEF) / 1/2x (suurin PEF+ pienin PEF)
        // värikoodit: jos yli 15% huonompi kuin viitearvo -> keltainen PEF-tulos?

    }
//echo("</table><br/>");
?>
<?php
//kysely ja taulukon tulostus PEF-mittauksille

$dataPEF['userID'] = $currentUserID;
$sqlPEF = "SELECT medsInfo, 1st, 2nd, 3rd, timeOfMeasurement, userSex FROM `peakFlow`, `users` 
WHERE users.userID = peakFlow.userID AND users.userID = :userID ORDER BY timeOfMeasurement DESC LIMIT 10";
$kyselyPEF=$DBH->prepare($sqlPEF);
$kyselyPEF->execute($dataPEF);				

echo ("<p><h3>Edelliset PEF-puhallusarvot:</h3></p>");
echo ("<p><h5>Puhallusarvot näytetään suuruusjärjestyksessä.</h5></p>");

echo("<table>
    <tr>
        <th>ajankohta</th>
        <th>lääkitys</th>
        <th colspan=\"3\">mittaukset</th>
        <th>paras arvo</th>
        <th>keskiarvo</th>
    </tr>");
        // lasketaan %raja-arvot mittausten keskiarvolle --> keskiarvon väri tulosten mukaan
while	($row=$kyselyPEF->fetch()){	
        $formatted_datetime = date("d.m.Y, H:i", strtotime($row['timeOfMeasurement']));
        $ka=($row['1st']+$row['2nd']+$row['3rd'])/3;
        $goodN=$pef_euN*0.85;
        $mediumN=$pef_euN*0.70;
        $badN=$pef_euN*0.50;
        $goodM=$pef_euM*0.85;
        $mediumM=$pef_euM*0.70;
        $badM=$pef_euM*0.50;
        echo("<tr>
        <td align=\"right\">".$formatted_datetime."</td>
        <td>".$row['medsInfo']."</td>
        <td align=\"right\">".$row['1st']."</td>
        <td align=\"right\">".$row['2nd']."</td>
        <td align=\"right\">".$row['3rd']."</td>
        <td>".$row['1st']."</td>");
        echo("<td>");
       /*if($row['1st'] > $row['2nd']) {
            //echo($row['2nd']. " l/min");
            echo(ROUND($pef_euN, 0));
        }*/
        if($row['userSex'] == "m") { 
            if($ka > $goodM) {
                //echo($ka);
                echo '<span style="color:green; font-weight: bold;">'.ROUND($ka, 0).'</span>';
            }elseif($ka >= $badM && $ka <= $goodM) {
                //echo($ka);
                echo '<span style="color:DarkOrange;  font-weight: bold;">'.ROUND($ka, 0).'</span>';
            }elseif($ka < $badM) {
                //echo($ka);
                echo '<span style="color:red;  font-weight: bold;">'.ROUND($ka, 0).'</span>';
            }else {
                echo(ROUND($ka, 0));
            }
        }

        if($row['userSex'] == "n") {
            if($ka > $goodN) {
                
                echo '<span style="color:green; font-weight: bold;">'.ROUND($ka, 0).'</span>';
            }elseif($ka >= $badN && $ka <= $goodN) {
                //echo($ka);
                echo '<span style="color:DarkOrange;  font-weight: bold;">'.ROUND($ka, 0).'</span>';
            }elseif($ka < $badN) {
                //echo($ka);
                echo '<span style="color:red;  font-weight: bold;">'.ROUND($ka, 0).'</span>';
            }else {
                echo(ROUND($ka, 0));
            }
        }

    
        echo("</td></tr>");

    }
echo("</table><br/>");

?>

<?php
    // sql kysely oireille ja triggereille
$dataOireet['userID']=$currentUserID;
$sqlOireet="SELECT * FROM `oireet`
WHERE userID = :userID ORDER BY oireDate DESC LIMIT 10";
    $kyselyOireet=$DBH->prepare($sqlOireet);				
    $kyselyOireet->execute($dataOireet);
    echo ("<p><h3>Oireet ja laukaisijat (Näytetään 10 viimeisintä):</h3></p>");

       echo("<table>
            <tr>
                <th>ajankohta</th>
                <th>oireet</th>
                <th>laukaisijat</th>
                <th>lisätiedot</th>

            

            </tr>");
            //tulostetaan valitut oireet, jotka eivät ole null
        while	($row=$kyselyOireet->fetch()){	
                $formatted_datetime = date("d.m.y, H:i", strtotime($row['oireDate']));
                echo("<tr><td><ul><li>".$formatted_datetime."</li></ul></td>");
                echo("<td>");
                echo("<ul>");
                if(strlen($row['cough']) > 1) {
                    echo("<li>".$row['cough']."</li>");
                }
                if(strlen($row['sniffle']) > 1) {
                    echo"<li>".($row['sniffle']."</li>");
                }
                if(strlen($row['shortBreath']) > 1) {
                    echo"<li>".($row['shortBreath']."</li>");
                }
                if(strlen($row['slime']) > 1) {
                    echo("<li>".$row['slime']."</li>");
                }
                if(strlen($row['wheeze']) > 1) {
                    echo("<li>".$row['wheeze']."</li>");
                }
                echo("</ul>");
                echo("</td>");
                echo("<td>");
                echo("<ul>");
                // tulostetaan valitut triggerit, jotka eivät ole null
                if(strlen($row['animal']) > 1) {
                    echo("<li>".$row['animal']."</li>");
                }
                if(strlen($row['dust']) > 1) {
                    echo("<li>".$row['dust']."</li>");
                }
                if(strlen($row['pollen']) > 1) {
                    echo("<li>".$row['pollen']."</li>");
                }
                if(strlen($row['smoking']) > 1) {
                    echo("<li>".$row['smoking']."</li>");
                }
                if(strlen($row['medication']) > 1) {
                    echo("<li>".$row['medication']."</li>");
                }
                if(strlen($row['fever']) > 1) {
                    echo("<li>".$row['fever']."</li>");
                }
                if(strlen($row['coldAir']) > 1) {
                    echo("<li>".$row['coldAir']."</li>");
                }
                if(strlen($row['sports']) > 1) {
                    echo("<li>".$row['sports']."</li>");
                }
                if(strlen($row['stress']) > 1) {
                    echo("<li>".$row['stress']."</li>");
                }
                if(strlen($row['flavor']) > 1) {
                    echo("<li>".$row['flavor']."</li>");
                }
                if(strlen($row['alcohol']) > 1) {
                    echo("<li>".$row['alcohol']."</li>");
                }
                if(strlen($row['noTriggers']) > 1) {
                    echo("<li>".$row['noTriggers']."</li>");
                }
                echo("</ul>");
                echo("</td>");
                echo("<td>");
                echo("<ul>");
                // tulostetaan vapaana tekstinä kirjoitettu lisätieto, jos se ei ole null
                if(strlen($row['oireText']) > 1) {
                    echo("<li>".$row['oireText']."</li>");
                }
                if(strlen($row['triggerText']) > 1) {
                    echo("<li>".$row['triggerText']."</li>");
                }
                echo("</ul>");
                echo("</td>");
                //tähän triggerit samalla tavalla
                echo("</tr>");
            }
        echo("</table><br/>");

?>

<?php
/*$dataOireCount['userID'] = $currentUserID;
$sqlOireCount = "SELECT count(cough)  FROM `oireet` WHERE userID = :userID";
$kyselyOireCount=$DBH->prepare($sqlOireCount);
$kyselyOireCount->execute($dataOireCount);				

echo ("<p><h3>Oireiden lukumäärät:</h3></p>");

while	($row=$kyselyOireCount->fetch()){	
        $count=$row['cough'];
        echo(intval($count));
    }

*/
?>
<br/>
<?php include("includes/ifooter.php");?>
