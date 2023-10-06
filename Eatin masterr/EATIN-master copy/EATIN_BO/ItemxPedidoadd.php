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
$ItemxPedido_add = new ItemxPedido_add();

// Run the page
$ItemxPedido_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ItemxPedido_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fItemxPedidoadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fItemxPedidoadd = currentForm = new ew.Form("fItemxPedidoadd", "add");

	// Validate form
	fItemxPedidoadd.validate = function() {
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
			<?php if ($ItemxPedido_add->ID_Item->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_Item");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ItemxPedido_add->ID_Item->caption(), $ItemxPedido_add->ID_Item->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ID_Item");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ItemxPedido_add->ID_Item->errorMessage()) ?>");
			<?php if ($ItemxPedido_add->ID_Restaurant->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_Restaurant");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ItemxPedido_add->ID_Restaurant->caption(), $ItemxPedido_add->ID_Restaurant->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ID_Restaurant");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ItemxPedido_add->ID_Restaurant->errorMessage()) ?>");
			<?php if ($ItemxPedido_add->ID_Client->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_Client");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ItemxPedido_add->ID_Client->caption(), $ItemxPedido_add->ID_Client->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ID_Client");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ItemxPedido_add->ID_Client->errorMessage()) ?>");
			<?php if ($ItemxPedido_add->DateCreation->Required) { ?>
				elm = this.getElements("x" + infix + "_DateCreation");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ItemxPedido_add->DateCreation->caption(), $ItemxPedido_add->DateCreation->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateCreation");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ItemxPedido_add->DateCreation->errorMessage()) ?>");
			<?php if ($ItemxPedido_add->DateLastUpdate->Required) { ?>
				elm = this.getElements("x" + infix + "_DateLastUpdate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ItemxPedido_add->DateLastUpdate->caption(), $ItemxPedido_add->DateLastUpdate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateLastUpdate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ItemxPedido_add->DateLastUpdate->errorMessage()) ?>");
			<?php if ($ItemxPedido_add->Comments->Required) { ?>
				elm = this.getElements("x" + infix + "_Comments");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ItemxPedido_add->Comments->caption(), $ItemxPedido_add->Comments->RequiredErrorMessage)) ?>");
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
	fItemxPedidoadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fItemxPedidoadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fItemxPedidoadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ItemxPedido_add->showPageHeader(); ?>
<?php
$ItemxPedido_add->showMessage();
?>
<form name="fItemxPedidoadd" id="fItemxPedidoadd" class="<?php echo $ItemxPedido_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ItemxPedido">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$ItemxPedido_add->IsModal ?>">
<?php if ($ItemxPedido->getCurrentMasterTable() == "Pedido") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="Pedido">
<input type="hidden" name="fk_ID" value="<?php echo HtmlEncode($ItemxPedido_add->ID_Item->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($ItemxPedido_add->ID_Item->Visible) { // ID_Item ?>
	<div id="r_ID_Item" class="form-group row">
		<label id="elh_ItemxPedido_ID_Item" for="x_ID_Item" class="<?php echo $ItemxPedido_add->LeftColumnClass ?>"><?php echo $ItemxPedido_add->ID_Item->caption() ?><?php echo $ItemxPedido_add->ID_Item->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ItemxPedido_add->RightColumnClass ?>"><div <?php echo $ItemxPedido_add->ID_Item->cellAttributes() ?>>
