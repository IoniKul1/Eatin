
<?php
phpinfo();

echo "test0";

echo "test1";


// SDK de Mercado Pago
require '/usr/share/nginx/html/EATIN/EATIN_FO/vendor/autoload.php';

echo "test2";

// Agrega credenciales
MercadoPago\SDK::setAccessToken('TEST-2537924627528950-073123-6e72fa3aa09f845b6e82b8b5586f60d9-43322597');

echo "test3";


// Crea un objeto de preferencia
$preference = new MercadoPago\Preference();

var_dump($preference);

/*


// Crea un ítem en la preferencia
$item = new MercadoPago\Item();
$item->title = 'Mi producto';
$item->quantity = 1;
$item->unit_price = 75.56;
$preference->items = array($item);
$preference->save();
*/

?>

<form action="/procesar-pago" method="POST">
	<script
	src="https://www.mercadopago.com.ar/integrations/v1/web-payment-checkout.js"
	data-preference-id="<?php /* echo $preference->id; */ ?>">
	</script>
</form>




