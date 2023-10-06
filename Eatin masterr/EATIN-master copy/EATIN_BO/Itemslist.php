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
$Items_list = new Items_list();

// Run the page
$Items_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Items_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$Items_list->isExport()) { ?>
<script>
var fItemslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fItemslist = currentForm = new ew.Form("fItemslist", "list");
	fItemslist.formKeyCountName = '<?php echo $Items_list->FormKeyCountName ?>';
	loadjs.done("fItemslist");
});
var fItemslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fItemslistsrch = currentSearchForm = new ew.Form("fItemslistsrch");

	// Dynamic selection lists
	// Filters

	fItemslistsrch.filterList = <?php echo $Items_list->getFilterList() ?>;
	loadjs.done("fItemslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$Items_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($Items_list->TotalRecords > 0 && $Items_list->ExportOptions->visible()) { ?>
<?php $Items_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Items_list->ImportOptions->visible()) { ?>
<?php $Items_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($Items_list->SearchOptions->visible()) { ?>
<?php $Items_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($Items_list->FilterOptions->visible()) { ?>
<?php $Items_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$Items_list->isExport() || Config("EXPORT_MASTER_RECORD") && $Items_list->isExport("print")) { ?>
<?php
if ($Items_list->DbMasterFilter != "" && $Items->getCurrentMasterTable() == "Categorias") {
	if ($Items_list->MasterRecordExists) {
		include_once "Categoriasmaster.php";
	}
}
?>
<?php } ?>
<?php
$Items_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$Items_list->isExport() && !$Items->CurrentAction) { ?>
<form name="fItemslistsrch" id="fItemslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fItemslistsrch-search-panel" class="<?php echo $Items_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="Items">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $Items_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($Items_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($Items_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $Items_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($Items_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($Items_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($Items_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($Items_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $Items_list->showPageHeader(); ?>
<?php
$Items_list->showMessage();
?>
<?php if ($Items_list->TotalRecords > 0 || $Items->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Items_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> Items">
<?php if (!$Items_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$Items_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Items_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Items_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fItemslist" id="fItemslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Items">
<?php if ($Items->getCurrentMasterTable() == "Categorias" && $Items->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="Categorias">
<input type="hidden" name="fk_ID" value="<?php echo HtmlEncode($Items_list->ID_Categorias->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_Items" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Items_list->TotalRecords > 0 || $Items_list->isGridEdit()) { ?>
<table id="tbl_Itemslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$Items->RowType = ROWTYPE_HEADER;

// Render list options
$Items_list->renderListOptions();

// Render list options (header, left)
$Items_list->ListOptions->render("header", "left");
?>
<?php if ($Items_list->ID->Visible) { // ID ?>
	<?php if ($Items_list->SortUrl($Items_list->ID) == "") { ?>
		<th data-name="ID" class="<?php echo $Items_list->ID->headerCellClass() ?>"><div id="elh_Items_ID" class="Items_ID"><div class="ew-table-header-caption"><?php echo $Items_list->ID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID" class="<?php echo $Items_list->ID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Items_list->SortUrl($Items_list->ID) ?>', 1);"><div id="elh_Items_ID" class="Items_ID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Items_list->ID->caption() ?></span><span class="ew-table-header-sort"><?php if ($Items_list->ID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Items_list->ID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Items_list->ID_Categorias->Visible) { // ID_Categorias ?>
	<?php if ($Items_list->SortUrl($Items_list->ID_Categorias) == "") { ?>
		<th data-name="ID_Categorias" class="<?php echo $Items_list->ID_Categorias->headerCellClass() ?>"><div id="elh_Items_ID_Categorias" class="Items_ID_Categorias"><div class="ew-table-header-caption"><?php echo $Items_list->ID_Categorias->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Categorias" class="<?php echo $Items_list->ID_Categorias->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Items_list->SortUrl($Items_list->ID_Categorias) ?>', 1);"><div id="elh_Items_ID_Categorias" class="Items_ID_Categorias">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Items_list->ID_Categorias->caption() ?></span><span class="ew-table-header-sort"><?php if ($Items_list->ID_Categorias->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Items_list->ID_Categorias->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Items_list->ID_Restaurant->Visible) { // ID_Restaurant ?>
	<?php if ($Items_list->SortUrl($Items_list->ID_Restaurant) == "") { ?>
		<th data-name="ID_Restaurant" class="<?php echo $Items_list->ID_Restaurant->headerCellClass() ?>"><div id="elh_Items_ID_Restaurant" class="Items_ID_Restaurant"><div class="ew-table-header-caption"><?php echo $Items_list->ID_Restaurant->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Restaurant" class="<?php echo $Items_list->ID_Restaurant->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Items_list->SortUrl($Items_list->ID_Restaurant) ?>', 1);"><div id="elh_Items_ID_Restaurant" class="Items_ID_Restaurant">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Items_list->ID_Restaurant->caption() ?></span><span class="ew-table-header-sort"><?php if ($Items_list->ID_Restaurant->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Items_list->ID_Restaurant->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Items_list->Nombre->Visible) { // Nombre ?>
	<?php if ($Items_list->SortUrl($Items_list->Nombre) == "") { ?>
		<th data-name="Nombre" class="<?php echo $Items_list->Nombre->headerCellClass() ?>"><div id="elh_Items_Nombre" class="Items_Nombre"><div class="ew-table-header-caption"><?php echo $Items_list->Nombre->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Nombre" class="<?php echo $Items_list->Nombre->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Items_list->SortUrl($Items_list->Nombre) ?>', 1);"><div id="elh_Items_Nombre" class="Items_Nombre">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Items_list->Nombre->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($Items_list->Nombre->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Items_list->Nombre->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Items_list->Precio->Visible) { // Precio ?>
	<?php if ($Items_list->SortUrl($Items_list->Precio) == "") { ?>
		<th data-name="Precio" class="<?php echo $Items_list->Precio->headerCellClass() ?>"><div id="elh_Items_Precio" class="Items_Precio"><div class="ew-table-header-caption"><?php echo $Items_list->Precio->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Precio" class="<?php echo $Items_list->Precio->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Items_list->SortUrl($Items_list->Precio) ?>', 1);"><div id="elh_Items_Precio" class="Items_Precio">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Items_list->Precio->caption() ?></span><span class="ew-table-header-sort"><?php if ($Items_list->Precio->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Items_list->Precio->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Items_list->Active->Visible) { // Active ?>
	<?php if ($Items_list->SortUrl($Items_list->Active) == "") { ?>
		<th data-name="Active" class="<?php echo $Items_list->Active->headerCellClass() ?>"><div id="elh_Items_Active" class="Items_Active"><div class="ew-table-header-caption"><?php echo $Items_list->Active->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Active" class="<?php echo $Items_list->Active->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Items_list->SortUrl($Items_list->Active) ?>', 1);"><div id="elh_Items_Active" class="Items_Active">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Items_list->Active->caption() ?></span><span class="ew-table-header-sort"><?php if ($Items_list->Active->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Items_list->Active->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Items_list->Stock->Visible) { // Stock ?>
	<?php if ($Items_list->SortUrl($Items_list->Stock) == "") { ?>
		<th data-name="Stock" class="<?php echo $Items_list->Stock->headerCellClass() ?>"><div id="elh_Items_Stock" class="Items_Stock"><div class="ew-table-header-caption"><?php echo $Items_list->Stock->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Stock" class="<?php echo $Items_list->Stock->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Items_list->SortUrl($Items_list->Stock) ?>', 1);"><div id="elh_Items_Stock" class="Items_Stock">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Items_list->Stock->caption() ?></span><span class="ew-table-header-sort"><?php if ($Items_list->Stock->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Items_list->Stock->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Items_list->Img1->Visible) { // Img1 ?>
	<?php if ($Items_list->SortUrl($Items_list->Img1) == "") { ?>
		<th data-name="Img1" class="<?php echo $Items_list->Img1->headerCellClass() ?>"><div id="elh_Items_Img1" class="Items_Img1"><div class="ew-table-header-caption"><?php echo $Items_list->Img1->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Img1" class="<?php echo $Items_list->Img1->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Items_list->SortUrl($Items_list->Img1) ?>', 1);"><div id="elh_Items_Img1" class="Items_Img1">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Items_list->Img1->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($Items_list->Img1->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Items_list->Img1->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$Items_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($Items_list->ExportAll && $Items_list->isExport()) {
	$Items_list->StopRecord = $Items_list->TotalRecords;
} else {

	// Set the last record to display
	if ($Items_list->TotalRecords > $Items_list->StartRecord + $Items_list->DisplayRecords - 1)
		$Items_list->StopRecord = $Items_list->StartRecord + $Items_list->DisplayRecords - 1;
	else
		$Items_list->StopRecord = $Items_list->TotalRecords;
}
$Items_list->RecordCount = $Items_list->StartRecord - 1;
if ($Items_list->Recordset && !$Items_list->Recordset->EOF) {
	$Items_list->Recordset->moveFirst();
	$selectLimit = $Items_list->UseSelectLimit;
	if (!$selectLimit && $Items_list->StartRecord > 1)
		$Items_list->Recordset->move($Items_list->StartRecord - 1);
} elseif (!$Items->AllowAddDeleteRow && $Items_list->StopRecord == 0) {
	$Items_list->StopRecord = $Items->GridAddRowCount;
}

// Initialize aggregate
$Items->RowType = ROWTYPE_AGGREGATEINIT;
$Items->resetAttributes();
$Items_list->renderRow();
while ($Items_list->RecordCount < $Items_list->StopRecord) {
	$Items_list->RecordCount++;
	if ($Items_list->RecordCount >= $Items_list->StartRecord) {
		$Items_list->RowCount++;

		// Set up key count
		$Items_list->KeyCount = $Items_list->RowIndex;

		// Init row class and style
		$Items->resetAttributes();
		$Items->CssClass = "";
		if ($Items_list->isGridAdd()) {
		} else {
			$Items_list->loadRowValues($Items_list->Recordset); // Load row values
		}
		$Items->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$Items->RowAttrs->merge(["data-rowindex" => $Items_list->RowCount, "id" => "r" . $Items_list->RowCount . "_Items", "data-rowtype" => $Items->RowType]);

		// Render row
		$Items_list->renderRow();

		// Render list options
		$Items_list->renderListOptions();
?>
	<tr <?php echo $Items->rowAttributes() ?>>
<?php

// Render list options (body, left)
$Items_list->ListOptions->render("body", "left", $Items_list->RowCount);
?>
	<?php if ($Items_list->ID->Visible) { // ID ?>
		<td data-name="ID" <?php echo $Items_list->ID->cellAttributes() ?>>
<span id="el<?php echo $Items_list->RowCount ?>_Items_ID">
<span<?php echo $Items_list->ID->viewAttributes() ?>><?php echo $Items_list->ID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Items_list->ID_Categorias->Visible) { // ID_Categorias ?>
		<td data-name="ID_Categorias" <?php echo $Items_list->ID_Categorias->cellAttributes() ?>>
<span id="el<?php echo $Items_list->RowCount ?>_Items_ID_Categorias">
<span<?php echo $Items_list->ID_Categorias->viewAttributes() ?>><?php echo $Items_list->ID_Categorias->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Items_list->ID_Restaurant->Visible) { // ID_Restaurant ?>
		<td data-name="ID_Restaurant" <?php echo $Items_list->ID_Restaurant->cellAttributes() ?>>
<span id="el<?php echo $Items_list->RowCount ?>_Items_ID_Restaurant">
<span<?php echo $Items_list->ID_Restaurant->viewAttributes() ?>><?php echo $Items_list->ID_Restaurant->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Items_list->Nombre->Visible) { // Nombre ?>
		<td data-name="Nombre" <?php echo $Items_list->Nombre->cellAttributes() ?>>
<span id="el<?php echo $Items_list->RowCount ?>_Items_Nombre">
<span<?php echo $Items_list->Nombre->viewAttributes() ?>><?php echo $Items_list->Nombre->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Items_list->Precio->Visible) { // Precio ?>
		<td data-name="Precio" <?php echo $Items_list->Precio->cellAttributes() ?>>
<span id="el<?php echo $Items_list->RowCount ?>_Items_Precio">
<span<?php echo $Items_list->Precio->viewAttributes() ?>><?php echo $Items_list->Precio->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Items_list->Active->Visible) { // Active ?>
		<td data-name="Active" <?php echo $Items_list->Active->cellAttributes() ?>>
<span id="el<?php echo $Items_list->RowCount ?>_Items_Active">
<span<?php echo $Items_list->Active->viewAttributes() ?>><?php echo $Items_list->Active->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Items_list->Stock->Visible) { // Stock ?>
		<td data-name="Stock" <?php echo $Items_list->Stock->cellAttributes() ?>>
<span id="el<?php echo $Items_list->RowCount ?>_Items_Stock">
<span<?php echo $Items_list->Stock->viewAttributes() ?>><?php echo $Items_list->Stock->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Items_list->Img1->Visible) { // Img1 ?>
		<td data-name="Img1" <?php echo $Items_list->Img1->cellAttributes() ?>>
<span id="el<?php echo $Items_list->RowCount ?>_Items_Img1">
<span><?php echo GetFileViewTag($Items_list->Img1, $Items_list->Img1->getViewValue(), FALSE) ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$Items_list->ListOptions->render("body", "right", $Items_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$Items_list->isGridAdd())
		$Items_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$Items->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($Items_list->Recordset)
	$Items_list->Recordset->Close();
?>
<?php if (!$Items_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$Items_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Items_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Items_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($Items_list->TotalRecords == 0 && !$Items->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $Items_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$Items_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$Items_list->isExport()) { ?>
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
$Items_list->terminate();
?>