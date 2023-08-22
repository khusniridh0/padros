<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deposit extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (!is_login() || !is_admin()) {
			redirect('auth','refresh');
			die;
		}

		$this->load->model('deposits_model');
		$this->load->model('user_model');
	}

	public function index() {
		$data['title'] = 'Deposit';
		$data['deposits'] = $this->deposits_model->get_deposit_all();
		$data['js'] = [
			'https://code.jquery.com/jquery-3.6.0.js',
			base_url('public/owner/assets/js/deposit.js'),
		];

		$this->load->view('owner/top', $data);
		$this->load->view('owner/aside');
		$this->load->view('owner/deposit');
		$this->load->view('owner/footer');
	}

	public function detile() {
		$uuid = $this->uri->segment(3);
		$data = ['status' => 404];
		if (!empty($uuid)) {
			$data = $this->deposits_model->get_deposit_by_uuid_deposits($uuid);
			$data['amount'] = number_format($data['amount']) . ',-';
			$data['data'] = date('d-m-Y', strtotime($data['date_created']));
			$data['proof'] = base_url('public/owner/assets/img/orders/' . $data['proof']);
			$data['reject'] = '';
			$data['accept'] = '';
			if ($data['status'] == 0) {
				$data['reject'] = base_url('deposit/validated/reject/' . $uuid);
				$data['accept'] = base_url('deposit/validated/accept/' . $uuid);
			}
			$data['status'] = 200;
			if (empty($data)) {
				$data = ['status' => 404];
			}
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function validated() {
		if ($this->uri->segment(3) == 'accept') {
			$this->accept($this->uri->segment(4));
			redirect('deposit','refresh');
		} else if ($this->uri->segment(3) == 'reject') {
			$this->deposits_model->deposit_update_by_uuid(['status' => 2], $this->uri->segment(4));
			redirect('deposit','refresh');
		} else {
			redirect('deposit','refresh');
		}
	}

	private function accept($uuid) {
		$data = $this->deposits_model->get_deposit_by_uuid_deposits($uuid);
		$this->user_model->update_profile_user(['balance' => $data['amount'] + $data['balance']], $data['uuid']);
		$this->deposits_model->deposit_update_by_uuid(['status' => 1], $uuid);
	}
}

/* End of file Deposit.php */
/* Location: ./application/controllers/Deposit.php */