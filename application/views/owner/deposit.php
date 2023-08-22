    <main id="main" class="main">

      <div class="pagetitle">
        <h1>Deposit</h1>
      </div><!-- End Page Title -->

      <section class="section dashboard">
        <div class="row">

          <!-- Left side columns -->
          <div class="col-lg-12">
            <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                  <h5 class="card-title">Data Deposit</h5>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">Invoice</th>
                        <th scope="col">Pelanggan</th>
                        <th scope="col">Nominal</th>
                        <th scope="col">Tanggal Deposit</th>
                        <th scope="col">Status</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($deposits as $item): ?>
                      <tr>
                        <th scope="row"><a href="#"><?php echo $item['uuid_deposit'] ?></a></th>
                        <td><?php echo $item['name'] ?></td>
                        <td>Rp <?php echo number_format($item['amount']) ?></td>
                        <td><?php echo date('d-m-Y', strtotime($item['date_created'])) ?></td>
                        <td>
                          <?php if ($item['status'] == 0): ?>
                          <span class="fs-6 rounded-pill badge bg-warning text-muted">Respon</span>
                          <?php endif ?>
                          <?php if ($item['status'] == 1): ?>
                          <span class="fs-6 rounded-pill badge bg-success">Setuju</span>
                          <?php endif ?>
                          <?php if ($item['status'] == 2): ?>
                          <span class="fs-6 rounded-pill badge bg-danger">Tolak</span>
                          <?php endif ?>
                        </td>
                        <td>
                          <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></button>
                          <ul class="dropdown-menu">
                            <li><button class="dropdown-item deposit-detile" type="button" role="button" data-bs-target="#proof-deposit" data-bs-toggle="modal" data-url="<?php echo base_url('deposit/detile/' . $item['uuid_deposit']) ?>">Detile</button></li>
                          </ul>
                        </td>
                      </tr>
                      <?php endforeach ?>
                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- End Recent Sales -->
          </div>

        </div>
      </section>

      <!-- modal satu-->
      <div class="modal fade" id="proof-deposit" aria-hidden="true" aria-labelledby="proof-deposit" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header d-block py-5">
              <small class="fs-6 text-center d-block text-muted mb-2" id="detile-invoice">#198801012019032006</small>
              <div class="text-center fw-semibold"><small class="fs-5">Rp</small> <span class="fs-1" id="detile-price">600.000 ,-</span></div>
            </div>
            <div class="modal-body py-4">
              <div class="w-100 d-flex justify-content-between my-3">
                <span>Nama Pelanggan</span>
                <span id="detile-name">Brandon Jacob</span>
              </div>
              <div class="w-100 d-flex justify-content-between my-3">
                <span>Tanggal Deposit</span>
                <span id="detile-tanggal">2023-07-25</span>
              </div>
              <div class="w-100 d-flex justify-content-between my-3">
                <span>Bukti Deposit</span>
                <span class="text-primary"><a role="button" data-bs-target="#image-proof" data-bs-toggle="modal">Lihat bukti bayar</a></span>
              </div>
            </div>
            <div class="modal-footer d-flex justify-content-between d-none" id="action">
              <a href="#" class="btn btn-danger py-3 px-5 float-end mx-2 fs-6" id="detile-reject">Tolak</a>
              <a href="#" class="btn btn-primary py-3 px-5 float-end mx-2 fs-6" id="detile-accept">Setuju</a>
            </div>
          </div>
        </div>
      </div>

      <!-- modal dua -->
      <div class="modal fade" id="image-proof" aria-hidden="true" aria-labelledby="image-proof" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content bg-transparent border-0">
            <div class="modal-header border-0 p-0">
              <button type="button" class="btn btn-warning" data-bs-target="#proof-deposit" data-bs-toggle="modal"><i class="bi bi-x-lg"></i></button>
            </div>
            <div class="modal-body">
              <div class="row btn-danger">
                <div class="col-12 p-0 d-flex justify-content-center">
                  <img src="" class="img-fluid" id="payment-picture-target">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main><!-- End #main -->