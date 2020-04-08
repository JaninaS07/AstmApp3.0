
<?php include_once("includes/iheader.php"); ?>
    <head>
        <script>
            function disableSubmit() {
            document.getElementById("button1").disabled = true;
            }

            //aktivoi buttonin, kun elementti ruksattu
            function activateButton(element) {

            if(element.checked) {
                document.getElementById("button1").disabled = false;
            }
            else  {
                document.getElementById("button1").disabled = true;
            }

            }
        </script>
    </head>

<!--Infoa sovelluksesta ja GDPR. Jatka-buttoni disable, kun sivu latautuu -->
<body onload="disableSubmit()">

<div class="infocontainer">
    <h2>Tietoa sovelluksesta</h2>

    <div class="info">
    
    AstmApp on websovellus, joka on tarkoitettu astmaatikoille. Sovellukseen voit kirjata PEF-mittaustulokset ennen ja jälkeen
    lääkkeenoton. Mittauksia yhdellä kerralla suoritetaan kolme, mutta maksimissaan viisi. Näistä kirjatuista 
    tuloksista kolme parasta tallennetaan tietokantaan. AstmApp-sovellusta voi käyttää oirepäiväkirjana. 
    Oireet ja niiden aiheuttajat tallennetaan tietokantaan. Mittaustuloksista ja oireista luodaan yhteenveto,
    jonka voi tarvittaessa tulostaa. Sovellus sisältää myös hengitys- ja meditaatioharjoituksia sekä linkkejä, 
    joista saat lisätietoa astmasta ja sen hoidosta.
    
    </div>

    <h2>Käyttöehdot</h2>

    <div class="border">
            
        <p>
            Rekisteri- ja tietosuojaseloste (malli)
            Tämä on Leftovers Oy:n henkilötietolain (10 ja 24 §) ja EU:n yleisen tietosuoja-asetuksen (GDPR) mukainen rekisteri- ja tietosuojaseloste.
            Laadittu 01.04.2020. Viimeisin muutos 01.04.2020.
        </p>

            
        <p>
            1. Rekisterinpitäjä
            Leftovers Oy, Jokukatu 8, 00100 Helsinki

            leftovers@leftovers.com
        </p>

            
        <p>
            2. Rekisteristä vastaava yhteyshenkilö
            Mohammad Kebab, moham.kebab@leftovers.com, +358 40 123456
        </p>
            
        <p>
            3. Rekisterin nimi
            Verkkopalvelun käyttäjärekisteri
        </p>
            
        <p>
            4. Oikeusperuste ja henkilötietojen käsittelyn tarkoitus
            EU:n yleisen tietosuoja-asetuksen mukainen oikeusperuste henkilötietojen käsittelylle on
            - henkilön suostumus (dokumentoitu, vapaaehtoinen, yksilöity, tietoinen ja yksiselitteinen)
            - sopimus, jossa rekisteröity on osapuolena
            - laki (mikä)
            - julkisen tehtävän hoitaminen (mihin perustuu), tai
            - rekisterinpitäjän oikeutettu etu (esim. asiakassuhde, työsuhde, jäsenyys).

            Henkilötietojen käsittelyn tarkoitus on yhteydenpito asiakkaisiin, asiakassuhteen ylläpito, markkinointi tms.

            Tietoja ei käytetä automatisoituun päätöksentekoon tai profilointiin. 
        </p>
            
        <p>
            5. Rekisterin tietosisältö
            Rekisteriin tallennettavia tietoja ovat: yhteystiedot (sähköpostiosoite), www-sivustojen osoitteet, verkkoyhteyden IP-osoite,
            tunnukset/profiilit sosiaalisen median palveluissa, tiedot tilatuista palveluista ja niiden muutoksista, muut asiakassuhteeseen ja tilattuihin palveluihin liittyvät tiedot.

            Kerro tässä myös tietojen säilytysaika, mikäli mahdollista. Kerro myös, jos tiedot esimerkiksi anonymisoidaan tietyn ajan kuluttua.
        </p>
            
        <p>
            6. Säännönmukaiset tietolähteet
            Rekisteriin tallennettavat tiedot saadaan asiakkaalta mm. www-lomakkeilla lähetetyistä viesteistä, sähköpostitse, puhelimitse,
            sosiaalisen median palvelujen kautta, sopimuksista, asiakastapaamisista ja muista tilanteista, joissa asiakas luovuttaa tietojaan.
        </p>
            
        <p>
            7. Tietojen säännönmukaiset luovutukset ja tietojen siirto EU:n tai ETA:n ulkopuolelle
            Tietoja ei luovuteta säännönmukaisesti muille tahoille.
        </p>
            
        <p>
            8. Rekisterin suojauksen periaatteet
            Rekisterin käsittelyssä noudatetaan huolellisuutta ja tietojärjestelmien avulla käsiteltävät tiedot suojataan asianmukaisesti. 
            Kun rekisteritietoja säilytetään Internet-palvelimilla, niiden laitteiston fyysisestä ja digitaalisesta tietoturvasta huolehditaan
            asiaankuuluvasti. Rekisterinpitäjä huolehtii siitä, että tallennettuja tietoja sekä palvelimien käyttöoikeuksia ja 
            muita henkilötietojen turvallisuuden kannalta kriittisiä tietoja käsitellään luottamuksellisesti ja vain niiden työntekijöiden 
            toimesta, joiden työnkuvaan se kuuluu.
        </p>
            
        <p>
            9. Tarkastusoikeus ja oikeus vaatia tiedon korjaamista
            Jokaisella rekisterissä olevalla henkilöllä on oikeus tarkistaa rekisteriin tallennetut tietonsa ja vaatia mahdollisen virheellisen 
            tiedon korjaamista tai puutteellisen tiedon täydentämistä. Mikäli henkilö haluaa tarkistaa hänestä tallennetut tiedot tai 
            vaatia niihin oikaisua, pyyntö tulee lähettää kirjallisesti rekisterinpitäjälle. Rekisterinpitäjä voi pyytää tarvittaessa pyynnön 
            esittäjää todistamaan henkilöllisyytensä. Rekisterinpitäjä vastaa asiakkaalle EU:n tietosuoja-asetuksessa säädetyssä ajassa 
            (pääsääntöisesti kuukauden kuluessa).
        </p>
            
        <p>
            10. Muut henkilötietojen käsittelyyn liittyvät oikeudet
            Rekisterissä olevalla henkilöllä on oikeus pyytää häntä koskevien henkilötietojen poistamiseen rekisteristä 
            ("oikeus tulla unohdetuksi"). Niin ikään rekisteröidyillä on muut EU:n yleisen tietosuoja-asetuksen mukaiset oikeudet 
            kuten henkilötietojen käsittelyn rajoittaminen tietyissä tilanteissa. Pyynnöt tulee lähettää kirjallisesti rekisterinpitäjälle. 
            Rekisterinpitäjä voi pyytää tarvittaessa pyynnön esittäjää todistamaan henkilöllisyytensä. Rekisterinpitäjä vastaa asiakkaalle
            EU:n tietosuoja-asetuksessa säädetyssä ajassa (pääsääntöisesti kuukauden kuluessa).
        </p>
    </div>
    <br/>
    <!-- Hyväksytään käyttöehdot ja siirrytään pääsivulle -->
    <div>
            <input type="checkbox" name="terms" id="terms" onchange="activateButton(this)">  Hyväksyn käyttöehdot
            <br><br>

        <form method="post" action="register.php">
            <button type="submit" name="submit" id="button1" class="button">Jatka</button>
        </form>

        <form method="post">
            <button type="submit" id="button2" name="submitBackDestroy"><?= _RETURNHOME ?></button>
        </form>
    
    </div>
        </div>
    <div>
            <?php include_once("includes/ifooter.php"); ?>
    </div>
