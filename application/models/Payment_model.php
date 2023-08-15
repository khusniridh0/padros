<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_model extends CI_Model {
    private $table = 'payment';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function save_payment($data) {
        $this->db->insert($this->table, $data);
    }

    public function get_all_payment(){
        $this->db->join('order_details', 'order_details.order_uuid = payment.payment_uuid');
        $this->db->join('order', 'order.payment_uuid = payment.payment_uuid');
        return $this->db->get($this->table)->result_array();
    }

    public function get_only_payment(){
        return $this->db->get($this->table)->result_array();
    }

    public function get_payment_by_date($date){
        $this->db->select('payment_amount');
        return $this->db->get_where($this->table, ['DATE(date_created)' => $date])->result_array();
    }

    // public function get_payment_by_date($date){
    //     $this->db->join('order_details', 'order_details.order_uuid = order.order_uuid');
    //     $this->db->join('payment', 'payment.payment_uuid = order.payment_uuid');
    //     return $this->db->get_where('order', ['DATE(payment.date_created)' => $date, 'order_details.status' => 1])->result_array();
    // }

}


/* End of file Payment_model.php */
/* Location: ./application/models/Payment_model.php */