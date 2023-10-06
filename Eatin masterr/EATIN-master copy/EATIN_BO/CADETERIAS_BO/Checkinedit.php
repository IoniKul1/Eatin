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
				elm = this.getElements("x" + infix + "_ID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Checkin_edit->ID->errorMessage()) ?>");
			<?php if ($Checkin_edit->ID_Cadete->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_Cadete");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Checkin_edit->ID_Cadete->caption(), $Checkin_edit->ID_Cadete->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ID_Cadete");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Checkin_edit->ID_Cadete->errorMessage()) ?>");
			<?php if ($Checkin_edit->ID_PedidoACadeteria->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_PedidoACadeteria");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Checkin_edit->ID_PedidoACadeteria->caption(), $Checkin_edit->ID_PedidoACadeteria->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ID_PedidoACadeteria");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Checkin_edit->ID_PedidoACadeteria->errorMessage()) ?>");
			<?php if ($Checkin_edit->FechaCreacion->Required) { ?>
				elm = this.getElements("x" + infix + "_FechaCreacion");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Checkin_edit->FechaCreacion->caption(), $Checkin_edit->FechaCreacion->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_FechaCreacion");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Checkin_edit->FechaCreacion->errorMessage()) ?>");
			<?php if ($Checkin_edit->ID_Cadeteria->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_Cadeteria");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Checkin_edit->ID_Cadeteria->caption(), $Checkin_edit->ID_Cadeteria->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ID_Cadeteria");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Checkin_edit->ID_Cadeteria->errorMessage()) ?>");

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
<div class="ew-edit-div"><!-- page* -->
<?php if ($Checkin_edit->ID->Visible) { // ID ?>
	<div id="r_ID" class="form-group row">
		<label id="elh_Checkin_ID" for="x_ID" class="<?php echo $Checkin_edit->LeftColumnClass ?>"><?php echo $Checkin_edit->ID->caption() ?><?php echo $Checkin_edit->ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Checkin_edit->RightColumnClass ?>"><div <?php echo $Checkin_edit->ID->cellAttributes() ?>>
<input type="text" data-table="Checkin" data-field="x_ID" name="x_ID" id="x_ID" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Checkin_edit->ID->getPlaceHolder()) ?>" value="<?php echo $Checkin_edit->ID->EditValue ?>"<?php echo $Checkin_edit->ID->editAttributes() ?>>
<input type="hidden" data-table="Checkin" data-field="x_ID" name="o_ID" id="o_ID" value="<?php echo HtmlEncode($Checkin_edit->ID->OldValue != null ? $Checkin_edit->ID->OldValue : $Checkin_edit->ID->CurrentValue) ?>">
<?php echo $Checkin_edit->ID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Checkin_edit->ID_Cadete->Visible) { // ID_Cadete ?>
	<div id="r_ID_Cadete" class="form-group row">
		<label id="elh_Checkin_ID_Cadete" for="x_ID_Cadete" class="<?php echo $Checkin_edit->LeftColumnClass ?>"><?php echo $Checkin_edit->ID_Cadete->caption() ?><?php echo $Checkin_edit->ID_Cadete->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Checkin_edit->RightColumnClass ?>"><div <?php echo $Checkin_edit->ID_Cadete->cellAttributes() ?>>
<span id="el_Checkin_ID_Cadete">
<input type="text" data-table="Checkin" data-field="x_ID_Cadete" name="x_ID_Cadete" id="x_ID_Cadete" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Checkin_edit->ID_Cadete->getPlaceHolder()) ?>" value="<?php echo $Checkin_edit->ID_Cadete->EditValue ?>"<?php echo $Checkin_edit->ID_Cadete->editAttributes() ?>>
</span>
<?php echo $Checkin_edit->ID_Cadete->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Checkin_edit->ID_PedidoACadeteria->Visible) { // ID_PedidoACadeteria ?>
	<div id="r_ID_PedidoACadeteria" class="form-group row">
		<label id="elh_Checkin_ID_PedidoACadeteria" for="x_ID_PedidoACadeteria" class="<?php echo $Checkin_edit->LeftColumnClass ?>"><?php echo $Checkin_edit->ID_PedidoACadeteria->caption() ?><?php echo $Checkin_edit->ID_PedidoACadeteria->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Checkin_edit->RightColumnClass ?>"><div <?php echo $Checkin_edit->ID_PedidoACadeteria->cellAttributes() ?>>
<span id="el_Checkin_ID_PedidoACadeteria">
<input type="text" data-table="Checkin" data-field="x_ID_PedidoACadeteria" name="x_ID_PedidoACadeteria" id="x_ID_PedidoACadeteria" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Checkin_edit->ID_PedidoACadeteria->getPlaceHolder()) ?>" value="<?php echo $Checkin_edit->ID_PedidoACadeteria->EditValue ?>"<?php echo $Checkin_edit->ID_PedidoACadeteria->editAttributes() ?>>
</span>
<?php echo $Checkin_edit->ID_PedidoACadeteria->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Checkin_edit->FechaCreacion->Visible) { // FechaCreacion ?>
	<div id="r_FechaCreacion" class="form-group row">
		<label id="elh_Checkin_FechaCreacion" for="x_FechaCreacion" class="<?php echo $Checkin_edit->LeftColumnClass ?>"><?php echo $Checkin_edit->FechaCreacion->caption() ?><?php echo $Checkin_edit->FechaCreacion->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Checkin_edit->RightColumnClass ?>"><div <?php echo $Checkin_edit->FechaCreacion->cellAttributes() ?>>
<span id="el_Checkin_FechaCreacion">
<input type="text" data-table="Checkin" data-field="x_FechaCreacion" name="x_FechaCreacion" id="x_FechaCreacion" maxlength="8" placeholder="<?php echo HtmlEncode($Checkin_edit->FechaCreacion->getPlaceHolder()) ?>" value="<?php echo $Checkin_edit->FechaCreacion->EditValue ?>"<?php echo $Checkin_edit->FechaCreacion->editAttributes() ?>>
<?php if (!$Checkin_edit->FechaCreacion->ReadOnly && !$Checkin_edit->FechaCreacion->Disabled && !isset($Checkin_edit->FechaCreacion->EditAttrs["readonly"]) && !isset($Checkin_edit->FechaCreacion->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fCheckinedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fCheckinedit", "x_FechaCreacion", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $Checkin_edit->FechaCreacion->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Checkin_edit->ID_Cadeteria->Visible) { // ID_Cadeteria ?>
	<div id="r_ID_Cadeteria" class="form-group row">
		<label id="elh_Checkin_ID_Cadeteria" for="x_ID_Cadeteria" class="<?php echo $Checkin_edit->LeftColumnClass ?>"><?php echo $Checkin_edit->ID_Cadeteria->caption() ?><?php echo $Checkin_edit->ID_Cadeteria->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Checkin_edit->RightColumnClass ?>"><div <?php echo $Checkin_edit->ID_Cadeteria->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn() && !$Checkin->userIDAllow("edit")) { // Non system admin ?>
<span id="el_Checkin_ID_Cadeteria">
<span<?php echo $Checkin_edit->ID_Cadeteria->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Checkin_edit->ID_Cadeteria->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="Checkin" data-field="x_ID_Cadeteria" name="x_ID_Cadeteria" id="x_ID_Cadeteria" value="<?php echo HtmlEncode($Checkin_edit->ID_Cadeteria->CurrentValue) ?>">
<?php } else { ?>
<span id="el_Checkin_ID_Cadeteria">
<input type="text" data-table="Checkin" data-field="x_ID_Cadeteria" name="x_ID_Cadeteria" id="x_ID_Cadeteria" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Checkin_edit->ID_Cadeteria->getPlaceHolder()) ?>" value="<?php echo $Checkin_edit->ID_Cadeteria->EditValue ?>"<?php echo $Checkin_edit->ID_Cadeteria->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $Checkin_edit->ID_Cadeteria->CustomMsg ?></div></div>
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