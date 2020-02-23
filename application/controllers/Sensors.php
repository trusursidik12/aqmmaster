<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class sensors extends CI_Controller {

	public function index(){
		$values = new stdClass;
		$formula = "";
		$sensors = $this->sensors_m->getvalues();
		@$AIN0 		= $sensors["AIN0"];
		@$AIN1 		= $sensors["AIN1"];
		@$AIN2 		= $sensors["AIN2"];
		@$AIN3 		= $sensors["AIN3"];
		@$PM25 		= $sensors["PM25"];
		@$PM10 		= $sensors["PM10"];
		@$WS	  		= $sensors["WS"];
		@$xtimestamp	= $sensors["xtimestamp"];
		
		$factors = $this->sensors_m->getFactors();
		foreach($factors as $_factor){
			$factor[$_factor["faktor"]] = $_factor["nilai"] * 1;
		}
		
		$params = $this->sensors_m->getParams();
		foreach($params as $_param){
			$param_id = $_param["param_id"];
			$param_id_unit = $_param["param_id"]."_unit";
			$default_unit = $_param["default_unit"];
			$molecular_mass = $_param["molecular_mass"];
			$gain = $_param["gain"];
			$offset = $_param["offset"];
			@$formula = $this->sensors_m->getFormula($param_id)["formula"];
			@eval("\$$param_id = $formula;");
			if(isset($_GET["unit"]) && $molecular_mass > 0 ){
				if($_GET["unit"] == "ppb"){
					@eval("\$$param_id = round(\$$param_id * 1000,0);");
					$default_unit = "ppb";
				}
				if($_GET["unit"] == "ug"){
					@eval("\$$param_id = round(\$$param_id * $molecular_mass / 24.45 * 1000,0);");
					$default_unit = "ug/m3";
				}
			}
			$values->$param_id_unit = $default_unit;
			@eval("if(\$$param_id < 0) \$$param_id = 0;");
			@eval("\$values->$param_id = \$$param_id;");
			unset($formula);
		}
		
		$data["values"] = json_encode($values);
		
		$this->load->view('master/ajax/sensor',$data);
	}
}
