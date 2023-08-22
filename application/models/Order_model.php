<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model {
    private $table = 'order';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function save_order($data) {
        $this->db->insert($this->table, $data);
    }

    public function get_order_join() {
        $this->db->order_by($this->table . '.id', 'desc');
        $this->db->join('order_details', 'order_details.order_uuid = order.order_uuid');
        $this->db->join('payment', 'payment.payment_uuid = order.payment_uuid');
        return $this->db->get($this->table)->result_array();
    }

    public function get_order_accept_join() {
        $this->db->order_by($this->table . '.id', 'desc');
        $this->db->join('order_details', 'order_details.order_uuid = order.order_uuid');
        $this->db->join('payment', 'payment.payment_uuid = order.payment_uuid');
        return $this->db->get_where($this->table, ['order_details.status' => 1])->result_array();
    }

    public function get_order_join_all_by_uuid($uuid) {
        $this->db->order_by($this->table . '.id', 'desc');
        $this->db->join('order_details', 'order_details.order_uuid = order.order_uuid');
        $this->db->join('payment', 'payment.payment_uuid = order.payment_uuid');
        return $this->db->get_where($this->table, ['uuid' => $uuid])->result_array();
    }

    public function get_order_join_by_order_uuid($order_uuid) {
        $this->db->order_by($this->table . '.id', 'desc');
        $this->db->join('order_details', 'order_details.order_uuid = order.order_uuid');
        $this->db->join('payment', 'payment.payment_uuid = order.payment_uuid');
        return $this->db->get_where($this->table, ['order.order_uuid' => $order_uuid])->row_array();
    }

    public function get_order_join_by_order_detile_uuid($order_uuid) {
        $this->db->order_by($this->table . '.id', 'desc');
        $this->db->join('order_details', 'order_details.order_uuid = order.order_uuid');
        $this->db->join('payment', 'payment.payment_uuid = order.payment_uuid');
        return $this->db->get_where($this->table, ['order_details.order_uuid' => $order_uuid])->row_array();
    }

    public function get_order_join_by_order_uuid_on_users($order_uuid) {
        $this->db->order_by($this->table . '.id', 'desc');
        $this->db->join('users', 'users.uuid = order.uuid');
        $this->db->join('order_details', 'order_details.order_uuid = order.order_uuid');
        $this->db->join('payment', 'payment.payment_uuid = order.payment_uuid');
        return $this->db->get_where($this->table, ['order.order_uuid' => $order_uuid])->row_array();
    }

    public function get_order_join_by_uuid($uuid) {
        $this->db->order_by($this->table . '.id', 'desc');
        $this->db->join('order_details', 'order_details.order_uuid = order.order_uuid');
        $this->db->join('payment', 'payment.payment_uuid = order.payment_uuid');
        return $this->db->get_where($this->table, ['uuid' => $uuid])->row_array();
    }

    public function get_order_all() {
        return $this->db->get($this->table)->result_array();
    }

    public function get_order_report($date) {
        $this->db->join('order_details', 'order_details.order_uuid = order.order_uuid');
        $this->db->join('payment', 'payment.payment_uuid = order.payment_uuid');
        $this->db->where_in('DATE(payment.date_created)', $date);
        $this->db->where('order_details.status', 1);
        return $this->db->get($this->table)->result_array();
    }

}


/* End of file Order_model.php */
/* Location: ./application/models/Order_model.php */