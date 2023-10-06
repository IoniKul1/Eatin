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
$Pedido_list = new Pedido_list();

// Run the page
$Pedido_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Pedido_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$Pedido_list->isExport()) { ?>
<script>
var fPedidolist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fPedidolist = currentForm = new ew.Form("fPedidolist", "list");
	fPedidolist.formKeyCountName = '<?php echo $Pedido_list->FormKeyCountName ?>';
	loadjs.done("fPedidolist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$Pedido_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($Pedido_list->TotalRecords > 0 && $Pedido_list->ExportOptions->visible()) { ?>
<?php $Pedido_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Pedido_list->ImportOptions->visible()) { ?>
<?php $Pedido_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$Pedido_list->isExport() || Config("EXPORT_MASTER_RECORD") && $Pedido_list->isExport("print")) { ?>
<?php
if ($Pedido_list->DbMasterFilter != "" && $Pedido->getCurrentMasterTable() == "Client") {
	if ($Pedido_list->MasterRecordExists) {
		include_once "Clientmaster.php";
	}
}
?>
<?php } ?>
<?php
$Pedido_list->renderOtherOptions();
?>
<?php $Pedido_list->showPageHeader(); ?>
<?php
$Pedido_list->showMessage();
?>
<?php if ($Pedido_list->TotalRecords > 0 || $Pedido->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Pedido_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> Pedido">
<?php if (!$Pedido_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$Pedido_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Pedido_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Pedido_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fPedidolist" id="fPedidolist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Pedido">
<?php if ($Pedido->getCurrentMasterTable() == "Client" && $Pedido->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="Client">
<input type="hidden" name="fk_ID" value="<?php echo HtmlEncode($Pedido_list->ID_Client->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_Pedido" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Pedido_list->TotalRecords > 0 || $Pedido_list->isGridEdit()) { ?>
<table id="tbl_Pedidolist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$Pedido->RowType = ROWTYPE_HEADER;

// Render list options
$Pedido_list->renderListOptions();

// Render list options (header, left)
$Pedido_list->ListOptions->render("header", "left");
?>
<?php if ($Pedido_list->ID->Visible) { // ID ?>
	<?php if ($Pedido_list->SortUrl($Pedido_list->ID) == "") { ?>
		<th data-name="ID" class="<?php echo $Pedido_list->ID->headerCellClass() ?>"><div id="elh_Pedido_ID" class="Pedido_ID"><div class="ew-table-header-caption"><?php echo $Pedido_list->ID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID" class="<?php echo $Pedido_list->ID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Pedido_list->SortUrl($Pedido_list->ID) ?>', 1);"><div id="elh_Pedido_ID" class="Pedido_ID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Pedido_list->ID->caption() ?></span><span class="ew-table-header-sort"><?php if ($Pedido_list->ID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Pedido_list->ID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Pedido_list->ID_Client->Visible) { // ID_Client ?>
	<?php if ($Pedido_list->SortUrl($Pedido_list->ID_Client) == "") { ?>
		<th data-name="ID_Client" class="<?php echo $Pedido_list->ID_Client->headerCellClass() ?>"><div id="elh_Pedido_ID_Client" class="Pedido_ID_Client"><div class="ew-table-header-caption"><?php echo $Pedido_list->ID_Client->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Client" class="<?php echo $Pedido_list->ID_Client->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Pedido_list->SortUrl($Pedido_list->ID_Client) ?>', 1);"><div id="elh_Pedido_ID_Client" class="Pedido_ID_Client">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Pedido_list->ID_Client->caption() ?></span><span class="ew-table-header-sort"><?php if ($Pedido_list->ID_Client->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Pedido_list->ID_Client->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Pedido_list->ID_Status->Visible) { // ID_Status ?>
	<?php if ($Pedido_list->SortUrl($Pedido_list->ID_Status) == "") { ?>
		<th data-name="ID_Status" class="<?php echo $Pedido_list->ID_Status->headerCellClass() ?>"><div id="elh_Pedido_ID_Status" class="Pedido_ID_Status"><div class="ew-table-header-caption"><?php echo $Pedido_list->ID_Status->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Status" class="<?php echo $Pedido_list->ID_Status->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Pedido_list->SortUrl($Pedido_list->ID_Status) ?>', 1);"><div id="elh_Pedido_ID_Status" class="Pedido_ID_Status">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Pedido_list->ID_Status->caption() ?></span><span class="ew-table-header-sort"><?php if ($Pedido_list->ID_Status->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Pedido_list->ID_Status->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Pedido_list->ID_Restaurant->Visible) { // ID_Restaurant ?>
	<?php if ($Pedido_list->SortUrl($Pedido_list->ID_Restaurant) == "") { ?>
		<th data-name="ID_Restaurant" class="<?php echo $Pedido_list->ID_Restaurant->headerCellClass() ?>"><div id="elh_Pedido_ID_Restaurant" class="Pedido_ID_Restaurant"><div class="ew-table-header-caption"><?php echo $Pedido_list->ID_Restaurant->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Restaurant" class="<?php echo $Pedido_list->ID_Restaurant->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Pedido_list->SortUrl($Pedido_list->ID_Restaurant) ?>', 1);"><div id="elh_Pedido_ID_Restaurant" class="Pedido_ID_Restaurant">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Pedido_list->ID_Restaurant->caption() ?></span><span class="ew-table-header-sort"><?php if ($Pedido_list->ID_Restaurant->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Pedido_list->ID_Restaurant->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Pedido_list->DateCreation->Visible) { // DateCreation ?>
	<?php if ($Pedido_list->SortUrl($Pedido_list->DateCreation) == "") { ?>
		<th data-name="DateCreation" class="<?php echo $Pedido_list->DateCreation->headerCellClass() ?>"><div id="elh_Pedido_DateCreation" class="Pedido_DateCreation"><div class="ew-table-header-caption"><?php echo $Pedido_list->DateCreation->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateCreation" class="<?php echo $Pedido_list->DateCreation->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Pedido_list->SortUrl($Pedido_list->DateCreation) ?>', 1);"><div id="elh_Pedido_DateCreation" class="Pedido_DateCreation">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Pedido_list->DateCreation->caption() ?></span><span class="ew-table-header-sort"><?php if ($Pedido_list->DateCreation->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Pedido_list->DateCreation->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Pedido_list->DateLastUpdate->Visible) { // DateLastUpdate ?>
	<?php if ($Pedido_list->SortUrl($Pedido_list->DateLastUpdate) == "") { ?>
		<th data-name="DateLastUpdate" class="<?php echo $Pedido_list->DateLastUpdate->headerCellClass() ?>"><div id="elh_Pedido_DateLastUpdate" class="Pedido_DateLastUpdate"><div class="ew-table-header-caption"><?php echo $Pedido_list->DateLastUpdate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateLastUpdate" class="<?php echo $Pedido_list->DateLastUpdate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Pedido_list->SortUrl($Pedido_list->DateLastUpdate) ?>', 1);"><div id="elh_Pedido_DateLastUpdate" class="Pedido_DateLastUpdate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Pedido_list->DateLastUpdate->caption() ?></span><span class="ew-table-header-sort"><?php if ($Pedido_list->DateLastUpdate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Pedido_list->DateLastUpdate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Pedido_list->ID_Table->Visible) { // ID_Table ?>
	<?php if ($Pedido_list->SortUrl($Pedido_list->ID_Table) == "") { ?>
		<th data-name="ID_Table" class="<?php echo $Pedido_list->ID_Table->headerCellClass() ?>"><div id="elh_Pedido_ID_Table" class="Pedido_ID_Table"><div class="ew-table-header-caption"><?php echo $Pedido_list->ID_Table->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Table" class="<?php echo $Pedido_list->ID_Table->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Pedido_list->SortUrl($Pedido_list->ID_Table) ?>', 1);"><div id="elh_Pedido_ID_Table" class="Pedido_ID_Table">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Pedido_list->ID_Table->caption() ?></span><span class="ew-table-header-sort"><?php if ($Pedido_list->ID_Table->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Pedido_list->ID_Table->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$Pedido_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($Pedido_list->ExportAll && $Pedido_list->isExport()) {
	$Pedido_list->StopRecord = $Pedido_list->TotalRecords;
} else {

	// Set the last record to display
	if ($Pedido_list->TotalRecords > $Pedido_list->StartRecord + $Pedido_list->DisplayRecords - 1)
		$Pedido_list->StopRecord = $Pedido_list->StartRecord + $Pedido_list->DisplayRecords - 1;
	else
		$Pedido_list->StopRecord = $Pedido_list->TotalRecords;
}
$Pedido_list->RecordCount = $Pedido_list->StartRecord - 1;
if ($Pedido_list->Recordset && !$Pedido_list->Recordset->EOF) {
	$Pedido_list->Recordset->moveFirst();
	$selectLimit = $Pedido_list->UseSelectLimit;
	if (!$selectLimit && $Pedido_list->StartRecord > 1)
		$Pedido_list->Recordset->move($Pedido_list->StartRecord - 1);
} elseif (!$Pedido->AllowAddDeleteRow && $Pedido_list->StopRecord == 0) {
	$Pedido_list->StopRecord = $Pedido->GridAddRowCount;
}

// Initialize aggregate
$Pedido->RowType = ROWTYPE_AGGREGATEINIT;
$Pedido->resetAttributes();
$Pedido_list->renderRow();
while ($Pedido_list->RecordCount < $Pedido_list->StopRecord) {
	$Pedido_list->RecordCount++;
	if ($Pedido_list->RecordCount >= $Pedido_list->StartRecord) {
		$Pedido_list->RowCount++;

		// Set up key count
		$Pedido_list->KeyCount = $Pedido_list->RowIndex;

		// Init row class and style
		$Pedido->resetAttributes();
		$Pedido->CssClass = "";
		if ($Pedido_list->isGridAdd()) {
		} else {
			$Pedido_list->loadRowValues($Pedido_list->Recordset); // Load row values
		}
		$Pedido->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$Pedido->RowAttrs->merge(["data-rowindex" => $Pedido_list->RowCount, "id" => "r" . $Pedido_list->RowCount . "_Pedido", "data-rowtype" => $Pedido->RowType]);

		// Render row
		$Pedido_list->renderRow();

		// Render list options
		$Pedido_list->renderListOptions();
?>
	<tr <?php echo $Pedido->rowAttributes() ?>>
<?php

// Render list options (body, left)
$Pedido_list->ListOptions->render("body", "left", $Pedido_list->RowCount);
?>
	<?php if ($Pedido_list->ID->Visible) { // ID ?>
		<td data-name="ID" <?php echo $Pedido_list->ID->cellAttributes() ?>>
<span id="el<?php echo $Pedido_list->RowCount ?>_Pedido_ID">
<span<?php echo $Pedido_list->ID->viewAttributes() ?>><?php echo $Pedido_list->ID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Pedido_list->ID_Client->Visible) { // ID_Client ?>
		<td data-name="ID_Client" <?php echo $Pedido_list->ID_Client->cellAttributes() ?>>
<span id="el<?php echo $Pedido_list->RowCount ?>_Pedido_ID_Client">
<span<?php echo $Pedido_list->ID_Client->viewAttributes() ?>><?php if (!EmptyString($Pedido_list->ID_Client->getViewValue()) && $Pedido_list->ID_Client->linkAttributes() != "") { ?>
<a<?php echo $Pedido_list->ID_Client->linkAttributes() ?>><?php echo $Pedido_list->ID_Client->getViewValue() ?></a>
<?php } else { ?>
<?php echo $Pedido_list->ID_Client->getViewValue() ?>
<?php } ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Pedido_list->ID_Status->Visible) { // ID_Status ?>
		<td data-name="ID_Status" <?php echo $Pedido_list->ID_Status->cellAttributes() ?>>
<span id="el<?php echo $Pedido_list->RowCount ?>_Pedido_ID_Status">
<span<?php echo $Pedido_list->ID_Status->viewAttributes() ?>><?php echo $Pedido_list->ID_Status->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Pedido_list->ID_Restaurant->Visible) { // ID_Restaurant ?>
		<td data-name="ID_Restaurant" <?php echo $Pedido_list->ID_Restaurant->cellAttributes() ?>>
<span id="el<?php echo $Pedido_list->RowCount ?>_Pedido_ID_Restaurant">
<span<?php echo $Pedido_list->ID_Restaurant->viewAttributes() ?>><?php echo $Pedido_list->ID_Restaurant->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Pedido_list->DateCreation->Visible) { // DateCreation ?>
		<td data-name="DateCreation" <?php echo $Pedido_list->DateCreation->cellAttributes() ?>>
<span id="el<?php echo $Pedido_list->RowCount ?>_Pedido_DateCreation">
<span<?php echo $Pedido_list->DateCreation->viewAttributes() ?>><?php echo $Pedido_list->DateCreation->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Pedido_list->DateLastUpdate->Visible) { // DateLastUpdate ?>
		<td data-name="DateLastUpdate" <?php echo $Pedido_list->DateLastUpdate->cellAttributes() ?>>
<span id="el<?php echo $Pedido_list->RowCount ?>_Pedido_DateLastUpdate">
<span<?php echo $Pedido_list->DateLastUpdate->viewAttributes() ?>><?php echo $Pedido_list->DateLastUpdate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Pedido_list->ID_Table->Visible) { // ID_Table ?>
		<td data-name="ID_Table" <?php echo $Pedido_list->ID_Table->cellAttributes() ?>>
<span id="el<?php echo $Pedido_list->RowCount ?>_Pedido_ID_Table">
<span<?php echo $Pedido_list->ID_Table->viewAttributes() ?>><?php echo $Pedido_list->ID_Table->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$Pedido_list->ListOptions->render("body", "right", $Pedido_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$Pedido_list->isGridAdd())
		$Pedido_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$Pedido->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($Pedido_list->Recordset)
	$Pedido_list->Recordset->Close();
?>
<?php if (!$Pedido_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$Pedido_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Pedido_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Pedido_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($Pedido_list->TotalRecords == 0 && !$Pedido->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $Pedido_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$Pedido_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$Pedido_list->isExport()) { ?>
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
$Pedido_list->terminate();
?>