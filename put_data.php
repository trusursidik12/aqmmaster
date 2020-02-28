<?php
$server_host = "103.247.11.149";
define('BASEPATH', 'http://127.0.0.1/aqmmaster');
define('ENVIRONMENT', 'production');
include_once "application\config\database.php";
$db = new mysqli($db['default']['hostname'], $db['default']['username'], $db['default']['password'], $db['default']['database']);

if($result = $db->query("SELECT * FROM aqm_data WHERE (sent is NULL OR sent = 0) ORDER BY id LIMIT 50")){
	$key = -1;
	while($data = $result->fetch_object()){
		$key++;
		$arr[$key]["data"]["id"] = $data->id;
		$arr[$key]["data"]["id_stasiun"] = $data->id_stasiun;
		$arr[$key]["data"]["waktu"] = $data->waktu;
		$arr[$key]["data"]["pm10"] = $data->pm10;
		$arr[$key]["data"]["pm25"] = $data->pm25;
		$arr[$key]["data"]["so2"] = $data->so2;
		$arr[$key]["data"]["co"] = $data->co;
		$arr[$key]["data"]["o3"] = $data->o3;
		$arr[$key]["data"]["no2"] = $data->no2;
		$arr[$key]["data"]["hc"] = $data->hc;
		$arr[$key]["data"]["ws"] = $data->ws;
		$arr[$key]["data"]["wd"] = $data->wd;
		$arr[$key]["data"]["humidity"] = $data->humidity;
		$arr[$key]["data"]["temperature"] = $data->temperature;
		$arr[$key]["data"]["pressure"] = $data->pressure;
		$arr[$key]["data"]["sr"] = $data->sr;
		$arr[$key]["data"]["rain_intensity"] = $data->rain_intensity;
		$arr[$key]["data"]["voc"] = $data->voc;
		$arr[$key]["data"]["nh3"] = $data->nh3;
		$arr[$key]["data"]["h2s"] = $data->h2s;
		$arr[$key]["data"]["cs2"] = $data->cs2;
	}
}
echo "<pre>";
print_r($arr);
echo "</pre>";
if(isset($arr)){
	foreach($arr as $key => $_data){
		$data = json_encode($_data["data"]);
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "http://".$server_host."/server_side/api/put_data.php",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "PUT",
			CURLOPT_USERPWD => "KLHK-2019:Project2016-2019",
			CURLOPT_POSTFIELDS => $data,
			CURLOPT_HTTPHEADER => array(
				"Api-Key: VHJ1c3VyVW5nZ3VsVGVrbnVzYV9wVA==",
				"cache-control: no-cache",
				"content-type: application/json"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			if(strpos(" ".$response,"success") > 0){
				$db->query("UPDATE aqm_data SET sent=1 WHERE id = '".$_data["data"]["id"]."'");
				echo $response;
			} else {
				echo $response;
			}
		}
	}
}

?>