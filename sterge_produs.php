<?php
session_start();
include ("connection.php"); 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sterge produs</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<?php
if (isset($_SESSION['valid_user']))
 {  echo '<h1>Esti logat ca: <b>'.$_SESSION['valid_user'].'</b></h1><br>';

if(isset($_GET['action']) && $_GET['action'] == "category") {
echo '<div align="center"><div class="mare"><div class="sus"><div class="ne"> Alege nume </div></div><div class="mijloc"><div class="mne">';
 $query = "SELECT nume,id_cat FROm categorii WHERE id_cat = '".$_POST['id_cat']."'";
 $rez = mysql_query($query);
 $rand = mysql_fetch_array($rez);
echo '<form method="post" action="sterge_produs.php?action=delete"><table>
<tr><td>Nume marca: </td><td>'.$rand['nume'].'</td></tr>
<tr><td>Model: </td><td>
<select name="id_produs">';

$sql="SELECT id_cat,id_produs,nume FROM produs WHERE id_cat = '".$_POST['id_cat']."'";
 $result = mysql_query($sql);
while ($row = mysql_fetch_array($result)) {
 echo '<option value="'.$row['id_produs'].'">'.$row['nume'].'</option>'; }
 
echo '</select>
</td></tr>
<tr><td colspan="2"><input type="submit" value="Selecteaza" name="action" style=" width:100px;"/></td></tr>
</table></form>';
echo '</div></div><div class="jos"></div></div></div>';
exit;
  }
if(isset($_GET['action']) && $_GET['action'] == "delete") {
echo '<div align="center"><div class="mare"><div class="sus"><div class="ne"> Stergere produs </div></div><div class="mijloc"><div class="mne">';
$query = "SELECT * FROM produs WHERE id_produs = '".$_POST['id_produs']."'";
 $rez = mysql_query($query);
 $row = mysql_fetch_array($rez);
 $nume = $row['nume'];
 $sql="DELETE FROM `produs` WHERE `produs`.`id_produs` = '".$_POST['id_produs']."' LIMIT 1";
 $result = mysql_query($sql);
 echo 'Ceasul '.$nume.' a fost sters din baza de date.<br><br><a href="sterge_produs.php">Sterge</a> alt produs.<br>Inapoi la <a href="index.php">pagina principala.</a>';
	  echo '</div></div><div class="jos"></div></div></div>';
	  exit;}
	  
else{
echo '<div align="center"><div class="mare"><div class="sus"><div class="ne"> Alege marca </div></div><div class="mijloc"><div class="mne">';
?> <form method="post" action="sterge_produs.php?action=category">
 <table>
<tr><td>Selecteaza categorie: </td>
<td>
<select name="id_cat">
<?php
  $query = "SELECT * FROM categorii";
  $result = mysql_query($query);
  while ($row = mysql_fetch_array($result)){
  echo '<option value="'.$row['id_cat'].'">'.$row['nume'].'</option>';}
?>
</select>
</td></tr>
<tr><td colspan="2"><input type="submit" value="Selecteaza" name="action" style=" width:80px;"/></td></tr>
</table>
</form>
<?php 
} echo '</div></div><div class="jos"></div></div></div>';
}
 else {
   echo 'Nu sunteti logat. Doar membrii privilegiati pot accesa aceasta pagina.<br>Pentru a va loga, accesati pagina de <a href="index.php">Log in</a>';}
?>
</body>
</html>