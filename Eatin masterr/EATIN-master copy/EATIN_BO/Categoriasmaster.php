<?php
namespace PHPMaker2020\EATIN_BO;
?>
<?php if ($Categorias->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_Categoriasmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($Categorias->ID->Visible) { // ID ?>
		<tr id="r_ID">
			<td class="<?php echo $Categorias->TableLeftColumnClass ?>"><?php echo $Categorias->ID->caption() ?></td>
			<td <?php echo $Categorias->ID->cellAttributes() ?>>
<span id="el_Categorias_ID">
<span<?php echo $Categorias->ID->viewAttributes() ?>><?php echo $Categorias->ID->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Categorias->ID_Restaurant->Visible) { // ID_Restaurant ?>
		<tr id="r_ID_Restaurant">
			<td class="<?php echo $Categorias->TableLeftColumnClass ?>"><?php echo $Categorias->ID_Restaurant->caption() ?></td>
			<td <?php echo $Categorias->ID_Restaurant->cellAttributes() ?>>
<span id="el_Categorias_ID_Restaurant">
<span<?php echo $Categorias->ID_Restaurant->viewAttributes() ?>><?php echo $Categorias->ID_Restaurant->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Categorias->Active->Visible) { // Active ?>
		<tr id="r_Active">
			<td class="<?php echo $Categorias->TableLeftColumnClass ?>"><?php echo $Categorias->Active->caption() ?></td>
			<td <?php echo $Categorias->Active->cellAttributes() ?>>
<span id="el_Categorias_Active">
<span<?php echo $Categorias->Active->viewAttributes() ?>><?php echo $Categorias->Active->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Categorias->Nombre->Visible) { // Nombre ?>
		<tr id="r_Nombre">
			<td class="<?php echo $Categorias->TableLeftColumnClass ?>"><?php echo $Categorias->Nombre->caption() ?></td>
			<td <?php echo $Categorias->Nombre->cellAttributes() ?>>
<span id="el_Categorias_Nombre">
<span<?php echo $Categorias->Nombre->viewAttributes() ?>><?php echo $Categorias->Nombre->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Categorias->NombreEN->Visible) { // NombreEN ?>
		<tr id="r_NombreEN">
			<td class="<?php echo $Categorias->TableLeftColumnClass ?>"><?php echo $Categorias->NombreEN->caption() ?></td>
			<td <?php echo $Categorias->NombreEN->cellAttributes() ?>>
<span id="el_Categorias_NombreEN">
<span<?php echo $Categorias->NombreEN->viewAttributes() ?>><?php echo $Categorias->NombreEN->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>