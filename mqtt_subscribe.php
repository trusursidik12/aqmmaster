<?php
session_start();
require('phpMQTT.php');
define('BASEPATH', 'http://127.0.0.1/aqmmaster');
define('ENVIRONMENT', 'production');
include_once "application/config/database.php";
$db = new mysqli($db['default']['hostname'], $db['default']['username'], $db['default']['password'], $db['default']['database']);
$client_id = session_id();
$client_id = "kc4pnmb9a6eqksde4bug87k6fl";
$sta_id = $db->query("SELECT content FROM aqm_configuration WHERE data='sta_id'")->fetch_object()->content;
$sta_id = "TP2500-17-KLH-04";
$sta_id = "portable_sampler";
$id_sampling = $db->query("SELECT content FROM aqm_configuration WHERE data='id_sampling'")->fetch_object()->content;
$sampler_operator_name = $db->query("SELECT content FROM aqm_configuration WHERE data='sampler_operator_name'")->fetch_object()->content;
$start_sampling = $db->query("SELECT content FROM aqm_configuration WHERE data='start_sampling'")->fetch_object()->content;
// echo "\n".$client_id."\n";
// echo "\n".$sta_id."\n";

$server = '202.73.26.177';     // change if necessary
$port = 8883;                     // change if necessary
$username = 'ClientKLHK';                   // set your username
$password = 'KLHK2016-2019project';                   // set your password


$mqtt = new Bluerhinos\phpMQTT($server, $port, $client_id);
if(!$mqtt->connect(true, NULL, $username, $password)) {
	exit(1);
}
echo "TOPIK : \"".$argv[1]."\"\n";
$mqtt->debug = true;
$topics[$argv[1]] = array('qos' => 0, 'function' => 'procMsg');
$mqtt->subscribe($topics, 0);

while($mqtt->proc()) {

}

$mqtt->close();

function procMsg($topic, $msg){
		echo '===> Msg Recieved: ' . date('r') . "\n";
		echo "===> Topic: {$topic}\n";
		echo "===> $msg\n\n";
}


?>