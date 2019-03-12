<?php
    $cookieFile = "cookie.txt";
    if(!file_exists($cookieFile)){
        $fh = fopen($cookieFile, "w");
        fwrite($fh, "");
        fclose($fh);
    }
    $data = [];
    function getCURL($url){
        global $cookieFile;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_COOKIEFILE, dirname(__FILE__). '/' . $cookieFile);
        curl_setopt($ch, CURLOPT_COOKIEJAR, dirname(__FILE__). '/' . $cookieFile);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $result = curl_exec($ch);
        curl_close ($ch);
        return $result;
    }

    getCURL('https://bimasislam.kemenag.go.id/jadwalshalat');
    $kabkot = getCURL('https://bimasislam.kemenag.go.id/ajax/getKabkoshalat');

    $provinsi = getCURL('https://bimasislam.kemenag.go.id/jadwalshalat');
    $provinsi = explode('<select id="search_prov">', $provinsi);
    $provinsi = explode('</select>', $provinsi[1]);
    //$provinsi = explode('</option>', $provinsi[0]);
    // foreach ($provinsi as $val) {
    //     var_dump($val);
    // }
    //echo $provinsi[0];
    var_dump($provinsi[0]);