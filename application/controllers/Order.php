<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (!is_login() || !is_admin()) {
			redirect('auth','refresh');
			die;
		}

		$this->load->model('user_model');
		$this->load->model('order_model');
		$this->load->model('order_detile_model');
	}

	public function index() {
		$data['title'] = 'Pesanan';
		$data['orders'] = $this->order_model->get_order_join();
		$this->load->view('owner/top', $data);
		$this->load->view('owner/aside');
		$this->load->view('owner/order');
		$this->load->view('owner/footer');
	}

	public function detile() {
		$data['title'] = 'Dateil Pesanan';
		$data['order'] = $this->order_model->get_order_join_by_order_uuid_on_users($this->uri->segment(3));
		$data['js'] = [base_url('public/owner/assets/js/order.js')];
		$this->load->view('owner/top', $data);
		$this->load->view('owner/aside');
		$this->load->view('owner/order_detle');
		$this->load->view('owner/footer');
	}

	public function service(){
		if ($this->uri->segment(3) == 'accept') {
			$this->order_detile_model->update_status_order(['status' => 1], $this->uri->segment(4));
		} else if ($this->uri->segment(3) == 'denied') {
			if (!is_owner()) {
				redirect('order','refresh');
			}
			$order = $this->order_model->get_order_join_by_order_detile_uuid($this->uri->segment(4));
			$balance = $this->user_model->get_user_by_uuid($order['uuid'])['balance'];
			$balance += $order['payment_amount'];
			$this->user_model->update_profile_user(['balance' => $balance], $order['uuid']);
			$this->order_detile_model->update_status_order(['status' => 2], $this->uri->segment(4));
		} else {
			return 404;
		}

		redirect('order','refresh');
	}

}

/* End of file Order.php */
/* Location: ./application/controllers/Home.php */