<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function get_all_data() {


		$this->db->select('payment_amount, date_created');
		$data['income'] = $this->db->get('payment')->result_array();

		$this->db->select('amount, date_created');
		$data['spending'] = $this->db->get('spanding')->result_array();

		$this->db->select('date_created');
		$data['count_user'] = $this->db->get_where('users', ['role' => 3])->result_array();

		$this->db->select('date_created');
		$data['orders'] = $this->db->get('order_details')->result_array();

		$this->db->join('employee', 'employee.uuid = users.uuid');
		$data['employee'] = $this->db->get_where('users', ['role' => 2])->result_array();


		return $data;
	}

	public function get_order_count($date){
		return $this->db->get_where('order_details', ['DATE(date_created)' => $date])->num_rows();
	}

	public function get_customer_count($date){
		return $this->db->get_where('users', ['DATE(date_created)' => $date])->num_rows();
	}

}

/* End of file Dashboard_model.php */
/* Location: ./application/models/Dashboard_model.php */