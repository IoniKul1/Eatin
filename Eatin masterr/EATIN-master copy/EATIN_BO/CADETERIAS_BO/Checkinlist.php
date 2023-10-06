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
$Checkin_list = new Checkin_list();

// Run the page
$Checkin_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Checkin_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$Checkin_list->isExport()) { ?>
<script>
var fCheckinlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fCheckinlist = currentForm = new ew.Form("fCheckinlist", "list");
	fCheckinlist.formKeyCountName = '<?php echo $Checkin_list->FormKeyCountName ?>';
	loadjs.done("fCheckinlist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$Checkin_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($Checkin_list->TotalRecords > 0 && $Checkin_list->ExportOptions->visible()) { ?>
<?php $Checkin_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Checkin_list->ImportOptions->visible()) { ?>
<?php $Checkin_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$Checkin_list->renderOtherOptions();
?>
<?php $Checkin_list->showPageHeader(); ?>
<?php
$Checkin_list->showMessage();
?>
<?php if ($Checkin_list->TotalRecords > 0 || $Checkin->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Checkin_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> Checkin">
<form name="fCheckinlist" id="fCheckinlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Checkin">
<div id="gmp_Checkin" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Checkin_list->TotalRecords > 0 || $Checkin_list->isGridEdit()) { ?>
<table id="tbl_Checkinlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$Checkin->RowType = ROWTYPE_HEADER;

// Render list options
$Checkin_list->renderListOptions();

// Render list options (header, left)
$Checkin_list->ListOptions->render("header", "left");
?>
<?php if ($Checkin_list->ID->Visible) { // ID ?>
	<?php if ($Checkin_list->SortUrl($Checkin_list->ID) == "") { ?>
		<th data-name="ID" class="<?php echo $Checkin_list->ID->headerCellClass() ?>"><div id="elh_Checkin_ID" class="Checkin_ID"><div class="ew-table-header-caption"><?php echo $Checkin_list->ID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID" class="<?php echo $Checkin_list->ID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Checkin_list->SortUrl($Checkin_list->ID) ?>', 1);"><div id="elh_Checkin_ID" class="Checkin_ID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Checkin_list->ID->caption() ?></span><span class="ew-table-header-sort"><?php if ($Checkin_list->ID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Checkin_list->ID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Checkin_list->ID_Cadete->Visible) { // ID_Cadete ?>
	<?php if ($Checkin_list->SortUrl($Checkin_list->ID_Cadete) == "") { ?>
		<th data-name="ID_Cadete" class="<?php echo $Checkin_list->ID_Cadete->headerCellClass() ?>"><div id="elh_Checkin_ID_Cadete" class="Checkin_ID_Cadete"><div class="ew-table-header-caption"><?php echo $Checkin_list->ID_Cadete->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Cadete" class="<?php echo $Checkin_list->ID_Cadete->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Checkin_list->SortUrl($Checkin_list->ID_Cadete) ?>', 1);"><div id="elh_Checkin_ID_Cadete" class="Checkin_ID_Cadete">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Checkin_list->ID_Cadete->caption() ?></span><span class="ew-table-header-sort"><?php if ($Checkin_list->ID_Cadete->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Checkin_list->ID_Cadete->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Checkin_list->ID_PedidoACadeteria->Visible) { // ID_PedidoACadeteria ?>
	<?php if ($Checkin_list->SortUrl($Checkin_list->ID_PedidoACadeteria) == "") { ?>
		<th data-name="ID_PedidoACadeteria" class="<?php echo $Checkin_list->ID_PedidoACadeteria->headerCellClass() ?>"><div id="elh_Checkin_ID_PedidoACadeteria" class="Checkin_ID_PedidoACadeteria"><div class="ew-table-header-caption"><?php echo $Checkin_list->ID_PedidoACadeteria->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_PedidoACadeteria" class="<?php echo $Checkin_list->ID_PedidoACadeteria->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Checkin_list->SortUrl($Checkin_list->ID_PedidoACadeteria) ?>', 1);"><div id="elh_Checkin_ID_PedidoACadeteria" class="Checkin_ID_PedidoACadeteria">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Checkin_list->ID_PedidoACadeteria->caption() ?></span><span class="ew-table-header-sort"><?php if ($Checkin_list->ID_PedidoACadeteria->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Checkin_list->ID_PedidoACadeteria->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Checkin_list->FechaCreacion->Visible) { // FechaCreacion ?>
	<?php if ($Checkin_list->SortUrl($Checkin_list->FechaCreacion) == "") { ?>
		<th data-name="FechaCreacion" class="<?php echo $Checkin_list->FechaCreacion->headerCellClass() ?>"><div id="elh_Checkin_FechaCreacion" class="Checkin_FechaCreacion"><div class="ew-table-header-caption"><?php echo $Checkin_list->FechaCreacion->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FechaCreacion" class="<?php echo $Checkin_list->FechaCreacion->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Checkin_list->SortUrl($Checkin_list->FechaCreacion) ?>', 1);"><div id="elh_Checkin_FechaCreacion" class="Checkin_FechaCreacion">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Checkin_list->FechaCreacion->caption() ?></span><span class="ew-table-header-sort"><?php if ($Checkin_list->FechaCreacion->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Checkin_list->FechaCreacion->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Checkin_list->ID_Cadeteria->Visible) { // ID_Cadeteria ?>
	<?php if ($Checkin_list->SortUrl($Checkin_list->ID_Cadeteria) == "") { ?>
		<th data-name="ID_Cadeteria" class="<?php echo $Checkin_list->ID_Cadeteria->headerCellClass() ?>"><div id="elh_Checkin_ID_Cadeteria" class="Checkin_ID_Cadeteria"><div class="ew-table-header-caption"><?php echo $Checkin_list->ID_Cadeteria->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Cadeteria" class="<?php echo $Checkin_list->ID_Cadeteria->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Checkin_list->SortUrl($Checkin_list->ID_Cadeteria) ?>', 1);"><div id="elh_Checkin_ID_Cadeteria" class="Checkin_ID_Cadeteria">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Checkin_list->ID_Cadeteria->caption() ?></span><span class="ew-table-header-sort"><?php if ($Checkin_list->ID_Cadeteria->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Checkin_list->ID_Cadeteria->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$Checkin_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($Checkin_list->ExportAll && $Checkin_list->isExport()) {
	$Checkin_list->StopRecord = $Checkin_list->TotalRecords;
} else {

	// Set the last record to display
	if ($Checkin_list->TotalRecords > $Checkin_list->StartRecord + $Checkin_list->DisplayRecords - 1)
		$Checkin_list->StopRecord = $Checkin_list->StartRecord + $Checkin_list->DisplayRecords - 1;
	else
		$Checkin_list->StopRecord = $Checkin_list->TotalRecords;
}
$Checkin_list->RecordCount = $Checkin_list->StartRecord - 1;
if ($Checkin_list->Recordset && !$Checkin_list->Recordset->EOF) {
	$Checkin_list->Recordset->moveFirst();
	$selectLimit = $Checkin_list->UseSelectLimit;
	if (!$selectLimit && $Checkin_list->StartRecord > 1)
		$Checkin_list->Recordset->move($Checkin_list->StartRecord - 1);
} elseif (!$Checkin->AllowAddDeleteRow && $Checkin_list->StopRecord == 0) {
	$Checkin_list->StopRecord = $Checkin->GridAddRowCount;
}

// Initialize aggregate
$Checkin->RowType = ROWTYPE_AGGREGATEINIT;
$Checkin->resetAttributes();
$Checkin_list->renderRow();
while ($Checkin_list->RecordCount < $Checkin_list->StopRecord) {
	$Checkin_list->RecordCount++;
	if ($Checkin_list->RecordCount >= $Checkin_list->StartRecord) {
		$Checkin_list->RowCount++;

		// Set up key count
		$Checkin_list->KeyCount = $Checkin_list->RowIndex;

		// Init row class and style
		$Checkin->resetAttributes();
		$Checkin->CssClass = "";
		if ($Checkin_list->isGridAdd()) {
		} else {
			$Checkin_list->loadRowValues($Checkin_list->Recordset); // Load row values
		}
		$Checkin->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$Checkin->RowAttrs->merge(["data-rowindex" => $Checkin_list->RowCount, "id" => "r" . $Checkin_list->RowCount . "_Checkin", "data-rowtype" => $Checkin->RowType]);

		// Render row
		$Checkin_list->renderRow();

		// Render list options
		$Checkin_list->renderListOptions();
?>
	<tr <?php echo $Checkin->rowAttributes() ?>>
<?php

// Render list options (body, left)
$Checkin_list->ListOptions->render("body", "left", $Checkin_list->RowCount);
?>
	<?php if ($Checkin_list->ID->Visible) { // ID ?>
		<td data-name="ID" <?php echo $Checkin_list->ID->cellAttributes() ?>>
<span id="el<?php echo $Checkin_list->RowCount ?>_Checkin_ID">
<span<?php echo $Checkin_list->ID->viewAttributes() ?>><?php echo $Checkin_list->ID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Checkin_list->ID_Cadete->Visible) { // ID_Cadete ?>
		<td data-name="ID_Cadete" <?php echo $Checkin_list->ID_Cadete->cellAttributes() ?>>
<span id="el<?php echo $Checkin_list->RowCount ?>_Checkin_ID_Cadete">
<span<?php echo $Checkin_list->ID_Cadete->viewAttributes() ?>><?php echo $Checkin_list->ID_Cadete->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Checkin_list->ID_PedidoACadeteria->Visible) { // ID_PedidoACadeteria ?>
		<td data-name="ID_PedidoACadeteria" <?php echo $Checkin_list->ID_PedidoACadeteria->cellAttributes() ?>>
<span id="el<?php echo $Checkin_list->RowCount ?>_Checkin_ID_PedidoACadeteria">
<span<?php echo $Checkin_list->ID_PedidoACadeteria->viewAttributes() ?>><?php echo $Checkin_list->ID_PedidoACadeteria->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Checkin_list->FechaCreacion->Visible) { // FechaCreacion ?>
		<td data-name="FechaCreacion" <?php echo $Checkin_list->FechaCreacion->cellAttributes() ?>>
<span id="el<?php echo $Checkin_list->RowCount ?>_Checkin_FechaCreacion">
<span<?php echo $Checkin_list->FechaCreacion->viewAttributes() ?>><?php echo $Checkin_list->FechaCreacion->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Checkin_list->ID_Cadeteria->Visible) { // ID_Cadeteria ?>
		<td data-name="ID_Cadeteria" <?php echo $Checkin_list->ID_Cadeteria->cellAttributes() ?>>
<span id="el<?php echo $Checkin_list->RowCount ?>_Checkin_ID_Cadeteria">
<span<?php echo $Checkin_list->ID_Cadeteria->viewAttributes() ?>><?php echo $Checkin_list->ID_Cadeteria->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$Checkin_list->ListOptions->render("body", "right", $Checkin_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$Checkin_list->isGridAdd())
		$Checkin_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$Checkin->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($Checkin_list->Recordset)
	$Checkin_list->Recordset->Close();
?>
<?php if (!$Checkin_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$Checkin_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Checkin_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Checkin_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($Checkin_list->TotalRecords == 0 && !$Checkin->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $Checkin_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$Checkin_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$Checkin_list->isExport()) { ?>
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
$Checkin_list->terminate();
?>