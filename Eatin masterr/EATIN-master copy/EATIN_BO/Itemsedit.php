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
$Items_edit = new Items_edit();

// Run the page
$Items_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Items_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fItemsedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fItemsedit = currentForm = new ew.Form("fItemsedit", "edit");

	// Validate form
	fItemsedit.validate = function() {
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
			<?php if ($Items_edit->ID->Required) { ?>
				elm = this.getElements("x" + infix + "_ID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Items_edit->ID->caption(), $Items_edit->ID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Items_edit->ID_Categorias->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_Categorias");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Items_edit->ID_Categorias->caption(), $Items_edit->ID_Categorias->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Items_edit->ID_Restaurant->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_Restaurant");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Items_edit->ID_Restaurant->caption(), $Items_edit->ID_Restaurant->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Items_edit->Nombre->Required) { ?>
				elm = this.getElements("x" + infix + "_Nombre");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Items_edit->Nombre->caption(), $Items_edit->Nombre->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Items_edit->Precio->Required) { ?>
				elm = this.getElements("x" + infix + "_Precio");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Items_edit->Precio->caption(), $Items_edit->Precio->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Precio");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Items_edit->Precio->errorMessage()) ?>");
			<?php if ($Items_edit->Active->Required) { ?>
				elm = this.getElements("x" + infix + "_Active");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Items_edit->Active->caption(), $Items_edit->Active->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Items_edit->Stock->Required) { ?>
				elm = this.getElements("x" + infix + "_Stock");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Items_edit->Stock->caption(), $Items_edit->Stock->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Stock");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Items_edit->Stock->errorMessage()) ?>");
			<?php if ($Items_edit->Img1->Required) { ?>
				felm = this.getElements("x" + infix + "_Img1");
				elm = this.getElements("fn_x" + infix + "_Img1");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $Items_edit->Img1->caption(), $Items_edit->Img1->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Items_edit->Img2->Required) { ?>
				felm = this.getElements("x" + infix + "_Img2");
				elm = this.getElements("fn_x" + infix + "_Img2");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $Items_edit->Img2->caption(), $Items_edit->Img2->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Items_edit->Img3->Required) { ?>
				felm = this.getElements("x" + infix + "_Img3");
				elm = this.getElements("fn_x" + infix + "_Img3");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $Items_edit->Img3->caption(), $Items_edit->Img3->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Items_edit->Img4->Required) { ?>
				felm = this.getElements("x" + infix + "_Img4");
				elm = this.getElements("fn_x" + infix + "_Img4");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $Items_edit->Img4->caption(), $Items_edit->Img4->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Items_edit->Vid1->Required) { ?>
				felm = this.getElements("x" + infix + "_Vid1");
				elm = this.getElements("fn_x" + infix + "_Vid1");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $Items_edit->Vid1->caption(), $Items_edit->Vid1->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Items_edit->Vid2->Required) { ?>
				felm = this.getElements("x" + infix + "_Vid2");
				elm = this.getElements("fn_x" + infix + "_Vid2");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $Items_edit->Vid2->caption(), $Items_edit->Vid2->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Items_edit->Descripcion->Required) { ?>
				elm = this.getElements("x" + infix + "_Descripcion");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Items_edit->Descripcion->caption(), $Items_edit->Descripcion->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Items_edit->NombreEN->Required) { ?>
				elm = this.getElements("x" + infix + "_NombreEN");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Items_edit->NombreEN->caption(), $Items_edit->NombreEN->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Items_edit->DescripcionEN->Required) { ?>
				elm = this.getElements("x" + infix + "_DescripcionEN");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Items_edit->DescripcionEN->caption(), $Items_edit->DescripcionEN->RequiredErrorMessage)) ?>");
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
	fItemsedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fItemsedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fItemsedit.lists["x_ID_Categorias"] = <?php echo $Items_edit->ID_Categorias->Lookup->toClientList($Items_edit) ?>;
	fItemsedit.lists["x_ID_Categorias"].options = <?php echo JsonEncode($Items_edit->ID_Categorias->lookupOptions()) ?>;
	fItemsedit.lists["x_ID_Restaurant"] = <?php echo $Items_edit->ID_Restaurant->Lookup->toClientList($Items_edit) ?>;
	fItemsedit.lists["x_ID_Restaurant"].options = <?php echo JsonEncode($Items_edit->ID_Restaurant->lookupOptions()) ?>;
	fItemsedit.lists["x_Active"] = <?php echo $Items_edit->Active->Lookup->toClientList($Items_edit) ?>;
	fItemsedit.lists["x_Active"].options = <?php echo JsonEncode($Items_edit->Active->options(FALSE, TRUE)) ?>;
	loadjs.done("fItemsedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $Items_edit->showPageHeader(); ?>
<?php
$Items_edit->showMessage();
?>
<form name="fItemsedit" id="fItemsedit" class="<?php echo $Items_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Items">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$Items_edit->IsModal ?>">
<?php if ($Items->getCurrentMasterTable() == "Categorias") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="Categorias">
<input type="hidden" name="fk_ID" value="<?php echo HtmlEncode($Items_edit->ID_Categorias->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($Items_edit->ID->Visible) { // ID ?>
	<div id="r_ID" class="form-group row">
		<label id="elh_Items_ID" class="<?php echo $Items_edit->LeftColumnClass ?>"><?php echo $Items_edit->ID->caption() ?><?php echo $Items_edit->ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Items_edit->RightColumnClass ?>"><div <?php echo $Items_edit->ID->cellAttributes() ?>>
<span id="el_Items_ID">
<span<?php echo $Items_edit->ID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Items_edit->ID->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="Items" data-field="x_ID" name="x_ID" id="x_ID" value="<?php echo HtmlEncode($Items_edit->ID->CurrentValue) ?>">
<?php echo $Items_edit->ID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Items_edit->ID_Categorias->Visible) { // ID_Categorias ?>
	<div id="r_ID_Categorias" class="form-group row">
		<label id="elh_Items_ID_Categorias" for="x_ID_Categorias" class="<?php echo $Items_edit->LeftColumnClass ?>"><?php echo $Items_edit->ID_Categorias->caption() ?><?php echo $Items_edit->ID_Categorias->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Items_edit->RightColumnClass ?>"><div <?php echo $Items_edit->ID_Categorias->cellAttributes() ?>>
<?php if ($Items_edit->ID_Categorias->getSessionValue() != "") { ?>
<span id="el_Items_ID_Categorias">
<span<?php echo $Items_edit->ID_Categorias->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Items_edit->ID_Categorias->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_ID_Categorias" name="x_ID_Categorias" value="<?php echo HtmlEncode($Items_edit->ID_Categorias->CurrentValue) ?>">
<?php } else { ?>
<span id="el_Items_ID_Categorias">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Items" data-field="x_ID_Categorias" data-value-separator="<?php echo $Items_edit->ID_Categorias->displayValueSeparatorAttribute() ?>" id="x_ID_Categorias" name="x_ID_Categorias"<?php echo $Items_edit->ID_Categorias->editAttributes() ?>>
			<?php echo $Items_edit->ID_Categorias->selectOptionListHtml("x_ID_Categorias") ?>
		</select>
</div>
<?php echo $Items_edit->ID_Categorias->Lookup->getParamTag($Items_edit, "p_x_ID_Categorias") ?>
</span>
<?php } ?>
<?php echo $Items_edit->ID_Categorias->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Items_edit->ID_Restaurant->Visible) { // ID_Restaurant ?>
	<div id="r_ID_Restaurant" class="form-group row">
		<label id="elh_Items_ID_Restaurant" for="x_ID_Restaurant" class="<?php echo $Items_edit->LeftColumnClass ?>"><?php echo $Items_edit->ID_Restaurant->caption() ?><?php echo $Items_edit->ID_Restaurant->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Items_edit->RightColumnClass ?>"><div <?php echo $Items_edit->ID_Restaurant->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn() && !$Items->userIDAllow("edit")) { // Non system admin ?>
<span id="el_Items_ID_Restaurant">
<span<?php echo $Items_edit->ID_Restaurant->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Items_edit->ID_Restaurant->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="Items" data-field="x_ID_Restaurant" name="x_ID_Restaurant" id="x_ID_Restaurant" value="<?php echo HtmlEncode($Items_edit->ID_Restaurant->CurrentValue) ?>">
<?php } else { ?>
<span id="el_Items_ID_Restaurant">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Items" data-field="x_ID_Restaurant" data-value-separator="<?php echo $Items_edit->ID_Restaurant->displayValueSeparatorAttribute() ?>" id="x_ID_Restaurant" name="x_ID_Restaurant"<?php echo $Items_edit->ID_Restaurant->editAttributes() ?>>
			<?php echo $Items_edit->ID_Restaurant->selectOptionListHtml("x_ID_Restaurant") ?>
		</select>
</div>
<?php echo $Items_edit->ID_Restaurant->Lookup->getParamTag($Items_edit, "p_x_ID_Restaurant") ?>
</span>
<?php } ?>
<?php echo $Items_edit->ID_Restaurant->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Items_edit->Nombre->Visible) { // Nombre ?>
	<div id="r_Nombre" class="form-group row">
		<label id="elh_Items_Nombre" for="x_Nombre" class="<?php echo $Items_edit->LeftColumnClass ?>"><?php echo $Items_edit->Nombre->caption() ?><?php echo $Items_edit->Nombre->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Items_edit->RightColumnClass ?>"><div <?php echo $Items_edit->Nombre->cellAttributes() ?>>
<span id="el_Items_Nombre">
<input type="text" data-table="Items" data-field="x_Nombre" name="x_Nombre" id="x_Nombre" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Items_edit->Nombre->getPlaceHolder()) ?>" value="<?php echo $Items_edit->Nombre->EditValue ?>"<?php echo $Items_edit->Nombre->editAttributes() ?>>
</span>
<?php echo $Items_edit->Nombre->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Items_edit->Precio->Visible) { // Precio ?>
	<div id="r_Precio" class="form-group row">
		<label id="elh_Items_Precio" for="x_Precio" class="<?php echo $Items_edit->LeftColumnClass ?>"><?php echo $Items_edit->Precio->caption() ?><?php echo $Items_edit->Precio->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Items_edit->RightColumnClass ?>"><div <?php echo $Items_edit->Precio->cellAttributes() ?>>
<span id="el_Items_Precio">
<input type="text" data-table="Items" data-field="x_Precio" name="x_Precio" id="x_Precio" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Items_edit->Precio->getPlaceHolder()) ?>" value="<?php echo $Items_edit->Precio->EditValue ?>"<?php echo $Items_edit->Precio->editAttributes() ?>>
</span>
<?php echo $Items_edit->Precio->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Items_edit->Active->Visible) { // Active ?>
	<div id="r_Active" class="form-group row">
		<label id="elh_Items_Active" class="<?php echo $Items_edit->LeftColumnClass ?>"><?php echo $Items_edit->Active->caption() ?><?php echo $Items_edit->Active->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Items_edit->RightColumnClass ?>"><div <?php echo $Items_edit->Active->cellAttributes() ?>>
<span id="el_Items_Active">
<div id="tp_x_Active" class="ew-template"><input type="radio" class="custom-control-input" data-table="Items" data-field="x_Active" data-value-separator="<?php echo $Items_edit->Active->displayValueSeparatorAttribute() ?>" name="x_Active" id="x_Active" value="{value}"<?php echo $Items_edit->Active->editAttributes() ?>></div>
<div id="dsl_x_Active" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $Items_edit->Active->radioButtonListHtml(FALSE, "x_Active") ?>
</div></div>
</span>
<?php echo $Items_edit->Active->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Items_edit->Stock->Visible) { // Stock ?>
	<div id="r_Stock" class="form-group row">
		<label id="elh_Items_Stock" for="x_Stock" class="<?php echo $Items_edit->LeftColumnClass ?>"><?php echo $Items_edit->Stock->caption() ?><?php echo $Items_edit->Stock->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Items_edit->RightColumnClass ?>"><div <?php echo $Items_edit->Stock->cellAttributes() ?>>
<span id="el_Items_Stock">
<input type="text" data-table="Items" data-field="x_Stock" name="x_Stock" id="x_Stock" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Items_edit->Stock->getPlaceHolder()) ?>" value="<?php echo $Items_edit->Stock->EditValue ?>"<?php echo $Items_edit->Stock->editAttributes() ?>>
</span>
<?php echo $Items_edit->Stock->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Items_edit->Img1->Visible) { // Img1 ?>
	<div id="r_Img1" class="form-group row">
		<label id="elh_Items_Img1" class="<?php echo $Items_edit->LeftColumnClass ?>"><?php echo $Items_edit->Img1->caption() ?><?php echo $Items_edit->Img1->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Items_edit->RightColumnClass ?>"><div <?php echo $Items_edit->Img1->cellAttributes() ?>>
<span id="el_Items_Img1">
<div id="fd_x_Img1">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $Items_edit->Img1->title() ?>" data-table="Items" data-field="x_Img1" name="x_Img1" id="x_Img1" lang="<?php echo CurrentLanguageID() ?>"<?php echo $Items_edit->Img1->editAttributes() ?><?php if ($Items_edit->Img1->ReadOnly || $Items_edit->Img1->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_Img1"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_Img1" id= "fn_x_Img1" value="<?php echo $Items_edit->Img1->Upload->FileName ?>">
<input type="hidden" name="fa_x_Img1" id= "fa_x_Img1" value="<?php echo (Post("fa_x_Img1") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_Img1" id= "fs_x_Img1" value="80">
<input type="hidden" name="fx_x_Img1" id= "fx_x_Img1" value="<?php echo $Items_edit->Img1->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_Img1" id= "fm_x_Img1" value="<?php echo $Items_edit->Img1->UploadMaxFileSize ?>">
</div>
<table id="ft_x_Img1" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $Items_edit->Img1->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Items_edit->Img2->Visible) { // Img2 ?>
	<div id="r_Img2" class="form-group row">
		<label id="elh_Items_Img2" class="<?php echo $Items_edit->LeftColumnClass ?>"><?php echo $Items_edit->Img2->caption() ?><?php echo $Items_edit->Img2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Items_edit->RightColumnClass ?>"><div <?php echo $Items_edit->Img2->cellAttributes() ?>>
<span id="el_Items_Img2">
<div id="fd_x_Img2">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $Items_edit->Img2->title() ?>" data-table="Items" data-field="x_Img2" name="x_Img2" id="x_Img2" lang="<?php echo CurrentLanguageID() ?>"<?php echo $Items_edit->Img2->editAttributes() ?><?php if ($Items_edit->Img2->ReadOnly || $Items_edit->Img2->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_Img2"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_Img2" id= "fn_x_Img2" value="<?php echo $Items_edit->Img2->Upload->FileName ?>">
<input type="hidden" name="fa_x_Img2" id= "fa_x_Img2" value="<?php echo (Post("fa_x_Img2") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_Img2" id= "fs_x_Img2" value="80">
<input type="hidden" name="fx_x_Img2" id= "fx_x_Img2" value="<?php echo $Items_edit->Img2->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_Img2" id= "fm_x_Img2" value="<?php echo $Items_edit->Img2->UploadMaxFileSize ?>">
</div>
<table id="ft_x_Img2" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $Items_edit->Img2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Items_edit->Img3->Visible) { // Img3 ?>
	<div id="r_Img3" class="form-group row">
		<label id="elh_Items_Img3" class="<?php echo $Items_edit->LeftColumnClass ?>"><?php echo $Items_edit->Img3->caption() ?><?php echo $Items_edit->Img3->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Items_edit->RightColumnClass ?>"><div <?php echo $Items_edit->Img3->cellAttributes() ?>>
<span id="el_Items_Img3">
<div id="fd_x_Img3">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $Items_edit->Img3->title() ?>" data-table="Items" data-field="x_Img3" name="x_Img3" id="x_Img3" lang="<?php echo CurrentLanguageID() ?>"<?php echo $Items_edit->Img3->editAttributes() ?><?php if ($Items_edit->Img3->ReadOnly || $Items_edit->Img3->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_Img3"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_Img3" id= "fn_x_Img3" value="<?php echo $Items_edit->Img3->Upload->FileName ?>">
<input type="hidden" name="fa_x_Img3" id= "fa_x_Img3" value="<?php echo (Post("fa_x_Img3") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_Img3" id= "fs_x_Img3" value="80">
<input type="hidden" name="fx_x_Img3" id= "fx_x_Img3" value="<?php echo $Items_edit->Img3->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_Img3" id= "fm_x_Img3" value="<?php echo $Items_edit->Img3->UploadMaxFileSize ?>">
</div>
<table id="ft_x_Img3" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $Items_edit->Img3->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Items_edit->Img4->Visible) { // Img4 ?>
	<div id="r_Img4" class="form-group row">
		<label id="elh_Items_Img4" class="<?php echo $Items_edit->LeftColumnClass ?>"><?php echo $Items_edit->Img4->caption() ?><?php echo $Items_edit->Img4->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Items_edit->RightColumnClass ?>"><div <?php echo $Items_edit->Img4->cellAttributes() ?>>
<span id="el_Items_Img4">
<div id="fd_x_Img4">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $Items_edit->Img4->title() ?>" data-table="Items" data-field="x_Img4" name="x_Img4" id="x_Img4" lang="<?php echo CurrentLanguageID() ?>"<?php echo $Items_edit->Img4->editAttributes() ?><?php if ($Items_edit->Img4->ReadOnly || $Items_edit->Img4->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_Img4"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_Img4" id= "fn_x_Img4" value="<?php echo $Items_edit->Img4->Upload->FileName ?>">
<input type="hidden" name="fa_x_Img4" id= "fa_x_Img4" value="<?php echo (Post("fa_x_Img4") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_Img4" id= "fs_x_Img4" value="80">
<input type="hidden" name="fx_x_Img4" id= "fx_x_Img4" value="<?php echo $Items_edit->Img4->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_Img4" id= "fm_x_Img4" value="<?php echo $Items_edit->Img4->UploadMaxFileSize ?>">
</div>
<table id="ft_x_Img4" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $Items_edit->Img4->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Items_edit->Vid1->Visible) { // Vid1 ?>
	<div id="r_Vid1" class="form-group row">
		<label id="elh_Items_Vid1" class="<?php echo $Items_edit->LeftColumnClass ?>"><?php echo $Items_edit->Vid1->caption() ?><?php echo $Items_edit->Vid1->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Items_edit->RightColumnClass ?>"><div <?php echo $Items_edit->Vid1->cellAttributes() ?>>
<span id="el_Items_Vid1">
<div id="fd_x_Vid1">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $Items_edit->Vid1->title() ?>" data-table="Items" data-field="x_Vid1" name="x_Vid1" id="x_Vid1" lang="<?php echo CurrentLanguageID() ?>"<?php echo $Items_edit->Vid1->editAttributes() ?><?php if ($Items_edit->Vid1->ReadOnly || $Items_edit->Vid1->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_Vid1"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_Vid1" id= "fn_x_Vid1" value="<?php echo $Items_edit->Vid1->Upload->FileName ?>">
<input type="hidden" name="fa_x_Vid1" id= "fa_x_Vid1" value="<?php echo (Post("fa_x_Vid1") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_Vid1" id= "fs_x_Vid1" value="80">
<input type="hidden" name="fx_x_Vid1" id= "fx_x_Vid1" value="<?php echo $Items_edit->Vid1->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_Vid1" id= "fm_x_Vid1" value="<?php echo $Items_edit->Vid1->UploadMaxFileSize ?>">
</div>
<table id="ft_x_Vid1" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $Items_edit->Vid1->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Items_edit->Vid2->Visible) { // Vid2 ?>
	<div id="r_Vid2" class="form-group row">
		<label id="elh_Items_Vid2" class="<?php echo $Items_edit->LeftColumnClass ?>"><?php echo $Items_edit->Vid2->caption() ?><?php echo $Items_edit->Vid2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Items_edit->RightColumnClass ?>"><div <?php echo $Items_edit->Vid2->cellAttributes() ?>>
<span id="el_Items_Vid2">
<div id="fd_x_Vid2">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $Items_edit->Vid2->title() ?>" data-table="Items" data-field="x_Vid2" name="x_Vid2" id="x_Vid2" lang="<?php echo CurrentLanguageID() ?>"<?php echo $Items_edit->Vid2->editAttributes() ?><?php if ($Items_edit->Vid2->ReadOnly || $Items_edit->Vid2->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_Vid2"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_Vid2" id= "fn_x_Vid2" value="<?php echo $Items_edit->Vid2->Upload->FileName ?>">
<input type="hidden" name="fa_x_Vid2" id= "fa_x_Vid2" value="<?php echo (Post("fa_x_Vid2") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_Vid2" id= "fs_x_Vid2" value="80">
<input type="hidden" name="fx_x_Vid2" id= "fx_x_Vid2" value="<?php echo $Items_edit->Vid2->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_Vid2" id= "fm_x_Vid2" value="<?php echo $Items_edit->Vid2->UploadMaxFileSize ?>">
</div>
<table id="ft_x_Vid2" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $Items_edit->Vid2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Items_edit->Descripcion->Visible) { // Descripcion ?>
	<div id="r_Descripcion" class="form-group row">
		<label id="elh_Items_Descripcion" for="x_Descripcion" class="<?php echo $Items_edit->LeftColumnClass ?>"><?php echo $Items_edit->Descripcion->caption() ?><?php echo $Items_edit->Descripcion->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Items_edit->RightColumnClass ?>"><div <?php echo $Items_edit->Descripcion->cellAttributes() ?>>
<span id="el_Items_Descripcion">
<input type="text" data-table="Items" data-field="x_Descripcion" name="x_Descripcion" id="x_Descripcion" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($Items_edit->Descripcion->getPlaceHolder()) ?>" value="<?php echo $Items_edit->Descripcion->EditValue ?>"<?php echo $Items_edit->Descripcion->editAttributes() ?>>
</span>
<?php echo $Items_edit->Descripcion->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Items_edit->NombreEN->Visible) { // NombreEN ?>
	<div id="r_NombreEN" class="form-group row">
		<label id="elh_Items_NombreEN" for="x_NombreEN" class="<?php echo $Items_edit->LeftColumnClass ?>"><?php echo $Items_edit->NombreEN->caption() ?><?php echo $Items_edit->NombreEN->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Items_edit->RightColumnClass ?>"><div <?php echo $Items_edit->NombreEN->cellAttributes() ?>>
<span id="el_Items_NombreEN">
<input type="text" data-table="Items" data-field="x_NombreEN" name="x_NombreEN" id="x_NombreEN" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Items_edit->NombreEN->getPlaceHolder()) ?>" value="<?php echo $Items_edit->NombreEN->EditValue ?>"<?php echo $Items_edit->NombreEN->editAttributes() ?>>
</span>
<?php echo $Items_edit->NombreEN->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Items_edit->DescripcionEN->Visible) { // DescripcionEN ?>
	<div id="r_DescripcionEN" class="form-group row">
		<label id="elh_Items_DescripcionEN" for="x_DescripcionEN" class="<?php echo $Items_edit->LeftColumnClass ?>"><?php echo $Items_edit->DescripcionEN->caption() ?><?php echo $Items_edit->DescripcionEN->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Items_edit->RightColumnClass ?>"><div <?php echo $Items_edit->DescripcionEN->cellAttributes() ?>>
<span id="el_Items_DescripcionEN">
<input type="text" data-table="Items" data-field="x_DescripcionEN" name="x_DescripcionEN" id="x_DescripcionEN" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($Items_edit->DescripcionEN->getPlaceHolder()) ?>" value="<?php echo $Items_edit->DescripcionEN->EditValue ?>"<?php echo $Items_edit->DescripcionEN->editAttributes() ?>>
</span>
<?php echo $Items_edit->DescripcionEN->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Items_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $Items_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $Items_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$Items_edit->showPageFooter();
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
$Items_edit->terminate();
?>