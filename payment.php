<?php
// Start session to handle confirmation messages
session_start();
$host = 'localhost';
$db = 'airline_booking_system'; // Replace with your database name
$user = 'root'; // Replace with your database username
$pass = ''; // Replace with your database password

// Process the form if submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form inputs
    $card_number = $_POST['card_number'] ?? '';
    $expiry_date = $_POST['expiry_date'] ?? '';
    $cvv = $_POST['cvv'] ?? '';

    // Basic validation (more robust validation can be added)
    if (strlen($card_number) < 12 || strlen($card_number) > 16 || strlen($cvv) < 3 || strlen($cvv) > 4) {
        $error_message = "Invalid card details.";
    } else {
        // If validation passes, simulate a successful payment
        $_SESSION['success'] = "payment successful!";
        header('Location: index.php'); // Redirect to confirmation page
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <link rel="stylesheet" href="payment.css"> <!-- Link to CSS file -->
</head>
<style>
    /* payment.css */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.payment-container {
    width: 400px;
    padding: 20px;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
}

h1 {
    color: #4CAF50;
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 5px;
    text-align: left;
    color: #333;
}

input {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button {
    width: 100%;
    padding: 10px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    cursor: pointer;
}

button:hover {
    background-color: #45a049;
}

.error {
    color: red;
    font-size: 14px;
    margin-bottom: 10px;
}

</style>
<body>
<div class="payment-container">
    <h1>Payment Page</h1>

    <!-- Display error message if validation fails -->
    <?php if (isset($error_message)): ?>
        <p class="error"><?php echo htmlspecialchars($error_message); ?></p>
    <?php endif; ?>

    <!-- Payment Form -->
    <form method="POST" action="payment.php" onsubmit="return validatePaymentForm()">
        <label for="card_number">Card Number</label>
        <input type="text" id="card_number" name="card_number" maxlength="16" placeholder="Enter your card number" required>

        <label for="expiry_date">Expiry Date (MM/YY)</label>
        <input type="text" id="expiry_date" name="expiry_date" placeholder="MM/YY" required>

        <label for="cvv">CVV</label>
        <input type="password" id="cvv" name="cvv" maxlength="4" placeholder="Enter CVV" required>

        <button type="submit" href="index.php" class="pay-now-btn">Pay Now</button>
    </form>
</div>
<script> // payment.js
function validatePaymentForm() {
    const cardNumber = document.getElementById('card_number').value.trim();
    const expiryDate = document.getElementById('expiry_date').value.trim();
    const cvv = document.getElementById('cvv').value.trim();

    // Card Number validation
    if (cardNumber.length < 12 || cardNumber.length > 16 || isNaN(cardNumber)) {
        alert('Card Number must be 12-16 digits long.');
        return false;
    }

    // Expiry Date validation
    const expiryRegex = /^(0[1-9]|1[0-2])\/\d{2}$/; // MM/YY format
    if (!expiryRegex.test(expiryDate)) {
        alert('Invalid Expiry Date. Format: MM/YY');
        return false;
    }

    // CVV validation
    if (cvv.length < 3 || cvv.length > 4 || isNaN(cvv)) {
        alert('CVV must be 3 or 4 digits.');
        return false;
    }

    return true; // Allow form submission
}
</script>
<script src="payment.js"></script> <!-- Link to JavaScript file -->
</body>
</html>
