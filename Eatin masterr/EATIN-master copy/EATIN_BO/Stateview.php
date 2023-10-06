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
$State_view = new State_view();

// Run the page
$State_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$State_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$State_view->isExport()) { ?>
<script>
var fStateview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fStateview = currentForm = new ew.Form("fStateview", "view");
	loadjs.done("fStateview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$State_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $State_view->ExportOptions->render("body") ?>
<?php $State_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $State_view->showPageHeader(); ?>
<?php
$State_view->showMessage();
?>
<form name="fStateview" id="fStateview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="State">
<input type="hidden" name="modal" value="<?php echo (int)$State_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($State_view->ID->Visible) { // ID ?>
	<tr id="r_ID">
		<td class="<?php echo $State_view->TableLeftColumnClass ?>"><span id="elh_State_ID"><?php echo $State_view->ID->caption() ?></span></td>
		<td data-name="ID" <?php echo $State_view->ID->cellAttributes() ?>>
<span id="el_State_ID">
<span<?php echo $State_view->ID->viewAttributes() ?>><?php echo $State_view->ID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($State_view->Name->Visible) { // Name ?>
	<tr id="r_Name">
		<td class="<?php echo $State_view->TableLeftColumnClass ?>"><span id="elh_State_Name"><?php echo $State_view->Name->caption() ?></span></td>
		<td data-name="Name" <?php echo $State_view->Name->cellAttributes() ?>>
<span id="el_State_Name">
<span<?php echo $State_view->Name->viewAttributes() ?>><?php echo $State_view->Name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$State_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$State_view->isExport()) { ?>
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
$State_view->terminate();
?>