document.domain = 'gobozu.com';

var CONTENT_URI = "https://eatin_content.gobozu.com/EATIN_BO/files/";


//ONSEN

window.fn = {};

window.fn.toggleMenu = function () {
	document.getElementById('appSplitter').right.toggle();
};

window.fn.loadView = function (index) {
	document.getElementById('appTabbar').setActiveTab(index);
	document.getElementById('sidemenu').close();
};

window.fn.loadLink = function (url) {
	window.open(url, '_blank');
};

window.fn.pushPage = function (page, anim) {
	if (anim)
	{
		document.getElementById('appNavigator').pushPage(page.id, { data: { title: page.title }, animation: anim });
	}
	else 
	{
		document.getElementById('appNavigator').pushPage(page.id, { data: { title: page.title } });
	}
};

window.fn.popPage = function (page, anim) {
	document.getElementById('appNavigator').popPage();
};
//end of ONSEN


var mipedidoencurso = '';

var currentPedido = {};
currentPedido.items = [];

var RestaurantName;
var RestaurantCSSURI;
var RestaurantLogoURI;
var RestaurantID;
var TableID;
var TableNumber;
var SelectedItemID;
var SelectedItemNombre;
var SelectedItemPrecio;
var SelectedItemDescripcion;
var SelectedItemImg;
var ID_Client;


function RefreshRestaurantLogo()
{
	setTimeout("RefreshRestaurantLogo_Do();", 500);
};


function RefreshRestaurantLogo_Do()
{
	$('.RestaurantLogo').attr('style', 'background-image: url('+ CONTENT_URI + udefToStr(RestaurantLogoURI) +');');
};



function GoToInit()
{
	setTimeout("window.fn.popPage();", 2000);
	document.getElementById('appTabbar').setActiveTab(0);
};

function GoToInit2()
{
	setTimeout("window.fn.popPage();", 200);
	document.getElementById('appTabbar').setActiveTab(1);
	setTimeout('document.getElementById("appTabbar").setActiveTab(1);', 1000);
};

function GoSeeMyPedido()
{
	setTimeout("window.fn.popPage();", 200);
	setTimeout("window.fn.popPage();", 800);
	setTimeout("window.fn.popPage();", 1200);
	
	document.getElementById('appTabbar').setActiveTab(1);
	setTimeout('document.getElementById("appTabbar").setActiveTab(1);', 1000);
};


function GetServicesURI()
{
	return "https://api_eatin.gobozu.com/services/?";
};

