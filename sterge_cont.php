<?php
session_start();
include ("connection.php"); 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Stergere cont</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<?php
if (isset($_SESSION['valid_user']))
 {  echo '<h1>Esti logat ca: <b>'.$_SESSION['valid_user'].'</b></h1><br>';

if(isset($_GET['action']) && $_GET['action'] == "delete") {
echo '<div align="center"><div class="mare"><div class="sus"><div class="ne"> Stergere categorie </div></div><div class="mijloc"><div class="mne">';
$query = "SELECT id_utilizator,username,mail FROM utilizator WHERE id_utilizator = '".$_POST['id_utilizator']."'";
 $rez = mysql_query($query);
 $row = mysql_fetch_array($rez);
 $user = $row['username'];$email = $row['mail'];
 $sql="DELETE FROM `utilizator` WHERE `utilizator`.`id_utilizator` = '".$_POST['id_utilizator']."' LIMIT 1";
 $result = mysql_query($sql);
 echo 'Utilizatorul <b>'.$user.'</b> cu adresa : <b>'.$email.'</b> a fost stears din baza de date.<br><br>Inapoi la <a href="index.php">pagina principala.</a>';

echo '</div></div><div class="jos"></div></div></div>';
exit;
  }
else{
echo '<div align="center"><div class="mare"><div class="sus"><div class="ne"> Alege categoria </div></div><div class="mijloc"><div class="mne">';
?> <form method="post" action="sterge_cont.php?action=delete">

<?php
  $query="SELECT username,mail,id_utilizator FROM utilizator WHERE username='".$_SESSION['valid_user']."'";
  $result = mysql_query($query);
  $row = mysql_fetch_array($result);
  echo 'Doriti sa stergeti contul: <b>'.$row['mail'].'</b> ?<br><br> 
  <input type="hidden" name="id_utilizator" value="'.$row['id_utilizator'].'" />';
?>

<input type="submit" value="Sterge cont" name="action" style=" width:110px;"/>
</form>
 
<?php 
} echo '</div></div><div class="jos"></div></div></div>';
}
 else {
   echo 'Nu sunteti logat. Doar membrii privilegiati pot accesa aceasta pagina.<br>Pentru a va loga, accesati pagina de <a href="index.php">Log in</a>';}
?>

</body>
</html>