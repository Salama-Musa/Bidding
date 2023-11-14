<?php

// Retrieve the callback data
$callbackData = file_get_contents('php://input');

// Log the callback data (you can modify this to store data in a database or perform other actions)
file_put_contents('callback_log.txt', $callbackData . PHP_EOL, FILE_APPEND);

// Decode the JSON callback data
$callbackDataArray = json_decode($callbackData, true);

// Check if the errorCode is present in the callback data
if (isset($callbackDataArray['errorCode'])) {
    // Handle the error
    $errorResponse = [
        'ResultCode' => $callbackDataArray['errorCode'],
        'ResultDesc' => $callbackDataArray['errorMessage'],
    ];

    // Log the error response
    file_put_contents('error_log.txt', json_encode($errorResponse) . PHP_EOL, FILE_APPEND);

    // Send a response to Safaricom with the error details
    header('Content-Type: application/json');
    echo json_encode($errorResponse);
} else {
    // If no error, send a success response to Safaricom
    $successResponse = [
        'ResultCode' => 0,
        'ResultDesc' => 'Callback received successfully',
    ];

    header('Content-Type: application/json');
    echo json_encode($successResponse);
}
