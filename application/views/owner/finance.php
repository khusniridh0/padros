  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Finance</h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <?php echo $this->session->flashdata('warning'); ?>
      <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">
            <div class="col-lg-3">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Pengeluaran Baru</h5>
                  <form action="<?php echo base_url('finance/submit/add') ?>" method="post" id="formFinance">
                    <div class="mb-4">
                      <label for="description" class="form-label text-primary text-opacity-75">Keterangan</label>
                      <input type="text" name="description" value="<?php echo set_value('description') ?>" class="form-control" id="description">
                      <?php echo form_error('description') ?>
                    </div>
                    <div class="mb-4">
                      <label for="amount" class="form-label text-primary text-opacity-75">Jumlah</label>
                      <input type="text" name="amount" value="<?php echo set_value('amount') ?>" class="form-control" id="amount" autofocus>
                      <?php echo form_error('amount') ?>
                    </div>
                    <div class="d-flex justify-content-between">
                      <button type="reset" class="btn btn-danger form-button">Batal</button>
                      <button type="submit" class="btn btn-primary form-button">Konfirmasi</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <!-- Reports -->
            <div class="col-lg-9">
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
                  <h5 class="card-title">Pemasukan dan pengeluaran</h5>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Status</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($traffic as $i => $item): ?>
                        <tr>
                          <th scope="row"><a href="#"><?php echo $i + 1 ?></a></th>
                          <td><?php echo $item['keterangan'] ?></td>
                          <td><?php echo $item['tanggal'] ?></td>
                          <td><span class="rounded-circle badge <?php echo $item['tipe'] == 'up' ? 'bg-success-light text-success' : 'bg-danger-light text-danger' ?> p-1 fs-6 me-2"><i class="bi bi-arrow-<?php echo $item['tipe'] ?>-short"></i></span><?php echo number_format($item['jumlah']) ?></td>
                          <td>
                            <?php if ($item['status'] == 'Berirespon' || $item['status'] == 'Pengajuan'): ?>
                            <span class="fs-6 fw-normal rounded-pill badge text-bg-warning"><?php echo $item['status'] == 'Berirespon'? 'Berirespon' : 'Pengajuan' ?></span>
                            <?php endif ?>

                            <?php if ($item['status'] == 'Diterima' || $item['status'] == 'Selesai'): ?>
                            <span class="fs-6 fw-normal rounded-pill badge text-bg-success"><?php echo $item['status'] == 'Diterima'? 'Diterima' : 'Selesai' ?></span>
                            <?php endif ?>

                            <?php if ($item['status'] == 'Ditolak'): ?>
                            <span class="fs-6 fw-normal rounded-pill badge text-bg-danger">Ditolak</span>
                            <?php endif ?>
                          </td>
                          <td>
                            <?php if (is_owner() && $item['role_type'] == 0): ?>
                            <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></button>
                            <ul class="dropdown-menu">
                              <?php if ($item['role'] == 1): ?>
                                <li><a class="dropdown-item" href="<?php echo base_url('finance/submit/accept/' . $item['id']) ?>">Setujui Pengajuan</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('finance/submit/denied/' . $item['id']) ?>">Tolak Pengajuan</a></li>
                              <?php endif ?>
                              <?php if ($item['role'] == 2): ?>
                                  <li><a class="dropdown-item" href="<?php echo base_url('order/detile/' . $item['id']) ?>">Detile</a></li>
                              <?php endif ?>
                            </ul>
                            <?php endif ?>

                            <?php if (is_employee() && $item['role_type'] == 0): ?>
                              <?php if ($item['role'] == 2): ?>
                                <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></button>
                                <ul class="dropdown-menu">
                                  <li><a class="dropdown-item" href="<?php echo base_url('order/detile/' . $item['id']) ?>">Detile</a></li>
                                </ul>
                              <?php endif ?>
                            <?php endif ?>
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