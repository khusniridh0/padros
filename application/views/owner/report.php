  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Laporan</h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
            <!-- Reports -->
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Laporan Keuangan</h5>
                  <form action="<?php echo base_url('report/validated/search') ?>" method="post" class="form-add-user" id="customerForm">
                    <div class="form-items" id="start-feedback">
                      <label for="start" class="form-label text-primary text-opacity-75">Dari tanggal</label>
                      <input type="text" name="start" value="<?php echo set_value('start') ?>" class="py-lg-3 py-2 form-control" data-date="<?php echo date('Y-m-d', strtotime(date('Y-m-d') . ' -7 day')) ?>" id="start" autocomplete="off">
                      <div class="invalid-feedback text-danger opacity-75"></div>
                      <?php echo form_error('start'); ?>
                    </div>
                    <div class="form-items" id="end-feedback">
                      <label for="end" class="form-label text-primary text-opacity-75">Hingga tanggal</label>
                      <input type="text" name="end" value="<?php echo set_value('end') ?>" class="py-lg-3 py-2 form-control" data-date="<?php echo date('Y-m-d', strtotime(date('Y-m-d') . ' -1 day')) ?>" id="end" autocomplete="off">
                      <div class="invalid-feedback text-danger opacity-75"></div>
                      <?php echo form_error('end'); ?>
                    </div>
                    <div class="form-items" id="type-feedback">
                      <label for="type" class="form-label text-primary text-opacity-75">Penilaian</label>
                      <select class="py-3 form-control" name="type" id="type">
                        <option value="1" <?php echo set_select('type', 1) ?>>Semua Transaksi</option>
                        <option value="2" <?php echo set_select('type', 2) ?>>Pemasukan</option>
                        <option value="3" <?php echo set_select('type', 3) ?>>Pengeluaran</option>
                      </select>
                      <?php echo form_error('type'); ?>
                    </div>
                    <button type="submit" class="sticky-bottom btn form-button">
                      <span class="btn btn-primary py-lg-3 py-2 fw-semibold w-100 d-blok">Cari Data</span>
                    </button>
                  </form>
                </div>
              </div>
            </div><!-- End Reports -->

            <!-- Recent Sales -->
            <div class="col-12">
              <?php echo $this->session->flashdata('warning'); ?>
              <?php if (!empty($traffic)): ?>
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-start pt-3">
                    <h5 class="card-title p-0">Pemasukan dan pengeluaran</h5>
                    <button type="button" class="sticky-bottom btn form-button border-0" id="print" data-url="<?php echo base_url('report/validated/print') ?>">
                      <span class="btn btn-primary py-lg-2 px-lg-4 fw-semibold">Cetak Data</span>
                    </button>
                  </div>

                  <table class="table table-borderless report">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Jenis</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($traffic as $i => $item): ?>
                        <tr>
                          <th scope="row"><a href="#"><?php echo $i + 1 ?></a></th>
                          <td><?php echo $item['keterangan'] ?></td>
                          <td><?php echo $item['tanggal'] ?></td>
                          <td><?php echo $item['tipe'] ?></td>
                          <td><?php echo number_format($item['jumlah']) ?></td>
                        </tr>
                      <?php endforeach ?>
                    </tbody>
                  </table>

                </div>

              </div>
              <?php endif ?>
            </div><!-- End Recent Sales -->
          </div>
        </div><!-- End Left side columns -->
      </div>
    </section>
  </main><!-- End #main -->