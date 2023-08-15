<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Finance extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (!is_login() || !is_admin()) {
			redirect('auth','refresh');
			die;
		}

		$this->load->model('spanding_model');
		$this->load->model('order_model');
		$this->load->model('payment_model');
	}

	public function index() {
		$data['title'] = 'Keuangan';
		$data['js'] = [
			'https://code.jquery.com/jquery-3.6.0.js',
			base_url('public/owner/assets/js/finance.js')
		];
		$data['traffic'] = $this->traffic();

		$this->load->view('owner/top', $data);
		$this->load->view('owner/aside');
		$this->load->view('owner/finance');
		$this->load->view('owner/footer');
	}

	public function submit() {
		if ($this->uri->segment(3) == 'accept') {
			if (!is_owner()) {
				redirect('finance','refresh');
				die;
			}
			$this->spanding_model->spanding_update(['status' => 1], $this->uri->segment(4));
			redirect('finance','refresh');
		} else if ($this->uri->segment(3) == 'denied') {
			if (!is_owner()) {
				redirect('finance','refresh');
				die;
			}
			$this->spanding_model->spanding_update(['status' => 2], $this->uri->segment(4));
			redirect('finance','refresh');
		} else if ($this->uri->segment(3) == 'add'){
			$this->form_validation->set_rules('description', 'Description', 'trim|required', [
				'required' => '{field} wajib diisi'
			]);

			$this->form_validation->set_rules('amount', 'Amount', 'trim|required', [
				'required' => '{field} wajib diisi',
			]);

			if (!$this->form_validation->run()) {
				$this->form_validation->set_error_delimiters('<div class="invalid-feedback text-danger opacity-75" style="display: block;">', '</div>');
			} else {
				$this->submission();
				redirect('finance','refresh');
			}
		}

		$data['title'] = 'Keuangan';
		$data['js'] = [
			'https://code.jquery.com/jquery-3.6.0.js',
			base_url('public/owner/assets/js/finance.js')
		];
		$data['traffic'] = $this->traffic();

		$this->load->view('owner/top', $data);
		$this->load->view('owner/aside');
		$this->load->view('owner/finance');
		$this->load->view('owner/footer');
	}

	public function graphic() {
		$spanding = $this->spanding_model->get_all_spanding();
		$payment = $this->payment_model->get_only_payment();

		foreach ($spanding as $index => $item) {
			unset($spanding[$index]['id']);
			unset($spanding[$index]['uuid_user']);
			unset($spanding[$index]['information']);
			unset($spanding[$index]['status']);
			unset($spanding[$index]['date_updated']);
		}

		foreach ($spanding as $index => $item) {
			unset($payment[$index]['id']);
			unset($payment[$index]['payment_uuid']);
			unset($payment[$index]['payment_method']);
			unset($payment[$index]['proof_of_payment']);
			unset($payment[$index]['date_updated']);
		}

		$data['spanding'] = [];
		$data['payment'] = [];
		$data['categories'] = graphic();

		foreach ($data['categories'][0] as $i => $date) {
			$query = $this->payment_model->get_payment_by_date($date);
			$data['payment'][$i] = 0;
			if (!empty($query)) {
				foreach ($query as $item) {
					$data['payment'][$i] += $item['payment_amount'];
				}
			}
		}

		foreach ($data['categories'][0] as $i => $date) {
			$query = $this->spanding_model->get_payment_by_date($date);
			$data['spanding'][$i] = 0;
			if (!empty($query)) {
				foreach ($query as $item) {
					$data['spanding'][$i] += $item['amount'];
				}
			}
		}

		$data['spanding'] = [$data['spanding']];
		$data['payment'] = [$data['payment']];
		$data['categories'] = array_reverse($data['categories'][0]);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	private function submission() {
		$data = [
			'spanding_uuid' => random_uuid(),
			'uuid_user' => $this->session->userdata('user'),
			'information' => $this->input->post('description'),
			'amount' => preg_replace('/[^0-9]/', '', $this->input->post('amount')),
			'date_created' => date('Y-m-d H:i:s'),
			'date_updated' => date('Y-m-d H:i:s')
		];

		if ($this->session->userdata('role') == 1) {
			$data['status'] = 1;
			flashmessage('success', 'Pengeluaran berhasil di buat');
		} else if ($this->session->userdata('role') == 2) {
			$data['status'] = 0;
			flashmessage('success', 'Pengeluaran sedang di ajukan menunggu konfirmasi owner');
		}

		if (!$this->spanding_model->save_spanding($data)) {
			if ($this->session->userdata('role') == 1) {
				flashmessage('danger', 'Gagal membuat pengeluaran baru');
			} else if ($this->session->userdata('role') == 2) {
				flashmessage('danger', 'Gagal membuat pengajuan pengeluara');
			}
		}
	}

	private function traffic(){
		$query = array_merge(
			$this->spanding_model->get_all_spanding(),
			$this->order_model->get_order_accept_join()
		);

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

			$tmp['tanggal'] = $d['date_created'];

			if (isset($d['order_uuid'])) {
				$tmp['id'] = $d['order_uuid'];
			} else {
				$tmp['id'] = $d['spanding_uuid'];
			}

			if (isset($d['payment_amount'])) {
				$tmp['jumlah'] = preg_replace('/[^0-9]/', '', $d['payment_amount']);
			} else {
				$tmp['jumlah'] = preg_replace('/[^0-9]/', '', $d['amount']);
			}

			if (isset($d['service'])) {
				$tmp['tipe'] = 'up';
				$tmp['role'] = 2;
				$tmp['role_type'] = $d['status'];
				if ($d['status'] == 0) {
					$tmp['status'] = 'Berirespon';
				} else if ($d['status'] == 1) {
					$tmp['status'] = 'Diterima';
				} else {
					$tmp['status'] = 'Ditolak';
				}
			} else {
				$tmp['tipe'] = 'down';
				$tmp['role'] = 1;
				$tmp['role_type'] = $d['status'];
				if ($d['status'] == 0) {
					$tmp['status'] = 'Pengajuan';
				} else if ($d['status'] == 1) {
					$tmp['status'] = 'Diterima';
				} else {
					$tmp['status'] = 'Ditolak';
				}
			}
			$result[] = $tmp;
		}

		return $result;
	}
}

/* End of file Finance.php */
	/* Location: ./application/controllers/Home.php */