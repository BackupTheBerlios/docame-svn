<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
require_once($root_path.'include/inc_date_format_functions.php'); // Load the date formatter
define('LANG_FILE','befundverwaltung.php');
require_once($root_path.'include/inc_front_chain_lang.php');

html_rtl($lang);
echo '<HEAD>';
echo setCharSet();

/*
myCARE 2X Integrated Information System version deployment 1.1 (mysql) 2004-01-11 for Hospitals and Health Care Organizations and Services
Copyright (C) 2004  Joachim Mollin & hcc gmbh	

GNU GPL. For details read file "copy_notice.txt".
*/

$local_user='ck_pflege_user';
// Load the date formatter
//require_once($root_path.'include/inc_date_format_functions.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<!-- Creation Date: <?=Date("d/m/Y")?> -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="Generator" content="Dev-PHP 2.0.12">
<?php echo '<title>'.$LDBefV["title"].'</title>'; ?>

<link rel="StyleSheet" href="dtree.css" type="text/css" />
<script type="text/javascript" src="dtree.js"></script>

<style type="text/css">

 select, input, textarea
   { font-size:10px; font-family:Verdana,sans-serif;  }

html, body {
  font-family: Arial,sans-serif;
  font-size=12px;
  font-color: #000000;
  background-color: #ffffff;
  color: #000000;
}
table {
  font-family: Arial,sans-serif;
  font-size=10px;
  font-color: #000000;
  color: #000000;
}
 .Check
   { font-size:8pt; }

</style>

</head>

<body onload="javascript:onStart();">

<script type="text/javascript">
function onStart () {
    //aktiv=window.setInterval("x=document.body.scrollLeft;y=document.body.scrollTop; document.BefVerw.submit();window.scrollTo(x,y);",10000);
    }

function show(element) {
 //if(document.getElementById)
   var status=document.getElementById(element).style.display
   if (status=="none")
       status=document.getElementById(element).style.display="block";
       else
       status=document.getElementById(element).style.display="none";
}

function changeDept () {
   document.BefVerw.myDepNr.value=document.BefVerw.DeptAuswahl.options[document.BefVerw.DeptAuswahl.selectedIndex].value;
   document.BefVerw.myDep.value=document.BefVerw.DeptAuswahl.options[document.BefVerw.DeptAuswahl.selectedIndex].text;
   document.BefVerw.submit();
   }

function startBefund (pid,fid,name,result_nr,batch_nr) {
	 dep_nr=document.BefVerw.myDepNr.value;
   if (result_nr==0)
       result_nr="";
   if (batch_nr==0)
       batch_nr="";
   var w=screen.width; var h=screen.height;
       if (w==800) {
           col=110;
           row=44;
           }
       if (w==1024) {
           col=110;
           row=58;
           }
       if (w==1280) {
           col=118;
           row=75;
           }
   var arg="<? echo $root_path; ?>modules/befund/bausteinaufruf.php<?php echo URL_REDIRECT_APPEND?>&pid="+pid
            +"&fid="+fid+"&dep="+dep_nr+"&pname="+name+"&batch="+batch_nr+"&result="+result_nr+"&breite="+w+"&hoehe="+h+"&col="+col+"&row="+row+"&modus=Lesen";
   //alert (arg);
   topWin=window.open(arg,"Befund","dependent=yes,width="+w+",height="+h+",menubar=no,resizable=yes,scrollbars=yes");
   topWin.moveTo(0,0);
   //var aufr="../befund/bausteinaufruf.php?lang=de&pid="+pid+"&fid="+fid+"&result="+result_nr+"&batch="+batch_nr+"&dep="+dep_nr+"&modus=Lesen";
   //alert (aufr);
   //window.open(aufr,"bst","menubar=no,tollbar=no,resizable=yes,status=no,scrollbars=yes");
}

function druckBefund (pid,fid,result_nr) {
   dep_nr=document.BefVerw.myDepNr.value;
   var aufr="Befundverwaltung_DruckBefund.php?result="+result_nr+"&dep="+dep_nr;
   //alert (aufr);
   window.open(aufr,"bst","dependent=yes,menubar=no,tollbar=no,resizable=yes,status=no,scrollbars=yes");
}

