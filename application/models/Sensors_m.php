<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sensors_m extends CI_Model {

	public function getValues(){
		$query = $this->db->get_where('aqm_sensor_values', array('id' => '1'));
		return $query->row_array();
	}

}