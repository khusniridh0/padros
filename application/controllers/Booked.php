<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Booked extends CI_Controller {

	public function __construct() {
		parent::__construct();

		if (!is_login() || !is_customer()) {
			redirect('auth','refresh');
		}

		$this->load->model('order_model');
	}

	public function index() {
		$data['title'] = 'Daftar pesanan | Padros Studio';
		$data['style'] = [
			'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css',
			base_url('public/utama/css/styles.css')
		];
		$data['script'] = [
			'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js',
		];
		$data['orders'] = $this->order_model->get_order_join_all_by_uuid($this->session->userdata('user'));
		$this->load->view('utama/booked', $data);
	}

	public function detile() {
		$data['title'] = 'Pesanan | Padros Studio';
		$data['style'] = [
			'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css',
			base_url('public/utama/css/styles.css'),
			base_url('public/utama/css/home.css')
		];
		$data['script'] = [
			'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js',
		];
		$data['order'] = $this->order_model->get_order_join_by_order_uuid($this->uri->segment(3));

		if (empty($data['order'])) {
			redirect('booked','refresh');
		}

		$this->load->view('utama/orders', $data);
	}

	public function orders() {
		$data['title'] = 'Pesanan | Padros Studio';
		$data['style'] = [
			'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css',
			base_url('public/utama/css/styles.css'),
			base_url('public/utama/css/home.css')
		];
		$data['script'] = [
			'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js',
		];
		$data['order'] = $this->order_model->get_order_join_by_uuid($this->session->userdata('user'));

		if (empty($data['order'])) {
			redirect('/','refresh');
		}

		$this->load->view('utama/orders', $data);
	}
}

/* End of file Booked.php */
/* Location: ./application/controllers/Home.php */