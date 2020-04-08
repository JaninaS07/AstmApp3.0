<?php
    include_once("includes/iheader.php");
?>
<div class="container">
    
    <form method="post">
        <h3>Hengitysharjoitus</h3>
    
        <div>
            <button type="submit" name="submitStart" class="button" id="button1">Aloita harjoitus</button>
        </div>
       
            
            
            <?php
                if (isset($_POST['submitStart'])) {
                    include("animation.php");
                }
            ?> 
    
    </form>
        <div>
            <h3>Rentoutumisharjoituksia</h3>
        </div>


        <div>
            <iframe class="container" src="https://www.youtube.com/embed/cF68gVXtwdg" frameborder="0"
            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        
        <div>
            <iframe class="container" src="https://www.youtube.com/embed/6xl1Ss5SeZo" frameborder="0" 
            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>

        <div>
            <iframe class="container" src="https://www.youtube.com/embed/loLZIfXzReg" 
            frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" 
            allowfullscreen></iframe>
        </div>

        <div>
            <iframe class="container" src="https://www.youtube.com/embed/SoRE945WcSE" frameborder="0"
            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>
            </div>
    <div>
        <?php
        include_once("includes/ifooter.php")
        ?>
    </div>
    

