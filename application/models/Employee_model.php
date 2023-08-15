<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_model extends CI_Model {
    private $table = 'employee';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function save_employee($data) {
        return $this->db->insert($this->table, $data);
    }

    public function update_employee_by_uuid($employee, $uuid) {
        $this->db->update($this->table, $employee, ['uuid' => $uuid]);
    }

    public function get_employee_all() {
        $this->db->order_by('employee.id', 'desc');
        $this->db->where('users.role', 2);
        $this->db->join('users', 'employee.uuid = users.uuid');
        return $this->db->get($this->table)->result_array();
    }

    public function get_employee_by_uuid($uuid) {
        return $this->db->get_where($this->table, array('uuid' => $uuid))->row_array();
    }

    public function remove_employee_by_uuid($uuid) {
        if ($this->db->delete($this->table, ['uuid' => $uuid])) {
            return $this->db->delete('users', ['uuid' => $uuid]);
        }
    }

}
