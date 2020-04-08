
<?php
//kirjautuneen käyttäjän userID?
   $data3['email'] = $_SESSION['suserEmail'];
   $sql3 = "SELECT userID FROM users where userEmail =  :email";
   $kysely3=$DBH->prepare($sql3);
   $kysely3->execute($data3);
   $tulos2=$kysely3->fetch();
   $currentUserID=$tulos2[0];
   ?>
<?php
   if(isset($_POST['submitSave'])){
      try {
       $data4['medsInfo']=$_SESSION['medsInfo'];
       $data4['1st']=$_SESSION['1st'];
       $data4['2nd']=$_SESSION['2nd'];
       $data4['3rd']=$_SESSION['3rd'];
       $data4['userID']=$currentUserID;
       $sql5="INSERT INTO peakFlow (medsInfo, 1st, 2nd, 3rd, userID)
       VALUES (:medsInfo, :1st, :2nd, :3rd, :userID);";
        $kysely4 = $DBH->prepare($sql5); 
        $kysely4->execute($data4);
        unset($_SESSION['1st']); // tuhotaan kaikki sessio muuttujat
        unset($_SESSION['2nd']);
        unset($_SESSION['3rd']);
        unset($_SESSION['4th']);
        unset($_SESSION['5th']);
        unset($_SESSION['medsInfo']);
          //Palataan takaisin tälle sivulle
          header("Location: index.php");
      } catch(PDOException $e) {
       file_put_contents('log/DBErrors.txt', 'index.php: '.$e->getMessage()."\n", FILE_APPEND);
      }
     }
 // jos painetaan tallenna mittaukset -nappulaa, siirretään tiedot databaseen
   /* if (isset($_POST['submitSave'])){

        //Parametrit taulukkona array
       $data =  ["medsInfo"=>$_SESSION['medsInfo'],
                 "1st"=>$_SESSION['1st'],
                 "2nd"=>$_SESSION['2nd'],
                 "3rd"=>$_SESSION['3rd']];
    
        try{
          //kysely
           $stmt = $DBH->prepare("INSERT INTO peakFlow (medsInfo, 1st, 2nd, 3rd)
           VALUES (:medsInfo, :1st, :2nd, :3rd)");
          $stmt->execute($data);
        
        unset($_SESSION['1st']); // tuhotaan kaikki sessio muuttujat
        unset($_SESSION['2nd']);
        unset($_SESSION['3rd']);
        unset($_SESSION['4th']);
        unset($_SESSION['5th']);
        unset($_SESSION['medsInfo']);
          //Palataan takaisin tälle sivulle
          header("Location: index.php");
        }catch(PDOException $e){
            echo "Tallennusvirhe: " . $e->getMessage(); 
            file_put_contents("DBErrors.txt", "DB saving: ".$e->getMessage()."\n", FILE_APPEND);
        }
    }*/
?>

