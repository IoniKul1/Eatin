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
$Restaurant_list = new Restaurant_list();

// Run the page
$Restaurant_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Restaurant_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$Restaurant_list->isExport()) { ?>
<script>
var fRestaurantlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fRestaurantlist = currentForm = new ew.Form("fRestaurantlist", "list");
	fRestaurantlist.formKeyCountName = '<?php echo $Restaurant_list->FormKeyCountName ?>';
	loadjs.done("fRestaurantlist");
});
var fRestaurantlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fRestaurantlistsrch = currentSearchForm = new ew.Form("fRestaurantlistsrch");

	// Dynamic selection lists
	// Filters

	fRestaurantlistsrch.filterList = <?php echo $Restaurant_list->getFilterList() ?>;
	loadjs.done("fRestaurantlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$Restaurant_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($Restaurant_list->TotalRecords > 0 && $Restaurant_list->ExportOptions->visible()) { ?>
<?php $Restaurant_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Restaurant_list->ImportOptions->visible()) { ?>
<?php $Restaurant_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($Restaurant_list->SearchOptions->visible()) { ?>
<?php $Restaurant_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($Restaurant_list->FilterOptions->visible()) { ?>
<?php $Restaurant_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$Restaurant_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$Restaurant_list->isExport() && !$Restaurant->CurrentAction) { ?>
<form name="fRestaurantlistsrch" id="fRestaurantlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fRestaurantlistsrch-search-panel" class="<?php echo $Restaurant_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="Restaurant">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $Restaurant_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($Restaurant_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($Restaurant_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $Restaurant_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($Restaurant_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($Restaurant_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($Restaurant_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($Restaurant_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $Restaurant_list->showPageHeader(); ?>
<?php
$Restaurant_list->showMessage();
?>
<?php if ($Restaurant_list->TotalRecords > 0 || $Restaurant->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Restaurant_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> Restaurant">
<?php if (!$Restaurant_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$Restaurant_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Restaurant_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Restaurant_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fRestaurantlist" id="fRestaurantlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Restaurant">
<div id="gmp_Restaurant" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Restaurant_list->TotalRecords > 0 || $Restaurant_list->isGridEdit()) { ?>
<table id="tbl_Restaurantlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$Restaurant->RowType = ROWTYPE_HEADER;

// Render list options
$Restaurant_list->renderListOptions();

// Render list options (header, left)
$Restaurant_list->ListOptions->render("header", "left");
?>
<?php if ($Restaurant_list->ID->Visible) { // ID ?>
	<?php if ($Restaurant_list->SortUrl($Restaurant_list->ID) == "") { ?>
		<th data-name="ID" class="<?php echo $Restaurant_list->ID->headerCellClass() ?>"><div id="elh_Restaurant_ID" class="Restaurant_ID"><div class="ew-table-header-caption"><?php echo $Restaurant_list->ID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID" class="<?php echo $Restaurant_list->ID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Restaurant_list->SortUrl($Restaurant_list->ID) ?>', 1);"><div id="elh_Restaurant_ID" class="Restaurant_ID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Restaurant_list->ID->caption() ?></span><span class="ew-table-header-sort"><?php if ($Restaurant_list->ID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Restaurant_list->ID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Restaurant_list->ID_State->Visible) { // ID_State ?>
	<?php if ($Restaurant_list->SortUrl($Restaurant_list->ID_State) == "") { ?>
		<th data-name="ID_State" class="<?php echo $Restaurant_list->ID_State->headerCellClass() ?>"><div id="elh_Restaurant_ID_State" class="Restaurant_ID_State"><div class="ew-table-header-caption"><?php echo $Restaurant_list->ID_State->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_State" class="<?php echo $Restaurant_list->ID_State->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Restaurant_list->SortUrl($Restaurant_list->ID_State) ?>', 1);"><div id="elh_Restaurant_ID_State" class="Restaurant_ID_State">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Restaurant_list->ID_State->caption() ?></span><span class="ew-table-header-sort"><?php if ($Restaurant_list->ID_State->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Restaurant_list->ID_State->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Restaurant_list->Nombre->Visible) { // Nombre ?>
	<?php if ($Restaurant_list->SortUrl($Restaurant_list->Nombre) == "") { ?>
		<th data-name="Nombre" class="<?php echo $Restaurant_list->Nombre->headerCellClass() ?>"><div id="elh_Restaurant_Nombre" class="Restaurant_Nombre"><div class="ew-table-header-caption"><?php echo $Restaurant_list->Nombre->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Nombre" class="<?php echo $Restaurant_list->Nombre->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Restaurant_list->SortUrl($Restaurant_list->Nombre) ?>', 1);"><div id="elh_Restaurant_Nombre" class="Restaurant_Nombre">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Restaurant_list->Nombre->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($Restaurant_list->Nombre->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Restaurant_list->Nombre->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Restaurant_list->Address->Visible) { // Address ?>
	<?php if ($Restaurant_list->SortUrl($Restaurant_list->Address) == "") { ?>
		<th data-name="Address" class="<?php echo $Restaurant_list->Address->headerCellClass() ?>"><div id="elh_Restaurant_Address" class="Restaurant_Address"><div class="ew-table-header-caption"><?php echo $Restaurant_list->Address->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Address" class="<?php echo $Restaurant_list->Address->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Restaurant_list->SortUrl($Restaurant_list->Address) ?>', 1);"><div id="elh_Restaurant_Address" class="Restaurant_Address">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Restaurant_list->Address->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($Restaurant_list->Address->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Restaurant_list->Address->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Restaurant_list->Deactivated->Visible) { // Deactivated ?>
	<?php if ($Restaurant_list->SortUrl($Restaurant_list->Deactivated) == "") { ?>
		<th data-name="Deactivated" class="<?php echo $Restaurant_list->Deactivated->headerCellClass() ?>"><div id="elh_Restaurant_Deactivated" class="Restaurant_Deactivated"><div class="ew-table-header-caption"><?php echo $Restaurant_list->Deactivated->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Deactivated" class="<?php echo $Restaurant_list->Deactivated->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Restaurant_list->SortUrl($Restaurant_list->Deactivated) ?>', 1);"><div id="elh_Restaurant_Deactivated" class="Restaurant_Deactivated">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Restaurant_list->Deactivated->caption() ?></span><span class="ew-table-header-sort"><?php if ($Restaurant_list->Deactivated->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Restaurant_list->Deactivated->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Restaurant_list->Suspended->Visible) { // Suspended ?>
	<?php if ($Restaurant_list->SortUrl($Restaurant_list->Suspended) == "") { ?>
		<th data-name="Suspended" class="<?php echo $Restaurant_list->Suspended->headerCellClass() ?>"><div id="elh_Restaurant_Suspended" class="Restaurant_Suspended"><div class="ew-table-header-caption"><?php echo $Restaurant_list->Suspended->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Suspended" class="<?php echo $Restaurant_list->Suspended->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Restaurant_list->SortUrl($Restaurant_list->Suspended) ?>', 1);"><div id="elh_Restaurant_Suspended" class="Restaurant_Suspended">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Restaurant_list->Suspended->caption() ?></span><span class="ew-table-header-sort"><?php if ($Restaurant_list->Suspended->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Restaurant_list->Suspended->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Restaurant_list->_Email->Visible) { // Email ?>
	<?php if ($Restaurant_list->SortUrl($Restaurant_list->_Email) == "") { ?>
		<th data-name="_Email" class="<?php echo $Restaurant_list->_Email->headerCellClass() ?>"><div id="elh_Restaurant__Email" class="Restaurant__Email"><div class="ew-table-header-caption"><?php echo $Restaurant_list->_Email->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_Email" class="<?php echo $Restaurant_list->_Email->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Restaurant_list->SortUrl($Restaurant_list->_Email) ?>', 1);"><div id="elh_Restaurant__Email" class="Restaurant__Email">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Restaurant_list->_Email->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($Restaurant_list->_Email->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Restaurant_list->_Email->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Restaurant_list->Password->Visible) { // Password ?>
	<?php if ($Restaurant_list->SortUrl($Restaurant_list->Password) == "") { ?>
		<th data-name="Password" class="<?php echo $Restaurant_list->Password->headerCellClass() ?>"><div id="elh_Restaurant_Password" class="Restaurant_Password"><div class="ew-table-header-caption"><?php echo $Restaurant_list->Password->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Password" class="<?php echo $Restaurant_list->Password->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Restaurant_list->SortUrl($Restaurant_list->Password) ?>', 1);"><div id="elh_Restaurant_Password" class="Restaurant_Password">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Restaurant_list->Password->caption() ?></span><span class="ew-table-header-sort"><?php if ($Restaurant_list->Password->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Restaurant_list->Password->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Restaurant_list->SplashImg->Visible) { // SplashImg ?>
	<?php if ($Restaurant_list->SortUrl($Restaurant_list->SplashImg) == "") { ?>
		<th data-name="SplashImg" class="<?php echo $Restaurant_list->SplashImg->headerCellClass() ?>"><div id="elh_Restaurant_SplashImg" class="Restaurant_SplashImg"><div class="ew-table-header-caption"><?php echo $Restaurant_list->SplashImg->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SplashImg" class="<?php echo $Restaurant_list->SplashImg->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Restaurant_list->SortUrl($Restaurant_list->SplashImg) ?>', 1);"><div id="elh_Restaurant_SplashImg" class="Restaurant_SplashImg">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Restaurant_list->SplashImg->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($Restaurant_list->SplashImg->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Restaurant_list->SplashImg->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Restaurant_list->LogoSize1->Visible) { // LogoSize1 ?>
	<?php if ($Restaurant_list->SortUrl($Restaurant_list->LogoSize1) == "") { ?>
		<th data-name="LogoSize1" class="<?php echo $Restaurant_list->LogoSize1->headerCellClass() ?>"><div id="elh_Restaurant_LogoSize1" class="Restaurant_LogoSize1"><div class="ew-table-header-caption"><?php echo $Restaurant_list->LogoSize1->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LogoSize1" class="<?php echo $Restaurant_list->LogoSize1->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Restaurant_list->SortUrl($Restaurant_list->LogoSize1) ?>', 1);"><div id="elh_Restaurant_LogoSize1" class="Restaurant_LogoSize1">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Restaurant_list->LogoSize1->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($Restaurant_list->LogoSize1->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Restaurant_list->LogoSize1->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Restaurant_list->LogoSize2->Visible) { // LogoSize2 ?>
	<?php if ($Restaurant_list->SortUrl($Restaurant_list->LogoSize2) == "") { ?>
		<th data-name="LogoSize2" class="<?php echo $Restaurant_list->LogoSize2->headerCellClass() ?>"><div id="elh_Restaurant_LogoSize2" class="Restaurant_LogoSize2"><div class="ew-table-header-caption"><?php echo $Restaurant_list->LogoSize2->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LogoSize2" class="<?php echo $Restaurant_list->LogoSize2->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Restaurant_list->SortUrl($Restaurant_list->LogoSize2) ?>', 1);"><div id="elh_Restaurant_LogoSize2" class="Restaurant_LogoSize2">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Restaurant_list->LogoSize2->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($Restaurant_list->LogoSize2->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Restaurant_list->LogoSize2->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Restaurant_list->AppCSS->Visible) { // AppCSS ?>
	<?php if ($Restaurant_list->SortUrl($Restaurant_list->AppCSS) == "") { ?>
		<th data-name="AppCSS" class="<?php echo $Restaurant_list->AppCSS->headerCellClass() ?>"><div id="elh_Restaurant_AppCSS" class="Restaurant_AppCSS"><div class="ew-table-header-caption"><?php echo $Restaurant_list->AppCSS->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AppCSS" class="<?php echo $Restaurant_list->AppCSS->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Restaurant_list->SortUrl($Restaurant_list->AppCSS) ?>', 1);"><div id="elh_Restaurant_AppCSS" class="Restaurant_AppCSS">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Restaurant_list->AppCSS->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($Restaurant_list->AppCSS->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Restaurant_list->AppCSS->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Restaurant_list->SplashVideo->Visible) { // SplashVideo ?>
	<?php if ($Restaurant_list->SortUrl($Restaurant_list->SplashVideo) == "") { ?>
		<th data-name="SplashVideo" class="<?php echo $Restaurant_list->SplashVideo->headerCellClass() ?>"><div id="elh_Restaurant_SplashVideo" class="Restaurant_SplashVideo"><div class="ew-table-header-caption"><?php echo $Restaurant_list->SplashVideo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SplashVideo" class="<?php echo $Restaurant_list->SplashVideo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Restaurant_list->SortUrl($Restaurant_list->SplashVideo) ?>', 1);"><div id="elh_Restaurant_SplashVideo" class="Restaurant_SplashVideo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Restaurant_list->SplashVideo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($Restaurant_list->SplashVideo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Restaurant_list->SplashVideo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$Restaurant_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($Restaurant_list->ExportAll && $Restaurant_list->isExport()) {
	$Restaurant_list->StopRecord = $Restaurant_list->TotalRecords;
} else {

	// Set the last record to display
	if ($Restaurant_list->TotalRecords > $Restaurant_list->StartRecord + $Restaurant_list->DisplayRecords - 1)
		$Restaurant_list->StopRecord = $Restaurant_list->StartRecord + $Restaurant_list->DisplayRecords - 1;
	else
		$Restaurant_list->StopRecord = $Restaurant_list->TotalRecords;
}
$Restaurant_list->RecordCount = $Restaurant_list->StartRecord - 1;
if ($Restaurant_list->Recordset && !$Restaurant_list->Recordset->EOF) {
	$Restaurant_list->Recordset->moveFirst();
	$selectLimit = $Restaurant_list->UseSelectLimit;
	if (!$selectLimit && $Restaurant_list->StartRecord > 1)
		$Restaurant_list->Recordset->move($Restaurant_list->StartRecord - 1);
} elseif (!$Restaurant->AllowAddDeleteRow && $Restaurant_list->StopRecord == 0) {
	$Restaurant_list->StopRecord = $Restaurant->GridAddRowCount;
}

// Initialize aggregate
$Restaurant->RowType = ROWTYPE_AGGREGATEINIT;
$Restaurant->resetAttributes();
$Restaurant_list->renderRow();
while ($Restaurant_list->RecordCount < $Restaurant_list->StopRecord) {
	$Restaurant_list->RecordCount++;
	if ($Restaurant_list->RecordCount >= $Restaurant_list->StartRecord) {
		$Restaurant_list->RowCount++;

		// Set up key count
		$Restaurant_list->KeyCount = $Restaurant_list->RowIndex;

		// Init row class and style
		$Restaurant->resetAttributes();
		$Restaurant->CssClass = "";
		if ($Restaurant_list->isGridAdd()) {
		} else {
			$Restaurant_list->loadRowValues($Restaurant_list->Recordset); // Load row values
		}
		$Restaurant->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$Restaurant->RowAttrs->merge(["data-rowindex" => $Restaurant_list->RowCount, "id" => "r" . $Restaurant_list->RowCount . "_Restaurant", "data-rowtype" => $Restaurant->RowType]);

		// Render row
		$Restaurant_list->renderRow();

		// Render list options
		$Restaurant_list->renderListOptions();
?>
	<tr <?php echo $Restaurant->rowAttributes() ?>>
<?php

// Render list options (body, left)
$Restaurant_list->ListOptions->render("body", "left", $Restaurant_list->RowCount);
?>
	<?php if ($Restaurant_list->ID->Visible) { // ID ?>
		<td data-name="ID" <?php echo $Restaurant_list->ID->cellAttributes() ?>>
<span id="el<?php echo $Restaurant_list->RowCount ?>_Restaurant_ID">
<span<?php echo $Restaurant_list->ID->viewAttributes() ?>><?php echo $Restaurant_list->ID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Restaurant_list->ID_State->Visible) { // ID_State ?>
		<td data-name="ID_State" <?php echo $Restaurant_list->ID_State->cellAttributes() ?>>
<span id="el<?php echo $Restaurant_list->RowCount ?>_Restaurant_ID_State">
<span<?php echo $Restaurant_list->ID_State->viewAttributes() ?>><?php echo $Restaurant_list->ID_State->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Restaurant_list->Nombre->Visible) { // Nombre ?>
		<td data-name="Nombre" <?php echo $Restaurant_list->Nombre->cellAttributes() ?>>
<span id="el<?php echo $Restaurant_list->RowCount ?>_Restaurant_Nombre">
<span<?php echo $Restaurant_list->Nombre->viewAttributes() ?>><?php echo $Restaurant_list->Nombre->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Restaurant_list->Address->Visible) { // Address ?>
		<td data-name="Address" <?php echo $Restaurant_list->Address->cellAttributes() ?>>
<span id="el<?php echo $Restaurant_list->RowCount ?>_Restaurant_Address">
<span<?php echo $Restaurant_list->Address->viewAttributes() ?>><?php echo $Restaurant_list->Address->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Restaurant_list->Deactivated->Visible) { // Deactivated ?>
		<td data-name="Deactivated" <?php echo $Restaurant_list->Deactivated->cellAttributes() ?>>
<span id="el<?php echo $Restaurant_list->RowCount ?>_Restaurant_Deactivated">
<span<?php echo $Restaurant_list->Deactivated->viewAttributes() ?>><?php echo $Restaurant_list->Deactivated->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Restaurant_list->Suspended->Visible) { // Suspended ?>
		<td data-name="Suspended" <?php echo $Restaurant_list->Suspended->cellAttributes() ?>>
<span id="el<?php echo $Restaurant_list->RowCount ?>_Restaurant_Suspended">
<span<?php echo $Restaurant_list->Suspended->viewAttributes() ?>><?php echo $Restaurant_list->Suspended->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Restaurant_list->_Email->Visible) { // Email ?>
		<td data-name="_Email" <?php echo $Restaurant_list->_Email->cellAttributes() ?>>
<span id="el<?php echo $Restaurant_list->RowCount ?>_Restaurant__Email">
<span<?php echo $Restaurant_list->_Email->viewAttributes() ?>><?php echo $Restaurant_list->_Email->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Restaurant_list->Password->Visible) { // Password ?>
		<td data-name="Password" <?php echo $Restaurant_list->Password->cellAttributes() ?>>
<span id="el<?php echo $Restaurant_list->RowCount ?>_Restaurant_Password">
<span<?php echo $Restaurant_list->Password->viewAttributes() ?>><?php echo $Restaurant_list->Password->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Restaurant_list->SplashImg->Visible) { // SplashImg ?>
		<td data-name="SplashImg" <?php echo $Restaurant_list->SplashImg->cellAttributes() ?>>
<span id="el<?php echo $Restaurant_list->RowCount ?>_Restaurant_SplashImg">
<span><?php echo GetFileViewTag($Restaurant_list->SplashImg, $Restaurant_list->SplashImg->getViewValue(), FALSE) ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Restaurant_list->LogoSize1->Visible) { // LogoSize1 ?>
		<td data-name="LogoSize1" <?php echo $Restaurant_list->LogoSize1->cellAttributes() ?>>
<span id="el<?php echo $Restaurant_list->RowCount ?>_Restaurant_LogoSize1">
<span><?php echo GetFileViewTag($Restaurant_list->LogoSize1, $Restaurant_list->LogoSize1->getViewValue(), FALSE) ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Restaurant_list->LogoSize2->Visible) { // LogoSize2 ?>
		<td data-name="LogoSize2" <?php echo $Restaurant_list->LogoSize2->cellAttributes() ?>>
<span id="el<?php echo $Restaurant_list->RowCount ?>_Restaurant_LogoSize2">
<span><?php echo GetFileViewTag($Restaurant_list->LogoSize2, $Restaurant_list->LogoSize2->getViewValue(), FALSE) ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Restaurant_list->AppCSS->Visible) { // AppCSS ?>
		<td data-name="AppCSS" <?php echo $Restaurant_list->AppCSS->cellAttributes() ?>>
<span id="el<?php echo $Restaurant_list->RowCount ?>_Restaurant_AppCSS">
<span<?php echo $Restaurant_list->AppCSS->viewAttributes() ?>><?php echo GetFileViewTag($Restaurant_list->AppCSS, $Restaurant_list->AppCSS->getViewValue(), FALSE) ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Restaurant_list->SplashVideo->Visible) { // SplashVideo ?>
		<td data-name="SplashVideo" <?php echo $Restaurant_list->SplashVideo->cellAttributes() ?>>
<span id="el<?php echo $Restaurant_list->RowCount ?>_Restaurant_SplashVideo">
<span<?php echo $Restaurant_list->SplashVideo->viewAttributes() ?>><?php echo GetFileViewTag($Restaurant_list->SplashVideo, $Restaurant_list->SplashVideo->getViewValue(), FALSE) ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$Restaurant_list->ListOptions->render("body", "right", $Restaurant_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$Restaurant_list->isGridAdd())
		$Restaurant_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$Restaurant->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($Restaurant_list->Recordset)
	$Restaurant_list->Recordset->Close();
?>
<?php if (!$Restaurant_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$Restaurant_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Restaurant_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Restaurant_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($Restaurant_list->TotalRecords == 0 && !$Restaurant->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $Restaurant_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$Restaurant_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$Restaurant_list->isExport()) { ?>
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
$Restaurant_list->terminate();
?>