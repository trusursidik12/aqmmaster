<?php
defined('BASEPATH') or exit('No direct script access allowed');

class sensors extends CI_Controller
{

	public function index()
	{
		$values = new stdClass;
		$formula = "";
		$sensors = $this->sensors_m->getvalues();
		@$AIN0 		= $sensors["AIN0"];
		@$AIN1 		= $sensors["AIN1"];
		@$AIN2 		= $sensors["AIN2"];
		@$AIN3 		= $sensors["AIN3"];
		@$AIN4 		= $sensors["AIN4"];
		@$AIN5 		= $sensors["AIN5"];
		@$AIN6 		= $sensors["AIN6"];
		@$AIN7 		= $sensors["AIN7"];
		@$AIN8 		= @$sensors["AIN8"];
		@$AIN9 		= @$sensors["AIN9"];
		@$AIN10 	= @$sensors["AIN10"];
		@$AIN11 	= @$sensors["AIN11"];
		@$AIN12 	= @$sensors["AIN12"];
		@$AIN13 	= @$sensors["AIN13"];
		@$AIN14 	= @$sensors["AIN14"];
		@$AIN15 	= @$sensors["AIN15"];
		@$HC 		= $sensors["HC"];
		@$PM25 		= $sensors["PM25"];
		@$PM10 		= $sensors["PM10"];
		@$TSP 		= $sensors["TSP"];
		@$WS	  	= $sensors["WS"];
		@$GPS	  	= $sensors["GPS"];
		@$LABJACK		= $sensors["LABJACK"];
		@$xtimestamp	= $sensors["xtimestamp"];

		$factors = $this->sensors_m->getFactors();
		foreach ($factors as $_factor) {
			$factor[$_factor["faktor"]] = $_factor["nilai"] * 1;
		}

		$params = $this->sensors_m->getParams();
		foreach ($params as $_param) {
			$param_id = $_param["param_id"];
			$param_id_mg = $_param["param_id"] . "_mg";
			$param_id_unit = $_param["param_id"] . "_unit";
			$default_unit = $_param["default_unit"];
			$molecular_mass = $_param["molecular_mass"];
			@$formula = $this->sensors_m->getFormula($param_id)["formula"];
			@eval("\$$param_id = $formula;");
			if ($molecular_mass > 0)
				@eval("\$$param_id_mg = round(\$$param_id * $molecular_mass / 24.45 * 1000,3);");

			if (isset($_GET["unit"]) && $molecular_mass > 0) {
				if ($_GET["unit"] == "ppb") {
					@eval("\$$param_id = round(\$$param_id * 1000,0);");
					$default_unit = "ppb";
				}
				if ($_GET["unit"] == "ug") {
					@eval("\$$param_id = round(\$$param_id * $molecular_mass / 24.45 * 1000,0);");
					$default_unit = "ug/m3";
				}
			}
			if ($_param["param_id"] == "TempIn" || $_param["param_id"] == "TempOut") {
				@eval("\$$param_id = round((\$$param_id - 32) * 5/9,1);");
			}

			if ($_param["param_id"] == "pm25_temp" || $_param["param_id"] == "pm10_temp")
				@eval("\$$param_id = str_replace('+','',\$$param_id);");

			if ($_param["param_id"] == "pm25_humid" || $_param["param_id"] == "pm10_humid")
				@eval("\$$param_id = \$$param_id * 1;");

			$values->$param_id_unit = $default_unit;
			@eval("if(\$$param_id < 0) \$$param_id = 0;");
			@eval("if(!isset(\$$param_id)) \$$param_id = 0;");
			@eval("\$values->$param_id = \$$param_id;");
			@eval("\$data[$param_id] = \$$param_id;");
			if ($molecular_mass > 0) {
				@eval("if(\$$param_id_mg < 0) \$$param_id_mg = 0;");
				@eval("if(!isset(\$$param_id_mg)) \$$param_id_mg = 0;");
				@eval("\$values->$param_id_mg = \$$param_id_mg;");
				@eval("\$data[$param_id] = \$$param_id_mg;");
			}
			unset($formula);
		}



		if (@$data["HumOut"] * 1 == 0) $data["HumOut"] = @$data["pm25_humid"];
		if (@$data["TempOut"] * 1 == 0) $data["TempOut"] = @$data["pm25_temp"];
		if (@$data["Barometer"] * 1 == 0) $data["Barometer"] = @$data["pm25_bar"];

		if (@$data["HumOut"] * 1 == 0) $data["HumOut"] = @$data["pm10_humid"];
		if (@$data["TempOut"] * 1 == 0) $data["TempOut"] = @$data["pm10_temp"];
		if (@$data["Barometer"] * 1 == 0) $data["Barometer"] = @$data["pm10_bar"];

		$values->pump_state = $this->sensors_m->getPumpState();
		$values->pump_last = $this->sensors_m->getPumpLast();
		$values->pump_interval = $this->sensors_m->getPumpInterval();
		$values->lastPutData = $this->session->userdata('lastPutData');

		$insertvalue = ["waktu" => date("Y-m-d H:i:s")];
		@$insertvalue = $insertvalue + ["pm10" => ($data["pm10"] * 1000)];
		@$insertvalue = $insertvalue + ["pm25" => ($data["pm25"] * 1000)];
		@$insertvalue = $insertvalue + ["tsp" => ($data["tsp"] * 1000)];
		@$insertvalue = $insertvalue + ["so2" => $data["so2"]];
		@$insertvalue = $insertvalue + ["co" => $data["co"]];
		@$insertvalue = $insertvalue + ["o3" => $data["o3"]];
		@$insertvalue = $insertvalue + ["no2" => $data["no2"]];
		@$insertvalue = $insertvalue + ["hc" => $data["hc"]];
		@$insertvalue = $insertvalue + ["ws" => $data["WindSpeed"]];
		@$insertvalue = $insertvalue + ["wd" => $data["WindDir"]];
		@$insertvalue = $insertvalue + ["humidity" => $data["HumOut"]];
		@$insertvalue = $insertvalue + ["temperature" => $data["TempOut"]];
		@$insertvalue = $insertvalue + ["pressure" => $data["Barometer"]];
		@$insertvalue = $insertvalue + ["sr" => $data["SolarRad"]];
		@$insertvalue = $insertvalue + ["voc" => $data["voc"]];
		@$insertvalue = $insertvalue + ["rain_intensity" => $data["RainDay"]];
		@$insertvalue = $insertvalue + ["h2s" => $data["h2s"]];
		@$insertvalue = $insertvalue + ["cs2" => $data["cs2"]];
		@$insertvalue = $insertvalue + ["nh3" => $data["nh3"]];
		@$insertvalue = $insertvalue + ["nmhc" => $data["nmhc"]];
		@$insertvalue = $insertvalue + ["ch4" => $data["ch4"]];
		$this->sensors_m->insert_aqm_data_log($insertvalue);
		$values->now = date("Y-m-d H:i:s");
		$data_interval = $this->konfigurasi_m->getConfigurationContent('data_interval');
		$aqm_data_ranges = $this->sensors_m->get_aqm_data_range($data_interval);
		if ($aqm_data_ranges != 0) {
			$tot_pm10 = 0;
			$tot_pm25 = 0;
			$tot_tsp = 0;
			$tot_so2 = 0;
			$tot_co = 0;
			$tot_o3 = 0;
			$tot_no2 = 0;
			$tot_hc = 0;
			$tot_voc = 0;
			$tot_h2s = 0;
			$tot_cs2 = 0;
			$tot_nh3 = 0;
			$tot_nmhc = 0;
			$tot_ch4 = 0;
			foreach ($aqm_data_ranges["data"] as $aqm_data) {
				$tot_pm10 += $aqm_data["pm10"];
				$tot_pm25 += $aqm_data["pm25"];
				$tot_tsp += $aqm_data["tsp"];
				$tot_so2 += $aqm_data["so2"];
				$tot_co += $aqm_data["co"];
				$tot_o3 += $aqm_data["o3"];
				$tot_no2 += $aqm_data["no2"];
				$tot_hc += $aqm_data["hc"];
				$tot_voc += $aqm_data["voc"];
				$tot_h2s += $aqm_data["h2s"];
				$tot_cs2 += $aqm_data["cs2"];
				$tot_nh3 += $aqm_data["nh3"];
				$tot_nmhc += $aqm_data["nmhc"];
				$tot_ch4 += $aqm_data["ch4"];
			}
			$num_data = count($aqm_data_ranges["data"]);
			if ($num_data > 0) {
				$aqm_data_values = [
					"id_stasiun" => $this->sensors_m->get_id_stasiun(),
					"waktu" => $aqm_data_ranges["waktu"],
					"pm10" => round($tot_pm10 / $num_data),
					"pm25" => round($tot_pm25 / $num_data),
					"tsp" => round($tot_tsp / $num_data),
					"so2" => round($tot_so2 / $num_data),
					"co" => round($tot_co / $num_data),
					"o3" => round($tot_o3 / $num_data),
					"no2" => round($tot_no2 / $num_data),
					"hc" => round($tot_hc / $num_data),
					"voc" => round($tot_voc / $num_data),
					"h2s" => round($tot_h2s / $num_data),
					"cs2" => round($tot_cs2 / $num_data),
					"nh3" => round($tot_nh3 / $num_data),
					"nmhc" => round($tot_nmhc / $num_data),
					"ch4" => round($tot_ch4 / $num_data),
					"ws" => @$data["WindSpeed"],
					"wd" => @$data["WindDir"],
					"humidity" => @$data["HumOut"],
					"temperature" => @$data["TempOut"],
					"pressure" => @$data["Barometer"],
					"sr" => @$data["SolarRad"],
					"rain_intensity" => @$data["RainDay"]
				];
				$is_start_sampling = $this->konfigurasi_m->getConfigurationContent('start_sampling');
				if ($is_start_sampling) {
					$sampler_operator_name = $this->konfigurasi_m->getConfigurationContent('sampler_operator_name');
					$id_sampling = $this->konfigurasi_m->getConfigurationContent('id_sampling');
					$aqm_data_values += ["sampler_operator_name" => $sampler_operator_name, "id_sampling" => $id_sampling];
				}
			}
			$this->sensors_m->insert_aqm_data($aqm_data_values, $aqm_data_ranges["id_start"], $aqm_data_ranges["id_end"]);
			$this->session->set_userdata('lastPutData', date("Y-m-d H:i"));
		}

		$values->GPS = $GPS;
		$values->LABJACK = $LABJACK;
		$data["values"] = json_encode($values);

		$this->load->view('master/ajax/sensor', $data);
	}

	public function change_pump_state()
	{
		$values = new stdClass;
		$values->pump_state = $this->sensors_m->changePumpState($_GET["state"]);
		$data["values"] = json_encode($values);
		$this->load->view('master/ajax/sensor', $data);
	}

	public function graph_data()
	{
		$data["is_graph"] = false;
		$graph_fields = $this->getdata_m->getGraph(true);
		if (count($graph_fields) > 0) {
			$data["is_graph"] = true;
			foreach ($graph_fields as $graph_field) {
				@$data["graph_fields"] .= "'" . $graph_field . "',";
			}
			$data["graph_fields"] = substr($data["graph_fields"], 0, -1);
		}

		$graphs = $this->getdata_m->getGraph();
		foreach ($graphs as $key => $graph) {
			$graph_data = ["time" => $graph["waktu"]];
			foreach ($graph_fields as $graph_field) {
				$graph_data = $graph_data + [$graph_field => $graph[$graph_field]];
			}
			$chart_data[] = $graph_data;
		}
		$data["values"] = json_encode($chart_data);
		$this->load->view('master/ajax/sensor', $data);
	}
}
