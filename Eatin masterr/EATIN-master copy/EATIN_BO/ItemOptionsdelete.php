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
$ItemOptions_delete = new ItemOptions_delete();

// Run the page
$ItemOptions_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ItemOptions_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fItemOptionsdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fItemOptionsdelete = currentForm = new ew.Form("fItemOptionsdelete", "delete");
	loadjs.done("fItemOptionsdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ItemOptions_delete->showPageHeader(); ?>
<?php
$ItemOptions_delete->showMessage();
?>
<form name="fItemOptionsdelete" id="fItemOptionsdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ItemOptions">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($ItemOptions_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($ItemOptions_delete->ID->Visible) { // ID ?>
		<th class="<?php echo $ItemOptions_delete->ID->headerCellClass() ?>"><span id="elh_ItemOptions_ID" class="ItemOptions_ID"><?php echo $ItemOptions_delete->ID->caption() ?></span></th>
<?php } ?>
<?php if ($ItemOptions_delete->ID_Item->Visible) { // ID_Item ?>
		<th class="<?php echo $ItemOptions_delete->ID_Item->headerCellClass() ?>"><span id="elh_ItemOptions_ID_Item" class="ItemOptions_ID_Item"><?php echo $ItemOptions_delete->ID_Item->caption() ?></span></th>
<?php } ?>
<?php if ($ItemOptions_delete->ID_Restaurant->Visible) { // ID_Restaurant ?>
		<th class="<?php echo $ItemOptions_delete->ID_Restaurant->headerCellClass() ?>"><span id="elh_ItemOptions_ID_Restaurant" class="ItemOptions_ID_Restaurant"><?php echo $ItemOptions_delete->ID_Restaurant->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$ItemOptions_delete->RecordCount = 0;
$i = 0;
while (!$ItemOptions_delete->Recordset->EOF) {
	$ItemOptions_delete->RecordCount++;
	$ItemOptions_delete->RowCount++;

	// Set row properties
	$ItemOptions->resetAttributes();
	$ItemOptions->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$ItemOptions_delete->loadRowValues($ItemOptions_delete->Recordset);

	// Render row
	$ItemOptions_delete->renderRow();
?>
	<tr <?php echo $ItemOptions->rowAttributes() ?>>
<?php if ($ItemOptions_delete->ID->Visible) { // ID ?>
		<td <?php echo $ItemOptions_delete->ID->cellAttributes() ?>>
<span id="el<?php echo $ItemOptions_delete->RowCount ?>_ItemOptions_ID" class="ItemOptions_ID">
<span<?php echo $ItemOptions_delete->ID->viewAttributes() ?>><?php echo $ItemOptions_delete->ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ItemOptions_delete->ID_Item->Visible) { // ID_Item ?>
		<td <?php echo $ItemOptions_delete->ID_Item->cellAttributes() ?>>
<span id="el<?php echo $ItemOptions_delete->RowCount ?>_ItemOptions_ID_Item" class="ItemOptions_ID_Item">
<span<?php echo $ItemOptions_delete->ID_Item->viewAttributes() ?>><?php echo $ItemOptions_delete->ID_Item->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ItemOptions_delete->ID_Restaurant->Visible) { // ID_Restaurant ?>
		<td <?php echo $ItemOptions_delete->ID_Restaurant->cellAttributes() ?>>
<span id="el<?php echo $ItemOptions_delete->RowCount ?>_ItemOptions_ID_Restaurant" class="ItemOptions_ID_Restaurant">
<span<?php echo $ItemOptions_delete->ID_Restaurant->viewAttributes() ?>><?php echo $ItemOptions_delete->ID_Restaurant->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$ItemOptions_delete->Recordset->moveNext();
}
$ItemOptions_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ItemOptions_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$ItemOptions_delete->showPageFooter();
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
$ItemOptions_delete->terminate();
?>