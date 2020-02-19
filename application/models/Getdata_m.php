<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Getdata_m extends CI_Model {

	public function getAll($id = FALSE){
		if($id === FALSE){
			$this->db->order_by('id', 'DESC');
			$this->db->limit('1');
			$query = $this->db->get('aqm_sensor_values');
			return $query->result_array();
		}
		$query = $this->db->get_where('aqm_sensor_values', array('id' => $id));
		return $query->row_array();
	}

}