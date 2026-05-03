<?php
$connection = mysql_connect("localhost","root","");
if (!$connection) {
 die ("Eroare MySQL");
}
mysql_select_db("produse" , $connection);

?>