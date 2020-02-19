<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sensors_m extends CI_Model {

	public function getValues(){
		$query = $this->db->get_where('aqm_sensor_values', ['id' => '1']);
		return $query->row_array();
	}
	
	public function getFactors(){
		$query = $this->db->get('aqm_calibration_factor');
		return $query->result_array();
	}
	
	public function getFormula($formula_name){
		$query = $this->db->get_where('aqm_configuration', ['data' => $formula_name]);
		return $query->row_array();
	}
	
	public function getCalibrationFactor($factor){
		$query = $this->db->get_where('aqm_calibration_factor', ['faktor' => $factor]);
		return $query->row_array();
	}
	
	public function getParams(){
		$query = $this->db->get_where('aqm_params',['is_view' => '1']);
		return $query->result_array();
	}

}