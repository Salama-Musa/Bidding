<?php
// Read the raw data from the request
$callback_data = file_get_contents("php://input");

// Decode the JSON data
$transaction_data = json_decode($callback_data, true);

// Check the transaction status
$result_code = $transaction_data['Body']['stkCallback']['ResultCode'];

if ($result_code == 0) {
    // Payment successful
    // Update your system accordingly
    // You might want to save relevant transaction details in your database
    echo "Payment successful";
} else {
    // Payment failed or was cancelled
    // Handle accordingly
    echo "Payment failed or cancelled";
}
?>
