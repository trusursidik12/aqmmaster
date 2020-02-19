<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kalibrasi extends CI_Controller {

	public function index()
	{
		$this->temp_frontend->load('master/theme/theme', 'master/kalibrasi/kalibrasi');
	}
}
