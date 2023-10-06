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
$ItemOptions_edit = new ItemOptions_edit();

// Run the page
$ItemOptions_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ItemOptions_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fItemOptionsedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fItemOptionsedit = currentForm = new ew.Form("fItemOptionsedit", "edit");

	// Validate form
	fItemOptionsedit.validate = function() {
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
			<?php if ($ItemOptions_edit->ID->Required) { ?>
				elm = this.getElements("x" + infix + "_ID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ItemOptions_edit->ID->caption(), $ItemOptions_edit->ID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ItemOptions_edit->ID_Item->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_Item");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ItemOptions_edit->ID_Item->caption(), $ItemOptions_edit->ID_Item->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ID_Item");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ItemOptions_edit->ID_Item->errorMessage()) ?>");
			<?php if ($ItemOptions_edit->ID_Restaurant->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_Restaurant");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ItemOptions_edit->ID_Restaurant->caption(), $ItemOptions_edit->ID_Restaurant->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ID_Restaurant");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ItemOptions_edit->ID_Restaurant->errorMessage()) ?>");

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
	fItemOptionsedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fItemOptionsedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fItemOptionsedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ItemOptions_edit->showPageHeader(); ?>
<?php
$ItemOptions_edit->showMessage();
?>
<form name="fItemOptionsedit" id="fItemOptionsedit" class="<?php echo $ItemOptions_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ItemOptions">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$ItemOptions_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($ItemOptions_edit->ID->Visible) { // ID ?>
	<div id="r_ID" class="form-group row">
		<label id="elh_ItemOptions_ID" class="<?php echo $ItemOptions_edit->LeftColumnClass ?>"><?php echo $ItemOptions_edit->ID->caption() ?><?php echo $ItemOptions_edit->ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ItemOptions_edit->RightColumnClass ?>"><div <?php echo $ItemOptions_edit->ID->cellAttributes() ?>>
<span id="el_ItemOptions_ID">
<span<?php echo $ItemOptions_edit->ID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ItemOptions_edit->ID->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="ItemOptions" data-field="x_ID" name="x_ID" id="x_ID" value="<?php echo HtmlEncode($ItemOptions_edit->ID->CurrentValue) ?>">
<?php echo $ItemOptions_edit->ID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ItemOptions_edit->ID_Item->Visible) { // ID_Item ?>
	<div id="r_ID_Item" class="form-group row">
		<label id="elh_ItemOptions_ID_Item" for="x_ID_Item" class="<?php echo $ItemOptions_edit->LeftColumnClass ?>"><?php echo $ItemOptions_edit->ID_Item->caption() ?><?php echo $ItemOptions_edit->ID_Item->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ItemOptions_edit->RightColumnClass ?>"><div <?php echo $ItemOptions_edit->ID_Item->cellAttributes() ?>>
<span id="el_ItemOptions_ID_Item">
<input type="text" data-table="ItemOptions" data-field="x_ID_Item" name="x_ID_Item" id="x_ID_Item" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($ItemOptions_edit->ID_Item->getPlaceHolder()) ?>" value="<?php echo $ItemOptions_edit->ID_Item->EditValue ?>"<?php echo $ItemOptions_edit->ID_Item->editAttributes() ?>>
</span>
<?php echo $ItemOptions_edit->ID_Item->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ItemOptions_edit->ID_Restaurant->Visible) { // ID_Restaurant ?>
	<div id="r_ID_Restaurant" class="form-group row">
		<label id="elh_ItemOptions_ID_Restaurant" for="x_ID_Restaurant" class="<?php echo $ItemOptions_edit->LeftColumnClass ?>"><?php echo $ItemOptions_edit->ID_Restaurant->caption() ?><?php echo $ItemOptions_edit->ID_Restaurant->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ItemOptions_edit->RightColumnClass ?>"><div <?php echo $ItemOptions_edit->ID_Restaurant->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn() && !$ItemOptions->userIDAllow("edit")) { // Non system admin ?>
<span id="el_ItemOptions_ID_Restaurant">
<span<?php echo $ItemOptions_edit->ID_Restaurant->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ItemOptions_edit->ID_Restaurant->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="ItemOptions" data-field="x_ID_Restaurant" name="x_ID_Restaurant" id="x_ID_Restaurant" value="<?php echo HtmlEncode($ItemOptions_edit->ID_Restaurant->CurrentValue) ?>">
<?php } else { ?>
<span id="el_ItemOptions_ID_Restaurant">
<input type="text" data-table="ItemOptions" data-field="x_ID_Restaurant" name="x_ID_Restaurant" id="x_ID_Restaurant" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($ItemOptions_edit->ID_Restaurant->getPlaceHolder()) ?>" value="<?php echo $ItemOptions_edit->ID_Restaurant->EditValue ?>"<?php echo $ItemOptions_edit->ID_Restaurant->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $ItemOptions_edit->ID_Restaurant->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$ItemOptions_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $ItemOptions_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ItemOptions_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$ItemOptions_edit->showPageFooter();
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
$ItemOptions_edit->terminate();
?>