function deleteAnforderung (pid,fid,batch_nr) {
   dep_nr=document.BefVerw.myDepNr.value;
   var aufr="Befundverwaltung_DeleteAnforderung.php?batch="+batch_nr+"&dep="+dep_nr;
   //alert (aufr);
   window.open(aufr,"delete","dependent=yes,menubar=no,tollbar=no,resizable=yes,status=no,scrollbars=yes");
}

/*function startNeuBefund (ziel) {
   //alert (ziel);
   if (document.BefVerw.myDepNr.value=="") {
       alert ("Keine Abteilung ausgewählt");
       return;
       }
   window.location.href = ziel;
}*/

</script>

<?PHP
$null="0";

function getAbteilung($nr) {
   global $db, $root_path, $lang;

   require ($root_path.'language/'.$lang.'/lang_'.$lang.'_departments.php');
   $sql="SELECT  nr, name_formal, LD_var, is_sub_dept, parent_dept_nr from care_department
         where nr='$nr'";
   $result=$db->Execute($sql);
   $ergebnis=$result->FetchRow();
   $formel="\$Abteilung=$".$ergebnis[LD_var].";";
   eval ($formel);
   if ($Abteilung!="")
        return ($Abteilung);
        else
        return $ergebnis[name_formal];
   }
function PatName($fpid) {
   global $db;
   // Name + Vorname Lesen lesen
   $sql="Select name_first, name_2, name_3, name_last, name_maiden, name_middle, date_birth
         From care_person where pid='".$fpid."'"; //echo $sql;
   $ok=$db->Execute($sql);
   $erg=$ok->FetchRow();
   $name=$erg[name_last].", ".$erg[name_first];
   if ($erg[name_maiden]<>"") $name.=",<br> geb. ".$erg[name_maiden];
   $name.=",<br> ".$erg[date_birth];
   return $name;
}

function stripText ($wert) {
   $wert=strip_tags($wert);
return $wert;
}

//***Variablen für dieses Modul setzen***
$ModulNeuBez="Befundverwaltung";

$my_dep_nr = $HTTP_GET_VARS["depnr"];
  if ($modus=='') {
      $my_sid = $HTTP_GET_VARS["sid"];
      $my_lang = $HTTP_GET_VARS["lang"];
      if ($my_lang=="") $my_lang="de";
      //$my_pid = $HTTP_GET_VARS["pid"];
      $my_dep = $HTTP_GET_VARS["dep"];
      if ($my_dep=="") $my_dep=$myDep;
      $my_dep_nr = $HTTP_GET_VARS["depnr"];
      if ($my_dep_nr=="") $my_dep_nr=$myDepNr;
      }

echo '<a name="top"></a>';
echo '<FONT    SIZE=-1  FACE="Arial">';

echo '<table bgcolor="#b7d3ff" width="100%" border="0" cellspacing="1" cellpadding="0">';
  echo '<tr>';
    echo '<td ><FONT SIZE="3" FACE="Arial"><b>'.$LDBefV["title"].'</font></b><br><br>'.
         '<FONT SIZE="2"  FACE="Arial"><b>'.$my_dep.' </font></b><br></td>';
    echo ' <td> <img src="myCare2x_122x44.jpg" align="'.$TP_ANTIALIGN.'" border="0" width="122" height="44" alt="mycare2x_122x44)"></td>';
    echo '</tr>';
echo '</table>';

//Abteilungsauswahl
require ('../../language/de/lang_de_departments.php');
//$sql="SELECT  id, LD_var, nr from care_department where type=1 order by LD_var"; //and (admit_inpatient=1 or admit_outpatient=1)";
$sql="SELECT  id, LD_var, nr
     from care_department
     where type='1' and
           is_inactive='0' and
           admit_outpatient='1'
     order by nr"; //echo $sql;
$ok=$db->Execute($sql);
?>
<form name="BefVerw" onsubmit="changeDept()" method="post">
  <font face="Arial" size="2">
  <select size="1" name="DeptAuswahl" onChange="javascript:changeDept();">
          <option><?php echo $LDBefV["deptchoice"];?></option>
          <?php
           while ($erg=$ok->FetchRow()) {
                $dep=getAbteilung($erg[nr]);
                //$formel="\$dep=$".$erg[LD_var].";";
                //eval ($formel);
                if ($my_dep_nr==$erg[nr])
                    echo "<option selected value='".$erg[nr]."'>".$dep."</option>";
                    else
                    echo "<option value='".$erg[nr]."'>".$dep."</option>";
                    }
