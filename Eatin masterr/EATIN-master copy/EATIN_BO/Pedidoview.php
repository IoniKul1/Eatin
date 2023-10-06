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
$Pedido_view = new Pedido_view();

// Run the page
$Pedido_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Pedido_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$Pedido_view->isExport()) { ?>
<script>
var fPedidoview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fPedidoview = currentForm = new ew.Form("fPedidoview", "view");
	loadjs.done("fPedidoview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$Pedido_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Pedido_view->ExportOptions->render("body") ?>
<?php $Pedido_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $Pedido_view->showPageHeader(); ?>
<?php
$Pedido_view->showMessage();
?>
<form name="fPedidoview" id="fPedidoview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Pedido">
<input type="hidden" name="modal" value="<?php echo (int)$Pedido_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Pedido_view->ID->Visible) { // ID ?>
	<tr id="r_ID">
		<td class="<?php echo $Pedido_view->TableLeftColumnClass ?>"><span id="elh_Pedido_ID"><?php echo $Pedido_view->ID->caption() ?></span></td>
		<td data-name="ID" <?php echo $Pedido_view->ID->cellAttributes() ?>>
<span id="el_Pedido_ID">
<span<?php echo $Pedido_view->ID->viewAttributes() ?>><?php echo $Pedido_view->ID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Pedido_view->ID_Client->Visible) { // ID_Client ?>
	<tr id="r_ID_Client">
		<td class="<?php echo $Pedido_view->TableLeftColumnClass ?>"><span id="elh_Pedido_ID_Client"><?php echo $Pedido_view->ID_Client->caption() ?></span></td>
		<td data-name="ID_Client" <?php echo $Pedido_view->ID_Client->cellAttributes() ?>>
<span id="el_Pedido_ID_Client">
<span<?php echo $Pedido_view->ID_Client->viewAttributes() ?>><?php if (!EmptyString($Pedido_view->ID_Client->getViewValue()) && $Pedido_view->ID_Client->linkAttributes() != "") { ?>
<a<?php echo $Pedido_view->ID_Client->linkAttributes() ?>><?php echo $Pedido_view->ID_Client->getViewValue() ?></a>
<?php } else { ?>
<?php echo $Pedido_view->ID_Client->getViewValue() ?>
<?php } ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Pedido_view->ID_Status->Visible) { // ID_Status ?>
	<tr id="r_ID_Status">
		<td class="<?php echo $Pedido_view->TableLeftColumnClass ?>"><span id="elh_Pedido_ID_Status"><?php echo $Pedido_view->ID_Status->caption() ?></span></td>
		<td data-name="ID_Status" <?php echo $Pedido_view->ID_Status->cellAttributes() ?>>
<span id="el_Pedido_ID_Status">
<span<?php echo $Pedido_view->ID_Status->viewAttributes() ?>><?php echo $Pedido_view->ID_Status->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Pedido_view->ID_Restaurant->Visible) { // ID_Restaurant ?>
	<tr id="r_ID_Restaurant">
		<td class="<?php echo $Pedido_view->TableLeftColumnClass ?>"><span id="elh_Pedido_ID_Restaurant"><?php echo $Pedido_view->ID_Restaurant->caption() ?></span></td>
		<td data-name="ID_Restaurant" <?php echo $Pedido_view->ID_Restaurant->cellAttributes() ?>>
<span id="el_Pedido_ID_Restaurant">
<span<?php echo $Pedido_view->ID_Restaurant->viewAttributes() ?>><?php echo $Pedido_view->ID_Restaurant->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Pedido_view->DateCreation->Visible) { // DateCreation ?>
	<tr id="r_DateCreation">
		<td class="<?php echo $Pedido_view->TableLeftColumnClass ?>"><span id="elh_Pedido_DateCreation"><?php echo $Pedido_view->DateCreation->caption() ?></span></td>
		<td data-name="DateCreation" <?php echo $Pedido_view->DateCreation->cellAttributes() ?>>
<span id="el_Pedido_DateCreation">
<span<?php echo $Pedido_view->DateCreation->viewAttributes() ?>><?php echo $Pedido_view->DateCreation->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Pedido_view->DateLastUpdate->Visible) { // DateLastUpdate ?>
	<tr id="r_DateLastUpdate">
		<td class="<?php echo $Pedido_view->TableLeftColumnClass ?>"><span id="elh_Pedido_DateLastUpdate"><?php echo $Pedido_view->DateLastUpdate->caption() ?></span></td>
		<td data-name="DateLastUpdate" <?php echo $Pedido_view->DateLastUpdate->cellAttributes() ?>>
<span id="el_Pedido_DateLastUpdate">
<span<?php echo $Pedido_view->DateLastUpdate->viewAttributes() ?>><?php echo $Pedido_view->DateLastUpdate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Pedido_view->ID_Table->Visible) { // ID_Table ?>
	<tr id="r_ID_Table">
		<td class="<?php echo $Pedido_view->TableLeftColumnClass ?>"><span id="elh_Pedido_ID_Table"><?php echo $Pedido_view->ID_Table->caption() ?></span></td>
		<td data-name="ID_Table" <?php echo $Pedido_view->ID_Table->cellAttributes() ?>>
<span id="el_Pedido_ID_Table">
<span<?php echo $Pedido_view->ID_Table->viewAttributes() ?>><?php echo $Pedido_view->ID_Table->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("ItemxPedido", explode(",", $Pedido->getCurrentDetailTable())) && $ItemxPedido->DetailView) {
?>
<?php if ($Pedido->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("ItemxPedido", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "ItemxPedidogrid.php" ?>
<?php } ?>
</form>
<?php
$Pedido_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$Pedido_view->isExport()) { ?>
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
$Pedido_view->terminate();
?>