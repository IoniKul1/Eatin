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
$State_delete = new State_delete();

// Run the page
$State_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$State_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fStatedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fStatedelete = currentForm = new ew.Form("fStatedelete", "delete");
	loadjs.done("fStatedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $State_delete->showPageHeader(); ?>
<?php
$State_delete->showMessage();
?>
<form name="fStatedelete" id="fStatedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="State">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($State_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($State_delete->ID->Visible) { // ID ?>
		<th class="<?php echo $State_delete->ID->headerCellClass() ?>"><span id="elh_State_ID" class="State_ID"><?php echo $State_delete->ID->caption() ?></span></th>
<?php } ?>
<?php if ($State_delete->Name->Visible) { // Name ?>
		<th class="<?php echo $State_delete->Name->headerCellClass() ?>"><span id="elh_State_Name" class="State_Name"><?php echo $State_delete->Name->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$State_delete->RecordCount = 0;
$i = 0;
while (!$State_delete->Recordset->EOF) {
	$State_delete->RecordCount++;
	$State_delete->RowCount++;

	// Set row properties
	$State->resetAttributes();
	$State->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$State_delete->loadRowValues($State_delete->Recordset);

	// Render row
	$State_delete->renderRow();
?>
	<tr <?php echo $State->rowAttributes() ?>>
<?php if ($State_delete->ID->Visible) { // ID ?>
		<td <?php echo $State_delete->ID->cellAttributes() ?>>
<span id="el<?php echo $State_delete->RowCount ?>_State_ID" class="State_ID">
<span<?php echo $State_delete->ID->viewAttributes() ?>><?php echo $State_delete->ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($State_delete->Name->Visible) { // Name ?>
		<td <?php echo $State_delete->Name->cellAttributes() ?>>
<span id="el<?php echo $State_delete->RowCount ?>_State_Name" class="State_Name">
<span<?php echo $State_delete->Name->viewAttributes() ?>><?php echo $State_delete->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$State_delete->Recordset->moveNext();
}
$State_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $State_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$State_delete->showPageFooter();
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
$State_delete->terminate();
?>