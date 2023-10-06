<?php
namespace PHPMaker2020\BACKOFFICE_CADETERIAS;

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
$Cadeteria_list = new Cadeteria_list();

// Run the page
$Cadeteria_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Cadeteria_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$Cadeteria_list->isExport()) { ?>
<script>
var fCadeterialist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fCadeterialist = currentForm = new ew.Form("fCadeterialist", "list");
	fCadeterialist.formKeyCountName = '<?php echo $Cadeteria_list->FormKeyCountName ?>';
	loadjs.done("fCadeterialist");
});
var fCadeterialistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fCadeterialistsrch = currentSearchForm = new ew.Form("fCadeterialistsrch");

	// Dynamic selection lists
	// Filters

	fCadeterialistsrch.filterList = <?php echo $Cadeteria_list->getFilterList() ?>;
	loadjs.done("fCadeterialistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$Cadeteria_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($Cadeteria_list->TotalRecords > 0 && $Cadeteria_list->ExportOptions->visible()) { ?>
<?php $Cadeteria_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Cadeteria_list->ImportOptions->visible()) { ?>
<?php $Cadeteria_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($Cadeteria_list->SearchOptions->visible()) { ?>
<?php $Cadeteria_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($Cadeteria_list->FilterOptions->visible()) { ?>
<?php $Cadeteria_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$Cadeteria_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$Cadeteria_list->isExport() && !$Cadeteria->CurrentAction) { ?>
<form name="fCadeterialistsrch" id="fCadeterialistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fCadeterialistsrch-search-panel" class="<?php echo $Cadeteria_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="Cadeteria">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $Cadeteria_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($Cadeteria_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($Cadeteria_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $Cadeteria_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($Cadeteria_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($Cadeteria_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($Cadeteria_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($Cadeteria_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $Cadeteria_list->showPageHeader(); ?>
<?php
$Cadeteria_list->showMessage();
?>
<?php if ($Cadeteria_list->TotalRecords > 0 || $Cadeteria->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Cadeteria_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> Cadeteria">
<form name="fCadeterialist" id="fCadeterialist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Cadeteria">
<div id="gmp_Cadeteria" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Cadeteria_list->TotalRecords > 0 || $Cadeteria_list->isGridEdit()) { ?>
<table id="tbl_Cadeterialist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$Cadeteria->RowType = ROWTYPE_HEADER;

// Render list options
$Cadeteria_list->renderListOptions();

// Render list options (header, left)
$Cadeteria_list->ListOptions->render("header", "left");
?>
<?php if ($Cadeteria_list->ID->Visible) { // ID ?>
	<?php if ($Cadeteria_list->SortUrl($Cadeteria_list->ID) == "") { ?>
		<th data-name="ID" class="<?php echo $Cadeteria_list->ID->headerCellClass() ?>"><div id="elh_Cadeteria_ID" class="Cadeteria_ID"><div class="ew-table-header-caption"><?php echo $Cadeteria_list->ID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID" class="<?php echo $Cadeteria_list->ID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Cadeteria_list->SortUrl($Cadeteria_list->ID) ?>', 1);"><div id="elh_Cadeteria_ID" class="Cadeteria_ID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Cadeteria_list->ID->caption() ?></span><span class="ew-table-header-sort"><?php if ($Cadeteria_list->ID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Cadeteria_list->ID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Cadeteria_list->ID_Status->Visible) { // ID_Status ?>
	<?php if ($Cadeteria_list->SortUrl($Cadeteria_list->ID_Status) == "") { ?>
		<th data-name="ID_Status" class="<?php echo $Cadeteria_list->ID_Status->headerCellClass() ?>"><div id="elh_Cadeteria_ID_Status" class="Cadeteria_ID_Status"><div class="ew-table-header-caption"><?php echo $Cadeteria_list->ID_Status->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Status" class="<?php echo $Cadeteria_list->ID_Status->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Cadeteria_list->SortUrl($Cadeteria_list->ID_Status) ?>', 1);"><div id="elh_Cadeteria_ID_Status" class="Cadeteria_ID_Status">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Cadeteria_list->ID_Status->caption() ?></span><span class="ew-table-header-sort"><?php if ($Cadeteria_list->ID_Status->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Cadeteria_list->ID_Status->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Cadeteria_list->Nombre->Visible) { // Nombre ?>
	<?php if ($Cadeteria_list->SortUrl($Cadeteria_list->Nombre) == "") { ?>
		<th data-name="Nombre" class="<?php echo $Cadeteria_list->Nombre->headerCellClass() ?>"><div id="elh_Cadeteria_Nombre" class="Cadeteria_Nombre"><div class="ew-table-header-caption"><?php echo $Cadeteria_list->Nombre->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Nombre" class="<?php echo $Cadeteria_list->Nombre->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Cadeteria_list->SortUrl($Cadeteria_list->Nombre) ?>', 1);"><div id="elh_Cadeteria_Nombre" class="Cadeteria_Nombre">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Cadeteria_list->Nombre->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($Cadeteria_list->Nombre->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Cadeteria_list->Nombre->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Cadeteria_list->Lat->Visible) { // Lat ?>
	<?php if ($Cadeteria_list->SortUrl($Cadeteria_list->Lat) == "") { ?>
		<th data-name="Lat" class="<?php echo $Cadeteria_list->Lat->headerCellClass() ?>"><div id="elh_Cadeteria_Lat" class="Cadeteria_Lat"><div class="ew-table-header-caption"><?php echo $Cadeteria_list->Lat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Lat" class="<?php echo $Cadeteria_list->Lat->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Cadeteria_list->SortUrl($Cadeteria_list->Lat) ?>', 1);"><div id="elh_Cadeteria_Lat" class="Cadeteria_Lat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Cadeteria_list->Lat->caption() ?></span><span class="ew-table-header-sort"><?php if ($Cadeteria_list->Lat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Cadeteria_list->Lat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Cadeteria_list->Lon->Visible) { // Lon ?>
	<?php if ($Cadeteria_list->SortUrl($Cadeteria_list->Lon) == "") { ?>
		<th data-name="Lon" class="<?php echo $Cadeteria_list->Lon->headerCellClass() ?>"><div id="elh_Cadeteria_Lon" class="Cadeteria_Lon"><div class="ew-table-header-caption"><?php echo $Cadeteria_list->Lon->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Lon" class="<?php echo $Cadeteria_list->Lon->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Cadeteria_list->SortUrl($Cadeteria_list->Lon) ?>', 1);"><div id="elh_Cadeteria_Lon" class="Cadeteria_Lon">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Cadeteria_list->Lon->caption() ?></span><span class="ew-table-header-sort"><?php if ($Cadeteria_list->Lon->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Cadeteria_list->Lon->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Cadeteria_list->_Email->Visible) { // Email ?>
	<?php if ($Cadeteria_list->SortUrl($Cadeteria_list->_Email) == "") { ?>
		<th data-name="_Email" class="<?php echo $Cadeteria_list->_Email->headerCellClass() ?>"><div id="elh_Cadeteria__Email" class="Cadeteria__Email"><div class="ew-table-header-caption"><?php echo $Cadeteria_list->_Email->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_Email" class="<?php echo $Cadeteria_list->_Email->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Cadeteria_list->SortUrl($Cadeteria_list->_Email) ?>', 1);"><div id="elh_Cadeteria__Email" class="Cadeteria__Email">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Cadeteria_list->_Email->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($Cadeteria_list->_Email->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Cadeteria_list->_Email->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Cadeteria_list->Hashpass->Visible) { // Hashpass ?>
	<?php if ($Cadeteria_list->SortUrl($Cadeteria_list->Hashpass) == "") { ?>
		<th data-name="Hashpass" class="<?php echo $Cadeteria_list->Hashpass->headerCellClass() ?>"><div id="elh_Cadeteria_Hashpass" class="Cadeteria_Hashpass"><div class="ew-table-header-caption"><?php echo $Cadeteria_list->Hashpass->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Hashpass" class="<?php echo $Cadeteria_list->Hashpass->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Cadeteria_list->SortUrl($Cadeteria_list->Hashpass) ?>', 1);"><div id="elh_Cadeteria_Hashpass" class="Cadeteria_Hashpass">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Cadeteria_list->Hashpass->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($Cadeteria_list->Hashpass->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Cadeteria_list->Hashpass->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Cadeteria_list->fMult1->Visible) { // fMult1 ?>
	<?php if ($Cadeteria_list->SortUrl($Cadeteria_list->fMult1) == "") { ?>
		<th data-name="fMult1" class="<?php echo $Cadeteria_list->fMult1->headerCellClass() ?>"><div id="elh_Cadeteria_fMult1" class="Cadeteria_fMult1"><div class="ew-table-header-caption"><?php echo $Cadeteria_list->fMult1->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fMult1" class="<?php echo $Cadeteria_list->fMult1->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Cadeteria_list->SortUrl($Cadeteria_list->fMult1) ?>', 1);"><div id="elh_Cadeteria_fMult1" class="Cadeteria_fMult1">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Cadeteria_list->fMult1->caption() ?></span><span class="ew-table-header-sort"><?php if ($Cadeteria_list->fMult1->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Cadeteria_list->fMult1->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Cadeteria_list->fMult2->Visible) { // fMult2 ?>
	<?php if ($Cadeteria_list->SortUrl($Cadeteria_list->fMult2) == "") { ?>
		<th data-name="fMult2" class="<?php echo $Cadeteria_list->fMult2->headerCellClass() ?>"><div id="elh_Cadeteria_fMult2" class="Cadeteria_fMult2"><div class="ew-table-header-caption"><?php echo $Cadeteria_list->fMult2->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fMult2" class="<?php echo $Cadeteria_list->fMult2->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Cadeteria_list->SortUrl($Cadeteria_list->fMult2) ?>', 1);"><div id="elh_Cadeteria_fMult2" class="Cadeteria_fMult2">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Cadeteria_list->fMult2->caption() ?></span><span class="ew-table-header-sort"><?php if ($Cadeteria_list->fMult2->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Cadeteria_list->fMult2->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$Cadeteria_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($Cadeteria_list->ExportAll && $Cadeteria_list->isExport()) {
	$Cadeteria_list->StopRecord = $Cadeteria_list->TotalRecords;
} else {

	// Set the last record to display
	if ($Cadeteria_list->TotalRecords > $Cadeteria_list->StartRecord + $Cadeteria_list->DisplayRecords - 1)
		$Cadeteria_list->StopRecord = $Cadeteria_list->StartRecord + $Cadeteria_list->DisplayRecords - 1;
	else
		$Cadeteria_list->StopRecord = $Cadeteria_list->TotalRecords;
}
$Cadeteria_list->RecordCount = $Cadeteria_list->StartRecord - 1;
if ($Cadeteria_list->Recordset && !$Cadeteria_list->Recordset->EOF) {
	$Cadeteria_list->Recordset->moveFirst();
	$selectLimit = $Cadeteria_list->UseSelectLimit;
	if (!$selectLimit && $Cadeteria_list->StartRecord > 1)
		$Cadeteria_list->Recordset->move($Cadeteria_list->StartRecord - 1);
} elseif (!$Cadeteria->AllowAddDeleteRow && $Cadeteria_list->StopRecord == 0) {
	$Cadeteria_list->StopRecord = $Cadeteria->GridAddRowCount;
}

// Initialize aggregate
$Cadeteria->RowType = ROWTYPE_AGGREGATEINIT;
$Cadeteria->resetAttributes();
$Cadeteria_list->renderRow();
while ($Cadeteria_list->RecordCount < $Cadeteria_list->StopRecord) {
	$Cadeteria_list->RecordCount++;
	if ($Cadeteria_list->RecordCount >= $Cadeteria_list->StartRecord) {
		$Cadeteria_list->RowCount++;

		// Set up key count
		$Cadeteria_list->KeyCount = $Cadeteria_list->RowIndex;

		// Init row class and style
		$Cadeteria->resetAttributes();
		$Cadeteria->CssClass = "";
		if ($Cadeteria_list->isGridAdd()) {
		} else {
			$Cadeteria_list->loadRowValues($Cadeteria_list->Recordset); // Load row values
		}
		$Cadeteria->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$Cadeteria->RowAttrs->merge(["data-rowindex" => $Cadeteria_list->RowCount, "id" => "r" . $Cadeteria_list->RowCount . "_Cadeteria", "data-rowtype" => $Cadeteria->RowType]);

		// Render row
		$Cadeteria_list->renderRow();

		// Render list options
		$Cadeteria_list->renderListOptions();
?>
	<tr <?php echo $Cadeteria->rowAttributes() ?>>
<?php

// Render list options (body, left)
$Cadeteria_list->ListOptions->render("body", "left", $Cadeteria_list->RowCount);
?>
	<?php if ($Cadeteria_list->ID->Visible) { // ID ?>
		<td data-name="ID" <?php echo $Cadeteria_list->ID->cellAttributes() ?>>
<span id="el<?php echo $Cadeteria_list->RowCount ?>_Cadeteria_ID">
<span<?php echo $Cadeteria_list->ID->viewAttributes() ?>><?php echo $Cadeteria_list->ID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Cadeteria_list->ID_Status->Visible) { // ID_Status ?>
		<td data-name="ID_Status" <?php echo $Cadeteria_list->ID_Status->cellAttributes() ?>>
<span id="el<?php echo $Cadeteria_list->RowCount ?>_Cadeteria_ID_Status">
<span<?php echo $Cadeteria_list->ID_Status->viewAttributes() ?>><?php echo $Cadeteria_list->ID_Status->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Cadeteria_list->Nombre->Visible) { // Nombre ?>
		<td data-name="Nombre" <?php echo $Cadeteria_list->Nombre->cellAttributes() ?>>
<span id="el<?php echo $Cadeteria_list->RowCount ?>_Cadeteria_Nombre">
<span<?php echo $Cadeteria_list->Nombre->viewAttributes() ?>><?php echo $Cadeteria_list->Nombre->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Cadeteria_list->Lat->Visible) { // Lat ?>
		<td data-name="Lat" <?php echo $Cadeteria_list->Lat->cellAttributes() ?>>
<span id="el<?php echo $Cadeteria_list->RowCount ?>_Cadeteria_Lat">
<span<?php echo $Cadeteria_list->Lat->viewAttributes() ?>><?php echo $Cadeteria_list->Lat->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Cadeteria_list->Lon->Visible) { // Lon ?>
		<td data-name="Lon" <?php echo $Cadeteria_list->Lon->cellAttributes() ?>>
<span id="el<?php echo $Cadeteria_list->RowCount ?>_Cadeteria_Lon">
<span<?php echo $Cadeteria_list->Lon->viewAttributes() ?>><?php echo $Cadeteria_list->Lon->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Cadeteria_list->_Email->Visible) { // Email ?>
		<td data-name="_Email" <?php echo $Cadeteria_list->_Email->cellAttributes() ?>>
<span id="el<?php echo $Cadeteria_list->RowCount ?>_Cadeteria__Email">
<span<?php echo $Cadeteria_list->_Email->viewAttributes() ?>><?php echo $Cadeteria_list->_Email->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Cadeteria_list->Hashpass->Visible) { // Hashpass ?>
		<td data-name="Hashpass" <?php echo $Cadeteria_list->Hashpass->cellAttributes() ?>>
<span id="el<?php echo $Cadeteria_list->RowCount ?>_Cadeteria_Hashpass">
<span<?php echo $Cadeteria_list->Hashpass->viewAttributes() ?>><?php echo $Cadeteria_list->Hashpass->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Cadeteria_list->fMult1->Visible) { // fMult1 ?>
		<td data-name="fMult1" <?php echo $Cadeteria_list->fMult1->cellAttributes() ?>>
<span id="el<?php echo $Cadeteria_list->RowCount ?>_Cadeteria_fMult1">
<span<?php echo $Cadeteria_list->fMult1->viewAttributes() ?>><?php echo $Cadeteria_list->fMult1->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Cadeteria_list->fMult2->Visible) { // fMult2 ?>
		<td data-name="fMult2" <?php echo $Cadeteria_list->fMult2->cellAttributes() ?>>
<span id="el<?php echo $Cadeteria_list->RowCount ?>_Cadeteria_fMult2">
<span<?php echo $Cadeteria_list->fMult2->viewAttributes() ?>><?php echo $Cadeteria_list->fMult2->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$Cadeteria_list->ListOptions->render("body", "right", $Cadeteria_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$Cadeteria_list->isGridAdd())
		$Cadeteria_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$Cadeteria->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($Cadeteria_list->Recordset)
	$Cadeteria_list->Recordset->Close();
?>
<?php if (!$Cadeteria_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$Cadeteria_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Cadeteria_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Cadeteria_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($Cadeteria_list->TotalRecords == 0 && !$Cadeteria->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $Cadeteria_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$Cadeteria_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$Cadeteria_list->isExport()) { ?>
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
$Cadeteria_list->terminate();
?>