<?php
//start de sesiune
session_start();
$old_user = $_SESSION['valid_user']; //atribuim in $old_user variabila din sesiune
unset($_SESSION['valid_user']); //scoatem din sesiune userul valid,daca exista
//distrugere sesiune de lucru
session_destroy();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Log Out</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<?php
//conditie pentru verificarea utilizatorului
if (!empty($old_user))  
 { echo '<div align="center"><div class="mare"><div class="sus"><div class="ne"> Log out </div></div><div class="mijloc"><div class="mne">';
   echo 'Nu mai sunteti logat . Click <a href="index.php">aici</a> pentru a va intoarce la pagina principala';  //delogare
   echo '</div></div><div class="jos"></div></div></div>';
   }
 else { // mesaj pentru cazul in care nu ati fost logat,dar totusi ati ajuns la aceasta pagina
   echo '<div align="center"><div class="mare"><div class="sus"><div class="ne"> Nu sunteti logat </div></div><div class="mijloc"><div class="mne">';
   echo 'Nu sunteti logat. Pentru a va loga, accesati pagina de <a href="index.php">Log in</a>';  
   echo '</div></div><div class="jos"></div></div></div>';}                                      
?>

</body>
</html>