?>
  </select>
<input type="button" name="Refresh" value="<? echo $LDBefV["refresh"];?>" onclick="javascript:document.BefVerw.submit()">
<?php $arg="test_person_search.php?sid=$my_sid&lang=$my_lang&depnr=$my_dep_nr&fid=$my_fid"; ?>
<!--
<input type="button" name="NeuerBefund" value="Neuer Befund" onclick="javascript:startNeuBefund('<?echo $arg; ?>')">
-->
<?php
echo '<a name="AnfOffen"></a>';
//offene Anforderungen
        echo '<table border="0" ><tr><td valign="middle" width="40%"><FONT size="2" face="Arial"><b>'.$LDBefV["pendorders"].'</td>';
            echo '<td valign="middle" width="50%"><FONT size="0" face="Arial"><a href="javascript:show(\'TabAnfOffen\');">'.$LDBefV["show"].'</a> ';
            echo '<FONT size="0" face="Arial"><a href="#top">'.$LDBefV["top"].'</a> ';
            echo '<FONT size="0" face="Arial">'.$LDBefV["results"].' (<a href="#BefOffen">'.$LDBefV["pending"].'</a> ';
            echo '<FONT size="0" face="Arial"><a href="#BefFertig">'.$LDBefV["done"].')</a>) ';
            echo '<FONT size="0" face="Arial"></td></tr></table>';
      echo '<table id="TabAnfOffen" border="0" width="100%">';
        echo '<tr>';
         echo '<td width="5%" valign="top" align="'.$TP_ALIGN.'" bgcolor="#b7d3ff"><FONT size="0" face="Arial"></font></td>'; //Auswahl
         echo '<td width="10%" valign="top" align="'.$TP_ALIGN.'" bgcolor="#b7d3ff"><FONT size="0" face="Arial">'.$LDBefV["date"].'</font></td>'; //Sende Datum
         echo '<td width="10%" valign="top" align="'.$TP_ALIGN.'" bgcolor="#b7d3ff"><FONT size="0" face="Arial">'.$LDBefV["doctor"].'</font></td>'; //Arzt
         echo '<td width="10%" valign="top" align="'.$TP_ALIGN.'" bgcolor="#b7d3ff"><FONT size="0" face="Arial">'.$LDBefV["pidfid"].'</font></td>'; //FID
         echo '<td width="10%" valign="top" align="'.$TP_ALIGN.'" bgcolor="#b7d3ff"><FONT size="0" face="Arial">'.$LDBefV["patname"].'</font></td>'; //Patientenname
         echo '<td width="10%" valign="top" align="'.$TP_ALIGN.'" bgcolor="#b7d3ff"><FONT size="0" face="Arial">'.$LDBefV["orderstate"].'</font></td>'; //Anforderungsnr
         echo '<td width="50%" valign="top" align="'.$TP_ALIGN.'" bgcolor="#b7d3ff"><FONT size="0" face="Arial">'.$LDBefV["text"].'</font></td>'; //Anforderungstext
       echo '</tr>';
          //Anforderungen lesen
        $sql="SELECT r.*, f.*
                FROM mycare_request as r, mycare_field as f
                where f.field_document_nr=r.request_document_nr
                and f.field_name='request_text'";
        if($done=="yes")
				   $sql.=" and request_state_accepted='done' ";
				   else
				   $sql.=" and request_state_accepted!='done' ";
        $sql.=" and request_state_findings is NULL
                and r.request_department_nr='".$my_dep_nr."'"; //echo $sql;
          $ok=$db->Execute($sql);
          while ($erg=$ok->FetchRow()) {
                   if ($erg[modified_id]=="") $anfPerson=$erg[create_id]; else $anfPerson=$erg[modified_id];
                   $mTime=$erg[modified_time]; //$mTime=substr($mTime,0,4)."-".substr($mTime,4,2)."-".substr($mTime,6,2);
                   if ($color=="#eeeeee") $color="#ffffff"; else $color="#eeeeee";
                   echo '<td width="5%" valign="top" align="'.$TP_ALIGN.'" bgcolor="'.$color.'"><FONT size="2" face="Arial">';
                   echo '<input type="image" src="pfeil.gif" onclick="startBefund('.$erg[request_pid].','.$erg[request_encounter_nr].',\''.PatName($erg[request_pid]).'\','.$null.','.$erg[request_nr].');">    </font>'; //Auswahl
                   echo '<td width="10%" valign="top" align="'.$TP_ALIGN.'" bgcolor="'.$color.'"><FONT size="0" face="Arial">'.formatDate2Local($mTime,$date_format).'</font></td>'; //Sende Datum
                   echo '<td width="10%" valign="top" align="'.$TP_ALIGN.'" bgcolor="'.$color.'"><FONT size="0" face="Arial">'.$anfPerson.'</font></td>'; //Arzt
                   echo '<td width="10%" valign="top" align="'.$TP_ALIGN.'" bgcolor="'.$color.'"><FONT size="0" face="Arial">'.$erg[request_pid]." / ".$erg[request_encounter_nr].'</font></td>'; //FID
                   echo '<td width="10%" valign="top" align="'.$TP_ALIGN.'" bgcolor="'.$color.'"><FONT size="0" face="Arial">'.PatName($erg[request_pid]).'</font></td>'; //Patientenname
                   echo '<td width="10%" valign="top" align="'.$TP_ALIGN.'" bgcolor="'.$color.'"><FONT size="0" face="Arial">'.$erg[request_nr]."<br>".$erg[request_state_accepted].'</font></td>'; //Anforderungsnr
                   echo '<td width="50%" valign="top" align="'.$TP_ALIGN.'" bgcolor="'.$color.'"><FONT size="0" face="Arial">'.substr(stripText($erg[field_text]),0,300).'</font></td>'; //Anforderungstext
         echo '</tr>';
                 }
        echo '</table>';
        
