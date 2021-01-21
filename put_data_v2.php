<?php
define('BASEPATH', 'http://127.0.0.1/aqmmaster');
define('ENVIRONMENT', 'production');
include_once "application/config/database.php";
$db = new mysqli($db['default']['hostname'], $db['default']['username'], $db['default']['password'], $db['default']['database']);

$stat_pm10 = @$db->query("SELECT is_view FROM aqm_params WHERE param_id='pm10' LIMIT 1")->fetch_object()->is_view * 1;
$stat_pm25 = @$db->query("SELECT is_view FROM aqm_params WHERE param_id='pm25' LIMIT 1")->fetch_object()->is_view * 1;
$stat_so2 = @$db->query("SELECT is_view FROM aqm_params WHERE param_id='so2' LIMIT 1")->fetch_object()->is_view * 1;
$stat_co = @$db->query("SELECT is_view FROM aqm_params WHERE param_id='co' LIMIT 1")->fetch_object()->is_view * 1;
$stat_o3 = @$db->query("SELECT is_view FROM aqm_params WHERE param_id='o3' LIMIT 1")->fetch_object()->is_view * 1;
$stat_no2 = @$db->query("SELECT is_view FROM aqm_params WHERE param_id='no2' LIMIT 1")->fetch_object()->is_view * 1;
$stat_hc = @$db->query("SELECT is_view FROM aqm_params WHERE param_id='hc' LIMIT 1")->fetch_object()->is_view * 1;

if($result = $db->query("SELECT * FROM aqm_data WHERE (sent2 is NULL OR sent2 = 0) AND waktu >= '2020-06-11 11:00:00' ORDER BY id LIMIT 50")){
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
if(isset($arr)){
	$token = "";
	$data = json_encode(["username" => "pt_trusur_unggul_teknusa","password" => "c6eXK8EUpbuCoaki"]);
	$curl = curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://iku.menlhk.go.id/api/v1/auth",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_SSL_VERIFYHOST => 0,
	  CURLOPT_SSL_VERIFYPEER => 0,
	  CURLOPT_POSTFIELDS => $data,
	  CURLOPT_HTTPHEADER => array(
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
		$response = json_decode ($response,true);
		$token = $response["token"];
	}
	
	if($token != ""){
		foreach($arr as $key => $_data){
			$_arr["id_stasiun"] = $_data["data"]["id_stasiun"];
			$_arr["waktu"] = $_data["data"]["waktu"];
			$_arr["pm10"] = $_data["data"]["pm10"];
			$_arr["pm25"] = $_data["data"]["pm25"];
			$_arr["so2"] = $_data["data"]["so2"];
			$_arr["co"] = $_data["data"]["co"];
			$_arr["o3"] = $_data["data"]["o3"];
			$_arr["no2"] = $_data["data"]["no2"];
			$_arr["hc"] = $_data["data"]["hc"];
			$_arr["ws"] = $_data["data"]["ws"];
			$_arr["wd"] = $_data["data"]["wd"];
			$_arr["stat_pm10"] = $stat_pm10;
			$_arr["stat_pm25"] = $stat_pm25;
			$_arr["stat_so2"] = $stat_so2;
			$_arr["stat_co"] = $stat_co;
			$_arr["stat_o3"] = $stat_o3;
			$_arr["stat_no2"] = $stat_no2;
			$_arr["stat_hc"] = $stat_hc;
			$_arr["humidity"] = $_data["data"]["humidity"];
			$_arr["temperature"] = $_data["data"]["temperature"];
			$_arr["pressure"] = $_data["data"]["pressure"];
			$_arr["sr"] = $_data["data"]["sr"];
			$_arr["rain_intensity"] = $_data["data"]["rain_intensity"];
			$data = json_encode($_arr);
			$curl = curl_init();
			curl_setopt_array($curl, array(
			  CURLOPT_URL => "https://iku.menlhk.go.id/api/v1/aqmdata",
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "POST",
			  CURLOPT_SSL_VERIFYHOST => 0,
			  CURLOPT_SSL_VERIFYPEER => 0,
			  CURLOPT_POSTFIELDS => $data,
			  CURLOPT_HTTPHEADER => array(
				"cache-control: no-cache",
				"content-type: application/json",
				sprintf('Authorization: Bearer %s', $token)
			  ),
			));

			$response = curl_exec($curl);
			$err = curl_error($curl);

			curl_close($curl);

			if ($err) {
			  echo "cURL Error #:" . $err;
			} else {
				echo "\n".$_data["data"]["id_stasiun"]." => ".$response;
				if(strpos(" ".$response,"\"status\":1") > 0){
					$db->query("UPDATE aqm_data SET sent2=1 WHERE id = '".$_data["data"]["id"]."'");
				}
			}
		}
	}
}

?>