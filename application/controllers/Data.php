<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends CI_Controller {

	function get_ajax() {
        $aqm_data = $this->data_m->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($aqm_data as $dataexport) {
            $no++;
            $row = array();
            $row[] = $no.".";
            $row[] = $dataexport->id_stasiun;
            $row[] = $dataexport->waktu;
            $row[] = $dataexport->pm10;
            $row[] = $dataexport->pm25;
            $data[] = $row;
        }
        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->data_m->count_all(),
                    "recordsFiltered" => $this->data_m->count_filtered(),
                    "data" => $data,
                );
        // output to json format
        echo json_encode($output);
    }
}