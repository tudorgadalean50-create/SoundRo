<?php
session_start();
include ("connection.php"); 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Modificare cont utilizator</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<?php
if (isset($_SESSION['valid_user']))
 { 
//functie de modificare
if(isset($_GET['action']) && $_GET['action'] == "modif") {
echo '<div align="center"><div class="mare"><div class="sus"><div class="ne"> Modificare cont </div></div><div class="mijloc"><div class="mne">';
		if($_POST['mail']=="") {echo 'Trebuie sa completati mail-ul ';echo '</div></div><div class="jos"></div></div></div>';exit;}
 $sql="UPDATE `librariamea`.`carte` SET `Titlu` = 'Trei Camarazi' WHERE `carte`.`CodISBN` = '973-592-193-7' LIMIT 1 ;
 UPDATE `parfumuri`.`utilizator` SET `nume` = '".$_POST['nume']."', `prenume` = '".$_POST['prenume']."', `cnp` = '".$_POST['cnp']."',
                 `telefon` = '".$_POST['telefon']."', `mail` = '".$_POST['mail']."', `judet` = '".$_POST['judet']."',
				 `oras` = '".$_POST['oras']."', `strada` = '".$_POST['strada']."', `numar` = '".$_POST['numar']."',
				 `cod_postal` = '".$_POST['cod_postal']."', `statut` = '".$_POST['statut']."'
               WHERE `utilizator`.`id_utilizator` =".$_POST['id_utilizator']." LIMIT 1 ";
    mysql_query ($sql);
    print 'Userul <b>'.$_POST['username'].'</b> cu adresa de mail: <b>'.$_POST['mail'].'</b> a fost modificat in baza de date!<br><br>
	  <a href="modifica_cont.php">Modifica</a> contul din nou.<br>Inapoi la <a href="index.php">meniul principal<a/>.<br><br>';
	  echo 'Interogare SQL efectuata: '.$sql;
	  echo '</div></div><div class="jos"></div></div></div>';
	  exit;
  }//sfarsit modificare 
else{
$sql="SELECT * FROM utilizator WHERE username='".$_SESSION['valid_user']."'";
$resursa=mysql_query ($sql);
$row = mysql_fetch_array($resursa); 
echo '<div align="center"><div class="mare"><div class="sus"><div class="ne"> Modificare cont </div></div><div class="mijloc"><div class="mne">';
?> <form method="post" action="modifica_cont.php?action=modif">
 <table>
<tr><td>Username: </td><td><?php echo $row['username']; ?></td></tr>
<tr><td>Parola criptata: </td><td><?=$row['password']?></td></tr>
<tr><td>Nume: </td><td><input type="text" name="nume" value="<?php echo $row['nume']; ?>"/></td></tr>
<tr><td>Prenume: </td><td><input type="text" name="prenume" value="<?php echo $row['prenume']; ?>"/></td></tr>
<tr><td>CNP: </td><td><input type="text" name="cnp" value="<?php echo $row['cnp']; ?>" /></td></tr>
<tr><td>Telefon: </td><td><input type="text" name="telefon" value="<?php echo $row['telefon']; ?>" /></td></tr>
<tr><td>Mail: </td><td><input type="text" name="mail" value="<?php echo $row['mail']; ?>"/></td></tr>
<tr><td>Judet: </td><td><input type="text" name="judet" value="<?php echo $row['judet']; ?>"/></td></tr>
<tr><td>Oras: </td><td><input type="text" name="oras" value="<?php echo $row['oras']; ?>" /></td></tr>
<tr><td>Strada: </td><td><input type="text" name="strada" value="<?php echo $row['strada']; ?>" /></td></tr>
<tr><td>Numar: </td><td><input type="text" name="numar" value="<?php echo $row['numar']; ?>" /></td></tr>
<tr><td>Cod postal: </td><td><input type="text" name="cod_postal" value="<?php echo $row['cod_postal']; ?>" /></td></tr>
<tr><td>Statut: </td><td>
<select name="statut">
<option value="0">Administrator</option>
<option value="1">Utilizator</option>
</select><input type="hidden" name="id_utilizator" value="<?=$row['id_utilizator']?>" /></td></tr>
<tr><td><input type="submit" value="Modifica" name="action" style="width:80px"/></td><td><input type="reset" value="Resetare" style="width:80px" /></td></tr>
</table>
</form>
<?php 
}  echo '</div></div><div class="jos"></div></div></div>';
}
 else {
   echo 'Nu sunteti logat. Doar membrii privilegiati pot accesa aceasta pagina.<br>Pentru a va loga, accesati pagina de <a href="index.php">Log in</a>';}
?>

</body>
</html>