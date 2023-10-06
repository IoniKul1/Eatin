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
$Pedido_add = new Pedido_add();

// Run the page
$Pedido_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Pedido_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fPedidoadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fPedidoadd = currentForm = new ew.Form("fPedidoadd", "add");

	// Validate form
	fPedidoadd.validate = function() {
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
			<?php if ($Pedido_add->ID_Client->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_Client");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Pedido_add->ID_Client->caption(), $Pedido_add->ID_Client->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ID_Client");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Pedido_add->ID_Client->errorMessage()) ?>");
			<?php if ($Pedido_add->ID_Status->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_Status");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Pedido_add->ID_Status->caption(), $Pedido_add->ID_Status->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ID_Status");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Pedido_add->ID_Status->errorMessage()) ?>");
			<?php if ($Pedido_add->ID_Restaurant->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_Restaurant");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Pedido_add->ID_Restaurant->caption(), $Pedido_add->ID_Restaurant->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ID_Restaurant");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Pedido_add->ID_Restaurant->errorMessage()) ?>");
			<?php if ($Pedido_add->DateCreation->Required) { ?>
				elm = this.getElements("x" + infix + "_DateCreation");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Pedido_add->DateCreation->caption(), $Pedido_add->DateCreation->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateCreation");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Pedido_add->DateCreation->errorMessage()) ?>");
			<?php if ($Pedido_add->DateLastUpdate->Required) { ?>
				elm = this.getElements("x" + infix + "_DateLastUpdate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Pedido_add->DateLastUpdate->caption(), $Pedido_add->DateLastUpdate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateLastUpdate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Pedido_add->DateLastUpdate->errorMessage()) ?>");
			<?php if ($Pedido_add->ID_Table->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_Table");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Pedido_add->ID_Table->caption(), $Pedido_add->ID_Table->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ID_Table");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Pedido_add->ID_Table->errorMessage()) ?>");

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
	fPedidoadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fPedidoadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fPedidoadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $Pedido_add->showPageHeader(); ?>
<?php
$Pedido_add->showMessage();
?>
<form name="fPedidoadd" id="fPedidoadd" class="<?php echo $Pedido_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Pedido">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$Pedido_add->IsModal ?>">
<?php if ($Pedido->getCurrentMasterTable() == "Client") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="Client">
<input type="hidden" name="fk_ID" value="<?php echo HtmlEncode($Pedido_add->ID_Client->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($Pedido_add->ID_Client->Visible) { // ID_Client ?>
	<div id="r_ID_Client" class="form-group row">
		<label id="elh_Pedido_ID_Client" for="x_ID_Client" class="<?php echo $Pedido_add->LeftColumnClass ?>"><?php echo $Pedido_add->ID_Client->caption() ?><?php echo $Pedido_add->ID_Client->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Pedido_add->RightColumnClass ?>"><div <?php echo $Pedido_add->ID_Client->cellAttributes() ?>>
<?php if ($Pedido_add->ID_Client->getSessionValue() != "") { ?>
<span id="el_Pedido_ID_Client">
<span<?php echo $Pedido_add->ID_Client->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Pedido_add->ID_Client->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_ID_Client" name="x_ID_Client" value="<?php echo HtmlEncode($Pedido_add->ID_Client->CurrentValue) ?>">
<?php } else { ?>
<span id="el_Pedido_ID_Client">
<input type="text" data-table="Pedido" data-field="x_ID_Client" name="x_ID_Client" id="x_ID_Client" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Pedido_add->ID_Client->getPlaceHolder()) ?>" value="<?php echo $Pedido_add->ID_Client->EditValue ?>"<?php echo $Pedido_add->ID_Client->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $Pedido_add->ID_Client->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Pedido_add->ID_Status->Visible) { // ID_Status ?>
	<div id="r_ID_Status" class="form-group row">
		<label id="elh_Pedido_ID_Status" for="x_ID_Status" class="<?php echo $Pedido_add->LeftColumnClass ?>"><?php echo $Pedido_add->ID_Status->caption() ?><?php echo $Pedido_add->ID_Status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Pedido_add->RightColumnClass ?>"><div <?php echo $Pedido_add->ID_Status->cellAttributes() ?>>
