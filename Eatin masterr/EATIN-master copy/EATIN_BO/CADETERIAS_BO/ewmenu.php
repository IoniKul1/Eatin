<?php
namespace PHPMaker2020\BACKOFFICE_CADETERIAS;

// Menu Language
if ($Language && function_exists(PROJECT_NAMESPACE . "Config") && $Language->LanguageFolder == Config("LANGUAGE_FOLDER")) {
	$MenuRelativePath = "";
	$MenuLanguage = &$Language;
} else { // Compat reports
	$LANGUAGE_FOLDER = "../lang/";
	$MenuRelativePath = "../";
	$MenuLanguage = new Language();
}

// Navbar menu
$topMenu = new Menu("navbar", TRUE, TRUE);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", TRUE, FALSE);
$sideMenu->addMenuItem(1, "mi_Cadete", $MenuLanguage->MenuPhrase("1", "MenuText"), $MenuRelativePath . "Cadetelist.php", -1, "", IsLoggedIn() || AllowListMenu('{68D35137-1670-419B-B841-52FFD5E14A4B}Cadete'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(2, "mi_Cadeteria", $MenuLanguage->MenuPhrase("2", "MenuText"), $MenuRelativePath . "Cadeterialist.php", -1, "", IsLoggedIn() || AllowListMenu('{68D35137-1670-419B-B841-52FFD5E14A4B}Cadeteria'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(4, "mi_Checkin", $MenuLanguage->MenuPhrase("4", "MenuText"), $MenuRelativePath . "Checkinlist.php", -1, "", IsLoggedIn() || AllowListMenu('{68D35137-1670-419B-B841-52FFD5E14A4B}Checkin'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(5, "mi_Checkout", $MenuLanguage->MenuPhrase("5", "MenuText"), $MenuRelativePath . "Checkoutlist.php", -1, "", IsLoggedIn() || AllowListMenu('{68D35137-1670-419B-B841-52FFD5E14A4B}Checkout'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(11, "mi_PedidoACadeteria", $MenuLanguage->MenuPhrase("11", "MenuText"), $MenuRelativePath . "PedidoACadeterialist.php", -1, "", IsLoggedIn() || AllowListMenu('{68D35137-1670-419B-B841-52FFD5E14A4B}PedidoACadeteria'), FALSE, FALSE, "", "", FALSE);
echo $sideMenu->toScript();
?>