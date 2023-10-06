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
$Client_edit = new Client_edit();

// Run the page
$Client_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Client_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fClientedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fClientedit = currentForm = new ew.Form("fClientedit", "edit");

	// Validate form
	fClientedit.validate = function() {
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
			<?php if ($Client_edit->ID->Required) { ?>
				elm = this.getElements("x" + infix + "_ID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Client_edit->ID->caption(), $Client_edit->ID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Client_edit->ID_Restaurant->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_Restaurant");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Client_edit->ID_Restaurant->caption(), $Client_edit->ID_Restaurant->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Client_edit->Hash->Required) { ?>
				elm = this.getElements("x" + infix + "_Hash");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Client_edit->Hash->caption(), $Client_edit->Hash->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Client_edit->FirstName->Required) { ?>
				elm = this.getElements("x" + infix + "_FirstName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Client_edit->FirstName->caption(), $Client_edit->FirstName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Client_edit->LastName->Required) { ?>
				elm = this.getElements("x" + infix + "_LastName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Client_edit->LastName->caption(), $Client_edit->LastName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Client_edit->_Email->Required) { ?>
				elm = this.getElements("x" + infix + "__Email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Client_edit->_Email->caption(), $Client_edit->_Email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Client_edit->Phone->Required) { ?>
				elm = this.getElements("x" + infix + "_Phone");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Client_edit->Phone->caption(), $Client_edit->Phone->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Client_edit->Banned->Required) { ?>
				elm = this.getElements("x" + infix + "_Banned");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Client_edit->Banned->caption(), $Client_edit->Banned->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Client_edit->Comments->Required) { ?>
				elm = this.getElements("x" + infix + "_Comments");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Client_edit->Comments->caption(), $Client_edit->Comments->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Client_edit->ClientToken->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientToken");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Client_edit->ClientToken->caption(), $Client_edit->ClientToken->RequiredErrorMessage)) ?>");
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
	fClientedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fClientedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fClientedit.lists["x_ID_Restaurant"] = <?php echo $Client_edit->ID_Restaurant->Lookup->toClientList($Client_edit) ?>;
	fClientedit.lists["x_ID_Restaurant"].options = <?php echo JsonEncode($Client_edit->ID_Restaurant->lookupOptions()) ?>;
	fClientedit.lists["x_Banned"] = <?php echo $Client_edit->Banned->Lookup->toClientList($Client_edit) ?>;
	fClientedit.lists["x_Banned"].options = <?php echo JsonEncode($Client_edit->Banned->options(FALSE, TRUE)) ?>;
	loadjs.done("fClientedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $Client_edit->showPageHeader(); ?>
<?php
$Client_edit->showMessage();
?>
<form name="fClientedit" id="fClientedit" class="<?php echo $Client_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Client">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$Client_edit->IsModal ?>">
<?php if ($Client->getCurrentMasterTable() == "Restaurant") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="Restaurant">
<input type="hidden" name="fk_ID" value="<?php echo HtmlEncode($Client_edit->ID_Restaurant->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($Client_edit->ID->Visible) { // ID ?>
	<div id="r_ID" class="form-group row">
		<label id="elh_Client_ID" class="<?php echo $Client_edit->LeftColumnClass ?>"><?php echo $Client_edit->ID->caption() ?><?php echo $Client_edit->ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Client_edit->RightColumnClass ?>"><div <?php echo $Client_edit->ID->cellAttributes() ?>>
<span id="el_Client_ID">
<span<?php echo $Client_edit->ID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Client_edit->ID->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="Client" data-field="x_ID" name="x_ID" id="x_ID" value="<?php echo HtmlEncode($Client_edit->ID->CurrentValue) ?>">
<?php echo $Client_edit->ID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Client_edit->ID_Restaurant->Visible) { // ID_Restaurant ?>
	<div id="r_ID_Restaurant" class="form-group row">
		<label id="elh_Client_ID_Restaurant" for="x_ID_Restaurant" class="<?php echo $Client_edit->LeftColumnClass ?>"><?php echo $Client_edit->ID_Restaurant->caption() ?><?php echo $Client_edit->ID_Restaurant->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Client_edit->RightColumnClass ?>"><div <?php echo $Client_edit->ID_Restaurant->cellAttributes() ?>>
<?php if ($Client_edit->ID_Restaurant->getSessionValue() != "") { ?>
<span id="el_Client_ID_Restaurant">
<span<?php echo $Client_edit->ID_Restaurant->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Client_edit->ID_Restaurant->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_ID_Restaurant" name="x_ID_Restaurant" value="<?php echo HtmlEncode($Client_edit->ID_Restaurant->CurrentValue) ?>">
<?php } elseif (!$Security->isAdmin() && $Security->isLoggedIn() && !$Client->userIDAllow("edit")) { // Non system admin ?>
<span id="el_Client_ID_Restaurant">
<span<?php echo $Client_edit->ID_Restaurant->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Client_edit->ID_Restaurant->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="Client" data-field="x_ID_Restaurant" name="x_ID_Restaurant" id="x_ID_Restaurant" value="<?php echo HtmlEncode($Client_edit->ID_Restaurant->CurrentValue) ?>">
<?php } else { ?>
<span id="el_Client_ID_Restaurant">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Client" data-field="x_ID_Restaurant" data-value-separator="<?php echo $Client_edit->ID_Restaurant->displayValueSeparatorAttribute() ?>" id="x_ID_Restaurant" name="x_ID_Restaurant"<?php echo $Client_edit->ID_Restaurant->editAttributes() ?>>
			<?php echo $Client_edit->ID_Restaurant->selectOptionListHtml("x_ID_Restaurant") ?>
		</select>
</div>
<?php echo $Client_edit->ID_Restaurant->Lookup->getParamTag($Client_edit, "p_x_ID_Restaurant") ?>
</span>
<?php } ?>
<?php echo $Client_edit->ID_Restaurant->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Client_edit->Hash->Visible) { // Hash ?>
	<div id="r_Hash" class="form-group row">
		<label id="elh_Client_Hash" for="x_Hash" class="<?php echo $Client_edit->LeftColumnClass ?>"><?php echo $Client_edit->Hash->caption() ?><?php echo $Client_edit->Hash->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Client_edit->RightColumnClass ?>"><div <?php echo $Client_edit->Hash->cellAttributes() ?>>
<span id="el_Client_Hash">
<input type="text" data-table="Client" data-field="x_Hash" name="x_Hash" id="x_Hash" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Client_edit->Hash->getPlaceHolder()) ?>" value="<?php echo $Client_edit->Hash->EditValue ?>"<?php echo $Client_edit->Hash->editAttributes() ?>>
</span>
<?php echo $Client_edit->Hash->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Client_edit->FirstName->Visible) { // FirstName ?>
	<div id="r_FirstName" class="form-group row">
		<label id="elh_Client_FirstName" for="x_FirstName" class="<?php echo $Client_edit->LeftColumnClass ?>"><?php echo $Client_edit->FirstName->caption() ?><?php echo $Client_edit->FirstName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Client_edit->RightColumnClass ?>"><div <?php echo $Client_edit->FirstName->cellAttributes() ?>>
<span id="el_Client_FirstName">
<input type="text" data-table="Client" data-field="x_FirstName" name="x_FirstName" id="x_FirstName" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Client_edit->FirstName->getPlaceHolder()) ?>" value="<?php echo $Client_edit->FirstName->EditValue ?>"<?php echo $Client_edit->FirstName->editAttributes() ?>>
</span>
<?php echo $Client_edit->FirstName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Client_edit->LastName->Visible) { // LastName ?>
	<div id="r_LastName" class="form-group row">
		<label id="elh_Client_LastName" for="x_LastName" class="<?php echo $Client_edit->LeftColumnClass ?>"><?php echo $Client_edit->LastName->caption() ?><?php echo $Client_edit->LastName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Client_edit->RightColumnClass ?>"><div <?php echo $Client_edit->LastName->cellAttributes() ?>>
<span id="el_Client_LastName">
<input type="text" data-table="Client" data-field="x_LastName" name="x_LastName" id="x_LastName" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Client_edit->LastName->getPlaceHolder()) ?>" value="<?php echo $Client_edit->LastName->EditValue ?>"<?php echo $Client_edit->LastName->editAttributes() ?>>
</span>
<?php echo $Client_edit->LastName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Client_edit->_Email->Visible) { // Email ?>
	<div id="r__Email" class="form-group row">
		<label id="elh_Client__Email" for="x__Email" class="<?php echo $Client_edit->LeftColumnClass ?>"><?php echo $Client_edit->_Email->caption() ?><?php echo $Client_edit->_Email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Client_edit->RightColumnClass ?>"><div <?php echo $Client_edit->_Email->cellAttributes() ?>>
<span id="el_Client__Email">
<input type="text" data-table="Client" data-field="x__Email" name="x__Email" id="x__Email" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Client_edit->_Email->getPlaceHolder()) ?>" value="<?php echo $Client_edit->_Email->EditValue ?>"<?php echo $Client_edit->_Email->editAttributes() ?>>
</span>
<?php echo $Client_edit->_Email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Client_edit->Phone->Visible) { // Phone ?>
	<div id="r_Phone" class="form-group row">
		<label id="elh_Client_Phone" for="x_Phone" class="<?php echo $Client_edit->LeftColumnClass ?>"><?php echo $Client_edit->Phone->caption() ?><?php echo $Client_edit->Phone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Client_edit->RightColumnClass ?>"><div <?php echo $Client_edit->Phone->cellAttributes() ?>>
<span id="el_Client_Phone">
<input type="text" data-table="Client" data-field="x_Phone" name="x_Phone" id="x_Phone" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Client_edit->Phone->getPlaceHolder()) ?>" value="<?php echo $Client_edit->Phone->EditValue ?>"<?php echo $Client_edit->Phone->editAttributes() ?>>
</span>
<?php echo $Client_edit->Phone->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Client_edit->Banned->Visible) { // Banned ?>
	<div id="r_Banned" class="form-group row">
		<label id="elh_Client_Banned" class="<?php echo $Client_edit->LeftColumnClass ?>"><?php echo $Client_edit->Banned->caption() ?><?php echo $Client_edit->Banned->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Client_edit->RightColumnClass ?>"><div <?php echo $Client_edit->Banned->cellAttributes() ?>>
<span id="el_Client_Banned">
<div id="tp_x_Banned" class="ew-template"><input type="radio" class="custom-control-input" data-table="Client" data-field="x_Banned" data-value-separator="<?php echo $Client_edit->Banned->displayValueSeparatorAttribute() ?>" name="x_Banned" id="x_Banned" value="{value}"<?php echo $Client_edit->Banned->editAttributes() ?>></div>
<div id="dsl_x_Banned" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $Client_edit->Banned->radioButtonListHtml(FALSE, "x_Banned") ?>
</div></div>
</span>
<?php echo $Client_edit->Banned->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Client_edit->Comments->Visible) { // Comments ?>
	<div id="r_Comments" class="form-group row">
		<label id="elh_Client_Comments" for="x_Comments" class="<?php echo $Client_edit->LeftColumnClass ?>"><?php echo $Client_edit->Comments->caption() ?><?php echo $Client_edit->Comments->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Client_edit->RightColumnClass ?>"><div <?php echo $Client_edit->Comments->cellAttributes() ?>>
<span id="el_Client_Comments">
<textarea data-table="Client" data-field="x_Comments" name="x_Comments" id="x_Comments" cols="35" rows="4" placeholder="<?php echo HtmlEncode($Client_edit->Comments->getPlaceHolder()) ?>"<?php echo $Client_edit->Comments->editAttributes() ?>><?php echo $Client_edit->Comments->EditValue ?></textarea>
</span>
<?php echo $Client_edit->Comments->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Client_edit->ClientToken->Visible) { // ClientToken ?>
	<div id="r_ClientToken" class="form-group row">
		<label id="elh_Client_ClientToken" for="x_ClientToken" class="<?php echo $Client_edit->LeftColumnClass ?>"><?php echo $Client_edit->ClientToken->caption() ?><?php echo $Client_edit->ClientToken->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Client_edit->RightColumnClass ?>"><div <?php echo $Client_edit->ClientToken->cellAttributes() ?>>
<span id="el_Client_ClientToken">
<input type="text" data-table="Client" data-field="x_ClientToken" name="x_ClientToken" id="x_ClientToken" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Client_edit->ClientToken->getPlaceHolder()) ?>" value="<?php echo $Client_edit->ClientToken->EditValue ?>"<?php echo $Client_edit->ClientToken->editAttributes() ?>>
</span>
<?php echo $Client_edit->ClientToken->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("Pedido", explode(",", $Client->getCurrentDetailTable())) && $Pedido->DetailEdit) {
?>
<?php if ($Client->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("Pedido", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "Pedidogrid.php" ?>
<?php } ?>
<?php
	if (in_array("Checkin", explode(",", $Client->getCurrentDetailTable())) && $Checkin->DetailEdit) {
?>
<?php if ($Client->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("Checkin", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "Checkingrid.php" ?>
<?php } ?>
<?php if (!$Client_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $Client_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $Client_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$Client_edit->showPageFooter();
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
$Client_edit->terminate();
?>