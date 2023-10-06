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
$ItemOptions_list = new ItemOptions_list();

// Run the page
$ItemOptions_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ItemOptions_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$ItemOptions_list->isExport()) { ?>
<script>
var fItemOptionslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fItemOptionslist = currentForm = new ew.Form("fItemOptionslist", "list");
	fItemOptionslist.formKeyCountName = '<?php echo $ItemOptions_list->FormKeyCountName ?>';
	loadjs.done("fItemOptionslist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$ItemOptions_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($ItemOptions_list->TotalRecords > 0 && $ItemOptions_list->ExportOptions->visible()) { ?>
<?php $ItemOptions_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($ItemOptions_list->ImportOptions->visible()) { ?>
<?php $ItemOptions_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$ItemOptions_list->renderOtherOptions();
?>
<?php $ItemOptions_list->showPageHeader(); ?>
<?php
$ItemOptions_list->showMessage();
?>
<?php if ($ItemOptions_list->TotalRecords > 0 || $ItemOptions->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($ItemOptions_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> ItemOptions">
<?php if (!$ItemOptions_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$ItemOptions_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ItemOptions_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ItemOptions_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fItemOptionslist" id="fItemOptionslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ItemOptions">
<div id="gmp_ItemOptions" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($ItemOptions_list->TotalRecords > 0 || $ItemOptions_list->isGridEdit()) { ?>
<table id="tbl_ItemOptionslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$ItemOptions->RowType = ROWTYPE_HEADER;

// Render list options
$ItemOptions_list->renderListOptions();

// Render list options (header, left)
$ItemOptions_list->ListOptions->render("header", "left");
?>
<?php if ($ItemOptions_list->ID->Visible) { // ID ?>
	<?php if ($ItemOptions_list->SortUrl($ItemOptions_list->ID) == "") { ?>
		<th data-name="ID" class="<?php echo $ItemOptions_list->ID->headerCellClass() ?>"><div id="elh_ItemOptions_ID" class="ItemOptions_ID"><div class="ew-table-header-caption"><?php echo $ItemOptions_list->ID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID" class="<?php echo $ItemOptions_list->ID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ItemOptions_list->SortUrl($ItemOptions_list->ID) ?>', 1);"><div id="elh_ItemOptions_ID" class="ItemOptions_ID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ItemOptions_list->ID->caption() ?></span><span class="ew-table-header-sort"><?php if ($ItemOptions_list->ID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ItemOptions_list->ID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ItemOptions_list->ID_Item->Visible) { // ID_Item ?>
	<?php if ($ItemOptions_list->SortUrl($ItemOptions_list->ID_Item) == "") { ?>
		<th data-name="ID_Item" class="<?php echo $ItemOptions_list->ID_Item->headerCellClass() ?>"><div id="elh_ItemOptions_ID_Item" class="ItemOptions_ID_Item"><div class="ew-table-header-caption"><?php echo $ItemOptions_list->ID_Item->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Item" class="<?php echo $ItemOptions_list->ID_Item->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ItemOptions_list->SortUrl($ItemOptions_list->ID_Item) ?>', 1);"><div id="elh_ItemOptions_ID_Item" class="ItemOptions_ID_Item">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ItemOptions_list->ID_Item->caption() ?></span><span class="ew-table-header-sort"><?php if ($ItemOptions_list->ID_Item->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ItemOptions_list->ID_Item->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ItemOptions_list->ID_Restaurant->Visible) { // ID_Restaurant ?>
	<?php if ($ItemOptions_list->SortUrl($ItemOptions_list->ID_Restaurant) == "") { ?>
		<th data-name="ID_Restaurant" class="<?php echo $ItemOptions_list->ID_Restaurant->headerCellClass() ?>"><div id="elh_ItemOptions_ID_Restaurant" class="ItemOptions_ID_Restaurant"><div class="ew-table-header-caption"><?php echo $ItemOptions_list->ID_Restaurant->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Restaurant" class="<?php echo $ItemOptions_list->ID_Restaurant->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ItemOptions_list->SortUrl($ItemOptions_list->ID_Restaurant) ?>', 1);"><div id="elh_ItemOptions_ID_Restaurant" class="ItemOptions_ID_Restaurant">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ItemOptions_list->ID_Restaurant->caption() ?></span><span class="ew-table-header-sort"><?php if ($ItemOptions_list->ID_Restaurant->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ItemOptions_list->ID_Restaurant->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$ItemOptions_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($ItemOptions_list->ExportAll && $ItemOptions_list->isExport()) {
	$ItemOptions_list->StopRecord = $ItemOptions_list->TotalRecords;
} else {

	// Set the last record to display
	if ($ItemOptions_list->TotalRecords > $ItemOptions_list->StartRecord + $ItemOptions_list->DisplayRecords - 1)
		$ItemOptions_list->StopRecord = $ItemOptions_list->StartRecord + $ItemOptions_list->DisplayRecords - 1;
	else
		$ItemOptions_list->StopRecord = $ItemOptions_list->TotalRecords;
}
$ItemOptions_list->RecordCount = $ItemOptions_list->StartRecord - 1;
if ($ItemOptions_list->Recordset && !$ItemOptions_list->Recordset->EOF) {
	$ItemOptions_list->Recordset->moveFirst();
	$selectLimit = $ItemOptions_list->UseSelectLimit;
	if (!$selectLimit && $ItemOptions_list->StartRecord > 1)
		$ItemOptions_list->Recordset->move($ItemOptions_list->StartRecord - 1);
} elseif (!$ItemOptions->AllowAddDeleteRow && $ItemOptions_list->StopRecord == 0) {
	$ItemOptions_list->StopRecord = $ItemOptions->GridAddRowCount;
}

// Initialize aggregate
$ItemOptions->RowType = ROWTYPE_AGGREGATEINIT;
$ItemOptions->resetAttributes();
$ItemOptions_list->renderRow();
while ($ItemOptions_list->RecordCount < $ItemOptions_list->StopRecord) {
	$ItemOptions_list->RecordCount++;
	if ($ItemOptions_list->RecordCount >= $ItemOptions_list->StartRecord) {
		$ItemOptions_list->RowCount++;

		// Set up key count
		$ItemOptions_list->KeyCount = $ItemOptions_list->RowIndex;

		// Init row class and style
		$ItemOptions->resetAttributes();
		$ItemOptions->CssClass = "";
		if ($ItemOptions_list->isGridAdd()) {
		} else {
			$ItemOptions_list->loadRowValues($ItemOptions_list->Recordset); // Load row values
		}
		$ItemOptions->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$ItemOptions->RowAttrs->merge(["data-rowindex" => $ItemOptions_list->RowCount, "id" => "r" . $ItemOptions_list->RowCount . "_ItemOptions", "data-rowtype" => $ItemOptions->RowType]);

		// Render row
		$ItemOptions_list->renderRow();

		// Render list options
		$ItemOptions_list->renderListOptions();
?>
	<tr <?php echo $ItemOptions->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ItemOptions_list->ListOptions->render("body", "left", $ItemOptions_list->RowCount);
?>
	<?php if ($ItemOptions_list->ID->Visible) { // ID ?>
		<td data-name="ID" <?php echo $ItemOptions_list->ID->cellAttributes() ?>>
<span id="el<?php echo $ItemOptions_list->RowCount ?>_ItemOptions_ID">
<span<?php echo $ItemOptions_list->ID->viewAttributes() ?>><?php echo $ItemOptions_list->ID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ItemOptions_list->ID_Item->Visible) { // ID_Item ?>
		<td data-name="ID_Item" <?php echo $ItemOptions_list->ID_Item->cellAttributes() ?>>
<span id="el<?php echo $ItemOptions_list->RowCount ?>_ItemOptions_ID_Item">
<span<?php echo $ItemOptions_list->ID_Item->viewAttributes() ?>><?php echo $ItemOptions_list->ID_Item->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ItemOptions_list->ID_Restaurant->Visible) { // ID_Restaurant ?>
		<td data-name="ID_Restaurant" <?php echo $ItemOptions_list->ID_Restaurant->cellAttributes() ?>>
<span id="el<?php echo $ItemOptions_list->RowCount ?>_ItemOptions_ID_Restaurant">
<span<?php echo $ItemOptions_list->ID_Restaurant->viewAttributes() ?>><?php echo $ItemOptions_list->ID_Restaurant->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ItemOptions_list->ListOptions->render("body", "right", $ItemOptions_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$ItemOptions_list->isGridAdd())
		$ItemOptions_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$ItemOptions->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($ItemOptions_list->Recordset)
	$ItemOptions_list->Recordset->Close();
?>
<?php if (!$ItemOptions_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$ItemOptions_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ItemOptions_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ItemOptions_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($ItemOptions_list->TotalRecords == 0 && !$ItemOptions->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $ItemOptions_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$ItemOptions_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$ItemOptions_list->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$ItemOptions_list->terminate();
?>