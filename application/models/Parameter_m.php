<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Parameter_m extends CI_Model
{

	public function getDataParameter($id = FALSE)
	{
		if (count(@$this->db->get_where('aqm_params', ['param_id' => "nh3"])->row_array()) <= 0) {
			$data = [
				"param_id" => "nh3",
				"caption" => "NH3",
				"default_unit" => "ppm",
				"molecular_mass" => "17.03",
				"span_concentration" => "100",
			];
			$this->db->insert('aqm_params', $data);
		}
		if (count(@$this->db->get_where('aqm_params', ['param_id' => "nmhc"])->row_array()) <= 0) {
			$data = [
				"param_id" => "nmhc",
				"caption" => "NMHC",
				"default_unit" => "ppm",
				"molecular_mass" => "110",
				"span_concentration" => "25",
			];
			$this->db->insert('aqm_params', $data);
		}
		if (count(@$this->db->get_where('aqm_params', ['param_id' => "ch4"])->row_array()) <= 0) {
			$data = [
				"param_id" => "ch4",
				"caption" => "CH4",
				"default_unit" => "ppm",
				"molecular_mass" => "16.04",
				"span_concentration" => "100",
			];
			$this->db->insert('aqm_params', $data);
		}

		if ($id === FALSE) {
			$this->db->order_by('id', 'ASC');
			$query = $this->db->get('aqm_params');
			return $query->result_array();
		}
		$query = $this->db->get_where('aqm_params', array('id' => $id));
		return $query->row_array();
	}

	public function save_parameter($values)
	{
		$this->db->where('param_id', $values["param_id"]);
		$data = ["caption" => $values["caption"]];
		$data = $data + ["default_unit" => $values["default_unit"]];
		$data = $data + ["molecular_mass" => $values["molecular_mass"]];
		if (isset($values["formula"]))
			$data = $data + ["formula" => $values["formula"]];
		$data = $data + ["gain" => $values["gain"]];
		$data = $data + ["offset" => $values["offset"]];
		$data = $data + ["is_view" => $values["is_view"]];
		$data = $data + ["is_graph" => $values["is_graph"]];
		return $this->db->update('aqm_params', $data);
	}

	public function save_kalibrasi($zerospan, $param_id, $post)
	{
		$data = [
			"voltage_field" => $post["voltage_field"],
			"span_concentration" => $post["span_concentration"],
			$zerospan . "_voltage" => $post["voltage"],
		];
		$this->db->where('id', $param_id);
		$this->db->update('aqm_params', $data);

		$param = $this->getDataParameter($param_id);
		if ($param["span_voltage"] > 0 && ($param["span_voltage"] - $param["zero_voltage"]) != 0 && $post["voltage_field"] != "") {
			$a = $post["span_concentration"] / ($param["span_voltage"] - $param["zero_voltage"]);
			$b = -1 * $a * $param["zero_voltage"];
			if ($b < 0) {
				$b = $b * -1;
				$sign = "-";
			} else $sign = "+";
			$formula = "round((" . $a . " * " . "\$" . $post["voltage_field"] . ") " . $sign . " " . $b . ",6)";
			$this->db->where('id', $param_id);
			$this->db->update('aqm_params', ["formula" => $formula]);
		}
	}

	public function update_parameter()
	{
		$data = array(
			'param_id' 	=> $this->input->post('param_id'),
			'caption'	=> $this->input->post('caption'),
			'satuan'	=> $this->input->post('satuan'),
			'is_view'	=> $this->input->post('is_view')
		);
		$this->db->where('id', $this->input->post('id'));
		return $this->db->update('aqm_params', $data);
	}

	public function get_gass()
	{
		$this->db->where("is_view", "1");
		$this->db->where("molecular_mass > 0");
		$query = $this->db->get('aqm_params');
		return $query->result_array();
	}
}
