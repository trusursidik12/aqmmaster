<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$data['title'] = 'Aqm Master';
		$data['all'] = $this->getdata_m->getall();
		$data['partikulats'] = $this->getdata_m->getParamsPartikulat();
		$data['gass'] = $this->getdata_m->getParamsGas();
		$data['cuacas'] = $this->getdata_m->getParamsCuaca();
		$this->temp_frontend->load('master/theme/theme', 'master/home/home', $data);
	}
}
