<?php
//start de sesiune
session_start();
//conectare la baza de date
include ("connection.php"); 

//notam directorul curent,comparativ cu root-ul
$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);

// notam in variabila locatia fisierului care prelucreaza functia de upload
$uploadHandler = 'http://' . $_SERVER['HTTP_HOST'] . $directory_self . 'adauga_produs.php?action=add';

// dimensiunea maxima a imaginii
$max_file_size = 30000000; //marimea ~ bytes

// notam intr-o variabila locatia formularului de upload
$uploadForm = 'http://' . $_SERVER['HTTP_HOST'] . $directory_self . 'adauga_produs.php';

//pagina care afiseaza daca operatia a avut loc cu success
$uploadSuccess = 'http://' . $_SERVER['HTTP_HOST'] . $directory_self . 'adauga_produs.php?action=add';

// numele fieldname-ului pentru fisierul respectiv
$fieldname = 'file';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Adauga produs</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<?php
//daca userul este setat ..
if (isset($_SESSION['valid_user']))
 { echo '<h1>Esti logat ca: <b>'.$_SESSION['valid_user'].'</b></h1><br>';

if(isset($_GET['action']) && $_GET['action'] == "add") {
	
$qdir = "SELECT nume FROM categorii WHERE id_cat = ".$_POST['id_cat'];
$rdir = mysql_query($qdir);
$d = mysql_fetch_array($rdir);
// Notam folderul care va primi poza ce urmeaza a fi uploadata
$uploadsDirectory = '../produse/'.$d['nume'].'/';


// Error Handler , in caz ca avem o eroare cu Upload-ul
function error($error, $location)
{
	echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"'."\n".
	'"http://www.w3.org/TR/html4/strict.dtd">'."\n\n".
	'<html lang="en">'."\n".
	'	<head>'."\n".
	'		<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">'."\n\n".
	'		<link rel="stylesheet" type="text/css" href="stylesheet.css">'."\n\n".
	'	<title>Upload error</title>'."\n\n".
	'	</head>'."\n\n".
	'	<body>'."\n\n".
	'	<div id="Upload">'."\n\n".
	'		<h1>Upload failure</h1>'."\n\n".
	'		<p>An error has occured: '."\n\n".
	'		<span class="red">' . $error . '...</span>'."\n\n".
	'	 	The upload form is reloading</p>'."\n\n".
	'	 </div>'."\n\n".
	'</html>';
	exit;
} // end error handler
	

	// Erori PHP posibile
$errors = array(1 => 'php.ini max file size exceeded', 
                2 => 'html form max file size exceeded', 
                3 => 'file upload was only partial', 
                4 => 'no file was attached');

// verificam daca actiunea din formular este setata
isset($_POST['action'])
	or error('the upload form is neaded', $uploadForm);

// verificam erorile standard de upload
($_FILES[$fieldname]['error'] == 0)
	or error($errors[$_FILES[$fieldname]['error']], $uploadForm);
	
// verificam daca lucram cu un upload HTTP
@is_uploaded_file($_FILES[$fieldname]['tmp_name'])
	or error('not an HTTP upload', $uploadForm);
	
// validation... sverificam daca fisierul uploadat este imagine sau nu
@getimagesize($_FILES[$fieldname]['tmp_name'])
	or error('only image uploads are allowed', $uploadForm);
	
// creem un nume de imagine unic , si verificam daca este folosit deja.
// Daca nu , incercam pana gasim un nume nefolosit.
$now = time();
while(file_exists($uploadFilename = $uploadsDirectory.$now.'-'.$_FILES[$fieldname]['name']))
{
	$now++;
}

$fisier = $now.'-'.$_FILES[$fieldname]['name'];
//Mutam fisierul in folder si ii atribuim numele.
@move_uploaded_file($_FILES[$fieldname]['tmp_name'], $uploadFilename)
	or error('receiving directory insuffiecient permission', $uploadForm);

	
echo '<div align="center"><div class="mare"><div class="sus"><div class="ne"> Adauga produs </div></div><div class="mijloc"><div class="mne">';
   if($_POST['nume']=="") {echo 'Trebuie sa completati numele produsului <br><a href="adauga_produs.php">Inapoi</a>';
   echo '</div></div><div class="jos"></div></div></div>';exit;}
	$sql="SELECT nume FROM produs WHERE nume='".$_POST['nume']."'";
    $resursa=mysql_query ($sql);
    if(mysql_num_rows($resursa) != 0)
 	  { print 'parfumul <b>'.$_POST['nume'].'</b> exista deja in baza de date!<br>
	   <a href="adauga_produs.php">Inapoi</a>';
	   echo '</div></div><div class="jos"></div></div></div>';exit;}
   
 $sql="INSERT INTO produs (id_produs,id_cat,nume,sex,descriere,pret,imagine) VALUES ('','".$_POST['id_cat']."','".$_POST['nume']."','".$_POST['sex']."','".$_POST['descriere']."','".$_POST['pret']."','".$fisier."')";
    mysql_query ($sql);
    print 'parfumul <b>'.$_POST['nume'].'</b> cu pretul <b>'.$_POST['pret'].'</b> RON a fost adaugata in baza de date!<br>
	  <a href="index.php">Inapoi la meniu</a><br><a href="adauga_produs.php">Adauga un alt produs</a>';
	  echo '</div></div><div class="jos"></div></div></div>';exit;
  }//sfarsit inserare in produs
else{

echo '<div align="center"><div class="mare"><div class="sus"><div class="ne"> Adauga produs </div></div><div class="mijloc"><div class="mne">';
?> <form method="post" action="<?php echo $uploadHandler ?>" enctype="multipart/form-data" >
 <table>
<tr><td>Marca: </td><td>
<select name="id_cat">
<?php
$query = "SELECT id_cat , nume FROM categorii";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result)) {
echo '<option value="'.$row['id_cat'].'">'.$row['nume'].'</option>';}
?>
</select>
</td></tr>
<tr><td>Nume: </td><td><input type="text" name="nume" /></td></tr>
<tr><td>Descriere: </td><td><textarea name="descriere"></textarea></td></tr>
<tr><td>Tip produs: </td><td><select name="sex">
   <option value="M">Pentru el</option>
   <option value="F">Pentru ea</option></select></td></tr>
<tr><td>Pret: </td><td><input type="text" name="pret" /></td></tr>
<tr><td colspan="2">

		<p>
			<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size ?>">
		</p>
		
		<p>
			<label for="file">Upload imagine:</label>
			<input id="file" type="file" name="file">
		</p>

</td></tr>
<tr><td><input type="submit" value="Creeaza" id="submit" name="action" style="width:80px;"/></td><td><input type="reset" value="Resetare" style="width:80px;"/></td></tr>
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