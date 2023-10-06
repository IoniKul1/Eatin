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
$Pedido_edit = new Pedido_edit();

// Run the page
$Pedido_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Pedido_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fPedidoedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fPedidoedit = currentForm = new ew.Form("fPedidoedit", "edit");

	// Validate form
	fPedidoedit.validate = function() {
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
			<?php if ($Pedido_edit->ID_Table->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_Table");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Pedido_edit->ID_Table->caption(), $Pedido_edit->ID_Table->RequiredErrorMessage)) ?>");
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
	fPedidoedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fPedidoedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fPedidoedit.lists["x_ID_Table"] = <?php echo $Pedido_edit->ID_Table->Lookup->toClientList($Pedido_edit) ?>;
	fPedidoedit.lists["x_ID_Table"].options = <?php echo JsonEncode($Pedido_edit->ID_Table->lookupOptions()) ?>;
	loadjs.done("fPedidoedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $Pedido_edit->showPageHeader(); ?>
<?php
$Pedido_edit->showMessage();
?>
<form name="fPedidoedit" id="fPedidoedit" class="<?php echo $Pedido_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Pedido">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$Pedido_edit->IsModal ?>">
<?php if ($Pedido->getCurrentMasterTable() == "Client") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="Client">
<input type="hidden" name="fk_ID" value="<?php echo HtmlEncode($Pedido_edit->ID_Client->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($Pedido_edit->ID_Table->Visible) { // ID_Table ?>
	<div id="r_ID_Table" class="form-group row">
		<label id="elh_Pedido_ID_Table" for="x_ID_Table" class="<?php echo $Pedido_edit->LeftColumnClass ?>"><?php echo $Pedido_edit->ID_Table->caption() ?><?php echo $Pedido_edit->ID_Table->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Pedido_edit->RightColumnClass ?>"><div <?php echo $Pedido_edit->ID_Table->cellAttributes() ?>>
<span id="el_Pedido_ID_Table">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Pedido" data-field="x_ID_Table" data-value-separator="<?php echo $Pedido_edit->ID_Table->displayValueSeparatorAttribute() ?>" id="x_ID_Table" name="x_ID_Table"<?php echo $Pedido_edit->ID_Table->editAttributes() ?>>
			<?php echo $Pedido_edit->ID_Table->selectOptionListHtml("x_ID_Table") ?>
		</select>
</div>
<?php echo $Pedido_edit->ID_Table->Lookup->getParamTag($Pedido_edit, "p_x_ID_Table") ?>
</span>
<?php echo $Pedido_edit->ID_Table->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="Pedido" data-field="x_ID" name="x_ID" id="x_ID" value="<?php echo HtmlEncode($Pedido_edit->ID->CurrentValue) ?>">
<?php
	if (in_array("ItemxPedido", explode(",", $Pedido->getCurrentDetailTable())) && $ItemxPedido->DetailEdit) {
?>
<?php if ($Pedido->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("ItemxPedido", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "ItemxPedidogrid.php" ?>
<?php } ?>
<?php if (!$Pedido_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $Pedido_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $Pedido_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$Pedido_edit->showPageFooter();
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
$Pedido_edit->terminate();
?>