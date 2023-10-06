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
$Cadete_add = new Cadete_add();

// Run the page
$Cadete_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Cadete_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fCadeteadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fCadeteadd = currentForm = new ew.Form("fCadeteadd", "add");

	// Validate form
	fCadeteadd.validate = function() {
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
			<?php if ($Cadete_add->FechaCreacion->Required) { ?>
				elm = this.getElements("x" + infix + "_FechaCreacion");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadete_add->FechaCreacion->caption(), $Cadete_add->FechaCreacion->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_FechaCreacion");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Cadete_add->FechaCreacion->errorMessage()) ?>");
			<?php if ($Cadete_add->ID_Cadeteria->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_Cadeteria");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadete_add->ID_Cadeteria->caption(), $Cadete_add->ID_Cadeteria->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ID_Cadeteria");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Cadete_add->ID_Cadeteria->errorMessage()) ?>");
			<?php if ($Cadete_add->ID_Status->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_Status");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadete_add->ID_Status->caption(), $Cadete_add->ID_Status->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ID_Status");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Cadete_add->ID_Status->errorMessage()) ?>");
			<?php if ($Cadete_add->ID_CurrentStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_CurrentStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadete_add->ID_CurrentStatus->caption(), $Cadete_add->ID_CurrentStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ID_CurrentStatus");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Cadete_add->ID_CurrentStatus->errorMessage()) ?>");
			<?php if ($Cadete_add->Nombre->Required) { ?>
				elm = this.getElements("x" + infix + "_Nombre");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadete_add->Nombre->caption(), $Cadete_add->Nombre->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Cadete_add->Apellido->Required) { ?>
				elm = this.getElements("x" + infix + "_Apellido");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadete_add->Apellido->caption(), $Cadete_add->Apellido->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Cadete_add->DNI->Required) { ?>
				elm = this.getElements("x" + infix + "_DNI");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadete_add->DNI->caption(), $Cadete_add->DNI->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Cadete_add->Celular->Required) { ?>
				elm = this.getElements("x" + infix + "_Celular");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadete_add->Celular->caption(), $Cadete_add->Celular->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Cadete_add->Domicilio->Required) { ?>
				elm = this.getElements("x" + infix + "_Domicilio");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadete_add->Domicilio->caption(), $Cadete_add->Domicilio->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($Cadete_add->RealLat->Required) { ?>
				elm = this.getElements("x" + infix + "_RealLat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadete_add->RealLat->caption(), $Cadete_add->RealLat->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_RealLat");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Cadete_add->RealLat->errorMessage()) ?>");
			<?php if ($Cadete_add->RealLon->Required) { ?>
				elm = this.getElements("x" + infix + "_RealLon");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadete_add->RealLon->caption(), $Cadete_add->RealLon->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_RealLon");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Cadete_add->RealLon->errorMessage()) ?>");
			<?php if ($Cadete_add->EstimatedLat->Required) { ?>
				elm = this.getElements("x" + infix + "_EstimatedLat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadete_add->EstimatedLat->caption(), $Cadete_add->EstimatedLat->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EstimatedLat");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Cadete_add->EstimatedLat->errorMessage()) ?>");
			<?php if ($Cadete_add->EstimatedLon->Required) { ?>
				elm = this.getElements("x" + infix + "_EstimatedLon");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadete_add->EstimatedLon->caption(), $Cadete_add->EstimatedLon->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EstimatedLon");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Cadete_add->EstimatedLon->errorMessage()) ?>");
			<?php if ($Cadete_add->LUDesde->Required) { ?>
				elm = this.getElements("x" + infix + "_LUDesde");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadete_add->LUDesde->caption(), $Cadete_add->LUDesde->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LUDesde");
				if (elm && !ew.checkTime(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Cadete_add->LUDesde->errorMessage()) ?>");
			<?php if ($Cadete_add->LUHasta->Required) { ?>
				elm = this.getElements("x" + infix + "_LUHasta");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadete_add->LUHasta->caption(), $Cadete_add->LUHasta->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LUHasta");
				if (elm && !ew.checkTime(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Cadete_add->LUHasta->errorMessage()) ?>");
			<?php if ($Cadete_add->MADesde->Required) { ?>
				elm = this.getElements("x" + infix + "_MADesde");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadete_add->MADesde->caption(), $Cadete_add->MADesde->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_MADesde");
				if (elm && !ew.checkTime(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Cadete_add->MADesde->errorMessage()) ?>");
			<?php if ($Cadete_add->MAHasta->Required) { ?>
				elm = this.getElements("x" + infix + "_MAHasta");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadete_add->MAHasta->caption(), $Cadete_add->MAHasta->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_MAHasta");
				if (elm && !ew.checkTime(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Cadete_add->MAHasta->errorMessage()) ?>");
			<?php if ($Cadete_add->MIEDesde->Required) { ?>
				elm = this.getElements("x" + infix + "_MIEDesde");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadete_add->MIEDesde->caption(), $Cadete_add->MIEDesde->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_MIEDesde");
				if (elm && !ew.checkTime(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Cadete_add->MIEDesde->errorMessage()) ?>");
			<?php if ($Cadete_add->MIEHasta->Required) { ?>
				elm = this.getElements("x" + infix + "_MIEHasta");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadete_add->MIEHasta->caption(), $Cadete_add->MIEHasta->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_MIEHasta");
				if (elm && !ew.checkTime(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Cadete_add->MIEHasta->errorMessage()) ?>");
			<?php if ($Cadete_add->JUEDesde->Required) { ?>
				elm = this.getElements("x" + infix + "_JUEDesde");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadete_add->JUEDesde->caption(), $Cadete_add->JUEDesde->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_JUEDesde");
				if (elm && !ew.checkTime(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Cadete_add->JUEDesde->errorMessage()) ?>");
			<?php if ($Cadete_add->JUEHasta->Required) { ?>
				elm = this.getElements("x" + infix + "_JUEHasta");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadete_add->JUEHasta->caption(), $Cadete_add->JUEHasta->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_JUEHasta");
				if (elm && !ew.checkTime(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Cadete_add->JUEHasta->errorMessage()) ?>");
			<?php if ($Cadete_add->VIEDesde->Required) { ?>
				elm = this.getElements("x" + infix + "_VIEDesde");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadete_add->VIEDesde->caption(), $Cadete_add->VIEDesde->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_VIEDesde");
				if (elm && !ew.checkTime(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Cadete_add->VIEDesde->errorMessage()) ?>");
			<?php if ($Cadete_add->VIEHasta->Required) { ?>
				elm = this.getElements("x" + infix + "_VIEHasta");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadete_add->VIEHasta->caption(), $Cadete_add->VIEHasta->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_VIEHasta");
				if (elm && !ew.checkTime(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Cadete_add->VIEHasta->errorMessage()) ?>");
			<?php if ($Cadete_add->SABDesde->Required) { ?>
				elm = this.getElements("x" + infix + "_SABDesde");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadete_add->SABDesde->caption(), $Cadete_add->SABDesde->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_SABDesde");
				if (elm && !ew.checkTime(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Cadete_add->SABDesde->errorMessage()) ?>");
			<?php if ($Cadete_add->SABHasta->Required) { ?>
				elm = this.getElements("x" + infix + "_SABHasta");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadete_add->SABHasta->caption(), $Cadete_add->SABHasta->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_SABHasta");
				if (elm && !ew.checkTime(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Cadete_add->SABHasta->errorMessage()) ?>");
			<?php if ($Cadete_add->DOMDesde->Required) { ?>
				elm = this.getElements("x" + infix + "_DOMDesde");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadete_add->DOMDesde->caption(), $Cadete_add->DOMDesde->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DOMDesde");
				if (elm && !ew.checkTime(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Cadete_add->DOMDesde->errorMessage()) ?>");
			<?php if ($Cadete_add->DOMHasta->Required) { ?>
				elm = this.getElements("x" + infix + "_DOMHasta");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadete_add->DOMHasta->caption(), $Cadete_add->DOMHasta->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DOMHasta");
				if (elm && !ew.checkTime(elm.value))
					return this.onError(elm, "<?php echo JsEncode($Cadete_add->DOMHasta->errorMessage()) ?>");
			<?php if ($Cadete_add->Foto->Required) { ?>
				elm = this.getElements("x" + infix + "_Foto");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $Cadete_add->Foto->caption(), $Cadete_add->Foto->RequiredErrorMessage)) ?>");
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
	fCadeteadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fCadeteadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fCadeteadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $Cadete_add->showPageHeader(); ?>
<?php
$Cadete_add->showMessage();
?>
<form name="fCadeteadd" id="fCadeteadd" class="<?php echo $Cadete_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="Cadete">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$Cadete_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Cadete_add->FechaCreacion->Visible) { // FechaCreacion ?>
	<div id="r_FechaCreacion" class="form-group row">
		<label id="elh_Cadete_FechaCreacion" for="x_FechaCreacion" class="<?php echo $Cadete_add->LeftColumnClass ?>"><?php echo $Cadete_add->FechaCreacion->caption() ?><?php echo $Cadete_add->FechaCreacion->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadete_add->RightColumnClass ?>"><div <?php echo $Cadete_add->FechaCreacion->cellAttributes() ?>>
<span id="el_Cadete_FechaCreacion">
<input type="text" data-table="Cadete" data-field="x_FechaCreacion" name="x_FechaCreacion" id="x_FechaCreacion" maxlength="8" placeholder="<?php echo HtmlEncode($Cadete_add->FechaCreacion->getPlaceHolder()) ?>" value="<?php echo $Cadete_add->FechaCreacion->EditValue ?>"<?php echo $Cadete_add->FechaCreacion->editAttributes() ?>>
<?php if (!$Cadete_add->FechaCreacion->ReadOnly && !$Cadete_add->FechaCreacion->Disabled && !isset($Cadete_add->FechaCreacion->EditAttrs["readonly"]) && !isset($Cadete_add->FechaCreacion->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fCadeteadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fCadeteadd", "x_FechaCreacion", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $Cadete_add->FechaCreacion->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadete_add->ID_Cadeteria->Visible) { // ID_Cadeteria ?>
	<div id="r_ID_Cadeteria" class="form-group row">
		<label id="elh_Cadete_ID_Cadeteria" for="x_ID_Cadeteria" class="<?php echo $Cadete_add->LeftColumnClass ?>"><?php echo $Cadete_add->ID_Cadeteria->caption() ?><?php echo $Cadete_add->ID_Cadeteria->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadete_add->RightColumnClass ?>"><div <?php echo $Cadete_add->ID_Cadeteria->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn() && !$Cadete->userIDAllow("add")) { // Non system admin ?>
<span id="el_Cadete_ID_Cadeteria">
<span<?php echo $Cadete_add->ID_Cadeteria->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($Cadete_add->ID_Cadeteria->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="Cadete" data-field="x_ID_Cadeteria" name="x_ID_Cadeteria" id="x_ID_Cadeteria" value="<?php echo HtmlEncode($Cadete_add->ID_Cadeteria->CurrentValue) ?>">
<?php } else { ?>
<span id="el_Cadete_ID_Cadeteria">
<input type="text" data-table="Cadete" data-field="x_ID_Cadeteria" name="x_ID_Cadeteria" id="x_ID_Cadeteria" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Cadete_add->ID_Cadeteria->getPlaceHolder()) ?>" value="<?php echo $Cadete_add->ID_Cadeteria->EditValue ?>"<?php echo $Cadete_add->ID_Cadeteria->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $Cadete_add->ID_Cadeteria->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadete_add->ID_Status->Visible) { // ID_Status ?>
	<div id="r_ID_Status" class="form-group row">
		<label id="elh_Cadete_ID_Status" for="x_ID_Status" class="<?php echo $Cadete_add->LeftColumnClass ?>"><?php echo $Cadete_add->ID_Status->caption() ?><?php echo $Cadete_add->ID_Status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadete_add->RightColumnClass ?>"><div <?php echo $Cadete_add->ID_Status->cellAttributes() ?>>
<span id="el_Cadete_ID_Status">
<input type="text" data-table="Cadete" data-field="x_ID_Status" name="x_ID_Status" id="x_ID_Status" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Cadete_add->ID_Status->getPlaceHolder()) ?>" value="<?php echo $Cadete_add->ID_Status->EditValue ?>"<?php echo $Cadete_add->ID_Status->editAttributes() ?>>
</span>
<?php echo $Cadete_add->ID_Status->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadete_add->ID_CurrentStatus->Visible) { // ID_CurrentStatus ?>
	<div id="r_ID_CurrentStatus" class="form-group row">
		<label id="elh_Cadete_ID_CurrentStatus" for="x_ID_CurrentStatus" class="<?php echo $Cadete_add->LeftColumnClass ?>"><?php echo $Cadete_add->ID_CurrentStatus->caption() ?><?php echo $Cadete_add->ID_CurrentStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadete_add->RightColumnClass ?>"><div <?php echo $Cadete_add->ID_CurrentStatus->cellAttributes() ?>>
<span id="el_Cadete_ID_CurrentStatus">
<input type="text" data-table="Cadete" data-field="x_ID_CurrentStatus" name="x_ID_CurrentStatus" id="x_ID_CurrentStatus" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Cadete_add->ID_CurrentStatus->getPlaceHolder()) ?>" value="<?php echo $Cadete_add->ID_CurrentStatus->EditValue ?>"<?php echo $Cadete_add->ID_CurrentStatus->editAttributes() ?>>
</span>
<?php echo $Cadete_add->ID_CurrentStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadete_add->Nombre->Visible) { // Nombre ?>
	<div id="r_Nombre" class="form-group row">
		<label id="elh_Cadete_Nombre" for="x_Nombre" class="<?php echo $Cadete_add->LeftColumnClass ?>"><?php echo $Cadete_add->Nombre->caption() ?><?php echo $Cadete_add->Nombre->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadete_add->RightColumnClass ?>"><div <?php echo $Cadete_add->Nombre->cellAttributes() ?>>
<span id="el_Cadete_Nombre">
<input type="text" data-table="Cadete" data-field="x_Nombre" name="x_Nombre" id="x_Nombre" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Cadete_add->Nombre->getPlaceHolder()) ?>" value="<?php echo $Cadete_add->Nombre->EditValue ?>"<?php echo $Cadete_add->Nombre->editAttributes() ?>>
</span>
<?php echo $Cadete_add->Nombre->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadete_add->Apellido->Visible) { // Apellido ?>
	<div id="r_Apellido" class="form-group row">
		<label id="elh_Cadete_Apellido" for="x_Apellido" class="<?php echo $Cadete_add->LeftColumnClass ?>"><?php echo $Cadete_add->Apellido->caption() ?><?php echo $Cadete_add->Apellido->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadete_add->RightColumnClass ?>"><div <?php echo $Cadete_add->Apellido->cellAttributes() ?>>
<span id="el_Cadete_Apellido">
<input type="text" data-table="Cadete" data-field="x_Apellido" name="x_Apellido" id="x_Apellido" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Cadete_add->Apellido->getPlaceHolder()) ?>" value="<?php echo $Cadete_add->Apellido->EditValue ?>"<?php echo $Cadete_add->Apellido->editAttributes() ?>>
</span>
<?php echo $Cadete_add->Apellido->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadete_add->DNI->Visible) { // DNI ?>
	<div id="r_DNI" class="form-group row">
		<label id="elh_Cadete_DNI" for="x_DNI" class="<?php echo $Cadete_add->LeftColumnClass ?>"><?php echo $Cadete_add->DNI->caption() ?><?php echo $Cadete_add->DNI->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadete_add->RightColumnClass ?>"><div <?php echo $Cadete_add->DNI->cellAttributes() ?>>
<span id="el_Cadete_DNI">
<input type="text" data-table="Cadete" data-field="x_DNI" name="x_DNI" id="x_DNI" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Cadete_add->DNI->getPlaceHolder()) ?>" value="<?php echo $Cadete_add->DNI->EditValue ?>"<?php echo $Cadete_add->DNI->editAttributes() ?>>
</span>
<?php echo $Cadete_add->DNI->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadete_add->Celular->Visible) { // Celular ?>
	<div id="r_Celular" class="form-group row">
		<label id="elh_Cadete_Celular" for="x_Celular" class="<?php echo $Cadete_add->LeftColumnClass ?>"><?php echo $Cadete_add->Celular->caption() ?><?php echo $Cadete_add->Celular->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadete_add->RightColumnClass ?>"><div <?php echo $Cadete_add->Celular->cellAttributes() ?>>
<span id="el_Cadete_Celular">
<input type="text" data-table="Cadete" data-field="x_Celular" name="x_Celular" id="x_Celular" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($Cadete_add->Celular->getPlaceHolder()) ?>" value="<?php echo $Cadete_add->Celular->EditValue ?>"<?php echo $Cadete_add->Celular->editAttributes() ?>>
</span>
<?php echo $Cadete_add->Celular->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadete_add->Domicilio->Visible) { // Domicilio ?>
	<div id="r_Domicilio" class="form-group row">
		<label id="elh_Cadete_Domicilio" for="x_Domicilio" class="<?php echo $Cadete_add->LeftColumnClass ?>"><?php echo $Cadete_add->Domicilio->caption() ?><?php echo $Cadete_add->Domicilio->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadete_add->RightColumnClass ?>"><div <?php echo $Cadete_add->Domicilio->cellAttributes() ?>>
<span id="el_Cadete_Domicilio">
<input type="text" data-table="Cadete" data-field="x_Domicilio" name="x_Domicilio" id="x_Domicilio" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($Cadete_add->Domicilio->getPlaceHolder()) ?>" value="<?php echo $Cadete_add->Domicilio->EditValue ?>"<?php echo $Cadete_add->Domicilio->editAttributes() ?>>
</span>
<?php echo $Cadete_add->Domicilio->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadete_add->RealLat->Visible) { // RealLat ?>
	<div id="r_RealLat" class="form-group row">
		<label id="elh_Cadete_RealLat" for="x_RealLat" class="<?php echo $Cadete_add->LeftColumnClass ?>"><?php echo $Cadete_add->RealLat->caption() ?><?php echo $Cadete_add->RealLat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadete_add->RightColumnClass ?>"><div <?php echo $Cadete_add->RealLat->cellAttributes() ?>>
<span id="el_Cadete_RealLat">
<input type="text" data-table="Cadete" data-field="x_RealLat" name="x_RealLat" id="x_RealLat" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Cadete_add->RealLat->getPlaceHolder()) ?>" value="<?php echo $Cadete_add->RealLat->EditValue ?>"<?php echo $Cadete_add->RealLat->editAttributes() ?>>
</span>
<?php echo $Cadete_add->RealLat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadete_add->RealLon->Visible) { // RealLon ?>
	<div id="r_RealLon" class="form-group row">
		<label id="elh_Cadete_RealLon" for="x_RealLon" class="<?php echo $Cadete_add->LeftColumnClass ?>"><?php echo $Cadete_add->RealLon->caption() ?><?php echo $Cadete_add->RealLon->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadete_add->RightColumnClass ?>"><div <?php echo $Cadete_add->RealLon->cellAttributes() ?>>
<span id="el_Cadete_RealLon">
<input type="text" data-table="Cadete" data-field="x_RealLon" name="x_RealLon" id="x_RealLon" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Cadete_add->RealLon->getPlaceHolder()) ?>" value="<?php echo $Cadete_add->RealLon->EditValue ?>"<?php echo $Cadete_add->RealLon->editAttributes() ?>>
</span>
<?php echo $Cadete_add->RealLon->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadete_add->EstimatedLat->Visible) { // EstimatedLat ?>
	<div id="r_EstimatedLat" class="form-group row">
		<label id="elh_Cadete_EstimatedLat" for="x_EstimatedLat" class="<?php echo $Cadete_add->LeftColumnClass ?>"><?php echo $Cadete_add->EstimatedLat->caption() ?><?php echo $Cadete_add->EstimatedLat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadete_add->RightColumnClass ?>"><div <?php echo $Cadete_add->EstimatedLat->cellAttributes() ?>>
<span id="el_Cadete_EstimatedLat">
<input type="text" data-table="Cadete" data-field="x_EstimatedLat" name="x_EstimatedLat" id="x_EstimatedLat" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Cadete_add->EstimatedLat->getPlaceHolder()) ?>" value="<?php echo $Cadete_add->EstimatedLat->EditValue ?>"<?php echo $Cadete_add->EstimatedLat->editAttributes() ?>>
</span>
<?php echo $Cadete_add->EstimatedLat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadete_add->EstimatedLon->Visible) { // EstimatedLon ?>
	<div id="r_EstimatedLon" class="form-group row">
		<label id="elh_Cadete_EstimatedLon" for="x_EstimatedLon" class="<?php echo $Cadete_add->LeftColumnClass ?>"><?php echo $Cadete_add->EstimatedLon->caption() ?><?php echo $Cadete_add->EstimatedLon->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadete_add->RightColumnClass ?>"><div <?php echo $Cadete_add->EstimatedLon->cellAttributes() ?>>
<span id="el_Cadete_EstimatedLon">
<input type="text" data-table="Cadete" data-field="x_EstimatedLon" name="x_EstimatedLon" id="x_EstimatedLon" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($Cadete_add->EstimatedLon->getPlaceHolder()) ?>" value="<?php echo $Cadete_add->EstimatedLon->EditValue ?>"<?php echo $Cadete_add->EstimatedLon->editAttributes() ?>>
</span>
<?php echo $Cadete_add->EstimatedLon->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadete_add->LUDesde->Visible) { // LUDesde ?>
	<div id="r_LUDesde" class="form-group row">
		<label id="elh_Cadete_LUDesde" for="x_LUDesde" class="<?php echo $Cadete_add->LeftColumnClass ?>"><?php echo $Cadete_add->LUDesde->caption() ?><?php echo $Cadete_add->LUDesde->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadete_add->RightColumnClass ?>"><div <?php echo $Cadete_add->LUDesde->cellAttributes() ?>>
<span id="el_Cadete_LUDesde">
<input type="text" data-table="Cadete" data-field="x_LUDesde" name="x_LUDesde" id="x_LUDesde" maxlength="8" placeholder="<?php echo HtmlEncode($Cadete_add->LUDesde->getPlaceHolder()) ?>" value="<?php echo $Cadete_add->LUDesde->EditValue ?>"<?php echo $Cadete_add->LUDesde->editAttributes() ?>>
</span>
<?php echo $Cadete_add->LUDesde->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadete_add->LUHasta->Visible) { // LUHasta ?>
	<div id="r_LUHasta" class="form-group row">
		<label id="elh_Cadete_LUHasta" for="x_LUHasta" class="<?php echo $Cadete_add->LeftColumnClass ?>"><?php echo $Cadete_add->LUHasta->caption() ?><?php echo $Cadete_add->LUHasta->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadete_add->RightColumnClass ?>"><div <?php echo $Cadete_add->LUHasta->cellAttributes() ?>>
<span id="el_Cadete_LUHasta">
<input type="text" data-table="Cadete" data-field="x_LUHasta" name="x_LUHasta" id="x_LUHasta" maxlength="8" placeholder="<?php echo HtmlEncode($Cadete_add->LUHasta->getPlaceHolder()) ?>" value="<?php echo $Cadete_add->LUHasta->EditValue ?>"<?php echo $Cadete_add->LUHasta->editAttributes() ?>>
</span>
<?php echo $Cadete_add->LUHasta->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadete_add->MADesde->Visible) { // MADesde ?>
	<div id="r_MADesde" class="form-group row">
		<label id="elh_Cadete_MADesde" for="x_MADesde" class="<?php echo $Cadete_add->LeftColumnClass ?>"><?php echo $Cadete_add->MADesde->caption() ?><?php echo $Cadete_add->MADesde->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadete_add->RightColumnClass ?>"><div <?php echo $Cadete_add->MADesde->cellAttributes() ?>>
<span id="el_Cadete_MADesde">
<input type="text" data-table="Cadete" data-field="x_MADesde" name="x_MADesde" id="x_MADesde" maxlength="8" placeholder="<?php echo HtmlEncode($Cadete_add->MADesde->getPlaceHolder()) ?>" value="<?php echo $Cadete_add->MADesde->EditValue ?>"<?php echo $Cadete_add->MADesde->editAttributes() ?>>
</span>
<?php echo $Cadete_add->MADesde->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadete_add->MAHasta->Visible) { // MAHasta ?>
	<div id="r_MAHasta" class="form-group row">
		<label id="elh_Cadete_MAHasta" for="x_MAHasta" class="<?php echo $Cadete_add->LeftColumnClass ?>"><?php echo $Cadete_add->MAHasta->caption() ?><?php echo $Cadete_add->MAHasta->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadete_add->RightColumnClass ?>"><div <?php echo $Cadete_add->MAHasta->cellAttributes() ?>>
<span id="el_Cadete_MAHasta">
<input type="text" data-table="Cadete" data-field="x_MAHasta" name="x_MAHasta" id="x_MAHasta" maxlength="8" placeholder="<?php echo HtmlEncode($Cadete_add->MAHasta->getPlaceHolder()) ?>" value="<?php echo $Cadete_add->MAHasta->EditValue ?>"<?php echo $Cadete_add->MAHasta->editAttributes() ?>>
</span>
<?php echo $Cadete_add->MAHasta->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadete_add->MIEDesde->Visible) { // MIEDesde ?>
	<div id="r_MIEDesde" class="form-group row">
		<label id="elh_Cadete_MIEDesde" for="x_MIEDesde" class="<?php echo $Cadete_add->LeftColumnClass ?>"><?php echo $Cadete_add->MIEDesde->caption() ?><?php echo $Cadete_add->MIEDesde->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadete_add->RightColumnClass ?>"><div <?php echo $Cadete_add->MIEDesde->cellAttributes() ?>>
<span id="el_Cadete_MIEDesde">
<input type="text" data-table="Cadete" data-field="x_MIEDesde" name="x_MIEDesde" id="x_MIEDesde" maxlength="8" placeholder="<?php echo HtmlEncode($Cadete_add->MIEDesde->getPlaceHolder()) ?>" value="<?php echo $Cadete_add->MIEDesde->EditValue ?>"<?php echo $Cadete_add->MIEDesde->editAttributes() ?>>
</span>
<?php echo $Cadete_add->MIEDesde->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadete_add->MIEHasta->Visible) { // MIEHasta ?>
	<div id="r_MIEHasta" class="form-group row">
		<label id="elh_Cadete_MIEHasta" for="x_MIEHasta" class="<?php echo $Cadete_add->LeftColumnClass ?>"><?php echo $Cadete_add->MIEHasta->caption() ?><?php echo $Cadete_add->MIEHasta->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadete_add->RightColumnClass ?>"><div <?php echo $Cadete_add->MIEHasta->cellAttributes() ?>>
<span id="el_Cadete_MIEHasta">
<input type="text" data-table="Cadete" data-field="x_MIEHasta" name="x_MIEHasta" id="x_MIEHasta" maxlength="8" placeholder="<?php echo HtmlEncode($Cadete_add->MIEHasta->getPlaceHolder()) ?>" value="<?php echo $Cadete_add->MIEHasta->EditValue ?>"<?php echo $Cadete_add->MIEHasta->editAttributes() ?>>
</span>
<?php echo $Cadete_add->MIEHasta->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadete_add->JUEDesde->Visible) { // JUEDesde ?>
	<div id="r_JUEDesde" class="form-group row">
		<label id="elh_Cadete_JUEDesde" for="x_JUEDesde" class="<?php echo $Cadete_add->LeftColumnClass ?>"><?php echo $Cadete_add->JUEDesde->caption() ?><?php echo $Cadete_add->JUEDesde->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadete_add->RightColumnClass ?>"><div <?php echo $Cadete_add->JUEDesde->cellAttributes() ?>>
<span id="el_Cadete_JUEDesde">
<input type="text" data-table="Cadete" data-field="x_JUEDesde" name="x_JUEDesde" id="x_JUEDesde" maxlength="8" placeholder="<?php echo HtmlEncode($Cadete_add->JUEDesde->getPlaceHolder()) ?>" value="<?php echo $Cadete_add->JUEDesde->EditValue ?>"<?php echo $Cadete_add->JUEDesde->editAttributes() ?>>
</span>
<?php echo $Cadete_add->JUEDesde->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadete_add->JUEHasta->Visible) { // JUEHasta ?>
	<div id="r_JUEHasta" class="form-group row">
		<label id="elh_Cadete_JUEHasta" for="x_JUEHasta" class="<?php echo $Cadete_add->LeftColumnClass ?>"><?php echo $Cadete_add->JUEHasta->caption() ?><?php echo $Cadete_add->JUEHasta->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadete_add->RightColumnClass ?>"><div <?php echo $Cadete_add->JUEHasta->cellAttributes() ?>>
<span id="el_Cadete_JUEHasta">
<input type="text" data-table="Cadete" data-field="x_JUEHasta" name="x_JUEHasta" id="x_JUEHasta" maxlength="8" placeholder="<?php echo HtmlEncode($Cadete_add->JUEHasta->getPlaceHolder()) ?>" value="<?php echo $Cadete_add->JUEHasta->EditValue ?>"<?php echo $Cadete_add->JUEHasta->editAttributes() ?>>
</span>
<?php echo $Cadete_add->JUEHasta->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadete_add->VIEDesde->Visible) { // VIEDesde ?>
	<div id="r_VIEDesde" class="form-group row">
		<label id="elh_Cadete_VIEDesde" for="x_VIEDesde" class="<?php echo $Cadete_add->LeftColumnClass ?>"><?php echo $Cadete_add->VIEDesde->caption() ?><?php echo $Cadete_add->VIEDesde->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadete_add->RightColumnClass ?>"><div <?php echo $Cadete_add->VIEDesde->cellAttributes() ?>>
<span id="el_Cadete_VIEDesde">
<input type="text" data-table="Cadete" data-field="x_VIEDesde" name="x_VIEDesde" id="x_VIEDesde" maxlength="8" placeholder="<?php echo HtmlEncode($Cadete_add->VIEDesde->getPlaceHolder()) ?>" value="<?php echo $Cadete_add->VIEDesde->EditValue ?>"<?php echo $Cadete_add->VIEDesde->editAttributes() ?>>
</span>
<?php echo $Cadete_add->VIEDesde->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadete_add->VIEHasta->Visible) { // VIEHasta ?>
	<div id="r_VIEHasta" class="form-group row">
		<label id="elh_Cadete_VIEHasta" for="x_VIEHasta" class="<?php echo $Cadete_add->LeftColumnClass ?>"><?php echo $Cadete_add->VIEHasta->caption() ?><?php echo $Cadete_add->VIEHasta->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadete_add->RightColumnClass ?>"><div <?php echo $Cadete_add->VIEHasta->cellAttributes() ?>>
<span id="el_Cadete_VIEHasta">
<input type="text" data-table="Cadete" data-field="x_VIEHasta" name="x_VIEHasta" id="x_VIEHasta" maxlength="8" placeholder="<?php echo HtmlEncode($Cadete_add->VIEHasta->getPlaceHolder()) ?>" value="<?php echo $Cadete_add->VIEHasta->EditValue ?>"<?php echo $Cadete_add->VIEHasta->editAttributes() ?>>
</span>
<?php echo $Cadete_add->VIEHasta->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadete_add->SABDesde->Visible) { // SABDesde ?>
	<div id="r_SABDesde" class="form-group row">
		<label id="elh_Cadete_SABDesde" for="x_SABDesde" class="<?php echo $Cadete_add->LeftColumnClass ?>"><?php echo $Cadete_add->SABDesde->caption() ?><?php echo $Cadete_add->SABDesde->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadete_add->RightColumnClass ?>"><div <?php echo $Cadete_add->SABDesde->cellAttributes() ?>>
<span id="el_Cadete_SABDesde">
<input type="text" data-table="Cadete" data-field="x_SABDesde" name="x_SABDesde" id="x_SABDesde" maxlength="8" placeholder="<?php echo HtmlEncode($Cadete_add->SABDesde->getPlaceHolder()) ?>" value="<?php echo $Cadete_add->SABDesde->EditValue ?>"<?php echo $Cadete_add->SABDesde->editAttributes() ?>>
</span>
<?php echo $Cadete_add->SABDesde->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadete_add->SABHasta->Visible) { // SABHasta ?>
	<div id="r_SABHasta" class="form-group row">
		<label id="elh_Cadete_SABHasta" for="x_SABHasta" class="<?php echo $Cadete_add->LeftColumnClass ?>"><?php echo $Cadete_add->SABHasta->caption() ?><?php echo $Cadete_add->SABHasta->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadete_add->RightColumnClass ?>"><div <?php echo $Cadete_add->SABHasta->cellAttributes() ?>>
<span id="el_Cadete_SABHasta">
<input type="text" data-table="Cadete" data-field="x_SABHasta" name="x_SABHasta" id="x_SABHasta" maxlength="8" placeholder="<?php echo HtmlEncode($Cadete_add->SABHasta->getPlaceHolder()) ?>" value="<?php echo $Cadete_add->SABHasta->EditValue ?>"<?php echo $Cadete_add->SABHasta->editAttributes() ?>>
</span>
<?php echo $Cadete_add->SABHasta->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadete_add->DOMDesde->Visible) { // DOMDesde ?>
	<div id="r_DOMDesde" class="form-group row">
		<label id="elh_Cadete_DOMDesde" for="x_DOMDesde" class="<?php echo $Cadete_add->LeftColumnClass ?>"><?php echo $Cadete_add->DOMDesde->caption() ?><?php echo $Cadete_add->DOMDesde->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadete_add->RightColumnClass ?>"><div <?php echo $Cadete_add->DOMDesde->cellAttributes() ?>>
<span id="el_Cadete_DOMDesde">
<input type="text" data-table="Cadete" data-field="x_DOMDesde" name="x_DOMDesde" id="x_DOMDesde" maxlength="8" placeholder="<?php echo HtmlEncode($Cadete_add->DOMDesde->getPlaceHolder()) ?>" value="<?php echo $Cadete_add->DOMDesde->EditValue ?>"<?php echo $Cadete_add->DOMDesde->editAttributes() ?>>
</span>
<?php echo $Cadete_add->DOMDesde->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadete_add->DOMHasta->Visible) { // DOMHasta ?>
	<div id="r_DOMHasta" class="form-group row">
		<label id="elh_Cadete_DOMHasta" for="x_DOMHasta" class="<?php echo $Cadete_add->LeftColumnClass ?>"><?php echo $Cadete_add->DOMHasta->caption() ?><?php echo $Cadete_add->DOMHasta->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadete_add->RightColumnClass ?>"><div <?php echo $Cadete_add->DOMHasta->cellAttributes() ?>>
<span id="el_Cadete_DOMHasta">
<input type="text" data-table="Cadete" data-field="x_DOMHasta" name="x_DOMHasta" id="x_DOMHasta" maxlength="8" placeholder="<?php echo HtmlEncode($Cadete_add->DOMHasta->getPlaceHolder()) ?>" value="<?php echo $Cadete_add->DOMHasta->EditValue ?>"<?php echo $Cadete_add->DOMHasta->editAttributes() ?>>
</span>
<?php echo $Cadete_add->DOMHasta->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($Cadete_add->Foto->Visible) { // Foto ?>
	<div id="r_Foto" class="form-group row">
		<label id="elh_Cadete_Foto" for="x_Foto" class="<?php echo $Cadete_add->LeftColumnClass ?>"><?php echo $Cadete_add->Foto->caption() ?><?php echo $Cadete_add->Foto->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $Cadete_add->RightColumnClass ?>"><div <?php echo $Cadete_add->Foto->cellAttributes() ?>>
<span id="el_Cadete_Foto">
<input type="text" data-table="Cadete" data-field="x_Foto" name="x_Foto" id="x_Foto" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($Cadete_add->Foto->getPlaceHolder()) ?>" value="<?php echo $Cadete_add->Foto->EditValue ?>"<?php echo $Cadete_add->Foto->editAttributes() ?>>
</span>
<?php echo $Cadete_add->Foto->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Cadete_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $Cadete_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $Cadete_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$Cadete_add->showPageFooter();
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
$Cadete_add->terminate();
?>