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
$Cadete_list = new Cadete_list();

// Run the page
$Cadete_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Cadete_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$Cadete_list->isExport()) { ?>
<script>
var fCadetelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fCadetelist = currentForm = new ew.Form("fCadetelist", "list");
	fCadetelist.formKeyCountName = '<?php echo $Cadete_list->FormKeyCountName ?>';
	loadjs.done("fCadetelist");
});
var fCadetelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fCadetelistsrch = currentSearchForm = new ew.Form("fCadetelistsrch");

	// Dynamic selection lists
	// Filters

	fCadetelistsrch.filterList = <?php echo $Cadete_list->getFilterList() ?>;
	loadjs.done("fCadetelistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$Cadete_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($Cadete_list->TotalRecords > 0 && $Cadete_list->ExportOptions->visible()) { ?>
<?php $Cadete_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Cadete_list->ImportOptions->visible()) { ?>
<?php $Cadete_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($Cadete_list->SearchOptions->visible()) { ?>
<?php $Cadete_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($Cadete_list->FilterOptions->visible()) { ?>
<?php $Cadete_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$Cadete_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$Cadete_list->isExport() && !$Cadete->CurrentAction) { ?>
<form name="fCadetelistsrch" id="fCadetelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fCadetelistsrch-search-panel" class="<?php echo $Cadete_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="Cadete">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $Cadete_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($Cadete_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($Cadete_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $Cadete_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($Cadete_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($Cadete_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($Cadete_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($Cadete_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $Cadete_list->showPageHeader(); ?>
<?php
$Cadete_list->showMessage();
?>
<?php if ($Cadete_list->TotalRecords > 0 || $Cadete->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Cadete_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> Cadete">
<form name="fCadetelist" id="fCadetelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Cadete">
<div id="gmp_Cadete" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Cadete_list->TotalRecords > 0 || $Cadete_list->isGridEdit()) { ?>
<table id="tbl_Cadetelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$Cadete->RowType = ROWTYPE_HEADER;

// Render list options
$Cadete_list->renderListOptions();

// Render list options (header, left)
$Cadete_list->ListOptions->render("header", "left");
?>
<?php if ($Cadete_list->ID->Visible) { // ID ?>
	<?php if ($Cadete_list->SortUrl($Cadete_list->ID) == "") { ?>
		<th data-name="ID" class="<?php echo $Cadete_list->ID->headerCellClass() ?>"><div id="elh_Cadete_ID" class="Cadete_ID"><div class="ew-table-header-caption"><?php echo $Cadete_list->ID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID" class="<?php echo $Cadete_list->ID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Cadete_list->SortUrl($Cadete_list->ID) ?>', 1);"><div id="elh_Cadete_ID" class="Cadete_ID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Cadete_list->ID->caption() ?></span><span class="ew-table-header-sort"><?php if ($Cadete_list->ID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Cadete_list->ID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Cadete_list->FechaCreacion->Visible) { // FechaCreacion ?>
	<?php if ($Cadete_list->SortUrl($Cadete_list->FechaCreacion) == "") { ?>
		<th data-name="FechaCreacion" class="<?php echo $Cadete_list->FechaCreacion->headerCellClass() ?>"><div id="elh_Cadete_FechaCreacion" class="Cadete_FechaCreacion"><div class="ew-table-header-caption"><?php echo $Cadete_list->FechaCreacion->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FechaCreacion" class="<?php echo $Cadete_list->FechaCreacion->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Cadete_list->SortUrl($Cadete_list->FechaCreacion) ?>', 1);"><div id="elh_Cadete_FechaCreacion" class="Cadete_FechaCreacion">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Cadete_list->FechaCreacion->caption() ?></span><span class="ew-table-header-sort"><?php if ($Cadete_list->FechaCreacion->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Cadete_list->FechaCreacion->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Cadete_list->ID_Cadeteria->Visible) { // ID_Cadeteria ?>
	<?php if ($Cadete_list->SortUrl($Cadete_list->ID_Cadeteria) == "") { ?>
		<th data-name="ID_Cadeteria" class="<?php echo $Cadete_list->ID_Cadeteria->headerCellClass() ?>"><div id="elh_Cadete_ID_Cadeteria" class="Cadete_ID_Cadeteria"><div class="ew-table-header-caption"><?php echo $Cadete_list->ID_Cadeteria->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Cadeteria" class="<?php echo $Cadete_list->ID_Cadeteria->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Cadete_list->SortUrl($Cadete_list->ID_Cadeteria) ?>', 1);"><div id="elh_Cadete_ID_Cadeteria" class="Cadete_ID_Cadeteria">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Cadete_list->ID_Cadeteria->caption() ?></span><span class="ew-table-header-sort"><?php if ($Cadete_list->ID_Cadeteria->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Cadete_list->ID_Cadeteria->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Cadete_list->ID_Status->Visible) { // ID_Status ?>
	<?php if ($Cadete_list->SortUrl($Cadete_list->ID_Status) == "") { ?>
		<th data-name="ID_Status" class="<?php echo $Cadete_list->ID_Status->headerCellClass() ?>"><div id="elh_Cadete_ID_Status" class="Cadete_ID_Status"><div class="ew-table-header-caption"><?php echo $Cadete_list->ID_Status->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Status" class="<?php echo $Cadete_list->ID_Status->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Cadete_list->SortUrl($Cadete_list->ID_Status) ?>', 1);"><div id="elh_Cadete_ID_Status" class="Cadete_ID_Status">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Cadete_list->ID_Status->caption() ?></span><span class="ew-table-header-sort"><?php if ($Cadete_list->ID_Status->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Cadete_list->ID_Status->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Cadete_list->ID_CurrentStatus->Visible) { // ID_CurrentStatus ?>
	<?php if ($Cadete_list->SortUrl($Cadete_list->ID_CurrentStatus) == "") { ?>
		<th data-name="ID_CurrentStatus" class="<?php echo $Cadete_list->ID_CurrentStatus->headerCellClass() ?>"><div id="elh_Cadete_ID_CurrentStatus" class="Cadete_ID_CurrentStatus"><div class="ew-table-header-caption"><?php echo $Cadete_list->ID_CurrentStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_CurrentStatus" class="<?php echo $Cadete_list->ID_CurrentStatus->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Cadete_list->SortUrl($Cadete_list->ID_CurrentStatus) ?>', 1);"><div id="elh_Cadete_ID_CurrentStatus" class="Cadete_ID_CurrentStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Cadete_list->ID_CurrentStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($Cadete_list->ID_CurrentStatus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Cadete_list->ID_CurrentStatus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Cadete_list->Nombre->Visible) { // Nombre ?>
	<?php if ($Cadete_list->SortUrl($Cadete_list->Nombre) == "") { ?>
		<th data-name="Nombre" class="<?php echo $Cadete_list->Nombre->headerCellClass() ?>"><div id="elh_Cadete_Nombre" class="Cadete_Nombre"><div class="ew-table-header-caption"><?php echo $Cadete_list->Nombre->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Nombre" class="<?php echo $Cadete_list->Nombre->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Cadete_list->SortUrl($Cadete_list->Nombre) ?>', 1);"><div id="elh_Cadete_Nombre" class="Cadete_Nombre">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Cadete_list->Nombre->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($Cadete_list->Nombre->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Cadete_list->Nombre->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Cadete_list->Apellido->Visible) { // Apellido ?>
	<?php if ($Cadete_list->SortUrl($Cadete_list->Apellido) == "") { ?>
		<th data-name="Apellido" class="<?php echo $Cadete_list->Apellido->headerCellClass() ?>"><div id="elh_Cadete_Apellido" class="Cadete_Apellido"><div class="ew-table-header-caption"><?php echo $Cadete_list->Apellido->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Apellido" class="<?php echo $Cadete_list->Apellido->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Cadete_list->SortUrl($Cadete_list->Apellido) ?>', 1);"><div id="elh_Cadete_Apellido" class="Cadete_Apellido">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Cadete_list->Apellido->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($Cadete_list->Apellido->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Cadete_list->Apellido->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Cadete_list->DNI->Visible) { // DNI ?>
	<?php if ($Cadete_list->SortUrl($Cadete_list->DNI) == "") { ?>
		<th data-name="DNI" class="<?php echo $Cadete_list->DNI->headerCellClass() ?>"><div id="elh_Cadete_DNI" class="Cadete_DNI"><div class="ew-table-header-caption"><?php echo $Cadete_list->DNI->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DNI" class="<?php echo $Cadete_list->DNI->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Cadete_list->SortUrl($Cadete_list->DNI) ?>', 1);"><div id="elh_Cadete_DNI" class="Cadete_DNI">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Cadete_list->DNI->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($Cadete_list->DNI->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Cadete_list->DNI->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Cadete_list->Celular->Visible) { // Celular ?>
	<?php if ($Cadete_list->SortUrl($Cadete_list->Celular) == "") { ?>
		<th data-name="Celular" class="<?php echo $Cadete_list->Celular->headerCellClass() ?>"><div id="elh_Cadete_Celular" class="Cadete_Celular"><div class="ew-table-header-caption"><?php echo $Cadete_list->Celular->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Celular" class="<?php echo $Cadete_list->Celular->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Cadete_list->SortUrl($Cadete_list->Celular) ?>', 1);"><div id="elh_Cadete_Celular" class="Cadete_Celular">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Cadete_list->Celular->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($Cadete_list->Celular->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Cadete_list->Celular->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Cadete_list->Domicilio->Visible) { // Domicilio ?>
	<?php if ($Cadete_list->SortUrl($Cadete_list->Domicilio) == "") { ?>
		<th data-name="Domicilio" class="<?php echo $Cadete_list->Domicilio->headerCellClass() ?>"><div id="elh_Cadete_Domicilio" class="Cadete_Domicilio"><div class="ew-table-header-caption"><?php echo $Cadete_list->Domicilio->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Domicilio" class="<?php echo $Cadete_list->Domicilio->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Cadete_list->SortUrl($Cadete_list->Domicilio) ?>', 1);"><div id="elh_Cadete_Domicilio" class="Cadete_Domicilio">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Cadete_list->Domicilio->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($Cadete_list->Domicilio->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Cadete_list->Domicilio->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Cadete_list->RealLat->Visible) { // RealLat ?>
	<?php if ($Cadete_list->SortUrl($Cadete_list->RealLat) == "") { ?>
		<th data-name="RealLat" class="<?php echo $Cadete_list->RealLat->headerCellClass() ?>"><div id="elh_Cadete_RealLat" class="Cadete_RealLat"><div class="ew-table-header-caption"><?php echo $Cadete_list->RealLat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RealLat" class="<?php echo $Cadete_list->RealLat->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Cadete_list->SortUrl($Cadete_list->RealLat) ?>', 1);"><div id="elh_Cadete_RealLat" class="Cadete_RealLat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Cadete_list->RealLat->caption() ?></span><span class="ew-table-header-sort"><?php if ($Cadete_list->RealLat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Cadete_list->RealLat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Cadete_list->RealLon->Visible) { // RealLon ?>
	<?php if ($Cadete_list->SortUrl($Cadete_list->RealLon) == "") { ?>
		<th data-name="RealLon" class="<?php echo $Cadete_list->RealLon->headerCellClass() ?>"><div id="elh_Cadete_RealLon" class="Cadete_RealLon"><div class="ew-table-header-caption"><?php echo $Cadete_list->RealLon->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RealLon" class="<?php echo $Cadete_list->RealLon->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Cadete_list->SortUrl($Cadete_list->RealLon) ?>', 1);"><div id="elh_Cadete_RealLon" class="Cadete_RealLon">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Cadete_list->RealLon->caption() ?></span><span class="ew-table-header-sort"><?php if ($Cadete_list->RealLon->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Cadete_list->RealLon->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Cadete_list->EstimatedLat->Visible) { // EstimatedLat ?>
	<?php if ($Cadete_list->SortUrl($Cadete_list->EstimatedLat) == "") { ?>
		<th data-name="EstimatedLat" class="<?php echo $Cadete_list->EstimatedLat->headerCellClass() ?>"><div id="elh_Cadete_EstimatedLat" class="Cadete_EstimatedLat"><div class="ew-table-header-caption"><?php echo $Cadete_list->EstimatedLat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EstimatedLat" class="<?php echo $Cadete_list->EstimatedLat->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Cadete_list->SortUrl($Cadete_list->EstimatedLat) ?>', 1);"><div id="elh_Cadete_EstimatedLat" class="Cadete_EstimatedLat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Cadete_list->EstimatedLat->caption() ?></span><span class="ew-table-header-sort"><?php if ($Cadete_list->EstimatedLat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Cadete_list->EstimatedLat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Cadete_list->EstimatedLon->Visible) { // EstimatedLon ?>
	<?php if ($Cadete_list->SortUrl($Cadete_list->EstimatedLon) == "") { ?>
		<th data-name="EstimatedLon" class="<?php echo $Cadete_list->EstimatedLon->headerCellClass() ?>"><div id="elh_Cadete_EstimatedLon" class="Cadete_EstimatedLon"><div class="ew-table-header-caption"><?php echo $Cadete_list->EstimatedLon->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EstimatedLon" class="<?php echo $Cadete_list->EstimatedLon->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Cadete_list->SortUrl($Cadete_list->EstimatedLon) ?>', 1);"><div id="elh_Cadete_EstimatedLon" class="Cadete_EstimatedLon">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Cadete_list->EstimatedLon->caption() ?></span><span class="ew-table-header-sort"><?php if ($Cadete_list->EstimatedLon->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Cadete_list->EstimatedLon->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Cadete_list->LUDesde->Visible) { // LUDesde ?>
	<?php if ($Cadete_list->SortUrl($Cadete_list->LUDesde) == "") { ?>
		<th data-name="LUDesde" class="<?php echo $Cadete_list->LUDesde->headerCellClass() ?>"><div id="elh_Cadete_LUDesde" class="Cadete_LUDesde"><div class="ew-table-header-caption"><?php echo $Cadete_list->LUDesde->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LUDesde" class="<?php echo $Cadete_list->LUDesde->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Cadete_list->SortUrl($Cadete_list->LUDesde) ?>', 1);"><div id="elh_Cadete_LUDesde" class="Cadete_LUDesde">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Cadete_list->LUDesde->caption() ?></span><span class="ew-table-header-sort"><?php if ($Cadete_list->LUDesde->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Cadete_list->LUDesde->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Cadete_list->LUHasta->Visible) { // LUHasta ?>
	<?php if ($Cadete_list->SortUrl($Cadete_list->LUHasta) == "") { ?>
		<th data-name="LUHasta" class="<?php echo $Cadete_list->LUHasta->headerCellClass() ?>"><div id="elh_Cadete_LUHasta" class="Cadete_LUHasta"><div class="ew-table-header-caption"><?php echo $Cadete_list->LUHasta->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LUHasta" class="<?php echo $Cadete_list->LUHasta->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Cadete_list->SortUrl($Cadete_list->LUHasta) ?>', 1);"><div id="elh_Cadete_LUHasta" class="Cadete_LUHasta">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Cadete_list->LUHasta->caption() ?></span><span class="ew-table-header-sort"><?php if ($Cadete_list->LUHasta->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Cadete_list->LUHasta->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Cadete_list->MADesde->Visible) { // MADesde ?>
	<?php if ($Cadete_list->SortUrl($Cadete_list->MADesde) == "") { ?>
		<th data-name="MADesde" class="<?php echo $Cadete_list->MADesde->headerCellClass() ?>"><div id="elh_Cadete_MADesde" class="Cadete_MADesde"><div class="ew-table-header-caption"><?php echo $Cadete_list->MADesde->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MADesde" class="<?php echo $Cadete_list->MADesde->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Cadete_list->SortUrl($Cadete_list->MADesde) ?>', 1);"><div id="elh_Cadete_MADesde" class="Cadete_MADesde">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Cadete_list->MADesde->caption() ?></span><span class="ew-table-header-sort"><?php if ($Cadete_list->MADesde->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Cadete_list->MADesde->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Cadete_list->MAHasta->Visible) { // MAHasta ?>
	<?php if ($Cadete_list->SortUrl($Cadete_list->MAHasta) == "") { ?>
		<th data-name="MAHasta" class="<?php echo $Cadete_list->MAHasta->headerCellClass() ?>"><div id="elh_Cadete_MAHasta" class="Cadete_MAHasta"><div class="ew-table-header-caption"><?php echo $Cadete_list->MAHasta->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MAHasta" class="<?php echo $Cadete_list->MAHasta->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Cadete_list->SortUrl($Cadete_list->MAHasta) ?>', 1);"><div id="elh_Cadete_MAHasta" class="Cadete_MAHasta">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Cadete_list->MAHasta->caption() ?></span><span class="ew-table-header-sort"><?php if ($Cadete_list->MAHasta->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Cadete_list->MAHasta->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Cadete_list->MIEDesde->Visible) { // MIEDesde ?>
	<?php if ($Cadete_list->SortUrl($Cadete_list->MIEDesde) == "") { ?>
		<th data-name="MIEDesde" class="<?php echo $Cadete_list->MIEDesde->headerCellClass() ?>"><div id="elh_Cadete_MIEDesde" class="Cadete_MIEDesde"><div class="ew-table-header-caption"><?php echo $Cadete_list->MIEDesde->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MIEDesde" class="<?php echo $Cadete_list->MIEDesde->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Cadete_list->SortUrl($Cadete_list->MIEDesde) ?>', 1);"><div id="elh_Cadete_MIEDesde" class="Cadete_MIEDesde">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Cadete_list->MIEDesde->caption() ?></span><span class="ew-table-header-sort"><?php if ($Cadete_list->MIEDesde->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Cadete_list->MIEDesde->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Cadete_list->MIEHasta->Visible) { // MIEHasta ?>
	<?php if ($Cadete_list->SortUrl($Cadete_list->MIEHasta) == "") { ?>
		<th data-name="MIEHasta" class="<?php echo $Cadete_list->MIEHasta->headerCellClass() ?>"><div id="elh_Cadete_MIEHasta" class="Cadete_MIEHasta"><div class="ew-table-header-caption"><?php echo $Cadete_list->MIEHasta->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MIEHasta" class="<?php echo $Cadete_list->MIEHasta->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Cadete_list->SortUrl($Cadete_list->MIEHasta) ?>', 1);"><div id="elh_Cadete_MIEHasta" class="Cadete_MIEHasta">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Cadete_list->MIEHasta->caption() ?></span><span class="ew-table-header-sort"><?php if ($Cadete_list->MIEHasta->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Cadete_list->MIEHasta->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Cadete_list->JUEDesde->Visible) { // JUEDesde ?>
	<?php if ($Cadete_list->SortUrl($Cadete_list->JUEDesde) == "") { ?>
		<th data-name="JUEDesde" class="<?php echo $Cadete_list->JUEDesde->headerCellClass() ?>"><div id="elh_Cadete_JUEDesde" class="Cadete_JUEDesde"><div class="ew-table-header-caption"><?php echo $Cadete_list->JUEDesde->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="JUEDesde" class="<?php echo $Cadete_list->JUEDesde->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Cadete_list->SortUrl($Cadete_list->JUEDesde) ?>', 1);"><div id="elh_Cadete_JUEDesde" class="Cadete_JUEDesde">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Cadete_list->JUEDesde->caption() ?></span><span class="ew-table-header-sort"><?php if ($Cadete_list->JUEDesde->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Cadete_list->JUEDesde->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Cadete_list->JUEHasta->Visible) { // JUEHasta ?>
	<?php if ($Cadete_list->SortUrl($Cadete_list->JUEHasta) == "") { ?>
		<th data-name="JUEHasta" class="<?php echo $Cadete_list->JUEHasta->headerCellClass() ?>"><div id="elh_Cadete_JUEHasta" class="Cadete_JUEHasta"><div class="ew-table-header-caption"><?php echo $Cadete_list->JUEHasta->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="JUEHasta" class="<?php echo $Cadete_list->JUEHasta->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Cadete_list->SortUrl($Cadete_list->JUEHasta) ?>', 1);"><div id="elh_Cadete_JUEHasta" class="Cadete_JUEHasta">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Cadete_list->JUEHasta->caption() ?></span><span class="ew-table-header-sort"><?php if ($Cadete_list->JUEHasta->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Cadete_list->JUEHasta->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Cadete_list->VIEDesde->Visible) { // VIEDesde ?>
	<?php if ($Cadete_list->SortUrl($Cadete_list->VIEDesde) == "") { ?>
		<th data-name="VIEDesde" class="<?php echo $Cadete_list->VIEDesde->headerCellClass() ?>"><div id="elh_Cadete_VIEDesde" class="Cadete_VIEDesde"><div class="ew-table-header-caption"><?php echo $Cadete_list->VIEDesde->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="VIEDesde" class="<?php echo $Cadete_list->VIEDesde->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Cadete_list->SortUrl($Cadete_list->VIEDesde) ?>', 1);"><div id="elh_Cadete_VIEDesde" class="Cadete_VIEDesde">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Cadete_list->VIEDesde->caption() ?></span><span class="ew-table-header-sort"><?php if ($Cadete_list->VIEDesde->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Cadete_list->VIEDesde->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Cadete_list->VIEHasta->Visible) { // VIEHasta ?>
	<?php if ($Cadete_list->SortUrl($Cadete_list->VIEHasta) == "") { ?>
		<th data-name="VIEHasta" class="<?php echo $Cadete_list->VIEHasta->headerCellClass() ?>"><div id="elh_Cadete_VIEHasta" class="Cadete_VIEHasta"><div class="ew-table-header-caption"><?php echo $Cadete_list->VIEHasta->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="VIEHasta" class="<?php echo $Cadete_list->VIEHasta->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Cadete_list->SortUrl($Cadete_list->VIEHasta) ?>', 1);"><div id="elh_Cadete_VIEHasta" class="Cadete_VIEHasta">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Cadete_list->VIEHasta->caption() ?></span><span class="ew-table-header-sort"><?php if ($Cadete_list->VIEHasta->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Cadete_list->VIEHasta->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Cadete_list->SABDesde->Visible) { // SABDesde ?>
	<?php if ($Cadete_list->SortUrl($Cadete_list->SABDesde) == "") { ?>
		<th data-name="SABDesde" class="<?php echo $Cadete_list->SABDesde->headerCellClass() ?>"><div id="elh_Cadete_SABDesde" class="Cadete_SABDesde"><div class="ew-table-header-caption"><?php echo $Cadete_list->SABDesde->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SABDesde" class="<?php echo $Cadete_list->SABDesde->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Cadete_list->SortUrl($Cadete_list->SABDesde) ?>', 1);"><div id="elh_Cadete_SABDesde" class="Cadete_SABDesde">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Cadete_list->SABDesde->caption() ?></span><span class="ew-table-header-sort"><?php if ($Cadete_list->SABDesde->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Cadete_list->SABDesde->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Cadete_list->SABHasta->Visible) { // SABHasta ?>
	<?php if ($Cadete_list->SortUrl($Cadete_list->SABHasta) == "") { ?>
		<th data-name="SABHasta" class="<?php echo $Cadete_list->SABHasta->headerCellClass() ?>"><div id="elh_Cadete_SABHasta" class="Cadete_SABHasta"><div class="ew-table-header-caption"><?php echo $Cadete_list->SABHasta->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SABHasta" class="<?php echo $Cadete_list->SABHasta->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Cadete_list->SortUrl($Cadete_list->SABHasta) ?>', 1);"><div id="elh_Cadete_SABHasta" class="Cadete_SABHasta">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Cadete_list->SABHasta->caption() ?></span><span class="ew-table-header-sort"><?php if ($Cadete_list->SABHasta->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Cadete_list->SABHasta->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Cadete_list->DOMDesde->Visible) { // DOMDesde ?>
	<?php if ($Cadete_list->SortUrl($Cadete_list->DOMDesde) == "") { ?>
		<th data-name="DOMDesde" class="<?php echo $Cadete_list->DOMDesde->headerCellClass() ?>"><div id="elh_Cadete_DOMDesde" class="Cadete_DOMDesde"><div class="ew-table-header-caption"><?php echo $Cadete_list->DOMDesde->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DOMDesde" class="<?php echo $Cadete_list->DOMDesde->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Cadete_list->SortUrl($Cadete_list->DOMDesde) ?>', 1);"><div id="elh_Cadete_DOMDesde" class="Cadete_DOMDesde">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Cadete_list->DOMDesde->caption() ?></span><span class="ew-table-header-sort"><?php if ($Cadete_list->DOMDesde->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Cadete_list->DOMDesde->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Cadete_list->DOMHasta->Visible) { // DOMHasta ?>
	<?php if ($Cadete_list->SortUrl($Cadete_list->DOMHasta) == "") { ?>
		<th data-name="DOMHasta" class="<?php echo $Cadete_list->DOMHasta->headerCellClass() ?>"><div id="elh_Cadete_DOMHasta" class="Cadete_DOMHasta"><div class="ew-table-header-caption"><?php echo $Cadete_list->DOMHasta->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DOMHasta" class="<?php echo $Cadete_list->DOMHasta->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Cadete_list->SortUrl($Cadete_list->DOMHasta) ?>', 1);"><div id="elh_Cadete_DOMHasta" class="Cadete_DOMHasta">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Cadete_list->DOMHasta->caption() ?></span><span class="ew-table-header-sort"><?php if ($Cadete_list->DOMHasta->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Cadete_list->DOMHasta->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Cadete_list->Foto->Visible) { // Foto ?>
	<?php if ($Cadete_list->SortUrl($Cadete_list->Foto) == "") { ?>
		<th data-name="Foto" class="<?php echo $Cadete_list->Foto->headerCellClass() ?>"><div id="elh_Cadete_Foto" class="Cadete_Foto"><div class="ew-table-header-caption"><?php echo $Cadete_list->Foto->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Foto" class="<?php echo $Cadete_list->Foto->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Cadete_list->SortUrl($Cadete_list->Foto) ?>', 1);"><div id="elh_Cadete_Foto" class="Cadete_Foto">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Cadete_list->Foto->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($Cadete_list->Foto->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Cadete_list->Foto->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$Cadete_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($Cadete_list->ExportAll && $Cadete_list->isExport()) {
	$Cadete_list->StopRecord = $Cadete_list->TotalRecords;
} else {

	// Set the last record to display
	if ($Cadete_list->TotalRecords > $Cadete_list->StartRecord + $Cadete_list->DisplayRecords - 1)
		$Cadete_list->StopRecord = $Cadete_list->StartRecord + $Cadete_list->DisplayRecords - 1;
	else
		$Cadete_list->StopRecord = $Cadete_list->TotalRecords;
}
$Cadete_list->RecordCount = $Cadete_list->StartRecord - 1;
if ($Cadete_list->Recordset && !$Cadete_list->Recordset->EOF) {
	$Cadete_list->Recordset->moveFirst();
	$selectLimit = $Cadete_list->UseSelectLimit;
	if (!$selectLimit && $Cadete_list->StartRecord > 1)
		$Cadete_list->Recordset->move($Cadete_list->StartRecord - 1);
} elseif (!$Cadete->AllowAddDeleteRow && $Cadete_list->StopRecord == 0) {
	$Cadete_list->StopRecord = $Cadete->GridAddRowCount;
}

// Initialize aggregate
$Cadete->RowType = ROWTYPE_AGGREGATEINIT;
$Cadete->resetAttributes();
$Cadete_list->renderRow();
while ($Cadete_list->RecordCount < $Cadete_list->StopRecord) {
	$Cadete_list->RecordCount++;
	if ($Cadete_list->RecordCount >= $Cadete_list->StartRecord) {
		$Cadete_list->RowCount++;

		// Set up key count
		$Cadete_list->KeyCount = $Cadete_list->RowIndex;

		// Init row class and style
		$Cadete->resetAttributes();
		$Cadete->CssClass = "";
		if ($Cadete_list->isGridAdd()) {
		} else {
			$Cadete_list->loadRowValues($Cadete_list->Recordset); // Load row values
		}
		$Cadete->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$Cadete->RowAttrs->merge(["data-rowindex" => $Cadete_list->RowCount, "id" => "r" . $Cadete_list->RowCount . "_Cadete", "data-rowtype" => $Cadete->RowType]);

		// Render row
		$Cadete_list->renderRow();

		// Render list options
		$Cadete_list->renderListOptions();
?>
	<tr <?php echo $Cadete->rowAttributes() ?>>
<?php

// Render list options (body, left)
$Cadete_list->ListOptions->render("body", "left", $Cadete_list->RowCount);
?>
	<?php if ($Cadete_list->ID->Visible) { // ID ?>
		<td data-name="ID" <?php echo $Cadete_list->ID->cellAttributes() ?>>
<span id="el<?php echo $Cadete_list->RowCount ?>_Cadete_ID">
<span<?php echo $Cadete_list->ID->viewAttributes() ?>><?php echo $Cadete_list->ID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Cadete_list->FechaCreacion->Visible) { // FechaCreacion ?>
		<td data-name="FechaCreacion" <?php echo $Cadete_list->FechaCreacion->cellAttributes() ?>>
<span id="el<?php echo $Cadete_list->RowCount ?>_Cadete_FechaCreacion">
<span<?php echo $Cadete_list->FechaCreacion->viewAttributes() ?>><?php echo $Cadete_list->FechaCreacion->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Cadete_list->ID_Cadeteria->Visible) { // ID_Cadeteria ?>
		<td data-name="ID_Cadeteria" <?php echo $Cadete_list->ID_Cadeteria->cellAttributes() ?>>
<span id="el<?php echo $Cadete_list->RowCount ?>_Cadete_ID_Cadeteria">
<span<?php echo $Cadete_list->ID_Cadeteria->viewAttributes() ?>><?php echo $Cadete_list->ID_Cadeteria->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Cadete_list->ID_Status->Visible) { // ID_Status ?>
		<td data-name="ID_Status" <?php echo $Cadete_list->ID_Status->cellAttributes() ?>>
<span id="el<?php echo $Cadete_list->RowCount ?>_Cadete_ID_Status">
<span<?php echo $Cadete_list->ID_Status->viewAttributes() ?>><?php echo $Cadete_list->ID_Status->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Cadete_list->ID_CurrentStatus->Visible) { // ID_CurrentStatus ?>
		<td data-name="ID_CurrentStatus" <?php echo $Cadete_list->ID_CurrentStatus->cellAttributes() ?>>
<span id="el<?php echo $Cadete_list->RowCount ?>_Cadete_ID_CurrentStatus">
<span<?php echo $Cadete_list->ID_CurrentStatus->viewAttributes() ?>><?php echo $Cadete_list->ID_CurrentStatus->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Cadete_list->Nombre->Visible) { // Nombre ?>
		<td data-name="Nombre" <?php echo $Cadete_list->Nombre->cellAttributes() ?>>
<span id="el<?php echo $Cadete_list->RowCount ?>_Cadete_Nombre">
<span<?php echo $Cadete_list->Nombre->viewAttributes() ?>><?php echo $Cadete_list->Nombre->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Cadete_list->Apellido->Visible) { // Apellido ?>
		<td data-name="Apellido" <?php echo $Cadete_list->Apellido->cellAttributes() ?>>
<span id="el<?php echo $Cadete_list->RowCount ?>_Cadete_Apellido">
<span<?php echo $Cadete_list->Apellido->viewAttributes() ?>><?php echo $Cadete_list->Apellido->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Cadete_list->DNI->Visible) { // DNI ?>
		<td data-name="DNI" <?php echo $Cadete_list->DNI->cellAttributes() ?>>
<span id="el<?php echo $Cadete_list->RowCount ?>_Cadete_DNI">
<span<?php echo $Cadete_list->DNI->viewAttributes() ?>><?php echo $Cadete_list->DNI->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Cadete_list->Celular->Visible) { // Celular ?>
		<td data-name="Celular" <?php echo $Cadete_list->Celular->cellAttributes() ?>>
<span id="el<?php echo $Cadete_list->RowCount ?>_Cadete_Celular">
<span<?php echo $Cadete_list->Celular->viewAttributes() ?>><?php echo $Cadete_list->Celular->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Cadete_list->Domicilio->Visible) { // Domicilio ?>
		<td data-name="Domicilio" <?php echo $Cadete_list->Domicilio->cellAttributes() ?>>
<span id="el<?php echo $Cadete_list->RowCount ?>_Cadete_Domicilio">
<span<?php echo $Cadete_list->Domicilio->viewAttributes() ?>><?php echo $Cadete_list->Domicilio->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Cadete_list->RealLat->Visible) { // RealLat ?>
		<td data-name="RealLat" <?php echo $Cadete_list->RealLat->cellAttributes() ?>>
<span id="el<?php echo $Cadete_list->RowCount ?>_Cadete_RealLat">
<span<?php echo $Cadete_list->RealLat->viewAttributes() ?>><?php echo $Cadete_list->RealLat->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Cadete_list->RealLon->Visible) { // RealLon ?>
		<td data-name="RealLon" <?php echo $Cadete_list->RealLon->cellAttributes() ?>>
<span id="el<?php echo $Cadete_list->RowCount ?>_Cadete_RealLon">
<span<?php echo $Cadete_list->RealLon->viewAttributes() ?>><?php echo $Cadete_list->RealLon->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Cadete_list->EstimatedLat->Visible) { // EstimatedLat ?>
		<td data-name="EstimatedLat" <?php echo $Cadete_list->EstimatedLat->cellAttributes() ?>>
<span id="el<?php echo $Cadete_list->RowCount ?>_Cadete_EstimatedLat">
<span<?php echo $Cadete_list->EstimatedLat->viewAttributes() ?>><?php echo $Cadete_list->EstimatedLat->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Cadete_list->EstimatedLon->Visible) { // EstimatedLon ?>
		<td data-name="EstimatedLon" <?php echo $Cadete_list->EstimatedLon->cellAttributes() ?>>
<span id="el<?php echo $Cadete_list->RowCount ?>_Cadete_EstimatedLon">
<span<?php echo $Cadete_list->EstimatedLon->viewAttributes() ?>><?php echo $Cadete_list->EstimatedLon->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Cadete_list->LUDesde->Visible) { // LUDesde ?>
		<td data-name="LUDesde" <?php echo $Cadete_list->LUDesde->cellAttributes() ?>>
<span id="el<?php echo $Cadete_list->RowCount ?>_Cadete_LUDesde">
<span<?php echo $Cadete_list->LUDesde->viewAttributes() ?>><?php echo $Cadete_list->LUDesde->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Cadete_list->LUHasta->Visible) { // LUHasta ?>
		<td data-name="LUHasta" <?php echo $Cadete_list->LUHasta->cellAttributes() ?>>
<span id="el<?php echo $Cadete_list->RowCount ?>_Cadete_LUHasta">
<span<?php echo $Cadete_list->LUHasta->viewAttributes() ?>><?php echo $Cadete_list->LUHasta->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Cadete_list->MADesde->Visible) { // MADesde ?>
		<td data-name="MADesde" <?php echo $Cadete_list->MADesde->cellAttributes() ?>>
<span id="el<?php echo $Cadete_list->RowCount ?>_Cadete_MADesde">
<span<?php echo $Cadete_list->MADesde->viewAttributes() ?>><?php echo $Cadete_list->MADesde->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Cadete_list->MAHasta->Visible) { // MAHasta ?>
		<td data-name="MAHasta" <?php echo $Cadete_list->MAHasta->cellAttributes() ?>>
<span id="el<?php echo $Cadete_list->RowCount ?>_Cadete_MAHasta">
<span<?php echo $Cadete_list->MAHasta->viewAttributes() ?>><?php echo $Cadete_list->MAHasta->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Cadete_list->MIEDesde->Visible) { // MIEDesde ?>
		<td data-name="MIEDesde" <?php echo $Cadete_list->MIEDesde->cellAttributes() ?>>
<span id="el<?php echo $Cadete_list->RowCount ?>_Cadete_MIEDesde">
<span<?php echo $Cadete_list->MIEDesde->viewAttributes() ?>><?php echo $Cadete_list->MIEDesde->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Cadete_list->MIEHasta->Visible) { // MIEHasta ?>
		<td data-name="MIEHasta" <?php echo $Cadete_list->MIEHasta->cellAttributes() ?>>
<span id="el<?php echo $Cadete_list->RowCount ?>_Cadete_MIEHasta">
<span<?php echo $Cadete_list->MIEHasta->viewAttributes() ?>><?php echo $Cadete_list->MIEHasta->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Cadete_list->JUEDesde->Visible) { // JUEDesde ?>
		<td data-name="JUEDesde" <?php echo $Cadete_list->JUEDesde->cellAttributes() ?>>
<span id="el<?php echo $Cadete_list->RowCount ?>_Cadete_JUEDesde">
<span<?php echo $Cadete_list->JUEDesde->viewAttributes() ?>><?php echo $Cadete_list->JUEDesde->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Cadete_list->JUEHasta->Visible) { // JUEHasta ?>
		<td data-name="JUEHasta" <?php echo $Cadete_list->JUEHasta->cellAttributes() ?>>
<span id="el<?php echo $Cadete_list->RowCount ?>_Cadete_JUEHasta">
<span<?php echo $Cadete_list->JUEHasta->viewAttributes() ?>><?php echo $Cadete_list->JUEHasta->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Cadete_list->VIEDesde->Visible) { // VIEDesde ?>
		<td data-name="VIEDesde" <?php echo $Cadete_list->VIEDesde->cellAttributes() ?>>
<span id="el<?php echo $Cadete_list->RowCount ?>_Cadete_VIEDesde">
<span<?php echo $Cadete_list->VIEDesde->viewAttributes() ?>><?php echo $Cadete_list->VIEDesde->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Cadete_list->VIEHasta->Visible) { // VIEHasta ?>
		<td data-name="VIEHasta" <?php echo $Cadete_list->VIEHasta->cellAttributes() ?>>
<span id="el<?php echo $Cadete_list->RowCount ?>_Cadete_VIEHasta">
<span<?php echo $Cadete_list->VIEHasta->viewAttributes() ?>><?php echo $Cadete_list->VIEHasta->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Cadete_list->SABDesde->Visible) { // SABDesde ?>
		<td data-name="SABDesde" <?php echo $Cadete_list->SABDesde->cellAttributes() ?>>
<span id="el<?php echo $Cadete_list->RowCount ?>_Cadete_SABDesde">
<span<?php echo $Cadete_list->SABDesde->viewAttributes() ?>><?php echo $Cadete_list->SABDesde->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Cadete_list->SABHasta->Visible) { // SABHasta ?>
		<td data-name="SABHasta" <?php echo $Cadete_list->SABHasta->cellAttributes() ?>>
<span id="el<?php echo $Cadete_list->RowCount ?>_Cadete_SABHasta">
<span<?php echo $Cadete_list->SABHasta->viewAttributes() ?>><?php echo $Cadete_list->SABHasta->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Cadete_list->DOMDesde->Visible) { // DOMDesde ?>
		<td data-name="DOMDesde" <?php echo $Cadete_list->DOMDesde->cellAttributes() ?>>
<span id="el<?php echo $Cadete_list->RowCount ?>_Cadete_DOMDesde">
<span<?php echo $Cadete_list->DOMDesde->viewAttributes() ?>><?php echo $Cadete_list->DOMDesde->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Cadete_list->DOMHasta->Visible) { // DOMHasta ?>
		<td data-name="DOMHasta" <?php echo $Cadete_list->DOMHasta->cellAttributes() ?>>
<span id="el<?php echo $Cadete_list->RowCount ?>_Cadete_DOMHasta">
<span<?php echo $Cadete_list->DOMHasta->viewAttributes() ?>><?php echo $Cadete_list->DOMHasta->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Cadete_list->Foto->Visible) { // Foto ?>
		<td data-name="Foto" <?php echo $Cadete_list->Foto->cellAttributes() ?>>
<span id="el<?php echo $Cadete_list->RowCount ?>_Cadete_Foto">
<span<?php echo $Cadete_list->Foto->viewAttributes() ?>><?php echo $Cadete_list->Foto->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$Cadete_list->ListOptions->render("body", "right", $Cadete_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$Cadete_list->isGridAdd())
		$Cadete_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$Cadete->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($Cadete_list->Recordset)
	$Cadete_list->Recordset->Close();
?>
<?php if (!$Cadete_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$Cadete_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Cadete_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Cadete_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($Cadete_list->TotalRecords == 0 && !$Cadete->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $Cadete_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$Cadete_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$Cadete_list->isExport()) { ?>
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
$Cadete_list->terminate();
?>