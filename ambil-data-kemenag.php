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
        return $result;
    }

    getCURL('https://bimasislam.kemenag.go.id/jadwalshalat');
    $kabkot = getCURL('https://bimasislam.kemenag.go.id/ajax/getKabkoshalat');

    $provinsi = getCURL('https://bimasislam.kemenag.go.id/jadwalshalat');
    $provinsi = explode('<select id="search_prov">', $provinsi);
    $provinsi = explode('</select>', $provinsi[1]);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Jadwal Shalat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script>
</head>
<body>
    <select id="provinsi">
        <?= $provinsi[0]; ?>
    </select>
    <select id="kabkot">
        <?= $kabkot; ?>
    </select>
    <select id="bulan">
        <option value='1'>JANUARI</option>
        <option value='2'>FEBRUARI</option>
        <option value='3'>MARET</option>
        <option value='4'>APRIL</option>
        <option value='5'>MEI</option>
        <option value='6'>JUNI</option>
        <option value='7'>JULI</option>
        <option value='8'>AGUSTUS</option>
        <option value='9'>SEPTEMBER</option>
        <option value='10' >OKTOBER</option>
        <option value='11' >NOVEMBER</option>
        <option value='12'>DESEMBER</option>
    </select>
    <select id="tahun">
        <option value='2009'>2009</option>
        <option value='2010'>2010</option>
        <option value='2011'>2011</option>
        <option value='2012'>2012</option>
        <option value='2013'>2013</option>
        <option value='2014'>2014</option>
        <option value='2015'>2015</option>
        <option value='2016'>2016</option>
        <option value='2017'>2017</option>
        <option value='2018'>2018</option>
        <option value='2019'>2019</option>
        <option value='2020'>2020</option>
        <option value='2021'>2021</option>
        <option value='2022'>2022</option>
        <option value='2023'>2023</option>
        <option value='2024'>2024</option>
        <option value='2025'>2025</option>
    </select>

</body>
</html>