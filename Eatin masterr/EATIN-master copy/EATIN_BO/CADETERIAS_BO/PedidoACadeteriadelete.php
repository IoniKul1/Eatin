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
$PedidoACadeteria_delete = new PedidoACadeteria_delete();

// Run the page
$PedidoACadeteria_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$PedidoACadeteria_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fPedidoACadeteriadelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fPedidoACadeteriadelete = currentForm = new ew.Form("fPedidoACadeteriadelete", "delete");
	loadjs.done("fPedidoACadeteriadelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $PedidoACadeteria_delete->showPageHeader(); ?>
<?php
$PedidoACadeteria_delete->showMessage();
?>
<form name="fPedidoACadeteriadelete" id="fPedidoACadeteriadelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="PedidoACadeteria">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($PedidoACadeteria_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($PedidoACadeteria_delete->ID->Visible) { // ID ?>
		<th class="<?php echo $PedidoACadeteria_delete->ID->headerCellClass() ?>"><span id="elh_PedidoACadeteria_ID" class="PedidoACadeteria_ID"><?php echo $PedidoACadeteria_delete->ID->caption() ?></span></th>
<?php } ?>
<?php if ($PedidoACadeteria_delete->ID_Usuario->Visible) { // ID_Usuario ?>
		<th class="<?php echo $PedidoACadeteria_delete->ID_Usuario->headerCellClass() ?>"><span id="elh_PedidoACadeteria_ID_Usuario" class="PedidoACadeteria_ID_Usuario"><?php echo $PedidoACadeteria_delete->ID_Usuario->caption() ?></span></th>
<?php } ?>
<?php if ($PedidoACadeteria_delete->ID_Place1->Visible) { // ID_Place1 ?>
		<th class="<?php echo $PedidoACadeteria_delete->ID_Place1->headerCellClass() ?>"><span id="elh_PedidoACadeteria_ID_Place1" class="PedidoACadeteria_ID_Place1"><?php echo $PedidoACadeteria_delete->ID_Place1->caption() ?></span></th>
<?php } ?>
<?php if ($PedidoACadeteria_delete->ID_Place2->Visible) { // ID_Place2 ?>
		<th class="<?php echo $PedidoACadeteria_delete->ID_Place2->headerCellClass() ?>"><span id="elh_PedidoACadeteria_ID_Place2" class="PedidoACadeteria_ID_Place2"><?php echo $PedidoACadeteria_delete->ID_Place2->caption() ?></span></th>
<?php } ?>
<?php if ($PedidoACadeteria_delete->ID_Cadete->Visible) { // ID_Cadete ?>
		<th class="<?php echo $PedidoACadeteria_delete->ID_Cadete->headerCellClass() ?>"><span id="elh_PedidoACadeteria_ID_Cadete" class="PedidoACadeteria_ID_Cadete"><?php echo $PedidoACadeteria_delete->ID_Cadete->caption() ?></span></th>
<?php } ?>
<?php if ($PedidoACadeteria_delete->ID_Status->Visible) { // ID_Status ?>
		<th class="<?php echo $PedidoACadeteria_delete->ID_Status->headerCellClass() ?>"><span id="elh_PedidoACadeteria_ID_Status" class="PedidoACadeteria_ID_Status"><?php echo $PedidoACadeteria_delete->ID_Status->caption() ?></span></th>
<?php } ?>
<?php if ($PedidoACadeteria_delete->InstruccionesPlace1->Visible) { // InstruccionesPlace1 ?>
		<th class="<?php echo $PedidoACadeteria_delete->InstruccionesPlace1->headerCellClass() ?>"><span id="elh_PedidoACadeteria_InstruccionesPlace1" class="PedidoACadeteria_InstruccionesPlace1"><?php echo $PedidoACadeteria_delete->InstruccionesPlace1->caption() ?></span></th>
<?php } ?>
<?php if ($PedidoACadeteria_delete->InstruccionesPlace2->Visible) { // InstruccionesPlace2 ?>
		<th class="<?php echo $PedidoACadeteria_delete->InstruccionesPlace2->headerCellClass() ?>"><span id="elh_PedidoACadeteria_InstruccionesPlace2" class="PedidoACadeteria_InstruccionesPlace2"><?php echo $PedidoACadeteria_delete->InstruccionesPlace2->caption() ?></span></th>
<?php } ?>
<?php if ($PedidoACadeteria_delete->Direccionalidad->Visible) { // Direccionalidad ?>
		<th class="<?php echo $PedidoACadeteria_delete->Direccionalidad->headerCellClass() ?>"><span id="elh_PedidoACadeteria_Direccionalidad" class="PedidoACadeteria_Direccionalidad"><?php echo $PedidoACadeteria_delete->Direccionalidad->caption() ?></span></th>
<?php } ?>
<?php if ($PedidoACadeteria_delete->RemitoURL->Visible) { // RemitoURL ?>
		<th class="<?php echo $PedidoACadeteria_delete->RemitoURL->headerCellClass() ?>"><span id="elh_PedidoACadeteria_RemitoURL" class="PedidoACadeteria_RemitoURL"><?php echo $PedidoACadeteria_delete->RemitoURL->caption() ?></span></th>
<?php } ?>
<?php if ($PedidoACadeteria_delete->Place1_Nombre->Visible) { // Place1_Nombre ?>
		<th class="<?php echo $PedidoACadeteria_delete->Place1_Nombre->headerCellClass() ?>"><span id="elh_PedidoACadeteria_Place1_Nombre" class="PedidoACadeteria_Place1_Nombre"><?php echo $PedidoACadeteria_delete->Place1_Nombre->caption() ?></span></th>
<?php } ?>
<?php if ($PedidoACadeteria_delete->Place1_Country->Visible) { // Place1_Country ?>
		<th class="<?php echo $PedidoACadeteria_delete->Place1_Country->headerCellClass() ?>"><span id="elh_PedidoACadeteria_Place1_Country" class="PedidoACadeteria_Place1_Country"><?php echo $PedidoACadeteria_delete->Place1_Country->caption() ?></span></th>
<?php } ?>
<?php if ($PedidoACadeteria_delete->Place1_UF->Visible) { // Place1_UF ?>
		<th class="<?php echo $PedidoACadeteria_delete->Place1_UF->headerCellClass() ?>"><span id="elh_PedidoACadeteria_Place1_UF" class="PedidoACadeteria_Place1_UF"><?php echo $PedidoACadeteria_delete->Place1_UF->caption() ?></span></th>
<?php } ?>
<?php if ($PedidoACadeteria_delete->Plate1_Lat->Visible) { // Plate1_Lat ?>
		<th class="<?php echo $PedidoACadeteria_delete->Plate1_Lat->headerCellClass() ?>"><span id="elh_PedidoACadeteria_Plate1_Lat" class="PedidoACadeteria_Plate1_Lat"><?php echo $PedidoACadeteria_delete->Plate1_Lat->caption() ?></span></th>
<?php } ?>
<?php if ($PedidoACadeteria_delete->Place1_Lon->Visible) { // Place1_Lon ?>
		<th class="<?php echo $PedidoACadeteria_delete->Place1_Lon->headerCellClass() ?>"><span id="elh_PedidoACadeteria_Place1_Lon" class="PedidoACadeteria_Place1_Lon"><?php echo $PedidoACadeteria_delete->Place1_Lon->caption() ?></span></th>
<?php } ?>
<?php if ($PedidoACadeteria_delete->Place1_Calle->Visible) { // Place1_Calle ?>
		<th class="<?php echo $PedidoACadeteria_delete->Place1_Calle->headerCellClass() ?>"><span id="elh_PedidoACadeteria_Place1_Calle" class="PedidoACadeteria_Place1_Calle"><?php echo $PedidoACadeteria_delete->Place1_Calle->caption() ?></span></th>
<?php } ?>
<?php if ($PedidoACadeteria_delete->Place1_Numero->Visible) { // Place1_Numero ?>
		<th class="<?php echo $PedidoACadeteria_delete->Place1_Numero->headerCellClass() ?>"><span id="elh_PedidoACadeteria_Place1_Numero" class="PedidoACadeteria_Place1_Numero"><?php echo $PedidoACadeteria_delete->Place1_Numero->caption() ?></span></th>
<?php } ?>
<?php if ($PedidoACadeteria_delete->Place1_Localidad->Visible) { // Place1_Localidad ?>
		<th class="<?php echo $PedidoACadeteria_delete->Place1_Localidad->headerCellClass() ?>"><span id="elh_PedidoACadeteria_Place1_Localidad" class="PedidoACadeteria_Place1_Localidad"><?php echo $PedidoACadeteria_delete->Place1_Localidad->caption() ?></span></th>
<?php } ?>
<?php if ($PedidoACadeteria_delete->Place1_Piso->Visible) { // Place1_Piso ?>
		<th class="<?php echo $PedidoACadeteria_delete->Place1_Piso->headerCellClass() ?>"><span id="elh_PedidoACadeteria_Place1_Piso" class="PedidoACadeteria_Place1_Piso"><?php echo $PedidoACadeteria_delete->Place1_Piso->caption() ?></span></th>
<?php } ?>
<?php if ($PedidoACadeteria_delete->Place1_Depto->Visible) { // Place1_Depto ?>
		<th class="<?php echo $PedidoACadeteria_delete->Place1_Depto->headerCellClass() ?>"><span id="elh_PedidoACadeteria_Place1_Depto" class="PedidoACadeteria_Place1_Depto"><?php echo $PedidoACadeteria_delete->Place1_Depto->caption() ?></span></th>
<?php } ?>
<?php if ($PedidoACadeteria_delete->Place1_PersonaRecibe->Visible) { // Place1_PersonaRecibe ?>
		<th class="<?php echo $PedidoACadeteria_delete->Place1_PersonaRecibe->headerCellClass() ?>"><span id="elh_PedidoACadeteria_Place1_PersonaRecibe" class="PedidoACadeteria_Place1_PersonaRecibe"><?php echo $PedidoACadeteria_delete->Place1_PersonaRecibe->caption() ?></span></th>
<?php } ?>
<?php if ($PedidoACadeteria_delete->Place1_PersonaRecibeTelefono->Visible) { // Place1_PersonaRecibeTelefono ?>
		<th class="<?php echo $PedidoACadeteria_delete->Place1_PersonaRecibeTelefono->headerCellClass() ?>"><span id="elh_PedidoACadeteria_Place1_PersonaRecibeTelefono" class="PedidoACadeteria_Place1_PersonaRecibeTelefono"><?php echo $PedidoACadeteria_delete->Place1_PersonaRecibeTelefono->caption() ?></span></th>
<?php } ?>
<?php if ($PedidoACadeteria_delete->Place2_Nombre->Visible) { // Place2_Nombre ?>
		<th class="<?php echo $PedidoACadeteria_delete->Place2_Nombre->headerCellClass() ?>"><span id="elh_PedidoACadeteria_Place2_Nombre" class="PedidoACadeteria_Place2_Nombre"><?php echo $PedidoACadeteria_delete->Place2_Nombre->caption() ?></span></th>
<?php } ?>
<?php if ($PedidoACadeteria_delete->Place2_Country->Visible) { // Place2_Country ?>
		<th class="<?php echo $PedidoACadeteria_delete->Place2_Country->headerCellClass() ?>"><span id="elh_PedidoACadeteria_Place2_Country" class="PedidoACadeteria_Place2_Country"><?php echo $PedidoACadeteria_delete->Place2_Country->caption() ?></span></th>
<?php } ?>
<?php if ($PedidoACadeteria_delete->Place2_UF->Visible) { // Place2_UF ?>
		<th class="<?php echo $PedidoACadeteria_delete->Place2_UF->headerCellClass() ?>"><span id="elh_PedidoACadeteria_Place2_UF" class="PedidoACadeteria_Place2_UF"><?php echo $PedidoACadeteria_delete->Place2_UF->caption() ?></span></th>
<?php } ?>
<?php if ($PedidoACadeteria_delete->Place2_Lat->Visible) { // Place2_Lat ?>
		<th class="<?php echo $PedidoACadeteria_delete->Place2_Lat->headerCellClass() ?>"><span id="elh_PedidoACadeteria_Place2_Lat" class="PedidoACadeteria_Place2_Lat"><?php echo $PedidoACadeteria_delete->Place2_Lat->caption() ?></span></th>
<?php } ?>
<?php if ($PedidoACadeteria_delete->Place2_Lon->Visible) { // Place2_Lon ?>
		<th class="<?php echo $PedidoACadeteria_delete->Place2_Lon->headerCellClass() ?>"><span id="elh_PedidoACadeteria_Place2_Lon" class="PedidoACadeteria_Place2_Lon"><?php echo $PedidoACadeteria_delete->Place2_Lon->caption() ?></span></th>
<?php } ?>
<?php if ($PedidoACadeteria_delete->Place2_Calle->Visible) { // Place2_Calle ?>
		<th class="<?php echo $PedidoACadeteria_delete->Place2_Calle->headerCellClass() ?>"><span id="elh_PedidoACadeteria_Place2_Calle" class="PedidoACadeteria_Place2_Calle"><?php echo $PedidoACadeteria_delete->Place2_Calle->caption() ?></span></th>
<?php } ?>
<?php if ($PedidoACadeteria_delete->Place2_Numero->Visible) { // Place2_Numero ?>
		<th class="<?php echo $PedidoACadeteria_delete->Place2_Numero->headerCellClass() ?>"><span id="elh_PedidoACadeteria_Place2_Numero" class="PedidoACadeteria_Place2_Numero"><?php echo $PedidoACadeteria_delete->Place2_Numero->caption() ?></span></th>
<?php } ?>
<?php if ($PedidoACadeteria_delete->Place2_Localidad->Visible) { // Place2_Localidad ?>
		<th class="<?php echo $PedidoACadeteria_delete->Place2_Localidad->headerCellClass() ?>"><span id="elh_PedidoACadeteria_Place2_Localidad" class="PedidoACadeteria_Place2_Localidad"><?php echo $PedidoACadeteria_delete->Place2_Localidad->caption() ?></span></th>
<?php } ?>
<?php if ($PedidoACadeteria_delete->Place2_Piso->Visible) { // Place2_Piso ?>
		<th class="<?php echo $PedidoACadeteria_delete->Place2_Piso->headerCellClass() ?>"><span id="elh_PedidoACadeteria_Place2_Piso" class="PedidoACadeteria_Place2_Piso"><?php echo $PedidoACadeteria_delete->Place2_Piso->caption() ?></span></th>
<?php } ?>
<?php if ($PedidoACadeteria_delete->Place2_Depto->Visible) { // Place2_Depto ?>
		<th class="<?php echo $PedidoACadeteria_delete->Place2_Depto->headerCellClass() ?>"><span id="elh_PedidoACadeteria_Place2_Depto" class="PedidoACadeteria_Place2_Depto"><?php echo $PedidoACadeteria_delete->Place2_Depto->caption() ?></span></th>
<?php } ?>
<?php if ($PedidoACadeteria_delete->Place2_PersonaRecibe->Visible) { // Place2_PersonaRecibe ?>
		<th class="<?php echo $PedidoACadeteria_delete->Place2_PersonaRecibe->headerCellClass() ?>"><span id="elh_PedidoACadeteria_Place2_PersonaRecibe" class="PedidoACadeteria_Place2_PersonaRecibe"><?php echo $PedidoACadeteria_delete->Place2_PersonaRecibe->caption() ?></span></th>
<?php } ?>
<?php if ($PedidoACadeteria_delete->Place2_PersonaRecibeTelefono->Visible) { // Place2_PersonaRecibeTelefono ?>
		<th class="<?php echo $PedidoACadeteria_delete->Place2_PersonaRecibeTelefono->headerCellClass() ?>"><span id="elh_PedidoACadeteria_Place2_PersonaRecibeTelefono" class="PedidoACadeteria_Place2_PersonaRecibeTelefono"><?php echo $PedidoACadeteria_delete->Place2_PersonaRecibeTelefono->caption() ?></span></th>
<?php } ?>
<?php if ($PedidoACadeteria_delete->ID_Cadeteria->Visible) { // ID_Cadeteria ?>
		<th class="<?php echo $PedidoACadeteria_delete->ID_Cadeteria->headerCellClass() ?>"><span id="elh_PedidoACadeteria_ID_Cadeteria" class="PedidoACadeteria_ID_Cadeteria"><?php echo $PedidoACadeteria_delete->ID_Cadeteria->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$PedidoACadeteria_delete->RecordCount = 0;
$i = 0;
while (!$PedidoACadeteria_delete->Recordset->EOF) {
	$PedidoACadeteria_delete->RecordCount++;
	$PedidoACadeteria_delete->RowCount++;

	// Set row properties
	$PedidoACadeteria->resetAttributes();
	$PedidoACadeteria->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$PedidoACadeteria_delete->loadRowValues($PedidoACadeteria_delete->Recordset);

	// Render row
	$PedidoACadeteria_delete->renderRow();
?>
	<tr <?php echo $PedidoACadeteria->rowAttributes() ?>>
<?php if ($PedidoACadeteria_delete->ID->Visible) { // ID ?>
		<td <?php echo $PedidoACadeteria_delete->ID->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_delete->RowCount ?>_PedidoACadeteria_ID" class="PedidoACadeteria_ID">
<span<?php echo $PedidoACadeteria_delete->ID->viewAttributes() ?>><?php echo $PedidoACadeteria_delete->ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($PedidoACadeteria_delete->ID_Usuario->Visible) { // ID_Usuario ?>
		<td <?php echo $PedidoACadeteria_delete->ID_Usuario->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_delete->RowCount ?>_PedidoACadeteria_ID_Usuario" class="PedidoACadeteria_ID_Usuario">
<span<?php echo $PedidoACadeteria_delete->ID_Usuario->viewAttributes() ?>><?php echo $PedidoACadeteria_delete->ID_Usuario->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($PedidoACadeteria_delete->ID_Place1->Visible) { // ID_Place1 ?>
		<td <?php echo $PedidoACadeteria_delete->ID_Place1->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_delete->RowCount ?>_PedidoACadeteria_ID_Place1" class="PedidoACadeteria_ID_Place1">
<span<?php echo $PedidoACadeteria_delete->ID_Place1->viewAttributes() ?>><?php echo $PedidoACadeteria_delete->ID_Place1->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($PedidoACadeteria_delete->ID_Place2->Visible) { // ID_Place2 ?>
		<td <?php echo $PedidoACadeteria_delete->ID_Place2->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_delete->RowCount ?>_PedidoACadeteria_ID_Place2" class="PedidoACadeteria_ID_Place2">
<span<?php echo $PedidoACadeteria_delete->ID_Place2->viewAttributes() ?>><?php echo $PedidoACadeteria_delete->ID_Place2->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($PedidoACadeteria_delete->ID_Cadete->Visible) { // ID_Cadete ?>
		<td <?php echo $PedidoACadeteria_delete->ID_Cadete->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_delete->RowCount ?>_PedidoACadeteria_ID_Cadete" class="PedidoACadeteria_ID_Cadete">
<span<?php echo $PedidoACadeteria_delete->ID_Cadete->viewAttributes() ?>><?php echo $PedidoACadeteria_delete->ID_Cadete->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($PedidoACadeteria_delete->ID_Status->Visible) { // ID_Status ?>
		<td <?php echo $PedidoACadeteria_delete->ID_Status->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_delete->RowCount ?>_PedidoACadeteria_ID_Status" class="PedidoACadeteria_ID_Status">
<span<?php echo $PedidoACadeteria_delete->ID_Status->viewAttributes() ?>><?php echo $PedidoACadeteria_delete->ID_Status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($PedidoACadeteria_delete->InstruccionesPlace1->Visible) { // InstruccionesPlace1 ?>
		<td <?php echo $PedidoACadeteria_delete->InstruccionesPlace1->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_delete->RowCount ?>_PedidoACadeteria_InstruccionesPlace1" class="PedidoACadeteria_InstruccionesPlace1">
<span<?php echo $PedidoACadeteria_delete->InstruccionesPlace1->viewAttributes() ?>><?php echo $PedidoACadeteria_delete->InstruccionesPlace1->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($PedidoACadeteria_delete->InstruccionesPlace2->Visible) { // InstruccionesPlace2 ?>
		<td <?php echo $PedidoACadeteria_delete->InstruccionesPlace2->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_delete->RowCount ?>_PedidoACadeteria_InstruccionesPlace2" class="PedidoACadeteria_InstruccionesPlace2">
<span<?php echo $PedidoACadeteria_delete->InstruccionesPlace2->viewAttributes() ?>><?php echo $PedidoACadeteria_delete->InstruccionesPlace2->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($PedidoACadeteria_delete->Direccionalidad->Visible) { // Direccionalidad ?>
		<td <?php echo $PedidoACadeteria_delete->Direccionalidad->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_delete->RowCount ?>_PedidoACadeteria_Direccionalidad" class="PedidoACadeteria_Direccionalidad">
<span<?php echo $PedidoACadeteria_delete->Direccionalidad->viewAttributes() ?>><?php echo $PedidoACadeteria_delete->Direccionalidad->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($PedidoACadeteria_delete->RemitoURL->Visible) { // RemitoURL ?>
		<td <?php echo $PedidoACadeteria_delete->RemitoURL->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_delete->RowCount ?>_PedidoACadeteria_RemitoURL" class="PedidoACadeteria_RemitoURL">
<span<?php echo $PedidoACadeteria_delete->RemitoURL->viewAttributes() ?>><?php echo $PedidoACadeteria_delete->RemitoURL->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($PedidoACadeteria_delete->Place1_Nombre->Visible) { // Place1_Nombre ?>
		<td <?php echo $PedidoACadeteria_delete->Place1_Nombre->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_delete->RowCount ?>_PedidoACadeteria_Place1_Nombre" class="PedidoACadeteria_Place1_Nombre">
<span<?php echo $PedidoACadeteria_delete->Place1_Nombre->viewAttributes() ?>><?php echo $PedidoACadeteria_delete->Place1_Nombre->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($PedidoACadeteria_delete->Place1_Country->Visible) { // Place1_Country ?>
		<td <?php echo $PedidoACadeteria_delete->Place1_Country->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_delete->RowCount ?>_PedidoACadeteria_Place1_Country" class="PedidoACadeteria_Place1_Country">
<span<?php echo $PedidoACadeteria_delete->Place1_Country->viewAttributes() ?>><?php echo $PedidoACadeteria_delete->Place1_Country->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($PedidoACadeteria_delete->Place1_UF->Visible) { // Place1_UF ?>
		<td <?php echo $PedidoACadeteria_delete->Place1_UF->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_delete->RowCount ?>_PedidoACadeteria_Place1_UF" class="PedidoACadeteria_Place1_UF">
<span<?php echo $PedidoACadeteria_delete->Place1_UF->viewAttributes() ?>><?php echo $PedidoACadeteria_delete->Place1_UF->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($PedidoACadeteria_delete->Plate1_Lat->Visible) { // Plate1_Lat ?>
		<td <?php echo $PedidoACadeteria_delete->Plate1_Lat->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_delete->RowCount ?>_PedidoACadeteria_Plate1_Lat" class="PedidoACadeteria_Plate1_Lat">
<span<?php echo $PedidoACadeteria_delete->Plate1_Lat->viewAttributes() ?>><?php echo $PedidoACadeteria_delete->Plate1_Lat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($PedidoACadeteria_delete->Place1_Lon->Visible) { // Place1_Lon ?>
		<td <?php echo $PedidoACadeteria_delete->Place1_Lon->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_delete->RowCount ?>_PedidoACadeteria_Place1_Lon" class="PedidoACadeteria_Place1_Lon">
<span<?php echo $PedidoACadeteria_delete->Place1_Lon->viewAttributes() ?>><?php echo $PedidoACadeteria_delete->Place1_Lon->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($PedidoACadeteria_delete->Place1_Calle->Visible) { // Place1_Calle ?>
		<td <?php echo $PedidoACadeteria_delete->Place1_Calle->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_delete->RowCount ?>_PedidoACadeteria_Place1_Calle" class="PedidoACadeteria_Place1_Calle">
<span<?php echo $PedidoACadeteria_delete->Place1_Calle->viewAttributes() ?>><?php echo $PedidoACadeteria_delete->Place1_Calle->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($PedidoACadeteria_delete->Place1_Numero->Visible) { // Place1_Numero ?>
		<td <?php echo $PedidoACadeteria_delete->Place1_Numero->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_delete->RowCount ?>_PedidoACadeteria_Place1_Numero" class="PedidoACadeteria_Place1_Numero">
<span<?php echo $PedidoACadeteria_delete->Place1_Numero->viewAttributes() ?>><?php echo $PedidoACadeteria_delete->Place1_Numero->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($PedidoACadeteria_delete->Place1_Localidad->Visible) { // Place1_Localidad ?>
		<td <?php echo $PedidoACadeteria_delete->Place1_Localidad->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_delete->RowCount ?>_PedidoACadeteria_Place1_Localidad" class="PedidoACadeteria_Place1_Localidad">
<span<?php echo $PedidoACadeteria_delete->Place1_Localidad->viewAttributes() ?>><?php echo $PedidoACadeteria_delete->Place1_Localidad->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($PedidoACadeteria_delete->Place1_Piso->Visible) { // Place1_Piso ?>
		<td <?php echo $PedidoACadeteria_delete->Place1_Piso->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_delete->RowCount ?>_PedidoACadeteria_Place1_Piso" class="PedidoACadeteria_Place1_Piso">
<span<?php echo $PedidoACadeteria_delete->Place1_Piso->viewAttributes() ?>><?php echo $PedidoACadeteria_delete->Place1_Piso->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($PedidoACadeteria_delete->Place1_Depto->Visible) { // Place1_Depto ?>
		<td <?php echo $PedidoACadeteria_delete->Place1_Depto->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_delete->RowCount ?>_PedidoACadeteria_Place1_Depto" class="PedidoACadeteria_Place1_Depto">
<span<?php echo $PedidoACadeteria_delete->Place1_Depto->viewAttributes() ?>><?php echo $PedidoACadeteria_delete->Place1_Depto->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($PedidoACadeteria_delete->Place1_PersonaRecibe->Visible) { // Place1_PersonaRecibe ?>
		<td <?php echo $PedidoACadeteria_delete->Place1_PersonaRecibe->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_delete->RowCount ?>_PedidoACadeteria_Place1_PersonaRecibe" class="PedidoACadeteria_Place1_PersonaRecibe">
<span<?php echo $PedidoACadeteria_delete->Place1_PersonaRecibe->viewAttributes() ?>><?php echo $PedidoACadeteria_delete->Place1_PersonaRecibe->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($PedidoACadeteria_delete->Place1_PersonaRecibeTelefono->Visible) { // Place1_PersonaRecibeTelefono ?>
		<td <?php echo $PedidoACadeteria_delete->Place1_PersonaRecibeTelefono->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_delete->RowCount ?>_PedidoACadeteria_Place1_PersonaRecibeTelefono" class="PedidoACadeteria_Place1_PersonaRecibeTelefono">
<span<?php echo $PedidoACadeteria_delete->Place1_PersonaRecibeTelefono->viewAttributes() ?>><?php echo $PedidoACadeteria_delete->Place1_PersonaRecibeTelefono->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($PedidoACadeteria_delete->Place2_Nombre->Visible) { // Place2_Nombre ?>
		<td <?php echo $PedidoACadeteria_delete->Place2_Nombre->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_delete->RowCount ?>_PedidoACadeteria_Place2_Nombre" class="PedidoACadeteria_Place2_Nombre">
<span<?php echo $PedidoACadeteria_delete->Place2_Nombre->viewAttributes() ?>><?php echo $PedidoACadeteria_delete->Place2_Nombre->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($PedidoACadeteria_delete->Place2_Country->Visible) { // Place2_Country ?>
		<td <?php echo $PedidoACadeteria_delete->Place2_Country->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_delete->RowCount ?>_PedidoACadeteria_Place2_Country" class="PedidoACadeteria_Place2_Country">
<span<?php echo $PedidoACadeteria_delete->Place2_Country->viewAttributes() ?>><?php echo $PedidoACadeteria_delete->Place2_Country->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($PedidoACadeteria_delete->Place2_UF->Visible) { // Place2_UF ?>
		<td <?php echo $PedidoACadeteria_delete->Place2_UF->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_delete->RowCount ?>_PedidoACadeteria_Place2_UF" class="PedidoACadeteria_Place2_UF">
<span<?php echo $PedidoACadeteria_delete->Place2_UF->viewAttributes() ?>><?php echo $PedidoACadeteria_delete->Place2_UF->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($PedidoACadeteria_delete->Place2_Lat->Visible) { // Place2_Lat ?>
		<td <?php echo $PedidoACadeteria_delete->Place2_Lat->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_delete->RowCount ?>_PedidoACadeteria_Place2_Lat" class="PedidoACadeteria_Place2_Lat">
<span<?php echo $PedidoACadeteria_delete->Place2_Lat->viewAttributes() ?>><?php echo $PedidoACadeteria_delete->Place2_Lat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($PedidoACadeteria_delete->Place2_Lon->Visible) { // Place2_Lon ?>
		<td <?php echo $PedidoACadeteria_delete->Place2_Lon->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_delete->RowCount ?>_PedidoACadeteria_Place2_Lon" class="PedidoACadeteria_Place2_Lon">
<span<?php echo $PedidoACadeteria_delete->Place2_Lon->viewAttributes() ?>><?php echo $PedidoACadeteria_delete->Place2_Lon->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($PedidoACadeteria_delete->Place2_Calle->Visible) { // Place2_Calle ?>
		<td <?php echo $PedidoACadeteria_delete->Place2_Calle->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_delete->RowCount ?>_PedidoACadeteria_Place2_Calle" class="PedidoACadeteria_Place2_Calle">
<span<?php echo $PedidoACadeteria_delete->Place2_Calle->viewAttributes() ?>><?php echo $PedidoACadeteria_delete->Place2_Calle->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($PedidoACadeteria_delete->Place2_Numero->Visible) { // Place2_Numero ?>
		<td <?php echo $PedidoACadeteria_delete->Place2_Numero->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_delete->RowCount ?>_PedidoACadeteria_Place2_Numero" class="PedidoACadeteria_Place2_Numero">
<span<?php echo $PedidoACadeteria_delete->Place2_Numero->viewAttributes() ?>><?php echo $PedidoACadeteria_delete->Place2_Numero->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($PedidoACadeteria_delete->Place2_Localidad->Visible) { // Place2_Localidad ?>
		<td <?php echo $PedidoACadeteria_delete->Place2_Localidad->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_delete->RowCount ?>_PedidoACadeteria_Place2_Localidad" class="PedidoACadeteria_Place2_Localidad">
<span<?php echo $PedidoACadeteria_delete->Place2_Localidad->viewAttributes() ?>><?php echo $PedidoACadeteria_delete->Place2_Localidad->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($PedidoACadeteria_delete->Place2_Piso->Visible) { // Place2_Piso ?>
		<td <?php echo $PedidoACadeteria_delete->Place2_Piso->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_delete->RowCount ?>_PedidoACadeteria_Place2_Piso" class="PedidoACadeteria_Place2_Piso">
<span<?php echo $PedidoACadeteria_delete->Place2_Piso->viewAttributes() ?>><?php echo $PedidoACadeteria_delete->Place2_Piso->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($PedidoACadeteria_delete->Place2_Depto->Visible) { // Place2_Depto ?>
		<td <?php echo $PedidoACadeteria_delete->Place2_Depto->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_delete->RowCount ?>_PedidoACadeteria_Place2_Depto" class="PedidoACadeteria_Place2_Depto">
<span<?php echo $PedidoACadeteria_delete->Place2_Depto->viewAttributes() ?>><?php echo $PedidoACadeteria_delete->Place2_Depto->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($PedidoACadeteria_delete->Place2_PersonaRecibe->Visible) { // Place2_PersonaRecibe ?>
		<td <?php echo $PedidoACadeteria_delete->Place2_PersonaRecibe->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_delete->RowCount ?>_PedidoACadeteria_Place2_PersonaRecibe" class="PedidoACadeteria_Place2_PersonaRecibe">
<span<?php echo $PedidoACadeteria_delete->Place2_PersonaRecibe->viewAttributes() ?>><?php echo $PedidoACadeteria_delete->Place2_PersonaRecibe->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($PedidoACadeteria_delete->Place2_PersonaRecibeTelefono->Visible) { // Place2_PersonaRecibeTelefono ?>
		<td <?php echo $PedidoACadeteria_delete->Place2_PersonaRecibeTelefono->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_delete->RowCount ?>_PedidoACadeteria_Place2_PersonaRecibeTelefono" class="PedidoACadeteria_Place2_PersonaRecibeTelefono">
<span<?php echo $PedidoACadeteria_delete->Place2_PersonaRecibeTelefono->viewAttributes() ?>><?php echo $PedidoACadeteria_delete->Place2_PersonaRecibeTelefono->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($PedidoACadeteria_delete->ID_Cadeteria->Visible) { // ID_Cadeteria ?>
		<td <?php echo $PedidoACadeteria_delete->ID_Cadeteria->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_delete->RowCount ?>_PedidoACadeteria_ID_Cadeteria" class="PedidoACadeteria_ID_Cadeteria">
<span<?php echo $PedidoACadeteria_delete->ID_Cadeteria->viewAttributes() ?>><?php echo $PedidoACadeteria_delete->ID_Cadeteria->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$PedidoACadeteria_delete->Recordset->moveNext();
}
$PedidoACadeteria_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $PedidoACadeteria_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$PedidoACadeteria_delete->showPageFooter();
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
$PedidoACadeteria_delete->terminate();
?>