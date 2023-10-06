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
$Client_view = new Client_view();

// Run the page
$Client_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Client_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$Client_view->isExport()) { ?>
<script>
var fClientview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fClientview = currentForm = new ew.Form("fClientview", "view");
	loadjs.done("fClientview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$Client_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Client_view->ExportOptions->render("body") ?>
<?php $Client_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $Client_view->showPageHeader(); ?>
<?php
$Client_view->showMessage();
?>
<form name="fClientview" id="fClientview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Client">
<input type="hidden" name="modal" value="<?php echo (int)$Client_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Client_view->ID->Visible) { // ID ?>
	<tr id="r_ID">
		<td class="<?php echo $Client_view->TableLeftColumnClass ?>"><span id="elh_Client_ID"><?php echo $Client_view->ID->caption() ?></span></td>
		<td data-name="ID" <?php echo $Client_view->ID->cellAttributes() ?>>
<span id="el_Client_ID">
<span<?php echo $Client_view->ID->viewAttributes() ?>><?php echo $Client_view->ID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Client_view->ID_Restaurant->Visible) { // ID_Restaurant ?>
	<tr id="r_ID_Restaurant">
		<td class="<?php echo $Client_view->TableLeftColumnClass ?>"><span id="elh_Client_ID_Restaurant"><?php echo $Client_view->ID_Restaurant->caption() ?></span></td>
		<td data-name="ID_Restaurant" <?php echo $Client_view->ID_Restaurant->cellAttributes() ?>>
<span id="el_Client_ID_Restaurant">
<span<?php echo $Client_view->ID_Restaurant->viewAttributes() ?>><?php echo $Client_view->ID_Restaurant->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Client_view->DateCreation->Visible) { // DateCreation ?>
	<tr id="r_DateCreation">
		<td class="<?php echo $Client_view->TableLeftColumnClass ?>"><span id="elh_Client_DateCreation"><?php echo $Client_view->DateCreation->caption() ?></span></td>
		<td data-name="DateCreation" <?php echo $Client_view->DateCreation->cellAttributes() ?>>
<span id="el_Client_DateCreation">
<span<?php echo $Client_view->DateCreation->viewAttributes() ?>><?php echo $Client_view->DateCreation->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Client_view->DateLastUpdate->Visible) { // DateLastUpdate ?>
	<tr id="r_DateLastUpdate">
		<td class="<?php echo $Client_view->TableLeftColumnClass ?>"><span id="elh_Client_DateLastUpdate"><?php echo $Client_view->DateLastUpdate->caption() ?></span></td>
		<td data-name="DateLastUpdate" <?php echo $Client_view->DateLastUpdate->cellAttributes() ?>>
<span id="el_Client_DateLastUpdate">
<span<?php echo $Client_view->DateLastUpdate->viewAttributes() ?>><?php echo $Client_view->DateLastUpdate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Client_view->FirstName->Visible) { // FirstName ?>
	<tr id="r_FirstName">
		<td class="<?php echo $Client_view->TableLeftColumnClass ?>"><span id="elh_Client_FirstName"><?php echo $Client_view->FirstName->caption() ?></span></td>
		<td data-name="FirstName" <?php echo $Client_view->FirstName->cellAttributes() ?>>
<span id="el_Client_FirstName">
<span<?php echo $Client_view->FirstName->viewAttributes() ?>><?php echo $Client_view->FirstName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Client_view->LastName->Visible) { // LastName ?>
	<tr id="r_LastName">
		<td class="<?php echo $Client_view->TableLeftColumnClass ?>"><span id="elh_Client_LastName"><?php echo $Client_view->LastName->caption() ?></span></td>
		<td data-name="LastName" <?php echo $Client_view->LastName->cellAttributes() ?>>
<span id="el_Client_LastName">
<span<?php echo $Client_view->LastName->viewAttributes() ?>><?php echo $Client_view->LastName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Client_view->_Email->Visible) { // Email ?>
	<tr id="r__Email">
		<td class="<?php echo $Client_view->TableLeftColumnClass ?>"><span id="elh_Client__Email"><?php echo $Client_view->_Email->caption() ?></span></td>
		<td data-name="_Email" <?php echo $Client_view->_Email->cellAttributes() ?>>
<span id="el_Client__Email">
<span<?php echo $Client_view->_Email->viewAttributes() ?>><?php echo $Client_view->_Email->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Client_view->Phone->Visible) { // Phone ?>
	<tr id="r_Phone">
		<td class="<?php echo $Client_view->TableLeftColumnClass ?>"><span id="elh_Client_Phone"><?php echo $Client_view->Phone->caption() ?></span></td>
		<td data-name="Phone" <?php echo $Client_view->Phone->cellAttributes() ?>>
<span id="el_Client_Phone">
<span<?php echo $Client_view->Phone->viewAttributes() ?>><?php echo $Client_view->Phone->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Client_view->Banned->Visible) { // Banned ?>
	<tr id="r_Banned">
		<td class="<?php echo $Client_view->TableLeftColumnClass ?>"><span id="elh_Client_Banned"><?php echo $Client_view->Banned->caption() ?></span></td>
		<td data-name="Banned" <?php echo $Client_view->Banned->cellAttributes() ?>>
<span id="el_Client_Banned">
<span<?php echo $Client_view->Banned->viewAttributes() ?>><?php echo $Client_view->Banned->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Client_view->Comments->Visible) { // Comments ?>
	<tr id="r_Comments">
		<td class="<?php echo $Client_view->TableLeftColumnClass ?>"><span id="elh_Client_Comments"><?php echo $Client_view->Comments->caption() ?></span></td>
		<td data-name="Comments" <?php echo $Client_view->Comments->cellAttributes() ?>>
<span id="el_Client_Comments">
<span<?php echo $Client_view->Comments->viewAttributes() ?>><?php echo $Client_view->Comments->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Client_view->ClientToken->Visible) { // ClientToken ?>
	<tr id="r_ClientToken">
		<td class="<?php echo $Client_view->TableLeftColumnClass ?>"><span id="elh_Client_ClientToken"><?php echo $Client_view->ClientToken->caption() ?></span></td>
		<td data-name="ClientToken" <?php echo $Client_view->ClientToken->cellAttributes() ?>>
<span id="el_Client_ClientToken">
<span<?php echo $Client_view->ClientToken->viewAttributes() ?>><?php echo $Client_view->ClientToken->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("Pedido", explode(",", $Client->getCurrentDetailTable())) && $Pedido->DetailView) {
?>
<?php if ($Client->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("Pedido", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "Pedidogrid.php" ?>
<?php } ?>
<?php
	if (in_array("Checkin", explode(",", $Client->getCurrentDetailTable())) && $Checkin->DetailView) {
?>
<?php if ($Client->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("Checkin", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "Checkingrid.php" ?>
<?php } ?>
</form>
<?php
$Client_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$Client_view->isExport()) { ?>
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
$Client_view->terminate();
?>