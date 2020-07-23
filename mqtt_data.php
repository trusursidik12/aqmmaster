<?php
session_start();
$server = '202.73.26.177';
$port = 8883;
$username = 'ClientKLHK';
$password = 'KLHK2016-2019project';
require('phpMQTT.php');
define('BASEPATH', 'http://127.0.0.1/aqmmaster');
define('ENVIRONMENT', 'production');
include_once "application/config/database.php";
echo $client_id = session_id().date("YmdHis");
echo "<br>";
$db = new mysqli($db['default']['hostname'], $db['default']['username'], $db['default']['password'], $db['default']['database']);
$sta_id = $db->query("SELECT content FROM aqm_configuration WHERE data='sta_id'")->fetch_object()->content;
$id_sampling = $db->query("SELECT content FROM aqm_configuration WHERE data='id_sampling'")->fetch_object()->content;
$sampler_operator_name = $db->query("SELECT content FROM aqm_configuration WHERE data='sampler_operator_name'")->fetch_object()->content;
$start_sampling = $db->query("SELECT content FROM aqm_configuration WHERE data='start_sampling'")->fetch_object()->content;
if($_GET["mode"] == "send_data_sampler" && $id_sampling != "" && $sampler_operator_name != "" && $start_sampling == "1"){
	$sta_alamat = $db->query("SELECT content FROM aqm_configuration WHERE data='sta_alamat'")->fetch_object()->content;
	$sta_lat = $db->query("SELECT content FROM aqm_configuration WHERE data='sta_lat'")->fetch_object()->content;
	$sta_lon = $db->query("SELECT content FROM aqm_configuration WHERE data='sta_lon'")->fetch_object()->content;
	echo $data = str_replace(" ","+",$id_sampling).",".$sta_id.",".str_replace(" ","+",$sampler_operator_name).",".str_replace(" ","+",$sta_alamat).",".$sta_lat.",".$sta_lon.";";
	echo "<br>";

	exec("cd aes_ubuntu && ./AES encode ".$data,$outputs);
	foreach($outputs as $output){
		if(stripos(" ".$output,"!=!enc!=!") > 0) $encdata = $output;
	}
	
	if(stripos(" ".$encdata,"!=!enc!=!") <= 0){ //try windows mode
		exec("cd aes_ubuntu && AES.exe encode ".$data,$outputs);
		foreach($outputs as $output){
			if(stripos(" ".$output,"!=!enc!=!") > 0) $encdata = $output;
		}
	}

	echo $encdata."<br>";
	if(stripos(" ".$encdata,"!=!enc!=!") > 0){ 
		$mqtt = new Bluerhinos\phpMQTT($server, $port, $client_id);

		if ($mqtt->connect(true, NULL, $username, $password)) {
			$mqtt->publish("portable_sampler", $encdata, 0, false);
			$mqtt->close();
			echo "1";
			$db->query("UPDATE aqm_configuration SET content='2' WHERE data='start_sampling'");
		} else {
			echo "Time out!<br>";
		}
	} else {
		echo "Data Encription Error<br>";
	}

} else if($_GET["mode"] == "send_data_sampling" && $id_sampling != "" && $sampler_operator_name != "" && $start_sampling == "2") {
	//id_sampling,serial_number,waktu,pm10,so2,co,o3,no2,pm25,hc,voc,nh3,ws,wd,humidity,temperature,pressure
	// Sampling:15-02-2020 09:54:16,TP2500-17-KLH-03,15022020 142519,-1,-1,-1,-1,-1,5,-1,-1,-1,-1,-1,31,41.6,1010.4
	// ddMMyyyy HHmmss
	if($aqm = $db->query("SELECT * FROM aqm_data WHERE sent2 = 0 AND sampler_operator_name LIKE '".$sampler_operator_name."' AND id_sampling LIKE '".$id_sampling."' ORDER BY id LIMIT 1")->fetch_object()){	 
		// $waktu = $aqm->waktu;
		$waktu = date("dmY His",strtotime($aqm->waktu));
		$pm10 = $aqm->pm10 * 1;
		$so2 = $aqm->so2 * 1;
		$co = $aqm->co * 1;
		$o3 = $aqm->o3 * 1;
		$no2 = $aqm->no2 * 1;
		$pm25 = $aqm->pm25 * 1;
		$hc = $aqm->hc * 1;
		$voc = $aqm->voc * 1;
		$nh3 = $aqm->nh3 * 1;
		$ws = $aqm->ws;
		$wd = $aqm->wd;
		$humidity = $aqm->humidity;
		$temperature = $aqm->temperature;
		$pressure = $aqm->pressure;
		echo $data = str_replace(" ","+",$id_sampling).",".$sta_id.",".str_replace(" ","+",$waktu).",".$pm10.",".$so2.",".$co.",".$o3.",".$no2.",".$pm25.",".$hc.",".$voc.",".$nh3.",".$ws.",".$wd.",".$humidity.",".$temperature.",".$pressure.";";
		echo "<br>";

		exec("cd aes_ubuntu && ./AES encode ".$data,$outputs);
		foreach($outputs as $output){
			if(stripos(" ".$output,"!=!enc!=!") > 0) $encdata_portable = $output;
		}
		if(stripos(" ".$encdata,"!=!enc!=!") <= 0){ //try windows mode
			exec("cd aes_ubuntu && AES.exe encode ".$data,$outputs);
			foreach($outputs as $output){
				if(stripos(" ".$output,"!=!enc!=!") > 0) $encdata_portable = $output;
			}
		}
		echo $encdata_portable."<br>";
		if(stripos(" ".$encdata_portable,"!=!enc!=!") > 0){ 
			$mqtt = new Bluerhinos\phpMQTT($server, $port, $client_id);

			if ($mqtt->connect(true, NULL, $username, $password)) {
				$mqtt->publish("portable", $encdata_portable, 0, false);
				$mqtt->close();
				echo "1";
				$db->query("UPDATE aqm_data SET sent2='1' WHERE id='".$aqm->id."'");
			} else {
				echo "Time out!<br>";
			}
		} else {
			echo "Data Encription Error<br>";
		}
	} else {
		echo "0";
	}
} else {
	echo "0";
}

?>