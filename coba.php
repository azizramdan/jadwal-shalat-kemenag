<?php
$mainurl = "https://bimasislam.kemenag.go.id/jadwalshalat";
$ripurl = "https://bimasislam.kemenag.go.id/ajax/getKabkoshalat";
//Put cookie file
$cookieFile = "cookie.txt";

//if file doesn't exist
if(!file_exists($cookieFile)) {
    //fopen for writing
    $fh = fopen($cookieFile, "w");
    //write
    fwrite($fh, "");
    //close
    fclose($fh);
}

//Start session for first login
$ch = curl_init();
//Load curl
curl_setopt($ch, CURLOPT_URL, $mainurl);
//Set cookie file
curl_setopt($ch, CURLOPT_COOKIEFILE, dirname(__FILE__). '/' . $cookieFile);
curl_setopt($ch, CURLOPT_COOKIEJAR, dirname(__FILE__). '/' . $cookieFile);
//do not return data
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//execute curl and close
curl_exec($ch);
curl_close ($ch);

//startup curl again
$ch = curl_init($ripurl);
//cookie stuff
curl_setopt($ch, CURLOPT_COOKIEFILE, dirname(__FILE__). '/' .$cookieFile);
curl_setopt($ch, CURLOPT_COOKIEJAR, dirname(__FILE__). '/' .$cookieFile);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//store curl result in var
$rawdata=curl_exec($ch);

//Close curl
curl_close ($ch);

//echo $rawdata;
var_dump($rawdata);