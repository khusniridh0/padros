<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (!is_login() || !is_admin()) {
			redirect('auth','refresh');
			die;
		}

		$this->load->model('spanding_model');
		$this->load->model('order_model');
		$this->load->model('payment_model');
		$this->load->model('user_model');
	}

	public function index() {
		$data['title'] = 'Laporan';
		$data['css'] = [
			'https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css',
			base_url('public/owner/assets/css/report.css')
		];
		$data['js'] = [
			'https://code.jquery.com/jquery-3.6.0.js',
			'https://code.jquery.com/ui/1.13.2/jquery-ui.js',
			base_url('public/owner/assets/js/report.js')
		];

		$this->load->view('owner/top', $data);
		$this->load->view('owner/aside');
		$this->load->view('owner/report');
		$this->load->view('owner/footer');
	}

	public function validated() {
		if ($this->uri->segment(3) == 'search') {
			$this->form_validation->set_rules('start', 'Tanggal mulai', 'trim|required');
			$this->form_validation->set_rules('end', 'Tanggal akhir', 'trim|required');
			$this->form_validation->set_rules('type', 'Jenis Transaksi', 'trim|required');

			if (!$this->form_validation->run()) {
				flashmessage('danger', 'Data tidak di temukan');
				redirect('report','refresh');
			} else {
				$data['traffic'] = $this->traffic();

				$data['title'] = 'Laporan';
				$data['css'] = [
					'https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css',
					base_url('public/owner/assets/css/report.css')
				];
				$data['js'] = [
					'https://code.jquery.com/jquery-3.6.0.js',
					'https://code.jquery.com/ui/1.13.2/jquery-ui.js',
					base_url('public/owner/assets/js/report.js')
				];

				$this->load->view('owner/top', $data);
				$this->load->view('owner/aside');
				$this->load->view('owner/report');
				$this->load->view('owner/footer');
			}
		} else if ($this->uri->segment(3) == 'print'){
			$data['traffic'] = $this->session->flashdata('traffic');
			$this->load->view('owner/print', $data);
		} else {
			flashmessage('danger', 'Data tidak di temukan');
			redirect('report','refresh');
		}
	}

	private function traffic(){

		$start = strtotime(set_date($this->input->post('start')));
		$end = strtotime(set_date($this->input->post('end')));

		$date = [];
		while ($start <= $end) {
			$date[] = date("Y-m-d", $start);
			$start = strtotime("+1 day", $start);
		}

		if ($this->input->post('type') == 2) {
			$query = $this->order_model->get_order_report($date);
		} else if ($this->input->post('type') == 3) {
			$query = $this->spanding_model->get_spanding_report($date);
		} else {
			$query = array_merge($this->spanding_model->get_spanding_report($date), $this->order_model->get_order_report($date));
		}

		usort($query, 'sortASC');
		$data = array_reverse($query);
		$result = [];

		foreach ($data as $d) {
			if (isset($d['information'])) {
				$tmp['keterangan'] = $d['information'];
			} else {
				if ($d['service'] == 1) {
					$tmp['keterangan'] = 'Sewa Studio';
				} else if ($d['service'] == 2) {
					$tmp['keterangan'] = 'Promo';
				} else {
					$tmp['keterangan'] = 'Sewa Rekaman Studio';
				}
			}

			$tmp['tanggal'] = date('d-m-Y', strtotime($d['date_created']));

			if (isset($d['payment_amount'])) {
				$tmp['jumlah'] = preg_replace('/[^0-9]/', '', $d['payment_amount']);
			} else {
				$tmp['jumlah'] = preg_replace('/[^0-9]/', '', $d['amount']);
			}

			if (isset($d['service'])) {
				$tmp['tipe'] = 'Pemasukan';
			} else {
				$tmp['tipe'] = 'Pengeluaran';
			}
			$result[] = $tmp;
		}
			// $result[] = $tmp['start'] = $start;
		// $tmp['end'] = $end;;

		$this->session->set_flashdata('traffic', $result);
		$this->session->set_flashdata('start', date('d-m-Y', $start));
		$this->session->set_flashdata('end', date('d-m-Y', $end));
		return $result;
	}

}

/* End of file Print.php */
/* Location: ./application/controllers/Print.php */