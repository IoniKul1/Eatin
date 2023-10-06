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
$Checkout_list = new Checkout_list();

// Run the page
$Checkout_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Checkout_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$Checkout_list->isExport()) { ?>
<script>
var fCheckoutlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fCheckoutlist = currentForm = new ew.Form("fCheckoutlist", "list");
	fCheckoutlist.formKeyCountName = '<?php echo $Checkout_list->FormKeyCountName ?>';
	loadjs.done("fCheckoutlist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$Checkout_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($Checkout_list->TotalRecords > 0 && $Checkout_list->ExportOptions->visible()) { ?>
<?php $Checkout_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Checkout_list->ImportOptions->visible()) { ?>
<?php $Checkout_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$Checkout_list->renderOtherOptions();
?>
<?php $Checkout_list->showPageHeader(); ?>
<?php
$Checkout_list->showMessage();
?>
<?php if ($Checkout_list->TotalRecords > 0 || $Checkout->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Checkout_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> Checkout">
<form name="fCheckoutlist" id="fCheckoutlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Checkout">
<div id="gmp_Checkout" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Checkout_list->TotalRecords > 0 || $Checkout_list->isGridEdit()) { ?>
<table id="tbl_Checkoutlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$Checkout->RowType = ROWTYPE_HEADER;

// Render list options
$Checkout_list->renderListOptions();

// Render list options (header, left)
$Checkout_list->ListOptions->render("header", "left");
?>
<?php if ($Checkout_list->ID->Visible) { // ID ?>
	<?php if ($Checkout_list->SortUrl($Checkout_list->ID) == "") { ?>
		<th data-name="ID" class="<?php echo $Checkout_list->ID->headerCellClass() ?>"><div id="elh_Checkout_ID" class="Checkout_ID"><div class="ew-table-header-caption"><?php echo $Checkout_list->ID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID" class="<?php echo $Checkout_list->ID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Checkout_list->SortUrl($Checkout_list->ID) ?>', 1);"><div id="elh_Checkout_ID" class="Checkout_ID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Checkout_list->ID->caption() ?></span><span class="ew-table-header-sort"><?php if ($Checkout_list->ID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Checkout_list->ID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Checkout_list->ID_Cadete->Visible) { // ID_Cadete ?>
	<?php if ($Checkout_list->SortUrl($Checkout_list->ID_Cadete) == "") { ?>
		<th data-name="ID_Cadete" class="<?php echo $Checkout_list->ID_Cadete->headerCellClass() ?>"><div id="elh_Checkout_ID_Cadete" class="Checkout_ID_Cadete"><div class="ew-table-header-caption"><?php echo $Checkout_list->ID_Cadete->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Cadete" class="<?php echo $Checkout_list->ID_Cadete->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Checkout_list->SortUrl($Checkout_list->ID_Cadete) ?>', 1);"><div id="elh_Checkout_ID_Cadete" class="Checkout_ID_Cadete">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Checkout_list->ID_Cadete->caption() ?></span><span class="ew-table-header-sort"><?php if ($Checkout_list->ID_Cadete->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Checkout_list->ID_Cadete->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Checkout_list->ID_PedidoACadeteria->Visible) { // ID_PedidoACadeteria ?>
	<?php if ($Checkout_list->SortUrl($Checkout_list->ID_PedidoACadeteria) == "") { ?>
		<th data-name="ID_PedidoACadeteria" class="<?php echo $Checkout_list->ID_PedidoACadeteria->headerCellClass() ?>"><div id="elh_Checkout_ID_PedidoACadeteria" class="Checkout_ID_PedidoACadeteria"><div class="ew-table-header-caption"><?php echo $Checkout_list->ID_PedidoACadeteria->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_PedidoACadeteria" class="<?php echo $Checkout_list->ID_PedidoACadeteria->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Checkout_list->SortUrl($Checkout_list->ID_PedidoACadeteria) ?>', 1);"><div id="elh_Checkout_ID_PedidoACadeteria" class="Checkout_ID_PedidoACadeteria">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Checkout_list->ID_PedidoACadeteria->caption() ?></span><span class="ew-table-header-sort"><?php if ($Checkout_list->ID_PedidoACadeteria->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Checkout_list->ID_PedidoACadeteria->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Checkout_list->FechaCreacion->Visible) { // FechaCreacion ?>
	<?php if ($Checkout_list->SortUrl($Checkout_list->FechaCreacion) == "") { ?>
		<th data-name="FechaCreacion" class="<?php echo $Checkout_list->FechaCreacion->headerCellClass() ?>"><div id="elh_Checkout_FechaCreacion" class="Checkout_FechaCreacion"><div class="ew-table-header-caption"><?php echo $Checkout_list->FechaCreacion->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FechaCreacion" class="<?php echo $Checkout_list->FechaCreacion->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Checkout_list->SortUrl($Checkout_list->FechaCreacion) ?>', 1);"><div id="elh_Checkout_FechaCreacion" class="Checkout_FechaCreacion">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Checkout_list->FechaCreacion->caption() ?></span><span class="ew-table-header-sort"><?php if ($Checkout_list->FechaCreacion->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Checkout_list->FechaCreacion->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Checkout_list->ID_Cadeteria->Visible) { // ID_Cadeteria ?>
	<?php if ($Checkout_list->SortUrl($Checkout_list->ID_Cadeteria) == "") { ?>
		<th data-name="ID_Cadeteria" class="<?php echo $Checkout_list->ID_Cadeteria->headerCellClass() ?>"><div id="elh_Checkout_ID_Cadeteria" class="Checkout_ID_Cadeteria"><div class="ew-table-header-caption"><?php echo $Checkout_list->ID_Cadeteria->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Cadeteria" class="<?php echo $Checkout_list->ID_Cadeteria->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Checkout_list->SortUrl($Checkout_list->ID_Cadeteria) ?>', 1);"><div id="elh_Checkout_ID_Cadeteria" class="Checkout_ID_Cadeteria">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Checkout_list->ID_Cadeteria->caption() ?></span><span class="ew-table-header-sort"><?php if ($Checkout_list->ID_Cadeteria->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Checkout_list->ID_Cadeteria->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$Checkout_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($Checkout_list->ExportAll && $Checkout_list->isExport()) {
	$Checkout_list->StopRecord = $Checkout_list->TotalRecords;
} else {

	// Set the last record to display
	if ($Checkout_list->TotalRecords > $Checkout_list->StartRecord + $Checkout_list->DisplayRecords - 1)
		$Checkout_list->StopRecord = $Checkout_list->StartRecord + $Checkout_list->DisplayRecords - 1;
	else
		$Checkout_list->StopRecord = $Checkout_list->TotalRecords;
}
$Checkout_list->RecordCount = $Checkout_list->StartRecord - 1;
if ($Checkout_list->Recordset && !$Checkout_list->Recordset->EOF) {
	$Checkout_list->Recordset->moveFirst();
	$selectLimit = $Checkout_list->UseSelectLimit;
	if (!$selectLimit && $Checkout_list->StartRecord > 1)
		$Checkout_list->Recordset->move($Checkout_list->StartRecord - 1);
} elseif (!$Checkout->AllowAddDeleteRow && $Checkout_list->StopRecord == 0) {
	$Checkout_list->StopRecord = $Checkout->GridAddRowCount;
}

// Initialize aggregate
$Checkout->RowType = ROWTYPE_AGGREGATEINIT;
$Checkout->resetAttributes();
$Checkout_list->renderRow();
while ($Checkout_list->RecordCount < $Checkout_list->StopRecord) {
	$Checkout_list->RecordCount++;
	if ($Checkout_list->RecordCount >= $Checkout_list->StartRecord) {
		$Checkout_list->RowCount++;

		// Set up key count
		$Checkout_list->KeyCount = $Checkout_list->RowIndex;

		// Init row class and style
		$Checkout->resetAttributes();
		$Checkout->CssClass = "";
		if ($Checkout_list->isGridAdd()) {
		} else {
			$Checkout_list->loadRowValues($Checkout_list->Recordset); // Load row values
		}
		$Checkout->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$Checkout->RowAttrs->merge(["data-rowindex" => $Checkout_list->RowCount, "id" => "r" . $Checkout_list->RowCount . "_Checkout", "data-rowtype" => $Checkout->RowType]);

		// Render row
		$Checkout_list->renderRow();

		// Render list options
		$Checkout_list->renderListOptions();
?>
	<tr <?php echo $Checkout->rowAttributes() ?>>
<?php

// Render list options (body, left)
$Checkout_list->ListOptions->render("body", "left", $Checkout_list->RowCount);
?>
	<?php if ($Checkout_list->ID->Visible) { // ID ?>
		<td data-name="ID" <?php echo $Checkout_list->ID->cellAttributes() ?>>
<span id="el<?php echo $Checkout_list->RowCount ?>_Checkout_ID">
<span<?php echo $Checkout_list->ID->viewAttributes() ?>><?php echo $Checkout_list->ID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Checkout_list->ID_Cadete->Visible) { // ID_Cadete ?>
		<td data-name="ID_Cadete" <?php echo $Checkout_list->ID_Cadete->cellAttributes() ?>>
<span id="el<?php echo $Checkout_list->RowCount ?>_Checkout_ID_Cadete">
<span<?php echo $Checkout_list->ID_Cadete->viewAttributes() ?>><?php echo $Checkout_list->ID_Cadete->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Checkout_list->ID_PedidoACadeteria->Visible) { // ID_PedidoACadeteria ?>
		<td data-name="ID_PedidoACadeteria" <?php echo $Checkout_list->ID_PedidoACadeteria->cellAttributes() ?>>
<span id="el<?php echo $Checkout_list->RowCount ?>_Checkout_ID_PedidoACadeteria">
<span<?php echo $Checkout_list->ID_PedidoACadeteria->viewAttributes() ?>><?php echo $Checkout_list->ID_PedidoACadeteria->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Checkout_list->FechaCreacion->Visible) { // FechaCreacion ?>
		<td data-name="FechaCreacion" <?php echo $Checkout_list->FechaCreacion->cellAttributes() ?>>
<span id="el<?php echo $Checkout_list->RowCount ?>_Checkout_FechaCreacion">
<span<?php echo $Checkout_list->FechaCreacion->viewAttributes() ?>><?php echo $Checkout_list->FechaCreacion->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Checkout_list->ID_Cadeteria->Visible) { // ID_Cadeteria ?>
		<td data-name="ID_Cadeteria" <?php echo $Checkout_list->ID_Cadeteria->cellAttributes() ?>>
<span id="el<?php echo $Checkout_list->RowCount ?>_Checkout_ID_Cadeteria">
<span<?php echo $Checkout_list->ID_Cadeteria->viewAttributes() ?>><?php echo $Checkout_list->ID_Cadeteria->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$Checkout_list->ListOptions->render("body", "right", $Checkout_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$Checkout_list->isGridAdd())
		$Checkout_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$Checkout->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($Checkout_list->Recordset)
	$Checkout_list->Recordset->Close();
?>
<?php if (!$Checkout_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$Checkout_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Checkout_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Checkout_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($Checkout_list->TotalRecords == 0 && !$Checkout->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $Checkout_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$Checkout_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$Checkout_list->isExport()) { ?>
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
$Checkout_list->terminate();
?>