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
$Checkout_edit = new Checkout_edit();

// Run the page
$Checkout_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Checkout_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fCheckoutedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fCheckoutedit = currentForm = new ew.Form("fCheckoutedit", "edit");

	// Validate form
	fCheckoutedit.validate = function() {
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
			<?php if ($Checkout_edit->ID->Required) { ?>
				elm = this.getElements("x" + infix + "_ID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Checkout_edit->ID->caption(), $Checkout_edit->ID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Checkout_edit->ID->errorMessage()) ?>");
			<?php if ($Checkout_edit->ID_Cadete->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_Cadete");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Checkout_edit->ID_Cadete->caption(), $Checkout_edit->ID_Cadete->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ID_Cadete");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Checkout_edit->ID_Cadete->errorMessage()) ?>");
			<?php if ($Checkout_edit->ID_PedidoACadeteria->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_PedidoACadeteria");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Checkout_edit->ID_PedidoACadeteria->caption(), $Checkout_edit->ID_PedidoACadeteria->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ID_PedidoACadeteria");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Checkout_edit->ID_PedidoACadeteria->errorMessage()) ?>");
			<?php if ($Checkout_edit->FechaCreacion->Required) { ?>
				elm = this.getElements("x" + infix + "_FechaCreacion");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Checkout_edit->FechaCreacion->caption(), $Checkout_edit->FechaCreacion->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_FechaCreacion");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Checkout_edit->FechaCreacion->errorMessage()) ?>");
			<?php if ($Checkout_edit->ID_Cadeteria->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_Cadeteria");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Checkout_edit->ID_Cadeteria->caption(), $Checkout_edit->ID_Cadeteria->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ID_Cadeteria");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Checkout_edit->ID_Cadeteria->errorMessage()) ?>");

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
	fCheckoutedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fCheckoutedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fCheckoutedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $Checkout_edit->showPageHeader(); ?>
