<?php
  // Set Language variable
if(isset($_GET['lang']) && !empty($_GET['lang'])){
 $_SESSION['lang'] = $_GET['lang'];

 if(isset($_SESSION['lang']) && $_SESSION['lang'] != $_GET['lang']){
  echo "<script type='text/javascript'> location.reload(); </script>";
 }
}

// Include Language file
if(isset($_SESSION['lang'])){
 include "languages/lang_".$_SESSION['lang'].".php";
}else{
 include "languages/lang_fi.php";
}
?>

 <script>
 function changeLang(){
  document.getElementById('form_lang').submit();
 }
 </script>

 <!-- Language -->

 <form method='get' action='' id='form_lang' >
 <img src="<?php echo $flag; ?>" alt="flag" class="flag"/>
   <select name='lang' id='select_lang' onchange='changeLang();' >
   <option value='fi' <?php if(isset($_SESSION['lang']) && $_SESSION['lang'] == 'fi'){ echo "selected"; } ?> >FI</option>
   <option value='en' <?php if(isset($_SESSION['lang']) && $_SESSION['lang'] == 'en'){ echo "selected"; } ?> >EN</option>
  </select>
 </form>