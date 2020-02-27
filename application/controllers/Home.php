<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		if(!isset($_GET["unit"])) $_GET["unit"] = "";
		if($_GET["unit"] == "") $data['nextunit'] = "ppb";
		if($_GET["unit"] == "ppb") $data['nextunit'] = "ug";
		if($_GET["unit"] == "ug") $data['nextunit'] = "";
		$data['title'] = 'AQM';
		$data['all'] = $this->getdata_m->getall();
		$data['partikulats'] = $this->getdata_m->getParamsPartikulat();
		$data['partikulatflows'] = $this->getdata_m->getParamsPartikulatFlow();
		$data['gass'] = $this->getdata_m->getParamsGas();
		$data['cuacas'] = $this->getdata_m->getParamsCuaca();
		$data['configurations'] = $this->getdata_m->getConfigurations();
		$data['is_graph'] = false;
		$this->temp_frontend->load('master/theme/theme', 'master/home/home', $data);
	}
}
