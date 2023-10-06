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
$Countries_delete = new Countries_delete();

// Run the page
$Countries_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Countries_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fCountriesdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fCountriesdelete = currentForm = new ew.Form("fCountriesdelete", "delete");
	loadjs.done("fCountriesdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $Countries_delete->showPageHeader(); ?>
<?php
$Countries_delete->showMessage();
?>
<form name="fCountriesdelete" id="fCountriesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Countries">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Countries_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($Countries_delete->ID->Visible) { // ID ?>
		<th class="<?php echo $Countries_delete->ID->headerCellClass() ?>"><span id="elh_Countries_ID" class="Countries_ID"><?php echo $Countries_delete->ID->caption() ?></span></th>
<?php } ?>
<?php if ($Countries_delete->Name->Visible) { // Name ?>
		<th class="<?php echo $Countries_delete->Name->headerCellClass() ?>"><span id="elh_Countries_Name" class="Countries_Name"><?php echo $Countries_delete->Name->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$Countries_delete->RecordCount = 0;
$i = 0;
while (!$Countries_delete->Recordset->EOF) {
	$Countries_delete->RecordCount++;
	$Countries_delete->RowCount++;

	// Set row properties
	$Countries->resetAttributes();
	$Countries->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$Countries_delete->loadRowValues($Countries_delete->Recordset);

	// Render row
	$Countries_delete->renderRow();
?>
	<tr <?php echo $Countries->rowAttributes() ?>>
<?php if ($Countries_delete->ID->Visible) { // ID ?>
		<td <?php echo $Countries_delete->ID->cellAttributes() ?>>
<span id="el<?php echo $Countries_delete->RowCount ?>_Countries_ID" class="Countries_ID">
<span<?php echo $Countries_delete->ID->viewAttributes() ?>><?php echo $Countries_delete->ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Countries_delete->Name->Visible) { // Name ?>
		<td <?php echo $Countries_delete->Name->cellAttributes() ?>>
<span id="el<?php echo $Countries_delete->RowCount ?>_Countries_Name" class="Countries_Name">
<span<?php echo $Countries_delete->Name->viewAttributes() ?>><?php echo $Countries_delete->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$Countries_delete->Recordset->moveNext();
}
$Countries_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $Countries_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Countries_delete->showPageFooter();
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
$Countries_delete->terminate();
?>