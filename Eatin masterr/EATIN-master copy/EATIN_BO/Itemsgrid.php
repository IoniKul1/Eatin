<?php
namespace PHPMaker2020\EATIN_BO;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($Items_grid))
	$Items_grid = new Items_grid();

// Run the page
$Items_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Items_grid->Page_Render();
?>
<?php if (!$Items_grid->isExport()) { ?>
<script>
var fItemsgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fItemsgrid = new ew.Form("fItemsgrid", "grid");
	fItemsgrid.formKeyCountName = '<?php echo $Items_grid->FormKeyCountName ?>';

	// Validate form
	fItemsgrid.validate = function() {
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
			<?php if ($Items_grid->ID->Required) { ?>
				elm = this.getElements("x" + infix + "_ID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Items_grid->ID->caption(), $Items_grid->ID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Items_grid->ID_Categorias->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_Categorias");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Items_grid->ID_Categorias->caption(), $Items_grid->ID_Categorias->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Items_grid->ID_Restaurant->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_Restaurant");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Items_grid->ID_Restaurant->caption(), $Items_grid->ID_Restaurant->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Items_grid->Nombre->Required) { ?>
				elm = this.getElements("x" + infix + "_Nombre");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Items_grid->Nombre->caption(), $Items_grid->Nombre->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Items_grid->Precio->Required) { ?>
				elm = this.getElements("x" + infix + "_Precio");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Items_grid->Precio->caption(), $Items_grid->Precio->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Precio");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Items_grid->Precio->errorMessage()) ?>");
			<?php if ($Items_grid->Active->Required) { ?>
				elm = this.getElements("x" + infix + "_Active");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Items_grid->Active->caption(), $Items_grid->Active->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Items_grid->Stock->Required) { ?>
				elm = this.getElements("x" + infix + "_Stock");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Items_grid->Stock->caption(), $Items_grid->Stock->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Stock");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Items_grid->Stock->errorMessage()) ?>");
			<?php if ($Items_grid->Img1->Required) { ?>
				felm = this.getElements("x" + infix + "_Img1");
				elm = this.getElements("fn_x" + infix + "_Img1");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $Items_grid->Img1->caption(), $Items_grid->Img1->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fItemsgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "ID_Categorias", false)) return false;
		if (ew.valueChanged(fobj, infix, "ID_Restaurant", false)) return false;
		if (ew.valueChanged(fobj, infix, "Nombre", false)) return false;
		if (ew.valueChanged(fobj, infix, "Precio", false)) return false;
		if (ew.valueChanged(fobj, infix, "Active", false)) return false;
		if (ew.valueChanged(fobj, infix, "Stock", false)) return false;
		if (ew.valueChanged(fobj, infix, "Img1", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fItemsgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fItemsgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fItemsgrid.lists["x_ID_Categorias"] = <?php echo $Items_grid->ID_Categorias->Lookup->toClientList($Items_grid) ?>;
	fItemsgrid.lists["x_ID_Categorias"].options = <?php echo JsonEncode($Items_grid->ID_Categorias->lookupOptions()) ?>;
	fItemsgrid.lists["x_ID_Restaurant"] = <?php echo $Items_grid->ID_Restaurant->Lookup->toClientList($Items_grid) ?>;
	fItemsgrid.lists["x_ID_Restaurant"].options = <?php echo JsonEncode($Items_grid->ID_Restaurant->lookupOptions()) ?>;
	fItemsgrid.lists["x_Active"] = <?php echo $Items_grid->Active->Lookup->toClientList($Items_grid) ?>;
	fItemsgrid.lists["x_Active"].options = <?php echo JsonEncode($Items_grid->Active->options(FALSE, TRUE)) ?>;
	loadjs.done("fItemsgrid");
});
</script>
<?php } ?>
<?php
$Items_grid->renderOtherOptions();
?>
<?php if ($Items_grid->TotalRecords > 0 || $Items->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Items_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> Items">
<?php if ($Items_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $Items_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fItemsgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_Items" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_Itemsgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$Items->RowType = ROWTYPE_HEADER;

// Render list options
$Items_grid->renderListOptions();

// Render list options (header, left)
$Items_grid->ListOptions->render("header", "left");
?>
<?php if ($Items_grid->ID->Visible) { // ID ?>
	<?php if ($Items_grid->SortUrl($Items_grid->ID) == "") { ?>
		<th data-name="ID" class="<?php echo $Items_grid->ID->headerCellClass() ?>"><div id="elh_Items_ID" class="Items_ID"><div class="ew-table-header-caption"><?php echo $Items_grid->ID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID" class="<?php echo $Items_grid->ID->headerCellClass() ?>"><div><div id="elh_Items_ID" class="Items_ID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Items_grid->ID->caption() ?></span><span class="ew-table-header-sort"><?php if ($Items_grid->ID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Items_grid->ID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Items_grid->ID_Categorias->Visible) { // ID_Categorias ?>
	<?php if ($Items_grid->SortUrl($Items_grid->ID_Categorias) == "") { ?>
		<th data-name="ID_Categorias" class="<?php echo $Items_grid->ID_Categorias->headerCellClass() ?>"><div id="elh_Items_ID_Categorias" class="Items_ID_Categorias"><div class="ew-table-header-caption"><?php echo $Items_grid->ID_Categorias->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Categorias" class="<?php echo $Items_grid->ID_Categorias->headerCellClass() ?>"><div><div id="elh_Items_ID_Categorias" class="Items_ID_Categorias">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Items_grid->ID_Categorias->caption() ?></span><span class="ew-table-header-sort"><?php if ($Items_grid->ID_Categorias->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Items_grid->ID_Categorias->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Items_grid->ID_Restaurant->Visible) { // ID_Restaurant ?>
	<?php if ($Items_grid->SortUrl($Items_grid->ID_Restaurant) == "") { ?>
		<th data-name="ID_Restaurant" class="<?php echo $Items_grid->ID_Restaurant->headerCellClass() ?>"><div id="elh_Items_ID_Restaurant" class="Items_ID_Restaurant"><div class="ew-table-header-caption"><?php echo $Items_grid->ID_Restaurant->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Restaurant" class="<?php echo $Items_grid->ID_Restaurant->headerCellClass() ?>"><div><div id="elh_Items_ID_Restaurant" class="Items_ID_Restaurant">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Items_grid->ID_Restaurant->caption() ?></span><span class="ew-table-header-sort"><?php if ($Items_grid->ID_Restaurant->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Items_grid->ID_Restaurant->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Items_grid->Nombre->Visible) { // Nombre ?>
	<?php if ($Items_grid->SortUrl($Items_grid->Nombre) == "") { ?>
		<th data-name="Nombre" class="<?php echo $Items_grid->Nombre->headerCellClass() ?>"><div id="elh_Items_Nombre" class="Items_Nombre"><div class="ew-table-header-caption"><?php echo $Items_grid->Nombre->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Nombre" class="<?php echo $Items_grid->Nombre->headerCellClass() ?>"><div><div id="elh_Items_Nombre" class="Items_Nombre">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Items_grid->Nombre->caption() ?></span><span class="ew-table-header-sort"><?php if ($Items_grid->Nombre->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Items_grid->Nombre->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Items_grid->Precio->Visible) { // Precio ?>
	<?php if ($Items_grid->SortUrl($Items_grid->Precio) == "") { ?>
		<th data-name="Precio" class="<?php echo $Items_grid->Precio->headerCellClass() ?>"><div id="elh_Items_Precio" class="Items_Precio"><div class="ew-table-header-caption"><?php echo $Items_grid->Precio->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Precio" class="<?php echo $Items_grid->Precio->headerCellClass() ?>"><div><div id="elh_Items_Precio" class="Items_Precio">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Items_grid->Precio->caption() ?></span><span class="ew-table-header-sort"><?php if ($Items_grid->Precio->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Items_grid->Precio->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Items_grid->Active->Visible) { // Active ?>
	<?php if ($Items_grid->SortUrl($Items_grid->Active) == "") { ?>
		<th data-name="Active" class="<?php echo $Items_grid->Active->headerCellClass() ?>"><div id="elh_Items_Active" class="Items_Active"><div class="ew-table-header-caption"><?php echo $Items_grid->Active->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Active" class="<?php echo $Items_grid->Active->headerCellClass() ?>"><div><div id="elh_Items_Active" class="Items_Active">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Items_grid->Active->caption() ?></span><span class="ew-table-header-sort"><?php if ($Items_grid->Active->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Items_grid->Active->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Items_grid->Stock->Visible) { // Stock ?>
	<?php if ($Items_grid->SortUrl($Items_grid->Stock) == "") { ?>
		<th data-name="Stock" class="<?php echo $Items_grid->Stock->headerCellClass() ?>"><div id="elh_Items_Stock" class="Items_Stock"><div class="ew-table-header-caption"><?php echo $Items_grid->Stock->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Stock" class="<?php echo $Items_grid->Stock->headerCellClass() ?>"><div><div id="elh_Items_Stock" class="Items_Stock">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Items_grid->Stock->caption() ?></span><span class="ew-table-header-sort"><?php if ($Items_grid->Stock->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Items_grid->Stock->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Items_grid->Img1->Visible) { // Img1 ?>
	<?php if ($Items_grid->SortUrl($Items_grid->Img1) == "") { ?>
		<th data-name="Img1" class="<?php echo $Items_grid->Img1->headerCellClass() ?>"><div id="elh_Items_Img1" class="Items_Img1"><div class="ew-table-header-caption"><?php echo $Items_grid->Img1->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Img1" class="<?php echo $Items_grid->Img1->headerCellClass() ?>"><div><div id="elh_Items_Img1" class="Items_Img1">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Items_grid->Img1->caption() ?></span><span class="ew-table-header-sort"><?php if ($Items_grid->Img1->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Items_grid->Img1->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$Items_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$Items_grid->StartRecord = 1;
$Items_grid->StopRecord = $Items_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($Items->isConfirm() || $Items_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($Items_grid->FormKeyCountName) && ($Items_grid->isGridAdd() || $Items_grid->isGridEdit() || $Items->isConfirm())) {
		$Items_grid->KeyCount = $CurrentForm->getValue($Items_grid->FormKeyCountName);
		$Items_grid->StopRecord = $Items_grid->StartRecord + $Items_grid->KeyCount - 1;
	}
}
$Items_grid->RecordCount = $Items_grid->StartRecord - 1;
if ($Items_grid->Recordset && !$Items_grid->Recordset->EOF) {
	$Items_grid->Recordset->moveFirst();
	$selectLimit = $Items_grid->UseSelectLimit;
	if (!$selectLimit && $Items_grid->StartRecord > 1)
		$Items_grid->Recordset->move($Items_grid->StartRecord - 1);
} elseif (!$Items->AllowAddDeleteRow && $Items_grid->StopRecord == 0) {
	$Items_grid->StopRecord = $Items->GridAddRowCount;
}

// Initialize aggregate
$Items->RowType = ROWTYPE_AGGREGATEINIT;
$Items->resetAttributes();
$Items_grid->renderRow();
if ($Items_grid->isGridAdd())
	$Items_grid->RowIndex = 0;
if ($Items_grid->isGridEdit())
	$Items_grid->RowIndex = 0;
while ($Items_grid->RecordCount < $Items_grid->StopRecord) {
	$Items_grid->RecordCount++;
	if ($Items_grid->RecordCount >= $Items_grid->StartRecord) {
		$Items_grid->RowCount++;
		if ($Items_grid->isGridAdd() || $Items_grid->isGridEdit() || $Items->isConfirm()) {
			$Items_grid->RowIndex++;
			$CurrentForm->Index = $Items_grid->RowIndex;
			if ($CurrentForm->hasValue($Items_grid->FormActionName) && ($Items->isConfirm() || $Items_grid->EventCancelled))
				$Items_grid->RowAction = strval($CurrentForm->getValue($Items_grid->FormActionName));
			elseif ($Items_grid->isGridAdd())
				$Items_grid->RowAction = "insert";
			else
				$Items_grid->RowAction = "";
		}

		// Set up key count
		$Items_grid->KeyCount = $Items_grid->RowIndex;

		// Init row class and style
		$Items->resetAttributes();
		$Items->CssClass = "";
		if ($Items_grid->isGridAdd()) {
			if ($Items->CurrentMode == "copy") {
				$Items_grid->loadRowValues($Items_grid->Recordset); // Load row values
				$Items_grid->setRecordKey($Items_grid->RowOldKey, $Items_grid->Recordset); // Set old record key
			} else {
				$Items_grid->loadRowValues(); // Load default values
				$Items_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$Items_grid->loadRowValues($Items_grid->Recordset); // Load row values
		}
		$Items->RowType = ROWTYPE_VIEW; // Render view
		if ($Items_grid->isGridAdd()) // Grid add
			$Items->RowType = ROWTYPE_ADD; // Render add
		if ($Items_grid->isGridAdd() && $Items->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$Items_grid->restoreCurrentRowFormValues($Items_grid->RowIndex); // Restore form values
		if ($Items_grid->isGridEdit()) { // Grid edit
			if ($Items->EventCancelled)
				$Items_grid->restoreCurrentRowFormValues($Items_grid->RowIndex); // Restore form values
			if ($Items_grid->RowAction == "insert")
				$Items->RowType = ROWTYPE_ADD; // Render add
			else
				$Items->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($Items_grid->isGridEdit() && ($Items->RowType == ROWTYPE_EDIT || $Items->RowType == ROWTYPE_ADD) && $Items->EventCancelled) // Update failed
			$Items_grid->restoreCurrentRowFormValues($Items_grid->RowIndex); // Restore form values
		if ($Items->RowType == ROWTYPE_EDIT) // Edit row
			$Items_grid->EditRowCount++;
		if ($Items->isConfirm()) // Confirm row
			$Items_grid->restoreCurrentRowFormValues($Items_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$Items->RowAttrs->merge(["data-rowindex" => $Items_grid->RowCount, "id" => "r" . $Items_grid->RowCount . "_Items", "data-rowtype" => $Items->RowType]);

		// Render row
		$Items_grid->renderRow();

		// Render list options
		$Items_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($Items_grid->RowAction != "delete" && $Items_grid->RowAction != "insertdelete" && !($Items_grid->RowAction == "insert" && $Items->isConfirm() && $Items_grid->emptyRow())) {
?>
	<tr <?php echo $Items->rowAttributes() ?>>
<?php

// Render list options (body, left)
$Items_grid->ListOptions->render("body", "left", $Items_grid->RowCount);
?>
	<?php if ($Items_grid->ID->Visible) { // ID ?>
		<td data-name="ID" <?php echo $Items_grid->ID->cellAttributes() ?>>
<?php if ($Items->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Items_grid->RowCount ?>_Items_ID" class="form-group"></span>
<input type="hidden" data-table="Items" data-field="x_ID" name="o<?php echo $Items_grid->RowIndex ?>_ID" id="o<?php echo $Items_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($Items_grid->ID->OldValue) ?>">
<?php } ?>
<?php if ($Items->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Items_grid->RowCount ?>_Items_ID" class="form-group">
<span<?php echo $Items_grid->ID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Items_grid->ID->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="Items" data-field="x_ID" name="x<?php echo $Items_grid->RowIndex ?>_ID" id="x<?php echo $Items_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($Items_grid->ID->CurrentValue) ?>">
<?php } ?>
<?php if ($Items->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Items_grid->RowCount ?>_Items_ID">
<span<?php echo $Items_grid->ID->viewAttributes() ?>><?php echo $Items_grid->ID->getViewValue() ?></span>
</span>
<?php if (!$Items->isConfirm()) { ?>
<input type="hidden" data-table="Items" data-field="x_ID" name="x<?php echo $Items_grid->RowIndex ?>_ID" id="x<?php echo $Items_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($Items_grid->ID->FormValue) ?>">
<input type="hidden" data-table="Items" data-field="x_ID" name="o<?php echo $Items_grid->RowIndex ?>_ID" id="o<?php echo $Items_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($Items_grid->ID->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="Items" data-field="x_ID" name="fItemsgrid$x<?php echo $Items_grid->RowIndex ?>_ID" id="fItemsgrid$x<?php echo $Items_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($Items_grid->ID->FormValue) ?>">
<input type="hidden" data-table="Items" data-field="x_ID" name="fItemsgrid$o<?php echo $Items_grid->RowIndex ?>_ID" id="fItemsgrid$o<?php echo $Items_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($Items_grid->ID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Items_grid->ID_Categorias->Visible) { // ID_Categorias ?>
		<td data-name="ID_Categorias" <?php echo $Items_grid->ID_Categorias->cellAttributes() ?>>
<?php if ($Items->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($Items_grid->ID_Categorias->getSessionValue() != "") { ?>
<span id="el<?php echo $Items_grid->RowCount ?>_Items_ID_Categorias" class="form-group">
<span<?php echo $Items_grid->ID_Categorias->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Items_grid->ID_Categorias->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $Items_grid->RowIndex ?>_ID_Categorias" name="x<?php echo $Items_grid->RowIndex ?>_ID_Categorias" value="<?php echo HtmlEncode($Items_grid->ID_Categorias->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $Items_grid->RowCount ?>_Items_ID_Categorias" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Items" data-field="x_ID_Categorias" data-value-separator="<?php echo $Items_grid->ID_Categorias->displayValueSeparatorAttribute() ?>" id="x<?php echo $Items_grid->RowIndex ?>_ID_Categorias" name="x<?php echo $Items_grid->RowIndex ?>_ID_Categorias"<?php echo $Items_grid->ID_Categorias->editAttributes() ?>>
			<?php echo $Items_grid->ID_Categorias->selectOptionListHtml("x{$Items_grid->RowIndex}_ID_Categorias") ?>
		</select>
</div>
<?php echo $Items_grid->ID_Categorias->Lookup->getParamTag($Items_grid, "p_x" . $Items_grid->RowIndex . "_ID_Categorias") ?>
</span>
<?php } ?>
<input type="hidden" data-table="Items" data-field="x_ID_Categorias" name="o<?php echo $Items_grid->RowIndex ?>_ID_Categorias" id="o<?php echo $Items_grid->RowIndex ?>_ID_Categorias" value="<?php echo HtmlEncode($Items_grid->ID_Categorias->OldValue) ?>">
<?php } ?>
<?php if ($Items->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($Items_grid->ID_Categorias->getSessionValue() != "") { ?>
<span id="el<?php echo $Items_grid->RowCount ?>_Items_ID_Categorias" class="form-group">
<span<?php echo $Items_grid->ID_Categorias->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Items_grid->ID_Categorias->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $Items_grid->RowIndex ?>_ID_Categorias" name="x<?php echo $Items_grid->RowIndex ?>_ID_Categorias" value="<?php echo HtmlEncode($Items_grid->ID_Categorias->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $Items_grid->RowCount ?>_Items_ID_Categorias" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Items" data-field="x_ID_Categorias" data-value-separator="<?php echo $Items_grid->ID_Categorias->displayValueSeparatorAttribute() ?>" id="x<?php echo $Items_grid->RowIndex ?>_ID_Categorias" name="x<?php echo $Items_grid->RowIndex ?>_ID_Categorias"<?php echo $Items_grid->ID_Categorias->editAttributes() ?>>
			<?php echo $Items_grid->ID_Categorias->selectOptionListHtml("x{$Items_grid->RowIndex}_ID_Categorias") ?>
		</select>
</div>
<?php echo $Items_grid->ID_Categorias->Lookup->getParamTag($Items_grid, "p_x" . $Items_grid->RowIndex . "_ID_Categorias") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($Items->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Items_grid->RowCount ?>_Items_ID_Categorias">
<span<?php echo $Items_grid->ID_Categorias->viewAttributes() ?>><?php echo $Items_grid->ID_Categorias->getViewValue() ?></span>
</span>
<?php if (!$Items->isConfirm()) { ?>
<input type="hidden" data-table="Items" data-field="x_ID_Categorias" name="x<?php echo $Items_grid->RowIndex ?>_ID_Categorias" id="x<?php echo $Items_grid->RowIndex ?>_ID_Categorias" value="<?php echo HtmlEncode($Items_grid->ID_Categorias->FormValue) ?>">
<input type="hidden" data-table="Items" data-field="x_ID_Categorias" name="o<?php echo $Items_grid->RowIndex ?>_ID_Categorias" id="o<?php echo $Items_grid->RowIndex ?>_ID_Categorias" value="<?php echo HtmlEncode($Items_grid->ID_Categorias->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="Items" data-field="x_ID_Categorias" name="fItemsgrid$x<?php echo $Items_grid->RowIndex ?>_ID_Categorias" id="fItemsgrid$x<?php echo $Items_grid->RowIndex ?>_ID_Categorias" value="<?php echo HtmlEncode($Items_grid->ID_Categorias->FormValue) ?>">
<input type="hidden" data-table="Items" data-field="x_ID_Categorias" name="fItemsgrid$o<?php echo $Items_grid->RowIndex ?>_ID_Categorias" id="fItemsgrid$o<?php echo $Items_grid->RowIndex ?>_ID_Categorias" value="<?php echo HtmlEncode($Items_grid->ID_Categorias->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Items_grid->ID_Restaurant->Visible) { // ID_Restaurant ?>
		<td data-name="ID_Restaurant" <?php echo $Items_grid->ID_Restaurant->cellAttributes() ?>>
<?php if ($Items->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn() && !$Items->userIDAllow("grid")) { // Non system admin ?>
<span id="el<?php echo $Items_grid->RowCount ?>_Items_ID_Restaurant" class="form-group">
<span<?php echo $Items_grid->ID_Restaurant->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Items_grid->ID_Restaurant->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="Items" data-field="x_ID_Restaurant" name="x<?php echo $Items_grid->RowIndex ?>_ID_Restaurant" id="x<?php echo $Items_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($Items_grid->ID_Restaurant->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $Items_grid->RowCount ?>_Items_ID_Restaurant" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Items" data-field="x_ID_Restaurant" data-value-separator="<?php echo $Items_grid->ID_Restaurant->displayValueSeparatorAttribute() ?>" id="x<?php echo $Items_grid->RowIndex ?>_ID_Restaurant" name="x<?php echo $Items_grid->RowIndex ?>_ID_Restaurant"<?php echo $Items_grid->ID_Restaurant->editAttributes() ?>>
			<?php echo $Items_grid->ID_Restaurant->selectOptionListHtml("x{$Items_grid->RowIndex}_ID_Restaurant") ?>
		</select>
</div>
<?php echo $Items_grid->ID_Restaurant->Lookup->getParamTag($Items_grid, "p_x" . $Items_grid->RowIndex . "_ID_Restaurant") ?>
</span>
<?php } ?>
<input type="hidden" data-table="Items" data-field="x_ID_Restaurant" name="o<?php echo $Items_grid->RowIndex ?>_ID_Restaurant" id="o<?php echo $Items_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($Items_grid->ID_Restaurant->OldValue) ?>">
<?php } ?>
<?php if ($Items->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn() && !$Items->userIDAllow("grid")) { // Non system admin ?>
<span id="el<?php echo $Items_grid->RowCount ?>_Items_ID_Restaurant" class="form-group">
<span<?php echo $Items_grid->ID_Restaurant->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Items_grid->ID_Restaurant->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="Items" data-field="x_ID_Restaurant" name="x<?php echo $Items_grid->RowIndex ?>_ID_Restaurant" id="x<?php echo $Items_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($Items_grid->ID_Restaurant->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $Items_grid->RowCount ?>_Items_ID_Restaurant" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Items" data-field="x_ID_Restaurant" data-value-separator="<?php echo $Items_grid->ID_Restaurant->displayValueSeparatorAttribute() ?>" id="x<?php echo $Items_grid->RowIndex ?>_ID_Restaurant" name="x<?php echo $Items_grid->RowIndex ?>_ID_Restaurant"<?php echo $Items_grid->ID_Restaurant->editAttributes() ?>>
			<?php echo $Items_grid->ID_Restaurant->selectOptionListHtml("x{$Items_grid->RowIndex}_ID_Restaurant") ?>
		</select>
</div>
<?php echo $Items_grid->ID_Restaurant->Lookup->getParamTag($Items_grid, "p_x" . $Items_grid->RowIndex . "_ID_Restaurant") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($Items->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Items_grid->RowCount ?>_Items_ID_Restaurant">
<span<?php echo $Items_grid->ID_Restaurant->viewAttributes() ?>><?php echo $Items_grid->ID_Restaurant->getViewValue() ?></span>
</span>
<?php if (!$Items->isConfirm()) { ?>
<input type="hidden" data-table="Items" data-field="x_ID_Restaurant" name="x<?php echo $Items_grid->RowIndex ?>_ID_Restaurant" id="x<?php echo $Items_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($Items_grid->ID_Restaurant->FormValue) ?>">
<input type="hidden" data-table="Items" data-field="x_ID_Restaurant" name="o<?php echo $Items_grid->RowIndex ?>_ID_Restaurant" id="o<?php echo $Items_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($Items_grid->ID_Restaurant->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="Items" data-field="x_ID_Restaurant" name="fItemsgrid$x<?php echo $Items_grid->RowIndex ?>_ID_Restaurant" id="fItemsgrid$x<?php echo $Items_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($Items_grid->ID_Restaurant->FormValue) ?>">
<input type="hidden" data-table="Items" data-field="x_ID_Restaurant" name="fItemsgrid$o<?php echo $Items_grid->RowIndex ?>_ID_Restaurant" id="fItemsgrid$o<?php echo $Items_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($Items_grid->ID_Restaurant->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Items_grid->Nombre->Visible) { // Nombre ?>
		<td data-name="Nombre" <?php echo $Items_grid->Nombre->cellAttributes() ?>>
<?php if ($Items->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Items_grid->RowCount ?>_Items_Nombre" class="form-group">
<input type="text" data-table="Items" data-field="x_Nombre" name="x<?php echo $Items_grid->RowIndex ?>_Nombre" id="x<?php echo $Items_grid->RowIndex ?>_Nombre" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Items_grid->Nombre->getPlaceHolder()) ?>" value="<?php echo $Items_grid->Nombre->EditValue ?>"<?php echo $Items_grid->Nombre->editAttributes() ?>>
</span>
<input type="hidden" data-table="Items" data-field="x_Nombre" name="o<?php echo $Items_grid->RowIndex ?>_Nombre" id="o<?php echo $Items_grid->RowIndex ?>_Nombre" value="<?php echo HtmlEncode($Items_grid->Nombre->OldValue) ?>">
<?php } ?>
<?php if ($Items->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Items_grid->RowCount ?>_Items_Nombre" class="form-group">
<input type="text" data-table="Items" data-field="x_Nombre" name="x<?php echo $Items_grid->RowIndex ?>_Nombre" id="x<?php echo $Items_grid->RowIndex ?>_Nombre" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Items_grid->Nombre->getPlaceHolder()) ?>" value="<?php echo $Items_grid->Nombre->EditValue ?>"<?php echo $Items_grid->Nombre->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($Items->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Items_grid->RowCount ?>_Items_Nombre">
<span<?php echo $Items_grid->Nombre->viewAttributes() ?>><?php echo $Items_grid->Nombre->getViewValue() ?></span>
</span>
<?php if (!$Items->isConfirm()) { ?>
<input type="hidden" data-table="Items" data-field="x_Nombre" name="x<?php echo $Items_grid->RowIndex ?>_Nombre" id="x<?php echo $Items_grid->RowIndex ?>_Nombre" value="<?php echo HtmlEncode($Items_grid->Nombre->FormValue) ?>">
<input type="hidden" data-table="Items" data-field="x_Nombre" name="o<?php echo $Items_grid->RowIndex ?>_Nombre" id="o<?php echo $Items_grid->RowIndex ?>_Nombre" value="<?php echo HtmlEncode($Items_grid->Nombre->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="Items" data-field="x_Nombre" name="fItemsgrid$x<?php echo $Items_grid->RowIndex ?>_Nombre" id="fItemsgrid$x<?php echo $Items_grid->RowIndex ?>_Nombre" value="<?php echo HtmlEncode($Items_grid->Nombre->FormValue) ?>">
<input type="hidden" data-table="Items" data-field="x_Nombre" name="fItemsgrid$o<?php echo $Items_grid->RowIndex ?>_Nombre" id="fItemsgrid$o<?php echo $Items_grid->RowIndex ?>_Nombre" value="<?php echo HtmlEncode($Items_grid->Nombre->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Items_grid->Precio->Visible) { // Precio ?>
		<td data-name="Precio" <?php echo $Items_grid->Precio->cellAttributes() ?>>
<?php if ($Items->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Items_grid->RowCount ?>_Items_Precio" class="form-group">
<input type="text" data-table="Items" data-field="x_Precio" name="x<?php echo $Items_grid->RowIndex ?>_Precio" id="x<?php echo $Items_grid->RowIndex ?>_Precio" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Items_grid->Precio->getPlaceHolder()) ?>" value="<?php echo $Items_grid->Precio->EditValue ?>"<?php echo $Items_grid->Precio->editAttributes() ?>>
</span>
<input type="hidden" data-table="Items" data-field="x_Precio" name="o<?php echo $Items_grid->RowIndex ?>_Precio" id="o<?php echo $Items_grid->RowIndex ?>_Precio" value="<?php echo HtmlEncode($Items_grid->Precio->OldValue) ?>">
<?php } ?>
<?php if ($Items->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Items_grid->RowCount ?>_Items_Precio" class="form-group">
<input type="text" data-table="Items" data-field="x_Precio" name="x<?php echo $Items_grid->RowIndex ?>_Precio" id="x<?php echo $Items_grid->RowIndex ?>_Precio" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Items_grid->Precio->getPlaceHolder()) ?>" value="<?php echo $Items_grid->Precio->EditValue ?>"<?php echo $Items_grid->Precio->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($Items->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Items_grid->RowCount ?>_Items_Precio">
<span<?php echo $Items_grid->Precio->viewAttributes() ?>><?php echo $Items_grid->Precio->getViewValue() ?></span>
</span>
<?php if (!$Items->isConfirm()) { ?>
<input type="hidden" data-table="Items" data-field="x_Precio" name="x<?php echo $Items_grid->RowIndex ?>_Precio" id="x<?php echo $Items_grid->RowIndex ?>_Precio" value="<?php echo HtmlEncode($Items_grid->Precio->FormValue) ?>">
<input type="hidden" data-table="Items" data-field="x_Precio" name="o<?php echo $Items_grid->RowIndex ?>_Precio" id="o<?php echo $Items_grid->RowIndex ?>_Precio" value="<?php echo HtmlEncode($Items_grid->Precio->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="Items" data-field="x_Precio" name="fItemsgrid$x<?php echo $Items_grid->RowIndex ?>_Precio" id="fItemsgrid$x<?php echo $Items_grid->RowIndex ?>_Precio" value="<?php echo HtmlEncode($Items_grid->Precio->FormValue) ?>">
<input type="hidden" data-table="Items" data-field="x_Precio" name="fItemsgrid$o<?php echo $Items_grid->RowIndex ?>_Precio" id="fItemsgrid$o<?php echo $Items_grid->RowIndex ?>_Precio" value="<?php echo HtmlEncode($Items_grid->Precio->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Items_grid->Active->Visible) { // Active ?>
		<td data-name="Active" <?php echo $Items_grid->Active->cellAttributes() ?>>
<?php if ($Items->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Items_grid->RowCount ?>_Items_Active" class="form-group">
<div id="tp_x<?php echo $Items_grid->RowIndex ?>_Active" class="ew-template"><input type="radio" class="custom-control-input" data-table="Items" data-field="x_Active" data-value-separator="<?php echo $Items_grid->Active->displayValueSeparatorAttribute() ?>" name="x<?php echo $Items_grid->RowIndex ?>_Active" id="x<?php echo $Items_grid->RowIndex ?>_Active" value="{value}"<?php echo $Items_grid->Active->editAttributes() ?>></div>
<div id="dsl_x<?php echo $Items_grid->RowIndex ?>_Active" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $Items_grid->Active->radioButtonListHtml(FALSE, "x{$Items_grid->RowIndex}_Active") ?>
</div></div>
</span>
<input type="hidden" data-table="Items" data-field="x_Active" name="o<?php echo $Items_grid->RowIndex ?>_Active" id="o<?php echo $Items_grid->RowIndex ?>_Active" value="<?php echo HtmlEncode($Items_grid->Active->OldValue) ?>">
<?php } ?>
<?php if ($Items->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Items_grid->RowCount ?>_Items_Active" class="form-group">
<div id="tp_x<?php echo $Items_grid->RowIndex ?>_Active" class="ew-template"><input type="radio" class="custom-control-input" data-table="Items" data-field="x_Active" data-value-separator="<?php echo $Items_grid->Active->displayValueSeparatorAttribute() ?>" name="x<?php echo $Items_grid->RowIndex ?>_Active" id="x<?php echo $Items_grid->RowIndex ?>_Active" value="{value}"<?php echo $Items_grid->Active->editAttributes() ?>></div>
<div id="dsl_x<?php echo $Items_grid->RowIndex ?>_Active" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $Items_grid->Active->radioButtonListHtml(FALSE, "x{$Items_grid->RowIndex}_Active") ?>
</div></div>
</span>
<?php } ?>
<?php if ($Items->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Items_grid->RowCount ?>_Items_Active">
<span<?php echo $Items_grid->Active->viewAttributes() ?>><?php echo $Items_grid->Active->getViewValue() ?></span>
</span>
<?php if (!$Items->isConfirm()) { ?>
<input type="hidden" data-table="Items" data-field="x_Active" name="x<?php echo $Items_grid->RowIndex ?>_Active" id="x<?php echo $Items_grid->RowIndex ?>_Active" value="<?php echo HtmlEncode($Items_grid->Active->FormValue) ?>">
<input type="hidden" data-table="Items" data-field="x_Active" name="o<?php echo $Items_grid->RowIndex ?>_Active" id="o<?php echo $Items_grid->RowIndex ?>_Active" value="<?php echo HtmlEncode($Items_grid->Active->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="Items" data-field="x_Active" name="fItemsgrid$x<?php echo $Items_grid->RowIndex ?>_Active" id="fItemsgrid$x<?php echo $Items_grid->RowIndex ?>_Active" value="<?php echo HtmlEncode($Items_grid->Active->FormValue) ?>">
<input type="hidden" data-table="Items" data-field="x_Active" name="fItemsgrid$o<?php echo $Items_grid->RowIndex ?>_Active" id="fItemsgrid$o<?php echo $Items_grid->RowIndex ?>_Active" value="<?php echo HtmlEncode($Items_grid->Active->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Items_grid->Stock->Visible) { // Stock ?>
		<td data-name="Stock" <?php echo $Items_grid->Stock->cellAttributes() ?>>
<?php if ($Items->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Items_grid->RowCount ?>_Items_Stock" class="form-group">
<input type="text" data-table="Items" data-field="x_Stock" name="x<?php echo $Items_grid->RowIndex ?>_Stock" id="x<?php echo $Items_grid->RowIndex ?>_Stock" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Items_grid->Stock->getPlaceHolder()) ?>" value="<?php echo $Items_grid->Stock->EditValue ?>"<?php echo $Items_grid->Stock->editAttributes() ?>>
</span>
<input type="hidden" data-table="Items" data-field="x_Stock" name="o<?php echo $Items_grid->RowIndex ?>_Stock" id="o<?php echo $Items_grid->RowIndex ?>_Stock" value="<?php echo HtmlEncode($Items_grid->Stock->OldValue) ?>">
<?php } ?>
<?php if ($Items->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Items_grid->RowCount ?>_Items_Stock" class="form-group">
<input type="text" data-table="Items" data-field="x_Stock" name="x<?php echo $Items_grid->RowIndex ?>_Stock" id="x<?php echo $Items_grid->RowIndex ?>_Stock" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Items_grid->Stock->getPlaceHolder()) ?>" value="<?php echo $Items_grid->Stock->EditValue ?>"<?php echo $Items_grid->Stock->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($Items->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Items_grid->RowCount ?>_Items_Stock">
<span<?php echo $Items_grid->Stock->viewAttributes() ?>><?php echo $Items_grid->Stock->getViewValue() ?></span>
</span>
<?php if (!$Items->isConfirm()) { ?>
<input type="hidden" data-table="Items" data-field="x_Stock" name="x<?php echo $Items_grid->RowIndex ?>_Stock" id="x<?php echo $Items_grid->RowIndex ?>_Stock" value="<?php echo HtmlEncode($Items_grid->Stock->FormValue) ?>">
<input type="hidden" data-table="Items" data-field="x_Stock" name="o<?php echo $Items_grid->RowIndex ?>_Stock" id="o<?php echo $Items_grid->RowIndex ?>_Stock" value="<?php echo HtmlEncode($Items_grid->Stock->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="Items" data-field="x_Stock" name="fItemsgrid$x<?php echo $Items_grid->RowIndex ?>_Stock" id="fItemsgrid$x<?php echo $Items_grid->RowIndex ?>_Stock" value="<?php echo HtmlEncode($Items_grid->Stock->FormValue) ?>">
<input type="hidden" data-table="Items" data-field="x_Stock" name="fItemsgrid$o<?php echo $Items_grid->RowIndex ?>_Stock" id="fItemsgrid$o<?php echo $Items_grid->RowIndex ?>_Stock" value="<?php echo HtmlEncode($Items_grid->Stock->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Items_grid->Img1->Visible) { // Img1 ?>
		<td data-name="Img1" <?php echo $Items_grid->Img1->cellAttributes() ?>>
<?php if ($Items_grid->RowAction == "insert") { // Add record ?>
<span id="el$rowindex$_Items_Img1" class="form-group Items_Img1">
<div id="fd_x<?php echo $Items_grid->RowIndex ?>_Img1">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $Items_grid->Img1->title() ?>" data-table="Items" data-field="x_Img1" name="x<?php echo $Items_grid->RowIndex ?>_Img1" id="x<?php echo $Items_grid->RowIndex ?>_Img1" lang="<?php echo CurrentLanguageID() ?>"<?php echo $Items_grid->Img1->editAttributes() ?><?php if ($Items_grid->Img1->ReadOnly || $Items_grid->Img1->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x<?php echo $Items_grid->RowIndex ?>_Img1"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x<?php echo $Items_grid->RowIndex ?>_Img1" id= "fn_x<?php echo $Items_grid->RowIndex ?>_Img1" value="<?php echo $Items_grid->Img1->Upload->FileName ?>">
<input type="hidden" name="fa_x<?php echo $Items_grid->RowIndex ?>_Img1" id= "fa_x<?php echo $Items_grid->RowIndex ?>_Img1" value="0">
<input type="hidden" name="fs_x<?php echo $Items_grid->RowIndex ?>_Img1" id= "fs_x<?php echo $Items_grid->RowIndex ?>_Img1" value="80">
<input type="hidden" name="fx_x<?php echo $Items_grid->RowIndex ?>_Img1" id= "fx_x<?php echo $Items_grid->RowIndex ?>_Img1" value="<?php echo $Items_grid->Img1->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $Items_grid->RowIndex ?>_Img1" id= "fm_x<?php echo $Items_grid->RowIndex ?>_Img1" value="<?php echo $Items_grid->Img1->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $Items_grid->RowIndex ?>_Img1" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<input type="hidden" data-table="Items" data-field="x_Img1" name="o<?php echo $Items_grid->RowIndex ?>_Img1" id="o<?php echo $Items_grid->RowIndex ?>_Img1" value="<?php echo HtmlEncode($Items_grid->Img1->OldValue) ?>">
<?php } elseif ($Items->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Items_grid->RowCount ?>_Items_Img1">
<span><?php echo GetFileViewTag($Items_grid->Img1, $Items_grid->Img1->getViewValue(), FALSE) ?></span>
</span>
<?php } else  { // Edit record ?>
<span id="el<?php echo $Items_grid->RowCount ?>_Items_Img1" class="form-group Items_Img1">
<div id="fd_x<?php echo $Items_grid->RowIndex ?>_Img1">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $Items_grid->Img1->title() ?>" data-table="Items" data-field="x_Img1" name="x<?php echo $Items_grid->RowIndex ?>_Img1" id="x<?php echo $Items_grid->RowIndex ?>_Img1" lang="<?php echo CurrentLanguageID() ?>"<?php echo $Items_grid->Img1->editAttributes() ?><?php if ($Items_grid->Img1->ReadOnly || $Items_grid->Img1->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x<?php echo $Items_grid->RowIndex ?>_Img1"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x<?php echo $Items_grid->RowIndex ?>_Img1" id= "fn_x<?php echo $Items_grid->RowIndex ?>_Img1" value="<?php echo $Items_grid->Img1->Upload->FileName ?>">
<input type="hidden" name="fa_x<?php echo $Items_grid->RowIndex ?>_Img1" id= "fa_x<?php echo $Items_grid->RowIndex ?>_Img1" value="<?php echo (Post("fa_x<?php echo $Items_grid->RowIndex ?>_Img1") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x<?php echo $Items_grid->RowIndex ?>_Img1" id= "fs_x<?php echo $Items_grid->RowIndex ?>_Img1" value="80">
<input type="hidden" name="fx_x<?php echo $Items_grid->RowIndex ?>_Img1" id= "fx_x<?php echo $Items_grid->RowIndex ?>_Img1" value="<?php echo $Items_grid->Img1->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $Items_grid->RowIndex ?>_Img1" id= "fm_x<?php echo $Items_grid->RowIndex ?>_Img1" value="<?php echo $Items_grid->Img1->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $Items_grid->RowIndex ?>_Img1" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$Items_grid->ListOptions->render("body", "right", $Items_grid->RowCount);
?>
	</tr>
<?php if ($Items->RowType == ROWTYPE_ADD || $Items->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fItemsgrid", "load"], function() {
	fItemsgrid.updateLists(<?php echo $Items_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$Items_grid->isGridAdd() || $Items->CurrentMode == "copy")
		if (!$Items_grid->Recordset->EOF)
			$Items_grid->Recordset->moveNext();
}
?>
<?php
	if ($Items->CurrentMode == "add" || $Items->CurrentMode == "copy" || $Items->CurrentMode == "edit") {
		$Items_grid->RowIndex = '$rowindex$';
		$Items_grid->loadRowValues();

		// Set row properties
		$Items->resetAttributes();
		$Items->RowAttrs->merge(["data-rowindex" => $Items_grid->RowIndex, "id" => "r0_Items", "data-rowtype" => ROWTYPE_ADD]);
		$Items->RowAttrs->appendClass("ew-template");
		$Items->RowType = ROWTYPE_ADD;

		// Render row
		$Items_grid->renderRow();

		// Render list options
		$Items_grid->renderListOptions();
		$Items_grid->StartRowCount = 0;
?>
	<tr <?php echo $Items->rowAttributes() ?>>
<?php

// Render list options (body, left)
$Items_grid->ListOptions->render("body", "left", $Items_grid->RowIndex);
?>
	<?php if ($Items_grid->ID->Visible) { // ID ?>
		<td data-name="ID">
<?php if (!$Items->isConfirm()) { ?>
<span id="el$rowindex$_Items_ID" class="form-group Items_ID"></span>
<?php } else { ?>
<span id="el$rowindex$_Items_ID" class="form-group Items_ID">
<span<?php echo $Items_grid->ID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Items_grid->ID->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="Items" data-field="x_ID" name="x<?php echo $Items_grid->RowIndex ?>_ID" id="x<?php echo $Items_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($Items_grid->ID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="Items" data-field="x_ID" name="o<?php echo $Items_grid->RowIndex ?>_ID" id="o<?php echo $Items_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($Items_grid->ID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Items_grid->ID_Categorias->Visible) { // ID_Categorias ?>
		<td data-name="ID_Categorias">
<?php if (!$Items->isConfirm()) { ?>
<?php if ($Items_grid->ID_Categorias->getSessionValue() != "") { ?>
<span id="el$rowindex$_Items_ID_Categorias" class="form-group Items_ID_Categorias">
<span<?php echo $Items_grid->ID_Categorias->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Items_grid->ID_Categorias->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $Items_grid->RowIndex ?>_ID_Categorias" name="x<?php echo $Items_grid->RowIndex ?>_ID_Categorias" value="<?php echo HtmlEncode($Items_grid->ID_Categorias->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_Items_ID_Categorias" class="form-group Items_ID_Categorias">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Items" data-field="x_ID_Categorias" data-value-separator="<?php echo $Items_grid->ID_Categorias->displayValueSeparatorAttribute() ?>" id="x<?php echo $Items_grid->RowIndex ?>_ID_Categorias" name="x<?php echo $Items_grid->RowIndex ?>_ID_Categorias"<?php echo $Items_grid->ID_Categorias->editAttributes() ?>>
			<?php echo $Items_grid->ID_Categorias->selectOptionListHtml("x{$Items_grid->RowIndex}_ID_Categorias") ?>
		</select>
</div>
<?php echo $Items_grid->ID_Categorias->Lookup->getParamTag($Items_grid, "p_x" . $Items_grid->RowIndex . "_ID_Categorias") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_Items_ID_Categorias" class="form-group Items_ID_Categorias">
<span<?php echo $Items_grid->ID_Categorias->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Items_grid->ID_Categorias->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="Items" data-field="x_ID_Categorias" name="x<?php echo $Items_grid->RowIndex ?>_ID_Categorias" id="x<?php echo $Items_grid->RowIndex ?>_ID_Categorias" value="<?php echo HtmlEncode($Items_grid->ID_Categorias->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="Items" data-field="x_ID_Categorias" name="o<?php echo $Items_grid->RowIndex ?>_ID_Categorias" id="o<?php echo $Items_grid->RowIndex ?>_ID_Categorias" value="<?php echo HtmlEncode($Items_grid->ID_Categorias->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Items_grid->ID_Restaurant->Visible) { // ID_Restaurant ?>
		<td data-name="ID_Restaurant">
<?php if (!$Items->isConfirm()) { ?>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn() && !$Items->userIDAllow("grid")) { // Non system admin ?>
<span id="el$rowindex$_Items_ID_Restaurant" class="form-group Items_ID_Restaurant">
<span<?php echo $Items_grid->ID_Restaurant->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Items_grid->ID_Restaurant->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="Items" data-field="x_ID_Restaurant" name="x<?php echo $Items_grid->RowIndex ?>_ID_Restaurant" id="x<?php echo $Items_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($Items_grid->ID_Restaurant->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_Items_ID_Restaurant" class="form-group Items_ID_Restaurant">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Items" data-field="x_ID_Restaurant" data-value-separator="<?php echo $Items_grid->ID_Restaurant->displayValueSeparatorAttribute() ?>" id="x<?php echo $Items_grid->RowIndex ?>_ID_Restaurant" name="x<?php echo $Items_grid->RowIndex ?>_ID_Restaurant"<?php echo $Items_grid->ID_Restaurant->editAttributes() ?>>
			<?php echo $Items_grid->ID_Restaurant->selectOptionListHtml("x{$Items_grid->RowIndex}_ID_Restaurant") ?>
		</select>
</div>
<?php echo $Items_grid->ID_Restaurant->Lookup->getParamTag($Items_grid, "p_x" . $Items_grid->RowIndex . "_ID_Restaurant") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_Items_ID_Restaurant" class="form-group Items_ID_Restaurant">
<span<?php echo $Items_grid->ID_Restaurant->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Items_grid->ID_Restaurant->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="Items" data-field="x_ID_Restaurant" name="x<?php echo $Items_grid->RowIndex ?>_ID_Restaurant" id="x<?php echo $Items_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($Items_grid->ID_Restaurant->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="Items" data-field="x_ID_Restaurant" name="o<?php echo $Items_grid->RowIndex ?>_ID_Restaurant" id="o<?php echo $Items_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($Items_grid->ID_Restaurant->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Items_grid->Nombre->Visible) { // Nombre ?>
		<td data-name="Nombre">
<?php if (!$Items->isConfirm()) { ?>
<span id="el$rowindex$_Items_Nombre" class="form-group Items_Nombre">
<input type="text" data-table="Items" data-field="x_Nombre" name="x<?php echo $Items_grid->RowIndex ?>_Nombre" id="x<?php echo $Items_grid->RowIndex ?>_Nombre" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Items_grid->Nombre->getPlaceHolder()) ?>" value="<?php echo $Items_grid->Nombre->EditValue ?>"<?php echo $Items_grid->Nombre->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_Items_Nombre" class="form-group Items_Nombre">
<span<?php echo $Items_grid->Nombre->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Items_grid->Nombre->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="Items" data-field="x_Nombre" name="x<?php echo $Items_grid->RowIndex ?>_Nombre" id="x<?php echo $Items_grid->RowIndex ?>_Nombre" value="<?php echo HtmlEncode($Items_grid->Nombre->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="Items" data-field="x_Nombre" name="o<?php echo $Items_grid->RowIndex ?>_Nombre" id="o<?php echo $Items_grid->RowIndex ?>_Nombre" value="<?php echo HtmlEncode($Items_grid->Nombre->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Items_grid->Precio->Visible) { // Precio ?>
		<td data-name="Precio">
<?php if (!$Items->isConfirm()) { ?>
<span id="el$rowindex$_Items_Precio" class="form-group Items_Precio">
<input type="text" data-table="Items" data-field="x_Precio" name="x<?php echo $Items_grid->RowIndex ?>_Precio" id="x<?php echo $Items_grid->RowIndex ?>_Precio" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Items_grid->Precio->getPlaceHolder()) ?>" value="<?php echo $Items_grid->Precio->EditValue ?>"<?php echo $Items_grid->Precio->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_Items_Precio" class="form-group Items_Precio">
<span<?php echo $Items_grid->Precio->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Items_grid->Precio->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="Items" data-field="x_Precio" name="x<?php echo $Items_grid->RowIndex ?>_Precio" id="x<?php echo $Items_grid->RowIndex ?>_Precio" value="<?php echo HtmlEncode($Items_grid->Precio->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="Items" data-field="x_Precio" name="o<?php echo $Items_grid->RowIndex ?>_Precio" id="o<?php echo $Items_grid->RowIndex ?>_Precio" value="<?php echo HtmlEncode($Items_grid->Precio->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Items_grid->Active->Visible) { // Active ?>
		<td data-name="Active">
<?php if (!$Items->isConfirm()) { ?>
<span id="el$rowindex$_Items_Active" class="form-group Items_Active">
<div id="tp_x<?php echo $Items_grid->RowIndex ?>_Active" class="ew-template"><input type="radio" class="custom-control-input" data-table="Items" data-field="x_Active" data-value-separator="<?php echo $Items_grid->Active->displayValueSeparatorAttribute() ?>" name="x<?php echo $Items_grid->RowIndex ?>_Active" id="x<?php echo $Items_grid->RowIndex ?>_Active" value="{value}"<?php echo $Items_grid->Active->editAttributes() ?>></div>
<div id="dsl_x<?php echo $Items_grid->RowIndex ?>_Active" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $Items_grid->Active->radioButtonListHtml(FALSE, "x{$Items_grid->RowIndex}_Active") ?>
</div></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_Items_Active" class="form-group Items_Active">
<span<?php echo $Items_grid->Active->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Items_grid->Active->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="Items" data-field="x_Active" name="x<?php echo $Items_grid->RowIndex ?>_Active" id="x<?php echo $Items_grid->RowIndex ?>_Active" value="<?php echo HtmlEncode($Items_grid->Active->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="Items" data-field="x_Active" name="o<?php echo $Items_grid->RowIndex ?>_Active" id="o<?php echo $Items_grid->RowIndex ?>_Active" value="<?php echo HtmlEncode($Items_grid->Active->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Items_grid->Stock->Visible) { // Stock ?>
		<td data-name="Stock">
<?php if (!$Items->isConfirm()) { ?>
<span id="el$rowindex$_Items_Stock" class="form-group Items_Stock">
<input type="text" data-table="Items" data-field="x_Stock" name="x<?php echo $Items_grid->RowIndex ?>_Stock" id="x<?php echo $Items_grid->RowIndex ?>_Stock" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Items_grid->Stock->getPlaceHolder()) ?>" value="<?php echo $Items_grid->Stock->EditValue ?>"<?php echo $Items_grid->Stock->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_Items_Stock" class="form-group Items_Stock">
<span<?php echo $Items_grid->Stock->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Items_grid->Stock->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="Items" data-field="x_Stock" name="x<?php echo $Items_grid->RowIndex ?>_Stock" id="x<?php echo $Items_grid->RowIndex ?>_Stock" value="<?php echo HtmlEncode($Items_grid->Stock->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="Items" data-field="x_Stock" name="o<?php echo $Items_grid->RowIndex ?>_Stock" id="o<?php echo $Items_grid->RowIndex ?>_Stock" value="<?php echo HtmlEncode($Items_grid->Stock->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Items_grid->Img1->Visible) { // Img1 ?>
		<td data-name="Img1">
<span id="el$rowindex$_Items_Img1" class="form-group Items_Img1">
<div id="fd_x<?php echo $Items_grid->RowIndex ?>_Img1">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $Items_grid->Img1->title() ?>" data-table="Items" data-field="x_Img1" name="x<?php echo $Items_grid->RowIndex ?>_Img1" id="x<?php echo $Items_grid->RowIndex ?>_Img1" lang="<?php echo CurrentLanguageID() ?>"<?php echo $Items_grid->Img1->editAttributes() ?><?php if ($Items_grid->Img1->ReadOnly || $Items_grid->Img1->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x<?php echo $Items_grid->RowIndex ?>_Img1"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x<?php echo $Items_grid->RowIndex ?>_Img1" id= "fn_x<?php echo $Items_grid->RowIndex ?>_Img1" value="<?php echo $Items_grid->Img1->Upload->FileName ?>">
<input type="hidden" name="fa_x<?php echo $Items_grid->RowIndex ?>_Img1" id= "fa_x<?php echo $Items_grid->RowIndex ?>_Img1" value="0">
<input type="hidden" name="fs_x<?php echo $Items_grid->RowIndex ?>_Img1" id= "fs_x<?php echo $Items_grid->RowIndex ?>_Img1" value="80">
<input type="hidden" name="fx_x<?php echo $Items_grid->RowIndex ?>_Img1" id= "fx_x<?php echo $Items_grid->RowIndex ?>_Img1" value="<?php echo $Items_grid->Img1->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $Items_grid->RowIndex ?>_Img1" id= "fm_x<?php echo $Items_grid->RowIndex ?>_Img1" value="<?php echo $Items_grid->Img1->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $Items_grid->RowIndex ?>_Img1" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<input type="hidden" data-table="Items" data-field="x_Img1" name="o<?php echo $Items_grid->RowIndex ?>_Img1" id="o<?php echo $Items_grid->RowIndex ?>_Img1" value="<?php echo HtmlEncode($Items_grid->Img1->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$Items_grid->ListOptions->render("body", "right", $Items_grid->RowIndex);
?>
<script>
loadjs.ready(["fItemsgrid", "load"], function() {
	fItemsgrid.updateLists(<?php echo $Items_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($Items->CurrentMode == "add" || $Items->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $Items_grid->FormKeyCountName ?>" id="<?php echo $Items_grid->FormKeyCountName ?>" value="<?php echo $Items_grid->KeyCount ?>">
<?php echo $Items_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($Items->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $Items_grid->FormKeyCountName ?>" id="<?php echo $Items_grid->FormKeyCountName ?>" value="<?php echo $Items_grid->KeyCount ?>">
<?php echo $Items_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($Items->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fItemsgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($Items_grid->Recordset)
	$Items_grid->Recordset->Close();
?>
<?php if ($Items_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $Items_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($Items_grid->TotalRecords == 0 && !$Items->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $Items_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$Items_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$Items_grid->terminate();
?>