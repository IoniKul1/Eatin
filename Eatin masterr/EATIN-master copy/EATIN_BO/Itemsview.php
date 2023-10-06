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
$Items_view = new Items_view();

// Run the page
$Items_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Items_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$Items_view->isExport()) { ?>
<script>
var fItemsview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fItemsview = currentForm = new ew.Form("fItemsview", "view");
	loadjs.done("fItemsview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$Items_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Items_view->ExportOptions->render("body") ?>
<?php $Items_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $Items_view->showPageHeader(); ?>
<?php
$Items_view->showMessage();
?>
<form name="fItemsview" id="fItemsview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Items">
<input type="hidden" name="modal" value="<?php echo (int)$Items_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Items_view->ID->Visible) { // ID ?>
	<tr id="r_ID">
		<td class="<?php echo $Items_view->TableLeftColumnClass ?>"><span id="elh_Items_ID"><?php echo $Items_view->ID->caption() ?></span></td>
		<td data-name="ID" <?php echo $Items_view->ID->cellAttributes() ?>>
<span id="el_Items_ID">
<span<?php echo $Items_view->ID->viewAttributes() ?>><?php echo $Items_view->ID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Items_view->ID_Categorias->Visible) { // ID_Categorias ?>
	<tr id="r_ID_Categorias">
		<td class="<?php echo $Items_view->TableLeftColumnClass ?>"><span id="elh_Items_ID_Categorias"><?php echo $Items_view->ID_Categorias->caption() ?></span></td>
		<td data-name="ID_Categorias" <?php echo $Items_view->ID_Categorias->cellAttributes() ?>>
<span id="el_Items_ID_Categorias">
<span<?php echo $Items_view->ID_Categorias->viewAttributes() ?>><?php echo $Items_view->ID_Categorias->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Items_view->ID_Restaurant->Visible) { // ID_Restaurant ?>
	<tr id="r_ID_Restaurant">
		<td class="<?php echo $Items_view->TableLeftColumnClass ?>"><span id="elh_Items_ID_Restaurant"><?php echo $Items_view->ID_Restaurant->caption() ?></span></td>
		<td data-name="ID_Restaurant" <?php echo $Items_view->ID_Restaurant->cellAttributes() ?>>
<span id="el_Items_ID_Restaurant">
<span<?php echo $Items_view->ID_Restaurant->viewAttributes() ?>><?php echo $Items_view->ID_Restaurant->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Items_view->DateCreation->Visible) { // DateCreation ?>
	<tr id="r_DateCreation">
		<td class="<?php echo $Items_view->TableLeftColumnClass ?>"><span id="elh_Items_DateCreation"><?php echo $Items_view->DateCreation->caption() ?></span></td>
		<td data-name="DateCreation" <?php echo $Items_view->DateCreation->cellAttributes() ?>>
<span id="el_Items_DateCreation">
<span<?php echo $Items_view->DateCreation->viewAttributes() ?>><?php echo $Items_view->DateCreation->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Items_view->DateLastUpdate->Visible) { // DateLastUpdate ?>
	<tr id="r_DateLastUpdate">
		<td class="<?php echo $Items_view->TableLeftColumnClass ?>"><span id="elh_Items_DateLastUpdate"><?php echo $Items_view->DateLastUpdate->caption() ?></span></td>
		<td data-name="DateLastUpdate" <?php echo $Items_view->DateLastUpdate->cellAttributes() ?>>
<span id="el_Items_DateLastUpdate">
<span<?php echo $Items_view->DateLastUpdate->viewAttributes() ?>><?php echo $Items_view->DateLastUpdate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Items_view->Nombre->Visible) { // Nombre ?>
	<tr id="r_Nombre">
		<td class="<?php echo $Items_view->TableLeftColumnClass ?>"><span id="elh_Items_Nombre"><?php echo $Items_view->Nombre->caption() ?></span></td>
		<td data-name="Nombre" <?php echo $Items_view->Nombre->cellAttributes() ?>>
<span id="el_Items_Nombre">
<span<?php echo $Items_view->Nombre->viewAttributes() ?>><?php echo $Items_view->Nombre->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Items_view->Precio->Visible) { // Precio ?>
	<tr id="r_Precio">
		<td class="<?php echo $Items_view->TableLeftColumnClass ?>"><span id="elh_Items_Precio"><?php echo $Items_view->Precio->caption() ?></span></td>
		<td data-name="Precio" <?php echo $Items_view->Precio->cellAttributes() ?>>
<span id="el_Items_Precio">
<span<?php echo $Items_view->Precio->viewAttributes() ?>><?php echo $Items_view->Precio->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Items_view->Active->Visible) { // Active ?>
	<tr id="r_Active">
		<td class="<?php echo $Items_view->TableLeftColumnClass ?>"><span id="elh_Items_Active"><?php echo $Items_view->Active->caption() ?></span></td>
		<td data-name="Active" <?php echo $Items_view->Active->cellAttributes() ?>>
<span id="el_Items_Active">
<span<?php echo $Items_view->Active->viewAttributes() ?>><?php echo $Items_view->Active->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Items_view->Stock->Visible) { // Stock ?>
	<tr id="r_Stock">
		<td class="<?php echo $Items_view->TableLeftColumnClass ?>"><span id="elh_Items_Stock"><?php echo $Items_view->Stock->caption() ?></span></td>
		<td data-name="Stock" <?php echo $Items_view->Stock->cellAttributes() ?>>
<span id="el_Items_Stock">
<span<?php echo $Items_view->Stock->viewAttributes() ?>><?php echo $Items_view->Stock->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Items_view->Img1->Visible) { // Img1 ?>
	<tr id="r_Img1">
		<td class="<?php echo $Items_view->TableLeftColumnClass ?>"><span id="elh_Items_Img1"><?php echo $Items_view->Img1->caption() ?></span></td>
		<td data-name="Img1" <?php echo $Items_view->Img1->cellAttributes() ?>>
<span id="el_Items_Img1">
<span><?php echo GetFileViewTag($Items_view->Img1, $Items_view->Img1->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Items_view->Img2->Visible) { // Img2 ?>
	<tr id="r_Img2">
		<td class="<?php echo $Items_view->TableLeftColumnClass ?>"><span id="elh_Items_Img2"><?php echo $Items_view->Img2->caption() ?></span></td>
		<td data-name="Img2" <?php echo $Items_view->Img2->cellAttributes() ?>>
<span id="el_Items_Img2">
<span><?php echo GetFileViewTag($Items_view->Img2, $Items_view->Img2->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Items_view->Img3->Visible) { // Img3 ?>
	<tr id="r_Img3">
		<td class="<?php echo $Items_view->TableLeftColumnClass ?>"><span id="elh_Items_Img3"><?php echo $Items_view->Img3->caption() ?></span></td>
		<td data-name="Img3" <?php echo $Items_view->Img3->cellAttributes() ?>>
<span id="el_Items_Img3">
<span><?php echo GetFileViewTag($Items_view->Img3, $Items_view->Img3->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Items_view->Img4->Visible) { // Img4 ?>
	<tr id="r_Img4">
		<td class="<?php echo $Items_view->TableLeftColumnClass ?>"><span id="elh_Items_Img4"><?php echo $Items_view->Img4->caption() ?></span></td>
		<td data-name="Img4" <?php echo $Items_view->Img4->cellAttributes() ?>>
<span id="el_Items_Img4">
<span><?php echo GetFileViewTag($Items_view->Img4, $Items_view->Img4->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Items_view->Vid1->Visible) { // Vid1 ?>
	<tr id="r_Vid1">
		<td class="<?php echo $Items_view->TableLeftColumnClass ?>"><span id="elh_Items_Vid1"><?php echo $Items_view->Vid1->caption() ?></span></td>
		<td data-name="Vid1" <?php echo $Items_view->Vid1->cellAttributes() ?>>
<span id="el_Items_Vid1">
<span<?php echo $Items_view->Vid1->viewAttributes() ?>><?php echo GetFileViewTag($Items_view->Vid1, $Items_view->Vid1->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Items_view->Vid2->Visible) { // Vid2 ?>
	<tr id="r_Vid2">
		<td class="<?php echo $Items_view->TableLeftColumnClass ?>"><span id="elh_Items_Vid2"><?php echo $Items_view->Vid2->caption() ?></span></td>
		<td data-name="Vid2" <?php echo $Items_view->Vid2->cellAttributes() ?>>
<span id="el_Items_Vid2">
<span<?php echo $Items_view->Vid2->viewAttributes() ?>><?php echo GetFileViewTag($Items_view->Vid2, $Items_view->Vid2->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Items_view->Descripcion->Visible) { // Descripcion ?>
	<tr id="r_Descripcion">
		<td class="<?php echo $Items_view->TableLeftColumnClass ?>"><span id="elh_Items_Descripcion"><?php echo $Items_view->Descripcion->caption() ?></span></td>
		<td data-name="Descripcion" <?php echo $Items_view->Descripcion->cellAttributes() ?>>
<span id="el_Items_Descripcion">
<span<?php echo $Items_view->Descripcion->viewAttributes() ?>><?php echo $Items_view->Descripcion->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Items_view->NombreEN->Visible) { // NombreEN ?>
	<tr id="r_NombreEN">
		<td class="<?php echo $Items_view->TableLeftColumnClass ?>"><span id="elh_Items_NombreEN"><?php echo $Items_view->NombreEN->caption() ?></span></td>
		<td data-name="NombreEN" <?php echo $Items_view->NombreEN->cellAttributes() ?>>
<span id="el_Items_NombreEN">
<span<?php echo $Items_view->NombreEN->viewAttributes() ?>><?php echo $Items_view->NombreEN->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Items_view->DescripcionEN->Visible) { // DescripcionEN ?>
	<tr id="r_DescripcionEN">
		<td class="<?php echo $Items_view->TableLeftColumnClass ?>"><span id="elh_Items_DescripcionEN"><?php echo $Items_view->DescripcionEN->caption() ?></span></td>
		<td data-name="DescripcionEN" <?php echo $Items_view->DescripcionEN->cellAttributes() ?>>
<span id="el_Items_DescripcionEN">
<span<?php echo $Items_view->DescripcionEN->viewAttributes() ?>><?php echo $Items_view->DescripcionEN->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$Items_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$Items_view->isExport()) { ?>
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
$Items_view->terminate();
?>