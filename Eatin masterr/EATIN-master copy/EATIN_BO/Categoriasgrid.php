<?php
namespace PHPMaker2020\EATIN_BO;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($Categorias_grid))
	$Categorias_grid = new Categorias_grid();

// Run the page
$Categorias_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Categorias_grid->Page_Render();
?>
<?php if (!$Categorias_grid->isExport()) { ?>
<script>
var fCategoriasgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fCategoriasgrid = new ew.Form("fCategoriasgrid", "grid");
	fCategoriasgrid.formKeyCountName = '<?php echo $Categorias_grid->FormKeyCountName ?>';

	// Validate form
	fCategoriasgrid.validate = function() {
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
			<?php if ($Categorias_grid->ID->Required) { ?>
				elm = this.getElements("x" + infix + "_ID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Categorias_grid->ID->caption(), $Categorias_grid->ID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Categorias_grid->ID_Restaurant->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_Restaurant");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Categorias_grid->ID_Restaurant->caption(), $Categorias_grid->ID_Restaurant->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Categorias_grid->Active->Required) { ?>
				elm = this.getElements("x" + infix + "_Active");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Categorias_grid->Active->caption(), $Categorias_grid->Active->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Categorias_grid->Nombre->Required) { ?>
				elm = this.getElements("x" + infix + "_Nombre");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Categorias_grid->Nombre->caption(), $Categorias_grid->Nombre->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Categorias_grid->NombreEN->Required) { ?>
				elm = this.getElements("x" + infix + "_NombreEN");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Categorias_grid->NombreEN->caption(), $Categorias_grid->NombreEN->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fCategoriasgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "ID_Restaurant", false)) return false;
		if (ew.valueChanged(fobj, infix, "Active", false)) return false;
		if (ew.valueChanged(fobj, infix, "Nombre", false)) return false;
		if (ew.valueChanged(fobj, infix, "NombreEN", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fCategoriasgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fCategoriasgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fCategoriasgrid.lists["x_ID_Restaurant"] = <?php echo $Categorias_grid->ID_Restaurant->Lookup->toClientList($Categorias_grid) ?>;
	fCategoriasgrid.lists["x_ID_Restaurant"].options = <?php echo JsonEncode($Categorias_grid->ID_Restaurant->lookupOptions()) ?>;
	fCategoriasgrid.lists["x_Active"] = <?php echo $Categorias_grid->Active->Lookup->toClientList($Categorias_grid) ?>;
	fCategoriasgrid.lists["x_Active"].options = <?php echo JsonEncode($Categorias_grid->Active->options(FALSE, TRUE)) ?>;
	loadjs.done("fCategoriasgrid");
});
</script>
<?php } ?>
<?php
$Categorias_grid->renderOtherOptions();
?>
<?php if ($Categorias_grid->TotalRecords > 0 || $Categorias->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Categorias_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> Categorias">
<?php if ($Categorias_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $Categorias_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fCategoriasgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_Categorias" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_Categoriasgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$Categorias->RowType = ROWTYPE_HEADER;

// Render list options
$Categorias_grid->renderListOptions();

// Render list options (header, left)
$Categorias_grid->ListOptions->render("header", "left");
?>
<?php if ($Categorias_grid->ID->Visible) { // ID ?>
	<?php if ($Categorias_grid->SortUrl($Categorias_grid->ID) == "") { ?>
		<th data-name="ID" class="<?php echo $Categorias_grid->ID->headerCellClass() ?>"><div id="elh_Categorias_ID" class="Categorias_ID"><div class="ew-table-header-caption"><?php echo $Categorias_grid->ID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID" class="<?php echo $Categorias_grid->ID->headerCellClass() ?>"><div><div id="elh_Categorias_ID" class="Categorias_ID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Categorias_grid->ID->caption() ?></span><span class="ew-table-header-sort"><?php if ($Categorias_grid->ID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Categorias_grid->ID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Categorias_grid->ID_Restaurant->Visible) { // ID_Restaurant ?>
	<?php if ($Categorias_grid->SortUrl($Categorias_grid->ID_Restaurant) == "") { ?>
		<th data-name="ID_Restaurant" class="<?php echo $Categorias_grid->ID_Restaurant->headerCellClass() ?>"><div id="elh_Categorias_ID_Restaurant" class="Categorias_ID_Restaurant"><div class="ew-table-header-caption"><?php echo $Categorias_grid->ID_Restaurant->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Restaurant" class="<?php echo $Categorias_grid->ID_Restaurant->headerCellClass() ?>"><div><div id="elh_Categorias_ID_Restaurant" class="Categorias_ID_Restaurant">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Categorias_grid->ID_Restaurant->caption() ?></span><span class="ew-table-header-sort"><?php if ($Categorias_grid->ID_Restaurant->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Categorias_grid->ID_Restaurant->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Categorias_grid->Active->Visible) { // Active ?>
	<?php if ($Categorias_grid->SortUrl($Categorias_grid->Active) == "") { ?>
		<th data-name="Active" class="<?php echo $Categorias_grid->Active->headerCellClass() ?>"><div id="elh_Categorias_Active" class="Categorias_Active"><div class="ew-table-header-caption"><?php echo $Categorias_grid->Active->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Active" class="<?php echo $Categorias_grid->Active->headerCellClass() ?>"><div><div id="elh_Categorias_Active" class="Categorias_Active">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Categorias_grid->Active->caption() ?></span><span class="ew-table-header-sort"><?php if ($Categorias_grid->Active->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Categorias_grid->Active->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Categorias_grid->Nombre->Visible) { // Nombre ?>
	<?php if ($Categorias_grid->SortUrl($Categorias_grid->Nombre) == "") { ?>
		<th data-name="Nombre" class="<?php echo $Categorias_grid->Nombre->headerCellClass() ?>"><div id="elh_Categorias_Nombre" class="Categorias_Nombre"><div class="ew-table-header-caption"><?php echo $Categorias_grid->Nombre->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Nombre" class="<?php echo $Categorias_grid->Nombre->headerCellClass() ?>"><div><div id="elh_Categorias_Nombre" class="Categorias_Nombre">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Categorias_grid->Nombre->caption() ?></span><span class="ew-table-header-sort"><?php if ($Categorias_grid->Nombre->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Categorias_grid->Nombre->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Categorias_grid->NombreEN->Visible) { // NombreEN ?>
	<?php if ($Categorias_grid->SortUrl($Categorias_grid->NombreEN) == "") { ?>
		<th data-name="NombreEN" class="<?php echo $Categorias_grid->NombreEN->headerCellClass() ?>"><div id="elh_Categorias_NombreEN" class="Categorias_NombreEN"><div class="ew-table-header-caption"><?php echo $Categorias_grid->NombreEN->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NombreEN" class="<?php echo $Categorias_grid->NombreEN->headerCellClass() ?>"><div><div id="elh_Categorias_NombreEN" class="Categorias_NombreEN">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Categorias_grid->NombreEN->caption() ?></span><span class="ew-table-header-sort"><?php if ($Categorias_grid->NombreEN->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Categorias_grid->NombreEN->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$Categorias_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$Categorias_grid->StartRecord = 1;
$Categorias_grid->StopRecord = $Categorias_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($Categorias->isConfirm() || $Categorias_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($Categorias_grid->FormKeyCountName) && ($Categorias_grid->isGridAdd() || $Categorias_grid->isGridEdit() || $Categorias->isConfirm())) {
		$Categorias_grid->KeyCount = $CurrentForm->getValue($Categorias_grid->FormKeyCountName);
		$Categorias_grid->StopRecord = $Categorias_grid->StartRecord + $Categorias_grid->KeyCount - 1;
	}
}
$Categorias_grid->RecordCount = $Categorias_grid->StartRecord - 1;
if ($Categorias_grid->Recordset && !$Categorias_grid->Recordset->EOF) {
	$Categorias_grid->Recordset->moveFirst();
	$selectLimit = $Categorias_grid->UseSelectLimit;
	if (!$selectLimit && $Categorias_grid->StartRecord > 1)
		$Categorias_grid->Recordset->move($Categorias_grid->StartRecord - 1);
} elseif (!$Categorias->AllowAddDeleteRow && $Categorias_grid->StopRecord == 0) {
	$Categorias_grid->StopRecord = $Categorias->GridAddRowCount;
}

// Initialize aggregate
$Categorias->RowType = ROWTYPE_AGGREGATEINIT;
$Categorias->resetAttributes();
$Categorias_grid->renderRow();
if ($Categorias_grid->isGridAdd())
	$Categorias_grid->RowIndex = 0;
if ($Categorias_grid->isGridEdit())
	$Categorias_grid->RowIndex = 0;
while ($Categorias_grid->RecordCount < $Categorias_grid->StopRecord) {
	$Categorias_grid->RecordCount++;
	if ($Categorias_grid->RecordCount >= $Categorias_grid->StartRecord) {
		$Categorias_grid->RowCount++;
		if ($Categorias_grid->isGridAdd() || $Categorias_grid->isGridEdit() || $Categorias->isConfirm()) {
			$Categorias_grid->RowIndex++;
			$CurrentForm->Index = $Categorias_grid->RowIndex;
			if ($CurrentForm->hasValue($Categorias_grid->FormActionName) && ($Categorias->isConfirm() || $Categorias_grid->EventCancelled))
				$Categorias_grid->RowAction = strval($CurrentForm->getValue($Categorias_grid->FormActionName));
			elseif ($Categorias_grid->isGridAdd())
				$Categorias_grid->RowAction = "insert";
			else
				$Categorias_grid->RowAction = "";
		}

		// Set up key count
		$Categorias_grid->KeyCount = $Categorias_grid->RowIndex;

		// Init row class and style
		$Categorias->resetAttributes();
		$Categorias->CssClass = "";
		if ($Categorias_grid->isGridAdd()) {
			if ($Categorias->CurrentMode == "copy") {
				$Categorias_grid->loadRowValues($Categorias_grid->Recordset); // Load row values
				$Categorias_grid->setRecordKey($Categorias_grid->RowOldKey, $Categorias_grid->Recordset); // Set old record key
			} else {
				$Categorias_grid->loadRowValues(); // Load default values
				$Categorias_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$Categorias_grid->loadRowValues($Categorias_grid->Recordset); // Load row values
		}
		$Categorias->RowType = ROWTYPE_VIEW; // Render view
		if ($Categorias_grid->isGridAdd()) // Grid add
			$Categorias->RowType = ROWTYPE_ADD; // Render add
		if ($Categorias_grid->isGridAdd() && $Categorias->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$Categorias_grid->restoreCurrentRowFormValues($Categorias_grid->RowIndex); // Restore form values
		if ($Categorias_grid->isGridEdit()) { // Grid edit
			if ($Categorias->EventCancelled)
				$Categorias_grid->restoreCurrentRowFormValues($Categorias_grid->RowIndex); // Restore form values
			if ($Categorias_grid->RowAction == "insert")
				$Categorias->RowType = ROWTYPE_ADD; // Render add
			else
				$Categorias->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($Categorias_grid->isGridEdit() && ($Categorias->RowType == ROWTYPE_EDIT || $Categorias->RowType == ROWTYPE_ADD) && $Categorias->EventCancelled) // Update failed
			$Categorias_grid->restoreCurrentRowFormValues($Categorias_grid->RowIndex); // Restore form values
		if ($Categorias->RowType == ROWTYPE_EDIT) // Edit row
			$Categorias_grid->EditRowCount++;
		if ($Categorias->isConfirm()) // Confirm row
			$Categorias_grid->restoreCurrentRowFormValues($Categorias_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$Categorias->RowAttrs->merge(["data-rowindex" => $Categorias_grid->RowCount, "id" => "r" . $Categorias_grid->RowCount . "_Categorias", "data-rowtype" => $Categorias->RowType]);

		// Render row
		$Categorias_grid->renderRow();

		// Render list options
		$Categorias_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($Categorias_grid->RowAction != "delete" && $Categorias_grid->RowAction != "insertdelete" && !($Categorias_grid->RowAction == "insert" && $Categorias->isConfirm() && $Categorias_grid->emptyRow())) {
?>
	<tr <?php echo $Categorias->rowAttributes() ?>>
<?php

// Render list options (body, left)
$Categorias_grid->ListOptions->render("body", "left", $Categorias_grid->RowCount);
?>
	<?php if ($Categorias_grid->ID->Visible) { // ID ?>
		<td data-name="ID" <?php echo $Categorias_grid->ID->cellAttributes() ?>>
<?php if ($Categorias->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Categorias_grid->RowCount ?>_Categorias_ID" class="form-group"></span>
<input type="hidden" data-table="Categorias" data-field="x_ID" name="o<?php echo $Categorias_grid->RowIndex ?>_ID" id="o<?php echo $Categorias_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($Categorias_grid->ID->OldValue) ?>">
<?php } ?>
<?php if ($Categorias->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Categorias_grid->RowCount ?>_Categorias_ID" class="form-group">
<span<?php echo $Categorias_grid->ID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Categorias_grid->ID->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="Categorias" data-field="x_ID" name="x<?php echo $Categorias_grid->RowIndex ?>_ID" id="x<?php echo $Categorias_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($Categorias_grid->ID->CurrentValue) ?>">
<?php } ?>
<?php if ($Categorias->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Categorias_grid->RowCount ?>_Categorias_ID">
<span<?php echo $Categorias_grid->ID->viewAttributes() ?>><?php echo $Categorias_grid->ID->getViewValue() ?></span>
</span>
<?php if (!$Categorias->isConfirm()) { ?>
<input type="hidden" data-table="Categorias" data-field="x_ID" name="x<?php echo $Categorias_grid->RowIndex ?>_ID" id="x<?php echo $Categorias_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($Categorias_grid->ID->FormValue) ?>">
<input type="hidden" data-table="Categorias" data-field="x_ID" name="o<?php echo $Categorias_grid->RowIndex ?>_ID" id="o<?php echo $Categorias_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($Categorias_grid->ID->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="Categorias" data-field="x_ID" name="fCategoriasgrid$x<?php echo $Categorias_grid->RowIndex ?>_ID" id="fCategoriasgrid$x<?php echo $Categorias_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($Categorias_grid->ID->FormValue) ?>">
<input type="hidden" data-table="Categorias" data-field="x_ID" name="fCategoriasgrid$o<?php echo $Categorias_grid->RowIndex ?>_ID" id="fCategoriasgrid$o<?php echo $Categorias_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($Categorias_grid->ID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Categorias_grid->ID_Restaurant->Visible) { // ID_Restaurant ?>
		<td data-name="ID_Restaurant" <?php echo $Categorias_grid->ID_Restaurant->cellAttributes() ?>>
<?php if ($Categorias->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($Categorias_grid->ID_Restaurant->getSessionValue() != "") { ?>
<span id="el<?php echo $Categorias_grid->RowCount ?>_Categorias_ID_Restaurant" class="form-group">
<span<?php echo $Categorias_grid->ID_Restaurant->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Categorias_grid->ID_Restaurant->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $Categorias_grid->RowIndex ?>_ID_Restaurant" name="x<?php echo $Categorias_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($Categorias_grid->ID_Restaurant->CurrentValue) ?>">
<?php } elseif (!$Security->isAdmin() && $Security->isLoggedIn() && !$Categorias->userIDAllow("grid")) { // Non system admin ?>
<span id="el<?php echo $Categorias_grid->RowCount ?>_Categorias_ID_Restaurant" class="form-group">
<span<?php echo $Categorias_grid->ID_Restaurant->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Categorias_grid->ID_Restaurant->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="Categorias" data-field="x_ID_Restaurant" name="x<?php echo $Categorias_grid->RowIndex ?>_ID_Restaurant" id="x<?php echo $Categorias_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($Categorias_grid->ID_Restaurant->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $Categorias_grid->RowCount ?>_Categorias_ID_Restaurant" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Categorias" data-field="x_ID_Restaurant" data-value-separator="<?php echo $Categorias_grid->ID_Restaurant->displayValueSeparatorAttribute() ?>" id="x<?php echo $Categorias_grid->RowIndex ?>_ID_Restaurant" name="x<?php echo $Categorias_grid->RowIndex ?>_ID_Restaurant"<?php echo $Categorias_grid->ID_Restaurant->editAttributes() ?>>
			<?php echo $Categorias_grid->ID_Restaurant->selectOptionListHtml("x{$Categorias_grid->RowIndex}_ID_Restaurant") ?>
		</select>
</div>
<?php echo $Categorias_grid->ID_Restaurant->Lookup->getParamTag($Categorias_grid, "p_x" . $Categorias_grid->RowIndex . "_ID_Restaurant") ?>
</span>
<?php } ?>
<input type="hidden" data-table="Categorias" data-field="x_ID_Restaurant" name="o<?php echo $Categorias_grid->RowIndex ?>_ID_Restaurant" id="o<?php echo $Categorias_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($Categorias_grid->ID_Restaurant->OldValue) ?>">
<?php } ?>
<?php if ($Categorias->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($Categorias_grid->ID_Restaurant->getSessionValue() != "") { ?>
<span id="el<?php echo $Categorias_grid->RowCount ?>_Categorias_ID_Restaurant" class="form-group">
<span<?php echo $Categorias_grid->ID_Restaurant->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Categorias_grid->ID_Restaurant->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $Categorias_grid->RowIndex ?>_ID_Restaurant" name="x<?php echo $Categorias_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($Categorias_grid->ID_Restaurant->CurrentValue) ?>">
<?php } elseif (!$Security->isAdmin() && $Security->isLoggedIn() && !$Categorias->userIDAllow("grid")) { // Non system admin ?>
<span id="el<?php echo $Categorias_grid->RowCount ?>_Categorias_ID_Restaurant" class="form-group">
<span<?php echo $Categorias_grid->ID_Restaurant->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Categorias_grid->ID_Restaurant->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="Categorias" data-field="x_ID_Restaurant" name="x<?php echo $Categorias_grid->RowIndex ?>_ID_Restaurant" id="x<?php echo $Categorias_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($Categorias_grid->ID_Restaurant->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $Categorias_grid->RowCount ?>_Categorias_ID_Restaurant" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Categorias" data-field="x_ID_Restaurant" data-value-separator="<?php echo $Categorias_grid->ID_Restaurant->displayValueSeparatorAttribute() ?>" id="x<?php echo $Categorias_grid->RowIndex ?>_ID_Restaurant" name="x<?php echo $Categorias_grid->RowIndex ?>_ID_Restaurant"<?php echo $Categorias_grid->ID_Restaurant->editAttributes() ?>>
			<?php echo $Categorias_grid->ID_Restaurant->selectOptionListHtml("x{$Categorias_grid->RowIndex}_ID_Restaurant") ?>
		</select>
</div>
<?php echo $Categorias_grid->ID_Restaurant->Lookup->getParamTag($Categorias_grid, "p_x" . $Categorias_grid->RowIndex . "_ID_Restaurant") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($Categorias->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Categorias_grid->RowCount ?>_Categorias_ID_Restaurant">
<span<?php echo $Categorias_grid->ID_Restaurant->viewAttributes() ?>><?php echo $Categorias_grid->ID_Restaurant->getViewValue() ?></span>
</span>
<?php if (!$Categorias->isConfirm()) { ?>
<input type="hidden" data-table="Categorias" data-field="x_ID_Restaurant" name="x<?php echo $Categorias_grid->RowIndex ?>_ID_Restaurant" id="x<?php echo $Categorias_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($Categorias_grid->ID_Restaurant->FormValue) ?>">
<input type="hidden" data-table="Categorias" data-field="x_ID_Restaurant" name="o<?php echo $Categorias_grid->RowIndex ?>_ID_Restaurant" id="o<?php echo $Categorias_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($Categorias_grid->ID_Restaurant->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="Categorias" data-field="x_ID_Restaurant" name="fCategoriasgrid$x<?php echo $Categorias_grid->RowIndex ?>_ID_Restaurant" id="fCategoriasgrid$x<?php echo $Categorias_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($Categorias_grid->ID_Restaurant->FormValue) ?>">
<input type="hidden" data-table="Categorias" data-field="x_ID_Restaurant" name="fCategoriasgrid$o<?php echo $Categorias_grid->RowIndex ?>_ID_Restaurant" id="fCategoriasgrid$o<?php echo $Categorias_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($Categorias_grid->ID_Restaurant->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Categorias_grid->Active->Visible) { // Active ?>
		<td data-name="Active" <?php echo $Categorias_grid->Active->cellAttributes() ?>>
<?php if ($Categorias->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Categorias_grid->RowCount ?>_Categorias_Active" class="form-group">
<div id="tp_x<?php echo $Categorias_grid->RowIndex ?>_Active" class="ew-template"><input type="radio" class="custom-control-input" data-table="Categorias" data-field="x_Active" data-value-separator="<?php echo $Categorias_grid->Active->displayValueSeparatorAttribute() ?>" name="x<?php echo $Categorias_grid->RowIndex ?>_Active" id="x<?php echo $Categorias_grid->RowIndex ?>_Active" value="{value}"<?php echo $Categorias_grid->Active->editAttributes() ?>></div>
<div id="dsl_x<?php echo $Categorias_grid->RowIndex ?>_Active" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $Categorias_grid->Active->radioButtonListHtml(FALSE, "x{$Categorias_grid->RowIndex}_Active") ?>
</div></div>
</span>
<input type="hidden" data-table="Categorias" data-field="x_Active" name="o<?php echo $Categorias_grid->RowIndex ?>_Active" id="o<?php echo $Categorias_grid->RowIndex ?>_Active" value="<?php echo HtmlEncode($Categorias_grid->Active->OldValue) ?>">
<?php } ?>
<?php if ($Categorias->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Categorias_grid->RowCount ?>_Categorias_Active" class="form-group">
<div id="tp_x<?php echo $Categorias_grid->RowIndex ?>_Active" class="ew-template"><input type="radio" class="custom-control-input" data-table="Categorias" data-field="x_Active" data-value-separator="<?php echo $Categorias_grid->Active->displayValueSeparatorAttribute() ?>" name="x<?php echo $Categorias_grid->RowIndex ?>_Active" id="x<?php echo $Categorias_grid->RowIndex ?>_Active" value="{value}"<?php echo $Categorias_grid->Active->editAttributes() ?>></div>
<div id="dsl_x<?php echo $Categorias_grid->RowIndex ?>_Active" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $Categorias_grid->Active->radioButtonListHtml(FALSE, "x{$Categorias_grid->RowIndex}_Active") ?>
</div></div>
</span>
<?php } ?>
<?php if ($Categorias->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Categorias_grid->RowCount ?>_Categorias_Active">
<span<?php echo $Categorias_grid->Active->viewAttributes() ?>><?php echo $Categorias_grid->Active->getViewValue() ?></span>
</span>
<?php if (!$Categorias->isConfirm()) { ?>
<input type="hidden" data-table="Categorias" data-field="x_Active" name="x<?php echo $Categorias_grid->RowIndex ?>_Active" id="x<?php echo $Categorias_grid->RowIndex ?>_Active" value="<?php echo HtmlEncode($Categorias_grid->Active->FormValue) ?>">
<input type="hidden" data-table="Categorias" data-field="x_Active" name="o<?php echo $Categorias_grid->RowIndex ?>_Active" id="o<?php echo $Categorias_grid->RowIndex ?>_Active" value="<?php echo HtmlEncode($Categorias_grid->Active->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="Categorias" data-field="x_Active" name="fCategoriasgrid$x<?php echo $Categorias_grid->RowIndex ?>_Active" id="fCategoriasgrid$x<?php echo $Categorias_grid->RowIndex ?>_Active" value="<?php echo HtmlEncode($Categorias_grid->Active->FormValue) ?>">
<input type="hidden" data-table="Categorias" data-field="x_Active" name="fCategoriasgrid$o<?php echo $Categorias_grid->RowIndex ?>_Active" id="fCategoriasgrid$o<?php echo $Categorias_grid->RowIndex ?>_Active" value="<?php echo HtmlEncode($Categorias_grid->Active->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Categorias_grid->Nombre->Visible) { // Nombre ?>
		<td data-name="Nombre" <?php echo $Categorias_grid->Nombre->cellAttributes() ?>>
<?php if ($Categorias->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Categorias_grid->RowCount ?>_Categorias_Nombre" class="form-group">
<input type="text" data-table="Categorias" data-field="x_Nombre" name="x<?php echo $Categorias_grid->RowIndex ?>_Nombre" id="x<?php echo $Categorias_grid->RowIndex ?>_Nombre" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Categorias_grid->Nombre->getPlaceHolder()) ?>" value="<?php echo $Categorias_grid->Nombre->EditValue ?>"<?php echo $Categorias_grid->Nombre->editAttributes() ?>>
</span>
<input type="hidden" data-table="Categorias" data-field="x_Nombre" name="o<?php echo $Categorias_grid->RowIndex ?>_Nombre" id="o<?php echo $Categorias_grid->RowIndex ?>_Nombre" value="<?php echo HtmlEncode($Categorias_grid->Nombre->OldValue) ?>">
<?php } ?>
<?php if ($Categorias->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Categorias_grid->RowCount ?>_Categorias_Nombre" class="form-group">
<input type="text" data-table="Categorias" data-field="x_Nombre" name="x<?php echo $Categorias_grid->RowIndex ?>_Nombre" id="x<?php echo $Categorias_grid->RowIndex ?>_Nombre" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Categorias_grid->Nombre->getPlaceHolder()) ?>" value="<?php echo $Categorias_grid->Nombre->EditValue ?>"<?php echo $Categorias_grid->Nombre->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($Categorias->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Categorias_grid->RowCount ?>_Categorias_Nombre">
<span<?php echo $Categorias_grid->Nombre->viewAttributes() ?>><?php echo $Categorias_grid->Nombre->getViewValue() ?></span>
</span>
<?php if (!$Categorias->isConfirm()) { ?>
<input type="hidden" data-table="Categorias" data-field="x_Nombre" name="x<?php echo $Categorias_grid->RowIndex ?>_Nombre" id="x<?php echo $Categorias_grid->RowIndex ?>_Nombre" value="<?php echo HtmlEncode($Categorias_grid->Nombre->FormValue) ?>">
<input type="hidden" data-table="Categorias" data-field="x_Nombre" name="o<?php echo $Categorias_grid->RowIndex ?>_Nombre" id="o<?php echo $Categorias_grid->RowIndex ?>_Nombre" value="<?php echo HtmlEncode($Categorias_grid->Nombre->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="Categorias" data-field="x_Nombre" name="fCategoriasgrid$x<?php echo $Categorias_grid->RowIndex ?>_Nombre" id="fCategoriasgrid$x<?php echo $Categorias_grid->RowIndex ?>_Nombre" value="<?php echo HtmlEncode($Categorias_grid->Nombre->FormValue) ?>">
<input type="hidden" data-table="Categorias" data-field="x_Nombre" name="fCategoriasgrid$o<?php echo $Categorias_grid->RowIndex ?>_Nombre" id="fCategoriasgrid$o<?php echo $Categorias_grid->RowIndex ?>_Nombre" value="<?php echo HtmlEncode($Categorias_grid->Nombre->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Categorias_grid->NombreEN->Visible) { // NombreEN ?>
		<td data-name="NombreEN" <?php echo $Categorias_grid->NombreEN->cellAttributes() ?>>
<?php if ($Categorias->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Categorias_grid->RowCount ?>_Categorias_NombreEN" class="form-group">
<input type="text" data-table="Categorias" data-field="x_NombreEN" name="x<?php echo $Categorias_grid->RowIndex ?>_NombreEN" id="x<?php echo $Categorias_grid->RowIndex ?>_NombreEN" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Categorias_grid->NombreEN->getPlaceHolder()) ?>" value="<?php echo $Categorias_grid->NombreEN->EditValue ?>"<?php echo $Categorias_grid->NombreEN->editAttributes() ?>>
</span>
<input type="hidden" data-table="Categorias" data-field="x_NombreEN" name="o<?php echo $Categorias_grid->RowIndex ?>_NombreEN" id="o<?php echo $Categorias_grid->RowIndex ?>_NombreEN" value="<?php echo HtmlEncode($Categorias_grid->NombreEN->OldValue) ?>">
<?php } ?>
<?php if ($Categorias->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Categorias_grid->RowCount ?>_Categorias_NombreEN" class="form-group">
<input type="text" data-table="Categorias" data-field="x_NombreEN" name="x<?php echo $Categorias_grid->RowIndex ?>_NombreEN" id="x<?php echo $Categorias_grid->RowIndex ?>_NombreEN" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Categorias_grid->NombreEN->getPlaceHolder()) ?>" value="<?php echo $Categorias_grid->NombreEN->EditValue ?>"<?php echo $Categorias_grid->NombreEN->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($Categorias->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Categorias_grid->RowCount ?>_Categorias_NombreEN">
<span<?php echo $Categorias_grid->NombreEN->viewAttributes() ?>><?php echo $Categorias_grid->NombreEN->getViewValue() ?></span>
</span>
<?php if (!$Categorias->isConfirm()) { ?>
<input type="hidden" data-table="Categorias" data-field="x_NombreEN" name="x<?php echo $Categorias_grid->RowIndex ?>_NombreEN" id="x<?php echo $Categorias_grid->RowIndex ?>_NombreEN" value="<?php echo HtmlEncode($Categorias_grid->NombreEN->FormValue) ?>">
<input type="hidden" data-table="Categorias" data-field="x_NombreEN" name="o<?php echo $Categorias_grid->RowIndex ?>_NombreEN" id="o<?php echo $Categorias_grid->RowIndex ?>_NombreEN" value="<?php echo HtmlEncode($Categorias_grid->NombreEN->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="Categorias" data-field="x_NombreEN" name="fCategoriasgrid$x<?php echo $Categorias_grid->RowIndex ?>_NombreEN" id="fCategoriasgrid$x<?php echo $Categorias_grid->RowIndex ?>_NombreEN" value="<?php echo HtmlEncode($Categorias_grid->NombreEN->FormValue) ?>">
<input type="hidden" data-table="Categorias" data-field="x_NombreEN" name="fCategoriasgrid$o<?php echo $Categorias_grid->RowIndex ?>_NombreEN" id="fCategoriasgrid$o<?php echo $Categorias_grid->RowIndex ?>_NombreEN" value="<?php echo HtmlEncode($Categorias_grid->NombreEN->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$Categorias_grid->ListOptions->render("body", "right", $Categorias_grid->RowCount);
?>
	</tr>
<?php if ($Categorias->RowType == ROWTYPE_ADD || $Categorias->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fCategoriasgrid", "load"], function() {
	fCategoriasgrid.updateLists(<?php echo $Categorias_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$Categorias_grid->isGridAdd() || $Categorias->CurrentMode == "copy")
		if (!$Categorias_grid->Recordset->EOF)
			$Categorias_grid->Recordset->moveNext();
}
?>
<?php
	if ($Categorias->CurrentMode == "add" || $Categorias->CurrentMode == "copy" || $Categorias->CurrentMode == "edit") {
		$Categorias_grid->RowIndex = '$rowindex$';
		$Categorias_grid->loadRowValues();

		// Set row properties
		$Categorias->resetAttributes();
		$Categorias->RowAttrs->merge(["data-rowindex" => $Categorias_grid->RowIndex, "id" => "r0_Categorias", "data-rowtype" => ROWTYPE_ADD]);
		$Categorias->RowAttrs->appendClass("ew-template");
		$Categorias->RowType = ROWTYPE_ADD;

		// Render row
		$Categorias_grid->renderRow();

		// Render list options
		$Categorias_grid->renderListOptions();
		$Categorias_grid->StartRowCount = 0;
?>
	<tr <?php echo $Categorias->rowAttributes() ?>>
<?php

// Render list options (body, left)
$Categorias_grid->ListOptions->render("body", "left", $Categorias_grid->RowIndex);
?>
	<?php if ($Categorias_grid->ID->Visible) { // ID ?>
		<td data-name="ID">
<?php if (!$Categorias->isConfirm()) { ?>
<span id="el$rowindex$_Categorias_ID" class="form-group Categorias_ID"></span>
<?php } else { ?>
<span id="el$rowindex$_Categorias_ID" class="form-group Categorias_ID">
<span<?php echo $Categorias_grid->ID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Categorias_grid->ID->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="Categorias" data-field="x_ID" name="x<?php echo $Categorias_grid->RowIndex ?>_ID" id="x<?php echo $Categorias_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($Categorias_grid->ID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="Categorias" data-field="x_ID" name="o<?php echo $Categorias_grid->RowIndex ?>_ID" id="o<?php echo $Categorias_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($Categorias_grid->ID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Categorias_grid->ID_Restaurant->Visible) { // ID_Restaurant ?>
		<td data-name="ID_Restaurant">
<?php if (!$Categorias->isConfirm()) { ?>
<?php if ($Categorias_grid->ID_Restaurant->getSessionValue() != "") { ?>
<span id="el$rowindex$_Categorias_ID_Restaurant" class="form-group Categorias_ID_Restaurant">
<span<?php echo $Categorias_grid->ID_Restaurant->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Categorias_grid->ID_Restaurant->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $Categorias_grid->RowIndex ?>_ID_Restaurant" name="x<?php echo $Categorias_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($Categorias_grid->ID_Restaurant->CurrentValue) ?>">
<?php } elseif (!$Security->isAdmin() && $Security->isLoggedIn() && !$Categorias->userIDAllow("grid")) { // Non system admin ?>
<span id="el$rowindex$_Categorias_ID_Restaurant" class="form-group Categorias_ID_Restaurant">
<span<?php echo $Categorias_grid->ID_Restaurant->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Categorias_grid->ID_Restaurant->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="Categorias" data-field="x_ID_Restaurant" name="x<?php echo $Categorias_grid->RowIndex ?>_ID_Restaurant" id="x<?php echo $Categorias_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($Categorias_grid->ID_Restaurant->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_Categorias_ID_Restaurant" class="form-group Categorias_ID_Restaurant">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Categorias" data-field="x_ID_Restaurant" data-value-separator="<?php echo $Categorias_grid->ID_Restaurant->displayValueSeparatorAttribute() ?>" id="x<?php echo $Categorias_grid->RowIndex ?>_ID_Restaurant" name="x<?php echo $Categorias_grid->RowIndex ?>_ID_Restaurant"<?php echo $Categorias_grid->ID_Restaurant->editAttributes() ?>>
			<?php echo $Categorias_grid->ID_Restaurant->selectOptionListHtml("x{$Categorias_grid->RowIndex}_ID_Restaurant") ?>
		</select>
</div>
<?php echo $Categorias_grid->ID_Restaurant->Lookup->getParamTag($Categorias_grid, "p_x" . $Categorias_grid->RowIndex . "_ID_Restaurant") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_Categorias_ID_Restaurant" class="form-group Categorias_ID_Restaurant">
<span<?php echo $Categorias_grid->ID_Restaurant->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Categorias_grid->ID_Restaurant->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="Categorias" data-field="x_ID_Restaurant" name="x<?php echo $Categorias_grid->RowIndex ?>_ID_Restaurant" id="x<?php echo $Categorias_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($Categorias_grid->ID_Restaurant->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="Categorias" data-field="x_ID_Restaurant" name="o<?php echo $Categorias_grid->RowIndex ?>_ID_Restaurant" id="o<?php echo $Categorias_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($Categorias_grid->ID_Restaurant->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Categorias_grid->Active->Visible) { // Active ?>
		<td data-name="Active">
<?php if (!$Categorias->isConfirm()) { ?>
<span id="el$rowindex$_Categorias_Active" class="form-group Categorias_Active">
<div id="tp_x<?php echo $Categorias_grid->RowIndex ?>_Active" class="ew-template"><input type="radio" class="custom-control-input" data-table="Categorias" data-field="x_Active" data-value-separator="<?php echo $Categorias_grid->Active->displayValueSeparatorAttribute() ?>" name="x<?php echo $Categorias_grid->RowIndex ?>_Active" id="x<?php echo $Categorias_grid->RowIndex ?>_Active" value="{value}"<?php echo $Categorias_grid->Active->editAttributes() ?>></div>
<div id="dsl_x<?php echo $Categorias_grid->RowIndex ?>_Active" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $Categorias_grid->Active->radioButtonListHtml(FALSE, "x{$Categorias_grid->RowIndex}_Active") ?>
</div></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_Categorias_Active" class="form-group Categorias_Active">
<span<?php echo $Categorias_grid->Active->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Categorias_grid->Active->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="Categorias" data-field="x_Active" name="x<?php echo $Categorias_grid->RowIndex ?>_Active" id="x<?php echo $Categorias_grid->RowIndex ?>_Active" value="<?php echo HtmlEncode($Categorias_grid->Active->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="Categorias" data-field="x_Active" name="o<?php echo $Categorias_grid->RowIndex ?>_Active" id="o<?php echo $Categorias_grid->RowIndex ?>_Active" value="<?php echo HtmlEncode($Categorias_grid->Active->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Categorias_grid->Nombre->Visible) { // Nombre ?>
		<td data-name="Nombre">
<?php if (!$Categorias->isConfirm()) { ?>
<span id="el$rowindex$_Categorias_Nombre" class="form-group Categorias_Nombre">
<input type="text" data-table="Categorias" data-field="x_Nombre" name="x<?php echo $Categorias_grid->RowIndex ?>_Nombre" id="x<?php echo $Categorias_grid->RowIndex ?>_Nombre" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Categorias_grid->Nombre->getPlaceHolder()) ?>" value="<?php echo $Categorias_grid->Nombre->EditValue ?>"<?php echo $Categorias_grid->Nombre->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_Categorias_Nombre" class="form-group Categorias_Nombre">
<span<?php echo $Categorias_grid->Nombre->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Categorias_grid->Nombre->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="Categorias" data-field="x_Nombre" name="x<?php echo $Categorias_grid->RowIndex ?>_Nombre" id="x<?php echo $Categorias_grid->RowIndex ?>_Nombre" value="<?php echo HtmlEncode($Categorias_grid->Nombre->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="Categorias" data-field="x_Nombre" name="o<?php echo $Categorias_grid->RowIndex ?>_Nombre" id="o<?php echo $Categorias_grid->RowIndex ?>_Nombre" value="<?php echo HtmlEncode($Categorias_grid->Nombre->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Categorias_grid->NombreEN->Visible) { // NombreEN ?>
		<td data-name="NombreEN">
<?php if (!$Categorias->isConfirm()) { ?>
<span id="el$rowindex$_Categorias_NombreEN" class="form-group Categorias_NombreEN">
<input type="text" data-table="Categorias" data-field="x_NombreEN" name="x<?php echo $Categorias_grid->RowIndex ?>_NombreEN" id="x<?php echo $Categorias_grid->RowIndex ?>_NombreEN" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Categorias_grid->NombreEN->getPlaceHolder()) ?>" value="<?php echo $Categorias_grid->NombreEN->EditValue ?>"<?php echo $Categorias_grid->NombreEN->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_Categorias_NombreEN" class="form-group Categorias_NombreEN">
<span<?php echo $Categorias_grid->NombreEN->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Categorias_grid->NombreEN->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="Categorias" data-field="x_NombreEN" name="x<?php echo $Categorias_grid->RowIndex ?>_NombreEN" id="x<?php echo $Categorias_grid->RowIndex ?>_NombreEN" value="<?php echo HtmlEncode($Categorias_grid->NombreEN->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="Categorias" data-field="x_NombreEN" name="o<?php echo $Categorias_grid->RowIndex ?>_NombreEN" id="o<?php echo $Categorias_grid->RowIndex ?>_NombreEN" value="<?php echo HtmlEncode($Categorias_grid->NombreEN->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$Categorias_grid->ListOptions->render("body", "right", $Categorias_grid->RowIndex);
?>
<script>
loadjs.ready(["fCategoriasgrid", "load"], function() {
	fCategoriasgrid.updateLists(<?php echo $Categorias_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($Categorias->CurrentMode == "add" || $Categorias->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $Categorias_grid->FormKeyCountName ?>" id="<?php echo $Categorias_grid->FormKeyCountName ?>" value="<?php echo $Categorias_grid->KeyCount ?>">
<?php echo $Categorias_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($Categorias->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $Categorias_grid->FormKeyCountName ?>" id="<?php echo $Categorias_grid->FormKeyCountName ?>" value="<?php echo $Categorias_grid->KeyCount ?>">
<?php echo $Categorias_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($Categorias->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fCategoriasgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($Categorias_grid->Recordset)
	$Categorias_grid->Recordset->Close();
?>
<?php if ($Categorias_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $Categorias_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($Categorias_grid->TotalRecords == 0 && !$Categorias->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $Categorias_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$Categorias_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$Categorias_grid->terminate();
?>