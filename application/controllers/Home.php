<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		if(isset($_POST["startsampling"]) && $_POST["startsampling"] == "1"){
			$this->konfigurasi_m->save_konfigurasi("id_sampling",@$_POST["id_sampling"]);
			$this->konfigurasi_m->save_konfigurasi("sta_alamat",@$_POST["sta_alamat"]);
			$this->konfigurasi_m->save_konfigurasi("sta_lat",@$_POST["sta_lat"]);
			$this->konfigurasi_m->save_konfigurasi("sta_lon",@$_POST["sta_lon"]);
			$this->konfigurasi_m->save_konfigurasi("sampler_operator_name",@$_POST["sampler_operator_name"]);
			$this->konfigurasi_m->save_konfigurasi("start_sampling","1");
			$data["_startsampling"] = 1;
		}
		
		if(isset($_POST["startsampling"]) && $_POST["startsampling"] == "2"){
			$this->konfigurasi_m->save_konfigurasi("sampler_operator_name","");
			$this->konfigurasi_m->save_konfigurasi("start_sampling","0");
		}
		
		$this->konfigurasi_m->save_konfigurasi("selenoid_state","q");
		
		if(!isset($_GET["unit"])) $_GET["unit"] = "";
		if($_GET["unit"] == "") $data['nextunit'] = "ppb";
		if($_GET["unit"] == "ppb") $data['nextunit'] = "ug";
		if($_GET["unit"] == "ug") $data['nextunit'] = "";
		$data['title'] = 'AQM';
		$data['all'] = $this->getdata_m->getall();
		$data['partikulats'] = $this->getdata_m->getParamsPartikulat();
		$data['partikulatflows'] = $this->getdata_m->getParamsPartikulatFlow();
		$data['partikulatattr'] = $this->getdata_m->getParamsPartikulatAttr();
		$data['gass'] = $this->getdata_m->getParamsGas();
		$data['cuacas'] = $this->getdata_m->getParamsCuaca();
		$data['configurations'] = $this->getdata_m->getConfigurations();
		
		$data["is_sampling"] = $this->konfigurasi_m->getConfigurationContent('is_sampling');
		$data["pump_control"] = $this->konfigurasi_m->getConfigurationContent('pump_control');
		$data["calibration_menu"] = $this->konfigurasi_m->getConfigurationContent('calibration_menu');
		
		$data["title_partikulat_gas"] = "";
		if(count($data['partikulats']) > 0) $data["title_partikulat_gas"] .= "Partikulat dan ";
		if(count($data['gass']) > 0) $data["title_partikulat_gas"] .= "Gas";
		if(substr($data["title_partikulat_gas"],-4) == "dan ") $data["title_partikulat_gas"] = "Partikulat";
		
		$data["title_cuacas"] = "";
		if(count($data['cuacas']) > 0) $data["title_cuacas"] = "Cuaca";
		
		$data["is_graph"] = false;
		$graph_fields = $this->getdata_m->getGraph(true);
		if(count($graph_fields) > 0){
			$data["is_graph"] = true;
			foreach($graph_fields as $graph_field){
				@$data["graph_fields"] .= "'".$graph_field."',";
			}
			$data["graph_fields"] = substr($data["graph_fields"],0,-1);
		}
		$graphs = $this->getdata_m->getGraph();
		$graph_data = "";
		foreach($graphs as $key => $graph){
			$graph_data .= "{time: '".$graph["waktu"]."', ";
			foreach($graph_fields as $graph_field){
				$graph_data .= " ".$graph_field.": ".$graph[$graph_field]." ,";
			}
			$graph_data = substr($graph_data,0,-1)."},";
		}
		$data["graph_data"] = $graph_data;
		$data["is_start_sampling"] = $this->konfigurasi_m->getConfigurationContent('start_sampling');
		
		$data["selenoid_state"] = @$data["configurations"]["selenoid_state"];
		$selenoid_names = explode(";",@$data["configurations"]["selenoid_names"]);
		$selenoid_commands = explode(";",@$data["configurations"]["selenoid_commands"]);
		
		$selenoid_state_id = array_search(@$data["configurations"]["selenoid_state"], $selenoid_commands);
		
		$data["selenoid_name"] = @$selenoid_names[@$selenoid_state_id];
		if(@$selenoid_state_id + 1 >= count(@$selenoid_commands)) $selenoid_state_id = -1;
		$data["nextselenoid_command"] = @$selenoid_commands[@$selenoid_state_id + 1];
		
		$this->temp_frontend->load('master/theme/theme', 'master/home/home', $data);
	}
	
	public function graph(){
		$data["is_graph"] = false;
		$graph_fields = $this->getdata_m->getGraph(true);
		if(count($graph_fields) > 0){
			$data["is_graph"] = true;
			foreach($graph_fields as $graph_field){
				@$data["graph_fields"] .= "'".$graph_field."',";
			}
			$data["graph_fields"] = substr($data["graph_fields"],0,-1);
		}
		$graphs = $this->getdata_m->getGraph();
		$graph_data = "";
		foreach($graphs as $key => $graph){
			$graph_data .= "{time: '".$graph["waktu"]."', ";
			foreach($graph_fields as $graph_field){
				$graph_data .= " ".$graph_field.": ".$graph[$graph_field]." ,";
			}
			$graph_data = substr($graph_data,0,-1)."},";
		}
		$data["graph_data"] = $graph_data;
		$this->load->view('master/home/graph',$data);
	}
	
	public function get_sampling_data(){
		$values = new stdClass;
		$values->device_id = $this->konfigurasi_m->getConfigurationContent('device_id');
		// $values->id_sampling = $values->device_id."-".date("Ymdhis");
		$values->id_sampling = "Sampling:".date("d-m-Y H:i:s");
		$values->sta_alamat = $this->konfigurasi_m->getConfigurationContent('sta_alamat');
		$values->sta_lat = $this->konfigurasi_m->getConfigurationContent('sta_lat');
		$values->sta_lon = $this->konfigurasi_m->getConfigurationContent('sta_lon');
		$values->sampler_operator_name = $this->konfigurasi_m->getConfigurationContent('sampler_operator_name');
		echo json_encode($values);
	}
	
	public function kalibrasi()
	{
	}
}
