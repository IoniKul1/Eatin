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
$Categorias_edit = new Categorias_edit();

// Run the page
$Categorias_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Categorias_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fCategoriasedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fCategoriasedit = currentForm = new ew.Form("fCategoriasedit", "edit");

	// Validate form
	fCategoriasedit.validate = function() {
		if (!this.validateRequired)
			return true; // Ignore validation
		var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
		if ($fobj.find("#confirm").val() == "confirm")
			return true;
		var elm, felm, uelm, addcnt = 0;
		var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
		var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
		var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
		var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
		for (var i = startcnt; i <= rowcnt; i++) {
			var infix = ($k[0]) ? String(i) : "";
			$fobj.data("rowindex", infix);
			<?php if ($Categorias_edit->ID->Required) { ?>
				elm = this.getElements("x" + infix + "_ID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Categorias_edit->ID->caption(), $Categorias_edit->ID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Categorias_edit->Active->Required) { ?>
				elm = this.getElements("x" + infix + "_Active");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Categorias_edit->Active->caption(), $Categorias_edit->Active->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Categorias_edit->Nombre->Required) { ?>
				elm = this.getElements("x" + infix + "_Nombre");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Categorias_edit->Nombre->caption(), $Categorias_edit->Nombre->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Categorias_edit->NombreEN->Required) { ?>
				elm = this.getElements("x" + infix + "_NombreEN");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Categorias_edit->NombreEN->caption(), $Categorias_edit->NombreEN->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}

		// Process detail forms
		var dfs = $fobj.find("input[name='detailpage']").get();
		for (var i = 0; i < dfs.length; i++) {
			var df = dfs[i], val = df.value;
			if (val && ew.forms[val])
				if (!ew.forms[val].validate())
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fCategoriasedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fCategoriasedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fCategoriasedit.lists["x_Active"] = <?php echo $Categorias_edit->Active->Lookup->toClientList($Categorias_edit) ?>;
	fCategoriasedit.lists["x_Active"].options = <?php echo JsonEncode($Categorias_edit->Active->options(FALSE, TRUE)) ?>;
	loadjs.done("fCategoriasedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $Categorias_edit->showPageHeader(); ?>
<?php
$Categorias_edit->showMessage();
?>
<form name="fCategoriasedit" id="fCategoriasedit" class="<?php echo $Categorias_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Categorias">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$Categorias_edit->IsModal ?>">
<?php if ($Categorias->getCurrentMasterTable() == "Restaurant") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="Restaurant">
<input type="hidden" name="fk_ID" value="<?php echo HtmlEncode($Categorias_edit->ID_Restaurant->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($Categorias_edit->ID->Visible) { // ID ?>
	<div id="r_ID" class="form-group row">
		<label id="elh_Categorias_ID" class="<?php echo $Categorias_edit->LeftColumnClass ?>"><?php echo $Categorias_edit->ID->caption() ?><?php echo $Categorias_edit->ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Categorias_edit->RightColumnClass ?>"><div <?php echo $Categorias_edit->ID->cellAttributes() ?>>
<span id="el_Categorias_ID">
<span<?php echo $Categorias_edit->ID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Categorias_edit->ID->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="Categorias" data-field="x_ID" name="x_ID" id="x_ID" value="<?php echo HtmlEncode($Categorias_edit->ID->CurrentValue) ?>">
<?php echo $Categorias_edit->ID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Categorias_edit->Active->Visible) { // Active ?>
	<div id="r_Active" class="form-group row">
		<label id="elh_Categorias_Active" class="<?php echo $Categorias_edit->LeftColumnClass ?>"><?php echo $Categorias_edit->Active->caption() ?><?php echo $Categorias_edit->Active->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Categorias_edit->RightColumnClass ?>"><div <?php echo $Categorias_edit->Active->cellAttributes() ?>>
<span id="el_Categorias_Active">
<div id="tp_x_Active" class="ew-template"><input type="radio" class="custom-control-input" data-table="Categorias" data-field="x_Active" data-value-separator="<?php echo $Categorias_edit->Active->displayValueSeparatorAttribute() ?>" name="x_Active" id="x_Active" value="{value}"<?php echo $Categorias_edit->Active->editAttributes() ?>></div>
<div id="dsl_x_Active" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $Categorias_edit->Active->radioButtonListHtml(FALSE, "x_Active") ?>
</div></div>
</span>
<?php echo $Categorias_edit->Active->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Categorias_edit->Nombre->Visible) { // Nombre ?>
	<div id="r_Nombre" class="form-group row">
		<label id="elh_Categorias_Nombre" for="x_Nombre" class="<?php echo $Categorias_edit->LeftColumnClass ?>"><?php echo $Categorias_edit->Nombre->caption() ?><?php echo $Categorias_edit->Nombre->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Categorias_edit->RightColumnClass ?>"><div <?php echo $Categorias_edit->Nombre->cellAttributes() ?>>
<span id="el_Categorias_Nombre">
<input type="text" data-table="Categorias" data-field="x_Nombre" name="x_Nombre" id="x_Nombre" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Categorias_edit->Nombre->getPlaceHolder()) ?>" value="<?php echo $Categorias_edit->Nombre->EditValue ?>"<?php echo $Categorias_edit->Nombre->editAttributes() ?>>
</span>
<?php echo $Categorias_edit->Nombre->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Categorias_edit->NombreEN->Visible) { // NombreEN ?>
	<div id="r_NombreEN" class="form-group row">
		<label id="elh_Categorias_NombreEN" for="x_NombreEN" class="<?php echo $Categorias_edit->LeftColumnClass ?>"><?php echo $Categorias_edit->NombreEN->caption() ?><?php echo $Categorias_edit->NombreEN->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Categorias_edit->RightColumnClass ?>"><div <?php echo $Categorias_edit->NombreEN->cellAttributes() ?>>
<span id="el_Categorias_NombreEN">
<input type="text" data-table="Categorias" data-field="x_NombreEN" name="x_NombreEN" id="x_NombreEN" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Categorias_edit->NombreEN->getPlaceHolder()) ?>" value="<?php echo $Categorias_edit->NombreEN->EditValue ?>"<?php echo $Categorias_edit->NombreEN->editAttributes() ?>>
</span>
<?php echo $Categorias_edit->NombreEN->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("Items", explode(",", $Categorias->getCurrentDetailTable())) && $Items->DetailEdit) {
?>
<?php if ($Categorias->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("Items", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "Itemsgrid.php" ?>
<?php } ?>
<?php if (!$Categorias_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $Categorias_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $Categorias_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$Categorias_edit->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$Categorias_edit->terminate();
?>