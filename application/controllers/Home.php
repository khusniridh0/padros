<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index() {
		$data['title'] = 'Home | Padros Studio';
		$data['style'] = [
			'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css',
			base_url('public/utama/css/styles.css'),
			base_url('public/utama/css/home.css')
		];
		$data['script'] = [
			'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js',
		];
		$this->load->view('utama/index', $data);
	}

}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */