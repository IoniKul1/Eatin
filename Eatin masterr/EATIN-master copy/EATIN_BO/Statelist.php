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
$State_list = new State_list();

// Run the page
$State_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$State_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$State_list->isExport()) { ?>
<script>
var fStatelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fStatelist = currentForm = new ew.Form("fStatelist", "list");
	fStatelist.formKeyCountName = '<?php echo $State_list->FormKeyCountName ?>';
	loadjs.done("fStatelist");
});
var fStatelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fStatelistsrch = currentSearchForm = new ew.Form("fStatelistsrch");

	// Dynamic selection lists
	// Filters

	fStatelistsrch.filterList = <?php echo $State_list->getFilterList() ?>;
	loadjs.done("fStatelistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$State_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($State_list->TotalRecords > 0 && $State_list->ExportOptions->visible()) { ?>
<?php $State_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($State_list->ImportOptions->visible()) { ?>
<?php $State_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($State_list->SearchOptions->visible()) { ?>
<?php $State_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($State_list->FilterOptions->visible()) { ?>
<?php $State_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$State_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$State_list->isExport() && !$State->CurrentAction) { ?>
<form name="fStatelistsrch" id="fStatelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fStatelistsrch-search-panel" class="<?php echo $State_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="State">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $State_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($State_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($State_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $State_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($State_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($State_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($State_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($State_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $State_list->showPageHeader(); ?>
<?php
$State_list->showMessage();
?>
<?php if ($State_list->TotalRecords > 0 || $State->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($State_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> State">
<?php if (!$State_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$State_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $State_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $State_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fStatelist" id="fStatelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="State">
<div id="gmp_State" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($State_list->TotalRecords > 0 || $State_list->isGridEdit()) { ?>
<table id="tbl_Statelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$State->RowType = ROWTYPE_HEADER;

// Render list options
$State_list->renderListOptions();

// Render list options (header, left)
$State_list->ListOptions->render("header", "left");
?>
<?php if ($State_list->ID->Visible) { // ID ?>
	<?php if ($State_list->SortUrl($State_list->ID) == "") { ?>
		<th data-name="ID" class="<?php echo $State_list->ID->headerCellClass() ?>"><div id="elh_State_ID" class="State_ID"><div class="ew-table-header-caption"><?php echo $State_list->ID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID" class="<?php echo $State_list->ID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $State_list->SortUrl($State_list->ID) ?>', 1);"><div id="elh_State_ID" class="State_ID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $State_list->ID->caption() ?></span><span class="ew-table-header-sort"><?php if ($State_list->ID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($State_list->ID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($State_list->Name->Visible) { // Name ?>
	<?php if ($State_list->SortUrl($State_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $State_list->Name->headerCellClass() ?>"><div id="elh_State_Name" class="State_Name"><div class="ew-table-header-caption"><?php echo $State_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $State_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $State_list->SortUrl($State_list->Name) ?>', 1);"><div id="elh_State_Name" class="State_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $State_list->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($State_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($State_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$State_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($State_list->ExportAll && $State_list->isExport()) {
	$State_list->StopRecord = $State_list->TotalRecords;
} else {

	// Set the last record to display
	if ($State_list->TotalRecords > $State_list->StartRecord + $State_list->DisplayRecords - 1)
		$State_list->StopRecord = $State_list->StartRecord + $State_list->DisplayRecords - 1;
	else
		$State_list->StopRecord = $State_list->TotalRecords;
}
$State_list->RecordCount = $State_list->StartRecord - 1;
if ($State_list->Recordset && !$State_list->Recordset->EOF) {
	$State_list->Recordset->moveFirst();
	$selectLimit = $State_list->UseSelectLimit;
	if (!$selectLimit && $State_list->StartRecord > 1)
		$State_list->Recordset->move($State_list->StartRecord - 1);
} elseif (!$State->AllowAddDeleteRow && $State_list->StopRecord == 0) {
	$State_list->StopRecord = $State->GridAddRowCount;
}

// Initialize aggregate
$State->RowType = ROWTYPE_AGGREGATEINIT;
$State->resetAttributes();
$State_list->renderRow();
while ($State_list->RecordCount < $State_list->StopRecord) {
	$State_list->RecordCount++;
	if ($State_list->RecordCount >= $State_list->StartRecord) {
		$State_list->RowCount++;

		// Set up key count
		$State_list->KeyCount = $State_list->RowIndex;

		// Init row class and style
		$State->resetAttributes();
		$State->CssClass = "";
		if ($State_list->isGridAdd()) {
		} else {
			$State_list->loadRowValues($State_list->Recordset); // Load row values
		}
		$State->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$State->RowAttrs->merge(["data-rowindex" => $State_list->RowCount, "id" => "r" . $State_list->RowCount . "_State", "data-rowtype" => $State->RowType]);

		// Render row
		$State_list->renderRow();

		// Render list options
		$State_list->renderListOptions();
?>
	<tr <?php echo $State->rowAttributes() ?>>
<?php

// Render list options (body, left)
$State_list->ListOptions->render("body", "left", $State_list->RowCount);
?>
	<?php if ($State_list->ID->Visible) { // ID ?>
		<td data-name="ID" <?php echo $State_list->ID->cellAttributes() ?>>
<span id="el<?php echo $State_list->RowCount ?>_State_ID">
<span<?php echo $State_list->ID->viewAttributes() ?>><?php echo $State_list->ID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($State_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $State_list->Name->cellAttributes() ?>>
<span id="el<?php echo $State_list->RowCount ?>_State_Name">
<span<?php echo $State_list->Name->viewAttributes() ?>><?php echo $State_list->Name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$State_list->ListOptions->render("body", "right", $State_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$State_list->isGridAdd())
		$State_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$State->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($State_list->Recordset)
	$State_list->Recordset->Close();
?>
<?php if (!$State_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$State_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $State_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $State_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($State_list->TotalRecords == 0 && !$State->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $State_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$State_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$State_list->isExport()) { ?>
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
$State_list->terminate();
?>