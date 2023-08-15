<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
    private $table = 'users';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function save_user($data) {
        return $this->db->insert($this->table, $data);
    }

    public function update_profile_user($data, $uuid) {
        return $this->db->update($this->table, $data, ['uuid' => $uuid]);
    }

    public function update_status_user($status, $uuid) {
        return $this->db->update($this->table, ['status' => $status], ['uuid' => $uuid]);
    }

    public function update_code_verify_user($code, $uuid) {
        return $this->db->update($this->table, ['verify' => $code], ['uuid' => $uuid]);
    }

    public function update_password_user($pass, $uuid) {
        return $this->db->update($this->table, ['password' => $pass], ['uuid' => $uuid]);
    }

    public function get_user_all() {
        $this->db->order_by('id', 'desc');
        $this->db->where('role', 3);
        return $this->db->get($this->table)->result_array();
    }

    public function get_user_by_email($email) {
        return $this->db->get_where($this->table, array('email' => $email))->row_array();
    }

    public function get_user_by_uuid($uuid) {
        return $this->db->get_where($this->table, ['uuid' => $uuid])->row_array();
    }

    public function remove_user_by_uuid($uuid){
        return $this->db->delete($this->table, ['uuid' => $uuid]);
    }

}
