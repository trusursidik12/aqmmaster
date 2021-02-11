<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Getdata_m extends CI_Model
{

	public function getAll($id = FALSE)
	{
		if ($id === FALSE) {
			$this->db->order_by('id', 'DESC');
			$this->db->limit('1');
			$query = $this->db->get('aqm_sensor_values');
			return $query->result_array();
		}
		$query = $this->db->get_where('aqm_sensor_values', array('id' => $id));
		return $query->row_array();
	}

	public function getParamsPartikulat($id = FALSE)
	{
		if ($id === FALSE) {
			$partikulat = array('pm10', 'pm25', 'tsp');
			$this->db->order_by('id', 'ASC');
			$this->db->where('is_view', '1');
			$this->db->where_in('param_id', $partikulat);
			$query = $this->db->get('aqm_params');
			return $query->result_array();
		}
		$query = $this->db->get_where('aqm_params', array('id' => $id));
		return $query->row_array();
	}

	public function getParamsPartikulatFlow($id = FALSE)
	{
		if ($id === FALSE) {
			$partikulatflow = array('pm10_flow', 'pm25_flow');
			$this->db->order_by('id', 'ASC');
			$this->db->where('is_view', '1');
			$this->db->where_in('param_id', $partikulatflow);
			$query = $this->db->get('aqm_params');
			return $query->result_array();
		}
		$query = $this->db->get_where('aqm_params', array('id' => $id));
		return $query->row_array();
	}

	public function getParamsPartikulatAttr()
	{
		$partikulatattr = array('pm10_bar', 'pm10_humid', 'pm10_temp', 'pm25_bar', 'pm25_humid', 'pm25_temp');
		$this->db->order_by('id', 'ASC');
		$this->db->where('is_view', '1');
		$this->db->where_in('param_id', $partikulatattr);
		$query = $this->db->get('aqm_params');
		foreach ($query->result_array() as $key => $param) {
			@$return[$param["param_id"]]["is_view"] = 1;
			@$return[$param["param_id"]]["param_id"] = $param["param_id"];
			@$return[$param["param_id"]]["caption"] = $param["caption"];
			@$return[$param["param_id"]]["default_unit"] = $param["default_unit"];
			@$return[$param["param_id"]]["formula"] = $param["formula"];
		}
		return @$return;
	}

	public function getParamsGas($id = FALSE)
	{
		if ($id === FALSE) {
			$gas = array('so2', 'co', 'o3', 'no2', 'voc', 'hc', 'h2s', 'cs2', 'nh3', 'nmhc', 'ch4');
			$this->db->order_by('id', 'ASC');
			$this->db->where('is_view', '1');
			$this->db->where_in('param_id', $gas);
			$query = $this->db->get('aqm_params');
			return $query->result_array();
		}
		$query = $this->db->get_where('aqm_params', array('id' => $id));
		return $query->row_array();
	}

	public function getParamsCuaca($id = FALSE)
	{
		if ($id === FALSE) {
			$cuaca = array('WindSpeed', 'WindDir', 'TempIn', 'TempOut', 'Barometer', 'RainDay', 'RainRate', 'SolarRad', 'HumIn', 'HumOut');
			$this->db->order_by('id', 'ASC');
			$this->db->where('is_view', '1');
			$this->db->where_in('param_id', $cuaca);
			$query = $this->db->get('aqm_params');
			return $query->result_array();
		}
		$query = $this->db->get_where('aqm_params', array('id' => $id));
		return $query->row_array();
	}

	public function getConfigurations()
	{
		$query = $this->db->get('aqm_configuration');
		foreach ($query->result_array() as $key => $configuration) {
			$return[$configuration["data"]] = $configuration["content"];
		}
		return $return;
	}

	public function getGraph($getparams = false)
	{
		if ($getparams) {
			$this->db->order_by('id', 'ASC');
			$this->db->where('is_view', '1');
			$this->db->where('is_graph', '1');
			$query = $this->db->get('aqm_params');
			$params = $query->result_array();
			if (count($params) > 0) {
				$param_id_in = array();
				foreach ($params as $param) {
					$fields[] = $param["param_id"];
				}
				return $fields;
			} else {
				return [];
			}
		} else {
			$query = $this->db->get_where('aqm_configuration', ["data" => "graph_interval"]);
			$graph_interval = $query->row_array()['content'];
			if ($graph_interval == 0) {
				$this->db->order_by('id', 'DESC');
				$this->db->limit("30");
				$query = $this->db->get('aqm_data_log');
				return $query->result_array();
			} else {
				$times = "";
				$ii = 0;
				$start = false;
				$menit = date("i");
				while ($ii < 30) {
					if ($menit % $graph_interval == 0) $start = true;
					if ($start) {
						$times .= "'" . date("Y-m-d H:i", mktime(date("H"), ($menit - ($ii * $graph_interval)))) . ":00',";
						$ii++;
					} else {
						$menit--;
					}
				}
				$times = substr($times, 0, -1);
				$this->db->where("waktu IN ($times)");
				$this->db->order_by('id', 'DESC');
				$this->db->limit("30");
				$query = $this->db->get('aqm_data_log');
				return $query->result_array();
			}
		}
	}
}
