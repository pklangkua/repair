<?php

$curl = curl_init();
$apikey = "FIJ3mJHv0QbmgZ4p82l2eb66Gzzav8Ls";

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://opend.data.go.th/opend-search/vir_7710_1600680027/query?dsname=vir_7710_1600680027&path=vir_7710_1600680027&path=vir_7710_1600680027&loadAll=1&type=json&limit=100&offset=0&api-key=REPLACE_THIS_KEY",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "accept: application/json",
    "api-key: $apikey"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}  
?>
