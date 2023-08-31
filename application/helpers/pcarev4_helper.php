<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once 'vendor/autoload.php';

function PcareV4($url = "", $method = "GET", $ct = "application/json; charset=utf-8", $post = "")
{
  $ci = get_instance();
  $data_pcare = $ci->db->get('pcare')->row_array();
  date_default_timezone_set('UTC');
  $TimeStamp = strval(time() - strtotime('1970-01-01 00:00:00'));
  $c = curl_init();

  $data = $data_pcare['consid'];
  $secretKey = $data_pcare['conssecret'];
  $username = $data_pcare['userpcare'];
  $password = $data_pcare['passpcare'];
  $user_key = $data_pcare['user_key'];
  $keyDecrypt = $data . $secretKey . $TimeStamp;
  // Computes the signature by hashing the salt with the secret key as the key
  $signature = hash_hmac('sha256', $data . "&" . $TimeStamp, $secretKey, true);
  // base64 encode…
  $encodedSignature = base64_encode($signature);
  //	die(var_dump($secretKey));
  $kodeaplikasi = "095";
  $XAuthorization  = base64_encode($username . ":" . $password . ":" . $kodeaplikasi);

  $curl = curl_init();
  // var_dump($TimeStamp); die;
  // $u = "dokter/0/100";
  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://apijkn-dev.bpjs-kesehatan.go.id/pcare-rest-dev/" . $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 500,
    CURLOPT_CONNECTTIMEOUT => 500,
    CURLOPT_FOLLOWLOCATION => false,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => $method,
    CURLOPT_POSTFIELDS => $post,
    CURLOPT_HTTPHEADER => array(
      "authorization: Basic Og==",
      "cache-control: no-cache",
      "content-type: " . $ct,
      "x-authorization: Basic " . $XAuthorization,
      "x-cons-id: " . $data,
      "x-signature: " . $encodedSignature,
      "x-timestamp: " . $TimeStamp,
      "user_key: " . $user_key
    ),
  ));

  $response = curl_exec($curl);
  $err = curl_error($curl);
  // var_dump($err);
  curl_close($curl);

  $rest = json_decode($response);
  if ($err) {
    // echo "cURL Error #:" . $err;
    @$rest->metaData->code = 500;
    @$rest->metaData->message = $err;
  } else {
    if (@$rest->metaData->code == 200) {
      $decrype = stringDecrypt($keyDecrypt, $rest->response);
      if ($decrype != null) {
        $rest->response = json_decode($decrype);
      } else {
        $errorResponse = $rest->metaData->message . " : " . $rest->response[0]->field . " - " . $rest->response[0]->message;
        $rest->response = $errorResponse;
        $rest->metaData->message = $errorResponse;
      }
    } else {
      if (@$rest->response != null) {
        $decrype = stringDecrypt($keyDecrypt, $rest->response);
        $rest->response = json_decode($decrype);
      } else {
        @$rest->metaData->code = 500;
        @$rest->metaData->message = "Error Response PCare";
      }
    }
    // echo json_encode($rest);
  }
  // return $response;
  return $rest;
}

function PcareV4Tes($url = "", $method = "GET", $ct = "application/json; charset=utf-8", $post = "")
{
  $ci = get_instance();
  $data_pcare = $ci->db->get('pcare')->row_array();
  date_default_timezone_set('UTC');
  $TimeStamp = strval(time() - strtotime('1970-01-01 00:00:00'));
  $c = curl_init();

  $data = $data_pcare['consid'];
  $secretKey = $data_pcare['conssecret'];
  $username = $data_pcare['userpcare'];
  $password = $data_pcare['passpcare'];
  $user_key = $data_pcare['user_key'];
  $keyDecrypt = $data . $secretKey . $TimeStamp;
  // Computes the signature by hashing the salt with the secret key as the key
  $signature = hash_hmac('sha256', $data . "&" . $TimeStamp, $secretKey, true);
  // base64 encode…
  $encodedSignature = base64_encode($signature);
  //	die(var_dump($secretKey));
  $kodeaplikasi = "095";
  $XAuthorization  = base64_encode($username . ":" . $password . ":" . $kodeaplikasi);

  $curl = curl_init();

  // $u = "dokter/0/100";
  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://apijkn-dev.bpjs-kesehatan.go.id/pcare-rest-dev" . $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_CONNECTTIMEOUT => 30,
    CURLOPT_FOLLOWLOCATION => false,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => $method,
    CURLOPT_POSTFIELDS => $post,
    CURLOPT_HTTPHEADER => array(
      "authorization: Basic Og==",
      "cache-control: no-cache",
      "content-type: " . $ct,
      "x-authorization: Basic " . $XAuthorization,
      "x-cons-id: " . $data,
      "x-signature: " . $encodedSignature,
      "x-timestamp: " . $TimeStamp,
      "user_key: " . $user_key
    ),
  ));

  $response = curl_exec($curl);
  $err = curl_error($curl);
  curl_close($curl);

  $rest = json_decode($response);
  if ($err) {
    // echo "cURL Error #:" . $err;
    @$rest->metaData->code = 500;
    @$rest->metaData->message = $err;
  } else {
    if (@$rest->metaData->code == 200) {
      $decrype = stringDecrypt($keyDecrypt, $rest->response);
      $rest->response = json_decode($decrype);
    } else {
      if (@$rest->response != null) {
        $decrype = stringDecrypt($keyDecrypt, $rest->response);
        if ($decrype != null) {
          $rest->response = json_decode($decrype);
        } else {
          $errorResponse = $rest->metaData->message . " : " . $rest->response[0]->field . " - " . $rest->response[0]->message;
          $rest->response = $errorResponse;
          $rest->metaData->message = $errorResponse;
        }
      } else {
        @$rest->metaData->code = 500;
        @$rest->metaData->message = "Error Response PCare";
        // $rest = "Error Response PCare";
      }
    }
  }
  // return $response;
  // echo var_dump($rest); die();
  // echo json_encode($rest); die();
  return $rest;
}

function stringDecrypt($key, $string)
{
  $encrypt_method = 'AES-256-CBC';
  // hash
  $key_hash = hex2bin(hash('sha256', $key));
  // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
  $iv = substr(hex2bin(hash('sha256', $key)), 0, 16);
  @$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key_hash, OPENSSL_RAW_DATA, $iv);
  // return $output;
  return \LZCompressor\LZString::decompressFromEncodedURIComponent($output);
}