echo '<a name="BefOffen"></a>';
//offene Befunde
echo '<br><br>';
        echo '<table border="0" ><tr><td valign="middle" width="40%"><FONT size="2" face="Arial"><b>'.$LDBefV["pendresults"].'</td>';
            echo '<td valign="middle" width="50%"><FONT size="0" face="Arial"><a href="javascript:show(\'TabBefOffen\');">'.$LDBefV["show"].'</a> ';
            echo '<FONT size="0" face="Arial"><a href="#top">'.$LDBefV["top"].'</a> ';
            echo '<FONT size="0" face="Arial">'.$LDBefV["results"].' (<a href="#BefOffen">'.$LDBefV["pending"].'</a> ';
            echo '<FONT size="0" face="Arial"><a href="#BefFertig">'.$LDBefV["done"].')</a>) ';
             echo '<FONT size="0" face="Arial"></td></tr></table>';
      echo '<table id="TabBefOffen" border="0" width="100%">';
        echo '<tr>';
         echo '<td width="5%" valign="top" align="'.$TP_ALIGN.'" bgcolor="#b7d3ff"><FONT size="0" face="Arial"></font></td>'; //Auswahl
         echo '<td width="10%" valign="top" align="'.$TP_ALIGN.'" bgcolor="#b7d3ff"><FONT size="0" face="Arial">'.$LDBefV["date"].'</font></td>'; //letzte Bearbeitung Datum
         echo '<td width="10%" valign="top" align="'.$TP_ALIGN.'" bgcolor="#b7d3ff"><FONT size="0" face="Arial">'.$LDBefV["doctor"].'</font></td>'; //Arzt
         echo '<td width="10%" valign="top" align="'.$TP_ALIGN.'" bgcolor="#b7d3ff"><FONT size="0" face="Arial">'.$LDBefV["pidfid"].'</font></td>'; //FID
         echo '<td width="10%" valign="top" align="'.$TP_ALIGN.'" bgcolor="#b7d3ff"><FONT size="0" face="Arial">'.$LDBefV["patname"].'</font></td>'; //Patientenname
         echo '<td width="10%" valign="top" align="'.$TP_ALIGN.'" bgcolor="#b7d3ff"><FONT size="0" face="Arial">'.$LDBefV["result#order#"].' </font></td>'; //Anforderungsnr
         echo '<td width="50%" valign="top" align="'.$TP_ALIGN.'" bgcolor="#b7d3ff"><FONT size="0" face="Arial">'.$LDBefV["text"].'</font></td>'; //Befundtext
       echo '</tr>';
          //Lese Result Tabelle
          $sql="SELECT *
                FROM mycare_result
                where result_department_nr='".$my_dep_nr."'
                and result_status='pending'
                order by modified_time"; //echo $sql;
          $ok=$db->Execute($sql);
          while ($erg=$ok->FetchRow()) {
                 $mTime=$erg[modified_time]; //$mTime=substr($mTime,0,4)."-".substr($mTime,4,2)."-".substr($mTime,6,2);
                 if ($color=="#eeeeee") $color="#ffffff"; else $color="#eeeeee";
                   echo '<td width="5%" valign="top" align="'.$TP_ALIGN.'" bgcolor="'.$color.'"><FONT size="0" face="Arial">';
                   echo '<input type="image" src="pfeil.gif" onclick="startBefund('.$erg[result_pid].','.$erg[result_fid].','.PatName($erg[result_pid]).','.$erg[result_id].','.$null.');">    </font>'; //Auswahl
                   echo '<input type="image" src="befdruck.gif" onclick="druckBefund('.$erg[result_pid].','.$erg[result_fid].','.$erg[result_id].','.$null.');"></font></td>'; //Auswahl
                   echo '<td width="10%" valign="top" align="'.$TP_ALIGN.'" bgcolor="'.$color.'"><FONT size="0" face="Arial">'.formatDate2Local($mTime,$date_format).'</font></td>'; //Sende Datum
                   echo '<td width="10%" valign="top" align="'.$TP_ALIGN.'" bgcolor="'.$color.'"><FONT size="0" face="Arial">'.$erg[result_dr].'</font></td>'; //Arzt
                   echo '<td width="10%" valign="top" align="'.$TP_ALIGN.'" bgcolor="'.$color.'"><FONT size="0" face="Arial">'.$erg[result_pid]."<br>".$erg[result_fid].'</font></td>'; //FID
                   echo '<td width="10%" valign="top" align="'.$TP_ALIGN.'" bgcolor="'.$color.'"><FONT size="0" face="Arial">'.PatName($erg[result_pid]).'</font></td>'; //Patientenname
                   echo '<td width="10%" valign="top" align="'.$TP_ALIGN.'" bgcolor="'.$color.'"><FONT size="0" face="Arial">'.$erg[result_id].'<br>'.$erg[result_request_nr].'</font></td>'; //Anforderungsnr
                   echo '<td width="50%" valign="top" align="'.$TP_ALIGN.'" bgcolor="'.$color.'"><FONT size="0" face="Arial">'.substr(stripText($erg[result_text]),0,300).'</font></td>'; //Befundtext
         echo '</tr>';
                 }
        echo '</table>';

