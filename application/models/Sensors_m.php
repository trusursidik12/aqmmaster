<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sensors_m extends CI_Model {

	public function getValues(){
		$query = $this->db->get_where('aqm_sensor_values', array('id' => '1'));
		return $query->row_array();
	}
	
	public function getFormula($formula_name){
		$query = $this->db->get_where('aqm_configuration', array('data' => $formula_name));
		return $query->row_array();
	}
	
	public function getCalibrationFactor($factor){
		$query = $this->db->get_where('aqm_calibration_factor', array('faktor' => $factor));
		return $query->row_array();
	}

}