<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if (!is_login() || !is_admin()) {
			redirect('auth','refresh');
			die;
		}

		$this->load->model('user_model');
		$this->load->model('employee_model');
	}

	public function index() {
		$data['title'] = 'Dashboard';
		$data['js'] = [
			base_url('public/owner/assets/js/setting.js')
		];
		$user = $this->user_model->get_user_by_uuid($this->session->userdata('user'));
		$employee = $this->employee_model->get_employee_by_uuid($this->session->userdata('user'));

		if (empty($user) || empty($employee)) {
			return '404';
			die;
		}

		$data['user'] = array_merge($user, $employee);
		$this->load->view('owner/top', $data);
		$this->load->view('owner/aside');
		$this->load->view('owner/setting');
		$this->load->view('owner/footer');
	}

	public function validated() {
		if ($this->uri->segment(3) == 'profile') {
			$this->form_validation->set_rules('email', 'Alamat email', 'trim|is_unique[users.email]', [
				'is_unique' => ''
			]);

			if (!$this->form_validation->run()) {
				$this->form_validation->set_rules('email', 'Alamat email', 'trim|required|valid_email', [
					'required' => '{field} wajib diisi',
					'valid_email' => '{field} tidak valid',
				]);
			} else {
				$this->form_validation->set_rules('email', 'Alamat email', 'trim|required|valid_email|is_unique[users.email]', [
					'required' => '{field} wajib diisi',
					'valid_email' => '{field} tidak valid',
					'is_unique' => 'Email sudah terdaftar gunakan email lain'
				]);

				$verify_code = verify_code();
				$email = htmlspecialchars($this->input->post('email'));
				$message = 'Email Anda didaftarkan ke Padros Studio<br>Gunakan link berikut untuk berifikasi ' . base_url('auth/link_verify/' . urlencode($this->input->post('email')) . '/' . urlencode($verify_code));
				$subject = 'Verifikasi Akun';

				if (email_send($email, $message, $subject)){
					$this->session->set_userdata(['surel' => $this->input->post('email')]);
					$this->user_model->update_code_verify_user($verify_code, $this->session->userdata('user'));
					flashmessage('success', 'Periksa email anda untuk verifikasi email, jangan keluar sebelum email terverifikasi');
				} else {
					flashmessage('warning', 'Email Gagal diperbarui');
				}
			}

			$this->form_validation->reset_validation();

			$this->form_validation->set_rules('name', 'Nama lengkap', 'trim|required|min_length[3]|max_length[125]', [
				'required' => '{field} wajib diisi'
			]);
			$this->form_validation->set_rules('city', 'Kota', 'trim|required', [
				'required' => '{field} wajib diisi'
			]);
			$this->form_validation->set_rules('phone', 'Nomor HP', 'trim|required|numeric', [
				'required' => '{field} wajib diisi',
				'numeric' => '{field} tidak valid'
			]);
			$this->form_validation->set_rules('address', 'Alamat lengkap', 'trim|required', [
				'required' => '{field} wajib diisi'
			]);

			if (!$this->form_validation->run()) {
				$this->form_validation->set_error_delimiters('<div class="invalid-feedback text-danger opacity-75" style="display: block;">', '</div>');
			} else {
				$this->profile_update();
				$this->form_validation->reset_validation();
				$this->form_validation->set_rules('email', 'Alamat email', 'trim|required|valid_email|is_unique[users.email]', [
					'required' => '{field} wajib diisi',
					'valid_email' => '{field} tidak valid',
					'is_unique' => 'Email sudah terdaftar gunakan email lain'
				]);
				if (!$this->form_validation->run()) {
					flashmessage('success', 'Profil berhasil di perbaharui');
				}
				redirect('setting','refresh');
			}
		} else if ($this->uri->segment(3) == 'security') {
			$this->form_validation->set_rules('now-password', 'Sandi saat ini', 'trim|required|min_length[6]|max_length[30]', [
					'required' => '{field} wajib diisi',
					'min_length' => '{field} panajng minimal 6 karakter',
					'max_length' => '{field} melebihi panajng maksimal'
				]);	
			$this->form_validation->set_rules('new-password', 'Sandi baru', 'trim|required|min_length[6]|max_length[30]', [
					'required' => '{field} wajib diisi',
					'min_length' => '{field} panajng minimal 6 karakter',
					'max_length' => '{field} melebihi panajng maksimal'
				]);
			$this->form_validation->set_rules('confirm-new-password', 'Konfirmasi sandi baru', 'trim|required|matches[new-password]', [
					'required' => '{field} wajib diisi',
					'matches' => '{field} tidak cocok',
				]);	

			if (!$this->form_validation->run()) {
				$this->form_validation->set_error_delimiters('<div class="invalid-feedback text-danger opacity-75" style="display: block;">', '</div>');
			} else {
				$this->security();
				redirect('setting','refresh');
			}
		}

		$data['title'] = 'Dashboard';
		$data['js'] = [
			base_url('public/owner/assets/js/setting.js')
		];
		$user = $this->user_model->get_user_by_email($this->session->userdata('email'));
		$employee = $this->employee_model->get_employee_by_uuid($this->session->userdata('user'));

		if (empty($user) || empty($employee)) {
			return '404';
			die;
		}

		$data['user'] = array_merge($user, $employee);
		$this->load->view('owner/top', $data);
		$this->load->view('owner/aside');
		$this->load->view('owner/setting');
		$this->load->view('owner/footer');
	}

	public function reset_profile_picture() {
		$user = $this->user_model->get_user_by_uuid($this->session->userdata('user'));
		$file_default = ['avatar1.jpg'];
		if (!in_array($user['image'], $file_default)) {
			$user = 'public/utama/assets/dinamis/profil/' . $this->session->userdata('image');
			if ($user) {
				unlink($user);
			}
		}

		$this->user_model->update_profile_user(['image' => 'avatar1.jpg'], $this->session->userdata('user'));
		$this->session->set_userdata(['image' => 'avatar1.jpg']);
		echo json_encode(['url' => base_url('public/utama/assets/dinamis/profil/avatar1.jpg')]);
	}

	private function profile_update() {
		$user = [
			'name' => htmlspecialchars($this->input->post('name')),
			'address' => htmlspecialchars($this->input->post('address')),
			'phone' => htmlspecialchars($this->input->post('phone'))
		];

		$employee = ['city' => htmlspecialchars($this->input->post('city'))];

		if ($_FILES['image']['error'] == 0) {
			$user = $this->user_model->get_user_by_uuid($this->uri->segment(4));

			$config['upload_path'] = './public/utama/assets/dinamis/profil/';
			$config['allowed_types'] = 'jpeg|jpg|png';
			$config['max_size'] = '100000';
			
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			
			if (!empty($user['image'])) {
				if (file_exists('public/utama/assets/dinamis/profil/' . $user['image'])) {
					$file_default = ['avatar1.jpg'];
					if (!in_array($user['image'], $file_default)) {
						unlink('public/utama/assets/dinamis/profil/' . $user['image']);
					}
				}
			}
			
			if (!$this->upload->do_upload('image')){
				flashmessage('warning', 'Terjadi masalah saat update foto profil');
			} else{
				$file_name = $this->upload->data('file_name');
				$user['image'] = $file_name;
				$this->session->set_userdata(['image' => $file_name]);
			}
		}

		$this->user_model->update_profile_user($user, $this->uri->segment(4));
		$this->employee_model->update_employee_by_uuid($employee, $this->uri->segment(4));
		
		$this->session->set_userdata([
			'name' => $this->input->post('name'),
			'phone' => $this->input->post('phone')
		]);
	}

	private function security(){

		$user = $this->user_model->get_user_by_uuid($this->session->userdata('user'));

		if (password_verify($this->input->post('now-password'), $user['password'])) {
			$data = ['password' => password_hash($this->input->post('new-password'), PASSWORD_DEFAULT)];
			if (!$this->user_model->update_profile_user($data, $this->session->userdata('user'))) {
				flashmessage('danger', 'Terjadi kesalahan saat membuat sandi baru');
			} else {
				flashmessage('success', 'Sandi berhasil di perbaharui');
			} 
		} else {
			flashmessage('warning', 'Kata sandi sebelumnya salah');
		}
	}

}

/* End of file Profile-Settings.php */
/* Location: ./application/controllers/Profile-Settings.php */