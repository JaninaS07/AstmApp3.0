<form method="post">
<div class="imgcontainer">
  <img src="images/AstmApp.svg" alt="Logo" class="avatar">
</div>

<?php
//Lomakkeen submit painettu?
if(isset($_POST['submitUser'])){
  //***Tarkistetaan email myös palvelimella
  if(!filter_var($_POST['givenEmail'], FILTER_VALIDATE_EMAIL)){
   $_SESSION['swarningInput']="AstmApp-tiliäsi ei löytynyt.";
  }else{
    unset($_SESSION['swarningInput']);  
     try {
      //Tiedot kannasta, hakuehto
      $data['email'] = $_POST['givenEmail'];
      $STH = $DBH->prepare("SELECT userName, userEmail, userPwd, userDOB FROM users WHERE userEmail = :email;");
      $STH->execute($data);
      $STH->setFetchMode(PDO::FETCH_OBJ);
      $tulosOlio=$STH->fetch();
      //lomakkeelle annettu salasana + suola
      $givenPasswordAdded = $_POST['givenPassword'].$added; //$added löytyy cconfig.php
 
       //Löytyikö email kannasta?   
       if($tulosOlio!=NULL){
          //email löytyi
          // var_dump($tulosOlio);
          if(password_verify($givenPasswordAdded,$tulosOlio->userPwd)){
              $_SESSION['sloggedIn']="yes";
              $_SESSION['suserName']=$tulosOlio->userName;
              $_SESSION['suserEmail']=$tulosOlio->userEmail;
              $_SESSION['suserDay']=$tulosOlio->userDay;
              $_SESSION['suserMonth']=$tulosOlio->userMonth;
              $_SESSION['suserYear']=$tulosOlio->userYear;
              header("Location: index.php"); //Palataan pääsivulle kirjautuneena
          }else{
            $_SESSION['swarningInput']="Väärä salasana.";
          }
      }else{
        $_SESSION['swarningInput']="Väärä sähköposti.";
      }
     } catch(PDOException $e) {
        file_put_contents('log/DBErrors.txt', 'signInUser.php: '.$e->getMessage()."\n", FILE_APPEND);
        $_SESSION['swarningInput'] = 'Tietokantaongelma.';
    }
  }
}
?>

<?php
  //***Näytetäänkö lomakesyötteen aiheuttama varoitus?
if(isset($_SESSION['swarningInput'])){
  echo("<p class=\"red\">". $_SESSION['swarningInput']."</p>");
  unset($_SESSION['swarningInput']);
} else {
}
?>

<!-- Sisäänkirjautumislomake -->
<?php include("forms/flogInUser.php");?>