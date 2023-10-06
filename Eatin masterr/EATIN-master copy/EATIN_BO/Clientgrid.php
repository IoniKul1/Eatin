<?php
namespace PHPMaker2020\EATIN_BO;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($Client_grid))
	$Client_grid = new Client_grid();

// Run the page
$Client_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Client_grid->Page_Render();
?>
<?php if (!$Client_grid->isExport()) { ?>
<script>
var fClientgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fClientgrid = new ew.Form("fClientgrid", "grid");
	fClientgrid.formKeyCountName = '<?php echo $Client_grid->FormKeyCountName ?>';

	// Validate form
	fClientgrid.validate = function() {
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
			<?php if ($Client_grid->ID->Required) { ?>
				elm = this.getElements("x" + infix + "_ID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Client_grid->ID->caption(), $Client_grid->ID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Client_grid->ID_Restaurant->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_Restaurant");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Client_grid->ID_Restaurant->caption(), $Client_grid->ID_Restaurant->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Client_grid->FirstName->Required) { ?>
				elm = this.getElements("x" + infix + "_FirstName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Client_grid->FirstName->caption(), $Client_grid->FirstName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Client_grid->LastName->Required) { ?>
				elm = this.getElements("x" + infix + "_LastName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Client_grid->LastName->caption(), $Client_grid->LastName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Client_grid->_Email->Required) { ?>
				elm = this.getElements("x" + infix + "__Email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Client_grid->_Email->caption(), $Client_grid->_Email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Client_grid->Phone->Required) { ?>
				elm = this.getElements("x" + infix + "_Phone");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Client_grid->Phone->caption(), $Client_grid->Phone->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Client_grid->Banned->Required) { ?>
				elm = this.getElements("x" + infix + "_Banned");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Client_grid->Banned->caption(), $Client_grid->Banned->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Client_grid->ClientToken->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientToken");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Client_grid->ClientToken->caption(), $Client_grid->ClientToken->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fClientgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "ID_Restaurant", false)) return false;
		if (ew.valueChanged(fobj, infix, "FirstName", false)) return false;
		if (ew.valueChanged(fobj, infix, "LastName", false)) return false;
		if (ew.valueChanged(fobj, infix, "_Email", false)) return false;
		if (ew.valueChanged(fobj, infix, "Phone", false)) return false;
		if (ew.valueChanged(fobj, infix, "Banned", false)) return false;
		if (ew.valueChanged(fobj, infix, "ClientToken", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fClientgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fClientgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fClientgrid.lists["x_ID_Restaurant"] = <?php echo $Client_grid->ID_Restaurant->Lookup->toClientList($Client_grid) ?>;
	fClientgrid.lists["x_ID_Restaurant"].options = <?php echo JsonEncode($Client_grid->ID_Restaurant->lookupOptions()) ?>;
	fClientgrid.lists["x_Banned"] = <?php echo $Client_grid->Banned->Lookup->toClientList($Client_grid) ?>;
	fClientgrid.lists["x_Banned"].options = <?php echo JsonEncode($Client_grid->Banned->options(FALSE, TRUE)) ?>;
	loadjs.done("fClientgrid");
});
</script>
<?php } ?>
<?php
$Client_grid->renderOtherOptions();
?>
<?php if ($Client_grid->TotalRecords > 0 || $Client->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Client_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> Client">
<?php if ($Client_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $Client_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fClientgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_Client" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_Clientgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$Client->RowType = ROWTYPE_HEADER;

// Render list options
$Client_grid->renderListOptions();

// Render list options (header, left)
$Client_grid->ListOptions->render("header", "left");
?>
<?php if ($Client_grid->ID->Visible) { // ID ?>
	<?php if ($Client_grid->SortUrl($Client_grid->ID) == "") { ?>
		<th data-name="ID" class="<?php echo $Client_grid->ID->headerCellClass() ?>"><div id="elh_Client_ID" class="Client_ID"><div class="ew-table-header-caption"><?php echo $Client_grid->ID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID" class="<?php echo $Client_grid->ID->headerCellClass() ?>"><div><div id="elh_Client_ID" class="Client_ID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Client_grid->ID->caption() ?></span><span class="ew-table-header-sort"><?php if ($Client_grid->ID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Client_grid->ID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Client_grid->ID_Restaurant->Visible) { // ID_Restaurant ?>
	<?php if ($Client_grid->SortUrl($Client_grid->ID_Restaurant) == "") { ?>
		<th data-name="ID_Restaurant" class="<?php echo $Client_grid->ID_Restaurant->headerCellClass() ?>"><div id="elh_Client_ID_Restaurant" class="Client_ID_Restaurant"><div class="ew-table-header-caption"><?php echo $Client_grid->ID_Restaurant->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Restaurant" class="<?php echo $Client_grid->ID_Restaurant->headerCellClass() ?>"><div><div id="elh_Client_ID_Restaurant" class="Client_ID_Restaurant">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Client_grid->ID_Restaurant->caption() ?></span><span class="ew-table-header-sort"><?php if ($Client_grid->ID_Restaurant->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Client_grid->ID_Restaurant->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Client_grid->FirstName->Visible) { // FirstName ?>
	<?php if ($Client_grid->SortUrl($Client_grid->FirstName) == "") { ?>
		<th data-name="FirstName" class="<?php echo $Client_grid->FirstName->headerCellClass() ?>"><div id="elh_Client_FirstName" class="Client_FirstName"><div class="ew-table-header-caption"><?php echo $Client_grid->FirstName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FirstName" class="<?php echo $Client_grid->FirstName->headerCellClass() ?>"><div><div id="elh_Client_FirstName" class="Client_FirstName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Client_grid->FirstName->caption() ?></span><span class="ew-table-header-sort"><?php if ($Client_grid->FirstName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Client_grid->FirstName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Client_grid->LastName->Visible) { // LastName ?>
	<?php if ($Client_grid->SortUrl($Client_grid->LastName) == "") { ?>
		<th data-name="LastName" class="<?php echo $Client_grid->LastName->headerCellClass() ?>"><div id="elh_Client_LastName" class="Client_LastName"><div class="ew-table-header-caption"><?php echo $Client_grid->LastName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastName" class="<?php echo $Client_grid->LastName->headerCellClass() ?>"><div><div id="elh_Client_LastName" class="Client_LastName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Client_grid->LastName->caption() ?></span><span class="ew-table-header-sort"><?php if ($Client_grid->LastName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Client_grid->LastName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Client_grid->_Email->Visible) { // Email ?>
	<?php if ($Client_grid->SortUrl($Client_grid->_Email) == "") { ?>
		<th data-name="_Email" class="<?php echo $Client_grid->_Email->headerCellClass() ?>"><div id="elh_Client__Email" class="Client__Email"><div class="ew-table-header-caption"><?php echo $Client_grid->_Email->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_Email" class="<?php echo $Client_grid->_Email->headerCellClass() ?>"><div><div id="elh_Client__Email" class="Client__Email">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Client_grid->_Email->caption() ?></span><span class="ew-table-header-sort"><?php if ($Client_grid->_Email->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Client_grid->_Email->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Client_grid->Phone->Visible) { // Phone ?>
	<?php if ($Client_grid->SortUrl($Client_grid->Phone) == "") { ?>
		<th data-name="Phone" class="<?php echo $Client_grid->Phone->headerCellClass() ?>"><div id="elh_Client_Phone" class="Client_Phone"><div class="ew-table-header-caption"><?php echo $Client_grid->Phone->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Phone" class="<?php echo $Client_grid->Phone->headerCellClass() ?>"><div><div id="elh_Client_Phone" class="Client_Phone">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Client_grid->Phone->caption() ?></span><span class="ew-table-header-sort"><?php if ($Client_grid->Phone->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Client_grid->Phone->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Client_grid->Banned->Visible) { // Banned ?>
	<?php if ($Client_grid->SortUrl($Client_grid->Banned) == "") { ?>
		<th data-name="Banned" class="<?php echo $Client_grid->Banned->headerCellClass() ?>"><div id="elh_Client_Banned" class="Client_Banned"><div class="ew-table-header-caption"><?php echo $Client_grid->Banned->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Banned" class="<?php echo $Client_grid->Banned->headerCellClass() ?>"><div><div id="elh_Client_Banned" class="Client_Banned">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Client_grid->Banned->caption() ?></span><span class="ew-table-header-sort"><?php if ($Client_grid->Banned->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Client_grid->Banned->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Client_grid->ClientToken->Visible) { // ClientToken ?>
	<?php if ($Client_grid->SortUrl($Client_grid->ClientToken) == "") { ?>
		<th data-name="ClientToken" class="<?php echo $Client_grid->ClientToken->headerCellClass() ?>"><div id="elh_Client_ClientToken" class="Client_ClientToken"><div class="ew-table-header-caption"><?php echo $Client_grid->ClientToken->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ClientToken" class="<?php echo $Client_grid->ClientToken->headerCellClass() ?>"><div><div id="elh_Client_ClientToken" class="Client_ClientToken">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Client_grid->ClientToken->caption() ?></span><span class="ew-table-header-sort"><?php if ($Client_grid->ClientToken->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Client_grid->ClientToken->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$Client_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$Client_grid->StartRecord = 1;
$Client_grid->StopRecord = $Client_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($Client->isConfirm() || $Client_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($Client_grid->FormKeyCountName) && ($Client_grid->isGridAdd() || $Client_grid->isGridEdit() || $Client->isConfirm())) {
		$Client_grid->KeyCount = $CurrentForm->getValue($Client_grid->FormKeyCountName);
		$Client_grid->StopRecord = $Client_grid->StartRecord + $Client_grid->KeyCount - 1;
	}
}
$Client_grid->RecordCount = $Client_grid->StartRecord - 1;
if ($Client_grid->Recordset && !$Client_grid->Recordset->EOF) {
	$Client_grid->Recordset->moveFirst();
	$selectLimit = $Client_grid->UseSelectLimit;
	if (!$selectLimit && $Client_grid->StartRecord > 1)
		$Client_grid->Recordset->move($Client_grid->StartRecord - 1);
} elseif (!$Client->AllowAddDeleteRow && $Client_grid->StopRecord == 0) {
	$Client_grid->StopRecord = $Client->GridAddRowCount;
}

// Initialize aggregate
$Client->RowType = ROWTYPE_AGGREGATEINIT;
$Client->resetAttributes();
$Client_grid->renderRow();
if ($Client_grid->isGridAdd())
	$Client_grid->RowIndex = 0;
if ($Client_grid->isGridEdit())
	$Client_grid->RowIndex = 0;
while ($Client_grid->RecordCount < $Client_grid->StopRecord) {
	$Client_grid->RecordCount++;
	if ($Client_grid->RecordCount >= $Client_grid->StartRecord) {
		$Client_grid->RowCount++;
		if ($Client_grid->isGridAdd() || $Client_grid->isGridEdit() || $Client->isConfirm()) {
			$Client_grid->RowIndex++;
			$CurrentForm->Index = $Client_grid->RowIndex;
			if ($CurrentForm->hasValue($Client_grid->FormActionName) && ($Client->isConfirm() || $Client_grid->EventCancelled))
				$Client_grid->RowAction = strval($CurrentForm->getValue($Client_grid->FormActionName));
			elseif ($Client_grid->isGridAdd())
				$Client_grid->RowAction = "insert";
			else
				$Client_grid->RowAction = "";
		}

		// Set up key count
		$Client_grid->KeyCount = $Client_grid->RowIndex;

		// Init row class and style
		$Client->resetAttributes();
		$Client->CssClass = "";
		if ($Client_grid->isGridAdd()) {
			if ($Client->CurrentMode == "copy") {
				$Client_grid->loadRowValues($Client_grid->Recordset); // Load row values
				$Client_grid->setRecordKey($Client_grid->RowOldKey, $Client_grid->Recordset); // Set old record key
			} else {
				$Client_grid->loadRowValues(); // Load default values
				$Client_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$Client_grid->loadRowValues($Client_grid->Recordset); // Load row values
		}
		$Client->RowType = ROWTYPE_VIEW; // Render view
		if ($Client_grid->isGridAdd()) // Grid add
			$Client->RowType = ROWTYPE_ADD; // Render add
		if ($Client_grid->isGridAdd() && $Client->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$Client_grid->restoreCurrentRowFormValues($Client_grid->RowIndex); // Restore form values
		if ($Client_grid->isGridEdit()) { // Grid edit
			if ($Client->EventCancelled)
				$Client_grid->restoreCurrentRowFormValues($Client_grid->RowIndex); // Restore form values
			if ($Client_grid->RowAction == "insert")
				$Client->RowType = ROWTYPE_ADD; // Render add
			else
				$Client->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($Client_grid->isGridEdit() && ($Client->RowType == ROWTYPE_EDIT || $Client->RowType == ROWTYPE_ADD) && $Client->EventCancelled) // Update failed
			$Client_grid->restoreCurrentRowFormValues($Client_grid->RowIndex); // Restore form values
		if ($Client->RowType == ROWTYPE_EDIT) // Edit row
			$Client_grid->EditRowCount++;
		if ($Client->isConfirm()) // Confirm row
			$Client_grid->restoreCurrentRowFormValues($Client_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$Client->RowAttrs->merge(["data-rowindex" => $Client_grid->RowCount, "id" => "r" . $Client_grid->RowCount . "_Client", "data-rowtype" => $Client->RowType]);

		// Render row
		$Client_grid->renderRow();

		// Render list options
		$Client_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($Client_grid->RowAction != "delete" && $Client_grid->RowAction != "insertdelete" && !($Client_grid->RowAction == "insert" && $Client->isConfirm() && $Client_grid->emptyRow())) {
?>
	<tr <?php echo $Client->rowAttributes() ?>>
<?php

// Render list options (body, left)
$Client_grid->ListOptions->render("body", "left", $Client_grid->RowCount);
?>
	<?php if ($Client_grid->ID->Visible) { // ID ?>
		<td data-name="ID" <?php echo $Client_grid->ID->cellAttributes() ?>>
<?php if ($Client->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Client_grid->RowCount ?>_Client_ID" class="form-group"></span>
<input type="hidden" data-table="Client" data-field="x_ID" name="o<?php echo $Client_grid->RowIndex ?>_ID" id="o<?php echo $Client_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($Client_grid->ID->OldValue) ?>">
<?php } ?>
<?php if ($Client->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Client_grid->RowCount ?>_Client_ID" class="form-group">
<span<?php echo $Client_grid->ID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Client_grid->ID->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="Client" data-field="x_ID" name="x<?php echo $Client_grid->RowIndex ?>_ID" id="x<?php echo $Client_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($Client_grid->ID->CurrentValue) ?>">
<?php } ?>
<?php if ($Client->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Client_grid->RowCount ?>_Client_ID">
<span<?php echo $Client_grid->ID->viewAttributes() ?>><?php echo $Client_grid->ID->getViewValue() ?></span>
</span>
<?php if (!$Client->isConfirm()) { ?>
<input type="hidden" data-table="Client" data-field="x_ID" name="x<?php echo $Client_grid->RowIndex ?>_ID" id="x<?php echo $Client_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($Client_grid->ID->FormValue) ?>">
<input type="hidden" data-table="Client" data-field="x_ID" name="o<?php echo $Client_grid->RowIndex ?>_ID" id="o<?php echo $Client_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($Client_grid->ID->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="Client" data-field="x_ID" name="fClientgrid$x<?php echo $Client_grid->RowIndex ?>_ID" id="fClientgrid$x<?php echo $Client_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($Client_grid->ID->FormValue) ?>">
<input type="hidden" data-table="Client" data-field="x_ID" name="fClientgrid$o<?php echo $Client_grid->RowIndex ?>_ID" id="fClientgrid$o<?php echo $Client_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($Client_grid->ID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Client_grid->ID_Restaurant->Visible) { // ID_Restaurant ?>
		<td data-name="ID_Restaurant" <?php echo $Client_grid->ID_Restaurant->cellAttributes() ?>>
<?php if ($Client->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($Client_grid->ID_Restaurant->getSessionValue() != "") { ?>
<span id="el<?php echo $Client_grid->RowCount ?>_Client_ID_Restaurant" class="form-group">
<span<?php echo $Client_grid->ID_Restaurant->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Client_grid->ID_Restaurant->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $Client_grid->RowIndex ?>_ID_Restaurant" name="x<?php echo $Client_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($Client_grid->ID_Restaurant->CurrentValue) ?>">
<?php } elseif (!$Security->isAdmin() && $Security->isLoggedIn() && !$Client->userIDAllow("grid")) { // Non system admin ?>
<span id="el<?php echo $Client_grid->RowCount ?>_Client_ID_Restaurant" class="form-group">
<span<?php echo $Client_grid->ID_Restaurant->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Client_grid->ID_Restaurant->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="Client" data-field="x_ID_Restaurant" name="x<?php echo $Client_grid->RowIndex ?>_ID_Restaurant" id="x<?php echo $Client_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($Client_grid->ID_Restaurant->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $Client_grid->RowCount ?>_Client_ID_Restaurant" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Client" data-field="x_ID_Restaurant" data-value-separator="<?php echo $Client_grid->ID_Restaurant->displayValueSeparatorAttribute() ?>" id="x<?php echo $Client_grid->RowIndex ?>_ID_Restaurant" name="x<?php echo $Client_grid->RowIndex ?>_ID_Restaurant"<?php echo $Client_grid->ID_Restaurant->editAttributes() ?>>
			<?php echo $Client_grid->ID_Restaurant->selectOptionListHtml("x{$Client_grid->RowIndex}_ID_Restaurant") ?>
		</select>
</div>
<?php echo $Client_grid->ID_Restaurant->Lookup->getParamTag($Client_grid, "p_x" . $Client_grid->RowIndex . "_ID_Restaurant") ?>
</span>
<?php } ?>
<input type="hidden" data-table="Client" data-field="x_ID_Restaurant" name="o<?php echo $Client_grid->RowIndex ?>_ID_Restaurant" id="o<?php echo $Client_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($Client_grid->ID_Restaurant->OldValue) ?>">
<?php } ?>
<?php if ($Client->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($Client_grid->ID_Restaurant->getSessionValue() != "") { ?>
<span id="el<?php echo $Client_grid->RowCount ?>_Client_ID_Restaurant" class="form-group">
<span<?php echo $Client_grid->ID_Restaurant->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Client_grid->ID_Restaurant->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $Client_grid->RowIndex ?>_ID_Restaurant" name="x<?php echo $Client_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($Client_grid->ID_Restaurant->CurrentValue) ?>">
<?php } elseif (!$Security->isAdmin() && $Security->isLoggedIn() && !$Client->userIDAllow("grid")) { // Non system admin ?>
<span id="el<?php echo $Client_grid->RowCount ?>_Client_ID_Restaurant" class="form-group">
<span<?php echo $Client_grid->ID_Restaurant->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Client_grid->ID_Restaurant->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="Client" data-field="x_ID_Restaurant" name="x<?php echo $Client_grid->RowIndex ?>_ID_Restaurant" id="x<?php echo $Client_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($Client_grid->ID_Restaurant->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $Client_grid->RowCount ?>_Client_ID_Restaurant" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Client" data-field="x_ID_Restaurant" data-value-separator="<?php echo $Client_grid->ID_Restaurant->displayValueSeparatorAttribute() ?>" id="x<?php echo $Client_grid->RowIndex ?>_ID_Restaurant" name="x<?php echo $Client_grid->RowIndex ?>_ID_Restaurant"<?php echo $Client_grid->ID_Restaurant->editAttributes() ?>>
			<?php echo $Client_grid->ID_Restaurant->selectOptionListHtml("x{$Client_grid->RowIndex}_ID_Restaurant") ?>
		</select>
</div>
<?php echo $Client_grid->ID_Restaurant->Lookup->getParamTag($Client_grid, "p_x" . $Client_grid->RowIndex . "_ID_Restaurant") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($Client->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Client_grid->RowCount ?>_Client_ID_Restaurant">
<span<?php echo $Client_grid->ID_Restaurant->viewAttributes() ?>><?php echo $Client_grid->ID_Restaurant->getViewValue() ?></span>
</span>
<?php if (!$Client->isConfirm()) { ?>
<input type="hidden" data-table="Client" data-field="x_ID_Restaurant" name="x<?php echo $Client_grid->RowIndex ?>_ID_Restaurant" id="x<?php echo $Client_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($Client_grid->ID_Restaurant->FormValue) ?>">
<input type="hidden" data-table="Client" data-field="x_ID_Restaurant" name="o<?php echo $Client_grid->RowIndex ?>_ID_Restaurant" id="o<?php echo $Client_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($Client_grid->ID_Restaurant->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="Client" data-field="x_ID_Restaurant" name="fClientgrid$x<?php echo $Client_grid->RowIndex ?>_ID_Restaurant" id="fClientgrid$x<?php echo $Client_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($Client_grid->ID_Restaurant->FormValue) ?>">
<input type="hidden" data-table="Client" data-field="x_ID_Restaurant" name="fClientgrid$o<?php echo $Client_grid->RowIndex ?>_ID_Restaurant" id="fClientgrid$o<?php echo $Client_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($Client_grid->ID_Restaurant->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Client_grid->FirstName->Visible) { // FirstName ?>
		<td data-name="FirstName" <?php echo $Client_grid->FirstName->cellAttributes() ?>>
<?php if ($Client->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Client_grid->RowCount ?>_Client_FirstName" class="form-group">
<input type="text" data-table="Client" data-field="x_FirstName" name="x<?php echo $Client_grid->RowIndex ?>_FirstName" id="x<?php echo $Client_grid->RowIndex ?>_FirstName" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Client_grid->FirstName->getPlaceHolder()) ?>" value="<?php echo $Client_grid->FirstName->EditValue ?>"<?php echo $Client_grid->FirstName->editAttributes() ?>>
</span>
<input type="hidden" data-table="Client" data-field="x_FirstName" name="o<?php echo $Client_grid->RowIndex ?>_FirstName" id="o<?php echo $Client_grid->RowIndex ?>_FirstName" value="<?php echo HtmlEncode($Client_grid->FirstName->OldValue) ?>">
<?php } ?>
<?php if ($Client->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Client_grid->RowCount ?>_Client_FirstName" class="form-group">
<input type="text" data-table="Client" data-field="x_FirstName" name="x<?php echo $Client_grid->RowIndex ?>_FirstName" id="x<?php echo $Client_grid->RowIndex ?>_FirstName" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Client_grid->FirstName->getPlaceHolder()) ?>" value="<?php echo $Client_grid->FirstName->EditValue ?>"<?php echo $Client_grid->FirstName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($Client->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Client_grid->RowCount ?>_Client_FirstName">
<span<?php echo $Client_grid->FirstName->viewAttributes() ?>><?php echo $Client_grid->FirstName->getViewValue() ?></span>
</span>
<?php if (!$Client->isConfirm()) { ?>
<input type="hidden" data-table="Client" data-field="x_FirstName" name="x<?php echo $Client_grid->RowIndex ?>_FirstName" id="x<?php echo $Client_grid->RowIndex ?>_FirstName" value="<?php echo HtmlEncode($Client_grid->FirstName->FormValue) ?>">
<input type="hidden" data-table="Client" data-field="x_FirstName" name="o<?php echo $Client_grid->RowIndex ?>_FirstName" id="o<?php echo $Client_grid->RowIndex ?>_FirstName" value="<?php echo HtmlEncode($Client_grid->FirstName->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="Client" data-field="x_FirstName" name="fClientgrid$x<?php echo $Client_grid->RowIndex ?>_FirstName" id="fClientgrid$x<?php echo $Client_grid->RowIndex ?>_FirstName" value="<?php echo HtmlEncode($Client_grid->FirstName->FormValue) ?>">
<input type="hidden" data-table="Client" data-field="x_FirstName" name="fClientgrid$o<?php echo $Client_grid->RowIndex ?>_FirstName" id="fClientgrid$o<?php echo $Client_grid->RowIndex ?>_FirstName" value="<?php echo HtmlEncode($Client_grid->FirstName->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Client_grid->LastName->Visible) { // LastName ?>
		<td data-name="LastName" <?php echo $Client_grid->LastName->cellAttributes() ?>>
<?php if ($Client->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Client_grid->RowCount ?>_Client_LastName" class="form-group">
<input type="text" data-table="Client" data-field="x_LastName" name="x<?php echo $Client_grid->RowIndex ?>_LastName" id="x<?php echo $Client_grid->RowIndex ?>_LastName" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Client_grid->LastName->getPlaceHolder()) ?>" value="<?php echo $Client_grid->LastName->EditValue ?>"<?php echo $Client_grid->LastName->editAttributes() ?>>
</span>
<input type="hidden" data-table="Client" data-field="x_LastName" name="o<?php echo $Client_grid->RowIndex ?>_LastName" id="o<?php echo $Client_grid->RowIndex ?>_LastName" value="<?php echo HtmlEncode($Client_grid->LastName->OldValue) ?>">
<?php } ?>
<?php if ($Client->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Client_grid->RowCount ?>_Client_LastName" class="form-group">
<input type="text" data-table="Client" data-field="x_LastName" name="x<?php echo $Client_grid->RowIndex ?>_LastName" id="x<?php echo $Client_grid->RowIndex ?>_LastName" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Client_grid->LastName->getPlaceHolder()) ?>" value="<?php echo $Client_grid->LastName->EditValue ?>"<?php echo $Client_grid->LastName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($Client->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Client_grid->RowCount ?>_Client_LastName">
<span<?php echo $Client_grid->LastName->viewAttributes() ?>><?php echo $Client_grid->LastName->getViewValue() ?></span>
</span>
<?php if (!$Client->isConfirm()) { ?>
<input type="hidden" data-table="Client" data-field="x_LastName" name="x<?php echo $Client_grid->RowIndex ?>_LastName" id="x<?php echo $Client_grid->RowIndex ?>_LastName" value="<?php echo HtmlEncode($Client_grid->LastName->FormValue) ?>">
<input type="hidden" data-table="Client" data-field="x_LastName" name="o<?php echo $Client_grid->RowIndex ?>_LastName" id="o<?php echo $Client_grid->RowIndex ?>_LastName" value="<?php echo HtmlEncode($Client_grid->LastName->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="Client" data-field="x_LastName" name="fClientgrid$x<?php echo $Client_grid->RowIndex ?>_LastName" id="fClientgrid$x<?php echo $Client_grid->RowIndex ?>_LastName" value="<?php echo HtmlEncode($Client_grid->LastName->FormValue) ?>">
<input type="hidden" data-table="Client" data-field="x_LastName" name="fClientgrid$o<?php echo $Client_grid->RowIndex ?>_LastName" id="fClientgrid$o<?php echo $Client_grid->RowIndex ?>_LastName" value="<?php echo HtmlEncode($Client_grid->LastName->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Client_grid->_Email->Visible) { // Email ?>
		<td data-name="_Email" <?php echo $Client_grid->_Email->cellAttributes() ?>>
<?php if ($Client->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Client_grid->RowCount ?>_Client__Email" class="form-group">
<input type="text" data-table="Client" data-field="x__Email" name="x<?php echo $Client_grid->RowIndex ?>__Email" id="x<?php echo $Client_grid->RowIndex ?>__Email" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Client_grid->_Email->getPlaceHolder()) ?>" value="<?php echo $Client_grid->_Email->EditValue ?>"<?php echo $Client_grid->_Email->editAttributes() ?>>
</span>
<input type="hidden" data-table="Client" data-field="x__Email" name="o<?php echo $Client_grid->RowIndex ?>__Email" id="o<?php echo $Client_grid->RowIndex ?>__Email" value="<?php echo HtmlEncode($Client_grid->_Email->OldValue) ?>">
<?php } ?>
<?php if ($Client->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Client_grid->RowCount ?>_Client__Email" class="form-group">
<input type="text" data-table="Client" data-field="x__Email" name="x<?php echo $Client_grid->RowIndex ?>__Email" id="x<?php echo $Client_grid->RowIndex ?>__Email" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Client_grid->_Email->getPlaceHolder()) ?>" value="<?php echo $Client_grid->_Email->EditValue ?>"<?php echo $Client_grid->_Email->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($Client->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Client_grid->RowCount ?>_Client__Email">
<span<?php echo $Client_grid->_Email->viewAttributes() ?>><?php echo $Client_grid->_Email->getViewValue() ?></span>
</span>
<?php if (!$Client->isConfirm()) { ?>
<input type="hidden" data-table="Client" data-field="x__Email" name="x<?php echo $Client_grid->RowIndex ?>__Email" id="x<?php echo $Client_grid->RowIndex ?>__Email" value="<?php echo HtmlEncode($Client_grid->_Email->FormValue) ?>">
<input type="hidden" data-table="Client" data-field="x__Email" name="o<?php echo $Client_grid->RowIndex ?>__Email" id="o<?php echo $Client_grid->RowIndex ?>__Email" value="<?php echo HtmlEncode($Client_grid->_Email->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="Client" data-field="x__Email" name="fClientgrid$x<?php echo $Client_grid->RowIndex ?>__Email" id="fClientgrid$x<?php echo $Client_grid->RowIndex ?>__Email" value="<?php echo HtmlEncode($Client_grid->_Email->FormValue) ?>">
<input type="hidden" data-table="Client" data-field="x__Email" name="fClientgrid$o<?php echo $Client_grid->RowIndex ?>__Email" id="fClientgrid$o<?php echo $Client_grid->RowIndex ?>__Email" value="<?php echo HtmlEncode($Client_grid->_Email->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Client_grid->Phone->Visible) { // Phone ?>
		<td data-name="Phone" <?php echo $Client_grid->Phone->cellAttributes() ?>>
<?php if ($Client->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Client_grid->RowCount ?>_Client_Phone" class="form-group">
<input type="text" data-table="Client" data-field="x_Phone" name="x<?php echo $Client_grid->RowIndex ?>_Phone" id="x<?php echo $Client_grid->RowIndex ?>_Phone" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Client_grid->Phone->getPlaceHolder()) ?>" value="<?php echo $Client_grid->Phone->EditValue ?>"<?php echo $Client_grid->Phone->editAttributes() ?>>
</span>
<input type="hidden" data-table="Client" data-field="x_Phone" name="o<?php echo $Client_grid->RowIndex ?>_Phone" id="o<?php echo $Client_grid->RowIndex ?>_Phone" value="<?php echo HtmlEncode($Client_grid->Phone->OldValue) ?>">
<?php } ?>
<?php if ($Client->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Client_grid->RowCount ?>_Client_Phone" class="form-group">
<input type="text" data-table="Client" data-field="x_Phone" name="x<?php echo $Client_grid->RowIndex ?>_Phone" id="x<?php echo $Client_grid->RowIndex ?>_Phone" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Client_grid->Phone->getPlaceHolder()) ?>" value="<?php echo $Client_grid->Phone->EditValue ?>"<?php echo $Client_grid->Phone->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($Client->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Client_grid->RowCount ?>_Client_Phone">
<span<?php echo $Client_grid->Phone->viewAttributes() ?>><?php echo $Client_grid->Phone->getViewValue() ?></span>
</span>
<?php if (!$Client->isConfirm()) { ?>
<input type="hidden" data-table="Client" data-field="x_Phone" name="x<?php echo $Client_grid->RowIndex ?>_Phone" id="x<?php echo $Client_grid->RowIndex ?>_Phone" value="<?php echo HtmlEncode($Client_grid->Phone->FormValue) ?>">
<input type="hidden" data-table="Client" data-field="x_Phone" name="o<?php echo $Client_grid->RowIndex ?>_Phone" id="o<?php echo $Client_grid->RowIndex ?>_Phone" value="<?php echo HtmlEncode($Client_grid->Phone->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="Client" data-field="x_Phone" name="fClientgrid$x<?php echo $Client_grid->RowIndex ?>_Phone" id="fClientgrid$x<?php echo $Client_grid->RowIndex ?>_Phone" value="<?php echo HtmlEncode($Client_grid->Phone->FormValue) ?>">
<input type="hidden" data-table="Client" data-field="x_Phone" name="fClientgrid$o<?php echo $Client_grid->RowIndex ?>_Phone" id="fClientgrid$o<?php echo $Client_grid->RowIndex ?>_Phone" value="<?php echo HtmlEncode($Client_grid->Phone->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Client_grid->Banned->Visible) { // Banned ?>
		<td data-name="Banned" <?php echo $Client_grid->Banned->cellAttributes() ?>>
<?php if ($Client->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Client_grid->RowCount ?>_Client_Banned" class="form-group">
<div id="tp_x<?php echo $Client_grid->RowIndex ?>_Banned" class="ew-template"><input type="radio" class="custom-control-input" data-table="Client" data-field="x_Banned" data-value-separator="<?php echo $Client_grid->Banned->displayValueSeparatorAttribute() ?>" name="x<?php echo $Client_grid->RowIndex ?>_Banned" id="x<?php echo $Client_grid->RowIndex ?>_Banned" value="{value}"<?php echo $Client_grid->Banned->editAttributes() ?>></div>
<div id="dsl_x<?php echo $Client_grid->RowIndex ?>_Banned" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $Client_grid->Banned->radioButtonListHtml(FALSE, "x{$Client_grid->RowIndex}_Banned") ?>
</div></div>
</span>
<input type="hidden" data-table="Client" data-field="x_Banned" name="o<?php echo $Client_grid->RowIndex ?>_Banned" id="o<?php echo $Client_grid->RowIndex ?>_Banned" value="<?php echo HtmlEncode($Client_grid->Banned->OldValue) ?>">
<?php } ?>
<?php if ($Client->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Client_grid->RowCount ?>_Client_Banned" class="form-group">
<div id="tp_x<?php echo $Client_grid->RowIndex ?>_Banned" class="ew-template"><input type="radio" class="custom-control-input" data-table="Client" data-field="x_Banned" data-value-separator="<?php echo $Client_grid->Banned->displayValueSeparatorAttribute() ?>" name="x<?php echo $Client_grid->RowIndex ?>_Banned" id="x<?php echo $Client_grid->RowIndex ?>_Banned" value="{value}"<?php echo $Client_grid->Banned->editAttributes() ?>></div>
<div id="dsl_x<?php echo $Client_grid->RowIndex ?>_Banned" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $Client_grid->Banned->radioButtonListHtml(FALSE, "x{$Client_grid->RowIndex}_Banned") ?>
</div></div>
</span>
<?php } ?>
<?php if ($Client->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Client_grid->RowCount ?>_Client_Banned">
<span<?php echo $Client_grid->Banned->viewAttributes() ?>><?php echo $Client_grid->Banned->getViewValue() ?></span>
</span>
<?php if (!$Client->isConfirm()) { ?>
<input type="hidden" data-table="Client" data-field="x_Banned" name="x<?php echo $Client_grid->RowIndex ?>_Banned" id="x<?php echo $Client_grid->RowIndex ?>_Banned" value="<?php echo HtmlEncode($Client_grid->Banned->FormValue) ?>">
<input type="hidden" data-table="Client" data-field="x_Banned" name="o<?php echo $Client_grid->RowIndex ?>_Banned" id="o<?php echo $Client_grid->RowIndex ?>_Banned" value="<?php echo HtmlEncode($Client_grid->Banned->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="Client" data-field="x_Banned" name="fClientgrid$x<?php echo $Client_grid->RowIndex ?>_Banned" id="fClientgrid$x<?php echo $Client_grid->RowIndex ?>_Banned" value="<?php echo HtmlEncode($Client_grid->Banned->FormValue) ?>">
<input type="hidden" data-table="Client" data-field="x_Banned" name="fClientgrid$o<?php echo $Client_grid->RowIndex ?>_Banned" id="fClientgrid$o<?php echo $Client_grid->RowIndex ?>_Banned" value="<?php echo HtmlEncode($Client_grid->Banned->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Client_grid->ClientToken->Visible) { // ClientToken ?>
		<td data-name="ClientToken" <?php echo $Client_grid->ClientToken->cellAttributes() ?>>
<?php if ($Client->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Client_grid->RowCount ?>_Client_ClientToken" class="form-group">
<input type="text" data-table="Client" data-field="x_ClientToken" name="x<?php echo $Client_grid->RowIndex ?>_ClientToken" id="x<?php echo $Client_grid->RowIndex ?>_ClientToken" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Client_grid->ClientToken->getPlaceHolder()) ?>" value="<?php echo $Client_grid->ClientToken->EditValue ?>"<?php echo $Client_grid->ClientToken->editAttributes() ?>>
</span>
<input type="hidden" data-table="Client" data-field="x_ClientToken" name="o<?php echo $Client_grid->RowIndex ?>_ClientToken" id="o<?php echo $Client_grid->RowIndex ?>_ClientToken" value="<?php echo HtmlEncode($Client_grid->ClientToken->OldValue) ?>">
<?php } ?>
<?php if ($Client->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Client_grid->RowCount ?>_Client_ClientToken" class="form-group">
<input type="text" data-table="Client" data-field="x_ClientToken" name="x<?php echo $Client_grid->RowIndex ?>_ClientToken" id="x<?php echo $Client_grid->RowIndex ?>_ClientToken" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Client_grid->ClientToken->getPlaceHolder()) ?>" value="<?php echo $Client_grid->ClientToken->EditValue ?>"<?php echo $Client_grid->ClientToken->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($Client->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Client_grid->RowCount ?>_Client_ClientToken">
<span<?php echo $Client_grid->ClientToken->viewAttributes() ?>><?php echo $Client_grid->ClientToken->getViewValue() ?></span>
</span>
<?php if (!$Client->isConfirm()) { ?>
<input type="hidden" data-table="Client" data-field="x_ClientToken" name="x<?php echo $Client_grid->RowIndex ?>_ClientToken" id="x<?php echo $Client_grid->RowIndex ?>_ClientToken" value="<?php echo HtmlEncode($Client_grid->ClientToken->FormValue) ?>">
<input type="hidden" data-table="Client" data-field="x_ClientToken" name="o<?php echo $Client_grid->RowIndex ?>_ClientToken" id="o<?php echo $Client_grid->RowIndex ?>_ClientToken" value="<?php echo HtmlEncode($Client_grid->ClientToken->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="Client" data-field="x_ClientToken" name="fClientgrid$x<?php echo $Client_grid->RowIndex ?>_ClientToken" id="fClientgrid$x<?php echo $Client_grid->RowIndex ?>_ClientToken" value="<?php echo HtmlEncode($Client_grid->ClientToken->FormValue) ?>">
<input type="hidden" data-table="Client" data-field="x_ClientToken" name="fClientgrid$o<?php echo $Client_grid->RowIndex ?>_ClientToken" id="fClientgrid$o<?php echo $Client_grid->RowIndex ?>_ClientToken" value="<?php echo HtmlEncode($Client_grid->ClientToken->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$Client_grid->ListOptions->render("body", "right", $Client_grid->RowCount);
?>
	</tr>
<?php if ($Client->RowType == ROWTYPE_ADD || $Client->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fClientgrid", "load"], function() {
	fClientgrid.updateLists(<?php echo $Client_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$Client_grid->isGridAdd() || $Client->CurrentMode == "copy")
		if (!$Client_grid->Recordset->EOF)
			$Client_grid->Recordset->moveNext();
}
?>
<?php
	if ($Client->CurrentMode == "add" || $Client->CurrentMode == "copy" || $Client->CurrentMode == "edit") {
		$Client_grid->RowIndex = '$rowindex$';
		$Client_grid->loadRowValues();

		// Set row properties
		$Client->resetAttributes();
		$Client->RowAttrs->merge(["data-rowindex" => $Client_grid->RowIndex, "id" => "r0_Client", "data-rowtype" => ROWTYPE_ADD]);
		$Client->RowAttrs->appendClass("ew-template");
		$Client->RowType = ROWTYPE_ADD;

		// Render row
		$Client_grid->renderRow();

		// Render list options
		$Client_grid->renderListOptions();
		$Client_grid->StartRowCount = 0;
?>
	<tr <?php echo $Client->rowAttributes() ?>>
<?php

// Render list options (body, left)
$Client_grid->ListOptions->render("body", "left", $Client_grid->RowIndex);
?>
	<?php if ($Client_grid->ID->Visible) { // ID ?>
		<td data-name="ID">
<?php if (!$Client->isConfirm()) { ?>
<span id="el$rowindex$_Client_ID" class="form-group Client_ID"></span>
<?php } else { ?>
<span id="el$rowindex$_Client_ID" class="form-group Client_ID">
<span<?php echo $Client_grid->ID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Client_grid->ID->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="Client" data-field="x_ID" name="x<?php echo $Client_grid->RowIndex ?>_ID" id="x<?php echo $Client_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($Client_grid->ID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="Client" data-field="x_ID" name="o<?php echo $Client_grid->RowIndex ?>_ID" id="o<?php echo $Client_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($Client_grid->ID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Client_grid->ID_Restaurant->Visible) { // ID_Restaurant ?>
		<td data-name="ID_Restaurant">
<?php if (!$Client->isConfirm()) { ?>
<?php if ($Client_grid->ID_Restaurant->getSessionValue() != "") { ?>
<span id="el$rowindex$_Client_ID_Restaurant" class="form-group Client_ID_Restaurant">
<span<?php echo $Client_grid->ID_Restaurant->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Client_grid->ID_Restaurant->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $Client_grid->RowIndex ?>_ID_Restaurant" name="x<?php echo $Client_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($Client_grid->ID_Restaurant->CurrentValue) ?>">
<?php } elseif (!$Security->isAdmin() && $Security->isLoggedIn() && !$Client->userIDAllow("grid")) { // Non system admin ?>
<span id="el$rowindex$_Client_ID_Restaurant" class="form-group Client_ID_Restaurant">
<span<?php echo $Client_grid->ID_Restaurant->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Client_grid->ID_Restaurant->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="Client" data-field="x_ID_Restaurant" name="x<?php echo $Client_grid->RowIndex ?>_ID_Restaurant" id="x<?php echo $Client_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($Client_grid->ID_Restaurant->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_Client_ID_Restaurant" class="form-group Client_ID_Restaurant">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Client" data-field="x_ID_Restaurant" data-value-separator="<?php echo $Client_grid->ID_Restaurant->displayValueSeparatorAttribute() ?>" id="x<?php echo $Client_grid->RowIndex ?>_ID_Restaurant" name="x<?php echo $Client_grid->RowIndex ?>_ID_Restaurant"<?php echo $Client_grid->ID_Restaurant->editAttributes() ?>>
			<?php echo $Client_grid->ID_Restaurant->selectOptionListHtml("x{$Client_grid->RowIndex}_ID_Restaurant") ?>
		</select>
</div>
<?php echo $Client_grid->ID_Restaurant->Lookup->getParamTag($Client_grid, "p_x" . $Client_grid->RowIndex . "_ID_Restaurant") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_Client_ID_Restaurant" class="form-group Client_ID_Restaurant">
<span<?php echo $Client_grid->ID_Restaurant->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Client_grid->ID_Restaurant->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="Client" data-field="x_ID_Restaurant" name="x<?php echo $Client_grid->RowIndex ?>_ID_Restaurant" id="x<?php echo $Client_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($Client_grid->ID_Restaurant->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="Client" data-field="x_ID_Restaurant" name="o<?php echo $Client_grid->RowIndex ?>_ID_Restaurant" id="o<?php echo $Client_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($Client_grid->ID_Restaurant->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Client_grid->FirstName->Visible) { // FirstName ?>
		<td data-name="FirstName">
<?php if (!$Client->isConfirm()) { ?>
<span id="el$rowindex$_Client_FirstName" class="form-group Client_FirstName">
<input type="text" data-table="Client" data-field="x_FirstName" name="x<?php echo $Client_grid->RowIndex ?>_FirstName" id="x<?php echo $Client_grid->RowIndex ?>_FirstName" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Client_grid->FirstName->getPlaceHolder()) ?>" value="<?php echo $Client_grid->FirstName->EditValue ?>"<?php echo $Client_grid->FirstName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_Client_FirstName" class="form-group Client_FirstName">
<span<?php echo $Client_grid->FirstName->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Client_grid->FirstName->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="Client" data-field="x_FirstName" name="x<?php echo $Client_grid->RowIndex ?>_FirstName" id="x<?php echo $Client_grid->RowIndex ?>_FirstName" value="<?php echo HtmlEncode($Client_grid->FirstName->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="Client" data-field="x_FirstName" name="o<?php echo $Client_grid->RowIndex ?>_FirstName" id="o<?php echo $Client_grid->RowIndex ?>_FirstName" value="<?php echo HtmlEncode($Client_grid->FirstName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Client_grid->LastName->Visible) { // LastName ?>
		<td data-name="LastName">
<?php if (!$Client->isConfirm()) { ?>
<span id="el$rowindex$_Client_LastName" class="form-group Client_LastName">
<input type="text" data-table="Client" data-field="x_LastName" name="x<?php echo $Client_grid->RowIndex ?>_LastName" id="x<?php echo $Client_grid->RowIndex ?>_LastName" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Client_grid->LastName->getPlaceHolder()) ?>" value="<?php echo $Client_grid->LastName->EditValue ?>"<?php echo $Client_grid->LastName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_Client_LastName" class="form-group Client_LastName">
<span<?php echo $Client_grid->LastName->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Client_grid->LastName->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="Client" data-field="x_LastName" name="x<?php echo $Client_grid->RowIndex ?>_LastName" id="x<?php echo $Client_grid->RowIndex ?>_LastName" value="<?php echo HtmlEncode($Client_grid->LastName->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="Client" data-field="x_LastName" name="o<?php echo $Client_grid->RowIndex ?>_LastName" id="o<?php echo $Client_grid->RowIndex ?>_LastName" value="<?php echo HtmlEncode($Client_grid->LastName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Client_grid->_Email->Visible) { // Email ?>
		<td data-name="_Email">
<?php if (!$Client->isConfirm()) { ?>
<span id="el$rowindex$_Client__Email" class="form-group Client__Email">
<input type="text" data-table="Client" data-field="x__Email" name="x<?php echo $Client_grid->RowIndex ?>__Email" id="x<?php echo $Client_grid->RowIndex ?>__Email" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Client_grid->_Email->getPlaceHolder()) ?>" value="<?php echo $Client_grid->_Email->EditValue ?>"<?php echo $Client_grid->_Email->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_Client__Email" class="form-group Client__Email">
<span<?php echo $Client_grid->_Email->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Client_grid->_Email->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="Client" data-field="x__Email" name="x<?php echo $Client_grid->RowIndex ?>__Email" id="x<?php echo $Client_grid->RowIndex ?>__Email" value="<?php echo HtmlEncode($Client_grid->_Email->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="Client" data-field="x__Email" name="o<?php echo $Client_grid->RowIndex ?>__Email" id="o<?php echo $Client_grid->RowIndex ?>__Email" value="<?php echo HtmlEncode($Client_grid->_Email->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Client_grid->Phone->Visible) { // Phone ?>
		<td data-name="Phone">
<?php if (!$Client->isConfirm()) { ?>
<span id="el$rowindex$_Client_Phone" class="form-group Client_Phone">
<input type="text" data-table="Client" data-field="x_Phone" name="x<?php echo $Client_grid->RowIndex ?>_Phone" id="x<?php echo $Client_grid->RowIndex ?>_Phone" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Client_grid->Phone->getPlaceHolder()) ?>" value="<?php echo $Client_grid->Phone->EditValue ?>"<?php echo $Client_grid->Phone->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_Client_Phone" class="form-group Client_Phone">
<span<?php echo $Client_grid->Phone->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Client_grid->Phone->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="Client" data-field="x_Phone" name="x<?php echo $Client_grid->RowIndex ?>_Phone" id="x<?php echo $Client_grid->RowIndex ?>_Phone" value="<?php echo HtmlEncode($Client_grid->Phone->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="Client" data-field="x_Phone" name="o<?php echo $Client_grid->RowIndex ?>_Phone" id="o<?php echo $Client_grid->RowIndex ?>_Phone" value="<?php echo HtmlEncode($Client_grid->Phone->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Client_grid->Banned->Visible) { // Banned ?>
		<td data-name="Banned">
<?php if (!$Client->isConfirm()) { ?>
<span id="el$rowindex$_Client_Banned" class="form-group Client_Banned">
<div id="tp_x<?php echo $Client_grid->RowIndex ?>_Banned" class="ew-template"><input type="radio" class="custom-control-input" data-table="Client" data-field="x_Banned" data-value-separator="<?php echo $Client_grid->Banned->displayValueSeparatorAttribute() ?>" name="x<?php echo $Client_grid->RowIndex ?>_Banned" id="x<?php echo $Client_grid->RowIndex ?>_Banned" value="{value}"<?php echo $Client_grid->Banned->editAttributes() ?>></div>
<div id="dsl_x<?php echo $Client_grid->RowIndex ?>_Banned" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $Client_grid->Banned->radioButtonListHtml(FALSE, "x{$Client_grid->RowIndex}_Banned") ?>
</div></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_Client_Banned" class="form-group Client_Banned">
<span<?php echo $Client_grid->Banned->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Client_grid->Banned->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="Client" data-field="x_Banned" name="x<?php echo $Client_grid->RowIndex ?>_Banned" id="x<?php echo $Client_grid->RowIndex ?>_Banned" value="<?php echo HtmlEncode($Client_grid->Banned->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="Client" data-field="x_Banned" name="o<?php echo $Client_grid->RowIndex ?>_Banned" id="o<?php echo $Client_grid->RowIndex ?>_Banned" value="<?php echo HtmlEncode($Client_grid->Banned->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Client_grid->ClientToken->Visible) { // ClientToken ?>
		<td data-name="ClientToken">
<?php if (!$Client->isConfirm()) { ?>
<span id="el$rowindex$_Client_ClientToken" class="form-group Client_ClientToken">
<input type="text" data-table="Client" data-field="x_ClientToken" name="x<?php echo $Client_grid->RowIndex ?>_ClientToken" id="x<?php echo $Client_grid->RowIndex ?>_ClientToken" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Client_grid->ClientToken->getPlaceHolder()) ?>" value="<?php echo $Client_grid->ClientToken->EditValue ?>"<?php echo $Client_grid->ClientToken->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_Client_ClientToken" class="form-group Client_ClientToken">
<span<?php echo $Client_grid->ClientToken->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Client_grid->ClientToken->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="Client" data-field="x_ClientToken" name="x<?php echo $Client_grid->RowIndex ?>_ClientToken" id="x<?php echo $Client_grid->RowIndex ?>_ClientToken" value="<?php echo HtmlEncode($Client_grid->ClientToken->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="Client" data-field="x_ClientToken" name="o<?php echo $Client_grid->RowIndex ?>_ClientToken" id="o<?php echo $Client_grid->RowIndex ?>_ClientToken" value="<?php echo HtmlEncode($Client_grid->ClientToken->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$Client_grid->ListOptions->render("body", "right", $Client_grid->RowIndex);
?>
<script>
loadjs.ready(["fClientgrid", "load"], function() {
	fClientgrid.updateLists(<?php echo $Client_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($Client->CurrentMode == "add" || $Client->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $Client_grid->FormKeyCountName ?>" id="<?php echo $Client_grid->FormKeyCountName ?>" value="<?php echo $Client_grid->KeyCount ?>">
<?php echo $Client_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($Client->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $Client_grid->FormKeyCountName ?>" id="<?php echo $Client_grid->FormKeyCountName ?>" value="<?php echo $Client_grid->KeyCount ?>">
<?php echo $Client_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($Client->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fClientgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($Client_grid->Recordset)
	$Client_grid->Recordset->Close();
?>
<?php if ($Client_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $Client_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($Client_grid->TotalRecords == 0 && !$Client->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $Client_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$Client_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$Client_grid->terminate();
?>