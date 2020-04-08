
    	<form method="post"> <!--Palataan oletuksena samalle sivulle-->

        <label for="measure"><b>1. mittaus</b></label>
            <input type="number" name="given1st" placeholder="Syötä mittausarvo" value="<?php echo isset($_POST['given1st']) ? $_POST['given1st'] : '' ?>" />

        <label for="measure"><b>2. mittaus</b></label>
            <input type="number" name="given2nd" placeholder="Syötä mittausarvo" value="<?php echo isset($_POST['given2nd']) ? $_POST['given2nd'] : '' ?>" />

        <label for="measure"><b>3. mittaus</b></label>
            <input type="number" name="given3rd" placeholder="Syötä mittausarvo" value="<?php echo isset($_POST['given3rd']) ? $_POST['given3rd'] : '' ?>" />
    
        <button type="submit" name="submitPefData1" id="button1">Jatka</button>
        <!--<button type="reset">Tyhjennä</button>-->

    	</form>