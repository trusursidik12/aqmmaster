<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kalibrasi extends CI_Controller {

	// public function index()
	// {
	// 	$data['alldata'] = $this->kalibrasi_m->getdata();
	// 	$this->temp_frontend->load('master/theme/theme', 'master/kalibrasi/kalibrasi', $data);
	// }

	

	public function update(){
		$data['alldata'] = $this->kalibrasi_m->getdata();
		$data['titlebar'] = 'Kalibrasi';

		if(empty($data['alldata'])){
			show_404();
		}

		$this->form_validation->set_rules('sta_nama', 'Nama Stasiun', 'required');

		$this->form_validation->set_message('required', '%s Kosong, Silakan Input..');

		if($this->form_validation->run() === FALSE){
			$this->temp_frontend->load('master/theme/theme', 'master/kalibrasi/kalibrasi', $data);
		} else {
			$this->kalibrasi_m->update_aqm_configuration();
			redirect(site_url());
		}
	}
}
