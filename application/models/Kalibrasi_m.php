<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kalibrasi_m extends CI_Model {

	public function getData($id = FALSE){
		if($id === FALSE){
			$this->db->where('is_view', '1');
			$query = $this->db->get('aqm_configuration');
			return $query->result_array();
		}
		$query = $this->db->get_where('aqm_configuration', array('id' => $id));
		return $query->row_array();
	}

	public function update_aqm_configuration(){
		$data = array(
			// 'sta_nama' 			=> $this->input->post('sta_nama'),
			// 'sta_id' 			=> $this->input->post('sta_id'),
			// 'sta_alamat' 		=> $this->input->post('sta_alamat'),
			// 'sta_kota' 			=> $this->input->post('sta_kota'),
			// 'sta_prov' 			=> $this->input->post('sta_prov'),
			// 'sta_lat' 			=> $this->input->post('sta_lat'),
			// 'sta_lon' 			=> $this->input->post('sta_lon'),
			// 'com_ws' 			=> $this->input->post('com_ws'),
			// 'com_modem' 		=> $this->input->post('com_modem'),
			// 'baud_ws' 			=> $this->input->post('baud_ws'),
			// 'baud_modem' 		=> $this->input->post('baud_modem'),
			// 'data_server' 		=> $this->input->post('data_server'),
			// 'com_pm10' 			=> $this->input->post('com_pm10'),
			// 'com_pm25' 			=> $this->input->post('com_pm25'),
			// 'baud_pm10' 		=> $this->input->post('baud_pm10'),
			// 'baud_pm25' 		=> $this->input->post('baud_pm25'),
			// 'controller' 		=> $this->input->post('controller'),
			// 'controller_baud' 	=> $this->input->post('controller_baud'),
			// 'pump_interval' 	=> $this->input->post('pump_interval'),
			'pump_state' 		=> $this->input->post('pump_state')
			// 'pump_last' 		=> $this->input->post('pump_last')
		);
		$this->db->where('id', $this->input->post('id'));
		return $this->db->update('aqm_configuration', $data);
	}

}