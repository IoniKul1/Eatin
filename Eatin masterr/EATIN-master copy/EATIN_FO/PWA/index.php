<html>
<head>
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

	<!-- ONSEN -->
	<link rel="stylesheet" href="https://unpkg.com/onsenui/css/onsenui.css">
	<link rel="stylesheet" href="https://unpkg.com/onsenui/css/onsen-css-components.min.css">
	<script src="https://unpkg.com/onsenui/js/onsenui.min.js"></script>
	
	<!-- MP -->
	<script src="https://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js"></script>	

	<!-- P5 -->
	<!--
	<script src="static/js/p5.min.js"></script>
	<script src="static/js/p5.sound.js"></script>
	-->
	<script src="static/js/commons_v4.js"></script>

	<!--<script src="static/js/wow.min.js"></script>-->
	<link rel="stylesheet" href="static/css/animate.css">
	<link rel="stylesheet" href="static/css/onsen-css-components.min.css">
	<link rel="stylesheet" href="static/css/theme.css">

	<!-- APP -->
	<script src="static/js/app.js?g=<?php echo rand(0, 100000); ?>"></script>
	<link rel="stylesheet" href="static/css/app.css?g=<?php echo rand(0, 100000); ?>"/>

	
</head>
<body>

	<script>
	  window.fbAsyncInit = function() {
		FB.init({
		  appId            : '622594948676605',
		  autoLogAppEvents : true,
		  xfbml            : true,
		  version          : 'v8.0'
		});
	  };
	</script>
	<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
		


	<div class="divCSS">
	
	</div>


	<ons-navigator id="appNavigator" swipe-target-width="80px">
		<ons-page>
			<ons-splitter id="appSplitter">
				<ons-splitter-content page="tabbar.html"></ons-splitter-content>
			</ons-splitter>
		</ons-page>
	</ons-navigator>

	<template id="tabbar.html">
		<ons-page id="tabbar-page">
			<ons-toolbar>
				<div class="center divRestaurantName">  </div>
				<div class="right">
					<ons-toolbar-button onclick="fn.toggleMenu()">
						<ons-icon icon="ion-navicon, material:md-menu"></ons-icon>
					</ons-toolbar-button>
				</div>
			</ons-toolbar>
			<ons-tabbar id="appTabbar" position="auto">
				<ons-tab class="tabMenu FauxHidden" page="menu.html" active>
					<ion-icon id="iconTabMenu" size="large" name="albums"></ion-icon>
				</ons-tab>
				<ons-tab class="tabMiPedido FauxHidden" page="mipedido.html">
					<ion-icon id="iconTabMiPedido" size="large" name="cart"></ion-icon>
				</ons-tab>
				<ons-tab class="tabMozo FauxHidden" page="mozo.html">
					<ion-icon id="iconTabMozo" size="large" name="people-outline"></ion-icon>
				</ons-tab>
			</ons-tabbar>
		</ons-page>
	</template>
	
	
	
	<template id="menu.html">
		<ons-page>
		
			<div class="MainMenuCont" style="display: none;">
				<div class="RestaurantLogo" style="">
				</div>
				<h1 class="h1Welcome wow fadeInDown">
				</h1>
				<h2 class="h2TableName">
				</h2>
				<p class="intro">
					Esperamos que tengas una grata estadia.
				</p>
				
				<div class="divPedidoEnCurso" style="display: none;">
					<h3>
						Pedido en curso
					</h3>
					<ons-button class="btnViewPedido" modifier="large outline">Ver pedido</ons-button>
				</div>
				
				<div class="divCategorias">
				</div>
				
			</div>
			
			<div class="EatinLogoFooter">
				<div class="EatinLogo" style="display: none;">
				</div>
			</div>


		</ons-page>
	</template>
	
	
	
	<template id="categorydetail.html">
		<ons-page>
			<ons-toolbar>
				<div class="left">
					<ons-back-button> Volver </ons-back-button>
				</div>
				<div class="center CategoryDetailHeader">
				</div>
			</ons-toolbar>
		
			<ons-list class="list listItems">
			</ons-list>
			
			<div class="divGoToPedidoContainer" style="display: none;">
				<ons-button class="btnGoToPedido" modifier="large outline">Ver pedido</ons-button>
			</div>
			
		</ons-page>
	</template>
	
	
	
	
	

	<template id="itemdetail.html">
		<ons-page>
			<ons-toolbar>
				<div class="left">
					<ons-back-button> Volver </ons-back-button>
				</div>
				<div class="center itemDetailTitle">
					<!--Shake Burger Doble-->
				</div>
				<div class="right">
				</div>
			</ons-toolbar>
			
			<h1 class="h1itemDetailTitle"></h1>
			<h2 class="itemDetailDescription" style="color: rgb(100,100,100); font-size: 14px;">
				<!--Hamburguesa con carne de asado 220 g, lechuga, tomate, cheddar, en pan de Martins. incluye papas shake!-->
			</h2>
			<h2 class="itemDetailDescriptionEN" style="color: rgb(100,100,100); font-size: 14px;">
				<!--Hamburguesa con carne de asado 220 g, lechuga, tomate, cheddar, en pan de Martins. incluye papas shake!-->
			</h2>
			<div class="bgItem" style="">
			</div>

			<h3 class="h3ItemPrice">
			</h3>
			
			<!--<ons-button class="btnPedir" modifier="large outline">Pedir</ons-button>-->
			<div class="btnPedirOpciones">
				Cantidad:
				<br/>
				<br/>
				<ons-row class="cantidadCont">
					<ons-col width="10%" style="text-align: center;">
						<ons-button class="decreaseCantidad"> - </ons-button>					
					</ons-col>
					<ons-col width="20%" style="text-align: center;">
						<ons-input style=" pointer-events: none; width: 50px;" class="txtCantidad" type="number" placeholder="Cantidad" min="1" max="10" value="1"></ons-input>					
					</ons-col>
					<ons-col width="10%" style="text-align: center;">
						<ons-button class="increaseCantidad"> + </ons-button>					
					</ons-col>
				</ons-row>
				
	

				<ons-button class="btnItemOptions" modifier="large"> Agregar opciones </ons-button>					
				
				<br/>
				<br/>
				Aclaraciones:
				<br/>
				<ons-input class="txtAclaraciones" type="text" modifier="large" placeholder="Aclaraciones"></ons-input>
				<ons-list-item class="divParaCompartir">
					<div class="center lblParaCompartir">
						Para compartir
					</div>
					<div class="right">
						<ons-switch id="toggleParaCompartir" class="toggleParaCompartir"></ons-switch>
					</div>			
				</ons-list-item>
				<ons-button class="btnPedirConfirmar" modifier="large">+ Agregar</ons-button>
			</div>
			
			<div class="EatinLogoFooter">
				<div class="EatinLogo" style="display: none;">
				</div>
			</div>
			
		</ons-page>
	</template>
	
	
	
	

	<template id="opciones.html">
		<ons-page>
			<h1 style="font-size: 40px;">
				Opciones
			</h1>
		
			<ons-button modifier="large" class="btnAddOptionsAccept MargTop20">Aceptar</ons-button>
			<ons-button modifier="large" class="btnAddOptionsCancel MargTop20">Cancelar</ons-button>
			
		</ons-page>
	</template>

	
	
	
	
	
	

	<template id="mipedido.html">
		<ons-page>
			<h1 style="font-size: 40px;">
				Mi <b>pedido</b>
			</h1>
		
			<div class="lblPedidoVacio">
				<h3 style="margin-top: 30px; margin-bottom: 40px;">Tu pedido esta vacio.</h3>
			</div>
		
			<ons-button modifier="large outline" class="btnBorrarPedido" style="display: none; margin-bottom: 20px;">Borrar Pedido</ons-button>
			
			<ons-list class="list listMiPedido">
				<ons-list-header class="list-header">
					Mi pedido
				</ons-list-header>
			</ons-list>
			<h3 class="h3SumTotal">
			</h3>
			
			<ons-button modifier="large" class="btnConfirmarPedido">Confirmar Pedido</ons-button>
		
			<ons-button onclick="fn.pushPage({'id': 'mipedidoencurso.html', 'title': 'Ver pedidos en curso'}); MiPedidoEnCurso_Init();" modifier="large" style="display: none;" class="btnVerPedidoEnCurso MargTop20">Ver pedidos en curso</ons-button>


			<hr style="margin-bottom: 20px; margin-top: 10px;"/>
			<ons-button onclick="fn.pushPage({'id': 'pedirlacuenta.html', 'title': 'Pedir la cuenta'}); PedirLaCuenta_Init(); GoToInit();" modifier="large" style="background-color: red;" class="MargTop20">Pedir la cuenta</ons-button>
			
			<div class="EatinLogoFooter">
				<div class="EatinLogo" style="display: none;">
				</div>
			</div>
			
			
		</ons-page>
	</template>







	<template id="mipedidoencurso.html">
		<ons-page>
			<ons-toolbar>
				<div class="left">
					<ons-back-button> Volver </ons-back-button>
				</div>
				<div class="center">
					<!--Shake Burger Doble-->
				</div>
				<div class="right">
				</div>
			</ons-toolbar>
		
			<h1>
				Mi pedido en curso.
			</h1>
		
			<ons-button modifier="large outline" class="btnBorrarPedido" style="display: none; margin-bottom: 20px;">Borrar Pedido</ons-button>
			
			
			<div class="divNumeroPedidoEnCurso">
			
			</div>
			<ons-list class="list listMiPedidoEnCurso">
			</ons-list>
		

			<hr style="margin-bottom: 20px; margin-top: 10px;"/>
			<!--<ons-button onclick="fn.pushPage({'id': 'pedirlacuenta.html', 'title': 'Pedir la cuenta'}); GoToInit();" modifier="large" style="background-color: red;" class="MargTop20">Pedir la cuenta</ons-button>-->
			
		</ons-page>
	</template>









	<template id="tutorial.html">
		<ons-page>
			
		</ons-page>
	</template>
	
	
	<template id="tutorial2.html">
	  <ons-page>
		<ons-toolbar>
			<div class="left">
				<!--<ons-back-button> Volver </ons-back-button>-->
			</div>
			<div class="center">
				Login
			</div>
		</ons-toolbar>
	  
		<ons-carousel id="carousel" fullscreen swipeable auto-scroll overscrollable initial-index="0">
		  <ons-carousel-item class="carousel-item" style="background-color: white;">
			<video class="PointerEventsNone" playsinline="" autoplay="autoplay" muted="muted" loop="loop" width="320" height="240">
			  <source src="static/vids/food1.mp4" type="video/mp4">
			</video>
		  
			<div class="color-tag">1. Haces el pedido</div>
		  </ons-carousel-item>

		  <ons-carousel-item class="carousel-item" style="background-color: white;">
			<video class="PointerEventsNone" playsinline="" autoplay="autoplay" muted="muted" loop="loop" width="320" height="240">
			  <source src="static/vids/food3.mp4" type="video/mp4">
			</video>
			<div class="color-tag">2. Confirmas el pedido</div>
		  </ons-carousel-item>

		  <ons-carousel-item class="carousel-item" style="background-color: white;">
			<video class="PointerEventsNone" playsinline="" autoplay="autoplay" muted="muted" loop="loop" width="320" height="240">
			  <source src="static/vids/food4.mp4" type="video/mp4">
			</video>
			<div class="color-tag" style="bottom: 120px;">3. Lo llevamos a tu mesa o lo retiras en el mostrador</div>
		  </ons-carousel-item>

		  <ons-carousel-item class="carousel-item" style="background-color: white; " onclick="document.getElementById('appNavigator').popPage();">
			<video class="PointerEventsNone" playsinline="" autoplay="autoplay" muted="muted" loop="loop" width="320" height="240">
			  <source src="static/vids/food5.mp4" type="video/mp4">
			</video>
			<div class="color-tag" style="bottom: 140px;">A comer!</div>
			<div style="position: absolute; bottom: 60px; width: 80%;">
				<ons-button modifier="large" class="btnComenzar" onclick="document.getElementById('appNavigator').popPage();">Comenzar</ons-button>
			</div>
		  </ons-carousel-item>
		</ons-carousel>

		<div class="dots">
		  <span id="dot0" class="dot" onclick="fn.swipe(this)">
			&#9679;
		  </span>
		  <span id="dot1" class="dot" onclick="fn.swipe(this)">
			&#9675;
		  </span>
		  <span id="dot2" class="dot" onclick="fn.swipe(this)">
			&#9675;
		  </span>
		  <span id="dot3" class="dot" onclick="fn.swipe(this)">
			&#9675;
		  </span>
		</div>

		<script>
		  ons.getScriptPage().onInit = function () {
			this.querySelector('ons-toolbar div.center').textContent = this.data.title;
			const carousel = document.getElementById('carousel');
			carousel.addEventListener('postchange', function () {
			  var index = carousel.getActiveIndex();
			  const dots = document.querySelectorAll('.dot');
			  for (dot of dots) {
				dot.innerHTML = dot.id === 'dot' + index ? '&#9679;' : '&#9675;';
			  }
			});
			window.fn.swipe = function (target) {
			  carousel.setActiveIndex(Number(target.id.slice(-1)));
			}
		  }
		</script>

		<style>
		  .carousel-item {
			display: flex;
			justify-content: space-around;
			align-items: center;
		  }

		  .color-tag {
			color: rgb(100,100,100);
			font-size: 30px;
			position: absolute;
			bottom: 120px;
			text-align: center;
		  }

		  .dots {
			text-align: center;
			font-size: 30px;
			color: rgba(0,0,0,0.6);
			position: absolute;
			bottom: 40px;
			left: 0;
			right: 0;
		  }

		  .dots > span {
			cursor: pointer;
		  }
		</style>
	  </ons-page>
	</template>

	



	<template id="hacerpedido.html">
		<ons-page class="HacerPedidoPage PageBgWhite">
			<ons-toolbar>
				<div class="left">
					<ons-back-button> Volver </ons-back-button>
				</div>
				<div class="center">
					Elegir medio de pago
				</div>
			</ons-toolbar>
		
			<h2 style="text-align: center;">
				Elegir medio de pago
			</h2>
			
			<ons-button class="btnHacerPedido_PagarEnLaCuenta MargTop20" modifier="large">Pagar en la cuenta</ons-button>
			<ons-button class="btnHacerPedido_PagarAhora MargTop20" modifier="large">Pagar ahora</ons-button>

		</ons-page>
	</template>








	<template id="haciendopedido.html">
		<ons-page class="HaciendoPedidoPage PageBgWhite BlendMultiply">
			<div class="BigImage" style="background-image: url(static/imgs/animatedtick2.gif);">
			</div>
			<h2 style="text-align: center;">
				Pedido confirmado.
			</h2>
			
			<h3 class="lblPedidoNumero"></h3>
			<ons-button class="btnHaciendoPedidoVolver" modifier="large outline"> Volver </ons-button>
		</ons-page>
	</template>






	<template id="loginorregister.html">
		<ons-page>
			<div class="loginOrRegisterPage Padlet1">
				<div class="RestaurantLogo" style="">
				</div>
				<h1 class="h1Welcome wow fadeInDown"></h1>
				<h2 class="h2TableName"></h2>
				
				<ons-button onclick="Login_Init();" modifier="large" class="btnAlreadyClient MargTop20">Iniciar sesion</ons-button>
				<ons-button onclick="Register_Init();" modifier="large" class="btnRegister MargTop20">Registrarse</ons-button>
				
				<ons-button onclick="Facebook_Login();" modifier="large" class="btnLoginWithFB MargTop20">Ingresar con Facebook</ons-button>
				
				
			</div>

		</ons-page>
	</template>




	<template id="login.html">
		<ons-page>
			<ons-toolbar>
				<div class="left">
					<ons-back-button> Volver </ons-back-button>
				</div>
				<div class="center">
					Login
				</div>
			</ons-toolbar>
			
			<div class="Padlet1">
				<div class="RestaurantLogo" style="">
				</div>
				<h1 class="h1Welcome"></h1>
				<h2 class="h2TableName"></h2>
				
				<h1>Login.</h1>
				<h4 class="h4ErrorLogin" style="color: red;"></h4>

				<ons-input type="text" placeholder="Email" class="txtLoginEmail"></ons-input>
				<ons-input type="password" placeholder="Password" class="txtLoginPassword"></ons-input>
				<ons-button onclick="Login();" modifier="large" class="btnLogin MargTop20">Ingresar</ons-button>
				
			</div>
		</ons-page>
	</template>




	<template id="register.html">
		<ons-page>
			<ons-toolbar>
				<div class="left">
					<ons-back-button> Volver </ons-back-button>
				</div>
				<div class="center">
					Registro
				</div>
			</ons-toolbar>

			<div class="Padlet2">
				<div class="RestaurantLogo" style="">
				</div>
				<h1 class="h1Welcome"></h1>
				<h2 class="h2TableName"></h2>
				
				<h1>Registro.</h1>
				<h4 class="h4ErrorRegister" style="color: red;"></h4>
				
				
				<ons-input type="text" placeholder="Email" class="txtRegisterEmail"></ons-input>
				<ons-input type="password" placeholder="Password" class="txtRegisterPassword"></ons-input>
				<ons-button onclick="Register();" modifier="large" class="btnRegiser MargTop20">Ingresar</ons-button>
			</div>
		</ons-page>
	</template>





	<template id="mozo.html">
		<ons-page>
			<p class="intro">
				Bienvenido
			</p>
			<ons-button onclick="fn.pushPage({'id': 'mozollamado.html', 'title': 'Llamamos al mozo'}); LlamarAlMozo_Init(); GoToInit();" modifier="large" class="MargTop20">Llamar al mozo</ons-button>
			<ons-button onclick="fn.pushPage({'id': 'condimentospedidos.html', 'title': 'Condimentos pedidos'}); GoToInit();" modifier="large outline" class="MargTop20">Pedir condimentos</ons-button>
			<ons-button onclick="fn.pushPage({'id': 'pedimoscubiertos.html', 'title': 'Pedimos cubiertos'}); PedirCubiertos_Init(); GoToInit();" modifier="large outline" class="MargTop20">Pedir cubiertos</ons-button>
			<ons-button onclick="fn.pushPage({'id': 'pedimospan.html', 'title': 'Pedimos Pan'}); PedirPan_Init(); GoToInit();" modifier="large outline" class="MargTop20">Pedir pan</ons-button>
			
			<div class="EatinLogoFooter">
				<div class="EatinLogo" style="display: none;">
				</div>
			</div>
			
		</ons-page>
	</template>
	
	
	
	
	<template id="mozollamado.html">
		<ons-page class="PageBgWhite BlendMultiply">
			<div class="BigImage" style="background-image: url(static/imgs/animatedtick2.gif);">
			</div>
			<h2 style="text-align: center;">
				Llamando al mozo.
			</h2>
		</ons-page>
	</template>
	


	<template id="pedirlacuenta.html">
		<ons-page class="PageBgWhite BlendMultiply">
			<div class="BigImage" style="background-image: url(static/imgs/animatedtick2.gif);">
			</div>
			<h2 style="text-align: center;">
				Pedimos la cuenta.
			</h2>
		</ons-page>
	</template>



	<template id="condimentospedidos.html">
		<ons-page class="PageBgWhite BlendMultiply">
			<div class="BigImage" style="background-image: url(static/imgs/animatedtick2.gif);">
			</div>
			<h2 style="text-align: center;">
				Pedimos condimentos.
			</h2>
		</ons-page>
	</template>



	<template id="pedimoscubiertos.html">
		<ons-page class="PageBgWhite BlendMultiply">
			<div class="BigImage" style="background-image: url(static/imgs/animatedtick2.gif);">
			</div>
			<h2 style="text-align: center;">
				Pedimos cubiertos.
			</h2>
		</ons-page>
	</template>


	<template id="pedimospan.html">
		<ons-page class="PageBgWhite BlendMultiply">
			<div class="BigImage" style="background-image: url(static/imgs/animatedtick2.gif);">
			</div>
			<h2 style="text-align: center;">
				Pedimos pan.
			</h2>
		</ons-page>
	</template>


	<script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>



</body>
</html>

