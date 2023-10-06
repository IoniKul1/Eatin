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
$Cadeteria_edit = new Cadeteria_edit();

// Run the page
$Cadeteria_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Cadeteria_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fCadeteriaedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fCadeteriaedit = currentForm = new ew.Form("fCadeteriaedit", "edit");

	// Validate form
	fCadeteriaedit.validate = function() {
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
			<?php if ($Cadeteria_edit->ID->Required) { ?>
				elm = this.getElements("x" + infix + "_ID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadeteria_edit->ID->caption(), $Cadeteria_edit->ID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Cadeteria_edit->ID_Status->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_Status");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadeteria_edit->ID_Status->caption(), $Cadeteria_edit->ID_Status->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ID_Status");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Cadeteria_edit->ID_Status->errorMessage()) ?>");
			<?php if ($Cadeteria_edit->Nombre->Required) { ?>
				elm = this.getElements("x" + infix + "_Nombre");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadeteria_edit->Nombre->caption(), $Cadeteria_edit->Nombre->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Cadeteria_edit->Lat->Required) { ?>
				elm = this.getElements("x" + infix + "_Lat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadeteria_edit->Lat->caption(), $Cadeteria_edit->Lat->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Lat");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Cadeteria_edit->Lat->errorMessage()) ?>");
			<?php if ($Cadeteria_edit->Lon->Required) { ?>
				elm = this.getElements("x" + infix + "_Lon");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadeteria_edit->Lon->caption(), $Cadeteria_edit->Lon->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Lon");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Cadeteria_edit->Lon->errorMessage()) ?>");
			<?php if ($Cadeteria_edit->_Email->Required) { ?>
				elm = this.getElements("x" + infix + "__Email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadeteria_edit->_Email->caption(), $Cadeteria_edit->_Email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Cadeteria_edit->Hashpass->Required) { ?>
				elm = this.getElements("x" + infix + "_Hashpass");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadeteria_edit->Hashpass->caption(), $Cadeteria_edit->Hashpass->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Cadeteria_edit->fMult1->Required) { ?>
				elm = this.getElements("x" + infix + "_fMult1");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadeteria_edit->fMult1->caption(), $Cadeteria_edit->fMult1->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_fMult1");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Cadeteria_edit->fMult1->errorMessage()) ?>");
			<?php if ($Cadeteria_edit->fMult2->Required) { ?>
				elm = this.getElements("x" + infix + "_fMult2");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadeteria_edit->fMult2->caption(), $Cadeteria_edit->fMult2->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_fMult2");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Cadeteria_edit->fMult2->errorMessage()) ?>");

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
	fCadeteriaedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fCadeteriaedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fCadeteriaedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $Cadeteria_edit->showPageHeader(); ?>
<?php
$Cadeteria_edit->showMessage();
?>
<form name="fCadeteriaedit" id="fCadeteriaedit" class="<?php echo $Cadeteria_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Cadeteria">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$Cadeteria_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Cadeteria_edit->ID->Visible) { // ID ?>
	<div id="r_ID" class="form-group row">
		<label id="elh_Cadeteria_ID" class="<?php echo $Cadeteria_edit->LeftColumnClass ?>"><?php echo $Cadeteria_edit->ID->caption() ?><?php echo $Cadeteria_edit->ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadeteria_edit->RightColumnClass ?>"><div <?php echo $Cadeteria_edit->ID->cellAttributes() ?>>
<span id="el_Cadeteria_ID">
<span<?php echo $Cadeteria_edit->ID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Cadeteria_edit->ID->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="Cadeteria" data-field="x_ID" name="x_ID" id="x_ID" value="<?php echo HtmlEncode($Cadeteria_edit->ID->CurrentValue) ?>">
<?php echo $Cadeteria_edit->ID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadeteria_edit->ID_Status->Visible) { // ID_Status ?>
	<div id="r_ID_Status" class="form-group row">
		<label id="elh_Cadeteria_ID_Status" for="x_ID_Status" class="<?php echo $Cadeteria_edit->LeftColumnClass ?>"><?php echo $Cadeteria_edit->ID_Status->caption() ?><?php echo $Cadeteria_edit->ID_Status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadeteria_edit->RightColumnClass ?>"><div <?php echo $Cadeteria_edit->ID_Status->cellAttributes() ?>>
<span id="el_Cadeteria_ID_Status">
<input type="text" data-table="Cadeteria" data-field="x_ID_Status" name="x_ID_Status" id="x_ID_Status" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Cadeteria_edit->ID_Status->getPlaceHolder()) ?>" value="<?php echo $Cadeteria_edit->ID_Status->EditValue ?>"<?php echo $Cadeteria_edit->ID_Status->editAttributes() ?>>
</span>
<?php echo $Cadeteria_edit->ID_Status->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadeteria_edit->Nombre->Visible) { // Nombre ?>
	<div id="r_Nombre" class="form-group row">
		<label id="elh_Cadeteria_Nombre" for="x_Nombre" class="<?php echo $Cadeteria_edit->LeftColumnClass ?>"><?php echo $Cadeteria_edit->Nombre->caption() ?><?php echo $Cadeteria_edit->Nombre->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadeteria_edit->RightColumnClass ?>"><div <?php echo $Cadeteria_edit->Nombre->cellAttributes() ?>>
<span id="el_Cadeteria_Nombre">
<input type="text" data-table="Cadeteria" data-field="x_Nombre" name="x_Nombre" id="x_Nombre" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($Cadeteria_edit->Nombre->getPlaceHolder()) ?>" value="<?php echo $Cadeteria_edit->Nombre->EditValue ?>"<?php echo $Cadeteria_edit->Nombre->editAttributes() ?>>
</span>
<?php echo $Cadeteria_edit->Nombre->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadeteria_edit->Lat->Visible) { // Lat ?>
	<div id="r_Lat" class="form-group row">
		<label id="elh_Cadeteria_Lat" for="x_Lat" class="<?php echo $Cadeteria_edit->LeftColumnClass ?>"><?php echo $Cadeteria_edit->Lat->caption() ?><?php echo $Cadeteria_edit->Lat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadeteria_edit->RightColumnClass ?>"><div <?php echo $Cadeteria_edit->Lat->cellAttributes() ?>>
<span id="el_Cadeteria_Lat">
<input type="text" data-table="Cadeteria" data-field="x_Lat" name="x_Lat" id="x_Lat" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Cadeteria_edit->Lat->getPlaceHolder()) ?>" value="<?php echo $Cadeteria_edit->Lat->EditValue ?>"<?php echo $Cadeteria_edit->Lat->editAttributes() ?>>
</span>
<?php echo $Cadeteria_edit->Lat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadeteria_edit->Lon->Visible) { // Lon ?>
	<div id="r_Lon" class="form-group row">
		<label id="elh_Cadeteria_Lon" for="x_Lon" class="<?php echo $Cadeteria_edit->LeftColumnClass ?>"><?php echo $Cadeteria_edit->Lon->caption() ?><?php echo $Cadeteria_edit->Lon->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadeteria_edit->RightColumnClass ?>"><div <?php echo $Cadeteria_edit->Lon->cellAttributes() ?>>
<span id="el_Cadeteria_Lon">
<input type="text" data-table="Cadeteria" data-field="x_Lon" name="x_Lon" id="x_Lon" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Cadeteria_edit->Lon->getPlaceHolder()) ?>" value="<?php echo $Cadeteria_edit->Lon->EditValue ?>"<?php echo $Cadeteria_edit->Lon->editAttributes() ?>>
</span>
<?php echo $Cadeteria_edit->Lon->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadeteria_edit->_Email->Visible) { // Email ?>
	<div id="r__Email" class="form-group row">
		<label id="elh_Cadeteria__Email" for="x__Email" class="<?php echo $Cadeteria_edit->LeftColumnClass ?>"><?php echo $Cadeteria_edit->_Email->caption() ?><?php echo $Cadeteria_edit->_Email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadeteria_edit->RightColumnClass ?>"><div <?php echo $Cadeteria_edit->_Email->cellAttributes() ?>>
<span id="el_Cadeteria__Email">
<input type="text" data-table="Cadeteria" data-field="x__Email" name="x__Email" id="x__Email" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Cadeteria_edit->_Email->getPlaceHolder()) ?>" value="<?php echo $Cadeteria_edit->_Email->EditValue ?>"<?php echo $Cadeteria_edit->_Email->editAttributes() ?>>
</span>
<?php echo $Cadeteria_edit->_Email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadeteria_edit->Hashpass->Visible) { // Hashpass ?>
	<div id="r_Hashpass" class="form-group row">
		<label id="elh_Cadeteria_Hashpass" for="x_Hashpass" class="<?php echo $Cadeteria_edit->LeftColumnClass ?>"><?php echo $Cadeteria_edit->Hashpass->caption() ?><?php echo $Cadeteria_edit->Hashpass->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadeteria_edit->RightColumnClass ?>"><div <?php echo $Cadeteria_edit->Hashpass->cellAttributes() ?>>
<span id="el_Cadeteria_Hashpass">
<input type="text" data-table="Cadeteria" data-field="x_Hashpass" name="x_Hashpass" id="x_Hashpass" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Cadeteria_edit->Hashpass->getPlaceHolder()) ?>" value="<?php echo $Cadeteria_edit->Hashpass->EditValue ?>"<?php echo $Cadeteria_edit->Hashpass->editAttributes() ?>>
</span>
<?php echo $Cadeteria_edit->Hashpass->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadeteria_edit->fMult1->Visible) { // fMult1 ?>
	<div id="r_fMult1" class="form-group row">
		<label id="elh_Cadeteria_fMult1" for="x_fMult1" class="<?php echo $Cadeteria_edit->LeftColumnClass ?>"><?php echo $Cadeteria_edit->fMult1->caption() ?><?php echo $Cadeteria_edit->fMult1->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadeteria_edit->RightColumnClass ?>"><div <?php echo $Cadeteria_edit->fMult1->cellAttributes() ?>>
<span id="el_Cadeteria_fMult1">
<input type="text" data-table="Cadeteria" data-field="x_fMult1" name="x_fMult1" id="x_fMult1" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Cadeteria_edit->fMult1->getPlaceHolder()) ?>" value="<?php echo $Cadeteria_edit->fMult1->EditValue ?>"<?php echo $Cadeteria_edit->fMult1->editAttributes() ?>>
</span>
<?php echo $Cadeteria_edit->fMult1->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadeteria_edit->fMult2->Visible) { // fMult2 ?>
	<div id="r_fMult2" class="form-group row">
		<label id="elh_Cadeteria_fMult2" for="x_fMult2" class="<?php echo $Cadeteria_edit->LeftColumnClass ?>"><?php echo $Cadeteria_edit->fMult2->caption() ?><?php echo $Cadeteria_edit->fMult2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadeteria_edit->RightColumnClass ?>"><div <?php echo $Cadeteria_edit->fMult2->cellAttributes() ?>>
<span id="el_Cadeteria_fMult2">
<input type="text" data-table="Cadeteria" data-field="x_fMult2" name="x_fMult2" id="x_fMult2" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Cadeteria_edit->fMult2->getPlaceHolder()) ?>" value="<?php echo $Cadeteria_edit->fMult2->EditValue ?>"<?php echo $Cadeteria_edit->fMult2->editAttributes() ?>>
</span>
<?php echo $Cadeteria_edit->fMult2->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Cadeteria_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $Cadeteria_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $Cadeteria_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$Cadeteria_edit->showPageFooter();
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
$Cadeteria_edit->terminate();
?>