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
$Restaurant_delete = new Restaurant_delete();

// Run the page
$Restaurant_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Restaurant_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fRestaurantdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fRestaurantdelete = currentForm = new ew.Form("fRestaurantdelete", "delete");
	loadjs.done("fRestaurantdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $Restaurant_delete->showPageHeader(); ?>
<?php
$Restaurant_delete->showMessage();
?>
<form name="fRestaurantdelete" id="fRestaurantdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Restaurant">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Restaurant_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($Restaurant_delete->ID->Visible) { // ID ?>
		<th class="<?php echo $Restaurant_delete->ID->headerCellClass() ?>"><span id="elh_Restaurant_ID" class="Restaurant_ID"><?php echo $Restaurant_delete->ID->caption() ?></span></th>
<?php } ?>
<?php if ($Restaurant_delete->ID_State->Visible) { // ID_State ?>
		<th class="<?php echo $Restaurant_delete->ID_State->headerCellClass() ?>"><span id="elh_Restaurant_ID_State" class="Restaurant_ID_State"><?php echo $Restaurant_delete->ID_State->caption() ?></span></th>
<?php } ?>
<?php if ($Restaurant_delete->Nombre->Visible) { // Nombre ?>
		<th class="<?php echo $Restaurant_delete->Nombre->headerCellClass() ?>"><span id="elh_Restaurant_Nombre" class="Restaurant_Nombre"><?php echo $Restaurant_delete->Nombre->caption() ?></span></th>
<?php } ?>
<?php if ($Restaurant_delete->Address->Visible) { // Address ?>
		<th class="<?php echo $Restaurant_delete->Address->headerCellClass() ?>"><span id="elh_Restaurant_Address" class="Restaurant_Address"><?php echo $Restaurant_delete->Address->caption() ?></span></th>
<?php } ?>
<?php if ($Restaurant_delete->Deactivated->Visible) { // Deactivated ?>
		<th class="<?php echo $Restaurant_delete->Deactivated->headerCellClass() ?>"><span id="elh_Restaurant_Deactivated" class="Restaurant_Deactivated"><?php echo $Restaurant_delete->Deactivated->caption() ?></span></th>
<?php } ?>
<?php if ($Restaurant_delete->Suspended->Visible) { // Suspended ?>
		<th class="<?php echo $Restaurant_delete->Suspended->headerCellClass() ?>"><span id="elh_Restaurant_Suspended" class="Restaurant_Suspended"><?php echo $Restaurant_delete->Suspended->caption() ?></span></th>
<?php } ?>
<?php if ($Restaurant_delete->_Email->Visible) { // Email ?>
		<th class="<?php echo $Restaurant_delete->_Email->headerCellClass() ?>"><span id="elh_Restaurant__Email" class="Restaurant__Email"><?php echo $Restaurant_delete->_Email->caption() ?></span></th>
<?php } ?>
<?php if ($Restaurant_delete->Password->Visible) { // Password ?>
		<th class="<?php echo $Restaurant_delete->Password->headerCellClass() ?>"><span id="elh_Restaurant_Password" class="Restaurant_Password"><?php echo $Restaurant_delete->Password->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$Restaurant_delete->RecordCount = 0;
$i = 0;
while (!$Restaurant_delete->Recordset->EOF) {
	$Restaurant_delete->RecordCount++;
	$Restaurant_delete->RowCount++;

	// Set row properties
	$Restaurant->resetAttributes();
	$Restaurant->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$Restaurant_delete->loadRowValues($Restaurant_delete->Recordset);

	// Render row
	$Restaurant_delete->renderRow();
?>
	<tr <?php echo $Restaurant->rowAttributes() ?>>
<?php if ($Restaurant_delete->ID->Visible) { // ID ?>
		<td <?php echo $Restaurant_delete->ID->cellAttributes() ?>>
<span id="el<?php echo $Restaurant_delete->RowCount ?>_Restaurant_ID" class="Restaurant_ID">
<span<?php echo $Restaurant_delete->ID->viewAttributes() ?>><?php echo $Restaurant_delete->ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Restaurant_delete->ID_State->Visible) { // ID_State ?>
		<td <?php echo $Restaurant_delete->ID_State->cellAttributes() ?>>
<span id="el<?php echo $Restaurant_delete->RowCount ?>_Restaurant_ID_State" class="Restaurant_ID_State">
<span<?php echo $Restaurant_delete->ID_State->viewAttributes() ?>><?php echo $Restaurant_delete->ID_State->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Restaurant_delete->Nombre->Visible) { // Nombre ?>
		<td <?php echo $Restaurant_delete->Nombre->cellAttributes() ?>>
<span id="el<?php echo $Restaurant_delete->RowCount ?>_Restaurant_Nombre" class="Restaurant_Nombre">
<span<?php echo $Restaurant_delete->Nombre->viewAttributes() ?>><?php echo $Restaurant_delete->Nombre->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Restaurant_delete->Address->Visible) { // Address ?>
		<td <?php echo $Restaurant_delete->Address->cellAttributes() ?>>
<span id="el<?php echo $Restaurant_delete->RowCount ?>_Restaurant_Address" class="Restaurant_Address">
<span<?php echo $Restaurant_delete->Address->viewAttributes() ?>><?php echo $Restaurant_delete->Address->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Restaurant_delete->Deactivated->Visible) { // Deactivated ?>
		<td <?php echo $Restaurant_delete->Deactivated->cellAttributes() ?>>
<span id="el<?php echo $Restaurant_delete->RowCount ?>_Restaurant_Deactivated" class="Restaurant_Deactivated">
<span<?php echo $Restaurant_delete->Deactivated->viewAttributes() ?>><?php echo $Restaurant_delete->Deactivated->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Restaurant_delete->Suspended->Visible) { // Suspended ?>
		<td <?php echo $Restaurant_delete->Suspended->cellAttributes() ?>>
<span id="el<?php echo $Restaurant_delete->RowCount ?>_Restaurant_Suspended" class="Restaurant_Suspended">
<span<?php echo $Restaurant_delete->Suspended->viewAttributes() ?>><?php echo $Restaurant_delete->Suspended->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Restaurant_delete->_Email->Visible) { // Email ?>
		<td <?php echo $Restaurant_delete->_Email->cellAttributes() ?>>
<span id="el<?php echo $Restaurant_delete->RowCount ?>_Restaurant__Email" class="Restaurant__Email">
<span<?php echo $Restaurant_delete->_Email->viewAttributes() ?>><?php echo $Restaurant_delete->_Email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Restaurant_delete->Password->Visible) { // Password ?>
		<td <?php echo $Restaurant_delete->Password->cellAttributes() ?>>
<span id="el<?php echo $Restaurant_delete->RowCount ?>_Restaurant_Password" class="Restaurant_Password">
<span<?php echo $Restaurant_delete->Password->viewAttributes() ?>><?php echo $Restaurant_delete->Password->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$Restaurant_delete->Recordset->moveNext();
}
$Restaurant_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $Restaurant_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Restaurant_delete->showPageFooter();
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
$Restaurant_delete->terminate();
?>