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
$Categorias_delete = new Categorias_delete();

// Run the page
$Categorias_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Categorias_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fCategoriasdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fCategoriasdelete = currentForm = new ew.Form("fCategoriasdelete", "delete");
	loadjs.done("fCategoriasdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $Categorias_delete->showPageHeader(); ?>
<?php
$Categorias_delete->showMessage();
?>
<form name="fCategoriasdelete" id="fCategoriasdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Categorias">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Categorias_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($Categorias_delete->ID->Visible) { // ID ?>
		<th class="<?php echo $Categorias_delete->ID->headerCellClass() ?>"><span id="elh_Categorias_ID" class="Categorias_ID"><?php echo $Categorias_delete->ID->caption() ?></span></th>
<?php } ?>
<?php if ($Categorias_delete->ID_Restaurant->Visible) { // ID_Restaurant ?>
		<th class="<?php echo $Categorias_delete->ID_Restaurant->headerCellClass() ?>"><span id="elh_Categorias_ID_Restaurant" class="Categorias_ID_Restaurant"><?php echo $Categorias_delete->ID_Restaurant->caption() ?></span></th>
<?php } ?>
<?php if ($Categorias_delete->Active->Visible) { // Active ?>
		<th class="<?php echo $Categorias_delete->Active->headerCellClass() ?>"><span id="elh_Categorias_Active" class="Categorias_Active"><?php echo $Categorias_delete->Active->caption() ?></span></th>
<?php } ?>
<?php if ($Categorias_delete->Nombre->Visible) { // Nombre ?>
		<th class="<?php echo $Categorias_delete->Nombre->headerCellClass() ?>"><span id="elh_Categorias_Nombre" class="Categorias_Nombre"><?php echo $Categorias_delete->Nombre->caption() ?></span></th>
<?php } ?>
<?php if ($Categorias_delete->NombreEN->Visible) { // NombreEN ?>
		<th class="<?php echo $Categorias_delete->NombreEN->headerCellClass() ?>"><span id="elh_Categorias_NombreEN" class="Categorias_NombreEN"><?php echo $Categorias_delete->NombreEN->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$Categorias_delete->RecordCount = 0;
$i = 0;
while (!$Categorias_delete->Recordset->EOF) {
	$Categorias_delete->RecordCount++;
	$Categorias_delete->RowCount++;

	// Set row properties
	$Categorias->resetAttributes();
	$Categorias->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$Categorias_delete->loadRowValues($Categorias_delete->Recordset);

	// Render row
	$Categorias_delete->renderRow();
?>
	<tr <?php echo $Categorias->rowAttributes() ?>>
<?php if ($Categorias_delete->ID->Visible) { // ID ?>
		<td <?php echo $Categorias_delete->ID->cellAttributes() ?>>
<span id="el<?php echo $Categorias_delete->RowCount ?>_Categorias_ID" class="Categorias_ID">
<span<?php echo $Categorias_delete->ID->viewAttributes() ?>><?php echo $Categorias_delete->ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Categorias_delete->ID_Restaurant->Visible) { // ID_Restaurant ?>
		<td <?php echo $Categorias_delete->ID_Restaurant->cellAttributes() ?>>
<span id="el<?php echo $Categorias_delete->RowCount ?>_Categorias_ID_Restaurant" class="Categorias_ID_Restaurant">
<span<?php echo $Categorias_delete->ID_Restaurant->viewAttributes() ?>><?php echo $Categorias_delete->ID_Restaurant->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Categorias_delete->Active->Visible) { // Active ?>
		<td <?php echo $Categorias_delete->Active->cellAttributes() ?>>
<span id="el<?php echo $Categorias_delete->RowCount ?>_Categorias_Active" class="Categorias_Active">
<span<?php echo $Categorias_delete->Active->viewAttributes() ?>><?php echo $Categorias_delete->Active->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Categorias_delete->Nombre->Visible) { // Nombre ?>
		<td <?php echo $Categorias_delete->Nombre->cellAttributes() ?>>
<span id="el<?php echo $Categorias_delete->RowCount ?>_Categorias_Nombre" class="Categorias_Nombre">
<span<?php echo $Categorias_delete->Nombre->viewAttributes() ?>><?php echo $Categorias_delete->Nombre->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Categorias_delete->NombreEN->Visible) { // NombreEN ?>
		<td <?php echo $Categorias_delete->NombreEN->cellAttributes() ?>>
<span id="el<?php echo $Categorias_delete->RowCount ?>_Categorias_NombreEN" class="Categorias_NombreEN">
<span<?php echo $Categorias_delete->NombreEN->viewAttributes() ?>><?php echo $Categorias_delete->NombreEN->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$Categorias_delete->Recordset->moveNext();
}
$Categorias_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $Categorias_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Categorias_delete->showPageFooter();
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
$Categorias_delete->terminate();
?>