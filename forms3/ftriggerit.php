<form method="POST">
<h2>Valitse oireisiin liittyvät laukaisevat tekijät</h2>
<h5 class="justified">Valitse alla olevasta listasta astmaoireisiisi liittyvät oireita laukaisevat tekijät. 
Jos listalta ei löydy sopivaa valintaa, valitse "muu, mikä?" ja kirjoita vastauksesi tekstikenttään.</h5>

<div class="centered">
<div class="leftaligned">
<input type="checkbox" name="check[0]" value="eläin"><label>Eläinkontakti</label><br/>
<input type="checkbox" name="check[1]" value="pöly"><label>Pöly</label><br/>
<input type="checkbox" name="check[2]" value="siitepöly"><label>Siitepöly</label><br/>
<input type="checkbox" name="check[3]" value="tuoksut tai hajusteet"><label>Tuoksut ja hajusteet</label><br/>
<br/>
<input type="checkbox" name="check[4]" value="tupakointi"><label>Tupakointi</label><br/>
<input type="checkbox" name="check[5]" value="lääkkeet"><label>Lääkkeet</label><br/>
<input type="checkbox" name="check[6]" value="kuume/flunssa"><label>Kuume/flunssa</label><br/>
<input type="checkbox" name="check[7]" value="kylmä ilma"><label>Kylmä ilma</label><br/>
<br/>
<input type="checkbox" name="check[8]" value="urheilusuoritus"><label>Urheilusuoritus</label><br/>
<input type="checkbox" name="check[9]" value="stressi"><label>Stressi</label><br/>
<input type="checkbox" name="check[10]" value="ruoka ja mausteet"><label>Ruoka ja mausteet</label><br/>
<input type="checkbox" name="check[11]" value="alkoholi"><label>Alkoholi</label><br/>
<br/>
<input type="checkbox" name="check[12]" value="muu"><label>Muu, mikä?</label>
</div>
</div>
<br/>
<br/>
<p>
   Lisätiedot:
  <br />  
  <textarea rows = "2" cols = "50" name = "givenTrigger"></textarea>
  </p><br/>
<br/>
<button type="submit" name="submitTriggers" id="button1">Tallenna oireet ja laukaisijat</button>
</form>
