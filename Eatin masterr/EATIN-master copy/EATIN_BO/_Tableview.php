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
$_Table_view = new _Table_view();

// Run the page
$_Table_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$_Table_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$_Table_view->isExport()) { ?>
<script>
var f_Tableview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	f_Tableview = currentForm = new ew.Form("f_Tableview", "view");
	loadjs.done("f_Tableview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$_Table_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $_Table_view->ExportOptions->render("body") ?>
<?php $_Table_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $_Table_view->showPageHeader(); ?>
<?php
$_Table_view->showMessage();
?>
<form name="f_Tableview" id="f_Tableview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="_Table">
<input type="hidden" name="modal" value="<?php echo (int)$_Table_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($_Table_view->ID->Visible) { // ID ?>
	<tr id="r_ID">
		<td class="<?php echo $_Table_view->TableLeftColumnClass ?>"><span id="elh__Table_ID"><?php echo $_Table_view->ID->caption() ?></span></td>
		<td data-name="ID" <?php echo $_Table_view->ID->cellAttributes() ?>>
<span id="el__Table_ID">
<span<?php echo $_Table_view->ID->viewAttributes() ?>><?php echo $_Table_view->ID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($_Table_view->ID_Restaurant->Visible) { // ID_Restaurant ?>
	<tr id="r_ID_Restaurant">
		<td class="<?php echo $_Table_view->TableLeftColumnClass ?>"><span id="elh__Table_ID_Restaurant"><?php echo $_Table_view->ID_Restaurant->caption() ?></span></td>
		<td data-name="ID_Restaurant" <?php echo $_Table_view->ID_Restaurant->cellAttributes() ?>>
<span id="el__Table_ID_Restaurant">
<span<?php echo $_Table_view->ID_Restaurant->viewAttributes() ?>><?php echo $_Table_view->ID_Restaurant->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($_Table_view->QRCode->Visible) { // QRCode ?>
	<tr id="r_QRCode">
		<td class="<?php echo $_Table_view->TableLeftColumnClass ?>"><span id="elh__Table_QRCode"><?php echo $_Table_view->QRCode->caption() ?></span></td>
		<td data-name="QRCode" <?php echo $_Table_view->QRCode->cellAttributes() ?>>
<span id="el__Table_QRCode">
<span<?php echo $_Table_view->QRCode->viewAttributes() ?>><?php if (!EmptyString($_Table_view->QRCode->getViewValue()) && $_Table_view->QRCode->linkAttributes() != "") { ?>
<a<?php echo $_Table_view->QRCode->linkAttributes() ?>><?php echo $_Table_view->QRCode->getViewValue() ?></a>
<?php } else { ?>
<?php echo $_Table_view->QRCode->getViewValue() ?>
<?php } ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($_Table_view->Numero->Visible) { // Numero ?>
	<tr id="r_Numero">
		<td class="<?php echo $_Table_view->TableLeftColumnClass ?>"><span id="elh__Table_Numero"><?php echo $_Table_view->Numero->caption() ?></span></td>
		<td data-name="Numero" <?php echo $_Table_view->Numero->cellAttributes() ?>>
<span id="el__Table_Numero">
<span<?php echo $_Table_view->Numero->viewAttributes() ?>><?php echo $_Table_view->Numero->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$_Table_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$_Table_view->isExport()) { ?>
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
$_Table_view->terminate();
?>