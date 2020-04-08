<?php include("includes/iheader.php"); ?>
<div class="container">

    <?php

if(!isset($_POST['submitOireet']) && !isset($_POST['submitAddTriggers']) && !isset($_POST['submitTriggers'])) {
include("forms3/foireet.php");

}

//jos painettu "tallenna ilman triggereitä" -buttonia
//ja on valittu väh. 1 arvo checkboxista, niin siirretään tiedot sessioon
if(isset($_POST['submitOireet'])) {
        if(!empty($_POST['check_list'])){
            
            foreach($_POST['check_list'] as $key => $value){
             $_SESSION['check_list'] = $_POST['check_list'];
             $_SESSION['oireText'] = $_POST['givenOireet'];
            }
        } else {
            echo("<br/><br/><h3>valitse ensin oireet!</h3>");
            include("forms3/foireet.php");
        }
    } 
      
   /* if(isset($_SESSION['check_list'])) {
        echo("<h3>Valitsit seuraavat oireet:<br/></h3>");
        foreach($_SESSION['check_list'] as $value){
             echo("<br/> " .$value);
        }
        echo ("<br/><br/>" .$_SESSION['oireText']);
        //include("empty.php");
    }*/

    // jos o painettu "lisää triggerit" button
    //niin siirretään loopilla valuet sessioon ja näytetään oire-checkboxin valinnat
    if(isset($_POST['submitAddTriggers'])) {
        if(!empty($_POST['check_list'])){
            foreach($_POST['check_list'] as $key => $value){
                $_SESSION['check_list'] = $_POST['check_list'];
                $_SESSION['oireText'] = $_POST['givenOireet'];
               }
            if(isset($_SESSION['check_list'])) {
                echo("<h3>Valitsit seuraavat oireet:</h3>");
                    foreach($_SESSION['check_list'] as $value){
                    echo("<br/> " .$value);
                    }
                }
                echo ("<h5>Lisätiedot:</h5>" .$_SESSION['oireText']);
                include("forms3/ftriggerit.php");

        }else {
            echo("<br/><br/><h3>valitse ensin oireet!</h3>");
            include("forms3/foireet.php");
        }
    }
     
    //jos on painettu tallenna ja on valittu oireita
    //niin lisätään triggerit sessioon
    if(isset($_POST['submitTriggers']) && isset($_SESSION['check_list'])) {
        if(!empty($_POST['check'])){
            foreach($_POST['check'] as $key => $arvo){
             $_SESSION['check'] = $_POST['check'];
             $_SESSION['triggerText']=$_POST['givenTrigger'];
    
            }
           
        } else {
            echo("<br/><br/><h4>valitse ensin oireita laukaisevat tekijät!</h4>");
            include("forms3/ftriggerit.php");
        }
    } 


   /*if(isset($_SESSION['check'])) {
        echo("<h3>Valitsit seuraavat triggerit:<br/></h3>");
        foreach($_SESSION['check'] as $arvo){
             echo("<br/> " .$arvo);
        }
        echo ("<br/><br/>" .$_SESSION['triggerText']);
        include("forms3/tallenna.php");
    }*/
    
?>
<?php
    include("forms3/tuhoaTiedot.php");
?>

<?php

    if(isset($_POST['submitDestroyKaikki'])) {
        unset($_SESSION['check_list']); // tuhotaan kaikki sessio muuttujat
        unset($_SESSION['check']);
       
        // palataan takaisin tälle samalle sivulle, jolloin sessio käynnistyy uudelleen
        header("Location: " . $_SERVER['PHP_SELF']);
    }
    
?>




<?php
//kirjautuneena käyttäjän userID?
   $data1['email'] = $_SESSION['suserEmail'];
   $sql10 = "SELECT userID FROM users where userEmail =  :email";
   $kysely2=$DBH->prepare($sql10);
   $kysely2->execute($data1);
   $tulos2=$kysely2->fetch();
   $currentUserID1=$tulos2[0];
   ?>

