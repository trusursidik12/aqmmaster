<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parameter_m extends CI_Model {

	public function getDataParameter($id = FALSE){
		if($id === FALSE){
			$this->db->order_by('id', 'ASC');
			$query = $this->db->get('aqm_params');
			return $query->result_array();
		}
		$query = $this->db->get_where('aqm_params', array('id' => $id));
		return $query->row_array();
	}

	public function update_parameter(){
		$data = array(
			'param_id' 	=> $this->input->post('param_id'),
			'caption'	=> $this->input->post('caption'),
			'satuan'	=> $this->input->post('satuan'),
			'is_view'	=> $this->input->post('is_view')
		);
		$this->db->where('id', $this->input->post('id'));
		return $this->db->update('aqm_params', $data);
	}

}