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
$Items_add = new Items_add();

// Run the page
$Items_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Items_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fItemsadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fItemsadd = currentForm = new ew.Form("fItemsadd", "add");

	// Validate form
	fItemsadd.validate = function() {
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
			<?php if ($Items_add->ID_Categorias->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_Categorias");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Items_add->ID_Categorias->caption(), $Items_add->ID_Categorias->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Items_add->ID_Restaurant->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_Restaurant");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Items_add->ID_Restaurant->caption(), $Items_add->ID_Restaurant->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Items_add->Nombre->Required) { ?>
				elm = this.getElements("x" + infix + "_Nombre");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Items_add->Nombre->caption(), $Items_add->Nombre->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Items_add->Precio->Required) { ?>
				elm = this.getElements("x" + infix + "_Precio");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Items_add->Precio->caption(), $Items_add->Precio->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Precio");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Items_add->Precio->errorMessage()) ?>");
			<?php if ($Items_add->Active->Required) { ?>
				elm = this.getElements("x" + infix + "_Active");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Items_add->Active->caption(), $Items_add->Active->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Items_add->Stock->Required) { ?>
				elm = this.getElements("x" + infix + "_Stock");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Items_add->Stock->caption(), $Items_add->Stock->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Stock");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Items_add->Stock->errorMessage()) ?>");
			<?php if ($Items_add->Img1->Required) { ?>
				felm = this.getElements("x" + infix + "_Img1");
				elm = this.getElements("fn_x" + infix + "_Img1");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $Items_add->Img1->caption(), $Items_add->Img1->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Items_add->Img2->Required) { ?>
				felm = this.getElements("x" + infix + "_Img2");
				elm = this.getElements("fn_x" + infix + "_Img2");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $Items_add->Img2->caption(), $Items_add->Img2->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Items_add->Img3->Required) { ?>
				felm = this.getElements("x" + infix + "_Img3");
				elm = this.getElements("fn_x" + infix + "_Img3");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $Items_add->Img3->caption(), $Items_add->Img3->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Items_add->Img4->Required) { ?>
				felm = this.getElements("x" + infix + "_Img4");
				elm = this.getElements("fn_x" + infix + "_Img4");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $Items_add->Img4->caption(), $Items_add->Img4->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Items_add->Vid1->Required) { ?>
				felm = this.getElements("x" + infix + "_Vid1");
				elm = this.getElements("fn_x" + infix + "_Vid1");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $Items_add->Vid1->caption(), $Items_add->Vid1->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Items_add->Vid2->Required) { ?>
				felm = this.getElements("x" + infix + "_Vid2");
				elm = this.getElements("fn_x" + infix + "_Vid2");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $Items_add->Vid2->caption(), $Items_add->Vid2->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Items_add->Descripcion->Required) { ?>
				elm = this.getElements("x" + infix + "_Descripcion");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Items_add->Descripcion->caption(), $Items_add->Descripcion->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Items_add->NombreEN->Required) { ?>
				elm = this.getElements("x" + infix + "_NombreEN");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Items_add->NombreEN->caption(), $Items_add->NombreEN->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Items_add->DescripcionEN->Required) { ?>
				elm = this.getElements("x" + infix + "_DescripcionEN");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Items_add->DescripcionEN->caption(), $Items_add->DescripcionEN->RequiredErrorMessage)) ?>");
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
	fItemsadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fItemsadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fItemsadd.lists["x_ID_Categorias"] = <?php echo $Items_add->ID_Categorias->Lookup->toClientList($Items_add) ?>;
	fItemsadd.lists["x_ID_Categorias"].options = <?php echo JsonEncode($Items_add->ID_Categorias->lookupOptions()) ?>;
	fItemsadd.lists["x_ID_Restaurant"] = <?php echo $Items_add->ID_Restaurant->Lookup->toClientList($Items_add) ?>;
	fItemsadd.lists["x_ID_Restaurant"].options = <?php echo JsonEncode($Items_add->ID_Restaurant->lookupOptions()) ?>;
	fItemsadd.lists["x_Active"] = <?php echo $Items_add->Active->Lookup->toClientList($Items_add) ?>;
	fItemsadd.lists["x_Active"].options = <?php echo JsonEncode($Items_add->Active->options(FALSE, TRUE)) ?>;
	loadjs.done("fItemsadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $Items_add->showPageHeader(); ?>
<?php
$Items_add->showMessage();
?>
<form name="fItemsadd" id="fItemsadd" class="<?php echo $Items_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Items">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$Items_add->IsModal ?>">
<?php if ($Items->getCurrentMasterTable() == "Categorias") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="Categorias">
<input type="hidden" name="fk_ID" value="<?php echo HtmlEncode($Items_add->ID_Categorias->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($Items_add->ID_Categorias->Visible) { // ID_Categorias ?>
	<div id="r_ID_Categorias" class="form-group row">
		<label id="elh_Items_ID_Categorias" for="x_ID_Categorias" class="<?php echo $Items_add->LeftColumnClass ?>"><?php echo $Items_add->ID_Categorias->caption() ?><?php echo $Items_add->ID_Categorias->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Items_add->RightColumnClass ?>"><div <?php echo $Items_add->ID_Categorias->cellAttributes() ?>>
<?php if ($Items_add->ID_Categorias->getSessionValue() != "") { ?>
<span id="el_Items_ID_Categorias">
<span<?php echo $Items_add->ID_Categorias->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Items_add->ID_Categorias->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_ID_Categorias" name="x_ID_Categorias" value="<?php echo HtmlEncode($Items_add->ID_Categorias->CurrentValue) ?>">
<?php } else { ?>
<span id="el_Items_ID_Categorias">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Items" data-field="x_ID_Categorias" data-value-separator="<?php echo $Items_add->ID_Categorias->displayValueSeparatorAttribute() ?>" id="x_ID_Categorias" name="x_ID_Categorias"<?php echo $Items_add->ID_Categorias->editAttributes() ?>>
			<?php echo $Items_add->ID_Categorias->selectOptionListHtml("x_ID_Categorias") ?>
		</select>
</div>
<?php echo $Items_add->ID_Categorias->Lookup->getParamTag($Items_add, "p_x_ID_Categorias") ?>
</span>
<?php } ?>
<?php echo $Items_add->ID_Categorias->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Items_add->ID_Restaurant->Visible) { // ID_Restaurant ?>
	<div id="r_ID_Restaurant" class="form-group row">
		<label id="elh_Items_ID_Restaurant" for="x_ID_Restaurant" class="<?php echo $Items_add->LeftColumnClass ?>"><?php echo $Items_add->ID_Restaurant->caption() ?><?php echo $Items_add->ID_Restaurant->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Items_add->RightColumnClass ?>"><div <?php echo $Items_add->ID_Restaurant->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn() && !$Items->userIDAllow("add")) { // Non system admin ?>
<span id="el_Items_ID_Restaurant">
<span<?php echo $Items_add->ID_Restaurant->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Items_add->ID_Restaurant->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="Items" data-field="x_ID_Restaurant" name="x_ID_Restaurant" id="x_ID_Restaurant" value="<?php echo HtmlEncode($Items_add->ID_Restaurant->CurrentValue) ?>">
<?php } else { ?>
<span id="el_Items_ID_Restaurant">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Items" data-field="x_ID_Restaurant" data-value-separator="<?php echo $Items_add->ID_Restaurant->displayValueSeparatorAttribute() ?>" id="x_ID_Restaurant" name="x_ID_Restaurant"<?php echo $Items_add->ID_Restaurant->editAttributes() ?>>
			<?php echo $Items_add->ID_Restaurant->selectOptionListHtml("x_ID_Restaurant") ?>
		</select>
</div>
<?php echo $Items_add->ID_Restaurant->Lookup->getParamTag($Items_add, "p_x_ID_Restaurant") ?>
</span>
<?php } ?>
<?php echo $Items_add->ID_Restaurant->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Items_add->Nombre->Visible) { // Nombre ?>
	<div id="r_Nombre" class="form-group row">
		<label id="elh_Items_Nombre" for="x_Nombre" class="<?php echo $Items_add->LeftColumnClass ?>"><?php echo $Items_add->Nombre->caption() ?><?php echo $Items_add->Nombre->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Items_add->RightColumnClass ?>"><div <?php echo $Items_add->Nombre->cellAttributes() ?>>
<span id="el_Items_Nombre">
<input type="text" data-table="Items" data-field="x_Nombre" name="x_Nombre" id="x_Nombre" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Items_add->Nombre->getPlaceHolder()) ?>" value="<?php echo $Items_add->Nombre->EditValue ?>"<?php echo $Items_add->Nombre->editAttributes() ?>>
</span>
<?php echo $Items_add->Nombre->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Items_add->Precio->Visible) { // Precio ?>
	<div id="r_Precio" class="form-group row">
		<label id="elh_Items_Precio" for="x_Precio" class="<?php echo $Items_add->LeftColumnClass ?>"><?php echo $Items_add->Precio->caption() ?><?php echo $Items_add->Precio->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Items_add->RightColumnClass ?>"><div <?php echo $Items_add->Precio->cellAttributes() ?>>
<span id="el_Items_Precio">
<input type="text" data-table="Items" data-field="x_Precio" name="x_Precio" id="x_Precio" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Items_add->Precio->getPlaceHolder()) ?>" value="<?php echo $Items_add->Precio->EditValue ?>"<?php echo $Items_add->Precio->editAttributes() ?>>
</span>
<?php echo $Items_add->Precio->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Items_add->Active->Visible) { // Active ?>
	<div id="r_Active" class="form-group row">
		<label id="elh_Items_Active" class="<?php echo $Items_add->LeftColumnClass ?>"><?php echo $Items_add->Active->caption() ?><?php echo $Items_add->Active->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Items_add->RightColumnClass ?>"><div <?php echo $Items_add->Active->cellAttributes() ?>>
<span id="el_Items_Active">
<div id="tp_x_Active" class="ew-template"><input type="radio" class="custom-control-input" data-table="Items" data-field="x_Active" data-value-separator="<?php echo $Items_add->Active->displayValueSeparatorAttribute() ?>" name="x_Active" id="x_Active" value="{value}"<?php echo $Items_add->Active->editAttributes() ?>></div>
<div id="dsl_x_Active" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $Items_add->Active->radioButtonListHtml(FALSE, "x_Active") ?>
</div></div>
</span>
<?php echo $Items_add->Active->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Items_add->Stock->Visible) { // Stock ?>
	<div id="r_Stock" class="form-group row">
		<label id="elh_Items_Stock" for="x_Stock" class="<?php echo $Items_add->LeftColumnClass ?>"><?php echo $Items_add->Stock->caption() ?><?php echo $Items_add->Stock->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Items_add->RightColumnClass ?>"><div <?php echo $Items_add->Stock->cellAttributes() ?>>
<span id="el_Items_Stock">
<input type="text" data-table="Items" data-field="x_Stock" name="x_Stock" id="x_Stock" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Items_add->Stock->getPlaceHolder()) ?>" value="<?php echo $Items_add->Stock->EditValue ?>"<?php echo $Items_add->Stock->editAttributes() ?>>
</span>
<?php echo $Items_add->Stock->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Items_add->Img1->Visible) { // Img1 ?>
	<div id="r_Img1" class="form-group row">
		<label id="elh_Items_Img1" class="<?php echo $Items_add->LeftColumnClass ?>"><?php echo $Items_add->Img1->caption() ?><?php echo $Items_add->Img1->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Items_add->RightColumnClass ?>"><div <?php echo $Items_add->Img1->cellAttributes() ?>>
<span id="el_Items_Img1">
<div id="fd_x_Img1">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $Items_add->Img1->title() ?>" data-table="Items" data-field="x_Img1" name="x_Img1" id="x_Img1" lang="<?php echo CurrentLanguageID() ?>"<?php echo $Items_add->Img1->editAttributes() ?><?php if ($Items_add->Img1->ReadOnly || $Items_add->Img1->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_Img1"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_Img1" id= "fn_x_Img1" value="<?php echo $Items_add->Img1->Upload->FileName ?>">
<input type="hidden" name="fa_x_Img1" id= "fa_x_Img1" value="0">
<input type="hidden" name="fs_x_Img1" id= "fs_x_Img1" value="80">
<input type="hidden" name="fx_x_Img1" id= "fx_x_Img1" value="<?php echo $Items_add->Img1->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_Img1" id= "fm_x_Img1" value="<?php echo $Items_add->Img1->UploadMaxFileSize ?>">
</div>
<table id="ft_x_Img1" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $Items_add->Img1->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Items_add->Img2->Visible) { // Img2 ?>
	<div id="r_Img2" class="form-group row">
		<label id="elh_Items_Img2" class="<?php echo $Items_add->LeftColumnClass ?>"><?php echo $Items_add->Img2->caption() ?><?php echo $Items_add->Img2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Items_add->RightColumnClass ?>"><div <?php echo $Items_add->Img2->cellAttributes() ?>>
<span id="el_Items_Img2">
<div id="fd_x_Img2">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $Items_add->Img2->title() ?>" data-table="Items" data-field="x_Img2" name="x_Img2" id="x_Img2" lang="<?php echo CurrentLanguageID() ?>"<?php echo $Items_add->Img2->editAttributes() ?><?php if ($Items_add->Img2->ReadOnly || $Items_add->Img2->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_Img2"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_Img2" id= "fn_x_Img2" value="<?php echo $Items_add->Img2->Upload->FileName ?>">
<input type="hidden" name="fa_x_Img2" id= "fa_x_Img2" value="0">
<input type="hidden" name="fs_x_Img2" id= "fs_x_Img2" value="80">
<input type="hidden" name="fx_x_Img2" id= "fx_x_Img2" value="<?php echo $Items_add->Img2->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_Img2" id= "fm_x_Img2" value="<?php echo $Items_add->Img2->UploadMaxFileSize ?>">
</div>
<table id="ft_x_Img2" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $Items_add->Img2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Items_add->Img3->Visible) { // Img3 ?>
	<div id="r_Img3" class="form-group row">
		<label id="elh_Items_Img3" class="<?php echo $Items_add->LeftColumnClass ?>"><?php echo $Items_add->Img3->caption() ?><?php echo $Items_add->Img3->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Items_add->RightColumnClass ?>"><div <?php echo $Items_add->Img3->cellAttributes() ?>>
<span id="el_Items_Img3">
<div id="fd_x_Img3">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $Items_add->Img3->title() ?>" data-table="Items" data-field="x_Img3" name="x_Img3" id="x_Img3" lang="<?php echo CurrentLanguageID() ?>"<?php echo $Items_add->Img3->editAttributes() ?><?php if ($Items_add->Img3->ReadOnly || $Items_add->Img3->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_Img3"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_Img3" id= "fn_x_Img3" value="<?php echo $Items_add->Img3->Upload->FileName ?>">
<input type="hidden" name="fa_x_Img3" id= "fa_x_Img3" value="0">
<input type="hidden" name="fs_x_Img3" id= "fs_x_Img3" value="80">
<input type="hidden" name="fx_x_Img3" id= "fx_x_Img3" value="<?php echo $Items_add->Img3->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_Img3" id= "fm_x_Img3" value="<?php echo $Items_add->Img3->UploadMaxFileSize ?>">
</div>
<table id="ft_x_Img3" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $Items_add->Img3->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Items_add->Img4->Visible) { // Img4 ?>
	<div id="r_Img4" class="form-group row">
		<label id="elh_Items_Img4" class="<?php echo $Items_add->LeftColumnClass ?>"><?php echo $Items_add->Img4->caption() ?><?php echo $Items_add->Img4->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Items_add->RightColumnClass ?>"><div <?php echo $Items_add->Img4->cellAttributes() ?>>
<span id="el_Items_Img4">
<div id="fd_x_Img4">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $Items_add->Img4->title() ?>" data-table="Items" data-field="x_Img4" name="x_Img4" id="x_Img4" lang="<?php echo CurrentLanguageID() ?>"<?php echo $Items_add->Img4->editAttributes() ?><?php if ($Items_add->Img4->ReadOnly || $Items_add->Img4->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_Img4"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_Img4" id= "fn_x_Img4" value="<?php echo $Items_add->Img4->Upload->FileName ?>">
<input type="hidden" name="fa_x_Img4" id= "fa_x_Img4" value="0">
<input type="hidden" name="fs_x_Img4" id= "fs_x_Img4" value="80">
<input type="hidden" name="fx_x_Img4" id= "fx_x_Img4" value="<?php echo $Items_add->Img4->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_Img4" id= "fm_x_Img4" value="<?php echo $Items_add->Img4->UploadMaxFileSize ?>">
</div>
<table id="ft_x_Img4" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $Items_add->Img4->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Items_add->Vid1->Visible) { // Vid1 ?>
	<div id="r_Vid1" class="form-group row">
		<label id="elh_Items_Vid1" class="<?php echo $Items_add->LeftColumnClass ?>"><?php echo $Items_add->Vid1->caption() ?><?php echo $Items_add->Vid1->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Items_add->RightColumnClass ?>"><div <?php echo $Items_add->Vid1->cellAttributes() ?>>
<span id="el_Items_Vid1">
<div id="fd_x_Vid1">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $Items_add->Vid1->title() ?>" data-table="Items" data-field="x_Vid1" name="x_Vid1" id="x_Vid1" lang="<?php echo CurrentLanguageID() ?>"<?php echo $Items_add->Vid1->editAttributes() ?><?php if ($Items_add->Vid1->ReadOnly || $Items_add->Vid1->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_Vid1"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_Vid1" id= "fn_x_Vid1" value="<?php echo $Items_add->Vid1->Upload->FileName ?>">
<input type="hidden" name="fa_x_Vid1" id= "fa_x_Vid1" value="0">
<input type="hidden" name="fs_x_Vid1" id= "fs_x_Vid1" value="80">
<input type="hidden" name="fx_x_Vid1" id= "fx_x_Vid1" value="<?php echo $Items_add->Vid1->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_Vid1" id= "fm_x_Vid1" value="<?php echo $Items_add->Vid1->UploadMaxFileSize ?>">
</div>
<table id="ft_x_Vid1" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $Items_add->Vid1->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Items_add->Vid2->Visible) { // Vid2 ?>
	<div id="r_Vid2" class="form-group row">
		<label id="elh_Items_Vid2" class="<?php echo $Items_add->LeftColumnClass ?>"><?php echo $Items_add->Vid2->caption() ?><?php echo $Items_add->Vid2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Items_add->RightColumnClass ?>"><div <?php echo $Items_add->Vid2->cellAttributes() ?>>
<span id="el_Items_Vid2">
<div id="fd_x_Vid2">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $Items_add->Vid2->title() ?>" data-table="Items" data-field="x_Vid2" name="x_Vid2" id="x_Vid2" lang="<?php echo CurrentLanguageID() ?>"<?php echo $Items_add->Vid2->editAttributes() ?><?php if ($Items_add->Vid2->ReadOnly || $Items_add->Vid2->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_Vid2"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_Vid2" id= "fn_x_Vid2" value="<?php echo $Items_add->Vid2->Upload->FileName ?>">
<input type="hidden" name="fa_x_Vid2" id= "fa_x_Vid2" value="0">
<input type="hidden" name="fs_x_Vid2" id= "fs_x_Vid2" value="80">
<input type="hidden" name="fx_x_Vid2" id= "fx_x_Vid2" value="<?php echo $Items_add->Vid2->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_Vid2" id= "fm_x_Vid2" value="<?php echo $Items_add->Vid2->UploadMaxFileSize ?>">
</div>
<table id="ft_x_Vid2" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $Items_add->Vid2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Items_add->Descripcion->Visible) { // Descripcion ?>
	<div id="r_Descripcion" class="form-group row">
		<label id="elh_Items_Descripcion" for="x_Descripcion" class="<?php echo $Items_add->LeftColumnClass ?>"><?php echo $Items_add->Descripcion->caption() ?><?php echo $Items_add->Descripcion->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Items_add->RightColumnClass ?>"><div <?php echo $Items_add->Descripcion->cellAttributes() ?>>
<span id="el_Items_Descripcion">
<input type="text" data-table="Items" data-field="x_Descripcion" name="x_Descripcion" id="x_Descripcion" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($Items_add->Descripcion->getPlaceHolder()) ?>" value="<?php echo $Items_add->Descripcion->EditValue ?>"<?php echo $Items_add->Descripcion->editAttributes() ?>>
</span>
<?php echo $Items_add->Descripcion->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Items_add->NombreEN->Visible) { // NombreEN ?>
	<div id="r_NombreEN" class="form-group row">
		<label id="elh_Items_NombreEN" for="x_NombreEN" class="<?php echo $Items_add->LeftColumnClass ?>"><?php echo $Items_add->NombreEN->caption() ?><?php echo $Items_add->NombreEN->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Items_add->RightColumnClass ?>"><div <?php echo $Items_add->NombreEN->cellAttributes() ?>>
<span id="el_Items_NombreEN">
<input type="text" data-table="Items" data-field="x_NombreEN" name="x_NombreEN" id="x_NombreEN" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Items_add->NombreEN->getPlaceHolder()) ?>" value="<?php echo $Items_add->NombreEN->EditValue ?>"<?php echo $Items_add->NombreEN->editAttributes() ?>>
</span>
<?php echo $Items_add->NombreEN->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Items_add->DescripcionEN->Visible) { // DescripcionEN ?>
	<div id="r_DescripcionEN" class="form-group row">
		<label id="elh_Items_DescripcionEN" for="x_DescripcionEN" class="<?php echo $Items_add->LeftColumnClass ?>"><?php echo $Items_add->DescripcionEN->caption() ?><?php echo $Items_add->DescripcionEN->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Items_add->RightColumnClass ?>"><div <?php echo $Items_add->DescripcionEN->cellAttributes() ?>>
<span id="el_Items_DescripcionEN">
<input type="text" data-table="Items" data-field="x_DescripcionEN" name="x_DescripcionEN" id="x_DescripcionEN" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($Items_add->DescripcionEN->getPlaceHolder()) ?>" value="<?php echo $Items_add->DescripcionEN->EditValue ?>"<?php echo $Items_add->DescripcionEN->editAttributes() ?>>
</span>
<?php echo $Items_add->DescripcionEN->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Items_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $Items_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $Items_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$Items_add->showPageFooter();
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
$Items_add->terminate();
?>