echo '<a name="BefFertig"></a>';
//fertige Befunde
echo '<br><br>';
        echo '<table border="0" ><tr><td valign="middle" width="40%"><FONT size="2" face="Arial"><b>'.$LDBefV["doneresults"].'</td>';
            echo '<td valign="middle" width="50%"><FONT size="0" face="Arial"><a href="javascript:show(\'TabBefFertig\');">'.$LDBefV["show"].'</a> ';
            echo '<FONT size="0" face="Arial"><a href="#top">'.$LDBefV["top"].'</a> ';
            echo '<FONT size="0" face="Arial">'.$LDBefV["results"].' (<a href="#BefOffen">'.$LDBefV["pending"].'</a> ';
            echo '<FONT size="0" face="Arial"><a href="#BefFertig">'.$LDBefV["done"].'</a>) ';
             echo '<FONT size="0" face="Arial"></td></tr></table>';
      echo '<table id="TabBefFertig" border="0" width="100%">';
        echo '<tr>';
         echo '<td width="5%" valign="top" align="'.$TP_ALIGN.'" bgcolor="#b7d3ff"><FONT size="0" face="Arial"></font></td>'; //Auswahl
         echo '<td width="10%" valign="top" align="'.$TP_ALIGN.'" bgcolor="#b7d3ff"><FONT size="0" face="Arial">'.$LDBefV["date"].'</font></td>'; //letzte Bearbeitung Datum
         echo '<td width="10%" valign="top" align="'.$TP_ALIGN.'" bgcolor="#b7d3ff"><FONT size="0" face="Arial">'.$LDBefV["doctor"].'</font></td>'; //Arzt
         echo '<td width="10%" valign="top" align="'.$TP_ALIGN.'" bgcolor="#b7d3ff"><FONT size="0" face="Arial">'.$LDBefV["pidfid"].'</font></td>'; //FID
         echo '<td width="10%" valign="top" align="'.$TP_ALIGN.'" bgcolor="#b7d3ff"><FONT size="0" face="Arial">'.$LDBefV["patname"].'</font></td>'; //Patientenname
         echo '<td width="10%" valign="top" align="'.$TP_ALIGN.'" bgcolor="#b7d3ff"><FONT size="0" face="Arial">'.$LDBefV["result#order#"].'</font></td>'; //Anforderungsnr
         echo '<td width="50%" valign="top" align="'.$TP_ALIGN.'" bgcolor="#b7d3ff"><FONT size="0" face="Arial">'.$LDBefV["text"].'</font></td>'; //Befundtext
       echo '</tr>';
          //Lese Result Tabelle
          $sql="SELECT *
                FROM mycare_result
                where result_department_nr='".$my_dep_nr."'
                and result_status='done'
                order by result_date desc"; //echo $sql;
          $ok=$db->Execute($sql);
          while ($erg=$ok->FetchRow()) {
                 if ($color=="#eeeeee") $color="#ffffff"; else $color="#eeeeee";
                   echo '<td width="5%" valign="top" align="'.$TP_ALIGN.'" bgcolor="'.$color.'"><FONT size="0" face="Arial">';
                   //echo '<input type="image" src="pfeil.gif" onclick="startBefund('.$erg[result_fid].','.$erg[result_fid].','.$erg[result_id].');">    </font>'; //Auswahl
                   echo '<input type="image" src="befdruck.gif" onclick="druckBefund('.$erg[result_pid].','.$erg[result_fid].','.$erg[result_id].','.$null.');"></font></td>'; //Auswahl
                   echo '<td width="10%" valign="top" align="'.$TP_ALIGN.'" bgcolor="'.$color.'"><FONT size="0" face="Arial">'.formatDate2Local($erg[result_date],$date_format).'</font></td>'; //Sende Datum
                   echo '<td width="10%" valign="top" align="'.$TP_ALIGN.'" bgcolor="'.$color.'"><FONT size="0" face="Arial">'.$erg[result_dr].'</font></td>'; //Arzt
                   echo '<td width="10%" valign="top" align="'.$TP_ALIGN.'" bgcolor="'.$color.'"><FONT size="0" face="Arial">'.$erg[result_pid]."<br>".$erg[result_fid].'</font></td>'; //FID
                   echo '<td width="10%" valign="top" align="'.$TP_ALIGN.'" bgcolor="'.$color.'"><FONT size="0" face="Arial">'.PatName($erg[result_pid]).'</font></td>'; //Patientenname
                   echo '<td width="10%" valign="top" align="'.$TP_ALIGN.'" bgcolor="'.$color.'"><FONT size="0" face="Arial">'.$erg[result_id].'<br>'.$erg[result_request_nr].'</font></td>'; //Anforderungsnr
                   echo '<td width="50%" valign="top" align="'.$TP_ALIGN.'" bgcolor="'.$color.'"><FONT size="0" face="Arial">'.substr(stripText($erg[result_text]),0,400).'</font></td>'; //Befundtext
         echo '</tr>';
                 }
        echo '</table>';

?>

<br><br><br>
<INPUT TYPE="hidden"  name="myArzt" value="<? echo $my_user; ?>">
<INPUT TYPE="hidden"  name="myDep" value="<? echo $my_dep; ?>">
<INPUT TYPE="hidden"  name="myDepNr" value="<? echo $my_dep_nr; ?>">
<input type="hidden" name="modus">
</form>

</body>
</html>