App_Start();
function App_Start()
{
	$(document).ready(function(){
		//Mercadopago.setPublishableKey("TEST-26ecb5cf-f8f8-45e2-b9e7-9b4139920330");		
		
		console.log("App_Start(); - Eatin Start v002!");
		
		MiPedidoEnCurso_WatchAndDeleteAfter10Minutes();


		
		//Client_GetFromSession();
		setTimeout("Restaurant_View();", 500);
		setTimeout("Table_View();", 500);
		setTimeout("Categorias_View();", 500);
		setTimeout("GetClientFromSession();", 500);
		
			
		var restaurant_table = getParameterByName("Restaurant_Table");
		var arrrestaurant_table = restaurant_table.split("_");
		RestaurantID = arrrestaurant_table[0];
		TableID = arrrestaurant_table[1];
		

		$(document).on('click', '.btnItemOptions', function(){
			alert("test");
		});



		
		$(document).on('click', '.btnViewPedido', function(){
			document.getElementById('appTabbar').setActiveTab(1);
			Pedido_RedrawListMiPedido();
			setTimeout("Pedido_RedrawListMiPedido();", 700);
		});
		
		$(document).on('click, tap', '.btnPedir', function(){
			//alert("dsada");
			$('.txtCantidad').val(1);
			//$('.btnPedirOpciones').show();
			
			if (selectedCategory_Name.toLowerCase().indexOf("bebida")!=-1  || selectedCategory_Name.toLowerCase().indexOf("cerveza")!=-1)
			{
				$('.toggleParaCompartir').hide();
				$('.lblParaCompartir').hide();
			}
			else
			{
				$('.toggleParaCompartir').show();
				$('.lblParaCompartir').show();
			}
		});
		
		$(document).on('click', '.btnPedirConfirmar', function(){
			//document.getElementById('appNavigator').popPage();
			document.getElementById('appNavigator').popPage({animation: "lift"});
			
			ons.notification.toast('Agregado.', {
				timeout: 2000,
				animation: 'fall'
			});
			var item = {};
			item.aclaraciones = $('.txtAclaraciones').val();
			item.cantidad = $('.txtCantidad').val();
			item.compartir = $('.toggleParaCompartir').val();
			item.ID = SelectedItemID;
			item.Nombre = SelectedItemNombre;
			item.Precio = SelectedItemPrecio;
			item.Descripcion = SelectedItemDescripcion;
			item.Img1 = SelectedItemImg;
			item.compartir = document.getElementById('toggleParaCompartir').checked;
			Pedido_Agregar(item);
		});
		

		
		$(document).on('click', '.btnHacerPedido_PagarEnLaCuenta', function(){
			mipedidoencurso = $('.listMiPedido').html().toString() + mipedidoencurso;
			setTimeout("currentPedido.items = []; Pedido_RedrawListMiPedido();", 2000);
			ons.notification.toast('Haciendo pedido...', {
				timeout: 2000,
				animation: 'fall'
			});
			Pedido_Add();
			fn.pushPage({'id': 'haciendopedido.html', 'title': 'dsaasd' });
		});
		
		$(document).on('click', '.btnHacerPedido_PagarAhora', function(){
			var obj = {};
			Pedido_RecalculateSum();
			obj.sum = sum;
			obj.restaurantname = RestaurantName;
			var url = "https://tbo.gobozu.com/EATIN_PMTS/index.php?obj=" + btoa( JSON.stringify(obj) );
			window.location.href = url;
		});
		
		
		$(document).on('click', '.liItem', function(){
			var itemid = $(this).attr('data-itemid');
			ItemDetailPage_Init(itemid);
		});

		$(document).on('click', '.liCategory', function(){
			var categoryid = $(this).attr('data-categoryid');
			selectedCategory_ID = categoryid;
			selectedCategory_Name = $(this).attr('data-categoryname');
			CategoryDetailPage_Init(categoryid);
		});


		$(document).on('click', '.tabMiPedido', function(){
			Pedido_RedrawListMiPedido();
		});
		
		$(document).on('click', '.btnBorrarPedido', function(){
			currentPedido.items = [];
			Pedido_RedrawListMiPedido();
		});
		
		$(document).on('click', '.btnConfirmarPedido', function(){
			$('.btnVerPedidoEnCurso').show();
			
			fn.pushPage({'id': 'hacerpedido.html', 'title': 'dsaasd' });
		});
		
		
		
		$(document).on('click', '.decreaseCantidad', function(){
			var cant = $(this).closest('.cantidadCont').find('.txtCantidad').val();
			cant--;
			if (cant < 1) cant = 1;
			$(this).closest('.cantidadCont').find('.txtCantidad').val(cant);
		});
		$(document).on('click', '.increaseCantidad', function(){
			var cant = $(this).closest('.cantidadCont').find('.txtCantidad').val();
			cant++;
			if (cant > 10) cant = 10;
			$(this).closest('.cantidadCont').find('.txtCantidad').val(cant);
		});
		
		
		
		$(document).on('click', '.decreaseCantidadEdit', function(){
			var key = $(this).closest('.liListItem').attr('data-key');
			var cant = $(this).parent().find('.txtCantidadEdit').val();
			cant--;
			if (cant < 1)
			{
				//TODO: remover item.
				$(this).closest('.list-item').remove();
				currentPedido.items[key] = null;
			}
			else
			{
				$(this).parent().find('.txtCantidadEdit').val(cant);
				currentPedido.items[key].cantidad = cant;
			}
			Pedido_RecalculateSum();
		});
		$(document).on('click', '.increaseCantidadEdit', function(){
			var cant = $(this).parent().find('.txtCantidadEdit').val();
			cant++;
			if (cant > 10) cant = 10;
			$(this).parent().find('.txtCantidadEdit').val(cant);
			var key = $(this).closest('.liListItem').attr('data-key');
			currentPedido.items[key].cantidad = cant;
			Pedido_RecalculateSum();
		});
		
		
		$(document).on('click', '.btnGoToPedido', function(){
			GoToInit2();
			Pedido_RedrawListMiPedido();
			setTimeout("Pedido_RedrawListMiPedido();", 700);
		});

		
		$(document).on('click', '.btnHaciendoPedidoVolver', function(){
			GoSeeMyPedido();
		});
		
		
	});
};

