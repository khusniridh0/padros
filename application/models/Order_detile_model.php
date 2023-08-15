<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_detile_model extends CI_Model {
    private $table = 'order_details';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function save_order_detile($data) {
        $this->db->insert($this->table, $data);
    }

    public function get_order_detile_all() {
        return $this->db->get($this->table)->result_array();
    }

    public function update_status_order($status, $order_uuid) {
        return $this->db->update($this->table, $status, ['order_uuid' => $order_uuid]);
    }

}


/* End of file Order_detile_model.php */
/* Location: ./application/models/Order_detile_model.php */