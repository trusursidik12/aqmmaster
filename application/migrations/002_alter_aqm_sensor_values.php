<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Migration_Alter_aqm_sensor_values extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_column('aqm_sensor_values', ['TSP' => ['type' => 'VARCHAR', 'constraint' => 255, 'default' => '', "after" => "PM10"]]);
    }
    public function down()
    {
    }
}
