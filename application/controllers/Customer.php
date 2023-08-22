 <?php 
 defined('BASEPATH') OR exit('No direct script access allowed');

 class Customer extends CI_Controller {

 	public function __construct(){
 		parent::__construct();
 		if (!is_login() || !is_admin()) {
 			redirect('auth','refresh');
 			die;
 		}

 		$this->load->model('user_model');
 	}

 	public function index() {
 		$data['title'] = 'Pelanggan';
 		$data['css'] = [
 			base_url('public/owner/assets/css/customer.css')
 		];
 		$data['js'] = [
 			base_url('public/owner/assets/js/customer.js')
 		];
 		$data['customer'] = $this->user_model->get_user_all();

 		$this->load->view('owner/top', $data);
 		$this->load->view('owner/aside');
 		$this->load->view('owner/customer');
 		$this->load->view('owner/footer');
 	}

 	public function validated() {
 		if ($this->uri->segment(3) == 'add') {
 			$this->form_validation->set_rules('name', 'Nama lengkap', 'trim|required|min_length[3]|max_length[125]', [
 				'required' => '{field} wajib diisi'
 			]);
 			$this->form_validation->set_rules('email', 'Alamat email', 'trim|required|valid_email|is_unique[users.email]', [
 				'required' => '{field} wajib diisi',
 				'valid_email' => '{field} tidak valid',
 				'is_unique' => '{field} telah terdaftar'
 			]);
 			$this->form_validation->set_rules('phone', 'Nomor HP', 'trim|required|numeric', [
 				'required' => '{field} wajib diisi',
 				'numeric' => '{field} tidak valid'
 			]);

 			if (!$this->form_validation->run()) {
 				$this->form_validation->set_error_delimiters('<div class="invalid-feedback text-danger opacity-75" style="display: block;">', '</div>');
 			} else {
 				$this->add();
 			}
 			redirect('customer','refresh');
 		} else if ($this->uri->segment(3) == 'block') {
 			$this->user_model->update_status_user(2, $this->uri->segment(4));
 			redirect('customer','refresh');
 			die;
 		} else if ($this->uri->segment(3) == 'unblock') {
 			$this->user_model->update_status_user(1, $this->uri->segment(4));
 			redirect('customer','refresh');
 			die;
 		} else if ($this->uri->segment(3) == 'delete') {
      if (!$this->user_model->remove_user_by_uuid($this->uri->segment(4))) {
        flashmessage('danger', 'Terjadi kesalahan sistem saat menghapus data pelanggan');
      } else {
        flashmessage('success', 'Berhasil menghapus data pelanggan');
      }
      redirect('customer','refresh');
 			die;
 		}

 		$data['title'] = 'Pelanggan';
 		$data['css'] = [
 			base_url('public/owner/assets/css/customer.css')
 		];
 		$data['js'] = [
 			base_url('public/owner/assets/js/customer.js')
 		];
 		$data['customer'] = $this->user_model->get_user_all();
 		$this->load->view('owner/top', $data);
 		$this->load->view('owner/aside');
 		$this->load->view('owner/customer');
 		$this->load->view('owner/footer');
 	}

 	public function detile() {
 		$data['title'] = 'Detile Pelanggan';
 		$data['css'] = [
 			base_url('public/owner/assets/css/customer.css')
 		];
 		$data['js'] = [
 			base_url('public/owner/assets/js/customer.js')
 		];
 		$data['user'] = $this->user_model->get_user_by_uuid($this->uri->segment(3));
 		$this->load->view('owner/top', $data);
 		$this->load->view('owner/aside');
 		$this->load->view('owner/costumer_detile');
 		$this->load->view('owner/footer');
 	}

 	private function add() {
 		while (true) {
 			$uuid = random_uuid();
 			if ($this->user_model->get_user_by_uuid($uuid) == null) {
 				break;
 			}
 		}

 		$verify_code = verify_code();
 		$password = random_password();

 		$data = [
 			'uuid' => $uuid,
 			'name' => htmlspecialchars($this->input->post('name')),
 			'image' => 'avatar1.jpg',
 			'email' => htmlspecialchars($this->input->post('email')),
 			'phone' => htmlspecialchars($this->input->post('phone')),
 			'password' => password_hash($password, PASSWORD_DEFAULT),
 			'verify' => $verify_code,
 			'balance' => 0,
 			'role' => 3,
 			'status' => 0,
 			'date_created' => date('Y-m-d H:i:s'),
 		];

 		$email = htmlspecialchars($this->input->post('email'));
 		$message = 'Email Anda didaftarkan ke Padros Studio<br>Gunakan link berikut untuk berifikasi ' . base_url('auth/link_verify/' . urlencode($this->input->post('email')) . '/' . urlencode($verify_code)) . '<br>Sandi sementara: ' . $password . '<br>Jika ini bukan kehendak anda abaikan pesan ini';
 		$subject = 'Verifikasi Akun';

 		if (email_send($email, $message, $subject)){
 			if (!$this->user_model->save_user($data)) {
 				flashmessage('warning', 'Akun tidak berhasil dibuat. Harap coba lagi atau hubungi webmaster anda');
 			} else {
 				flashmessage('success', 'Akun telah berhasil dibuat. Menunggu konfirmasi email');
 			}
 		}
 		redirect('customer','refresh');
 	}

 }

 /* End of file Customer.php */
/* Location: ./application/controllers/Home.php */