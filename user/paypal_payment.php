<?php
session_start();
include("../db.php");

$name = $_GET['name'] ?? '';
$email = $_GET['email'] ?? '';
$address = $_GET['address'] ?? '';
$phone = $_GET['phone'] ?? '';
$note = $_GET['note'] ?? '';
$tongtien = 500000; // Ví dụ tổng tiền

$paypal_url = "https://www.paypal.com/cgi-bin/webscr";
$business_email = "your-paypal-email@example.com";

?>

<form action="<?php echo $paypal_url; ?>" method="post" id="paypalForm">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="business" value="<?php echo $business_email; ?>">
    <input type="hidden" name="item_name" value="Thanh toán đơn hàng">
    <input type="hidden" name="amount" value="<?php echo $tongtien; ?>">
    <input type="hidden" name="currency_code" value="USD">
    <input type="hidden" name="return" value="http://yourwebsite.com/success.php">
    <input type="hidden" name="cancel_return" value="http://yourwebsite.com/cancel.php">
</form>

<script>
    document.getElementById("paypalForm").submit();
</script>
