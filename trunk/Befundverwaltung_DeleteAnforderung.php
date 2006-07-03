<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<!-- Creation Date: <?=Date("d/m/Y")?> -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="Generator" content="Dev-PHP 1.9.4">
<title>Lösche Anforderung aus der Befundverwaltung</title>
</head>
<body>

<?php
$my_batch = $HTTP_GET_VARS["batch"];
$my_dep_nr = $HTTP_GET_VARS["dep"];

echo '<table bgcolor="#b7d3ff" width="100%" border="0" cellspacing="1" cellpadding="0">';
  echo '<tr>';
    echo '<td ><FONT SIZE="3" FACE="Arial"><br><b>Befundverwaltung - Lösche Anforderung</font></b><br><br><br><br></td>';
    echo ' <td> <img src="myCare2x_122x44.jpg" align="right" border="0" width="122" height="44" alt="mycare2x_122x44)"></td>';
    echo '</tr>';
echo '</table>';

//datenbank öffnen
require('../../include/inc_init_main.php');
$link= mysql_pconnect ( $dbhost, $dbusername, $dbpassword) // [, string password [, int client_flags]]]])
       or die("Could not connect : " . mysql_error());
mysql_select_db($dbname) or die("Could not select database");

$sql="SELECT order_table, result_table FROM mycare_department where nr='".$my_dep_nr."'";
$ok=mysql_query($sql);
$nr=mysql_num_rows($ok);
if ($nr>0) {
    $erg= mysql_fetch_row ($ok);
    if ($erg[0]!="") {
        $order_table=$erg[0];
        $result_table=$erg[1];
        }
    } // andere Table als generic

// Lösche Batch
if ($order_table!="") {
    $sql="DELETE FROM ".$order_table." WHERE batch_nr='".$my_batch."'";
    //echo $sql;
    $ok = mysql_query($sql);
    }
    else {
    $sql="DELETE FROM care_test_request_generic WHERE batch_nr='".$my_batch."'";
    //echo $sql;
    $ok = mysql_query($sql);
    }
    
if ($result_table!="") {
    $sql="DELETE FROM ".$result_table." WHERE batch_nr='".$my_batch."'";
    //echo $sql;
    $ok = mysql_query($sql);
    }

   echo '<script type="text/javascript" >';
   //echo 'alert("Fenster schließen");';
   echo 'window.close();';

   echo '</script>';


?>

</body>
</html>
