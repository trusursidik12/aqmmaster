<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kalibrasi extends CI_Controller {

	public function index()
	{
		
		$data['title'] = 'Kalibrasi';
		$data['configurations'] = $this->getdata_m->getConfigurations();
		
		if(@$_GET["selenoid_command"] != "") $this->konfigurasi_m->save_konfigurasi("selenoid_state",$_GET["selenoid_command"]);
		if(@$_GET["purge_command"] != "") $this->konfigurasi_m->save_konfigurasi("purge_state",$_GET["purge_command"]);
		
		$data["selenoid_state"] = @$data["configurations"]["selenoid_state"];
		$data["selenoid_names"] = explode(";",@$data["configurations"]["selenoid_names"]);
		$data["selenoid_commands"] = explode(";",@$data["configurations"]["selenoid_commands"]);
		
		$data["calibration_menu"] = $this->konfigurasi_m->getConfigurationContent('calibration_menu');
		
		$this->temp_frontend->load('master/theme/theme', 'master/kalibrasi/kalibrasi', $data);
	}	
}
