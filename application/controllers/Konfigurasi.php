<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konfigurasi extends CI_Controller {

	public function index()
	{
		$data['title'] = 'Konfigurasi';
		$data['alldata'] = $this->konfigurasi_m->getdata();
		$this->temp_frontend->load('master/theme/theme', 'master/konfigurasi/konfigurasi', $data);
	}	

	
}
