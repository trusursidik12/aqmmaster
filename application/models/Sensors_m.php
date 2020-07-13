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

	public function insert_aqm_data_log($values){
		$this->db->where("(waktu < ('".date("Y-m-d H:i:s")."' - INTERVAL 3 HOUR))");
		$this->db->delete('aqm_data_log');
		$this->db->insert('aqm_data_log', $values);
		return 1;
	}
	
	public function get_aqm_data_range($minute){
		$query = $this->db->order_by('waktu DESC');
		$query = $this->db->get('aqm_data_log');
		@$id_end = $query->row_array()["id"];
		$lasttime = date("Y-m-d H:i:%",mktime(date("H"),date("i")-$minute));
		$mm = date("i") * 1;
		$waktu = date("Y-m-d H:i");
		if($mm % $minute == 0 && $this->session->userdata('lastPutData') != $waktu) {
			$query = $this->db->where("waktu >= '".$lasttime.":00'");
			$query = $this->db->where("is_sent=0");
			$query = $this->db->order_by('waktu');
			$query = $this->db->get('aqm_data_log');
			@$id_start = $query->row_array()["id"];
			if($id_start > 0){
				$query = $this->db->where("id BETWEEN '".$id_start."' AND '".$id_end."' AND is_sent=0");
				$query = $this->db->get('aqm_data_log');
				$data["id_start"] = $id_start;
				$data["id_end"] = $id_end;
				$data["waktu"] = $waktu.":00";
				$data["data"] = $query->result_array();
				return $data;
			} else {
				return 0;
			}
		} else {
			return 0;
		}
	}
	
	public function get_id_stasiun(){
		$query = $this->db->get_where('aqm_configuration', ['data' => 'sta_id']);
		return $query->row_array()["content"];
	}

	public function insert_aqm_data($values,$id_start,$id_end){
		$this->db->where("id BETWEEN '".$id_start."' AND '".$id_end."'");
		$this->db->update('aqm_data_log',["is_sent" => "1", "sent_at" => date("Y-m-d H:i:s")]);
		$this->db->insert('aqm_data', $values);
		return 1;
	}
}