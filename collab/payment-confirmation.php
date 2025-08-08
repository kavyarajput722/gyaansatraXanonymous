<?php
require('razorpay-php/Razorpay.php'); // Make sure this path is correct

use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

$api_key = "YOUR_API_KEY";
$api_secret = "YOUR_API_SECRET";

$api = new Api($api_key, $api_secret);

// Get values from POST request
$payment_id = $_POST['razorpay_payment_id'] ?? '';
$order_id   = $_POST['razorpay_order_id'] ?? '';
$signature  = $_POST['razorpay_signature'] ?? '';

if (!$payment_id || !$order_id || !$signature) {
    http_response_code(400);
    echo "Missing required payment details.";
    exit;
}

try {
    // Signature verification
    $attributes = [
        'razorpay_order_id'   => $order_id,
        'razorpay_payment_id' => $payment_id,
        'razorpay_signature'  => $signature
    ];
    $api->utility->verifyPaymentSignature($attributes);

    // Save to DB (optional) or display success
    echo "✅ Payment successful! Payment ID: $payment_id";

} catch (SignatureVerificationError $e) {
    http_response_code(403);
    echo "❌ Payment verification failed: " . $e->getMessage();
}
?>
