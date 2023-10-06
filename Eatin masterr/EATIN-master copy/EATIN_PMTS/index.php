
<?php
//phpinfo();


require_once 'vendor/autoload.php'; // You have to require the library from your Composer vendor folder

MercadoPago\SDK::setAccessToken("TEST-5519771915372314-080214-4adae518a7bd5dd6f98c60c9706407a4-43322597"); // Either Production or SandBox AccessToken


$obj = base64_decode($_REQUEST['obj']);
$obj = json_decode($obj);


$preference = new MercadoPago\Preference();
// Crea un ítem en la preferencia
$item = new MercadoPago\Item();
$item->title = $obj->restaurantname . ' - Menu a la Carta';
$item->quantity = 1;
$item->unit_price = $obj->sum;
$preference->items = array($item);

$preference->payment_methods = array(
	"excluded_payment_types" => array(
		array("id"=>"ticket"),
		array("id"=>"atm")
	  )
);

$preference->save();



?>
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
	
	<link rel="stylesheet" href="https://eatin.gobozu.com/static/css/app.css?g=<?php echo rand(1,10000); ?>">

	
</head>
<body>

	<style>
		.mercadopago-button
		{
			font-weight: 400;
			width: 100%;
			height: 50px;
			background-color: rgba(255,40,78,.99)!important;
			box-shadow: 0px 6px 10px -4px rgba(0,0,0,0.5), inset 0px 2px 10px rgba(0,0,0,0.1);
		}
	</style>
	
	<div class="Pad20">
		<div class="Pad20" style="font-family: sans-serif; text-align: center; font-size: 20px; color: rgb(100,100,100);">
			<?php echo $obj->restaurantname; ?>
		</div>
	
		<div style="font-family: sans-serif; text-align: center; font-size: 15px; color: rgb(200,200,200);">
			Estas por pagar con MercadoPago. Te redirigimos al portal seguro.
		</div>
		
		<div class="BigImage" style="background-image: url(https://eatin.gobozu.com/static/imgs/credit2.gif); background-size: 50% auto; margin-top: 50px;">
		</div>
		
	
	
		<form action="/procesar-pago" method="POST">
			<script
			src="https://www.mercadopago.com.ar/integrations/v1/web-payment-checkout.js"
			data-preference-id="<?php echo $preference->id; ?>">
			</script>
		</form>
		
		<div class="Pad10" style="font-family: sans-serif; text-align: center; font-size: 12px; color: rgb(200,200,200);">
			<a href="#" style="color: rgb(255,40,78);" onclick="javascript:history.go(-1); return false;">Volver</a>
		</div>
		
	
	</div>



</body>
</html>

