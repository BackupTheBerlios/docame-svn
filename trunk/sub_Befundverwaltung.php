<?PHP
//***Variablen f�r dieses Modul setzen***
//Variable f�r Individual-Sprachdateisetzen, Ausgabetext sollte in Variablen hier abgelegt werden.
$lang_thismodule_used="Befundverwaltung.php";
//Hilfedatei
$new_hlp_file="Befundverwaltung_hlp.php";
//Variable f�r �berschrift der Titelleseite, des Submen�s o.�.
$thismodulname=Befundverwaltung;
require("./roots.php");
// Error Meldungen unterdr�cken, inc_environment_global.php includen, Standard-Sprachdateien einbinden,
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
// Submen� anstarten.
/*****************************************/
require($root_path."modules/Befundverwaltung/submenu1.php");
require($root_path."modules/system_new_module/includes/footnote.inc.php");
