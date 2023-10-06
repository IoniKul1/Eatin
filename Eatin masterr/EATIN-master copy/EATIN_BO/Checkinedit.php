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
$Checkin_edit = new Checkin_edit();

// Run the page
$Checkin_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Checkin_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fCheckinedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fCheckinedit = currentForm = new ew.Form("fCheckinedit", "edit");

	// Validate form
	fCheckinedit.validate = function() {
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
			<?php if ($Checkin_edit->ID->Required) { ?>
				elm = this.getElements("x" + infix + "_ID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Checkin_edit->ID->caption(), $Checkin_edit->ID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Checkin_edit->ID_Client->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_Client");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Checkin_edit->ID_Client->caption(), $Checkin_edit->ID_Client->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ID_Client");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Checkin_edit->ID_Client->errorMessage()) ?>");
			<?php if ($Checkin_edit->ID_Restaurant->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_Restaurant");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Checkin_edit->ID_Restaurant->caption(), $Checkin_edit->ID_Restaurant->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ID_Restaurant");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Checkin_edit->ID_Restaurant->errorMessage()) ?>");
			<?php if ($Checkin_edit->DateCreation->Required) { ?>
				elm = this.getElements("x" + infix + "_DateCreation");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Checkin_edit->DateCreation->caption(), $Checkin_edit->DateCreation->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateCreation");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Checkin_edit->DateCreation->errorMessage()) ?>");

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
	fCheckinedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fCheckinedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fCheckinedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $Checkin_edit->showPageHeader(); ?>
<?php
$Checkin_edit->showMessage();
?>
<form name="fCheckinedit" id="fCheckinedit" class="<?php echo $Checkin_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Checkin">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$Checkin_edit->IsModal ?>">
<?php if ($Checkin->getCurrentMasterTable() == "Client") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="Client">
<input type="hidden" name="fk_ID" value="<?php echo HtmlEncode($Checkin_edit->ID_Client->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($Checkin_edit->ID->Visible) { // ID ?>
	<div id="r_ID" class="form-group row">
		<label id="elh_Checkin_ID" class="<?php echo $Checkin_edit->LeftColumnClass ?>"><?php echo $Checkin_edit->ID->caption() ?><?php echo $Checkin_edit->ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Checkin_edit->RightColumnClass ?>"><div <?php echo $Checkin_edit->ID->cellAttributes() ?>>
<span id="el_Checkin_ID">
<span<?php echo $Checkin_edit->ID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Checkin_edit->ID->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="Checkin" data-field="x_ID" name="x_ID" id="x_ID" value="<?php echo HtmlEncode($Checkin_edit->ID->CurrentValue) ?>">
<?php echo $Checkin_edit->ID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Checkin_edit->ID_Client->Visible) { // ID_Client ?>
	<div id="r_ID_Client" class="form-group row">
		<label id="elh_Checkin_ID_Client" for="x_ID_Client" class="<?php echo $Checkin_edit->LeftColumnClass ?>"><?php echo $Checkin_edit->ID_Client->caption() ?><?php echo $Checkin_edit->ID_Client->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Checkin_edit->RightColumnClass ?>"><div <?php echo $Checkin_edit->ID_Client->cellAttributes() ?>>
<?php if ($Checkin_edit->ID_Client->getSessionValue() != "") { ?>
<span id="el_Checkin_ID_Client">
<span<?php echo $Checkin_edit->ID_Client->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Checkin_edit->ID_Client->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_ID_Client" name="x_ID_Client" value="<?php echo HtmlEncode($Checkin_edit->ID_Client->CurrentValue) ?>">
<?php } else { ?>
<span id="el_Checkin_ID_Client">
<input type="text" data-table="Checkin" data-field="x_ID_Client" name="x_ID_Client" id="x_ID_Client" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Checkin_edit->ID_Client->getPlaceHolder()) ?>" value="<?php echo $Checkin_edit->ID_Client->EditValue ?>"<?php echo $Checkin_edit->ID_Client->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $Checkin_edit->ID_Client->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Checkin_edit->ID_Restaurant->Visible) { // ID_Restaurant ?>
	<div id="r_ID_Restaurant" class="form-group row">
		<label id="elh_Checkin_ID_Restaurant" for="x_ID_Restaurant" class="<?php echo $Checkin_edit->LeftColumnClass ?>"><?php echo $Checkin_edit->ID_Restaurant->caption() ?><?php echo $Checkin_edit->ID_Restaurant->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Checkin_edit->RightColumnClass ?>"><div <?php echo $Checkin_edit->ID_Restaurant->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn() && !$Checkin->userIDAllow("edit")) { // Non system admin ?>
<span id="el_Checkin_ID_Restaurant">
<span<?php echo $Checkin_edit->ID_Restaurant->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Checkin_edit->ID_Restaurant->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="Checkin" data-field="x_ID_Restaurant" name="x_ID_Restaurant" id="x_ID_Restaurant" value="<?php echo HtmlEncode($Checkin_edit->ID_Restaurant->CurrentValue) ?>">
<?php } else { ?>
<span id="el_Checkin_ID_Restaurant">
<input type="text" data-table="Checkin" data-field="x_ID_Restaurant" name="x_ID_Restaurant" id="x_ID_Restaurant" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Checkin_edit->ID_Restaurant->getPlaceHolder()) ?>" value="<?php echo $Checkin_edit->ID_Restaurant->EditValue ?>"<?php echo $Checkin_edit->ID_Restaurant->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $Checkin_edit->ID_Restaurant->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Checkin_edit->DateCreation->Visible) { // DateCreation ?>
	<div id="r_DateCreation" class="form-group row">
		<label id="elh_Checkin_DateCreation" for="x_DateCreation" class="<?php echo $Checkin_edit->LeftColumnClass ?>"><?php echo $Checkin_edit->DateCreation->caption() ?><?php echo $Checkin_edit->DateCreation->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Checkin_edit->RightColumnClass ?>"><div <?php echo $Checkin_edit->DateCreation->cellAttributes() ?>>
<span id="el_Checkin_DateCreation">
<input type="text" data-table="Checkin" data-field="x_DateCreation" name="x_DateCreation" id="x_DateCreation" maxlength="8" placeholder="<?php echo HtmlEncode($Checkin_edit->DateCreation->getPlaceHolder()) ?>" value="<?php echo $Checkin_edit->DateCreation->EditValue ?>"<?php echo $Checkin_edit->DateCreation->editAttributes() ?>>
<?php if (!$Checkin_edit->DateCreation->ReadOnly && !$Checkin_edit->DateCreation->Disabled && !isset($Checkin_edit->DateCreation->EditAttrs["readonly"]) && !isset($Checkin_edit->DateCreation->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fCheckinedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fCheckinedit", "x_DateCreation", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $Checkin_edit->DateCreation->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Checkin_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $Checkin_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $Checkin_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$Checkin_edit->showPageFooter();
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
$Checkin_edit->terminate();
?>