<?php if ($ItemxPedido_add->ID_Item->getSessionValue() != "") { ?>
<span id="el_ItemxPedido_ID_Item">
<span<?php echo $ItemxPedido_add->ID_Item->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ItemxPedido_add->ID_Item->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_ID_Item" name="x_ID_Item" value="<?php echo HtmlEncode($ItemxPedido_add->ID_Item->CurrentValue) ?>">
<?php } else { ?>
<span id="el_ItemxPedido_ID_Item">
<input type="text" data-table="ItemxPedido" data-field="x_ID_Item" name="x_ID_Item" id="x_ID_Item" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($ItemxPedido_add->ID_Item->getPlaceHolder()) ?>" value="<?php echo $ItemxPedido_add->ID_Item->EditValue ?>"<?php echo $ItemxPedido_add->ID_Item->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $ItemxPedido_add->ID_Item->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ItemxPedido_add->ID_Restaurant->Visible) { // ID_Restaurant ?>
	<div id="r_ID_Restaurant" class="form-group row">
		<label id="elh_ItemxPedido_ID_Restaurant" for="x_ID_Restaurant" class="<?php echo $ItemxPedido_add->LeftColumnClass ?>"><?php echo $ItemxPedido_add->ID_Restaurant->caption() ?><?php echo $ItemxPedido_add->ID_Restaurant->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ItemxPedido_add->RightColumnClass ?>"><div <?php echo $ItemxPedido_add->ID_Restaurant->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn() && !$ItemxPedido->userIDAllow("add")) { // Non system admin ?>
<span id="el_ItemxPedido_ID_Restaurant">
<span<?php echo $ItemxPedido_add->ID_Restaurant->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ItemxPedido_add->ID_Restaurant->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="ItemxPedido" data-field="x_ID_Restaurant" name="x_ID_Restaurant" id="x_ID_Restaurant" value="<?php echo HtmlEncode($ItemxPedido_add->ID_Restaurant->CurrentValue) ?>">
<?php } else { ?>
<span id="el_ItemxPedido_ID_Restaurant">
<input type="text" data-table="ItemxPedido" data-field="x_ID_Restaurant" name="x_ID_Restaurant" id="x_ID_Restaurant" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($ItemxPedido_add->ID_Restaurant->getPlaceHolder()) ?>" value="<?php echo $ItemxPedido_add->ID_Restaurant->EditValue ?>"<?php echo $ItemxPedido_add->ID_Restaurant->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $ItemxPedido_add->ID_Restaurant->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ItemxPedido_add->ID_Client->Visible) { // ID_Client ?>
	<div id="r_ID_Client" class="form-group row">
		<label id="elh_ItemxPedido_ID_Client" for="x_ID_Client" class="<?php echo $ItemxPedido_add->LeftColumnClass ?>"><?php echo $ItemxPedido_add->ID_Client->caption() ?><?php echo $ItemxPedido_add->ID_Client->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ItemxPedido_add->RightColumnClass ?>"><div <?php echo $ItemxPedido_add->ID_Client->cellAttributes() ?>>
<span id="el_ItemxPedido_ID_Client">
<input type="text" data-table="ItemxPedido" data-field="x_ID_Client" name="x_ID_Client" id="x_ID_Client" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($ItemxPedido_add->ID_Client->getPlaceHolder()) ?>" value="<?php echo $ItemxPedido_add->ID_Client->EditValue ?>"<?php echo $ItemxPedido_add->ID_Client->editAttributes() ?>>
</span>
<?php echo $ItemxPedido_add->ID_Client->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ItemxPedido_add->DateCreation->Visible) { // DateCreation ?>
	<div id="r_DateCreation" class="form-group row">
		<label id="elh_ItemxPedido_DateCreation" for="x_DateCreation" class="<?php echo $ItemxPedido_add->LeftColumnClass ?>"><?php echo $ItemxPedido_add->DateCreation->caption() ?><?php echo $ItemxPedido_add->DateCreation->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ItemxPedido_add->RightColumnClass ?>"><div <?php echo $ItemxPedido_add->DateCreation->cellAttributes() ?>>
<span id="el_ItemxPedido_DateCreation">
<input type="text" data-table="ItemxPedido" data-field="x_DateCreation" name="x_DateCreation" id="x_DateCreation" maxlength="8" placeholder="<?php echo HtmlEncode($ItemxPedido_add->DateCreation->getPlaceHolder()) ?>" value="<?php echo $ItemxPedido_add->DateCreation->EditValue ?>"<?php echo $ItemxPedido_add->DateCreation->editAttributes() ?>>
<?php if (!$ItemxPedido_add->DateCreation->ReadOnly && !$ItemxPedido_add->DateCreation->Disabled && !isset($ItemxPedido_add->DateCreation->EditAttrs["readonly"]) && !isset($ItemxPedido_add->DateCreation->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fItemxPedidoadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fItemxPedidoadd", "x_DateCreation", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $ItemxPedido_add->DateCreation->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ItemxPedido_add->DateLastUpdate->Visible) { // DateLastUpdate ?>
	<div id="r_DateLastUpdate" class="form-group row">
		<label id="elh_ItemxPedido_DateLastUpdate" for="x_DateLastUpdate" class="<?php echo $ItemxPedido_add->LeftColumnClass ?>"><?php echo $ItemxPedido_add->DateLastUpdate->caption() ?><?php echo $ItemxPedido_add->DateLastUpdate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ItemxPedido_add->RightColumnClass ?>"><div <?php echo $ItemxPedido_add->DateLastUpdate->cellAttributes() ?>>
<span id="el_ItemxPedido_DateLastUpdate">
<input type="text" data-table="ItemxPedido" data-field="x_DateLastUpdate" name="x_DateLastUpdate" id="x_DateLastUpdate" maxlength="8" placeholder="<?php echo HtmlEncode($ItemxPedido_add->DateLastUpdate->getPlaceHolder()) ?>" value="<?php echo $ItemxPedido_add->DateLastUpdate->EditValue ?>"<?php echo $ItemxPedido_add->DateLastUpdate->editAttributes() ?>>
<?php if (!$ItemxPedido_add->DateLastUpdate->ReadOnly && !$ItemxPedido_add->DateLastUpdate->Disabled && !isset($ItemxPedido_add->DateLastUpdate->EditAttrs["readonly"]) && !isset($ItemxPedido_add->DateLastUpdate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fItemxPedidoadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fItemxPedidoadd", "x_DateLastUpdate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $ItemxPedido_add->DateLastUpdate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ItemxPedido_add->Comments->Visible) { // Comments ?>
	<div id="r_Comments" class="form-group row">
		<label id="elh_ItemxPedido_Comments" for="x_Comments" class="<?php echo $ItemxPedido_add->LeftColumnClass ?>"><?php echo $ItemxPedido_add->Comments->caption() ?><?php echo $ItemxPedido_add->Comments->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ItemxPedido_add->RightColumnClass ?>"><div <?php echo $ItemxPedido_add->Comments->cellAttributes() ?>>
<span id="el_ItemxPedido_Comments">
<input type="text" data-table="ItemxPedido" data-field="x_Comments" name="x_Comments" id="x_Comments" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($ItemxPedido_add->Comments->getPlaceHolder()) ?>" value="<?php echo $ItemxPedido_add->Comments->EditValue ?>"<?php echo $ItemxPedido_add->Comments->editAttributes() ?>>
</span>
<?php echo $ItemxPedido_add->Comments->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$ItemxPedido_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $ItemxPedido_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ItemxPedido_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$ItemxPedido_add->showPageFooter();
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
$ItemxPedido_add->terminate();
?>