<?php
    // jos on painettu tallenna ilman triggereitä&lisätty sessiomuuttujat 
    // tai jos on painettu tallenna oireet ja triggerit&lisätty triggerit
    // niin lähetetään tiedot kantaan
    if (isset($_POST['submitOireet']) && isset($_SESSION['check_list']) || isset($_POST['submitTriggers']) && isset($_SESSION['check'])){
        try{
       /* $dataOire1=["oireText"=>$_SESSION['oireText'],
            "cough"=>$_SESSION['check_list'][0],     
        "sniffle"=>$_SESSION['check_list'][1],
        "shortBreath"=>$_SESSION['check_list'][2],
        "slime"=>$_SESSION['check_list'][3],
        "wheeze"=>$_SESSION['check_list'][4],
        "triggerText"=>$_SESSION['triggerText'],
        "animal"=>$_SESSION['check'][0],
        "dust"=>$_SESSION['check'][1],
        "pollen"=>$_SESSION['check'][2],
        "perfume"=>$_SESSION['check'][3],
        "smoking"=>$_SESSION['check'][4],
        "medication"=>$_SESSION['check'][5],
        "fever"=>$_SESSION['check'][6],
        "coldAir"=>$_SESSION['check'][7],
        "sports"=>$_SESSION['check'][8],
        "stress"=>$_SESSION['check'][9],
        "flavor"=>$_SESSION['check'][10],
        "alcohol"=>$_SESSION['check'][11]];*/
        $dataOire1['oireText']=$_SESSION['oireText'];
        $dataOire1['cough']=$_SESSION['check_list'][0];
        $dataOire1['sniffle']=$_SESSION['check_list'][1];
        $dataOire1['shortBreath']=$_SESSION['check_list'][2];
        $dataOire1['slime']=$_SESSION['check_list'][3];
        $dataOire1['wheeze']=$_SESSION['check_list'][4];
        $dataOire1['triggerText']=$_SESSION['triggerText'];
        $dataOire1['animal']=$_SESSION['check'][0];
        $dataOire1['dust']=$_SESSION['check'][1];
        $dataOire1['pollen']=$_SESSION['check'][2];
        $dataOire1['perfume']=$_SESSION['check'][3];
        $dataOire1['smoking']=$_SESSION['check'][4];
        $dataOire1['medication']=$_SESSION['check'][5];
        $dataOire1['fever']=$_SESSION['check'][6];
        $dataOire1['coldAir']=$_SESSION['check'][7];
        $dataOire1['sports']=$_SESSION['check'][8];
        $dataOire1['stress']=$_SESSION['check'][9];
        $dataOire1['flavor']=$_SESSION['check'][10];
        $dataOire1['alcohol']=$_SESSION['check'][11];
        $dataOire1['noTriggers']=$_SESSION['check'][12];
     //"noTriggers"=>$_SESSION['check'][12]
        $dataOire1['userID']=$currentUserID1;
    
      //kysely
       $sqlOire1="INSERT INTO oireet (oireText, cough, sniffle, shortBreath, slime, wheeze, triggerText, animal, dust, pollen, perfume, smoking, medication, fever, coldAir, sports, stress, flavor, alcohol, noTriggers, userID)
       VALUES (:oireText, :cough, :sniffle, :shortBreath, :slime, :wheeze, :triggerText, :animal, :dust, :pollen, :perfume, :smoking, :medication, :fever, :coldAir, :sports, :stress, :flavor, :alcohol, :noTriggers, :userID);";
      $kyselyOire1 = $DBH->prepare($sqlOire1); 
      $kyselyOire1->execute($dataOire1);
      unset($_SESSION['check_list']);
      unset($_SESSION['check']);
      //Palataan takaisin tälle sivulle
      header("Location: ". $_SERVER['PHP_SELF']);
    }catch(PDOException $e){
        echo "Tallennusvirhe: " . $e->getMessage(); 
        file_put_contents("DBErrors.txt", "DB saving: ".$e->getMessage()."\n", FILE_APPEND);
    }
}
        
?>
<main>
<?php
    // sql kyselyt
$dataOireet['userID']=$currentUserID1;
$sqlOireet="SELECT * FROM `oireet`
WHERE userID = :userID ORDER BY oireDate DESC LIMIT 3";
    $kyselyOireet=$DBH->prepare($sqlOireet);				
    $kyselyOireet->execute($dataOireet);
    echo ("<p><h3>Edelliset merkinnät:</h3></p>");

       echo("<table>
            <tr>
                <th>ajankohta</th>
                <th>oireet</th>
                <th>laukaisijat</th>
                <th>lisätiedot</th>

            

            </tr>");
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
</div>
<?php include("includes/ifooter.php"); ?>