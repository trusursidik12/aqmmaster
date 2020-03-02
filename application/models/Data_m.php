<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_m extends CI_Model {

    var $table = 'aqm_data';
    var $column_order = array('id_stasiun','waktu');
    var $column_search = array('id_stasiun','waktu');
    var $order = array('id' => 'desc'); // default order

    public function get_datatables($from, $to)
    {
        $this->_get_datatables_query($from, $to);
       
        if(@$_POST['length'] != -1)
            $this->db->limit(@$_POST['length'], @$_POST['start']);
        
        $query = $this->db->get();
        
        return $query->result();
    }

    public function count_filtered($from, $to)
    {
        $this->_get_datatables_query($from, $to);
       
        $query = $this->db->get();
       
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        
        return $this->db->count_all_results();
    }

    private function _get_datatables_query($from,$to)
    {

        $this->db->from($this->table);

        if($from!='' && $to!='' || $from!= NULL) // To process our custom input parameter
        {

            $this->db->where('waktu BETWEEN "'. date('Y-m-d', strtotime($from)). '" and "'. date('Y-m-d', strtotime($to)).'"');
        }

        $i = 0;
        foreach ($this->column_search as $item) // loop column
        {
            if(@$_POST['search']['value']) // if datatable send POST for search
            {

                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);

        }
        elseif (isset($this->order)) // default order processing
        {
            $order = $this->order;

            $this->db->order_by(key($order), $order[key($order)]);

        }
    }

	

}