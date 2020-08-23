<?php
// SDK de Mercado Pago
require __DIR__ .  '/vendor/autoload.php';

MercadoPago\SDK::setAccessToken("APP_USR-6317427424180639-042414-47e969706991d3a442922b0702a0da44-469485398"); 
$payment = MercadoPago\Payment.find_by_id($_POST["id"]);

$request = $_POST;
$jsonencoded = json_encode($request,JSON_UNESCAPED_UNICODE);
$file = __DIR__ . "/responses/$payment.json";

$fh = fopen($file, 'w');
fwrite($fh, $jsonencoded);
fclose($fh);

?>