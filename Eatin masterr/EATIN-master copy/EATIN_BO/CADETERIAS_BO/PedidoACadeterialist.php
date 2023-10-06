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
$PedidoACadeteria_list = new PedidoACadeteria_list();

// Run the page
$PedidoACadeteria_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$PedidoACadeteria_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$PedidoACadeteria_list->isExport()) { ?>
<script>
var fPedidoACadeterialist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fPedidoACadeterialist = currentForm = new ew.Form("fPedidoACadeterialist", "list");
	fPedidoACadeterialist.formKeyCountName = '<?php echo $PedidoACadeteria_list->FormKeyCountName ?>';
	loadjs.done("fPedidoACadeterialist");
});
var fPedidoACadeterialistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fPedidoACadeterialistsrch = currentSearchForm = new ew.Form("fPedidoACadeterialistsrch");

	// Dynamic selection lists
	// Filters

	fPedidoACadeterialistsrch.filterList = <?php echo $PedidoACadeteria_list->getFilterList() ?>;
	loadjs.done("fPedidoACadeterialistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$PedidoACadeteria_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($PedidoACadeteria_list->TotalRecords > 0 && $PedidoACadeteria_list->ExportOptions->visible()) { ?>
<?php $PedidoACadeteria_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($PedidoACadeteria_list->ImportOptions->visible()) { ?>
<?php $PedidoACadeteria_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($PedidoACadeteria_list->SearchOptions->visible()) { ?>
<?php $PedidoACadeteria_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($PedidoACadeteria_list->FilterOptions->visible()) { ?>
<?php $PedidoACadeteria_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$PedidoACadeteria_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$PedidoACadeteria_list->isExport() && !$PedidoACadeteria->CurrentAction) { ?>
<form name="fPedidoACadeterialistsrch" id="fPedidoACadeterialistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fPedidoACadeterialistsrch-search-panel" class="<?php echo $PedidoACadeteria_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="PedidoACadeteria">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $PedidoACadeteria_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($PedidoACadeteria_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($PedidoACadeteria_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $PedidoACadeteria_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($PedidoACadeteria_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($PedidoACadeteria_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($PedidoACadeteria_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($PedidoACadeteria_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $PedidoACadeteria_list->showPageHeader(); ?>
<?php
$PedidoACadeteria_list->showMessage();
?>
<?php if ($PedidoACadeteria_list->TotalRecords > 0 || $PedidoACadeteria->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($PedidoACadeteria_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> PedidoACadeteria">
<form name="fPedidoACadeterialist" id="fPedidoACadeterialist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="PedidoACadeteria">
<div id="gmp_PedidoACadeteria" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($PedidoACadeteria_list->TotalRecords > 0 || $PedidoACadeteria_list->isGridEdit()) { ?>
<table id="tbl_PedidoACadeterialist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$PedidoACadeteria->RowType = ROWTYPE_HEADER;

// Render list options
$PedidoACadeteria_list->renderListOptions();

// Render list options (header, left)
$PedidoACadeteria_list->ListOptions->render("header", "left");
?>
<?php if ($PedidoACadeteria_list->ID->Visible) { // ID ?>
	<?php if ($PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->ID) == "") { ?>
		<th data-name="ID" class="<?php echo $PedidoACadeteria_list->ID->headerCellClass() ?>"><div id="elh_PedidoACadeteria_ID" class="PedidoACadeteria_ID"><div class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->ID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID" class="<?php echo $PedidoACadeteria_list->ID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->ID) ?>', 1);"><div id="elh_PedidoACadeteria_ID" class="PedidoACadeteria_ID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->ID->caption() ?></span><span class="ew-table-header-sort"><?php if ($PedidoACadeteria_list->ID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PedidoACadeteria_list->ID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($PedidoACadeteria_list->ID_Usuario->Visible) { // ID_Usuario ?>
	<?php if ($PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->ID_Usuario) == "") { ?>
		<th data-name="ID_Usuario" class="<?php echo $PedidoACadeteria_list->ID_Usuario->headerCellClass() ?>"><div id="elh_PedidoACadeteria_ID_Usuario" class="PedidoACadeteria_ID_Usuario"><div class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->ID_Usuario->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Usuario" class="<?php echo $PedidoACadeteria_list->ID_Usuario->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->ID_Usuario) ?>', 1);"><div id="elh_PedidoACadeteria_ID_Usuario" class="PedidoACadeteria_ID_Usuario">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->ID_Usuario->caption() ?></span><span class="ew-table-header-sort"><?php if ($PedidoACadeteria_list->ID_Usuario->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PedidoACadeteria_list->ID_Usuario->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($PedidoACadeteria_list->ID_Place1->Visible) { // ID_Place1 ?>
	<?php if ($PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->ID_Place1) == "") { ?>
		<th data-name="ID_Place1" class="<?php echo $PedidoACadeteria_list->ID_Place1->headerCellClass() ?>"><div id="elh_PedidoACadeteria_ID_Place1" class="PedidoACadeteria_ID_Place1"><div class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->ID_Place1->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Place1" class="<?php echo $PedidoACadeteria_list->ID_Place1->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->ID_Place1) ?>', 1);"><div id="elh_PedidoACadeteria_ID_Place1" class="PedidoACadeteria_ID_Place1">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->ID_Place1->caption() ?></span><span class="ew-table-header-sort"><?php if ($PedidoACadeteria_list->ID_Place1->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PedidoACadeteria_list->ID_Place1->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($PedidoACadeteria_list->ID_Place2->Visible) { // ID_Place2 ?>
	<?php if ($PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->ID_Place2) == "") { ?>
		<th data-name="ID_Place2" class="<?php echo $PedidoACadeteria_list->ID_Place2->headerCellClass() ?>"><div id="elh_PedidoACadeteria_ID_Place2" class="PedidoACadeteria_ID_Place2"><div class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->ID_Place2->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Place2" class="<?php echo $PedidoACadeteria_list->ID_Place2->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->ID_Place2) ?>', 1);"><div id="elh_PedidoACadeteria_ID_Place2" class="PedidoACadeteria_ID_Place2">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->ID_Place2->caption() ?></span><span class="ew-table-header-sort"><?php if ($PedidoACadeteria_list->ID_Place2->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PedidoACadeteria_list->ID_Place2->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($PedidoACadeteria_list->ID_Cadete->Visible) { // ID_Cadete ?>
	<?php if ($PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->ID_Cadete) == "") { ?>
		<th data-name="ID_Cadete" class="<?php echo $PedidoACadeteria_list->ID_Cadete->headerCellClass() ?>"><div id="elh_PedidoACadeteria_ID_Cadete" class="PedidoACadeteria_ID_Cadete"><div class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->ID_Cadete->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Cadete" class="<?php echo $PedidoACadeteria_list->ID_Cadete->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->ID_Cadete) ?>', 1);"><div id="elh_PedidoACadeteria_ID_Cadete" class="PedidoACadeteria_ID_Cadete">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->ID_Cadete->caption() ?></span><span class="ew-table-header-sort"><?php if ($PedidoACadeteria_list->ID_Cadete->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PedidoACadeteria_list->ID_Cadete->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($PedidoACadeteria_list->ID_Status->Visible) { // ID_Status ?>
	<?php if ($PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->ID_Status) == "") { ?>
		<th data-name="ID_Status" class="<?php echo $PedidoACadeteria_list->ID_Status->headerCellClass() ?>"><div id="elh_PedidoACadeteria_ID_Status" class="PedidoACadeteria_ID_Status"><div class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->ID_Status->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Status" class="<?php echo $PedidoACadeteria_list->ID_Status->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->ID_Status) ?>', 1);"><div id="elh_PedidoACadeteria_ID_Status" class="PedidoACadeteria_ID_Status">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->ID_Status->caption() ?></span><span class="ew-table-header-sort"><?php if ($PedidoACadeteria_list->ID_Status->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PedidoACadeteria_list->ID_Status->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($PedidoACadeteria_list->InstruccionesPlace1->Visible) { // InstruccionesPlace1 ?>
	<?php if ($PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->InstruccionesPlace1) == "") { ?>
		<th data-name="InstruccionesPlace1" class="<?php echo $PedidoACadeteria_list->InstruccionesPlace1->headerCellClass() ?>"><div id="elh_PedidoACadeteria_InstruccionesPlace1" class="PedidoACadeteria_InstruccionesPlace1"><div class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->InstruccionesPlace1->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="InstruccionesPlace1" class="<?php echo $PedidoACadeteria_list->InstruccionesPlace1->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->InstruccionesPlace1) ?>', 1);"><div id="elh_PedidoACadeteria_InstruccionesPlace1" class="PedidoACadeteria_InstruccionesPlace1">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->InstruccionesPlace1->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($PedidoACadeteria_list->InstruccionesPlace1->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PedidoACadeteria_list->InstruccionesPlace1->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($PedidoACadeteria_list->InstruccionesPlace2->Visible) { // InstruccionesPlace2 ?>
	<?php if ($PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->InstruccionesPlace2) == "") { ?>
		<th data-name="InstruccionesPlace2" class="<?php echo $PedidoACadeteria_list->InstruccionesPlace2->headerCellClass() ?>"><div id="elh_PedidoACadeteria_InstruccionesPlace2" class="PedidoACadeteria_InstruccionesPlace2"><div class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->InstruccionesPlace2->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="InstruccionesPlace2" class="<?php echo $PedidoACadeteria_list->InstruccionesPlace2->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->InstruccionesPlace2) ?>', 1);"><div id="elh_PedidoACadeteria_InstruccionesPlace2" class="PedidoACadeteria_InstruccionesPlace2">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->InstruccionesPlace2->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($PedidoACadeteria_list->InstruccionesPlace2->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PedidoACadeteria_list->InstruccionesPlace2->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($PedidoACadeteria_list->Direccionalidad->Visible) { // Direccionalidad ?>
	<?php if ($PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->Direccionalidad) == "") { ?>
		<th data-name="Direccionalidad" class="<?php echo $PedidoACadeteria_list->Direccionalidad->headerCellClass() ?>"><div id="elh_PedidoACadeteria_Direccionalidad" class="PedidoACadeteria_Direccionalidad"><div class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->Direccionalidad->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Direccionalidad" class="<?php echo $PedidoACadeteria_list->Direccionalidad->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->Direccionalidad) ?>', 1);"><div id="elh_PedidoACadeteria_Direccionalidad" class="PedidoACadeteria_Direccionalidad">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->Direccionalidad->caption() ?></span><span class="ew-table-header-sort"><?php if ($PedidoACadeteria_list->Direccionalidad->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PedidoACadeteria_list->Direccionalidad->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($PedidoACadeteria_list->RemitoURL->Visible) { // RemitoURL ?>
	<?php if ($PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->RemitoURL) == "") { ?>
		<th data-name="RemitoURL" class="<?php echo $PedidoACadeteria_list->RemitoURL->headerCellClass() ?>"><div id="elh_PedidoACadeteria_RemitoURL" class="PedidoACadeteria_RemitoURL"><div class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->RemitoURL->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RemitoURL" class="<?php echo $PedidoACadeteria_list->RemitoURL->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->RemitoURL) ?>', 1);"><div id="elh_PedidoACadeteria_RemitoURL" class="PedidoACadeteria_RemitoURL">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->RemitoURL->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($PedidoACadeteria_list->RemitoURL->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PedidoACadeteria_list->RemitoURL->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($PedidoACadeteria_list->Place1_Nombre->Visible) { // Place1_Nombre ?>
	<?php if ($PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->Place1_Nombre) == "") { ?>
		<th data-name="Place1_Nombre" class="<?php echo $PedidoACadeteria_list->Place1_Nombre->headerCellClass() ?>"><div id="elh_PedidoACadeteria_Place1_Nombre" class="PedidoACadeteria_Place1_Nombre"><div class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->Place1_Nombre->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Place1_Nombre" class="<?php echo $PedidoACadeteria_list->Place1_Nombre->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->Place1_Nombre) ?>', 1);"><div id="elh_PedidoACadeteria_Place1_Nombre" class="PedidoACadeteria_Place1_Nombre">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->Place1_Nombre->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($PedidoACadeteria_list->Place1_Nombre->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PedidoACadeteria_list->Place1_Nombre->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($PedidoACadeteria_list->Place1_Country->Visible) { // Place1_Country ?>
	<?php if ($PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->Place1_Country) == "") { ?>
		<th data-name="Place1_Country" class="<?php echo $PedidoACadeteria_list->Place1_Country->headerCellClass() ?>"><div id="elh_PedidoACadeteria_Place1_Country" class="PedidoACadeteria_Place1_Country"><div class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->Place1_Country->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Place1_Country" class="<?php echo $PedidoACadeteria_list->Place1_Country->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->Place1_Country) ?>', 1);"><div id="elh_PedidoACadeteria_Place1_Country" class="PedidoACadeteria_Place1_Country">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->Place1_Country->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($PedidoACadeteria_list->Place1_Country->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PedidoACadeteria_list->Place1_Country->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($PedidoACadeteria_list->Place1_UF->Visible) { // Place1_UF ?>
	<?php if ($PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->Place1_UF) == "") { ?>
		<th data-name="Place1_UF" class="<?php echo $PedidoACadeteria_list->Place1_UF->headerCellClass() ?>"><div id="elh_PedidoACadeteria_Place1_UF" class="PedidoACadeteria_Place1_UF"><div class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->Place1_UF->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Place1_UF" class="<?php echo $PedidoACadeteria_list->Place1_UF->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->Place1_UF) ?>', 1);"><div id="elh_PedidoACadeteria_Place1_UF" class="PedidoACadeteria_Place1_UF">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->Place1_UF->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($PedidoACadeteria_list->Place1_UF->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PedidoACadeteria_list->Place1_UF->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($PedidoACadeteria_list->Plate1_Lat->Visible) { // Plate1_Lat ?>
	<?php if ($PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->Plate1_Lat) == "") { ?>
		<th data-name="Plate1_Lat" class="<?php echo $PedidoACadeteria_list->Plate1_Lat->headerCellClass() ?>"><div id="elh_PedidoACadeteria_Plate1_Lat" class="PedidoACadeteria_Plate1_Lat"><div class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->Plate1_Lat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Plate1_Lat" class="<?php echo $PedidoACadeteria_list->Plate1_Lat->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->Plate1_Lat) ?>', 1);"><div id="elh_PedidoACadeteria_Plate1_Lat" class="PedidoACadeteria_Plate1_Lat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->Plate1_Lat->caption() ?></span><span class="ew-table-header-sort"><?php if ($PedidoACadeteria_list->Plate1_Lat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PedidoACadeteria_list->Plate1_Lat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($PedidoACadeteria_list->Place1_Lon->Visible) { // Place1_Lon ?>
	<?php if ($PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->Place1_Lon) == "") { ?>
		<th data-name="Place1_Lon" class="<?php echo $PedidoACadeteria_list->Place1_Lon->headerCellClass() ?>"><div id="elh_PedidoACadeteria_Place1_Lon" class="PedidoACadeteria_Place1_Lon"><div class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->Place1_Lon->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Place1_Lon" class="<?php echo $PedidoACadeteria_list->Place1_Lon->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->Place1_Lon) ?>', 1);"><div id="elh_PedidoACadeteria_Place1_Lon" class="PedidoACadeteria_Place1_Lon">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->Place1_Lon->caption() ?></span><span class="ew-table-header-sort"><?php if ($PedidoACadeteria_list->Place1_Lon->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PedidoACadeteria_list->Place1_Lon->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($PedidoACadeteria_list->Place1_Calle->Visible) { // Place1_Calle ?>
	<?php if ($PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->Place1_Calle) == "") { ?>
		<th data-name="Place1_Calle" class="<?php echo $PedidoACadeteria_list->Place1_Calle->headerCellClass() ?>"><div id="elh_PedidoACadeteria_Place1_Calle" class="PedidoACadeteria_Place1_Calle"><div class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->Place1_Calle->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Place1_Calle" class="<?php echo $PedidoACadeteria_list->Place1_Calle->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->Place1_Calle) ?>', 1);"><div id="elh_PedidoACadeteria_Place1_Calle" class="PedidoACadeteria_Place1_Calle">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->Place1_Calle->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($PedidoACadeteria_list->Place1_Calle->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PedidoACadeteria_list->Place1_Calle->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($PedidoACadeteria_list->Place1_Numero->Visible) { // Place1_Numero ?>
	<?php if ($PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->Place1_Numero) == "") { ?>
		<th data-name="Place1_Numero" class="<?php echo $PedidoACadeteria_list->Place1_Numero->headerCellClass() ?>"><div id="elh_PedidoACadeteria_Place1_Numero" class="PedidoACadeteria_Place1_Numero"><div class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->Place1_Numero->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Place1_Numero" class="<?php echo $PedidoACadeteria_list->Place1_Numero->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->Place1_Numero) ?>', 1);"><div id="elh_PedidoACadeteria_Place1_Numero" class="PedidoACadeteria_Place1_Numero">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->Place1_Numero->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($PedidoACadeteria_list->Place1_Numero->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PedidoACadeteria_list->Place1_Numero->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($PedidoACadeteria_list->Place1_Localidad->Visible) { // Place1_Localidad ?>
	<?php if ($PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->Place1_Localidad) == "") { ?>
		<th data-name="Place1_Localidad" class="<?php echo $PedidoACadeteria_list->Place1_Localidad->headerCellClass() ?>"><div id="elh_PedidoACadeteria_Place1_Localidad" class="PedidoACadeteria_Place1_Localidad"><div class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->Place1_Localidad->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Place1_Localidad" class="<?php echo $PedidoACadeteria_list->Place1_Localidad->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->Place1_Localidad) ?>', 1);"><div id="elh_PedidoACadeteria_Place1_Localidad" class="PedidoACadeteria_Place1_Localidad">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->Place1_Localidad->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($PedidoACadeteria_list->Place1_Localidad->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PedidoACadeteria_list->Place1_Localidad->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($PedidoACadeteria_list->Place1_Piso->Visible) { // Place1_Piso ?>
	<?php if ($PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->Place1_Piso) == "") { ?>
		<th data-name="Place1_Piso" class="<?php echo $PedidoACadeteria_list->Place1_Piso->headerCellClass() ?>"><div id="elh_PedidoACadeteria_Place1_Piso" class="PedidoACadeteria_Place1_Piso"><div class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->Place1_Piso->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Place1_Piso" class="<?php echo $PedidoACadeteria_list->Place1_Piso->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->Place1_Piso) ?>', 1);"><div id="elh_PedidoACadeteria_Place1_Piso" class="PedidoACadeteria_Place1_Piso">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->Place1_Piso->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($PedidoACadeteria_list->Place1_Piso->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PedidoACadeteria_list->Place1_Piso->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($PedidoACadeteria_list->Place1_Depto->Visible) { // Place1_Depto ?>
	<?php if ($PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->Place1_Depto) == "") { ?>
		<th data-name="Place1_Depto" class="<?php echo $PedidoACadeteria_list->Place1_Depto->headerCellClass() ?>"><div id="elh_PedidoACadeteria_Place1_Depto" class="PedidoACadeteria_Place1_Depto"><div class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->Place1_Depto->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Place1_Depto" class="<?php echo $PedidoACadeteria_list->Place1_Depto->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->Place1_Depto) ?>', 1);"><div id="elh_PedidoACadeteria_Place1_Depto" class="PedidoACadeteria_Place1_Depto">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->Place1_Depto->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($PedidoACadeteria_list->Place1_Depto->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PedidoACadeteria_list->Place1_Depto->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($PedidoACadeteria_list->Place1_PersonaRecibe->Visible) { // Place1_PersonaRecibe ?>
	<?php if ($PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->Place1_PersonaRecibe) == "") { ?>
		<th data-name="Place1_PersonaRecibe" class="<?php echo $PedidoACadeteria_list->Place1_PersonaRecibe->headerCellClass() ?>"><div id="elh_PedidoACadeteria_Place1_PersonaRecibe" class="PedidoACadeteria_Place1_PersonaRecibe"><div class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->Place1_PersonaRecibe->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Place1_PersonaRecibe" class="<?php echo $PedidoACadeteria_list->Place1_PersonaRecibe->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->Place1_PersonaRecibe) ?>', 1);"><div id="elh_PedidoACadeteria_Place1_PersonaRecibe" class="PedidoACadeteria_Place1_PersonaRecibe">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->Place1_PersonaRecibe->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($PedidoACadeteria_list->Place1_PersonaRecibe->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PedidoACadeteria_list->Place1_PersonaRecibe->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($PedidoACadeteria_list->Place1_PersonaRecibeTelefono->Visible) { // Place1_PersonaRecibeTelefono ?>
	<?php if ($PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->Place1_PersonaRecibeTelefono) == "") { ?>
		<th data-name="Place1_PersonaRecibeTelefono" class="<?php echo $PedidoACadeteria_list->Place1_PersonaRecibeTelefono->headerCellClass() ?>"><div id="elh_PedidoACadeteria_Place1_PersonaRecibeTelefono" class="PedidoACadeteria_Place1_PersonaRecibeTelefono"><div class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->Place1_PersonaRecibeTelefono->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Place1_PersonaRecibeTelefono" class="<?php echo $PedidoACadeteria_list->Place1_PersonaRecibeTelefono->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->Place1_PersonaRecibeTelefono) ?>', 1);"><div id="elh_PedidoACadeteria_Place1_PersonaRecibeTelefono" class="PedidoACadeteria_Place1_PersonaRecibeTelefono">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->Place1_PersonaRecibeTelefono->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($PedidoACadeteria_list->Place1_PersonaRecibeTelefono->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PedidoACadeteria_list->Place1_PersonaRecibeTelefono->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($PedidoACadeteria_list->Place2_Nombre->Visible) { // Place2_Nombre ?>
	<?php if ($PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->Place2_Nombre) == "") { ?>
		<th data-name="Place2_Nombre" class="<?php echo $PedidoACadeteria_list->Place2_Nombre->headerCellClass() ?>"><div id="elh_PedidoACadeteria_Place2_Nombre" class="PedidoACadeteria_Place2_Nombre"><div class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->Place2_Nombre->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Place2_Nombre" class="<?php echo $PedidoACadeteria_list->Place2_Nombre->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->Place2_Nombre) ?>', 1);"><div id="elh_PedidoACadeteria_Place2_Nombre" class="PedidoACadeteria_Place2_Nombre">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->Place2_Nombre->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($PedidoACadeteria_list->Place2_Nombre->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PedidoACadeteria_list->Place2_Nombre->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($PedidoACadeteria_list->Place2_Country->Visible) { // Place2_Country ?>
	<?php if ($PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->Place2_Country) == "") { ?>
		<th data-name="Place2_Country" class="<?php echo $PedidoACadeteria_list->Place2_Country->headerCellClass() ?>"><div id="elh_PedidoACadeteria_Place2_Country" class="PedidoACadeteria_Place2_Country"><div class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->Place2_Country->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Place2_Country" class="<?php echo $PedidoACadeteria_list->Place2_Country->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->Place2_Country) ?>', 1);"><div id="elh_PedidoACadeteria_Place2_Country" class="PedidoACadeteria_Place2_Country">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->Place2_Country->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($PedidoACadeteria_list->Place2_Country->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PedidoACadeteria_list->Place2_Country->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($PedidoACadeteria_list->Place2_UF->Visible) { // Place2_UF ?>
	<?php if ($PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->Place2_UF) == "") { ?>
		<th data-name="Place2_UF" class="<?php echo $PedidoACadeteria_list->Place2_UF->headerCellClass() ?>"><div id="elh_PedidoACadeteria_Place2_UF" class="PedidoACadeteria_Place2_UF"><div class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->Place2_UF->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Place2_UF" class="<?php echo $PedidoACadeteria_list->Place2_UF->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->Place2_UF) ?>', 1);"><div id="elh_PedidoACadeteria_Place2_UF" class="PedidoACadeteria_Place2_UF">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->Place2_UF->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($PedidoACadeteria_list->Place2_UF->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PedidoACadeteria_list->Place2_UF->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($PedidoACadeteria_list->Place2_Lat->Visible) { // Place2_Lat ?>
	<?php if ($PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->Place2_Lat) == "") { ?>
		<th data-name="Place2_Lat" class="<?php echo $PedidoACadeteria_list->Place2_Lat->headerCellClass() ?>"><div id="elh_PedidoACadeteria_Place2_Lat" class="PedidoACadeteria_Place2_Lat"><div class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->Place2_Lat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Place2_Lat" class="<?php echo $PedidoACadeteria_list->Place2_Lat->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->Place2_Lat) ?>', 1);"><div id="elh_PedidoACadeteria_Place2_Lat" class="PedidoACadeteria_Place2_Lat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->Place2_Lat->caption() ?></span><span class="ew-table-header-sort"><?php if ($PedidoACadeteria_list->Place2_Lat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PedidoACadeteria_list->Place2_Lat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($PedidoACadeteria_list->Place2_Lon->Visible) { // Place2_Lon ?>
	<?php if ($PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->Place2_Lon) == "") { ?>
		<th data-name="Place2_Lon" class="<?php echo $PedidoACadeteria_list->Place2_Lon->headerCellClass() ?>"><div id="elh_PedidoACadeteria_Place2_Lon" class="PedidoACadeteria_Place2_Lon"><div class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->Place2_Lon->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Place2_Lon" class="<?php echo $PedidoACadeteria_list->Place2_Lon->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->Place2_Lon) ?>', 1);"><div id="elh_PedidoACadeteria_Place2_Lon" class="PedidoACadeteria_Place2_Lon">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->Place2_Lon->caption() ?></span><span class="ew-table-header-sort"><?php if ($PedidoACadeteria_list->Place2_Lon->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PedidoACadeteria_list->Place2_Lon->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($PedidoACadeteria_list->Place2_Calle->Visible) { // Place2_Calle ?>
	<?php if ($PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->Place2_Calle) == "") { ?>
		<th data-name="Place2_Calle" class="<?php echo $PedidoACadeteria_list->Place2_Calle->headerCellClass() ?>"><div id="elh_PedidoACadeteria_Place2_Calle" class="PedidoACadeteria_Place2_Calle"><div class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->Place2_Calle->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Place2_Calle" class="<?php echo $PedidoACadeteria_list->Place2_Calle->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->Place2_Calle) ?>', 1);"><div id="elh_PedidoACadeteria_Place2_Calle" class="PedidoACadeteria_Place2_Calle">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->Place2_Calle->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($PedidoACadeteria_list->Place2_Calle->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PedidoACadeteria_list->Place2_Calle->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($PedidoACadeteria_list->Place2_Numero->Visible) { // Place2_Numero ?>
	<?php if ($PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->Place2_Numero) == "") { ?>
		<th data-name="Place2_Numero" class="<?php echo $PedidoACadeteria_list->Place2_Numero->headerCellClass() ?>"><div id="elh_PedidoACadeteria_Place2_Numero" class="PedidoACadeteria_Place2_Numero"><div class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->Place2_Numero->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Place2_Numero" class="<?php echo $PedidoACadeteria_list->Place2_Numero->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->Place2_Numero) ?>', 1);"><div id="elh_PedidoACadeteria_Place2_Numero" class="PedidoACadeteria_Place2_Numero">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->Place2_Numero->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($PedidoACadeteria_list->Place2_Numero->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PedidoACadeteria_list->Place2_Numero->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($PedidoACadeteria_list->Place2_Localidad->Visible) { // Place2_Localidad ?>
	<?php if ($PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->Place2_Localidad) == "") { ?>
		<th data-name="Place2_Localidad" class="<?php echo $PedidoACadeteria_list->Place2_Localidad->headerCellClass() ?>"><div id="elh_PedidoACadeteria_Place2_Localidad" class="PedidoACadeteria_Place2_Localidad"><div class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->Place2_Localidad->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Place2_Localidad" class="<?php echo $PedidoACadeteria_list->Place2_Localidad->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->Place2_Localidad) ?>', 1);"><div id="elh_PedidoACadeteria_Place2_Localidad" class="PedidoACadeteria_Place2_Localidad">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->Place2_Localidad->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($PedidoACadeteria_list->Place2_Localidad->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PedidoACadeteria_list->Place2_Localidad->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($PedidoACadeteria_list->Place2_Piso->Visible) { // Place2_Piso ?>
	<?php if ($PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->Place2_Piso) == "") { ?>
		<th data-name="Place2_Piso" class="<?php echo $PedidoACadeteria_list->Place2_Piso->headerCellClass() ?>"><div id="elh_PedidoACadeteria_Place2_Piso" class="PedidoACadeteria_Place2_Piso"><div class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->Place2_Piso->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Place2_Piso" class="<?php echo $PedidoACadeteria_list->Place2_Piso->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->Place2_Piso) ?>', 1);"><div id="elh_PedidoACadeteria_Place2_Piso" class="PedidoACadeteria_Place2_Piso">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->Place2_Piso->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($PedidoACadeteria_list->Place2_Piso->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PedidoACadeteria_list->Place2_Piso->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($PedidoACadeteria_list->Place2_Depto->Visible) { // Place2_Depto ?>
	<?php if ($PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->Place2_Depto) == "") { ?>
		<th data-name="Place2_Depto" class="<?php echo $PedidoACadeteria_list->Place2_Depto->headerCellClass() ?>"><div id="elh_PedidoACadeteria_Place2_Depto" class="PedidoACadeteria_Place2_Depto"><div class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->Place2_Depto->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Place2_Depto" class="<?php echo $PedidoACadeteria_list->Place2_Depto->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->Place2_Depto) ?>', 1);"><div id="elh_PedidoACadeteria_Place2_Depto" class="PedidoACadeteria_Place2_Depto">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->Place2_Depto->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($PedidoACadeteria_list->Place2_Depto->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PedidoACadeteria_list->Place2_Depto->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($PedidoACadeteria_list->Place2_PersonaRecibe->Visible) { // Place2_PersonaRecibe ?>
	<?php if ($PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->Place2_PersonaRecibe) == "") { ?>
		<th data-name="Place2_PersonaRecibe" class="<?php echo $PedidoACadeteria_list->Place2_PersonaRecibe->headerCellClass() ?>"><div id="elh_PedidoACadeteria_Place2_PersonaRecibe" class="PedidoACadeteria_Place2_PersonaRecibe"><div class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->Place2_PersonaRecibe->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Place2_PersonaRecibe" class="<?php echo $PedidoACadeteria_list->Place2_PersonaRecibe->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->Place2_PersonaRecibe) ?>', 1);"><div id="elh_PedidoACadeteria_Place2_PersonaRecibe" class="PedidoACadeteria_Place2_PersonaRecibe">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->Place2_PersonaRecibe->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($PedidoACadeteria_list->Place2_PersonaRecibe->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PedidoACadeteria_list->Place2_PersonaRecibe->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($PedidoACadeteria_list->Place2_PersonaRecibeTelefono->Visible) { // Place2_PersonaRecibeTelefono ?>
	<?php if ($PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->Place2_PersonaRecibeTelefono) == "") { ?>
		<th data-name="Place2_PersonaRecibeTelefono" class="<?php echo $PedidoACadeteria_list->Place2_PersonaRecibeTelefono->headerCellClass() ?>"><div id="elh_PedidoACadeteria_Place2_PersonaRecibeTelefono" class="PedidoACadeteria_Place2_PersonaRecibeTelefono"><div class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->Place2_PersonaRecibeTelefono->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Place2_PersonaRecibeTelefono" class="<?php echo $PedidoACadeteria_list->Place2_PersonaRecibeTelefono->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->Place2_PersonaRecibeTelefono) ?>', 1);"><div id="elh_PedidoACadeteria_Place2_PersonaRecibeTelefono" class="PedidoACadeteria_Place2_PersonaRecibeTelefono">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->Place2_PersonaRecibeTelefono->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($PedidoACadeteria_list->Place2_PersonaRecibeTelefono->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PedidoACadeteria_list->Place2_PersonaRecibeTelefono->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($PedidoACadeteria_list->ID_Cadeteria->Visible) { // ID_Cadeteria ?>
	<?php if ($PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->ID_Cadeteria) == "") { ?>
		<th data-name="ID_Cadeteria" class="<?php echo $PedidoACadeteria_list->ID_Cadeteria->headerCellClass() ?>"><div id="elh_PedidoACadeteria_ID_Cadeteria" class="PedidoACadeteria_ID_Cadeteria"><div class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->ID_Cadeteria->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Cadeteria" class="<?php echo $PedidoACadeteria_list->ID_Cadeteria->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PedidoACadeteria_list->SortUrl($PedidoACadeteria_list->ID_Cadeteria) ?>', 1);"><div id="elh_PedidoACadeteria_ID_Cadeteria" class="PedidoACadeteria_ID_Cadeteria">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PedidoACadeteria_list->ID_Cadeteria->caption() ?></span><span class="ew-table-header-sort"><?php if ($PedidoACadeteria_list->ID_Cadeteria->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PedidoACadeteria_list->ID_Cadeteria->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$PedidoACadeteria_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($PedidoACadeteria_list->ExportAll && $PedidoACadeteria_list->isExport()) {
	$PedidoACadeteria_list->StopRecord = $PedidoACadeteria_list->TotalRecords;
} else {

	// Set the last record to display
	if ($PedidoACadeteria_list->TotalRecords > $PedidoACadeteria_list->StartRecord + $PedidoACadeteria_list->DisplayRecords - 1)
		$PedidoACadeteria_list->StopRecord = $PedidoACadeteria_list->StartRecord + $PedidoACadeteria_list->DisplayRecords - 1;
	else
		$PedidoACadeteria_list->StopRecord = $PedidoACadeteria_list->TotalRecords;
}
$PedidoACadeteria_list->RecordCount = $PedidoACadeteria_list->StartRecord - 1;
if ($PedidoACadeteria_list->Recordset && !$PedidoACadeteria_list->Recordset->EOF) {
	$PedidoACadeteria_list->Recordset->moveFirst();
	$selectLimit = $PedidoACadeteria_list->UseSelectLimit;
	if (!$selectLimit && $PedidoACadeteria_list->StartRecord > 1)
		$PedidoACadeteria_list->Recordset->move($PedidoACadeteria_list->StartRecord - 1);
} elseif (!$PedidoACadeteria->AllowAddDeleteRow && $PedidoACadeteria_list->StopRecord == 0) {
	$PedidoACadeteria_list->StopRecord = $PedidoACadeteria->GridAddRowCount;
}

