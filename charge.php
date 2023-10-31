<?php
require_once "vendor/autoload.php";
use Omnipay\Omnipay;

// Define your PayPal credentials
define('CLIENT_ID', 'ATfuZjN9obJAIF3xXtfE9N6Xit8EM-_T88FJKM709GcoDRv_Wk5bS1ZPOOXY50tnBCIYk3avjRXeEXgr');
define('CLIENT_SECRET', 'EHTcG_8jmOb51KUBCEakG-igAQIEk-QnV--MJJqlDD_wToYyUsoJGpo6-LxVTvPbFSEVW8ozEto30T1k');
define('PAYPAL_CURRENCY', 'GBP');
define('PAYPAL_RETURN_URL', 'https://equipride.co.uk/success.php');
define('PAYPAL_CANCEL_URL', 'https://equipride.co.uk/cancel.php');

$gateway = Omnipay::create('PayPal_Rest');
$gateway->setClientId(CLIENT_ID);
$gateway->setSecret(CLIENT_SECRET);
$gateway->setTestMode(false); // Set to true for testing, false for production

if (isset($_POST['submit'])) {
    $userid = $_POST['userid']; // Replace with your user ID retrieval logic
    // $amount = $_POST['amount'];
    $amount = 0.1;
    $orderid = $_POST['orderid'];

    // Input validation
    if (!is_numeric($amount) || $amount <= 0) {
        echo "Invalid amount";
        exit;
    }

    // Generate a unique transaction ID
    $transactionId = uniqid();

    // Generate a CSRF token and store it in the session
    session_start();
    $csrfToken = bin2hex(random_bytes(32));
    $_SESSION['csrf_token'] = $csrfToken;

    try {
        $response = $gateway->purchase([
            'amount' => $amount,
            'currency' => PAYPAL_CURRENCY,
            'returnUrl' => PAYPAL_RETURN_URL . '?userid=' . urlencode($userid) . '&orderid=' . urlencode($orderid),
            'cancelUrl' => PAYPAL_CANCEL_URL . '?userid=' . urlencode($userid) . '&orderid=' . urlencode($orderid),
            'transactionId' => $transactionId,
            'custom' => $csrfToken,
        ])->send();

        if ($response->isRedirect()) {
            $response->redirect();
        } else {
            echo "Payment failed: " . $response->getMessage();
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}


// require_once "vendor/autoload.php";
// use Omnipay\Omnipay;

// // Load PayPal credentials from environment variables
// $clientId = getenv('ATfuZjN9obJAIF3xXtfE9N6Xit8EM-_T88FJKM709GcoDRv_Wk5bS1ZPOOXY50tnBCIYk3avjRXeEXgr');
// $clientSecret = getenv('EHTcG_8jmOb51KUBCEakG-igAQIEk-QnV--MJJqlDD_wToYyUsoJGpo6-LxVTvPbFSEVW8ozEto30T1k');
// $paypalCurrency = 'GBP'; // Set the currency
// $paypalReturnUrl = 'https://equipride.co.uk/success.php'; // Set your success URL
// $paypalCancelUrl = 'https://equipride.co.uk/cancel.php'; // Set your cancel URL

// $gateway = Omnipay::create('PayPal_Rest');
// $gateway->setClientId($clientId);
// $gateway->setSecret($clientSecret);
// $gateway->setTestMode(false); // Set to true for testing, false for production

// if (isset($_POST['submit'])) {
//     $userid = $_POST['userid']; // Replace with your user ID retrieval logic

//     // Additional input validation
//     $amount = floatval($_POST['amount']);
//     $orderid = $_POST['orderid'];

//     if ($amount <= 0) {
//         echo "Invalid amount";
//         exit;
//     }

//     // Generate a unique transaction ID
//     $transactionId = uniqid();

//     // Generate a CSRF token and store it in the session
//     session_start();
//     $csrfToken = bin2hex(random_bytes(32));
//     $_SESSION['csrf_token'] = $csrfToken;

//     try {
//         // Verify that the CSRF token matches the one stored in the session
//         if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
//             echo "CSRF token mismatch";
//             exit;
//         }

//         $response = $gateway->purchase([
//             'amount' => $amount,
//             'currency' => $paypalCurrency,
//             'returnUrl' => $paypalReturnUrl . '?userid=' . urlencode($userid) . '&orderid=' . urlencode($orderid),
//             'cancelUrl' => $paypalCancelUrl . '?userid=' . urlencode($userid) . '&orderid=' . urlencode($orderid),
//             'transactionId' => $transactionId,
//             'custom' => $csrfToken,
//         ])->send();

//         if ($response->isRedirect()) {
//             $response->redirect();
//         } else {
//             echo "Payment failed: " . $response->getMessage();
//         }
//     } catch (Exception $e) {
//         echo "Error: " . $e->getMessage();
//     }
// }



?>


