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
$PedidoACadeteria_edit = new PedidoACadeteria_edit();

// Run the page
$PedidoACadeteria_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$PedidoACadeteria_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fPedidoACadeteriaedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fPedidoACadeteriaedit = currentForm = new ew.Form("fPedidoACadeteriaedit", "edit");

	// Validate form
	fPedidoACadeteriaedit.validate = function() {
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
			<?php if ($PedidoACadeteria_edit->ID->Required) { ?>
				elm = this.getElements("x" + infix + "_ID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PedidoACadeteria_edit->ID->caption(), $PedidoACadeteria_edit->ID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($PedidoACadeteria_edit->ID->errorMessage()) ?>");
			<?php if ($PedidoACadeteria_edit->ID_Usuario->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_Usuario");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PedidoACadeteria_edit->ID_Usuario->caption(), $PedidoACadeteria_edit->ID_Usuario->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ID_Usuario");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($PedidoACadeteria_edit->ID_Usuario->errorMessage()) ?>");
			<?php if ($PedidoACadeteria_edit->ID_Place1->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_Place1");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PedidoACadeteria_edit->ID_Place1->caption(), $PedidoACadeteria_edit->ID_Place1->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ID_Place1");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($PedidoACadeteria_edit->ID_Place1->errorMessage()) ?>");
			<?php if ($PedidoACadeteria_edit->ID_Place2->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_Place2");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PedidoACadeteria_edit->ID_Place2->caption(), $PedidoACadeteria_edit->ID_Place2->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ID_Place2");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($PedidoACadeteria_edit->ID_Place2->errorMessage()) ?>");
			<?php if ($PedidoACadeteria_edit->ID_Cadete->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_Cadete");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PedidoACadeteria_edit->ID_Cadete->caption(), $PedidoACadeteria_edit->ID_Cadete->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ID_Cadete");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($PedidoACadeteria_edit->ID_Cadete->errorMessage()) ?>");
			<?php if ($PedidoACadeteria_edit->ID_Status->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_Status");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PedidoACadeteria_edit->ID_Status->caption(), $PedidoACadeteria_edit->ID_Status->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ID_Status");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($PedidoACadeteria_edit->ID_Status->errorMessage()) ?>");
			<?php if ($PedidoACadeteria_edit->InstruccionesPlace1->Required) { ?>
				elm = this.getElements("x" + infix + "_InstruccionesPlace1");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PedidoACadeteria_edit->InstruccionesPlace1->caption(), $PedidoACadeteria_edit->InstruccionesPlace1->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($PedidoACadeteria_edit->InstruccionesPlace2->Required) { ?>
				elm = this.getElements("x" + infix + "_InstruccionesPlace2");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PedidoACadeteria_edit->InstruccionesPlace2->caption(), $PedidoACadeteria_edit->InstruccionesPlace2->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($PedidoACadeteria_edit->Direccionalidad->Required) { ?>
				elm = this.getElements("x" + infix + "_Direccionalidad");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PedidoACadeteria_edit->Direccionalidad->caption(), $PedidoACadeteria_edit->Direccionalidad->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Direccionalidad");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($PedidoACadeteria_edit->Direccionalidad->errorMessage()) ?>");
			<?php if ($PedidoACadeteria_edit->RemitoURL->Required) { ?>
				elm = this.getElements("x" + infix + "_RemitoURL");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PedidoACadeteria_edit->RemitoURL->caption(), $PedidoACadeteria_edit->RemitoURL->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($PedidoACadeteria_edit->Place1_Nombre->Required) { ?>
				elm = this.getElements("x" + infix + "_Place1_Nombre");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PedidoACadeteria_edit->Place1_Nombre->caption(), $PedidoACadeteria_edit->Place1_Nombre->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($PedidoACadeteria_edit->Place1_Country->Required) { ?>
				elm = this.getElements("x" + infix + "_Place1_Country");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PedidoACadeteria_edit->Place1_Country->caption(), $PedidoACadeteria_edit->Place1_Country->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($PedidoACadeteria_edit->Place1_UF->Required) { ?>
				elm = this.getElements("x" + infix + "_Place1_UF");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PedidoACadeteria_edit->Place1_UF->caption(), $PedidoACadeteria_edit->Place1_UF->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($PedidoACadeteria_edit->Plate1_Lat->Required) { ?>
				elm = this.getElements("x" + infix + "_Plate1_Lat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PedidoACadeteria_edit->Plate1_Lat->caption(), $PedidoACadeteria_edit->Plate1_Lat->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Plate1_Lat");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($PedidoACadeteria_edit->Plate1_Lat->errorMessage()) ?>");
			<?php if ($PedidoACadeteria_edit->Place1_Lon->Required) { ?>
				elm = this.getElements("x" + infix + "_Place1_Lon");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PedidoACadeteria_edit->Place1_Lon->caption(), $PedidoACadeteria_edit->Place1_Lon->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Place1_Lon");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($PedidoACadeteria_edit->Place1_Lon->errorMessage()) ?>");
			<?php if ($PedidoACadeteria_edit->Place1_Calle->Required) { ?>
				elm = this.getElements("x" + infix + "_Place1_Calle");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PedidoACadeteria_edit->Place1_Calle->caption(), $PedidoACadeteria_edit->Place1_Calle->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($PedidoACadeteria_edit->Place1_Numero->Required) { ?>
				elm = this.getElements("x" + infix + "_Place1_Numero");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PedidoACadeteria_edit->Place1_Numero->caption(), $PedidoACadeteria_edit->Place1_Numero->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($PedidoACadeteria_edit->Place1_Localidad->Required) { ?>
				elm = this.getElements("x" + infix + "_Place1_Localidad");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PedidoACadeteria_edit->Place1_Localidad->caption(), $PedidoACadeteria_edit->Place1_Localidad->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($PedidoACadeteria_edit->Place1_Piso->Required) { ?>
				elm = this.getElements("x" + infix + "_Place1_Piso");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PedidoACadeteria_edit->Place1_Piso->caption(), $PedidoACadeteria_edit->Place1_Piso->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($PedidoACadeteria_edit->Place1_Depto->Required) { ?>
				elm = this.getElements("x" + infix + "_Place1_Depto");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PedidoACadeteria_edit->Place1_Depto->caption(), $PedidoACadeteria_edit->Place1_Depto->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($PedidoACadeteria_edit->Place1_PersonaRecibe->Required) { ?>
				elm = this.getElements("x" + infix + "_Place1_PersonaRecibe");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PedidoACadeteria_edit->Place1_PersonaRecibe->caption(), $PedidoACadeteria_edit->Place1_PersonaRecibe->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($PedidoACadeteria_edit->Place1_PersonaRecibeTelefono->Required) { ?>
				elm = this.getElements("x" + infix + "_Place1_PersonaRecibeTelefono");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PedidoACadeteria_edit->Place1_PersonaRecibeTelefono->caption(), $PedidoACadeteria_edit->Place1_PersonaRecibeTelefono->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($PedidoACadeteria_edit->Place2_Nombre->Required) { ?>
				elm = this.getElements("x" + infix + "_Place2_Nombre");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PedidoACadeteria_edit->Place2_Nombre->caption(), $PedidoACadeteria_edit->Place2_Nombre->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($PedidoACadeteria_edit->Place2_Country->Required) { ?>
				elm = this.getElements("x" + infix + "_Place2_Country");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PedidoACadeteria_edit->Place2_Country->caption(), $PedidoACadeteria_edit->Place2_Country->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($PedidoACadeteria_edit->Place2_UF->Required) { ?>
				elm = this.getElements("x" + infix + "_Place2_UF");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PedidoACadeteria_edit->Place2_UF->caption(), $PedidoACadeteria_edit->Place2_UF->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($PedidoACadeteria_edit->Place2_Lat->Required) { ?>
				elm = this.getElements("x" + infix + "_Place2_Lat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PedidoACadeteria_edit->Place2_Lat->caption(), $PedidoACadeteria_edit->Place2_Lat->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Place2_Lat");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($PedidoACadeteria_edit->Place2_Lat->errorMessage()) ?>");
			<?php if ($PedidoACadeteria_edit->Place2_Lon->Required) { ?>
				elm = this.getElements("x" + infix + "_Place2_Lon");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PedidoACadeteria_edit->Place2_Lon->caption(), $PedidoACadeteria_edit->Place2_Lon->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Place2_Lon");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($PedidoACadeteria_edit->Place2_Lon->errorMessage()) ?>");
			<?php if ($PedidoACadeteria_edit->Place2_Calle->Required) { ?>
				elm = this.getElements("x" + infix + "_Place2_Calle");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PedidoACadeteria_edit->Place2_Calle->caption(), $PedidoACadeteria_edit->Place2_Calle->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($PedidoACadeteria_edit->Place2_Numero->Required) { ?>
				elm = this.getElements("x" + infix + "_Place2_Numero");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PedidoACadeteria_edit->Place2_Numero->caption(), $PedidoACadeteria_edit->Place2_Numero->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($PedidoACadeteria_edit->Place2_Localidad->Required) { ?>
				elm = this.getElements("x" + infix + "_Place2_Localidad");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PedidoACadeteria_edit->Place2_Localidad->caption(), $PedidoACadeteria_edit->Place2_Localidad->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($PedidoACadeteria_edit->Place2_Piso->Required) { ?>
				elm = this.getElements("x" + infix + "_Place2_Piso");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PedidoACadeteria_edit->Place2_Piso->caption(), $PedidoACadeteria_edit->Place2_Piso->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($PedidoACadeteria_edit->Place2_Depto->Required) { ?>
				elm = this.getElements("x" + infix + "_Place2_Depto");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PedidoACadeteria_edit->Place2_Depto->caption(), $PedidoACadeteria_edit->Place2_Depto->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($PedidoACadeteria_edit->Place2_PersonaRecibe->Required) { ?>
				elm = this.getElements("x" + infix + "_Place2_PersonaRecibe");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PedidoACadeteria_edit->Place2_PersonaRecibe->caption(), $PedidoACadeteria_edit->Place2_PersonaRecibe->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($PedidoACadeteria_edit->Place2_PersonaRecibeTelefono->Required) { ?>
				elm = this.getElements("x" + infix + "_Place2_PersonaRecibeTelefono");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PedidoACadeteria_edit->Place2_PersonaRecibeTelefono->caption(), $PedidoACadeteria_edit->Place2_PersonaRecibeTelefono->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($PedidoACadeteria_edit->ID_Cadeteria->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_Cadeteria");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $PedidoACadeteria_edit->ID_Cadeteria->caption(), $PedidoACadeteria_edit->ID_Cadeteria->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ID_Cadeteria");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($PedidoACadeteria_edit->ID_Cadeteria->errorMessage()) ?>");

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
	fPedidoACadeteriaedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fPedidoACadeteriaedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fPedidoACadeteriaedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $PedidoACadeteria_edit->showPageHeader(); ?>
<?php
$PedidoACadeteria_edit->showMessage();
?>
<form name="fPedidoACadeteriaedit" id="fPedidoACadeteriaedit" class="<?php echo $PedidoACadeteria_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="PedidoACadeteria">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$PedidoACadeteria_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($PedidoACadeteria_edit->ID->Visible) { // ID ?>
	<div id="r_ID" class="form-group row">
		<label id="elh_PedidoACadeteria_ID" for="x_ID" class="<?php echo $PedidoACadeteria_edit->LeftColumnClass ?>"><?php echo $PedidoACadeteria_edit->ID->caption() ?><?php echo $PedidoACadeteria_edit->ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $PedidoACadeteria_edit->RightColumnClass ?>"><div <?php echo $PedidoACadeteria_edit->ID->cellAttributes() ?>>
<input type="text" data-table="PedidoACadeteria" data-field="x_ID" name="x_ID" id="x_ID" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($PedidoACadeteria_edit->ID->getPlaceHolder()) ?>" value="<?php echo $PedidoACadeteria_edit->ID->EditValue ?>"<?php echo $PedidoACadeteria_edit->ID->editAttributes() ?>>
<input type="hidden" data-table="PedidoACadeteria" data-field="x_ID" name="o_ID" id="o_ID" value="<?php echo HtmlEncode($PedidoACadeteria_edit->ID->OldValue != null ? $PedidoACadeteria_edit->ID->OldValue : $PedidoACadeteria_edit->ID->CurrentValue) ?>">
<?php echo $PedidoACadeteria_edit->ID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($PedidoACadeteria_edit->ID_Usuario->Visible) { // ID_Usuario ?>
	<div id="r_ID_Usuario" class="form-group row">
		<label id="elh_PedidoACadeteria_ID_Usuario" for="x_ID_Usuario" class="<?php echo $PedidoACadeteria_edit->LeftColumnClass ?>"><?php echo $PedidoACadeteria_edit->ID_Usuario->caption() ?><?php echo $PedidoACadeteria_edit->ID_Usuario->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $PedidoACadeteria_edit->RightColumnClass ?>"><div <?php echo $PedidoACadeteria_edit->ID_Usuario->cellAttributes() ?>>
<span id="el_PedidoACadeteria_ID_Usuario">
<input type="text" data-table="PedidoACadeteria" data-field="x_ID_Usuario" name="x_ID_Usuario" id="x_ID_Usuario" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($PedidoACadeteria_edit->ID_Usuario->getPlaceHolder()) ?>" value="<?php echo $PedidoACadeteria_edit->ID_Usuario->EditValue ?>"<?php echo $PedidoACadeteria_edit->ID_Usuario->editAttributes() ?>>
</span>
<?php echo $PedidoACadeteria_edit->ID_Usuario->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($PedidoACadeteria_edit->ID_Place1->Visible) { // ID_Place1 ?>
	<div id="r_ID_Place1" class="form-group row">
		<label id="elh_PedidoACadeteria_ID_Place1" for="x_ID_Place1" class="<?php echo $PedidoACadeteria_edit->LeftColumnClass ?>"><?php echo $PedidoACadeteria_edit->ID_Place1->caption() ?><?php echo $PedidoACadeteria_edit->ID_Place1->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $PedidoACadeteria_edit->RightColumnClass ?>"><div <?php echo $PedidoACadeteria_edit->ID_Place1->cellAttributes() ?>>
<span id="el_PedidoACadeteria_ID_Place1">
<input type="text" data-table="PedidoACadeteria" data-field="x_ID_Place1" name="x_ID_Place1" id="x_ID_Place1" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($PedidoACadeteria_edit->ID_Place1->getPlaceHolder()) ?>" value="<?php echo $PedidoACadeteria_edit->ID_Place1->EditValue ?>"<?php echo $PedidoACadeteria_edit->ID_Place1->editAttributes() ?>>
</span>
<?php echo $PedidoACadeteria_edit->ID_Place1->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($PedidoACadeteria_edit->ID_Place2->Visible) { // ID_Place2 ?>
	<div id="r_ID_Place2" class="form-group row">
		<label id="elh_PedidoACadeteria_ID_Place2" for="x_ID_Place2" class="<?php echo $PedidoACadeteria_edit->LeftColumnClass ?>"><?php echo $PedidoACadeteria_edit->ID_Place2->caption() ?><?php echo $PedidoACadeteria_edit->ID_Place2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $PedidoACadeteria_edit->RightColumnClass ?>"><div <?php echo $PedidoACadeteria_edit->ID_Place2->cellAttributes() ?>>
<span id="el_PedidoACadeteria_ID_Place2">
<input type="text" data-table="PedidoACadeteria" data-field="x_ID_Place2" name="x_ID_Place2" id="x_ID_Place2" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($PedidoACadeteria_edit->ID_Place2->getPlaceHolder()) ?>" value="<?php echo $PedidoACadeteria_edit->ID_Place2->EditValue ?>"<?php echo $PedidoACadeteria_edit->ID_Place2->editAttributes() ?>>
</span>
<?php echo $PedidoACadeteria_edit->ID_Place2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($PedidoACadeteria_edit->ID_Cadete->Visible) { // ID_Cadete ?>
	<div id="r_ID_Cadete" class="form-group row">
		<label id="elh_PedidoACadeteria_ID_Cadete" for="x_ID_Cadete" class="<?php echo $PedidoACadeteria_edit->LeftColumnClass ?>"><?php echo $PedidoACadeteria_edit->ID_Cadete->caption() ?><?php echo $PedidoACadeteria_edit->ID_Cadete->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $PedidoACadeteria_edit->RightColumnClass ?>"><div <?php echo $PedidoACadeteria_edit->ID_Cadete->cellAttributes() ?>>
<span id="el_PedidoACadeteria_ID_Cadete">
<input type="text" data-table="PedidoACadeteria" data-field="x_ID_Cadete" name="x_ID_Cadete" id="x_ID_Cadete" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($PedidoACadeteria_edit->ID_Cadete->getPlaceHolder()) ?>" value="<?php echo $PedidoACadeteria_edit->ID_Cadete->EditValue ?>"<?php echo $PedidoACadeteria_edit->ID_Cadete->editAttributes() ?>>
</span>
<?php echo $PedidoACadeteria_edit->ID_Cadete->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($PedidoACadeteria_edit->ID_Status->Visible) { // ID_Status ?>
	<div id="r_ID_Status" class="form-group row">
		<label id="elh_PedidoACadeteria_ID_Status" for="x_ID_Status" class="<?php echo $PedidoACadeteria_edit->LeftColumnClass ?>"><?php echo $PedidoACadeteria_edit->ID_Status->caption() ?><?php echo $PedidoACadeteria_edit->ID_Status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $PedidoACadeteria_edit->RightColumnClass ?>"><div <?php echo $PedidoACadeteria_edit->ID_Status->cellAttributes() ?>>
<span id="el_PedidoACadeteria_ID_Status">
<input type="text" data-table="PedidoACadeteria" data-field="x_ID_Status" name="x_ID_Status" id="x_ID_Status" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($PedidoACadeteria_edit->ID_Status->getPlaceHolder()) ?>" value="<?php echo $PedidoACadeteria_edit->ID_Status->EditValue ?>"<?php echo $PedidoACadeteria_edit->ID_Status->editAttributes() ?>>
</span>
<?php echo $PedidoACadeteria_edit->ID_Status->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($PedidoACadeteria_edit->InstruccionesPlace1->Visible) { // InstruccionesPlace1 ?>
	<div id="r_InstruccionesPlace1" class="form-group row">
		<label id="elh_PedidoACadeteria_InstruccionesPlace1" for="x_InstruccionesPlace1" class="<?php echo $PedidoACadeteria_edit->LeftColumnClass ?>"><?php echo $PedidoACadeteria_edit->InstruccionesPlace1->caption() ?><?php echo $PedidoACadeteria_edit->InstruccionesPlace1->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $PedidoACadeteria_edit->RightColumnClass ?>"><div <?php echo $PedidoACadeteria_edit->InstruccionesPlace1->cellAttributes() ?>>
<span id="el_PedidoACadeteria_InstruccionesPlace1">
<input type="text" data-table="PedidoACadeteria" data-field="x_InstruccionesPlace1" name="x_InstruccionesPlace1" id="x_InstruccionesPlace1" size="30" maxlength="400" placeholder="<?php echo HtmlEncode($PedidoACadeteria_edit->InstruccionesPlace1->getPlaceHolder()) ?>" value="<?php echo $PedidoACadeteria_edit->InstruccionesPlace1->EditValue ?>"<?php echo $PedidoACadeteria_edit->InstruccionesPlace1->editAttributes() ?>>
</span>
<?php echo $PedidoACadeteria_edit->InstruccionesPlace1->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($PedidoACadeteria_edit->InstruccionesPlace2->Visible) { // InstruccionesPlace2 ?>
	<div id="r_InstruccionesPlace2" class="form-group row">
		<label id="elh_PedidoACadeteria_InstruccionesPlace2" for="x_InstruccionesPlace2" class="<?php echo $PedidoACadeteria_edit->LeftColumnClass ?>"><?php echo $PedidoACadeteria_edit->InstruccionesPlace2->caption() ?><?php echo $PedidoACadeteria_edit->InstruccionesPlace2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $PedidoACadeteria_edit->RightColumnClass ?>"><div <?php echo $PedidoACadeteria_edit->InstruccionesPlace2->cellAttributes() ?>>
<span id="el_PedidoACadeteria_InstruccionesPlace2">
<input type="text" data-table="PedidoACadeteria" data-field="x_InstruccionesPlace2" name="x_InstruccionesPlace2" id="x_InstruccionesPlace2" size="30" maxlength="400" placeholder="<?php echo HtmlEncode($PedidoACadeteria_edit->InstruccionesPlace2->getPlaceHolder()) ?>" value="<?php echo $PedidoACadeteria_edit->InstruccionesPlace2->EditValue ?>"<?php echo $PedidoACadeteria_edit->InstruccionesPlace2->editAttributes() ?>>
</span>
<?php echo $PedidoACadeteria_edit->InstruccionesPlace2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($PedidoACadeteria_edit->Direccionalidad->Visible) { // Direccionalidad ?>
	<div id="r_Direccionalidad" class="form-group row">
		<label id="elh_PedidoACadeteria_Direccionalidad" for="x_Direccionalidad" class="<?php echo $PedidoACadeteria_edit->LeftColumnClass ?>"><?php echo $PedidoACadeteria_edit->Direccionalidad->caption() ?><?php echo $PedidoACadeteria_edit->Direccionalidad->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $PedidoACadeteria_edit->RightColumnClass ?>"><div <?php echo $PedidoACadeteria_edit->Direccionalidad->cellAttributes() ?>>
<span id="el_PedidoACadeteria_Direccionalidad">
<input type="text" data-table="PedidoACadeteria" data-field="x_Direccionalidad" name="x_Direccionalidad" id="x_Direccionalidad" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($PedidoACadeteria_edit->Direccionalidad->getPlaceHolder()) ?>" value="<?php echo $PedidoACadeteria_edit->Direccionalidad->EditValue ?>"<?php echo $PedidoACadeteria_edit->Direccionalidad->editAttributes() ?>>
</span>
<?php echo $PedidoACadeteria_edit->Direccionalidad->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($PedidoACadeteria_edit->RemitoURL->Visible) { // RemitoURL ?>
	<div id="r_RemitoURL" class="form-group row">
		<label id="elh_PedidoACadeteria_RemitoURL" for="x_RemitoURL" class="<?php echo $PedidoACadeteria_edit->LeftColumnClass ?>"><?php echo $PedidoACadeteria_edit->RemitoURL->caption() ?><?php echo $PedidoACadeteria_edit->RemitoURL->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $PedidoACadeteria_edit->RightColumnClass ?>"><div <?php echo $PedidoACadeteria_edit->RemitoURL->cellAttributes() ?>>
<span id="el_PedidoACadeteria_RemitoURL">
<input type="text" data-table="PedidoACadeteria" data-field="x_RemitoURL" name="x_RemitoURL" id="x_RemitoURL" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($PedidoACadeteria_edit->RemitoURL->getPlaceHolder()) ?>" value="<?php echo $PedidoACadeteria_edit->RemitoURL->EditValue ?>"<?php echo $PedidoACadeteria_edit->RemitoURL->editAttributes() ?>>
</span>
<?php echo $PedidoACadeteria_edit->RemitoURL->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($PedidoACadeteria_edit->Place1_Nombre->Visible) { // Place1_Nombre ?>
	<div id="r_Place1_Nombre" class="form-group row">
		<label id="elh_PedidoACadeteria_Place1_Nombre" for="x_Place1_Nombre" class="<?php echo $PedidoACadeteria_edit->LeftColumnClass ?>"><?php echo $PedidoACadeteria_edit->Place1_Nombre->caption() ?><?php echo $PedidoACadeteria_edit->Place1_Nombre->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $PedidoACadeteria_edit->RightColumnClass ?>"><div <?php echo $PedidoACadeteria_edit->Place1_Nombre->cellAttributes() ?>>
<span id="el_PedidoACadeteria_Place1_Nombre">
<input type="text" data-table="PedidoACadeteria" data-field="x_Place1_Nombre" name="x_Place1_Nombre" id="x_Place1_Nombre" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($PedidoACadeteria_edit->Place1_Nombre->getPlaceHolder()) ?>" value="<?php echo $PedidoACadeteria_edit->Place1_Nombre->EditValue ?>"<?php echo $PedidoACadeteria_edit->Place1_Nombre->editAttributes() ?>>
</span>
<?php echo $PedidoACadeteria_edit->Place1_Nombre->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($PedidoACadeteria_edit->Place1_Country->Visible) { // Place1_Country ?>
	<div id="r_Place1_Country" class="form-group row">
		<label id="elh_PedidoACadeteria_Place1_Country" for="x_Place1_Country" class="<?php echo $PedidoACadeteria_edit->LeftColumnClass ?>"><?php echo $PedidoACadeteria_edit->Place1_Country->caption() ?><?php echo $PedidoACadeteria_edit->Place1_Country->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $PedidoACadeteria_edit->RightColumnClass ?>"><div <?php echo $PedidoACadeteria_edit->Place1_Country->cellAttributes() ?>>
<span id="el_PedidoACadeteria_Place1_Country">
<input type="text" data-table="PedidoACadeteria" data-field="x_Place1_Country" name="x_Place1_Country" id="x_Place1_Country" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($PedidoACadeteria_edit->Place1_Country->getPlaceHolder()) ?>" value="<?php echo $PedidoACadeteria_edit->Place1_Country->EditValue ?>"<?php echo $PedidoACadeteria_edit->Place1_Country->editAttributes() ?>>
</span>
<?php echo $PedidoACadeteria_edit->Place1_Country->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($PedidoACadeteria_edit->Place1_UF->Visible) { // Place1_UF ?>
	<div id="r_Place1_UF" class="form-group row">
		<label id="elh_PedidoACadeteria_Place1_UF" for="x_Place1_UF" class="<?php echo $PedidoACadeteria_edit->LeftColumnClass ?>"><?php echo $PedidoACadeteria_edit->Place1_UF->caption() ?><?php echo $PedidoACadeteria_edit->Place1_UF->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $PedidoACadeteria_edit->RightColumnClass ?>"><div <?php echo $PedidoACadeteria_edit->Place1_UF->cellAttributes() ?>>
<span id="el_PedidoACadeteria_Place1_UF">
<input type="text" data-table="PedidoACadeteria" data-field="x_Place1_UF" name="x_Place1_UF" id="x_Place1_UF" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($PedidoACadeteria_edit->Place1_UF->getPlaceHolder()) ?>" value="<?php echo $PedidoACadeteria_edit->Place1_UF->EditValue ?>"<?php echo $PedidoACadeteria_edit->Place1_UF->editAttributes() ?>>
</span>
<?php echo $PedidoACadeteria_edit->Place1_UF->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($PedidoACadeteria_edit->Plate1_Lat->Visible) { // Plate1_Lat ?>
	<div id="r_Plate1_Lat" class="form-group row">
		<label id="elh_PedidoACadeteria_Plate1_Lat" for="x_Plate1_Lat" class="<?php echo $PedidoACadeteria_edit->LeftColumnClass ?>"><?php echo $PedidoACadeteria_edit->Plate1_Lat->caption() ?><?php echo $PedidoACadeteria_edit->Plate1_Lat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $PedidoACadeteria_edit->RightColumnClass ?>"><div <?php echo $PedidoACadeteria_edit->Plate1_Lat->cellAttributes() ?>>
<span id="el_PedidoACadeteria_Plate1_Lat">
<input type="text" data-table="PedidoACadeteria" data-field="x_Plate1_Lat" name="x_Plate1_Lat" id="x_Plate1_Lat" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($PedidoACadeteria_edit->Plate1_Lat->getPlaceHolder()) ?>" value="<?php echo $PedidoACadeteria_edit->Plate1_Lat->EditValue ?>"<?php echo $PedidoACadeteria_edit->Plate1_Lat->editAttributes() ?>>
</span>
<?php echo $PedidoACadeteria_edit->Plate1_Lat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($PedidoACadeteria_edit->Place1_Lon->Visible) { // Place1_Lon ?>
	<div id="r_Place1_Lon" class="form-group row">
		<label id="elh_PedidoACadeteria_Place1_Lon" for="x_Place1_Lon" class="<?php echo $PedidoACadeteria_edit->LeftColumnClass ?>"><?php echo $PedidoACadeteria_edit->Place1_Lon->caption() ?><?php echo $PedidoACadeteria_edit->Place1_Lon->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $PedidoACadeteria_edit->RightColumnClass ?>"><div <?php echo $PedidoACadeteria_edit->Place1_Lon->cellAttributes() ?>>
<span id="el_PedidoACadeteria_Place1_Lon">
<input type="text" data-table="PedidoACadeteria" data-field="x_Place1_Lon" name="x_Place1_Lon" id="x_Place1_Lon" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($PedidoACadeteria_edit->Place1_Lon->getPlaceHolder()) ?>" value="<?php echo $PedidoACadeteria_edit->Place1_Lon->EditValue ?>"<?php echo $PedidoACadeteria_edit->Place1_Lon->editAttributes() ?>>
</span>
<?php echo $PedidoACadeteria_edit->Place1_Lon->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($PedidoACadeteria_edit->Place1_Calle->Visible) { // Place1_Calle ?>
	<div id="r_Place1_Calle" class="form-group row">
		<label id="elh_PedidoACadeteria_Place1_Calle" for="x_Place1_Calle" class="<?php echo $PedidoACadeteria_edit->LeftColumnClass ?>"><?php echo $PedidoACadeteria_edit->Place1_Calle->caption() ?><?php echo $PedidoACadeteria_edit->Place1_Calle->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $PedidoACadeteria_edit->RightColumnClass ?>"><div <?php echo $PedidoACadeteria_edit->Place1_Calle->cellAttributes() ?>>
<span id="el_PedidoACadeteria_Place1_Calle">
<input type="text" data-table="PedidoACadeteria" data-field="x_Place1_Calle" name="x_Place1_Calle" id="x_Place1_Calle" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($PedidoACadeteria_edit->Place1_Calle->getPlaceHolder()) ?>" value="<?php echo $PedidoACadeteria_edit->Place1_Calle->EditValue ?>"<?php echo $PedidoACadeteria_edit->Place1_Calle->editAttributes() ?>>
</span>
<?php echo $PedidoACadeteria_edit->Place1_Calle->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($PedidoACadeteria_edit->Place1_Numero->Visible) { // Place1_Numero ?>
	<div id="r_Place1_Numero" class="form-group row">
		<label id="elh_PedidoACadeteria_Place1_Numero" for="x_Place1_Numero" class="<?php echo $PedidoACadeteria_edit->LeftColumnClass ?>"><?php echo $PedidoACadeteria_edit->Place1_Numero->caption() ?><?php echo $PedidoACadeteria_edit->Place1_Numero->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $PedidoACadeteria_edit->RightColumnClass ?>"><div <?php echo $PedidoACadeteria_edit->Place1_Numero->cellAttributes() ?>>
<span id="el_PedidoACadeteria_Place1_Numero">
<input type="text" data-table="PedidoACadeteria" data-field="x_Place1_Numero" name="x_Place1_Numero" id="x_Place1_Numero" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($PedidoACadeteria_edit->Place1_Numero->getPlaceHolder()) ?>" value="<?php echo $PedidoACadeteria_edit->Place1_Numero->EditValue ?>"<?php echo $PedidoACadeteria_edit->Place1_Numero->editAttributes() ?>>
</span>
<?php echo $PedidoACadeteria_edit->Place1_Numero->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($PedidoACadeteria_edit->Place1_Localidad->Visible) { // Place1_Localidad ?>
	<div id="r_Place1_Localidad" class="form-group row">
		<label id="elh_PedidoACadeteria_Place1_Localidad" for="x_Place1_Localidad" class="<?php echo $PedidoACadeteria_edit->LeftColumnClass ?>"><?php echo $PedidoACadeteria_edit->Place1_Localidad->caption() ?><?php echo $PedidoACadeteria_edit->Place1_Localidad->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $PedidoACadeteria_edit->RightColumnClass ?>"><div <?php echo $PedidoACadeteria_edit->Place1_Localidad->cellAttributes() ?>>
<span id="el_PedidoACadeteria_Place1_Localidad">
<input type="text" data-table="PedidoACadeteria" data-field="x_Place1_Localidad" name="x_Place1_Localidad" id="x_Place1_Localidad" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($PedidoACadeteria_edit->Place1_Localidad->getPlaceHolder()) ?>" value="<?php echo $PedidoACadeteria_edit->Place1_Localidad->EditValue ?>"<?php echo $PedidoACadeteria_edit->Place1_Localidad->editAttributes() ?>>
</span>
<?php echo $PedidoACadeteria_edit->Place1_Localidad->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($PedidoACadeteria_edit->Place1_Piso->Visible) { // Place1_Piso ?>
	<div id="r_Place1_Piso" class="form-group row">
		<label id="elh_PedidoACadeteria_Place1_Piso" for="x_Place1_Piso" class="<?php echo $PedidoACadeteria_edit->LeftColumnClass ?>"><?php echo $PedidoACadeteria_edit->Place1_Piso->caption() ?><?php echo $PedidoACadeteria_edit->Place1_Piso->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $PedidoACadeteria_edit->RightColumnClass ?>"><div <?php echo $PedidoACadeteria_edit->Place1_Piso->cellAttributes() ?>>
<span id="el_PedidoACadeteria_Place1_Piso">
<input type="text" data-table="PedidoACadeteria" data-field="x_Place1_Piso" name="x_Place1_Piso" id="x_Place1_Piso" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($PedidoACadeteria_edit->Place1_Piso->getPlaceHolder()) ?>" value="<?php echo $PedidoACadeteria_edit->Place1_Piso->EditValue ?>"<?php echo $PedidoACadeteria_edit->Place1_Piso->editAttributes() ?>>
</span>
<?php echo $PedidoACadeteria_edit->Place1_Piso->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($PedidoACadeteria_edit->Place1_Depto->Visible) { // Place1_Depto ?>
	<div id="r_Place1_Depto" class="form-group row">
		<label id="elh_PedidoACadeteria_Place1_Depto" for="x_Place1_Depto" class="<?php echo $PedidoACadeteria_edit->LeftColumnClass ?>"><?php echo $PedidoACadeteria_edit->Place1_Depto->caption() ?><?php echo $PedidoACadeteria_edit->Place1_Depto->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $PedidoACadeteria_edit->RightColumnClass ?>"><div <?php echo $PedidoACadeteria_edit->Place1_Depto->cellAttributes() ?>>
<span id="el_PedidoACadeteria_Place1_Depto">
<input type="text" data-table="PedidoACadeteria" data-field="x_Place1_Depto" name="x_Place1_Depto" id="x_Place1_Depto" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($PedidoACadeteria_edit->Place1_Depto->getPlaceHolder()) ?>" value="<?php echo $PedidoACadeteria_edit->Place1_Depto->EditValue ?>"<?php echo $PedidoACadeteria_edit->Place1_Depto->editAttributes() ?>>
</span>
<?php echo $PedidoACadeteria_edit->Place1_Depto->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($PedidoACadeteria_edit->Place1_PersonaRecibe->Visible) { // Place1_PersonaRecibe ?>
	<div id="r_Place1_PersonaRecibe" class="form-group row">
		<label id="elh_PedidoACadeteria_Place1_PersonaRecibe" for="x_Place1_PersonaRecibe" class="<?php echo $PedidoACadeteria_edit->LeftColumnClass ?>"><?php echo $PedidoACadeteria_edit->Place1_PersonaRecibe->caption() ?><?php echo $PedidoACadeteria_edit->Place1_PersonaRecibe->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $PedidoACadeteria_edit->RightColumnClass ?>"><div <?php echo $PedidoACadeteria_edit->Place1_PersonaRecibe->cellAttributes() ?>>
<span id="el_PedidoACadeteria_Place1_PersonaRecibe">
<input type="text" data-table="PedidoACadeteria" data-field="x_Place1_PersonaRecibe" name="x_Place1_PersonaRecibe" id="x_Place1_PersonaRecibe" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($PedidoACadeteria_edit->Place1_PersonaRecibe->getPlaceHolder()) ?>" value="<?php echo $PedidoACadeteria_edit->Place1_PersonaRecibe->EditValue ?>"<?php echo $PedidoACadeteria_edit->Place1_PersonaRecibe->editAttributes() ?>>
</span>
<?php echo $PedidoACadeteria_edit->Place1_PersonaRecibe->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($PedidoACadeteria_edit->Place1_PersonaRecibeTelefono->Visible) { // Place1_PersonaRecibeTelefono ?>
	<div id="r_Place1_PersonaRecibeTelefono" class="form-group row">
		<label id="elh_PedidoACadeteria_Place1_PersonaRecibeTelefono" for="x_Place1_PersonaRecibeTelefono" class="<?php echo $PedidoACadeteria_edit->LeftColumnClass ?>"><?php echo $PedidoACadeteria_edit->Place1_PersonaRecibeTelefono->caption() ?><?php echo $PedidoACadeteria_edit->Place1_PersonaRecibeTelefono->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $PedidoACadeteria_edit->RightColumnClass ?>"><div <?php echo $PedidoACadeteria_edit->Place1_PersonaRecibeTelefono->cellAttributes() ?>>
<span id="el_PedidoACadeteria_Place1_PersonaRecibeTelefono">
<input type="text" data-table="PedidoACadeteria" data-field="x_Place1_PersonaRecibeTelefono" name="x_Place1_PersonaRecibeTelefono" id="x_Place1_PersonaRecibeTelefono" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($PedidoACadeteria_edit->Place1_PersonaRecibeTelefono->getPlaceHolder()) ?>" value="<?php echo $PedidoACadeteria_edit->Place1_PersonaRecibeTelefono->EditValue ?>"<?php echo $PedidoACadeteria_edit->Place1_PersonaRecibeTelefono->editAttributes() ?>>
</span>
<?php echo $PedidoACadeteria_edit->Place1_PersonaRecibeTelefono->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($PedidoACadeteria_edit->Place2_Nombre->Visible) { // Place2_Nombre ?>
	<div id="r_Place2_Nombre" class="form-group row">
		<label id="elh_PedidoACadeteria_Place2_Nombre" for="x_Place2_Nombre" class="<?php echo $PedidoACadeteria_edit->LeftColumnClass ?>"><?php echo $PedidoACadeteria_edit->Place2_Nombre->caption() ?><?php echo $PedidoACadeteria_edit->Place2_Nombre->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $PedidoACadeteria_edit->RightColumnClass ?>"><div <?php echo $PedidoACadeteria_edit->Place2_Nombre->cellAttributes() ?>>
<span id="el_PedidoACadeteria_Place2_Nombre">
<input type="text" data-table="PedidoACadeteria" data-field="x_Place2_Nombre" name="x_Place2_Nombre" id="x_Place2_Nombre" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($PedidoACadeteria_edit->Place2_Nombre->getPlaceHolder()) ?>" value="<?php echo $PedidoACadeteria_edit->Place2_Nombre->EditValue ?>"<?php echo $PedidoACadeteria_edit->Place2_Nombre->editAttributes() ?>>
</span>
<?php echo $PedidoACadeteria_edit->Place2_Nombre->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($PedidoACadeteria_edit->Place2_Country->Visible) { // Place2_Country ?>
	<div id="r_Place2_Country" class="form-group row">
		<label id="elh_PedidoACadeteria_Place2_Country" for="x_Place2_Country" class="<?php echo $PedidoACadeteria_edit->LeftColumnClass ?>"><?php echo $PedidoACadeteria_edit->Place2_Country->caption() ?><?php echo $PedidoACadeteria_edit->Place2_Country->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $PedidoACadeteria_edit->RightColumnClass ?>"><div <?php echo $PedidoACadeteria_edit->Place2_Country->cellAttributes() ?>>
<span id="el_PedidoACadeteria_Place2_Country">
<input type="text" data-table="PedidoACadeteria" data-field="x_Place2_Country" name="x_Place2_Country" id="x_Place2_Country" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($PedidoACadeteria_edit->Place2_Country->getPlaceHolder()) ?>" value="<?php echo $PedidoACadeteria_edit->Place2_Country->EditValue ?>"<?php echo $PedidoACadeteria_edit->Place2_Country->editAttributes() ?>>
</span>
<?php echo $PedidoACadeteria_edit->Place2_Country->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($PedidoACadeteria_edit->Place2_UF->Visible) { // Place2_UF ?>
	<div id="r_Place2_UF" class="form-group row">
		<label id="elh_PedidoACadeteria_Place2_UF" for="x_Place2_UF" class="<?php echo $PedidoACadeteria_edit->LeftColumnClass ?>"><?php echo $PedidoACadeteria_edit->Place2_UF->caption() ?><?php echo $PedidoACadeteria_edit->Place2_UF->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $PedidoACadeteria_edit->RightColumnClass ?>"><div <?php echo $PedidoACadeteria_edit->Place2_UF->cellAttributes() ?>>
<span id="el_PedidoACadeteria_Place2_UF">
<input type="text" data-table="PedidoACadeteria" data-field="x_Place2_UF" name="x_Place2_UF" id="x_Place2_UF" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($PedidoACadeteria_edit->Place2_UF->getPlaceHolder()) ?>" value="<?php echo $PedidoACadeteria_edit->Place2_UF->EditValue ?>"<?php echo $PedidoACadeteria_edit->Place2_UF->editAttributes() ?>>
</span>
<?php echo $PedidoACadeteria_edit->Place2_UF->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($PedidoACadeteria_edit->Place2_Lat->Visible) { // Place2_Lat ?>
	<div id="r_Place2_Lat" class="form-group row">
		<label id="elh_PedidoACadeteria_Place2_Lat" for="x_Place2_Lat" class="<?php echo $PedidoACadeteria_edit->LeftColumnClass ?>"><?php echo $PedidoACadeteria_edit->Place2_Lat->caption() ?><?php echo $PedidoACadeteria_edit->Place2_Lat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $PedidoACadeteria_edit->RightColumnClass ?>"><div <?php echo $PedidoACadeteria_edit->Place2_Lat->cellAttributes() ?>>
<span id="el_PedidoACadeteria_Place2_Lat">
<input type="text" data-table="PedidoACadeteria" data-field="x_Place2_Lat" name="x_Place2_Lat" id="x_Place2_Lat" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($PedidoACadeteria_edit->Place2_Lat->getPlaceHolder()) ?>" value="<?php echo $PedidoACadeteria_edit->Place2_Lat->EditValue ?>"<?php echo $PedidoACadeteria_edit->Place2_Lat->editAttributes() ?>>
</span>
<?php echo $PedidoACadeteria_edit->Place2_Lat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($PedidoACadeteria_edit->Place2_Lon->Visible) { // Place2_Lon ?>
	<div id="r_Place2_Lon" class="form-group row">
		<label id="elh_PedidoACadeteria_Place2_Lon" for="x_Place2_Lon" class="<?php echo $PedidoACadeteria_edit->LeftColumnClass ?>"><?php echo $PedidoACadeteria_edit->Place2_Lon->caption() ?><?php echo $PedidoACadeteria_edit->Place2_Lon->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $PedidoACadeteria_edit->RightColumnClass ?>"><div <?php echo $PedidoACadeteria_edit->Place2_Lon->cellAttributes() ?>>
<span id="el_PedidoACadeteria_Place2_Lon">
<input type="text" data-table="PedidoACadeteria" data-field="x_Place2_Lon" name="x_Place2_Lon" id="x_Place2_Lon" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($PedidoACadeteria_edit->Place2_Lon->getPlaceHolder()) ?>" value="<?php echo $PedidoACadeteria_edit->Place2_Lon->EditValue ?>"<?php echo $PedidoACadeteria_edit->Place2_Lon->editAttributes() ?>>
</span>
<?php echo $PedidoACadeteria_edit->Place2_Lon->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($PedidoACadeteria_edit->Place2_Calle->Visible) { // Place2_Calle ?>
	<div id="r_Place2_Calle" class="form-group row">
		<label id="elh_PedidoACadeteria_Place2_Calle" for="x_Place2_Calle" class="<?php echo $PedidoACadeteria_edit->LeftColumnClass ?>"><?php echo $PedidoACadeteria_edit->Place2_Calle->caption() ?><?php echo $PedidoACadeteria_edit->Place2_Calle->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $PedidoACadeteria_edit->RightColumnClass ?>"><div <?php echo $PedidoACadeteria_edit->Place2_Calle->cellAttributes() ?>>
<span id="el_PedidoACadeteria_Place2_Calle">
<input type="text" data-table="PedidoACadeteria" data-field="x_Place2_Calle" name="x_Place2_Calle" id="x_Place2_Calle" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($PedidoACadeteria_edit->Place2_Calle->getPlaceHolder()) ?>" value="<?php echo $PedidoACadeteria_edit->Place2_Calle->EditValue ?>"<?php echo $PedidoACadeteria_edit->Place2_Calle->editAttributes() ?>>
</span>
<?php echo $PedidoACadeteria_edit->Place2_Calle->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($PedidoACadeteria_edit->Place2_Numero->Visible) { // Place2_Numero ?>
	<div id="r_Place2_Numero" class="form-group row">
		<label id="elh_PedidoACadeteria_Place2_Numero" for="x_Place2_Numero" class="<?php echo $PedidoACadeteria_edit->LeftColumnClass ?>"><?php echo $PedidoACadeteria_edit->Place2_Numero->caption() ?><?php echo $PedidoACadeteria_edit->Place2_Numero->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $PedidoACadeteria_edit->RightColumnClass ?>"><div <?php echo $PedidoACadeteria_edit->Place2_Numero->cellAttributes() ?>>
<span id="el_PedidoACadeteria_Place2_Numero">
<input type="text" data-table="PedidoACadeteria" data-field="x_Place2_Numero" name="x_Place2_Numero" id="x_Place2_Numero" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($PedidoACadeteria_edit->Place2_Numero->getPlaceHolder()) ?>" value="<?php echo $PedidoACadeteria_edit->Place2_Numero->EditValue ?>"<?php echo $PedidoACadeteria_edit->Place2_Numero->editAttributes() ?>>
</span>
<?php echo $PedidoACadeteria_edit->Place2_Numero->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($PedidoACadeteria_edit->Place2_Localidad->Visible) { // Place2_Localidad ?>
	<div id="r_Place2_Localidad" class="form-group row">
		<label id="elh_PedidoACadeteria_Place2_Localidad" for="x_Place2_Localidad" class="<?php echo $PedidoACadeteria_edit->LeftColumnClass ?>"><?php echo $PedidoACadeteria_edit->Place2_Localidad->caption() ?><?php echo $PedidoACadeteria_edit->Place2_Localidad->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $PedidoACadeteria_edit->RightColumnClass ?>"><div <?php echo $PedidoACadeteria_edit->Place2_Localidad->cellAttributes() ?>>
<span id="el_PedidoACadeteria_Place2_Localidad">
<input type="text" data-table="PedidoACadeteria" data-field="x_Place2_Localidad" name="x_Place2_Localidad" id="x_Place2_Localidad" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($PedidoACadeteria_edit->Place2_Localidad->getPlaceHolder()) ?>" value="<?php echo $PedidoACadeteria_edit->Place2_Localidad->EditValue ?>"<?php echo $PedidoACadeteria_edit->Place2_Localidad->editAttributes() ?>>
</span>
<?php echo $PedidoACadeteria_edit->Place2_Localidad->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($PedidoACadeteria_edit->Place2_Piso->Visible) { // Place2_Piso ?>
	<div id="r_Place2_Piso" class="form-group row">
		<label id="elh_PedidoACadeteria_Place2_Piso" for="x_Place2_Piso" class="<?php echo $PedidoACadeteria_edit->LeftColumnClass ?>"><?php echo $PedidoACadeteria_edit->Place2_Piso->caption() ?><?php echo $PedidoACadeteria_edit->Place2_Piso->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $PedidoACadeteria_edit->RightColumnClass ?>"><div <?php echo $PedidoACadeteria_edit->Place2_Piso->cellAttributes() ?>>
<span id="el_PedidoACadeteria_Place2_Piso">
<input type="text" data-table="PedidoACadeteria" data-field="x_Place2_Piso" name="x_Place2_Piso" id="x_Place2_Piso" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($PedidoACadeteria_edit->Place2_Piso->getPlaceHolder()) ?>" value="<?php echo $PedidoACadeteria_edit->Place2_Piso->EditValue ?>"<?php echo $PedidoACadeteria_edit->Place2_Piso->editAttributes() ?>>
</span>
<?php echo $PedidoACadeteria_edit->Place2_Piso->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($PedidoACadeteria_edit->Place2_Depto->Visible) { // Place2_Depto ?>
	<div id="r_Place2_Depto" class="form-group row">
		<label id="elh_PedidoACadeteria_Place2_Depto" for="x_Place2_Depto" class="<?php echo $PedidoACadeteria_edit->LeftColumnClass ?>"><?php echo $PedidoACadeteria_edit->Place2_Depto->caption() ?><?php echo $PedidoACadeteria_edit->Place2_Depto->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $PedidoACadeteria_edit->RightColumnClass ?>"><div <?php echo $PedidoACadeteria_edit->Place2_Depto->cellAttributes() ?>>
<span id="el_PedidoACadeteria_Place2_Depto">
<input type="text" data-table="PedidoACadeteria" data-field="x_Place2_Depto" name="x_Place2_Depto" id="x_Place2_Depto" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($PedidoACadeteria_edit->Place2_Depto->getPlaceHolder()) ?>" value="<?php echo $PedidoACadeteria_edit->Place2_Depto->EditValue ?>"<?php echo $PedidoACadeteria_edit->Place2_Depto->editAttributes() ?>>
</span>
<?php echo $PedidoACadeteria_edit->Place2_Depto->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($PedidoACadeteria_edit->Place2_PersonaRecibe->Visible) { // Place2_PersonaRecibe ?>
	<div id="r_Place2_PersonaRecibe" class="form-group row">
		<label id="elh_PedidoACadeteria_Place2_PersonaRecibe" for="x_Place2_PersonaRecibe" class="<?php echo $PedidoACadeteria_edit->LeftColumnClass ?>"><?php echo $PedidoACadeteria_edit->Place2_PersonaRecibe->caption() ?><?php echo $PedidoACadeteria_edit->Place2_PersonaRecibe->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $PedidoACadeteria_edit->RightColumnClass ?>"><div <?php echo $PedidoACadeteria_edit->Place2_PersonaRecibe->cellAttributes() ?>>
<span id="el_PedidoACadeteria_Place2_PersonaRecibe">
<input type="text" data-table="PedidoACadeteria" data-field="x_Place2_PersonaRecibe" name="x_Place2_PersonaRecibe" id="x_Place2_PersonaRecibe" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($PedidoACadeteria_edit->Place2_PersonaRecibe->getPlaceHolder()) ?>" value="<?php echo $PedidoACadeteria_edit->Place2_PersonaRecibe->EditValue ?>"<?php echo $PedidoACadeteria_edit->Place2_PersonaRecibe->editAttributes() ?>>
</span>
<?php echo $PedidoACadeteria_edit->Place2_PersonaRecibe->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($PedidoACadeteria_edit->Place2_PersonaRecibeTelefono->Visible) { // Place2_PersonaRecibeTelefono ?>
	<div id="r_Place2_PersonaRecibeTelefono" class="form-group row">
		<label id="elh_PedidoACadeteria_Place2_PersonaRecibeTelefono" for="x_Place2_PersonaRecibeTelefono" class="<?php echo $PedidoACadeteria_edit->LeftColumnClass ?>"><?php echo $PedidoACadeteria_edit->Place2_PersonaRecibeTelefono->caption() ?><?php echo $PedidoACadeteria_edit->Place2_PersonaRecibeTelefono->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $PedidoACadeteria_edit->RightColumnClass ?>"><div <?php echo $PedidoACadeteria_edit->Place2_PersonaRecibeTelefono->cellAttributes() ?>>
<span id="el_PedidoACadeteria_Place2_PersonaRecibeTelefono">
<input type="text" data-table="PedidoACadeteria" data-field="x_Place2_PersonaRecibeTelefono" name="x_Place2_PersonaRecibeTelefono" id="x_Place2_PersonaRecibeTelefono" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($PedidoACadeteria_edit->Place2_PersonaRecibeTelefono->getPlaceHolder()) ?>" value="<?php echo $PedidoACadeteria_edit->Place2_PersonaRecibeTelefono->EditValue ?>"<?php echo $PedidoACadeteria_edit->Place2_PersonaRecibeTelefono->editAttributes() ?>>
</span>
<?php echo $PedidoACadeteria_edit->Place2_PersonaRecibeTelefono->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($PedidoACadeteria_edit->ID_Cadeteria->Visible) { // ID_Cadeteria ?>
	<div id="r_ID_Cadeteria" class="form-group row">
		<label id="elh_PedidoACadeteria_ID_Cadeteria" for="x_ID_Cadeteria" class="<?php echo $PedidoACadeteria_edit->LeftColumnClass ?>"><?php echo $PedidoACadeteria_edit->ID_Cadeteria->caption() ?><?php echo $PedidoACadeteria_edit->ID_Cadeteria->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $PedidoACadeteria_edit->RightColumnClass ?>"><div <?php echo $PedidoACadeteria_edit->ID_Cadeteria->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn() && !$PedidoACadeteria->userIDAllow("edit")) { // Non system admin ?>
<span id="el_PedidoACadeteria_ID_Cadeteria">
<span<?php echo $PedidoACadeteria_edit->ID_Cadeteria->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($PedidoACadeteria_edit->ID_Cadeteria->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="PedidoACadeteria" data-field="x_ID_Cadeteria" name="x_ID_Cadeteria" id="x_ID_Cadeteria" value="<?php echo HtmlEncode($PedidoACadeteria_edit->ID_Cadeteria->CurrentValue) ?>">
<?php } else { ?>
<span id="el_PedidoACadeteria_ID_Cadeteria">
<input type="text" data-table="PedidoACadeteria" data-field="x_ID_Cadeteria" name="x_ID_Cadeteria" id="x_ID_Cadeteria" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($PedidoACadeteria_edit->ID_Cadeteria->getPlaceHolder()) ?>" value="<?php echo $PedidoACadeteria_edit->ID_Cadeteria->EditValue ?>"<?php echo $PedidoACadeteria_edit->ID_Cadeteria->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $PedidoACadeteria_edit->ID_Cadeteria->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$PedidoACadeteria_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $PedidoACadeteria_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $PedidoACadeteria_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$PedidoACadeteria_edit->showPageFooter();
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
$PedidoACadeteria_edit->terminate();
?>