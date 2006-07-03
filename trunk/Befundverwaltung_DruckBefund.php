<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
require_once($root_path.'include/inc_date_format_functions.php'); // Load the date formatter
define('LANG_FILE','Befundverwaltung.php');
require_once($root_path.'include/inc_front_chain_lang.php');

html_rtl($lang);
echo '<HEAD>';
echo setCharSet();


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<!-- Creation Date: <?=Date("d/m/Y")?> -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="Generator" content="Dev-PHP 1.9.4">
<?php echo '<title>'.$LDBefV["printtitle"].'</title>'; ?>
</head>
<body>

<?php
$my_result = $HTTP_GET_VARS["result"];
$my_dep = $HTTP_GET_VARS["dep"];

// Drucke result
    $sql="select result_text FROM mycare_result WHERE result_id='".$my_result."'";
    $ok=$db->Execute($sql);
    if ($erg=$ok->FetchRow()) {

        //Formular Kopf
        if (file_exists ("../../bausteine/".$my_dep."/formkopf.htm")){
            $lines = file ("../../bausteine/".$my_dep."/formkopf.htm");
            foreach ($lines as $line_num => $line) {
                     echo $line;
                     }
            }

        //Formulartext
        echo $erg[result_text];

        if (file_exists ("../../bausteine/".$my_dep."/formend.htm")){
            $lines = file ("../../bausteine/".$my_dep."/formend.htm");
            foreach ($lines as $line_num => $line) {
                     echo $line;
                     }
            }
        }

echo '<script type="text/javascript" >';
echo 'window.print();';
echo 'window.close();';

echo '</script>';


?>
</body>
</html>
