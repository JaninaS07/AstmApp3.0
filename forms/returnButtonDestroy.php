
<!-- Kaikki kuolee -->
<?php if(isset($_POST['submitBackDestroy'])){
session_unset();
session_destroy();
header("Location: index.php");
}?>