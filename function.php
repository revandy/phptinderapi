<?php 
class apiTinder{
	function fetchAllTomodachi(){
		$curl = curl_init();
		curl_setopt_array($curl, array(
		    CURLOPT_RETURNTRANSFER => 1,
		    CURLOPT_URL => 'https://api.gotinder.com/v2/recs/core?locale=en'
		));
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			'Accept: application/json',
			'app-version: 1020326',
			'Origin: https://tinder.com',
			'platform: web',
			'Referer: https://tinder.com/',
			'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36',
			'X-Auth-Token: xxx', //Feel Your Token Here!
			'x-supported-image-formats: webp,jpeg'
		));
		$resp = curl_exec($curl);
		curl_close($curl);
		$decode = json_decode($resp, true);
		$data = [];
		for ($i=0; $i < count($decode['data']['results']); $i++) { 
			$getTomodachiData = [
				'no' => $i + 1,
				'uid' => $decode['data']['results'][$i]['user']['_id'],
				's_number' => $decode['data']['results'][$i]['s_number'],
				'name' => $decode['data']['results'][$i]['user']['name'],
				'dob' =>  $decode['data']['results'][$i]['user']['birth_date'],
				'bio' =>  $decode['data']['results'][$i]['user']['bio'],
				'distance' => $decode['data']['results'][$i]['distance_mi'] . ' KM'
			];
			array_push($data, $getTomodachiData);
		}
		return $data;
	}
	function autoLikeTomodachi($uid, $s_number){
		$curl = curl_init();
		curl_setopt_array($curl, array(
		    CURLOPT_RETURNTRANSFER => 1,
		    CURLOPT_URL => "https://api.gotinder.com/like/$uid?locale=en&s_number=$s_number"
		));
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			'Accept: application/json',
			'app-version: 1020326',
			'Origin: https://tinder.com',
			'platform: web',
			'Referer: https://tinder.com/',
			'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36',
			'X-Auth-Token: xxx', //Feel Your Token Here!
			'x-supported-image-formats: webp,jpeg'
		));
		$resp = curl_exec($curl);
		curl_close($curl);
		return $resp;
	}
	function logTinder($log){
		file_put_contents('log/log.volk'.date("j.n.Y").'.log', $log, FILE_APPEND);
	}
}
?>