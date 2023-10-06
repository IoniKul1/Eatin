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
$Restaurant_add = new Restaurant_add();

// Run the page
$Restaurant_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Restaurant_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fRestaurantadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fRestaurantadd = currentForm = new ew.Form("fRestaurantadd", "add");

	// Validate form
	fRestaurantadd.validate = function() {
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
			<?php if ($Restaurant_add->ID_State->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_State");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Restaurant_add->ID_State->caption(), $Restaurant_add->ID_State->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ID_State");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Restaurant_add->ID_State->errorMessage()) ?>");
			<?php if ($Restaurant_add->DateCreation->Required) { ?>
				elm = this.getElements("x" + infix + "_DateCreation");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Restaurant_add->DateCreation->caption(), $Restaurant_add->DateCreation->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateCreation");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Restaurant_add->DateCreation->errorMessage()) ?>");
			<?php if ($Restaurant_add->DateLastUpdate->Required) { ?>
				elm = this.getElements("x" + infix + "_DateLastUpdate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Restaurant_add->DateLastUpdate->caption(), $Restaurant_add->DateLastUpdate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateLastUpdate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Restaurant_add->DateLastUpdate->errorMessage()) ?>");
			<?php if ($Restaurant_add->Nombre->Required) { ?>
				elm = this.getElements("x" + infix + "_Nombre");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Restaurant_add->Nombre->caption(), $Restaurant_add->Nombre->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Restaurant_add->Lat->Required) { ?>
				elm = this.getElements("x" + infix + "_Lat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Restaurant_add->Lat->caption(), $Restaurant_add->Lat->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Lat");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Restaurant_add->Lat->errorMessage()) ?>");
			<?php if ($Restaurant_add->Lon->Required) { ?>
				elm = this.getElements("x" + infix + "_Lon");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Restaurant_add->Lon->caption(), $Restaurant_add->Lon->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Lon");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Restaurant_add->Lon->errorMessage()) ?>");
			<?php if ($Restaurant_add->GoogleGeocodeAddress->Required) { ?>
				elm = this.getElements("x" + infix + "_GoogleGeocodeAddress");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Restaurant_add->GoogleGeocodeAddress->caption(), $Restaurant_add->GoogleGeocodeAddress->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Restaurant_add->Address->Required) { ?>
				elm = this.getElements("x" + infix + "_Address");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Restaurant_add->Address->caption(), $Restaurant_add->Address->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Restaurant_add->Deactivated->Required) { ?>
				elm = this.getElements("x" + infix + "_Deactivated");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Restaurant_add->Deactivated->caption(), $Restaurant_add->Deactivated->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Deactivated");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Restaurant_add->Deactivated->errorMessage()) ?>");
			<?php if ($Restaurant_add->Suspended->Required) { ?>
				elm = this.getElements("x" + infix + "_Suspended");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Restaurant_add->Suspended->caption(), $Restaurant_add->Suspended->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Suspended");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Restaurant_add->Suspended->errorMessage()) ?>");
			<?php if ($Restaurant_add->ActualQRGrantCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ActualQRGrantCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Restaurant_add->ActualQRGrantCode->caption(), $Restaurant_add->ActualQRGrantCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Restaurant_add->_Email->Required) { ?>
				elm = this.getElements("x" + infix + "__Email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Restaurant_add->_Email->caption(), $Restaurant_add->_Email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Restaurant_add->Password->Required) { ?>
				elm = this.getElements("x" + infix + "_Password");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Restaurant_add->Password->caption(), $Restaurant_add->Password->RequiredErrorMessage)) ?>");
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
	fRestaurantadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fRestaurantadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fRestaurantadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $Restaurant_add->showPageHeader(); ?>
<?php
$Restaurant_add->showMessage();
?>
<form name="fRestaurantadd" id="fRestaurantadd" class="<?php echo $Restaurant_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Restaurant">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$Restaurant_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Restaurant_add->ID_State->Visible) { // ID_State ?>
	<div id="r_ID_State" class="form-group row">
		<label id="elh_Restaurant_ID_State" for="x_ID_State" class="<?php echo $Restaurant_add->LeftColumnClass ?>"><?php echo $Restaurant_add->ID_State->caption() ?><?php echo $Restaurant_add->ID_State->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Restaurant_add->RightColumnClass ?>"><div <?php echo $Restaurant_add->ID_State->cellAttributes() ?>>
<span id="el_Restaurant_ID_State">
<input type="text" data-table="Restaurant" data-field="x_ID_State" name="x_ID_State" id="x_ID_State" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Restaurant_add->ID_State->getPlaceHolder()) ?>" value="<?php echo $Restaurant_add->ID_State->EditValue ?>"<?php echo $Restaurant_add->ID_State->editAttributes() ?>>
</span>
<?php echo $Restaurant_add->ID_State->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Restaurant_add->DateCreation->Visible) { // DateCreation ?>
	<div id="r_DateCreation" class="form-group row">
		<label id="elh_Restaurant_DateCreation" for="x_DateCreation" class="<?php echo $Restaurant_add->LeftColumnClass ?>"><?php echo $Restaurant_add->DateCreation->caption() ?><?php echo $Restaurant_add->DateCreation->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Restaurant_add->RightColumnClass ?>"><div <?php echo $Restaurant_add->DateCreation->cellAttributes() ?>>
<span id="el_Restaurant_DateCreation">
<input type="text" data-table="Restaurant" data-field="x_DateCreation" name="x_DateCreation" id="x_DateCreation" maxlength="8" placeholder="<?php echo HtmlEncode($Restaurant_add->DateCreation->getPlaceHolder()) ?>" value="<?php echo $Restaurant_add->DateCreation->EditValue ?>"<?php echo $Restaurant_add->DateCreation->editAttributes() ?>>
<?php if (!$Restaurant_add->DateCreation->ReadOnly && !$Restaurant_add->DateCreation->Disabled && !isset($Restaurant_add->DateCreation->EditAttrs["readonly"]) && !isset($Restaurant_add->DateCreation->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fRestaurantadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fRestaurantadd", "x_DateCreation", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $Restaurant_add->DateCreation->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Restaurant_add->DateLastUpdate->Visible) { // DateLastUpdate ?>
	<div id="r_DateLastUpdate" class="form-group row">
		<label id="elh_Restaurant_DateLastUpdate" for="x_DateLastUpdate" class="<?php echo $Restaurant_add->LeftColumnClass ?>"><?php echo $Restaurant_add->DateLastUpdate->caption() ?><?php echo $Restaurant_add->DateLastUpdate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Restaurant_add->RightColumnClass ?>"><div <?php echo $Restaurant_add->DateLastUpdate->cellAttributes() ?>>
<span id="el_Restaurant_DateLastUpdate">
<input type="text" data-table="Restaurant" data-field="x_DateLastUpdate" name="x_DateLastUpdate" id="x_DateLastUpdate" maxlength="8" placeholder="<?php echo HtmlEncode($Restaurant_add->DateLastUpdate->getPlaceHolder()) ?>" value="<?php echo $Restaurant_add->DateLastUpdate->EditValue ?>"<?php echo $Restaurant_add->DateLastUpdate->editAttributes() ?>>
<?php if (!$Restaurant_add->DateLastUpdate->ReadOnly && !$Restaurant_add->DateLastUpdate->Disabled && !isset($Restaurant_add->DateLastUpdate->EditAttrs["readonly"]) && !isset($Restaurant_add->DateLastUpdate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fRestaurantadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fRestaurantadd", "x_DateLastUpdate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $Restaurant_add->DateLastUpdate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Restaurant_add->Nombre->Visible) { // Nombre ?>
	<div id="r_Nombre" class="form-group row">
		<label id="elh_Restaurant_Nombre" for="x_Nombre" class="<?php echo $Restaurant_add->LeftColumnClass ?>"><?php echo $Restaurant_add->Nombre->caption() ?><?php echo $Restaurant_add->Nombre->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Restaurant_add->RightColumnClass ?>"><div <?php echo $Restaurant_add->Nombre->cellAttributes() ?>>
<span id="el_Restaurant_Nombre">
<input type="text" data-table="Restaurant" data-field="x_Nombre" name="x_Nombre" id="x_Nombre" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Restaurant_add->Nombre->getPlaceHolder()) ?>" value="<?php echo $Restaurant_add->Nombre->EditValue ?>"<?php echo $Restaurant_add->Nombre->editAttributes() ?>>
</span>
<?php echo $Restaurant_add->Nombre->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Restaurant_add->Lat->Visible) { // Lat ?>
	<div id="r_Lat" class="form-group row">
		<label id="elh_Restaurant_Lat" for="x_Lat" class="<?php echo $Restaurant_add->LeftColumnClass ?>"><?php echo $Restaurant_add->Lat->caption() ?><?php echo $Restaurant_add->Lat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Restaurant_add->RightColumnClass ?>"><div <?php echo $Restaurant_add->Lat->cellAttributes() ?>>
<span id="el_Restaurant_Lat">
<input type="text" data-table="Restaurant" data-field="x_Lat" name="x_Lat" id="x_Lat" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Restaurant_add->Lat->getPlaceHolder()) ?>" value="<?php echo $Restaurant_add->Lat->EditValue ?>"<?php echo $Restaurant_add->Lat->editAttributes() ?>>
</span>
<?php echo $Restaurant_add->Lat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Restaurant_add->Lon->Visible) { // Lon ?>
	<div id="r_Lon" class="form-group row">
		<label id="elh_Restaurant_Lon" for="x_Lon" class="<?php echo $Restaurant_add->LeftColumnClass ?>"><?php echo $Restaurant_add->Lon->caption() ?><?php echo $Restaurant_add->Lon->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Restaurant_add->RightColumnClass ?>"><div <?php echo $Restaurant_add->Lon->cellAttributes() ?>>
<span id="el_Restaurant_Lon">
<input type="text" data-table="Restaurant" data-field="x_Lon" name="x_Lon" id="x_Lon" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Restaurant_add->Lon->getPlaceHolder()) ?>" value="<?php echo $Restaurant_add->Lon->EditValue ?>"<?php echo $Restaurant_add->Lon->editAttributes() ?>>
</span>
<?php echo $Restaurant_add->Lon->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Restaurant_add->GoogleGeocodeAddress->Visible) { // GoogleGeocodeAddress ?>
	<div id="r_GoogleGeocodeAddress" class="form-group row">
		<label id="elh_Restaurant_GoogleGeocodeAddress" for="x_GoogleGeocodeAddress" class="<?php echo $Restaurant_add->LeftColumnClass ?>"><?php echo $Restaurant_add->GoogleGeocodeAddress->caption() ?><?php echo $Restaurant_add->GoogleGeocodeAddress->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Restaurant_add->RightColumnClass ?>"><div <?php echo $Restaurant_add->GoogleGeocodeAddress->cellAttributes() ?>>
<span id="el_Restaurant_GoogleGeocodeAddress">
<input type="text" data-table="Restaurant" data-field="x_GoogleGeocodeAddress" name="x_GoogleGeocodeAddress" id="x_GoogleGeocodeAddress" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($Restaurant_add->GoogleGeocodeAddress->getPlaceHolder()) ?>" value="<?php echo $Restaurant_add->GoogleGeocodeAddress->EditValue ?>"<?php echo $Restaurant_add->GoogleGeocodeAddress->editAttributes() ?>>
</span>
<?php echo $Restaurant_add->GoogleGeocodeAddress->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Restaurant_add->Address->Visible) { // Address ?>
	<div id="r_Address" class="form-group row">
		<label id="elh_Restaurant_Address" for="x_Address" class="<?php echo $Restaurant_add->LeftColumnClass ?>"><?php echo $Restaurant_add->Address->caption() ?><?php echo $Restaurant_add->Address->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Restaurant_add->RightColumnClass ?>"><div <?php echo $Restaurant_add->Address->cellAttributes() ?>>
<span id="el_Restaurant_Address">
<input type="text" data-table="Restaurant" data-field="x_Address" name="x_Address" id="x_Address" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($Restaurant_add->Address->getPlaceHolder()) ?>" value="<?php echo $Restaurant_add->Address->EditValue ?>"<?php echo $Restaurant_add->Address->editAttributes() ?>>
</span>
<?php echo $Restaurant_add->Address->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Restaurant_add->Deactivated->Visible) { // Deactivated ?>
	<div id="r_Deactivated" class="form-group row">
		<label id="elh_Restaurant_Deactivated" for="x_Deactivated" class="<?php echo $Restaurant_add->LeftColumnClass ?>"><?php echo $Restaurant_add->Deactivated->caption() ?><?php echo $Restaurant_add->Deactivated->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Restaurant_add->RightColumnClass ?>"><div <?php echo $Restaurant_add->Deactivated->cellAttributes() ?>>
<span id="el_Restaurant_Deactivated">
<input type="text" data-table="Restaurant" data-field="x_Deactivated" name="x_Deactivated" id="x_Deactivated" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($Restaurant_add->Deactivated->getPlaceHolder()) ?>" value="<?php echo $Restaurant_add->Deactivated->EditValue ?>"<?php echo $Restaurant_add->Deactivated->editAttributes() ?>>
</span>
<?php echo $Restaurant_add->Deactivated->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Restaurant_add->Suspended->Visible) { // Suspended ?>
	<div id="r_Suspended" class="form-group row">
		<label id="elh_Restaurant_Suspended" for="x_Suspended" class="<?php echo $Restaurant_add->LeftColumnClass ?>"><?php echo $Restaurant_add->Suspended->caption() ?><?php echo $Restaurant_add->Suspended->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Restaurant_add->RightColumnClass ?>"><div <?php echo $Restaurant_add->Suspended->cellAttributes() ?>>
<span id="el_Restaurant_Suspended">
<input type="text" data-table="Restaurant" data-field="x_Suspended" name="x_Suspended" id="x_Suspended" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($Restaurant_add->Suspended->getPlaceHolder()) ?>" value="<?php echo $Restaurant_add->Suspended->EditValue ?>"<?php echo $Restaurant_add->Suspended->editAttributes() ?>>
</span>
<?php echo $Restaurant_add->Suspended->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Restaurant_add->ActualQRGrantCode->Visible) { // ActualQRGrantCode ?>
	<div id="r_ActualQRGrantCode" class="form-group row">
		<label id="elh_Restaurant_ActualQRGrantCode" for="x_ActualQRGrantCode" class="<?php echo $Restaurant_add->LeftColumnClass ?>"><?php echo $Restaurant_add->ActualQRGrantCode->caption() ?><?php echo $Restaurant_add->ActualQRGrantCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Restaurant_add->RightColumnClass ?>"><div <?php echo $Restaurant_add->ActualQRGrantCode->cellAttributes() ?>>
<span id="el_Restaurant_ActualQRGrantCode">
<input type="text" data-table="Restaurant" data-field="x_ActualQRGrantCode" name="x_ActualQRGrantCode" id="x_ActualQRGrantCode" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Restaurant_add->ActualQRGrantCode->getPlaceHolder()) ?>" value="<?php echo $Restaurant_add->ActualQRGrantCode->EditValue ?>"<?php echo $Restaurant_add->ActualQRGrantCode->editAttributes() ?>>
</span>
<?php echo $Restaurant_add->ActualQRGrantCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Restaurant_add->_Email->Visible) { // Email ?>
	<div id="r__Email" class="form-group row">
		<label id="elh_Restaurant__Email" for="x__Email" class="<?php echo $Restaurant_add->LeftColumnClass ?>"><?php echo $Restaurant_add->_Email->caption() ?><?php echo $Restaurant_add->_Email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Restaurant_add->RightColumnClass ?>"><div <?php echo $Restaurant_add->_Email->cellAttributes() ?>>
<span id="el_Restaurant__Email">
<input type="text" data-table="Restaurant" data-field="x__Email" name="x__Email" id="x__Email" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Restaurant_add->_Email->getPlaceHolder()) ?>" value="<?php echo $Restaurant_add->_Email->EditValue ?>"<?php echo $Restaurant_add->_Email->editAttributes() ?>>
</span>
<?php echo $Restaurant_add->_Email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Restaurant_add->Password->Visible) { // Password ?>
	<div id="r_Password" class="form-group row">
		<label id="elh_Restaurant_Password" for="x_Password" class="<?php echo $Restaurant_add->LeftColumnClass ?>"><?php echo $Restaurant_add->Password->caption() ?><?php echo $Restaurant_add->Password->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Restaurant_add->RightColumnClass ?>"><div <?php echo $Restaurant_add->Password->cellAttributes() ?>>
<span id="el_Restaurant_Password">
<input type="text" data-table="Restaurant" data-field="x_Password" name="x_Password" id="x_Password" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Restaurant_add->Password->getPlaceHolder()) ?>" value="<?php echo $Restaurant_add->Password->EditValue ?>"<?php echo $Restaurant_add->Password->editAttributes() ?>>
</span>
<?php echo $Restaurant_add->Password->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Restaurant_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $Restaurant_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $Restaurant_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$Restaurant_add->showPageFooter();
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
$Restaurant_add->terminate();
?>