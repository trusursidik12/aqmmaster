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

	public function save_parameter($values){
		$this->db->where('param_id', $values["param_id"]);
		$data = ["caption" => $values["caption"]];
		$data = $data + ["default_unit" => $values["default_unit"]];
		$data = $data + ["molecular_mass" => $values["molecular_mass"]];
		if(isset($data["formula"]))
			$data = $data + ["formula" => $values["formula"]];
		$data = $data + ["gain" => $values["gain"]];		
		$data = $data + ["offset" => $values["offset"]];		
		$data = $data + ["is_view" => $values["is_view"]];		
		return $this->db->update('aqm_params', $data);
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