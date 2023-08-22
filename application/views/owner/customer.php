  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Pelanggan</h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
            <!-- Reports -->
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Daftarkan Akun</h5>
                  <?php echo $this->session->flashdata('warning'); ?>
                  <form action="<?php echo base_url('customer/validated/add') ?>" method="post" class="form-add-user" id="customerForm">
                    <div class="form-items" id="name-feedback">
                      <label for="name" class="form-label text-primary text-opacity-75">Nama lengkap</label>
                      <input type="text" name="name" value="<?php echo set_value('name') ?>" class="py-lg-3 py-2 form-control" id="name" aria-describedby="emailHelp">
                      <div class="invalid-feedback text-danger opacity-75"></div>
                      <?php echo form_error('name'); ?>
                    </div>
                    <div class="form-items" id="email-feedback">
                      <label for="email" class="form-label text-primary text-opacity-75">Alamat email</label>
                      <input type="text" name="email" value="<?php echo set_value('email') ?>" class="py-lg-3 py-2 form-control" id="email">
                      <div class="invalid-feedback text-danger opacity-75"></div>
                      <?php echo form_error('email'); ?>
                    </div>
                    <div class="form-items" id="HP-feedback">
                      <label for="no-hp" class="form-label text-primary text-opacity-75">Nomor HP</label>
                      <input type="text" name="phone" value="<?php echo set_value('phone') ?>" class="py-lg-3 py-2 form-control" id="no-hp">
                      <div class="invalid-feedback text-danger opacity-75"></div>
                      <?php echo form_error('phone'); ?>
                    </div>
                    <button type="submit" class="sticky-bottom btn form-button">
                      <span class="btn btn-primary py-lg-3 py-2 fw-semibold w-100 d-blok">Buat Akun</span>
                    </button>
                  </form>
                </div>
              </div>
            </div><!-- End Reports -->

            <!-- Recent Sales -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                  <h5 class="card-title">Pelanggan</h5>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Alamat Email</th>
                        <th scope="col">Saldo Deposit</th>
                        <th scope="col">Nomor HP</th>
                        <th scope="col">Mendaftar</th>
                        <th scope="col">Berubah</th>
                        <th scope="col">Status</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($customer as $i => $data): ?>
                        <tr>
                          <th scope="row"><a href="#"><?php echo $i + 1 ?></a></th>
                          <td><?php echo $data['name'] ?></td>
                          <td class="text-primary"><?php echo $data['email'] ?></td>
                          <td>Rp <?php echo $data['balance'] ?></td>
                          <td><?php echo $data['phone'] ?></td>
                          <td><?php echo $data['date_created'] ?></td>
                          <td><?php echo $data['date_updated'] ?></td>
                          <td>
                            <?php if ($data['status'] == 0): ?>
                              <span class="fs-6 rounded-pill badge bg-warning">Butuh Verifikasi</span>
                            <?php endif ?>
                            <?php if ($data['status'] == 1): ?>
                              <span class="fs-6 rounded-pill badge bg-success">Aktif</span>
                            <?php endif ?>
                            <?php if ($data['status'] == 2): ?>
                              <span class="fs-6 rounded-pill badge bg-danger">Terblokir</span>
                            <?php endif ?>
                          </td>
                          <td>
                            <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></button>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="<?php echo base_url('customer/detile/' . $data['uuid']) ?>">Lihat profil</a></li>

                              <?php if ($data['status'] == 1): ?>
                                <li><a class="dropdown-item" href="<?php echo base_url('customer/validated/block/' . $data['uuid']) ?>">Blokir</a></li>
                              <?php endif ?>
                              <?php if ($data['status'] == 2): ?>
                                <li><a class="dropdown-item" href="<?php echo base_url('customer/validated/unblock/' . $data['uuid']) ?>">Buka Blokir</a></li>
                              <?php endif ?>

                              <li><a class="dropdown-item" href="<?php echo base_url('customer/validated/delete/' . $data['uuid']) ?>">Hapus</a></li>
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