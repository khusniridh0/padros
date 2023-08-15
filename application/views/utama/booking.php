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
		<!-- Page content-->
		<div id="root-content">
			<section class="py-5">
				<div class="container px-5">
					<!-- Contact form-->
					<div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-5">
						<?php echo $this->session->flashdata('warning'); ?>
						<div class="row mb-5">
							<div class="col-12">
								<h3 class="fw-normal mb-4 mt-5">Transfer Bank</h3>
								<h6 class="fs-5 fw-light">PT. BERKAH ABADI BERSAMA PRO:</h6>
								<div class="hstack gap-4 align-items-center">
									<div class="">
										<small class="fw-light">Bank:</small>
										<p class="line">BCA</p>
									</div>
									<div class="vr" style="height: 50px;"></div>
									<div class="">
										<small class="fw-light">Account number:</small>
										<p class="line">7402141444</p>
									</div>
								</div>							
							</div>
						</div>

						<form action="<?php echo base_url('booking/service/order/' . $this->uri->segment(3)) ?>" method='post' class="row" id="bookingForm" enctype="multipart/form-data">
							<div class="col-lg-6 mb-5">
								<div class="form-floating mb-3" id="name-feedback">
									<input class="form-control" id="name" name="name" type="text" value="<?php echo $this->session->userdata('name'); ?>" placeholder="Nama lengkap" data-sb-validations="required|email" />
									<label for="name">Nama lengkap</label>
									<div class="invalid-feedback text-danger opacity-75"></div>
								</div>

								<div class="form-floating mb-3" id="date-of-entry-feedback">
									<input class="form-control" id="date-of-entry" name="date-of-entry" type="text" value="<?php echo date_now() ?>" placeholder="Tanggal Masuk" data-sb-validations="required" />
									<label for="date-of-entry">Tanggal masuk ( hari ini: <?php echo date_now() ?> )</label>
									<div class="invalid-feedback text-danger opacity-75"></div>
								</div>

								<div class="form-floating mb-3" id="clock-in-feedback">
									<input class="form-control timepicker" id="clock-in" name="clock-in" type="time" value="<?php echo date('H:i'); ?>" placeholder="Jam Masuk" data-sb-validations="required" />
									<label for="clock-in">Jam Masuk</label>
									<div class="invalid-feedback text-danger opacity-75"></div>
								</div>

								<div class="form-floating mb-3" id="clock-out-feedback">
									<input class="form-control timepicker" id="clock-out" name="clock-out" type="time" value="<?php echo date('H:i'); ?>" placeholder="Jam keluar" data-sb-validations="required" />
									<label for="clock-out">Jam keluar</label>
									<div class="invalid-feedback text-danger opacity-75"></div>
								</div>

								<div class="mb-3 d-none" id="payment">
									<label for="proof-of-payment" class="form-control py-lg-3" role="button" id="file-label">Unggah bukti bayar</label>
									<input class="d-none" type="file" id="proof-of-payment" name="proof-of-payment" accept="image/jpg, image/jpeg, image/png">
								</div>

								<input type="hidden" name="payment-method" id="select-payment-method">
								<input type="hidden" name="payment-amount" value="<?php echo number_format($price * ceil((strtotime(date('H:i', strtotime('+2 hour'))) - strtotime(date('H:i', strtotime('+1 hour')))) / 3600)) ?>" id="payment-amount">
								<input type="hidden" name="service" value="<?php echo $service ?>">

								<div class="d-grid">
									<button class="btn btn-primary btn-lg disabled" id="submitButton" type="submit">Pesan Sekarang</button>
								</div>	
							</div>
							<div class="col-lg-6">

								<table class="table">
									<tbody>
										<tr class="border-none">
											<td class="py-lg-3 px-lg-3 border-0 fw-light table-active">Product</td>
											<td class="py-3 fw-light border-0 table-active">Total</td>
										</tr>
										<tr class="border-none">
											<td class="py-lg-3 px-lg-3 border-0 fw-light text-primary">
												<?php if ($service == 1): ?>
													Sewa Studio x1
												<?php endif ?>
												<?php if ($service == 2): ?>
													Promo
												<?php endif ?>
												<?php if ($service == 3): ?>
													Sewa Rekaman Studio x1
												<?php endif ?>
										</td>
											<td class="py-lg-3 px-lg-3 border-0 fw-bold" id="price">Rp. <?php echo number_format($price);?></td>
										</tr>
										<tr class="border-none">
											<td class="py-lg-3 px-lg-3 border-0 fw-light table-active">Subtotal:</td>
											<td class="py-lg-3 px-lg-3 border-0 fw-bold">Rp. <?php echo number_format($price)?></td>
										</tr>
										<tr class="border-none">
											<td class="py-lg-3 px-lg-3 border-0 fw-light table-active">Total:</td>
											<td class="py-lg-3 px-lg-3 border-0 fw-bold" id="amount">Rp. <?php echo number_format($price * ceil((strtotime(date('H:i', strtotime('+2 hour'))) - strtotime(date('H:i', strtotime('+1 hour')))) / 3600)) ?></td>
										</tr>
										<tr class="border-none">
											<td class="py-lg-3 px-lg-3 border-0 fw-light table-active">Payment method:</td>
											<td class="py-lg-3 px-lg-3 border-0 fw-light hstack">
												<span id="payment-method" style="width: 100px">Bank Transfer</span>
												<button class="btn shadow-sm ms-auto" type="button" data-bs-toggle="dropdown" aria-expanded="false">
													<i class="bi bi-three-dots-vertical"></i>
												</button>
												<ul class="dropdown-menu">
													<li><button class="btn dropdown-item active method-choice" type="button">Transfer Bank</button></li>
													<li><button class="btn dropdown-item method-choice" type="button">Deposit</button></li>
												</ul>
											</td>
										</tr>
										</tbody>
								</table>
								<p class="fs-6 fw-light">Lakukan pembayaran langsung ke rekening bank resmi kami. Pesanan Anda tidak dapat kami proses sampai Anda melakukan pembayaran.</p>
							</div>
						</form>
					</div>
				</div>
			</div>
		</section>
	</div>

	<div class="modal fade <?php echo $this->session->flashdata('danger'); ?>" id="alertmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header border-0">
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>

				<div class="modal-body d-flex justify-content-center flex-column align-items-center pb-5">
					<h1>Saldo Kurang</h1>
					<div class="bg-info bg-gradient bg-opacity-25 w-50 rounded-pill">
						<img src="<?php echo base_url('public/utama/assets/static/wallet.png') ?>" alt="error" class="img-fluid">
					</div>
					<p class="lead mt-4">Lakukan Deposit di halaman pengaturan profile</p>
					<a href="<?php echo base_url('booking/service/profile') ?>" class="btn btn-primary">Lakukan sekarang</a>











					<!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
				</div>
			</div>
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
<!-- Modal -->
	

<?php foreach ($script as $js): ?>
	<script src="<?php echo $js ?>"></script>
<?php endforeach ?>
</body>
</html>