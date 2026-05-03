<?php
session_start();
include ("connection.php"); 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Prelucrare comenzi</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<?php
if (isset($_SESSION['valid_user']))
 {  echo '<h1>Esti logat ca: <b>'.$_SESSION['valid_user'].'</b></h1><br>';

if(isset($_GET['id_comanda'])) {
echo '<div align="center"><div class="mare"><div class="sus"><div class="ne"> Detalii comanda </div></div><div class="mijloc"><div class="mne">';

// pentru produse,utilizatori si nr produse		  
$query_comanda = "SELECT CS.id_produs , CS.pret, NR.nr_produse ,U.username , U.nume , U.cnp,U.prenume ,                  U.mail,U.telefon,U.judet,U.oras,U.strada,U.numar,U.cod_postal
                  FROM produs AS CS , produs_comanda AS NR , utilizator AS U
				  WHERE CS.id_produs=NR.id_produs AND CS.id_produs IN 
                  (SELECT CC.id_produs FROM comanda AS C , produs_comanda AS CC WHERE
                            C.id_comanda = '".$_GET['id_comanda']."' AND CC.id_comanda = C.id_comanda )
				  AND U.id_utilizator = (SELECT C.id_utilizator FROM comanda AS C WHERE
                            C.id_comanda = '".$_GET['id_comanda']."')
				  GROUP BY NR.nr_produse,U.id_utilizator";

$result_comanda = mysql_query($query_comanda);
$rez2= mysql_query($query_comanda);

while ($row = mysql_fetch_array($result_comanda)){
	$q = "Select nume from produs where id_produs = ".$row['id_produs'];$r = mysql_query($q);$rows = mysql_fetch_array($r);
echo 'Parfum: <b>'.$rows['nume'].'</b> ; Numar: <b>'.$row['nr_produse'].'</b> ; Pret: <b>'.$row['nr_produse']*$row['pret'].' RON</b><br>';}

$row = mysql_fetch_assoc($rez2);
echo '<br><br><table>
<tr><td>Username: </td><td>'.$row['username'].'</td></tr>
<tr><td>Nume: </td><td>'.$row['nume'].'</td></tr>
<tr><td>Prenume: </td><td>'.$row['prenume'].'</td></tr>
<tr><td>CNP: </td><td>'.$row['cnp'].'</td></tr>
<tr><td>Telefon: </td><td>'.$row['telefon'].'</td></tr>
<tr><td>Mail: </td><td>'.$row['mail'].'</td></tr>
<tr><td>Judet: </td><td>'.$row['judet'].'</td></tr>
<tr><td>Oras: </td><td>'.$row['oras'].'</td></tr>
<tr><td>Strada: </td><td>'.$row['strada'].'</td></tr>
<tr><td>Numar: </td><td>'.$row['numar'].'</td></tr>
<tr><td>Cod postal: </td><td>'.$row['cod_postal'].'</td></tr></table>';

echo '<br><form action="prelucrare_comenzi.php?action=onoreaza" method="post">
 <input type="submit" value="Onoreaza comanda" >
 <input type="hidden" name="id_comanda" value="'.$_GET['id_comanda'].'" >
</form>';
echo '</div></div><div class="jos"></div></div></div>';
exit;
  }
if(isset($_GET['action']) && $_GET['action'] == "onoreaza"){
echo '<div align="center"><div class="mare"><div class="sus"><div class="ne"> Prelucrare comenzi </div></div><div class="mijloc"><div class="mne">';
echo '<div align="center"><h3>Comanda a fost onorata !</h3></div><br><br><a href="index.php">Inapoi</a> la prima pagina<br><a href="comenzi_onorate.php">Onoreaza</a> alta comanda <br><br>';
$sql = "UPDATE `parfumuri`.`comanda` SET `onorare` = '1' WHERE `comanda`.`id_comanda` =".$_POST['id_comanda']." LIMIT 1" ;
$update = mysql_query($sql);
  $query = "SELECT id_comanda,onorare,data FROM comanda WHERE onorare = '0' ORDER BY data ASC";
  $result = mysql_query($query);
  while ($row = mysql_fetch_array($result)){
  echo '<a href="prelucrare_comenzi.php?id_comanda='.$row['id_comanda'].'">Comanda '.$row['data'].'</a><br>';}

echo '</div></div><div class="jos"></div></div></div>';
}
else{
echo '<div align="center"><div class="mare"><div class="sus"><div class="ne"> Alege comanda </div></div><div class="mijloc"><div class="mne">';
?> 
<?php
  $query = "SELECT id_comanda,onorare,data FROM comanda WHERE onorare = '0' ORDER BY data ASC";
  $result = mysql_query($query);
  while ($row = mysql_fetch_array($result)){
  echo '<a href="prelucrare_comenzi.php?id_comanda='.$row['id_comanda'].'">Comanda '.$row['data'].'</a><br>';}
?>
 
<?php 
} echo '</div></div><div class="jos"></div></div></div>';
}
 else {
   echo 'Nu sunteti logat. Doar membrii privilegiati pot accesa aceasta pagina.<br>Pentru a va loga, accesati pagina de <a href="index.php">Log in</a>';}
?>

</body>
</html>