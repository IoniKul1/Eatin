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
$Checkin_delete = new Checkin_delete();

// Run the page
$Checkin_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Checkin_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fCheckindelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fCheckindelete = currentForm = new ew.Form("fCheckindelete", "delete");
	loadjs.done("fCheckindelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $Checkin_delete->showPageHeader(); ?>
<?php
$Checkin_delete->showMessage();
?>
<form name="fCheckindelete" id="fCheckindelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Checkin">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Checkin_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($Checkin_delete->ID->Visible) { // ID ?>
		<th class="<?php echo $Checkin_delete->ID->headerCellClass() ?>"><span id="elh_Checkin_ID" class="Checkin_ID"><?php echo $Checkin_delete->ID->caption() ?></span></th>
<?php } ?>
<?php if ($Checkin_delete->ID_Cadete->Visible) { // ID_Cadete ?>
		<th class="<?php echo $Checkin_delete->ID_Cadete->headerCellClass() ?>"><span id="elh_Checkin_ID_Cadete" class="Checkin_ID_Cadete"><?php echo $Checkin_delete->ID_Cadete->caption() ?></span></th>
<?php } ?>
<?php if ($Checkin_delete->ID_PedidoACadeteria->Visible) { // ID_PedidoACadeteria ?>
		<th class="<?php echo $Checkin_delete->ID_PedidoACadeteria->headerCellClass() ?>"><span id="elh_Checkin_ID_PedidoACadeteria" class="Checkin_ID_PedidoACadeteria"><?php echo $Checkin_delete->ID_PedidoACadeteria->caption() ?></span></th>
<?php } ?>
<?php if ($Checkin_delete->FechaCreacion->Visible) { // FechaCreacion ?>
		<th class="<?php echo $Checkin_delete->FechaCreacion->headerCellClass() ?>"><span id="elh_Checkin_FechaCreacion" class="Checkin_FechaCreacion"><?php echo $Checkin_delete->FechaCreacion->caption() ?></span></th>
<?php } ?>
<?php if ($Checkin_delete->ID_Cadeteria->Visible) { // ID_Cadeteria ?>
		<th class="<?php echo $Checkin_delete->ID_Cadeteria->headerCellClass() ?>"><span id="elh_Checkin_ID_Cadeteria" class="Checkin_ID_Cadeteria"><?php echo $Checkin_delete->ID_Cadeteria->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$Checkin_delete->RecordCount = 0;
$i = 0;
while (!$Checkin_delete->Recordset->EOF) {
	$Checkin_delete->RecordCount++;
	$Checkin_delete->RowCount++;

	// Set row properties
	$Checkin->resetAttributes();
	$Checkin->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$Checkin_delete->loadRowValues($Checkin_delete->Recordset);

	// Render row
	$Checkin_delete->renderRow();
?>
	<tr <?php echo $Checkin->rowAttributes() ?>>
<?php if ($Checkin_delete->ID->Visible) { // ID ?>
		<td <?php echo $Checkin_delete->ID->cellAttributes() ?>>
<span id="el<?php echo $Checkin_delete->RowCount ?>_Checkin_ID" class="Checkin_ID">
<span<?php echo $Checkin_delete->ID->viewAttributes() ?>><?php echo $Checkin_delete->ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Checkin_delete->ID_Cadete->Visible) { // ID_Cadete ?>
		<td <?php echo $Checkin_delete->ID_Cadete->cellAttributes() ?>>
<span id="el<?php echo $Checkin_delete->RowCount ?>_Checkin_ID_Cadete" class="Checkin_ID_Cadete">
<span<?php echo $Checkin_delete->ID_Cadete->viewAttributes() ?>><?php echo $Checkin_delete->ID_Cadete->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Checkin_delete->ID_PedidoACadeteria->Visible) { // ID_PedidoACadeteria ?>
		<td <?php echo $Checkin_delete->ID_PedidoACadeteria->cellAttributes() ?>>
<span id="el<?php echo $Checkin_delete->RowCount ?>_Checkin_ID_PedidoACadeteria" class="Checkin_ID_PedidoACadeteria">
<span<?php echo $Checkin_delete->ID_PedidoACadeteria->viewAttributes() ?>><?php echo $Checkin_delete->ID_PedidoACadeteria->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Checkin_delete->FechaCreacion->Visible) { // FechaCreacion ?>
		<td <?php echo $Checkin_delete->FechaCreacion->cellAttributes() ?>>
<span id="el<?php echo $Checkin_delete->RowCount ?>_Checkin_FechaCreacion" class="Checkin_FechaCreacion">
<span<?php echo $Checkin_delete->FechaCreacion->viewAttributes() ?>><?php echo $Checkin_delete->FechaCreacion->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Checkin_delete->ID_Cadeteria->Visible) { // ID_Cadeteria ?>
		<td <?php echo $Checkin_delete->ID_Cadeteria->cellAttributes() ?>>
<span id="el<?php echo $Checkin_delete->RowCount ?>_Checkin_ID_Cadeteria" class="Checkin_ID_Cadeteria">
<span<?php echo $Checkin_delete->ID_Cadeteria->viewAttributes() ?>><?php echo $Checkin_delete->ID_Cadeteria->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$Checkin_delete->Recordset->moveNext();
}
$Checkin_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $Checkin_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Checkin_delete->showPageFooter();
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
$Checkin_delete->terminate();
?>