<?php
    $setProvinsi = "jawa tengah";
    $setKota = "kebumen";
    $setBulan = "3";
    $setTahun = "2019";
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
    function getKey($arr, $keyword){
        $index;
        $data = explode('</option>', $arr);
        array_pop($data);
        foreach ($data as &$value) {
            $value = $value . '</option>';
        }

        foreach($data as $key => $value){
            if( stristr( $value, $keyword ) ){
                $index = $value;
                break;
            }
        }
        $index = explode("'", $index);
        return $index[1];
    }

    getCURL('https://bimasislam.kemenag.go.id/jadwalshalat', '');

    $provinsi = getCURL('https://bimasislam.kemenag.go.id/jadwalshalat', '');
    $provinsi = trim(preg_replace('/[\t\n\r\s]+/', ' ', $provinsi));
    $provinsi = explode('<select id="search_prov">', $provinsi);
    $provinsi = explode('</select>', $provinsi[1]);
    $provinsi = getKey($provinsi[0], $setProvinsi);

    $data = [
        "x" => $provinsi
    ];
    $kabkot = getCURL('https://bimasislam.kemenag.go.id/ajax/getKabkoshalat', $data);
    $kabkot = getKey($kabkot, $setKota);

    $data = [
        "x" => $provinsi,
        "y" => $kabkot,
        "bln" => $setBulan,
        "thn" => $setTahun
    ];
    $res = getCURL('https://bimasislam.kemenag.go.id/ajax/getShalatbln', $data);
    echo $res;
