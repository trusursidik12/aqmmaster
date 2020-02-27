<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		if(!isset($_GET["unit"])) $_GET["unit"] = "";
		if($_GET["unit"] == "") $data['nextunit'] = "ppb";
		if($_GET["unit"] == "ppb") $data['nextunit'] = "ug";
		if($_GET["unit"] == "ug") $data['nextunit'] = "";
		$data['title'] = 'AQM';
		$data['all'] = $this->getdata_m->getall();
		$data['partikulats'] = $this->getdata_m->getParamsPartikulat();
		$data['partikulatflows'] = $this->getdata_m->getParamsPartikulatFlow();
		$data['gass'] = $this->getdata_m->getParamsGas();
		$data['cuacas'] = $this->getdata_m->getParamsCuaca();
		$data['configurations'] = $this->getdata_m->getConfigurations();
		
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
}
