<?PHP
//***Variablen für dieses Modul setzen***
//Variable für Individual-Sprachdateisetzen, Ausgabetext sollte in Variablen hier abgelegt werden.
$lang_thismodule_used="Befundverwaltung.php";
// Variable für den Cookie setzen
$this_cookie_name="ck_Befundverwaltung_user";
//Hilfedatei Variable setzen
$new_hlp_file="Befundverwaltung_hlp.php";
//Variable für Überschrift der Titelleseite, des Submenüs o.ä.
$thismodulname="Befundverwaltung";
//Standardpfadangaben laden
require("./roots.php");
// Error Meldungen unterdrücken, inc_environment_global.php includen, Standard-Sprachdateien einbinden,
// Dateischutz etc.
require($root_path."modules/Befundverwaltung/inc_modul_top.php");
// Den <HEAD> includen
$returnfile="sub_Befundverwaltung.php".URL_APPEND;
$breakfile=$root_path."main/startframe.php".URL_APPEND;
require($root_path."modules/Befundverwaltung/head_include.inc.php");
// Den <BODY> includen 
require($root_path."modules/Befundverwaltung/inc_body.php");
// den blauen Titelblock einbinden
require($root_path."modules/Befundverwaltung/inc_titelblock.php");
/*****************************************/
// Eigener Code folgt ab hier.
// Verweis auf die Datei mit DBForm.
/*****************************************/
?><form name="Befundverwaltung" action="<?php echo '../../modules/Befundverwaltung/Befundverwaltung_dbform.php?sid=$sid&lang=$lang'?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="hidden" name="pid" value="<?php echo $pid; ?>">
<input type="hidden" name="depnr" value="<?php echo $depnr; ?>">

<script type="text/javascript" >
document.Befundverwaltung.submit();
</script>
<input type="submit" name="los" value="Tabelle öffnen">
</form><?php
require($root_path."modules/system_new_module/includes/footnote.inc.php");
