<?php 
//start de sesiune
session_start();
//conectare la baza de date
if (isset($_POST['username']) && isset($_POST['password'])) {
$username = $_POST['username'];
$password = $_POST['password'];

include ("connection.php"); 

$query = "SELECT username , password , statut FROM utilizator WHERE username='$username' AND password=md5('$password') AND statut = 0";
$result = mysql_query($query);
if (mysql_fetch_array($result)) {
       $_SESSION['valid_user'] = $username;}
// Inchidere conexiune
mysql_close($connection);	   
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Content Management System</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>

<?php
if (isset($_SESSION['valid_user']))  {
   echo '<h1>Esti logat ca: <b>'.$_SESSION['valid_user'].'</b></h1><br>';
   //meniu
   echo '<table border="0" align="center"><tr><td>';
   echo '<div class="meniu"><div class="sus"><div class="ne"> Produse </div></div><div class="mijloc"><div class="mne">';
   echo '<a href="adauga_produs.php">Adauga produs</a><br>';
   echo '<a href="modifica_produs.php">Modifica produs</a><br>';
   echo '<a href="sterge_produs.php">Sterge produs</a>';
   echo '</div></div><div class="jos"></div></div></td>';
   //meniu categorii
   echo '<td><div class="meniu"><div class="sus"><div class="ne"> Categorii </div></div><div class="mijloc"><div class="mne">';
   echo '<a href="adauga_categorie.php">Adauga categorie</a><br>';
   echo '<a href="modifica_categorie.php">Modifica categorie</a><br>';
   echo '<a href="sterge_categorie.php">Sterge categorie</a><br>';
   echo '</div></div><div class="jos"></div></div></td></tr>';   
   //meniu cont
   echo '<tr><td><div class="meniu"><div class="sus"><div class="ne"> Cont </div></div><div class="mijloc"><div class="mne">';
   echo '<a href="logout.php">Log out</a><br>';
   echo '<a href="creeaza_cont.php">Creeaza cont nou</a><br>';
   echo '<a href="modifica_cont.php">Modifica cont</a><br>';
   echo '<a href="sterge_cont.php">Stergere cont</a><br>';
   echo '</div></div><div class="jos"></div></div></td>';
   //meniu comenzi
   echo '<td><div class="meniu"><div class="sus"><div class="ne"> Comenzi </div></div><div class="mijloc"><div class="mne">';
   echo '<a href="prelucrare_comenzi.php">Prelucrare comenzi</a><br>';
   echo '<a href="comenzi_onorate.php">Comenzi onorate</a><br><br><br>';
   echo '</div></div><div class="jos"></div></div></td></tr></table>'; 
   }
   
else {
 if (isset($username)){ //formular pentru cazul in care username-ul sau parola sunt introduse incorect
  echo '<div align="center"><div class="mare"><div class="sus"><div class="ne"> Log in </div></div><div class="mijloc"><div class="mne">';
   echo "Nu va puteti loga.Username sau parola incorecte<br><br>";
   echo '<form method="POST" action="index.php">';
echo'<br>Username: <input type="text" name="username"><br>';
echo'Password: <input type="password" name="password"><br><br>';
echo '<input type="submit" value="Log in" style="width:80px"></form>';
 echo '</div></div><div class="jos"></div></div></div>';
   }
   else { // formular pentru cazul in care nu a fost introdus un user sau o parola
    echo '<div align="center"><div class="mare"><div class="sus"><div class="ne"> Log in </div></div><div class="mijloc"><div class="mne">';
   echo "Nu sunteti logat. Introduceti username-ul si parola<br><br>";
   echo '<form method="POST" action="index.php">';
echo'<br>Username: <input type="text" name="username"><br>';
echo'Password: <input type="password" name="password"><br><br>';
echo '<input type="submit" value="Log in" style="width:80px"></form>';
 echo '</div></div><div class="jos"></div></div></div>';
   }
  }
?>

</body>
</html>
