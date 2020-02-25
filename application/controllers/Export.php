<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Export extends CI_Controller {

	public function index()
	{		
		$data['title'] = 'Data';
		$this->temp_frontend->load('master/theme/theme', 'master/data/data_export', $data);
	}
}
