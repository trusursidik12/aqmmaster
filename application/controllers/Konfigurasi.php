<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konfigurasi extends CI_Controller {

	public function index()
	{
		$data['title'] = 'List Konfigurasi';
		$data['alldata'] = $this->konfigurasi_m->getDataKonfigurasi();
		$this->temp_frontend->load('master/theme/theme', 'master/konfigurasi/konfigurasi', $data);
	}	

	public function edit($id = NULL){
		$data['alldata'] = $this->konfigurasi_m->getDataKonfigurasi($id);
		$data['title'] = 'Edit Konfigurasi';

		if(empty($data['alldata'])){
			show_404();
		}

		$this->form_validation->set_rules('data', 'DATA', 'required|callback_data_check');

		$this->form_validation->set_message('required', '%s Tidak Boleh Kosong ..');

		if($this->form_validation->run() === FALSE){
			$this->temp_frontend->load('master/theme/theme', 'master/konfigurasi/konfigurasi_form_edit', $data);
		} else {
			$this->konfigurasi_m->update_konfigurasi();
			redirect('konfigurasi');
		}
	}

	public function data_check()
	{
		$post = $this->input->post(null, TRUE);
		$query = $this->db->query("SELECT * FROM aqm_configuration WHERE data = '$post[data]' AND id != '$post[id]'");
		if($query->num_rows() > 0){
			$this->form_validation->set_message('data_check', '{field} Sudah Ada, Silakan Input Data Yang Berbada');
			return FALSE;
		}
			return TRUE;
	}
}
