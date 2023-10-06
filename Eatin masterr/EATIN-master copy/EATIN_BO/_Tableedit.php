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
$_Table_edit = new _Table_edit();

// Run the page
$_Table_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$_Table_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var f_Tableedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	f_Tableedit = currentForm = new ew.Form("f_Tableedit", "edit");

	// Validate form
	f_Tableedit.validate = function() {
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
			<?php if ($_Table_edit->ID->Required) { ?>
				elm = this.getElements("x" + infix + "_ID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_Table_edit->ID->caption(), $_Table_edit->ID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($_Table_edit->ID_Restaurant->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_Restaurant");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_Table_edit->ID_Restaurant->caption(), $_Table_edit->ID_Restaurant->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($_Table_edit->QRCode->Required) { ?>
				elm = this.getElements("x" + infix + "_QRCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_Table_edit->QRCode->caption(), $_Table_edit->QRCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($_Table_edit->Numero->Required) { ?>
				elm = this.getElements("x" + infix + "_Numero");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_Table_edit->Numero->caption(), $_Table_edit->Numero->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Numero");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($_Table_edit->Numero->errorMessage()) ?>");

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
	f_Tableedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	f_Tableedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	f_Tableedit.lists["x_ID_Restaurant"] = <?php echo $_Table_edit->ID_Restaurant->Lookup->toClientList($_Table_edit) ?>;
	f_Tableedit.lists["x_ID_Restaurant"].options = <?php echo JsonEncode($_Table_edit->ID_Restaurant->lookupOptions()) ?>;
	loadjs.done("f_Tableedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $_Table_edit->showPageHeader(); ?>
<?php
$_Table_edit->showMessage();
?>
<form name="f_Tableedit" id="f_Tableedit" class="<?php echo $_Table_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="_Table">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$_Table_edit->IsModal ?>">
<?php if ($_Table->getCurrentMasterTable() == "Restaurant") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="Restaurant">
<input type="hidden" name="fk_ID" value="<?php echo HtmlEncode($_Table_edit->ID_Restaurant->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($_Table_edit->ID->Visible) { // ID ?>
	<div id="r_ID" class="form-group row">
		<label id="elh__Table_ID" class="<?php echo $_Table_edit->LeftColumnClass ?>"><?php echo $_Table_edit->ID->caption() ?><?php echo $_Table_edit->ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $_Table_edit->RightColumnClass ?>"><div <?php echo $_Table_edit->ID->cellAttributes() ?>>
<span id="el__Table_ID">
<span<?php echo $_Table_edit->ID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_Table_edit->ID->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="_Table" data-field="x_ID" name="x_ID" id="x_ID" value="<?php echo HtmlEncode($_Table_edit->ID->CurrentValue) ?>">
<?php echo $_Table_edit->ID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($_Table_edit->ID_Restaurant->Visible) { // ID_Restaurant ?>
	<div id="r_ID_Restaurant" class="form-group row">
		<label id="elh__Table_ID_Restaurant" for="x_ID_Restaurant" class="<?php echo $_Table_edit->LeftColumnClass ?>"><?php echo $_Table_edit->ID_Restaurant->caption() ?><?php echo $_Table_edit->ID_Restaurant->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $_Table_edit->RightColumnClass ?>"><div <?php echo $_Table_edit->ID_Restaurant->cellAttributes() ?>>
<?php if ($_Table_edit->ID_Restaurant->getSessionValue() != "") { ?>
<span id="el__Table_ID_Restaurant">
<span<?php echo $_Table_edit->ID_Restaurant->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_Table_edit->ID_Restaurant->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_ID_Restaurant" name="x_ID_Restaurant" value="<?php echo HtmlEncode($_Table_edit->ID_Restaurant->CurrentValue) ?>">
<?php } elseif (!$Security->isAdmin() && $Security->isLoggedIn() && !$_Table->userIDAllow("edit")) { // Non system admin ?>
<span id="el__Table_ID_Restaurant">
<span<?php echo $_Table_edit->ID_Restaurant->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_Table_edit->ID_Restaurant->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="_Table" data-field="x_ID_Restaurant" name="x_ID_Restaurant" id="x_ID_Restaurant" value="<?php echo HtmlEncode($_Table_edit->ID_Restaurant->CurrentValue) ?>">
<?php } else { ?>
<span id="el__Table_ID_Restaurant">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="_Table" data-field="x_ID_Restaurant" data-value-separator="<?php echo $_Table_edit->ID_Restaurant->displayValueSeparatorAttribute() ?>" id="x_ID_Restaurant" name="x_ID_Restaurant"<?php echo $_Table_edit->ID_Restaurant->editAttributes() ?>>
			<?php echo $_Table_edit->ID_Restaurant->selectOptionListHtml("x_ID_Restaurant") ?>
		</select>
</div>
<?php echo $_Table_edit->ID_Restaurant->Lookup->getParamTag($_Table_edit, "p_x_ID_Restaurant") ?>
</span>
<?php } ?>
<?php echo $_Table_edit->ID_Restaurant->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($_Table_edit->QRCode->Visible) { // QRCode ?>
	<div id="r_QRCode" class="form-group row">
		<label id="elh__Table_QRCode" for="x_QRCode" class="<?php echo $_Table_edit->LeftColumnClass ?>"><?php echo $_Table_edit->QRCode->caption() ?><?php echo $_Table_edit->QRCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $_Table_edit->RightColumnClass ?>"><div <?php echo $_Table_edit->QRCode->cellAttributes() ?>>
<span id="el__Table_QRCode">
<span<?php echo $_Table_edit->QRCode->viewAttributes() ?>><?php if (!EmptyString($_Table_edit->QRCode->EditValue) && $_Table_edit->QRCode->linkAttributes() != "") { ?>
<a<?php echo $_Table_edit->QRCode->linkAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_Table_edit->QRCode->EditValue)) ?>"></a>
<?php } else { ?>
<input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_Table_edit->QRCode->EditValue)) ?>">
<?php } ?></span>
</span>
<input type="hidden" data-table="_Table" data-field="x_QRCode" name="x_QRCode" id="x_QRCode" value="<?php echo HtmlEncode($_Table_edit->QRCode->CurrentValue) ?>">
<?php echo $_Table_edit->QRCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($_Table_edit->Numero->Visible) { // Numero ?>
	<div id="r_Numero" class="form-group row">
		<label id="elh__Table_Numero" for="x_Numero" class="<?php echo $_Table_edit->LeftColumnClass ?>"><?php echo $_Table_edit->Numero->caption() ?><?php echo $_Table_edit->Numero->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $_Table_edit->RightColumnClass ?>"><div <?php echo $_Table_edit->Numero->cellAttributes() ?>>
<span id="el__Table_Numero">
<input type="text" data-table="_Table" data-field="x_Numero" name="x_Numero" id="x_Numero" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($_Table_edit->Numero->getPlaceHolder()) ?>" value="<?php echo $_Table_edit->Numero->EditValue ?>"<?php echo $_Table_edit->Numero->editAttributes() ?>>
</span>
<?php echo $_Table_edit->Numero->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$_Table_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $_Table_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $_Table_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$_Table_edit->showPageFooter();
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
$_Table_edit->terminate();
?>