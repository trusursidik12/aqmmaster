<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Getdata_m extends CI_Model {

	public function getAll($id = FALSE)
	{
		if($id === FALSE)
		{
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
		if($id === FALSE)
		{
			$partikulat = array('pm10','pm25');
			$this->db->order_by('id', 'ASC');
			$this->db->where_in('param_id', $partikulat);
			$query = $this->db->get('aqm_params');
			return $query->result_array();
		}
		$query = $this->db->get_where('aqm_params', array('id' => $id));
		return $query->row_array();
	}

	public function getParamsGas($id = FALSE)
	{
		if($id === FALSE)
		{
			$partikulat = array('so2','co','o3','no2','voc','hc','h2s','cs2');
			$this->db->order_by('id', 'ASC');
			$this->db->where_in('param_id', $partikulat);
			$query = $this->db->get('aqm_params');
			return $query->result_array();
		}
		$query = $this->db->get_where('aqm_params', array('id' => $id));
		return $query->row_array();
	}

	public function getParamsCuaca($id = FALSE)
	{
		if($id === FALSE)
		{
			$partikulat = array('WindSpeed','WindDir','TempIn','TempOut','Barometer','RainDay','RainRate','SolarRad','HumIn','HumOut');
			$this->db->order_by('id', 'ASC');
			$this->db->where('is_view', '1');
			$this->db->where_in('param_id', $partikulat);
			$query = $this->db->get('aqm_params');
			return $query->result_array();
		}
		$query = $this->db->get_where('aqm_params', array('id' => $id));
		return $query->row_array();
	}

}