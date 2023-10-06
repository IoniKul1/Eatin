<?php
namespace PHPMaker2020\EATIN_BO;
?>
<?php if ($Restaurant->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_Restaurantmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($Restaurant->ID->Visible) { // ID ?>
		<tr id="r_ID">
			<td class="<?php echo $Restaurant->TableLeftColumnClass ?>"><?php echo $Restaurant->ID->caption() ?></td>
			<td <?php echo $Restaurant->ID->cellAttributes() ?>>
<span id="el_Restaurant_ID">
<span<?php echo $Restaurant->ID->viewAttributes() ?>><?php echo $Restaurant->ID->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Restaurant->ID_State->Visible) { // ID_State ?>
		<tr id="r_ID_State">
			<td class="<?php echo $Restaurant->TableLeftColumnClass ?>"><?php echo $Restaurant->ID_State->caption() ?></td>
			<td <?php echo $Restaurant->ID_State->cellAttributes() ?>>
<span id="el_Restaurant_ID_State">
<span<?php echo $Restaurant->ID_State->viewAttributes() ?>><?php echo $Restaurant->ID_State->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Restaurant->Nombre->Visible) { // Nombre ?>
		<tr id="r_Nombre">
			<td class="<?php echo $Restaurant->TableLeftColumnClass ?>"><?php echo $Restaurant->Nombre->caption() ?></td>
			<td <?php echo $Restaurant->Nombre->cellAttributes() ?>>
<span id="el_Restaurant_Nombre">
<span<?php echo $Restaurant->Nombre->viewAttributes() ?>><?php echo $Restaurant->Nombre->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Restaurant->Address->Visible) { // Address ?>
		<tr id="r_Address">
			<td class="<?php echo $Restaurant->TableLeftColumnClass ?>"><?php echo $Restaurant->Address->caption() ?></td>
			<td <?php echo $Restaurant->Address->cellAttributes() ?>>
<span id="el_Restaurant_Address">
<span<?php echo $Restaurant->Address->viewAttributes() ?>><?php echo $Restaurant->Address->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Restaurant->Deactivated->Visible) { // Deactivated ?>
		<tr id="r_Deactivated">
			<td class="<?php echo $Restaurant->TableLeftColumnClass ?>"><?php echo $Restaurant->Deactivated->caption() ?></td>
			<td <?php echo $Restaurant->Deactivated->cellAttributes() ?>>
<span id="el_Restaurant_Deactivated">
<span<?php echo $Restaurant->Deactivated->viewAttributes() ?>><?php echo $Restaurant->Deactivated->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Restaurant->Suspended->Visible) { // Suspended ?>
		<tr id="r_Suspended">
			<td class="<?php echo $Restaurant->TableLeftColumnClass ?>"><?php echo $Restaurant->Suspended->caption() ?></td>
			<td <?php echo $Restaurant->Suspended->cellAttributes() ?>>
<span id="el_Restaurant_Suspended">
<span<?php echo $Restaurant->Suspended->viewAttributes() ?>><?php echo $Restaurant->Suspended->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Restaurant->_Email->Visible) { // Email ?>
		<tr id="r__Email">
			<td class="<?php echo $Restaurant->TableLeftColumnClass ?>"><?php echo $Restaurant->_Email->caption() ?></td>
			<td <?php echo $Restaurant->_Email->cellAttributes() ?>>
<span id="el_Restaurant__Email">
<span<?php echo $Restaurant->_Email->viewAttributes() ?>><?php echo $Restaurant->_Email->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Restaurant->Password->Visible) { // Password ?>
		<tr id="r_Password">
			<td class="<?php echo $Restaurant->TableLeftColumnClass ?>"><?php echo $Restaurant->Password->caption() ?></td>
			<td <?php echo $Restaurant->Password->cellAttributes() ?>>
<span id="el_Restaurant_Password">
<span<?php echo $Restaurant->Password->viewAttributes() ?>><?php echo $Restaurant->Password->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Restaurant->SplashImg->Visible) { // SplashImg ?>
		<tr id="r_SplashImg">
			<td class="<?php echo $Restaurant->TableLeftColumnClass ?>"><?php echo $Restaurant->SplashImg->caption() ?></td>
			<td <?php echo $Restaurant->SplashImg->cellAttributes() ?>>
<span id="el_Restaurant_SplashImg">
<span><?php echo GetFileViewTag($Restaurant->SplashImg, $Restaurant->SplashImg->getViewValue(), FALSE) ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Restaurant->LogoSize1->Visible) { // LogoSize1 ?>
		<tr id="r_LogoSize1">
			<td class="<?php echo $Restaurant->TableLeftColumnClass ?>"><?php echo $Restaurant->LogoSize1->caption() ?></td>
			<td <?php echo $Restaurant->LogoSize1->cellAttributes() ?>>
<span id="el_Restaurant_LogoSize1">
<span><?php echo GetFileViewTag($Restaurant->LogoSize1, $Restaurant->LogoSize1->getViewValue(), FALSE) ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Restaurant->LogoSize2->Visible) { // LogoSize2 ?>
		<tr id="r_LogoSize2">
			<td class="<?php echo $Restaurant->TableLeftColumnClass ?>"><?php echo $Restaurant->LogoSize2->caption() ?></td>
			<td <?php echo $Restaurant->LogoSize2->cellAttributes() ?>>
<span id="el_Restaurant_LogoSize2">
<span><?php echo GetFileViewTag($Restaurant->LogoSize2, $Restaurant->LogoSize2->getViewValue(), FALSE) ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Restaurant->AppCSS->Visible) { // AppCSS ?>
		<tr id="r_AppCSS">
			<td class="<?php echo $Restaurant->TableLeftColumnClass ?>"><?php echo $Restaurant->AppCSS->caption() ?></td>
			<td <?php echo $Restaurant->AppCSS->cellAttributes() ?>>
<span id="el_Restaurant_AppCSS">
<span<?php echo $Restaurant->AppCSS->viewAttributes() ?>><?php echo GetFileViewTag($Restaurant->AppCSS, $Restaurant->AppCSS->getViewValue(), FALSE) ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($Restaurant->SplashVideo->Visible) { // SplashVideo ?>
		<tr id="r_SplashVideo">
			<td class="<?php echo $Restaurant->TableLeftColumnClass ?>"><?php echo $Restaurant->SplashVideo->caption() ?></td>
			<td <?php echo $Restaurant->SplashVideo->cellAttributes() ?>>
<span id="el_Restaurant_SplashVideo">
<span<?php echo $Restaurant->SplashVideo->viewAttributes() ?>><?php echo GetFileViewTag($Restaurant->SplashVideo, $Restaurant->SplashVideo->getViewValue(), FALSE) ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>