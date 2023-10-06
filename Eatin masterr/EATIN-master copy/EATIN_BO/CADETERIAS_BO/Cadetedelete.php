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
$Cadete_delete = new Cadete_delete();

// Run the page
$Cadete_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Cadete_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fCadetedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fCadetedelete = currentForm = new ew.Form("fCadetedelete", "delete");
	loadjs.done("fCadetedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $Cadete_delete->showPageHeader(); ?>
<?php
$Cadete_delete->showMessage();
?>
<form name="fCadetedelete" id="fCadetedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Cadete">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Cadete_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($Cadete_delete->ID->Visible) { // ID ?>
		<th class="<?php echo $Cadete_delete->ID->headerCellClass() ?>"><span id="elh_Cadete_ID" class="Cadete_ID"><?php echo $Cadete_delete->ID->caption() ?></span></th>
<?php } ?>
<?php if ($Cadete_delete->FechaCreacion->Visible) { // FechaCreacion ?>
		<th class="<?php echo $Cadete_delete->FechaCreacion->headerCellClass() ?>"><span id="elh_Cadete_FechaCreacion" class="Cadete_FechaCreacion"><?php echo $Cadete_delete->FechaCreacion->caption() ?></span></th>
<?php } ?>
<?php if ($Cadete_delete->ID_Cadeteria->Visible) { // ID_Cadeteria ?>
		<th class="<?php echo $Cadete_delete->ID_Cadeteria->headerCellClass() ?>"><span id="elh_Cadete_ID_Cadeteria" class="Cadete_ID_Cadeteria"><?php echo $Cadete_delete->ID_Cadeteria->caption() ?></span></th>
<?php } ?>
<?php if ($Cadete_delete->ID_Status->Visible) { // ID_Status ?>
		<th class="<?php echo $Cadete_delete->ID_Status->headerCellClass() ?>"><span id="elh_Cadete_ID_Status" class="Cadete_ID_Status"><?php echo $Cadete_delete->ID_Status->caption() ?></span></th>
<?php } ?>
<?php if ($Cadete_delete->ID_CurrentStatus->Visible) { // ID_CurrentStatus ?>
		<th class="<?php echo $Cadete_delete->ID_CurrentStatus->headerCellClass() ?>"><span id="elh_Cadete_ID_CurrentStatus" class="Cadete_ID_CurrentStatus"><?php echo $Cadete_delete->ID_CurrentStatus->caption() ?></span></th>
<?php } ?>
<?php if ($Cadete_delete->Nombre->Visible) { // Nombre ?>
		<th class="<?php echo $Cadete_delete->Nombre->headerCellClass() ?>"><span id="elh_Cadete_Nombre" class="Cadete_Nombre"><?php echo $Cadete_delete->Nombre->caption() ?></span></th>
<?php } ?>
<?php if ($Cadete_delete->Apellido->Visible) { // Apellido ?>
		<th class="<?php echo $Cadete_delete->Apellido->headerCellClass() ?>"><span id="elh_Cadete_Apellido" class="Cadete_Apellido"><?php echo $Cadete_delete->Apellido->caption() ?></span></th>
<?php } ?>
<?php if ($Cadete_delete->DNI->Visible) { // DNI ?>
		<th class="<?php echo $Cadete_delete->DNI->headerCellClass() ?>"><span id="elh_Cadete_DNI" class="Cadete_DNI"><?php echo $Cadete_delete->DNI->caption() ?></span></th>
<?php } ?>
<?php if ($Cadete_delete->Celular->Visible) { // Celular ?>
		<th class="<?php echo $Cadete_delete->Celular->headerCellClass() ?>"><span id="elh_Cadete_Celular" class="Cadete_Celular"><?php echo $Cadete_delete->Celular->caption() ?></span></th>
<?php } ?>
<?php if ($Cadete_delete->Domicilio->Visible) { // Domicilio ?>
		<th class="<?php echo $Cadete_delete->Domicilio->headerCellClass() ?>"><span id="elh_Cadete_Domicilio" class="Cadete_Domicilio"><?php echo $Cadete_delete->Domicilio->caption() ?></span></th>
<?php } ?>
<?php if ($Cadete_delete->RealLat->Visible) { // RealLat ?>
		<th class="<?php echo $Cadete_delete->RealLat->headerCellClass() ?>"><span id="elh_Cadete_RealLat" class="Cadete_RealLat"><?php echo $Cadete_delete->RealLat->caption() ?></span></th>
<?php } ?>
<?php if ($Cadete_delete->RealLon->Visible) { // RealLon ?>
		<th class="<?php echo $Cadete_delete->RealLon->headerCellClass() ?>"><span id="elh_Cadete_RealLon" class="Cadete_RealLon"><?php echo $Cadete_delete->RealLon->caption() ?></span></th>
<?php } ?>
<?php if ($Cadete_delete->EstimatedLat->Visible) { // EstimatedLat ?>
		<th class="<?php echo $Cadete_delete->EstimatedLat->headerCellClass() ?>"><span id="elh_Cadete_EstimatedLat" class="Cadete_EstimatedLat"><?php echo $Cadete_delete->EstimatedLat->caption() ?></span></th>
<?php } ?>
<?php if ($Cadete_delete->EstimatedLon->Visible) { // EstimatedLon ?>
		<th class="<?php echo $Cadete_delete->EstimatedLon->headerCellClass() ?>"><span id="elh_Cadete_EstimatedLon" class="Cadete_EstimatedLon"><?php echo $Cadete_delete->EstimatedLon->caption() ?></span></th>
<?php } ?>
<?php if ($Cadete_delete->LUDesde->Visible) { // LUDesde ?>
		<th class="<?php echo $Cadete_delete->LUDesde->headerCellClass() ?>"><span id="elh_Cadete_LUDesde" class="Cadete_LUDesde"><?php echo $Cadete_delete->LUDesde->caption() ?></span></th>
<?php } ?>
<?php if ($Cadete_delete->LUHasta->Visible) { // LUHasta ?>
		<th class="<?php echo $Cadete_delete->LUHasta->headerCellClass() ?>"><span id="elh_Cadete_LUHasta" class="Cadete_LUHasta"><?php echo $Cadete_delete->LUHasta->caption() ?></span></th>
<?php } ?>
<?php if ($Cadete_delete->MADesde->Visible) { // MADesde ?>
		<th class="<?php echo $Cadete_delete->MADesde->headerCellClass() ?>"><span id="elh_Cadete_MADesde" class="Cadete_MADesde"><?php echo $Cadete_delete->MADesde->caption() ?></span></th>
<?php } ?>
<?php if ($Cadete_delete->MAHasta->Visible) { // MAHasta ?>
		<th class="<?php echo $Cadete_delete->MAHasta->headerCellClass() ?>"><span id="elh_Cadete_MAHasta" class="Cadete_MAHasta"><?php echo $Cadete_delete->MAHasta->caption() ?></span></th>
<?php } ?>
<?php if ($Cadete_delete->MIEDesde->Visible) { // MIEDesde ?>
		<th class="<?php echo $Cadete_delete->MIEDesde->headerCellClass() ?>"><span id="elh_Cadete_MIEDesde" class="Cadete_MIEDesde"><?php echo $Cadete_delete->MIEDesde->caption() ?></span></th>
<?php } ?>
<?php if ($Cadete_delete->MIEHasta->Visible) { // MIEHasta ?>
		<th class="<?php echo $Cadete_delete->MIEHasta->headerCellClass() ?>"><span id="elh_Cadete_MIEHasta" class="Cadete_MIEHasta"><?php echo $Cadete_delete->MIEHasta->caption() ?></span></th>
<?php } ?>
<?php if ($Cadete_delete->JUEDesde->Visible) { // JUEDesde ?>
		<th class="<?php echo $Cadete_delete->JUEDesde->headerCellClass() ?>"><span id="elh_Cadete_JUEDesde" class="Cadete_JUEDesde"><?php echo $Cadete_delete->JUEDesde->caption() ?></span></th>
<?php } ?>
<?php if ($Cadete_delete->JUEHasta->Visible) { // JUEHasta ?>
		<th class="<?php echo $Cadete_delete->JUEHasta->headerCellClass() ?>"><span id="elh_Cadete_JUEHasta" class="Cadete_JUEHasta"><?php echo $Cadete_delete->JUEHasta->caption() ?></span></th>
<?php } ?>
<?php if ($Cadete_delete->VIEDesde->Visible) { // VIEDesde ?>
		<th class="<?php echo $Cadete_delete->VIEDesde->headerCellClass() ?>"><span id="elh_Cadete_VIEDesde" class="Cadete_VIEDesde"><?php echo $Cadete_delete->VIEDesde->caption() ?></span></th>
<?php } ?>
<?php if ($Cadete_delete->VIEHasta->Visible) { // VIEHasta ?>
		<th class="<?php echo $Cadete_delete->VIEHasta->headerCellClass() ?>"><span id="elh_Cadete_VIEHasta" class="Cadete_VIEHasta"><?php echo $Cadete_delete->VIEHasta->caption() ?></span></th>
<?php } ?>
<?php if ($Cadete_delete->SABDesde->Visible) { // SABDesde ?>
		<th class="<?php echo $Cadete_delete->SABDesde->headerCellClass() ?>"><span id="elh_Cadete_SABDesde" class="Cadete_SABDesde"><?php echo $Cadete_delete->SABDesde->caption() ?></span></th>
<?php } ?>
<?php if ($Cadete_delete->SABHasta->Visible) { // SABHasta ?>
		<th class="<?php echo $Cadete_delete->SABHasta->headerCellClass() ?>"><span id="elh_Cadete_SABHasta" class="Cadete_SABHasta"><?php echo $Cadete_delete->SABHasta->caption() ?></span></th>
<?php } ?>
<?php if ($Cadete_delete->DOMDesde->Visible) { // DOMDesde ?>
		<th class="<?php echo $Cadete_delete->DOMDesde->headerCellClass() ?>"><span id="elh_Cadete_DOMDesde" class="Cadete_DOMDesde"><?php echo $Cadete_delete->DOMDesde->caption() ?></span></th>
<?php } ?>
<?php if ($Cadete_delete->DOMHasta->Visible) { // DOMHasta ?>
		<th class="<?php echo $Cadete_delete->DOMHasta->headerCellClass() ?>"><span id="elh_Cadete_DOMHasta" class="Cadete_DOMHasta"><?php echo $Cadete_delete->DOMHasta->caption() ?></span></th>
<?php } ?>
<?php if ($Cadete_delete->Foto->Visible) { // Foto ?>
		<th class="<?php echo $Cadete_delete->Foto->headerCellClass() ?>"><span id="elh_Cadete_Foto" class="Cadete_Foto"><?php echo $Cadete_delete->Foto->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$Cadete_delete->RecordCount = 0;
$i = 0;
while (!$Cadete_delete->Recordset->EOF) {
	$Cadete_delete->RecordCount++;
	$Cadete_delete->RowCount++;

	// Set row properties
	$Cadete->resetAttributes();
	$Cadete->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$Cadete_delete->loadRowValues($Cadete_delete->Recordset);

	// Render row
	$Cadete_delete->renderRow();
?>
	<tr <?php echo $Cadete->rowAttributes() ?>>
<?php if ($Cadete_delete->ID->Visible) { // ID ?>
		<td <?php echo $Cadete_delete->ID->cellAttributes() ?>>
<span id="el<?php echo $Cadete_delete->RowCount ?>_Cadete_ID" class="Cadete_ID">
<span<?php echo $Cadete_delete->ID->viewAttributes() ?>><?php echo $Cadete_delete->ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Cadete_delete->FechaCreacion->Visible) { // FechaCreacion ?>
		<td <?php echo $Cadete_delete->FechaCreacion->cellAttributes() ?>>
<span id="el<?php echo $Cadete_delete->RowCount ?>_Cadete_FechaCreacion" class="Cadete_FechaCreacion">
<span<?php echo $Cadete_delete->FechaCreacion->viewAttributes() ?>><?php echo $Cadete_delete->FechaCreacion->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Cadete_delete->ID_Cadeteria->Visible) { // ID_Cadeteria ?>
		<td <?php echo $Cadete_delete->ID_Cadeteria->cellAttributes() ?>>
<span id="el<?php echo $Cadete_delete->RowCount ?>_Cadete_ID_Cadeteria" class="Cadete_ID_Cadeteria">
<span<?php echo $Cadete_delete->ID_Cadeteria->viewAttributes() ?>><?php echo $Cadete_delete->ID_Cadeteria->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Cadete_delete->ID_Status->Visible) { // ID_Status ?>
		<td <?php echo $Cadete_delete->ID_Status->cellAttributes() ?>>
<span id="el<?php echo $Cadete_delete->RowCount ?>_Cadete_ID_Status" class="Cadete_ID_Status">
<span<?php echo $Cadete_delete->ID_Status->viewAttributes() ?>><?php echo $Cadete_delete->ID_Status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Cadete_delete->ID_CurrentStatus->Visible) { // ID_CurrentStatus ?>
		<td <?php echo $Cadete_delete->ID_CurrentStatus->cellAttributes() ?>>
<span id="el<?php echo $Cadete_delete->RowCount ?>_Cadete_ID_CurrentStatus" class="Cadete_ID_CurrentStatus">
<span<?php echo $Cadete_delete->ID_CurrentStatus->viewAttributes() ?>><?php echo $Cadete_delete->ID_CurrentStatus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Cadete_delete->Nombre->Visible) { // Nombre ?>
		<td <?php echo $Cadete_delete->Nombre->cellAttributes() ?>>
<span id="el<?php echo $Cadete_delete->RowCount ?>_Cadete_Nombre" class="Cadete_Nombre">
<span<?php echo $Cadete_delete->Nombre->viewAttributes() ?>><?php echo $Cadete_delete->Nombre->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Cadete_delete->Apellido->Visible) { // Apellido ?>
		<td <?php echo $Cadete_delete->Apellido->cellAttributes() ?>>
<span id="el<?php echo $Cadete_delete->RowCount ?>_Cadete_Apellido" class="Cadete_Apellido">
<span<?php echo $Cadete_delete->Apellido->viewAttributes() ?>><?php echo $Cadete_delete->Apellido->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Cadete_delete->DNI->Visible) { // DNI ?>
		<td <?php echo $Cadete_delete->DNI->cellAttributes() ?>>
<span id="el<?php echo $Cadete_delete->RowCount ?>_Cadete_DNI" class="Cadete_DNI">
<span<?php echo $Cadete_delete->DNI->viewAttributes() ?>><?php echo $Cadete_delete->DNI->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Cadete_delete->Celular->Visible) { // Celular ?>
		<td <?php echo $Cadete_delete->Celular->cellAttributes() ?>>
<span id="el<?php echo $Cadete_delete->RowCount ?>_Cadete_Celular" class="Cadete_Celular">
<span<?php echo $Cadete_delete->Celular->viewAttributes() ?>><?php echo $Cadete_delete->Celular->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Cadete_delete->Domicilio->Visible) { // Domicilio ?>
		<td <?php echo $Cadete_delete->Domicilio->cellAttributes() ?>>
<span id="el<?php echo $Cadete_delete->RowCount ?>_Cadete_Domicilio" class="Cadete_Domicilio">
<span<?php echo $Cadete_delete->Domicilio->viewAttributes() ?>><?php echo $Cadete_delete->Domicilio->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Cadete_delete->RealLat->Visible) { // RealLat ?>
		<td <?php echo $Cadete_delete->RealLat->cellAttributes() ?>>
<span id="el<?php echo $Cadete_delete->RowCount ?>_Cadete_RealLat" class="Cadete_RealLat">
<span<?php echo $Cadete_delete->RealLat->viewAttributes() ?>><?php echo $Cadete_delete->RealLat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Cadete_delete->RealLon->Visible) { // RealLon ?>
		<td <?php echo $Cadete_delete->RealLon->cellAttributes() ?>>
<span id="el<?php echo $Cadete_delete->RowCount ?>_Cadete_RealLon" class="Cadete_RealLon">
<span<?php echo $Cadete_delete->RealLon->viewAttributes() ?>><?php echo $Cadete_delete->RealLon->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Cadete_delete->EstimatedLat->Visible) { // EstimatedLat ?>
		<td <?php echo $Cadete_delete->EstimatedLat->cellAttributes() ?>>
<span id="el<?php echo $Cadete_delete->RowCount ?>_Cadete_EstimatedLat" class="Cadete_EstimatedLat">
<span<?php echo $Cadete_delete->EstimatedLat->viewAttributes() ?>><?php echo $Cadete_delete->EstimatedLat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Cadete_delete->EstimatedLon->Visible) { // EstimatedLon ?>
		<td <?php echo $Cadete_delete->EstimatedLon->cellAttributes() ?>>
<span id="el<?php echo $Cadete_delete->RowCount ?>_Cadete_EstimatedLon" class="Cadete_EstimatedLon">
<span<?php echo $Cadete_delete->EstimatedLon->viewAttributes() ?>><?php echo $Cadete_delete->EstimatedLon->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Cadete_delete->LUDesde->Visible) { // LUDesde ?>
		<td <?php echo $Cadete_delete->LUDesde->cellAttributes() ?>>
<span id="el<?php echo $Cadete_delete->RowCount ?>_Cadete_LUDesde" class="Cadete_LUDesde">
<span<?php echo $Cadete_delete->LUDesde->viewAttributes() ?>><?php echo $Cadete_delete->LUDesde->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Cadete_delete->LUHasta->Visible) { // LUHasta ?>
		<td <?php echo $Cadete_delete->LUHasta->cellAttributes() ?>>
<span id="el<?php echo $Cadete_delete->RowCount ?>_Cadete_LUHasta" class="Cadete_LUHasta">
<span<?php echo $Cadete_delete->LUHasta->viewAttributes() ?>><?php echo $Cadete_delete->LUHasta->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Cadete_delete->MADesde->Visible) { // MADesde ?>
		<td <?php echo $Cadete_delete->MADesde->cellAttributes() ?>>
<span id="el<?php echo $Cadete_delete->RowCount ?>_Cadete_MADesde" class="Cadete_MADesde">
<span<?php echo $Cadete_delete->MADesde->viewAttributes() ?>><?php echo $Cadete_delete->MADesde->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Cadete_delete->MAHasta->Visible) { // MAHasta ?>
		<td <?php echo $Cadete_delete->MAHasta->cellAttributes() ?>>
<span id="el<?php echo $Cadete_delete->RowCount ?>_Cadete_MAHasta" class="Cadete_MAHasta">
<span<?php echo $Cadete_delete->MAHasta->viewAttributes() ?>><?php echo $Cadete_delete->MAHasta->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Cadete_delete->MIEDesde->Visible) { // MIEDesde ?>
		<td <?php echo $Cadete_delete->MIEDesde->cellAttributes() ?>>
<span id="el<?php echo $Cadete_delete->RowCount ?>_Cadete_MIEDesde" class="Cadete_MIEDesde">
<span<?php echo $Cadete_delete->MIEDesde->viewAttributes() ?>><?php echo $Cadete_delete->MIEDesde->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Cadete_delete->MIEHasta->Visible) { // MIEHasta ?>
		<td <?php echo $Cadete_delete->MIEHasta->cellAttributes() ?>>
<span id="el<?php echo $Cadete_delete->RowCount ?>_Cadete_MIEHasta" class="Cadete_MIEHasta">
<span<?php echo $Cadete_delete->MIEHasta->viewAttributes() ?>><?php echo $Cadete_delete->MIEHasta->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Cadete_delete->JUEDesde->Visible) { // JUEDesde ?>
		<td <?php echo $Cadete_delete->JUEDesde->cellAttributes() ?>>
<span id="el<?php echo $Cadete_delete->RowCount ?>_Cadete_JUEDesde" class="Cadete_JUEDesde">
<span<?php echo $Cadete_delete->JUEDesde->viewAttributes() ?>><?php echo $Cadete_delete->JUEDesde->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Cadete_delete->JUEHasta->Visible) { // JUEHasta ?>
		<td <?php echo $Cadete_delete->JUEHasta->cellAttributes() ?>>
<span id="el<?php echo $Cadete_delete->RowCount ?>_Cadete_JUEHasta" class="Cadete_JUEHasta">
<span<?php echo $Cadete_delete->JUEHasta->viewAttributes() ?>><?php echo $Cadete_delete->JUEHasta->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Cadete_delete->VIEDesde->Visible) { // VIEDesde ?>
		<td <?php echo $Cadete_delete->VIEDesde->cellAttributes() ?>>
<span id="el<?php echo $Cadete_delete->RowCount ?>_Cadete_VIEDesde" class="Cadete_VIEDesde">
<span<?php echo $Cadete_delete->VIEDesde->viewAttributes() ?>><?php echo $Cadete_delete->VIEDesde->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Cadete_delete->VIEHasta->Visible) { // VIEHasta ?>
		<td <?php echo $Cadete_delete->VIEHasta->cellAttributes() ?>>
<span id="el<?php echo $Cadete_delete->RowCount ?>_Cadete_VIEHasta" class="Cadete_VIEHasta">
<span<?php echo $Cadete_delete->VIEHasta->viewAttributes() ?>><?php echo $Cadete_delete->VIEHasta->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Cadete_delete->SABDesde->Visible) { // SABDesde ?>
		<td <?php echo $Cadete_delete->SABDesde->cellAttributes() ?>>
<span id="el<?php echo $Cadete_delete->RowCount ?>_Cadete_SABDesde" class="Cadete_SABDesde">
<span<?php echo $Cadete_delete->SABDesde->viewAttributes() ?>><?php echo $Cadete_delete->SABDesde->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Cadete_delete->SABHasta->Visible) { // SABHasta ?>
		<td <?php echo $Cadete_delete->SABHasta->cellAttributes() ?>>
<span id="el<?php echo $Cadete_delete->RowCount ?>_Cadete_SABHasta" class="Cadete_SABHasta">
<span<?php echo $Cadete_delete->SABHasta->viewAttributes() ?>><?php echo $Cadete_delete->SABHasta->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Cadete_delete->DOMDesde->Visible) { // DOMDesde ?>
		<td <?php echo $Cadete_delete->DOMDesde->cellAttributes() ?>>
<span id="el<?php echo $Cadete_delete->RowCount ?>_Cadete_DOMDesde" class="Cadete_DOMDesde">
<span<?php echo $Cadete_delete->DOMDesde->viewAttributes() ?>><?php echo $Cadete_delete->DOMDesde->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Cadete_delete->DOMHasta->Visible) { // DOMHasta ?>
		<td <?php echo $Cadete_delete->DOMHasta->cellAttributes() ?>>
<span id="el<?php echo $Cadete_delete->RowCount ?>_Cadete_DOMHasta" class="Cadete_DOMHasta">
<span<?php echo $Cadete_delete->DOMHasta->viewAttributes() ?>><?php echo $Cadete_delete->DOMHasta->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Cadete_delete->Foto->Visible) { // Foto ?>
		<td <?php echo $Cadete_delete->Foto->cellAttributes() ?>>
<span id="el<?php echo $Cadete_delete->RowCount ?>_Cadete_Foto" class="Cadete_Foto">
<span<?php echo $Cadete_delete->Foto->viewAttributes() ?>><?php echo $Cadete_delete->Foto->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$Cadete_delete->Recordset->moveNext();
}
$Cadete_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $Cadete_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Cadete_delete->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$Cadete_delete->terminate();
?>