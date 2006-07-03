<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<!-- Creation Date: <?=Date("d/m/Y")?> -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="Generator" content="Dev-PHP 1.9.4">
<title>Document Title</title>
</head>
<body>

<?php
$my_sid = $HTTP_GET_VARS["sid"];
$my_lang = $HTTP_GET_VARS["lang"];
if ($my_lang=="") $my_lang="de";
$my_pid = $HTTP_GET_VARS["pid"];
$my_dep_nr = $HTTP_GET_VARS["depnr"];
$my_fid= $HTTP_GET_VARS["fid"];

echo '<table bgcolor="#b7d3ff" width="100%" border="0" cellspacing="1" cellpadding="0">';
  echo '<tr>';
    echo '<td ><FONT SIZE="3" FACE="Arial"><b>Befundverwaltung - Neuer Befund</font></b><br><br><br><br></td>';
    echo ' <td> <img src="myCare2x_122x44.jpg" align="right" border="0" width="122" height="44" alt="mycare2x_122x44)"></td>';
    echo '</tr>';
echo '</table>';

error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
require_once($root_path.'include/inc_date_format_functions.php'); // Load the date formatter

// Finde FID
   if ($my_fid=="")
       $sql="Select encounter_nr, pid, is_discharged, encounter_class_nr, current_ward_nr, current_room_nr, in_ward, current_dept_nr, in_dept "
           ."From care_encounter where pid='".$my_pid."' order by encounter_nr desc"; //  and is_discharged='0'";
       else
       $sql="Select encounter_nr, pid, is_discharged, encounter_class_nr, current_ward_nr, current_room_nr, in_ward, current_dept_nr, in_dept "
           ."From care_encounter where encounter_nr='".$my_fid."'";
   //echo $sql;
   $ok=$db->Execute($sql);
   $erg=$ok->FetchRow();
   //Anzeigen Tabelle
   $my_fid=$erg[encounter_nr];
   if ($erg[current_dept_nr]!="" and $erg[in_dept]==true) {
       $my_order_dep=$erg[current_dept_nr];
       }
       else  {
       $my_order_dep="";
       $sql="Select nr, dept_nr From care_ward where nr='".$erg[currenr_ward_nr]."'"; //echo $sql;
       $erg= mysql_fetch_row ($ok);
       $my_order_dep=$erg[nr];
       }

   //call Befundschreibung
   $aufr='"../befund/bausteinaufruf.php?fid='.$my_fid.'&pid='.$my_pid.'&result=&batch='.$my_batch.'&dep='.$my_dep_nr.'"';
   //echo $aufr;
   echo '<script type="text/javascript" >';
   echo 'window.open('.$aufr,',"bst","dependent=yes,menubar=no,tollbar=no,resizable=yes,status=no,scrollbars=yes");';

   echo 'if (opener.name!="") window.close();';
   echo '</script>';
   
//RUN BEFUNDAnzeige

?>
<br><br><br>
<form name="BefVerwNeu" action="Befundverwaltung_dbform.php?sid=<?echo $my_sid; ?>&lang=<?echo $my_lang; ?>" method="post">
<INPUT TYPE="hidden"  name="myDepNr" value="<? echo $my_dep_nr; ?>">
<input type="submit" name="Befundverwaltung" value="zurück">
</form>

</body>
</html>
