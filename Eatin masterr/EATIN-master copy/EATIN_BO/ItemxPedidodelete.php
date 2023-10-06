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
$ItemxPedido_delete = new ItemxPedido_delete();

// Run the page
$ItemxPedido_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ItemxPedido_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fItemxPedidodelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fItemxPedidodelete = currentForm = new ew.Form("fItemxPedidodelete", "delete");
	loadjs.done("fItemxPedidodelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ItemxPedido_delete->showPageHeader(); ?>
<?php
$ItemxPedido_delete->showMessage();
?>
<form name="fItemxPedidodelete" id="fItemxPedidodelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ItemxPedido">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($ItemxPedido_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($ItemxPedido_delete->ID->Visible) { // ID ?>
		<th class="<?php echo $ItemxPedido_delete->ID->headerCellClass() ?>"><span id="elh_ItemxPedido_ID" class="ItemxPedido_ID"><?php echo $ItemxPedido_delete->ID->caption() ?></span></th>
<?php } ?>
<?php if ($ItemxPedido_delete->ID_Item->Visible) { // ID_Item ?>
		<th class="<?php echo $ItemxPedido_delete->ID_Item->headerCellClass() ?>"><span id="elh_ItemxPedido_ID_Item" class="ItemxPedido_ID_Item"><?php echo $ItemxPedido_delete->ID_Item->caption() ?></span></th>
<?php } ?>
<?php if ($ItemxPedido_delete->ID_Restaurant->Visible) { // ID_Restaurant ?>
		<th class="<?php echo $ItemxPedido_delete->ID_Restaurant->headerCellClass() ?>"><span id="elh_ItemxPedido_ID_Restaurant" class="ItemxPedido_ID_Restaurant"><?php echo $ItemxPedido_delete->ID_Restaurant->caption() ?></span></th>
<?php } ?>
<?php if ($ItemxPedido_delete->ID_Client->Visible) { // ID_Client ?>
		<th class="<?php echo $ItemxPedido_delete->ID_Client->headerCellClass() ?>"><span id="elh_ItemxPedido_ID_Client" class="ItemxPedido_ID_Client"><?php echo $ItemxPedido_delete->ID_Client->caption() ?></span></th>
<?php } ?>
<?php if ($ItemxPedido_delete->DateCreation->Visible) { // DateCreation ?>
		<th class="<?php echo $ItemxPedido_delete->DateCreation->headerCellClass() ?>"><span id="elh_ItemxPedido_DateCreation" class="ItemxPedido_DateCreation"><?php echo $ItemxPedido_delete->DateCreation->caption() ?></span></th>
<?php } ?>
<?php if ($ItemxPedido_delete->DateLastUpdate->Visible) { // DateLastUpdate ?>
		<th class="<?php echo $ItemxPedido_delete->DateLastUpdate->headerCellClass() ?>"><span id="elh_ItemxPedido_DateLastUpdate" class="ItemxPedido_DateLastUpdate"><?php echo $ItemxPedido_delete->DateLastUpdate->caption() ?></span></th>
<?php } ?>
<?php if ($ItemxPedido_delete->Comments->Visible) { // Comments ?>
		<th class="<?php echo $ItemxPedido_delete->Comments->headerCellClass() ?>"><span id="elh_ItemxPedido_Comments" class="ItemxPedido_Comments"><?php echo $ItemxPedido_delete->Comments->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$ItemxPedido_delete->RecordCount = 0;
$i = 0;
while (!$ItemxPedido_delete->Recordset->EOF) {
	$ItemxPedido_delete->RecordCount++;
	$ItemxPedido_delete->RowCount++;

	// Set row properties
	$ItemxPedido->resetAttributes();
	$ItemxPedido->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$ItemxPedido_delete->loadRowValues($ItemxPedido_delete->Recordset);

	// Render row
	$ItemxPedido_delete->renderRow();
?>
	<tr <?php echo $ItemxPedido->rowAttributes() ?>>
<?php if ($ItemxPedido_delete->ID->Visible) { // ID ?>
		<td <?php echo $ItemxPedido_delete->ID->cellAttributes() ?>>
<span id="el<?php echo $ItemxPedido_delete->RowCount ?>_ItemxPedido_ID" class="ItemxPedido_ID">
<span<?php echo $ItemxPedido_delete->ID->viewAttributes() ?>><?php echo $ItemxPedido_delete->ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ItemxPedido_delete->ID_Item->Visible) { // ID_Item ?>
		<td <?php echo $ItemxPedido_delete->ID_Item->cellAttributes() ?>>
<span id="el<?php echo $ItemxPedido_delete->RowCount ?>_ItemxPedido_ID_Item" class="ItemxPedido_ID_Item">
<span<?php echo $ItemxPedido_delete->ID_Item->viewAttributes() ?>><?php echo $ItemxPedido_delete->ID_Item->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ItemxPedido_delete->ID_Restaurant->Visible) { // ID_Restaurant ?>
		<td <?php echo $ItemxPedido_delete->ID_Restaurant->cellAttributes() ?>>
<span id="el<?php echo $ItemxPedido_delete->RowCount ?>_ItemxPedido_ID_Restaurant" class="ItemxPedido_ID_Restaurant">
<span<?php echo $ItemxPedido_delete->ID_Restaurant->viewAttributes() ?>><?php echo $ItemxPedido_delete->ID_Restaurant->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ItemxPedido_delete->ID_Client->Visible) { // ID_Client ?>
		<td <?php echo $ItemxPedido_delete->ID_Client->cellAttributes() ?>>
<span id="el<?php echo $ItemxPedido_delete->RowCount ?>_ItemxPedido_ID_Client" class="ItemxPedido_ID_Client">
<span<?php echo $ItemxPedido_delete->ID_Client->viewAttributes() ?>><?php echo $ItemxPedido_delete->ID_Client->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ItemxPedido_delete->DateCreation->Visible) { // DateCreation ?>
		<td <?php echo $ItemxPedido_delete->DateCreation->cellAttributes() ?>>
<span id="el<?php echo $ItemxPedido_delete->RowCount ?>_ItemxPedido_DateCreation" class="ItemxPedido_DateCreation">
<span<?php echo $ItemxPedido_delete->DateCreation->viewAttributes() ?>><?php echo $ItemxPedido_delete->DateCreation->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ItemxPedido_delete->DateLastUpdate->Visible) { // DateLastUpdate ?>
		<td <?php echo $ItemxPedido_delete->DateLastUpdate->cellAttributes() ?>>
<span id="el<?php echo $ItemxPedido_delete->RowCount ?>_ItemxPedido_DateLastUpdate" class="ItemxPedido_DateLastUpdate">
<span<?php echo $ItemxPedido_delete->DateLastUpdate->viewAttributes() ?>><?php echo $ItemxPedido_delete->DateLastUpdate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ItemxPedido_delete->Comments->Visible) { // Comments ?>
		<td <?php echo $ItemxPedido_delete->Comments->cellAttributes() ?>>
<span id="el<?php echo $ItemxPedido_delete->RowCount ?>_ItemxPedido_Comments" class="ItemxPedido_Comments">
<span<?php echo $ItemxPedido_delete->Comments->viewAttributes() ?>><?php echo $ItemxPedido_delete->Comments->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$ItemxPedido_delete->Recordset->moveNext();
}
$ItemxPedido_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ItemxPedido_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$ItemxPedido_delete->showPageFooter();
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
$ItemxPedido_delete->terminate();
?>