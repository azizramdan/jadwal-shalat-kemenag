<?php
$cookieFile = "cookie.txt";
if(!file_exists($cookieFile)){
    $fh = fopen($cookieFile, "w");
    fwrite($fh, "");
    fclose($fh);
}
function getCURL($url){
    global $cookieFile;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_COOKIEFILE, dirname(__FILE__). '/' . $cookieFile);
    curl_setopt($ch, CURLOPT_COOKIEJAR, dirname(__FILE__). '/' . $cookieFile);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close ($ch);
    return json_encode($result);
}

getCURL('https://bimasislam.kemenag.go.id/jadwalshalat');
$result = getCURL('https://bimasislam.kemenag.go.id/ajax/getKabkoshalat');
var_dump($result);