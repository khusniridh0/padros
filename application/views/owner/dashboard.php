  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Penjualan</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-bag"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $penjualan ?></h6>
                      <span class="<?php echo $present_penjualan['status'] ?> small pt-1 fw-bold"><?php echo $present_penjualan['present'] ?> %</span> <span class="text-muted small pt-2 ps-1"><?php echo $present_penjualan['message'] ?></span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Customers Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card customers-card">
                <div class="card-body">
                  <h5 class="card-title">Akun pelanggan</h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $pelanggan ?></h6>
                      <span class="<?php echo $present_pelanggan['status'] ?> small pt-1 fw-bold"><?php echo $present_pelanggan['present'] ?> %</span> <span class="text-muted small pt-2 ps-1"><?php echo $present_pelanggan['message'] ?></span>

                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->

            <!-- Customers Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card employees-card">
                <div class="card-body">
                  <h5 class="card-title">Karyawan</h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $staf ?></h6>
                      <span class="<?php echo $present_staf['status'] ?> small pt-1 fw-bold"><?php echo $present_staf['present'] ?> %</span> <span class="text-muted small pt-2 ps-1"><?php echo $present_staf['message'] ?></span>

                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-6 col-md-12">
              <div class="card info-card revenue-card">
                <div class="card-body">
                  <h5 class="card-title">Pendapatan</h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo number_format($pendapatan) ?></h6>
                      <span class="<?php echo $present_pendapatan['status'] ?> small pt-1 fw-bold"><?php echo $present_pendapatan['present'] ?> %</span> <span class="text-muted small pt-2 ps-1"><?php echo $present_pendapatan['message'] ?></span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-6 col-md-12">
              <div class="card info-card employees-card">
                <div class="card-body">
                  <h5 class="card-title">Karyawan</h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo number_format($pengeluaran) ?></h6>
                      <span class="<?php echo $present_pengeluaran['status'] ?> small pt-1 fw-bold"><?php echo $present_pengeluaran['present'] ?> %</span> <span class="text-muted small pt-2 ps-1"><?php echo $present_pengeluaran['message'] ?></span>

                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->

            <!-- Reports -->
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Laporan</h5>
                  <!-- Line Chart -->
                  <div id="reportsChart"></div>
                  <!-- End Line Chart -->
                </div>

              </div>
            </div><!-- End Reports -->

            <!-- Recent Sales -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                  <h5 class="card-title">Karyawan</h5>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">UUID</th>
                        <th scope="col">Karyawan</th>
                        <th scope="col">Jabatan</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">Tugas</th>
                        <th scope="col">Terdaftar</th>
                        <th scope="col">Status</th>
                        <?php if (is_owner()): ?>
                        <th></th>
                        <?php endif ?>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($employee as $em): ?>
                        <tr>
                          <th scope="row"><a href="#"><?php echo $em['uuid'] ?></a></th>
                          <td><?php echo $em['name'] ?></td>
                          <td><?php echo $em['position'] ?></td>
                          <td><?php echo $em['gender'] ?></td>
                          <td><?php echo $em['task'] ?></td>
                          <td><?php echo $em['date_created'] ?></td>
                          <td>
                            <?php if ($em['evaluation'] == 1): ?>
                              <span class="fs-6 rounded-pill badge bg-success">Baik</span></td>
                            <?php endif ?>
                            <?php if ($em['evaluation'] == 2): ?>
                              <span class="fs-6 rounded-pill badge bg-warning">Cukup</span></td>
                            <?php endif ?>
                            <?php if ($em['evaluation'] == 3): ?>
                              <span class="fs-6 rounded-pill badge bg-danger">Buruk</span></td>
                            <?php endif ?>
                            <?php if (is_owner()): ?>
                            <td>
                              <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></button>
                              <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?php echo base_url('employee/detile/' . $em['uuid']) ?>">Profil Karyawan</a></li>
                                <?php if ($em['status'] == 1): ?>
                                  <li><a class="dropdown-item" href="<?php echo base_url('employee/validated/block/' . $em['uuid']) ?>">Blokir</a></li>
                                <?php endif ?>
                                <?php if ($em['status'] == 2): ?>
                                  <li><a class="dropdown-item" href="<?php echo base_url('employee/validated/unblock/' . $em['uuid']) ?>">Buka Blokir</a></li>
                                <?php endif ?>
                                <li><a class="dropdown-item" href="<?php echo base_url('employee/validated/remove/' . $em['uuid']) ?>">Hapus Karyawan</a></li>
                              </ul>
                            </td>
                            <?php endif ?>
                          </tr>
                        <?php endforeach ?>
                      </tbody>
                    </table>

                  </div>

                </div>

              </div>
            </div><!-- End Recent Sales -->
          </div>
        </div><!-- End Left side columns -->
      </div>
    </section>
  </main><!-- End #main -->