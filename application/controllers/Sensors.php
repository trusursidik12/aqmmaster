<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sensors extends CI_Controller {

	public function index(){
		$values = new stdClass;
		$sensors = $this->sensors_m->getvalues();
		$AIN0 		= $sensors["AIN0"];
		$AIN1 		= $sensors["AIN1"];
		$AIN2 		= $sensors["AIN2"];
		$AIN3 		= $sensors["AIN3"];
		$PM25 		= $sensors["PM25"];
		$PM10 		= $sensors["PM10"];
		$WS	  		= $sensors["WS"];
		$xtimestamp	= $sensors["xtimestamp"];
		
		$factor["ah2s"] = $this->sensors_m->getCalibrationFactor("ah2s")["nilai"];
		
		$formula_h2s = $this->sensors_m->getFormula("formula_h2s")["content"];
		eval("\$h2s = $formula_h2s;");
		$values->h2s = $h2s;
		$data["values"] = json_encode($values);
		
		$this->load->view('master/ajax/sensor',$data);
	}
}
