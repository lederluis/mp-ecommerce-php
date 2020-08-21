<?php
// SDK de Mercado Pago
require __DIR__ .  '/vendor/autoload.php';

// Url principal
$url_principal = isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : null ;
$url_principal = "https://".$url_principal;

// Agrega credenciales
MercadoPago\SDK::setAccessToken("APP_USR-6317427424180639-042414-47e969706991d3a442922b0702a0da44-469485398 "); 
MercadoPago\SDK::setIntegratorId("dev_24c65fb163bf11ea96500242ac130004");

// Crea un objeto de preferencia
$preference = new MercadoPago\Preference();

// Crea un ítem en la preferencia
$item = new MercadoPago\Item();
$item->id = "1234";
$item->title = $_POST['title'];
$item->description = "Dispositivo móvil de Tienda e-commerce";

$item->picture_url = $url_principal.substr($_POST['img'],1);
$item->quantity = 1;
$item->unit_price = (float) $_POST['price'];

$preference->items = array($item);

// Información del pagador
$payer = new MercadoPago\Payer();
$payer->name = "Lalo";
$payer->surname = "Landa";
$payer->email = "test_user_63274575@testuser.com";
$payer->phone = array(
  "area_code" => "11",
  "number" => "22223333"
);

$payer->address = array(
  "street_name" => false,
  "street_number" => 123,
  "zip_code" => "1111"
);

// referencia de pago
$preference->external_reference = "leder_luis@outlook.com";

// Url de notificación
$preference->notification_url = $url_principal."/notification.php";

//  retornar al sitio web del cliente y manejar una pantalla diferente para cada estado de pago
$preference->back_urls = array(
  "success" => $url_principal."/success.php",
  "failure" => $url_principal."/failure.php",
  "pending" => $url_principal."/pending.php"
);

// retorno en caso de pago aprobado
$preference->auto_return = "approved";

// Configuración de metodos/tipos de pago
$preference->payment_methods = array(
  "excluded_payment_methods" => array(
    array("id" => "amex")
  ),
  "excluded_payment_types" => array(
    array("id" => "atm")
  ),
  "installments" => 6
);

$preference->save();

?>
<a  class="mercadopago-button" href="<?php echo $preference->init_point; ?>">Pagar la compra</a>