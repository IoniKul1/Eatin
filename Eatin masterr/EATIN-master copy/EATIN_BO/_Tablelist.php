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
$_Table_list = new _Table_list();

// Run the page
$_Table_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$_Table_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$_Table_list->isExport()) { ?>
<script>
var f_Tablelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	f_Tablelist = currentForm = new ew.Form("f_Tablelist", "list");
	f_Tablelist.formKeyCountName = '<?php echo $_Table_list->FormKeyCountName ?>';
	loadjs.done("f_Tablelist");
});
var f_Tablelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	f_Tablelistsrch = currentSearchForm = new ew.Form("f_Tablelistsrch");

	// Dynamic selection lists
	// Filters

	f_Tablelistsrch.filterList = <?php echo $_Table_list->getFilterList() ?>;
	loadjs.done("f_Tablelistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$_Table_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($_Table_list->TotalRecords > 0 && $_Table_list->ExportOptions->visible()) { ?>
<?php $_Table_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($_Table_list->ImportOptions->visible()) { ?>
<?php $_Table_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($_Table_list->SearchOptions->visible()) { ?>
<?php $_Table_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($_Table_list->FilterOptions->visible()) { ?>
<?php $_Table_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$_Table_list->isExport() || Config("EXPORT_MASTER_RECORD") && $_Table_list->isExport("print")) { ?>
<?php
if ($_Table_list->DbMasterFilter != "" && $_Table->getCurrentMasterTable() == "Restaurant") {
	if ($_Table_list->MasterRecordExists) {
		include_once "Restaurantmaster.php";
	}
}
?>
<?php } ?>
<?php
$_Table_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$_Table_list->isExport() && !$_Table->CurrentAction) { ?>
<form name="f_Tablelistsrch" id="f_Tablelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="f_Tablelistsrch-search-panel" class="<?php echo $_Table_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="_Table">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $_Table_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($_Table_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($_Table_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $_Table_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($_Table_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($_Table_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($_Table_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($_Table_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $_Table_list->showPageHeader(); ?>
<?php
$_Table_list->showMessage();
?>
<?php if ($_Table_list->TotalRecords > 0 || $_Table->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($_Table_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> _Table">
<?php if (!$_Table_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$_Table_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $_Table_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $_Table_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="f_Tablelist" id="f_Tablelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="_Table">
<?php if ($_Table->getCurrentMasterTable() == "Restaurant" && $_Table->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="Restaurant">
<input type="hidden" name="fk_ID" value="<?php echo HtmlEncode($_Table_list->ID_Restaurant->getSessionValue()) ?>">
<?php } ?>
<div id="gmp__Table" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($_Table_list->TotalRecords > 0 || $_Table_list->isGridEdit()) { ?>
<table id="tbl__Tablelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$_Table->RowType = ROWTYPE_HEADER;

// Render list options
$_Table_list->renderListOptions();

// Render list options (header, left)
$_Table_list->ListOptions->render("header", "left");
?>
<?php if ($_Table_list->ID->Visible) { // ID ?>
	<?php if ($_Table_list->SortUrl($_Table_list->ID) == "") { ?>
		<th data-name="ID" class="<?php echo $_Table_list->ID->headerCellClass() ?>"><div id="elh__Table_ID" class="_Table_ID"><div class="ew-table-header-caption"><?php echo $_Table_list->ID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID" class="<?php echo $_Table_list->ID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_Table_list->SortUrl($_Table_list->ID) ?>', 1);"><div id="elh__Table_ID" class="_Table_ID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_Table_list->ID->caption() ?></span><span class="ew-table-header-sort"><?php if ($_Table_list->ID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_Table_list->ID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_Table_list->ID_Restaurant->Visible) { // ID_Restaurant ?>
	<?php if ($_Table_list->SortUrl($_Table_list->ID_Restaurant) == "") { ?>
		<th data-name="ID_Restaurant" class="<?php echo $_Table_list->ID_Restaurant->headerCellClass() ?>"><div id="elh__Table_ID_Restaurant" class="_Table_ID_Restaurant"><div class="ew-table-header-caption"><?php echo $_Table_list->ID_Restaurant->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Restaurant" class="<?php echo $_Table_list->ID_Restaurant->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_Table_list->SortUrl($_Table_list->ID_Restaurant) ?>', 1);"><div id="elh__Table_ID_Restaurant" class="_Table_ID_Restaurant">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_Table_list->ID_Restaurant->caption() ?></span><span class="ew-table-header-sort"><?php if ($_Table_list->ID_Restaurant->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_Table_list->ID_Restaurant->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_Table_list->QRCode->Visible) { // QRCode ?>
	<?php if ($_Table_list->SortUrl($_Table_list->QRCode) == "") { ?>
		<th data-name="QRCode" class="<?php echo $_Table_list->QRCode->headerCellClass() ?>"><div id="elh__Table_QRCode" class="_Table_QRCode"><div class="ew-table-header-caption"><?php echo $_Table_list->QRCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="QRCode" class="<?php echo $_Table_list->QRCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_Table_list->SortUrl($_Table_list->QRCode) ?>', 1);"><div id="elh__Table_QRCode" class="_Table_QRCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_Table_list->QRCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_Table_list->QRCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_Table_list->QRCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_Table_list->Numero->Visible) { // Numero ?>
	<?php if ($_Table_list->SortUrl($_Table_list->Numero) == "") { ?>
		<th data-name="Numero" class="<?php echo $_Table_list->Numero->headerCellClass() ?>"><div id="elh__Table_Numero" class="_Table_Numero"><div class="ew-table-header-caption"><?php echo $_Table_list->Numero->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Numero" class="<?php echo $_Table_list->Numero->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_Table_list->SortUrl($_Table_list->Numero) ?>', 1);"><div id="elh__Table_Numero" class="_Table_Numero">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_Table_list->Numero->caption() ?></span><span class="ew-table-header-sort"><?php if ($_Table_list->Numero->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_Table_list->Numero->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$_Table_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($_Table_list->ExportAll && $_Table_list->isExport()) {
	$_Table_list->StopRecord = $_Table_list->TotalRecords;
} else {

	// Set the last record to display
	if ($_Table_list->TotalRecords > $_Table_list->StartRecord + $_Table_list->DisplayRecords - 1)
		$_Table_list->StopRecord = $_Table_list->StartRecord + $_Table_list->DisplayRecords - 1;
	else
		$_Table_list->StopRecord = $_Table_list->TotalRecords;
}
$_Table_list->RecordCount = $_Table_list->StartRecord - 1;
if ($_Table_list->Recordset && !$_Table_list->Recordset->EOF) {
	$_Table_list->Recordset->moveFirst();
	$selectLimit = $_Table_list->UseSelectLimit;
	if (!$selectLimit && $_Table_list->StartRecord > 1)
		$_Table_list->Recordset->move($_Table_list->StartRecord - 1);
} elseif (!$_Table->AllowAddDeleteRow && $_Table_list->StopRecord == 0) {
	$_Table_list->StopRecord = $_Table->GridAddRowCount;
}

// Initialize aggregate
$_Table->RowType = ROWTYPE_AGGREGATEINIT;
$_Table->resetAttributes();
$_Table_list->renderRow();
while ($_Table_list->RecordCount < $_Table_list->StopRecord) {
	$_Table_list->RecordCount++;
	if ($_Table_list->RecordCount >= $_Table_list->StartRecord) {
		$_Table_list->RowCount++;

		// Set up key count
		$_Table_list->KeyCount = $_Table_list->RowIndex;

		// Init row class and style
		$_Table->resetAttributes();
		$_Table->CssClass = "";
		if ($_Table_list->isGridAdd()) {
		} else {
			$_Table_list->loadRowValues($_Table_list->Recordset); // Load row values
		}
		$_Table->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$_Table->RowAttrs->merge(["data-rowindex" => $_Table_list->RowCount, "id" => "r" . $_Table_list->RowCount . "__Table", "data-rowtype" => $_Table->RowType]);

		// Render row
		$_Table_list->renderRow();

		// Render list options
		$_Table_list->renderListOptions();
?>
	<tr <?php echo $_Table->rowAttributes() ?>>
<?php

// Render list options (body, left)
$_Table_list->ListOptions->render("body", "left", $_Table_list->RowCount);
?>
	<?php if ($_Table_list->ID->Visible) { // ID ?>
		<td data-name="ID" <?php echo $_Table_list->ID->cellAttributes() ?>>
<span id="el<?php echo $_Table_list->RowCount ?>__Table_ID">
<span<?php echo $_Table_list->ID->viewAttributes() ?>><?php echo $_Table_list->ID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_Table_list->ID_Restaurant->Visible) { // ID_Restaurant ?>
		<td data-name="ID_Restaurant" <?php echo $_Table_list->ID_Restaurant->cellAttributes() ?>>
<span id="el<?php echo $_Table_list->RowCount ?>__Table_ID_Restaurant">
<span<?php echo $_Table_list->ID_Restaurant->viewAttributes() ?>><?php echo $_Table_list->ID_Restaurant->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_Table_list->QRCode->Visible) { // QRCode ?>
		<td data-name="QRCode" <?php echo $_Table_list->QRCode->cellAttributes() ?>>
<span id="el<?php echo $_Table_list->RowCount ?>__Table_QRCode">
<span<?php echo $_Table_list->QRCode->viewAttributes() ?>><?php if (!EmptyString($_Table_list->QRCode->getViewValue()) && $_Table_list->QRCode->linkAttributes() != "") { ?>
<a<?php echo $_Table_list->QRCode->linkAttributes() ?>><?php echo $_Table_list->QRCode->getViewValue() ?></a>
<?php } else { ?>
<?php echo $_Table_list->QRCode->getViewValue() ?>
<?php } ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_Table_list->Numero->Visible) { // Numero ?>
		<td data-name="Numero" <?php echo $_Table_list->Numero->cellAttributes() ?>>
<span id="el<?php echo $_Table_list->RowCount ?>__Table_Numero">
<span<?php echo $_Table_list->Numero->viewAttributes() ?>><?php echo $_Table_list->Numero->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$_Table_list->ListOptions->render("body", "right", $_Table_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$_Table_list->isGridAdd())
		$_Table_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$_Table->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($_Table_list->Recordset)
	$_Table_list->Recordset->Close();
?>
<?php if (!$_Table_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$_Table_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $_Table_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $_Table_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($_Table_list->TotalRecords == 0 && !$_Table->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $_Table_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$_Table_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$_Table_list->isExport()) { ?>
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
$_Table_list->terminate();
?>