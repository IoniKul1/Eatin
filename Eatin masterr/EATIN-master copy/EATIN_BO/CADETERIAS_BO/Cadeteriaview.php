<?php
namespace PHPMaker2020\BACKOFFICE_CADETERIAS;

// Autoload
include_once "autoload.php";

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	\Delight\Cookie\Session::start(Config("COOKIE_SAMESITE")); // Init session data

// Output buffering
ob_start();
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$Cadeteria_view = new Cadeteria_view();

// Run the page
$Cadeteria_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Cadeteria_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$Cadeteria_view->isExport()) { ?>
<script>
var fCadeteriaview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fCadeteriaview = currentForm = new ew.Form("fCadeteriaview", "view");
	loadjs.done("fCadeteriaview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$Cadeteria_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Cadeteria_view->ExportOptions->render("body") ?>
<?php $Cadeteria_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $Cadeteria_view->showPageHeader(); ?>
<?php
$Cadeteria_view->showMessage();
?>
<form name="fCadeteriaview" id="fCadeteriaview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Cadeteria">
<input type="hidden" name="modal" value="<?php echo (int)$Cadeteria_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Cadeteria_view->ID->Visible) { // ID ?>
	<tr id="r_ID">
		<td class="<?php echo $Cadeteria_view->TableLeftColumnClass ?>"><span id="elh_Cadeteria_ID"><?php echo $Cadeteria_view->ID->caption() ?></span></td>
		<td data-name="ID" <?php echo $Cadeteria_view->ID->cellAttributes() ?>>
<span id="el_Cadeteria_ID">
<span<?php echo $Cadeteria_view->ID->viewAttributes() ?>><?php echo $Cadeteria_view->ID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Cadeteria_view->ID_Status->Visible) { // ID_Status ?>
	<tr id="r_ID_Status">
		<td class="<?php echo $Cadeteria_view->TableLeftColumnClass ?>"><span id="elh_Cadeteria_ID_Status"><?php echo $Cadeteria_view->ID_Status->caption() ?></span></td>
		<td data-name="ID_Status" <?php echo $Cadeteria_view->ID_Status->cellAttributes() ?>>
<span id="el_Cadeteria_ID_Status">
<span<?php echo $Cadeteria_view->ID_Status->viewAttributes() ?>><?php echo $Cadeteria_view->ID_Status->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Cadeteria_view->Nombre->Visible) { // Nombre ?>
	<tr id="r_Nombre">
		<td class="<?php echo $Cadeteria_view->TableLeftColumnClass ?>"><span id="elh_Cadeteria_Nombre"><?php echo $Cadeteria_view->Nombre->caption() ?></span></td>
		<td data-name="Nombre" <?php echo $Cadeteria_view->Nombre->cellAttributes() ?>>
<span id="el_Cadeteria_Nombre">
<span<?php echo $Cadeteria_view->Nombre->viewAttributes() ?>><?php echo $Cadeteria_view->Nombre->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Cadeteria_view->Lat->Visible) { // Lat ?>
	<tr id="r_Lat">
		<td class="<?php echo $Cadeteria_view->TableLeftColumnClass ?>"><span id="elh_Cadeteria_Lat"><?php echo $Cadeteria_view->Lat->caption() ?></span></td>
		<td data-name="Lat" <?php echo $Cadeteria_view->Lat->cellAttributes() ?>>
<span id="el_Cadeteria_Lat">
<span<?php echo $Cadeteria_view->Lat->viewAttributes() ?>><?php echo $Cadeteria_view->Lat->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Cadeteria_view->Lon->Visible) { // Lon ?>
	<tr id="r_Lon">
		<td class="<?php echo $Cadeteria_view->TableLeftColumnClass ?>"><span id="elh_Cadeteria_Lon"><?php echo $Cadeteria_view->Lon->caption() ?></span></td>
		<td data-name="Lon" <?php echo $Cadeteria_view->Lon->cellAttributes() ?>>
<span id="el_Cadeteria_Lon">
<span<?php echo $Cadeteria_view->Lon->viewAttributes() ?>><?php echo $Cadeteria_view->Lon->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Cadeteria_view->_Email->Visible) { // Email ?>
	<tr id="r__Email">
		<td class="<?php echo $Cadeteria_view->TableLeftColumnClass ?>"><span id="elh_Cadeteria__Email"><?php echo $Cadeteria_view->_Email->caption() ?></span></td>
		<td data-name="_Email" <?php echo $Cadeteria_view->_Email->cellAttributes() ?>>
<span id="el_Cadeteria__Email">
<span<?php echo $Cadeteria_view->_Email->viewAttributes() ?>><?php echo $Cadeteria_view->_Email->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Cadeteria_view->Hashpass->Visible) { // Hashpass ?>
	<tr id="r_Hashpass">
		<td class="<?php echo $Cadeteria_view->TableLeftColumnClass ?>"><span id="elh_Cadeteria_Hashpass"><?php echo $Cadeteria_view->Hashpass->caption() ?></span></td>
		<td data-name="Hashpass" <?php echo $Cadeteria_view->Hashpass->cellAttributes() ?>>
<span id="el_Cadeteria_Hashpass">
<span<?php echo $Cadeteria_view->Hashpass->viewAttributes() ?>><?php echo $Cadeteria_view->Hashpass->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Cadeteria_view->fMult1->Visible) { // fMult1 ?>
	<tr id="r_fMult1">
		<td class="<?php echo $Cadeteria_view->TableLeftColumnClass ?>"><span id="elh_Cadeteria_fMult1"><?php echo $Cadeteria_view->fMult1->caption() ?></span></td>
		<td data-name="fMult1" <?php echo $Cadeteria_view->fMult1->cellAttributes() ?>>
<span id="el_Cadeteria_fMult1">
<span<?php echo $Cadeteria_view->fMult1->viewAttributes() ?>><?php echo $Cadeteria_view->fMult1->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Cadeteria_view->fMult2->Visible) { // fMult2 ?>
	<tr id="r_fMult2">
		<td class="<?php echo $Cadeteria_view->TableLeftColumnClass ?>"><span id="elh_Cadeteria_fMult2"><?php echo $Cadeteria_view->fMult2->caption() ?></span></td>
		<td data-name="fMult2" <?php echo $Cadeteria_view->fMult2->cellAttributes() ?>>
<span id="el_Cadeteria_fMult2">
<span<?php echo $Cadeteria_view->fMult2->viewAttributes() ?>><?php echo $Cadeteria_view->fMult2->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$Cadeteria_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$Cadeteria_view->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$Cadeteria_view->terminate();
?>