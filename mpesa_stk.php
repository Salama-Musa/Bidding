<?php
// Initialize the variables
$consumer_key = 'AgBlCCEtFV3jWYG3aVhWpDzzpV45aAfc';
$consumer_secret = 'b3tW2bzPllyjAL5K';
$Business_Code = '174379';
$Passkey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
$Type_of_Transaction = 'CustomerPayBillOnline';
$Token_URL = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
$OnlinePayment = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
$CallBackURL = 'https://dc8f-197-232-7-202.ngrok-free.app/bidding/callback.php';

// Data from the checkout page
$phone_number = $_POST['phone_number'];
$total_amount = $_POST['amount'];

// Generate authentication token.
$curl_Token = curl_init();
curl_setopt($curl_Token, CURLOPT_URL, $Token_URL);
$credentials = base64_encode($consumer_key . ':' . $consumer_secret);
curl_setopt($curl_Token, CURLOPT_HTTPHEADER, array('Authorization: Basic ' . $credentials));
curl_setopt($curl_Token, CURLOPT_HEADER, false);
curl_setopt($curl_Token, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl_Token, CURLOPT_SSL_VERIFYPEER, false);
$token_response = curl_exec($curl_Token);

$token = json_decode($token_response)->access_token;

// Prepare data for STK push
$password = base64_encode($Business_Code . $Passkey . date("Ymdhis"));
$timestamp = date("Ymdhis");

$data = [
    'BusinessShortCode' => $Business_Code,
    'Password' => $password,
    'Timestamp' => $timestamp,
    'TransactionType' => $Type_of_Transaction,
    'Amount' => $total_amount,
    'PartyA' => $phone_number,
    'PartyB' => $Business_Code,
    'PhoneNumber' => $phone_number,
    'CallBackURL' => $CallBackURL,
    'AccountReference' => 'Jack', // Modify as needed
    'TransactionDesc' => 'Test',  // Modify as needed
];

$data_string = json_encode($data);

// Initiate STK push
$curl_STK = curl_init();
curl_setopt($curl_STK, CURLOPT_URL, $OnlinePayment);
curl_setopt($curl_STK, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization:Bearer ' . $token));
curl_setopt($curl_STK, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl_STK, CURLOPT_POST, true);
curl_setopt($curl_STK, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($curl_STK, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($curl_STK, CURLOPT_SSL_VERIFYHOST, 0);

$response = json_decode(curl_exec($curl_STK), true);

// Close cURL resources
curl_close($curl_Token);
curl_close($curl_STK);

// Output the response
if(isset($response['ResponseCode']) && $response['ResponseCode'] == '0') {
    echo json_encode($response, JSON_PRETTY_PRINT);
} else {
    echo 'cancelled';
}
?>
