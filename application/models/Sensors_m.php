<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class sensors_m extends CI_Model {

	public function getValues(){
		$query = $this->db->get_where('aqm_sensor_values', ['id' => '1']);
		return $query->row_array();
	}
	
	public function getFactors(){
		$query = $this->db->get('aqm_calibration_factor');
		return $query->result_array();
	}
	
	public function getFormula($param_id){
		$query = $this->db->get_where('aqm_params', ['param_id' => $param_id]);
		return $query->row_array();
	}
	
	public function getParams(){
		$query = $this->db->get_where('aqm_params',['is_view' => '1']);
		return $query->result_array();
	}
	
	public function getPumpState(){
		$query = $this->db->get_where('aqm_configuration', ['data' => 'pump_state']);
		return $query->row_array()["content"];
	}
	
	public function getPumpInterval(){
		$query = $this->db->get_where('aqm_configuration', ['data' => 'pump_interval']);
		return $query->row_array()["content"];
	}
	
	public function getPumpLast(){
		$query = $this->db->get_where('aqm_configuration', ['data' => 'pump_last']);
		return $query->row_array()["content"];
	}
	
	public function changePumpState($state){
		$pump_state = ($state == 'false') ? '0' : '1';
		$this->db->where('data', 'pump_state');
		$this->db->update('aqm_configuration', ['content' => $pump_state]);
		$this->db->where('data', 'pump_last');
		$this->db->update('aqm_configuration', ['content' => date("Y-m-d H:i:s")]);
		return $pump_state;
	}
}