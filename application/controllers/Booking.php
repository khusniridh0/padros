 <?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends CI_Controller {
	public function __construct() {
		parent::__construct();

		if (!is_login() || !is_customer()) {
			redirect('auth','refresh');
		}

		$this->load->model('user_model');
		$this->load->model('order_model');
		$this->load->model('order_detile_model');
		$this->load->model('payment_model');
	}

	public function index() {
		redirect('booking/service','refresh');
		// $data['title'] = 'Booking | Padros Studio';
		// $data['style'] = [
		// 	'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css',
		// 	base_url('public/utama/css/styles.css'),
		// 	base_url('public/utama/css/home.css')
		// ];
		// $data['script'] = [
		// 	'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js',
		// 	base_url('public/utama/js/booking.js'),
		// ];
		// $this->load->view('utama/booking', $data);
	}

	public function service() {
		if ($this->session->flashdata('warning') == null) {
			flashmessage('success', 'Jika tombol <strong>Pesan Sekarang</strong> aktif maka pada tanggal dan waktu tersebut tersedia, studio siap untuk di pesan');
		}
		if ($this->uri->segment(3) == 'rent') {
			$data['price'] = 50000;
			$data['service'] = 1;
		} else if ($this->uri->segment(3) == 'promo') {
			$data['price'] = 60000;
			$data['service'] = 2;
		} else if ($this->uri->segment(3) == 'record') {
			$data['price'] = 70000;
			$data['service'] = 3;
		} else if ($this->uri->segment(3) == 'order') {
			$this->form_validation->set_rules('name', '', 'trim|required');
			$this->form_validation->set_rules('date-of-entry', '', 'trim|required');
			$this->form_validation->set_rules('clock-in', '', 'trim|required');
			$this->form_validation->set_rules('clock-out', '', 'trim|required');
			$this->form_validation->set_rules('payment-amount', '', 'trim|required|numeric');
			$this->form_validation->set_rules('payment-method', '', 'trim|required');
			$this->form_validation->set_rules('service', '', 'trim|required');

			if (!$this->form_validation->run()) {
				flashmessage('warning', 'Lengkapi formulir dengan benar');
				redirect('booking/service/' . $this->uri->segment(4) ,'refresh');
				return false;
			} else {
				$this->orders();
				redirect('booking/service/' . $this->uri->segment(4) ,'refresh');
				return false;
				die;
			}
		} else if ($this->uri->segment(3) == 'profile') {
			$this->session->unset_userdata('warning');
			redirect('profile','refresh');
			exit;
		}

		if (!isset($data['price'])) {
			echo 'di sini';
			die;
			redirect('/','refresh');
		}

		$data['title'] = 'Booking | Padros Studio';
		$data['style'] = [
			'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css',
			'https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css',
			'https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css',
			base_url('public/utama/css/styles.css'),
			base_url('public/utama/css/home.css')
		];
		$data['script'] = [
			'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js',
			'https://code.jquery.com/jquery-3.6.0.js',
			'https://code.jquery.com/ui/1.13.2/jquery-ui.js',
			'https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js',
			base_url('public/utama/js/booking.js')
		];
		$this->load->view('utama/booking', $data);
	}

	public function check() {
		$this->form_validation->set_rules('date', 'tanggal', 'trim|required');
		$this->form_validation->set_rules('timeIn', 'tanggal', 'trim|required');
		$this->form_validation->set_rules('timeOut', 'tanggal', 'trim|required');

		if (!$this->form_validation->run()) {
			redirect('/','refresh');			
		} else {
			$order = $this->order_detile_model->get_order_detile_all();

			$response = ['status' => true];
			foreach ($order as $booking) {
				if ($booking['order_date'] == set_date($this->input->post('date')) && ($booking['start_time'] <= $this->input->post('timeOut') && $booking['end_time'] >= $this->input->post('timeIn'))) {
					$response = ['status' => false];
					break;
				}
			}

			echo json_encode($response);
		}
	}

	private function orders(){
		$order_uudi = random_uuid();
		$payment_uudi = random_uuid();
		$user = $this->user_model->get_user_by_uuid($this->session->userdata('user'));
		$order = [
			'uuid' => $this->session->userdata('user'),
			'order_uuid' => $order_uudi,
			'payment_uuid' => $payment_uudi,
			'service' => $this->input->post('service')
		];
		$order_detile = [
			'order_uuid' => $order_uudi,
			'order_name' => $this->input->post('name'),
			'order_date' => set_date($this->input->post('date-of-entry')),
			'start_time' => $this->input->post('clock-in'),
			'end_time' => $this->input->post('clock-out'),
			'status' => 0,
			'date_updated' => date('Y-m-d H:i:s'),
			'date_created' => date('Y-m-d H:i:s'),
		];

		$payment = [
			'payment_uuid' => $payment_uudi,
			'payment_amount' => $this->input->post('payment-amount'),
			'payment_method' => $this->input->post('payment-method'),
			'date_updated' => date('Y-m-d H:i:s'),
			'date_created' => date('Y-m-d H:i:s')
		];

		if ($this->input->post('payment-method') == 'Transfer Bank') {
			if ($_FILES['proof-of-payment']['error'] != 0) {
				flashmessage('warning', 'Lengkapi formulir dengan benar');
				redirect('booking/service/' . $this->uri->segment(4) ,'refresh');
				return false;
				die;
			}

			$config['upload_path'] = './public/owner/assets/img/orders/';
			$config['allowed_types'] = 'jpeg|jpg|png';
			
			$this->load->library('upload', $config);
			
			if (!$this->upload->do_upload('proof-of-payment')){
				flashmessage('danger', 'Terjadi kesalahan saat mengunggah bukti pembayaran');
				redirect('booking/service/' . $this->uri->segment(4) ,'refresh');
				return false;
				die;
			}
			else{
				$payment['proof_of_payment'] = $this->upload->data('file_name');
			}
		}

		if ($this->input->post('payment-method') == 'Deposit') {
			if ($user['balance'] < $this->input->post('payment-amount')) {
				$this->session->set_flashdata('danger', 'danger');
				redirect('booking/service/' . $this->uri->segment(4) ,'refresh');
				die;
			} else {
				$user['balance'] -= $this->input->post('payment-amount');
				$this->user_model->update_profile_user(['balance' => $user['balance']], $this->session->userdata('user'));
			}
		}
		
		$this->order_model->save_order($order);
		$this->order_detile_model->save_order_detile($order_detile);
		$this->payment_model->save_payment($payment);

		flashmessage('info', 'Pesana sedang di prosess');
		redirect('booked/orders','refresh');
		return true;
		die;

	}

}

/* End of file Booking.php */
/* Location: ./application/controllers/Home.php */