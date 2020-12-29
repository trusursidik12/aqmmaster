<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends CI_Controller {

    public function index()
    {
        $data['title'] = 'Data';
        $data['from'] = date("Y-m-d");
        $data['to'] = date("Y-m-d");
		
		$partikulatattr = $this->getdata_m->getParamsPartikulatAttr();
		
		$partikulats = $this->getdata_m->getParamsPartikulat();
		if(count($partikulats) > 0){
			foreach($partikulats as $partikulat){
				$data["params"][$partikulat['param_id']] = 1;
			}
		}

		$gass = $this->getdata_m->getParamsGas();
		if(count($gass) > 0){
			foreach($gass as $gas){
				$data["params"][$gas['param_id']] = 1;
			}
		}
		
		$cuacas = $this->getdata_m->getParamsCuaca();
		if(count($cuacas) > 0){
			foreach($cuacas as $cuaca){
				$data["params"][$cuaca['param_id']] = 1;
			}
		}
		
		if(!@$data["params"]["pressure"]) $data["params"]["pressure"] = @$partikulatattr["pm25_bar"]["is_view"];
		if(!@$data["params"]["pressure"]) $data["params"]["pressure"] = @$partikulatattr["pm10_bar"]["is_view"];
		if(!@$data["params"]["temperature"]) $data["params"]["temperature"] = @$partikulatattr["pm25_temp"]["is_view"];
		if(!@$data["params"]["temperature"]) $data["params"]["temperature"] = @$partikulatattr["pm10_temp"]["is_view"];
		if(!@$data["params"]["humidity"]) $data["params"]["humidity"] = @$partikulatattr["pm25_humid"]["is_view"];
		if(!@$data["params"]["humidity"]) $data["params"]["humidity"] = @$partikulatattr["pm10_humid"]["is_view"];
		
		$data["calibration_menu"] = $this->konfigurasi_m->getConfigurationContent('calibration_menu');
        $this->temp_frontend->load('master/theme/theme', 'master/data/data_export', $data);
    }

    public function ajax()
    {

        $from = $this->input->post('from');
        $to = $this->input->post('to');

        if($from!='' && $to!='')
        {
            $from = date('Y-m-d',strtotime($from));
            $to = date('Y-m-d',strtotime($to));
        }

        $posts = $this->data_m->get_datatables($from,$to); 
		
		$partikulatattr = $this->getdata_m->getParamsPartikulatAttr();
		
		$partikulats = $this->getdata_m->getParamsPartikulat();
		if(count($partikulats) > 0){
			foreach($partikulats as $partikulat){
				$params[$partikulat['param_id']] = 1;
			}
		}

		$gass = $this->getdata_m->getParamsGas();
		if(count($gass) > 0){
			foreach($gass as $gas){
				$params[$gas['param_id']] = 1;
			}
		}
		
		$cuacas = $this->getdata_m->getParamsCuaca();
		if(count($cuacas) > 0){
			foreach($cuacas as $cuaca){
				$params[$cuaca['param_id']] = 1;
			}
		}
		
		if(!@$params["pressure"]) $params["pressure"] = @$partikulatattr["pm25_bar"]["is_view"];
		if(!@$params["pressure"]) $params["pressure"] = @$partikulatattr["pm10_bar"]["is_view"];
		if(!@$params["temperature"]) $params["temperature"] = @$partikulatattr["pm25_temp"]["is_view"];
		if(!@$params["temperature"]) $params["temperature"] = @$partikulatattr["pm10_temp"]["is_view"];
		if(!@$params["humidity"]) $params["humidity"] = @$partikulatattr["pm25_humid"]["is_view"];
		if(!@$params["humidity"]) $params["humidity"] = @$partikulatattr["pm10_humid"]["is_view"];
		
		
		
		// echo "<pre>";
		// print_r($partikulatattr);
		// print_r($params);
		// echo "</pre>";
		
        $data = array();
        $no = $this->input->post('start');
        foreach ($posts as $post) 
        {            
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $post->id_stasiun;
            $row[] = $post->waktu;
            if(@$params["pm10"]) $row[] = round($post->pm10);
			if(@$params["pm25"]) $row[] = round($post->pm25);
            if(@$params["so2"]) $row[] = round($post->so2);
            if(@$params["co"]) $row[] = round($post->co);
            if(@$params["o3"]) $row[] = round($post->o3);
            if(@$params["no2"]) $row[] = round($post->no2);
            if(@$params["hc"]) $row[] = round($post->hc);
            if(@$params["hc"]) $row[] = round($post->sr);
            if(@$params["voc"]) $row[] = round($post->voc);
            if(@$params["nh3"]) $row[] = round($post->nh3);
            if(@$params["h2s"]) $row[] = round($post->h2s);
            if(@$params["cs2"]) $row[] = round($post->cs2);
            if(@$params["ws"]) $row[] = round($post->ws);
            if(@$params["wd"]) $row[] = round($post->wd);
            if(@$params["humidity"]) $row[] = round($post->humidity);
            if(@$params["temperature"]) $row[] = round($post->temperature);
            if(@$params["pressure"]) $row[] = round($post->pressure);
            if(@$params["rain_intensity"]) $row[] = round($post->rain_intensity);
            
            $data[] = $row;
        }
        
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->data_m->count_all(),
            "recordsFiltered" => $this->data_m->count_filtered($from,$to),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
}