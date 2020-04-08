<form method="post" id="rekisteroi" autocomplete="off" autofill="off">

<h2><?= _CREATEACCOUNTTITLE ?></h2>

<p id="asteriskinfo"><?= _CREATEACCOUNTINFO ?></p>

<?php
//Lomakkeen submit painettu?
if(isset($_POST['submitUser'])){
  //Tarkistetaan syötteet myös palvelimella
  if(strlen($_POST['givenUsername'])<4){
   $_SESSION['swarningInput']="Käyttäjätunnus puuttuu.";
  }else if(!filter_var($_POST['givenEmail'], FILTER_VALIDATE_EMAIL)){
   $_SESSION['swarningInput']="Antamasi sähköposti ei kelpaa.";
  }else if(strlen($_POST['givenPassword'])<8){
  $_SESSION['swarningInput']="Salasana puuttuu.";
  }else if(!$_POST['givenPassword'] == $_POST['givenPasswordVerify']){
  $_SESSION['swarningInput']="Kirjoita antamasi salasana uudestaan.";
  }else{
  unset($_SESSION['swarningInput']);
  //1. Tiedot sessioon
  $_SESSION['suserName']=$_POST['givenUsername'];
  // $_SESSION['sloggedIn']="yes";
  $_SESSION['semail']= $_POST['givenEmail'];
  //2. Tiedot kantaan

  $data['name'] = $_POST['givenUsername'];
  $data['email'] = $_POST['givenEmail'];
  $data['sex'] = $_POST['givenSex'];
  $data['height'] = $_POST['givenHeight'];
  $data['area'] = $_POST['givenArea'];
  $data['dob'] = $_POST['givenYear'] . "-" . $_POST['givenMonth'] . "-" . $_POST['givenDay'];

  $added='#â‚¬%&&/'; //suolataan annettu salasana
  $data['pwd'] = password_hash($_POST['givenPassword'].$added, PASSWORD_BCRYPT);
  try {
    //***Email ei saa olla käytetty aiemmin
    $sql = "SELECT COUNT(*) FROM users where userEmail  =  " . "'".$_POST['givenEmail']."'"  ;
    $kysely=$DBH->prepare($sql);
    $kysely->execute();				
    $tulos=$kysely->fetch();
    if($tulos[0] == 0){ //email ei ole käytössä
     $STH = $DBH->prepare("INSERT INTO users (userName, userEmail, userPwd, userSex, userHeight, userArea, userDOB) VALUES (:name, :email, :pwd, :sex, :height, :area, :dob);");
     $STH->execute($data);

     header("Location: index.php"); //Palataan pääsivulle kirjautuneena
    }else{
      $_SESSION['swarningInput']="Sähköposti on jo käytössä.";
    }
  } catch(PDOException $e) {
    file_put_contents('log/DBErrors.txt', 'signInUser.php: '.$e->getMessage()."\n", FILE_APPEND);
    $_SESSION['swarningInput'] = 'Tietokantavirhe.';
    
  }
}
}
?>

<?php
  //Näytetäänkö lomakesyötteen aiheuttama varoitus?
  if(isset($_SESSION['swarningInput'])){
    echo("<p class=\"red\">". $_SESSION['swarningInput']."</p>");
    unset($_SESSION['swarningInput']);
  } else {
  }
?>

