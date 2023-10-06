<?php
namespace PHPMaker2020\EATIN_BO;
?>
<?php if ($Pedido->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_Pedidomaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($Pedido->ID->Visible) { // ID ?>
		<tr id="r_ID">
			<td class="<?php echo $Pedido->TableLeftColumnClass ?>"><?php echo $Pedido->ID->caption() ?></td>
			<td <?php echo $Pedido->ID->cellAttributes() ?>>
<span id="el_Pedido_ID">
<span<?php echo $Pedido->ID->viewAttributes() ?>><?php echo $Pedido->ID->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Pedido->ID_Client->Visible) { // ID_Client ?>
		<tr id="r_ID_Client">
			<td class="<?php echo $Pedido->TableLeftColumnClass ?>"><?php echo $Pedido->ID_Client->caption() ?></td>
			<td <?php echo $Pedido->ID_Client->cellAttributes() ?>>
<span id="el_Pedido_ID_Client">
<span<?php echo $Pedido->ID_Client->viewAttributes() ?>><?php if (!EmptyString($Pedido->ID_Client->getViewValue()) && $Pedido->ID_Client->linkAttributes() != "") { ?>
<a<?php echo $Pedido->ID_Client->linkAttributes() ?>><?php echo $Pedido->ID_Client->getViewValue() ?></a>
<?php } else { ?>
<?php echo $Pedido->ID_Client->getViewValue() ?>
<?php } ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Pedido->ID_Status->Visible) { // ID_Status ?>
		<tr id="r_ID_Status">
			<td class="<?php echo $Pedido->TableLeftColumnClass ?>"><?php echo $Pedido->ID_Status->caption() ?></td>
			<td <?php echo $Pedido->ID_Status->cellAttributes() ?>>
<span id="el_Pedido_ID_Status">
<span<?php echo $Pedido->ID_Status->viewAttributes() ?>><?php echo $Pedido->ID_Status->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Pedido->ID_Restaurant->Visible) { // ID_Restaurant ?>
		<tr id="r_ID_Restaurant">
			<td class="<?php echo $Pedido->TableLeftColumnClass ?>"><?php echo $Pedido->ID_Restaurant->caption() ?></td>
			<td <?php echo $Pedido->ID_Restaurant->cellAttributes() ?>>
<span id="el_Pedido_ID_Restaurant">
<span<?php echo $Pedido->ID_Restaurant->viewAttributes() ?>><?php echo $Pedido->ID_Restaurant->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Pedido->DateCreation->Visible) { // DateCreation ?>
		<tr id="r_DateCreation">
			<td class="<?php echo $Pedido->TableLeftColumnClass ?>"><?php echo $Pedido->DateCreation->caption() ?></td>
			<td <?php echo $Pedido->DateCreation->cellAttributes() ?>>
<span id="el_Pedido_DateCreation">
<span<?php echo $Pedido->DateCreation->viewAttributes() ?>><?php echo $Pedido->DateCreation->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Pedido->DateLastUpdate->Visible) { // DateLastUpdate ?>
		<tr id="r_DateLastUpdate">
			<td class="<?php echo $Pedido->TableLeftColumnClass ?>"><?php echo $Pedido->DateLastUpdate->caption() ?></td>
			<td <?php echo $Pedido->DateLastUpdate->cellAttributes() ?>>
<span id="el_Pedido_DateLastUpdate">
<span<?php echo $Pedido->DateLastUpdate->viewAttributes() ?>><?php echo $Pedido->DateLastUpdate->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Pedido->ID_Table->Visible) { // ID_Table ?>
		<tr id="r_ID_Table">
			<td class="<?php echo $Pedido->TableLeftColumnClass ?>"><?php echo $Pedido->ID_Table->caption() ?></td>
			<td <?php echo $Pedido->ID_Table->cellAttributes() ?>>
<span id="el_Pedido_ID_Table">
<span<?php echo $Pedido->ID_Table->viewAttributes() ?>><?php echo $Pedido->ID_Table->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>