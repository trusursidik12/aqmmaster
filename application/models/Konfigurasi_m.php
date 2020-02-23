<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konfigurasi_m extends CI_Model {

	public function getSerialPorts(){
		$query = $this->db->get('serial_ports');
		return $query->result_array();
	}
	
	public function getConfigurationContent($data){
		$query = $this->db->get_where('aqm_configuration', ["data" => $data]);
		return $query->row_array()['content'];
	}
	
	public function getDataKonfigurasi($id = FALSE){
		if($id === FALSE){
			$this->db->order_by('id', 'ASC');
			$query = $this->db->get('aqm_configuration');
			return $query->result_array();
		}
		$query = $this->db->get_where('aqm_configuration', array('id' => $id));
		return $query->row_array();
	}

	public function save_konfigurasi($data,$content){
		$this->db->where('data', $data);
		return $this->db->update('aqm_configuration', ["content" => $content]);
	}
	
	public function update_konfigurasi(){
		$data = array(
			'data' 		=> $this->input->post('data'),
			'content'	=> $this->input->post('content'),
			'is_view'	=> $this->input->post('is_view')
		);
		$this->db->where('id', $this->input->post('id'));
		return $this->db->update('aqm_configuration', $data);
	}

}