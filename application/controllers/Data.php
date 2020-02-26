<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends CI_Controller {

    public function index()
    {
        $data['title'] = 'Data';
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

        $data = array();
        $no = $this->input->post('start');
        foreach ($posts as $post) 
        {
            
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $post->id_stasiun;
            $row[] = $post->waktu;
            $row[] = $post->pm10;
            $row[] = $post->pm25;
            $row[] = $post->so2;
            $row[] = $post->co;
            $row[] = $post->o3;
            $row[] = $post->no2;
            
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