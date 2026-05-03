<?php
session_start();
include ("connection.php"); 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Modifica categorie</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<?php
if (isset($_SESSION['valid_user']))
 {  echo '<h1>Esti logat ca: <b>'.$_SESSION['valid_user'].'</b></h1><br>';

if(isset($_GET['action']) && $_GET['action'] == "select") {
echo '<div align="center"><div class="mare"><div class="sus"><div class="ne"> Detalii categorie </div></div><div class="mijloc"><div class="mne">';
 $sql="SELECT nume, descriere FROM categorii WHERE id_cat = '".$_POST['id_cat']."'";
 $result = mysql_query($sql);
 $row = mysql_fetch_array($result); 
echo '<form method="post" action="modifica_categorie.php?action=modifica"><table>
<tr><td>Nume categorie: </td><td><input type="text" value="'.$row['nume'].'" name="nume" /></td></tr>
<tr><td>Descriere: </td><td><textarea name="descriere" >'.$row['descriere'].'</textarea></td></tr>
<tr><td><input type="hidden" name="id_cat" value="'.$_POST['id_cat'].'"><input type="submit" value="Modifica" name="action" style=" width:80px;"/></td><td><input type="reset" value="Resetare" style=" width:80px;" /></td></tr>
</table></form>';
echo '</div></div><div class="jos"></div></div></div>';
exit;
  }
if(isset($_GET['action']) && $_GET['action'] == "modifica") {
echo '<div align="center"><div class="mare"><div class="sus"><div class="ne"> Rezultat </div></div><div class="mijloc"><div class="mne">';
 $sql="UPDATE `parfumuri`.`categorii` SET `nume` = '".$_POST['nume']."', `descriere` = '".$_POST['descriere']."'
               WHERE `categorii`.`id_cat` =".$_POST['id_cat']." LIMIT 1 ";
    mysql_query ($sql);
    print 'Categoria <b>'.$_POST['nume'].'</b> cu descrierea: <b>'.$_POST['descriere'].'</b> a fost modificat in baza de date!<br>
	  <a href="modifica_categorie.php">Modifica alta categorie</a> sau mergi la <a href="index.php">meniul principal</a><br><br>';
	  echo 'Interogare SQL efectuata: '.$sql;
	  echo '</div></div><div class="jos"></div></div></div>';
	  exit;}

else{
echo '<div align="center"><div class="mare"><div class="sus"><div class="ne"> Alege categoria </div></div><div class="mijloc"><div class="mne">';
?> <form method="post" action="modifica_categorie.php?action=select">
 <table>
<tr><td>Selecteaza categorie: </td>
<td>
<select name="id_cat">
<?php
  $query = "SELECT id_cat,nume FROM categorii";
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