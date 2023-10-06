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
$Cadete_edit = new Cadete_edit();

// Run the page
$Cadete_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Cadete_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fCadeteedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fCadeteedit = currentForm = new ew.Form("fCadeteedit", "edit");

	// Validate form
	fCadeteedit.validate = function() {
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
			<?php if ($Cadete_edit->ID->Required) { ?>
				elm = this.getElements("x" + infix + "_ID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadete_edit->ID->caption(), $Cadete_edit->ID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Cadete_edit->FechaCreacion->Required) { ?>
				elm = this.getElements("x" + infix + "_FechaCreacion");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadete_edit->FechaCreacion->caption(), $Cadete_edit->FechaCreacion->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_FechaCreacion");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Cadete_edit->FechaCreacion->errorMessage()) ?>");
			<?php if ($Cadete_edit->ID_Cadeteria->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_Cadeteria");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadete_edit->ID_Cadeteria->caption(), $Cadete_edit->ID_Cadeteria->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ID_Cadeteria");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Cadete_edit->ID_Cadeteria->errorMessage()) ?>");
			<?php if ($Cadete_edit->ID_Status->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_Status");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadete_edit->ID_Status->caption(), $Cadete_edit->ID_Status->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ID_Status");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Cadete_edit->ID_Status->errorMessage()) ?>");
			<?php if ($Cadete_edit->ID_CurrentStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_CurrentStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadete_edit->ID_CurrentStatus->caption(), $Cadete_edit->ID_CurrentStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ID_CurrentStatus");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Cadete_edit->ID_CurrentStatus->errorMessage()) ?>");
			<?php if ($Cadete_edit->Nombre->Required) { ?>
				elm = this.getElements("x" + infix + "_Nombre");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadete_edit->Nombre->caption(), $Cadete_edit->Nombre->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Cadete_edit->Apellido->Required) { ?>
				elm = this.getElements("x" + infix + "_Apellido");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadete_edit->Apellido->caption(), $Cadete_edit->Apellido->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Cadete_edit->DNI->Required) { ?>
				elm = this.getElements("x" + infix + "_DNI");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadete_edit->DNI->caption(), $Cadete_edit->DNI->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Cadete_edit->Celular->Required) { ?>
				elm = this.getElements("x" + infix + "_Celular");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadete_edit->Celular->caption(), $Cadete_edit->Celular->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Cadete_edit->Domicilio->Required) { ?>
				elm = this.getElements("x" + infix + "_Domicilio");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadete_edit->Domicilio->caption(), $Cadete_edit->Domicilio->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Cadete_edit->RealLat->Required) { ?>
				elm = this.getElements("x" + infix + "_RealLat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadete_edit->RealLat->caption(), $Cadete_edit->RealLat->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_RealLat");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Cadete_edit->RealLat->errorMessage()) ?>");
			<?php if ($Cadete_edit->RealLon->Required) { ?>
				elm = this.getElements("x" + infix + "_RealLon");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadete_edit->RealLon->caption(), $Cadete_edit->RealLon->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_RealLon");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Cadete_edit->RealLon->errorMessage()) ?>");
			<?php if ($Cadete_edit->EstimatedLat->Required) { ?>
				elm = this.getElements("x" + infix + "_EstimatedLat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadete_edit->EstimatedLat->caption(), $Cadete_edit->EstimatedLat->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EstimatedLat");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Cadete_edit->EstimatedLat->errorMessage()) ?>");
			<?php if ($Cadete_edit->EstimatedLon->Required) { ?>
				elm = this.getElements("x" + infix + "_EstimatedLon");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadete_edit->EstimatedLon->caption(), $Cadete_edit->EstimatedLon->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EstimatedLon");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Cadete_edit->EstimatedLon->errorMessage()) ?>");
			<?php if ($Cadete_edit->LUDesde->Required) { ?>
				elm = this.getElements("x" + infix + "_LUDesde");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadete_edit->LUDesde->caption(), $Cadete_edit->LUDesde->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LUDesde");
				if (elm && !ew.checkTime(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Cadete_edit->LUDesde->errorMessage()) ?>");
			<?php if ($Cadete_edit->LUHasta->Required) { ?>
				elm = this.getElements("x" + infix + "_LUHasta");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadete_edit->LUHasta->caption(), $Cadete_edit->LUHasta->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LUHasta");
				if (elm && !ew.checkTime(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Cadete_edit->LUHasta->errorMessage()) ?>");
			<?php if ($Cadete_edit->MADesde->Required) { ?>
				elm = this.getElements("x" + infix + "_MADesde");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadete_edit->MADesde->caption(), $Cadete_edit->MADesde->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_MADesde");
				if (elm && !ew.checkTime(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Cadete_edit->MADesde->errorMessage()) ?>");
			<?php if ($Cadete_edit->MAHasta->Required) { ?>
				elm = this.getElements("x" + infix + "_MAHasta");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadete_edit->MAHasta->caption(), $Cadete_edit->MAHasta->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_MAHasta");
				if (elm && !ew.checkTime(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Cadete_edit->MAHasta->errorMessage()) ?>");
			<?php if ($Cadete_edit->MIEDesde->Required) { ?>
				elm = this.getElements("x" + infix + "_MIEDesde");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadete_edit->MIEDesde->caption(), $Cadete_edit->MIEDesde->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_MIEDesde");
				if (elm && !ew.checkTime(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Cadete_edit->MIEDesde->errorMessage()) ?>");
			<?php if ($Cadete_edit->MIEHasta->Required) { ?>
				elm = this.getElements("x" + infix + "_MIEHasta");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadete_edit->MIEHasta->caption(), $Cadete_edit->MIEHasta->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_MIEHasta");
				if (elm && !ew.checkTime(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Cadete_edit->MIEHasta->errorMessage()) ?>");
			<?php if ($Cadete_edit->JUEDesde->Required) { ?>
				elm = this.getElements("x" + infix + "_JUEDesde");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadete_edit->JUEDesde->caption(), $Cadete_edit->JUEDesde->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_JUEDesde");
				if (elm && !ew.checkTime(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Cadete_edit->JUEDesde->errorMessage()) ?>");
			<?php if ($Cadete_edit->JUEHasta->Required) { ?>
				elm = this.getElements("x" + infix + "_JUEHasta");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadete_edit->JUEHasta->caption(), $Cadete_edit->JUEHasta->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_JUEHasta");
				if (elm && !ew.checkTime(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Cadete_edit->JUEHasta->errorMessage()) ?>");
			<?php if ($Cadete_edit->VIEDesde->Required) { ?>
				elm = this.getElements("x" + infix + "_VIEDesde");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadete_edit->VIEDesde->caption(), $Cadete_edit->VIEDesde->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_VIEDesde");
				if (elm && !ew.checkTime(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Cadete_edit->VIEDesde->errorMessage()) ?>");
			<?php if ($Cadete_edit->VIEHasta->Required) { ?>
				elm = this.getElements("x" + infix + "_VIEHasta");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadete_edit->VIEHasta->caption(), $Cadete_edit->VIEHasta->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_VIEHasta");
				if (elm && !ew.checkTime(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Cadete_edit->VIEHasta->errorMessage()) ?>");
			<?php if ($Cadete_edit->SABDesde->Required) { ?>
				elm = this.getElements("x" + infix + "_SABDesde");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadete_edit->SABDesde->caption(), $Cadete_edit->SABDesde->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_SABDesde");
				if (elm && !ew.checkTime(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Cadete_edit->SABDesde->errorMessage()) ?>");
			<?php if ($Cadete_edit->SABHasta->Required) { ?>
				elm = this.getElements("x" + infix + "_SABHasta");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadete_edit->SABHasta->caption(), $Cadete_edit->SABHasta->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_SABHasta");
				if (elm && !ew.checkTime(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Cadete_edit->SABHasta->errorMessage()) ?>");
			<?php if ($Cadete_edit->DOMDesde->Required) { ?>
				elm = this.getElements("x" + infix + "_DOMDesde");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadete_edit->DOMDesde->caption(), $Cadete_edit->DOMDesde->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DOMDesde");
				if (elm && !ew.checkTime(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Cadete_edit->DOMDesde->errorMessage()) ?>");
			<?php if ($Cadete_edit->DOMHasta->Required) { ?>
				elm = this.getElements("x" + infix + "_DOMHasta");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadete_edit->DOMHasta->caption(), $Cadete_edit->DOMHasta->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DOMHasta");
				if (elm && !ew.checkTime(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Cadete_edit->DOMHasta->errorMessage()) ?>");
			<?php if ($Cadete_edit->Foto->Required) { ?>
				elm = this.getElements("x" + infix + "_Foto");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadete_edit->Foto->caption(), $Cadete_edit->Foto->RequiredErrorMessage)) ?>");
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
	fCadeteedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fCadeteedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fCadeteedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $Cadete_edit->showPageHeader(); ?>
<?php
$Cadete_edit->showMessage();
?>
<form name="fCadeteedit" id="fCadeteedit" class="<?php echo $Cadete_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Cadete">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$Cadete_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Cadete_edit->ID->Visible) { // ID ?>
	<div id="r_ID" class="form-group row">
		<label id="elh_Cadete_ID" class="<?php echo $Cadete_edit->LeftColumnClass ?>"><?php echo $Cadete_edit->ID->caption() ?><?php echo $Cadete_edit->ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadete_edit->RightColumnClass ?>"><div <?php echo $Cadete_edit->ID->cellAttributes() ?>>
<span id="el_Cadete_ID">
<span<?php echo $Cadete_edit->ID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Cadete_edit->ID->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="Cadete" data-field="x_ID" name="x_ID" id="x_ID" value="<?php echo HtmlEncode($Cadete_edit->ID->CurrentValue) ?>">
<?php echo $Cadete_edit->ID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadete_edit->FechaCreacion->Visible) { // FechaCreacion ?>
	<div id="r_FechaCreacion" class="form-group row">
		<label id="elh_Cadete_FechaCreacion" for="x_FechaCreacion" class="<?php echo $Cadete_edit->LeftColumnClass ?>"><?php echo $Cadete_edit->FechaCreacion->caption() ?><?php echo $Cadete_edit->FechaCreacion->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadete_edit->RightColumnClass ?>"><div <?php echo $Cadete_edit->FechaCreacion->cellAttributes() ?>>
<span id="el_Cadete_FechaCreacion">
<input type="text" data-table="Cadete" data-field="x_FechaCreacion" name="x_FechaCreacion" id="x_FechaCreacion" maxlength="8" placeholder="<?php echo HtmlEncode($Cadete_edit->FechaCreacion->getPlaceHolder()) ?>" value="<?php echo $Cadete_edit->FechaCreacion->EditValue ?>"<?php echo $Cadete_edit->FechaCreacion->editAttributes() ?>>
<?php if (!$Cadete_edit->FechaCreacion->ReadOnly && !$Cadete_edit->FechaCreacion->Disabled && !isset($Cadete_edit->FechaCreacion->EditAttrs["readonly"]) && !isset($Cadete_edit->FechaCreacion->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fCadeteedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fCadeteedit", "x_FechaCreacion", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $Cadete_edit->FechaCreacion->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadete_edit->ID_Cadeteria->Visible) { // ID_Cadeteria ?>
	<div id="r_ID_Cadeteria" class="form-group row">
		<label id="elh_Cadete_ID_Cadeteria" for="x_ID_Cadeteria" class="<?php echo $Cadete_edit->LeftColumnClass ?>"><?php echo $Cadete_edit->ID_Cadeteria->caption() ?><?php echo $Cadete_edit->ID_Cadeteria->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadete_edit->RightColumnClass ?>"><div <?php echo $Cadete_edit->ID_Cadeteria->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn() && !$Cadete->userIDAllow("edit")) { // Non system admin ?>
<span id="el_Cadete_ID_Cadeteria">
<span<?php echo $Cadete_edit->ID_Cadeteria->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Cadete_edit->ID_Cadeteria->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="Cadete" data-field="x_ID_Cadeteria" name="x_ID_Cadeteria" id="x_ID_Cadeteria" value="<?php echo HtmlEncode($Cadete_edit->ID_Cadeteria->CurrentValue) ?>">
<?php } else { ?>
<span id="el_Cadete_ID_Cadeteria">
<input type="text" data-table="Cadete" data-field="x_ID_Cadeteria" name="x_ID_Cadeteria" id="x_ID_Cadeteria" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Cadete_edit->ID_Cadeteria->getPlaceHolder()) ?>" value="<?php echo $Cadete_edit->ID_Cadeteria->EditValue ?>"<?php echo $Cadete_edit->ID_Cadeteria->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $Cadete_edit->ID_Cadeteria->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadete_edit->ID_Status->Visible) { // ID_Status ?>
	<div id="r_ID_Status" class="form-group row">
		<label id="elh_Cadete_ID_Status" for="x_ID_Status" class="<?php echo $Cadete_edit->LeftColumnClass ?>"><?php echo $Cadete_edit->ID_Status->caption() ?><?php echo $Cadete_edit->ID_Status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadete_edit->RightColumnClass ?>"><div <?php echo $Cadete_edit->ID_Status->cellAttributes() ?>>
<span id="el_Cadete_ID_Status">
<input type="text" data-table="Cadete" data-field="x_ID_Status" name="x_ID_Status" id="x_ID_Status" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Cadete_edit->ID_Status->getPlaceHolder()) ?>" value="<?php echo $Cadete_edit->ID_Status->EditValue ?>"<?php echo $Cadete_edit->ID_Status->editAttributes() ?>>
</span>
<?php echo $Cadete_edit->ID_Status->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadete_edit->ID_CurrentStatus->Visible) { // ID_CurrentStatus ?>
	<div id="r_ID_CurrentStatus" class="form-group row">
		<label id="elh_Cadete_ID_CurrentStatus" for="x_ID_CurrentStatus" class="<?php echo $Cadete_edit->LeftColumnClass ?>"><?php echo $Cadete_edit->ID_CurrentStatus->caption() ?><?php echo $Cadete_edit->ID_CurrentStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadete_edit->RightColumnClass ?>"><div <?php echo $Cadete_edit->ID_CurrentStatus->cellAttributes() ?>>
<span id="el_Cadete_ID_CurrentStatus">
<input type="text" data-table="Cadete" data-field="x_ID_CurrentStatus" name="x_ID_CurrentStatus" id="x_ID_CurrentStatus" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Cadete_edit->ID_CurrentStatus->getPlaceHolder()) ?>" value="<?php echo $Cadete_edit->ID_CurrentStatus->EditValue ?>"<?php echo $Cadete_edit->ID_CurrentStatus->editAttributes() ?>>
</span>
<?php echo $Cadete_edit->ID_CurrentStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadete_edit->Nombre->Visible) { // Nombre ?>
	<div id="r_Nombre" class="form-group row">
		<label id="elh_Cadete_Nombre" for="x_Nombre" class="<?php echo $Cadete_edit->LeftColumnClass ?>"><?php echo $Cadete_edit->Nombre->caption() ?><?php echo $Cadete_edit->Nombre->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadete_edit->RightColumnClass ?>"><div <?php echo $Cadete_edit->Nombre->cellAttributes() ?>>
<span id="el_Cadete_Nombre">
<input type="text" data-table="Cadete" data-field="x_Nombre" name="x_Nombre" id="x_Nombre" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Cadete_edit->Nombre->getPlaceHolder()) ?>" value="<?php echo $Cadete_edit->Nombre->EditValue ?>"<?php echo $Cadete_edit->Nombre->editAttributes() ?>>
</span>
<?php echo $Cadete_edit->Nombre->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadete_edit->Apellido->Visible) { // Apellido ?>
	<div id="r_Apellido" class="form-group row">
		<label id="elh_Cadete_Apellido" for="x_Apellido" class="<?php echo $Cadete_edit->LeftColumnClass ?>"><?php echo $Cadete_edit->Apellido->caption() ?><?php echo $Cadete_edit->Apellido->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadete_edit->RightColumnClass ?>"><div <?php echo $Cadete_edit->Apellido->cellAttributes() ?>>
<span id="el_Cadete_Apellido">
<input type="text" data-table="Cadete" data-field="x_Apellido" name="x_Apellido" id="x_Apellido" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Cadete_edit->Apellido->getPlaceHolder()) ?>" value="<?php echo $Cadete_edit->Apellido->EditValue ?>"<?php echo $Cadete_edit->Apellido->editAttributes() ?>>
</span>
<?php echo $Cadete_edit->Apellido->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadete_edit->DNI->Visible) { // DNI ?>
	<div id="r_DNI" class="form-group row">
		<label id="elh_Cadete_DNI" for="x_DNI" class="<?php echo $Cadete_edit->LeftColumnClass ?>"><?php echo $Cadete_edit->DNI->caption() ?><?php echo $Cadete_edit->DNI->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadete_edit->RightColumnClass ?>"><div <?php echo $Cadete_edit->DNI->cellAttributes() ?>>
<span id="el_Cadete_DNI">
<input type="text" data-table="Cadete" data-field="x_DNI" name="x_DNI" id="x_DNI" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Cadete_edit->DNI->getPlaceHolder()) ?>" value="<?php echo $Cadete_edit->DNI->EditValue ?>"<?php echo $Cadete_edit->DNI->editAttributes() ?>>
</span>
<?php echo $Cadete_edit->DNI->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadete_edit->Celular->Visible) { // Celular ?>
	<div id="r_Celular" class="form-group row">
		<label id="elh_Cadete_Celular" for="x_Celular" class="<?php echo $Cadete_edit->LeftColumnClass ?>"><?php echo $Cadete_edit->Celular->caption() ?><?php echo $Cadete_edit->Celular->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadete_edit->RightColumnClass ?>"><div <?php echo $Cadete_edit->Celular->cellAttributes() ?>>
<span id="el_Cadete_Celular">
<input type="text" data-table="Cadete" data-field="x_Celular" name="x_Celular" id="x_Celular" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Cadete_edit->Celular->getPlaceHolder()) ?>" value="<?php echo $Cadete_edit->Celular->EditValue ?>"<?php echo $Cadete_edit->Celular->editAttributes() ?>>
</span>
<?php echo $Cadete_edit->Celular->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadete_edit->Domicilio->Visible) { // Domicilio ?>
	<div id="r_Domicilio" class="form-group row">
		<label id="elh_Cadete_Domicilio" for="x_Domicilio" class="<?php echo $Cadete_edit->LeftColumnClass ?>"><?php echo $Cadete_edit->Domicilio->caption() ?><?php echo $Cadete_edit->Domicilio->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadete_edit->RightColumnClass ?>"><div <?php echo $Cadete_edit->Domicilio->cellAttributes() ?>>
<span id="el_Cadete_Domicilio">
<input type="text" data-table="Cadete" data-field="x_Domicilio" name="x_Domicilio" id="x_Domicilio" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($Cadete_edit->Domicilio->getPlaceHolder()) ?>" value="<?php echo $Cadete_edit->Domicilio->EditValue ?>"<?php echo $Cadete_edit->Domicilio->editAttributes() ?>>
</span>
<?php echo $Cadete_edit->Domicilio->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadete_edit->RealLat->Visible) { // RealLat ?>
	<div id="r_RealLat" class="form-group row">
		<label id="elh_Cadete_RealLat" for="x_RealLat" class="<?php echo $Cadete_edit->LeftColumnClass ?>"><?php echo $Cadete_edit->RealLat->caption() ?><?php echo $Cadete_edit->RealLat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadete_edit->RightColumnClass ?>"><div <?php echo $Cadete_edit->RealLat->cellAttributes() ?>>
<span id="el_Cadete_RealLat">
<input type="text" data-table="Cadete" data-field="x_RealLat" name="x_RealLat" id="x_RealLat" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Cadete_edit->RealLat->getPlaceHolder()) ?>" value="<?php echo $Cadete_edit->RealLat->EditValue ?>"<?php echo $Cadete_edit->RealLat->editAttributes() ?>>
</span>
<?php echo $Cadete_edit->RealLat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadete_edit->RealLon->Visible) { // RealLon ?>
	<div id="r_RealLon" class="form-group row">
		<label id="elh_Cadete_RealLon" for="x_RealLon" class="<?php echo $Cadete_edit->LeftColumnClass ?>"><?php echo $Cadete_edit->RealLon->caption() ?><?php echo $Cadete_edit->RealLon->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadete_edit->RightColumnClass ?>"><div <?php echo $Cadete_edit->RealLon->cellAttributes() ?>>
<span id="el_Cadete_RealLon">
<input type="text" data-table="Cadete" data-field="x_RealLon" name="x_RealLon" id="x_RealLon" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Cadete_edit->RealLon->getPlaceHolder()) ?>" value="<?php echo $Cadete_edit->RealLon->EditValue ?>"<?php echo $Cadete_edit->RealLon->editAttributes() ?>>
</span>
<?php echo $Cadete_edit->RealLon->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadete_edit->EstimatedLat->Visible) { // EstimatedLat ?>
	<div id="r_EstimatedLat" class="form-group row">
		<label id="elh_Cadete_EstimatedLat" for="x_EstimatedLat" class="<?php echo $Cadete_edit->LeftColumnClass ?>"><?php echo $Cadete_edit->EstimatedLat->caption() ?><?php echo $Cadete_edit->EstimatedLat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadete_edit->RightColumnClass ?>"><div <?php echo $Cadete_edit->EstimatedLat->cellAttributes() ?>>
<span id="el_Cadete_EstimatedLat">
<input type="text" data-table="Cadete" data-field="x_EstimatedLat" name="x_EstimatedLat" id="x_EstimatedLat" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Cadete_edit->EstimatedLat->getPlaceHolder()) ?>" value="<?php echo $Cadete_edit->EstimatedLat->EditValue ?>"<?php echo $Cadete_edit->EstimatedLat->editAttributes() ?>>
</span>
<?php echo $Cadete_edit->EstimatedLat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadete_edit->EstimatedLon->Visible) { // EstimatedLon ?>
	<div id="r_EstimatedLon" class="form-group row">
		<label id="elh_Cadete_EstimatedLon" for="x_EstimatedLon" class="<?php echo $Cadete_edit->LeftColumnClass ?>"><?php echo $Cadete_edit->EstimatedLon->caption() ?><?php echo $Cadete_edit->EstimatedLon->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadete_edit->RightColumnClass ?>"><div <?php echo $Cadete_edit->EstimatedLon->cellAttributes() ?>>
<span id="el_Cadete_EstimatedLon">
<input type="text" data-table="Cadete" data-field="x_EstimatedLon" name="x_EstimatedLon" id="x_EstimatedLon" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Cadete_edit->EstimatedLon->getPlaceHolder()) ?>" value="<?php echo $Cadete_edit->EstimatedLon->EditValue ?>"<?php echo $Cadete_edit->EstimatedLon->editAttributes() ?>>
</span>
<?php echo $Cadete_edit->EstimatedLon->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadete_edit->LUDesde->Visible) { // LUDesde ?>
	<div id="r_LUDesde" class="form-group row">
		<label id="elh_Cadete_LUDesde" for="x_LUDesde" class="<?php echo $Cadete_edit->LeftColumnClass ?>"><?php echo $Cadete_edit->LUDesde->caption() ?><?php echo $Cadete_edit->LUDesde->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadete_edit->RightColumnClass ?>"><div <?php echo $Cadete_edit->LUDesde->cellAttributes() ?>>
<span id="el_Cadete_LUDesde">
<input type="text" data-table="Cadete" data-field="x_LUDesde" name="x_LUDesde" id="x_LUDesde" maxlength="8" placeholder="<?php echo HtmlEncode($Cadete_edit->LUDesde->getPlaceHolder()) ?>" value="<?php echo $Cadete_edit->LUDesde->EditValue ?>"<?php echo $Cadete_edit->LUDesde->editAttributes() ?>>
</span>
<?php echo $Cadete_edit->LUDesde->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadete_edit->LUHasta->Visible) { // LUHasta ?>
	<div id="r_LUHasta" class="form-group row">
		<label id="elh_Cadete_LUHasta" for="x_LUHasta" class="<?php echo $Cadete_edit->LeftColumnClass ?>"><?php echo $Cadete_edit->LUHasta->caption() ?><?php echo $Cadete_edit->LUHasta->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadete_edit->RightColumnClass ?>"><div <?php echo $Cadete_edit->LUHasta->cellAttributes() ?>>
<span id="el_Cadete_LUHasta">
<input type="text" data-table="Cadete" data-field="x_LUHasta" name="x_LUHasta" id="x_LUHasta" maxlength="8" placeholder="<?php echo HtmlEncode($Cadete_edit->LUHasta->getPlaceHolder()) ?>" value="<?php echo $Cadete_edit->LUHasta->EditValue ?>"<?php echo $Cadete_edit->LUHasta->editAttributes() ?>>
</span>
<?php echo $Cadete_edit->LUHasta->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadete_edit->MADesde->Visible) { // MADesde ?>
	<div id="r_MADesde" class="form-group row">
		<label id="elh_Cadete_MADesde" for="x_MADesde" class="<?php echo $Cadete_edit->LeftColumnClass ?>"><?php echo $Cadete_edit->MADesde->caption() ?><?php echo $Cadete_edit->MADesde->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadete_edit->RightColumnClass ?>"><div <?php echo $Cadete_edit->MADesde->cellAttributes() ?>>
<span id="el_Cadete_MADesde">
<input type="text" data-table="Cadete" data-field="x_MADesde" name="x_MADesde" id="x_MADesde" maxlength="8" placeholder="<?php echo HtmlEncode($Cadete_edit->MADesde->getPlaceHolder()) ?>" value="<?php echo $Cadete_edit->MADesde->EditValue ?>"<?php echo $Cadete_edit->MADesde->editAttributes() ?>>
</span>
<?php echo $Cadete_edit->MADesde->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadete_edit->MAHasta->Visible) { // MAHasta ?>
	<div id="r_MAHasta" class="form-group row">
		<label id="elh_Cadete_MAHasta" for="x_MAHasta" class="<?php echo $Cadete_edit->LeftColumnClass ?>"><?php echo $Cadete_edit->MAHasta->caption() ?><?php echo $Cadete_edit->MAHasta->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadete_edit->RightColumnClass ?>"><div <?php echo $Cadete_edit->MAHasta->cellAttributes() ?>>
<span id="el_Cadete_MAHasta">
<input type="text" data-table="Cadete" data-field="x_MAHasta" name="x_MAHasta" id="x_MAHasta" maxlength="8" placeholder="<?php echo HtmlEncode($Cadete_edit->MAHasta->getPlaceHolder()) ?>" value="<?php echo $Cadete_edit->MAHasta->EditValue ?>"<?php echo $Cadete_edit->MAHasta->editAttributes() ?>>
</span>
<?php echo $Cadete_edit->MAHasta->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadete_edit->MIEDesde->Visible) { // MIEDesde ?>
	<div id="r_MIEDesde" class="form-group row">
		<label id="elh_Cadete_MIEDesde" for="x_MIEDesde" class="<?php echo $Cadete_edit->LeftColumnClass ?>"><?php echo $Cadete_edit->MIEDesde->caption() ?><?php echo $Cadete_edit->MIEDesde->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadete_edit->RightColumnClass ?>"><div <?php echo $Cadete_edit->MIEDesde->cellAttributes() ?>>
<span id="el_Cadete_MIEDesde">
<input type="text" data-table="Cadete" data-field="x_MIEDesde" name="x_MIEDesde" id="x_MIEDesde" maxlength="8" placeholder="<?php echo HtmlEncode($Cadete_edit->MIEDesde->getPlaceHolder()) ?>" value="<?php echo $Cadete_edit->MIEDesde->EditValue ?>"<?php echo $Cadete_edit->MIEDesde->editAttributes() ?>>
</span>
<?php echo $Cadete_edit->MIEDesde->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadete_edit->MIEHasta->Visible) { // MIEHasta ?>
	<div id="r_MIEHasta" class="form-group row">
		<label id="elh_Cadete_MIEHasta" for="x_MIEHasta" class="<?php echo $Cadete_edit->LeftColumnClass ?>"><?php echo $Cadete_edit->MIEHasta->caption() ?><?php echo $Cadete_edit->MIEHasta->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadete_edit->RightColumnClass ?>"><div <?php echo $Cadete_edit->MIEHasta->cellAttributes() ?>>
<span id="el_Cadete_MIEHasta">
<input type="text" data-table="Cadete" data-field="x_MIEHasta" name="x_MIEHasta" id="x_MIEHasta" maxlength="8" placeholder="<?php echo HtmlEncode($Cadete_edit->MIEHasta->getPlaceHolder()) ?>" value="<?php echo $Cadete_edit->MIEHasta->EditValue ?>"<?php echo $Cadete_edit->MIEHasta->editAttributes() ?>>
</span>
<?php echo $Cadete_edit->MIEHasta->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadete_edit->JUEDesde->Visible) { // JUEDesde ?>
	<div id="r_JUEDesde" class="form-group row">
		<label id="elh_Cadete_JUEDesde" for="x_JUEDesde" class="<?php echo $Cadete_edit->LeftColumnClass ?>"><?php echo $Cadete_edit->JUEDesde->caption() ?><?php echo $Cadete_edit->JUEDesde->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadete_edit->RightColumnClass ?>"><div <?php echo $Cadete_edit->JUEDesde->cellAttributes() ?>>
<span id="el_Cadete_JUEDesde">
<input type="text" data-table="Cadete" data-field="x_JUEDesde" name="x_JUEDesde" id="x_JUEDesde" maxlength="8" placeholder="<?php echo HtmlEncode($Cadete_edit->JUEDesde->getPlaceHolder()) ?>" value="<?php echo $Cadete_edit->JUEDesde->EditValue ?>"<?php echo $Cadete_edit->JUEDesde->editAttributes() ?>>
</span>
<?php echo $Cadete_edit->JUEDesde->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadete_edit->JUEHasta->Visible) { // JUEHasta ?>
	<div id="r_JUEHasta" class="form-group row">
		<label id="elh_Cadete_JUEHasta" for="x_JUEHasta" class="<?php echo $Cadete_edit->LeftColumnClass ?>"><?php echo $Cadete_edit->JUEHasta->caption() ?><?php echo $Cadete_edit->JUEHasta->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadete_edit->RightColumnClass ?>"><div <?php echo $Cadete_edit->JUEHasta->cellAttributes() ?>>
<span id="el_Cadete_JUEHasta">
<input type="text" data-table="Cadete" data-field="x_JUEHasta" name="x_JUEHasta" id="x_JUEHasta" maxlength="8" placeholder="<?php echo HtmlEncode($Cadete_edit->JUEHasta->getPlaceHolder()) ?>" value="<?php echo $Cadete_edit->JUEHasta->EditValue ?>"<?php echo $Cadete_edit->JUEHasta->editAttributes() ?>>
</span>
<?php echo $Cadete_edit->JUEHasta->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadete_edit->VIEDesde->Visible) { // VIEDesde ?>
	<div id="r_VIEDesde" class="form-group row">
		<label id="elh_Cadete_VIEDesde" for="x_VIEDesde" class="<?php echo $Cadete_edit->LeftColumnClass ?>"><?php echo $Cadete_edit->VIEDesde->caption() ?><?php echo $Cadete_edit->VIEDesde->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadete_edit->RightColumnClass ?>"><div <?php echo $Cadete_edit->VIEDesde->cellAttributes() ?>>
<span id="el_Cadete_VIEDesde">
<input type="text" data-table="Cadete" data-field="x_VIEDesde" name="x_VIEDesde" id="x_VIEDesde" maxlength="8" placeholder="<?php echo HtmlEncode($Cadete_edit->VIEDesde->getPlaceHolder()) ?>" value="<?php echo $Cadete_edit->VIEDesde->EditValue ?>"<?php echo $Cadete_edit->VIEDesde->editAttributes() ?>>
</span>
<?php echo $Cadete_edit->VIEDesde->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadete_edit->VIEHasta->Visible) { // VIEHasta ?>
	<div id="r_VIEHasta" class="form-group row">
		<label id="elh_Cadete_VIEHasta" for="x_VIEHasta" class="<?php echo $Cadete_edit->LeftColumnClass ?>"><?php echo $Cadete_edit->VIEHasta->caption() ?><?php echo $Cadete_edit->VIEHasta->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadete_edit->RightColumnClass ?>"><div <?php echo $Cadete_edit->VIEHasta->cellAttributes() ?>>
<span id="el_Cadete_VIEHasta">
<input type="text" data-table="Cadete" data-field="x_VIEHasta" name="x_VIEHasta" id="x_VIEHasta" maxlength="8" placeholder="<?php echo HtmlEncode($Cadete_edit->VIEHasta->getPlaceHolder()) ?>" value="<?php echo $Cadete_edit->VIEHasta->EditValue ?>"<?php echo $Cadete_edit->VIEHasta->editAttributes() ?>>
</span>
<?php echo $Cadete_edit->VIEHasta->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadete_edit->SABDesde->Visible) { // SABDesde ?>
	<div id="r_SABDesde" class="form-group row">
		<label id="elh_Cadete_SABDesde" for="x_SABDesde" class="<?php echo $Cadete_edit->LeftColumnClass ?>"><?php echo $Cadete_edit->SABDesde->caption() ?><?php echo $Cadete_edit->SABDesde->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadete_edit->RightColumnClass ?>"><div <?php echo $Cadete_edit->SABDesde->cellAttributes() ?>>
<span id="el_Cadete_SABDesde">
<input type="text" data-table="Cadete" data-field="x_SABDesde" name="x_SABDesde" id="x_SABDesde" maxlength="8" placeholder="<?php echo HtmlEncode($Cadete_edit->SABDesde->getPlaceHolder()) ?>" value="<?php echo $Cadete_edit->SABDesde->EditValue ?>"<?php echo $Cadete_edit->SABDesde->editAttributes() ?>>
</span>
<?php echo $Cadete_edit->SABDesde->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadete_edit->SABHasta->Visible) { // SABHasta ?>
	<div id="r_SABHasta" class="form-group row">
		<label id="elh_Cadete_SABHasta" for="x_SABHasta" class="<?php echo $Cadete_edit->LeftColumnClass ?>"><?php echo $Cadete_edit->SABHasta->caption() ?><?php echo $Cadete_edit->SABHasta->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadete_edit->RightColumnClass ?>"><div <?php echo $Cadete_edit->SABHasta->cellAttributes() ?>>
<span id="el_Cadete_SABHasta">
<input type="text" data-table="Cadete" data-field="x_SABHasta" name="x_SABHasta" id="x_SABHasta" maxlength="8" placeholder="<?php echo HtmlEncode($Cadete_edit->SABHasta->getPlaceHolder()) ?>" value="<?php echo $Cadete_edit->SABHasta->EditValue ?>"<?php echo $Cadete_edit->SABHasta->editAttributes() ?>>
</span>
<?php echo $Cadete_edit->SABHasta->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadete_edit->DOMDesde->Visible) { // DOMDesde ?>
	<div id="r_DOMDesde" class="form-group row">
		<label id="elh_Cadete_DOMDesde" for="x_DOMDesde" class="<?php echo $Cadete_edit->LeftColumnClass ?>"><?php echo $Cadete_edit->DOMDesde->caption() ?><?php echo $Cadete_edit->DOMDesde->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadete_edit->RightColumnClass ?>"><div <?php echo $Cadete_edit->DOMDesde->cellAttributes() ?>>
<span id="el_Cadete_DOMDesde">
<input type="text" data-table="Cadete" data-field="x_DOMDesde" name="x_DOMDesde" id="x_DOMDesde" maxlength="8" placeholder="<?php echo HtmlEncode($Cadete_edit->DOMDesde->getPlaceHolder()) ?>" value="<?php echo $Cadete_edit->DOMDesde->EditValue ?>"<?php echo $Cadete_edit->DOMDesde->editAttributes() ?>>
</span>
<?php echo $Cadete_edit->DOMDesde->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadete_edit->DOMHasta->Visible) { // DOMHasta ?>
	<div id="r_DOMHasta" class="form-group row">
		<label id="elh_Cadete_DOMHasta" for="x_DOMHasta" class="<?php echo $Cadete_edit->LeftColumnClass ?>"><?php echo $Cadete_edit->DOMHasta->caption() ?><?php echo $Cadete_edit->DOMHasta->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadete_edit->RightColumnClass ?>"><div <?php echo $Cadete_edit->DOMHasta->cellAttributes() ?>>
<span id="el_Cadete_DOMHasta">
<input type="text" data-table="Cadete" data-field="x_DOMHasta" name="x_DOMHasta" id="x_DOMHasta" maxlength="8" placeholder="<?php echo HtmlEncode($Cadete_edit->DOMHasta->getPlaceHolder()) ?>" value="<?php echo $Cadete_edit->DOMHasta->EditValue ?>"<?php echo $Cadete_edit->DOMHasta->editAttributes() ?>>
</span>
<?php echo $Cadete_edit->DOMHasta->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadete_edit->Foto->Visible) { // Foto ?>
	<div id="r_Foto" class="form-group row">
		<label id="elh_Cadete_Foto" for="x_Foto" class="<?php echo $Cadete_edit->LeftColumnClass ?>"><?php echo $Cadete_edit->Foto->caption() ?><?php echo $Cadete_edit->Foto->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadete_edit->RightColumnClass ?>"><div <?php echo $Cadete_edit->Foto->cellAttributes() ?>>
<span id="el_Cadete_Foto">
<input type="text" data-table="Cadete" data-field="x_Foto" name="x_Foto" id="x_Foto" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($Cadete_edit->Foto->getPlaceHolder()) ?>" value="<?php echo $Cadete_edit->Foto->EditValue ?>"<?php echo $Cadete_edit->Foto->editAttributes() ?>>
</span>
<?php echo $Cadete_edit->Foto->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Cadete_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $Cadete_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $Cadete_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$Cadete_edit->showPageFooter();
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
$Cadete_edit->terminate();
?>