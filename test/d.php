<?php @error_reporting(0);
$ip    = $_SERVER['REMOTE_ADDR'];
$detek = dirname(__FILE__).'/Save/' . $ip . '.txt';
if (file_exists($detek)) {
    $Detect      = explode('|', file_get_contents(dirname(__FILE__).'/Save/' . $ip . '.txt'));
    $negara      = $Detect[0];
    $nama_negara = $Detect[1];
    $kode_negara = $Detect[2];
} else {
    $getip = 'http://www.geoplugin.net/json.gp?ip=' . $ip;
    $curl  = curl_init();
    curl_setopt($curl, CURLOPT_URL, $getip);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    @curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    $content = curl_exec($curl);
    curl_close($curl);
    $details      = json_decode($content);
    $country_code = $details->geoplugin_countryCode;
    if ($country_code == 'GB') {
        $negara = 'GB';
    } elseif ($country_code == 'C2' || $country_code == 'A1') {
        $negara = 'US';
    } else {
        $negara = $country_code;
    }
    if ($country_code == 'C2' || $country_code == 'A1') {
        $nama_negara = 'United States';
    } else {
        $nama_negara = $details->geoplugin_countryName;
    }
    $kode_negara = strtolower($negara);
    $open        = @fopen($detek, 'a');
    @fwrite($open, $negara . '|' . $nama_negara . '|' . $kode_negara);
    @fclose($open);
}
$agent = $_SERVER['HTTP_USER_AGENT'];
?>
