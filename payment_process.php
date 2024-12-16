<?php
session_start();

// Here you can process the payment (replace this with your payment gateway logic)

// For now, we are assuming payment is successful.
$paymentSuccessful = true; // Change this based on your actual payment success check.

if ($paymentSuccessful) {
    // Set a success message with a checkmark
    $_SESSION['success'] = '✔ Payment successful! Your seat is booked.';
    header('Location: index.php'); // Redirect to index.php (or confirmation page)
    exit;
} else {
    // If payment failed, you could set an error message
    $_SESSION['error'] = 'Payment failed. Please try again.';
    header('Location: payment.php'); // Redirect to payment page
    exit;
}
