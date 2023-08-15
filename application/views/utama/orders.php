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
			<section class="py-5">
				<div class="container px-5">
					<!-- Contact form-->
					<div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-5">
						<div class="row mb-5">
							<div class="col-12">
								<h6 class="fw-normal mb-4">Thank you. Your order has been received.</h6>
								<div class="hstack gap-4 align-items-center">
									<div class="">
										<small class="fw-light">Invoice:</small>
										<p class="line text-uppercase"><?php echo $order['order_uuid'] ?></p>
									</div>
									<div class="vr" style="height: 50px;"></div>
									<div class="">
										<small class="fw-light">Date:</small>
										<p class="line"><?php echo date('d/m/Y', strtotime($order['order_date'])) ?></p>
									</div>
									<div class="vr" style="height: 50px;"></div>
									<div class="">
										<small class="fw-light">Payment method:</small>
										<p class="line"><?php echo $order['payment_method'] ?></p>
									</div>
								</div>							
							</div>
						</div>

						<div class="row">
							<div class="col-lg-6">
								<h2 class="fw-normal mb-4">Detail Order</h2>
								<table class="table">
									<tbody>
										<tr class="border-none">
											<td class="py-lg-3 px-lg-3 border-0 fw-normal table-active">Nama pemesan:</td>
											<td class="py-3 fw-normal border-0 table-active"><?php echo $order['order_name'] ?></td>
										</tr>
										<tr class="border-none">
											<td class="py-lg-3 px-lg-3 border-0 fw-normal">Tanggal pesana:</td>
											<td class="py-lg-3 px-lg-3 border-0 fw-bold"><?php echo date('d/m/Y', strtotime($order['order_date'])) ?></td>
										</tr>
										<tr class="border-none">
											<td class="py-lg-3 px-lg-3 border-0 fw-normal table-active">Jam masuk:</td>
											<td class="py-lg-3 px-lg-3 border-0 fw-bold"><?php echo explode(':', $order['start_time'])[0] . ':' .explode(':', $order['start_time'])[1] ?></td>
										</tr>
										<tr class="border-none">
											<td class="py-lg-3 px-lg-3 border-0 fw-normal table-active">Jam keluar</td>
											<td class="py-lg-3 px-lg-3 border-0 fw-bold"><?php echo explode(':', $order['end_time'])[0] . ':' .explode(':', $order['end_time'])[1] ?></td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="col-lg-6">
								<h2 class="fw-normal mb-4">Detail Transfer</h2>
								<h6 class="fs-5 fw-normal">PT. BERKAH ABADI BERSAMA PRO:</h6>
								<div class="hstack gap-4 align-items-center">
									<div class="">
										<small class="fw-normal">Bank:</small>
										<p class="line">BCA</p>
									</div>
									<div class="vr" style="height: 50px;"></div>
									<div class="">
										<small class="fw-normal">Account number:</small>
										<p class="line">7402141444</p>
									</div>
								</div>

								<h2 class="fw-normal mb-4">Status Pesanan</h2>
								<?php if ($order['status'] == 0): ?>
									<div class="alert alert-primary">Pesanan sedang di proses</div>
								<?php endif ?>

								<?php if ($order['status'] == 1): ?>
									<div class="alert alert-success">Pesanan di teriman</div>
								<?php endif ?>

								<?php if ($order['status'] == 2): ?>
									<div class="alert alert-danger">Pesanan di tolak</div>
								<?php endif ?>
							</div>

							<div class="col-12 mt-4">
								<table class="table">
									<tbody>
										<tr class="border-none">
											<td class="py-lg-3 w-50 px-lg-3 border-0 fw-normal table-active">Product</td>
											<td class="py-3 fw-normal border-0 table-active">Total</td>
										</tr>
										<tr class="border-none">
											<td class="py-lg-3 w-50 px-lg-3 border-0 fw-normal text-primary">
												<?php if ($order['service'] == 1): ?>
													Sewa studio x1
												<?php endif ?>

												<?php if ($order['service'] == 2): ?>
													Promo x1
												<?php endif ?>

												<?php if ($order['service'] == 3): ?>
													Sewa Rekaman Studio x1
												<?php endif ?>
											</td>
											<td class="py-lg-3 px-lg-3 border-0 fw-bold">
												<?php if ($order['service'] == 1): ?>
													Rp. 50,000
												<?php endif ?>

												<?php if ($order['service'] == 2): ?>
													Rp. 60,000
												<?php endif ?>

												<?php if ($order['service'] == 3): ?>
													Rp. 70,000
												<?php endif ?>
											</td>
										</tr>
										<tr class="border-none">
											<td class="py-lg-3 w-50 px-lg-3 border-0 fw-normal table-active">Subtotal:</td>
											<td class="py-lg-3 px-lg-3 border-0 fw-bold">
												<?php if ($order['service'] == 1): ?>
													Rp. 50,000
												<?php endif ?>

												<?php if ($order['service'] == 2): ?>
													Rp. 60,000
												<?php endif ?>

												<?php if ($order['service'] == 3): ?>
													Rp. 70,000
												<?php endif ?>
											</td>
										</tr>
										<tr class="border-none">
											<td class="py-lg-3 w-50 px-lg-3 border-0 fw-normal table-active">Total:</td>
											<td class="py-lg-3 px-lg-3 border-0 fw-bold">Rp. <?php echo number_format($order['payment_amount']) ?></td>
										</tr>
										</tbody>
									</table>
								</div>
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