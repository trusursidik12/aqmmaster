<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$data['all'] = $this->getdata_m->getall();
		$this->temp_frontend->load('master/theme/theme', 'master/home/home', $data);
	}
}
