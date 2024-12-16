<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cardNumber = $_POST['cc-number'] ?? '';
    $expiration = $_POST['cc-exp'] ?? '';
    $cvv = $_POST['x_card_code'] ?? '';

    // Validate the card number (must be 12-16 digits)
    if (!preg_match('/^\d{12,16}$/', $cardNumber)) {
        die('Invalid card number');
    }

    // Validate the expiration date (MM / YY format)
    if (!preg_match('/^\d{2} \/ \d{2}$/', $expiration)) {
        die('Invalid expiration date');
    }

    // Validate the CVV (3-4 digits)
    if (!preg_match('/^\d{3,4}$/', $cvv)) {
        die('Invalid CVV');
    }

    // Process the payment (simulate payment processing here)
    // In a real scenario, you would integrate with a payment gateway like Stripe, PayPal, etc.
    $paymentProcessed = true; // Simulate successful payment

    if ($paymentProcessed) {
        // Redirect to the success page after payment is successful
        header('Location: payment_success.php');
        exit;
    } else {
        // If payment failed, display an error message
        echo "Payment failed. Please try again.";
    }
}
?>
