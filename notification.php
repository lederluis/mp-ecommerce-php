<?php
$key = "APP_USR-6317427424180639-042414-47e969706991d3a442922b0702a0da44-469485398";
$payment = $_POST["id"];

$json = file_get_contents("https://api.mercadopago.com/v1/payments/$payment?access_token=$key");
$file = __DIR__ . "/responses/test.json";

$fh = fopen($file, 'w');
fwrite($fh, $json);
fclose($fh);

?>  