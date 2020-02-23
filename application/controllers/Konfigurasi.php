<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konfigurasi extends CI_Controller {

	public function index()
	{
		$data['title'] = 'Konfigurasi';
		$data['configurations'][0]['id'] = "device_id";
		$data['configurations'][0]['caption'] = "Device ID";
		$data['configurations'][0]['value'] = $this->konfigurasi_m->getConfigurationContent('device_id');
		$data['configurations'][1]['id'] = "sta_id";
		$data['configurations'][1]['caption'] = "Stasiun ID";
		$data['configurations'][1]['value'] = $this->konfigurasi_m->getConfigurationContent('sta_id');
		$data['configurations'][2]['id'] = "sta_nama";
		$data['configurations'][2]['caption'] = "Nama Stasiun";
		$data['configurations'][2]['value'] = $this->konfigurasi_m->getConfigurationContent('sta_nama');
		$data['configurations'][3]['id'] = "sta_alamat";
		$data['configurations'][3]['caption'] = "Alamat";
		$data['configurations'][3]['value'] = $this->konfigurasi_m->getConfigurationContent('sta_alamat');
		$data['configurations'][4]['id'] = "sta_kota";
		$data['configurations'][4]['caption'] = "Kota";
		$data['configurations'][4]['value'] = $this->konfigurasi_m->getConfigurationContent('sta_kota');
		$data['configurations'][5]['id'] = "sta_prov";
		$data['configurations'][5]['caption'] = "Propinsi";
		$data['configurations'][5]['value'] = $this->konfigurasi_m->getConfigurationContent('sta_prov');
		$data['configurations'][6]['id'] = "sta_lat";
		$data['configurations'][6]['caption'] = "Latitude";
		$data['configurations'][6]['value'] = $this->konfigurasi_m->getConfigurationContent('sta_lat');
		$data['configurations'][7]['id'] = "sta_lon";
		$data['configurations'][7]['caption'] = "Longitude";
		$data['configurations'][7]['value'] = $this->konfigurasi_m->getConfigurationContent('sta_lon');
		
		$data['serial_devices'][0]['com_id'] = "com_pm10";
		$data['serial_devices'][0]['baud_id'] = "baud_pm10";
		$data['serial_devices'][0]['caption'] = "PM10";
		$data['serial_devices'][0]['com_value'] = $this->konfigurasi_m->getConfigurationContent('com_pm10');
		$data['serial_devices'][0]['baud_value'] = $this->konfigurasi_m->getConfigurationContent('baud_pm10');
		
		$data['serial_devices'][1]['com_id'] = "com_pm25";
		$data['serial_devices'][1]['baud_id'] = "baud_pm125";
		$data['serial_devices'][1]['caption'] = "PM25";
		$data['serial_devices'][1]['com_value'] = $this->konfigurasi_m->getConfigurationContent('com_pm25');
		$data['serial_devices'][1]['baud_value'] = $this->konfigurasi_m->getConfigurationContent('baud_pm25');
		
		$data['serial_devices'][2]['com_id'] = "com_ws";
		$data['serial_devices'][2]['baud_id'] = "baud_ws";
		$data['serial_devices'][2]['caption'] = "Weather Station";
		$data['serial_devices'][2]['com_value'] = $this->konfigurasi_m->getConfigurationContent('com_ws');
		$data['serial_devices'][2]['baud_value'] = $this->konfigurasi_m->getConfigurationContent('baud_ws');
		
		$data['serial_devices'][3]['com_id'] = "controller";
		$data['serial_devices'][3]['baud_id'] = "controller_baud";
		$data['serial_devices'][3]['caption'] = "Arduino";
		$data['serial_devices'][3]['com_value'] = $this->konfigurasi_m->getConfigurationContent('controller');
		$data['serial_devices'][3]['baud_value'] = $this->konfigurasi_m->getConfigurationContent('controller_baud');
		
		$data['serial_devices'][4]['com_id'] = "com_modem";
		$data['serial_devices'][4]['baud_id'] = "baud_modem";
		$data['serial_devices'][4]['caption'] = "Modem";
		$data['serial_devices'][4]['com_value'] = $this->konfigurasi_m->getConfigurationContent('com_modem');
		$data['serial_devices'][4]['baud_value'] = $this->konfigurasi_m->getConfigurationContent('baud_modem');
		
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
