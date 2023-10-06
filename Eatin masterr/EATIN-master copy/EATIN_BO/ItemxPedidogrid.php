<?php
namespace PHPMaker2020\EATIN_BO;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($ItemxPedido_grid))
	$ItemxPedido_grid = new ItemxPedido_grid();

// Run the page
$ItemxPedido_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ItemxPedido_grid->Page_Render();
?>
<?php if (!$ItemxPedido_grid->isExport()) { ?>
<script>
var fItemxPedidogrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fItemxPedidogrid = new ew.Form("fItemxPedidogrid", "grid");
	fItemxPedidogrid.formKeyCountName = '<?php echo $ItemxPedido_grid->FormKeyCountName ?>';

	// Validate form
	fItemxPedidogrid.validate = function() {
		if (!this.validateRequired)
			return true; // Ignore validation
		var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
		if ($fobj.find("#confirm").val() == "confirm")
			return true;
		var elm, felm, uelm, addcnt = 0;
		var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
		var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
		var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
		var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
		for (var i = startcnt; i <= rowcnt; i++) {
			var infix = ($k[0]) ? String(i) : "";
			$fobj.data("rowindex", infix);
			var checkrow = (gridinsert) ? !this.emptyRow(infix) : true;
			if (checkrow) {
				addcnt++;
			<?php if ($ItemxPedido_grid->ID->Required) { ?>
				elm = this.getElements("x" + infix + "_ID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ItemxPedido_grid->ID->caption(), $ItemxPedido_grid->ID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ItemxPedido_grid->ID_Item->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_Item");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ItemxPedido_grid->ID_Item->caption(), $ItemxPedido_grid->ID_Item->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ItemxPedido_grid->ID_Restaurant->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_Restaurant");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ItemxPedido_grid->ID_Restaurant->caption(), $ItemxPedido_grid->ID_Restaurant->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ItemxPedido_grid->ID_Client->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_Client");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ItemxPedido_grid->ID_Client->caption(), $ItemxPedido_grid->ID_Client->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ItemxPedido_grid->DateCreation->Required) { ?>
				elm = this.getElements("x" + infix + "_DateCreation");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ItemxPedido_grid->DateCreation->caption(), $ItemxPedido_grid->DateCreation->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateCreation");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ItemxPedido_grid->DateCreation->errorMessage()) ?>");
			<?php if ($ItemxPedido_grid->DateLastUpdate->Required) { ?>
				elm = this.getElements("x" + infix + "_DateLastUpdate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ItemxPedido_grid->DateLastUpdate->caption(), $ItemxPedido_grid->DateLastUpdate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateLastUpdate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ItemxPedido_grid->DateLastUpdate->errorMessage()) ?>");
			<?php if ($ItemxPedido_grid->Comments->Required) { ?>
				elm = this.getElements("x" + infix + "_Comments");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ItemxPedido_grid->Comments->caption(), $ItemxPedido_grid->Comments->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ItemxPedido_grid->ID_Pedido->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_Pedido");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ItemxPedido_grid->ID_Pedido->caption(), $ItemxPedido_grid->ID_Pedido->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ID_Pedido");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ItemxPedido_grid->ID_Pedido->errorMessage()) ?>");
			<?php if ($ItemxPedido_grid->Compartir->Required) { ?>
				elm = this.getElements("x" + infix + "_Compartir");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ItemxPedido_grid->Compartir->caption(), $ItemxPedido_grid->Compartir->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ItemxPedido_grid->Cantidad->Required) { ?>
				elm = this.getElements("x" + infix + "_Cantidad");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ItemxPedido_grid->Cantidad->caption(), $ItemxPedido_grid->Cantidad->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Cantidad");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ItemxPedido_grid->Cantidad->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fItemxPedidogrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "ID_Item", false)) return false;
		if (ew.valueChanged(fobj, infix, "ID_Restaurant", false)) return false;
		if (ew.valueChanged(fobj, infix, "ID_Client", false)) return false;
		if (ew.valueChanged(fobj, infix, "DateCreation", false)) return false;
		if (ew.valueChanged(fobj, infix, "DateLastUpdate", false)) return false;
		if (ew.valueChanged(fobj, infix, "Comments", false)) return false;
		if (ew.valueChanged(fobj, infix, "ID_Pedido", false)) return false;
		if (ew.valueChanged(fobj, infix, "Compartir", false)) return false;
		if (ew.valueChanged(fobj, infix, "Cantidad", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fItemxPedidogrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fItemxPedidogrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fItemxPedidogrid.lists["x_ID_Item"] = <?php echo $ItemxPedido_grid->ID_Item->Lookup->toClientList($ItemxPedido_grid) ?>;
	fItemxPedidogrid.lists["x_ID_Item"].options = <?php echo JsonEncode($ItemxPedido_grid->ID_Item->lookupOptions()) ?>;
	fItemxPedidogrid.lists["x_ID_Restaurant"] = <?php echo $ItemxPedido_grid->ID_Restaurant->Lookup->toClientList($ItemxPedido_grid) ?>;
	fItemxPedidogrid.lists["x_ID_Restaurant"].options = <?php echo JsonEncode($ItemxPedido_grid->ID_Restaurant->lookupOptions()) ?>;
	fItemxPedidogrid.lists["x_ID_Client"] = <?php echo $ItemxPedido_grid->ID_Client->Lookup->toClientList($ItemxPedido_grid) ?>;
	fItemxPedidogrid.lists["x_ID_Client"].options = <?php echo JsonEncode($ItemxPedido_grid->ID_Client->lookupOptions()) ?>;
	fItemxPedidogrid.lists["x_Compartir"] = <?php echo $ItemxPedido_grid->Compartir->Lookup->toClientList($ItemxPedido_grid) ?>;
	fItemxPedidogrid.lists["x_Compartir"].options = <?php echo JsonEncode($ItemxPedido_grid->Compartir->options(FALSE, TRUE)) ?>;
	loadjs.done("fItemxPedidogrid");
});
</script>
<?php } ?>
<?php
$ItemxPedido_grid->renderOtherOptions();
?>
<?php if ($ItemxPedido_grid->TotalRecords > 0 || $ItemxPedido->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($ItemxPedido_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> ItemxPedido">
<?php if ($ItemxPedido_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $ItemxPedido_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fItemxPedidogrid" class="ew-form ew-list-form form-inline">
<div id="gmp_ItemxPedido" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_ItemxPedidogrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$ItemxPedido->RowType = ROWTYPE_HEADER;

// Render list options
$ItemxPedido_grid->renderListOptions();

// Render list options (header, left)
$ItemxPedido_grid->ListOptions->render("header", "left");
?>
<?php if ($ItemxPedido_grid->ID->Visible) { // ID ?>
	<?php if ($ItemxPedido_grid->SortUrl($ItemxPedido_grid->ID) == "") { ?>
		<th data-name="ID" class="<?php echo $ItemxPedido_grid->ID->headerCellClass() ?>"><div id="elh_ItemxPedido_ID" class="ItemxPedido_ID"><div class="ew-table-header-caption"><?php echo $ItemxPedido_grid->ID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID" class="<?php echo $ItemxPedido_grid->ID->headerCellClass() ?>"><div><div id="elh_ItemxPedido_ID" class="ItemxPedido_ID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ItemxPedido_grid->ID->caption() ?></span><span class="ew-table-header-sort"><?php if ($ItemxPedido_grid->ID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ItemxPedido_grid->ID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ItemxPedido_grid->ID_Item->Visible) { // ID_Item ?>
	<?php if ($ItemxPedido_grid->SortUrl($ItemxPedido_grid->ID_Item) == "") { ?>
		<th data-name="ID_Item" class="<?php echo $ItemxPedido_grid->ID_Item->headerCellClass() ?>"><div id="elh_ItemxPedido_ID_Item" class="ItemxPedido_ID_Item"><div class="ew-table-header-caption"><?php echo $ItemxPedido_grid->ID_Item->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Item" class="<?php echo $ItemxPedido_grid->ID_Item->headerCellClass() ?>"><div><div id="elh_ItemxPedido_ID_Item" class="ItemxPedido_ID_Item">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ItemxPedido_grid->ID_Item->caption() ?></span><span class="ew-table-header-sort"><?php if ($ItemxPedido_grid->ID_Item->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ItemxPedido_grid->ID_Item->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ItemxPedido_grid->ID_Restaurant->Visible) { // ID_Restaurant ?>
	<?php if ($ItemxPedido_grid->SortUrl($ItemxPedido_grid->ID_Restaurant) == "") { ?>
		<th data-name="ID_Restaurant" class="<?php echo $ItemxPedido_grid->ID_Restaurant->headerCellClass() ?>"><div id="elh_ItemxPedido_ID_Restaurant" class="ItemxPedido_ID_Restaurant"><div class="ew-table-header-caption"><?php echo $ItemxPedido_grid->ID_Restaurant->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Restaurant" class="<?php echo $ItemxPedido_grid->ID_Restaurant->headerCellClass() ?>"><div><div id="elh_ItemxPedido_ID_Restaurant" class="ItemxPedido_ID_Restaurant">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ItemxPedido_grid->ID_Restaurant->caption() ?></span><span class="ew-table-header-sort"><?php if ($ItemxPedido_grid->ID_Restaurant->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ItemxPedido_grid->ID_Restaurant->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ItemxPedido_grid->ID_Client->Visible) { // ID_Client ?>
	<?php if ($ItemxPedido_grid->SortUrl($ItemxPedido_grid->ID_Client) == "") { ?>
		<th data-name="ID_Client" class="<?php echo $ItemxPedido_grid->ID_Client->headerCellClass() ?>"><div id="elh_ItemxPedido_ID_Client" class="ItemxPedido_ID_Client"><div class="ew-table-header-caption"><?php echo $ItemxPedido_grid->ID_Client->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Client" class="<?php echo $ItemxPedido_grid->ID_Client->headerCellClass() ?>"><div><div id="elh_ItemxPedido_ID_Client" class="ItemxPedido_ID_Client">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ItemxPedido_grid->ID_Client->caption() ?></span><span class="ew-table-header-sort"><?php if ($ItemxPedido_grid->ID_Client->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ItemxPedido_grid->ID_Client->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ItemxPedido_grid->DateCreation->Visible) { // DateCreation ?>
	<?php if ($ItemxPedido_grid->SortUrl($ItemxPedido_grid->DateCreation) == "") { ?>
		<th data-name="DateCreation" class="<?php echo $ItemxPedido_grid->DateCreation->headerCellClass() ?>"><div id="elh_ItemxPedido_DateCreation" class="ItemxPedido_DateCreation"><div class="ew-table-header-caption"><?php echo $ItemxPedido_grid->DateCreation->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateCreation" class="<?php echo $ItemxPedido_grid->DateCreation->headerCellClass() ?>"><div><div id="elh_ItemxPedido_DateCreation" class="ItemxPedido_DateCreation">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ItemxPedido_grid->DateCreation->caption() ?></span><span class="ew-table-header-sort"><?php if ($ItemxPedido_grid->DateCreation->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ItemxPedido_grid->DateCreation->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ItemxPedido_grid->DateLastUpdate->Visible) { // DateLastUpdate ?>
	<?php if ($ItemxPedido_grid->SortUrl($ItemxPedido_grid->DateLastUpdate) == "") { ?>
		<th data-name="DateLastUpdate" class="<?php echo $ItemxPedido_grid->DateLastUpdate->headerCellClass() ?>"><div id="elh_ItemxPedido_DateLastUpdate" class="ItemxPedido_DateLastUpdate"><div class="ew-table-header-caption"><?php echo $ItemxPedido_grid->DateLastUpdate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateLastUpdate" class="<?php echo $ItemxPedido_grid->DateLastUpdate->headerCellClass() ?>"><div><div id="elh_ItemxPedido_DateLastUpdate" class="ItemxPedido_DateLastUpdate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ItemxPedido_grid->DateLastUpdate->caption() ?></span><span class="ew-table-header-sort"><?php if ($ItemxPedido_grid->DateLastUpdate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ItemxPedido_grid->DateLastUpdate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ItemxPedido_grid->Comments->Visible) { // Comments ?>
	<?php if ($ItemxPedido_grid->SortUrl($ItemxPedido_grid->Comments) == "") { ?>
		<th data-name="Comments" class="<?php echo $ItemxPedido_grid->Comments->headerCellClass() ?>"><div id="elh_ItemxPedido_Comments" class="ItemxPedido_Comments"><div class="ew-table-header-caption"><?php echo $ItemxPedido_grid->Comments->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Comments" class="<?php echo $ItemxPedido_grid->Comments->headerCellClass() ?>"><div><div id="elh_ItemxPedido_Comments" class="ItemxPedido_Comments">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ItemxPedido_grid->Comments->caption() ?></span><span class="ew-table-header-sort"><?php if ($ItemxPedido_grid->Comments->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ItemxPedido_grid->Comments->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ItemxPedido_grid->ID_Pedido->Visible) { // ID_Pedido ?>
	<?php if ($ItemxPedido_grid->SortUrl($ItemxPedido_grid->ID_Pedido) == "") { ?>
		<th data-name="ID_Pedido" class="<?php echo $ItemxPedido_grid->ID_Pedido->headerCellClass() ?>"><div id="elh_ItemxPedido_ID_Pedido" class="ItemxPedido_ID_Pedido"><div class="ew-table-header-caption"><?php echo $ItemxPedido_grid->ID_Pedido->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Pedido" class="<?php echo $ItemxPedido_grid->ID_Pedido->headerCellClass() ?>"><div><div id="elh_ItemxPedido_ID_Pedido" class="ItemxPedido_ID_Pedido">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ItemxPedido_grid->ID_Pedido->caption() ?></span><span class="ew-table-header-sort"><?php if ($ItemxPedido_grid->ID_Pedido->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ItemxPedido_grid->ID_Pedido->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ItemxPedido_grid->Compartir->Visible) { // Compartir ?>
	<?php if ($ItemxPedido_grid->SortUrl($ItemxPedido_grid->Compartir) == "") { ?>
		<th data-name="Compartir" class="<?php echo $ItemxPedido_grid->Compartir->headerCellClass() ?>"><div id="elh_ItemxPedido_Compartir" class="ItemxPedido_Compartir"><div class="ew-table-header-caption"><?php echo $ItemxPedido_grid->Compartir->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Compartir" class="<?php echo $ItemxPedido_grid->Compartir->headerCellClass() ?>"><div><div id="elh_ItemxPedido_Compartir" class="ItemxPedido_Compartir">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ItemxPedido_grid->Compartir->caption() ?></span><span class="ew-table-header-sort"><?php if ($ItemxPedido_grid->Compartir->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ItemxPedido_grid->Compartir->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ItemxPedido_grid->Cantidad->Visible) { // Cantidad ?>
	<?php if ($ItemxPedido_grid->SortUrl($ItemxPedido_grid->Cantidad) == "") { ?>
		<th data-name="Cantidad" class="<?php echo $ItemxPedido_grid->Cantidad->headerCellClass() ?>"><div id="elh_ItemxPedido_Cantidad" class="ItemxPedido_Cantidad"><div class="ew-table-header-caption"><?php echo $ItemxPedido_grid->Cantidad->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Cantidad" class="<?php echo $ItemxPedido_grid->Cantidad->headerCellClass() ?>"><div><div id="elh_ItemxPedido_Cantidad" class="ItemxPedido_Cantidad">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ItemxPedido_grid->Cantidad->caption() ?></span><span class="ew-table-header-sort"><?php if ($ItemxPedido_grid->Cantidad->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ItemxPedido_grid->Cantidad->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$ItemxPedido_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$ItemxPedido_grid->StartRecord = 1;
$ItemxPedido_grid->StopRecord = $ItemxPedido_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($ItemxPedido->isConfirm() || $ItemxPedido_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($ItemxPedido_grid->FormKeyCountName) && ($ItemxPedido_grid->isGridAdd() || $ItemxPedido_grid->isGridEdit() || $ItemxPedido->isConfirm())) {
		$ItemxPedido_grid->KeyCount = $CurrentForm->getValue($ItemxPedido_grid->FormKeyCountName);
		$ItemxPedido_grid->StopRecord = $ItemxPedido_grid->StartRecord + $ItemxPedido_grid->KeyCount - 1;
	}
}
$ItemxPedido_grid->RecordCount = $ItemxPedido_grid->StartRecord - 1;
if ($ItemxPedido_grid->Recordset && !$ItemxPedido_grid->Recordset->EOF) {
	$ItemxPedido_grid->Recordset->moveFirst();
	$selectLimit = $ItemxPedido_grid->UseSelectLimit;
	if (!$selectLimit && $ItemxPedido_grid->StartRecord > 1)
		$ItemxPedido_grid->Recordset->move($ItemxPedido_grid->StartRecord - 1);
} elseif (!$ItemxPedido->AllowAddDeleteRow && $ItemxPedido_grid->StopRecord == 0) {
	$ItemxPedido_grid->StopRecord = $ItemxPedido->GridAddRowCount;
}

// Initialize aggregate
$ItemxPedido->RowType = ROWTYPE_AGGREGATEINIT;
$ItemxPedido->resetAttributes();
$ItemxPedido_grid->renderRow();
if ($ItemxPedido_grid->isGridAdd())
	$ItemxPedido_grid->RowIndex = 0;
if ($ItemxPedido_grid->isGridEdit())
	$ItemxPedido_grid->RowIndex = 0;
while ($ItemxPedido_grid->RecordCount < $ItemxPedido_grid->StopRecord) {
	$ItemxPedido_grid->RecordCount++;
	if ($ItemxPedido_grid->RecordCount >= $ItemxPedido_grid->StartRecord) {
		$ItemxPedido_grid->RowCount++;
		if ($ItemxPedido_grid->isGridAdd() || $ItemxPedido_grid->isGridEdit() || $ItemxPedido->isConfirm()) {
			$ItemxPedido_grid->RowIndex++;
			$CurrentForm->Index = $ItemxPedido_grid->RowIndex;
			if ($CurrentForm->hasValue($ItemxPedido_grid->FormActionName) && ($ItemxPedido->isConfirm() || $ItemxPedido_grid->EventCancelled))
				$ItemxPedido_grid->RowAction = strval($CurrentForm->getValue($ItemxPedido_grid->FormActionName));
			elseif ($ItemxPedido_grid->isGridAdd())
				$ItemxPedido_grid->RowAction = "insert";
			else
				$ItemxPedido_grid->RowAction = "";
		}

		// Set up key count
		$ItemxPedido_grid->KeyCount = $ItemxPedido_grid->RowIndex;

		// Init row class and style
		$ItemxPedido->resetAttributes();
		$ItemxPedido->CssClass = "";
		if ($ItemxPedido_grid->isGridAdd()) {
			if ($ItemxPedido->CurrentMode == "copy") {
				$ItemxPedido_grid->loadRowValues($ItemxPedido_grid->Recordset); // Load row values
				$ItemxPedido_grid->setRecordKey($ItemxPedido_grid->RowOldKey, $ItemxPedido_grid->Recordset); // Set old record key
			} else {
				$ItemxPedido_grid->loadRowValues(); // Load default values
				$ItemxPedido_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$ItemxPedido_grid->loadRowValues($ItemxPedido_grid->Recordset); // Load row values
		}
		$ItemxPedido->RowType = ROWTYPE_VIEW; // Render view
		if ($ItemxPedido_grid->isGridAdd()) // Grid add
			$ItemxPedido->RowType = ROWTYPE_ADD; // Render add
		if ($ItemxPedido_grid->isGridAdd() && $ItemxPedido->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$ItemxPedido_grid->restoreCurrentRowFormValues($ItemxPedido_grid->RowIndex); // Restore form values
		if ($ItemxPedido_grid->isGridEdit()) { // Grid edit
			if ($ItemxPedido->EventCancelled)
				$ItemxPedido_grid->restoreCurrentRowFormValues($ItemxPedido_grid->RowIndex); // Restore form values
			if ($ItemxPedido_grid->RowAction == "insert")
				$ItemxPedido->RowType = ROWTYPE_ADD; // Render add
			else
				$ItemxPedido->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($ItemxPedido_grid->isGridEdit() && ($ItemxPedido->RowType == ROWTYPE_EDIT || $ItemxPedido->RowType == ROWTYPE_ADD) && $ItemxPedido->EventCancelled) // Update failed
			$ItemxPedido_grid->restoreCurrentRowFormValues($ItemxPedido_grid->RowIndex); // Restore form values
		if ($ItemxPedido->RowType == ROWTYPE_EDIT) // Edit row
			$ItemxPedido_grid->EditRowCount++;
		if ($ItemxPedido->isConfirm()) // Confirm row
			$ItemxPedido_grid->restoreCurrentRowFormValues($ItemxPedido_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$ItemxPedido->RowAttrs->merge(["data-rowindex" => $ItemxPedido_grid->RowCount, "id" => "r" . $ItemxPedido_grid->RowCount . "_ItemxPedido", "data-rowtype" => $ItemxPedido->RowType]);

		// Render row
		$ItemxPedido_grid->renderRow();

		// Render list options
		$ItemxPedido_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($ItemxPedido_grid->RowAction != "delete" && $ItemxPedido_grid->RowAction != "insertdelete" && !($ItemxPedido_grid->RowAction == "insert" && $ItemxPedido->isConfirm() && $ItemxPedido_grid->emptyRow())) {
?>
	<tr <?php echo $ItemxPedido->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ItemxPedido_grid->ListOptions->render("body", "left", $ItemxPedido_grid->RowCount);
?>
	<?php if ($ItemxPedido_grid->ID->Visible) { // ID ?>
		<td data-name="ID" <?php echo $ItemxPedido_grid->ID->cellAttributes() ?>>
<?php if ($ItemxPedido->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ItemxPedido_grid->RowCount ?>_ItemxPedido_ID" class="form-group"></span>
<input type="hidden" data-table="ItemxPedido" data-field="x_ID" name="o<?php echo $ItemxPedido_grid->RowIndex ?>_ID" id="o<?php echo $ItemxPedido_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($ItemxPedido_grid->ID->OldValue) ?>">
<?php } ?>
<?php if ($ItemxPedido->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ItemxPedido_grid->RowCount ?>_ItemxPedido_ID" class="form-group">
<span<?php echo $ItemxPedido_grid->ID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ItemxPedido_grid->ID->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="ItemxPedido" data-field="x_ID" name="x<?php echo $ItemxPedido_grid->RowIndex ?>_ID" id="x<?php echo $ItemxPedido_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($ItemxPedido_grid->ID->CurrentValue) ?>">
<?php } ?>
<?php if ($ItemxPedido->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ItemxPedido_grid->RowCount ?>_ItemxPedido_ID">
<span<?php echo $ItemxPedido_grid->ID->viewAttributes() ?>><?php echo $ItemxPedido_grid->ID->getViewValue() ?></span>
</span>
<?php if (!$ItemxPedido->isConfirm()) { ?>
<input type="hidden" data-table="ItemxPedido" data-field="x_ID" name="x<?php echo $ItemxPedido_grid->RowIndex ?>_ID" id="x<?php echo $ItemxPedido_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($ItemxPedido_grid->ID->FormValue) ?>">
<input type="hidden" data-table="ItemxPedido" data-field="x_ID" name="o<?php echo $ItemxPedido_grid->RowIndex ?>_ID" id="o<?php echo $ItemxPedido_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($ItemxPedido_grid->ID->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ItemxPedido" data-field="x_ID" name="fItemxPedidogrid$x<?php echo $ItemxPedido_grid->RowIndex ?>_ID" id="fItemxPedidogrid$x<?php echo $ItemxPedido_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($ItemxPedido_grid->ID->FormValue) ?>">
<input type="hidden" data-table="ItemxPedido" data-field="x_ID" name="fItemxPedidogrid$o<?php echo $ItemxPedido_grid->RowIndex ?>_ID" id="fItemxPedidogrid$o<?php echo $ItemxPedido_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($ItemxPedido_grid->ID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ItemxPedido_grid->ID_Item->Visible) { // ID_Item ?>
		<td data-name="ID_Item" <?php echo $ItemxPedido_grid->ID_Item->cellAttributes() ?>>
<?php if ($ItemxPedido->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ItemxPedido_grid->RowCount ?>_ItemxPedido_ID_Item" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ItemxPedido" data-field="x_ID_Item" data-value-separator="<?php echo $ItemxPedido_grid->ID_Item->displayValueSeparatorAttribute() ?>" id="x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Item" name="x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Item"<?php echo $ItemxPedido_grid->ID_Item->editAttributes() ?>>
			<?php echo $ItemxPedido_grid->ID_Item->selectOptionListHtml("x{$ItemxPedido_grid->RowIndex}_ID_Item") ?>
		</select>
</div>
<?php echo $ItemxPedido_grid->ID_Item->Lookup->getParamTag($ItemxPedido_grid, "p_x" . $ItemxPedido_grid->RowIndex . "_ID_Item") ?>
</span>
<input type="hidden" data-table="ItemxPedido" data-field="x_ID_Item" name="o<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Item" id="o<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Item" value="<?php echo HtmlEncode($ItemxPedido_grid->ID_Item->OldValue) ?>">
<?php } ?>
<?php if ($ItemxPedido->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ItemxPedido_grid->RowCount ?>_ItemxPedido_ID_Item" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ItemxPedido" data-field="x_ID_Item" data-value-separator="<?php echo $ItemxPedido_grid->ID_Item->displayValueSeparatorAttribute() ?>" id="x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Item" name="x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Item"<?php echo $ItemxPedido_grid->ID_Item->editAttributes() ?>>
			<?php echo $ItemxPedido_grid->ID_Item->selectOptionListHtml("x{$ItemxPedido_grid->RowIndex}_ID_Item") ?>
		</select>
</div>
<?php echo $ItemxPedido_grid->ID_Item->Lookup->getParamTag($ItemxPedido_grid, "p_x" . $ItemxPedido_grid->RowIndex . "_ID_Item") ?>
</span>
<?php } ?>
<?php if ($ItemxPedido->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ItemxPedido_grid->RowCount ?>_ItemxPedido_ID_Item">
<span<?php echo $ItemxPedido_grid->ID_Item->viewAttributes() ?>><?php echo $ItemxPedido_grid->ID_Item->getViewValue() ?></span>
</span>
<?php if (!$ItemxPedido->isConfirm()) { ?>
<input type="hidden" data-table="ItemxPedido" data-field="x_ID_Item" name="x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Item" id="x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Item" value="<?php echo HtmlEncode($ItemxPedido_grid->ID_Item->FormValue) ?>">
<input type="hidden" data-table="ItemxPedido" data-field="x_ID_Item" name="o<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Item" id="o<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Item" value="<?php echo HtmlEncode($ItemxPedido_grid->ID_Item->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ItemxPedido" data-field="x_ID_Item" name="fItemxPedidogrid$x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Item" id="fItemxPedidogrid$x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Item" value="<?php echo HtmlEncode($ItemxPedido_grid->ID_Item->FormValue) ?>">
<input type="hidden" data-table="ItemxPedido" data-field="x_ID_Item" name="fItemxPedidogrid$o<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Item" id="fItemxPedidogrid$o<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Item" value="<?php echo HtmlEncode($ItemxPedido_grid->ID_Item->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ItemxPedido_grid->ID_Restaurant->Visible) { // ID_Restaurant ?>
		<td data-name="ID_Restaurant" <?php echo $ItemxPedido_grid->ID_Restaurant->cellAttributes() ?>>
<?php if ($ItemxPedido->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn() && !$ItemxPedido->userIDAllow("grid")) { // Non system admin ?>
<span id="el<?php echo $ItemxPedido_grid->RowCount ?>_ItemxPedido_ID_Restaurant" class="form-group">
<span<?php echo $ItemxPedido_grid->ID_Restaurant->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ItemxPedido_grid->ID_Restaurant->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="ItemxPedido" data-field="x_ID_Restaurant" name="x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Restaurant" id="x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($ItemxPedido_grid->ID_Restaurant->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $ItemxPedido_grid->RowCount ?>_ItemxPedido_ID_Restaurant" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ItemxPedido" data-field="x_ID_Restaurant" data-value-separator="<?php echo $ItemxPedido_grid->ID_Restaurant->displayValueSeparatorAttribute() ?>" id="x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Restaurant" name="x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Restaurant"<?php echo $ItemxPedido_grid->ID_Restaurant->editAttributes() ?>>
			<?php echo $ItemxPedido_grid->ID_Restaurant->selectOptionListHtml("x{$ItemxPedido_grid->RowIndex}_ID_Restaurant") ?>
		</select>
</div>
<?php echo $ItemxPedido_grid->ID_Restaurant->Lookup->getParamTag($ItemxPedido_grid, "p_x" . $ItemxPedido_grid->RowIndex . "_ID_Restaurant") ?>
</span>
<?php } ?>
<input type="hidden" data-table="ItemxPedido" data-field="x_ID_Restaurant" name="o<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Restaurant" id="o<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($ItemxPedido_grid->ID_Restaurant->OldValue) ?>">
<?php } ?>
<?php if ($ItemxPedido->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn() && !$ItemxPedido->userIDAllow("grid")) { // Non system admin ?>
<span id="el<?php echo $ItemxPedido_grid->RowCount ?>_ItemxPedido_ID_Restaurant" class="form-group">
<span<?php echo $ItemxPedido_grid->ID_Restaurant->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ItemxPedido_grid->ID_Restaurant->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="ItemxPedido" data-field="x_ID_Restaurant" name="x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Restaurant" id="x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($ItemxPedido_grid->ID_Restaurant->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $ItemxPedido_grid->RowCount ?>_ItemxPedido_ID_Restaurant" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ItemxPedido" data-field="x_ID_Restaurant" data-value-separator="<?php echo $ItemxPedido_grid->ID_Restaurant->displayValueSeparatorAttribute() ?>" id="x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Restaurant" name="x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Restaurant"<?php echo $ItemxPedido_grid->ID_Restaurant->editAttributes() ?>>
			<?php echo $ItemxPedido_grid->ID_Restaurant->selectOptionListHtml("x{$ItemxPedido_grid->RowIndex}_ID_Restaurant") ?>
		</select>
</div>
<?php echo $ItemxPedido_grid->ID_Restaurant->Lookup->getParamTag($ItemxPedido_grid, "p_x" . $ItemxPedido_grid->RowIndex . "_ID_Restaurant") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($ItemxPedido->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ItemxPedido_grid->RowCount ?>_ItemxPedido_ID_Restaurant">
<span<?php echo $ItemxPedido_grid->ID_Restaurant->viewAttributes() ?>><?php echo $ItemxPedido_grid->ID_Restaurant->getViewValue() ?></span>
</span>
<?php if (!$ItemxPedido->isConfirm()) { ?>
<input type="hidden" data-table="ItemxPedido" data-field="x_ID_Restaurant" name="x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Restaurant" id="x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($ItemxPedido_grid->ID_Restaurant->FormValue) ?>">
<input type="hidden" data-table="ItemxPedido" data-field="x_ID_Restaurant" name="o<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Restaurant" id="o<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($ItemxPedido_grid->ID_Restaurant->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ItemxPedido" data-field="x_ID_Restaurant" name="fItemxPedidogrid$x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Restaurant" id="fItemxPedidogrid$x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($ItemxPedido_grid->ID_Restaurant->FormValue) ?>">
<input type="hidden" data-table="ItemxPedido" data-field="x_ID_Restaurant" name="fItemxPedidogrid$o<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Restaurant" id="fItemxPedidogrid$o<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($ItemxPedido_grid->ID_Restaurant->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ItemxPedido_grid->ID_Client->Visible) { // ID_Client ?>
		<td data-name="ID_Client" <?php echo $ItemxPedido_grid->ID_Client->cellAttributes() ?>>
<?php if ($ItemxPedido->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ItemxPedido_grid->RowCount ?>_ItemxPedido_ID_Client" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ItemxPedido" data-field="x_ID_Client" data-value-separator="<?php echo $ItemxPedido_grid->ID_Client->displayValueSeparatorAttribute() ?>" id="x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Client" name="x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Client"<?php echo $ItemxPedido_grid->ID_Client->editAttributes() ?>>
			<?php echo $ItemxPedido_grid->ID_Client->selectOptionListHtml("x{$ItemxPedido_grid->RowIndex}_ID_Client") ?>
		</select>
</div>
<?php echo $ItemxPedido_grid->ID_Client->Lookup->getParamTag($ItemxPedido_grid, "p_x" . $ItemxPedido_grid->RowIndex . "_ID_Client") ?>
</span>
<input type="hidden" data-table="ItemxPedido" data-field="x_ID_Client" name="o<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Client" id="o<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Client" value="<?php echo HtmlEncode($ItemxPedido_grid->ID_Client->OldValue) ?>">
<?php } ?>
<?php if ($ItemxPedido->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ItemxPedido_grid->RowCount ?>_ItemxPedido_ID_Client" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ItemxPedido" data-field="x_ID_Client" data-value-separator="<?php echo $ItemxPedido_grid->ID_Client->displayValueSeparatorAttribute() ?>" id="x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Client" name="x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Client"<?php echo $ItemxPedido_grid->ID_Client->editAttributes() ?>>
			<?php echo $ItemxPedido_grid->ID_Client->selectOptionListHtml("x{$ItemxPedido_grid->RowIndex}_ID_Client") ?>
		</select>
</div>
<?php echo $ItemxPedido_grid->ID_Client->Lookup->getParamTag($ItemxPedido_grid, "p_x" . $ItemxPedido_grid->RowIndex . "_ID_Client") ?>
</span>
<?php } ?>
<?php if ($ItemxPedido->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ItemxPedido_grid->RowCount ?>_ItemxPedido_ID_Client">
<span<?php echo $ItemxPedido_grid->ID_Client->viewAttributes() ?>><?php echo $ItemxPedido_grid->ID_Client->getViewValue() ?></span>
</span>
<?php if (!$ItemxPedido->isConfirm()) { ?>
<input type="hidden" data-table="ItemxPedido" data-field="x_ID_Client" name="x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Client" id="x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Client" value="<?php echo HtmlEncode($ItemxPedido_grid->ID_Client->FormValue) ?>">
<input type="hidden" data-table="ItemxPedido" data-field="x_ID_Client" name="o<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Client" id="o<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Client" value="<?php echo HtmlEncode($ItemxPedido_grid->ID_Client->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ItemxPedido" data-field="x_ID_Client" name="fItemxPedidogrid$x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Client" id="fItemxPedidogrid$x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Client" value="<?php echo HtmlEncode($ItemxPedido_grid->ID_Client->FormValue) ?>">
<input type="hidden" data-table="ItemxPedido" data-field="x_ID_Client" name="fItemxPedidogrid$o<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Client" id="fItemxPedidogrid$o<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Client" value="<?php echo HtmlEncode($ItemxPedido_grid->ID_Client->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ItemxPedido_grid->DateCreation->Visible) { // DateCreation ?>
		<td data-name="DateCreation" <?php echo $ItemxPedido_grid->DateCreation->cellAttributes() ?>>
<?php if ($ItemxPedido->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ItemxPedido_grid->RowCount ?>_ItemxPedido_DateCreation" class="form-group">
<input type="text" data-table="ItemxPedido" data-field="x_DateCreation" name="x<?php echo $ItemxPedido_grid->RowIndex ?>_DateCreation" id="x<?php echo $ItemxPedido_grid->RowIndex ?>_DateCreation" maxlength="8" placeholder="<?php echo HtmlEncode($ItemxPedido_grid->DateCreation->getPlaceHolder()) ?>" value="<?php echo $ItemxPedido_grid->DateCreation->EditValue ?>"<?php echo $ItemxPedido_grid->DateCreation->editAttributes() ?>>
<?php if (!$ItemxPedido_grid->DateCreation->ReadOnly && !$ItemxPedido_grid->DateCreation->Disabled && !isset($ItemxPedido_grid->DateCreation->EditAttrs["readonly"]) && !isset($ItemxPedido_grid->DateCreation->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fItemxPedidogrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fItemxPedidogrid", "x<?php echo $ItemxPedido_grid->RowIndex ?>_DateCreation", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="ItemxPedido" data-field="x_DateCreation" name="o<?php echo $ItemxPedido_grid->RowIndex ?>_DateCreation" id="o<?php echo $ItemxPedido_grid->RowIndex ?>_DateCreation" value="<?php echo HtmlEncode($ItemxPedido_grid->DateCreation->OldValue) ?>">
<?php } ?>
<?php if ($ItemxPedido->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ItemxPedido_grid->RowCount ?>_ItemxPedido_DateCreation" class="form-group">
<input type="text" data-table="ItemxPedido" data-field="x_DateCreation" name="x<?php echo $ItemxPedido_grid->RowIndex ?>_DateCreation" id="x<?php echo $ItemxPedido_grid->RowIndex ?>_DateCreation" maxlength="8" placeholder="<?php echo HtmlEncode($ItemxPedido_grid->DateCreation->getPlaceHolder()) ?>" value="<?php echo $ItemxPedido_grid->DateCreation->EditValue ?>"<?php echo $ItemxPedido_grid->DateCreation->editAttributes() ?>>
<?php if (!$ItemxPedido_grid->DateCreation->ReadOnly && !$ItemxPedido_grid->DateCreation->Disabled && !isset($ItemxPedido_grid->DateCreation->EditAttrs["readonly"]) && !isset($ItemxPedido_grid->DateCreation->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fItemxPedidogrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fItemxPedidogrid", "x<?php echo $ItemxPedido_grid->RowIndex ?>_DateCreation", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($ItemxPedido->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ItemxPedido_grid->RowCount ?>_ItemxPedido_DateCreation">
<span<?php echo $ItemxPedido_grid->DateCreation->viewAttributes() ?>><?php echo $ItemxPedido_grid->DateCreation->getViewValue() ?></span>
</span>
<?php if (!$ItemxPedido->isConfirm()) { ?>
<input type="hidden" data-table="ItemxPedido" data-field="x_DateCreation" name="x<?php echo $ItemxPedido_grid->RowIndex ?>_DateCreation" id="x<?php echo $ItemxPedido_grid->RowIndex ?>_DateCreation" value="<?php echo HtmlEncode($ItemxPedido_grid->DateCreation->FormValue) ?>">
<input type="hidden" data-table="ItemxPedido" data-field="x_DateCreation" name="o<?php echo $ItemxPedido_grid->RowIndex ?>_DateCreation" id="o<?php echo $ItemxPedido_grid->RowIndex ?>_DateCreation" value="<?php echo HtmlEncode($ItemxPedido_grid->DateCreation->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ItemxPedido" data-field="x_DateCreation" name="fItemxPedidogrid$x<?php echo $ItemxPedido_grid->RowIndex ?>_DateCreation" id="fItemxPedidogrid$x<?php echo $ItemxPedido_grid->RowIndex ?>_DateCreation" value="<?php echo HtmlEncode($ItemxPedido_grid->DateCreation->FormValue) ?>">
<input type="hidden" data-table="ItemxPedido" data-field="x_DateCreation" name="fItemxPedidogrid$o<?php echo $ItemxPedido_grid->RowIndex ?>_DateCreation" id="fItemxPedidogrid$o<?php echo $ItemxPedido_grid->RowIndex ?>_DateCreation" value="<?php echo HtmlEncode($ItemxPedido_grid->DateCreation->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ItemxPedido_grid->DateLastUpdate->Visible) { // DateLastUpdate ?>
		<td data-name="DateLastUpdate" <?php echo $ItemxPedido_grid->DateLastUpdate->cellAttributes() ?>>
<?php if ($ItemxPedido->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ItemxPedido_grid->RowCount ?>_ItemxPedido_DateLastUpdate" class="form-group">
<input type="text" data-table="ItemxPedido" data-field="x_DateLastUpdate" name="x<?php echo $ItemxPedido_grid->RowIndex ?>_DateLastUpdate" id="x<?php echo $ItemxPedido_grid->RowIndex ?>_DateLastUpdate" maxlength="8" placeholder="<?php echo HtmlEncode($ItemxPedido_grid->DateLastUpdate->getPlaceHolder()) ?>" value="<?php echo $ItemxPedido_grid->DateLastUpdate->EditValue ?>"<?php echo $ItemxPedido_grid->DateLastUpdate->editAttributes() ?>>
<?php if (!$ItemxPedido_grid->DateLastUpdate->ReadOnly && !$ItemxPedido_grid->DateLastUpdate->Disabled && !isset($ItemxPedido_grid->DateLastUpdate->EditAttrs["readonly"]) && !isset($ItemxPedido_grid->DateLastUpdate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fItemxPedidogrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fItemxPedidogrid", "x<?php echo $ItemxPedido_grid->RowIndex ?>_DateLastUpdate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="ItemxPedido" data-field="x_DateLastUpdate" name="o<?php echo $ItemxPedido_grid->RowIndex ?>_DateLastUpdate" id="o<?php echo $ItemxPedido_grid->RowIndex ?>_DateLastUpdate" value="<?php echo HtmlEncode($ItemxPedido_grid->DateLastUpdate->OldValue) ?>">
<?php } ?>
<?php if ($ItemxPedido->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ItemxPedido_grid->RowCount ?>_ItemxPedido_DateLastUpdate" class="form-group">
<input type="text" data-table="ItemxPedido" data-field="x_DateLastUpdate" name="x<?php echo $ItemxPedido_grid->RowIndex ?>_DateLastUpdate" id="x<?php echo $ItemxPedido_grid->RowIndex ?>_DateLastUpdate" maxlength="8" placeholder="<?php echo HtmlEncode($ItemxPedido_grid->DateLastUpdate->getPlaceHolder()) ?>" value="<?php echo $ItemxPedido_grid->DateLastUpdate->EditValue ?>"<?php echo $ItemxPedido_grid->DateLastUpdate->editAttributes() ?>>
<?php if (!$ItemxPedido_grid->DateLastUpdate->ReadOnly && !$ItemxPedido_grid->DateLastUpdate->Disabled && !isset($ItemxPedido_grid->DateLastUpdate->EditAttrs["readonly"]) && !isset($ItemxPedido_grid->DateLastUpdate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fItemxPedidogrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fItemxPedidogrid", "x<?php echo $ItemxPedido_grid->RowIndex ?>_DateLastUpdate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($ItemxPedido->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ItemxPedido_grid->RowCount ?>_ItemxPedido_DateLastUpdate">
<span<?php echo $ItemxPedido_grid->DateLastUpdate->viewAttributes() ?>><?php echo $ItemxPedido_grid->DateLastUpdate->getViewValue() ?></span>
</span>
<?php if (!$ItemxPedido->isConfirm()) { ?>
<input type="hidden" data-table="ItemxPedido" data-field="x_DateLastUpdate" name="x<?php echo $ItemxPedido_grid->RowIndex ?>_DateLastUpdate" id="x<?php echo $ItemxPedido_grid->RowIndex ?>_DateLastUpdate" value="<?php echo HtmlEncode($ItemxPedido_grid->DateLastUpdate->FormValue) ?>">
<input type="hidden" data-table="ItemxPedido" data-field="x_DateLastUpdate" name="o<?php echo $ItemxPedido_grid->RowIndex ?>_DateLastUpdate" id="o<?php echo $ItemxPedido_grid->RowIndex ?>_DateLastUpdate" value="<?php echo HtmlEncode($ItemxPedido_grid->DateLastUpdate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ItemxPedido" data-field="x_DateLastUpdate" name="fItemxPedidogrid$x<?php echo $ItemxPedido_grid->RowIndex ?>_DateLastUpdate" id="fItemxPedidogrid$x<?php echo $ItemxPedido_grid->RowIndex ?>_DateLastUpdate" value="<?php echo HtmlEncode($ItemxPedido_grid->DateLastUpdate->FormValue) ?>">
<input type="hidden" data-table="ItemxPedido" data-field="x_DateLastUpdate" name="fItemxPedidogrid$o<?php echo $ItemxPedido_grid->RowIndex ?>_DateLastUpdate" id="fItemxPedidogrid$o<?php echo $ItemxPedido_grid->RowIndex ?>_DateLastUpdate" value="<?php echo HtmlEncode($ItemxPedido_grid->DateLastUpdate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ItemxPedido_grid->Comments->Visible) { // Comments ?>
		<td data-name="Comments" <?php echo $ItemxPedido_grid->Comments->cellAttributes() ?>>
<?php if ($ItemxPedido->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ItemxPedido_grid->RowCount ?>_ItemxPedido_Comments" class="form-group">
<input type="text" data-table="ItemxPedido" data-field="x_Comments" name="x<?php echo $ItemxPedido_grid->RowIndex ?>_Comments" id="x<?php echo $ItemxPedido_grid->RowIndex ?>_Comments" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($ItemxPedido_grid->Comments->getPlaceHolder()) ?>" value="<?php echo $ItemxPedido_grid->Comments->EditValue ?>"<?php echo $ItemxPedido_grid->Comments->editAttributes() ?>>
</span>
<input type="hidden" data-table="ItemxPedido" data-field="x_Comments" name="o<?php echo $ItemxPedido_grid->RowIndex ?>_Comments" id="o<?php echo $ItemxPedido_grid->RowIndex ?>_Comments" value="<?php echo HtmlEncode($ItemxPedido_grid->Comments->OldValue) ?>">
<?php } ?>
<?php if ($ItemxPedido->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ItemxPedido_grid->RowCount ?>_ItemxPedido_Comments" class="form-group">
<input type="text" data-table="ItemxPedido" data-field="x_Comments" name="x<?php echo $ItemxPedido_grid->RowIndex ?>_Comments" id="x<?php echo $ItemxPedido_grid->RowIndex ?>_Comments" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($ItemxPedido_grid->Comments->getPlaceHolder()) ?>" value="<?php echo $ItemxPedido_grid->Comments->EditValue ?>"<?php echo $ItemxPedido_grid->Comments->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($ItemxPedido->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ItemxPedido_grid->RowCount ?>_ItemxPedido_Comments">
<span<?php echo $ItemxPedido_grid->Comments->viewAttributes() ?>><?php echo $ItemxPedido_grid->Comments->getViewValue() ?></span>
</span>
<?php if (!$ItemxPedido->isConfirm()) { ?>
<input type="hidden" data-table="ItemxPedido" data-field="x_Comments" name="x<?php echo $ItemxPedido_grid->RowIndex ?>_Comments" id="x<?php echo $ItemxPedido_grid->RowIndex ?>_Comments" value="<?php echo HtmlEncode($ItemxPedido_grid->Comments->FormValue) ?>">
<input type="hidden" data-table="ItemxPedido" data-field="x_Comments" name="o<?php echo $ItemxPedido_grid->RowIndex ?>_Comments" id="o<?php echo $ItemxPedido_grid->RowIndex ?>_Comments" value="<?php echo HtmlEncode($ItemxPedido_grid->Comments->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ItemxPedido" data-field="x_Comments" name="fItemxPedidogrid$x<?php echo $ItemxPedido_grid->RowIndex ?>_Comments" id="fItemxPedidogrid$x<?php echo $ItemxPedido_grid->RowIndex ?>_Comments" value="<?php echo HtmlEncode($ItemxPedido_grid->Comments->FormValue) ?>">
<input type="hidden" data-table="ItemxPedido" data-field="x_Comments" name="fItemxPedidogrid$o<?php echo $ItemxPedido_grid->RowIndex ?>_Comments" id="fItemxPedidogrid$o<?php echo $ItemxPedido_grid->RowIndex ?>_Comments" value="<?php echo HtmlEncode($ItemxPedido_grid->Comments->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ItemxPedido_grid->ID_Pedido->Visible) { // ID_Pedido ?>
		<td data-name="ID_Pedido" <?php echo $ItemxPedido_grid->ID_Pedido->cellAttributes() ?>>
<?php if ($ItemxPedido->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($ItemxPedido_grid->ID_Pedido->getSessionValue() != "") { ?>
<span id="el<?php echo $ItemxPedido_grid->RowCount ?>_ItemxPedido_ID_Pedido" class="form-group">
<span<?php echo $ItemxPedido_grid->ID_Pedido->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ItemxPedido_grid->ID_Pedido->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Pedido" name="x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Pedido" value="<?php echo HtmlEncode($ItemxPedido_grid->ID_Pedido->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $ItemxPedido_grid->RowCount ?>_ItemxPedido_ID_Pedido" class="form-group">
<input type="text" data-table="ItemxPedido" data-field="x_ID_Pedido" name="x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Pedido" id="x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Pedido" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($ItemxPedido_grid->ID_Pedido->getPlaceHolder()) ?>" value="<?php echo $ItemxPedido_grid->ID_Pedido->EditValue ?>"<?php echo $ItemxPedido_grid->ID_Pedido->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="ItemxPedido" data-field="x_ID_Pedido" name="o<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Pedido" id="o<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Pedido" value="<?php echo HtmlEncode($ItemxPedido_grid->ID_Pedido->OldValue) ?>">
<?php } ?>
<?php if ($ItemxPedido->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($ItemxPedido_grid->ID_Pedido->getSessionValue() != "") { ?>
<span id="el<?php echo $ItemxPedido_grid->RowCount ?>_ItemxPedido_ID_Pedido" class="form-group">
<span<?php echo $ItemxPedido_grid->ID_Pedido->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ItemxPedido_grid->ID_Pedido->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Pedido" name="x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Pedido" value="<?php echo HtmlEncode($ItemxPedido_grid->ID_Pedido->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $ItemxPedido_grid->RowCount ?>_ItemxPedido_ID_Pedido" class="form-group">
<input type="text" data-table="ItemxPedido" data-field="x_ID_Pedido" name="x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Pedido" id="x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Pedido" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($ItemxPedido_grid->ID_Pedido->getPlaceHolder()) ?>" value="<?php echo $ItemxPedido_grid->ID_Pedido->EditValue ?>"<?php echo $ItemxPedido_grid->ID_Pedido->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($ItemxPedido->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ItemxPedido_grid->RowCount ?>_ItemxPedido_ID_Pedido">
<span<?php echo $ItemxPedido_grid->ID_Pedido->viewAttributes() ?>><?php echo $ItemxPedido_grid->ID_Pedido->getViewValue() ?></span>
</span>
<?php if (!$ItemxPedido->isConfirm()) { ?>
<input type="hidden" data-table="ItemxPedido" data-field="x_ID_Pedido" name="x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Pedido" id="x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Pedido" value="<?php echo HtmlEncode($ItemxPedido_grid->ID_Pedido->FormValue) ?>">
<input type="hidden" data-table="ItemxPedido" data-field="x_ID_Pedido" name="o<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Pedido" id="o<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Pedido" value="<?php echo HtmlEncode($ItemxPedido_grid->ID_Pedido->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ItemxPedido" data-field="x_ID_Pedido" name="fItemxPedidogrid$x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Pedido" id="fItemxPedidogrid$x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Pedido" value="<?php echo HtmlEncode($ItemxPedido_grid->ID_Pedido->FormValue) ?>">
<input type="hidden" data-table="ItemxPedido" data-field="x_ID_Pedido" name="fItemxPedidogrid$o<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Pedido" id="fItemxPedidogrid$o<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Pedido" value="<?php echo HtmlEncode($ItemxPedido_grid->ID_Pedido->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ItemxPedido_grid->Compartir->Visible) { // Compartir ?>
		<td data-name="Compartir" <?php echo $ItemxPedido_grid->Compartir->cellAttributes() ?>>
<?php if ($ItemxPedido->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ItemxPedido_grid->RowCount ?>_ItemxPedido_Compartir" class="form-group">
<div id="tp_x<?php echo $ItemxPedido_grid->RowIndex ?>_Compartir" class="ew-template"><input type="radio" class="custom-control-input" data-table="ItemxPedido" data-field="x_Compartir" data-value-separator="<?php echo $ItemxPedido_grid->Compartir->displayValueSeparatorAttribute() ?>" name="x<?php echo $ItemxPedido_grid->RowIndex ?>_Compartir" id="x<?php echo $ItemxPedido_grid->RowIndex ?>_Compartir" value="{value}"<?php echo $ItemxPedido_grid->Compartir->editAttributes() ?>></div>
<div id="dsl_x<?php echo $ItemxPedido_grid->RowIndex ?>_Compartir" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $ItemxPedido_grid->Compartir->radioButtonListHtml(FALSE, "x{$ItemxPedido_grid->RowIndex}_Compartir") ?>
</div></div>
</span>
<input type="hidden" data-table="ItemxPedido" data-field="x_Compartir" name="o<?php echo $ItemxPedido_grid->RowIndex ?>_Compartir" id="o<?php echo $ItemxPedido_grid->RowIndex ?>_Compartir" value="<?php echo HtmlEncode($ItemxPedido_grid->Compartir->OldValue) ?>">
<?php } ?>
<?php if ($ItemxPedido->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ItemxPedido_grid->RowCount ?>_ItemxPedido_Compartir" class="form-group">
<div id="tp_x<?php echo $ItemxPedido_grid->RowIndex ?>_Compartir" class="ew-template"><input type="radio" class="custom-control-input" data-table="ItemxPedido" data-field="x_Compartir" data-value-separator="<?php echo $ItemxPedido_grid->Compartir->displayValueSeparatorAttribute() ?>" name="x<?php echo $ItemxPedido_grid->RowIndex ?>_Compartir" id="x<?php echo $ItemxPedido_grid->RowIndex ?>_Compartir" value="{value}"<?php echo $ItemxPedido_grid->Compartir->editAttributes() ?>></div>
<div id="dsl_x<?php echo $ItemxPedido_grid->RowIndex ?>_Compartir" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $ItemxPedido_grid->Compartir->radioButtonListHtml(FALSE, "x{$ItemxPedido_grid->RowIndex}_Compartir") ?>
</div></div>
</span>
<?php } ?>
<?php if ($ItemxPedido->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ItemxPedido_grid->RowCount ?>_ItemxPedido_Compartir">
<span<?php echo $ItemxPedido_grid->Compartir->viewAttributes() ?>><?php echo $ItemxPedido_grid->Compartir->getViewValue() ?></span>
</span>
<?php if (!$ItemxPedido->isConfirm()) { ?>
<input type="hidden" data-table="ItemxPedido" data-field="x_Compartir" name="x<?php echo $ItemxPedido_grid->RowIndex ?>_Compartir" id="x<?php echo $ItemxPedido_grid->RowIndex ?>_Compartir" value="<?php echo HtmlEncode($ItemxPedido_grid->Compartir->FormValue) ?>">
<input type="hidden" data-table="ItemxPedido" data-field="x_Compartir" name="o<?php echo $ItemxPedido_grid->RowIndex ?>_Compartir" id="o<?php echo $ItemxPedido_grid->RowIndex ?>_Compartir" value="<?php echo HtmlEncode($ItemxPedido_grid->Compartir->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ItemxPedido" data-field="x_Compartir" name="fItemxPedidogrid$x<?php echo $ItemxPedido_grid->RowIndex ?>_Compartir" id="fItemxPedidogrid$x<?php echo $ItemxPedido_grid->RowIndex ?>_Compartir" value="<?php echo HtmlEncode($ItemxPedido_grid->Compartir->FormValue) ?>">
<input type="hidden" data-table="ItemxPedido" data-field="x_Compartir" name="fItemxPedidogrid$o<?php echo $ItemxPedido_grid->RowIndex ?>_Compartir" id="fItemxPedidogrid$o<?php echo $ItemxPedido_grid->RowIndex ?>_Compartir" value="<?php echo HtmlEncode($ItemxPedido_grid->Compartir->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ItemxPedido_grid->Cantidad->Visible) { // Cantidad ?>
		<td data-name="Cantidad" <?php echo $ItemxPedido_grid->Cantidad->cellAttributes() ?>>
<?php if ($ItemxPedido->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ItemxPedido_grid->RowCount ?>_ItemxPedido_Cantidad" class="form-group">
<input type="text" data-table="ItemxPedido" data-field="x_Cantidad" name="x<?php echo $ItemxPedido_grid->RowIndex ?>_Cantidad" id="x<?php echo $ItemxPedido_grid->RowIndex ?>_Cantidad" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($ItemxPedido_grid->Cantidad->getPlaceHolder()) ?>" value="<?php echo $ItemxPedido_grid->Cantidad->EditValue ?>"<?php echo $ItemxPedido_grid->Cantidad->editAttributes() ?>>
</span>
<input type="hidden" data-table="ItemxPedido" data-field="x_Cantidad" name="o<?php echo $ItemxPedido_grid->RowIndex ?>_Cantidad" id="o<?php echo $ItemxPedido_grid->RowIndex ?>_Cantidad" value="<?php echo HtmlEncode($ItemxPedido_grid->Cantidad->OldValue) ?>">
<?php } ?>
<?php if ($ItemxPedido->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ItemxPedido_grid->RowCount ?>_ItemxPedido_Cantidad" class="form-group">
<input type="text" data-table="ItemxPedido" data-field="x_Cantidad" name="x<?php echo $ItemxPedido_grid->RowIndex ?>_Cantidad" id="x<?php echo $ItemxPedido_grid->RowIndex ?>_Cantidad" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($ItemxPedido_grid->Cantidad->getPlaceHolder()) ?>" value="<?php echo $ItemxPedido_grid->Cantidad->EditValue ?>"<?php echo $ItemxPedido_grid->Cantidad->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($ItemxPedido->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ItemxPedido_grid->RowCount ?>_ItemxPedido_Cantidad">
<span<?php echo $ItemxPedido_grid->Cantidad->viewAttributes() ?>><?php echo $ItemxPedido_grid->Cantidad->getViewValue() ?></span>
</span>
<?php if (!$ItemxPedido->isConfirm()) { ?>
<input type="hidden" data-table="ItemxPedido" data-field="x_Cantidad" name="x<?php echo $ItemxPedido_grid->RowIndex ?>_Cantidad" id="x<?php echo $ItemxPedido_grid->RowIndex ?>_Cantidad" value="<?php echo HtmlEncode($ItemxPedido_grid->Cantidad->FormValue) ?>">
<input type="hidden" data-table="ItemxPedido" data-field="x_Cantidad" name="o<?php echo $ItemxPedido_grid->RowIndex ?>_Cantidad" id="o<?php echo $ItemxPedido_grid->RowIndex ?>_Cantidad" value="<?php echo HtmlEncode($ItemxPedido_grid->Cantidad->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ItemxPedido" data-field="x_Cantidad" name="fItemxPedidogrid$x<?php echo $ItemxPedido_grid->RowIndex ?>_Cantidad" id="fItemxPedidogrid$x<?php echo $ItemxPedido_grid->RowIndex ?>_Cantidad" value="<?php echo HtmlEncode($ItemxPedido_grid->Cantidad->FormValue) ?>">
<input type="hidden" data-table="ItemxPedido" data-field="x_Cantidad" name="fItemxPedidogrid$o<?php echo $ItemxPedido_grid->RowIndex ?>_Cantidad" id="fItemxPedidogrid$o<?php echo $ItemxPedido_grid->RowIndex ?>_Cantidad" value="<?php echo HtmlEncode($ItemxPedido_grid->Cantidad->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ItemxPedido_grid->ListOptions->render("body", "right", $ItemxPedido_grid->RowCount);
?>
	</tr>
<?php if ($ItemxPedido->RowType == ROWTYPE_ADD || $ItemxPedido->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fItemxPedidogrid", "load"], function() {
	fItemxPedidogrid.updateLists(<?php echo $ItemxPedido_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$ItemxPedido_grid->isGridAdd() || $ItemxPedido->CurrentMode == "copy")
		if (!$ItemxPedido_grid->Recordset->EOF)
			$ItemxPedido_grid->Recordset->moveNext();
}
?>
<?php
	if ($ItemxPedido->CurrentMode == "add" || $ItemxPedido->CurrentMode == "copy" || $ItemxPedido->CurrentMode == "edit") {
		$ItemxPedido_grid->RowIndex = '$rowindex$';
		$ItemxPedido_grid->loadRowValues();

		// Set row properties
		$ItemxPedido->resetAttributes();
		$ItemxPedido->RowAttrs->merge(["data-rowindex" => $ItemxPedido_grid->RowIndex, "id" => "r0_ItemxPedido", "data-rowtype" => ROWTYPE_ADD]);
		$ItemxPedido->RowAttrs->appendClass("ew-template");
		$ItemxPedido->RowType = ROWTYPE_ADD;

		// Render row
		$ItemxPedido_grid->renderRow();

		// Render list options
		$ItemxPedido_grid->renderListOptions();
		$ItemxPedido_grid->StartRowCount = 0;
?>
	<tr <?php echo $ItemxPedido->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ItemxPedido_grid->ListOptions->render("body", "left", $ItemxPedido_grid->RowIndex);
?>
	<?php if ($ItemxPedido_grid->ID->Visible) { // ID ?>
		<td data-name="ID">
<?php if (!$ItemxPedido->isConfirm()) { ?>
<span id="el$rowindex$_ItemxPedido_ID" class="form-group ItemxPedido_ID"></span>
<?php } else { ?>
<span id="el$rowindex$_ItemxPedido_ID" class="form-group ItemxPedido_ID">
<span<?php echo $ItemxPedido_grid->ID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ItemxPedido_grid->ID->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="ItemxPedido" data-field="x_ID" name="x<?php echo $ItemxPedido_grid->RowIndex ?>_ID" id="x<?php echo $ItemxPedido_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($ItemxPedido_grid->ID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ItemxPedido" data-field="x_ID" name="o<?php echo $ItemxPedido_grid->RowIndex ?>_ID" id="o<?php echo $ItemxPedido_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($ItemxPedido_grid->ID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ItemxPedido_grid->ID_Item->Visible) { // ID_Item ?>
		<td data-name="ID_Item">
<?php if (!$ItemxPedido->isConfirm()) { ?>
<span id="el$rowindex$_ItemxPedido_ID_Item" class="form-group ItemxPedido_ID_Item">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ItemxPedido" data-field="x_ID_Item" data-value-separator="<?php echo $ItemxPedido_grid->ID_Item->displayValueSeparatorAttribute() ?>" id="x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Item" name="x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Item"<?php echo $ItemxPedido_grid->ID_Item->editAttributes() ?>>
			<?php echo $ItemxPedido_grid->ID_Item->selectOptionListHtml("x{$ItemxPedido_grid->RowIndex}_ID_Item") ?>
		</select>
</div>
<?php echo $ItemxPedido_grid->ID_Item->Lookup->getParamTag($ItemxPedido_grid, "p_x" . $ItemxPedido_grid->RowIndex . "_ID_Item") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_ItemxPedido_ID_Item" class="form-group ItemxPedido_ID_Item">
<span<?php echo $ItemxPedido_grid->ID_Item->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ItemxPedido_grid->ID_Item->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="ItemxPedido" data-field="x_ID_Item" name="x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Item" id="x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Item" value="<?php echo HtmlEncode($ItemxPedido_grid->ID_Item->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ItemxPedido" data-field="x_ID_Item" name="o<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Item" id="o<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Item" value="<?php echo HtmlEncode($ItemxPedido_grid->ID_Item->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ItemxPedido_grid->ID_Restaurant->Visible) { // ID_Restaurant ?>
		<td data-name="ID_Restaurant">
<?php if (!$ItemxPedido->isConfirm()) { ?>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn() && !$ItemxPedido->userIDAllow("grid")) { // Non system admin ?>
<span id="el$rowindex$_ItemxPedido_ID_Restaurant" class="form-group ItemxPedido_ID_Restaurant">
<span<?php echo $ItemxPedido_grid->ID_Restaurant->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ItemxPedido_grid->ID_Restaurant->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="ItemxPedido" data-field="x_ID_Restaurant" name="x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Restaurant" id="x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($ItemxPedido_grid->ID_Restaurant->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_ItemxPedido_ID_Restaurant" class="form-group ItemxPedido_ID_Restaurant">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ItemxPedido" data-field="x_ID_Restaurant" data-value-separator="<?php echo $ItemxPedido_grid->ID_Restaurant->displayValueSeparatorAttribute() ?>" id="x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Restaurant" name="x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Restaurant"<?php echo $ItemxPedido_grid->ID_Restaurant->editAttributes() ?>>
			<?php echo $ItemxPedido_grid->ID_Restaurant->selectOptionListHtml("x{$ItemxPedido_grid->RowIndex}_ID_Restaurant") ?>
		</select>
</div>
<?php echo $ItemxPedido_grid->ID_Restaurant->Lookup->getParamTag($ItemxPedido_grid, "p_x" . $ItemxPedido_grid->RowIndex . "_ID_Restaurant") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_ItemxPedido_ID_Restaurant" class="form-group ItemxPedido_ID_Restaurant">
<span<?php echo $ItemxPedido_grid->ID_Restaurant->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ItemxPedido_grid->ID_Restaurant->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="ItemxPedido" data-field="x_ID_Restaurant" name="x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Restaurant" id="x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($ItemxPedido_grid->ID_Restaurant->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ItemxPedido" data-field="x_ID_Restaurant" name="o<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Restaurant" id="o<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($ItemxPedido_grid->ID_Restaurant->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ItemxPedido_grid->ID_Client->Visible) { // ID_Client ?>
		<td data-name="ID_Client">
<?php if (!$ItemxPedido->isConfirm()) { ?>
<span id="el$rowindex$_ItemxPedido_ID_Client" class="form-group ItemxPedido_ID_Client">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ItemxPedido" data-field="x_ID_Client" data-value-separator="<?php echo $ItemxPedido_grid->ID_Client->displayValueSeparatorAttribute() ?>" id="x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Client" name="x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Client"<?php echo $ItemxPedido_grid->ID_Client->editAttributes() ?>>
			<?php echo $ItemxPedido_grid->ID_Client->selectOptionListHtml("x{$ItemxPedido_grid->RowIndex}_ID_Client") ?>
		</select>
</div>
<?php echo $ItemxPedido_grid->ID_Client->Lookup->getParamTag($ItemxPedido_grid, "p_x" . $ItemxPedido_grid->RowIndex . "_ID_Client") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_ItemxPedido_ID_Client" class="form-group ItemxPedido_ID_Client">
<span<?php echo $ItemxPedido_grid->ID_Client->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ItemxPedido_grid->ID_Client->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="ItemxPedido" data-field="x_ID_Client" name="x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Client" id="x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Client" value="<?php echo HtmlEncode($ItemxPedido_grid->ID_Client->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ItemxPedido" data-field="x_ID_Client" name="o<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Client" id="o<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Client" value="<?php echo HtmlEncode($ItemxPedido_grid->ID_Client->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ItemxPedido_grid->DateCreation->Visible) { // DateCreation ?>
		<td data-name="DateCreation">
<?php if (!$ItemxPedido->isConfirm()) { ?>
<span id="el$rowindex$_ItemxPedido_DateCreation" class="form-group ItemxPedido_DateCreation">
<input type="text" data-table="ItemxPedido" data-field="x_DateCreation" name="x<?php echo $ItemxPedido_grid->RowIndex ?>_DateCreation" id="x<?php echo $ItemxPedido_grid->RowIndex ?>_DateCreation" maxlength="8" placeholder="<?php echo HtmlEncode($ItemxPedido_grid->DateCreation->getPlaceHolder()) ?>" value="<?php echo $ItemxPedido_grid->DateCreation->EditValue ?>"<?php echo $ItemxPedido_grid->DateCreation->editAttributes() ?>>
<?php if (!$ItemxPedido_grid->DateCreation->ReadOnly && !$ItemxPedido_grid->DateCreation->Disabled && !isset($ItemxPedido_grid->DateCreation->EditAttrs["readonly"]) && !isset($ItemxPedido_grid->DateCreation->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fItemxPedidogrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fItemxPedidogrid", "x<?php echo $ItemxPedido_grid->RowIndex ?>_DateCreation", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_ItemxPedido_DateCreation" class="form-group ItemxPedido_DateCreation">
<span<?php echo $ItemxPedido_grid->DateCreation->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ItemxPedido_grid->DateCreation->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="ItemxPedido" data-field="x_DateCreation" name="x<?php echo $ItemxPedido_grid->RowIndex ?>_DateCreation" id="x<?php echo $ItemxPedido_grid->RowIndex ?>_DateCreation" value="<?php echo HtmlEncode($ItemxPedido_grid->DateCreation->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ItemxPedido" data-field="x_DateCreation" name="o<?php echo $ItemxPedido_grid->RowIndex ?>_DateCreation" id="o<?php echo $ItemxPedido_grid->RowIndex ?>_DateCreation" value="<?php echo HtmlEncode($ItemxPedido_grid->DateCreation->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ItemxPedido_grid->DateLastUpdate->Visible) { // DateLastUpdate ?>
		<td data-name="DateLastUpdate">
<?php if (!$ItemxPedido->isConfirm()) { ?>
<span id="el$rowindex$_ItemxPedido_DateLastUpdate" class="form-group ItemxPedido_DateLastUpdate">
<input type="text" data-table="ItemxPedido" data-field="x_DateLastUpdate" name="x<?php echo $ItemxPedido_grid->RowIndex ?>_DateLastUpdate" id="x<?php echo $ItemxPedido_grid->RowIndex ?>_DateLastUpdate" maxlength="8" placeholder="<?php echo HtmlEncode($ItemxPedido_grid->DateLastUpdate->getPlaceHolder()) ?>" value="<?php echo $ItemxPedido_grid->DateLastUpdate->EditValue ?>"<?php echo $ItemxPedido_grid->DateLastUpdate->editAttributes() ?>>
<?php if (!$ItemxPedido_grid->DateLastUpdate->ReadOnly && !$ItemxPedido_grid->DateLastUpdate->Disabled && !isset($ItemxPedido_grid->DateLastUpdate->EditAttrs["readonly"]) && !isset($ItemxPedido_grid->DateLastUpdate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fItemxPedidogrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fItemxPedidogrid", "x<?php echo $ItemxPedido_grid->RowIndex ?>_DateLastUpdate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_ItemxPedido_DateLastUpdate" class="form-group ItemxPedido_DateLastUpdate">
<span<?php echo $ItemxPedido_grid->DateLastUpdate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ItemxPedido_grid->DateLastUpdate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="ItemxPedido" data-field="x_DateLastUpdate" name="x<?php echo $ItemxPedido_grid->RowIndex ?>_DateLastUpdate" id="x<?php echo $ItemxPedido_grid->RowIndex ?>_DateLastUpdate" value="<?php echo HtmlEncode($ItemxPedido_grid->DateLastUpdate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ItemxPedido" data-field="x_DateLastUpdate" name="o<?php echo $ItemxPedido_grid->RowIndex ?>_DateLastUpdate" id="o<?php echo $ItemxPedido_grid->RowIndex ?>_DateLastUpdate" value="<?php echo HtmlEncode($ItemxPedido_grid->DateLastUpdate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ItemxPedido_grid->Comments->Visible) { // Comments ?>
		<td data-name="Comments">
<?php if (!$ItemxPedido->isConfirm()) { ?>
<span id="el$rowindex$_ItemxPedido_Comments" class="form-group ItemxPedido_Comments">
<input type="text" data-table="ItemxPedido" data-field="x_Comments" name="x<?php echo $ItemxPedido_grid->RowIndex ?>_Comments" id="x<?php echo $ItemxPedido_grid->RowIndex ?>_Comments" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($ItemxPedido_grid->Comments->getPlaceHolder()) ?>" value="<?php echo $ItemxPedido_grid->Comments->EditValue ?>"<?php echo $ItemxPedido_grid->Comments->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_ItemxPedido_Comments" class="form-group ItemxPedido_Comments">
<span<?php echo $ItemxPedido_grid->Comments->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ItemxPedido_grid->Comments->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="ItemxPedido" data-field="x_Comments" name="x<?php echo $ItemxPedido_grid->RowIndex ?>_Comments" id="x<?php echo $ItemxPedido_grid->RowIndex ?>_Comments" value="<?php echo HtmlEncode($ItemxPedido_grid->Comments->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ItemxPedido" data-field="x_Comments" name="o<?php echo $ItemxPedido_grid->RowIndex ?>_Comments" id="o<?php echo $ItemxPedido_grid->RowIndex ?>_Comments" value="<?php echo HtmlEncode($ItemxPedido_grid->Comments->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ItemxPedido_grid->ID_Pedido->Visible) { // ID_Pedido ?>
		<td data-name="ID_Pedido">
<?php if (!$ItemxPedido->isConfirm()) { ?>
<?php if ($ItemxPedido_grid->ID_Pedido->getSessionValue() != "") { ?>
<span id="el$rowindex$_ItemxPedido_ID_Pedido" class="form-group ItemxPedido_ID_Pedido">
<span<?php echo $ItemxPedido_grid->ID_Pedido->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ItemxPedido_grid->ID_Pedido->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Pedido" name="x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Pedido" value="<?php echo HtmlEncode($ItemxPedido_grid->ID_Pedido->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_ItemxPedido_ID_Pedido" class="form-group ItemxPedido_ID_Pedido">
<input type="text" data-table="ItemxPedido" data-field="x_ID_Pedido" name="x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Pedido" id="x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Pedido" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($ItemxPedido_grid->ID_Pedido->getPlaceHolder()) ?>" value="<?php echo $ItemxPedido_grid->ID_Pedido->EditValue ?>"<?php echo $ItemxPedido_grid->ID_Pedido->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_ItemxPedido_ID_Pedido" class="form-group ItemxPedido_ID_Pedido">
<span<?php echo $ItemxPedido_grid->ID_Pedido->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ItemxPedido_grid->ID_Pedido->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="ItemxPedido" data-field="x_ID_Pedido" name="x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Pedido" id="x<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Pedido" value="<?php echo HtmlEncode($ItemxPedido_grid->ID_Pedido->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ItemxPedido" data-field="x_ID_Pedido" name="o<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Pedido" id="o<?php echo $ItemxPedido_grid->RowIndex ?>_ID_Pedido" value="<?php echo HtmlEncode($ItemxPedido_grid->ID_Pedido->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ItemxPedido_grid->Compartir->Visible) { // Compartir ?>
		<td data-name="Compartir">
<?php if (!$ItemxPedido->isConfirm()) { ?>
<span id="el$rowindex$_ItemxPedido_Compartir" class="form-group ItemxPedido_Compartir">
<div id="tp_x<?php echo $ItemxPedido_grid->RowIndex ?>_Compartir" class="ew-template"><input type="radio" class="custom-control-input" data-table="ItemxPedido" data-field="x_Compartir" data-value-separator="<?php echo $ItemxPedido_grid->Compartir->displayValueSeparatorAttribute() ?>" name="x<?php echo $ItemxPedido_grid->RowIndex ?>_Compartir" id="x<?php echo $ItemxPedido_grid->RowIndex ?>_Compartir" value="{value}"<?php echo $ItemxPedido_grid->Compartir->editAttributes() ?>></div>
<div id="dsl_x<?php echo $ItemxPedido_grid->RowIndex ?>_Compartir" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $ItemxPedido_grid->Compartir->radioButtonListHtml(FALSE, "x{$ItemxPedido_grid->RowIndex}_Compartir") ?>
</div></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_ItemxPedido_Compartir" class="form-group ItemxPedido_Compartir">
<span<?php echo $ItemxPedido_grid->Compartir->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ItemxPedido_grid->Compartir->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="ItemxPedido" data-field="x_Compartir" name="x<?php echo $ItemxPedido_grid->RowIndex ?>_Compartir" id="x<?php echo $ItemxPedido_grid->RowIndex ?>_Compartir" value="<?php echo HtmlEncode($ItemxPedido_grid->Compartir->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ItemxPedido" data-field="x_Compartir" name="o<?php echo $ItemxPedido_grid->RowIndex ?>_Compartir" id="o<?php echo $ItemxPedido_grid->RowIndex ?>_Compartir" value="<?php echo HtmlEncode($ItemxPedido_grid->Compartir->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ItemxPedido_grid->Cantidad->Visible) { // Cantidad ?>
		<td data-name="Cantidad">
<?php if (!$ItemxPedido->isConfirm()) { ?>
<span id="el$rowindex$_ItemxPedido_Cantidad" class="form-group ItemxPedido_Cantidad">
<input type="text" data-table="ItemxPedido" data-field="x_Cantidad" name="x<?php echo $ItemxPedido_grid->RowIndex ?>_Cantidad" id="x<?php echo $ItemxPedido_grid->RowIndex ?>_Cantidad" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($ItemxPedido_grid->Cantidad->getPlaceHolder()) ?>" value="<?php echo $ItemxPedido_grid->Cantidad->EditValue ?>"<?php echo $ItemxPedido_grid->Cantidad->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_ItemxPedido_Cantidad" class="form-group ItemxPedido_Cantidad">
<span<?php echo $ItemxPedido_grid->Cantidad->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ItemxPedido_grid->Cantidad->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="ItemxPedido" data-field="x_Cantidad" name="x<?php echo $ItemxPedido_grid->RowIndex ?>_Cantidad" id="x<?php echo $ItemxPedido_grid->RowIndex ?>_Cantidad" value="<?php echo HtmlEncode($ItemxPedido_grid->Cantidad->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ItemxPedido" data-field="x_Cantidad" name="o<?php echo $ItemxPedido_grid->RowIndex ?>_Cantidad" id="o<?php echo $ItemxPedido_grid->RowIndex ?>_Cantidad" value="<?php echo HtmlEncode($ItemxPedido_grid->Cantidad->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ItemxPedido_grid->ListOptions->render("body", "right", $ItemxPedido_grid->RowIndex);
?>
<script>
loadjs.ready(["fItemxPedidogrid", "load"], function() {
	fItemxPedidogrid.updateLists(<?php echo $ItemxPedido_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($ItemxPedido->CurrentMode == "add" || $ItemxPedido->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $ItemxPedido_grid->FormKeyCountName ?>" id="<?php echo $ItemxPedido_grid->FormKeyCountName ?>" value="<?php echo $ItemxPedido_grid->KeyCount ?>">
<?php echo $ItemxPedido_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($ItemxPedido->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $ItemxPedido_grid->FormKeyCountName ?>" id="<?php echo $ItemxPedido_grid->FormKeyCountName ?>" value="<?php echo $ItemxPedido_grid->KeyCount ?>">
<?php echo $ItemxPedido_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($ItemxPedido->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fItemxPedidogrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($ItemxPedido_grid->Recordset)
	$ItemxPedido_grid->Recordset->Close();
?>
<?php if ($ItemxPedido_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $ItemxPedido_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($ItemxPedido_grid->TotalRecords == 0 && !$ItemxPedido->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $ItemxPedido_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$ItemxPedido_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$ItemxPedido_grid->terminate();
?>