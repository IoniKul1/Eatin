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
$_Table_add = new _Table_add();

// Run the page
$_Table_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$_Table_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var f_Tableadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	f_Tableadd = currentForm = new ew.Form("f_Tableadd", "add");

	// Validate form
	f_Tableadd.validate = function() {
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
			<?php if ($_Table_add->ID_Restaurant->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_Restaurant");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_Table_add->ID_Restaurant->caption(), $_Table_add->ID_Restaurant->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($_Table_add->Numero->Required) { ?>
				elm = this.getElements("x" + infix + "_Numero");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_Table_add->Numero->caption(), $_Table_add->Numero->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Numero");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($_Table_add->Numero->errorMessage()) ?>");

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
	f_Tableadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	f_Tableadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	f_Tableadd.lists["x_ID_Restaurant"] = <?php echo $_Table_add->ID_Restaurant->Lookup->toClientList($_Table_add) ?>;
	f_Tableadd.lists["x_ID_Restaurant"].options = <?php echo JsonEncode($_Table_add->ID_Restaurant->lookupOptions()) ?>;
	loadjs.done("f_Tableadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $_Table_add->showPageHeader(); ?>
<?php
$_Table_add->showMessage();
?>
<form name="f_Tableadd" id="f_Tableadd" class="<?php echo $_Table_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="_Table">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$_Table_add->IsModal ?>">
<?php if ($_Table->getCurrentMasterTable() == "Restaurant") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="Restaurant">
<input type="hidden" name="fk_ID" value="<?php echo HtmlEncode($_Table_add->ID_Restaurant->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($_Table_add->ID_Restaurant->Visible) { // ID_Restaurant ?>
	<div id="r_ID_Restaurant" class="form-group row">
		<label id="elh__Table_ID_Restaurant" for="x_ID_Restaurant" class="<?php echo $_Table_add->LeftColumnClass ?>"><?php echo $_Table_add->ID_Restaurant->caption() ?><?php echo $_Table_add->ID_Restaurant->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $_Table_add->RightColumnClass ?>"><div <?php echo $_Table_add->ID_Restaurant->cellAttributes() ?>>
<?php if ($_Table_add->ID_Restaurant->getSessionValue() != "") { ?>
<span id="el__Table_ID_Restaurant">
<span<?php echo $_Table_add->ID_Restaurant->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_Table_add->ID_Restaurant->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_ID_Restaurant" name="x_ID_Restaurant" value="<?php echo HtmlEncode($_Table_add->ID_Restaurant->CurrentValue) ?>">
<?php } elseif (!$Security->isAdmin() && $Security->isLoggedIn() && !$_Table->userIDAllow("add")) { // Non system admin ?>
<span id="el__Table_ID_Restaurant">
<span<?php echo $_Table_add->ID_Restaurant->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_Table_add->ID_Restaurant->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="_Table" data-field="x_ID_Restaurant" name="x_ID_Restaurant" id="x_ID_Restaurant" value="<?php echo HtmlEncode($_Table_add->ID_Restaurant->CurrentValue) ?>">
<?php } else { ?>
<span id="el__Table_ID_Restaurant">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="_Table" data-field="x_ID_Restaurant" data-value-separator="<?php echo $_Table_add->ID_Restaurant->displayValueSeparatorAttribute() ?>" id="x_ID_Restaurant" name="x_ID_Restaurant"<?php echo $_Table_add->ID_Restaurant->editAttributes() ?>>
			<?php echo $_Table_add->ID_Restaurant->selectOptionListHtml("x_ID_Restaurant") ?>
		</select>
</div>
<?php echo $_Table_add->ID_Restaurant->Lookup->getParamTag($_Table_add, "p_x_ID_Restaurant") ?>
</span>
<?php } ?>
<?php echo $_Table_add->ID_Restaurant->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($_Table_add->Numero->Visible) { // Numero ?>
	<div id="r_Numero" class="form-group row">
		<label id="elh__Table_Numero" for="x_Numero" class="<?php echo $_Table_add->LeftColumnClass ?>"><?php echo $_Table_add->Numero->caption() ?><?php echo $_Table_add->Numero->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $_Table_add->RightColumnClass ?>"><div <?php echo $_Table_add->Numero->cellAttributes() ?>>
<span id="el__Table_Numero">
<input type="text" data-table="_Table" data-field="x_Numero" name="x_Numero" id="x_Numero" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($_Table_add->Numero->getPlaceHolder()) ?>" value="<?php echo $_Table_add->Numero->EditValue ?>"<?php echo $_Table_add->Numero->editAttributes() ?>>
</span>
<?php echo $_Table_add->Numero->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$_Table_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $_Table_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $_Table_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$_Table_add->showPageFooter();
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
$_Table_add->terminate();
?>