<form method="post" id="kirjaudu" autocomplete="off" autofill="off">

<div class="container">
    <label for="login"><b><?= _EMAIL ?></b></label>
    <input type="text" name="givenEmail" placeholder="<?= _EMAILINPUT ?>" maxlength="40"/>
    
  <label for="login"><b><?= _PASSWORD ?></b></label><label for="login" id="psw2"><b><a href="#"><?= _PASSWORDLOST ?></a></b></label>
    <input type="password" name="givenPassword" placeholder="<?= _PASSWORDINPUT ?>" maxlength="40"/>

    <div class="btn-group">
      <button type="submit" id="button1" name="submitUser"><?= _LOGIN ?></button>
  </form>

  <form method="post" action="info.php">
     <button type="submit" id="button2"><?= _REGISTER ?></button>
  </form>
    </div> 

</div>