function EATINLogo_Show()
{
	$('.EatinLogo').show(1000);
};


function MiPedidoEnCurso_Init()
{
	setTimeout("MiPedidoEnCurso_Init_Do();", 800);
};

function MiPedidoEnCurso_Init_Do()
{
	$('.listMiPedidoEnCurso').html(mipedidoencurso);
	$('.divNumeroPedidoEnCurso').html("Numero de pedido en curso: <b>"+ actualpedido.toString() +"</b>")
};


function MiPedidoEnCurso_WatchAndDeleteAfter10Minutes()
{
	setInterval("MiPedidoEnCurso_WatchAndDeleteAfter10Minutes_Do();", 1000);
};

function MiPedidoEnCurso_WatchAndDeleteAfter10Minutes_Do()
{
	$('.listMiPedidoEnCurso').find('.liListItem').each(function(){
		if ( !$(this).attr('data-timer') )
		{
			$(this).attr('data-timer', 1);
		}
		else
		{
			var t = $(this).attr('data-timer');
			t++;
			$(this).attr('data-timer', t);
			
			if (t > 600)
			{
				$(this).remove();
			}
		}
		
	});
};


function Pedido_Agregar(item)
{
	//recorro currentPedido.items. Busco el item correspondiente si existe, sino lo agrego.
	var foundit = false;
	for (var key in currentPedido.items)
	{
		if (!currentPedido.items[key]) continue;
		if (currentPedido.items[key].ID==item.ID && currentPedido.items[key].Aclaraciones==item.Aclaraciones)
		{
			foundit = true;
			currentPedido.items[key].Cantidad++;
		}
	}
	
	if (!foundit)
	{
		//agrego a la tabla currentPedido.items
		currentPedido.items.push(item);
	}
	//Pedido_RedrawListMiPedido();
	$('.divPedidoEnCurso').show();
	$('.divGoToPedidoContainer').show();
};


function Pedido_Add()
{
	
	$.ajax({
		type: "POST",
		url: GetServicesURI() + "service=Pedido_Add&tk=1&ID_Restaurant=" + udefToStr(RestaurantID) + "&ID_Table=" + udefToStr(TableID) + "&ID_Client=" + udefToStr(ID_Client),
		data: currentPedido,
		success: Pedido_Add_Success
	});	
};

var actualpedido;
function Pedido_Add_Success(data)
{
	console.log("DATA:", data);
	var obj = JSON.parse(data);
	var pedidoID = obj.results[0].ID;
	actualpedido = pedidoID;
	$('.lblPedidoNumero').html('Pedido numero: <b class="bNumeroPedido">' + udefToStr(pedidoID) + "</b>" );
};

var sum = 0;
function Pedido_RecalculateSum()
{
	sum = 0;
	$('.btnConfirmarPedido').hide();
	for (var key in currentPedido.items)
	{
		console.log("KK", currentPedido.items[key]);
		if (!currentPedido.items[key]) continue;
		sum = sum + parseFloat(currentPedido.items[key].Precio) * parseFloat(currentPedido.items[key].cantidad);
		$('.btnConfirmarPedido').show();
	}
	$('.h3SumTotal').html('Total: $' + sum.toString() );
	
	if (sum)
	{
		$('.h3SumTotal').show();
	}
	else
	{
		$('.h3SumTotal').hide();
	}
	
};

