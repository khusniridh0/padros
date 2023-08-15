<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {
	private $verify_code;

	public function __construct(){
		parent::__construct();
		if (!is_login() || !is_admin() || !is_owner()) {
			redirect('auth','refresh');
			die;
		}

		$this->load->model('user_model');
		$this->load->model('employee_model');
	}

	public function index() {
		$data['title'] = 'Karyawan';
		$data['employee'] = $this->employee_model->get_employee_all();
		$this->load->view('owner/top', $data);
		$this->load->view('owner/aside');
		$this->load->view('owner/employee');
		$this->load->view('owner/footer');
	}

	public function validated() {
		if (!is_owner()) {
			redirect('auth','refresh');
		}

		if ($this->uri->segment(3) == 'add') {
			$this->form_validation->set_rules('name', 'Nama lengkap', 'trim|required', [
				'required' => '{field} wajib diisi',
			]);

			$this->form_validation->set_rules('email', 'Alamat email', 'trim|required|valid_email|is_unique[users.email]', [
				'required' => '{field} wajib diisi',
				'valid_email' => '{field} tidak valid',
				'is_unique' => 'Email sudah terdaftar gunakan email lain'
			]);

			$this->form_validation->set_rules('phone', 'Nomor HP', 'trim|required|numeric', [
				'required' => '{field} wajib diisi',
				'numeric' => '{field} hanya boleh angka'
			]);

			$this->form_validation->set_rules('task', 'Tugas', 'trim|required', [
				'required' => '{field} wajib diisi'
			]);

			$this->form_validation->set_rules('evaluation', 'Penilaian', 'trim|required', [
				'required' => '{field} wajib diisi'
			]);

			$this->form_validation->set_rules('gender', 'Jenis kelamin', 'trim|required', [
				'required' => '{field} wajib diisi'
			]);

			$this->form_validation->set_rules('city', 'Kota', 'trim|required', [
				'required' => '{field} wajib diisi'
			]);

			$this->form_validation->set_rules('address', 'Alamat lengkap', 'trim|required', [
				'required' => '{field} wajib diisi'
			]);

			if (!$this->form_validation->run()) {
				$this->form_validation->set_error_delimiters('<div class="invalid-feedback text-danger opacity-75" style="display: block;">', '</div>');
			} else {
				$this->register_employee();
				redirect('employee','refresh');
			}
		} else if ($this->uri->segment(3) == 'update') {
			$this->form_validation->set_rules('name', 'Nama lengkap', 'trim|required', [
				'required' => '{field} wajib diisi',
			]);

			$this->form_validation->set_rules('phone', 'Nomor HP', 'trim|required|numeric', [
				'required' => '{field} wajib diisi',
				'numeric' => '{field} hanya boleh angka'
			]);

			$this->form_validation->set_rules('task', 'Tugas', 'trim|required', [
				'required' => '{field} wajib diisi'
			]);

			$this->form_validation->set_rules('evaluation', 'Penilaian', 'trim|required', [
				'required' => '{field} wajib diisi'
			]);

			$this->form_validation->set_rules('address', 'Alamat lengkap', 'trim|required', [
				'required' => '{field} wajib diisi'
			]);

			$this->form_validation->set_rules('city', 'Kota', 'trim|required', [
				'required' => '{field} wajib diisi'
			]);

			if (!$this->form_validation->run()) {
				flashmessage('warning', 'Data pembaruan tidak valid');
			} else {
				$this->employee_update();
				redirect('employee','refresh');
			}
		} else if ($this->uri->segment(3) == 'block') {
			$this->user_model->update_status_user(2, $this->uri->segment(4));
			redirect('employee','refresh');
		} else if ($this->uri->segment(3) == 'unblock') {
			$this->user_model->update_status_user(1, $this->uri->segment(4));
			redirect('employee','refresh');
		} else if ($this->uri->segment(3) == 'remove') {
			$user = $this->user_model->get_user_by_uuid($this->uri->segment(4));
			$employee = $this->employee_model->get_employee_by_uuid($this->uri->segment(4));

			if (empty($user) || empty($employee)) {
				flashmessage('warning', 'Karyawan tidak ditemukan');
				redirect('employee','refresh');
				die;
			}
			$this->remove_employee();
			redirect('employee','refresh');
		} else {
			redirect('employee','refresh');
		}

		$data['title'] = 'Karyawan';
		$data['employee'] = $this->employee_model->get_employee_all();
		$this->load->view('owner/top', $data);
		$this->load->view('owner/aside');
		$this->load->view('owner/employee');
		$this->load->view('owner/footer');	
	}

	public function detile() {
		if (!is_owner()) {
			redirect('auth','refresh');
		}
		$data['title'] = 'Karyawan Detile';
		$data['employee'] = array_merge(
			$this->user_model->get_user_by_uuid($this->uri->segment(3)),
			$this->employee_model->get_employee_by_uuid($this->uri->segment(3))
		);
		$data['js'] = [base_url('public/owner/assets/js/employee.js')];

		$this->load->view('owner/top', $data);
		$this->load->view('owner/aside');
		$this->load->view('owner/employee_detile');
		$this->load->view('owner/footer');	
	}

	private function register_employee() {
		$this->verify_code = verify_code();
		$password = random_password();
		$addition = [
			'email' => htmlspecialchars($this->input->post('email')),
			'subject' => 'Verifikasi Akun',
			'uuid' => random_uuid(),
			'password' => $password,
			'verify_code' => $this->verify_code,
			'message' => 'Email Anda didaftarkan ke Padros Studio<br>Gunakan link berikut untuk berifikasi ' . base_url('auth/link_verify/' . urlencode($this->input->post('email')) . '/' . urlencode($this->verify_code)) . '<br>Sandi sementara: ' . $password . '<br>Jika ini bukan kehendak anda abaikan pesan ini',

		];

		if (!email_send($addition['email'], $addition['message'], $addition['subject'])) {
			flashmessage('warning', 'Terjadi kesalahan sistem saat membuat karyawan baru');
		} else {
			$user = [
				'uuid' => $addition['uuid'],
				'name' => htmlspecialchars($this->input->post('name')),
				'image' => 'avatar1.jpg',
				'email' => htmlspecialchars($this->input->post('email')),
				'phone' => htmlspecialchars($this->input->post('phone')),
				'address' => htmlspecialchars($this->input->post('address')),
				'password' => password_hash($addition['password'], PASSWORD_DEFAULT),
				'verify' => $addition['verify_code'],
				'balance' => 0,
				'role' => 2,
				'status' => 0,
				'date_created' => date('Y-m-d H:i:s')
			];

			$employee = [
				'uuid' => $addition['uuid'],
				'gender' => htmlspecialchars($this->input->post('gender')),
				'company' => 'Padros Studio',
				'task' => htmlspecialchars($this->input->post('task')),
				'city' => htmlspecialchars($this->input->post('city')),
				'evaluation' => htmlspecialchars($this->input->post('evaluation')),
				'position' => 'Karyawan',
				'date_created' => date('Y-m-d H:i:s')
			];

			if (!$this->user_model->save_user($user)) {
				flashmessage('warning', 'Terjadi kesalahan sistem saat membuat karyawan baru');
				return false;
			}

			if (!$this->employee_model->save_employee($employee)) {
				flashmessage('warning', 'Terjadi kesalahan sistem saat membuat karyawan baru');
				return false;
			}
			flashmessage('success', 'Karyawan baru berhasil ditambahkan');
			return true;
		}
	}

	private function employee_update() {
		$user = [
			'name' => $this->input->post('name'),
			'phone' => $this->input->post('phone'),
			'address' => $this->input->post('address')
		];

		$employee = [
			'task' => $this->input->post('task'),
			'city' => $this->input->post('city'),
			'evaluation' => $this->input->post('evaluation')
		];

		$this->user_model->update_profile_user($user, $this->uri->segment(4));
		$this->employee_model->update_employee_by_uuid($employee, $this->uri->segment(4));
		flashmessage('success', 'Berhasil memperbaharui data karyawan');
		return true;
	}

	private function remove_employee() {
		if ($this->employee_model->remove_employee_by_uuid($this->uri->segment(4))) {
			flashmessage('success', 'Karyawan berhasil di hapus');
		} else {
			flashmessage('danger', 'Terjadi kesalahan sistem saat menghapus karyawan');
		}
	}
}

/* End of file Employee.php */
/* Location: ./application/controllers/Home.php */