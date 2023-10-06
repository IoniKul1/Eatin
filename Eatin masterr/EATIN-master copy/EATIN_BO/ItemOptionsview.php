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
$ItemOptions_view = new ItemOptions_view();

// Run the page
$ItemOptions_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ItemOptions_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$ItemOptions_view->isExport()) { ?>
<script>
var fItemOptionsview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fItemOptionsview = currentForm = new ew.Form("fItemOptionsview", "view");
	loadjs.done("fItemOptionsview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$ItemOptions_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $ItemOptions_view->ExportOptions->render("body") ?>
<?php $ItemOptions_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $ItemOptions_view->showPageHeader(); ?>
<?php
$ItemOptions_view->showMessage();
?>
<form name="fItemOptionsview" id="fItemOptionsview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ItemOptions">
<input type="hidden" name="modal" value="<?php echo (int)$ItemOptions_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($ItemOptions_view->ID->Visible) { // ID ?>
	<tr id="r_ID">
		<td class="<?php echo $ItemOptions_view->TableLeftColumnClass ?>"><span id="elh_ItemOptions_ID"><?php echo $ItemOptions_view->ID->caption() ?></span></td>
		<td data-name="ID" <?php echo $ItemOptions_view->ID->cellAttributes() ?>>
<span id="el_ItemOptions_ID">
<span<?php echo $ItemOptions_view->ID->viewAttributes() ?>><?php echo $ItemOptions_view->ID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ItemOptions_view->ID_Item->Visible) { // ID_Item ?>
	<tr id="r_ID_Item">
		<td class="<?php echo $ItemOptions_view->TableLeftColumnClass ?>"><span id="elh_ItemOptions_ID_Item"><?php echo $ItemOptions_view->ID_Item->caption() ?></span></td>
		<td data-name="ID_Item" <?php echo $ItemOptions_view->ID_Item->cellAttributes() ?>>
<span id="el_ItemOptions_ID_Item">
<span<?php echo $ItemOptions_view->ID_Item->viewAttributes() ?>><?php echo $ItemOptions_view->ID_Item->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ItemOptions_view->ID_Restaurant->Visible) { // ID_Restaurant ?>
	<tr id="r_ID_Restaurant">
		<td class="<?php echo $ItemOptions_view->TableLeftColumnClass ?>"><span id="elh_ItemOptions_ID_Restaurant"><?php echo $ItemOptions_view->ID_Restaurant->caption() ?></span></td>
		<td data-name="ID_Restaurant" <?php echo $ItemOptions_view->ID_Restaurant->cellAttributes() ?>>
<span id="el_ItemOptions_ID_Restaurant">
<span<?php echo $ItemOptions_view->ID_Restaurant->viewAttributes() ?>><?php echo $ItemOptions_view->ID_Restaurant->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$ItemOptions_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$ItemOptions_view->isExport()) { ?>
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
$ItemOptions_view->terminate();
?>