function Pedido_RedrawListMiPedido()
{
	var vw = '';
	vw = vw + '\
		<ons-list-header class="list-header">\
			Mi pedido\
		</ons-list-header>\
	';
	for (var key in currentPedido.items)
	{
		if (!currentPedido.items[key]) continue;
		vw = vw + '\
			<ons-list-item data-key="'+ key.toString() +'" class="list-item liListItem">\
				<div class="center list-item__center">\
				<h2>'+ udefToStr(currentPedido.items[key].Nombre) +'</h2>\
					<div style="width: 100%;">\
						'+ udefToStr(currentPedido.items[key].Descripcion) +'\
					</div>\
					<div class="editCantidad">\
						Cantidad:<br/>\
						<ons-button class="decreaseCantidadEdit"> - </ons-button>  <ons-input disabled style="width: 50px;" class="txtCantidadEdit" type="number" placeholder="Cantidad" min="1" max="10" value="'+ udefToStr(currentPedido.items[key].cantidad) +'"></ons-input>    <ons-button class="increaseCantidadEdit"> + </ons-button> \
					</div>\
				</div>\
				<div class="left list-item__left">\
					<img class="list-item__thumbnail" src="'+ CONTENT_URI + udefToStr(currentPedido.items[key].Img1) +'">\
				</div>\
				<div class="right">\
					$'+ udefToStr(currentPedido.items[key].Precio) +'.-\
				</div>\
			</ons-list-item>';
	}
	$('.listMiPedido').html(vw);
	
	if (!currentPedido.items.length)
	{
		$('.btnConfirmarPedido').hide();
		$('.btnBorrarPedido').hide();
		$('.lblPedidoVacio').show();
		$('.divPedidoEnCurso').hide();
	}
	else
	{
		$('.btnConfirmarPedido').show();
		$('.btnBorrarPedido').show();
		$('.lblPedidoVacio').hide();
		$('.divPedidoEnCurso').show();
	}
	Pedido_RecalculateSum();
};


function Client_GetFromSession()
{
	var callbackAdditionalArgs = {};
	var path = GetServicesURI();
	var callback = 'Client_GetFromSession_Callback';
	var args = [];
	args['service'] = 'Client_GetFromSession';
	JsonP( path, args, callback, callbackAdditionalArgs );
};

function Client_GetFromSession(data, callbackAdditionalArgs)
{
	
};

function Restaurant_View()
{
	console.log("Restaurant_View();");
	var callbackAdditionalArgs = {};
	var path = GetServicesURI();
	var callback = 'Restaurant_View_Callback';
	var args = [];
	args['service'] = 'Restaurant_View';
	args['ID'] = RestaurantID; //getParameterByName('ID_Restaurant');
	JsonP( path, args, callback, callbackAdditionalArgs );
};

function Restaurant_View_Callback(data, callbackAdditionalArgs)
{
	console.log("Restaurant_View_Callback");
	console.log(data);
	for (var key in data.results)
	{
		$('.divRestaurantName').html(data.results[key].Nombre);
		RestaurantName = data.results[key].Nombre;
		RestaurantCSSURI = data.results[key].AppCSS;
		RestaurantLogoURI = data.results[key].LogoSize1;
		if (RestaurantCSSURI)
		{
			Restaurant_AddCSS();
		}
		
		$('.h1Welcome').html( "Bienvenido a " + RestaurantName.toString() );
		RefreshRestaurantLogo();
	}
};


function Restaurant_AddCSS()
{
	//appendea una stylesheet al head.
	var vw = '<link rel="stylesheet" href="'+ CONTENT_URI + RestaurantCSSURI + '?v=' + udefToStr(randomFromTo(10,10000)) +'"/>';
	$('.divCSS').append(vw);
};


