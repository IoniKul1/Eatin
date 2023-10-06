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
$Restaurant_edit = new Restaurant_edit();

// Run the page
$Restaurant_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Restaurant_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fRestaurantedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fRestaurantedit = currentForm = new ew.Form("fRestaurantedit", "edit");

	// Validate form
	fRestaurantedit.validate = function() {
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
			<?php if ($Restaurant_edit->ID->Required) { ?>
				elm = this.getElements("x" + infix + "_ID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Restaurant_edit->ID->caption(), $Restaurant_edit->ID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Restaurant_edit->ID_State->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_State");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Restaurant_edit->ID_State->caption(), $Restaurant_edit->ID_State->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ID_State");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Restaurant_edit->ID_State->errorMessage()) ?>");
			<?php if ($Restaurant_edit->Nombre->Required) { ?>
				elm = this.getElements("x" + infix + "_Nombre");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Restaurant_edit->Nombre->caption(), $Restaurant_edit->Nombre->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Restaurant_edit->Lat->Required) { ?>
				elm = this.getElements("x" + infix + "_Lat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Restaurant_edit->Lat->caption(), $Restaurant_edit->Lat->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Lat");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Restaurant_edit->Lat->errorMessage()) ?>");
			<?php if ($Restaurant_edit->Lon->Required) { ?>
				elm = this.getElements("x" + infix + "_Lon");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Restaurant_edit->Lon->caption(), $Restaurant_edit->Lon->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Lon");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Restaurant_edit->Lon->errorMessage()) ?>");
			<?php if ($Restaurant_edit->GoogleGeocodeAddress->Required) { ?>
				elm = this.getElements("x" + infix + "_GoogleGeocodeAddress");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Restaurant_edit->GoogleGeocodeAddress->caption(), $Restaurant_edit->GoogleGeocodeAddress->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Restaurant_edit->Address->Required) { ?>
				elm = this.getElements("x" + infix + "_Address");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Restaurant_edit->Address->caption(), $Restaurant_edit->Address->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Restaurant_edit->Deactivated->Required) { ?>
				elm = this.getElements("x" + infix + "_Deactivated[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Restaurant_edit->Deactivated->caption(), $Restaurant_edit->Deactivated->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Restaurant_edit->ActualQRGrantCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ActualQRGrantCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Restaurant_edit->ActualQRGrantCode->caption(), $Restaurant_edit->ActualQRGrantCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Restaurant_edit->_Email->Required) { ?>
				elm = this.getElements("x" + infix + "__Email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Restaurant_edit->_Email->caption(), $Restaurant_edit->_Email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Restaurant_edit->Password->Required) { ?>
				elm = this.getElements("x" + infix + "_Password");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Restaurant_edit->Password->caption(), $Restaurant_edit->Password->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Restaurant_edit->SplashImg->Required) { ?>
				felm = this.getElements("x" + infix + "_SplashImg");
				elm = this.getElements("fn_x" + infix + "_SplashImg");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $Restaurant_edit->SplashImg->caption(), $Restaurant_edit->SplashImg->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Restaurant_edit->LogoSize1->Required) { ?>
				felm = this.getElements("x" + infix + "_LogoSize1");
				elm = this.getElements("fn_x" + infix + "_LogoSize1");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $Restaurant_edit->LogoSize1->caption(), $Restaurant_edit->LogoSize1->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Restaurant_edit->LogoSize2->Required) { ?>
				felm = this.getElements("x" + infix + "_LogoSize2");
				elm = this.getElements("fn_x" + infix + "_LogoSize2");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $Restaurant_edit->LogoSize2->caption(), $Restaurant_edit->LogoSize2->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Restaurant_edit->AppCSS->Required) { ?>
				felm = this.getElements("x" + infix + "_AppCSS");
				elm = this.getElements("fn_x" + infix + "_AppCSS");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $Restaurant_edit->AppCSS->caption(), $Restaurant_edit->AppCSS->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Restaurant_edit->SplashVideo->Required) { ?>
				felm = this.getElements("x" + infix + "_SplashVideo");
				elm = this.getElements("fn_x" + infix + "_SplashVideo");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $Restaurant_edit->SplashVideo->caption(), $Restaurant_edit->SplashVideo->RequiredErrorMessage)) ?>");
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
	fRestaurantedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fRestaurantedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fRestaurantedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $Restaurant_edit->showPageHeader(); ?>
<?php
$Restaurant_edit->showMessage();
?>
<form name="fRestaurantedit" id="fRestaurantedit" class="<?php echo $Restaurant_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Restaurant">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$Restaurant_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Restaurant_edit->ID->Visible) { // ID ?>
	<div id="r_ID" class="form-group row">
		<label id="elh_Restaurant_ID" class="<?php echo $Restaurant_edit->LeftColumnClass ?>"><?php echo $Restaurant_edit->ID->caption() ?><?php echo $Restaurant_edit->ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Restaurant_edit->RightColumnClass ?>"><div <?php echo $Restaurant_edit->ID->cellAttributes() ?>>
<span id="el_Restaurant_ID">
<span<?php echo $Restaurant_edit->ID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Restaurant_edit->ID->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="Restaurant" data-field="x_ID" name="x_ID" id="x_ID" value="<?php echo HtmlEncode($Restaurant_edit->ID->CurrentValue) ?>">
<?php echo $Restaurant_edit->ID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Restaurant_edit->ID_State->Visible) { // ID_State ?>
	<div id="r_ID_State" class="form-group row">
		<label id="elh_Restaurant_ID_State" for="x_ID_State" class="<?php echo $Restaurant_edit->LeftColumnClass ?>"><?php echo $Restaurant_edit->ID_State->caption() ?><?php echo $Restaurant_edit->ID_State->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Restaurant_edit->RightColumnClass ?>"><div <?php echo $Restaurant_edit->ID_State->cellAttributes() ?>>
<span id="el_Restaurant_ID_State">
<input type="text" data-table="Restaurant" data-field="x_ID_State" name="x_ID_State" id="x_ID_State" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Restaurant_edit->ID_State->getPlaceHolder()) ?>" value="<?php echo $Restaurant_edit->ID_State->EditValue ?>"<?php echo $Restaurant_edit->ID_State->editAttributes() ?>>
</span>
<?php echo $Restaurant_edit->ID_State->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Restaurant_edit->Nombre->Visible) { // Nombre ?>
	<div id="r_Nombre" class="form-group row">
		<label id="elh_Restaurant_Nombre" for="x_Nombre" class="<?php echo $Restaurant_edit->LeftColumnClass ?>"><?php echo $Restaurant_edit->Nombre->caption() ?><?php echo $Restaurant_edit->Nombre->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Restaurant_edit->RightColumnClass ?>"><div <?php echo $Restaurant_edit->Nombre->cellAttributes() ?>>
<span id="el_Restaurant_Nombre">
<input type="text" data-table="Restaurant" data-field="x_Nombre" name="x_Nombre" id="x_Nombre" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Restaurant_edit->Nombre->getPlaceHolder()) ?>" value="<?php echo $Restaurant_edit->Nombre->EditValue ?>"<?php echo $Restaurant_edit->Nombre->editAttributes() ?>>
</span>
<?php echo $Restaurant_edit->Nombre->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Restaurant_edit->Lat->Visible) { // Lat ?>
	<div id="r_Lat" class="form-group row">
		<label id="elh_Restaurant_Lat" for="x_Lat" class="<?php echo $Restaurant_edit->LeftColumnClass ?>"><?php echo $Restaurant_edit->Lat->caption() ?><?php echo $Restaurant_edit->Lat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Restaurant_edit->RightColumnClass ?>"><div <?php echo $Restaurant_edit->Lat->cellAttributes() ?>>
<span id="el_Restaurant_Lat">
<input type="text" data-table="Restaurant" data-field="x_Lat" name="x_Lat" id="x_Lat" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Restaurant_edit->Lat->getPlaceHolder()) ?>" value="<?php echo $Restaurant_edit->Lat->EditValue ?>"<?php echo $Restaurant_edit->Lat->editAttributes() ?>>
</span>
<?php echo $Restaurant_edit->Lat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Restaurant_edit->Lon->Visible) { // Lon ?>
	<div id="r_Lon" class="form-group row">
		<label id="elh_Restaurant_Lon" for="x_Lon" class="<?php echo $Restaurant_edit->LeftColumnClass ?>"><?php echo $Restaurant_edit->Lon->caption() ?><?php echo $Restaurant_edit->Lon->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Restaurant_edit->RightColumnClass ?>"><div <?php echo $Restaurant_edit->Lon->cellAttributes() ?>>
<span id="el_Restaurant_Lon">
<input type="text" data-table="Restaurant" data-field="x_Lon" name="x_Lon" id="x_Lon" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Restaurant_edit->Lon->getPlaceHolder()) ?>" value="<?php echo $Restaurant_edit->Lon->EditValue ?>"<?php echo $Restaurant_edit->Lon->editAttributes() ?>>
</span>
<?php echo $Restaurant_edit->Lon->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Restaurant_edit->GoogleGeocodeAddress->Visible) { // GoogleGeocodeAddress ?>
	<div id="r_GoogleGeocodeAddress" class="form-group row">
		<label id="elh_Restaurant_GoogleGeocodeAddress" for="x_GoogleGeocodeAddress" class="<?php echo $Restaurant_edit->LeftColumnClass ?>"><?php echo $Restaurant_edit->GoogleGeocodeAddress->caption() ?><?php echo $Restaurant_edit->GoogleGeocodeAddress->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Restaurant_edit->RightColumnClass ?>"><div <?php echo $Restaurant_edit->GoogleGeocodeAddress->cellAttributes() ?>>
<span id="el_Restaurant_GoogleGeocodeAddress">
<input type="text" data-table="Restaurant" data-field="x_GoogleGeocodeAddress" name="x_GoogleGeocodeAddress" id="x_GoogleGeocodeAddress" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($Restaurant_edit->GoogleGeocodeAddress->getPlaceHolder()) ?>" value="<?php echo $Restaurant_edit->GoogleGeocodeAddress->EditValue ?>"<?php echo $Restaurant_edit->GoogleGeocodeAddress->editAttributes() ?>>
</span>
<?php echo $Restaurant_edit->GoogleGeocodeAddress->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Restaurant_edit->Address->Visible) { // Address ?>
	<div id="r_Address" class="form-group row">
		<label id="elh_Restaurant_Address" for="x_Address" class="<?php echo $Restaurant_edit->LeftColumnClass ?>"><?php echo $Restaurant_edit->Address->caption() ?><?php echo $Restaurant_edit->Address->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Restaurant_edit->RightColumnClass ?>"><div <?php echo $Restaurant_edit->Address->cellAttributes() ?>>
<span id="el_Restaurant_Address">
<input type="text" data-table="Restaurant" data-field="x_Address" name="x_Address" id="x_Address" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($Restaurant_edit->Address->getPlaceHolder()) ?>" value="<?php echo $Restaurant_edit->Address->EditValue ?>"<?php echo $Restaurant_edit->Address->editAttributes() ?>>
</span>
<?php echo $Restaurant_edit->Address->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Restaurant_edit->Deactivated->Visible) { // Deactivated ?>
	<div id="r_Deactivated" class="form-group row">
		<label id="elh_Restaurant_Deactivated" class="<?php echo $Restaurant_edit->LeftColumnClass ?>"><?php echo $Restaurant_edit->Deactivated->caption() ?><?php echo $Restaurant_edit->Deactivated->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Restaurant_edit->RightColumnClass ?>"><div <?php echo $Restaurant_edit->Deactivated->cellAttributes() ?>>
<span id="el_Restaurant_Deactivated">
<span<?php echo $Restaurant_edit->Deactivated->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Restaurant_edit->Deactivated->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="Restaurant" data-field="x_Deactivated" name="x_Deactivated" id="x_Deactivated" value="<?php echo HtmlEncode($Restaurant_edit->Deactivated->CurrentValue) ?>">
<?php echo $Restaurant_edit->Deactivated->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Restaurant_edit->ActualQRGrantCode->Visible) { // ActualQRGrantCode ?>
	<div id="r_ActualQRGrantCode" class="form-group row">
		<label id="elh_Restaurant_ActualQRGrantCode" for="x_ActualQRGrantCode" class="<?php echo $Restaurant_edit->LeftColumnClass ?>"><?php echo $Restaurant_edit->ActualQRGrantCode->caption() ?><?php echo $Restaurant_edit->ActualQRGrantCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Restaurant_edit->RightColumnClass ?>"><div <?php echo $Restaurant_edit->ActualQRGrantCode->cellAttributes() ?>>
<span id="el_Restaurant_ActualQRGrantCode">
<input type="text" data-table="Restaurant" data-field="x_ActualQRGrantCode" name="x_ActualQRGrantCode" id="x_ActualQRGrantCode" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Restaurant_edit->ActualQRGrantCode->getPlaceHolder()) ?>" value="<?php echo $Restaurant_edit->ActualQRGrantCode->EditValue ?>"<?php echo $Restaurant_edit->ActualQRGrantCode->editAttributes() ?>>
</span>
<?php echo $Restaurant_edit->ActualQRGrantCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Restaurant_edit->_Email->Visible) { // Email ?>
	<div id="r__Email" class="form-group row">
		<label id="elh_Restaurant__Email" for="x__Email" class="<?php echo $Restaurant_edit->LeftColumnClass ?>"><?php echo $Restaurant_edit->_Email->caption() ?><?php echo $Restaurant_edit->_Email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Restaurant_edit->RightColumnClass ?>"><div <?php echo $Restaurant_edit->_Email->cellAttributes() ?>>
<span id="el_Restaurant__Email">
<input type="text" data-table="Restaurant" data-field="x__Email" name="x__Email" id="x__Email" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Restaurant_edit->_Email->getPlaceHolder()) ?>" value="<?php echo $Restaurant_edit->_Email->EditValue ?>"<?php echo $Restaurant_edit->_Email->editAttributes() ?>>
</span>
<?php echo $Restaurant_edit->_Email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Restaurant_edit->Password->Visible) { // Password ?>
	<div id="r_Password" class="form-group row">
		<label id="elh_Restaurant_Password" for="x_Password" class="<?php echo $Restaurant_edit->LeftColumnClass ?>"><?php echo $Restaurant_edit->Password->caption() ?><?php echo $Restaurant_edit->Password->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Restaurant_edit->RightColumnClass ?>"><div <?php echo $Restaurant_edit->Password->cellAttributes() ?>>
<span id="el_Restaurant_Password">
<div class="input-group"><input type="password" name="x_Password" id="x_Password" autocomplete="new-password" data-field="x_Password" value="<?php echo $Restaurant_edit->Password->EditValue ?>" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Restaurant_edit->Password->getPlaceHolder()) ?>"<?php echo $Restaurant_edit->Password->editAttributes() ?>><div class="input-group-append"><button type="button" class="btn btn-default ew-toggle-password" onclick="ew.togglePassword(event);"><i class="fas fa-eye"></i></button></div></div>
</span>
<?php echo $Restaurant_edit->Password->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Restaurant_edit->SplashImg->Visible) { // SplashImg ?>
	<div id="r_SplashImg" class="form-group row">
		<label id="elh_Restaurant_SplashImg" class="<?php echo $Restaurant_edit->LeftColumnClass ?>"><?php echo $Restaurant_edit->SplashImg->caption() ?><?php echo $Restaurant_edit->SplashImg->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Restaurant_edit->RightColumnClass ?>"><div <?php echo $Restaurant_edit->SplashImg->cellAttributes() ?>>
<span id="el_Restaurant_SplashImg">
<div id="fd_x_SplashImg">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $Restaurant_edit->SplashImg->title() ?>" data-table="Restaurant" data-field="x_SplashImg" name="x_SplashImg" id="x_SplashImg" lang="<?php echo CurrentLanguageID() ?>"<?php echo $Restaurant_edit->SplashImg->editAttributes() ?><?php if ($Restaurant_edit->SplashImg->ReadOnly || $Restaurant_edit->SplashImg->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_SplashImg"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_SplashImg" id= "fn_x_SplashImg" value="<?php echo $Restaurant_edit->SplashImg->Upload->FileName ?>">
<input type="hidden" name="fa_x_SplashImg" id= "fa_x_SplashImg" value="<?php echo (Post("fa_x_SplashImg") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_SplashImg" id= "fs_x_SplashImg" value="80">
<input type="hidden" name="fx_x_SplashImg" id= "fx_x_SplashImg" value="<?php echo $Restaurant_edit->SplashImg->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_SplashImg" id= "fm_x_SplashImg" value="<?php echo $Restaurant_edit->SplashImg->UploadMaxFileSize ?>">
</div>
<table id="ft_x_SplashImg" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $Restaurant_edit->SplashImg->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Restaurant_edit->LogoSize1->Visible) { // LogoSize1 ?>
	<div id="r_LogoSize1" class="form-group row">
		<label id="elh_Restaurant_LogoSize1" class="<?php echo $Restaurant_edit->LeftColumnClass ?>"><?php echo $Restaurant_edit->LogoSize1->caption() ?><?php echo $Restaurant_edit->LogoSize1->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Restaurant_edit->RightColumnClass ?>"><div <?php echo $Restaurant_edit->LogoSize1->cellAttributes() ?>>
<span id="el_Restaurant_LogoSize1">
<div id="fd_x_LogoSize1">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $Restaurant_edit->LogoSize1->title() ?>" data-table="Restaurant" data-field="x_LogoSize1" name="x_LogoSize1" id="x_LogoSize1" lang="<?php echo CurrentLanguageID() ?>"<?php echo $Restaurant_edit->LogoSize1->editAttributes() ?><?php if ($Restaurant_edit->LogoSize1->ReadOnly || $Restaurant_edit->LogoSize1->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_LogoSize1"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_LogoSize1" id= "fn_x_LogoSize1" value="<?php echo $Restaurant_edit->LogoSize1->Upload->FileName ?>">
<input type="hidden" name="fa_x_LogoSize1" id= "fa_x_LogoSize1" value="<?php echo (Post("fa_x_LogoSize1") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_LogoSize1" id= "fs_x_LogoSize1" value="80">
<input type="hidden" name="fx_x_LogoSize1" id= "fx_x_LogoSize1" value="<?php echo $Restaurant_edit->LogoSize1->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_LogoSize1" id= "fm_x_LogoSize1" value="<?php echo $Restaurant_edit->LogoSize1->UploadMaxFileSize ?>">
</div>
<table id="ft_x_LogoSize1" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $Restaurant_edit->LogoSize1->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Restaurant_edit->LogoSize2->Visible) { // LogoSize2 ?>
	<div id="r_LogoSize2" class="form-group row">
		<label id="elh_Restaurant_LogoSize2" class="<?php echo $Restaurant_edit->LeftColumnClass ?>"><?php echo $Restaurant_edit->LogoSize2->caption() ?><?php echo $Restaurant_edit->LogoSize2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Restaurant_edit->RightColumnClass ?>"><div <?php echo $Restaurant_edit->LogoSize2->cellAttributes() ?>>
<span id="el_Restaurant_LogoSize2">
<div id="fd_x_LogoSize2">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $Restaurant_edit->LogoSize2->title() ?>" data-table="Restaurant" data-field="x_LogoSize2" name="x_LogoSize2" id="x_LogoSize2" lang="<?php echo CurrentLanguageID() ?>"<?php echo $Restaurant_edit->LogoSize2->editAttributes() ?><?php if ($Restaurant_edit->LogoSize2->ReadOnly || $Restaurant_edit->LogoSize2->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_LogoSize2"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_LogoSize2" id= "fn_x_LogoSize2" value="<?php echo $Restaurant_edit->LogoSize2->Upload->FileName ?>">
<input type="hidden" name="fa_x_LogoSize2" id= "fa_x_LogoSize2" value="<?php echo (Post("fa_x_LogoSize2") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_LogoSize2" id= "fs_x_LogoSize2" value="80">
<input type="hidden" name="fx_x_LogoSize2" id= "fx_x_LogoSize2" value="<?php echo $Restaurant_edit->LogoSize2->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_LogoSize2" id= "fm_x_LogoSize2" value="<?php echo $Restaurant_edit->LogoSize2->UploadMaxFileSize ?>">
</div>
<table id="ft_x_LogoSize2" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $Restaurant_edit->LogoSize2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Restaurant_edit->AppCSS->Visible) { // AppCSS ?>
	<div id="r_AppCSS" class="form-group row">
		<label id="elh_Restaurant_AppCSS" class="<?php echo $Restaurant_edit->LeftColumnClass ?>"><?php echo $Restaurant_edit->AppCSS->caption() ?><?php echo $Restaurant_edit->AppCSS->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Restaurant_edit->RightColumnClass ?>"><div <?php echo $Restaurant_edit->AppCSS->cellAttributes() ?>>
<span id="el_Restaurant_AppCSS">
<div id="fd_x_AppCSS">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $Restaurant_edit->AppCSS->title() ?>" data-table="Restaurant" data-field="x_AppCSS" name="x_AppCSS" id="x_AppCSS" lang="<?php echo CurrentLanguageID() ?>"<?php echo $Restaurant_edit->AppCSS->editAttributes() ?><?php if ($Restaurant_edit->AppCSS->ReadOnly || $Restaurant_edit->AppCSS->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_AppCSS"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_AppCSS" id= "fn_x_AppCSS" value="<?php echo $Restaurant_edit->AppCSS->Upload->FileName ?>">
<input type="hidden" name="fa_x_AppCSS" id= "fa_x_AppCSS" value="<?php echo (Post("fa_x_AppCSS") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_AppCSS" id= "fs_x_AppCSS" value="80">
<input type="hidden" name="fx_x_AppCSS" id= "fx_x_AppCSS" value="<?php echo $Restaurant_edit->AppCSS->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_AppCSS" id= "fm_x_AppCSS" value="<?php echo $Restaurant_edit->AppCSS->UploadMaxFileSize ?>">
</div>
<table id="ft_x_AppCSS" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $Restaurant_edit->AppCSS->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Restaurant_edit->SplashVideo->Visible) { // SplashVideo ?>
	<div id="r_SplashVideo" class="form-group row">
		<label id="elh_Restaurant_SplashVideo" class="<?php echo $Restaurant_edit->LeftColumnClass ?>"><?php echo $Restaurant_edit->SplashVideo->caption() ?><?php echo $Restaurant_edit->SplashVideo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Restaurant_edit->RightColumnClass ?>"><div <?php echo $Restaurant_edit->SplashVideo->cellAttributes() ?>>
<span id="el_Restaurant_SplashVideo">
<div id="fd_x_SplashVideo">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $Restaurant_edit->SplashVideo->title() ?>" data-table="Restaurant" data-field="x_SplashVideo" name="x_SplashVideo" id="x_SplashVideo" lang="<?php echo CurrentLanguageID() ?>"<?php echo $Restaurant_edit->SplashVideo->editAttributes() ?><?php if ($Restaurant_edit->SplashVideo->ReadOnly || $Restaurant_edit->SplashVideo->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_SplashVideo"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_SplashVideo" id= "fn_x_SplashVideo" value="<?php echo $Restaurant_edit->SplashVideo->Upload->FileName ?>">
<input type="hidden" name="fa_x_SplashVideo" id= "fa_x_SplashVideo" value="<?php echo (Post("fa_x_SplashVideo") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_SplashVideo" id= "fs_x_SplashVideo" value="80">
<input type="hidden" name="fx_x_SplashVideo" id= "fx_x_SplashVideo" value="<?php echo $Restaurant_edit->SplashVideo->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_SplashVideo" id= "fm_x_SplashVideo" value="<?php echo $Restaurant_edit->SplashVideo->UploadMaxFileSize ?>">
</div>
<table id="ft_x_SplashVideo" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $Restaurant_edit->SplashVideo->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("Client", explode(",", $Restaurant->getCurrentDetailTable())) && $Client->DetailEdit) {
?>
<?php if ($Restaurant->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("Client", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "Clientgrid.php" ?>
<?php } ?>
<?php
	if (in_array("Categorias", explode(",", $Restaurant->getCurrentDetailTable())) && $Categorias->DetailEdit) {
?>
<?php if ($Restaurant->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("Categorias", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "Categoriasgrid.php" ?>
<?php } ?>
<?php
	if (in_array("_Table", explode(",", $Restaurant->getCurrentDetailTable())) && $_Table->DetailEdit) {
?>
<?php if ($Restaurant->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("_Table", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "_Tablegrid.php" ?>
<?php } ?>
<?php if (!$Restaurant_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $Restaurant_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $Restaurant_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$Restaurant_edit->showPageFooter();
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
$Restaurant_edit->terminate();
?>