<span id="el_Pedido_ID_Status">
<input type="text" data-table="Pedido" data-field="x_ID_Status" name="x_ID_Status" id="x_ID_Status" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Pedido_add->ID_Status->getPlaceHolder()) ?>" value="<?php echo $Pedido_add->ID_Status->EditValue ?>"<?php echo $Pedido_add->ID_Status->editAttributes() ?>>
</span>
<?php echo $Pedido_add->ID_Status->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Pedido_add->ID_Restaurant->Visible) { // ID_Restaurant ?>
	<div id="r_ID_Restaurant" class="form-group row">
		<label id="elh_Pedido_ID_Restaurant" for="x_ID_Restaurant" class="<?php echo $Pedido_add->LeftColumnClass ?>"><?php echo $Pedido_add->ID_Restaurant->caption() ?><?php echo $Pedido_add->ID_Restaurant->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Pedido_add->RightColumnClass ?>"><div <?php echo $Pedido_add->ID_Restaurant->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn() && !$Pedido->userIDAllow("add")) { // Non system admin ?>
<span id="el_Pedido_ID_Restaurant">
<span<?php echo $Pedido_add->ID_Restaurant->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Pedido_add->ID_Restaurant->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="Pedido" data-field="x_ID_Restaurant" name="x_ID_Restaurant" id="x_ID_Restaurant" value="<?php echo HtmlEncode($Pedido_add->ID_Restaurant->CurrentValue) ?>">
<?php } else { ?>
<span id="el_Pedido_ID_Restaurant">
<input type="text" data-table="Pedido" data-field="x_ID_Restaurant" name="x_ID_Restaurant" id="x_ID_Restaurant" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Pedido_add->ID_Restaurant->getPlaceHolder()) ?>" value="<?php echo $Pedido_add->ID_Restaurant->EditValue ?>"<?php echo $Pedido_add->ID_Restaurant->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $Pedido_add->ID_Restaurant->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Pedido_add->DateCreation->Visible) { // DateCreation ?>
	<div id="r_DateCreation" class="form-group row">
		<label id="elh_Pedido_DateCreation" for="x_DateCreation" class="<?php echo $Pedido_add->LeftColumnClass ?>"><?php echo $Pedido_add->DateCreation->caption() ?><?php echo $Pedido_add->DateCreation->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Pedido_add->RightColumnClass ?>"><div <?php echo $Pedido_add->DateCreation->cellAttributes() ?>>
<span id="el_Pedido_DateCreation">
<input type="text" data-table="Pedido" data-field="x_DateCreation" name="x_DateCreation" id="x_DateCreation" maxlength="8" placeholder="<?php echo HtmlEncode($Pedido_add->DateCreation->getPlaceHolder()) ?>" value="<?php echo $Pedido_add->DateCreation->EditValue ?>"<?php echo $Pedido_add->DateCreation->editAttributes() ?>>
<?php if (!$Pedido_add->DateCreation->ReadOnly && !$Pedido_add->DateCreation->Disabled && !isset($Pedido_add->DateCreation->EditAttrs["readonly"]) && !isset($Pedido_add->DateCreation->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fPedidoadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fPedidoadd", "x_DateCreation", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $Pedido_add->DateCreation->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Pedido_add->DateLastUpdate->Visible) { // DateLastUpdate ?>
	<div id="r_DateLastUpdate" class="form-group row">
		<label id="elh_Pedido_DateLastUpdate" for="x_DateLastUpdate" class="<?php echo $Pedido_add->LeftColumnClass ?>"><?php echo $Pedido_add->DateLastUpdate->caption() ?><?php echo $Pedido_add->DateLastUpdate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Pedido_add->RightColumnClass ?>"><div <?php echo $Pedido_add->DateLastUpdate->cellAttributes() ?>>
<span id="el_Pedido_DateLastUpdate">
<input type="text" data-table="Pedido" data-field="x_DateLastUpdate" name="x_DateLastUpdate" id="x_DateLastUpdate" maxlength="8" placeholder="<?php echo HtmlEncode($Pedido_add->DateLastUpdate->getPlaceHolder()) ?>" value="<?php echo $Pedido_add->DateLastUpdate->EditValue ?>"<?php echo $Pedido_add->DateLastUpdate->editAttributes() ?>>
<?php if (!$Pedido_add->DateLastUpdate->ReadOnly && !$Pedido_add->DateLastUpdate->Disabled && !isset($Pedido_add->DateLastUpdate->EditAttrs["readonly"]) && !isset($Pedido_add->DateLastUpdate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fPedidoadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fPedidoadd", "x_DateLastUpdate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $Pedido_add->DateLastUpdate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Pedido_add->ID_Table->Visible) { // ID_Table ?>
	<div id="r_ID_Table" class="form-group row">
		<label id="elh_Pedido_ID_Table" for="x_ID_Table" class="<?php echo $Pedido_add->LeftColumnClass ?>"><?php echo $Pedido_add->ID_Table->caption() ?><?php echo $Pedido_add->ID_Table->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Pedido_add->RightColumnClass ?>"><div <?php echo $Pedido_add->ID_Table->cellAttributes() ?>>
<span id="el_Pedido_ID_Table">
<input type="text" data-table="Pedido" data-field="x_ID_Table" name="x_ID_Table" id="x_ID_Table" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Pedido_add->ID_Table->getPlaceHolder()) ?>" value="<?php echo $Pedido_add->ID_Table->EditValue ?>"<?php echo $Pedido_add->ID_Table->editAttributes() ?>>
</span>
<?php echo $Pedido_add->ID_Table->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("ItemxPedido", explode(",", $Pedido->getCurrentDetailTable())) && $ItemxPedido->DetailAdd) {
?>
<?php if ($Pedido->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("ItemxPedido", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "ItemxPedidogrid.php" ?>
<?php } ?>
<?php if (!$Pedido_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $Pedido_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $Pedido_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$Pedido_add->showPageFooter();
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
$Pedido_add->terminate();
?>