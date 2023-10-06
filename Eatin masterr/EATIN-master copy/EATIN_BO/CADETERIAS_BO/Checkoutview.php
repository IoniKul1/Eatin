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
$Checkout_view = new Checkout_view();

// Run the page
$Checkout_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Checkout_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$Checkout_view->isExport()) { ?>
<script>
var fCheckoutview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fCheckoutview = currentForm = new ew.Form("fCheckoutview", "view");
	loadjs.done("fCheckoutview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$Checkout_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Checkout_view->ExportOptions->render("body") ?>
<?php $Checkout_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $Checkout_view->showPageHeader(); ?>
<?php
$Checkout_view->showMessage();
?>
<form name="fCheckoutview" id="fCheckoutview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Checkout">
<input type="hidden" name="modal" value="<?php echo (int)$Checkout_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Checkout_view->ID->Visible) { // ID ?>
	<tr id="r_ID">
		<td class="<?php echo $Checkout_view->TableLeftColumnClass ?>"><span id="elh_Checkout_ID"><?php echo $Checkout_view->ID->caption() ?></span></td>
		<td data-name="ID" <?php echo $Checkout_view->ID->cellAttributes() ?>>
<span id="el_Checkout_ID">
<span<?php echo $Checkout_view->ID->viewAttributes() ?>><?php echo $Checkout_view->ID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Checkout_view->ID_Cadete->Visible) { // ID_Cadete ?>
	<tr id="r_ID_Cadete">
		<td class="<?php echo $Checkout_view->TableLeftColumnClass ?>"><span id="elh_Checkout_ID_Cadete"><?php echo $Checkout_view->ID_Cadete->caption() ?></span></td>
		<td data-name="ID_Cadete" <?php echo $Checkout_view->ID_Cadete->cellAttributes() ?>>
<span id="el_Checkout_ID_Cadete">
<span<?php echo $Checkout_view->ID_Cadete->viewAttributes() ?>><?php echo $Checkout_view->ID_Cadete->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Checkout_view->ID_PedidoACadeteria->Visible) { // ID_PedidoACadeteria ?>
	<tr id="r_ID_PedidoACadeteria">
		<td class="<?php echo $Checkout_view->TableLeftColumnClass ?>"><span id="elh_Checkout_ID_PedidoACadeteria"><?php echo $Checkout_view->ID_PedidoACadeteria->caption() ?></span></td>
		<td data-name="ID_PedidoACadeteria" <?php echo $Checkout_view->ID_PedidoACadeteria->cellAttributes() ?>>
<span id="el_Checkout_ID_PedidoACadeteria">
<span<?php echo $Checkout_view->ID_PedidoACadeteria->viewAttributes() ?>><?php echo $Checkout_view->ID_PedidoACadeteria->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Checkout_view->FechaCreacion->Visible) { // FechaCreacion ?>
	<tr id="r_FechaCreacion">
		<td class="<?php echo $Checkout_view->TableLeftColumnClass ?>"><span id="elh_Checkout_FechaCreacion"><?php echo $Checkout_view->FechaCreacion->caption() ?></span></td>
		<td data-name="FechaCreacion" <?php echo $Checkout_view->FechaCreacion->cellAttributes() ?>>
<span id="el_Checkout_FechaCreacion">
<span<?php echo $Checkout_view->FechaCreacion->viewAttributes() ?>><?php echo $Checkout_view->FechaCreacion->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Checkout_view->ID_Cadeteria->Visible) { // ID_Cadeteria ?>
	<tr id="r_ID_Cadeteria">
		<td class="<?php echo $Checkout_view->TableLeftColumnClass ?>"><span id="elh_Checkout_ID_Cadeteria"><?php echo $Checkout_view->ID_Cadeteria->caption() ?></span></td>
		<td data-name="ID_Cadeteria" <?php echo $Checkout_view->ID_Cadeteria->cellAttributes() ?>>
<span id="el_Checkout_ID_Cadeteria">
<span<?php echo $Checkout_view->ID_Cadeteria->viewAttributes() ?>><?php echo $Checkout_view->ID_Cadeteria->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$Checkout_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$Checkout_view->isExport()) { ?>
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
$Checkout_view->terminate();
?>