function Table_View()
{
	//https://eatin.gobozu.com/?ID_Restaurant=3&ID_Table=2
	console.log("Table_View();");
	var callbackAdditionalArgs = {};
	var path = GetServicesURI();
	var callback = 'Table_View_Callback';
	var args = [];
	args['service'] = 'Table_View';
	args['ID_Restaurant'] = RestaurantID; //getParameterByName('ID_Restaurant');
	args['ID'] = TableID; //getParameterByName('ID_Table');
	JsonP( path, args, callback, callbackAdditionalArgs );
};

function Table_View_Callback(data, callbackAdditionalArgs)
{
	console.log("Table_View_Callback");
	console.log(data);
	for (var key in data.results)
	{
		TableNumber = data.results[key].Numero;
		$('.h2TableName').html( "Mesa #" + TableNumber.toString() );
	}
};





function LoginOrRegister_Init()
{
	RefreshRestaurantLogo();
	fn.pushPage({'id': 'loginorregister.html', 'title': 'dsaasd' });
	setTimeout("ChangeLabels();", 500);
};
function ChangeLabels()
{
	$('.h1Welcome').html( "Bienvenido a " + RestaurantName.toString() );
	$('.h2TableName').html( "Mesa #" + TableNumber.toString() );
};



function Login_Init()
{
	RefreshRestaurantLogo();
	fn.pushPage({'id': 'login.html', 'title': 'dsaasd' });
	setTimeout("ChangeLabels();", 500);
};


function Register_Init()
{
	RefreshRestaurantLogo();
	fn.pushPage({'id': 'register.html', 'title': 'dsaasd' });
	setTimeout("ChangeLabels();", 500);
};


function GetClientFromSession()
{
	var callbackAdditionalArgs = {};
	var path = GetServicesURI();
	var callback = 'GetClientFromSession_Callback';
	var args = [];
	args['service'] = 'Client_GetFromSession';
	JsonP( path, args, callback, callbackAdditionalArgs );
};
function GetClientFromSession_Callback(data, callbackAdditionalArgs)
{
	if (data.result=='Error.')
	{
		LoginOrRegister_Init();
	}
	else
	{
		Tutorial_Start();
		
		ID_Client = data.result.ID;
		setTimeout("$('.MainMenuCont').show();", 1500);
		$('.tabMenu, .tabMiPedido, .tabMozo').removeClass("FauxHidden");
	}
};




function Login()
{
	var email = $('.txtLoginEmail').val().trim();
	var pass = $('.txtLoginPassword').val().trim();
	
	if (!isValidEmail(email))
	{
		$('.h4ErrorLogin').html('Error: email invalido.');
		return;
	}
	else
	{
		$('.h4ErrorLogin').html('');
	}
	
	if ( pass.length < 5 )
	{
		$('.h4ErrorLogin').html('Error: la password debe tener al menos 5 caracteres.');
		return;
	}
	else
	{
		$('.h4ErrorLogin').html('');
	}
	
	
	var callbackAdditionalArgs = {};
	var path = GetServicesURI();
	var callback = 'Login_Callback';
	var args = [];
	args['service'] = 'Client_Login';
	args['ID_Restaurant'] = RestaurantID; //getParameterByName('ID_Restaurant');
	args['Email'] = email;
	args['Hashpass'] = pass;
	JsonP( path, args, callback, callbackAdditionalArgs );
};
function Login_Callback(data, callbackAdditionalArgs)
{
	console.log("Login_Callback", data);
	
	if (data.result=='OK')
	{
		Tutorial_Start();
		ID_Client = data.results.ID;
		
		setTimeout("$('.MainMenuCont').show();", 1500);
		$('.tabMenu, .tabMiPedido, .tabMozo').removeClass("FauxHidden");
		$('.loginOrRegisterPage').hide();
		
		document.getElementById('appNavigator').popPage();
		setTimeout("document.getElementById('appNavigator').popPage();", 500);
		ons.notification.toast('Bienvenido.', {
			timeout: 2000,
			animation: 'fall'
		});
	}
	else
	{
		ons.notification.toast('Login Incorrecto.', {
			timeout: 2000,
			animation: 'fall'
		});
	}
};

