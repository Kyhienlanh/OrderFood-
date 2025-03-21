<?php
require 'vendor/autoload.php'; // Tải thư viện PayPal đã cài

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

// Cấu hình thông tin PayPal API
$apiContext = new ApiContext(
    new OAuthTokenCredential(
        'AU5KgwGhJcvX0Ag9pl19acM4iXhYgLvNFJ562s0LO9DpIjpJsiIq1d8T_WPGuaO_l6elo5m1QeTKdWXu', // Thay bằng Client ID từ PayPal Developer
        'EJsLF49wUAVOzV43WtY6cGOVC2gsOjuPvkOq2bZ6EetURe9kd3ZfAzW3lHgDSjfLVYrc1NeRhmt6F0My' // Thay bằng Client Secret từ PayPal Developer
    )
);

// Cấu hình môi trường
$apiContext->setConfig([
    'mode' => 'sandbox', // 'live' khi đưa vào production
    'log.LogEnabled' => true,
    'log.FileName' => 'PayPal.log',
    'log.LogLevel' => 'FINE'
]);

?>
