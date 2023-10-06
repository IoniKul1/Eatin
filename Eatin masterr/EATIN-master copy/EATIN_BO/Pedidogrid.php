<?php
namespace PHPMaker2020\EATIN_BO;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($Pedido_grid))
	$Pedido_grid = new Pedido_grid();

// Run the page
$Pedido_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Pedido_grid->Page_Render();
?>
<?php if (!$Pedido_grid->isExport()) { ?>
<script>
var fPedidogrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fPedidogrid = new ew.Form("fPedidogrid", "grid");
	fPedidogrid.formKeyCountName = '<?php echo $Pedido_grid->FormKeyCountName ?>';

	// Validate form
	fPedidogrid.validate = function() {
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
			<?php if ($Pedido_grid->ID->Required) { ?>
				elm = this.getElements("x" + infix + "_ID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Pedido_grid->ID->caption(), $Pedido_grid->ID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Pedido_grid->ID_Client->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_Client");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Pedido_grid->ID_Client->caption(), $Pedido_grid->ID_Client->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Pedido_grid->ID_Status->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_Status");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Pedido_grid->ID_Status->caption(), $Pedido_grid->ID_Status->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ID_Status");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Pedido_grid->ID_Status->errorMessage()) ?>");
			<?php if ($Pedido_grid->ID_Restaurant->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_Restaurant");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Pedido_grid->ID_Restaurant->caption(), $Pedido_grid->ID_Restaurant->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Pedido_grid->DateCreation->Required) { ?>
				elm = this.getElements("x" + infix + "_DateCreation");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Pedido_grid->DateCreation->caption(), $Pedido_grid->DateCreation->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateCreation");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Pedido_grid->DateCreation->errorMessage()) ?>");
			<?php if ($Pedido_grid->DateLastUpdate->Required) { ?>
				elm = this.getElements("x" + infix + "_DateLastUpdate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Pedido_grid->DateLastUpdate->caption(), $Pedido_grid->DateLastUpdate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateLastUpdate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Pedido_grid->DateLastUpdate->errorMessage()) ?>");
			<?php if ($Pedido_grid->ID_Table->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_Table");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Pedido_grid->ID_Table->caption(), $Pedido_grid->ID_Table->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fPedidogrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "ID_Client", false)) return false;
		if (ew.valueChanged(fobj, infix, "ID_Status", false)) return false;
		if (ew.valueChanged(fobj, infix, "ID_Restaurant", false)) return false;
		if (ew.valueChanged(fobj, infix, "DateCreation", false)) return false;
		if (ew.valueChanged(fobj, infix, "DateLastUpdate", false)) return false;
		if (ew.valueChanged(fobj, infix, "ID_Table", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fPedidogrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fPedidogrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fPedidogrid.lists["x_ID_Client"] = <?php echo $Pedido_grid->ID_Client->Lookup->toClientList($Pedido_grid) ?>;
	fPedidogrid.lists["x_ID_Client"].options = <?php echo JsonEncode($Pedido_grid->ID_Client->lookupOptions()) ?>;
	fPedidogrid.lists["x_ID_Restaurant"] = <?php echo $Pedido_grid->ID_Restaurant->Lookup->toClientList($Pedido_grid) ?>;
	fPedidogrid.lists["x_ID_Restaurant"].options = <?php echo JsonEncode($Pedido_grid->ID_Restaurant->lookupOptions()) ?>;
	fPedidogrid.lists["x_ID_Table"] = <?php echo $Pedido_grid->ID_Table->Lookup->toClientList($Pedido_grid) ?>;
	fPedidogrid.lists["x_ID_Table"].options = <?php echo JsonEncode($Pedido_grid->ID_Table->lookupOptions()) ?>;
	loadjs.done("fPedidogrid");
});
</script>
<?php } ?>
<?php
$Pedido_grid->renderOtherOptions();
?>
<?php if ($Pedido_grid->TotalRecords > 0 || $Pedido->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Pedido_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> Pedido">
<?php if ($Pedido_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $Pedido_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fPedidogrid" class="ew-form ew-list-form form-inline">
<div id="gmp_Pedido" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_Pedidogrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$Pedido->RowType = ROWTYPE_HEADER;

// Render list options
$Pedido_grid->renderListOptions();

// Render list options (header, left)
$Pedido_grid->ListOptions->render("header", "left");
?>
<?php if ($Pedido_grid->ID->Visible) { // ID ?>
	<?php if ($Pedido_grid->SortUrl($Pedido_grid->ID) == "") { ?>
		<th data-name="ID" class="<?php echo $Pedido_grid->ID->headerCellClass() ?>"><div id="elh_Pedido_ID" class="Pedido_ID"><div class="ew-table-header-caption"><?php echo $Pedido_grid->ID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID" class="<?php echo $Pedido_grid->ID->headerCellClass() ?>"><div><div id="elh_Pedido_ID" class="Pedido_ID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Pedido_grid->ID->caption() ?></span><span class="ew-table-header-sort"><?php if ($Pedido_grid->ID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Pedido_grid->ID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Pedido_grid->ID_Client->Visible) { // ID_Client ?>
	<?php if ($Pedido_grid->SortUrl($Pedido_grid->ID_Client) == "") { ?>
		<th data-name="ID_Client" class="<?php echo $Pedido_grid->ID_Client->headerCellClass() ?>"><div id="elh_Pedido_ID_Client" class="Pedido_ID_Client"><div class="ew-table-header-caption"><?php echo $Pedido_grid->ID_Client->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Client" class="<?php echo $Pedido_grid->ID_Client->headerCellClass() ?>"><div><div id="elh_Pedido_ID_Client" class="Pedido_ID_Client">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Pedido_grid->ID_Client->caption() ?></span><span class="ew-table-header-sort"><?php if ($Pedido_grid->ID_Client->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Pedido_grid->ID_Client->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Pedido_grid->ID_Status->Visible) { // ID_Status ?>
	<?php if ($Pedido_grid->SortUrl($Pedido_grid->ID_Status) == "") { ?>
		<th data-name="ID_Status" class="<?php echo $Pedido_grid->ID_Status->headerCellClass() ?>"><div id="elh_Pedido_ID_Status" class="Pedido_ID_Status"><div class="ew-table-header-caption"><?php echo $Pedido_grid->ID_Status->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Status" class="<?php echo $Pedido_grid->ID_Status->headerCellClass() ?>"><div><div id="elh_Pedido_ID_Status" class="Pedido_ID_Status">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Pedido_grid->ID_Status->caption() ?></span><span class="ew-table-header-sort"><?php if ($Pedido_grid->ID_Status->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Pedido_grid->ID_Status->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Pedido_grid->ID_Restaurant->Visible) { // ID_Restaurant ?>
	<?php if ($Pedido_grid->SortUrl($Pedido_grid->ID_Restaurant) == "") { ?>
		<th data-name="ID_Restaurant" class="<?php echo $Pedido_grid->ID_Restaurant->headerCellClass() ?>"><div id="elh_Pedido_ID_Restaurant" class="Pedido_ID_Restaurant"><div class="ew-table-header-caption"><?php echo $Pedido_grid->ID_Restaurant->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Restaurant" class="<?php echo $Pedido_grid->ID_Restaurant->headerCellClass() ?>"><div><div id="elh_Pedido_ID_Restaurant" class="Pedido_ID_Restaurant">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Pedido_grid->ID_Restaurant->caption() ?></span><span class="ew-table-header-sort"><?php if ($Pedido_grid->ID_Restaurant->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Pedido_grid->ID_Restaurant->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Pedido_grid->DateCreation->Visible) { // DateCreation ?>
	<?php if ($Pedido_grid->SortUrl($Pedido_grid->DateCreation) == "") { ?>
		<th data-name="DateCreation" class="<?php echo $Pedido_grid->DateCreation->headerCellClass() ?>"><div id="elh_Pedido_DateCreation" class="Pedido_DateCreation"><div class="ew-table-header-caption"><?php echo $Pedido_grid->DateCreation->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateCreation" class="<?php echo $Pedido_grid->DateCreation->headerCellClass() ?>"><div><div id="elh_Pedido_DateCreation" class="Pedido_DateCreation">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Pedido_grid->DateCreation->caption() ?></span><span class="ew-table-header-sort"><?php if ($Pedido_grid->DateCreation->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Pedido_grid->DateCreation->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Pedido_grid->DateLastUpdate->Visible) { // DateLastUpdate ?>
	<?php if ($Pedido_grid->SortUrl($Pedido_grid->DateLastUpdate) == "") { ?>
		<th data-name="DateLastUpdate" class="<?php echo $Pedido_grid->DateLastUpdate->headerCellClass() ?>"><div id="elh_Pedido_DateLastUpdate" class="Pedido_DateLastUpdate"><div class="ew-table-header-caption"><?php echo $Pedido_grid->DateLastUpdate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateLastUpdate" class="<?php echo $Pedido_grid->DateLastUpdate->headerCellClass() ?>"><div><div id="elh_Pedido_DateLastUpdate" class="Pedido_DateLastUpdate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Pedido_grid->DateLastUpdate->caption() ?></span><span class="ew-table-header-sort"><?php if ($Pedido_grid->DateLastUpdate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Pedido_grid->DateLastUpdate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Pedido_grid->ID_Table->Visible) { // ID_Table ?>
	<?php if ($Pedido_grid->SortUrl($Pedido_grid->ID_Table) == "") { ?>
		<th data-name="ID_Table" class="<?php echo $Pedido_grid->ID_Table->headerCellClass() ?>"><div id="elh_Pedido_ID_Table" class="Pedido_ID_Table"><div class="ew-table-header-caption"><?php echo $Pedido_grid->ID_Table->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Table" class="<?php echo $Pedido_grid->ID_Table->headerCellClass() ?>"><div><div id="elh_Pedido_ID_Table" class="Pedido_ID_Table">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Pedido_grid->ID_Table->caption() ?></span><span class="ew-table-header-sort"><?php if ($Pedido_grid->ID_Table->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Pedido_grid->ID_Table->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$Pedido_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$Pedido_grid->StartRecord = 1;
$Pedido_grid->StopRecord = $Pedido_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($Pedido->isConfirm() || $Pedido_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($Pedido_grid->FormKeyCountName) && ($Pedido_grid->isGridAdd() || $Pedido_grid->isGridEdit() || $Pedido->isConfirm())) {
		$Pedido_grid->KeyCount = $CurrentForm->getValue($Pedido_grid->FormKeyCountName);
		$Pedido_grid->StopRecord = $Pedido_grid->StartRecord + $Pedido_grid->KeyCount - 1;
	}
}
$Pedido_grid->RecordCount = $Pedido_grid->StartRecord - 1;
if ($Pedido_grid->Recordset && !$Pedido_grid->Recordset->EOF) {
	$Pedido_grid->Recordset->moveFirst();
	$selectLimit = $Pedido_grid->UseSelectLimit;
	if (!$selectLimit && $Pedido_grid->StartRecord > 1)
		$Pedido_grid->Recordset->move($Pedido_grid->StartRecord - 1);
} elseif (!$Pedido->AllowAddDeleteRow && $Pedido_grid->StopRecord == 0) {
	$Pedido_grid->StopRecord = $Pedido->GridAddRowCount;
}

// Initialize aggregate
$Pedido->RowType = ROWTYPE_AGGREGATEINIT;
$Pedido->resetAttributes();
$Pedido_grid->renderRow();
if ($Pedido_grid->isGridAdd())
	$Pedido_grid->RowIndex = 0;
if ($Pedido_grid->isGridEdit())
	$Pedido_grid->RowIndex = 0;
while ($Pedido_grid->RecordCount < $Pedido_grid->StopRecord) {
	$Pedido_grid->RecordCount++;
	if ($Pedido_grid->RecordCount >= $Pedido_grid->StartRecord) {
		$Pedido_grid->RowCount++;
		if ($Pedido_grid->isGridAdd() || $Pedido_grid->isGridEdit() || $Pedido->isConfirm()) {
			$Pedido_grid->RowIndex++;
			$CurrentForm->Index = $Pedido_grid->RowIndex;
			if ($CurrentForm->hasValue($Pedido_grid->FormActionName) && ($Pedido->isConfirm() || $Pedido_grid->EventCancelled))
				$Pedido_grid->RowAction = strval($CurrentForm->getValue($Pedido_grid->FormActionName));
			elseif ($Pedido_grid->isGridAdd())
				$Pedido_grid->RowAction = "insert";
			else
				$Pedido_grid->RowAction = "";
		}

		// Set up key count
		$Pedido_grid->KeyCount = $Pedido_grid->RowIndex;

		// Init row class and style
		$Pedido->resetAttributes();
		$Pedido->CssClass = "";
		if ($Pedido_grid->isGridAdd()) {
			if ($Pedido->CurrentMode == "copy") {
				$Pedido_grid->loadRowValues($Pedido_grid->Recordset); // Load row values
				$Pedido_grid->setRecordKey($Pedido_grid->RowOldKey, $Pedido_grid->Recordset); // Set old record key
			} else {
				$Pedido_grid->loadRowValues(); // Load default values
				$Pedido_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$Pedido_grid->loadRowValues($Pedido_grid->Recordset); // Load row values
		}
		$Pedido->RowType = ROWTYPE_VIEW; // Render view
		if ($Pedido_grid->isGridAdd()) // Grid add
			$Pedido->RowType = ROWTYPE_ADD; // Render add
		if ($Pedido_grid->isGridAdd() && $Pedido->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$Pedido_grid->restoreCurrentRowFormValues($Pedido_grid->RowIndex); // Restore form values
		if ($Pedido_grid->isGridEdit()) { // Grid edit
			if ($Pedido->EventCancelled)
				$Pedido_grid->restoreCurrentRowFormValues($Pedido_grid->RowIndex); // Restore form values
			if ($Pedido_grid->RowAction == "insert")
				$Pedido->RowType = ROWTYPE_ADD; // Render add
			else
				$Pedido->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($Pedido_grid->isGridEdit() && ($Pedido->RowType == ROWTYPE_EDIT || $Pedido->RowType == ROWTYPE_ADD) && $Pedido->EventCancelled) // Update failed
			$Pedido_grid->restoreCurrentRowFormValues($Pedido_grid->RowIndex); // Restore form values
		if ($Pedido->RowType == ROWTYPE_EDIT) // Edit row
			$Pedido_grid->EditRowCount++;
		if ($Pedido->isConfirm()) // Confirm row
			$Pedido_grid->restoreCurrentRowFormValues($Pedido_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$Pedido->RowAttrs->merge(["data-rowindex" => $Pedido_grid->RowCount, "id" => "r" . $Pedido_grid->RowCount . "_Pedido", "data-rowtype" => $Pedido->RowType]);

		// Render row
		$Pedido_grid->renderRow();

		// Render list options
		$Pedido_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($Pedido_grid->RowAction != "delete" && $Pedido_grid->RowAction != "insertdelete" && !($Pedido_grid->RowAction == "insert" && $Pedido->isConfirm() && $Pedido_grid->emptyRow())) {
?>
	<tr <?php echo $Pedido->rowAttributes() ?>>
<?php

// Render list options (body, left)
$Pedido_grid->ListOptions->render("body", "left", $Pedido_grid->RowCount);
?>
	<?php if ($Pedido_grid->ID->Visible) { // ID ?>
		<td data-name="ID" <?php echo $Pedido_grid->ID->cellAttributes() ?>>
<?php if ($Pedido->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Pedido_grid->RowCount ?>_Pedido_ID" class="form-group"></span>
<input type="hidden" data-table="Pedido" data-field="x_ID" name="o<?php echo $Pedido_grid->RowIndex ?>_ID" id="o<?php echo $Pedido_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($Pedido_grid->ID->OldValue) ?>">
<?php } ?>
<?php if ($Pedido->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Pedido_grid->RowCount ?>_Pedido_ID" class="form-group">
<span<?php echo $Pedido_grid->ID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Pedido_grid->ID->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="Pedido" data-field="x_ID" name="x<?php echo $Pedido_grid->RowIndex ?>_ID" id="x<?php echo $Pedido_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($Pedido_grid->ID->CurrentValue) ?>">
<?php } ?>
<?php if ($Pedido->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Pedido_grid->RowCount ?>_Pedido_ID">
<span<?php echo $Pedido_grid->ID->viewAttributes() ?>><?php echo $Pedido_grid->ID->getViewValue() ?></span>
</span>
<?php if (!$Pedido->isConfirm()) { ?>
<input type="hidden" data-table="Pedido" data-field="x_ID" name="x<?php echo $Pedido_grid->RowIndex ?>_ID" id="x<?php echo $Pedido_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($Pedido_grid->ID->FormValue) ?>">
<input type="hidden" data-table="Pedido" data-field="x_ID" name="o<?php echo $Pedido_grid->RowIndex ?>_ID" id="o<?php echo $Pedido_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($Pedido_grid->ID->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="Pedido" data-field="x_ID" name="fPedidogrid$x<?php echo $Pedido_grid->RowIndex ?>_ID" id="fPedidogrid$x<?php echo $Pedido_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($Pedido_grid->ID->FormValue) ?>">
<input type="hidden" data-table="Pedido" data-field="x_ID" name="fPedidogrid$o<?php echo $Pedido_grid->RowIndex ?>_ID" id="fPedidogrid$o<?php echo $Pedido_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($Pedido_grid->ID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Pedido_grid->ID_Client->Visible) { // ID_Client ?>
		<td data-name="ID_Client" <?php echo $Pedido_grid->ID_Client->cellAttributes() ?>>
<?php if ($Pedido->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($Pedido_grid->ID_Client->getSessionValue() != "") { ?>
<span id="el<?php echo $Pedido_grid->RowCount ?>_Pedido_ID_Client" class="form-group">
<span<?php echo $Pedido_grid->ID_Client->viewAttributes() ?>><?php if (!EmptyString($Pedido_grid->ID_Client->ViewValue) && $Pedido_grid->ID_Client->linkAttributes() != "") { ?>
<a<?php echo $Pedido_grid->ID_Client->linkAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Pedido_grid->ID_Client->ViewValue)) ?>"></a>
<?php } else { ?>
<input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Pedido_grid->ID_Client->ViewValue)) ?>">
<?php } ?></span>
</span>
<input type="hidden" id="x<?php echo $Pedido_grid->RowIndex ?>_ID_Client" name="x<?php echo $Pedido_grid->RowIndex ?>_ID_Client" value="<?php echo HtmlEncode($Pedido_grid->ID_Client->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $Pedido_grid->RowCount ?>_Pedido_ID_Client" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Pedido" data-field="x_ID_Client" data-value-separator="<?php echo $Pedido_grid->ID_Client->displayValueSeparatorAttribute() ?>" id="x<?php echo $Pedido_grid->RowIndex ?>_ID_Client" name="x<?php echo $Pedido_grid->RowIndex ?>_ID_Client"<?php echo $Pedido_grid->ID_Client->editAttributes() ?>>
			<?php echo $Pedido_grid->ID_Client->selectOptionListHtml("x{$Pedido_grid->RowIndex}_ID_Client") ?>
		</select>
</div>
<?php echo $Pedido_grid->ID_Client->Lookup->getParamTag($Pedido_grid, "p_x" . $Pedido_grid->RowIndex . "_ID_Client") ?>
</span>
<?php } ?>
<input type="hidden" data-table="Pedido" data-field="x_ID_Client" name="o<?php echo $Pedido_grid->RowIndex ?>_ID_Client" id="o<?php echo $Pedido_grid->RowIndex ?>_ID_Client" value="<?php echo HtmlEncode($Pedido_grid->ID_Client->OldValue) ?>">
<?php } ?>
<?php if ($Pedido->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($Pedido_grid->ID_Client->getSessionValue() != "") { ?>
<span id="el<?php echo $Pedido_grid->RowCount ?>_Pedido_ID_Client" class="form-group">
<span<?php echo $Pedido_grid->ID_Client->viewAttributes() ?>><?php if (!EmptyString($Pedido_grid->ID_Client->ViewValue) && $Pedido_grid->ID_Client->linkAttributes() != "") { ?>
<a<?php echo $Pedido_grid->ID_Client->linkAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Pedido_grid->ID_Client->ViewValue)) ?>"></a>
<?php } else { ?>
<input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Pedido_grid->ID_Client->ViewValue)) ?>">
<?php } ?></span>
</span>
<input type="hidden" id="x<?php echo $Pedido_grid->RowIndex ?>_ID_Client" name="x<?php echo $Pedido_grid->RowIndex ?>_ID_Client" value="<?php echo HtmlEncode($Pedido_grid->ID_Client->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $Pedido_grid->RowCount ?>_Pedido_ID_Client" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Pedido" data-field="x_ID_Client" data-value-separator="<?php echo $Pedido_grid->ID_Client->displayValueSeparatorAttribute() ?>" id="x<?php echo $Pedido_grid->RowIndex ?>_ID_Client" name="x<?php echo $Pedido_grid->RowIndex ?>_ID_Client"<?php echo $Pedido_grid->ID_Client->editAttributes() ?>>
			<?php echo $Pedido_grid->ID_Client->selectOptionListHtml("x{$Pedido_grid->RowIndex}_ID_Client") ?>
		</select>
</div>
<?php echo $Pedido_grid->ID_Client->Lookup->getParamTag($Pedido_grid, "p_x" . $Pedido_grid->RowIndex . "_ID_Client") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($Pedido->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Pedido_grid->RowCount ?>_Pedido_ID_Client">
<span<?php echo $Pedido_grid->ID_Client->viewAttributes() ?>><?php if (!EmptyString($Pedido_grid->ID_Client->getViewValue()) && $Pedido_grid->ID_Client->linkAttributes() != "") { ?>
<a<?php echo $Pedido_grid->ID_Client->linkAttributes() ?>><?php echo $Pedido_grid->ID_Client->getViewValue() ?></a>
<?php } else { ?>
<?php echo $Pedido_grid->ID_Client->getViewValue() ?>
<?php } ?></span>
</span>
<?php if (!$Pedido->isConfirm()) { ?>
<input type="hidden" data-table="Pedido" data-field="x_ID_Client" name="x<?php echo $Pedido_grid->RowIndex ?>_ID_Client" id="x<?php echo $Pedido_grid->RowIndex ?>_ID_Client" value="<?php echo HtmlEncode($Pedido_grid->ID_Client->FormValue) ?>">
<input type="hidden" data-table="Pedido" data-field="x_ID_Client" name="o<?php echo $Pedido_grid->RowIndex ?>_ID_Client" id="o<?php echo $Pedido_grid->RowIndex ?>_ID_Client" value="<?php echo HtmlEncode($Pedido_grid->ID_Client->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="Pedido" data-field="x_ID_Client" name="fPedidogrid$x<?php echo $Pedido_grid->RowIndex ?>_ID_Client" id="fPedidogrid$x<?php echo $Pedido_grid->RowIndex ?>_ID_Client" value="<?php echo HtmlEncode($Pedido_grid->ID_Client->FormValue) ?>">
<input type="hidden" data-table="Pedido" data-field="x_ID_Client" name="fPedidogrid$o<?php echo $Pedido_grid->RowIndex ?>_ID_Client" id="fPedidogrid$o<?php echo $Pedido_grid->RowIndex ?>_ID_Client" value="<?php echo HtmlEncode($Pedido_grid->ID_Client->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Pedido_grid->ID_Status->Visible) { // ID_Status ?>
		<td data-name="ID_Status" <?php echo $Pedido_grid->ID_Status->cellAttributes() ?>>
<?php if ($Pedido->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Pedido_grid->RowCount ?>_Pedido_ID_Status" class="form-group">
<input type="text" data-table="Pedido" data-field="x_ID_Status" name="x<?php echo $Pedido_grid->RowIndex ?>_ID_Status" id="x<?php echo $Pedido_grid->RowIndex ?>_ID_Status" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Pedido_grid->ID_Status->getPlaceHolder()) ?>" value="<?php echo $Pedido_grid->ID_Status->EditValue ?>"<?php echo $Pedido_grid->ID_Status->editAttributes() ?>>
</span>
<input type="hidden" data-table="Pedido" data-field="x_ID_Status" name="o<?php echo $Pedido_grid->RowIndex ?>_ID_Status" id="o<?php echo $Pedido_grid->RowIndex ?>_ID_Status" value="<?php echo HtmlEncode($Pedido_grid->ID_Status->OldValue) ?>">
<?php } ?>
<?php if ($Pedido->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Pedido_grid->RowCount ?>_Pedido_ID_Status" class="form-group">
<input type="text" data-table="Pedido" data-field="x_ID_Status" name="x<?php echo $Pedido_grid->RowIndex ?>_ID_Status" id="x<?php echo $Pedido_grid->RowIndex ?>_ID_Status" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Pedido_grid->ID_Status->getPlaceHolder()) ?>" value="<?php echo $Pedido_grid->ID_Status->EditValue ?>"<?php echo $Pedido_grid->ID_Status->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($Pedido->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Pedido_grid->RowCount ?>_Pedido_ID_Status">
<span<?php echo $Pedido_grid->ID_Status->viewAttributes() ?>><?php echo $Pedido_grid->ID_Status->getViewValue() ?></span>
</span>
<?php if (!$Pedido->isConfirm()) { ?>
<input type="hidden" data-table="Pedido" data-field="x_ID_Status" name="x<?php echo $Pedido_grid->RowIndex ?>_ID_Status" id="x<?php echo $Pedido_grid->RowIndex ?>_ID_Status" value="<?php echo HtmlEncode($Pedido_grid->ID_Status->FormValue) ?>">
<input type="hidden" data-table="Pedido" data-field="x_ID_Status" name="o<?php echo $Pedido_grid->RowIndex ?>_ID_Status" id="o<?php echo $Pedido_grid->RowIndex ?>_ID_Status" value="<?php echo HtmlEncode($Pedido_grid->ID_Status->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="Pedido" data-field="x_ID_Status" name="fPedidogrid$x<?php echo $Pedido_grid->RowIndex ?>_ID_Status" id="fPedidogrid$x<?php echo $Pedido_grid->RowIndex ?>_ID_Status" value="<?php echo HtmlEncode($Pedido_grid->ID_Status->FormValue) ?>">
<input type="hidden" data-table="Pedido" data-field="x_ID_Status" name="fPedidogrid$o<?php echo $Pedido_grid->RowIndex ?>_ID_Status" id="fPedidogrid$o<?php echo $Pedido_grid->RowIndex ?>_ID_Status" value="<?php echo HtmlEncode($Pedido_grid->ID_Status->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Pedido_grid->ID_Restaurant->Visible) { // ID_Restaurant ?>
		<td data-name="ID_Restaurant" <?php echo $Pedido_grid->ID_Restaurant->cellAttributes() ?>>
<?php if ($Pedido->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn() && !$Pedido->userIDAllow("grid")) { // Non system admin ?>
<span id="el<?php echo $Pedido_grid->RowCount ?>_Pedido_ID_Restaurant" class="form-group">
<span<?php echo $Pedido_grid->ID_Restaurant->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Pedido_grid->ID_Restaurant->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="Pedido" data-field="x_ID_Restaurant" name="x<?php echo $Pedido_grid->RowIndex ?>_ID_Restaurant" id="x<?php echo $Pedido_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($Pedido_grid->ID_Restaurant->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $Pedido_grid->RowCount ?>_Pedido_ID_Restaurant" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Pedido" data-field="x_ID_Restaurant" data-value-separator="<?php echo $Pedido_grid->ID_Restaurant->displayValueSeparatorAttribute() ?>" id="x<?php echo $Pedido_grid->RowIndex ?>_ID_Restaurant" name="x<?php echo $Pedido_grid->RowIndex ?>_ID_Restaurant"<?php echo $Pedido_grid->ID_Restaurant->editAttributes() ?>>
			<?php echo $Pedido_grid->ID_Restaurant->selectOptionListHtml("x{$Pedido_grid->RowIndex}_ID_Restaurant") ?>
		</select>
</div>
<?php echo $Pedido_grid->ID_Restaurant->Lookup->getParamTag($Pedido_grid, "p_x" . $Pedido_grid->RowIndex . "_ID_Restaurant") ?>
</span>
<?php } ?>
<input type="hidden" data-table="Pedido" data-field="x_ID_Restaurant" name="o<?php echo $Pedido_grid->RowIndex ?>_ID_Restaurant" id="o<?php echo $Pedido_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($Pedido_grid->ID_Restaurant->OldValue) ?>">
<?php } ?>
<?php if ($Pedido->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn() && !$Pedido->userIDAllow("grid")) { // Non system admin ?>
<span id="el<?php echo $Pedido_grid->RowCount ?>_Pedido_ID_Restaurant" class="form-group">
<span<?php echo $Pedido_grid->ID_Restaurant->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Pedido_grid->ID_Restaurant->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="Pedido" data-field="x_ID_Restaurant" name="x<?php echo $Pedido_grid->RowIndex ?>_ID_Restaurant" id="x<?php echo $Pedido_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($Pedido_grid->ID_Restaurant->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $Pedido_grid->RowCount ?>_Pedido_ID_Restaurant" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Pedido" data-field="x_ID_Restaurant" data-value-separator="<?php echo $Pedido_grid->ID_Restaurant->displayValueSeparatorAttribute() ?>" id="x<?php echo $Pedido_grid->RowIndex ?>_ID_Restaurant" name="x<?php echo $Pedido_grid->RowIndex ?>_ID_Restaurant"<?php echo $Pedido_grid->ID_Restaurant->editAttributes() ?>>
			<?php echo $Pedido_grid->ID_Restaurant->selectOptionListHtml("x{$Pedido_grid->RowIndex}_ID_Restaurant") ?>
		</select>
</div>
<?php echo $Pedido_grid->ID_Restaurant->Lookup->getParamTag($Pedido_grid, "p_x" . $Pedido_grid->RowIndex . "_ID_Restaurant") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($Pedido->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Pedido_grid->RowCount ?>_Pedido_ID_Restaurant">
<span<?php echo $Pedido_grid->ID_Restaurant->viewAttributes() ?>><?php echo $Pedido_grid->ID_Restaurant->getViewValue() ?></span>
</span>
<?php if (!$Pedido->isConfirm()) { ?>
<input type="hidden" data-table="Pedido" data-field="x_ID_Restaurant" name="x<?php echo $Pedido_grid->RowIndex ?>_ID_Restaurant" id="x<?php echo $Pedido_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($Pedido_grid->ID_Restaurant->FormValue) ?>">
<input type="hidden" data-table="Pedido" data-field="x_ID_Restaurant" name="o<?php echo $Pedido_grid->RowIndex ?>_ID_Restaurant" id="o<?php echo $Pedido_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($Pedido_grid->ID_Restaurant->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="Pedido" data-field="x_ID_Restaurant" name="fPedidogrid$x<?php echo $Pedido_grid->RowIndex ?>_ID_Restaurant" id="fPedidogrid$x<?php echo $Pedido_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($Pedido_grid->ID_Restaurant->FormValue) ?>">
<input type="hidden" data-table="Pedido" data-field="x_ID_Restaurant" name="fPedidogrid$o<?php echo $Pedido_grid->RowIndex ?>_ID_Restaurant" id="fPedidogrid$o<?php echo $Pedido_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($Pedido_grid->ID_Restaurant->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Pedido_grid->DateCreation->Visible) { // DateCreation ?>
		<td data-name="DateCreation" <?php echo $Pedido_grid->DateCreation->cellAttributes() ?>>
<?php if ($Pedido->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Pedido_grid->RowCount ?>_Pedido_DateCreation" class="form-group">
<input type="text" data-table="Pedido" data-field="x_DateCreation" data-format="1" name="x<?php echo $Pedido_grid->RowIndex ?>_DateCreation" id="x<?php echo $Pedido_grid->RowIndex ?>_DateCreation" maxlength="8" placeholder="<?php echo HtmlEncode($Pedido_grid->DateCreation->getPlaceHolder()) ?>" value="<?php echo $Pedido_grid->DateCreation->EditValue ?>"<?php echo $Pedido_grid->DateCreation->editAttributes() ?>>
<?php if (!$Pedido_grid->DateCreation->ReadOnly && !$Pedido_grid->DateCreation->Disabled && !isset($Pedido_grid->DateCreation->EditAttrs["readonly"]) && !isset($Pedido_grid->DateCreation->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fPedidogrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fPedidogrid", "x<?php echo $Pedido_grid->RowIndex ?>_DateCreation", {"ignoreReadonly":true,"useCurrent":false,"format":1});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="Pedido" data-field="x_DateCreation" name="o<?php echo $Pedido_grid->RowIndex ?>_DateCreation" id="o<?php echo $Pedido_grid->RowIndex ?>_DateCreation" value="<?php echo HtmlEncode($Pedido_grid->DateCreation->OldValue) ?>">
<?php } ?>
<?php if ($Pedido->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Pedido_grid->RowCount ?>_Pedido_DateCreation" class="form-group">
<input type="text" data-table="Pedido" data-field="x_DateCreation" data-format="1" name="x<?php echo $Pedido_grid->RowIndex ?>_DateCreation" id="x<?php echo $Pedido_grid->RowIndex ?>_DateCreation" maxlength="8" placeholder="<?php echo HtmlEncode($Pedido_grid->DateCreation->getPlaceHolder()) ?>" value="<?php echo $Pedido_grid->DateCreation->EditValue ?>"<?php echo $Pedido_grid->DateCreation->editAttributes() ?>>
<?php if (!$Pedido_grid->DateCreation->ReadOnly && !$Pedido_grid->DateCreation->Disabled && !isset($Pedido_grid->DateCreation->EditAttrs["readonly"]) && !isset($Pedido_grid->DateCreation->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fPedidogrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fPedidogrid", "x<?php echo $Pedido_grid->RowIndex ?>_DateCreation", {"ignoreReadonly":true,"useCurrent":false,"format":1});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Pedido->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Pedido_grid->RowCount ?>_Pedido_DateCreation">
<span<?php echo $Pedido_grid->DateCreation->viewAttributes() ?>><?php echo $Pedido_grid->DateCreation->getViewValue() ?></span>
</span>
<?php if (!$Pedido->isConfirm()) { ?>
<input type="hidden" data-table="Pedido" data-field="x_DateCreation" name="x<?php echo $Pedido_grid->RowIndex ?>_DateCreation" id="x<?php echo $Pedido_grid->RowIndex ?>_DateCreation" value="<?php echo HtmlEncode($Pedido_grid->DateCreation->FormValue) ?>">
<input type="hidden" data-table="Pedido" data-field="x_DateCreation" name="o<?php echo $Pedido_grid->RowIndex ?>_DateCreation" id="o<?php echo $Pedido_grid->RowIndex ?>_DateCreation" value="<?php echo HtmlEncode($Pedido_grid->DateCreation->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="Pedido" data-field="x_DateCreation" name="fPedidogrid$x<?php echo $Pedido_grid->RowIndex ?>_DateCreation" id="fPedidogrid$x<?php echo $Pedido_grid->RowIndex ?>_DateCreation" value="<?php echo HtmlEncode($Pedido_grid->DateCreation->FormValue) ?>">
<input type="hidden" data-table="Pedido" data-field="x_DateCreation" name="fPedidogrid$o<?php echo $Pedido_grid->RowIndex ?>_DateCreation" id="fPedidogrid$o<?php echo $Pedido_grid->RowIndex ?>_DateCreation" value="<?php echo HtmlEncode($Pedido_grid->DateCreation->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Pedido_grid->DateLastUpdate->Visible) { // DateLastUpdate ?>
		<td data-name="DateLastUpdate" <?php echo $Pedido_grid->DateLastUpdate->cellAttributes() ?>>
<?php if ($Pedido->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Pedido_grid->RowCount ?>_Pedido_DateLastUpdate" class="form-group">
<input type="text" data-table="Pedido" data-field="x_DateLastUpdate" name="x<?php echo $Pedido_grid->RowIndex ?>_DateLastUpdate" id="x<?php echo $Pedido_grid->RowIndex ?>_DateLastUpdate" maxlength="8" placeholder="<?php echo HtmlEncode($Pedido_grid->DateLastUpdate->getPlaceHolder()) ?>" value="<?php echo $Pedido_grid->DateLastUpdate->EditValue ?>"<?php echo $Pedido_grid->DateLastUpdate->editAttributes() ?>>
<?php if (!$Pedido_grid->DateLastUpdate->ReadOnly && !$Pedido_grid->DateLastUpdate->Disabled && !isset($Pedido_grid->DateLastUpdate->EditAttrs["readonly"]) && !isset($Pedido_grid->DateLastUpdate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fPedidogrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fPedidogrid", "x<?php echo $Pedido_grid->RowIndex ?>_DateLastUpdate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="Pedido" data-field="x_DateLastUpdate" name="o<?php echo $Pedido_grid->RowIndex ?>_DateLastUpdate" id="o<?php echo $Pedido_grid->RowIndex ?>_DateLastUpdate" value="<?php echo HtmlEncode($Pedido_grid->DateLastUpdate->OldValue) ?>">
<?php } ?>
<?php if ($Pedido->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Pedido_grid->RowCount ?>_Pedido_DateLastUpdate" class="form-group">
<input type="text" data-table="Pedido" data-field="x_DateLastUpdate" name="x<?php echo $Pedido_grid->RowIndex ?>_DateLastUpdate" id="x<?php echo $Pedido_grid->RowIndex ?>_DateLastUpdate" maxlength="8" placeholder="<?php echo HtmlEncode($Pedido_grid->DateLastUpdate->getPlaceHolder()) ?>" value="<?php echo $Pedido_grid->DateLastUpdate->EditValue ?>"<?php echo $Pedido_grid->DateLastUpdate->editAttributes() ?>>
<?php if (!$Pedido_grid->DateLastUpdate->ReadOnly && !$Pedido_grid->DateLastUpdate->Disabled && !isset($Pedido_grid->DateLastUpdate->EditAttrs["readonly"]) && !isset($Pedido_grid->DateLastUpdate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fPedidogrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fPedidogrid", "x<?php echo $Pedido_grid->RowIndex ?>_DateLastUpdate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Pedido->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Pedido_grid->RowCount ?>_Pedido_DateLastUpdate">
<span<?php echo $Pedido_grid->DateLastUpdate->viewAttributes() ?>><?php echo $Pedido_grid->DateLastUpdate->getViewValue() ?></span>
</span>
<?php if (!$Pedido->isConfirm()) { ?>
<input type="hidden" data-table="Pedido" data-field="x_DateLastUpdate" name="x<?php echo $Pedido_grid->RowIndex ?>_DateLastUpdate" id="x<?php echo $Pedido_grid->RowIndex ?>_DateLastUpdate" value="<?php echo HtmlEncode($Pedido_grid->DateLastUpdate->FormValue) ?>">
<input type="hidden" data-table="Pedido" data-field="x_DateLastUpdate" name="o<?php echo $Pedido_grid->RowIndex ?>_DateLastUpdate" id="o<?php echo $Pedido_grid->RowIndex ?>_DateLastUpdate" value="<?php echo HtmlEncode($Pedido_grid->DateLastUpdate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="Pedido" data-field="x_DateLastUpdate" name="fPedidogrid$x<?php echo $Pedido_grid->RowIndex ?>_DateLastUpdate" id="fPedidogrid$x<?php echo $Pedido_grid->RowIndex ?>_DateLastUpdate" value="<?php echo HtmlEncode($Pedido_grid->DateLastUpdate->FormValue) ?>">
<input type="hidden" data-table="Pedido" data-field="x_DateLastUpdate" name="fPedidogrid$o<?php echo $Pedido_grid->RowIndex ?>_DateLastUpdate" id="fPedidogrid$o<?php echo $Pedido_grid->RowIndex ?>_DateLastUpdate" value="<?php echo HtmlEncode($Pedido_grid->DateLastUpdate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($Pedido_grid->ID_Table->Visible) { // ID_Table ?>
		<td data-name="ID_Table" <?php echo $Pedido_grid->ID_Table->cellAttributes() ?>>
<?php if ($Pedido->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Pedido_grid->RowCount ?>_Pedido_ID_Table" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Pedido" data-field="x_ID_Table" data-value-separator="<?php echo $Pedido_grid->ID_Table->displayValueSeparatorAttribute() ?>" id="x<?php echo $Pedido_grid->RowIndex ?>_ID_Table" name="x<?php echo $Pedido_grid->RowIndex ?>_ID_Table"<?php echo $Pedido_grid->ID_Table->editAttributes() ?>>
			<?php echo $Pedido_grid->ID_Table->selectOptionListHtml("x{$Pedido_grid->RowIndex}_ID_Table") ?>
		</select>
</div>
<?php echo $Pedido_grid->ID_Table->Lookup->getParamTag($Pedido_grid, "p_x" . $Pedido_grid->RowIndex . "_ID_Table") ?>
</span>
<input type="hidden" data-table="Pedido" data-field="x_ID_Table" name="o<?php echo $Pedido_grid->RowIndex ?>_ID_Table" id="o<?php echo $Pedido_grid->RowIndex ?>_ID_Table" value="<?php echo HtmlEncode($Pedido_grid->ID_Table->OldValue) ?>">
<?php } ?>
<?php if ($Pedido->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Pedido_grid->RowCount ?>_Pedido_ID_Table" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Pedido" data-field="x_ID_Table" data-value-separator="<?php echo $Pedido_grid->ID_Table->displayValueSeparatorAttribute() ?>" id="x<?php echo $Pedido_grid->RowIndex ?>_ID_Table" name="x<?php echo $Pedido_grid->RowIndex ?>_ID_Table"<?php echo $Pedido_grid->ID_Table->editAttributes() ?>>
			<?php echo $Pedido_grid->ID_Table->selectOptionListHtml("x{$Pedido_grid->RowIndex}_ID_Table") ?>
		</select>
</div>
<?php echo $Pedido_grid->ID_Table->Lookup->getParamTag($Pedido_grid, "p_x" . $Pedido_grid->RowIndex . "_ID_Table") ?>
</span>
<?php } ?>
<?php if ($Pedido->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $Pedido_grid->RowCount ?>_Pedido_ID_Table">
<span<?php echo $Pedido_grid->ID_Table->viewAttributes() ?>><?php echo $Pedido_grid->ID_Table->getViewValue() ?></span>
</span>
<?php if (!$Pedido->isConfirm()) { ?>
<input type="hidden" data-table="Pedido" data-field="x_ID_Table" name="x<?php echo $Pedido_grid->RowIndex ?>_ID_Table" id="x<?php echo $Pedido_grid->RowIndex ?>_ID_Table" value="<?php echo HtmlEncode($Pedido_grid->ID_Table->FormValue) ?>">
<input type="hidden" data-table="Pedido" data-field="x_ID_Table" name="o<?php echo $Pedido_grid->RowIndex ?>_ID_Table" id="o<?php echo $Pedido_grid->RowIndex ?>_ID_Table" value="<?php echo HtmlEncode($Pedido_grid->ID_Table->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="Pedido" data-field="x_ID_Table" name="fPedidogrid$x<?php echo $Pedido_grid->RowIndex ?>_ID_Table" id="fPedidogrid$x<?php echo $Pedido_grid->RowIndex ?>_ID_Table" value="<?php echo HtmlEncode($Pedido_grid->ID_Table->FormValue) ?>">
<input type="hidden" data-table="Pedido" data-field="x_ID_Table" name="fPedidogrid$o<?php echo $Pedido_grid->RowIndex ?>_ID_Table" id="fPedidogrid$o<?php echo $Pedido_grid->RowIndex ?>_ID_Table" value="<?php echo HtmlEncode($Pedido_grid->ID_Table->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$Pedido_grid->ListOptions->render("body", "right", $Pedido_grid->RowCount);
?>
	</tr>
<?php if ($Pedido->RowType == ROWTYPE_ADD || $Pedido->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fPedidogrid", "load"], function() {
	fPedidogrid.updateLists(<?php echo $Pedido_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$Pedido_grid->isGridAdd() || $Pedido->CurrentMode == "copy")
		if (!$Pedido_grid->Recordset->EOF)
			$Pedido_grid->Recordset->moveNext();
}
?>
<?php
	if ($Pedido->CurrentMode == "add" || $Pedido->CurrentMode == "copy" || $Pedido->CurrentMode == "edit") {
		$Pedido_grid->RowIndex = '$rowindex$';
		$Pedido_grid->loadRowValues();

		// Set row properties
		$Pedido->resetAttributes();
		$Pedido->RowAttrs->merge(["data-rowindex" => $Pedido_grid->RowIndex, "id" => "r0_Pedido", "data-rowtype" => ROWTYPE_ADD]);
		$Pedido->RowAttrs->appendClass("ew-template");
		$Pedido->RowType = ROWTYPE_ADD;

		// Render row
		$Pedido_grid->renderRow();

		// Render list options
		$Pedido_grid->renderListOptions();
		$Pedido_grid->StartRowCount = 0;
?>
	<tr <?php echo $Pedido->rowAttributes() ?>>
<?php

// Render list options (body, left)
$Pedido_grid->ListOptions->render("body", "left", $Pedido_grid->RowIndex);
?>
	<?php if ($Pedido_grid->ID->Visible) { // ID ?>
		<td data-name="ID">
<?php if (!$Pedido->isConfirm()) { ?>
<span id="el$rowindex$_Pedido_ID" class="form-group Pedido_ID"></span>
<?php } else { ?>
<span id="el$rowindex$_Pedido_ID" class="form-group Pedido_ID">
<span<?php echo $Pedido_grid->ID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Pedido_grid->ID->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="Pedido" data-field="x_ID" name="x<?php echo $Pedido_grid->RowIndex ?>_ID" id="x<?php echo $Pedido_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($Pedido_grid->ID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="Pedido" data-field="x_ID" name="o<?php echo $Pedido_grid->RowIndex ?>_ID" id="o<?php echo $Pedido_grid->RowIndex ?>_ID" value="<?php echo HtmlEncode($Pedido_grid->ID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Pedido_grid->ID_Client->Visible) { // ID_Client ?>
		<td data-name="ID_Client">
<?php if (!$Pedido->isConfirm()) { ?>
<?php if ($Pedido_grid->ID_Client->getSessionValue() != "") { ?>
<span id="el$rowindex$_Pedido_ID_Client" class="form-group Pedido_ID_Client">
<span<?php echo $Pedido_grid->ID_Client->viewAttributes() ?>><?php if (!EmptyString($Pedido_grid->ID_Client->ViewValue) && $Pedido_grid->ID_Client->linkAttributes() != "") { ?>
<a<?php echo $Pedido_grid->ID_Client->linkAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Pedido_grid->ID_Client->ViewValue)) ?>"></a>
<?php } else { ?>
<input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Pedido_grid->ID_Client->ViewValue)) ?>">
<?php } ?></span>
</span>
<input type="hidden" id="x<?php echo $Pedido_grid->RowIndex ?>_ID_Client" name="x<?php echo $Pedido_grid->RowIndex ?>_ID_Client" value="<?php echo HtmlEncode($Pedido_grid->ID_Client->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_Pedido_ID_Client" class="form-group Pedido_ID_Client">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Pedido" data-field="x_ID_Client" data-value-separator="<?php echo $Pedido_grid->ID_Client->displayValueSeparatorAttribute() ?>" id="x<?php echo $Pedido_grid->RowIndex ?>_ID_Client" name="x<?php echo $Pedido_grid->RowIndex ?>_ID_Client"<?php echo $Pedido_grid->ID_Client->editAttributes() ?>>
			<?php echo $Pedido_grid->ID_Client->selectOptionListHtml("x{$Pedido_grid->RowIndex}_ID_Client") ?>
		</select>
</div>
<?php echo $Pedido_grid->ID_Client->Lookup->getParamTag($Pedido_grid, "p_x" . $Pedido_grid->RowIndex . "_ID_Client") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_Pedido_ID_Client" class="form-group Pedido_ID_Client">
<span<?php echo $Pedido_grid->ID_Client->viewAttributes() ?>><?php if (!EmptyString($Pedido_grid->ID_Client->ViewValue) && $Pedido_grid->ID_Client->linkAttributes() != "") { ?>
<a<?php echo $Pedido_grid->ID_Client->linkAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Pedido_grid->ID_Client->ViewValue)) ?>"></a>
<?php } else { ?>
<input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Pedido_grid->ID_Client->ViewValue)) ?>">
<?php } ?></span>
</span>
<input type="hidden" data-table="Pedido" data-field="x_ID_Client" name="x<?php echo $Pedido_grid->RowIndex ?>_ID_Client" id="x<?php echo $Pedido_grid->RowIndex ?>_ID_Client" value="<?php echo HtmlEncode($Pedido_grid->ID_Client->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="Pedido" data-field="x_ID_Client" name="o<?php echo $Pedido_grid->RowIndex ?>_ID_Client" id="o<?php echo $Pedido_grid->RowIndex ?>_ID_Client" value="<?php echo HtmlEncode($Pedido_grid->ID_Client->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Pedido_grid->ID_Status->Visible) { // ID_Status ?>
		<td data-name="ID_Status">
<?php if (!$Pedido->isConfirm()) { ?>
<span id="el$rowindex$_Pedido_ID_Status" class="form-group Pedido_ID_Status">
<input type="text" data-table="Pedido" data-field="x_ID_Status" name="x<?php echo $Pedido_grid->RowIndex ?>_ID_Status" id="x<?php echo $Pedido_grid->RowIndex ?>_ID_Status" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Pedido_grid->ID_Status->getPlaceHolder()) ?>" value="<?php echo $Pedido_grid->ID_Status->EditValue ?>"<?php echo $Pedido_grid->ID_Status->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_Pedido_ID_Status" class="form-group Pedido_ID_Status">
<span<?php echo $Pedido_grid->ID_Status->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Pedido_grid->ID_Status->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="Pedido" data-field="x_ID_Status" name="x<?php echo $Pedido_grid->RowIndex ?>_ID_Status" id="x<?php echo $Pedido_grid->RowIndex ?>_ID_Status" value="<?php echo HtmlEncode($Pedido_grid->ID_Status->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="Pedido" data-field="x_ID_Status" name="o<?php echo $Pedido_grid->RowIndex ?>_ID_Status" id="o<?php echo $Pedido_grid->RowIndex ?>_ID_Status" value="<?php echo HtmlEncode($Pedido_grid->ID_Status->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Pedido_grid->ID_Restaurant->Visible) { // ID_Restaurant ?>
		<td data-name="ID_Restaurant">
<?php if (!$Pedido->isConfirm()) { ?>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn() && !$Pedido->userIDAllow("grid")) { // Non system admin ?>
<span id="el$rowindex$_Pedido_ID_Restaurant" class="form-group Pedido_ID_Restaurant">
<span<?php echo $Pedido_grid->ID_Restaurant->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Pedido_grid->ID_Restaurant->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="Pedido" data-field="x_ID_Restaurant" name="x<?php echo $Pedido_grid->RowIndex ?>_ID_Restaurant" id="x<?php echo $Pedido_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($Pedido_grid->ID_Restaurant->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_Pedido_ID_Restaurant" class="form-group Pedido_ID_Restaurant">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Pedido" data-field="x_ID_Restaurant" data-value-separator="<?php echo $Pedido_grid->ID_Restaurant->displayValueSeparatorAttribute() ?>" id="x<?php echo $Pedido_grid->RowIndex ?>_ID_Restaurant" name="x<?php echo $Pedido_grid->RowIndex ?>_ID_Restaurant"<?php echo $Pedido_grid->ID_Restaurant->editAttributes() ?>>
			<?php echo $Pedido_grid->ID_Restaurant->selectOptionListHtml("x{$Pedido_grid->RowIndex}_ID_Restaurant") ?>
		</select>
</div>
<?php echo $Pedido_grid->ID_Restaurant->Lookup->getParamTag($Pedido_grid, "p_x" . $Pedido_grid->RowIndex . "_ID_Restaurant") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_Pedido_ID_Restaurant" class="form-group Pedido_ID_Restaurant">
<span<?php echo $Pedido_grid->ID_Restaurant->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Pedido_grid->ID_Restaurant->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="Pedido" data-field="x_ID_Restaurant" name="x<?php echo $Pedido_grid->RowIndex ?>_ID_Restaurant" id="x<?php echo $Pedido_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($Pedido_grid->ID_Restaurant->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="Pedido" data-field="x_ID_Restaurant" name="o<?php echo $Pedido_grid->RowIndex ?>_ID_Restaurant" id="o<?php echo $Pedido_grid->RowIndex ?>_ID_Restaurant" value="<?php echo HtmlEncode($Pedido_grid->ID_Restaurant->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Pedido_grid->DateCreation->Visible) { // DateCreation ?>
		<td data-name="DateCreation">
<?php if (!$Pedido->isConfirm()) { ?>
<span id="el$rowindex$_Pedido_DateCreation" class="form-group Pedido_DateCreation">
<input type="text" data-table="Pedido" data-field="x_DateCreation" data-format="1" name="x<?php echo $Pedido_grid->RowIndex ?>_DateCreation" id="x<?php echo $Pedido_grid->RowIndex ?>_DateCreation" maxlength="8" placeholder="<?php echo HtmlEncode($Pedido_grid->DateCreation->getPlaceHolder()) ?>" value="<?php echo $Pedido_grid->DateCreation->EditValue ?>"<?php echo $Pedido_grid->DateCreation->editAttributes() ?>>
<?php if (!$Pedido_grid->DateCreation->ReadOnly && !$Pedido_grid->DateCreation->Disabled && !isset($Pedido_grid->DateCreation->EditAttrs["readonly"]) && !isset($Pedido_grid->DateCreation->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fPedidogrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fPedidogrid", "x<?php echo $Pedido_grid->RowIndex ?>_DateCreation", {"ignoreReadonly":true,"useCurrent":false,"format":1});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_Pedido_DateCreation" class="form-group Pedido_DateCreation">
<span<?php echo $Pedido_grid->DateCreation->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Pedido_grid->DateCreation->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="Pedido" data-field="x_DateCreation" name="x<?php echo $Pedido_grid->RowIndex ?>_DateCreation" id="x<?php echo $Pedido_grid->RowIndex ?>_DateCreation" value="<?php echo HtmlEncode($Pedido_grid->DateCreation->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="Pedido" data-field="x_DateCreation" name="o<?php echo $Pedido_grid->RowIndex ?>_DateCreation" id="o<?php echo $Pedido_grid->RowIndex ?>_DateCreation" value="<?php echo HtmlEncode($Pedido_grid->DateCreation->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Pedido_grid->DateLastUpdate->Visible) { // DateLastUpdate ?>
		<td data-name="DateLastUpdate">
<?php if (!$Pedido->isConfirm()) { ?>
<span id="el$rowindex$_Pedido_DateLastUpdate" class="form-group Pedido_DateLastUpdate">
<input type="text" data-table="Pedido" data-field="x_DateLastUpdate" name="x<?php echo $Pedido_grid->RowIndex ?>_DateLastUpdate" id="x<?php echo $Pedido_grid->RowIndex ?>_DateLastUpdate" maxlength="8" placeholder="<?php echo HtmlEncode($Pedido_grid->DateLastUpdate->getPlaceHolder()) ?>" value="<?php echo $Pedido_grid->DateLastUpdate->EditValue ?>"<?php echo $Pedido_grid->DateLastUpdate->editAttributes() ?>>
<?php if (!$Pedido_grid->DateLastUpdate->ReadOnly && !$Pedido_grid->DateLastUpdate->Disabled && !isset($Pedido_grid->DateLastUpdate->EditAttrs["readonly"]) && !isset($Pedido_grid->DateLastUpdate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fPedidogrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fPedidogrid", "x<?php echo $Pedido_grid->RowIndex ?>_DateLastUpdate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_Pedido_DateLastUpdate" class="form-group Pedido_DateLastUpdate">
<span<?php echo $Pedido_grid->DateLastUpdate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Pedido_grid->DateLastUpdate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="Pedido" data-field="x_DateLastUpdate" name="x<?php echo $Pedido_grid->RowIndex ?>_DateLastUpdate" id="x<?php echo $Pedido_grid->RowIndex ?>_DateLastUpdate" value="<?php echo HtmlEncode($Pedido_grid->DateLastUpdate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="Pedido" data-field="x_DateLastUpdate" name="o<?php echo $Pedido_grid->RowIndex ?>_DateLastUpdate" id="o<?php echo $Pedido_grid->RowIndex ?>_DateLastUpdate" value="<?php echo HtmlEncode($Pedido_grid->DateLastUpdate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Pedido_grid->ID_Table->Visible) { // ID_Table ?>
		<td data-name="ID_Table">
<?php if (!$Pedido->isConfirm()) { ?>
<span id="el$rowindex$_Pedido_ID_Table" class="form-group Pedido_ID_Table">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Pedido" data-field="x_ID_Table" data-value-separator="<?php echo $Pedido_grid->ID_Table->displayValueSeparatorAttribute() ?>" id="x<?php echo $Pedido_grid->RowIndex ?>_ID_Table" name="x<?php echo $Pedido_grid->RowIndex ?>_ID_Table"<?php echo $Pedido_grid->ID_Table->editAttributes() ?>>
			<?php echo $Pedido_grid->ID_Table->selectOptionListHtml("x{$Pedido_grid->RowIndex}_ID_Table") ?>
		</select>
</div>
<?php echo $Pedido_grid->ID_Table->Lookup->getParamTag($Pedido_grid, "p_x" . $Pedido_grid->RowIndex . "_ID_Table") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_Pedido_ID_Table" class="form-group Pedido_ID_Table">
<span<?php echo $Pedido_grid->ID_Table->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Pedido_grid->ID_Table->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="Pedido" data-field="x_ID_Table" name="x<?php echo $Pedido_grid->RowIndex ?>_ID_Table" id="x<?php echo $Pedido_grid->RowIndex ?>_ID_Table" value="<?php echo HtmlEncode($Pedido_grid->ID_Table->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="Pedido" data-field="x_ID_Table" name="o<?php echo $Pedido_grid->RowIndex ?>_ID_Table" id="o<?php echo $Pedido_grid->RowIndex ?>_ID_Table" value="<?php echo HtmlEncode($Pedido_grid->ID_Table->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$Pedido_grid->ListOptions->render("body", "right", $Pedido_grid->RowIndex);
?>
<script>
loadjs.ready(["fPedidogrid", "load"], function() {
	fPedidogrid.updateLists(<?php echo $Pedido_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($Pedido->CurrentMode == "add" || $Pedido->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $Pedido_grid->FormKeyCountName ?>" id="<?php echo $Pedido_grid->FormKeyCountName ?>" value="<?php echo $Pedido_grid->KeyCount ?>">
<?php echo $Pedido_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($Pedido->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $Pedido_grid->FormKeyCountName ?>" id="<?php echo $Pedido_grid->FormKeyCountName ?>" value="<?php echo $Pedido_grid->KeyCount ?>">
<?php echo $Pedido_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($Pedido->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fPedidogrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($Pedido_grid->Recordset)
	$Pedido_grid->Recordset->Close();
?>
<?php if ($Pedido_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $Pedido_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($Pedido_grid->TotalRecords == 0 && !$Pedido->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $Pedido_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$Pedido_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$Pedido_grid->terminate();
?>