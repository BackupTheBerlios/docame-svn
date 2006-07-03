/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE=NO_AUTO_VALUE_ON_ZERO */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/ `care2x`;
USE `care2x`;
CREATE TABLE `care_menu_main` (
  `nr` tinyint(3) unsigned NOT NULL auto_increment,
  `sort_nr` tinyint(2) NOT NULL default '0',
  `name` varchar(35) NOT NULL default '',
  `LD_var` varchar(35) NOT NULL default '',
  `url` varchar(255) NOT NULL default '',
  `is_visible` tinyint(1) unsigned NOT NULL default '1',
  `hide_by` text,
  `status` varchar(25) NOT NULL default '',
  `modify_id` timestamp(14) NOT NULL,
  `modify_time` timestamp(14) NOT NULL default '00000000000000',
  PRIMARY KEY  (`nr`)
) TYPE=MyISAM;
INSERT INTO `care_menu_main` (`nr`,`sort_nr`,`name`,`LD_var`,`url`,`is_visible`,`hide_by`,`status`,`modify_id`,`modify_time`) VALUES (1,3,'Home','LDHome','main/startframe.php',1,'','',20040612003103,00000000000000),(2,7,'Person','LDPerson','modules/registration_admission/patient.php',1,'','',20040612003103,00000000000000),(3,12,'Admission','LDAdmission','modules/registration_admission/aufnahme_pass.php',1,'','',20040612003103,00000000000000),(4,17,'Ambulatory','LDAmbulatory','modules/ambulatory/ambulatory.php',1,'','',20040612003103,00000000000000),(5,25,'Medocs','LDMedocs','modules/medocs/medocs_pass.php',1,'','',20040710223651,00000000000000),(6,30,'Doctors','LDDoctors','modules/doctors/doctors.php',1,'','',20040710223651,00000000000000),(7,40,'Nursing','LDNursing','modules/nursing/nursing.php',1,'','',20040710223651,00000000000000),(8,45,'OR','LDOR','main/op-doku.php',1,'','',20040710223651,00000000000000),(9,50,'Laboratories','LDLabs','modules/laboratory/labor.php',1,'','',20040710223651,00000000000000),(10,55,'Radiology','LDRadiology','modules/radiology/radiolog.php',1,'','',20040710223651,00000000000000);
INSERT INTO `care_menu_main` (`nr`,`sort_nr`,`name`,`LD_var`,`url`,`is_visible`,`hide_by`,`status`,`modify_id`,`modify_time`) VALUES (11,60,'Pharmacy','LDPharmacy','modules/pharmacy/apotheke.php',1,'','',20040710223651,00000000000000),(12,65,'Medical Depot','LDMedDepot','modules/med_depot/medlager.php',1,'','',20040710223651,00000000000000),(13,70,'Directory','LDDirectory','modules/phone_directory/phone.php',1,'','',20040710223651,00000000000000),(14,75,'Tech Support','LDTechSupport','modules/tech/technik.php',1,'','',20040710223651,00000000000000),(15,77,'EDP','LDEDP','modules/system_admin/edv.php',1,'','',20040710223651,00000000000000),(16,80,'Intranet Email','LDIntraEmail','modules/intranet_email/intra-email-pass.php',0,'','',20040710223651,00000000000000),(17,85,'Internet Email','LDInterEmail','modules/nocc/index.php',0,'','',20040710223651,00000000000000),(18,90,'Special Tools','LDSpecials','main/spediens.php',1,'','',20040710223651,00000000000000),(19,95,'Login','LDLogin','main/login.php',1,'','',20040710223651,00000000000000),(20,9,'Appointments','LDAppointments','modules/appointment_scheduler/appt_main_pass.php',1,'','',20040612003103,20030405000145);
INSERT INTO `care_menu_main` (`nr`,`sort_nr`,`name`,`LD_var`,`url`,`is_visible`,`hide_by`,`status`,`modify_id`,`modify_time`) VALUES (25,22,'Befundverwaltung','LDBefundverwaltung','modules/Befundverwaltung/sub_Befundverwaltung.php',1,NULL,'',20040710223651,00000000000000),(23,21,'Leistungserfassung','LDmobil','modules/mobil/sub_mobil.php',1,NULL,'',20040703235802,00000000000000);
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
