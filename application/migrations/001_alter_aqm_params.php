<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Migration_Alter_aqm_params extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_column('aqm_params', ["voltage_field" => ["type" => "varchar(20)", "default" => "", "after" => "is_graph"]]);
        $this->dbforge->add_column('aqm_params', ["zero_voltage" => ["type" => "double", "default" => 0, "after" => "voltage_field"]]);
        $this->dbforge->add_column('aqm_params', ["span_voltage" => ["type" => "double", "default" => 0, "after" => "zero_voltage"]]);
        $this->dbforge->add_column('aqm_params', ["span_concentration" => ["type" => "double", "default" => 0, "after" => "span_voltage"]]);
    }
    public function down()
    {
    }
}
