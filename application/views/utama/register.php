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
		<!-- Page content-->
		<div id="root-content">
		<?php echo $this->session->flashdata('warning'); ?>
			<section class="py-5">
				<div class="container px-5">
					<div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-5">
						<div class="text-center mb-5">
							<div class="feature text-white rounded-3 mb-3">
								<img src="<?php echo base_url('public/utama/assets/static/padros.png') ?>" alt="Padros" width="100" height="100" class="d-inline-block" />
							</div>
							<h1 class="fw-bolder">Daftar Akun Baru</h1>
							<p class="lead fw-normal text-muted mb-0">Perkenalakan siapa anda</p>
						</div>
						<div class="row gx-5 justify-content-center">
							<div class="col-lg-8 col-xl-6">
								<form action="<?php echo base_url('auth/register') ?>" method="post" id="loginForm">
									<div class="form-floating mb-3" id="name-feedback">
										<input class="form-control" name="name" value="<?php echo set_value('name') ?>" id="name" type="text" placeholder="Nama Lengkap" data-sb-validations="required" />
										<label for="name">Nama Lengkap</label>
										<div class="invalid-feedback text-danger opacity-75"></div>
										<?php echo form_error('name'); ?>
									</div>

									<div class="form-floating mb-3" id="email-feedback">
										<input class="form-control" name="email" value="<?php echo set_value('email') ?>" id="email" type="text" placeholder="name@example.com" data-sb-validations="required|email" />
										<label for="email">Alamat amail</label>
										<div class="invalid-feedback text-danger opacity-75"></div>
										<?php echo form_error('email'); ?>
									</div>

									<div class="form-floating mb-3" id="HP-feedback">
										<input class="form-control" name="phone" value="<?php echo set_value('phone') ?>" id="no-hp" type="text" placeholder="Nomor HP" data-sb-validations="required" />
										<label for="no-hp">Nomor HP</label>
										<div class="invalid-feedback text-danger opacity-75"></div>
										<?php echo form_error('phone'); ?>
									</div>

									<div class="form-floating mb-3" id="password-feedback">
										<input class="form-control" name="password" value="<?php echo set_value('password') ?>" id="password" type="password" placeholder="Masukan kata sandi"/>
										<label for="password">Kata sandi</label>
										<div class="invalid-feedback text-danger opacity-75"></div>
										<?php echo form_error('password'); ?>
									</div>

									<div class="form-floating mb-3" id="konfirm-password-feedback">
										<input class="form-control" name="konfirm" value="<?php echo set_value('konfirm') ?>" id="konfirm-password" type="password" placeholder="Konfirmasi kata sandi"/>
										<label for="konfirm-password">Konfirmasi kata sandi</label>
										<div class="invalid-feedback text-danger opacity-75"></div>
										<?php echo form_error('konfirm'); ?>
									</div>

									<div class="d-flex align-items-center justify-content-between my-4 px-3">
										<a href="<?php echo base_url('auth/forget') ?>" class="text-decoration-none">
											Lupa kata sandi
										</a>
										<span>
											Sudah punya akun.
											<a href="<?php echo base_url('auth') ?>" class="text-decoration-none">
												Login sekarang
											</a>
										</span>
									</div>

									<div class="d-grid">
										<button class="btn btn-primary btn-lg" id="submitButton" type="submit">Daftar</button>
									</div>
								</form>
							</div>
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
