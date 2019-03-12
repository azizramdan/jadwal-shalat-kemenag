<?php
    $setProvinsi = "jawa barat";
    $setKota = "kota bandung";
    $cookieFile = "cookie.txt";
    if(!file_exists($cookieFile)){
        $fh = fopen($cookieFile, "w");
        fwrite($fh, "");
        fclose($fh);
    }
    function getCURL($url, $data){
        global $cookieFile;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_COOKIEFILE, dirname(__FILE__). '/' . $cookieFile);
        curl_setopt($ch, CURLOPT_COOKIEJAR, dirname(__FILE__). '/' . $cookieFile);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $result = curl_exec($ch);
        curl_close ($ch);
        return $result;
    }

    getCURL('https://bimasislam.kemenag.go.id/jadwalshalat', '');

    $provinsi = getCURL('https://bimasislam.kemenag.go.id/jadwalshalat', '');
    $provinsi = trim(preg_replace('/[\t\n\r\s]+/', ' ', $provinsi));
    $provinsi = explode('<select id="search_prov">', $provinsi);
    $provinsi = explode('</select>', $provinsi[1]);

    function splitKey($arr){
        $data = explode('</option>', $arr);
        array_pop($data);
        foreach ($data as &$val) {
            $val = $val . '</option>';
        }
        return $data;
    }
    $provinsi = splitKey($provinsi[0]);

    function getKey($arr1, $keyword){
        $data;
        foreach($arr1 as $key => $arrayItem){
            if( stristr( $arrayItem, $keyword ) ){
                $data = $arr1[$key];
                break;
            }
        }
        $data = explode("'", $data);
        return $data[1];
    }

    $provinsi = getKey($provinsi, $setProvinsi);
    echo $provinsi;

    $data = [
        "x" => $provinsi
    ];
    $kabkot = getCURL('https://bimasislam.kemenag.go.id/ajax/getKabkoshalat', $data);
    $kabkot = splitKey($kabkot);
    $kabkot = getKey($kabkot, $setKota);
    echo '<br>' . $kabkot;

    //$kabkot = getKey($kabkot, $setKota);
    //echo $kabkot;
