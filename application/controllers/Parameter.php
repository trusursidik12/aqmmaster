<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parameter extends CI_Controller {

	public function index()
	{
		if($this->input->post('simpan')){
			foreach($_POST["caption"] as $param_id => $caption){
				$values = ["param_id" => $param_id];
				$values = $values + ["caption" => $caption];
				$values = $values + ["default_unit" => $_POST["default_unit"][$param_id]];
				$values = $values + ["molecular_mass" => $_POST["molecular_mass"][$param_id]];
				if($_POST["molecular_mass"][$param_id] > 0)
					$values = $values + ["formula" => $_POST["formula"][$param_id]];
				$values = $values + ["gain" => (@$_POST["gain"][$param_id] * 1)];
				$values = $values + ["offset" => (@$_POST["offset"][$param_id] * 1)];
				$values = $values + ["is_view" => (@$_POST["is_view"][$param_id] * 1)];
				$values = $values + ["is_graph" => (@$_POST["is_graph"][$param_id] * 1)];
				$this->parameter_m->save_parameter($values);
			}
		}
		
		$data['title'] = 'Parameter';
		$data['alldata'] = $this->parameter_m->getDataParameter();
		$this->temp_frontend->load('master/theme/theme', 'master/parameter/parameter', $data);
	}	

	public function edit($id = NULL){
		$data['alldata'] = $this->parameter_m->getDataParameter($id);
		$data['title'] = 'Edit Parameter';

		if(empty($data['alldata'])){
			show_404();
		}

		$this->form_validation->set_rules('param_id', 'DATA', 'required|callback_param_id_check');

		$this->form_validation->set_message('required', '%s Tidak Boleh Kosong ..');

		if($this->form_validation->run() === FALSE){
			$this->temp_frontend->load('master/theme/theme', 'master/parameter/parameter_form_edit', $data);
		} else {
			$this->parameter_m->update_parameter();
			redirect('parameter');
		}
	}

	public function param_id_check()
	{
		$post = $this->input->post(null, TRUE);
		$query = $this->db->query("SELECT * FROM aqm_params WHERE param_id = '$post[param_id]' AND id != '$post[id]'");
		if($query->num_rows() > 0){
			$this->form_validation->set_message('data_check', '{field} Sudah Ada, Silakan Input Data Yang Berbada');
			return FALSE;
		}
			return TRUE;
	}
}
