<main id="main" class="main">

  <div class="pagetitle">
    <h1>Profile</h1>
  </div><!-- End Page Title -->

  <section class="section profile">
    <div class="row">
      <div class="col-xl-3">

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

            <img src="<?php echo base_url('public/utama/assets/dinamis/profil/' . $order['image']) ?>" alt="Profile" class="rounded-circle">
            <h2 class="text-capitalize"><?php echo $order['name']; ?></h2>
            <h3>Pelanggan</h3>
            <div class="row w-100 mt-4">
              <h2 class="text-primary fw-normal mb-2">Profile Details</h2>
              <ul class="list-group">
                <li class="list-group-item border-0 mb-2">
                  <small class="d-block text-primary text-opacity-75">Surel</small>
                  <span class="d-block"><?php echo $order['email']; ?></span>
                </li>
                <li class="list-group-item border-0 mb-2">
                  <small class="d-block text-primary text-opacity-75">Nomor Hp</small>
                  <span class="d-block"><?php echo $order['phone']; ?></span>
                </li>
              </ul>
            </div>
          </div>
        </div>

        <?php if ($order['status'] == 0 && $order['payment_method'] == 'Transfer Bank'): ?>
          <a href="<?php echo base_url('order/service/accept/' . $order['order_uuid']) ?>" class="btn btn-primary btn-lg mb-2 w-100">Terima Pesanan</a>
        <?php endif ?>

        <?php if ($order['status'] == 0 && $order['payment_method'] == 'Deposit'): ?>
          <a href="<?php echo base_url('order/service/accept/' . $order['order_uuid']) ?>" class="btn btn-primary btn-lg mb-2 w-100">Terima Pesanan</a>
          <?php if (is_owner()): ?>
          <a href="<?php echo base_url('order/service/denied/' . $order['order_uuid']) ?>" class="btn btn-danger btn-lg mb-2 w-100">Tolak Pesanan</a>
          <?php endif ?>
        <?php endif ?>

      </div>

      <div class="col-xl-9">
        <div class="card">
          <div class="card-body p-5">
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
                      <td class="py-lg-3 px-lg-3 border-0 fw-normal bg-light">Nama pemesan:</td>
                      <td class="py-3 fw-normal border-0 bg-light"><?php echo $order['order_name'] ?></td>
                    </tr>
                    <tr class="border-none">
                      <td class="py-lg-3 px-lg-3 border-0 fw-normal">Tanggal pesana:</td>
                      <td class="py-lg-3 px-lg-3 border-0 fw-bold"><?php echo date('d/m/Y', strtotime($order['order_date'])) ?></td>
                    </tr>
                    <tr class="border-none">
                      <td class="py-lg-3 px-lg-3 border-0 fw-normal bg-light">Jam masuk:</td>
                      <td class="py-lg-3 px-lg-3 border-0 fw-bold"><?php echo explode(':', $order['start_time'])[0] . ':' .explode(':', $order['start_time'])[1] ?></td>
                    </tr>
                    <tr class="border-none">
                      <td class="py-lg-3 px-lg-3 border-0 fw-normal bg-light">Jam keluar</td>
                      <td class="py-lg-3 px-lg-3 border-0 fw-bold"><?php echo explode(':', $order['end_time'])[0] . ':' .explode(':', $order['end_time'])[1] ?></td>
                    </tr>

                    <?php if ($order['payment_method'] == 'Transfer Bank'): ?>
                      <tr class="border-none">
                        <td class="py-lg-3 px-lg-3 border-0 fw-normal bg-light">Bukti bayar</td>
                        <td class="py-lg-3 px-lg-3 border-0 fw-bold">
                          <a role="button" data-bs-toggle="modal" data-bs-target="#payment-picture" data-image="<?php echo base_url('public/owner/assets/img/orders/' . $order['proof_of_payment']) ?>">
                            <span class="fw-normal text-primary">
                              Lihat pembayaran
                            </span>
                          </a>
                        </td>
                      </tr>
                    <?php endif ?>

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
                  <div class="alert alert-warning">Pesanan Tertunda</div>
                <?php endif ?>

                <?php if ($order['status'] == 1): ?>
                  <div class="alert alert-success">Pesanan di teriman</div>
                <?php endif ?>

                <?php if ($order['status'] == 2): ?>
                  <div class="alert alert-danger">Pesanan di tolak</div>
                <?php endif ?>

                <?php if ($order['status'] == 3): ?>
                  <div class="alert alert-danger">Dibatalkan</div>
                <?php endif ?>
              </div>

              <div class="col-12 mt-4">
                <table class="table">
                  <tbody>
                    <tr class="border-none">
                      <td class="py-lg-3 w-50 px-lg-3 border-0 fw-normal bg-light">Product</td>
                      <td class="py-3 fw-normal border-0 bg-light">Total</td>
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
                      <td class="py-lg-3 w-50 px-lg-3 border-0 fw-normal bg-light">Subtotal:</td>
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
                      <td class="py-lg-3 w-50 px-lg-3 border-0 fw-normal bg-light">Total:</td>
                      <td class="py-lg-3 px-lg-3 border-0 fw-bold">Rp. <?php echo number_format($order['payment_amount']) ?></td>
                    </tr>
                    </tbody>
                  </table>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </section>

<!-- Modal -->
<div class="modal fade" id="payment-picture" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body">
        <div class="row btn-danger">
          <div class="col-12 p-0 d-flex justify-content-center">
            <img src="<?php echo base_url('public/owner/assets/img/orders/' . $order['proof_of_payment']) ?>" class="img-fluid" id="payment-picture-target">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

  </main><!-- End #main -->