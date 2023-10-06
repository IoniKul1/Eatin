<?php
namespace PHPMaker2020\EATIN_BO;
?>
<?php if ($Client->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_Clientmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($Client->ID->Visible) { // ID ?>
		<tr id="r_ID">
			<td class="<?php echo $Client->TableLeftColumnClass ?>"><?php echo $Client->ID->caption() ?></td>
			<td <?php echo $Client->ID->cellAttributes() ?>>
<span id="el_Client_ID">
<span<?php echo $Client->ID->viewAttributes() ?>><?php echo $Client->ID->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Client->ID_Restaurant->Visible) { // ID_Restaurant ?>
		<tr id="r_ID_Restaurant">
			<td class="<?php echo $Client->TableLeftColumnClass ?>"><?php echo $Client->ID_Restaurant->caption() ?></td>
			<td <?php echo $Client->ID_Restaurant->cellAttributes() ?>>
<span id="el_Client_ID_Restaurant">
<span<?php echo $Client->ID_Restaurant->viewAttributes() ?>><?php echo $Client->ID_Restaurant->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Client->FirstName->Visible) { // FirstName ?>
		<tr id="r_FirstName">
			<td class="<?php echo $Client->TableLeftColumnClass ?>"><?php echo $Client->FirstName->caption() ?></td>
			<td <?php echo $Client->FirstName->cellAttributes() ?>>
<span id="el_Client_FirstName">
<span<?php echo $Client->FirstName->viewAttributes() ?>><?php echo $Client->FirstName->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Client->LastName->Visible) { // LastName ?>
		<tr id="r_LastName">
			<td class="<?php echo $Client->TableLeftColumnClass ?>"><?php echo $Client->LastName->caption() ?></td>
			<td <?php echo $Client->LastName->cellAttributes() ?>>
<span id="el_Client_LastName">
<span<?php echo $Client->LastName->viewAttributes() ?>><?php echo $Client->LastName->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Client->_Email->Visible) { // Email ?>
		<tr id="r__Email">
			<td class="<?php echo $Client->TableLeftColumnClass ?>"><?php echo $Client->_Email->caption() ?></td>
			<td <?php echo $Client->_Email->cellAttributes() ?>>
<span id="el_Client__Email">
<span<?php echo $Client->_Email->viewAttributes() ?>><?php echo $Client->_Email->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Client->Phone->Visible) { // Phone ?>
		<tr id="r_Phone">
			<td class="<?php echo $Client->TableLeftColumnClass ?>"><?php echo $Client->Phone->caption() ?></td>
			<td <?php echo $Client->Phone->cellAttributes() ?>>
<span id="el_Client_Phone">
<span<?php echo $Client->Phone->viewAttributes() ?>><?php echo $Client->Phone->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Client->Banned->Visible) { // Banned ?>
		<tr id="r_Banned">
			<td class="<?php echo $Client->TableLeftColumnClass ?>"><?php echo $Client->Banned->caption() ?></td>
			<td <?php echo $Client->Banned->cellAttributes() ?>>
<span id="el_Client_Banned">
<span<?php echo $Client->Banned->viewAttributes() ?>><?php echo $Client->Banned->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Client->ClientToken->Visible) { // ClientToken ?>
		<tr id="r_ClientToken">
			<td class="<?php echo $Client->TableLeftColumnClass ?>"><?php echo $Client->ClientToken->caption() ?></td>
			<td <?php echo $Client->ClientToken->cellAttributes() ?>>
<span id="el_Client_ClientToken">
<span<?php echo $Client->ClientToken->viewAttributes() ?>><?php echo $Client->ClientToken->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>