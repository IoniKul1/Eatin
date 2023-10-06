<?php
namespace PHPMaker2020\EATIN_BO;

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
$Categorias_view = new Categorias_view();

// Run the page
$Categorias_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Categorias_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$Categorias_view->isExport()) { ?>
<script>
var fCategoriasview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fCategoriasview = currentForm = new ew.Form("fCategoriasview", "view");
	loadjs.done("fCategoriasview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$Categorias_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Categorias_view->ExportOptions->render("body") ?>
<?php $Categorias_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $Categorias_view->showPageHeader(); ?>
<?php
$Categorias_view->showMessage();
?>
<form name="fCategoriasview" id="fCategoriasview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Categorias">
<input type="hidden" name="modal" value="<?php echo (int)$Categorias_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Categorias_view->ID->Visible) { // ID ?>
	<tr id="r_ID">
		<td class="<?php echo $Categorias_view->TableLeftColumnClass ?>"><span id="elh_Categorias_ID"><?php echo $Categorias_view->ID->caption() ?></span></td>
		<td data-name="ID" <?php echo $Categorias_view->ID->cellAttributes() ?>>
<span id="el_Categorias_ID">
<span<?php echo $Categorias_view->ID->viewAttributes() ?>><?php echo $Categorias_view->ID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Categorias_view->ID_Restaurant->Visible) { // ID_Restaurant ?>
	<tr id="r_ID_Restaurant">
		<td class="<?php echo $Categorias_view->TableLeftColumnClass ?>"><span id="elh_Categorias_ID_Restaurant"><?php echo $Categorias_view->ID_Restaurant->caption() ?></span></td>
		<td data-name="ID_Restaurant" <?php echo $Categorias_view->ID_Restaurant->cellAttributes() ?>>
<span id="el_Categorias_ID_Restaurant">
<span<?php echo $Categorias_view->ID_Restaurant->viewAttributes() ?>><?php echo $Categorias_view->ID_Restaurant->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Categorias_view->DateCreation->Visible) { // DateCreation ?>
	<tr id="r_DateCreation">
		<td class="<?php echo $Categorias_view->TableLeftColumnClass ?>"><span id="elh_Categorias_DateCreation"><?php echo $Categorias_view->DateCreation->caption() ?></span></td>
		<td data-name="DateCreation" <?php echo $Categorias_view->DateCreation->cellAttributes() ?>>
<span id="el_Categorias_DateCreation">
<span<?php echo $Categorias_view->DateCreation->viewAttributes() ?>><?php echo $Categorias_view->DateCreation->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Categorias_view->DateLastUpdate->Visible) { // DateLastUpdate ?>
	<tr id="r_DateLastUpdate">
		<td class="<?php echo $Categorias_view->TableLeftColumnClass ?>"><span id="elh_Categorias_DateLastUpdate"><?php echo $Categorias_view->DateLastUpdate->caption() ?></span></td>
		<td data-name="DateLastUpdate" <?php echo $Categorias_view->DateLastUpdate->cellAttributes() ?>>
<span id="el_Categorias_DateLastUpdate">
<span<?php echo $Categorias_view->DateLastUpdate->viewAttributes() ?>><?php echo $Categorias_view->DateLastUpdate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Categorias_view->Active->Visible) { // Active ?>
	<tr id="r_Active">
		<td class="<?php echo $Categorias_view->TableLeftColumnClass ?>"><span id="elh_Categorias_Active"><?php echo $Categorias_view->Active->caption() ?></span></td>
		<td data-name="Active" <?php echo $Categorias_view->Active->cellAttributes() ?>>
<span id="el_Categorias_Active">
<span<?php echo $Categorias_view->Active->viewAttributes() ?>><?php echo $Categorias_view->Active->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Categorias_view->Nombre->Visible) { // Nombre ?>
	<tr id="r_Nombre">
		<td class="<?php echo $Categorias_view->TableLeftColumnClass ?>"><span id="elh_Categorias_Nombre"><?php echo $Categorias_view->Nombre->caption() ?></span></td>
		<td data-name="Nombre" <?php echo $Categorias_view->Nombre->cellAttributes() ?>>
<span id="el_Categorias_Nombre">
<span<?php echo $Categorias_view->Nombre->viewAttributes() ?>><?php echo $Categorias_view->Nombre->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Categorias_view->NombreEN->Visible) { // NombreEN ?>
	<tr id="r_NombreEN">
		<td class="<?php echo $Categorias_view->TableLeftColumnClass ?>"><span id="elh_Categorias_NombreEN"><?php echo $Categorias_view->NombreEN->caption() ?></span></td>
		<td data-name="NombreEN" <?php echo $Categorias_view->NombreEN->cellAttributes() ?>>
<span id="el_Categorias_NombreEN">
<span<?php echo $Categorias_view->NombreEN->viewAttributes() ?>><?php echo $Categorias_view->NombreEN->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("Items", explode(",", $Categorias->getCurrentDetailTable())) && $Items->DetailView) {
?>
<?php if ($Categorias->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("Items", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "Itemsgrid.php" ?>
<?php } ?>
</form>
<?php
$Categorias_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$Categorias_view->isExport()) { ?>
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
$Categorias_view->terminate();
?>