<div class="container">

  <label for="register"><b><span class="red">*</span> <?= _USERNAME ?></span></b></label>
    <input type="text" name="givenUsername" placeholder="<?= _USERNAMEINPUT ?>" maxlength="40" minlength="4" value="<?php echo isset($_POST['givenUsername']) ? $_POST['givenUsername'] : '' ?>"/>

  <label for="register"><b><span class="red">*</span> <?= _EMAIL ?></b></label>
    <input type="text" name="givenEmail" placeholder="<?= _EMAILCREATEINPUT ?>" maxlength="40" value="<?php echo isset($_POST['givenEmail']) ? $_POST['givenEmail'] : '' ?>"/>
  
  <label for="register"><b><span class="red">*</span> <?= _PASSWORD ?></span></b></label>
    <input type="password" name="givenPassword" placeholder="<?= _PASSWORDCREATEINPUT ?>" minlength="8" maxlength="40"/>
  
  <label for="register"><b><span class="red">*</span> <?= _PASSWORDAGAIN ?></span></b></label>
    <input type="password" name="givenPasswordVerify" placeholder="<?= _PASSWORDAGAININPUT ?>" minlength="8" maxlength="40"/>

  <label for="register"><b><span class="red">*</span> <?= _SEX ?></span></b></label>
    <select id="sex" name="givenSex" style="background-color: White">>
      <option value="mies"><?= _MALE ?></option>
      <option value="nainen"><?= _FEMALE ?></option>
    </select>

    <label for="register"><b><span class="red">*</span> <?= _HEIGHT ?></b></label>
    <input type="number" id="height" name="givenHeight" placeholder="<?= _HEIGHTINPUT ?>" value="<?php echo isset($_POST['givenHeight']) ? $_POST['givenHeight'] : '' ?>"/>

  <label for="register"><b><span class="red"></span><?= _CITY ?></span></b></label>
    <select id="area" name="givenArea" style="background-color: White">
      <option value="helsinki" style="background-color: White">Helsinki</option>
      <option value="nakkila" style="background-color: White">Nakkila</option>
    </select>

    <div class="control-group">
    <label for="register"><b><span class="red">*</span> <?= _BIRTHDATE ?></span></b></label>
  <div class="controls">
    <select name="givenDay" id="dob-day">
      <option value="" disabled selected><?= _BIRTHDATEDAY ?></option>
      <option value="01">01</option>
      <option value="02">02</option>
      <option value="03">03</option>
      <option value="04">04</option>
      <option value="05">05</option>
      <option value="06">06</option>
      <option value="07">07</option>
      <option value="08">08</option>
      <option value="09">09</option>
      <option value="10">10</option>
      <option value="11">11</option>
      <option value="12">12</option>
      <option value="13">13</option>
      <option value="14">14</option>
      <option value="15">15</option>
      <option value="16">16</option>
      <option value="17">17</option>
      <option value="18">18</option>
      <option value="19">19</option>
      <option value="20">20</option>
      <option value="21">21</option>
      <option value="22">22</option>
      <option value="23">23</option>
      <option value="24">24</option>
      <option value="25">25</option>
      <option value="26">26</option>
      <option value="27">27</option>
      <option value="28">28</option>
      <option value="29">29</option>
      <option value="30">30</option>
      <option value="31">31</option>
    </select>
    <select name="givenMonth" id="dob-month">
      <option value="" disabled selected><?= _BIRTHDATEMONTH ?></option>
      <option value="01"><?= _JANUARY ?></option>
      <option value="02"><?= _FEBRUARY ?></option>
      <option value="03"><?= _MARCH ?></option>
      <option value="04"><?= _APRIL ?></option>
      <option value="05"><?= _MAY ?></option>
      <option value="06"><?= _JUNE ?></option>
      <option value="07"><?= _JULY ?></option>
      <option value="08"><?= _AUGUST ?></option>
      <option value="09"><?= _SEPTEMBER ?></option>
      <option value="10"><?= _OCTOBER ?></option>
      <option value="11"><?= _NOVEMBER ?></option>
      <option value="12"><?= _DECEMBER ?></option>
    </select>
    <select name="givenYear" id="dob-year">
      <option value="" disabled selected><?= _BIRTHDATEYEAR ?></option>
      <option value="2012">2012</option>
      <option value="2011">2011</option>
      <option value="2010">2010</option>
      <option value="2009">2009</option>
      <option value="2008">2008</option>
      <option value="2007">2007</option>
      <option value="2006">2006</option>
      <option value="2005">2005</option>
      <option value="2004">2004</option>
      <option value="2003">2003</option>
      <option value="2002">2002</option>
      <option value="2001">2001</option>
      <option value="2000">2000</option>
      <option value="1999">1999</option>
      <option value="1998">1998</option>
      <option value="1997">1997</option>
      <option value="1996">1996</option>
      <option value="1995">1995</option>
      <option value="1994">1994</option>
      <option value="1993">1993</option>
      <option value="1992">1992</option>
      <option value="1991">1991</option>
      <option value="1990">1990</option>
      <option value="1989">1989</option>
      <option value="1988">1988</option>
      <option value="1987">1987</option>
      <option value="1986">1986</option>
      <option value="1985">1985</option>
      <option value="1984">1984</option>
      <option value="1983">1983</option>
      <option value="1982">1982</option>
      <option value="1981">1981</option>
      <option value="1980">1980</option>
      <option value="1979">1979</option>
      <option value="1978">1978</option>
      <option value="1977">1977</option>
      <option value="1976">1976</option>
      <option value="1975">1975</option>
      <option value="1974">1974</option>
      <option value="1973">1973</option>
      <option value="1972">1972</option>
      <option value="1971">1971</option>
      <option value="1970">1970</option>
      <option value="1969">1969</option>
      <option value="1968">1968</option>
      <option value="1967">1967</option>
      <option value="1966">1966</option>
      <option value="1965">1965</option>
      <option value="1964">1964</option>
      <option value="1963">1963</option>
      <option value="1962">1962</option>
      <option value="1961">1961</option>
      <option value="1960">1960</option>
      <option value="1959">1959</option>
      <option value="1958">1958</option>
      <option value="1957">1957</option>
      <option value="1956">1956</option>
      <option value="1955">1955</option>
      <option value="1954">1954</option>
      <option value="1953">1953</option>
      <option value="1952">1952</option>
      <option value="1951">1951</option>
      <option value="1950">1950</option>
      <option value="1949">1949</option>
      <option value="1948">1948</option>
      <option value="1947">1947</option>
      <option value="1946">1946</option>
      <option value="1945">1945</option>
      <option value="1944">1944</option>
      <option value="1943">1943</option>
      <option value="1942">1942</option>
      <option value="1941">1941</option>
      <option value="1940">1940</option>
      <option value="1939">1939</option>
      <option value="1938">1938</option>
      <option value="1937">1937</option>
      <option value="1936">1936</option>
      <option value="1935">1935</option>
      <option value="1934">1934</option>
      <option value="1933">1933</option>
      <option value="1932">1932</option>
      <option value="1931">1931</option>
      <option value="1930">1930</option>
      <option value="1929">1929</option>
      <option value="1928">1928</option>
      <option value="1927">1927</option>
      <option value="1926">1926</option>
      <option value="1925">1925</option>
      <option value="1924">1924</option>
      <option value="1923">1923</option>
      <option value="1922">1922</option>
      <option value="1921">1921</option>
      <option value="1920">1920</option>
      <option value="1919">1919</option>
      <option value="1918">1918</option>
      <option value="1917">1917</option>
      <option value="1916">1916</option>
      <option value="1915">1915</option>
      <option value="1914">1914</option>
      <option value="1913">1913</option>
      <option value="1912">1912</option>
      <option value="1911">1911</option>
      <option value="1910">1910</option>
      <option value="1909">1909</option>
      <option value="1908">1908</option>
      <option value="1907">1907</option>
      <option value="1906">1906</option>
      <option value="1905">1905</option>
      <option value="1904">1904</option>
      <option value="1903">1903</option>
      <option value="1901">1901</option>
      <option value="1900">1900</option>
    </select>
  </div>
</div>
</form>

<button type="submit" form="rekisteroi" id="button1" name="submitUser"><?= _CREATEACCOUNT ?></button>

<form method="post">
    <button type="submit" id="button2" name="submitBackDestroy"><?= _RETURNHOME ?></button>
</form>
</div>