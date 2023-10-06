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
$Client_list = new Client_list();

// Run the page
$Client_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Client_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$Client_list->isExport()) { ?>
<script>
var fClientlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fClientlist = currentForm = new ew.Form("fClientlist", "list");
	fClientlist.formKeyCountName = '<?php echo $Client_list->FormKeyCountName ?>';
	loadjs.done("fClientlist");
});
var fClientlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fClientlistsrch = currentSearchForm = new ew.Form("fClientlistsrch");

	// Dynamic selection lists
	// Filters

	fClientlistsrch.filterList = <?php echo $Client_list->getFilterList() ?>;
	loadjs.done("fClientlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$Client_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($Client_list->TotalRecords > 0 && $Client_list->ExportOptions->visible()) { ?>
<?php $Client_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Client_list->ImportOptions->visible()) { ?>
<?php $Client_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($Client_list->SearchOptions->visible()) { ?>
<?php $Client_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($Client_list->FilterOptions->visible()) { ?>
<?php $Client_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$Client_list->isExport() || Config("EXPORT_MASTER_RECORD") && $Client_list->isExport("print")) { ?>
<?php
if ($Client_list->DbMasterFilter != "" && $Client->getCurrentMasterTable() == "Restaurant") {
	if ($Client_list->MasterRecordExists) {
		include_once "Restaurantmaster.php";
	}
}
?>
<?php } ?>
<?php
$Client_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$Client_list->isExport() && !$Client->CurrentAction) { ?>
<form name="fClientlistsrch" id="fClientlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fClientlistsrch-search-panel" class="<?php echo $Client_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="Client">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $Client_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($Client_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($Client_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $Client_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($Client_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($Client_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($Client_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($Client_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $Client_list->showPageHeader(); ?>
<?php
$Client_list->showMessage();
?>
<?php if ($Client_list->TotalRecords > 0 || $Client->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Client_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> Client">
<?php if (!$Client_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$Client_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Client_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Client_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fClientlist" id="fClientlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Client">
<?php if ($Client->getCurrentMasterTable() == "Restaurant" && $Client->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="Restaurant">
<input type="hidden" name="fk_ID" value="<?php echo HtmlEncode($Client_list->ID_Restaurant->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_Client" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Client_list->TotalRecords > 0 || $Client_list->isGridEdit()) { ?>
<table id="tbl_Clientlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$Client->RowType = ROWTYPE_HEADER;

// Render list options
$Client_list->renderListOptions();

// Render list options (header, left)
$Client_list->ListOptions->render("header", "left");
?>
<?php if ($Client_list->ID->Visible) { // ID ?>
	<?php if ($Client_list->SortUrl($Client_list->ID) == "") { ?>
		<th data-name="ID" class="<?php echo $Client_list->ID->headerCellClass() ?>"><div id="elh_Client_ID" class="Client_ID"><div class="ew-table-header-caption"><?php echo $Client_list->ID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID" class="<?php echo $Client_list->ID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Client_list->SortUrl($Client_list->ID) ?>', 1);"><div id="elh_Client_ID" class="Client_ID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Client_list->ID->caption() ?></span><span class="ew-table-header-sort"><?php if ($Client_list->ID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Client_list->ID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Client_list->ID_Restaurant->Visible) { // ID_Restaurant ?>
	<?php if ($Client_list->SortUrl($Client_list->ID_Restaurant) == "") { ?>
		<th data-name="ID_Restaurant" class="<?php echo $Client_list->ID_Restaurant->headerCellClass() ?>"><div id="elh_Client_ID_Restaurant" class="Client_ID_Restaurant"><div class="ew-table-header-caption"><?php echo $Client_list->ID_Restaurant->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Restaurant" class="<?php echo $Client_list->ID_Restaurant->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Client_list->SortUrl($Client_list->ID_Restaurant) ?>', 1);"><div id="elh_Client_ID_Restaurant" class="Client_ID_Restaurant">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Client_list->ID_Restaurant->caption() ?></span><span class="ew-table-header-sort"><?php if ($Client_list->ID_Restaurant->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Client_list->ID_Restaurant->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Client_list->FirstName->Visible) { // FirstName ?>
	<?php if ($Client_list->SortUrl($Client_list->FirstName) == "") { ?>
		<th data-name="FirstName" class="<?php echo $Client_list->FirstName->headerCellClass() ?>"><div id="elh_Client_FirstName" class="Client_FirstName"><div class="ew-table-header-caption"><?php echo $Client_list->FirstName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FirstName" class="<?php echo $Client_list->FirstName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Client_list->SortUrl($Client_list->FirstName) ?>', 1);"><div id="elh_Client_FirstName" class="Client_FirstName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Client_list->FirstName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($Client_list->FirstName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Client_list->FirstName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Client_list->LastName->Visible) { // LastName ?>
	<?php if ($Client_list->SortUrl($Client_list->LastName) == "") { ?>
		<th data-name="LastName" class="<?php echo $Client_list->LastName->headerCellClass() ?>"><div id="elh_Client_LastName" class="Client_LastName"><div class="ew-table-header-caption"><?php echo $Client_list->LastName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastName" class="<?php echo $Client_list->LastName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Client_list->SortUrl($Client_list->LastName) ?>', 1);"><div id="elh_Client_LastName" class="Client_LastName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Client_list->LastName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($Client_list->LastName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Client_list->LastName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Client_list->_Email->Visible) { // Email ?>
	<?php if ($Client_list->SortUrl($Client_list->_Email) == "") { ?>
		<th data-name="_Email" class="<?php echo $Client_list->_Email->headerCellClass() ?>"><div id="elh_Client__Email" class="Client__Email"><div class="ew-table-header-caption"><?php echo $Client_list->_Email->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_Email" class="<?php echo $Client_list->_Email->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Client_list->SortUrl($Client_list->_Email) ?>', 1);"><div id="elh_Client__Email" class="Client__Email">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Client_list->_Email->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($Client_list->_Email->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Client_list->_Email->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Client_list->Phone->Visible) { // Phone ?>
	<?php if ($Client_list->SortUrl($Client_list->Phone) == "") { ?>
		<th data-name="Phone" class="<?php echo $Client_list->Phone->headerCellClass() ?>"><div id="elh_Client_Phone" class="Client_Phone"><div class="ew-table-header-caption"><?php echo $Client_list->Phone->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Phone" class="<?php echo $Client_list->Phone->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Client_list->SortUrl($Client_list->Phone) ?>', 1);"><div id="elh_Client_Phone" class="Client_Phone">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Client_list->Phone->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($Client_list->Phone->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Client_list->Phone->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Client_list->Banned->Visible) { // Banned ?>
	<?php if ($Client_list->SortUrl($Client_list->Banned) == "") { ?>
		<th data-name="Banned" class="<?php echo $Client_list->Banned->headerCellClass() ?>"><div id="elh_Client_Banned" class="Client_Banned"><div class="ew-table-header-caption"><?php echo $Client_list->Banned->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Banned" class="<?php echo $Client_list->Banned->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Client_list->SortUrl($Client_list->Banned) ?>', 1);"><div id="elh_Client_Banned" class="Client_Banned">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Client_list->Banned->caption() ?></span><span class="ew-table-header-sort"><?php if ($Client_list->Banned->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Client_list->Banned->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Client_list->ClientToken->Visible) { // ClientToken ?>
	<?php if ($Client_list->SortUrl($Client_list->ClientToken) == "") { ?>
		<th data-name="ClientToken" class="<?php echo $Client_list->ClientToken->headerCellClass() ?>"><div id="elh_Client_ClientToken" class="Client_ClientToken"><div class="ew-table-header-caption"><?php echo $Client_list->ClientToken->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ClientToken" class="<?php echo $Client_list->ClientToken->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Client_list->SortUrl($Client_list->ClientToken) ?>', 1);"><div id="elh_Client_ClientToken" class="Client_ClientToken">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Client_list->ClientToken->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($Client_list->ClientToken->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Client_list->ClientToken->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$Client_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($Client_list->ExportAll && $Client_list->isExport()) {
	$Client_list->StopRecord = $Client_list->TotalRecords;
} else {

	// Set the last record to display
	if ($Client_list->TotalRecords > $Client_list->StartRecord + $Client_list->DisplayRecords - 1)
		$Client_list->StopRecord = $Client_list->StartRecord + $Client_list->DisplayRecords - 1;
	else
		$Client_list->StopRecord = $Client_list->TotalRecords;
}
$Client_list->RecordCount = $Client_list->StartRecord - 1;
if ($Client_list->Recordset && !$Client_list->Recordset->EOF) {
	$Client_list->Recordset->moveFirst();
	$selectLimit = $Client_list->UseSelectLimit;
	if (!$selectLimit && $Client_list->StartRecord > 1)
		$Client_list->Recordset->move($Client_list->StartRecord - 1);
} elseif (!$Client->AllowAddDeleteRow && $Client_list->StopRecord == 0) {
	$Client_list->StopRecord = $Client->GridAddRowCount;
}

// Initialize aggregate
$Client->RowType = ROWTYPE_AGGREGATEINIT;
$Client->resetAttributes();
$Client_list->renderRow();
while ($Client_list->RecordCount < $Client_list->StopRecord) {
	$Client_list->RecordCount++;
	if ($Client_list->RecordCount >= $Client_list->StartRecord) {
		$Client_list->RowCount++;

		// Set up key count
		$Client_list->KeyCount = $Client_list->RowIndex;

		// Init row class and style
		$Client->resetAttributes();
		$Client->CssClass = "";
		if ($Client_list->isGridAdd()) {
		} else {
			$Client_list->loadRowValues($Client_list->Recordset); // Load row values
		}
		$Client->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$Client->RowAttrs->merge(["data-rowindex" => $Client_list->RowCount, "id" => "r" . $Client_list->RowCount . "_Client", "data-rowtype" => $Client->RowType]);

		// Render row
		$Client_list->renderRow();

		// Render list options
		$Client_list->renderListOptions();
?>
	<tr <?php echo $Client->rowAttributes() ?>>
<?php

// Render list options (body, left)
$Client_list->ListOptions->render("body", "left", $Client_list->RowCount);
?>
	<?php if ($Client_list->ID->Visible) { // ID ?>
		<td data-name="ID" <?php echo $Client_list->ID->cellAttributes() ?>>
<span id="el<?php echo $Client_list->RowCount ?>_Client_ID">
<span<?php echo $Client_list->ID->viewAttributes() ?>><?php echo $Client_list->ID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Client_list->ID_Restaurant->Visible) { // ID_Restaurant ?>
		<td data-name="ID_Restaurant" <?php echo $Client_list->ID_Restaurant->cellAttributes() ?>>
<span id="el<?php echo $Client_list->RowCount ?>_Client_ID_Restaurant">
<span<?php echo $Client_list->ID_Restaurant->viewAttributes() ?>><?php echo $Client_list->ID_Restaurant->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Client_list->FirstName->Visible) { // FirstName ?>
		<td data-name="FirstName" <?php echo $Client_list->FirstName->cellAttributes() ?>>
<span id="el<?php echo $Client_list->RowCount ?>_Client_FirstName">
<span<?php echo $Client_list->FirstName->viewAttributes() ?>><?php echo $Client_list->FirstName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Client_list->LastName->Visible) { // LastName ?>
		<td data-name="LastName" <?php echo $Client_list->LastName->cellAttributes() ?>>
<span id="el<?php echo $Client_list->RowCount ?>_Client_LastName">
<span<?php echo $Client_list->LastName->viewAttributes() ?>><?php echo $Client_list->LastName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Client_list->_Email->Visible) { // Email ?>
		<td data-name="_Email" <?php echo $Client_list->_Email->cellAttributes() ?>>
<span id="el<?php echo $Client_list->RowCount ?>_Client__Email">
<span<?php echo $Client_list->_Email->viewAttributes() ?>><?php echo $Client_list->_Email->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Client_list->Phone->Visible) { // Phone ?>
		<td data-name="Phone" <?php echo $Client_list->Phone->cellAttributes() ?>>
<span id="el<?php echo $Client_list->RowCount ?>_Client_Phone">
<span<?php echo $Client_list->Phone->viewAttributes() ?>><?php echo $Client_list->Phone->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Client_list->Banned->Visible) { // Banned ?>
		<td data-name="Banned" <?php echo $Client_list->Banned->cellAttributes() ?>>
<span id="el<?php echo $Client_list->RowCount ?>_Client_Banned">
<span<?php echo $Client_list->Banned->viewAttributes() ?>><?php echo $Client_list->Banned->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Client_list->ClientToken->Visible) { // ClientToken ?>
		<td data-name="ClientToken" <?php echo $Client_list->ClientToken->cellAttributes() ?>>
<span id="el<?php echo $Client_list->RowCount ?>_Client_ClientToken">
<span<?php echo $Client_list->ClientToken->viewAttributes() ?>><?php echo $Client_list->ClientToken->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$Client_list->ListOptions->render("body", "right", $Client_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$Client_list->isGridAdd())
		$Client_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$Client->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($Client_list->Recordset)
	$Client_list->Recordset->Close();
?>
<?php if (!$Client_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$Client_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Client_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Client_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($Client_list->TotalRecords == 0 && !$Client->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $Client_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$Client_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$Client_list->isExport()) { ?>
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
$Client_list->terminate();
?>