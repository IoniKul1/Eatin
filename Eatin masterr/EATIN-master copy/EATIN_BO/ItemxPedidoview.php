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
$ItemxPedido_view = new ItemxPedido_view();

// Run the page
$ItemxPedido_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ItemxPedido_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$ItemxPedido_view->isExport()) { ?>
<script>
var fItemxPedidoview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fItemxPedidoview = currentForm = new ew.Form("fItemxPedidoview", "view");
	loadjs.done("fItemxPedidoview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$ItemxPedido_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $ItemxPedido_view->ExportOptions->render("body") ?>
<?php $ItemxPedido_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $ItemxPedido_view->showPageHeader(); ?>
<?php
$ItemxPedido_view->showMessage();
?>
<form name="fItemxPedidoview" id="fItemxPedidoview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ItemxPedido">
<input type="hidden" name="modal" value="<?php echo (int)$ItemxPedido_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($ItemxPedido_view->ID->Visible) { // ID ?>
	<tr id="r_ID">
		<td class="<?php echo $ItemxPedido_view->TableLeftColumnClass ?>"><span id="elh_ItemxPedido_ID"><?php echo $ItemxPedido_view->ID->caption() ?></span></td>
		<td data-name="ID" <?php echo $ItemxPedido_view->ID->cellAttributes() ?>>
<span id="el_ItemxPedido_ID">
<span<?php echo $ItemxPedido_view->ID->viewAttributes() ?>><?php echo $ItemxPedido_view->ID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ItemxPedido_view->ID_Item->Visible) { // ID_Item ?>
	<tr id="r_ID_Item">
		<td class="<?php echo $ItemxPedido_view->TableLeftColumnClass ?>"><span id="elh_ItemxPedido_ID_Item"><?php echo $ItemxPedido_view->ID_Item->caption() ?></span></td>
		<td data-name="ID_Item" <?php echo $ItemxPedido_view->ID_Item->cellAttributes() ?>>
<span id="el_ItemxPedido_ID_Item">
<span<?php echo $ItemxPedido_view->ID_Item->viewAttributes() ?>><?php echo $ItemxPedido_view->ID_Item->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ItemxPedido_view->ID_Restaurant->Visible) { // ID_Restaurant ?>
	<tr id="r_ID_Restaurant">
		<td class="<?php echo $ItemxPedido_view->TableLeftColumnClass ?>"><span id="elh_ItemxPedido_ID_Restaurant"><?php echo $ItemxPedido_view->ID_Restaurant->caption() ?></span></td>
		<td data-name="ID_Restaurant" <?php echo $ItemxPedido_view->ID_Restaurant->cellAttributes() ?>>
<span id="el_ItemxPedido_ID_Restaurant">
<span<?php echo $ItemxPedido_view->ID_Restaurant->viewAttributes() ?>><?php echo $ItemxPedido_view->ID_Restaurant->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ItemxPedido_view->ID_Client->Visible) { // ID_Client ?>
	<tr id="r_ID_Client">
		<td class="<?php echo $ItemxPedido_view->TableLeftColumnClass ?>"><span id="elh_ItemxPedido_ID_Client"><?php echo $ItemxPedido_view->ID_Client->caption() ?></span></td>
		<td data-name="ID_Client" <?php echo $ItemxPedido_view->ID_Client->cellAttributes() ?>>
<span id="el_ItemxPedido_ID_Client">
<span<?php echo $ItemxPedido_view->ID_Client->viewAttributes() ?>><?php echo $ItemxPedido_view->ID_Client->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ItemxPedido_view->DateCreation->Visible) { // DateCreation ?>
	<tr id="r_DateCreation">
		<td class="<?php echo $ItemxPedido_view->TableLeftColumnClass ?>"><span id="elh_ItemxPedido_DateCreation"><?php echo $ItemxPedido_view->DateCreation->caption() ?></span></td>
		<td data-name="DateCreation" <?php echo $ItemxPedido_view->DateCreation->cellAttributes() ?>>
<span id="el_ItemxPedido_DateCreation">
<span<?php echo $ItemxPedido_view->DateCreation->viewAttributes() ?>><?php echo $ItemxPedido_view->DateCreation->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ItemxPedido_view->DateLastUpdate->Visible) { // DateLastUpdate ?>
	<tr id="r_DateLastUpdate">
		<td class="<?php echo $ItemxPedido_view->TableLeftColumnClass ?>"><span id="elh_ItemxPedido_DateLastUpdate"><?php echo $ItemxPedido_view->DateLastUpdate->caption() ?></span></td>
		<td data-name="DateLastUpdate" <?php echo $ItemxPedido_view->DateLastUpdate->cellAttributes() ?>>
<span id="el_ItemxPedido_DateLastUpdate">
<span<?php echo $ItemxPedido_view->DateLastUpdate->viewAttributes() ?>><?php echo $ItemxPedido_view->DateLastUpdate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ItemxPedido_view->Comments->Visible) { // Comments ?>
	<tr id="r_Comments">
		<td class="<?php echo $ItemxPedido_view->TableLeftColumnClass ?>"><span id="elh_ItemxPedido_Comments"><?php echo $ItemxPedido_view->Comments->caption() ?></span></td>
		<td data-name="Comments" <?php echo $ItemxPedido_view->Comments->cellAttributes() ?>>
<span id="el_ItemxPedido_Comments">
<span<?php echo $ItemxPedido_view->Comments->viewAttributes() ?>><?php echo $ItemxPedido_view->Comments->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ItemxPedido_view->ID_Pedido->Visible) { // ID_Pedido ?>
	<tr id="r_ID_Pedido">
		<td class="<?php echo $ItemxPedido_view->TableLeftColumnClass ?>"><span id="elh_ItemxPedido_ID_Pedido"><?php echo $ItemxPedido_view->ID_Pedido->caption() ?></span></td>
		<td data-name="ID_Pedido" <?php echo $ItemxPedido_view->ID_Pedido->cellAttributes() ?>>
<span id="el_ItemxPedido_ID_Pedido">
<span<?php echo $ItemxPedido_view->ID_Pedido->viewAttributes() ?>><?php echo $ItemxPedido_view->ID_Pedido->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ItemxPedido_view->Compartir->Visible) { // Compartir ?>
	<tr id="r_Compartir">
		<td class="<?php echo $ItemxPedido_view->TableLeftColumnClass ?>"><span id="elh_ItemxPedido_Compartir"><?php echo $ItemxPedido_view->Compartir->caption() ?></span></td>
		<td data-name="Compartir" <?php echo $ItemxPedido_view->Compartir->cellAttributes() ?>>
<span id="el_ItemxPedido_Compartir">
<span<?php echo $ItemxPedido_view->Compartir->viewAttributes() ?>><?php echo $ItemxPedido_view->Compartir->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ItemxPedido_view->Cantidad->Visible) { // Cantidad ?>
	<tr id="r_Cantidad">
		<td class="<?php echo $ItemxPedido_view->TableLeftColumnClass ?>"><span id="elh_ItemxPedido_Cantidad"><?php echo $ItemxPedido_view->Cantidad->caption() ?></span></td>
		<td data-name="Cantidad" <?php echo $ItemxPedido_view->Cantidad->cellAttributes() ?>>
<span id="el_ItemxPedido_Cantidad">
<span<?php echo $ItemxPedido_view->Cantidad->viewAttributes() ?>><?php echo $ItemxPedido_view->Cantidad->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$ItemxPedido_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$ItemxPedido_view->isExport()) { ?>
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
$ItemxPedido_view->terminate();
?>