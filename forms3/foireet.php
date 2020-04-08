<form method="POST">
<h2>Valitse oireet:</h3>
<h5 class="justified">Valitse alla olevasta listasta parhaiten tilannettasi kuvaavat oireet. Mikäli sinua vaivaava astmaoire ei löydy listalta, voit merkitä oireen vapaaseen tekstikenttään.</h5>

<div class="centered">
<div class="leftaligned">
<input type="checkbox" name="check_list[0]" value="yskä"><label>Yskä</label><br/>
<input type="checkbox" name="check_list[1]" value="tukkoisuus"><label>Tukkoisuus</label><br/>
<input type="checkbox" name="check_list[2]" value="hengenahdistus"><label>Hengenahdistus</label><br/>
<input type="checkbox" name="check_list[3]" value="limaisuus"><label>Limaneritys</label><br/>
<input type="checkbox" name="check_list[4]" value="hengityksen vinkuminen"><label>Hengityksen vinkuminen</label>
</div>
</div>
<br/>

<label for="symptoms"><b>Lisätiedot</span></b></label>
<textarea rows = "2" cols = "50" name = "givenOireet"></textarea>

<button type="submit" name="submitAddTriggers" id="button1">Tallenna & lisää laukaisijat</button>
<button type="submit" name="submitOireet" id="button1">Tallenna ilman laukaisijoita</button>
</form>