// Initialize aggregate
$PedidoACadeteria->RowType = ROWTYPE_AGGREGATEINIT;
$PedidoACadeteria->resetAttributes();
$PedidoACadeteria_list->renderRow();
while ($PedidoACadeteria_list->RecordCount < $PedidoACadeteria_list->StopRecord) {
	$PedidoACadeteria_list->RecordCount++;
	if ($PedidoACadeteria_list->RecordCount >= $PedidoACadeteria_list->StartRecord) {
		$PedidoACadeteria_list->RowCount++;

		// Set up key count
		$PedidoACadeteria_list->KeyCount = $PedidoACadeteria_list->RowIndex;

		// Init row class and style
		$PedidoACadeteria->resetAttributes();
		$PedidoACadeteria->CssClass = "";
		if ($PedidoACadeteria_list->isGridAdd()) {
		} else {
			$PedidoACadeteria_list->loadRowValues($PedidoACadeteria_list->Recordset); // Load row values
		}
		$PedidoACadeteria->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$PedidoACadeteria->RowAttrs->merge(["data-rowindex" => $PedidoACadeteria_list->RowCount, "id" => "r" . $PedidoACadeteria_list->RowCount . "_PedidoACadeteria", "data-rowtype" => $PedidoACadeteria->RowType]);

		// Render row
		$PedidoACadeteria_list->renderRow();

		// Render list options
		$PedidoACadeteria_list->renderListOptions();
?>
	<tr <?php echo $PedidoACadeteria->rowAttributes() ?>>
<?php

// Render list options (body, left)
$PedidoACadeteria_list->ListOptions->render("body", "left", $PedidoACadeteria_list->RowCount);
?>
	<?php if ($PedidoACadeteria_list->ID->Visible) { // ID ?>
		<td data-name="ID" <?php echo $PedidoACadeteria_list->ID->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_list->RowCount ?>_PedidoACadeteria_ID">
<span<?php echo $PedidoACadeteria_list->ID->viewAttributes() ?>><?php echo $PedidoACadeteria_list->ID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($PedidoACadeteria_list->ID_Usuario->Visible) { // ID_Usuario ?>
		<td data-name="ID_Usuario" <?php echo $PedidoACadeteria_list->ID_Usuario->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_list->RowCount ?>_PedidoACadeteria_ID_Usuario">
<span<?php echo $PedidoACadeteria_list->ID_Usuario->viewAttributes() ?>><?php echo $PedidoACadeteria_list->ID_Usuario->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($PedidoACadeteria_list->ID_Place1->Visible) { // ID_Place1 ?>
		<td data-name="ID_Place1" <?php echo $PedidoACadeteria_list->ID_Place1->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_list->RowCount ?>_PedidoACadeteria_ID_Place1">
<span<?php echo $PedidoACadeteria_list->ID_Place1->viewAttributes() ?>><?php echo $PedidoACadeteria_list->ID_Place1->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($PedidoACadeteria_list->ID_Place2->Visible) { // ID_Place2 ?>
		<td data-name="ID_Place2" <?php echo $PedidoACadeteria_list->ID_Place2->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_list->RowCount ?>_PedidoACadeteria_ID_Place2">
<span<?php echo $PedidoACadeteria_list->ID_Place2->viewAttributes() ?>><?php echo $PedidoACadeteria_list->ID_Place2->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($PedidoACadeteria_list->ID_Cadete->Visible) { // ID_Cadete ?>
		<td data-name="ID_Cadete" <?php echo $PedidoACadeteria_list->ID_Cadete->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_list->RowCount ?>_PedidoACadeteria_ID_Cadete">
<span<?php echo $PedidoACadeteria_list->ID_Cadete->viewAttributes() ?>><?php echo $PedidoACadeteria_list->ID_Cadete->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($PedidoACadeteria_list->ID_Status->Visible) { // ID_Status ?>
		<td data-name="ID_Status" <?php echo $PedidoACadeteria_list->ID_Status->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_list->RowCount ?>_PedidoACadeteria_ID_Status">
<span<?php echo $PedidoACadeteria_list->ID_Status->viewAttributes() ?>><?php echo $PedidoACadeteria_list->ID_Status->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($PedidoACadeteria_list->InstruccionesPlace1->Visible) { // InstruccionesPlace1 ?>
		<td data-name="InstruccionesPlace1" <?php echo $PedidoACadeteria_list->InstruccionesPlace1->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_list->RowCount ?>_PedidoACadeteria_InstruccionesPlace1">
<span<?php echo $PedidoACadeteria_list->InstruccionesPlace1->viewAttributes() ?>><?php echo $PedidoACadeteria_list->InstruccionesPlace1->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($PedidoACadeteria_list->InstruccionesPlace2->Visible) { // InstruccionesPlace2 ?>
		<td data-name="InstruccionesPlace2" <?php echo $PedidoACadeteria_list->InstruccionesPlace2->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_list->RowCount ?>_PedidoACadeteria_InstruccionesPlace2">
<span<?php echo $PedidoACadeteria_list->InstruccionesPlace2->viewAttributes() ?>><?php echo $PedidoACadeteria_list->InstruccionesPlace2->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($PedidoACadeteria_list->Direccionalidad->Visible) { // Direccionalidad ?>
		<td data-name="Direccionalidad" <?php echo $PedidoACadeteria_list->Direccionalidad->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_list->RowCount ?>_PedidoACadeteria_Direccionalidad">
<span<?php echo $PedidoACadeteria_list->Direccionalidad->viewAttributes() ?>><?php echo $PedidoACadeteria_list->Direccionalidad->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($PedidoACadeteria_list->RemitoURL->Visible) { // RemitoURL ?>
		<td data-name="RemitoURL" <?php echo $PedidoACadeteria_list->RemitoURL->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_list->RowCount ?>_PedidoACadeteria_RemitoURL">
<span<?php echo $PedidoACadeteria_list->RemitoURL->viewAttributes() ?>><?php echo $PedidoACadeteria_list->RemitoURL->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($PedidoACadeteria_list->Place1_Nombre->Visible) { // Place1_Nombre ?>
		<td data-name="Place1_Nombre" <?php echo $PedidoACadeteria_list->Place1_Nombre->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_list->RowCount ?>_PedidoACadeteria_Place1_Nombre">
<span<?php echo $PedidoACadeteria_list->Place1_Nombre->viewAttributes() ?>><?php echo $PedidoACadeteria_list->Place1_Nombre->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($PedidoACadeteria_list->Place1_Country->Visible) { // Place1_Country ?>
		<td data-name="Place1_Country" <?php echo $PedidoACadeteria_list->Place1_Country->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_list->RowCount ?>_PedidoACadeteria_Place1_Country">
<span<?php echo $PedidoACadeteria_list->Place1_Country->viewAttributes() ?>><?php echo $PedidoACadeteria_list->Place1_Country->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($PedidoACadeteria_list->Place1_UF->Visible) { // Place1_UF ?>
		<td data-name="Place1_UF" <?php echo $PedidoACadeteria_list->Place1_UF->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_list->RowCount ?>_PedidoACadeteria_Place1_UF">
<span<?php echo $PedidoACadeteria_list->Place1_UF->viewAttributes() ?>><?php echo $PedidoACadeteria_list->Place1_UF->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($PedidoACadeteria_list->Plate1_Lat->Visible) { // Plate1_Lat ?>
		<td data-name="Plate1_Lat" <?php echo $PedidoACadeteria_list->Plate1_Lat->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_list->RowCount ?>_PedidoACadeteria_Plate1_Lat">
<span<?php echo $PedidoACadeteria_list->Plate1_Lat->viewAttributes() ?>><?php echo $PedidoACadeteria_list->Plate1_Lat->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($PedidoACadeteria_list->Place1_Lon->Visible) { // Place1_Lon ?>
		<td data-name="Place1_Lon" <?php echo $PedidoACadeteria_list->Place1_Lon->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_list->RowCount ?>_PedidoACadeteria_Place1_Lon">
<span<?php echo $PedidoACadeteria_list->Place1_Lon->viewAttributes() ?>><?php echo $PedidoACadeteria_list->Place1_Lon->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($PedidoACadeteria_list->Place1_Calle->Visible) { // Place1_Calle ?>
		<td data-name="Place1_Calle" <?php echo $PedidoACadeteria_list->Place1_Calle->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_list->RowCount ?>_PedidoACadeteria_Place1_Calle">
<span<?php echo $PedidoACadeteria_list->Place1_Calle->viewAttributes() ?>><?php echo $PedidoACadeteria_list->Place1_Calle->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($PedidoACadeteria_list->Place1_Numero->Visible) { // Place1_Numero ?>
		<td data-name="Place1_Numero" <?php echo $PedidoACadeteria_list->Place1_Numero->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_list->RowCount ?>_PedidoACadeteria_Place1_Numero">
<span<?php echo $PedidoACadeteria_list->Place1_Numero->viewAttributes() ?>><?php echo $PedidoACadeteria_list->Place1_Numero->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($PedidoACadeteria_list->Place1_Localidad->Visible) { // Place1_Localidad ?>
		<td data-name="Place1_Localidad" <?php echo $PedidoACadeteria_list->Place1_Localidad->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_list->RowCount ?>_PedidoACadeteria_Place1_Localidad">
<span<?php echo $PedidoACadeteria_list->Place1_Localidad->viewAttributes() ?>><?php echo $PedidoACadeteria_list->Place1_Localidad->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($PedidoACadeteria_list->Place1_Piso->Visible) { // Place1_Piso ?>
		<td data-name="Place1_Piso" <?php echo $PedidoACadeteria_list->Place1_Piso->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_list->RowCount ?>_PedidoACadeteria_Place1_Piso">
<span<?php echo $PedidoACadeteria_list->Place1_Piso->viewAttributes() ?>><?php echo $PedidoACadeteria_list->Place1_Piso->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($PedidoACadeteria_list->Place1_Depto->Visible) { // Place1_Depto ?>
		<td data-name="Place1_Depto" <?php echo $PedidoACadeteria_list->Place1_Depto->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_list->RowCount ?>_PedidoACadeteria_Place1_Depto">
<span<?php echo $PedidoACadeteria_list->Place1_Depto->viewAttributes() ?>><?php echo $PedidoACadeteria_list->Place1_Depto->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($PedidoACadeteria_list->Place1_PersonaRecibe->Visible) { // Place1_PersonaRecibe ?>
		<td data-name="Place1_PersonaRecibe" <?php echo $PedidoACadeteria_list->Place1_PersonaRecibe->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_list->RowCount ?>_PedidoACadeteria_Place1_PersonaRecibe">
<span<?php echo $PedidoACadeteria_list->Place1_PersonaRecibe->viewAttributes() ?>><?php echo $PedidoACadeteria_list->Place1_PersonaRecibe->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($PedidoACadeteria_list->Place1_PersonaRecibeTelefono->Visible) { // Place1_PersonaRecibeTelefono ?>
		<td data-name="Place1_PersonaRecibeTelefono" <?php echo $PedidoACadeteria_list->Place1_PersonaRecibeTelefono->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_list->RowCount ?>_PedidoACadeteria_Place1_PersonaRecibeTelefono">
<span<?php echo $PedidoACadeteria_list->Place1_PersonaRecibeTelefono->viewAttributes() ?>><?php echo $PedidoACadeteria_list->Place1_PersonaRecibeTelefono->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($PedidoACadeteria_list->Place2_Nombre->Visible) { // Place2_Nombre ?>
		<td data-name="Place2_Nombre" <?php echo $PedidoACadeteria_list->Place2_Nombre->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_list->RowCount ?>_PedidoACadeteria_Place2_Nombre">
<span<?php echo $PedidoACadeteria_list->Place2_Nombre->viewAttributes() ?>><?php echo $PedidoACadeteria_list->Place2_Nombre->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($PedidoACadeteria_list->Place2_Country->Visible) { // Place2_Country ?>
		<td data-name="Place2_Country" <?php echo $PedidoACadeteria_list->Place2_Country->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_list->RowCount ?>_PedidoACadeteria_Place2_Country">
<span<?php echo $PedidoACadeteria_list->Place2_Country->viewAttributes() ?>><?php echo $PedidoACadeteria_list->Place2_Country->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($PedidoACadeteria_list->Place2_UF->Visible) { // Place2_UF ?>
		<td data-name="Place2_UF" <?php echo $PedidoACadeteria_list->Place2_UF->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_list->RowCount ?>_PedidoACadeteria_Place2_UF">
<span<?php echo $PedidoACadeteria_list->Place2_UF->viewAttributes() ?>><?php echo $PedidoACadeteria_list->Place2_UF->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($PedidoACadeteria_list->Place2_Lat->Visible) { // Place2_Lat ?>
		<td data-name="Place2_Lat" <?php echo $PedidoACadeteria_list->Place2_Lat->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_list->RowCount ?>_PedidoACadeteria_Place2_Lat">
<span<?php echo $PedidoACadeteria_list->Place2_Lat->viewAttributes() ?>><?php echo $PedidoACadeteria_list->Place2_Lat->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($PedidoACadeteria_list->Place2_Lon->Visible) { // Place2_Lon ?>
		<td data-name="Place2_Lon" <?php echo $PedidoACadeteria_list->Place2_Lon->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_list->RowCount ?>_PedidoACadeteria_Place2_Lon">
<span<?php echo $PedidoACadeteria_list->Place2_Lon->viewAttributes() ?>><?php echo $PedidoACadeteria_list->Place2_Lon->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($PedidoACadeteria_list->Place2_Calle->Visible) { // Place2_Calle ?>
		<td data-name="Place2_Calle" <?php echo $PedidoACadeteria_list->Place2_Calle->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_list->RowCount ?>_PedidoACadeteria_Place2_Calle">
<span<?php echo $PedidoACadeteria_list->Place2_Calle->viewAttributes() ?>><?php echo $PedidoACadeteria_list->Place2_Calle->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($PedidoACadeteria_list->Place2_Numero->Visible) { // Place2_Numero ?>
		<td data-name="Place2_Numero" <?php echo $PedidoACadeteria_list->Place2_Numero->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_list->RowCount ?>_PedidoACadeteria_Place2_Numero">
<span<?php echo $PedidoACadeteria_list->Place2_Numero->viewAttributes() ?>><?php echo $PedidoACadeteria_list->Place2_Numero->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($PedidoACadeteria_list->Place2_Localidad->Visible) { // Place2_Localidad ?>
		<td data-name="Place2_Localidad" <?php echo $PedidoACadeteria_list->Place2_Localidad->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_list->RowCount ?>_PedidoACadeteria_Place2_Localidad">
<span<?php echo $PedidoACadeteria_list->Place2_Localidad->viewAttributes() ?>><?php echo $PedidoACadeteria_list->Place2_Localidad->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($PedidoACadeteria_list->Place2_Piso->Visible) { // Place2_Piso ?>
		<td data-name="Place2_Piso" <?php echo $PedidoACadeteria_list->Place2_Piso->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_list->RowCount ?>_PedidoACadeteria_Place2_Piso">
<span<?php echo $PedidoACadeteria_list->Place2_Piso->viewAttributes() ?>><?php echo $PedidoACadeteria_list->Place2_Piso->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($PedidoACadeteria_list->Place2_Depto->Visible) { // Place2_Depto ?>
		<td data-name="Place2_Depto" <?php echo $PedidoACadeteria_list->Place2_Depto->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_list->RowCount ?>_PedidoACadeteria_Place2_Depto">
<span<?php echo $PedidoACadeteria_list->Place2_Depto->viewAttributes() ?>><?php echo $PedidoACadeteria_list->Place2_Depto->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($PedidoACadeteria_list->Place2_PersonaRecibe->Visible) { // Place2_PersonaRecibe ?>
		<td data-name="Place2_PersonaRecibe" <?php echo $PedidoACadeteria_list->Place2_PersonaRecibe->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_list->RowCount ?>_PedidoACadeteria_Place2_PersonaRecibe">
<span<?php echo $PedidoACadeteria_list->Place2_PersonaRecibe->viewAttributes() ?>><?php echo $PedidoACadeteria_list->Place2_PersonaRecibe->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($PedidoACadeteria_list->Place2_PersonaRecibeTelefono->Visible) { // Place2_PersonaRecibeTelefono ?>
		<td data-name="Place2_PersonaRecibeTelefono" <?php echo $PedidoACadeteria_list->Place2_PersonaRecibeTelefono->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_list->RowCount ?>_PedidoACadeteria_Place2_PersonaRecibeTelefono">
<span<?php echo $PedidoACadeteria_list->Place2_PersonaRecibeTelefono->viewAttributes() ?>><?php echo $PedidoACadeteria_list->Place2_PersonaRecibeTelefono->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($PedidoACadeteria_list->ID_Cadeteria->Visible) { // ID_Cadeteria ?>
		<td data-name="ID_Cadeteria" <?php echo $PedidoACadeteria_list->ID_Cadeteria->cellAttributes() ?>>
<span id="el<?php echo $PedidoACadeteria_list->RowCount ?>_PedidoACadeteria_ID_Cadeteria">
<span<?php echo $PedidoACadeteria_list->ID_Cadeteria->viewAttributes() ?>><?php echo $PedidoACadeteria_list->ID_Cadeteria->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$PedidoACadeteria_list->ListOptions->render("body", "right", $PedidoACadeteria_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$PedidoACadeteria_list->isGridAdd())
		$PedidoACadeteria_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$PedidoACadeteria->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($PedidoACadeteria_list->Recordset)
	$PedidoACadeteria_list->Recordset->Close();
?>
<?php if (!$PedidoACadeteria_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$PedidoACadeteria_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $PedidoACadeteria_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $PedidoACadeteria_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($PedidoACadeteria_list->TotalRecords == 0 && !$PedidoACadeteria->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $PedidoACadeteria_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$PedidoACadeteria_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$PedidoACadeteria_list->isExport()) { ?>
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
$PedidoACadeteria_list->terminate();
?>