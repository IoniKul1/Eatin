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
$Countries_list = new Countries_list();

// Run the page
$Countries_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Countries_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$Countries_list->isExport()) { ?>
<script>
var fCountrieslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fCountrieslist = currentForm = new ew.Form("fCountrieslist", "list");
	fCountrieslist.formKeyCountName = '<?php echo $Countries_list->FormKeyCountName ?>';
	loadjs.done("fCountrieslist");
});
var fCountrieslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fCountrieslistsrch = currentSearchForm = new ew.Form("fCountrieslistsrch");

	// Dynamic selection lists
	// Filters

	fCountrieslistsrch.filterList = <?php echo $Countries_list->getFilterList() ?>;
	loadjs.done("fCountrieslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$Countries_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($Countries_list->TotalRecords > 0 && $Countries_list->ExportOptions->visible()) { ?>
<?php $Countries_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Countries_list->ImportOptions->visible()) { ?>
<?php $Countries_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($Countries_list->SearchOptions->visible()) { ?>
<?php $Countries_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($Countries_list->FilterOptions->visible()) { ?>
<?php $Countries_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$Countries_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$Countries_list->isExport() && !$Countries->CurrentAction) { ?>
<form name="fCountrieslistsrch" id="fCountrieslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fCountrieslistsrch-search-panel" class="<?php echo $Countries_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="Countries">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $Countries_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($Countries_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($Countries_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $Countries_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($Countries_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($Countries_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($Countries_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($Countries_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $Countries_list->showPageHeader(); ?>
<?php
$Countries_list->showMessage();
?>
<?php if ($Countries_list->TotalRecords > 0 || $Countries->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Countries_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> Countries">
<?php if (!$Countries_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$Countries_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Countries_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Countries_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fCountrieslist" id="fCountrieslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Countries">
<div id="gmp_Countries" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Countries_list->TotalRecords > 0 || $Countries_list->isGridEdit()) { ?>
<table id="tbl_Countrieslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$Countries->RowType = ROWTYPE_HEADER;

// Render list options
$Countries_list->renderListOptions();

// Render list options (header, left)
$Countries_list->ListOptions->render("header", "left");
?>
<?php if ($Countries_list->ID->Visible) { // ID ?>
	<?php if ($Countries_list->SortUrl($Countries_list->ID) == "") { ?>
		<th data-name="ID" class="<?php echo $Countries_list->ID->headerCellClass() ?>"><div id="elh_Countries_ID" class="Countries_ID"><div class="ew-table-header-caption"><?php echo $Countries_list->ID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID" class="<?php echo $Countries_list->ID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Countries_list->SortUrl($Countries_list->ID) ?>', 1);"><div id="elh_Countries_ID" class="Countries_ID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Countries_list->ID->caption() ?></span><span class="ew-table-header-sort"><?php if ($Countries_list->ID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Countries_list->ID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Countries_list->Name->Visible) { // Name ?>
	<?php if ($Countries_list->SortUrl($Countries_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $Countries_list->Name->headerCellClass() ?>"><div id="elh_Countries_Name" class="Countries_Name"><div class="ew-table-header-caption"><?php echo $Countries_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $Countries_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Countries_list->SortUrl($Countries_list->Name) ?>', 1);"><div id="elh_Countries_Name" class="Countries_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Countries_list->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($Countries_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Countries_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$Countries_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($Countries_list->ExportAll && $Countries_list->isExport()) {
	$Countries_list->StopRecord = $Countries_list->TotalRecords;
} else {

	// Set the last record to display
	if ($Countries_list->TotalRecords > $Countries_list->StartRecord + $Countries_list->DisplayRecords - 1)
		$Countries_list->StopRecord = $Countries_list->StartRecord + $Countries_list->DisplayRecords - 1;
	else
		$Countries_list->StopRecord = $Countries_list->TotalRecords;
}
$Countries_list->RecordCount = $Countries_list->StartRecord - 1;
if ($Countries_list->Recordset && !$Countries_list->Recordset->EOF) {
	$Countries_list->Recordset->moveFirst();
	$selectLimit = $Countries_list->UseSelectLimit;
	if (!$selectLimit && $Countries_list->StartRecord > 1)
		$Countries_list->Recordset->move($Countries_list->StartRecord - 1);
} elseif (!$Countries->AllowAddDeleteRow && $Countries_list->StopRecord == 0) {
	$Countries_list->StopRecord = $Countries->GridAddRowCount;
}

// Initialize aggregate
$Countries->RowType = ROWTYPE_AGGREGATEINIT;
$Countries->resetAttributes();
$Countries_list->renderRow();
while ($Countries_list->RecordCount < $Countries_list->StopRecord) {
	$Countries_list->RecordCount++;
	if ($Countries_list->RecordCount >= $Countries_list->StartRecord) {
		$Countries_list->RowCount++;

		// Set up key count
		$Countries_list->KeyCount = $Countries_list->RowIndex;

		// Init row class and style
		$Countries->resetAttributes();
		$Countries->CssClass = "";
		if ($Countries_list->isGridAdd()) {
		} else {
			$Countries_list->loadRowValues($Countries_list->Recordset); // Load row values
		}
		$Countries->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$Countries->RowAttrs->merge(["data-rowindex" => $Countries_list->RowCount, "id" => "r" . $Countries_list->RowCount . "_Countries", "data-rowtype" => $Countries->RowType]);

		// Render row
		$Countries_list->renderRow();

		// Render list options
		$Countries_list->renderListOptions();
?>
	<tr <?php echo $Countries->rowAttributes() ?>>
<?php

// Render list options (body, left)
$Countries_list->ListOptions->render("body", "left", $Countries_list->RowCount);
?>
	<?php if ($Countries_list->ID->Visible) { // ID ?>
		<td data-name="ID" <?php echo $Countries_list->ID->cellAttributes() ?>>
<span id="el<?php echo $Countries_list->RowCount ?>_Countries_ID">
<span<?php echo $Countries_list->ID->viewAttributes() ?>><?php echo $Countries_list->ID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Countries_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $Countries_list->Name->cellAttributes() ?>>
<span id="el<?php echo $Countries_list->RowCount ?>_Countries_Name">
<span<?php echo $Countries_list->Name->viewAttributes() ?>><?php echo $Countries_list->Name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$Countries_list->ListOptions->render("body", "right", $Countries_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$Countries_list->isGridAdd())
		$Countries_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$Countries->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($Countries_list->Recordset)
	$Countries_list->Recordset->Close();
?>
<?php if (!$Countries_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$Countries_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Countries_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Countries_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($Countries_list->TotalRecords == 0 && !$Countries->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $Countries_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$Countries_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$Countries_list->isExport()) { ?>
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
$Countries_list->terminate();
?>