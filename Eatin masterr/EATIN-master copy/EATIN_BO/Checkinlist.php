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
<?php if (!$Checkin_list->isExport() || Config("EXPORT_MASTER_RECORD") && $Checkin_list->isExport("print")) { ?>
<?php
if ($Checkin_list->DbMasterFilter != "" && $Checkin->getCurrentMasterTable() == "Client") {
	if ($Checkin_list->MasterRecordExists) {
		include_once "Clientmaster.php";
	}
}
?>
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
<?php if (!$Checkin_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$Checkin_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Checkin_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Checkin_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fCheckinlist" id="fCheckinlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Checkin">
<?php if ($Checkin->getCurrentMasterTable() == "Client" && $Checkin->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="Client">
<input type="hidden" name="fk_ID" value="<?php echo HtmlEncode($Checkin_list->ID_Client->getSessionValue()) ?>">
<?php } ?>
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
<?php if ($Checkin_list->ID_Client->Visible) { // ID_Client ?>
	<?php if ($Checkin_list->SortUrl($Checkin_list->ID_Client) == "") { ?>
		<th data-name="ID_Client" class="<?php echo $Checkin_list->ID_Client->headerCellClass() ?>"><div id="elh_Checkin_ID_Client" class="Checkin_ID_Client"><div class="ew-table-header-caption"><?php echo $Checkin_list->ID_Client->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Client" class="<?php echo $Checkin_list->ID_Client->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Checkin_list->SortUrl($Checkin_list->ID_Client) ?>', 1);"><div id="elh_Checkin_ID_Client" class="Checkin_ID_Client">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Checkin_list->ID_Client->caption() ?></span><span class="ew-table-header-sort"><?php if ($Checkin_list->ID_Client->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Checkin_list->ID_Client->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Checkin_list->ID_Restaurant->Visible) { // ID_Restaurant ?>
	<?php if ($Checkin_list->SortUrl($Checkin_list->ID_Restaurant) == "") { ?>
		<th data-name="ID_Restaurant" class="<?php echo $Checkin_list->ID_Restaurant->headerCellClass() ?>"><div id="elh_Checkin_ID_Restaurant" class="Checkin_ID_Restaurant"><div class="ew-table-header-caption"><?php echo $Checkin_list->ID_Restaurant->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Restaurant" class="<?php echo $Checkin_list->ID_Restaurant->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Checkin_list->SortUrl($Checkin_list->ID_Restaurant) ?>', 1);"><div id="elh_Checkin_ID_Restaurant" class="Checkin_ID_Restaurant">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Checkin_list->ID_Restaurant->caption() ?></span><span class="ew-table-header-sort"><?php if ($Checkin_list->ID_Restaurant->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Checkin_list->ID_Restaurant->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Checkin_list->DateCreation->Visible) { // DateCreation ?>
	<?php if ($Checkin_list->SortUrl($Checkin_list->DateCreation) == "") { ?>
		<th data-name="DateCreation" class="<?php echo $Checkin_list->DateCreation->headerCellClass() ?>"><div id="elh_Checkin_DateCreation" class="Checkin_DateCreation"><div class="ew-table-header-caption"><?php echo $Checkin_list->DateCreation->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateCreation" class="<?php echo $Checkin_list->DateCreation->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Checkin_list->SortUrl($Checkin_list->DateCreation) ?>', 1);"><div id="elh_Checkin_DateCreation" class="Checkin_DateCreation">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Checkin_list->DateCreation->caption() ?></span><span class="ew-table-header-sort"><?php if ($Checkin_list->DateCreation->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Checkin_list->DateCreation->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
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
	<?php if ($Checkin_list->ID_Client->Visible) { // ID_Client ?>
		<td data-name="ID_Client" <?php echo $Checkin_list->ID_Client->cellAttributes() ?>>
<span id="el<?php echo $Checkin_list->RowCount ?>_Checkin_ID_Client">
<span<?php echo $Checkin_list->ID_Client->viewAttributes() ?>><?php echo $Checkin_list->ID_Client->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Checkin_list->ID_Restaurant->Visible) { // ID_Restaurant ?>
		<td data-name="ID_Restaurant" <?php echo $Checkin_list->ID_Restaurant->cellAttributes() ?>>
<span id="el<?php echo $Checkin_list->RowCount ?>_Checkin_ID_Restaurant">
<span<?php echo $Checkin_list->ID_Restaurant->viewAttributes() ?>><?php echo $Checkin_list->ID_Restaurant->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($Checkin_list->DateCreation->Visible) { // DateCreation ?>
		<td data-name="DateCreation" <?php echo $Checkin_list->DateCreation->cellAttributes() ?>>
<span id="el<?php echo $Checkin_list->RowCount ?>_Checkin_DateCreation">
<span<?php echo $Checkin_list->DateCreation->viewAttributes() ?>><?php echo $Checkin_list->DateCreation->getViewValue() ?></span>
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