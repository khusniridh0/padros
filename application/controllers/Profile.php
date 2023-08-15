<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('user_model');

		if (!is_login() || !is_customer()) {
			redirect('/','refresh');
		}
	}

	public function index() {
		$data['title'] = 'Profil | Padros Studio';
		$data['style'] = [
			'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css',
			base_url('public/utama/css/styles.css'),
		];
		$data['script'] = [
			'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js',
			base_url('public/utama/js/profile.js'),
		];

		$user_data = $this->user_model->get_user_by_email($this->session->userdata('email'));
		if (empty($user_data)) {
			die('Access Denied');
		}
		$data['user'] = [
			'name' => $user_data['name'],
			'image' => $user_data['image'],
			'email' => $user_data['email'],
			'phone' => $user_data['phone'],
			'address' => $user_data['address'],
			'saldo' => $user_data['balance']
		];
		
		$this->load->view('utama/profile', $data);
	}

	public function update() {
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('phone', 'Nomor HP', 'required|numeric');
		$this->form_validation->set_rules('address', 'Alamat', 'required');

		if ($this->input->post('security')) {
			$this->form_validation->set_rules('now-password', 'Sandi saat ini', 'trim|required|min_length[6]|max_length[30]');	
			$this->form_validation->set_rules('new-password', 'Sandi bari', 'trim|required|min_length[6]|max_length[30]');	
			$this->form_validation->set_rules('confirm-new-password', 'Konfirmasi sandi baru', 'trim|required|matches[new-password]');
		}

		if ($this->form_validation->run()) {
			redirect('profile','refresh');
		} else {

			$data = [
				'name' => htmlspecialchars($this->input->post('name')),
				'phone' => htmlspecialchars($this->input->post('no-hp')),
				'address' => htmlspecialchars($this->input->post('address'))
			];


			$user_data = $this->user_model->get_user_by_email($this->session->userdata('email'));
			if (isset($_POST['security'])) {
				$password = htmlspecialchars($this->input->post('now-password'));
				if (password_verify($password, $user_data['password'])) {
					$data['password'] = password_hash(htmlspecialchars($this->input->post('new-password')), PASSWORD_DEFAULT);
				} else {
					$tipe = 'alert-warning';
					$pesan = 'Kata sandi gagal diperbaharui';
					$this->session->set_flashdata('warning', '<div class="alert ' . $tipe . ' alert-dismissible fade show sticky-top" role="alert"> ' . $pesan . ' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
				}
			}

			$this->user_model->update_profile_user($data, $this->session->userdata('user'));
			$this->form_validation->reset_validation();
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
			if ($this->form_validation->run()){
				if ($this->input->post('email') != $user_data['email']){
					$this->session->set_userdata(['surel' => $this->input->post('email')]);
					redirect('auth/verify/email-verify', 'refresh');
					die;
				}
			}

			redirect('profile', 'refresh');
		}
	}

	public function deposit() {
		$user = $this->user_model->get_user_by_uuid($this->session->userdata('user'));
		$this->form_validation->set_rules('deposit', 'Deposit', 'trim|required');

		if (!$this->form_validation->run()) {
			flashmessage('warning', 'Deposit gagal di lakukan');
			redirect('profile');
		} else {
			$deposit = preg_replace('/[^0-9]/', '', $this->input->post('deposit'));
			$deposit += $user['balance'];
			$this->user_model->update_profile_user(['balance' => $deposit], $this->session->userdata('user'));
			flashmessage('success', 'Deposit berhasil');
			redirect('profile');
		}
	}

}


/* End of file Profile.php */
/* Location: ./application/controllers/Home.php */