function Register()
{
	var email = $('.txtRegisterEmail').val().trim();
	var pass = $('.txtRegisterPassword').val().trim();
	
	if (!isValidEmail(email))
	{
		$('.h4ErrorRegister').html('Error: email invalido.');
		return;
	}
	else
	{
		$('.h4ErrorRegister').html('');
	}
	
	if ( pass.length < 5 )
	{
		$('.h4ErrorRegister').html('Error: la password debe tener al menos 5 caracteres.');
		return;
	}
	else
	{
		$('.h4ErrorRegister').html('');
	}
	
	
	
	var callbackAdditionalArgs = {};
	var path = GetServicesURI();
	var callback = 'Register_Callback';
	var args = [];
	args['service'] = 'Client_Register';
	args['ID_Restaurant'] = RestaurantID; //getParameterByName('ID_Restaurant');
	args['Email'] = email;
	args['Hashpass'] = pass;
	JsonP( path, args, callback, callbackAdditionalArgs );
};
function Register_Callback(data, callbackAdditionalArgs)
{
	console.log("Register_Callback", data);
	
	
	RefreshRestaurantLogo();
	if (data.result=='OK')
	{
		Tutorial_Start();		
		ID_Client = data.results.ID;
		
		$('.tabMenu, .tabMiPedido, .tabMozo').removeClass("FauxHidden");
		setTimeout("$('.MainMenuCont').show();", 1500);
		$('.loginOrRegisterPage').hide();
		
		document.getElementById('appNavigator').popPage();
		setTimeout("document.getElementById('appNavigator').popPage();", 500);
		ons.notification.toast('Bienvenido.', {
			timeout: 2000,
			animation: 'fall'
		});
	}
	else
	{
		ons.notification.toast('Error en el registro.', {
			timeout: 2000,
			animation: 'lift'
		});
	}
	
};




var selectedCategory_ID;
var selectedCategory_Name;
function Categorias_View()
{
	//https://eatin.gobozu.com/?ID_Restaurant=3&ID_Table=2
	console.log("Categorias_View();");
	var callbackAdditionalArgs = {};
	var path = GetServicesURI();
	var callback = 'Categorias_View_Callback';
	var args = [];
	args['service'] = 'Categorias_View';
	args['ID_Restaurant'] = RestaurantID; //getParameterByName('ID_Restaurant');
	JsonP( path, args, callback, callbackAdditionalArgs );
};

function Categorias_View_Callback(data, callbackAdditionalArgs)
{
	RefreshRestaurantLogo();
	console.log("Categorias_View_Callback");
	console.log(data);
	var vw = '';
	for (var key in data.results)
	{
		vw = vw + '\
			<ons-card class="liCategory" modifier="chevron" data-categoryid="'+ udefToStr(data.results[key].ID) +'" data-categoryname="'+ udefToStr(data.results[key].Nombre) +'" >\
				<div class="title">'+ data.results[key].Nombre.toString() +'</div>\
			</ons-card>\
		';
	}
	$('.divCategorias').html(vw);
};




function CategoryDetailPage_Init(ID)
{
	RefreshRestaurantLogo();
	//alert(ID);
	console.log("CategoryDetailPage_Init();");
	var callbackAdditionalArgs = {};
	var path = GetServicesURI();
	var callback = 'Items_View_Callback';
	var args = [];
	args['service'] = 'Items_View';
	args['ID_Restaurant'] = RestaurantID; //getParameterByName('ID_Restaurant');
	args['ID_Categorias'] = ID;
	JsonP( path, args, callback, callbackAdditionalArgs );
	
	fn.pushPage({'id': 'categorydetail.html', 'title': 'dsaasd' });
};