<?php
$Checkout_edit->showMessage();
?>
<form name="fCheckoutedit" id="fCheckoutedit" class="<?php echo $Checkout_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Checkout">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$Checkout_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Checkout_edit->ID->Visible) { // ID ?>
	<div id="r_ID" class="form-group row">
		<label id="elh_Checkout_ID" for="x_ID" class="<?php echo $Checkout_edit->LeftColumnClass ?>"><?php echo $Checkout_edit->ID->caption() ?><?php echo $Checkout_edit->ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Checkout_edit->RightColumnClass ?>"><div <?php echo $Checkout_edit->ID->cellAttributes() ?>>
<input type="text" data-table="Checkout" data-field="x_ID" name="x_ID" id="x_ID" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Checkout_edit->ID->getPlaceHolder()) ?>" value="<?php echo $Checkout_edit->ID->EditValue ?>"<?php echo $Checkout_edit->ID->editAttributes() ?>>
<input type="hidden" data-table="Checkout" data-field="x_ID" name="o_ID" id="o_ID" value="<?php echo HtmlEncode($Checkout_edit->ID->OldValue != null ? $Checkout_edit->ID->OldValue : $Checkout_edit->ID->CurrentValue) ?>">
<?php echo $Checkout_edit->ID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Checkout_edit->ID_Cadete->Visible) { // ID_Cadete ?>
	<div id="r_ID_Cadete" class="form-group row">
		<label id="elh_Checkout_ID_Cadete" for="x_ID_Cadete" class="<?php echo $Checkout_edit->LeftColumnClass ?>"><?php echo $Checkout_edit->ID_Cadete->caption() ?><?php echo $Checkout_edit->ID_Cadete->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Checkout_edit->RightColumnClass ?>"><div <?php echo $Checkout_edit->ID_Cadete->cellAttributes() ?>>
<span id="el_Checkout_ID_Cadete">
<input type="text" data-table="Checkout" data-field="x_ID_Cadete" name="x_ID_Cadete" id="x_ID_Cadete" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Checkout_edit->ID_Cadete->getPlaceHolder()) ?>" value="<?php echo $Checkout_edit->ID_Cadete->EditValue ?>"<?php echo $Checkout_edit->ID_Cadete->editAttributes() ?>>
</span>
<?php echo $Checkout_edit->ID_Cadete->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Checkout_edit->ID_PedidoACadeteria->Visible) { // ID_PedidoACadeteria ?>
	<div id="r_ID_PedidoACadeteria" class="form-group row">
		<label id="elh_Checkout_ID_PedidoACadeteria" for="x_ID_PedidoACadeteria" class="<?php echo $Checkout_edit->LeftColumnClass ?>"><?php echo $Checkout_edit->ID_PedidoACadeteria->caption() ?><?php echo $Checkout_edit->ID_PedidoACadeteria->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Checkout_edit->RightColumnClass ?>"><div <?php echo $Checkout_edit->ID_PedidoACadeteria->cellAttributes() ?>>
<span id="el_Checkout_ID_PedidoACadeteria">
<input type="text" data-table="Checkout" data-field="x_ID_PedidoACadeteria" name="x_ID_PedidoACadeteria" id="x_ID_PedidoACadeteria" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Checkout_edit->ID_PedidoACadeteria->getPlaceHolder()) ?>" value="<?php echo $Checkout_edit->ID_PedidoACadeteria->EditValue ?>"<?php echo $Checkout_edit->ID_PedidoACadeteria->editAttributes() ?>>
</span>
<?php echo $Checkout_edit->ID_PedidoACadeteria->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Checkout_edit->FechaCreacion->Visible) { // FechaCreacion ?>
	<div id="r_FechaCreacion" class="form-group row">
		<label id="elh_Checkout_FechaCreacion" for="x_FechaCreacion" class="<?php echo $Checkout_edit->LeftColumnClass ?>"><?php echo $Checkout_edit->FechaCreacion->caption() ?><?php echo $Checkout_edit->FechaCreacion->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Checkout_edit->RightColumnClass ?>"><div <?php echo $Checkout_edit->FechaCreacion->cellAttributes() ?>>
<span id="el_Checkout_FechaCreacion">
<input type="text" data-table="Checkout" data-field="x_FechaCreacion" name="x_FechaCreacion" id="x_FechaCreacion" maxlength="8" placeholder="<?php echo HtmlEncode($Checkout_edit->FechaCreacion->getPlaceHolder()) ?>" value="<?php echo $Checkout_edit->FechaCreacion->EditValue ?>"<?php echo $Checkout_edit->FechaCreacion->editAttributes() ?>>
<?php if (!$Checkout_edit->FechaCreacion->ReadOnly && !$Checkout_edit->FechaCreacion->Disabled && !isset($Checkout_edit->FechaCreacion->EditAttrs["readonly"]) && !isset($Checkout_edit->FechaCreacion->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fCheckoutedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fCheckoutedit", "x_FechaCreacion", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $Checkout_edit->FechaCreacion->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Checkout_edit->ID_Cadeteria->Visible) { // ID_Cadeteria ?>
	<div id="r_ID_Cadeteria" class="form-group row">
		<label id="elh_Checkout_ID_Cadeteria" for="x_ID_Cadeteria" class="<?php echo $Checkout_edit->LeftColumnClass ?>"><?php echo $Checkout_edit->ID_Cadeteria->caption() ?><?php echo $Checkout_edit->ID_Cadeteria->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Checkout_edit->RightColumnClass ?>"><div <?php echo $Checkout_edit->ID_Cadeteria->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn() && !$Checkout->userIDAllow("edit")) { // Non system admin ?>
<span id="el_Checkout_ID_Cadeteria">
<span<?php echo $Checkout_edit->ID_Cadeteria->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Checkout_edit->ID_Cadeteria->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="Checkout" data-field="x_ID_Cadeteria" name="x_ID_Cadeteria" id="x_ID_Cadeteria" value="<?php echo HtmlEncode($Checkout_edit->ID_Cadeteria->CurrentValue) ?>">
<?php } else { ?>
<span id="el_Checkout_ID_Cadeteria">
<input type="text" data-table="Checkout" data-field="x_ID_Cadeteria" name="x_ID_Cadeteria" id="x_ID_Cadeteria" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Checkout_edit->ID_Cadeteria->getPlaceHolder()) ?>" value="<?php echo $Checkout_edit->ID_Cadeteria->EditValue ?>"<?php echo $Checkout_edit->ID_Cadeteria->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $Checkout_edit->ID_Cadeteria->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Checkout_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $Checkout_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $Checkout_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$Checkout_edit->showPageFooter();
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
$Checkout_edit->terminate();
?>