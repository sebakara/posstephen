<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class RRA extends Model
{
public function sendRequest($url, $custotin){

  $ourtin = ENV('TIN');
  $bhfid = ENV('BHFID');

    $endpoint = ENV('RRA_URL').$url;
    $payload = array(
      "tin"=> $ourtin,
      "bhfId"=> $bhfid,
      "custmTin"=> $custotin
    );
// return $payload;
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $endpoint,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>json_encode($payload),
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);
$httpcode = curl_getinfo($curl);
curl_close($curl);

if($response){
  return $response;
  }
  else{
      return $httpcode;
  }
}
// select item class

public function selectItemsClass($url, $custotin){

  $bhfid = ENV('BHFID');

    $endpoint = ENV('RRA_URL').$url;
    $payload = array(
      "tin"=> $custotin,
      "bhfId"=> $bhfid,
      "lastReqDt"=> "20200512041622"
    );
// return $payload;
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $endpoint,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>json_encode($payload),
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);
$httpcode = curl_getinfo($curl);
curl_close($curl);

if($response){
  return $response;
  }
  else{
      return $httpcode;
  }
}


}