    //aktivoi buttonin, kun elementti ruksattu
    function activateButton(element) {

        if(element.checked) {
            document.getElementById("button1").disabled = false;
        }
        else  {
            document.getElementById("button1").disabled = true;
        }

        }