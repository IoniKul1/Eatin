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
$Cadete_view = new Cadete_view();

// Run the page
$Cadete_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Cadete_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$Cadete_view->isExport()) { ?>
<script>
var fCadeteview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fCadeteview = currentForm = new ew.Form("fCadeteview", "view");
	loadjs.done("fCadeteview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$Cadete_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Cadete_view->ExportOptions->render("body") ?>
<?php $Cadete_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $Cadete_view->showPageHeader(); ?>
<?php
$Cadete_view->showMessage();
?>
<form name="fCadeteview" id="fCadeteview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Cadete">
<input type="hidden" name="modal" value="<?php echo (int)$Cadete_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Cadete_view->ID->Visible) { // ID ?>
	<tr id="r_ID">
		<td class="<?php echo $Cadete_view->TableLeftColumnClass ?>"><span id="elh_Cadete_ID"><?php echo $Cadete_view->ID->caption() ?></span></td>
		<td data-name="ID" <?php echo $Cadete_view->ID->cellAttributes() ?>>
<span id="el_Cadete_ID">
<span<?php echo $Cadete_view->ID->viewAttributes() ?>><?php echo $Cadete_view->ID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Cadete_view->FechaCreacion->Visible) { // FechaCreacion ?>
	<tr id="r_FechaCreacion">
		<td class="<?php echo $Cadete_view->TableLeftColumnClass ?>"><span id="elh_Cadete_FechaCreacion"><?php echo $Cadete_view->FechaCreacion->caption() ?></span></td>
		<td data-name="FechaCreacion" <?php echo $Cadete_view->FechaCreacion->cellAttributes() ?>>
<span id="el_Cadete_FechaCreacion">
<span<?php echo $Cadete_view->FechaCreacion->viewAttributes() ?>><?php echo $Cadete_view->FechaCreacion->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Cadete_view->ID_Cadeteria->Visible) { // ID_Cadeteria ?>
	<tr id="r_ID_Cadeteria">
		<td class="<?php echo $Cadete_view->TableLeftColumnClass ?>"><span id="elh_Cadete_ID_Cadeteria"><?php echo $Cadete_view->ID_Cadeteria->caption() ?></span></td>
		<td data-name="ID_Cadeteria" <?php echo $Cadete_view->ID_Cadeteria->cellAttributes() ?>>
<span id="el_Cadete_ID_Cadeteria">
<span<?php echo $Cadete_view->ID_Cadeteria->viewAttributes() ?>><?php echo $Cadete_view->ID_Cadeteria->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Cadete_view->ID_Status->Visible) { // ID_Status ?>
	<tr id="r_ID_Status">
		<td class="<?php echo $Cadete_view->TableLeftColumnClass ?>"><span id="elh_Cadete_ID_Status"><?php echo $Cadete_view->ID_Status->caption() ?></span></td>
		<td data-name="ID_Status" <?php echo $Cadete_view->ID_Status->cellAttributes() ?>>
<span id="el_Cadete_ID_Status">
<span<?php echo $Cadete_view->ID_Status->viewAttributes() ?>><?php echo $Cadete_view->ID_Status->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Cadete_view->ID_CurrentStatus->Visible) { // ID_CurrentStatus ?>
	<tr id="r_ID_CurrentStatus">
		<td class="<?php echo $Cadete_view->TableLeftColumnClass ?>"><span id="elh_Cadete_ID_CurrentStatus"><?php echo $Cadete_view->ID_CurrentStatus->caption() ?></span></td>
		<td data-name="ID_CurrentStatus" <?php echo $Cadete_view->ID_CurrentStatus->cellAttributes() ?>>
<span id="el_Cadete_ID_CurrentStatus">
<span<?php echo $Cadete_view->ID_CurrentStatus->viewAttributes() ?>><?php echo $Cadete_view->ID_CurrentStatus->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Cadete_view->Nombre->Visible) { // Nombre ?>
	<tr id="r_Nombre">
		<td class="<?php echo $Cadete_view->TableLeftColumnClass ?>"><span id="elh_Cadete_Nombre"><?php echo $Cadete_view->Nombre->caption() ?></span></td>
		<td data-name="Nombre" <?php echo $Cadete_view->Nombre->cellAttributes() ?>>
<span id="el_Cadete_Nombre">
<span<?php echo $Cadete_view->Nombre->viewAttributes() ?>><?php echo $Cadete_view->Nombre->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Cadete_view->Apellido->Visible) { // Apellido ?>
	<tr id="r_Apellido">
		<td class="<?php echo $Cadete_view->TableLeftColumnClass ?>"><span id="elh_Cadete_Apellido"><?php echo $Cadete_view->Apellido->caption() ?></span></td>
		<td data-name="Apellido" <?php echo $Cadete_view->Apellido->cellAttributes() ?>>
<span id="el_Cadete_Apellido">
<span<?php echo $Cadete_view->Apellido->viewAttributes() ?>><?php echo $Cadete_view->Apellido->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Cadete_view->DNI->Visible) { // DNI ?>
	<tr id="r_DNI">
		<td class="<?php echo $Cadete_view->TableLeftColumnClass ?>"><span id="elh_Cadete_DNI"><?php echo $Cadete_view->DNI->caption() ?></span></td>
		<td data-name="DNI" <?php echo $Cadete_view->DNI->cellAttributes() ?>>
<span id="el_Cadete_DNI">
<span<?php echo $Cadete_view->DNI->viewAttributes() ?>><?php echo $Cadete_view->DNI->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Cadete_view->Celular->Visible) { // Celular ?>
	<tr id="r_Celular">
		<td class="<?php echo $Cadete_view->TableLeftColumnClass ?>"><span id="elh_Cadete_Celular"><?php echo $Cadete_view->Celular->caption() ?></span></td>
		<td data-name="Celular" <?php echo $Cadete_view->Celular->cellAttributes() ?>>
<span id="el_Cadete_Celular">
<span<?php echo $Cadete_view->Celular->viewAttributes() ?>><?php echo $Cadete_view->Celular->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Cadete_view->Domicilio->Visible) { // Domicilio ?>
	<tr id="r_Domicilio">
		<td class="<?php echo $Cadete_view->TableLeftColumnClass ?>"><span id="elh_Cadete_Domicilio"><?php echo $Cadete_view->Domicilio->caption() ?></span></td>
		<td data-name="Domicilio" <?php echo $Cadete_view->Domicilio->cellAttributes() ?>>
<span id="el_Cadete_Domicilio">
<span<?php echo $Cadete_view->Domicilio->viewAttributes() ?>><?php echo $Cadete_view->Domicilio->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Cadete_view->RealLat->Visible) { // RealLat ?>
	<tr id="r_RealLat">
		<td class="<?php echo $Cadete_view->TableLeftColumnClass ?>"><span id="elh_Cadete_RealLat"><?php echo $Cadete_view->RealLat->caption() ?></span></td>
		<td data-name="RealLat" <?php echo $Cadete_view->RealLat->cellAttributes() ?>>
<span id="el_Cadete_RealLat">
<span<?php echo $Cadete_view->RealLat->viewAttributes() ?>><?php echo $Cadete_view->RealLat->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Cadete_view->RealLon->Visible) { // RealLon ?>
	<tr id="r_RealLon">
		<td class="<?php echo $Cadete_view->TableLeftColumnClass ?>"><span id="elh_Cadete_RealLon"><?php echo $Cadete_view->RealLon->caption() ?></span></td>
		<td data-name="RealLon" <?php echo $Cadete_view->RealLon->cellAttributes() ?>>
<span id="el_Cadete_RealLon">
<span<?php echo $Cadete_view->RealLon->viewAttributes() ?>><?php echo $Cadete_view->RealLon->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Cadete_view->EstimatedLat->Visible) { // EstimatedLat ?>
	<tr id="r_EstimatedLat">
		<td class="<?php echo $Cadete_view->TableLeftColumnClass ?>"><span id="elh_Cadete_EstimatedLat"><?php echo $Cadete_view->EstimatedLat->caption() ?></span></td>
		<td data-name="EstimatedLat" <?php echo $Cadete_view->EstimatedLat->cellAttributes() ?>>
<span id="el_Cadete_EstimatedLat">
<span<?php echo $Cadete_view->EstimatedLat->viewAttributes() ?>><?php echo $Cadete_view->EstimatedLat->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Cadete_view->EstimatedLon->Visible) { // EstimatedLon ?>
	<tr id="r_EstimatedLon">
		<td class="<?php echo $Cadete_view->TableLeftColumnClass ?>"><span id="elh_Cadete_EstimatedLon"><?php echo $Cadete_view->EstimatedLon->caption() ?></span></td>
		<td data-name="EstimatedLon" <?php echo $Cadete_view->EstimatedLon->cellAttributes() ?>>
<span id="el_Cadete_EstimatedLon">
<span<?php echo $Cadete_view->EstimatedLon->viewAttributes() ?>><?php echo $Cadete_view->EstimatedLon->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Cadete_view->LUDesde->Visible) { // LUDesde ?>
	<tr id="r_LUDesde">
		<td class="<?php echo $Cadete_view->TableLeftColumnClass ?>"><span id="elh_Cadete_LUDesde"><?php echo $Cadete_view->LUDesde->caption() ?></span></td>
		<td data-name="LUDesde" <?php echo $Cadete_view->LUDesde->cellAttributes() ?>>
<span id="el_Cadete_LUDesde">
<span<?php echo $Cadete_view->LUDesde->viewAttributes() ?>><?php echo $Cadete_view->LUDesde->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Cadete_view->LUHasta->Visible) { // LUHasta ?>
	<tr id="r_LUHasta">
		<td class="<?php echo $Cadete_view->TableLeftColumnClass ?>"><span id="elh_Cadete_LUHasta"><?php echo $Cadete_view->LUHasta->caption() ?></span></td>
		<td data-name="LUHasta" <?php echo $Cadete_view->LUHasta->cellAttributes() ?>>
<span id="el_Cadete_LUHasta">
<span<?php echo $Cadete_view->LUHasta->viewAttributes() ?>><?php echo $Cadete_view->LUHasta->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Cadete_view->MADesde->Visible) { // MADesde ?>
	<tr id="r_MADesde">
		<td class="<?php echo $Cadete_view->TableLeftColumnClass ?>"><span id="elh_Cadete_MADesde"><?php echo $Cadete_view->MADesde->caption() ?></span></td>
		<td data-name="MADesde" <?php echo $Cadete_view->MADesde->cellAttributes() ?>>
<span id="el_Cadete_MADesde">
<span<?php echo $Cadete_view->MADesde->viewAttributes() ?>><?php echo $Cadete_view->MADesde->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Cadete_view->MAHasta->Visible) { // MAHasta ?>
	<tr id="r_MAHasta">
		<td class="<?php echo $Cadete_view->TableLeftColumnClass ?>"><span id="elh_Cadete_MAHasta"><?php echo $Cadete_view->MAHasta->caption() ?></span></td>
		<td data-name="MAHasta" <?php echo $Cadete_view->MAHasta->cellAttributes() ?>>
<span id="el_Cadete_MAHasta">
<span<?php echo $Cadete_view->MAHasta->viewAttributes() ?>><?php echo $Cadete_view->MAHasta->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Cadete_view->MIEDesde->Visible) { // MIEDesde ?>
	<tr id="r_MIEDesde">
		<td class="<?php echo $Cadete_view->TableLeftColumnClass ?>"><span id="elh_Cadete_MIEDesde"><?php echo $Cadete_view->MIEDesde->caption() ?></span></td>
		<td data-name="MIEDesde" <?php echo $Cadete_view->MIEDesde->cellAttributes() ?>>
<span id="el_Cadete_MIEDesde">
<span<?php echo $Cadete_view->MIEDesde->viewAttributes() ?>><?php echo $Cadete_view->MIEDesde->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Cadete_view->MIEHasta->Visible) { // MIEHasta ?>
	<tr id="r_MIEHasta">
		<td class="<?php echo $Cadete_view->TableLeftColumnClass ?>"><span id="elh_Cadete_MIEHasta"><?php echo $Cadete_view->MIEHasta->caption() ?></span></td>
		<td data-name="MIEHasta" <?php echo $Cadete_view->MIEHasta->cellAttributes() ?>>
<span id="el_Cadete_MIEHasta">
<span<?php echo $Cadete_view->MIEHasta->viewAttributes() ?>><?php echo $Cadete_view->MIEHasta->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Cadete_view->JUEDesde->Visible) { // JUEDesde ?>
	<tr id="r_JUEDesde">
		<td class="<?php echo $Cadete_view->TableLeftColumnClass ?>"><span id="elh_Cadete_JUEDesde"><?php echo $Cadete_view->JUEDesde->caption() ?></span></td>
		<td data-name="JUEDesde" <?php echo $Cadete_view->JUEDesde->cellAttributes() ?>>
<span id="el_Cadete_JUEDesde">
<span<?php echo $Cadete_view->JUEDesde->viewAttributes() ?>><?php echo $Cadete_view->JUEDesde->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Cadete_view->JUEHasta->Visible) { // JUEHasta ?>
	<tr id="r_JUEHasta">
		<td class="<?php echo $Cadete_view->TableLeftColumnClass ?>"><span id="elh_Cadete_JUEHasta"><?php echo $Cadete_view->JUEHasta->caption() ?></span></td>
		<td data-name="JUEHasta" <?php echo $Cadete_view->JUEHasta->cellAttributes() ?>>
<span id="el_Cadete_JUEHasta">
<span<?php echo $Cadete_view->JUEHasta->viewAttributes() ?>><?php echo $Cadete_view->JUEHasta->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Cadete_view->VIEDesde->Visible) { // VIEDesde ?>
	<tr id="r_VIEDesde">
		<td class="<?php echo $Cadete_view->TableLeftColumnClass ?>"><span id="elh_Cadete_VIEDesde"><?php echo $Cadete_view->VIEDesde->caption() ?></span></td>
		<td data-name="VIEDesde" <?php echo $Cadete_view->VIEDesde->cellAttributes() ?>>
<span id="el_Cadete_VIEDesde">
<span<?php echo $Cadete_view->VIEDesde->viewAttributes() ?>><?php echo $Cadete_view->VIEDesde->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Cadete_view->VIEHasta->Visible) { // VIEHasta ?>
	<tr id="r_VIEHasta">
		<td class="<?php echo $Cadete_view->TableLeftColumnClass ?>"><span id="elh_Cadete_VIEHasta"><?php echo $Cadete_view->VIEHasta->caption() ?></span></td>
		<td data-name="VIEHasta" <?php echo $Cadete_view->VIEHasta->cellAttributes() ?>>
<span id="el_Cadete_VIEHasta">
<span<?php echo $Cadete_view->VIEHasta->viewAttributes() ?>><?php echo $Cadete_view->VIEHasta->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Cadete_view->SABDesde->Visible) { // SABDesde ?>
	<tr id="r_SABDesde">
		<td class="<?php echo $Cadete_view->TableLeftColumnClass ?>"><span id="elh_Cadete_SABDesde"><?php echo $Cadete_view->SABDesde->caption() ?></span></td>
		<td data-name="SABDesde" <?php echo $Cadete_view->SABDesde->cellAttributes() ?>>
<span id="el_Cadete_SABDesde">
<span<?php echo $Cadete_view->SABDesde->viewAttributes() ?>><?php echo $Cadete_view->SABDesde->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Cadete_view->SABHasta->Visible) { // SABHasta ?>
	<tr id="r_SABHasta">
		<td class="<?php echo $Cadete_view->TableLeftColumnClass ?>"><span id="elh_Cadete_SABHasta"><?php echo $Cadete_view->SABHasta->caption() ?></span></td>
		<td data-name="SABHasta" <?php echo $Cadete_view->SABHasta->cellAttributes() ?>>
<span id="el_Cadete_SABHasta">
<span<?php echo $Cadete_view->SABHasta->viewAttributes() ?>><?php echo $Cadete_view->SABHasta->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Cadete_view->DOMDesde->Visible) { // DOMDesde ?>
	<tr id="r_DOMDesde">
		<td class="<?php echo $Cadete_view->TableLeftColumnClass ?>"><span id="elh_Cadete_DOMDesde"><?php echo $Cadete_view->DOMDesde->caption() ?></span></td>
		<td data-name="DOMDesde" <?php echo $Cadete_view->DOMDesde->cellAttributes() ?>>
<span id="el_Cadete_DOMDesde">
<span<?php echo $Cadete_view->DOMDesde->viewAttributes() ?>><?php echo $Cadete_view->DOMDesde->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Cadete_view->DOMHasta->Visible) { // DOMHasta ?>
	<tr id="r_DOMHasta">
		<td class="<?php echo $Cadete_view->TableLeftColumnClass ?>"><span id="elh_Cadete_DOMHasta"><?php echo $Cadete_view->DOMHasta->caption() ?></span></td>
		<td data-name="DOMHasta" <?php echo $Cadete_view->DOMHasta->cellAttributes() ?>>
<span id="el_Cadete_DOMHasta">
<span<?php echo $Cadete_view->DOMHasta->viewAttributes() ?>><?php echo $Cadete_view->DOMHasta->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Cadete_view->Foto->Visible) { // Foto ?>
	<tr id="r_Foto">
		<td class="<?php echo $Cadete_view->TableLeftColumnClass ?>"><span id="elh_Cadete_Foto"><?php echo $Cadete_view->Foto->caption() ?></span></td>
		<td data-name="Foto" <?php echo $Cadete_view->Foto->cellAttributes() ?>>
<span id="el_Cadete_Foto">
<span<?php echo $Cadete_view->Foto->viewAttributes() ?>><?php echo $Cadete_view->Foto->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$Cadete_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$Cadete_view->isExport()) { ?>
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
$Cadete_view->terminate();
?>