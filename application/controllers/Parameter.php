<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parameter extends CI_Controller {

	public function index()
	{
		$data['title'] = 'List Parameter';
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
