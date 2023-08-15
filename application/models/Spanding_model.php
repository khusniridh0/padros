<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Spanding_model extends CI_Model {
    private $table = 'spanding';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function save_spanding($data) {
        return $this->db->insert($this->table, $data);
    }

    public function spanding_update($data, $uuid) {
        return $this->db->update($this->table, $data, ['spanding_uuid' => $uuid]);
    }

    public function get_all_spanding() {
        $this->db->where_in('status', [0, 1]);
        return $this->db->get($this->table)->result_array();
    }

    public function get_payment_by_date($date){
        $this->db->select('amount');
        return $this->db->get_where($this->table, ['DATE(date_created)' => $date])->result_array();
    }

}


/* End of file spanding_model.php */
/* Location: ./application/models/spanding_model.php */