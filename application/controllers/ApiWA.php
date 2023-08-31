<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApiWA extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
$INSTANCE_ID = 'YOUR_INSTANCE_ID_HERE';  // TODO: Replace it with your gateway instance ID here
$CLIENT_ID = "YOUR_CLIENT_ID_HERE";  // TODO: Replace it with your Forever Green client ID here
$CLIENT_SECRET = "YOUR_CLIENT_SECRET_HERE";   // TODO: Replace it with your Forever Green client secret here
$postData = array(
  'number' => '082233860297',  // TODO: Specify the recipient's number here. NOT the gateway number
  'message' => 'Hai Gemblung'
);
$headers = array(
  'Content-Type: application/json',
  'X-WM-CLIENT-ID: '.$CLIENT_ID,
  'X-WM-CLIENT-SECRET: '.$CLIENT_SECRET
);
$url = 'http://api.whatsmate.net/v3/whatsapp/single/text/message/' . $INSTANCE_ID;
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
$response = curl_exec($ch);
echo "Response: ".$response;
curl_close($ch);
  }

  public function coba2($value='')
  {
    $data = [
    'phone' => '+6282233860297', // Receivers phone
    'body' => 'Hai Gemblung nggak punya dengkul', // Message
];
$json = json_encode($data); // Encode data to JSON
// URL for request POST /message
$url = 'https://eu18.chat-api.com/instance35512/message?token=jgjyk8gwjgrn74x6';
// Make a POST request
$options = stream_context_create(['http' => [
        'method'  => 'POST',
        'header'  => 'Content-type: application/json',
        'content' => $json
    ]
]);
// Send a request
$result = file_get_contents($url, false, $options);
  }

}
