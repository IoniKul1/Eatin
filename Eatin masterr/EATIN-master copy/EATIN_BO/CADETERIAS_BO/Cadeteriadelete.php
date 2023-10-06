<?php
namespace PHPMaker2020\BACKOFFICE_CADETERIAS;

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
$Cadeteria_delete = new Cadeteria_delete();

// Run the page
$Cadeteria_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Cadeteria_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fCadeteriadelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fCadeteriadelete = currentForm = new ew.Form("fCadeteriadelete", "delete");
	loadjs.done("fCadeteriadelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $Cadeteria_delete->showPageHeader(); ?>
<?php
$Cadeteria_delete->showMessage();
?>
<form name="fCadeteriadelete" id="fCadeteriadelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Cadeteria">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Cadeteria_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($Cadeteria_delete->ID->Visible) { // ID ?>
		<th class="<?php echo $Cadeteria_delete->ID->headerCellClass() ?>"><span id="elh_Cadeteria_ID" class="Cadeteria_ID"><?php echo $Cadeteria_delete->ID->caption() ?></span></th>
<?php } ?>
<?php if ($Cadeteria_delete->ID_Status->Visible) { // ID_Status ?>
		<th class="<?php echo $Cadeteria_delete->ID_Status->headerCellClass() ?>"><span id="elh_Cadeteria_ID_Status" class="Cadeteria_ID_Status"><?php echo $Cadeteria_delete->ID_Status->caption() ?></span></th>
<?php } ?>
<?php if ($Cadeteria_delete->Nombre->Visible) { // Nombre ?>
		<th class="<?php echo $Cadeteria_delete->Nombre->headerCellClass() ?>"><span id="elh_Cadeteria_Nombre" class="Cadeteria_Nombre"><?php echo $Cadeteria_delete->Nombre->caption() ?></span></th>
<?php } ?>
<?php if ($Cadeteria_delete->Lat->Visible) { // Lat ?>
		<th class="<?php echo $Cadeteria_delete->Lat->headerCellClass() ?>"><span id="elh_Cadeteria_Lat" class="Cadeteria_Lat"><?php echo $Cadeteria_delete->Lat->caption() ?></span></th>
<?php } ?>
<?php if ($Cadeteria_delete->Lon->Visible) { // Lon ?>
		<th class="<?php echo $Cadeteria_delete->Lon->headerCellClass() ?>"><span id="elh_Cadeteria_Lon" class="Cadeteria_Lon"><?php echo $Cadeteria_delete->Lon->caption() ?></span></th>
<?php } ?>
<?php if ($Cadeteria_delete->_Email->Visible) { // Email ?>
		<th class="<?php echo $Cadeteria_delete->_Email->headerCellClass() ?>"><span id="elh_Cadeteria__Email" class="Cadeteria__Email"><?php echo $Cadeteria_delete->_Email->caption() ?></span></th>
<?php } ?>
<?php if ($Cadeteria_delete->Hashpass->Visible) { // Hashpass ?>
		<th class="<?php echo $Cadeteria_delete->Hashpass->headerCellClass() ?>"><span id="elh_Cadeteria_Hashpass" class="Cadeteria_Hashpass"><?php echo $Cadeteria_delete->Hashpass->caption() ?></span></th>
<?php } ?>
<?php if ($Cadeteria_delete->fMult1->Visible) { // fMult1 ?>
		<th class="<?php echo $Cadeteria_delete->fMult1->headerCellClass() ?>"><span id="elh_Cadeteria_fMult1" class="Cadeteria_fMult1"><?php echo $Cadeteria_delete->fMult1->caption() ?></span></th>
<?php } ?>
<?php if ($Cadeteria_delete->fMult2->Visible) { // fMult2 ?>
		<th class="<?php echo $Cadeteria_delete->fMult2->headerCellClass() ?>"><span id="elh_Cadeteria_fMult2" class="Cadeteria_fMult2"><?php echo $Cadeteria_delete->fMult2->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$Cadeteria_delete->RecordCount = 0;
$i = 0;
while (!$Cadeteria_delete->Recordset->EOF) {
	$Cadeteria_delete->RecordCount++;
	$Cadeteria_delete->RowCount++;

	// Set row properties
	$Cadeteria->resetAttributes();
	$Cadeteria->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$Cadeteria_delete->loadRowValues($Cadeteria_delete->Recordset);

	// Render row
	$Cadeteria_delete->renderRow();
?>
	<tr <?php echo $Cadeteria->rowAttributes() ?>>
<?php if ($Cadeteria_delete->ID->Visible) { // ID ?>
		<td <?php echo $Cadeteria_delete->ID->cellAttributes() ?>>
<span id="el<?php echo $Cadeteria_delete->RowCount ?>_Cadeteria_ID" class="Cadeteria_ID">
<span<?php echo $Cadeteria_delete->ID->viewAttributes() ?>><?php echo $Cadeteria_delete->ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Cadeteria_delete->ID_Status->Visible) { // ID_Status ?>
		<td <?php echo $Cadeteria_delete->ID_Status->cellAttributes() ?>>
<span id="el<?php echo $Cadeteria_delete->RowCount ?>_Cadeteria_ID_Status" class="Cadeteria_ID_Status">
<span<?php echo $Cadeteria_delete->ID_Status->viewAttributes() ?>><?php echo $Cadeteria_delete->ID_Status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Cadeteria_delete->Nombre->Visible) { // Nombre ?>
		<td <?php echo $Cadeteria_delete->Nombre->cellAttributes() ?>>
<span id="el<?php echo $Cadeteria_delete->RowCount ?>_Cadeteria_Nombre" class="Cadeteria_Nombre">
<span<?php echo $Cadeteria_delete->Nombre->viewAttributes() ?>><?php echo $Cadeteria_delete->Nombre->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Cadeteria_delete->Lat->Visible) { // Lat ?>
		<td <?php echo $Cadeteria_delete->Lat->cellAttributes() ?>>
<span id="el<?php echo $Cadeteria_delete->RowCount ?>_Cadeteria_Lat" class="Cadeteria_Lat">
<span<?php echo $Cadeteria_delete->Lat->viewAttributes() ?>><?php echo $Cadeteria_delete->Lat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Cadeteria_delete->Lon->Visible) { // Lon ?>
		<td <?php echo $Cadeteria_delete->Lon->cellAttributes() ?>>
<span id="el<?php echo $Cadeteria_delete->RowCount ?>_Cadeteria_Lon" class="Cadeteria_Lon">
<span<?php echo $Cadeteria_delete->Lon->viewAttributes() ?>><?php echo $Cadeteria_delete->Lon->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Cadeteria_delete->_Email->Visible) { // Email ?>
		<td <?php echo $Cadeteria_delete->_Email->cellAttributes() ?>>
<span id="el<?php echo $Cadeteria_delete->RowCount ?>_Cadeteria__Email" class="Cadeteria__Email">
<span<?php echo $Cadeteria_delete->_Email->viewAttributes() ?>><?php echo $Cadeteria_delete->_Email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Cadeteria_delete->Hashpass->Visible) { // Hashpass ?>
		<td <?php echo $Cadeteria_delete->Hashpass->cellAttributes() ?>>
<span id="el<?php echo $Cadeteria_delete->RowCount ?>_Cadeteria_Hashpass" class="Cadeteria_Hashpass">
<span<?php echo $Cadeteria_delete->Hashpass->viewAttributes() ?>><?php echo $Cadeteria_delete->Hashpass->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Cadeteria_delete->fMult1->Visible) { // fMult1 ?>
		<td <?php echo $Cadeteria_delete->fMult1->cellAttributes() ?>>
<span id="el<?php echo $Cadeteria_delete->RowCount ?>_Cadeteria_fMult1" class="Cadeteria_fMult1">
<span<?php echo $Cadeteria_delete->fMult1->viewAttributes() ?>><?php echo $Cadeteria_delete->fMult1->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Cadeteria_delete->fMult2->Visible) { // fMult2 ?>
		<td <?php echo $Cadeteria_delete->fMult2->cellAttributes() ?>>
<span id="el<?php echo $Cadeteria_delete->RowCount ?>_Cadeteria_fMult2" class="Cadeteria_fMult2">
<span<?php echo $Cadeteria_delete->fMult2->viewAttributes() ?>><?php echo $Cadeteria_delete->fMult2->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$Cadeteria_delete->Recordset->moveNext();
}
$Cadeteria_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $Cadeteria_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Cadeteria_delete->showPageFooter();
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
$Cadeteria_delete->terminate();
?>