<?php
include 'admin/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['phone_number'], $_POST['amount'], $_POST['product_id'])) {
        $phone_number = $_POST['phone_number'];
        $amount = $_POST['amount'];
        $product_id = $_POST['product_id'];

        $access_token_url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $access_token_url);
        $credentials = base64_encode('AgBlCCEtFV3jWYG3aVhWpDzzpV45aAfc:b3tW2bzPllyjAL5K');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic ' . $credentials));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($curl);
        $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($status_code == 200) {
            $response = json_decode($response);
            $access_token = $response->access_token;
            $url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token));
            $timestamp = date('YmdHis');
            $password = base64_encode('600992' . '174379' . $timestamp);
            $curl_post_data = array(
                'BusinessShortCode' => '600992',
                'Password' => $password,
                'Timestamp' => $timestamp,
                'TransactionType' => 'CustomerPayBillOnline',
                'Amount' => $amount,
                'PartyA' => $phone_number,
                'PartyB' => '600992',
                'PhoneNumber' => $phone_number,
                'CallBackURL' => 'http://localhost/bidding/callback.php?product_id=' . $product_id . '&amount=' . $amount,
                'AccountReference' => 'Bidding Payment',
                'TransactionDesc' => 'Bidding Payment'
            );
            $data_string = json_encode($curl_post_data);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($curl);
            curl_close($curl);

            // Check the response from the payment gateway and handle accordingly
            if ($response) {
                echo 'success';
            } else {
                echo 'fail';
            }
        } else {
            echo 'Error generating access token';
        }
    } else {
        echo 'Incomplete data provided';
    }
} else {
    echo 'Invalid request method';
}
?>
