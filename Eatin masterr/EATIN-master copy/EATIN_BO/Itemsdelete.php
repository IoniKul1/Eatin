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
$Items_delete = new Items_delete();

// Run the page
$Items_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Items_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fItemsdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fItemsdelete = currentForm = new ew.Form("fItemsdelete", "delete");
	loadjs.done("fItemsdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $Items_delete->showPageHeader(); ?>
<?php
$Items_delete->showMessage();
?>
<form name="fItemsdelete" id="fItemsdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Items">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Items_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($Items_delete->ID->Visible) { // ID ?>
		<th class="<?php echo $Items_delete->ID->headerCellClass() ?>"><span id="elh_Items_ID" class="Items_ID"><?php echo $Items_delete->ID->caption() ?></span></th>
<?php } ?>
<?php if ($Items_delete->ID_Categorias->Visible) { // ID_Categorias ?>
		<th class="<?php echo $Items_delete->ID_Categorias->headerCellClass() ?>"><span id="elh_Items_ID_Categorias" class="Items_ID_Categorias"><?php echo $Items_delete->ID_Categorias->caption() ?></span></th>
<?php } ?>
<?php if ($Items_delete->ID_Restaurant->Visible) { // ID_Restaurant ?>
		<th class="<?php echo $Items_delete->ID_Restaurant->headerCellClass() ?>"><span id="elh_Items_ID_Restaurant" class="Items_ID_Restaurant"><?php echo $Items_delete->ID_Restaurant->caption() ?></span></th>
<?php } ?>
<?php if ($Items_delete->Nombre->Visible) { // Nombre ?>
		<th class="<?php echo $Items_delete->Nombre->headerCellClass() ?>"><span id="elh_Items_Nombre" class="Items_Nombre"><?php echo $Items_delete->Nombre->caption() ?></span></th>
<?php } ?>
<?php if ($Items_delete->Precio->Visible) { // Precio ?>
		<th class="<?php echo $Items_delete->Precio->headerCellClass() ?>"><span id="elh_Items_Precio" class="Items_Precio"><?php echo $Items_delete->Precio->caption() ?></span></th>
<?php } ?>
<?php if ($Items_delete->Active->Visible) { // Active ?>
		<th class="<?php echo $Items_delete->Active->headerCellClass() ?>"><span id="elh_Items_Active" class="Items_Active"><?php echo $Items_delete->Active->caption() ?></span></th>
<?php } ?>
<?php if ($Items_delete->Stock->Visible) { // Stock ?>
		<th class="<?php echo $Items_delete->Stock->headerCellClass() ?>"><span id="elh_Items_Stock" class="Items_Stock"><?php echo $Items_delete->Stock->caption() ?></span></th>
<?php } ?>
<?php if ($Items_delete->Img1->Visible) { // Img1 ?>
		<th class="<?php echo $Items_delete->Img1->headerCellClass() ?>"><span id="elh_Items_Img1" class="Items_Img1"><?php echo $Items_delete->Img1->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$Items_delete->RecordCount = 0;
$i = 0;
while (!$Items_delete->Recordset->EOF) {
	$Items_delete->RecordCount++;
	$Items_delete->RowCount++;

	// Set row properties
	$Items->resetAttributes();
	$Items->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$Items_delete->loadRowValues($Items_delete->Recordset);

	// Render row
	$Items_delete->renderRow();
?>
	<tr <?php echo $Items->rowAttributes() ?>>
<?php if ($Items_delete->ID->Visible) { // ID ?>
		<td <?php echo $Items_delete->ID->cellAttributes() ?>>
<span id="el<?php echo $Items_delete->RowCount ?>_Items_ID" class="Items_ID">
<span<?php echo $Items_delete->ID->viewAttributes() ?>><?php echo $Items_delete->ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Items_delete->ID_Categorias->Visible) { // ID_Categorias ?>
		<td <?php echo $Items_delete->ID_Categorias->cellAttributes() ?>>
<span id="el<?php echo $Items_delete->RowCount ?>_Items_ID_Categorias" class="Items_ID_Categorias">
<span<?php echo $Items_delete->ID_Categorias->viewAttributes() ?>><?php echo $Items_delete->ID_Categorias->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Items_delete->ID_Restaurant->Visible) { // ID_Restaurant ?>
		<td <?php echo $Items_delete->ID_Restaurant->cellAttributes() ?>>
<span id="el<?php echo $Items_delete->RowCount ?>_Items_ID_Restaurant" class="Items_ID_Restaurant">
<span<?php echo $Items_delete->ID_Restaurant->viewAttributes() ?>><?php echo $Items_delete->ID_Restaurant->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Items_delete->Nombre->Visible) { // Nombre ?>
		<td <?php echo $Items_delete->Nombre->cellAttributes() ?>>
<span id="el<?php echo $Items_delete->RowCount ?>_Items_Nombre" class="Items_Nombre">
<span<?php echo $Items_delete->Nombre->viewAttributes() ?>><?php echo $Items_delete->Nombre->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Items_delete->Precio->Visible) { // Precio ?>
		<td <?php echo $Items_delete->Precio->cellAttributes() ?>>
<span id="el<?php echo $Items_delete->RowCount ?>_Items_Precio" class="Items_Precio">
<span<?php echo $Items_delete->Precio->viewAttributes() ?>><?php echo $Items_delete->Precio->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Items_delete->Active->Visible) { // Active ?>
		<td <?php echo $Items_delete->Active->cellAttributes() ?>>
<span id="el<?php echo $Items_delete->RowCount ?>_Items_Active" class="Items_Active">
<span<?php echo $Items_delete->Active->viewAttributes() ?>><?php echo $Items_delete->Active->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Items_delete->Stock->Visible) { // Stock ?>
		<td <?php echo $Items_delete->Stock->cellAttributes() ?>>
<span id="el<?php echo $Items_delete->RowCount ?>_Items_Stock" class="Items_Stock">
<span<?php echo $Items_delete->Stock->viewAttributes() ?>><?php echo $Items_delete->Stock->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Items_delete->Img1->Visible) { // Img1 ?>
		<td <?php echo $Items_delete->Img1->cellAttributes() ?>>
<span id="el<?php echo $Items_delete->RowCount ?>_Items_Img1" class="Items_Img1">
<span><?php echo GetFileViewTag($Items_delete->Img1, $Items_delete->Img1->getViewValue(), FALSE) ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$Items_delete->Recordset->moveNext();
}
$Items_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $Items_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Items_delete->showPageFooter();
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
$Items_delete->terminate();
?>