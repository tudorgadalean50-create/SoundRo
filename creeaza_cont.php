<?php
//start de sesiune
session_start();
//conectare la baza de date
include ("connection.php"); 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Creeare cont utilizator</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<?php
if (isset($_SESSION['valid_user']))
 {  echo '<h1>Esti logat ca: <b>'.$_SESSION['valid_user'].'</b></h1><br>';


//functia de inregistrare
if(isset($_GET['action']) && $_GET['action'] == "inreg") {
echo '<div align="center"><div class="mare"><div class="sus"><div class="ne"> Creeaza cont nou </div></div><div class="mijloc"><div class="mne">';
   if($_POST['username']=="") {echo 'Trebuie sa completati UserName-ul <br><a href="creeaza_cont.php">Inapoi</a>';
   echo '</div></div><div class="jos"></div></div></div>';exit;}
	$sql="SELECT username,password FROM utilizator WHERE username='".$_POST['username']."'";
    $resursa=mysql_query ($sql);
    if(mysql_num_rows($resursa) != 0)
 	  { print 'Userul <b>'.$_POST['nume_nou'].'</b> exista deja in baza de date!<br>
	   <a href="creeaza_cont.php">Inapoi</a>';
	   echo '</div></div><div class="jos"></div></div></div>';exit;}
    if($_POST['password']=="") {echo 'Trebuie sa completati parola <br><a href="creeaza_cont.php">Inapoi</a>';
	echo '</div></div><div class="jos"></div></div></div>';exit;}
   if($_POST['mail']=="")
      { print 'Trebuie sa completezi adresa de e-mail!<br>
	     <a href="creeaza_cont.php">Inapoi</a>';
	    echo '</div></div><div class="jos"></div></div></div>';exit;
      }
    $sql="SELECT mail FROM utilizator WHERE mail='".$_POST['mail']."'";
    $resursa=mysql_query ($sql);
    if(mysql_num_rows($resursa) != 0)
 	{ print 'E-mailul <b>'.$_POST['mail'].'</b> exista deja in baza de date!<br>
	  <a href="creeaza_cont.php">Inapoi</a>';
	  echo '</div></div><div class="jos"></div></div></div>';exit;
	}
	
 $sql="INSERT INTO utilizator (id_utilizator,username,password,nume,prenume,cnp,telefon,mail,judet,oras,strada,numar,cod_postal,statut) VALUES ('','".$_POST['username']."',md5('".$_POST['password']."'),'".$_POST['nume']."','".$_POST['prenume']."','".$_POST['cnp']."','".$_POST['telefon']."','".$_POST['mail']."','".$_POST['judet']."','".$_POST['oras']."','".$_POST['strada']."','".$_POST['numar']."','".$_POST['cod_postal']."','".$_POST['statut']."')";
    mysql_query ($sql);
    print 'Userul <b>'.$_POST['username'].'</b> cu adresa de mail: <b>'.$_POST['mail'].'</b> a fost adaugat in baza de date!<br><br><br>
	  <a href="creeaza_cont.php">Creeaza</a> alt cont.<br>Inapoi la <a href="index.php">meniul principal</a>.';
echo '</div></div><div class="jos"></div></div></div>';
	  exit;
  }//sfarsit functie de inregistrare
else{
echo '<div align="center"><div class="mare"><div class="sus"><div class="ne"> Creeaza cont nou </div></div><div class="mijloc"><div class="mne">';
?> <form method="post" action="creeaza_cont.php?action=inreg">
 <table>
<tr><td>Username: </td><td><input type="text" name="username" /></td></tr>
<tr><td>Parola: </td><td><input type="password" name="password" /></td></tr>
<tr><td>Nume: </td><td><input type="text" name="nume" /></td></tr>
<tr><td>Prenume: </td><td><input type="text" name="prenume" /></td></tr>
<tr><td>CNP: </td><td><input type="text" name="cnp" /></td></tr>
<tr><td>Telefon: </td><td><input type="text" name="telefon" /></td></tr>
<tr><td>Mail: </td><td><input type="text" name="mail" /></td></tr>
<tr><td>Judet: </td><td><input type="text" name="judet" /></td></tr>
<tr><td>Oras: </td><td><input type="text" name="oras" /></td></tr>
<tr><td>Strada: </td><td><input type="text" name="strada" /></td></tr>
<tr><td>Numar: </td><td><input type="text" name="numar" /></td></tr>
<tr><td>Cod postal: </td><td><input type="text" name="cod_postal" /></td></tr>
<tr><td>Statut: </td><td>
<select name="statut">
<option value="0">Administrator</option>
<option value="1">Utilizator</option>
</select></td></tr>
<tr><td><input type="submit" value="Inregistreaza" name="action" style="width:100px;"/></td><td><input type="reset" value="Resetare" style="width:80px;"/></td></tr>
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