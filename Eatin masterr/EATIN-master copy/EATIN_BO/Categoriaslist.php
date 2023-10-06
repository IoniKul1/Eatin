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
$Categorias_list = new Categorias_list();

// Run the page
$Categorias_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Categorias_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$Categorias_list->isExport()) { ?>
<script>
var fCategoriaslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fCategoriaslist = currentForm = new ew.Form("fCategoriaslist", "list");
	fCategoriaslist.formKeyCountName = '<?php echo $Categorias_list->FormKeyCountName ?>';
	loadjs.done("fCategoriaslist");
});
var fCategoriaslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fCategoriaslistsrch = currentSearchForm = new ew.Form("fCategoriaslistsrch");

	// Dynamic selection lists
	// Filters

	fCategoriaslistsrch.filterList = <?php echo $Categorias_list->getFilterList() ?>;
	loadjs.done("fCategoriaslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$Categorias_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($Categorias_list->TotalRecords > 0 && $Categorias_list->ExportOptions->visible()) { ?>
<?php $Categorias_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Categorias_list->ImportOptions->visible()) { ?>
<?php $Categorias_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($Categorias_list->SearchOptions->visible()) { ?>
<?php $Categorias_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($Categorias_list->FilterOptions->visible()) { ?>
<?php $Categorias_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$Categorias_list->isExport() || Config("EXPORT_MASTER_RECORD") && $Categorias_list->isExport("print")) { ?>
<?php
if ($Categorias_list->DbMasterFilter != "" && $Categorias->getCurrentMasterTable() == "Restaurant") {
	if ($Categorias_list->MasterRecordExists) {
		include_once "Restaurantmaster.php";
	}
}
?>
<?php } ?>
<?php
$Categorias_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$Categorias_list->isExport() && !$Categorias->CurrentAction) { ?>
<form name="fCategoriaslistsrch" id="fCategoriaslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fCategoriaslistsrch-search-panel" class="<?php echo $Categorias_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="Categorias">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $Categorias_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($Categorias_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($Categorias_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $Categorias_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($Categorias_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($Categorias_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($Categorias_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($Categorias_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $Categorias_list->showPageHeader(); ?>
<?php
$Categorias_list->showMessage();
?>
<?php if ($Categorias_list->TotalRecords > 0 || $Categorias->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Categorias_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> Categorias">
<?php if (!$Categorias_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$Categorias_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Categorias_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Categorias_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fCategoriaslist" id="fCategoriaslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Categorias">
<?php if ($Categorias->getCurrentMasterTable() == "Restaurant" && $Categorias->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="Restaurant">
<input type="hidden" name="fk_ID" value="<?php echo HtmlEncode($Categorias_list->ID_Restaurant->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_Categorias" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Categorias_list->TotalRecords > 0 || $Categorias_list->isGridEdit()) { ?>
<table id="tbl_Categoriaslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$Categorias->RowType = ROWTYPE_HEADER;

// Render list options
$Categorias_list->renderListOptions();

// Render list options (header, left)
$Categorias_list->ListOptions->render("header", "left");
?>
<?php if ($Categorias_list->ID->Visible) { // ID ?>
	<?php if ($Categorias_list->SortUrl($Categorias_list->ID) == "") { ?>
		<th data-name="ID" class="<?php echo $Categorias_list->ID->headerCellClass() ?>"><div id="elh_Categorias_ID" class="Categorias_ID"><div class="ew-table-header-caption"><?php echo $Categorias_list->ID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID" class="<?php echo $Categorias_list->ID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Categorias_list->SortUrl($Categorias_list->ID) ?>', 1);"><div id="elh_Categorias_ID" class="Categorias_ID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Categorias_list->ID->caption() ?></span><span class="ew-table-header-sort"><?php if ($Categorias_list->ID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Categorias_list->ID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Categorias_list->ID_Restaurant->Visible) { // ID_Restaurant ?>
	<?php if ($Categorias_list->SortUrl($Categorias_list->ID_Restaurant) == "") { ?>
		<th data-name="ID_Restaurant" class="<?php echo $Categorias_list->ID_Restaurant->headerCellClass() ?>"><div id="elh_Categorias_ID_Restaurant" class="Categorias_ID_Restaurant"><div class="ew-table-header-caption"><?php echo $Categorias_list->ID_Restaurant->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Restaurant" class="<?php echo $Categorias_list->ID_Restaurant->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Categorias_list->SortUrl($Categorias_list->ID_Restaurant) ?>', 1);"><div id="elh_Categorias_ID_Restaurant" class="Categorias_ID_Restaurant">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Categorias_list->ID_Restaurant->caption() ?></span><span class="ew-table-header-sort"><?php if ($Categorias_list->ID_Restaurant->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Categorias_list->ID_Restaurant->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Categorias_list->Active->Visible) { // Active ?>
	<?php if ($Categorias_list->SortUrl($Categorias_list->Active) == "") { ?>
		<th data-name="Active" class="<?php echo $Categorias_list->Active->headerCellClass() ?>"><div id="elh_Categorias_Active" class="Categorias_Active"><div class="ew-table-header-caption"><?php echo $Categorias_list->Active->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Active" class="<?php echo $Categorias_list->Active->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Categorias_list->SortUrl($Categorias_list->Active) ?>', 1);"><div id="elh_Categorias_Active" class="Categorias_Active">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Categorias_list->Active->caption() ?></span><span class="ew-table-header-sort"><?php if ($Categorias_list->Active->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Categorias_list->Active->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Categorias_list->Nombre->Visible) { // Nombre ?>
	<?php if ($Categorias_list->SortUrl($Categorias_list->Nombre) == "") { ?>
		<th data-name="Nombre" class="<?php echo $Categorias_list->Nombre->headerCellClass() ?>"><div id="elh_Categorias_Nombre" class="Categorias_Nombre"><div class="ew-table-header-caption"><?php echo $Categorias_list->Nombre->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Nombre" class="<?php echo $Categorias_list->Nombre->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Categorias_list->SortUrl($Categorias_list->Nombre) ?>', 1);"><div id="elh_Categorias_Nombre" class="Categorias_Nombre">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Categorias_list->Nombre->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($Categorias_list->Nombre->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Categorias_list->Nombre->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Categorias_list->NombreEN->Visible) { // NombreEN ?>
	<?php if ($Categorias_list->SortUrl($Categorias_list->NombreEN) == "") { ?>
		<th data-name="NombreEN" class="<?php echo $Categorias_list->NombreEN->headerCellClass() ?>"><div id="elh_Categorias_NombreEN" class="Categorias_NombreEN"><div class="ew-table-header-caption"><?php echo $Categorias_list->NombreEN->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NombreEN" class="<?php echo $Categorias_list->NombreEN->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Categorias_list->SortUrl($Categorias_list->NombreEN) ?>', 1);"><div id="elh_Categorias_NombreEN" class="Categorias_NombreEN">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Categorias_list->NombreEN->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($Categorias_list->NombreEN->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Categorias_list->NombreEN->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$Categorias_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($Categorias_list->ExportAll && $Categorias_list->isExport()) {
	$Categorias_list->StopRecord = $Categorias_list->TotalRecords;
} else {

	// Set the last record to display
	if ($Categorias_list->TotalRecords > $Categorias_list->StartRecord + $Categorias_list->DisplayRecords - 1)
		$Categorias_list->StopRecord = $Categorias_list->StartRecord + $Categorias_list->DisplayRecords - 1;
	else
		$Categorias_list->StopRecord = $Categorias_list->TotalRecords;
}
$Categorias_list->RecordCount = $Categorias_list->StartRecord - 1;
if ($Categorias_list->Recordset && !$Categorias_list->Recordset->EOF) {
	$Categorias_list->Recordset->moveFirst();
	$selectLimit = $Categorias_list->UseSelectLimit;
	if (!$selectLimit && $Categorias_list->StartRecord > 1)
		$Categorias_list->Recordset->move($Categorias_list->StartRecord - 1);
} elseif (!$Categorias->AllowAddDeleteRow && $Categorias_list->StopRecord == 0) {
	$Categorias_list->StopRecord = $Categorias->GridAddRowCount;
}

// Initialize aggregate
$Categorias->RowType = ROWTYPE_AGGREGATEINIT;
$Categorias->resetAttributes();
$Categorias_list->renderRow();
while ($Categorias_list->RecordCount < $Categorias_list->StopRecord) {
	$Categorias_list->RecordCount++;
	if ($Categorias_list->RecordCount >= $Categorias_list->StartRecord) {
		$Categorias_list->RowCount++;

		// Set up key count
		$Categorias_list->KeyCount = $Categorias_list->RowIndex;

		// Init row class and style
		$Categorias->resetAttributes();
		$Categorias->CssClass = "";
		if ($Categorias_list->isGridAdd()) {
		} else {
			$Categorias_list->loadRowValues($Categorias_list->Recordset); // Load row values
		}
		$Categorias->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$Categorias->RowAttrs->merge(["data-rowindex" => $Categorias_list->RowCount, "id" => "r" . $Categorias_list->RowCount . "_Categorias", "data-rowtype" => $Categorias->RowType]);

		// Render row
		$Categorias_list->renderRow();

		// Render list options
		$Categorias_list->renderListOptions();
?>
	<tr <?php echo $Categorias->rowAttributes() ?>>
<?php

// Render list options (body, left)
$Categorias_list->ListOptions->render("body", "left", $Categorias_list->RowCount);
?>
	<?php if ($Categorias_list->ID->Visible) { // ID ?>
		<td data-name="ID" <?php echo $Categorias_list->ID->cellAttributes() ?>>
<span id="el<?php echo $Categorias_list->RowCount ?>_Categorias_ID">
<span<?php echo $Categorias_list->ID->viewAttributes() ?>><?php echo $Categorias_list->ID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Categorias_list->ID_Restaurant->Visible) { // ID_Restaurant ?>
		<td data-name="ID_Restaurant" <?php echo $Categorias_list->ID_Restaurant->cellAttributes() ?>>
<span id="el<?php echo $Categorias_list->RowCount ?>_Categorias_ID_Restaurant">
<span<?php echo $Categorias_list->ID_Restaurant->viewAttributes() ?>><?php echo $Categorias_list->ID_Restaurant->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Categorias_list->Active->Visible) { // Active ?>
		<td data-name="Active" <?php echo $Categorias_list->Active->cellAttributes() ?>>
<span id="el<?php echo $Categorias_list->RowCount ?>_Categorias_Active">
<span<?php echo $Categorias_list->Active->viewAttributes() ?>><?php echo $Categorias_list->Active->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Categorias_list->Nombre->Visible) { // Nombre ?>
		<td data-name="Nombre" <?php echo $Categorias_list->Nombre->cellAttributes() ?>>
<span id="el<?php echo $Categorias_list->RowCount ?>_Categorias_Nombre">
<span<?php echo $Categorias_list->Nombre->viewAttributes() ?>><?php echo $Categorias_list->Nombre->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Categorias_list->NombreEN->Visible) { // NombreEN ?>
		<td data-name="NombreEN" <?php echo $Categorias_list->NombreEN->cellAttributes() ?>>
<span id="el<?php echo $Categorias_list->RowCount ?>_Categorias_NombreEN">
<span<?php echo $Categorias_list->NombreEN->viewAttributes() ?>><?php echo $Categorias_list->NombreEN->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$Categorias_list->ListOptions->render("body", "right", $Categorias_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$Categorias_list->isGridAdd())
		$Categorias_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$Categorias->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($Categorias_list->Recordset)
	$Categorias_list->Recordset->Close();
?>
<?php if (!$Categorias_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$Categorias_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Categorias_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Categorias_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($Categorias_list->TotalRecords == 0 && !$Categorias->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $Categorias_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$Categorias_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$Categorias_list->isExport()) { ?>
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
$Categorias_list->terminate();
?>