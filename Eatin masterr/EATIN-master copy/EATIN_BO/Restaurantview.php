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
$Restaurant_view = new Restaurant_view();

// Run the page
$Restaurant_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Restaurant_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$Restaurant_view->isExport()) { ?>
<script>
var fRestaurantview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fRestaurantview = currentForm = new ew.Form("fRestaurantview", "view");
	loadjs.done("fRestaurantview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$Restaurant_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Restaurant_view->ExportOptions->render("body") ?>
<?php $Restaurant_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $Restaurant_view->showPageHeader(); ?>
<?php
$Restaurant_view->showMessage();
?>
<form name="fRestaurantview" id="fRestaurantview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Restaurant">
<input type="hidden" name="modal" value="<?php echo (int)$Restaurant_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Restaurant_view->ID->Visible) { // ID ?>
	<tr id="r_ID">
		<td class="<?php echo $Restaurant_view->TableLeftColumnClass ?>"><span id="elh_Restaurant_ID"><?php echo $Restaurant_view->ID->caption() ?></span></td>
		<td data-name="ID" <?php echo $Restaurant_view->ID->cellAttributes() ?>>
<span id="el_Restaurant_ID">
<span<?php echo $Restaurant_view->ID->viewAttributes() ?>><?php echo $Restaurant_view->ID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Restaurant_view->ID_State->Visible) { // ID_State ?>
	<tr id="r_ID_State">
		<td class="<?php echo $Restaurant_view->TableLeftColumnClass ?>"><span id="elh_Restaurant_ID_State"><?php echo $Restaurant_view->ID_State->caption() ?></span></td>
		<td data-name="ID_State" <?php echo $Restaurant_view->ID_State->cellAttributes() ?>>
<span id="el_Restaurant_ID_State">
<span<?php echo $Restaurant_view->ID_State->viewAttributes() ?>><?php echo $Restaurant_view->ID_State->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Restaurant_view->DateCreation->Visible) { // DateCreation ?>
	<tr id="r_DateCreation">
		<td class="<?php echo $Restaurant_view->TableLeftColumnClass ?>"><span id="elh_Restaurant_DateCreation"><?php echo $Restaurant_view->DateCreation->caption() ?></span></td>
		<td data-name="DateCreation" <?php echo $Restaurant_view->DateCreation->cellAttributes() ?>>
<span id="el_Restaurant_DateCreation">
<span<?php echo $Restaurant_view->DateCreation->viewAttributes() ?>><?php echo $Restaurant_view->DateCreation->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Restaurant_view->DateLastUpdate->Visible) { // DateLastUpdate ?>
	<tr id="r_DateLastUpdate">
		<td class="<?php echo $Restaurant_view->TableLeftColumnClass ?>"><span id="elh_Restaurant_DateLastUpdate"><?php echo $Restaurant_view->DateLastUpdate->caption() ?></span></td>
		<td data-name="DateLastUpdate" <?php echo $Restaurant_view->DateLastUpdate->cellAttributes() ?>>
<span id="el_Restaurant_DateLastUpdate">
<span<?php echo $Restaurant_view->DateLastUpdate->viewAttributes() ?>><?php echo $Restaurant_view->DateLastUpdate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Restaurant_view->Nombre->Visible) { // Nombre ?>
	<tr id="r_Nombre">
		<td class="<?php echo $Restaurant_view->TableLeftColumnClass ?>"><span id="elh_Restaurant_Nombre"><?php echo $Restaurant_view->Nombre->caption() ?></span></td>
		<td data-name="Nombre" <?php echo $Restaurant_view->Nombre->cellAttributes() ?>>
<span id="el_Restaurant_Nombre">
<span<?php echo $Restaurant_view->Nombre->viewAttributes() ?>><?php echo $Restaurant_view->Nombre->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Restaurant_view->Lat->Visible) { // Lat ?>
	<tr id="r_Lat">
		<td class="<?php echo $Restaurant_view->TableLeftColumnClass ?>"><span id="elh_Restaurant_Lat"><?php echo $Restaurant_view->Lat->caption() ?></span></td>
		<td data-name="Lat" <?php echo $Restaurant_view->Lat->cellAttributes() ?>>
<span id="el_Restaurant_Lat">
<span<?php echo $Restaurant_view->Lat->viewAttributes() ?>><?php echo $Restaurant_view->Lat->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Restaurant_view->Lon->Visible) { // Lon ?>
	<tr id="r_Lon">
		<td class="<?php echo $Restaurant_view->TableLeftColumnClass ?>"><span id="elh_Restaurant_Lon"><?php echo $Restaurant_view->Lon->caption() ?></span></td>
		<td data-name="Lon" <?php echo $Restaurant_view->Lon->cellAttributes() ?>>
<span id="el_Restaurant_Lon">
<span<?php echo $Restaurant_view->Lon->viewAttributes() ?>><?php echo $Restaurant_view->Lon->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Restaurant_view->GoogleGeocodeAddress->Visible) { // GoogleGeocodeAddress ?>
	<tr id="r_GoogleGeocodeAddress">
		<td class="<?php echo $Restaurant_view->TableLeftColumnClass ?>"><span id="elh_Restaurant_GoogleGeocodeAddress"><?php echo $Restaurant_view->GoogleGeocodeAddress->caption() ?></span></td>
		<td data-name="GoogleGeocodeAddress" <?php echo $Restaurant_view->GoogleGeocodeAddress->cellAttributes() ?>>
<span id="el_Restaurant_GoogleGeocodeAddress">
<span<?php echo $Restaurant_view->GoogleGeocodeAddress->viewAttributes() ?>><?php echo $Restaurant_view->GoogleGeocodeAddress->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Restaurant_view->Address->Visible) { // Address ?>
	<tr id="r_Address">
		<td class="<?php echo $Restaurant_view->TableLeftColumnClass ?>"><span id="elh_Restaurant_Address"><?php echo $Restaurant_view->Address->caption() ?></span></td>
		<td data-name="Address" <?php echo $Restaurant_view->Address->cellAttributes() ?>>
<span id="el_Restaurant_Address">
<span<?php echo $Restaurant_view->Address->viewAttributes() ?>><?php echo $Restaurant_view->Address->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Restaurant_view->Deactivated->Visible) { // Deactivated ?>
	<tr id="r_Deactivated">
		<td class="<?php echo $Restaurant_view->TableLeftColumnClass ?>"><span id="elh_Restaurant_Deactivated"><?php echo $Restaurant_view->Deactivated->caption() ?></span></td>
		<td data-name="Deactivated" <?php echo $Restaurant_view->Deactivated->cellAttributes() ?>>
<span id="el_Restaurant_Deactivated">
<span<?php echo $Restaurant_view->Deactivated->viewAttributes() ?>><?php echo $Restaurant_view->Deactivated->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Restaurant_view->Suspended->Visible) { // Suspended ?>
	<tr id="r_Suspended">
		<td class="<?php echo $Restaurant_view->TableLeftColumnClass ?>"><span id="elh_Restaurant_Suspended"><?php echo $Restaurant_view->Suspended->caption() ?></span></td>
		<td data-name="Suspended" <?php echo $Restaurant_view->Suspended->cellAttributes() ?>>
<span id="el_Restaurant_Suspended">
<span<?php echo $Restaurant_view->Suspended->viewAttributes() ?>><?php echo $Restaurant_view->Suspended->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Restaurant_view->ActualQRGrantCode->Visible) { // ActualQRGrantCode ?>
	<tr id="r_ActualQRGrantCode">
		<td class="<?php echo $Restaurant_view->TableLeftColumnClass ?>"><span id="elh_Restaurant_ActualQRGrantCode"><?php echo $Restaurant_view->ActualQRGrantCode->caption() ?></span></td>
		<td data-name="ActualQRGrantCode" <?php echo $Restaurant_view->ActualQRGrantCode->cellAttributes() ?>>
<span id="el_Restaurant_ActualQRGrantCode">
<span<?php echo $Restaurant_view->ActualQRGrantCode->viewAttributes() ?>><?php echo $Restaurant_view->ActualQRGrantCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Restaurant_view->_Email->Visible) { // Email ?>
	<tr id="r__Email">
		<td class="<?php echo $Restaurant_view->TableLeftColumnClass ?>"><span id="elh_Restaurant__Email"><?php echo $Restaurant_view->_Email->caption() ?></span></td>
		<td data-name="_Email" <?php echo $Restaurant_view->_Email->cellAttributes() ?>>
<span id="el_Restaurant__Email">
<span<?php echo $Restaurant_view->_Email->viewAttributes() ?>><?php echo $Restaurant_view->_Email->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Restaurant_view->Password->Visible) { // Password ?>
	<tr id="r_Password">
		<td class="<?php echo $Restaurant_view->TableLeftColumnClass ?>"><span id="elh_Restaurant_Password"><?php echo $Restaurant_view->Password->caption() ?></span></td>
		<td data-name="Password" <?php echo $Restaurant_view->Password->cellAttributes() ?>>
<span id="el_Restaurant_Password">
<span<?php echo $Restaurant_view->Password->viewAttributes() ?>><?php echo $Restaurant_view->Password->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Restaurant_view->SplashImg->Visible) { // SplashImg ?>
	<tr id="r_SplashImg">
		<td class="<?php echo $Restaurant_view->TableLeftColumnClass ?>"><span id="elh_Restaurant_SplashImg"><?php echo $Restaurant_view->SplashImg->caption() ?></span></td>
		<td data-name="SplashImg" <?php echo $Restaurant_view->SplashImg->cellAttributes() ?>>
<span id="el_Restaurant_SplashImg">
<span><?php echo GetFileViewTag($Restaurant_view->SplashImg, $Restaurant_view->SplashImg->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Restaurant_view->LogoSize1->Visible) { // LogoSize1 ?>
	<tr id="r_LogoSize1">
		<td class="<?php echo $Restaurant_view->TableLeftColumnClass ?>"><span id="elh_Restaurant_LogoSize1"><?php echo $Restaurant_view->LogoSize1->caption() ?></span></td>
		<td data-name="LogoSize1" <?php echo $Restaurant_view->LogoSize1->cellAttributes() ?>>
<span id="el_Restaurant_LogoSize1">
<span><?php echo GetFileViewTag($Restaurant_view->LogoSize1, $Restaurant_view->LogoSize1->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Restaurant_view->LogoSize2->Visible) { // LogoSize2 ?>
	<tr id="r_LogoSize2">
		<td class="<?php echo $Restaurant_view->TableLeftColumnClass ?>"><span id="elh_Restaurant_LogoSize2"><?php echo $Restaurant_view->LogoSize2->caption() ?></span></td>
		<td data-name="LogoSize2" <?php echo $Restaurant_view->LogoSize2->cellAttributes() ?>>
<span id="el_Restaurant_LogoSize2">
<span><?php echo GetFileViewTag($Restaurant_view->LogoSize2, $Restaurant_view->LogoSize2->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Restaurant_view->AppCSS->Visible) { // AppCSS ?>
	<tr id="r_AppCSS">
		<td class="<?php echo $Restaurant_view->TableLeftColumnClass ?>"><span id="elh_Restaurant_AppCSS"><?php echo $Restaurant_view->AppCSS->caption() ?></span></td>
		<td data-name="AppCSS" <?php echo $Restaurant_view->AppCSS->cellAttributes() ?>>
<span id="el_Restaurant_AppCSS">
<span<?php echo $Restaurant_view->AppCSS->viewAttributes() ?>><?php echo GetFileViewTag($Restaurant_view->AppCSS, $Restaurant_view->AppCSS->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($Restaurant_view->SplashVideo->Visible) { // SplashVideo ?>
	<tr id="r_SplashVideo">
		<td class="<?php echo $Restaurant_view->TableLeftColumnClass ?>"><span id="elh_Restaurant_SplashVideo"><?php echo $Restaurant_view->SplashVideo->caption() ?></span></td>
		<td data-name="SplashVideo" <?php echo $Restaurant_view->SplashVideo->cellAttributes() ?>>
<span id="el_Restaurant_SplashVideo">
<span<?php echo $Restaurant_view->SplashVideo->viewAttributes() ?>><?php echo GetFileViewTag($Restaurant_view->SplashVideo, $Restaurant_view->SplashVideo->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("Client", explode(",", $Restaurant->getCurrentDetailTable())) && $Client->DetailView) {
?>
<?php if ($Restaurant->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("Client", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "Clientgrid.php" ?>
<?php } ?>
<?php
	if (in_array("Categorias", explode(",", $Restaurant->getCurrentDetailTable())) && $Categorias->DetailView) {
?>
<?php if ($Restaurant->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("Categorias", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "Categoriasgrid.php" ?>
<?php } ?>
<?php
	if (in_array("_Table", explode(",", $Restaurant->getCurrentDetailTable())) && $_Table->DetailView) {
?>
<?php if ($Restaurant->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("_Table", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "_Tablegrid.php" ?>
<?php } ?>
</form>
<?php
$Restaurant_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$Restaurant_view->isExport()) { ?>
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
$Restaurant_view->terminate();
?>