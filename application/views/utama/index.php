<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $title ?></title>
	<link rel="icon" type="image/x-icon" href="<?php echo base_url('public/utama/assets/static/favicon.png') ?>" />
	<?php foreach ($style as $css): ?>
		<link rel="stylesheet" href="<?php echo $css ?>" />
	<?php endforeach ?>
</head>
<body>
	<main class="flex-shrink-0">
		<!-- Navigation-->
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="scroll-spy">
			<div class="container-lg px-5">
				<a class="navbar-brand" href="<?php echo base_url() ?>">
					<img src="<?php echo base_url('public/utama/assets/static/padros.png') ?>" alt="Padros" width="40" height="40" class="d-inline-block" />
					Padros Studio
				</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<div class="navbar-nav ms-auto mb-2 mb-lg-0">
						<a href="<?php echo base_url('#home') ?>" class="nav-link text-md-center m-lg-2 m-md-3">Home</a>
						<a href="<?php echo base_url('#about') ?>" class="nav-link text-md-center m-lg-2 m-md-3" href="#">About</a>
						<a href="<?php echo base_url('#service') ?>" class="nav-link text-md-center m-lg-2 m-md-3" href="#">Pricing</a>
						<a href="<?php echo base_url('#contact') ?>" class="nav-link text-md-center m-lg-2 m-md-3" href="#">Contact</a>
						<?php if ($this->session->userdata('name')): ?>
							<div class="nav-link dropdown">
								<button class="btn btn-sm fs-6 text-white text-md-center dropdown-toggle" id="navbarDropdownBlog" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
									<?php echo $this->session->userdata('name') ?>
									<img src="<?php echo base_url('public/utama/assets/dinamis/profil/' . $this->session->userdata('image')) ?>" alt="Padros" width="35" height="35" class="d-inline-block rounded-circle ms-3" />
								</button>
								<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownBlog">
									<?php if (is_admin()): ?>
										<li><a class="dropdown-item" href="<?php echo base_url('dashboard') ?>">Dasboard</a></li>
									<?php else: ?>
										<li><a class="dropdown-item" href="<?php echo base_url('booked') ?>">Pesanan</a></li>
										<li><a class="dropdown-item" href="<?php echo base_url('profile') ?>">Pengaturan</a></li>
									<?php endif ?>
									<li><a class="dropdown-item" href="<?php echo base_url('auth/singout') ?>">Keluar</a></li>
								</ul>
							</div>
						<?php else: ?>
							<a class="nav-link text-md-center m-lg-2 m-md-3" href="<?php echo base_url('auth') ?>">login</a>
							<a href="<?php echo base_url('auth/register') ?>" class="btn btn-primary px-4 py-md-3 py-lg-2 m-lg-2 m-md-3" type="button">Daftar</a>
						<?php endif ?>
					</div>
				</div>
			</div>
		</nav>
		<!-- Header-->
		<div data-bs-spy="scroll" data-bs-target="#scroll-spy" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" class="bg-body-tertiary" tabindex="0" id="root-content">
			<section class="heading-content py-5" id="home">
				<div class="container px-5">
					<div class="row gx-5 align-items-center justify-content-center">
						<div class="col-lg-8 col-xl-7 col-xxl-6">
							<div class="my-5 text-center text-xl-start">
								<h1 class="display-5 fw-bolder text-white mb-2">Musik Merupakan Bagian dari Gaya hidup</h1>
								<p class="lead fw-normal text-white-50 mb-4">Berdasarkan keinginan hiburan umum, Padros Musik Studio menyediakan fasilitas  alat musik dan tempat untuk menyewanya</p>
								<div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xl-start" id="scroll-spy">
									<a class="btn btn-primary btn-lg px-4 me-sm-3 action" href="<?php echo base_url('#service') ?>">Get Started</a>
									<a class="btn btn-outline-light btn-lg px-4 action" href="<?php echo base_url('#about') ?>">Learn More</a>
								</div>
							</div>
						</div>
						<div class="col-xl-5 col-xxl-6 d-none d-xl-block text-center"><img class="img-fluid rounded-3 my-5" src="<?php echo base_url('public/utama/assets/static/avatar.jpeg') ?>" alt="..." /></div>
					</div>
				</div>
			</section>
			<!-- Features section-->
			<section class="py-5" id="about">
				<div class="container px-5 my-5">
					<div class="row gx-5">
						<div class="col-lg-4 mb-5 mb-lg-0"><h2 class="fw-bolder mb-0">Layanan Profesional Produksi BAB</h2></div>
						<div class="col-lg-8">
							<div class="row gx-5 row-cols-1 row-cols-md-2">
								<div class="col mb-5 h-100">
									<div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-cpu-fill"></i></div>
									<h2 class="h5">Softwere</h2>
									<p class="mb-0">Kami menggunakan Software Audio Original saat melakukan proses rekaman/recording.</p>
								</div>
								<div class="col mb-5 h-100">
									<div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-subtract"></i></div>
									<h2 class="h5">Layanan</h2>
									<p class="mb-0">Kami memlilik banyak layanan untuk Audio dari Rekaman Lagu hingga Mixing dan Mastering.</p>
								</div>
								<div class="col mb-5 mb-md-0 h-100">
									<div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-headset"></i></div>
									<h2 class="h5">Operator</h2>
									<p class="mb-0">Menggunakan Operator yang profesional sehingga menghasilkan tatanan musik yang enak di dengar.</p>
								</div>
								<div class="col h-100">
									<div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-toggles2"></i></div>
									<h2 class="h5">Konsultasi</h2>
									<p class="mb-0">Konsultasi GRATIS langsung dengan operator kami agar menyesuaikan keinginan anda.</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- Testimonial section-->
			<div class="py-5 bg-light" id="quotes">
				<div class="container px-5 my-5">
					<div class="row justify-content-center">
						<div class="col-12">
							<div class="text-center">
								<div class="fs-4 mb-4 fst-italic">Sebelum anda melakukan rekaman/recording lagu atau sewa studio recording musik, mungkin sebuah hal yang menjadi ganjalan di pikiran anda merupakan problem ongkos membayar jasa recording studio. Untuk ongkos/tarif harga untuk sewa jasa rekaman di studio musik sangatlah bermacam-macam, bergantung pada fitur, software dan hardaware yang digunakan buat proses merekam. Semakin canggih alat, fitur, hardware dan sofware yang digunakan maka harganya pun semakin mahal.</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Blog preview section-->
			<section class="py-5" id="service">
				<div class="container px-5 my-5">
					<div class="row gx-5 justify-content-center">
						<div class="col-lg-8 col-xl-6">
							<div class="text-center">
								<h2 class="fw-bolder">Layanan</h2>
								<p class="lead fw-normal text-muted mb-5">Sesuaikan dengan kebutuhan</p>
							</div>
						</div>
					</div>


					<div class="row gx-5 justify-content-center">
						<!-- Pricing card free-->
						<div class="col-lg-6 col-xl-4">
							<div class="card mb-5 mb-xl-0">
								<div class="card-body p-5">
									<div class="small text-uppercase fs-4 text-primary fw-bold text-center">Sewa studio</div>
									<div class="mb-3 text-center">
										<span class="text-muted">Rp</span>
										<span class="display-4 fw-bold">50,000</span>
										<span class="text-muted">/ Jam</span>
									</div>
									<ul class="list-unstyled mb-4">
										<li class="mb-2">
											<i class="bi bi-check text-primary"></i>
											Limited person (5 person)
										</li>
										<li class="mb-2">
											<i class="bi bi-check text-primary"></i>
											1 Microphone
										</li>
										<li class="mb-2">
											<i class="bi bi-check text-primary"></i>
											1 	Guitar Bass
										</li>
										<li class="mb-2">
											<i class="bi bi-check text-primary"></i>
											2 Guitar Electric
										</li>
										<li class="mb-2">
											<i class="bi bi-check text-primary"></i>
											1 Set Drum
										</li>
										<li class="mb-2">
											<i class="bi bi-check text-primary"></i>
											1 Keyboard
										</li>
									</ul>
									<div class="d-grid"><a class="btn btn-outline-primary" href="<?php echo base_url('booking/service/rent') ?>">Choose plan</a></div>
								</div>
							</div>
						</div>
						<!-- Pricing card pro-->
						<div class="col-lg-6 col-xl-4">
							<div class="card mb-5 mb-xl-0">
								<div class="recommend">
									<svg width="102" height="33" viewBox="0 0 102 33" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M0 0H102L90.0541 16.5L102 33H0V0Z" fill="#FFD600"/>
									</svg>
									<span>Best Offer</span>
								</div>
								<div class="card-body p-5">
									<div class="small text-uppercase fs-4 text-primary fw-bold text-center">Promo</div>
									<div class="mb-3 text-center">
										<span class="text-muted">Rp</span>
										<span class="display-4 fw-bold">60,000</span>
										<span class="text-muted">/ Jam</span>
									</div>
									<ul class="list-unstyled mb-4">
										<li class="mb-2">
											<i class="bi bi-check text-primary"></i>
											Minimum Deposit Rp. 500,000,-
										</li>
										<li class="mb-2">
											<i class="bi bi-check text-primary"></i>
											Limited person (7 person)
										</li>
										<li class="mb-2">
											<i class="bi bi-check text-primary"></i>
											3 Microphone
										</li>
										<li class="mb-2">
											<i class="bi bi-check text-primary"></i>
											1 Guitar Bass
										</li>
										<li class="mb-2">
											<i class="bi bi-check text-primary"></i>
											2 Guitar Elektrik
										</li>
										<li class="mb-2">
											<i class="bi bi-check text-primary"></i>
											1 Set Electric Drum
										</li>
										<li class="mb-2">
											<i class="bi bi-check text-primary"></i>
											1 Keyboard
										</li>
									</ul>
									<div class="d-grid"><a class="btn btn-primary" href="<?php echo base_url('booking/service/promo') ?>">Choose plan</a></div>
								</div>
							</div>
						</div>
						<!-- Pricing card enterprise-->
						<div class="col-lg-6 col-xl-4">
							<div class="card mb-5 mb-xl-0">
								<div class="card-body p-5">
									<div class="small text-uppercase fs-4 text-primary fw-bold text-center">sewa studio rekaman</div>
									<div class="mb-3 text-center">
										<span class="text-muted">Rp</span>
										<span class="display-4 fw-bold">70,000</span>
										<span class="text-muted">/ Jam</span>
									</div>
									<ul class="list-unstyled mb-4">
										<li class="mb-2">
											<i class="bi bi-check text-primary"></i>
											Limited person (7 person)
										</li>
										<li class="mb-2">
											<i class="bi bi-check text-primary"></i>
											3 Microphone
										</li>
										<li class="mb-2">
											<i class="bi bi-check text-primary"></i>
											1 Guitar Bass
										</li>
										<li class="mb-2">
											<i class="bi bi-check text-primary"></i>
											2 Guitar Elektrik
										</li>
										<li class="mb-2">
											<i class="bi bi-check text-primary"></i>
											1 Set Electric Drum
										</li>
										<li class="mb-2">
											<i class="bi bi-check text-primary"></i>
											1 Keyboard
										</li>
									</ul>
									<div class="d-grid"><a class="btn btn-outline-primary" href="<?php echo base_url('booking/service/record') ?>">Choose plan</a></div>
								</div>
							</div>
						</div>
					</div>
				</section>

				<section class="contact" id="contact">
					<div class="container">
						<div class="row justify-content-between">
							<div class="col-lg-4">
								<div class="items-contect">
									<h3>Alamat</h3>
									<p>Purworejo, Paduroso Krajan 36 RT.02/01, Krajan, Paduroso, Kec. Purworejo, Kabupaten Purworejo, Jawa Tengah 54112</p>
								</div>
								<div class="items-contect">
									<h3>Sosial</h3>
									<a href="https://www.instagram.com" class="d-flex contact-link">
										<img src="<?php echo base_url('public/utama/assets/static/instagram.svg') ?>" alt="" class="img-fluid rounded-circle">
										Instagram
									</a>
									<a href="https://www.facebook.com" class="d-flex contact-link">
										<img src="<?php echo base_url('public/utama/assets/static/facebook.svg') ?>" alt="" class="img-fluid rounded-circle">
										Facebook
									</a>
									<a href="https://twitter.com" class="d-flex contact-link">
										<img src="<?php echo base_url('public/utama/assets/static/twitter.svg') ?>" alt="" class="img-fluid rounded-circle">
										Twitter
									</a>
									<a href="https://www.pinterest.com" class="d-flex contact-link">
										<img src="<?php echo base_url('public/utama/assets/static/pintres.svg') ?>" alt="" class="img-fluid rounded-circle">
										Pinterest
									</a>
									<a href="https://www.youtube.com" class="d-flex contact-link">
										<img src="<?php echo base_url('public/utama/assets/static/youtube.svg') ?>" alt="" class="img-fluid rounded-circle">
										Youtube
									</a>
								</div>
							</div>
							<div class="col-lg-7">
								<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.8199841492874!2d109.99596677606817!3d-7.7024584262910185!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7aebb2ed2503f7%3A0xce5e3b1ca072c61a!2zIiIiUEFEUk9TIiIiIE11c2ljIFN0dWRpbw!5e0!3m2!1sen!2sid!4v1690485330109!5m2!1sen!2sid"></iframe>
							</div>
						</div>
					</div>
				</section>
			</div>
		</main>
		<!-- Footer-->
		<footer class="bg-dark py-4 mt-auto">
			<div class="container px-5">
				<div class="row align-items-center justify-content-center flex-column flex-sm-row">
					<div class="col-auto"><div class="small text-white">Copyright &copy; Your Website 2023</div></div>
				</div>
			</div>
		</footer>

		<?php foreach ($script as $js): ?>
			<script src="<?php echo $js ?>"></script>
		<?php endforeach ?>
	</body>
	</html>