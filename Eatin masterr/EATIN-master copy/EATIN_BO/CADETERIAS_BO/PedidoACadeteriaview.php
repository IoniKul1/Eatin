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
$PedidoACadeteria_view = new PedidoACadeteria_view();

// Run the page
$PedidoACadeteria_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$PedidoACadeteria_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$PedidoACadeteria_view->isExport()) { ?>
<script>
var fPedidoACadeteriaview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fPedidoACadeteriaview = currentForm = new ew.Form("fPedidoACadeteriaview", "view");
	loadjs.done("fPedidoACadeteriaview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$PedidoACadeteria_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $PedidoACadeteria_view->ExportOptions->render("body") ?>
<?php $PedidoACadeteria_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $PedidoACadeteria_view->showPageHeader(); ?>
<?php
$PedidoACadeteria_view->showMessage();
?>
<form name="fPedidoACadeteriaview" id="fPedidoACadeteriaview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="PedidoACadeteria">
<input type="hidden" name="modal" value="<?php echo (int)$PedidoACadeteria_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($PedidoACadeteria_view->ID->Visible) { // ID ?>
	<tr id="r_ID">
		<td class="<?php echo $PedidoACadeteria_view->TableLeftColumnClass ?>"><span id="elh_PedidoACadeteria_ID"><?php echo $PedidoACadeteria_view->ID->caption() ?></span></td>
		<td data-name="ID" <?php echo $PedidoACadeteria_view->ID->cellAttributes() ?>>
<span id="el_PedidoACadeteria_ID">
<span<?php echo $PedidoACadeteria_view->ID->viewAttributes() ?>><?php echo $PedidoACadeteria_view->ID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($PedidoACadeteria_view->ID_Usuario->Visible) { // ID_Usuario ?>
	<tr id="r_ID_Usuario">
		<td class="<?php echo $PedidoACadeteria_view->TableLeftColumnClass ?>"><span id="elh_PedidoACadeteria_ID_Usuario"><?php echo $PedidoACadeteria_view->ID_Usuario->caption() ?></span></td>
		<td data-name="ID_Usuario" <?php echo $PedidoACadeteria_view->ID_Usuario->cellAttributes() ?>>
<span id="el_PedidoACadeteria_ID_Usuario">
<span<?php echo $PedidoACadeteria_view->ID_Usuario->viewAttributes() ?>><?php echo $PedidoACadeteria_view->ID_Usuario->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($PedidoACadeteria_view->ID_Place1->Visible) { // ID_Place1 ?>
	<tr id="r_ID_Place1">
		<td class="<?php echo $PedidoACadeteria_view->TableLeftColumnClass ?>"><span id="elh_PedidoACadeteria_ID_Place1"><?php echo $PedidoACadeteria_view->ID_Place1->caption() ?></span></td>
		<td data-name="ID_Place1" <?php echo $PedidoACadeteria_view->ID_Place1->cellAttributes() ?>>
<span id="el_PedidoACadeteria_ID_Place1">
<span<?php echo $PedidoACadeteria_view->ID_Place1->viewAttributes() ?>><?php echo $PedidoACadeteria_view->ID_Place1->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($PedidoACadeteria_view->ID_Place2->Visible) { // ID_Place2 ?>
	<tr id="r_ID_Place2">
		<td class="<?php echo $PedidoACadeteria_view->TableLeftColumnClass ?>"><span id="elh_PedidoACadeteria_ID_Place2"><?php echo $PedidoACadeteria_view->ID_Place2->caption() ?></span></td>
		<td data-name="ID_Place2" <?php echo $PedidoACadeteria_view->ID_Place2->cellAttributes() ?>>
<span id="el_PedidoACadeteria_ID_Place2">
<span<?php echo $PedidoACadeteria_view->ID_Place2->viewAttributes() ?>><?php echo $PedidoACadeteria_view->ID_Place2->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($PedidoACadeteria_view->ID_Cadete->Visible) { // ID_Cadete ?>
	<tr id="r_ID_Cadete">
		<td class="<?php echo $PedidoACadeteria_view->TableLeftColumnClass ?>"><span id="elh_PedidoACadeteria_ID_Cadete"><?php echo $PedidoACadeteria_view->ID_Cadete->caption() ?></span></td>
		<td data-name="ID_Cadete" <?php echo $PedidoACadeteria_view->ID_Cadete->cellAttributes() ?>>
<span id="el_PedidoACadeteria_ID_Cadete">
<span<?php echo $PedidoACadeteria_view->ID_Cadete->viewAttributes() ?>><?php echo $PedidoACadeteria_view->ID_Cadete->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($PedidoACadeteria_view->ID_Status->Visible) { // ID_Status ?>
	<tr id="r_ID_Status">
		<td class="<?php echo $PedidoACadeteria_view->TableLeftColumnClass ?>"><span id="elh_PedidoACadeteria_ID_Status"><?php echo $PedidoACadeteria_view->ID_Status->caption() ?></span></td>
		<td data-name="ID_Status" <?php echo $PedidoACadeteria_view->ID_Status->cellAttributes() ?>>
<span id="el_PedidoACadeteria_ID_Status">
<span<?php echo $PedidoACadeteria_view->ID_Status->viewAttributes() ?>><?php echo $PedidoACadeteria_view->ID_Status->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($PedidoACadeteria_view->InstruccionesPlace1->Visible) { // InstruccionesPlace1 ?>
	<tr id="r_InstruccionesPlace1">
		<td class="<?php echo $PedidoACadeteria_view->TableLeftColumnClass ?>"><span id="elh_PedidoACadeteria_InstruccionesPlace1"><?php echo $PedidoACadeteria_view->InstruccionesPlace1->caption() ?></span></td>
		<td data-name="InstruccionesPlace1" <?php echo $PedidoACadeteria_view->InstruccionesPlace1->cellAttributes() ?>>
<span id="el_PedidoACadeteria_InstruccionesPlace1">
<span<?php echo $PedidoACadeteria_view->InstruccionesPlace1->viewAttributes() ?>><?php echo $PedidoACadeteria_view->InstruccionesPlace1->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($PedidoACadeteria_view->InstruccionesPlace2->Visible) { // InstruccionesPlace2 ?>
	<tr id="r_InstruccionesPlace2">
		<td class="<?php echo $PedidoACadeteria_view->TableLeftColumnClass ?>"><span id="elh_PedidoACadeteria_InstruccionesPlace2"><?php echo $PedidoACadeteria_view->InstruccionesPlace2->caption() ?></span></td>
		<td data-name="InstruccionesPlace2" <?php echo $PedidoACadeteria_view->InstruccionesPlace2->cellAttributes() ?>>
<span id="el_PedidoACadeteria_InstruccionesPlace2">
<span<?php echo $PedidoACadeteria_view->InstruccionesPlace2->viewAttributes() ?>><?php echo $PedidoACadeteria_view->InstruccionesPlace2->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($PedidoACadeteria_view->Direccionalidad->Visible) { // Direccionalidad ?>
	<tr id="r_Direccionalidad">
		<td class="<?php echo $PedidoACadeteria_view->TableLeftColumnClass ?>"><span id="elh_PedidoACadeteria_Direccionalidad"><?php echo $PedidoACadeteria_view->Direccionalidad->caption() ?></span></td>
		<td data-name="Direccionalidad" <?php echo $PedidoACadeteria_view->Direccionalidad->cellAttributes() ?>>
<span id="el_PedidoACadeteria_Direccionalidad">
<span<?php echo $PedidoACadeteria_view->Direccionalidad->viewAttributes() ?>><?php echo $PedidoACadeteria_view->Direccionalidad->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($PedidoACadeteria_view->RemitoURL->Visible) { // RemitoURL ?>
	<tr id="r_RemitoURL">
		<td class="<?php echo $PedidoACadeteria_view->TableLeftColumnClass ?>"><span id="elh_PedidoACadeteria_RemitoURL"><?php echo $PedidoACadeteria_view->RemitoURL->caption() ?></span></td>
		<td data-name="RemitoURL" <?php echo $PedidoACadeteria_view->RemitoURL->cellAttributes() ?>>
<span id="el_PedidoACadeteria_RemitoURL">
<span<?php echo $PedidoACadeteria_view->RemitoURL->viewAttributes() ?>><?php echo $PedidoACadeteria_view->RemitoURL->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($PedidoACadeteria_view->Place1_Nombre->Visible) { // Place1_Nombre ?>
	<tr id="r_Place1_Nombre">
		<td class="<?php echo $PedidoACadeteria_view->TableLeftColumnClass ?>"><span id="elh_PedidoACadeteria_Place1_Nombre"><?php echo $PedidoACadeteria_view->Place1_Nombre->caption() ?></span></td>
		<td data-name="Place1_Nombre" <?php echo $PedidoACadeteria_view->Place1_Nombre->cellAttributes() ?>>
<span id="el_PedidoACadeteria_Place1_Nombre">
<span<?php echo $PedidoACadeteria_view->Place1_Nombre->viewAttributes() ?>><?php echo $PedidoACadeteria_view->Place1_Nombre->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($PedidoACadeteria_view->Place1_Country->Visible) { // Place1_Country ?>
	<tr id="r_Place1_Country">
		<td class="<?php echo $PedidoACadeteria_view->TableLeftColumnClass ?>"><span id="elh_PedidoACadeteria_Place1_Country"><?php echo $PedidoACadeteria_view->Place1_Country->caption() ?></span></td>
		<td data-name="Place1_Country" <?php echo $PedidoACadeteria_view->Place1_Country->cellAttributes() ?>>
<span id="el_PedidoACadeteria_Place1_Country">
<span<?php echo $PedidoACadeteria_view->Place1_Country->viewAttributes() ?>><?php echo $PedidoACadeteria_view->Place1_Country->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($PedidoACadeteria_view->Place1_UF->Visible) { // Place1_UF ?>
	<tr id="r_Place1_UF">
		<td class="<?php echo $PedidoACadeteria_view->TableLeftColumnClass ?>"><span id="elh_PedidoACadeteria_Place1_UF"><?php echo $PedidoACadeteria_view->Place1_UF->caption() ?></span></td>
		<td data-name="Place1_UF" <?php echo $PedidoACadeteria_view->Place1_UF->cellAttributes() ?>>
<span id="el_PedidoACadeteria_Place1_UF">
<span<?php echo $PedidoACadeteria_view->Place1_UF->viewAttributes() ?>><?php echo $PedidoACadeteria_view->Place1_UF->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($PedidoACadeteria_view->Plate1_Lat->Visible) { // Plate1_Lat ?>
	<tr id="r_Plate1_Lat">
		<td class="<?php echo $PedidoACadeteria_view->TableLeftColumnClass ?>"><span id="elh_PedidoACadeteria_Plate1_Lat"><?php echo $PedidoACadeteria_view->Plate1_Lat->caption() ?></span></td>
		<td data-name="Plate1_Lat" <?php echo $PedidoACadeteria_view->Plate1_Lat->cellAttributes() ?>>
<span id="el_PedidoACadeteria_Plate1_Lat">
<span<?php echo $PedidoACadeteria_view->Plate1_Lat->viewAttributes() ?>><?php echo $PedidoACadeteria_view->Plate1_Lat->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($PedidoACadeteria_view->Place1_Lon->Visible) { // Place1_Lon ?>
	<tr id="r_Place1_Lon">
		<td class="<?php echo $PedidoACadeteria_view->TableLeftColumnClass ?>"><span id="elh_PedidoACadeteria_Place1_Lon"><?php echo $PedidoACadeteria_view->Place1_Lon->caption() ?></span></td>
		<td data-name="Place1_Lon" <?php echo $PedidoACadeteria_view->Place1_Lon->cellAttributes() ?>>
<span id="el_PedidoACadeteria_Place1_Lon">
<span<?php echo $PedidoACadeteria_view->Place1_Lon->viewAttributes() ?>><?php echo $PedidoACadeteria_view->Place1_Lon->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($PedidoACadeteria_view->Place1_Calle->Visible) { // Place1_Calle ?>
	<tr id="r_Place1_Calle">
		<td class="<?php echo $PedidoACadeteria_view->TableLeftColumnClass ?>"><span id="elh_PedidoACadeteria_Place1_Calle"><?php echo $PedidoACadeteria_view->Place1_Calle->caption() ?></span></td>
		<td data-name="Place1_Calle" <?php echo $PedidoACadeteria_view->Place1_Calle->cellAttributes() ?>>
<span id="el_PedidoACadeteria_Place1_Calle">
<span<?php echo $PedidoACadeteria_view->Place1_Calle->viewAttributes() ?>><?php echo $PedidoACadeteria_view->Place1_Calle->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($PedidoACadeteria_view->Place1_Numero->Visible) { // Place1_Numero ?>
	<tr id="r_Place1_Numero">
		<td class="<?php echo $PedidoACadeteria_view->TableLeftColumnClass ?>"><span id="elh_PedidoACadeteria_Place1_Numero"><?php echo $PedidoACadeteria_view->Place1_Numero->caption() ?></span></td>
		<td data-name="Place1_Numero" <?php echo $PedidoACadeteria_view->Place1_Numero->cellAttributes() ?>>
<span id="el_PedidoACadeteria_Place1_Numero">
<span<?php echo $PedidoACadeteria_view->Place1_Numero->viewAttributes() ?>><?php echo $PedidoACadeteria_view->Place1_Numero->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($PedidoACadeteria_view->Place1_Localidad->Visible) { // Place1_Localidad ?>
	<tr id="r_Place1_Localidad">
		<td class="<?php echo $PedidoACadeteria_view->TableLeftColumnClass ?>"><span id="elh_PedidoACadeteria_Place1_Localidad"><?php echo $PedidoACadeteria_view->Place1_Localidad->caption() ?></span></td>
		<td data-name="Place1_Localidad" <?php echo $PedidoACadeteria_view->Place1_Localidad->cellAttributes() ?>>
<span id="el_PedidoACadeteria_Place1_Localidad">
<span<?php echo $PedidoACadeteria_view->Place1_Localidad->viewAttributes() ?>><?php echo $PedidoACadeteria_view->Place1_Localidad->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($PedidoACadeteria_view->Place1_Piso->Visible) { // Place1_Piso ?>
	<tr id="r_Place1_Piso">
		<td class="<?php echo $PedidoACadeteria_view->TableLeftColumnClass ?>"><span id="elh_PedidoACadeteria_Place1_Piso"><?php echo $PedidoACadeteria_view->Place1_Piso->caption() ?></span></td>
		<td data-name="Place1_Piso" <?php echo $PedidoACadeteria_view->Place1_Piso->cellAttributes() ?>>
<span id="el_PedidoACadeteria_Place1_Piso">
<span<?php echo $PedidoACadeteria_view->Place1_Piso->viewAttributes() ?>><?php echo $PedidoACadeteria_view->Place1_Piso->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($PedidoACadeteria_view->Place1_Depto->Visible) { // Place1_Depto ?>
	<tr id="r_Place1_Depto">
		<td class="<?php echo $PedidoACadeteria_view->TableLeftColumnClass ?>"><span id="elh_PedidoACadeteria_Place1_Depto"><?php echo $PedidoACadeteria_view->Place1_Depto->caption() ?></span></td>
		<td data-name="Place1_Depto" <?php echo $PedidoACadeteria_view->Place1_Depto->cellAttributes() ?>>
<span id="el_PedidoACadeteria_Place1_Depto">
<span<?php echo $PedidoACadeteria_view->Place1_Depto->viewAttributes() ?>><?php echo $PedidoACadeteria_view->Place1_Depto->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($PedidoACadeteria_view->Place1_PersonaRecibe->Visible) { // Place1_PersonaRecibe ?>
	<tr id="r_Place1_PersonaRecibe">
		<td class="<?php echo $PedidoACadeteria_view->TableLeftColumnClass ?>"><span id="elh_PedidoACadeteria_Place1_PersonaRecibe"><?php echo $PedidoACadeteria_view->Place1_PersonaRecibe->caption() ?></span></td>
		<td data-name="Place1_PersonaRecibe" <?php echo $PedidoACadeteria_view->Place1_PersonaRecibe->cellAttributes() ?>>
<span id="el_PedidoACadeteria_Place1_PersonaRecibe">
<span<?php echo $PedidoACadeteria_view->Place1_PersonaRecibe->viewAttributes() ?>><?php echo $PedidoACadeteria_view->Place1_PersonaRecibe->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($PedidoACadeteria_view->Place1_PersonaRecibeTelefono->Visible) { // Place1_PersonaRecibeTelefono ?>
	<tr id="r_Place1_PersonaRecibeTelefono">
		<td class="<?php echo $PedidoACadeteria_view->TableLeftColumnClass ?>"><span id="elh_PedidoACadeteria_Place1_PersonaRecibeTelefono"><?php echo $PedidoACadeteria_view->Place1_PersonaRecibeTelefono->caption() ?></span></td>
		<td data-name="Place1_PersonaRecibeTelefono" <?php echo $PedidoACadeteria_view->Place1_PersonaRecibeTelefono->cellAttributes() ?>>
<span id="el_PedidoACadeteria_Place1_PersonaRecibeTelefono">
<span<?php echo $PedidoACadeteria_view->Place1_PersonaRecibeTelefono->viewAttributes() ?>><?php echo $PedidoACadeteria_view->Place1_PersonaRecibeTelefono->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($PedidoACadeteria_view->Place2_Nombre->Visible) { // Place2_Nombre ?>
	<tr id="r_Place2_Nombre">
		<td class="<?php echo $PedidoACadeteria_view->TableLeftColumnClass ?>"><span id="elh_PedidoACadeteria_Place2_Nombre"><?php echo $PedidoACadeteria_view->Place2_Nombre->caption() ?></span></td>
		<td data-name="Place2_Nombre" <?php echo $PedidoACadeteria_view->Place2_Nombre->cellAttributes() ?>>
<span id="el_PedidoACadeteria_Place2_Nombre">
<span<?php echo $PedidoACadeteria_view->Place2_Nombre->viewAttributes() ?>><?php echo $PedidoACadeteria_view->Place2_Nombre->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($PedidoACadeteria_view->Place2_Country->Visible) { // Place2_Country ?>
	<tr id="r_Place2_Country">
		<td class="<?php echo $PedidoACadeteria_view->TableLeftColumnClass ?>"><span id="elh_PedidoACadeteria_Place2_Country"><?php echo $PedidoACadeteria_view->Place2_Country->caption() ?></span></td>
		<td data-name="Place2_Country" <?php echo $PedidoACadeteria_view->Place2_Country->cellAttributes() ?>>
<span id="el_PedidoACadeteria_Place2_Country">
<span<?php echo $PedidoACadeteria_view->Place2_Country->viewAttributes() ?>><?php echo $PedidoACadeteria_view->Place2_Country->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($PedidoACadeteria_view->Place2_UF->Visible) { // Place2_UF ?>
	<tr id="r_Place2_UF">
		<td class="<?php echo $PedidoACadeteria_view->TableLeftColumnClass ?>"><span id="elh_PedidoACadeteria_Place2_UF"><?php echo $PedidoACadeteria_view->Place2_UF->caption() ?></span></td>
		<td data-name="Place2_UF" <?php echo $PedidoACadeteria_view->Place2_UF->cellAttributes() ?>>
<span id="el_PedidoACadeteria_Place2_UF">
<span<?php echo $PedidoACadeteria_view->Place2_UF->viewAttributes() ?>><?php echo $PedidoACadeteria_view->Place2_UF->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($PedidoACadeteria_view->Place2_Lat->Visible) { // Place2_Lat ?>
	<tr id="r_Place2_Lat">
		<td class="<?php echo $PedidoACadeteria_view->TableLeftColumnClass ?>"><span id="elh_PedidoACadeteria_Place2_Lat"><?php echo $PedidoACadeteria_view->Place2_Lat->caption() ?></span></td>
		<td data-name="Place2_Lat" <?php echo $PedidoACadeteria_view->Place2_Lat->cellAttributes() ?>>
<span id="el_PedidoACadeteria_Place2_Lat">
<span<?php echo $PedidoACadeteria_view->Place2_Lat->viewAttributes() ?>><?php echo $PedidoACadeteria_view->Place2_Lat->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($PedidoACadeteria_view->Place2_Lon->Visible) { // Place2_Lon ?>
	<tr id="r_Place2_Lon">
		<td class="<?php echo $PedidoACadeteria_view->TableLeftColumnClass ?>"><span id="elh_PedidoACadeteria_Place2_Lon"><?php echo $PedidoACadeteria_view->Place2_Lon->caption() ?></span></td>
		<td data-name="Place2_Lon" <?php echo $PedidoACadeteria_view->Place2_Lon->cellAttributes() ?>>
<span id="el_PedidoACadeteria_Place2_Lon">
<span<?php echo $PedidoACadeteria_view->Place2_Lon->viewAttributes() ?>><?php echo $PedidoACadeteria_view->Place2_Lon->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($PedidoACadeteria_view->Place2_Calle->Visible) { // Place2_Calle ?>
	<tr id="r_Place2_Calle">
		<td class="<?php echo $PedidoACadeteria_view->TableLeftColumnClass ?>"><span id="elh_PedidoACadeteria_Place2_Calle"><?php echo $PedidoACadeteria_view->Place2_Calle->caption() ?></span></td>
		<td data-name="Place2_Calle" <?php echo $PedidoACadeteria_view->Place2_Calle->cellAttributes() ?>>
<span id="el_PedidoACadeteria_Place2_Calle">
<span<?php echo $PedidoACadeteria_view->Place2_Calle->viewAttributes() ?>><?php echo $PedidoACadeteria_view->Place2_Calle->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($PedidoACadeteria_view->Place2_Numero->Visible) { // Place2_Numero ?>
	<tr id="r_Place2_Numero">
		<td class="<?php echo $PedidoACadeteria_view->TableLeftColumnClass ?>"><span id="elh_PedidoACadeteria_Place2_Numero"><?php echo $PedidoACadeteria_view->Place2_Numero->caption() ?></span></td>
		<td data-name="Place2_Numero" <?php echo $PedidoACadeteria_view->Place2_Numero->cellAttributes() ?>>
<span id="el_PedidoACadeteria_Place2_Numero">
<span<?php echo $PedidoACadeteria_view->Place2_Numero->viewAttributes() ?>><?php echo $PedidoACadeteria_view->Place2_Numero->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($PedidoACadeteria_view->Place2_Localidad->Visible) { // Place2_Localidad ?>
	<tr id="r_Place2_Localidad">
		<td class="<?php echo $PedidoACadeteria_view->TableLeftColumnClass ?>"><span id="elh_PedidoACadeteria_Place2_Localidad"><?php echo $PedidoACadeteria_view->Place2_Localidad->caption() ?></span></td>
		<td data-name="Place2_Localidad" <?php echo $PedidoACadeteria_view->Place2_Localidad->cellAttributes() ?>>
<span id="el_PedidoACadeteria_Place2_Localidad">
<span<?php echo $PedidoACadeteria_view->Place2_Localidad->viewAttributes() ?>><?php echo $PedidoACadeteria_view->Place2_Localidad->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($PedidoACadeteria_view->Place2_Piso->Visible) { // Place2_Piso ?>
	<tr id="r_Place2_Piso">
		<td class="<?php echo $PedidoACadeteria_view->TableLeftColumnClass ?>"><span id="elh_PedidoACadeteria_Place2_Piso"><?php echo $PedidoACadeteria_view->Place2_Piso->caption() ?></span></td>
		<td data-name="Place2_Piso" <?php echo $PedidoACadeteria_view->Place2_Piso->cellAttributes() ?>>
<span id="el_PedidoACadeteria_Place2_Piso">
<span<?php echo $PedidoACadeteria_view->Place2_Piso->viewAttributes() ?>><?php echo $PedidoACadeteria_view->Place2_Piso->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($PedidoACadeteria_view->Place2_Depto->Visible) { // Place2_Depto ?>
	<tr id="r_Place2_Depto">
		<td class="<?php echo $PedidoACadeteria_view->TableLeftColumnClass ?>"><span id="elh_PedidoACadeteria_Place2_Depto"><?php echo $PedidoACadeteria_view->Place2_Depto->caption() ?></span></td>
		<td data-name="Place2_Depto" <?php echo $PedidoACadeteria_view->Place2_Depto->cellAttributes() ?>>
<span id="el_PedidoACadeteria_Place2_Depto">
<span<?php echo $PedidoACadeteria_view->Place2_Depto->viewAttributes() ?>><?php echo $PedidoACadeteria_view->Place2_Depto->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($PedidoACadeteria_view->Place2_PersonaRecibe->Visible) { // Place2_PersonaRecibe ?>
	<tr id="r_Place2_PersonaRecibe">
		<td class="<?php echo $PedidoACadeteria_view->TableLeftColumnClass ?>"><span id="elh_PedidoACadeteria_Place2_PersonaRecibe"><?php echo $PedidoACadeteria_view->Place2_PersonaRecibe->caption() ?></span></td>
		<td data-name="Place2_PersonaRecibe" <?php echo $PedidoACadeteria_view->Place2_PersonaRecibe->cellAttributes() ?>>
<span id="el_PedidoACadeteria_Place2_PersonaRecibe">
<span<?php echo $PedidoACadeteria_view->Place2_PersonaRecibe->viewAttributes() ?>><?php echo $PedidoACadeteria_view->Place2_PersonaRecibe->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($PedidoACadeteria_view->Place2_PersonaRecibeTelefono->Visible) { // Place2_PersonaRecibeTelefono ?>
	<tr id="r_Place2_PersonaRecibeTelefono">
		<td class="<?php echo $PedidoACadeteria_view->TableLeftColumnClass ?>"><span id="elh_PedidoACadeteria_Place2_PersonaRecibeTelefono"><?php echo $PedidoACadeteria_view->Place2_PersonaRecibeTelefono->caption() ?></span></td>
		<td data-name="Place2_PersonaRecibeTelefono" <?php echo $PedidoACadeteria_view->Place2_PersonaRecibeTelefono->cellAttributes() ?>>
<span id="el_PedidoACadeteria_Place2_PersonaRecibeTelefono">
<span<?php echo $PedidoACadeteria_view->Place2_PersonaRecibeTelefono->viewAttributes() ?>><?php echo $PedidoACadeteria_view->Place2_PersonaRecibeTelefono->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($PedidoACadeteria_view->ID_Cadeteria->Visible) { // ID_Cadeteria ?>
	<tr id="r_ID_Cadeteria">
		<td class="<?php echo $PedidoACadeteria_view->TableLeftColumnClass ?>"><span id="elh_PedidoACadeteria_ID_Cadeteria"><?php echo $PedidoACadeteria_view->ID_Cadeteria->caption() ?></span></td>
		<td data-name="ID_Cadeteria" <?php echo $PedidoACadeteria_view->ID_Cadeteria->cellAttributes() ?>>
<span id="el_PedidoACadeteria_ID_Cadeteria">
<span<?php echo $PedidoACadeteria_view->ID_Cadeteria->viewAttributes() ?>><?php echo $PedidoACadeteria_view->ID_Cadeteria->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$PedidoACadeteria_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$PedidoACadeteria_view->isExport()) { ?>
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
$PedidoACadeteria_view->terminate();
?>