function Items_View_Callback(data, callbackAdditionalArgs)
{
	$('.CategoryDetailHeader').html(selectedCategory_Name);
	
	console.log("Item_View_Callback()");
	var vw = '';
	vw = vw + '\
		<ons-list-header class="list-header">\
			Lista de items\
		</ons-list-header>';
	for (var key in data.results)
	{
		vw = vw + '\
			<ons-list-item class="list-item liItem" data-itemid="'+ udefToStr(data.results[key].ID) +'" >\
				<div class="center list-item__center">\
					<h2>'+ udefToStr(data.results[key].Nombre) +'</h2>\
					<div style="font-size: 14px; color: rgb(100,100,100); width: 100%;">\
						'+ udefToStr(data.results[key].Descripcion) +'\
					</div>\
					<div style="font-weight: bold; margin-top: 10px;">\
						$'+ udefToStr(data.results[key].Precio) +'\
					</div>\
				</div>\
				<div class="left list-item__left">\
					<img class="list-item__thumbnail" src="'+ CONTENT_URI + udefToStr(data.results[key].Img1) +'">\
				</div>\
			</ons-list-item>';		
	}
	$('.listItems').html(vw);
};



function ItemDetailPage_Init(ID_Item)
{
	RefreshRestaurantLogo();
	console.log("ItemDetailPage_Init();");
	var callbackAdditionalArgs = {};
	var path = GetServicesURI();
	var callback = 'ItemDetailPage_Items_View_Callback';
	var args = [];
	args['service'] = 'Items_View';
	args['ID'] = ID_Item;
	args['ID_Restaurant'] = RestaurantID; //getParameterByName('ID_Restaurant');
	JsonP( path, args, callback, callbackAdditionalArgs );
	fn.pushPage({'id': 'itemdetail.html', 'title': 'dsaasd' });	
	
};

function ItemDetailPage_Items_View_Callback(data, callbackAdditionalArgs)
{
	$('.btnPedir').show();
	//$('.btnPedirOpciones').hide();

	
	for (var key in data.results)
	{
		SelectedItemID = data.results[key].ID;
		SelectedItemNombre = data.results[key].Nombre;
		SelectedItemPrecio = data.results[key].Precio;
		SelectedItemDescripcion = data.results[key].Descripcion;
		SelectedItemImg = data.results[key].Img1;
		
		//alert(data.results[key].Nombre);
		$('.itemDetailTitle, .h1itemDetailTitle').html(data.results[key].Nombre);
		$('.itemDetailDescription').html(data.results[key].Descripcion);
		$('.itemDetailDescriptionEN').html(data.results[key].DescripcionEN);
		$('.itemPrice, .h3ItemPrice').html("$" + SelectedItemPrecio.toString() );
		if (data.results[key].Img1)
		{
			//data.results[key].Img1 = replaceAll(data.results[key].Img1, "(", "(");
			//data.results[key].Img1 = replaceAll(data.results[key].Img1, ")", ")");
		}
		$('.bgItem').attr('style', 'background-image: url('+ CONTENT_URI + encodeURI( udefToStr(data.results[key].Img1) ) +');');
	}
	
	if (selectedCategory_Name.toLowerCase().indexOf("bebida")!=-1 || selectedCategory_Name.toLowerCase().indexOf("cerveza")!=-1 )
	{
		$('.toggleParaCompartir').hide();
		$('.lblParaCompartir').hide();
		$('.txtAclaraciones').hide();
	}
	else
	{
		$('.toggleParaCompartir').show();
		$('.lblParaCompartir').show();
		$('.txtAclaraciones').show();
	}
	
	
};






function PedirLaCuenta_Init()
{
	$.ajax({
		type: "POST",
		url: GetServicesURI() + "&ID_PedidoAccion=2&service=Pedido_Add&tk=1&ID_Restaurant=" + udefToStr(RestaurantID) + "&ID_Table=" + udefToStr(TableID) + "&ID_Client=" + udefToStr(ID_Client),
		data: currentPedido,
		success: PedirLaCuenta_Callback
	});	
};
function PedirLaCuenta_Callback(data)
{	
};

