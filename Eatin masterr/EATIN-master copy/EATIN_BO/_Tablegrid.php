<?php
namespace PHPMaker2020\EATIN_BO;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($_Table_grid))
	$_Table_grid = new _Table_grid();

// Run the page
$_Table_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$_Table_grid->Page_Render();
?>
<?php if (!$_Table_grid->isExport()) { ?>
<script>
var f_Tablegrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	f_Tablegrid = new ew.Form("f_Tablegrid", "grid");
	f_Tablegrid.formKeyCountName = '<?php echo $_Table_grid->FormKeyCountName ?>';

	// Validate form
	f_Tablegrid.validate = function() {
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
			<?php if ($_Table_grid->ID->Required) { ?>
				elm = this.getElements("x" + infix + "_ID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_Table_grid->ID->caption(), $_Table_grid->ID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($_Table_grid->ID_Restaurant->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_Restaurant");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_Table_grid->ID_Restaurant->caption(), $_Table_grid->ID_Restaurant->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($_Table_grid->QRCode->Required) { ?>
				elm = this.getElements("x" + infix + "_QRCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_Table_grid->QRCode->caption(), $_Table_grid->QRCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($_Table_grid->Numero->Required) { ?>
				elm = this.getElements("x" + infix + "_Numero");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_Table_grid->Numero->caption(), $_Table_grid->Numero->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Numero");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($_Table_grid->Numero->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	f_Tablegrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "ID_Restaurant", false)) return false;
		if (ew.valueChanged(fobj, infix, "QRCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "Numero", false)) return false;
		return true;
	}

	// Form_CustomValidate
	f_Tablegrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	f_Tablegrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	f_Tablegrid.lists["x_ID_Restaurant"] = <?php echo $_Table_grid->ID_Restaurant->Lookup->toClientList($_Table_grid) ?>;
	f_Tablegrid.lists["x_ID_Restaurant"].options = <?php echo JsonEncode($_Table_grid->ID_Restaurant->lookupOptions()) ?>;
	loadjs.done("f_Tablegrid");
});
</script>
<?php } ?>
<?php
$_Table_grid->renderOtherOptions();
?>
<?php if ($_Table_grid->TotalRecords > 0 || $_Table->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($_Table_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> _Table">
<?php if ($_Table_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $_Table_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="f_Tablegrid" class="ew-form ew-list-form form-inline">
<div id="gmp__Table" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl__Tablegrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$_Table->RowType = ROWTYPE_HEADER;

// Render list options
$_Table_grid->renderListOptions();

// Render list options (header, left)
$_Table_grid->ListOptions->render("header", "left");
?>
<?php if ($_Table_grid->ID->Visible) { // ID ?>
	<?php if ($_Table_grid->SortUrl($_Table_grid->ID) == "") { ?>
		<th data-name="ID" class="<?php echo $_Table_grid->ID->headerCellClass() ?>"><div id="elh__Table_ID" class="_Table_ID"><div class="ew-table-header-caption"><?php echo $_Table_grid->ID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID" class="<?php echo $_Table_grid->ID->headerCellClass() ?>"><div><div id="elh__Table_ID" class="_Table_ID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_Table_grid->ID->caption() ?></span><span class="ew-table-header-sort"><?php if ($_Table_grid->ID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_Table_grid->ID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_Table_grid->ID_Restaurant->Visible) { // ID_Restaurant ?>
	<?php if ($_Table_grid->SortUrl($_Table_grid->ID_Restaurant) == "") { ?>
		<th data-name="ID_Restaurant" class="<?php echo $_Table_grid->ID_Restaurant->headerCellClass() ?>"><div id="elh__Table_ID_Restaurant" class="_Table_ID_Restaurant"><div class="ew-table-header-caption"><?php echo $_Table_grid->ID_Restaurant->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Restaurant" class="<?php echo $_Table_grid->ID_Restaurant->headerCellClass() ?>"><div><div id="elh__Table_ID_Restaurant" class="_Table_ID_Restaurant">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_Table_grid->ID_Restaurant->caption() ?></span><span class="ew-table-header-sort"><?php if ($_Table_grid->ID_Restaurant->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_Table_grid->ID_Restaurant->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_Table_grid->QRCode->Visible) { // QRCode ?>
	<?php if ($_Table_grid->SortUrl($_Table_grid->QRCode) == "") { ?>
		<th data-name="QRCode" class="<?php echo $_Table_grid->QRCode->headerCellClass() ?>"><div id="elh__Table_QRCode" class="_Table_QRCode"><div class="ew-table-header-caption"><?php echo $_Table_grid->QRCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="QRCode" class="<?php echo $_Table_grid->QRCode->headerCellClass() ?>"><div><div id="elh__Table_QRCode" class="_Table_QRCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_Table_grid->QRCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($_Table_grid->QRCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_Table_grid->QRCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_Table_grid->Numero->Visible) { // Numero ?>
	<?php if ($_Table_grid->SortUrl($_Table_grid->Numero) == "") { ?>
		<th data-name="Numero" class="<?php echo $_Table_grid->Numero->headerCellClass() ?>"><div id="elh__Table_Numero" class="_Table_Numero"><div class="ew-table-header-caption"><?php echo $_Table_grid->Numero->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Numero" class="<?php echo $_Table_grid->Numero->headerCellClass() ?>"><div><div id="elh__Table_Numero" class="_Table_Numero">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_Table_grid->Numero->caption() ?></span><span class="ew-table-header-sort"><?php if ($_Table_grid->Numero->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_Table_grid->Numero->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$_Table_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$_Table_grid->StartRecord = 1;
$_Table_grid->StopRecord = $_Table_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($_Table->isConfirm() || $_Table_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($_Table_grid->FormKeyCountName) && ($_Table_grid->isGridAdd() || $_Table_grid->isGridEdit() || $_Table->isConfirm())) {
		$_Table_grid->KeyCount = $CurrentForm->getValue($_Table_grid->FormKeyCountName);
		$_Table_grid->StopRecord = $_Table_grid->StartRecord + $_Table_grid->KeyCount - 1;
	}
}
$_Table_grid->RecordCount = $_Table_grid->StartRecord - 1;
if ($_Table_grid->Recordset && !$_Table_grid->Recordset->EOF) {
	$_Table_grid->Recordset->moveFirst();
	$selectLimit = $_Table_grid->UseSelectLimit;
	if (!$selectLimit && $_Table_grid->StartRecord > 1)
		$_Table_grid->Recordset->move($_Table_grid->StartRecord - 1);
} elseif (!$_Table->AllowAddDeleteRow && $_Table_grid->StopRecord == 0) {
	$_Table_grid->StopRecord = $_Table->GridAddRowCount;
}

// Initialize aggregate
$_Table->RowType = ROWTYPE_AGGREGATEINIT;
$_Table->resetAttributes();
$_Table_grid->renderRow();
if ($_Table_grid->isGridAdd())
	$_Table_grid->RowIndex = 0;
if ($_Table_grid->isGridEdit())
	$_Table_grid->RowIndex = 0;
while ($_Table_grid->RecordCount < $_Table_grid->StopRecord) {
	$_Table_grid->RecordCount++;
	if ($_Table_grid->RecordCount >= $_Table_grid->StartRecord) {
		$_Table_grid->RowCount++;
		if ($_Table_grid->isGridAdd() || $_Table_grid->isGridEdit() || $_Table->isConfirm()) {
			$_Table_grid->RowIndex++;
			$CurrentForm->Index = $_Table_grid->RowIndex;
			if ($CurrentForm->hasValue($_Table_grid->FormActionName) && ($_Table->isConfirm() || $_Table_grid->EventCancelled))
				$_Table_grid->RowAction = strval($CurrentForm->getValue($_Table_grid->FormActionName));
			elseif ($_Table_grid->isGridAdd())
				$_Table_grid->RowAction = "insert";
			else
				$_Table_grid->RowAction = "";
		}

		// Set up key count
		$_Table_grid->KeyCount = $_Table_grid->RowIndex;

		// Init row class and style
		$_Table->resetAttributes();
		$_Table->CssClass = "";
		if ($_Table_grid->isGridAdd()) {
			if ($_Table->CurrentMode == "copy") {
				$_Table_grid->loadRowValues($_Table_grid->Recordset); // Load row values
				$_Table_grid->setRecordKey($_Table_grid->RowOldKey, $_Table_grid->Recordset); // Set old record key
			} else {
				$_Table_grid->loadRowValues(); // Load default values
				$_Table_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$_Table_grid->loadRowValues($_Table_grid->Recordset); // Load row values
		}
		$_Table->RowType = ROWTYPE_VIEW; // Render view
		if ($_Table_grid->isGridAdd()) // Grid add
			$_Table->RowType = ROWTYPE_ADD; // Render add
		if ($_Table_grid->isGridAdd() && $_Table->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$_Table_grid->restoreCurrentRowFormValues($_Table_grid->RowIndex); // Restore form values
		if ($_Table_grid->isGridEdit()) { // Grid edit
			if ($_Table->EventCancelled)
				$_Table_grid->restoreCurrentRowFormValues($_Table_grid->RowIndex); // Restore form values
			if ($_Table_grid->RowAction == "insert")
				$_Table->RowType = ROWTYPE_ADD; // Render add
			else
				$_Table->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($_Table_grid->isGridEdit() && ($_Table->RowType == ROWTYPE_EDIT || $_Table->RowType == ROWTYPE_ADD) && $_Table->EventCancelled) // Update failed
			$_Table_grid->restoreCurrentRowFormValues($_Table_grid->RowIndex); // Restore form values
		if ($_Table->RowType == ROWTYPE_EDIT) // Edit row
			$_Table_grid->EditRowCount++;
		if ($_Table->isConfirm()) // Confirm row
			$_Table_grid->restoreCurrentRowFormValues($_Table_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$_Table->RowAttrs->merge(["data-rowindex" => $_Table_grid->RowCount, "id" => "r" . $_Table_grid->RowCount . "__Table", "data-rowtype" => $_Table->RowType]);

		// Render row
		$_Table_grid->renderRow();

		// Render list options
		$_Table_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($_Table_grid->RowAction != "delete" && $_Table_grid->RowAction != "insertdelete" && !($_Table_grid->RowAction == "insert" && $_Table->isConfirm() && $_Table_grid->emptyRow())) {
?>
	<tr <?php echo $_Table->rowAttributes() ?>>
<?php

// Render list options (body, left)
$_Table_grid->ListOptions->render("body", "left", $_Table_grid->RowCount);
?>
	<?php if ($_Table_grid->ID->Visible) { // ID ?>
		<td data-name="ID" <?php echo $_Table_grid->ID->cellAttributes() ?>>
<?php if ($_Table->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $_Table_grid->RowCount ?>__Table_ID" class="form-group"></span>
<input type="hidden" data-table="_Table" data-field="x_ID" name="o<?php echo $_Table_grid->RowIndex ?>_ID" id="o<?php echo $_Table_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($_Table_grid->ID->OldValue) ?>">
<?php } ?>
<?php if ($_Table->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $_Table_grid->RowCount ?>__Table_ID" class="form-group">
<span<?php echo $_Table_grid->ID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_Table_grid->ID->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="_Table" data-field="x_ID" name="x<?php echo $_Table_grid->RowIndex ?>_ID" id="x<?php echo $_Table_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($_Table_grid->ID->CurrentValue) ?>">
<?php } ?>
<?php if ($_Table->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $_Table_grid->RowCount ?>__Table_ID">
<span<?php echo $_Table_grid->ID->viewAttributes() ?>><?php echo $_Table_grid->ID->getViewValue() ?></span>
</span>
<?php if (!$_Table->isConfirm()) { ?>
<input type="hidden" data-table="_Table" data-field="x_ID" name="x<?php echo $_Table_grid->RowIndex ?>_ID" id="x<?php echo $_Table_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($_Table_grid->ID->FormValue) ?>">
<input type="hidden" data-table="_Table" data-field="x_ID" name="o<?php echo $_Table_grid->RowIndex ?>_ID" id="o<?php echo $_Table_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($_Table_grid->ID->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="_Table" data-field="x_ID" name="f_Tablegrid$x<?php echo $_Table_grid->RowIndex ?>_ID" id="f_Tablegrid$x<?php echo $_Table_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($_Table_grid->ID->FormValue) ?>">
<input type="hidden" data-table="_Table" data-field="x_ID" name="f_Tablegrid$o<?php echo $_Table_grid->RowIndex ?>_ID" id="f_Tablegrid$o<?php echo $_Table_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($_Table_grid->ID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($_Table_grid->ID_Restaurant->Visible) { // ID_Restaurant ?>
		<td data-name="ID_Restaurant" <?php echo $_Table_grid->ID_Restaurant->cellAttributes() ?>>
<?php if ($_Table->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($_Table_grid->ID_Restaurant->getSessionValue() != "") { ?>
<span id="el<?php echo $_Table_grid->RowCount ?>__Table_ID_Restaurant" class="form-group">
<span<?php echo $_Table_grid->ID_Restaurant->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_Table_grid->ID_Restaurant->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $_Table_grid->RowIndex ?>_ID_Restaurant" name="x<?php echo $_Table_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($_Table_grid->ID_Restaurant->CurrentValue) ?>">
<?php } elseif (!$Security->isAdmin() && $Security->isLoggedIn() && !$_Table->userIDAllow("grid")) { // Non system admin ?>
<span id="el<?php echo $_Table_grid->RowCount ?>__Table_ID_Restaurant" class="form-group">
<span<?php echo $_Table_grid->ID_Restaurant->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_Table_grid->ID_Restaurant->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="_Table" data-field="x_ID_Restaurant" name="x<?php echo $_Table_grid->RowIndex ?>_ID_Restaurant" id="x<?php echo $_Table_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($_Table_grid->ID_Restaurant->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $_Table_grid->RowCount ?>__Table_ID_Restaurant" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="_Table" data-field="x_ID_Restaurant" data-value-separator="<?php echo $_Table_grid->ID_Restaurant->displayValueSeparatorAttribute() ?>" id="x<?php echo $_Table_grid->RowIndex ?>_ID_Restaurant" name="x<?php echo $_Table_grid->RowIndex ?>_ID_Restaurant"<?php echo $_Table_grid->ID_Restaurant->editAttributes() ?>>
			<?php echo $_Table_grid->ID_Restaurant->selectOptionListHtml("x{$_Table_grid->RowIndex}_ID_Restaurant") ?>
		</select>
</div>
<?php echo $_Table_grid->ID_Restaurant->Lookup->getParamTag($_Table_grid, "p_x" . $_Table_grid->RowIndex . "_ID_Restaurant") ?>
</span>
<?php } ?>
<input type="hidden" data-table="_Table" data-field="x_ID_Restaurant" name="o<?php echo $_Table_grid->RowIndex ?>_ID_Restaurant" id="o<?php echo $_Table_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($_Table_grid->ID_Restaurant->OldValue) ?>">
<?php } ?>
<?php if ($_Table->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($_Table_grid->ID_Restaurant->getSessionValue() != "") { ?>
<span id="el<?php echo $_Table_grid->RowCount ?>__Table_ID_Restaurant" class="form-group">
<span<?php echo $_Table_grid->ID_Restaurant->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_Table_grid->ID_Restaurant->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $_Table_grid->RowIndex ?>_ID_Restaurant" name="x<?php echo $_Table_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($_Table_grid->ID_Restaurant->CurrentValue) ?>">
<?php } elseif (!$Security->isAdmin() && $Security->isLoggedIn() && !$_Table->userIDAllow("grid")) { // Non system admin ?>
<span id="el<?php echo $_Table_grid->RowCount ?>__Table_ID_Restaurant" class="form-group">
<span<?php echo $_Table_grid->ID_Restaurant->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_Table_grid->ID_Restaurant->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="_Table" data-field="x_ID_Restaurant" name="x<?php echo $_Table_grid->RowIndex ?>_ID_Restaurant" id="x<?php echo $_Table_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($_Table_grid->ID_Restaurant->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $_Table_grid->RowCount ?>__Table_ID_Restaurant" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="_Table" data-field="x_ID_Restaurant" data-value-separator="<?php echo $_Table_grid->ID_Restaurant->displayValueSeparatorAttribute() ?>" id="x<?php echo $_Table_grid->RowIndex ?>_ID_Restaurant" name="x<?php echo $_Table_grid->RowIndex ?>_ID_Restaurant"<?php echo $_Table_grid->ID_Restaurant->editAttributes() ?>>
			<?php echo $_Table_grid->ID_Restaurant->selectOptionListHtml("x{$_Table_grid->RowIndex}_ID_Restaurant") ?>
		</select>
</div>
<?php echo $_Table_grid->ID_Restaurant->Lookup->getParamTag($_Table_grid, "p_x" . $_Table_grid->RowIndex . "_ID_Restaurant") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($_Table->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $_Table_grid->RowCount ?>__Table_ID_Restaurant">
<span<?php echo $_Table_grid->ID_Restaurant->viewAttributes() ?>><?php echo $_Table_grid->ID_Restaurant->getViewValue() ?></span>
</span>
<?php if (!$_Table->isConfirm()) { ?>
<input type="hidden" data-table="_Table" data-field="x_ID_Restaurant" name="x<?php echo $_Table_grid->RowIndex ?>_ID_Restaurant" id="x<?php echo $_Table_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($_Table_grid->ID_Restaurant->FormValue) ?>">
<input type="hidden" data-table="_Table" data-field="x_ID_Restaurant" name="o<?php echo $_Table_grid->RowIndex ?>_ID_Restaurant" id="o<?php echo $_Table_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($_Table_grid->ID_Restaurant->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="_Table" data-field="x_ID_Restaurant" name="f_Tablegrid$x<?php echo $_Table_grid->RowIndex ?>_ID_Restaurant" id="f_Tablegrid$x<?php echo $_Table_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($_Table_grid->ID_Restaurant->FormValue) ?>">
<input type="hidden" data-table="_Table" data-field="x_ID_Restaurant" name="f_Tablegrid$o<?php echo $_Table_grid->RowIndex ?>_ID_Restaurant" id="f_Tablegrid$o<?php echo $_Table_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($_Table_grid->ID_Restaurant->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($_Table_grid->QRCode->Visible) { // QRCode ?>
		<td data-name="QRCode" <?php echo $_Table_grid->QRCode->cellAttributes() ?>>
<?php if ($_Table->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $_Table_grid->RowCount ?>__Table_QRCode" class="form-group">
<input type="text" data-table="_Table" data-field="x_QRCode" name="x<?php echo $_Table_grid->RowIndex ?>_QRCode" id="x<?php echo $_Table_grid->RowIndex ?>_QRCode" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($_Table_grid->QRCode->getPlaceHolder()) ?>" value="<?php echo $_Table_grid->QRCode->EditValue ?>"<?php echo $_Table_grid->QRCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="_Table" data-field="x_QRCode" name="o<?php echo $_Table_grid->RowIndex ?>_QRCode" id="o<?php echo $_Table_grid->RowIndex ?>_QRCode" value="<?php echo HtmlEncode($_Table_grid->QRCode->OldValue) ?>">
<?php } ?>
<?php if ($_Table->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $_Table_grid->RowCount ?>__Table_QRCode" class="form-group">
<span<?php echo $_Table_grid->QRCode->viewAttributes() ?>><?php if (!EmptyString($_Table_grid->QRCode->EditValue) && $_Table_grid->QRCode->linkAttributes() != "") { ?>
<a<?php echo $_Table_grid->QRCode->linkAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_Table_grid->QRCode->EditValue)) ?>"></a>
<?php } else { ?>
<input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_Table_grid->QRCode->EditValue)) ?>">
<?php } ?></span>
</span>
<input type="hidden" data-table="_Table" data-field="x_QRCode" name="x<?php echo $_Table_grid->RowIndex ?>_QRCode" id="x<?php echo $_Table_grid->RowIndex ?>_QRCode" value="<?php echo HtmlEncode($_Table_grid->QRCode->CurrentValue) ?>">
<?php } ?>
<?php if ($_Table->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $_Table_grid->RowCount ?>__Table_QRCode">
<span<?php echo $_Table_grid->QRCode->viewAttributes() ?>><?php if (!EmptyString($_Table_grid->QRCode->getViewValue()) && $_Table_grid->QRCode->linkAttributes() != "") { ?>
<a<?php echo $_Table_grid->QRCode->linkAttributes() ?>><?php echo $_Table_grid->QRCode->getViewValue() ?></a>
<?php } else { ?>
<?php echo $_Table_grid->QRCode->getViewValue() ?>
<?php } ?></span>
</span>
<?php if (!$_Table->isConfirm()) { ?>
<input type="hidden" data-table="_Table" data-field="x_QRCode" name="x<?php echo $_Table_grid->RowIndex ?>_QRCode" id="x<?php echo $_Table_grid->RowIndex ?>_QRCode" value="<?php echo HtmlEncode($_Table_grid->QRCode->FormValue) ?>">
<input type="hidden" data-table="_Table" data-field="x_QRCode" name="o<?php echo $_Table_grid->RowIndex ?>_QRCode" id="o<?php echo $_Table_grid->RowIndex ?>_QRCode" value="<?php echo HtmlEncode($_Table_grid->QRCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="_Table" data-field="x_QRCode" name="f_Tablegrid$x<?php echo $_Table_grid->RowIndex ?>_QRCode" id="f_Tablegrid$x<?php echo $_Table_grid->RowIndex ?>_QRCode" value="<?php echo HtmlEncode($_Table_grid->QRCode->FormValue) ?>">
<input type="hidden" data-table="_Table" data-field="x_QRCode" name="f_Tablegrid$o<?php echo $_Table_grid->RowIndex ?>_QRCode" id="f_Tablegrid$o<?php echo $_Table_grid->RowIndex ?>_QRCode" value="<?php echo HtmlEncode($_Table_grid->QRCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($_Table_grid->Numero->Visible) { // Numero ?>
		<td data-name="Numero" <?php echo $_Table_grid->Numero->cellAttributes() ?>>
<?php if ($_Table->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $_Table_grid->RowCount ?>__Table_Numero" class="form-group">
<input type="text" data-table="_Table" data-field="x_Numero" name="x<?php echo $_Table_grid->RowIndex ?>_Numero" id="x<?php echo $_Table_grid->RowIndex ?>_Numero" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($_Table_grid->Numero->getPlaceHolder()) ?>" value="<?php echo $_Table_grid->Numero->EditValue ?>"<?php echo $_Table_grid->Numero->editAttributes() ?>>
</span>
<input type="hidden" data-table="_Table" data-field="x_Numero" name="o<?php echo $_Table_grid->RowIndex ?>_Numero" id="o<?php echo $_Table_grid->RowIndex ?>_Numero" value="<?php echo HtmlEncode($_Table_grid->Numero->OldValue) ?>">
<?php } ?>
<?php if ($_Table->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $_Table_grid->RowCount ?>__Table_Numero" class="form-group">
<input type="text" data-table="_Table" data-field="x_Numero" name="x<?php echo $_Table_grid->RowIndex ?>_Numero" id="x<?php echo $_Table_grid->RowIndex ?>_Numero" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($_Table_grid->Numero->getPlaceHolder()) ?>" value="<?php echo $_Table_grid->Numero->EditValue ?>"<?php echo $_Table_grid->Numero->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($_Table->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $_Table_grid->RowCount ?>__Table_Numero">
<span<?php echo $_Table_grid->Numero->viewAttributes() ?>><?php echo $_Table_grid->Numero->getViewValue() ?></span>
</span>
<?php if (!$_Table->isConfirm()) { ?>
<input type="hidden" data-table="_Table" data-field="x_Numero" name="x<?php echo $_Table_grid->RowIndex ?>_Numero" id="x<?php echo $_Table_grid->RowIndex ?>_Numero" value="<?php echo HtmlEncode($_Table_grid->Numero->FormValue) ?>">
<input type="hidden" data-table="_Table" data-field="x_Numero" name="o<?php echo $_Table_grid->RowIndex ?>_Numero" id="o<?php echo $_Table_grid->RowIndex ?>_Numero" value="<?php echo HtmlEncode($_Table_grid->Numero->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="_Table" data-field="x_Numero" name="f_Tablegrid$x<?php echo $_Table_grid->RowIndex ?>_Numero" id="f_Tablegrid$x<?php echo $_Table_grid->RowIndex ?>_Numero" value="<?php echo HtmlEncode($_Table_grid->Numero->FormValue) ?>">
<input type="hidden" data-table="_Table" data-field="x_Numero" name="f_Tablegrid$o<?php echo $_Table_grid->RowIndex ?>_Numero" id="f_Tablegrid$o<?php echo $_Table_grid->RowIndex ?>_Numero" value="<?php echo HtmlEncode($_Table_grid->Numero->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$_Table_grid->ListOptions->render("body", "right", $_Table_grid->RowCount);
?>
	</tr>
<?php if ($_Table->RowType == ROWTYPE_ADD || $_Table->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["f_Tablegrid", "load"], function() {
	f_Tablegrid.updateLists(<?php echo $_Table_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$_Table_grid->isGridAdd() || $_Table->CurrentMode == "copy")
		if (!$_Table_grid->Recordset->EOF)
			$_Table_grid->Recordset->moveNext();
}
?>
<?php
	if ($_Table->CurrentMode == "add" || $_Table->CurrentMode == "copy" || $_Table->CurrentMode == "edit") {
		$_Table_grid->RowIndex = '$rowindex$';
		$_Table_grid->loadRowValues();

		// Set row properties
		$_Table->resetAttributes();
		$_Table->RowAttrs->merge(["data-rowindex" => $_Table_grid->RowIndex, "id" => "r0__Table", "data-rowtype" => ROWTYPE_ADD]);
		$_Table->RowAttrs->appendClass("ew-template");
		$_Table->RowType = ROWTYPE_ADD;

		// Render row
		$_Table_grid->renderRow();

		// Render list options
		$_Table_grid->renderListOptions();
		$_Table_grid->StartRowCount = 0;
?>
	<tr <?php echo $_Table->rowAttributes() ?>>
<?php

// Render list options (body, left)
$_Table_grid->ListOptions->render("body", "left", $_Table_grid->RowIndex);
?>
	<?php if ($_Table_grid->ID->Visible) { // ID ?>
		<td data-name="ID">
<?php if (!$_Table->isConfirm()) { ?>
<span id="el$rowindex$__Table_ID" class="form-group _Table_ID"></span>
<?php } else { ?>
<span id="el$rowindex$__Table_ID" class="form-group _Table_ID">
<span<?php echo $_Table_grid->ID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_Table_grid->ID->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="_Table" data-field="x_ID" name="x<?php echo $_Table_grid->RowIndex ?>_ID" id="x<?php echo $_Table_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($_Table_grid->ID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="_Table" data-field="x_ID" name="o<?php echo $_Table_grid->RowIndex ?>_ID" id="o<?php echo $_Table_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($_Table_grid->ID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($_Table_grid->ID_Restaurant->Visible) { // ID_Restaurant ?>
		<td data-name="ID_Restaurant">
<?php if (!$_Table->isConfirm()) { ?>
<?php if ($_Table_grid->ID_Restaurant->getSessionValue() != "") { ?>
<span id="el$rowindex$__Table_ID_Restaurant" class="form-group _Table_ID_Restaurant">
<span<?php echo $_Table_grid->ID_Restaurant->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_Table_grid->ID_Restaurant->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $_Table_grid->RowIndex ?>_ID_Restaurant" name="x<?php echo $_Table_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($_Table_grid->ID_Restaurant->CurrentValue) ?>">
<?php } elseif (!$Security->isAdmin() && $Security->isLoggedIn() && !$_Table->userIDAllow("grid")) { // Non system admin ?>
<span id="el$rowindex$__Table_ID_Restaurant" class="form-group _Table_ID_Restaurant">
<span<?php echo $_Table_grid->ID_Restaurant->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_Table_grid->ID_Restaurant->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="_Table" data-field="x_ID_Restaurant" name="x<?php echo $_Table_grid->RowIndex ?>_ID_Restaurant" id="x<?php echo $_Table_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($_Table_grid->ID_Restaurant->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$__Table_ID_Restaurant" class="form-group _Table_ID_Restaurant">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="_Table" data-field="x_ID_Restaurant" data-value-separator="<?php echo $_Table_grid->ID_Restaurant->displayValueSeparatorAttribute() ?>" id="x<?php echo $_Table_grid->RowIndex ?>_ID_Restaurant" name="x<?php echo $_Table_grid->RowIndex ?>_ID_Restaurant"<?php echo $_Table_grid->ID_Restaurant->editAttributes() ?>>
			<?php echo $_Table_grid->ID_Restaurant->selectOptionListHtml("x{$_Table_grid->RowIndex}_ID_Restaurant") ?>
		</select>
</div>
<?php echo $_Table_grid->ID_Restaurant->Lookup->getParamTag($_Table_grid, "p_x" . $_Table_grid->RowIndex . "_ID_Restaurant") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$__Table_ID_Restaurant" class="form-group _Table_ID_Restaurant">
<span<?php echo $_Table_grid->ID_Restaurant->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_Table_grid->ID_Restaurant->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="_Table" data-field="x_ID_Restaurant" name="x<?php echo $_Table_grid->RowIndex ?>_ID_Restaurant" id="x<?php echo $_Table_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($_Table_grid->ID_Restaurant->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="_Table" data-field="x_ID_Restaurant" name="o<?php echo $_Table_grid->RowIndex ?>_ID_Restaurant" id="o<?php echo $_Table_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($_Table_grid->ID_Restaurant->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($_Table_grid->QRCode->Visible) { // QRCode ?>
		<td data-name="QRCode">
<?php if (!$_Table->isConfirm()) { ?>
<span id="el$rowindex$__Table_QRCode" class="form-group _Table_QRCode">
<input type="text" data-table="_Table" data-field="x_QRCode" name="x<?php echo $_Table_grid->RowIndex ?>_QRCode" id="x<?php echo $_Table_grid->RowIndex ?>_QRCode" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($_Table_grid->QRCode->getPlaceHolder()) ?>" value="<?php echo $_Table_grid->QRCode->EditValue ?>"<?php echo $_Table_grid->QRCode->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$__Table_QRCode" class="form-group _Table_QRCode">
<span<?php echo $_Table_grid->QRCode->viewAttributes() ?>><?php if (!EmptyString($_Table_grid->QRCode->ViewValue) && $_Table_grid->QRCode->linkAttributes() != "") { ?>
<a<?php echo $_Table_grid->QRCode->linkAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_Table_grid->QRCode->ViewValue)) ?>"></a>
<?php } else { ?>
<input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_Table_grid->QRCode->ViewValue)) ?>">
<?php } ?></span>
</span>
<input type="hidden" data-table="_Table" data-field="x_QRCode" name="x<?php echo $_Table_grid->RowIndex ?>_QRCode" id="x<?php echo $_Table_grid->RowIndex ?>_QRCode" value="<?php echo HtmlEncode($_Table_grid->QRCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="_Table" data-field="x_QRCode" name="o<?php echo $_Table_grid->RowIndex ?>_QRCode" id="o<?php echo $_Table_grid->RowIndex ?>_QRCode" value="<?php echo HtmlEncode($_Table_grid->QRCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($_Table_grid->Numero->Visible) { // Numero ?>
		<td data-name="Numero">
<?php if (!$_Table->isConfirm()) { ?>
<span id="el$rowindex$__Table_Numero" class="form-group _Table_Numero">
<input type="text" data-table="_Table" data-field="x_Numero" name="x<?php echo $_Table_grid->RowIndex ?>_Numero" id="x<?php echo $_Table_grid->RowIndex ?>_Numero" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($_Table_grid->Numero->getPlaceHolder()) ?>" value="<?php echo $_Table_grid->Numero->EditValue ?>"<?php echo $_Table_grid->Numero->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$__Table_Numero" class="form-group _Table_Numero">
<span<?php echo $_Table_grid->Numero->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_Table_grid->Numero->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="_Table" data-field="x_Numero" name="x<?php echo $_Table_grid->RowIndex ?>_Numero" id="x<?php echo $_Table_grid->RowIndex ?>_Numero" value="<?php echo HtmlEncode($_Table_grid->Numero->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="_Table" data-field="x_Numero" name="o<?php echo $_Table_grid->RowIndex ?>_Numero" id="o<?php echo $_Table_grid->RowIndex ?>_Numero" value="<?php echo HtmlEncode($_Table_grid->Numero->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$_Table_grid->ListOptions->render("body", "right", $_Table_grid->RowIndex);
?>
<script>
loadjs.ready(["f_Tablegrid", "load"], function() {
	f_Tablegrid.updateLists(<?php echo $_Table_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($_Table->CurrentMode == "add" || $_Table->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $_Table_grid->FormKeyCountName ?>" id="<?php echo $_Table_grid->FormKeyCountName ?>" value="<?php echo $_Table_grid->KeyCount ?>">
<?php echo $_Table_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($_Table->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $_Table_grid->FormKeyCountName ?>" id="<?php echo $_Table_grid->FormKeyCountName ?>" value="<?php echo $_Table_grid->KeyCount ?>">
<?php echo $_Table_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($_Table->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="f_Tablegrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($_Table_grid->Recordset)
	$_Table_grid->Recordset->Close();
?>
<?php if ($_Table_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $_Table_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($_Table_grid->TotalRecords == 0 && !$_Table->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $_Table_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$_Table_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$_Table_grid->terminate();
?>