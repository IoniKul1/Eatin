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
$Pedido_delete = new Pedido_delete();

// Run the page
$Pedido_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Pedido_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fPedidodelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fPedidodelete = currentForm = new ew.Form("fPedidodelete", "delete");
	loadjs.done("fPedidodelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $Pedido_delete->showPageHeader(); ?>
<?php
$Pedido_delete->showMessage();
?>
<form name="fPedidodelete" id="fPedidodelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Pedido">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Pedido_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($Pedido_delete->ID->Visible) { // ID ?>
		<th class="<?php echo $Pedido_delete->ID->headerCellClass() ?>"><span id="elh_Pedido_ID" class="Pedido_ID"><?php echo $Pedido_delete->ID->caption() ?></span></th>
<?php } ?>
<?php if ($Pedido_delete->ID_Client->Visible) { // ID_Client ?>
		<th class="<?php echo $Pedido_delete->ID_Client->headerCellClass() ?>"><span id="elh_Pedido_ID_Client" class="Pedido_ID_Client"><?php echo $Pedido_delete->ID_Client->caption() ?></span></th>
<?php } ?>
<?php if ($Pedido_delete->ID_Status->Visible) { // ID_Status ?>
		<th class="<?php echo $Pedido_delete->ID_Status->headerCellClass() ?>"><span id="elh_Pedido_ID_Status" class="Pedido_ID_Status"><?php echo $Pedido_delete->ID_Status->caption() ?></span></th>
<?php } ?>
<?php if ($Pedido_delete->ID_Restaurant->Visible) { // ID_Restaurant ?>
		<th class="<?php echo $Pedido_delete->ID_Restaurant->headerCellClass() ?>"><span id="elh_Pedido_ID_Restaurant" class="Pedido_ID_Restaurant"><?php echo $Pedido_delete->ID_Restaurant->caption() ?></span></th>
<?php } ?>
<?php if ($Pedido_delete->DateCreation->Visible) { // DateCreation ?>
		<th class="<?php echo $Pedido_delete->DateCreation->headerCellClass() ?>"><span id="elh_Pedido_DateCreation" class="Pedido_DateCreation"><?php echo $Pedido_delete->DateCreation->caption() ?></span></th>
<?php } ?>
<?php if ($Pedido_delete->DateLastUpdate->Visible) { // DateLastUpdate ?>
		<th class="<?php echo $Pedido_delete->DateLastUpdate->headerCellClass() ?>"><span id="elh_Pedido_DateLastUpdate" class="Pedido_DateLastUpdate"><?php echo $Pedido_delete->DateLastUpdate->caption() ?></span></th>
<?php } ?>
<?php if ($Pedido_delete->ID_Table->Visible) { // ID_Table ?>
		<th class="<?php echo $Pedido_delete->ID_Table->headerCellClass() ?>"><span id="elh_Pedido_ID_Table" class="Pedido_ID_Table"><?php echo $Pedido_delete->ID_Table->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$Pedido_delete->RecordCount = 0;
$i = 0;
while (!$Pedido_delete->Recordset->EOF) {
	$Pedido_delete->RecordCount++;
	$Pedido_delete->RowCount++;

	// Set row properties
	$Pedido->resetAttributes();
	$Pedido->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$Pedido_delete->loadRowValues($Pedido_delete->Recordset);

	// Render row
	$Pedido_delete->renderRow();
?>
	<tr <?php echo $Pedido->rowAttributes() ?>>
<?php if ($Pedido_delete->ID->Visible) { // ID ?>
		<td <?php echo $Pedido_delete->ID->cellAttributes() ?>>
<span id="el<?php echo $Pedido_delete->RowCount ?>_Pedido_ID" class="Pedido_ID">
<span<?php echo $Pedido_delete->ID->viewAttributes() ?>><?php echo $Pedido_delete->ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Pedido_delete->ID_Client->Visible) { // ID_Client ?>
		<td <?php echo $Pedido_delete->ID_Client->cellAttributes() ?>>
<span id="el<?php echo $Pedido_delete->RowCount ?>_Pedido_ID_Client" class="Pedido_ID_Client">
<span<?php echo $Pedido_delete->ID_Client->viewAttributes() ?>><?php echo $Pedido_delete->ID_Client->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Pedido_delete->ID_Status->Visible) { // ID_Status ?>
		<td <?php echo $Pedido_delete->ID_Status->cellAttributes() ?>>
<span id="el<?php echo $Pedido_delete->RowCount ?>_Pedido_ID_Status" class="Pedido_ID_Status">
<span<?php echo $Pedido_delete->ID_Status->viewAttributes() ?>><?php echo $Pedido_delete->ID_Status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Pedido_delete->ID_Restaurant->Visible) { // ID_Restaurant ?>
		<td <?php echo $Pedido_delete->ID_Restaurant->cellAttributes() ?>>
<span id="el<?php echo $Pedido_delete->RowCount ?>_Pedido_ID_Restaurant" class="Pedido_ID_Restaurant">
<span<?php echo $Pedido_delete->ID_Restaurant->viewAttributes() ?>><?php echo $Pedido_delete->ID_Restaurant->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Pedido_delete->DateCreation->Visible) { // DateCreation ?>
		<td <?php echo $Pedido_delete->DateCreation->cellAttributes() ?>>
<span id="el<?php echo $Pedido_delete->RowCount ?>_Pedido_DateCreation" class="Pedido_DateCreation">
<span<?php echo $Pedido_delete->DateCreation->viewAttributes() ?>><?php echo $Pedido_delete->DateCreation->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Pedido_delete->DateLastUpdate->Visible) { // DateLastUpdate ?>
		<td <?php echo $Pedido_delete->DateLastUpdate->cellAttributes() ?>>
<span id="el<?php echo $Pedido_delete->RowCount ?>_Pedido_DateLastUpdate" class="Pedido_DateLastUpdate">
<span<?php echo $Pedido_delete->DateLastUpdate->viewAttributes() ?>><?php echo $Pedido_delete->DateLastUpdate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Pedido_delete->ID_Table->Visible) { // ID_Table ?>
		<td <?php echo $Pedido_delete->ID_Table->cellAttributes() ?>>
<span id="el<?php echo $Pedido_delete->RowCount ?>_Pedido_ID_Table" class="Pedido_ID_Table">
<span<?php echo $Pedido_delete->ID_Table->viewAttributes() ?>><?php echo $Pedido_delete->ID_Table->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$Pedido_delete->Recordset->moveNext();
}
$Pedido_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $Pedido_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Pedido_delete->showPageFooter();
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
$Pedido_delete->terminate();
?>