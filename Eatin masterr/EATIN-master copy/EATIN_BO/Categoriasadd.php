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
$Categorias_add = new Categorias_add();

// Run the page
$Categorias_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Categorias_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fCategoriasadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fCategoriasadd = currentForm = new ew.Form("fCategoriasadd", "add");

	// Validate form
	fCategoriasadd.validate = function() {
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
			<?php if ($Categorias_add->ID_Restaurant->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_Restaurant");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Categorias_add->ID_Restaurant->caption(), $Categorias_add->ID_Restaurant->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Categorias_add->Active->Required) { ?>
				elm = this.getElements("x" + infix + "_Active");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Categorias_add->Active->caption(), $Categorias_add->Active->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Categorias_add->Nombre->Required) { ?>
				elm = this.getElements("x" + infix + "_Nombre");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Categorias_add->Nombre->caption(), $Categorias_add->Nombre->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Categorias_add->NombreEN->Required) { ?>
				elm = this.getElements("x" + infix + "_NombreEN");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Categorias_add->NombreEN->caption(), $Categorias_add->NombreEN->RequiredErrorMessage)) ?>");
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
	fCategoriasadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fCategoriasadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fCategoriasadd.lists["x_ID_Restaurant"] = <?php echo $Categorias_add->ID_Restaurant->Lookup->toClientList($Categorias_add) ?>;
	fCategoriasadd.lists["x_ID_Restaurant"].options = <?php echo JsonEncode($Categorias_add->ID_Restaurant->lookupOptions()) ?>;
	fCategoriasadd.lists["x_Active"] = <?php echo $Categorias_add->Active->Lookup->toClientList($Categorias_add) ?>;
	fCategoriasadd.lists["x_Active"].options = <?php echo JsonEncode($Categorias_add->Active->options(FALSE, TRUE)) ?>;
	loadjs.done("fCategoriasadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $Categorias_add->showPageHeader(); ?>
<?php
$Categorias_add->showMessage();
?>
<form name="fCategoriasadd" id="fCategoriasadd" class="<?php echo $Categorias_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Categorias">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$Categorias_add->IsModal ?>">
<?php if ($Categorias->getCurrentMasterTable() == "Restaurant") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="Restaurant">
<input type="hidden" name="fk_ID" value="<?php echo HtmlEncode($Categorias_add->ID_Restaurant->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($Categorias_add->ID_Restaurant->Visible) { // ID_Restaurant ?>
	<div id="r_ID_Restaurant" class="form-group row">
		<label id="elh_Categorias_ID_Restaurant" for="x_ID_Restaurant" class="<?php echo $Categorias_add->LeftColumnClass ?>"><?php echo $Categorias_add->ID_Restaurant->caption() ?><?php echo $Categorias_add->ID_Restaurant->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Categorias_add->RightColumnClass ?>"><div <?php echo $Categorias_add->ID_Restaurant->cellAttributes() ?>>
<?php if ($Categorias_add->ID_Restaurant->getSessionValue() != "") { ?>
<span id="el_Categorias_ID_Restaurant">
<span<?php echo $Categorias_add->ID_Restaurant->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Categorias_add->ID_Restaurant->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_ID_Restaurant" name="x_ID_Restaurant" value="<?php echo HtmlEncode($Categorias_add->ID_Restaurant->CurrentValue) ?>">
<?php } elseif (!$Security->isAdmin() && $Security->isLoggedIn() && !$Categorias->userIDAllow("add")) { // Non system admin ?>
<span id="el_Categorias_ID_Restaurant">
<span<?php echo $Categorias_add->ID_Restaurant->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Categorias_add->ID_Restaurant->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="Categorias" data-field="x_ID_Restaurant" name="x_ID_Restaurant" id="x_ID_Restaurant" value="<?php echo HtmlEncode($Categorias_add->ID_Restaurant->CurrentValue) ?>">
<?php } else { ?>
<span id="el_Categorias_ID_Restaurant">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Categorias" data-field="x_ID_Restaurant" data-value-separator="<?php echo $Categorias_add->ID_Restaurant->displayValueSeparatorAttribute() ?>" id="x_ID_Restaurant" name="x_ID_Restaurant"<?php echo $Categorias_add->ID_Restaurant->editAttributes() ?>>
			<?php echo $Categorias_add->ID_Restaurant->selectOptionListHtml("x_ID_Restaurant") ?>
		</select>
</div>
<?php echo $Categorias_add->ID_Restaurant->Lookup->getParamTag($Categorias_add, "p_x_ID_Restaurant") ?>
</span>
<?php } ?>
<?php echo $Categorias_add->ID_Restaurant->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Categorias_add->Active->Visible) { // Active ?>
	<div id="r_Active" class="form-group row">
		<label id="elh_Categorias_Active" class="<?php echo $Categorias_add->LeftColumnClass ?>"><?php echo $Categorias_add->Active->caption() ?><?php echo $Categorias_add->Active->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Categorias_add->RightColumnClass ?>"><div <?php echo $Categorias_add->Active->cellAttributes() ?>>
<span id="el_Categorias_Active">
<div id="tp_x_Active" class="ew-template"><input type="radio" class="custom-control-input" data-table="Categorias" data-field="x_Active" data-value-separator="<?php echo $Categorias_add->Active->displayValueSeparatorAttribute() ?>" name="x_Active" id="x_Active" value="{value}"<?php echo $Categorias_add->Active->editAttributes() ?>></div>
<div id="dsl_x_Active" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $Categorias_add->Active->radioButtonListHtml(FALSE, "x_Active") ?>
</div></div>
</span>
<?php echo $Categorias_add->Active->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Categorias_add->Nombre->Visible) { // Nombre ?>
	<div id="r_Nombre" class="form-group row">
		<label id="elh_Categorias_Nombre" for="x_Nombre" class="<?php echo $Categorias_add->LeftColumnClass ?>"><?php echo $Categorias_add->Nombre->caption() ?><?php echo $Categorias_add->Nombre->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Categorias_add->RightColumnClass ?>"><div <?php echo $Categorias_add->Nombre->cellAttributes() ?>>
<span id="el_Categorias_Nombre">
<input type="text" data-table="Categorias" data-field="x_Nombre" name="x_Nombre" id="x_Nombre" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Categorias_add->Nombre->getPlaceHolder()) ?>" value="<?php echo $Categorias_add->Nombre->EditValue ?>"<?php echo $Categorias_add->Nombre->editAttributes() ?>>
</span>
<?php echo $Categorias_add->Nombre->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Categorias_add->NombreEN->Visible) { // NombreEN ?>
	<div id="r_NombreEN" class="form-group row">
		<label id="elh_Categorias_NombreEN" for="x_NombreEN" class="<?php echo $Categorias_add->LeftColumnClass ?>"><?php echo $Categorias_add->NombreEN->caption() ?><?php echo $Categorias_add->NombreEN->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Categorias_add->RightColumnClass ?>"><div <?php echo $Categorias_add->NombreEN->cellAttributes() ?>>
<span id="el_Categorias_NombreEN">
<input type="text" data-table="Categorias" data-field="x_NombreEN" name="x_NombreEN" id="x_NombreEN" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Categorias_add->NombreEN->getPlaceHolder()) ?>" value="<?php echo $Categorias_add->NombreEN->EditValue ?>"<?php echo $Categorias_add->NombreEN->editAttributes() ?>>
</span>
<?php echo $Categorias_add->NombreEN->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("Items", explode(",", $Categorias->getCurrentDetailTable())) && $Items->DetailAdd) {
?>
<?php if ($Categorias->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("Items", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "Itemsgrid.php" ?>
<?php } ?>
<?php if (!$Categorias_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $Categorias_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $Categorias_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$Categorias_add->showPageFooter();
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
$Categorias_add->terminate();
?>