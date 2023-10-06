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
$Countries_view = new Countries_view();

// Run the page
$Countries_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Countries_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$Countries_view->isExport()) { ?>
<script>
var fCountriesview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fCountriesview = currentForm = new ew.Form("fCountriesview", "view");
	loadjs.done("fCountriesview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$Countries_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Countries_view->ExportOptions->render("body") ?>
<?php $Countries_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $Countries_view->showPageHeader(); ?>
<?php
$Countries_view->showMessage();
?>
<form name="fCountriesview" id="fCountriesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Countries">
<input type="hidden" name="modal" value="<?php echo (int)$Countries_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Countries_view->ID->Visible) { // ID ?>
	<tr id="r_ID">
		<td class="<?php echo $Countries_view->TableLeftColumnClass ?>"><span id="elh_Countries_ID"><?php echo $Countries_view->ID->caption() ?></span></td>
		<td data-name="ID" <?php echo $Countries_view->ID->cellAttributes() ?>>
<span id="el_Countries_ID">
<span<?php echo $Countries_view->ID->viewAttributes() ?>><?php echo $Countries_view->ID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Countries_view->Name->Visible) { // Name ?>
	<tr id="r_Name">
		<td class="<?php echo $Countries_view->TableLeftColumnClass ?>"><span id="elh_Countries_Name"><?php echo $Countries_view->Name->caption() ?></span></td>
		<td data-name="Name" <?php echo $Countries_view->Name->cellAttributes() ?>>
<span id="el_Countries_Name">
<span<?php echo $Countries_view->Name->viewAttributes() ?>><?php echo $Countries_view->Name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$Countries_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$Countries_view->isExport()) { ?>
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
$Countries_view->terminate();
?>