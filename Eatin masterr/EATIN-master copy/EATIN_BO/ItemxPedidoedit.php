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
$ItemxPedido_edit = new ItemxPedido_edit();

// Run the page
$ItemxPedido_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ItemxPedido_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fItemxPedidoedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fItemxPedidoedit = currentForm = new ew.Form("fItemxPedidoedit", "edit");

	// Validate form
	fItemxPedidoedit.validate = function() {
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
			<?php if ($ItemxPedido_edit->ID->Required) { ?>
				elm = this.getElements("x" + infix + "_ID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ItemxPedido_edit->ID->caption(), $ItemxPedido_edit->ID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ItemxPedido_edit->ID_Item->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_Item");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ItemxPedido_edit->ID_Item->caption(), $ItemxPedido_edit->ID_Item->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ID_Item");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ItemxPedido_edit->ID_Item->errorMessage()) ?>");
			<?php if ($ItemxPedido_edit->ID_Restaurant->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_Restaurant");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ItemxPedido_edit->ID_Restaurant->caption(), $ItemxPedido_edit->ID_Restaurant->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ID_Restaurant");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ItemxPedido_edit->ID_Restaurant->errorMessage()) ?>");
			<?php if ($ItemxPedido_edit->ID_Client->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_Client");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ItemxPedido_edit->ID_Client->caption(), $ItemxPedido_edit->ID_Client->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ID_Client");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ItemxPedido_edit->ID_Client->errorMessage()) ?>");
			<?php if ($ItemxPedido_edit->DateCreation->Required) { ?>
				elm = this.getElements("x" + infix + "_DateCreation");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ItemxPedido_edit->DateCreation->caption(), $ItemxPedido_edit->DateCreation->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateCreation");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ItemxPedido_edit->DateCreation->errorMessage()) ?>");
			<?php if ($ItemxPedido_edit->DateLastUpdate->Required) { ?>
				elm = this.getElements("x" + infix + "_DateLastUpdate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ItemxPedido_edit->DateLastUpdate->caption(), $ItemxPedido_edit->DateLastUpdate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateLastUpdate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ItemxPedido_edit->DateLastUpdate->errorMessage()) ?>");
			<?php if ($ItemxPedido_edit->Comments->Required) { ?>
				elm = this.getElements("x" + infix + "_Comments");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ItemxPedido_edit->Comments->caption(), $ItemxPedido_edit->Comments->RequiredErrorMessage)) ?>");
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
	fItemxPedidoedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fItemxPedidoedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fItemxPedidoedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ItemxPedido_edit->showPageHeader(); ?>
<?php
$ItemxPedido_edit->showMessage();
?>
<form name="fItemxPedidoedit" id="fItemxPedidoedit" class="<?php echo $ItemxPedido_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ItemxPedido">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$ItemxPedido_edit->IsModal ?>">
<?php if ($ItemxPedido->getCurrentMasterTable() == "Pedido") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="Pedido">
<input type="hidden" name="fk_ID" value="<?php echo HtmlEncode($ItemxPedido_edit->ID_Item->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($ItemxPedido_edit->ID->Visible) { // ID ?>
	<div id="r_ID" class="form-group row">
		<label id="elh_ItemxPedido_ID" class="<?php echo $ItemxPedido_edit->LeftColumnClass ?>"><?php echo $ItemxPedido_edit->ID->caption() ?><?php echo $ItemxPedido_edit->ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ItemxPedido_edit->RightColumnClass ?>"><div <?php echo $ItemxPedido_edit->ID->cellAttributes() ?>>
