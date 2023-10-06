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
$_Table_delete = new _Table_delete();

// Run the page
$_Table_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$_Table_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var f_Tabledelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	f_Tabledelete = currentForm = new ew.Form("f_Tabledelete", "delete");
	loadjs.done("f_Tabledelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $_Table_delete->showPageHeader(); ?>
<?php
$_Table_delete->showMessage();
?>
<form name="f_Tabledelete" id="f_Tabledelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="_Table">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($_Table_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($_Table_delete->ID->Visible) { // ID ?>
		<th class="<?php echo $_Table_delete->ID->headerCellClass() ?>"><span id="elh__Table_ID" class="_Table_ID"><?php echo $_Table_delete->ID->caption() ?></span></th>
<?php } ?>
<?php if ($_Table_delete->ID_Restaurant->Visible) { // ID_Restaurant ?>
		<th class="<?php echo $_Table_delete->ID_Restaurant->headerCellClass() ?>"><span id="elh__Table_ID_Restaurant" class="_Table_ID_Restaurant"><?php echo $_Table_delete->ID_Restaurant->caption() ?></span></th>
<?php } ?>
<?php if ($_Table_delete->QRCode->Visible) { // QRCode ?>
		<th class="<?php echo $_Table_delete->QRCode->headerCellClass() ?>"><span id="elh__Table_QRCode" class="_Table_QRCode"><?php echo $_Table_delete->QRCode->caption() ?></span></th>
<?php } ?>
<?php if ($_Table_delete->Numero->Visible) { // Numero ?>
		<th class="<?php echo $_Table_delete->Numero->headerCellClass() ?>"><span id="elh__Table_Numero" class="_Table_Numero"><?php echo $_Table_delete->Numero->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$_Table_delete->RecordCount = 0;
$i = 0;
while (!$_Table_delete->Recordset->EOF) {
	$_Table_delete->RecordCount++;
	$_Table_delete->RowCount++;

	// Set row properties
	$_Table->resetAttributes();
	$_Table->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$_Table_delete->loadRowValues($_Table_delete->Recordset);

	// Render row
	$_Table_delete->renderRow();
?>
	<tr <?php echo $_Table->rowAttributes() ?>>
<?php if ($_Table_delete->ID->Visible) { // ID ?>
		<td <?php echo $_Table_delete->ID->cellAttributes() ?>>
<span id="el<?php echo $_Table_delete->RowCount ?>__Table_ID" class="_Table_ID">
<span<?php echo $_Table_delete->ID->viewAttributes() ?>><?php echo $_Table_delete->ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($_Table_delete->ID_Restaurant->Visible) { // ID_Restaurant ?>
		<td <?php echo $_Table_delete->ID_Restaurant->cellAttributes() ?>>
<span id="el<?php echo $_Table_delete->RowCount ?>__Table_ID_Restaurant" class="_Table_ID_Restaurant">
<span<?php echo $_Table_delete->ID_Restaurant->viewAttributes() ?>><?php echo $_Table_delete->ID_Restaurant->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($_Table_delete->QRCode->Visible) { // QRCode ?>
		<td <?php echo $_Table_delete->QRCode->cellAttributes() ?>>
<span id="el<?php echo $_Table_delete->RowCount ?>__Table_QRCode" class="_Table_QRCode">
<span<?php echo $_Table_delete->QRCode->viewAttributes() ?>><?php if (!EmptyString($_Table_delete->QRCode->getViewValue()) && $_Table_delete->QRCode->linkAttributes() != "") { ?>
<a<?php echo $_Table_delete->QRCode->linkAttributes() ?>><?php echo $_Table_delete->QRCode->getViewValue() ?></a>
<?php } else { ?>
<?php echo $_Table_delete->QRCode->getViewValue() ?>
<?php } ?></span>
</span>
</td>
<?php } ?>
<?php if ($_Table_delete->Numero->Visible) { // Numero ?>
		<td <?php echo $_Table_delete->Numero->cellAttributes() ?>>
<span id="el<?php echo $_Table_delete->RowCount ?>__Table_Numero" class="_Table_Numero">
<span<?php echo $_Table_delete->Numero->viewAttributes() ?>><?php echo $_Table_delete->Numero->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$_Table_delete->Recordset->moveNext();
}
$_Table_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $_Table_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$_Table_delete->showPageFooter();
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
$_Table_delete->terminate();
?>