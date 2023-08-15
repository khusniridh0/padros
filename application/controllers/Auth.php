<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	private $verify_code;

	public function __construct() {
		parent::__construct();
		$this->load->model('user_model');
	}

	public function index() {
		if (is_login()) {
			if (is_admin()) {
				redirect('dashboard','refresh');
			} else {
				redirect('/','refresh');
			}
		}
		
		$data['title'] = 'Login | Padros Studio';
		$data['style'] = [
			'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css',
			base_url('public/utama/css/styles.css'),
			base_url('public/utama/css/home.css')
		];
		$data['script'] = [
			'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js',
			base_url('public/utama/js/login.js'),
		];

		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', [
			'required' => '{field} wajib diisi',
			'valid_email' => '{field} tidak valid'
		]);
		$this->form_validation->set_rules('password', 'Kata Sandi', 'trim|required', [
			'required' => '{field} wajib diisi',
		]);

		if (!$this->form_validation->run()) {
			$this->load->view('utama/login', $data);
		} else {
			if (!$this->login()) {
				$tipe = 'alert-warning';
				$pesan = 'Email atau kata sandi salah';
				$this->session->set_flashdata('warning', '<div class="alert ' . $tipe . ' alert-dismissible fade show sticky-top" role="alert"> ' . $pesan . ' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
				redirect('auth','refresh');
			}	
		}
	}

	public function register() {
		if (is_login()) {
			if (is_admin()) {
				redirect('dashboard','refresh');
			} else {
				redirect('/','refresh');
			}
		}

		$data['title'] = 'Daftar | Padros Studio';
		$data['style'] = [
			'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css',
			base_url('public/utama/css/styles.css')
		];
		$data['script'] = [
			'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js',
			base_url('public/utama/js/register.js'),
		];

		$this->form_validation->set_rules('name', 'Name', 'trim|required', [
			'required' => '{field} wajib diisi'
		]);
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]', [
			'required' => '{field} wajib diisi',
			'valid_email' => '{field} tidak valid',
			'is_unique' => '{field} telah terdaftar'
		]);
		$this->form_validation->set_rules('phone', 'phone', 'trim|required|numeric', [
			'required' => '{field} wajib diisi',
			'numeric' => '{field} tidak valid'
		]);
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[30]', [
			'required' => '{field} wajib diisi',
			'min_length' => '{field} telalu pendek',
			'max_length' => '{field} telalu panjang'
		]);
		$this->form_validation->set_rules('konfirm', 'Konfirmasi kata', 'trim|required|matches[password]', [
			'required' => '{field} wajib diisi',
			'matches' => '{field} sandi tidak cocok'
		]);

		$this->form_validation->set_error_delimiters('<div class="invalid-feedback text-danger opacity-75" style="display: block;">', '</div>');

		if ($this->form_validation->run()) {
			if ($this->registrastion()) {
				redirect('auth/verify/register','refresh');
				return true;
			} else {
				$tipe = 'alert-danger';
				$pesan = 'Pendaftaran gagal di lakukan';
				$this->session->set_flashdata('warning', '<div class="alert ' . $tipe . ' alert-dismissible fade show sticky-top" role="alert"> ' . $pesan . ' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
			}
		}
		$this->load->view('utama/register', $data);
}

	public function verify() {
		$data['title'] = 'Verifikasi | Padros Studio';
		$data['style'] = [
			'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css',
			base_url('public/utama/css/styles.css'),
		];
		$data['script'] = [
			'https://code.jquery.com/jquery-3.7.0.min.js',
			'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js',
			base_url('public/utama/js/verify.js'),
		];

		if ($this->uri->segment(3) == 'requestcode') {
			if ($this->session->userdata('surel') && $this->session->userdata('user')){
				if ($this->input->post('requestCode')) {
					if (!$this->verify_send()){
						echo json_encode(['msg' => 'Kode verifikasi tidak terkirim']);
						return false;
					}
					$this->user_model->update_code_verify_user($this->verify_code, $this->session->userdata('user'));
					echo json_encode(['msg' => 'Kode verifikasi berhasil terkirim', 'verify' => $this->verify_code]);
					return true;
				} else {
					$this->load->view('utama/verify', $data);
				}
			} else {
				$this->load->view('utama/verify', $data);
			}
		} else {
			$this->load->view('utama/verify', $data);
		}

		if ($this->uri->segment(3) == 'register') {
			$user = $this->user_model->get_user_by_email($this->session->userdata('surel'));
			if ($user['verify'] === $this->input->post('verify')) {
				$this->user_model->update_status_user(1, $this->session->userdata('user'));
				redirect('auth','refresh');	
			} else {
				$this->load->view('utama/verify', $data);
			}
		} else if ($this->uri->segment(3) == 'forget') {
			$user = $this->user_model->get_user_by_email($this->session->userdata('surel'));
			if ($user['verify'] === $this->input->post('verify')) {

				$passCode = random_password();
				$config['protocol'] = 'smtp';
				$config['smtp_host'] = 'smtp.gmail.com';
				$config['smtp_user'] = 'suryakesuma63@gmail.com';
				$config['smtp_pass'] = 'dhawaqadrvvjptik';
				$config['smtp_port'] = 465;
				$config['smtp_crypto'] = 'ssl'; 
				$config['charset'] = 'utf-8';
				$config['mailtype'] = 'html';
				$config['newline'] = "\r\n";

				$this->email->initialize($config);

				$this->email->from('Padros');
				$this->email->to($this->session->userdata('surel'));
				$this->email->subject('Kata Sandi Sementara');
				$this->email->message('Kata sandi anda: ' . $passCode . '<br>Gunakan untuk masuk ke aplikasi padros dan segera ganti kata sandi');

				if (!$this->email->send()) {
					return false;
				}

				$this->user_model->update_password_user(password_hash($passCode, PASSWORD_DEFAULT), $this->session->userdata('user'));
				redirect('auth','refresh');
			} else {
				$this->load->view('utama/verify', $data);
			}
		} else if ($this->uri->segment(3) == 'email-verify') {
			if ($this->verify_send()) {
				$user = $this->user_model->get_user_by_email($this->session->userdata('email'));
				if ($user['verify'] === $this->input->post('verify')) {
					$this->user_model->update_profile_user(['email' => $this->session->userdata('surel')], $this->session->userdata('user'));
					$this->session->set_userdata(['email' => $this->session->userdata('surel')]);
					$this->session->unset_userdata('surel');
					redirect('auth','refresh');	
				} else {
					$this->user_model->update_code_verify_user($this->verify_code, $this->session->userdata('user'));
				}
			}
		}
	}

	public function forget() {
		if (is_login()) {
			if (is_admin()) {
				redirect('dashboard','refresh');
			} else {
				redirect('/','refresh');
			}
		}
		
		$data['title'] = 'Lupa Sandi | Padros Studio';
		$data['style'] = [
			'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css',
			base_url('public/utama/css/styles.css'),
		];
		$data['script'] = [
			'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js',
			base_url('public/utama/js/forget.js'),
		];

		$this->load->view('utama/forget', $data);

		if (!empty($this->input->post('email'))){
			$user = htmlspecialchars($this->input->post('email'));
			$user = $this->user_model->get_user_by_email($user);
			if (!empty($user)) {
				$this->session->set_userdata([
					'surel' => htmlspecialchars($this->input->post('email')),
					'user' => $user['uuid']
				]);

				if ($this->verify_send()) {
					if ($this->user_model->update_code_verify_user($this->verify_code, $this->session->userdata('user'))) {
						redirect('auth/verify/forget','refresh');
					}
				}
			}
		}
	}

	public function link_verify() {
		$url = urldecode(current_url());
		$url = explode('/', $url);
		$url = [end($url), prev($url)];

		if ($this->session->userdata('surel') && is_login() && is_admin()){
			$user = $this->user_model->get_user_by_uuid($this->session->userdata('user'));

			if (empty($user)) {
				redirect('/','refresh');
				die;
			}

			if ($this->session->userdata('surel') == end($url) && $user['verify'] == prev($url)) {
				$this->user_model->update_profile_user(['email' => $this->session->userdata('surel')], $this->session->userdata('user'));
				$this->session->set_userdata(['email' => $this->session->userdata('surel')]);
				$this->session->unset_userdata('surel');
			}

			redirect('setting','refresh');
		} else if (valid_email(end($url)) && is_numeric(prev($url))) {
			$user = $this->user_model->get_user_by_email(end($url));

			if (empty($user)) {
				redirect('/','refresh');
				die;
			}

			if ($user['verify'] === prev($url)){
				$this->user_model->update_status_user(1, $user['uuid']);
				redirect('auth','refresh');
			}
		} else {
			redirect('/','refresh');
			die;
		}
	}

	public function singout(){
		session_destroy();
		redirect('/','refresh');
	}

	private function login() {
		$user = $this->user_model->get_user_by_email($this->input->post('email'));

		if (!empty($user)) {
			if ($user['status'] == 1) {
				if (password_verify($this->input->post('password'), $user['password'])) {
					$this->session->set_userdata([
						'user' => $user['uuid'],
						'name' => $user['name'],
						'image' => $user['image'],
						'email' => $user['email'],
						'phone' => $user['phone'],
						'role' => $user['role']
					]);

					if ($this->session->userdata('role') == 1){
						redirect('dashboard','refresh');
					} else if ($this->session->userdata('role') == 2){
						redirect('dashboard','refresh');
					} else {
						redirect('/','refresh');
					}
				} else {
					return false;
				}
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	private function registrastion(){
		$uuid = random_uuid();

		if (!$this->user_model->get_user_by_uuid($uuid) == null) {
			return false;
		}

		$this->session->set_userdata([
			'surel' => htmlspecialchars($this->input->post('email')),
			'user' => $uuid
		]);

		if (!$this->verify_send()) {
			session_destroy();
			return false;
		}

		$data = [
			'uuid' => $uuid,
			'name' => htmlspecialchars($this->input->post('name')),
			'image' => 'avatar1.jpg',
			'email' => htmlspecialchars($this->input->post('email')),
			'phone' => htmlspecialchars($this->input->post('phone')),
			'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
			'verify' => $this->verify_code,
			'balance' => 0,
			'role' => 3,
			'status' => 0,
			'date_created' => date('Y-m-d H:i:s'),
		];

		if (!$this->user_model->save_user($data)) {
			return false;
		}
		return true;
	}

	private function verify_send(){
		$verifyCode = verify_code();
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'smtp.gmail.com';
		$config['smtp_user'] = 'suryakesuma63@gmail.com';
		$config['smtp_pass'] = 'dhawaqadrvvjptik';
		// $config['smtp_port'] = 465;
		// $config['smtp_crypto'] = 'ssl';
		$config['smtp_port'] = 587;
		$config['smtp_crypto'] = 'tls';
		$config['charset'] = 'utf-8';
		$config['mailtype'] = 'html';
		$config['newline'] = "\r\n";

		$this->email->initialize($config);

		$this->email->from('Padros');
		$this->email->to($this->session->userdata('surel'));
		$this->email->subject('Verify Code ' . $verifyCode);
		$this->email->message('Gunakan kode verifikasi diatas untuk Verifikasi akun anda');

		if (!$this->email->send()) {

			echo 'gagal';
			print_r($this->email->print_debugger());
			// return false;
		} else {
			echo 'berhasil';
			print_r($this->email->print_debugger());
		}

		die;
		// $this->verify_code = $verifyCode;
		// return true;
	}

}

/* End of file Auth.php */
/* Location: ./application/controllers/Auth.php */