<?php

//SQLSRC_SPROCS:
//lista de sprocs de SQL Server


$sprocs =
'


{
	

		"Categorias_View":
		{
			"InputParameters": {
				"ID_Restaurant": { "Name":"ID_Restaurant", "Type" : "bigint", "Size" : "8" }
			}
		},

		"Checkin_Add":
		{
			"InputParameters": {
				"ID_Client": { "Name":"ID_Client", "Type" : "bigint", "Size" : "8" },"ID_Restaurant": { "Name":"ID_Restaurant", "Type" : "bigint", "Size" : "8" }
			}
		},

		"Client_GetFromToken":
		{
			"InputParameters": {
				"ID_Restaurant": { "Name":"ID_Restaurant", "Type" : "bigint", "Size" : "8" },"ClientToken": { "Name":"ClientToken", "Type" : "nvarchar", "Size" : "100" }
			}
		},

		"Client_Login":
		{
			"InputParameters": {
				"Email": { "Name":"Email", "Type" : "nvarchar", "Size" : "100" },"Hashpass": { "Name":"Hashpass", "Type" : "nvarchar", "Size" : "100" }
			}
		},

		"Client_LoginWithFacebook":
		{
			"InputParameters": {
				"ID_Restaurant": { "Name":"ID_Restaurant", "Type" : "bigint", "Size" : "8" },"FBID": { "Name":"FBID", "Type" : "nvarchar", "Size" : "100" },"FBToken": { "Name":"FBToken", "Type" : "nvarchar", "Size" : "510" },"FirstName": { "Name":"FirstName", "Type" : "nvarchar", "Size" : "100" },"LastName": { "Name":"LastName", "Type" : "nvarchar", "Size" : "100" },"Phone": { "Name":"Phone", "Type" : "nvarchar", "Size" : "100" }
			}
		},

		"Client_Register":
		{
			"InputParameters": {
				"ID_Restaurant": { "Name":"ID_Restaurant", "Type" : "bigint", "Size" : "8" },"Email": { "Name":"Email", "Type" : "nvarchar", "Size" : "100" },"Hashpass": { "Name":"Hashpass", "Type" : "nvarchar", "Size" : "100" },"FirstName": { "Name":"FirstName", "Type" : "nvarchar", "Size" : "100" },"LastName": { "Name":"LastName", "Type" : "nvarchar", "Size" : "100" },"Phone": { "Name":"Phone", "Type" : "nvarchar", "Size" : "100" }
			}
		},

		"Countries_View":
		{
			"InputParameters": {
				
			}
		},

		"ItemOptions_View":
		{
			"InputParameters": {
				"ID_Item": { "Name":"ID_Item", "Type" : "bigint", "Size" : "8" },"ID_Restaurant": { "Name":"ID_Restaurant", "Type" : "bigint", "Size" : "8" }
			}
		},

		"Items_View":
		{
			"InputParameters": {
				"ID": { "Name":"ID", "Type" : "bigint", "Size" : "8" },"ID_Categorias": { "Name":"ID_Categorias", "Type" : "bigint", "Size" : "8" },"ID_Restaurant": { "Name":"ID_Restaurant", "Type" : "bigint", "Size" : "8" }
			}
		},

		"ItemxPedido_Add":
		{
			"InputParameters": {
				"ID_Pedido": { "Name":"ID_Pedido", "Type" : "bigint", "Size" : "8" },"ID_Item": { "Name":"ID_Item", "Type" : "bigint", "Size" : "8" },"ID_Restaurant": { "Name":"ID_Restaurant", "Type" : "bigint", "Size" : "8" },"ID_Client": { "Name":"ID_Client", "Type" : "bigint", "Size" : "8" },"Comments": { "Name":"Comments", "Type" : "nvarchar", "Size" : "200" },"Compartir": { "Name":"Compartir", "Type" : "int", "Size" : "4" },"Cantidad": { "Name":"Cantidad", "Type" : "int", "Size" : "4" }
			}
		},

		"ItemxPedidoxItemOptions_Add":
		{
			"InputParameters": {
				"ID_ItemxPedido": { "Name":"ID_ItemxPedido", "Type" : "bigint", "Size" : "8" },"ID_ItemxOptions": { "Name":"ID_ItemxOptions", "Type" : "bigint", "Size" : "8" },"ID_Restaurant": { "Name":"ID_Restaurant", "Type" : "bigint", "Size" : "8" },"Cantidad": { "Name":"Cantidad", "Type" : "int", "Size" : "4" }
			}
		},

		"ItemxPedidoxItemOptions_Del":
		{
			"InputParameters": {
				"ID": { "Name":"ID", "Type" : "bigint", "Size" : "8" }
			}
		},

		"Pedido_Add":
		{
			"InputParameters": {
				"ID_Client": { "Name":"ID_Client", "Type" : "bigint", "Size" : "8" },"ID_Status": { "Name":"ID_Status", "Type" : "bigint", "Size" : "8" },"ID_Restaurant": { "Name":"ID_Restaurant", "Type" : "bigint", "Size" : "8" },"ID_Table": { "Name":"ID_Table", "Type" : "bigint", "Size" : "8" },"ID_PedidoAccion": { "Name":"ID_PedidoAccion", "Type" : "bigint", "Size" : "8" }
			}
		},

		"Restaurant_View":
		{
			"InputParameters": {
				"ID": { "Name":"ID", "Type" : "bigint", "Size" : "8" }
			}
		},

		"State_View":
		{
			"InputParameters": {
				
			}
		},

		"Table_View":
		{
			"InputParameters": {
				"ID_Restaurant": { "Name":"ID_Restaurant", "Type" : "bigint", "Size" : "8" },"ID": { "Name":"ID", "Type" : "bigint", "Size" : "8" }
			}
		}
	
}



';


$sprocs = json_decode($sprocs);


