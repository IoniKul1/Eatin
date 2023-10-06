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
$ItemxPedido_list = new ItemxPedido_list();

// Run the page
$ItemxPedido_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ItemxPedido_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$ItemxPedido_list->isExport()) { ?>
<script>
var fItemxPedidolist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fItemxPedidolist = currentForm = new ew.Form("fItemxPedidolist", "list");
	fItemxPedidolist.formKeyCountName = '<?php echo $ItemxPedido_list->FormKeyCountName ?>';
	loadjs.done("fItemxPedidolist");
});
var fItemxPedidolistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fItemxPedidolistsrch = currentSearchForm = new ew.Form("fItemxPedidolistsrch");

	// Dynamic selection lists
	// Filters

	fItemxPedidolistsrch.filterList = <?php echo $ItemxPedido_list->getFilterList() ?>;
	loadjs.done("fItemxPedidolistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$ItemxPedido_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($ItemxPedido_list->TotalRecords > 0 && $ItemxPedido_list->ExportOptions->visible()) { ?>
<?php $ItemxPedido_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($ItemxPedido_list->ImportOptions->visible()) { ?>
<?php $ItemxPedido_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($ItemxPedido_list->SearchOptions->visible()) { ?>
<?php $ItemxPedido_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($ItemxPedido_list->FilterOptions->visible()) { ?>
<?php $ItemxPedido_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$ItemxPedido_list->isExport() || Config("EXPORT_MASTER_RECORD") && $ItemxPedido_list->isExport("print")) { ?>
<?php
if ($ItemxPedido_list->DbMasterFilter != "" && $ItemxPedido->getCurrentMasterTable() == "Pedido") {
	if ($ItemxPedido_list->MasterRecordExists) {
		include_once "Pedidomaster.php";
	}
}
?>
<?php } ?>
<?php
$ItemxPedido_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$ItemxPedido_list->isExport() && !$ItemxPedido->CurrentAction) { ?>
<form name="fItemxPedidolistsrch" id="fItemxPedidolistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fItemxPedidolistsrch-search-panel" class="<?php echo $ItemxPedido_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="ItemxPedido">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $ItemxPedido_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($ItemxPedido_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($ItemxPedido_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $ItemxPedido_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($ItemxPedido_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($ItemxPedido_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($ItemxPedido_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($ItemxPedido_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $ItemxPedido_list->showPageHeader(); ?>
<?php
$ItemxPedido_list->showMessage();
?>
<?php if ($ItemxPedido_list->TotalRecords > 0 || $ItemxPedido->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($ItemxPedido_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> ItemxPedido">
<?php if (!$ItemxPedido_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$ItemxPedido_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ItemxPedido_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ItemxPedido_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fItemxPedidolist" id="fItemxPedidolist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ItemxPedido">
<?php if ($ItemxPedido->getCurrentMasterTable() == "Pedido" && $ItemxPedido->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="Pedido">
<input type="hidden" name="fk_ID" value="<?php echo HtmlEncode($ItemxPedido_list->ID_Pedido->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_ItemxPedido" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($ItemxPedido_list->TotalRecords > 0 || $ItemxPedido_list->isGridEdit()) { ?>
<table id="tbl_ItemxPedidolist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$ItemxPedido->RowType = ROWTYPE_HEADER;

// Render list options
$ItemxPedido_list->renderListOptions();

// Render list options (header, left)
$ItemxPedido_list->ListOptions->render("header", "left");
?>
<?php if ($ItemxPedido_list->ID->Visible) { // ID ?>
	<?php if ($ItemxPedido_list->SortUrl($ItemxPedido_list->ID) == "") { ?>
		<th data-name="ID" class="<?php echo $ItemxPedido_list->ID->headerCellClass() ?>"><div id="elh_ItemxPedido_ID" class="ItemxPedido_ID"><div class="ew-table-header-caption"><?php echo $ItemxPedido_list->ID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID" class="<?php echo $ItemxPedido_list->ID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ItemxPedido_list->SortUrl($ItemxPedido_list->ID) ?>', 1);"><div id="elh_ItemxPedido_ID" class="ItemxPedido_ID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ItemxPedido_list->ID->caption() ?></span><span class="ew-table-header-sort"><?php if ($ItemxPedido_list->ID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ItemxPedido_list->ID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ItemxPedido_list->ID_Item->Visible) { // ID_Item ?>
	<?php if ($ItemxPedido_list->SortUrl($ItemxPedido_list->ID_Item) == "") { ?>
		<th data-name="ID_Item" class="<?php echo $ItemxPedido_list->ID_Item->headerCellClass() ?>"><div id="elh_ItemxPedido_ID_Item" class="ItemxPedido_ID_Item"><div class="ew-table-header-caption"><?php echo $ItemxPedido_list->ID_Item->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Item" class="<?php echo $ItemxPedido_list->ID_Item->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ItemxPedido_list->SortUrl($ItemxPedido_list->ID_Item) ?>', 1);"><div id="elh_ItemxPedido_ID_Item" class="ItemxPedido_ID_Item">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ItemxPedido_list->ID_Item->caption() ?></span><span class="ew-table-header-sort"><?php if ($ItemxPedido_list->ID_Item->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ItemxPedido_list->ID_Item->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ItemxPedido_list->ID_Restaurant->Visible) { // ID_Restaurant ?>
	<?php if ($ItemxPedido_list->SortUrl($ItemxPedido_list->ID_Restaurant) == "") { ?>
		<th data-name="ID_Restaurant" class="<?php echo $ItemxPedido_list->ID_Restaurant->headerCellClass() ?>"><div id="elh_ItemxPedido_ID_Restaurant" class="ItemxPedido_ID_Restaurant"><div class="ew-table-header-caption"><?php echo $ItemxPedido_list->ID_Restaurant->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Restaurant" class="<?php echo $ItemxPedido_list->ID_Restaurant->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ItemxPedido_list->SortUrl($ItemxPedido_list->ID_Restaurant) ?>', 1);"><div id="elh_ItemxPedido_ID_Restaurant" class="ItemxPedido_ID_Restaurant">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ItemxPedido_list->ID_Restaurant->caption() ?></span><span class="ew-table-header-sort"><?php if ($ItemxPedido_list->ID_Restaurant->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ItemxPedido_list->ID_Restaurant->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ItemxPedido_list->ID_Client->Visible) { // ID_Client ?>
	<?php if ($ItemxPedido_list->SortUrl($ItemxPedido_list->ID_Client) == "") { ?>
		<th data-name="ID_Client" class="<?php echo $ItemxPedido_list->ID_Client->headerCellClass() ?>"><div id="elh_ItemxPedido_ID_Client" class="ItemxPedido_ID_Client"><div class="ew-table-header-caption"><?php echo $ItemxPedido_list->ID_Client->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Client" class="<?php echo $ItemxPedido_list->ID_Client->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ItemxPedido_list->SortUrl($ItemxPedido_list->ID_Client) ?>', 1);"><div id="elh_ItemxPedido_ID_Client" class="ItemxPedido_ID_Client">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ItemxPedido_list->ID_Client->caption() ?></span><span class="ew-table-header-sort"><?php if ($ItemxPedido_list->ID_Client->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ItemxPedido_list->ID_Client->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ItemxPedido_list->DateCreation->Visible) { // DateCreation ?>
	<?php if ($ItemxPedido_list->SortUrl($ItemxPedido_list->DateCreation) == "") { ?>
		<th data-name="DateCreation" class="<?php echo $ItemxPedido_list->DateCreation->headerCellClass() ?>"><div id="elh_ItemxPedido_DateCreation" class="ItemxPedido_DateCreation"><div class="ew-table-header-caption"><?php echo $ItemxPedido_list->DateCreation->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateCreation" class="<?php echo $ItemxPedido_list->DateCreation->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ItemxPedido_list->SortUrl($ItemxPedido_list->DateCreation) ?>', 1);"><div id="elh_ItemxPedido_DateCreation" class="ItemxPedido_DateCreation">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ItemxPedido_list->DateCreation->caption() ?></span><span class="ew-table-header-sort"><?php if ($ItemxPedido_list->DateCreation->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ItemxPedido_list->DateCreation->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ItemxPedido_list->DateLastUpdate->Visible) { // DateLastUpdate ?>
	<?php if ($ItemxPedido_list->SortUrl($ItemxPedido_list->DateLastUpdate) == "") { ?>
		<th data-name="DateLastUpdate" class="<?php echo $ItemxPedido_list->DateLastUpdate->headerCellClass() ?>"><div id="elh_ItemxPedido_DateLastUpdate" class="ItemxPedido_DateLastUpdate"><div class="ew-table-header-caption"><?php echo $ItemxPedido_list->DateLastUpdate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateLastUpdate" class="<?php echo $ItemxPedido_list->DateLastUpdate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ItemxPedido_list->SortUrl($ItemxPedido_list->DateLastUpdate) ?>', 1);"><div id="elh_ItemxPedido_DateLastUpdate" class="ItemxPedido_DateLastUpdate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ItemxPedido_list->DateLastUpdate->caption() ?></span><span class="ew-table-header-sort"><?php if ($ItemxPedido_list->DateLastUpdate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ItemxPedido_list->DateLastUpdate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ItemxPedido_list->Comments->Visible) { // Comments ?>
	<?php if ($ItemxPedido_list->SortUrl($ItemxPedido_list->Comments) == "") { ?>
		<th data-name="Comments" class="<?php echo $ItemxPedido_list->Comments->headerCellClass() ?>"><div id="elh_ItemxPedido_Comments" class="ItemxPedido_Comments"><div class="ew-table-header-caption"><?php echo $ItemxPedido_list->Comments->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Comments" class="<?php echo $ItemxPedido_list->Comments->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ItemxPedido_list->SortUrl($ItemxPedido_list->Comments) ?>', 1);"><div id="elh_ItemxPedido_Comments" class="ItemxPedido_Comments">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ItemxPedido_list->Comments->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($ItemxPedido_list->Comments->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ItemxPedido_list->Comments->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ItemxPedido_list->ID_Pedido->Visible) { // ID_Pedido ?>
	<?php if ($ItemxPedido_list->SortUrl($ItemxPedido_list->ID_Pedido) == "") { ?>
		<th data-name="ID_Pedido" class="<?php echo $ItemxPedido_list->ID_Pedido->headerCellClass() ?>"><div id="elh_ItemxPedido_ID_Pedido" class="ItemxPedido_ID_Pedido"><div class="ew-table-header-caption"><?php echo $ItemxPedido_list->ID_Pedido->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Pedido" class="<?php echo $ItemxPedido_list->ID_Pedido->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ItemxPedido_list->SortUrl($ItemxPedido_list->ID_Pedido) ?>', 1);"><div id="elh_ItemxPedido_ID_Pedido" class="ItemxPedido_ID_Pedido">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ItemxPedido_list->ID_Pedido->caption() ?></span><span class="ew-table-header-sort"><?php if ($ItemxPedido_list->ID_Pedido->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ItemxPedido_list->ID_Pedido->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ItemxPedido_list->Compartir->Visible) { // Compartir ?>
	<?php if ($ItemxPedido_list->SortUrl($ItemxPedido_list->Compartir) == "") { ?>
		<th data-name="Compartir" class="<?php echo $ItemxPedido_list->Compartir->headerCellClass() ?>"><div id="elh_ItemxPedido_Compartir" class="ItemxPedido_Compartir"><div class="ew-table-header-caption"><?php echo $ItemxPedido_list->Compartir->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Compartir" class="<?php echo $ItemxPedido_list->Compartir->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ItemxPedido_list->SortUrl($ItemxPedido_list->Compartir) ?>', 1);"><div id="elh_ItemxPedido_Compartir" class="ItemxPedido_Compartir">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ItemxPedido_list->Compartir->caption() ?></span><span class="ew-table-header-sort"><?php if ($ItemxPedido_list->Compartir->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ItemxPedido_list->Compartir->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ItemxPedido_list->Cantidad->Visible) { // Cantidad ?>
	<?php if ($ItemxPedido_list->SortUrl($ItemxPedido_list->Cantidad) == "") { ?>
		<th data-name="Cantidad" class="<?php echo $ItemxPedido_list->Cantidad->headerCellClass() ?>"><div id="elh_ItemxPedido_Cantidad" class="ItemxPedido_Cantidad"><div class="ew-table-header-caption"><?php echo $ItemxPedido_list->Cantidad->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Cantidad" class="<?php echo $ItemxPedido_list->Cantidad->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ItemxPedido_list->SortUrl($ItemxPedido_list->Cantidad) ?>', 1);"><div id="elh_ItemxPedido_Cantidad" class="ItemxPedido_Cantidad">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ItemxPedido_list->Cantidad->caption() ?></span><span class="ew-table-header-sort"><?php if ($ItemxPedido_list->Cantidad->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ItemxPedido_list->Cantidad->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$ItemxPedido_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($ItemxPedido_list->ExportAll && $ItemxPedido_list->isExport()) {
	$ItemxPedido_list->StopRecord = $ItemxPedido_list->TotalRecords;
} else {

	// Set the last record to display
	if ($ItemxPedido_list->TotalRecords > $ItemxPedido_list->StartRecord + $ItemxPedido_list->DisplayRecords - 1)
		$ItemxPedido_list->StopRecord = $ItemxPedido_list->StartRecord + $ItemxPedido_list->DisplayRecords - 1;
	else
		$ItemxPedido_list->StopRecord = $ItemxPedido_list->TotalRecords;
}
$ItemxPedido_list->RecordCount = $ItemxPedido_list->StartRecord - 1;
if ($ItemxPedido_list->Recordset && !$ItemxPedido_list->Recordset->EOF) {
	$ItemxPedido_list->Recordset->moveFirst();
	$selectLimit = $ItemxPedido_list->UseSelectLimit;
	if (!$selectLimit && $ItemxPedido_list->StartRecord > 1)
		$ItemxPedido_list->Recordset->move($ItemxPedido_list->StartRecord - 1);
} elseif (!$ItemxPedido->AllowAddDeleteRow && $ItemxPedido_list->StopRecord == 0) {
	$ItemxPedido_list->StopRecord = $ItemxPedido->GridAddRowCount;
}

// Initialize aggregate
$ItemxPedido->RowType = ROWTYPE_AGGREGATEINIT;
$ItemxPedido->resetAttributes();
$ItemxPedido_list->renderRow();
while ($ItemxPedido_list->RecordCount < $ItemxPedido_list->StopRecord) {
	$ItemxPedido_list->RecordCount++;
	if ($ItemxPedido_list->RecordCount >= $ItemxPedido_list->StartRecord) {
		$ItemxPedido_list->RowCount++;

		// Set up key count
		$ItemxPedido_list->KeyCount = $ItemxPedido_list->RowIndex;

		// Init row class and style
		$ItemxPedido->resetAttributes();
		$ItemxPedido->CssClass = "";
		if ($ItemxPedido_list->isGridAdd()) {
		} else {
			$ItemxPedido_list->loadRowValues($ItemxPedido_list->Recordset); // Load row values
		}
		$ItemxPedido->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$ItemxPedido->RowAttrs->merge(["data-rowindex" => $ItemxPedido_list->RowCount, "id" => "r" . $ItemxPedido_list->RowCount . "_ItemxPedido", "data-rowtype" => $ItemxPedido->RowType]);

		// Render row
		$ItemxPedido_list->renderRow();

		// Render list options
		$ItemxPedido_list->renderListOptions();
?>
	<tr <?php echo $ItemxPedido->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ItemxPedido_list->ListOptions->render("body", "left", $ItemxPedido_list->RowCount);
?>
	<?php if ($ItemxPedido_list->ID->Visible) { // ID ?>
		<td data-name="ID" <?php echo $ItemxPedido_list->ID->cellAttributes() ?>>
<span id="el<?php echo $ItemxPedido_list->RowCount ?>_ItemxPedido_ID">
<span<?php echo $ItemxPedido_list->ID->viewAttributes() ?>><?php echo $ItemxPedido_list->ID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ItemxPedido_list->ID_Item->Visible) { // ID_Item ?>
		<td data-name="ID_Item" <?php echo $ItemxPedido_list->ID_Item->cellAttributes() ?>>
<span id="el<?php echo $ItemxPedido_list->RowCount ?>_ItemxPedido_ID_Item">
<span<?php echo $ItemxPedido_list->ID_Item->viewAttributes() ?>><?php echo $ItemxPedido_list->ID_Item->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ItemxPedido_list->ID_Restaurant->Visible) { // ID_Restaurant ?>
		<td data-name="ID_Restaurant" <?php echo $ItemxPedido_list->ID_Restaurant->cellAttributes() ?>>
<span id="el<?php echo $ItemxPedido_list->RowCount ?>_ItemxPedido_ID_Restaurant">
<span<?php echo $ItemxPedido_list->ID_Restaurant->viewAttributes() ?>><?php echo $ItemxPedido_list->ID_Restaurant->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ItemxPedido_list->ID_Client->Visible) { // ID_Client ?>
		<td data-name="ID_Client" <?php echo $ItemxPedido_list->ID_Client->cellAttributes() ?>>
<span id="el<?php echo $ItemxPedido_list->RowCount ?>_ItemxPedido_ID_Client">
<span<?php echo $ItemxPedido_list->ID_Client->viewAttributes() ?>><?php echo $ItemxPedido_list->ID_Client->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ItemxPedido_list->DateCreation->Visible) { // DateCreation ?>
		<td data-name="DateCreation" <?php echo $ItemxPedido_list->DateCreation->cellAttributes() ?>>
<span id="el<?php echo $ItemxPedido_list->RowCount ?>_ItemxPedido_DateCreation">
<span<?php echo $ItemxPedido_list->DateCreation->viewAttributes() ?>><?php echo $ItemxPedido_list->DateCreation->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ItemxPedido_list->DateLastUpdate->Visible) { // DateLastUpdate ?>
		<td data-name="DateLastUpdate" <?php echo $ItemxPedido_list->DateLastUpdate->cellAttributes() ?>>
<span id="el<?php echo $ItemxPedido_list->RowCount ?>_ItemxPedido_DateLastUpdate">
<span<?php echo $ItemxPedido_list->DateLastUpdate->viewAttributes() ?>><?php echo $ItemxPedido_list->DateLastUpdate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ItemxPedido_list->Comments->Visible) { // Comments ?>
		<td data-name="Comments" <?php echo $ItemxPedido_list->Comments->cellAttributes() ?>>
<span id="el<?php echo $ItemxPedido_list->RowCount ?>_ItemxPedido_Comments">
<span<?php echo $ItemxPedido_list->Comments->viewAttributes() ?>><?php echo $ItemxPedido_list->Comments->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ItemxPedido_list->ID_Pedido->Visible) { // ID_Pedido ?>
		<td data-name="ID_Pedido" <?php echo $ItemxPedido_list->ID_Pedido->cellAttributes() ?>>
<span id="el<?php echo $ItemxPedido_list->RowCount ?>_ItemxPedido_ID_Pedido">
<span<?php echo $ItemxPedido_list->ID_Pedido->viewAttributes() ?>><?php echo $ItemxPedido_list->ID_Pedido->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ItemxPedido_list->Compartir->Visible) { // Compartir ?>
		<td data-name="Compartir" <?php echo $ItemxPedido_list->Compartir->cellAttributes() ?>>
<span id="el<?php echo $ItemxPedido_list->RowCount ?>_ItemxPedido_Compartir">
<span<?php echo $ItemxPedido_list->Compartir->viewAttributes() ?>><?php echo $ItemxPedido_list->Compartir->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ItemxPedido_list->Cantidad->Visible) { // Cantidad ?>
		<td data-name="Cantidad" <?php echo $ItemxPedido_list->Cantidad->cellAttributes() ?>>
<span id="el<?php echo $ItemxPedido_list->RowCount ?>_ItemxPedido_Cantidad">
<span<?php echo $ItemxPedido_list->Cantidad->viewAttributes() ?>><?php echo $ItemxPedido_list->Cantidad->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ItemxPedido_list->ListOptions->render("body", "right", $ItemxPedido_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$ItemxPedido_list->isGridAdd())
		$ItemxPedido_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$ItemxPedido->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($ItemxPedido_list->Recordset)
	$ItemxPedido_list->Recordset->Close();
?>
<?php if (!$ItemxPedido_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$ItemxPedido_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ItemxPedido_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ItemxPedido_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($ItemxPedido_list->TotalRecords == 0 && !$ItemxPedido->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $ItemxPedido_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$ItemxPedido_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$ItemxPedido_list->isExport()) { ?>
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
$ItemxPedido_list->terminate();
?>