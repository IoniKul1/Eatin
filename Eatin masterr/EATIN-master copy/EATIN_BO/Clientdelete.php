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
$Client_delete = new Client_delete();

// Run the page
$Client_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Client_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fClientdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fClientdelete = currentForm = new ew.Form("fClientdelete", "delete");
	loadjs.done("fClientdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $Client_delete->showPageHeader(); ?>
<?php
$Client_delete->showMessage();
?>
<form name="fClientdelete" id="fClientdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Client">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Client_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($Client_delete->ID->Visible) { // ID ?>
		<th class="<?php echo $Client_delete->ID->headerCellClass() ?>"><span id="elh_Client_ID" class="Client_ID"><?php echo $Client_delete->ID->caption() ?></span></th>
<?php } ?>
<?php if ($Client_delete->ID_Restaurant->Visible) { // ID_Restaurant ?>
		<th class="<?php echo $Client_delete->ID_Restaurant->headerCellClass() ?>"><span id="elh_Client_ID_Restaurant" class="Client_ID_Restaurant"><?php echo $Client_delete->ID_Restaurant->caption() ?></span></th>
<?php } ?>
<?php if ($Client_delete->FirstName->Visible) { // FirstName ?>
		<th class="<?php echo $Client_delete->FirstName->headerCellClass() ?>"><span id="elh_Client_FirstName" class="Client_FirstName"><?php echo $Client_delete->FirstName->caption() ?></span></th>
<?php } ?>
<?php if ($Client_delete->LastName->Visible) { // LastName ?>
		<th class="<?php echo $Client_delete->LastName->headerCellClass() ?>"><span id="elh_Client_LastName" class="Client_LastName"><?php echo $Client_delete->LastName->caption() ?></span></th>
<?php } ?>
<?php if ($Client_delete->_Email->Visible) { // Email ?>
		<th class="<?php echo $Client_delete->_Email->headerCellClass() ?>"><span id="elh_Client__Email" class="Client__Email"><?php echo $Client_delete->_Email->caption() ?></span></th>
<?php } ?>
<?php if ($Client_delete->Phone->Visible) { // Phone ?>
		<th class="<?php echo $Client_delete->Phone->headerCellClass() ?>"><span id="elh_Client_Phone" class="Client_Phone"><?php echo $Client_delete->Phone->caption() ?></span></th>
<?php } ?>
<?php if ($Client_delete->Banned->Visible) { // Banned ?>
		<th class="<?php echo $Client_delete->Banned->headerCellClass() ?>"><span id="elh_Client_Banned" class="Client_Banned"><?php echo $Client_delete->Banned->caption() ?></span></th>
<?php } ?>
<?php if ($Client_delete->ClientToken->Visible) { // ClientToken ?>
		<th class="<?php echo $Client_delete->ClientToken->headerCellClass() ?>"><span id="elh_Client_ClientToken" class="Client_ClientToken"><?php echo $Client_delete->ClientToken->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$Client_delete->RecordCount = 0;
$i = 0;
while (!$Client_delete->Recordset->EOF) {
	$Client_delete->RecordCount++;
	$Client_delete->RowCount++;

	// Set row properties
	$Client->resetAttributes();
	$Client->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$Client_delete->loadRowValues($Client_delete->Recordset);

	// Render row
	$Client_delete->renderRow();
?>
	<tr <?php echo $Client->rowAttributes() ?>>
<?php if ($Client_delete->ID->Visible) { // ID ?>
		<td <?php echo $Client_delete->ID->cellAttributes() ?>>
<span id="el<?php echo $Client_delete->RowCount ?>_Client_ID" class="Client_ID">
<span<?php echo $Client_delete->ID->viewAttributes() ?>><?php echo $Client_delete->ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Client_delete->ID_Restaurant->Visible) { // ID_Restaurant ?>
		<td <?php echo $Client_delete->ID_Restaurant->cellAttributes() ?>>
<span id="el<?php echo $Client_delete->RowCount ?>_Client_ID_Restaurant" class="Client_ID_Restaurant">
<span<?php echo $Client_delete->ID_Restaurant->viewAttributes() ?>><?php echo $Client_delete->ID_Restaurant->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Client_delete->FirstName->Visible) { // FirstName ?>
		<td <?php echo $Client_delete->FirstName->cellAttributes() ?>>
<span id="el<?php echo $Client_delete->RowCount ?>_Client_FirstName" class="Client_FirstName">
<span<?php echo $Client_delete->FirstName->viewAttributes() ?>><?php echo $Client_delete->FirstName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Client_delete->LastName->Visible) { // LastName ?>
		<td <?php echo $Client_delete->LastName->cellAttributes() ?>>
<span id="el<?php echo $Client_delete->RowCount ?>_Client_LastName" class="Client_LastName">
<span<?php echo $Client_delete->LastName->viewAttributes() ?>><?php echo $Client_delete->LastName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Client_delete->_Email->Visible) { // Email ?>
		<td <?php echo $Client_delete->_Email->cellAttributes() ?>>
<span id="el<?php echo $Client_delete->RowCount ?>_Client__Email" class="Client__Email">
<span<?php echo $Client_delete->_Email->viewAttributes() ?>><?php echo $Client_delete->_Email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Client_delete->Phone->Visible) { // Phone ?>
		<td <?php echo $Client_delete->Phone->cellAttributes() ?>>
<span id="el<?php echo $Client_delete->RowCount ?>_Client_Phone" class="Client_Phone">
<span<?php echo $Client_delete->Phone->viewAttributes() ?>><?php echo $Client_delete->Phone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Client_delete->Banned->Visible) { // Banned ?>
		<td <?php echo $Client_delete->Banned->cellAttributes() ?>>
<span id="el<?php echo $Client_delete->RowCount ?>_Client_Banned" class="Client_Banned">
<span<?php echo $Client_delete->Banned->viewAttributes() ?>><?php echo $Client_delete->Banned->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Client_delete->ClientToken->Visible) { // ClientToken ?>
		<td <?php echo $Client_delete->ClientToken->cellAttributes() ?>>
<span id="el<?php echo $Client_delete->RowCount ?>_Client_ClientToken" class="Client_ClientToken">
<span<?php echo $Client_delete->ClientToken->viewAttributes() ?>><?php echo $Client_delete->ClientToken->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$Client_delete->Recordset->moveNext();
}
$Client_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $Client_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Client_delete->showPageFooter();
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
$Client_delete->terminate();
?>