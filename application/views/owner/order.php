  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Pelanggan</h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
            <!-- Recent Sales -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                  <h5 class="card-title">Pelanggan</h5>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Pelanggan</th>
                        <th scope="col">Layanan</th>
                        <th scope="col">Tanggal Sewa</th>
                        <th scope="col">Jam Masuk</th>
                        <th scope="col">Jam Keluar</th>
                        <th scope="col">Status</th>
                        <th scope="col">Pembayaran</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($orders as $i => $order): ?>
                        <tr>
                          <th scope="row"><a href="#"><?php echo $i + 1 ?></a></th>
                          <td><?php echo $order['order_name'] ?></td>
                          <td>
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
                          <td><?php echo $order['order_date'] ?></td>
                          <td><?php echo $order['start_time'] ?></td>
                          <td><?php echo $order['end_time'] ?></td>
                          <td>
                            <?php if ($order['status'] == 0): ?>
                              <span class="fs-6 rounded-pill badge bg-warning">Berirespon</span>
                            <?php endif ?>

                            <?php if ($order['status'] == 1): ?>
                              <span class="fs-6 rounded-pill badge bg-success">Diterima</span>
                            <?php endif ?>

                            <?php if ($order['status'] == 2): ?>
                              <span class="fs-6 rounded-pill badge bg-danger">Ditolak</span>
                            <?php endif ?>
                          </td>
                          <td><?php echo $order['payment_method'] ?></td>
                          <td>
                            <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></button>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="<?php echo base_url('order/detile/' . $order['order_uuid']) ?>">Detile</a></li>
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
        </div><!-- End Left side columns -->
      </div>
    </section>
  </main><!-- End #main -->