<?php
require 'config.php';

use PayPal\Api\Address;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;


$payer = new Payer();
$payer->setPaymentMethod('paypal');
if (isset($_GET['name']) && isset($_GET['tongtien'])) {
    $name = $_GET['name'];
    $email = $_GET['email'];
    $address = $_GET['address'];
    $phone = $_GET['phone'];
    $note = $_GET['note'];
    $payment_method = $_GET['payment_method'];
    $tongtien = $_GET['tongtien'];
} 

$amount = new Amount();
$amount->setTotal($tongtien/25.585); 
$amount->setCurrency('USD'); 


$transaction = new Transaction();
$transaction->setAmount($amount);
$transaction->setDescription('Thanh toán đơn hàng Demo');


$redirectUrls = new RedirectUrls();
$redirectUrls->setReturnUrl("http://localhost/ProjectPHP/success.php?address=" . urlencode($address))
             ->setCancelUrl("http://localhost/ProjectPHP/cancel.php");



$payment = new Payment();
$payment->setIntent('sale')
        ->setPayer($payer)
        ->setRedirectUrls($redirectUrls)
        ->setTransactions([$transaction]);

try {
    $payment->create($apiContext);
    $approvalUrl = $payment->getApprovalLink();
    header("Location: " . $approvalUrl); 
    exit;
} catch (Exception $e) {
    echo "Lỗi thanh toán: " . $e->getMessage();
}
?>
