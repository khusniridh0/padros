<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deposits_model extends CI_Model {

private $table = 'deposits';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function save_deposit($data) {
    	return $this->db->insert($this->table, $data);
    }

    public function get_deposit_all() {
    	$this->db->order_by('id_deposit', 'desc');
    	$this->db->select('uuid_deposit, name, amount, deposits.date_created, deposits.status');
    	$this->db->join('users', 'users.uuid = deposits.uuid_user');
    	return $this->db->get($this->table)->result_array();
    }

    public function get_deposit_by_uuid_deposits($uuid) {
    	$this->db->select('uuid_deposit, users.uuid, name, amount, balance, deposits.date_created, proof, deposits.status');
    	$this->db->join('users', 'users.uuid = deposits.uuid_user');
    	return $this->db->get_where($this->table, ['uuid_deposit' => $uuid])->row_array();
    }

    public function deposit_update_by_uuid($data, $uuid) {
    	return $this->db->update($this->table, $data, ['uuid_deposit' => $uuid]);
    }

}

/* End of file Deposits_model.php */
/* Location: ./application/models/Deposits_model.php */