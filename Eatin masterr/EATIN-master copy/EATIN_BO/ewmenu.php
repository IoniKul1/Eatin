<?php
namespace PHPMaker2020\EATIN_BO;

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
$sideMenu->addMenuItem(1, "mi_Categorias", $MenuLanguage->MenuPhrase("1", "MenuText"), $MenuRelativePath . "Categoriaslist.php?cmd=resetall", -1, "", IsLoggedIn() || AllowListMenu('{CC19BE4C-23D6-4992-89EF-6304995797F2}Categorias'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(2, "mi_Checkin", $MenuLanguage->MenuPhrase("2", "MenuText"), $MenuRelativePath . "Checkinlist.php?cmd=resetall", -1, "", IsLoggedIn() || AllowListMenu('{CC19BE4C-23D6-4992-89EF-6304995797F2}Checkin'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(3, "mi_Client", $MenuLanguage->MenuPhrase("3", "MenuText"), $MenuRelativePath . "Clientlist.php?cmd=resetall", -1, "", IsLoggedIn() || AllowListMenu('{CC19BE4C-23D6-4992-89EF-6304995797F2}Client'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(4, "mi_ItemOptions", $MenuLanguage->MenuPhrase("4", "MenuText"), $MenuRelativePath . "ItemOptionslist.php", -1, "", IsLoggedIn() || AllowListMenu('{CC19BE4C-23D6-4992-89EF-6304995797F2}ItemOptions'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(5, "mi_Items", $MenuLanguage->MenuPhrase("5", "MenuText"), $MenuRelativePath . "Itemslist.php?cmd=resetall", -1, "", IsLoggedIn() || AllowListMenu('{CC19BE4C-23D6-4992-89EF-6304995797F2}Items'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(7, "mi_Pedido", $MenuLanguage->MenuPhrase("7", "MenuText"), $MenuRelativePath . "Pedidolist.php?cmd=resetall", -1, "", IsLoggedIn() || AllowListMenu('{CC19BE4C-23D6-4992-89EF-6304995797F2}Pedido'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(8, "mi_Restaurant", $MenuLanguage->MenuPhrase("8", "MenuText"), $MenuRelativePath . "Restaurantlist.php", -1, "", IsLoggedIn() || AllowListMenu('{CC19BE4C-23D6-4992-89EF-6304995797F2}Restaurant'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(10, "mi__Table", $MenuLanguage->MenuPhrase("10", "MenuText"), $MenuRelativePath . "_Tablelist.php?cmd=resetall", -1, "", IsLoggedIn() || AllowListMenu('{CC19BE4C-23D6-4992-89EF-6304995797F2}Table'), FALSE, FALSE, "", "", FALSE);
echo $sideMenu->toScript();
?>