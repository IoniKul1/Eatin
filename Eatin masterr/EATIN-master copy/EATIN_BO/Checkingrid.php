<?php
namespace PHPMaker2020\EATIN_BO;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($Checkin_grid))
	$Checkin_grid = new Checkin_grid();

// Run the page
$Checkin_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Checkin_grid->Page_Render();
?>
<?php if (!$Checkin_grid->isExport()) { ?>
<script>
var fCheckingrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fCheckingrid = new ew.Form("fCheckingrid", "grid");
	fCheckingrid.formKeyCountName = '<?php echo $Checkin_grid->FormKeyCountName ?>';

	// Validate form
	fCheckingrid.validate = function() {
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
			<?php if ($Checkin_grid->ID->Required) { ?>
				elm = this.getElements("x" + infix + "_ID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Checkin_grid->ID->caption(), $Checkin_grid->ID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Checkin_grid->ID_Client->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_Client");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Checkin_grid->ID_Client->caption(), $Checkin_grid->ID_Client->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ID_Client");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Checkin_grid->ID_Client->errorMessage()) ?>");
			<?php if ($Checkin_grid->ID_Restaurant->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_Restaurant");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Checkin_grid->ID_Restaurant->caption(), $Checkin_grid->ID_Restaurant->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ID_Restaurant");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Checkin_grid->ID_Restaurant->errorMessage()) ?>");
			<?php if ($Checkin_grid->DateCreation->Required) { ?>
				elm = this.getElements("x" + infix + "_DateCreation");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Checkin_grid->DateCreation->caption(), $Checkin_grid->DateCreation->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateCreation");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Checkin_grid->DateCreation->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fCheckingrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "ID_Client", false)) return false;
		if (ew.valueChanged(fobj, infix, "ID_Restaurant", false)) return false;
		if (ew.valueChanged(fobj, infix, "DateCreation", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fCheckingrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fCheckingrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fCheckingrid");
});
</script>
<?php } ?>
<?php
$Checkin_grid->renderOtherOptions();
?>
<?php if ($Checkin_grid->TotalRecords > 0 || $Checkin->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Checkin_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> Checkin">
<?php if ($Checkin_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $Checkin_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fCheckingrid" class="ew-form ew-list-form form-inline">
<div id="gmp_Checkin" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_Checkingrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$Checkin->RowType = ROWTYPE_HEADER;

// Render list options
$Checkin_grid->renderListOptions();

// Render list options (header, left)
$Checkin_grid->ListOptions->render("header", "left");
?>
<?php if ($Checkin_grid->ID->Visible) { // ID ?>
	<?php if ($Checkin_grid->SortUrl($Checkin_grid->ID) == "") { ?>
		<th data-name="ID" class="<?php echo $Checkin_grid->ID->headerCellClass() ?>"><div id="elh_Checkin_ID" class="Checkin_ID"><div class="ew-table-header-caption"><?php echo $Checkin_grid->ID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID" class="<?php echo $Checkin_grid->ID->headerCellClass() ?>"><div><div id="elh_Checkin_ID" class="Checkin_ID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Checkin_grid->ID->caption() ?></span><span class="ew-table-header-sort"><?php if ($Checkin_grid->ID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Checkin_grid->ID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Checkin_grid->ID_Client->Visible) { // ID_Client ?>
	<?php if ($Checkin_grid->SortUrl($Checkin_grid->ID_Client) == "") { ?>
		<th data-name="ID_Client" class="<?php echo $Checkin_grid->ID_Client->headerCellClass() ?>"><div id="elh_Checkin_ID_Client" class="Checkin_ID_Client"><div class="ew-table-header-caption"><?php echo $Checkin_grid->ID_Client->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Client" class="<?php echo $Checkin_grid->ID_Client->headerCellClass() ?>"><div><div id="elh_Checkin_ID_Client" class="Checkin_ID_Client">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Checkin_grid->ID_Client->caption() ?></span><span class="ew-table-header-sort"><?php if ($Checkin_grid->ID_Client->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Checkin_grid->ID_Client->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Checkin_grid->ID_Restaurant->Visible) { // ID_Restaurant ?>
	<?php if ($Checkin_grid->SortUrl($Checkin_grid->ID_Restaurant) == "") { ?>
		<th data-name="ID_Restaurant" class="<?php echo $Checkin_grid->ID_Restaurant->headerCellClass() ?>"><div id="elh_Checkin_ID_Restaurant" class="Checkin_ID_Restaurant"><div class="ew-table-header-caption"><?php echo $Checkin_grid->ID_Restaurant->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Restaurant" class="<?php echo $Checkin_grid->ID_Restaurant->headerCellClass() ?>"><div><div id="elh_Checkin_ID_Restaurant" class="Checkin_ID_Restaurant">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Checkin_grid->ID_Restaurant->caption() ?></span><span class="ew-table-header-sort"><?php if ($Checkin_grid->ID_Restaurant->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Checkin_grid->ID_Restaurant->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Checkin_grid->DateCreation->Visible) { // DateCreation ?>
	<?php if ($Checkin_grid->SortUrl($Checkin_grid->DateCreation) == "") { ?>
		<th data-name="DateCreation" class="<?php echo $Checkin_grid->DateCreation->headerCellClass() ?>"><div id="elh_Checkin_DateCreation" class="Checkin_DateCreation"><div class="ew-table-header-caption"><?php echo $Checkin_grid->DateCreation->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateCreation" class="<?php echo $Checkin_grid->DateCreation->headerCellClass() ?>"><div><div id="elh_Checkin_DateCreation" class="Checkin_DateCreation">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Checkin_grid->DateCreation->caption() ?></span><span class="ew-table-header-sort"><?php if ($Checkin_grid->DateCreation->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Checkin_grid->DateCreation->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$Checkin_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$Checkin_grid->StartRecord = 1;
$Checkin_grid->StopRecord = $Checkin_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($Checkin->isConfirm() || $Checkin_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($Checkin_grid->FormKeyCountName) && ($Checkin_grid->isGridAdd() || $Checkin_grid->isGridEdit() || $Checkin->isConfirm())) {
		$Checkin_grid->KeyCount = $CurrentForm->getValue($Checkin_grid->FormKeyCountName);
		$Checkin_grid->StopRecord = $Checkin_grid->StartRecord + $Checkin_grid->KeyCount - 1;
	}
}
$Checkin_grid->RecordCount = $Checkin_grid->StartRecord - 1;
if ($Checkin_grid->Recordset && !$Checkin_grid->Recordset->EOF) {
	$Checkin_grid->Recordset->moveFirst();
	$selectLimit = $Checkin_grid->UseSelectLimit;
	if (!$selectLimit && $Checkin_grid->StartRecord > 1)
		$Checkin_grid->Recordset->move($Checkin_grid->StartRecord - 1);
} elseif (!$Checkin->AllowAddDeleteRow && $Checkin_grid->StopRecord == 0) {
	$Checkin_grid->StopRecord = $Checkin->GridAddRowCount;
}

// Initialize aggregate
$Checkin->RowType = ROWTYPE_AGGREGATEINIT;
$Checkin->resetAttributes();
$Checkin_grid->renderRow();
if ($Checkin_grid->isGridAdd())
	$Checkin_grid->RowIndex = 0;
if ($Checkin_grid->isGridEdit())
	$Checkin_grid->RowIndex = 0;
while ($Checkin_grid->RecordCount < $Checkin_grid->StopRecord) {
	$Checkin_grid->RecordCount++;
	if ($Checkin_grid->RecordCount >= $Checkin_grid->StartRecord) {
		$Checkin_grid->RowCount++;
		if ($Checkin_grid->isGridAdd() || $Checkin_grid->isGridEdit() || $Checkin->isConfirm()) {
			$Checkin_grid->RowIndex++;
			$CurrentForm->Index = $Checkin_grid->RowIndex;
			if ($CurrentForm->hasValue($Checkin_grid->FormActionName) && ($Checkin->isConfirm() || $Checkin_grid->EventCancelled))
				$Checkin_grid->RowAction = strval($CurrentForm->getValue($Checkin_grid->FormActionName));
			elseif ($Checkin_grid->isGridAdd())
				$Checkin_grid->RowAction = "insert";
			else
				$Checkin_grid->RowAction = "";
		}

		// Set up key count
		$Checkin_grid->KeyCount = $Checkin_grid->RowIndex;

		// Init row class and style
		$Checkin->resetAttributes();
		$Checkin->CssClass = "";
		if ($Checkin_grid->isGridAdd()) {
			if ($Checkin->CurrentMode == "copy") {
				$Checkin_grid->loadRowValues($Checkin_grid->Recordset); // Load row values
				$Checkin_grid->setRecordKey($Checkin_grid->RowOldKey, $Checkin_grid->Recordset); // Set old record key
			} else {
				$Checkin_grid->loadRowValues(); // Load default values
				$Checkin_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$Checkin_grid->loadRowValues($Checkin_grid->Recordset); // Load row values
		}
		$Checkin->RowType = ROWTYPE_VIEW; // Render view
		if ($Checkin_grid->isGridAdd()) // Grid add
			$Checkin->RowType = ROWTYPE_ADD; // Render add
		if ($Checkin_grid->isGridAdd() && $Checkin->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$Checkin_grid->restoreCurrentRowFormValues($Checkin_grid->RowIndex); // Restore form values
		if ($Checkin_grid->isGridEdit()) { // Grid edit
			if ($Checkin->EventCancelled)
				$Checkin_grid->restoreCurrentRowFormValues($Checkin_grid->RowIndex); // Restore form values
			if ($Checkin_grid->RowAction == "insert")
				$Checkin->RowType = ROWTYPE_ADD; // Render add
			else
				$Checkin->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($Checkin_grid->isGridEdit() && ($Checkin->RowType == ROWTYPE_EDIT || $Checkin->RowType == ROWTYPE_ADD) && $Checkin->EventCancelled) // Update failed
			$Checkin_grid->restoreCurrentRowFormValues($Checkin_grid->RowIndex); // Restore form values
		if ($Checkin->RowType == ROWTYPE_EDIT) // Edit row
			$Checkin_grid->EditRowCount++;
		if ($Checkin->isConfirm()) // Confirm row
			$Checkin_grid->restoreCurrentRowFormValues($Checkin_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$Checkin->RowAttrs->merge(["data-rowindex" => $Checkin_grid->RowCount, "id" => "r" . $Checkin_grid->RowCount . "_Checkin", "data-rowtype" => $Checkin->RowType]);

		// Render row
		$Checkin_grid->renderRow();

		// Render list options
		$Checkin_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($Checkin_grid->RowAction != "delete" && $Checkin_grid->RowAction != "insertdelete" && !($Checkin_grid->RowAction == "insert" && $Checkin->isConfirm() && $Checkin_grid->emptyRow())) {
?>
	<tr <?php echo $Checkin->rowAttributes() ?>>
<?php

// Render list options (body, left)
$Checkin_grid->ListOptions->render("body", "left", $Checkin_grid->RowCount);
?>
	<?php if ($Checkin_grid->ID->Visible) { // ID ?>
		<td data-name="ID" <?php echo $Checkin_grid->ID->cellAttributes() ?>>
<?php if ($Checkin->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Checkin_grid->RowCount ?>_Checkin_ID" class="form-group"></span>
<input type="hidden" data-table="Checkin" data-field="x_ID" name="o<?php echo $Checkin_grid->RowIndex ?>_ID" id="o<?php echo $Checkin_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($Checkin_grid->ID->OldValue) ?>">
<?php } ?>
<?php if ($Checkin->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Checkin_grid->RowCount ?>_Checkin_ID" class="form-group">
<span<?php echo $Checkin_grid->ID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Checkin_grid->ID->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="Checkin" data-field="x_ID" name="x<?php echo $Checkin_grid->RowIndex ?>_ID" id="x<?php echo $Checkin_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($Checkin_grid->ID->CurrentValue) ?>">
<?php } ?>
<?php if ($Checkin->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Checkin_grid->RowCount ?>_Checkin_ID">
<span<?php echo $Checkin_grid->ID->viewAttributes() ?>><?php echo $Checkin_grid->ID->getViewValue() ?></span>
</span>
<?php if (!$Checkin->isConfirm()) { ?>
<input type="hidden" data-table="Checkin" data-field="x_ID" name="x<?php echo $Checkin_grid->RowIndex ?>_ID" id="x<?php echo $Checkin_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($Checkin_grid->ID->FormValue) ?>">
<input type="hidden" data-table="Checkin" data-field="x_ID" name="o<?php echo $Checkin_grid->RowIndex ?>_ID" id="o<?php echo $Checkin_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($Checkin_grid->ID->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="Checkin" data-field="x_ID" name="fCheckingrid$x<?php echo $Checkin_grid->RowIndex ?>_ID" id="fCheckingrid$x<?php echo $Checkin_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($Checkin_grid->ID->FormValue) ?>">
<input type="hidden" data-table="Checkin" data-field="x_ID" name="fCheckingrid$o<?php echo $Checkin_grid->RowIndex ?>_ID" id="fCheckingrid$o<?php echo $Checkin_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($Checkin_grid->ID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Checkin_grid->ID_Client->Visible) { // ID_Client ?>
		<td data-name="ID_Client" <?php echo $Checkin_grid->ID_Client->cellAttributes() ?>>
<?php if ($Checkin->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($Checkin_grid->ID_Client->getSessionValue() != "") { ?>
<span id="el<?php echo $Checkin_grid->RowCount ?>_Checkin_ID_Client" class="form-group">
<span<?php echo $Checkin_grid->ID_Client->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Checkin_grid->ID_Client->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $Checkin_grid->RowIndex ?>_ID_Client" name="x<?php echo $Checkin_grid->RowIndex ?>_ID_Client" value="<?php echo HtmlEncode($Checkin_grid->ID_Client->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $Checkin_grid->RowCount ?>_Checkin_ID_Client" class="form-group">
<input type="text" data-table="Checkin" data-field="x_ID_Client" name="x<?php echo $Checkin_grid->RowIndex ?>_ID_Client" id="x<?php echo $Checkin_grid->RowIndex ?>_ID_Client" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Checkin_grid->ID_Client->getPlaceHolder()) ?>" value="<?php echo $Checkin_grid->ID_Client->EditValue ?>"<?php echo $Checkin_grid->ID_Client->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="Checkin" data-field="x_ID_Client" name="o<?php echo $Checkin_grid->RowIndex ?>_ID_Client" id="o<?php echo $Checkin_grid->RowIndex ?>_ID_Client" value="<?php echo HtmlEncode($Checkin_grid->ID_Client->OldValue) ?>">
<?php } ?>
<?php if ($Checkin->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($Checkin_grid->ID_Client->getSessionValue() != "") { ?>
<span id="el<?php echo $Checkin_grid->RowCount ?>_Checkin_ID_Client" class="form-group">
<span<?php echo $Checkin_grid->ID_Client->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Checkin_grid->ID_Client->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $Checkin_grid->RowIndex ?>_ID_Client" name="x<?php echo $Checkin_grid->RowIndex ?>_ID_Client" value="<?php echo HtmlEncode($Checkin_grid->ID_Client->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $Checkin_grid->RowCount ?>_Checkin_ID_Client" class="form-group">
<input type="text" data-table="Checkin" data-field="x_ID_Client" name="x<?php echo $Checkin_grid->RowIndex ?>_ID_Client" id="x<?php echo $Checkin_grid->RowIndex ?>_ID_Client" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Checkin_grid->ID_Client->getPlaceHolder()) ?>" value="<?php echo $Checkin_grid->ID_Client->EditValue ?>"<?php echo $Checkin_grid->ID_Client->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($Checkin->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Checkin_grid->RowCount ?>_Checkin_ID_Client">
<span<?php echo $Checkin_grid->ID_Client->viewAttributes() ?>><?php echo $Checkin_grid->ID_Client->getViewValue() ?></span>
</span>
<?php if (!$Checkin->isConfirm()) { ?>
<input type="hidden" data-table="Checkin" data-field="x_ID_Client" name="x<?php echo $Checkin_grid->RowIndex ?>_ID_Client" id="x<?php echo $Checkin_grid->RowIndex ?>_ID_Client" value="<?php echo HtmlEncode($Checkin_grid->ID_Client->FormValue) ?>">
<input type="hidden" data-table="Checkin" data-field="x_ID_Client" name="o<?php echo $Checkin_grid->RowIndex ?>_ID_Client" id="o<?php echo $Checkin_grid->RowIndex ?>_ID_Client" value="<?php echo HtmlEncode($Checkin_grid->ID_Client->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="Checkin" data-field="x_ID_Client" name="fCheckingrid$x<?php echo $Checkin_grid->RowIndex ?>_ID_Client" id="fCheckingrid$x<?php echo $Checkin_grid->RowIndex ?>_ID_Client" value="<?php echo HtmlEncode($Checkin_grid->ID_Client->FormValue) ?>">
<input type="hidden" data-table="Checkin" data-field="x_ID_Client" name="fCheckingrid$o<?php echo $Checkin_grid->RowIndex ?>_ID_Client" id="fCheckingrid$o<?php echo $Checkin_grid->RowIndex ?>_ID_Client" value="<?php echo HtmlEncode($Checkin_grid->ID_Client->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Checkin_grid->ID_Restaurant->Visible) { // ID_Restaurant ?>
		<td data-name="ID_Restaurant" <?php echo $Checkin_grid->ID_Restaurant->cellAttributes() ?>>
<?php if ($Checkin->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn() && !$Checkin->userIDAllow("grid")) { // Non system admin ?>
<span id="el<?php echo $Checkin_grid->RowCount ?>_Checkin_ID_Restaurant" class="form-group">
<span<?php echo $Checkin_grid->ID_Restaurant->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Checkin_grid->ID_Restaurant->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="Checkin" data-field="x_ID_Restaurant" name="x<?php echo $Checkin_grid->RowIndex ?>_ID_Restaurant" id="x<?php echo $Checkin_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($Checkin_grid->ID_Restaurant->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $Checkin_grid->RowCount ?>_Checkin_ID_Restaurant" class="form-group">
<input type="text" data-table="Checkin" data-field="x_ID_Restaurant" name="x<?php echo $Checkin_grid->RowIndex ?>_ID_Restaurant" id="x<?php echo $Checkin_grid->RowIndex ?>_ID_Restaurant" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Checkin_grid->ID_Restaurant->getPlaceHolder()) ?>" value="<?php echo $Checkin_grid->ID_Restaurant->EditValue ?>"<?php echo $Checkin_grid->ID_Restaurant->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="Checkin" data-field="x_ID_Restaurant" name="o<?php echo $Checkin_grid->RowIndex ?>_ID_Restaurant" id="o<?php echo $Checkin_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($Checkin_grid->ID_Restaurant->OldValue) ?>">
<?php } ?>
<?php if ($Checkin->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn() && !$Checkin->userIDAllow("grid")) { // Non system admin ?>
<span id="el<?php echo $Checkin_grid->RowCount ?>_Checkin_ID_Restaurant" class="form-group">
<span<?php echo $Checkin_grid->ID_Restaurant->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Checkin_grid->ID_Restaurant->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="Checkin" data-field="x_ID_Restaurant" name="x<?php echo $Checkin_grid->RowIndex ?>_ID_Restaurant" id="x<?php echo $Checkin_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($Checkin_grid->ID_Restaurant->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $Checkin_grid->RowCount ?>_Checkin_ID_Restaurant" class="form-group">
<input type="text" data-table="Checkin" data-field="x_ID_Restaurant" name="x<?php echo $Checkin_grid->RowIndex ?>_ID_Restaurant" id="x<?php echo $Checkin_grid->RowIndex ?>_ID_Restaurant" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Checkin_grid->ID_Restaurant->getPlaceHolder()) ?>" value="<?php echo $Checkin_grid->ID_Restaurant->EditValue ?>"<?php echo $Checkin_grid->ID_Restaurant->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($Checkin->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Checkin_grid->RowCount ?>_Checkin_ID_Restaurant">
<span<?php echo $Checkin_grid->ID_Restaurant->viewAttributes() ?>><?php echo $Checkin_grid->ID_Restaurant->getViewValue() ?></span>
</span>
<?php if (!$Checkin->isConfirm()) { ?>
<input type="hidden" data-table="Checkin" data-field="x_ID_Restaurant" name="x<?php echo $Checkin_grid->RowIndex ?>_ID_Restaurant" id="x<?php echo $Checkin_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($Checkin_grid->ID_Restaurant->FormValue) ?>">
<input type="hidden" data-table="Checkin" data-field="x_ID_Restaurant" name="o<?php echo $Checkin_grid->RowIndex ?>_ID_Restaurant" id="o<?php echo $Checkin_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($Checkin_grid->ID_Restaurant->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="Checkin" data-field="x_ID_Restaurant" name="fCheckingrid$x<?php echo $Checkin_grid->RowIndex ?>_ID_Restaurant" id="fCheckingrid$x<?php echo $Checkin_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($Checkin_grid->ID_Restaurant->FormValue) ?>">
<input type="hidden" data-table="Checkin" data-field="x_ID_Restaurant" name="fCheckingrid$o<?php echo $Checkin_grid->RowIndex ?>_ID_Restaurant" id="fCheckingrid$o<?php echo $Checkin_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($Checkin_grid->ID_Restaurant->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Checkin_grid->DateCreation->Visible) { // DateCreation ?>
		<td data-name="DateCreation" <?php echo $Checkin_grid->DateCreation->cellAttributes() ?>>
<?php if ($Checkin->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Checkin_grid->RowCount ?>_Checkin_DateCreation" class="form-group">
<input type="text" data-table="Checkin" data-field="x_DateCreation" name="x<?php echo $Checkin_grid->RowIndex ?>_DateCreation" id="x<?php echo $Checkin_grid->RowIndex ?>_DateCreation" maxlength="8" placeholder="<?php echo HtmlEncode($Checkin_grid->DateCreation->getPlaceHolder()) ?>" value="<?php echo $Checkin_grid->DateCreation->EditValue ?>"<?php echo $Checkin_grid->DateCreation->editAttributes() ?>>
<?php if (!$Checkin_grid->DateCreation->ReadOnly && !$Checkin_grid->DateCreation->Disabled && !isset($Checkin_grid->DateCreation->EditAttrs["readonly"]) && !isset($Checkin_grid->DateCreation->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fCheckingrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fCheckingrid", "x<?php echo $Checkin_grid->RowIndex ?>_DateCreation", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="Checkin" data-field="x_DateCreation" name="o<?php echo $Checkin_grid->RowIndex ?>_DateCreation" id="o<?php echo $Checkin_grid->RowIndex ?>_DateCreation" value="<?php echo HtmlEncode($Checkin_grid->DateCreation->OldValue) ?>">
<?php } ?>
<?php if ($Checkin->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Checkin_grid->RowCount ?>_Checkin_DateCreation" class="form-group">
<input type="text" data-table="Checkin" data-field="x_DateCreation" name="x<?php echo $Checkin_grid->RowIndex ?>_DateCreation" id="x<?php echo $Checkin_grid->RowIndex ?>_DateCreation" maxlength="8" placeholder="<?php echo HtmlEncode($Checkin_grid->DateCreation->getPlaceHolder()) ?>" value="<?php echo $Checkin_grid->DateCreation->EditValue ?>"<?php echo $Checkin_grid->DateCreation->editAttributes() ?>>
<?php if (!$Checkin_grid->DateCreation->ReadOnly && !$Checkin_grid->DateCreation->Disabled && !isset($Checkin_grid->DateCreation->EditAttrs["readonly"]) && !isset($Checkin_grid->DateCreation->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fCheckingrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fCheckingrid", "x<?php echo $Checkin_grid->RowIndex ?>_DateCreation", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Checkin->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Checkin_grid->RowCount ?>_Checkin_DateCreation">
<span<?php echo $Checkin_grid->DateCreation->viewAttributes() ?>><?php echo $Checkin_grid->DateCreation->getViewValue() ?></span>
</span>
<?php if (!$Checkin->isConfirm()) { ?>
<input type="hidden" data-table="Checkin" data-field="x_DateCreation" name="x<?php echo $Checkin_grid->RowIndex ?>_DateCreation" id="x<?php echo $Checkin_grid->RowIndex ?>_DateCreation" value="<?php echo HtmlEncode($Checkin_grid->DateCreation->FormValue) ?>">
<input type="hidden" data-table="Checkin" data-field="x_DateCreation" name="o<?php echo $Checkin_grid->RowIndex ?>_DateCreation" id="o<?php echo $Checkin_grid->RowIndex ?>_DateCreation" value="<?php echo HtmlEncode($Checkin_grid->DateCreation->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="Checkin" data-field="x_DateCreation" name="fCheckingrid$x<?php echo $Checkin_grid->RowIndex ?>_DateCreation" id="fCheckingrid$x<?php echo $Checkin_grid->RowIndex ?>_DateCreation" value="<?php echo HtmlEncode($Checkin_grid->DateCreation->FormValue) ?>">
<input type="hidden" data-table="Checkin" data-field="x_DateCreation" name="fCheckingrid$o<?php echo $Checkin_grid->RowIndex ?>_DateCreation" id="fCheckingrid$o<?php echo $Checkin_grid->RowIndex ?>_DateCreation" value="<?php echo HtmlEncode($Checkin_grid->DateCreation->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$Checkin_grid->ListOptions->render("body", "right", $Checkin_grid->RowCount);
?>
	</tr>
<?php if ($Checkin->RowType == ROWTYPE_ADD || $Checkin->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fCheckingrid", "load"], function() {
	fCheckingrid.updateLists(<?php echo $Checkin_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$Checkin_grid->isGridAdd() || $Checkin->CurrentMode == "copy")
		if (!$Checkin_grid->Recordset->EOF)
			$Checkin_grid->Recordset->moveNext();
}
?>
<?php
	if ($Checkin->CurrentMode == "add" || $Checkin->CurrentMode == "copy" || $Checkin->CurrentMode == "edit") {
		$Checkin_grid->RowIndex = '$rowindex$';
		$Checkin_grid->loadRowValues();

		// Set row properties
		$Checkin->resetAttributes();
		$Checkin->RowAttrs->merge(["data-rowindex" => $Checkin_grid->RowIndex, "id" => "r0_Checkin", "data-rowtype" => ROWTYPE_ADD]);
		$Checkin->RowAttrs->appendClass("ew-template");
		$Checkin->RowType = ROWTYPE_ADD;

		// Render row
		$Checkin_grid->renderRow();

		// Render list options
		$Checkin_grid->renderListOptions();
		$Checkin_grid->StartRowCount = 0;
?>
	<tr <?php echo $Checkin->rowAttributes() ?>>
<?php

// Render list options (body, left)
$Checkin_grid->ListOptions->render("body", "left", $Checkin_grid->RowIndex);
?>
	<?php if ($Checkin_grid->ID->Visible) { // ID ?>
		<td data-name="ID">
<?php if (!$Checkin->isConfirm()) { ?>
<span id="el$rowindex$_Checkin_ID" class="form-group Checkin_ID"></span>
<?php } else { ?>
<span id="el$rowindex$_Checkin_ID" class="form-group Checkin_ID">
<span<?php echo $Checkin_grid->ID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Checkin_grid->ID->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="Checkin" data-field="x_ID" name="x<?php echo $Checkin_grid->RowIndex ?>_ID" id="x<?php echo $Checkin_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($Checkin_grid->ID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="Checkin" data-field="x_ID" name="o<?php echo $Checkin_grid->RowIndex ?>_ID" id="o<?php echo $Checkin_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($Checkin_grid->ID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Checkin_grid->ID_Client->Visible) { // ID_Client ?>
		<td data-name="ID_Client">
<?php if (!$Checkin->isConfirm()) { ?>
<?php if ($Checkin_grid->ID_Client->getSessionValue() != "") { ?>
<span id="el$rowindex$_Checkin_ID_Client" class="form-group Checkin_ID_Client">
<span<?php echo $Checkin_grid->ID_Client->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Checkin_grid->ID_Client->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $Checkin_grid->RowIndex ?>_ID_Client" name="x<?php echo $Checkin_grid->RowIndex ?>_ID_Client" value="<?php echo HtmlEncode($Checkin_grid->ID_Client->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_Checkin_ID_Client" class="form-group Checkin_ID_Client">
<input type="text" data-table="Checkin" data-field="x_ID_Client" name="x<?php echo $Checkin_grid->RowIndex ?>_ID_Client" id="x<?php echo $Checkin_grid->RowIndex ?>_ID_Client" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Checkin_grid->ID_Client->getPlaceHolder()) ?>" value="<?php echo $Checkin_grid->ID_Client->EditValue ?>"<?php echo $Checkin_grid->ID_Client->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_Checkin_ID_Client" class="form-group Checkin_ID_Client">
<span<?php echo $Checkin_grid->ID_Client->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Checkin_grid->ID_Client->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="Checkin" data-field="x_ID_Client" name="x<?php echo $Checkin_grid->RowIndex ?>_ID_Client" id="x<?php echo $Checkin_grid->RowIndex ?>_ID_Client" value="<?php echo HtmlEncode($Checkin_grid->ID_Client->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="Checkin" data-field="x_ID_Client" name="o<?php echo $Checkin_grid->RowIndex ?>_ID_Client" id="o<?php echo $Checkin_grid->RowIndex ?>_ID_Client" value="<?php echo HtmlEncode($Checkin_grid->ID_Client->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Checkin_grid->ID_Restaurant->Visible) { // ID_Restaurant ?>
		<td data-name="ID_Restaurant">
<?php if (!$Checkin->isConfirm()) { ?>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn() && !$Checkin->userIDAllow("grid")) { // Non system admin ?>
<span id="el$rowindex$_Checkin_ID_Restaurant" class="form-group Checkin_ID_Restaurant">
<span<?php echo $Checkin_grid->ID_Restaurant->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Checkin_grid->ID_Restaurant->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="Checkin" data-field="x_ID_Restaurant" name="x<?php echo $Checkin_grid->RowIndex ?>_ID_Restaurant" id="x<?php echo $Checkin_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($Checkin_grid->ID_Restaurant->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_Checkin_ID_Restaurant" class="form-group Checkin_ID_Restaurant">
<input type="text" data-table="Checkin" data-field="x_ID_Restaurant" name="x<?php echo $Checkin_grid->RowIndex ?>_ID_Restaurant" id="x<?php echo $Checkin_grid->RowIndex ?>_ID_Restaurant" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Checkin_grid->ID_Restaurant->getPlaceHolder()) ?>" value="<?php echo $Checkin_grid->ID_Restaurant->EditValue ?>"<?php echo $Checkin_grid->ID_Restaurant->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_Checkin_ID_Restaurant" class="form-group Checkin_ID_Restaurant">
<span<?php echo $Checkin_grid->ID_Restaurant->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Checkin_grid->ID_Restaurant->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="Checkin" data-field="x_ID_Restaurant" name="x<?php echo $Checkin_grid->RowIndex ?>_ID_Restaurant" id="x<?php echo $Checkin_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($Checkin_grid->ID_Restaurant->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="Checkin" data-field="x_ID_Restaurant" name="o<?php echo $Checkin_grid->RowIndex ?>_ID_Restaurant" id="o<?php echo $Checkin_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($Checkin_grid->ID_Restaurant->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Checkin_grid->DateCreation->Visible) { // DateCreation ?>
		<td data-name="DateCreation">
<?php if (!$Checkin->isConfirm()) { ?>
<span id="el$rowindex$_Checkin_DateCreation" class="form-group Checkin_DateCreation">
<input type="text" data-table="Checkin" data-field="x_DateCreation" name="x<?php echo $Checkin_grid->RowIndex ?>_DateCreation" id="x<?php echo $Checkin_grid->RowIndex ?>_DateCreation" maxlength="8" placeholder="<?php echo HtmlEncode($Checkin_grid->DateCreation->getPlaceHolder()) ?>" value="<?php echo $Checkin_grid->DateCreation->EditValue ?>"<?php echo $Checkin_grid->DateCreation->editAttributes() ?>>
<?php if (!$Checkin_grid->DateCreation->ReadOnly && !$Checkin_grid->DateCreation->Disabled && !isset($Checkin_grid->DateCreation->EditAttrs["readonly"]) && !isset($Checkin_grid->DateCreation->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fCheckingrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fCheckingrid", "x<?php echo $Checkin_grid->RowIndex ?>_DateCreation", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_Checkin_DateCreation" class="form-group Checkin_DateCreation">
<span<?php echo $Checkin_grid->DateCreation->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Checkin_grid->DateCreation->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="Checkin" data-field="x_DateCreation" name="x<?php echo $Checkin_grid->RowIndex ?>_DateCreation" id="x<?php echo $Checkin_grid->RowIndex ?>_DateCreation" value="<?php echo HtmlEncode($Checkin_grid->DateCreation->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="Checkin" data-field="x_DateCreation" name="o<?php echo $Checkin_grid->RowIndex ?>_DateCreation" id="o<?php echo $Checkin_grid->RowIndex ?>_DateCreation" value="<?php echo HtmlEncode($Checkin_grid->DateCreation->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$Checkin_grid->ListOptions->render("body", "right", $Checkin_grid->RowIndex);
?>
<script>
loadjs.ready(["fCheckingrid", "load"], function() {
	fCheckingrid.updateLists(<?php echo $Checkin_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($Checkin->CurrentMode == "add" || $Checkin->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $Checkin_grid->FormKeyCountName ?>" id="<?php echo $Checkin_grid->FormKeyCountName ?>" value="<?php echo $Checkin_grid->KeyCount ?>">
<?php echo $Checkin_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($Checkin->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $Checkin_grid->FormKeyCountName ?>" id="<?php echo $Checkin_grid->FormKeyCountName ?>" value="<?php echo $Checkin_grid->KeyCount ?>">
<?php echo $Checkin_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($Checkin->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fCheckingrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($Checkin_grid->Recordset)
	$Checkin_grid->Recordset->Close();
?>
<?php if ($Checkin_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $Checkin_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($Checkin_grid->TotalRecords == 0 && !$Checkin->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $Checkin_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$Checkin_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$Checkin_grid->terminate();
?>