function PedirPan_Init()
{
	$.ajax({
		type: "POST",
		url: GetServicesURI() + "&ID_PedidoAccion=3&service=Pedido_Add&tk=1&ID_Restaurant=" + udefToStr(RestaurantID) + "&ID_Table=" + udefToStr(TableID) + "&ID_Client=" + udefToStr(ID_Client),
		data: currentPedido,
		success: PedirPan_Callback
	});	
};
function PedirPan_Callback(data)
{	
};


function PedirCubiertos_Init()
{
	$.ajax({
		type: "POST",
		url: GetServicesURI() + "&ID_PedidoAccion=4&service=Pedido_Add&tk=1&ID_Restaurant=" + udefToStr(RestaurantID) + "&ID_Table=" + udefToStr(TableID) + "&ID_Client=" + udefToStr(ID_Client),
		data: currentPedido,
		success: PedirCubiertos_Callback
	});	
};
function PedirCubiertos_Callback(data)
{	
};


function LlamarAlMozo_Init()
{
	$.ajax({
		type: "POST",
		url: GetServicesURI() + "&ID_PedidoAccion=5&service=Pedido_Add&tk=1&ID_Restaurant=" + udefToStr(RestaurantID) + "&ID_Table=" + udefToStr(TableID) + "&ID_Client=" + udefToStr(ID_Client),
		data: currentPedido,
		success: LlamarAlMozo_Callback
	});	
};
function LlamarAlMozo_Callback(data)
{	
};





function Tutorial_Start()
{
	DeactivateVidPanels();
	setTimeout("DeactivateVidPanels()", 600);
	setTimeout("DeactivateVidPanels()", 800);
	setTimeout("Tutorial_Start_Do();", 1200);
	setTimeout("EATINLogo_Show();", 5000);
	
};

function Tutorial_Start_Do()
{
	fn.pushPage({'id': 'tutorial2.html', 'title': ''});	
}


function DeactivateVidPanels()
{
	var vids = $("video"); 
	$.each(vids, function(){
		   this.controls = false; 
	}); 	
};

function getParameterByName(name) 
{
	name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
	var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
	results = regex.exec(location.search);
	return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}



function isValidEmail(email) 
{
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

function replaceAll(str, find, replace) 
{
	return str.replace(new RegExp(find, 'g'), replace);
}



function Facebook_Login()
{
	FB.login(function(response) {
		if (response.authResponse) 
		{
			console.log('Welcome!  Fetching your information.... ');
			FB.api('/me', function(response) {
				console.log("response", response);
				console.log('Good to see you, ' + response.name + ' . ' + response.id);

				//hacemos el request al servicio.
				var callbackAdditionalArgs = {};
				var path = GetServicesURI();
				var callback = 'Client_LoginWithFacebook_Callback';
				var args = [];
				args['service'] = 'Client_LoginWithFacebook';
				args['ID_Restaurant'] = RestaurantID;
				args['FBID'] = response.id;
				args['FirstName'] = response.name;
				args['LastName'] = response.last_name;
				//args['FBID'] = response.id;
				JsonP( path, args, callback, callbackAdditionalArgs );
			});
		} 
		else 
		{
			console.log('User cancelled login or did not fully authorize.');
		}
	}, { scope: 'email' });
    	
	
};


function Client_LoginWithFacebook_Callback(data, callbackAdditionalArgs)
{
	console.log("Client_LoginWithFacebook_Callback", data);	
	
	console.log("Login_Callback", data);
	
	if (data.result=='OK')
	{
		Tutorial_Start();
		ID_Client = data.results.ID;
		
		setTimeout("$('.MainMenuCont').show();", 1500);
		$('.tabMenu, .tabMiPedido, .tabMozo').removeClass("FauxHidden");
		$('.loginOrRegisterPage').hide();
		
		document.getElementById('appNavigator').popPage();
		setTimeout("document.getElementById('appNavigator').popPage();", 500);
		ons.notification.toast('Bienvenido.', {
			timeout: 2000,
			animation: 'fall'
		});
	}
	else
	{
		ons.notification.toast('Login Incorrecto.', {
			timeout: 2000,
			animation: 'fall'
		});
	}
	
	
	
};

