<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sensors extends CI_Controller {

	public function index(){
		$values = new stdClass;
		$formula = "";
		$sensors = $this->sensors_m->getvalues();
		$AIN0 		= $sensors["AIN0"];
		$AIN1 		= $sensors["AIN1"];
		$AIN2 		= $sensors["AIN2"];
		$AIN3 		= $sensors["AIN3"];
		$PM25 		= $sensors["PM25"];
		$PM10 		= $sensors["PM10"];
		$WS	  		= $sensors["WS"];
		$xtimestamp	= $sensors["xtimestamp"];
		
		$factors = $this->sensors_m->getFactors();
		foreach($factors as $_factor){
			$factor[$_factor["faktor"]] = $_factor["nilai"] * 1;
		}
		
		$params = $this->sensors_m->getParams();
		foreach($params as $_param){
			$param_id = $_param["param_id"];
			$formula = $this->sensors_m->getFormula("formula_".$param_id);
			if(isset($formula["content"])){
				$formula = $formula["content"];
				eval("\$$param_id = $formula;");
				eval("\$values->$param_id = \$$param_id;");
			}
			unset($formula);
		}
		
		$data["values"] = json_encode($values);
		
		$this->load->view('master/ajax/sensor',$data);
	}
}
