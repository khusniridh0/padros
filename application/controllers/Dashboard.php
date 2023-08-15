<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	private $query;
	public function __construct(){
		parent::__construct();
		if (!is_login() || !is_admin()) {
			redirect('auth','refresh');
			die;
		}

		$this->load->model('dashboard_model');
		$this->load->model('spanding_model');
		$this->load->model('payment_model');
		$this->query = $this->dashboard_model->get_all_data();
	}

	public function index() {
		$data['pendapatan'] = 0;
		foreach ($this->query['income'] as $item) {
			$data['pendapatan'] += $item['payment_amount'];
		}
		$data['present_pendapatan'] = present($this->query['income'], date('Y-m-d'));
		$data['penjualan'] = count($this->query['orders']);
		$data['present_penjualan'] = present($this->query['orders'], date('Y-m-d'));
		$data['pelanggan'] = count($this->query['count_user']);
		$data['present_pelanggan'] = present($this->query['count_user'], date('Y-m-d'));
		$data['staf'] = count($this->query['employee']);
		$data['present_staf'] = present($this->query['employee'], date('Y-m-d'));
		$data['employee'] = $this->query['employee'];

		$data['title'] = 'Dashboard';
		$data['js'] = [
			'https://code.jquery.com/jquery-3.6.0.js',
			base_url('public/owner/assets/js/dashboard.js')
		];
		$this->load->view('owner/top', $data);
		$this->load->view('owner/aside');
		$this->load->view('owner/dashboard');
		$this->load->view('owner/footer');
	}

	public function graphic() {
		$graphic_penjualan = $this->query['orders'];
		$graphic_pelanggan = $this->query['count_user'];
		$graphic_pendapatan = $this->query['income'];
		$data['categories'] = array_reverse(graphic()[0]);
		$data['graphic_penjualan'] = [];
		$data['graphic_pelanggan'] = [];
		$data['graphic_pendapatan'] = [];
		$data['graphic_pengeluaran'] = [];

		foreach ($data['categories'] as $i => $date) {
			$query = $this->dashboard_model->get_order_count($date);
			$data['graphic_penjualan'][$i] = $query;
		}

		foreach ($data['categories'] as $i => $date) {
			$query = $this->dashboard_model->get_customer_count($date);
			$data['graphic_pelanggan'][$i] = $query;
		}

		foreach ($data['categories'] as $i => $date) {
			$query = $this->payment_model->get_payment_by_date($date);
			$data['graphic_pendapatan'][$i] = 0;
			$tmp = 0;
			if (!empty($query)) {
				foreach ($query as $item) {
					$data['graphic_pendapatan'][$i] += $item['payment_amount'];
				}
				foreach ($query as $item) {
					$tmp += $data['graphic_pendapatan'][$i] / $item['payment_amount'] * 7;
				}
				$data['graphic_pendapatan'][$i] = round($tmp);
			}
		}

		foreach ($data['categories'] as $i => $date) {
			$query = $this->spanding_model->get_payment_by_date($date);
			$data['graphic_pengeluaran'][$i] = 0;
			$tmp = 0;
			if (!empty($query)) {
				foreach ($query as $item) {
					$data['graphic_pengeluaran'][$i] += $item['amount'];
				}
				foreach ($query as $item) {
					$tmp += $data['graphic_pengeluaran'][$i] / $item['amount'] * 7;
				}
				$data['graphic_pengeluaran'][$i] = round($tmp);
			}
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Home.php */