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
						<div class="row mb-5">
							<div class="col-12">
								<h3 class="fw-normal mb-5">Pengaturan Profil</h3>
								<div class="d-flex position-relative align-items-center">
									<img src="<?php echo base_url('public/utama/assets/dinamis/profil/' . $user['image']) ?>" class="flex-shrink-0 me-3 rounded-circle" alt="profile" width="150" height="150">
									<div>
										<h5 class="text-muted fw-normal">Deposit</h5>
										<h3 class="mt-0 fw-normal">IDR <?php echo $user['saldo'] == 0 ? ',00' : number_format($user['saldo']) ?></h3>
										<button class="btn bg-success bg-opacity-25 btn-sm text-success fw-semibold" data-bs-toggle="modal" data-bs-target="#TopUp">
											Deposit
											<span class="fs-5 btn-sm px-1 rounded-circle bg-success bg-opacity-25 ms-2">
												<i class="bi bi-arrow-up-short"></i>
											</span>
										</button>
									</div>
								</div>
							</div>
						</div>
						<form action="<?php echo base_url('profile/update') ?>" method="post" class="row" id="profilForm">
							<div class="col-lg-6 mb-5">
								<h5 class="text-primary fw-normal opacity-75 mb-4">Umum</h5>
								
								<div class="form-floating mb-3" id="name-feedback">
									<input class="form-control" name="name" id="name" type="text" value="<?php echo $user['name'] ?>" placeholder="Nama lengkap" data-sb-validations="required|email" />
									<label for="name">Nama lengkap</label>
									<div class="invalid-feedback text-danger opacity-75"></div>
								</div>

								<div class="form-floating mb-3" id="email-feedback">
									<input class="form-control" name="email" id="email" type="text" value="<?php echo $user['email'] ?>" placeholder="Alamat Email" data-sb-validations="required" />
									<label for="email">Alamat email</label>
									<div class="invalid-feedback text-danger opacity-75"></div>
								</div>
								
								<div class="form-floating mb-3" id="no-hp-feedback">
									<input class="form-control" name="no-hp" id="no-hp" type="text" value="<?php echo $user['phone'] ?>" placeholder="Nomor HP" data-sb-validations="required" />
									<label for="no-hp">Nomor HP</label>
									<div class="invalid-feedback text-danger opacity-75"></div>
								</div>
								
								<div class="form-floating mb-3" id="address-feedback">
									<input class="form-control" name="address" id="address" type="text" value="<?php echo $user['address'] ?>" placeholder="Alamat lengkap" data-sb-validations="required" />
									<label for="address">Alamat lengkap</label>
									<div class="invalid-feedback text-danger opacity-75"></div>
								</div>

								<div class="form-check my-4">
									<input class="form-check-input" name="security" type="checkbox" value="" id="security">
									<label class="form-check-label fw-light" for="security">
										Ubah Keamanan
									</label>
								</div>

								<div class="d-grid">
									<button class="btn btn-primary btn-lg disabled" id="submitButton" type="submit">Simpan perubahan</button>
								</div>	
							</div>
							<div class="col-lg-6">
								<h5 class="text-primary fw-normal opacity-75 mb-4">Keamanan</h5>
								
								<div class="form-floating mb-3" id="now-password-feedback">
									<input class="form-control" name="now-password" id="now-password" type="password" placeholder="Kata sandi saat ini" data-sb-validations="required" disabled readonly/>
									<label for="now-password">Kata sandi saat ini</label>
									<div class="invalid-feedback text-danger opacity-75"></div>
								</div>
								
								<div class="form-floating mb-3" id="new-password-feedback">
									<input class="form-control" name="new-password" id="new-password" type="password" placeholder="Kata sandi baru" data-sb-validations="required" disabled readonly/>
									<label for="new-password">Kata sandi baru</label>
									<div class="invalid-feedback text-danger opacity-75"></div>
								</div>
								
								<div class="form-floating mb-3" id="confirm-new-password-feedback">
									<input class="form-control" name="confirm-new-password" id="confirm-new-password" type="password" placeholder="Konfirmasi kata sandi baru" data-sb-validations="required" disabled readonly/>
									<label for="confirm-new-password">Konfirmasi kata sandi baru</label>
									<div class="invalid-feedback text-danger opacity-75"></div>
								</div>

							</div>
						</form>
					</div>
				</div>
			</section>
		</div>

		<!-- Modal -->
		<div class="modal fade" id="TopUp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<form action="<?php echo base_url('profile/deposit'); ?>" method="post" id="depositUp">
					<div class="modal-content">
						<div class="modal-header border-0">
							<h1 class="modal-title fs-5" id="exampleModalLabel">Deposit</h1>
						</div>
						<div class="modal-body">
							<div class="form-floating mb-3" id="deposit-feedback">
								<input class="form-control" id="deposit" name="deposit" type="text" value="" placeholder="Nama lengkap"/>
								<label for="deposit">Jumalah Deposit</label>
								<div class="invalid-feedback text-danger opacity-75"></div>
							</div>
						</div>
						<div class="modal-footer border-0">
							<button type="reset" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
							<button type="submit" class="btn btn-success">Deposit</button>
						</div>
					</div>
				</form>
			</div>
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