<span id="el_ItemxPedido_ID">
<span<?php echo $ItemxPedido_edit->ID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ItemxPedido_edit->ID->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="ItemxPedido" data-field="x_ID" name="x_ID" id="x_ID" value="<?php echo HtmlEncode($ItemxPedido_edit->ID->CurrentValue) ?>">
<?php echo $ItemxPedido_edit->ID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ItemxPedido_edit->ID_Item->Visible) { // ID_Item ?>
	<div id="r_ID_Item" class="form-group row">
		<label id="elh_ItemxPedido_ID_Item" for="x_ID_Item" class="<?php echo $ItemxPedido_edit->LeftColumnClass ?>"><?php echo $ItemxPedido_edit->ID_Item->caption() ?><?php echo $ItemxPedido_edit->ID_Item->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ItemxPedido_edit->RightColumnClass ?>"><div <?php echo $ItemxPedido_edit->ID_Item->cellAttributes() ?>>
<?php if ($ItemxPedido_edit->ID_Item->getSessionValue() != "") { ?>
<span id="el_ItemxPedido_ID_Item">
<span<?php echo $ItemxPedido_edit->ID_Item->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ItemxPedido_edit->ID_Item->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_ID_Item" name="x_ID_Item" value="<?php echo HtmlEncode($ItemxPedido_edit->ID_Item->CurrentValue) ?>">
<?php } else { ?>
<span id="el_ItemxPedido_ID_Item">
<input type="text" data-table="ItemxPedido" data-field="x_ID_Item" name="x_ID_Item" id="x_ID_Item" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($ItemxPedido_edit->ID_Item->getPlaceHolder()) ?>" value="<?php echo $ItemxPedido_edit->ID_Item->EditValue ?>"<?php echo $ItemxPedido_edit->ID_Item->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $ItemxPedido_edit->ID_Item->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ItemxPedido_edit->ID_Restaurant->Visible) { // ID_Restaurant ?>
	<div id="r_ID_Restaurant" class="form-group row">
		<label id="elh_ItemxPedido_ID_Restaurant" for="x_ID_Restaurant" class="<?php echo $ItemxPedido_edit->LeftColumnClass ?>"><?php echo $ItemxPedido_edit->ID_Restaurant->caption() ?><?php echo $ItemxPedido_edit->ID_Restaurant->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ItemxPedido_edit->RightColumnClass ?>"><div <?php echo $ItemxPedido_edit->ID_Restaurant->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn() && !$ItemxPedido->userIDAllow("edit")) { // Non system admin ?>
<span id="el_ItemxPedido_ID_Restaurant">
<span<?php echo $ItemxPedido_edit->ID_Restaurant->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ItemxPedido_edit->ID_Restaurant->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="ItemxPedido" data-field="x_ID_Restaurant" name="x_ID_Restaurant" id="x_ID_Restaurant" value="<?php echo HtmlEncode($ItemxPedido_edit->ID_Restaurant->CurrentValue) ?>">
<?php } else { ?>
<span id="el_ItemxPedido_ID_Restaurant">
<input type="text" data-table="ItemxPedido" data-field="x_ID_Restaurant" name="x_ID_Restaurant" id="x_ID_Restaurant" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($ItemxPedido_edit->ID_Restaurant->getPlaceHolder()) ?>" value="<?php echo $ItemxPedido_edit->ID_Restaurant->EditValue ?>"<?php echo $ItemxPedido_edit->ID_Restaurant->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $ItemxPedido_edit->ID_Restaurant->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ItemxPedido_edit->ID_Client->Visible) { // ID_Client ?>
	<div id="r_ID_Client" class="form-group row">
		<label id="elh_ItemxPedido_ID_Client" for="x_ID_Client" class="<?php echo $ItemxPedido_edit->LeftColumnClass ?>"><?php echo $ItemxPedido_edit->ID_Client->caption() ?><?php echo $ItemxPedido_edit->ID_Client->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ItemxPedido_edit->RightColumnClass ?>"><div <?php echo $ItemxPedido_edit->ID_Client->cellAttributes() ?>>
<span id="el_ItemxPedido_ID_Client">
<input type="text" data-table="ItemxPedido" data-field="x_ID_Client" name="x_ID_Client" id="x_ID_Client" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($ItemxPedido_edit->ID_Client->getPlaceHolder()) ?>" value="<?php echo $ItemxPedido_edit->ID_Client->EditValue ?>"<?php echo $ItemxPedido_edit->ID_Client->editAttributes() ?>>
</span>
<?php echo $ItemxPedido_edit->ID_Client->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ItemxPedido_edit->DateCreation->Visible) { // DateCreation ?>
	<div id="r_DateCreation" class="form-group row">
		<label id="elh_ItemxPedido_DateCreation" for="x_DateCreation" class="<?php echo $ItemxPedido_edit->LeftColumnClass ?>"><?php echo $ItemxPedido_edit->DateCreation->caption() ?><?php echo $ItemxPedido_edit->DateCreation->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ItemxPedido_edit->RightColumnClass ?>"><div <?php echo $ItemxPedido_edit->DateCreation->cellAttributes() ?>>
<span id="el_ItemxPedido_DateCreation">
<input type="text" data-table="ItemxPedido" data-field="x_DateCreation" name="x_DateCreation" id="x_DateCreation" maxlength="8" placeholder="<?php echo HtmlEncode($ItemxPedido_edit->DateCreation->getPlaceHolder()) ?>" value="<?php echo $ItemxPedido_edit->DateCreation->EditValue ?>"<?php echo $ItemxPedido_edit->DateCreation->editAttributes() ?>>
<?php if (!$ItemxPedido_edit->DateCreation->ReadOnly && !$ItemxPedido_edit->DateCreation->Disabled && !isset($ItemxPedido_edit->DateCreation->EditAttrs["readonly"]) && !isset($ItemxPedido_edit->DateCreation->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fItemxPedidoedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fItemxPedidoedit", "x_DateCreation", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $ItemxPedido_edit->DateCreation->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ItemxPedido_edit->DateLastUpdate->Visible) { // DateLastUpdate ?>
	<div id="r_DateLastUpdate" class="form-group row">
		<label id="elh_ItemxPedido_DateLastUpdate" for="x_DateLastUpdate" class="<?php echo $ItemxPedido_edit->LeftColumnClass ?>"><?php echo $ItemxPedido_edit->DateLastUpdate->caption() ?><?php echo $ItemxPedido_edit->DateLastUpdate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ItemxPedido_edit->RightColumnClass ?>"><div <?php echo $ItemxPedido_edit->DateLastUpdate->cellAttributes() ?>>
<span id="el_ItemxPedido_DateLastUpdate">
<input type="text" data-table="ItemxPedido" data-field="x_DateLastUpdate" name="x_DateLastUpdate" id="x_DateLastUpdate" maxlength="8" placeholder="<?php echo HtmlEncode($ItemxPedido_edit->DateLastUpdate->getPlaceHolder()) ?>" value="<?php echo $ItemxPedido_edit->DateLastUpdate->EditValue ?>"<?php echo $ItemxPedido_edit->DateLastUpdate->editAttributes() ?>>
<?php if (!$ItemxPedido_edit->DateLastUpdate->ReadOnly && !$ItemxPedido_edit->DateLastUpdate->Disabled && !isset($ItemxPedido_edit->DateLastUpdate->EditAttrs["readonly"]) && !isset($ItemxPedido_edit->DateLastUpdate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fItemxPedidoedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fItemxPedidoedit", "x_DateLastUpdate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $ItemxPedido_edit->DateLastUpdate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ItemxPedido_edit->Comments->Visible) { // Comments ?>
	<div id="r_Comments" class="form-group row">
		<label id="elh_ItemxPedido_Comments" for="x_Comments" class="<?php echo $ItemxPedido_edit->LeftColumnClass ?>"><?php echo $ItemxPedido_edit->Comments->caption() ?><?php echo $ItemxPedido_edit->Comments->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ItemxPedido_edit->RightColumnClass ?>"><div <?php echo $ItemxPedido_edit->Comments->cellAttributes() ?>>
<span id="el_ItemxPedido_Comments">
<input type="text" data-table="ItemxPedido" data-field="x_Comments" name="x_Comments" id="x_Comments" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($ItemxPedido_edit->Comments->getPlaceHolder()) ?>" value="<?php echo $ItemxPedido_edit->Comments->EditValue ?>"<?php echo $ItemxPedido_edit->Comments->editAttributes() ?>>
</span>
<?php echo $ItemxPedido_edit->Comments->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$ItemxPedido_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $ItemxPedido_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ItemxPedido_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$ItemxPedido_edit->showPageFooter();
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
$ItemxPedido_edit->terminate();
?>