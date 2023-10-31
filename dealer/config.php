<?php
require_once "vendor/autoload.php";

use Omnipay\Omnipay;

define('CLIENT_ID', 'AUXfWN5Wlia95yIbMTkZLLI0yjfhyyN9Dwwz5aMQLtvK5N0NPKc6io3PBkNropkOCy18FojcoHL440Zx');
define('CLIENT_SECRET', 'EIu0WEXLxwXwgjodNYIb9q2LZpOB7jEjfgR2cNPPF94fQmUwIdsHpZgu11QL8uj-vtG5rv7Ey28_pyuM');

define('PAYPAL_RETURN_URL', 'http://scratchsoftwaresolutions.com/equipride/success.php');
define('PAYPAL_CANCEL_URL', 'http://scratchsoftwaresolutions.com/equipride/cancel.php');
define('PAYPAL_CURRENCY', 'GBP'); // set your currency here

// Connect with the database
$db = new mysqli('localhost', 'root', '', 'db_equipride'); 

if ($db->connect_errno) {
    die("Connect failed: ". $db->connect_error);
}

$gateway = Omnipay::create('PayPal_Rest');
$gateway->setClientId(CLIENT_ID);
$gateway->setSecret(CLIENT_SECRET);
$gateway->setTestMode(false); //set it to 'false' when go live