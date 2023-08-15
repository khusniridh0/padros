  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Karyawan</h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <!-- Reports -->
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Daftarkan Karyawan</h5>
                <?php echo $this->session->flashdata('warning'); ?>
                <form action="<?php echo base_url('employee/validated/add') ?>" method="post" class="row justify-content-end">
                  <div class="col-lg-4 mb-3">
                    <label for="name" class="form-label text-primary text-opacity-75">Nama lengkap</label>
                    <input type="text" name="name" class="py-3 form-control" value="<?php echo set_value('name') ?>" id="name" />
                    <?php echo form_error('name') ?>
                  </div>
                  <div class="col-lg-4 mb-3">
                    <label for="email" class="form-label text-primary text-opacity-75">Alamat email</label>
                    <input type="text" name="email" class="py-3 form-control" value="<?php echo set_value('email') ?>" id="email" />
                    <?php echo form_error('email') ?>
                  </div>
                  <div class="col-lg-4 mb-3">
                    <label for="no-hp" class="form-label text-primary text-opacity-75">Nomor HP</label>
                    <input type="text" name="phone" class="py-3 form-control" value="<?php echo set_value('phone') ?>" id="no-hp" />
                    <?php echo form_error('phone') ?>
                  </div>
                  <div class="col-lg-4 mb-3">
                    <label for="task" class="form-label text-primary text-opacity-75">Tugas</label>
                    <input type="text" name="task" class="py-3 form-control" value="<?php echo set_value('task') ?>" id="task" />
                    <?php echo form_error('task') ?>
                  </div>
                  <div class="col-lg-4 mb-3">
                    <label for="evaluation" class="form-label text-primary text-opacity-75">Penilaian</label>
                    <select class="py-3 form-control" name="evaluation" id="evaluation">
                      <option value="1" <?php echo set_select('evaluation', 1) ?>>Baik</option>
                      <option value="2" <?php echo set_select('evaluation', 2) ?>>Cukup</option>
                      <option value="3" <?php echo set_select('evaluation', 3) ?>>Buruk</option>
                    </select>
                  </div>
                  <div class="col-lg-4 mb-3">
                    <label for="gender" class="form-label text-primary text-opacity-75">Jenis Kelamin</label>
                    <select class="py-3 form-control" name="gender" id="gender">
                      <option value="Laki-Laki" <?php echo set_select('gender', 1) ?>>Laki-Laki</option>
                      <option value="Perempuan" <?php echo set_select('gender', 2) ?>>Perempuan</option>
                    </select>
                  </div>
                  <div class="col-lg-4 mb-3">
                    <label for="city" class="form-label text-primary text-opacity-75">Kota</label>
                    <input type="text" name="city" class="py-3 form-control" value="<?php echo set_value('city') ?>" id="city">
                  </div>
                  <div class="col-lg-8 mb-3">
                    <label for="address" class="form-label text-primary text-opacity-75">Alamat lengkap</label>
                    <input type="text" name="address" class="py-3 form-control" value="<?php echo set_value('address') ?>" id="address">
                  </div>
                  <div class="col-12 mb-3">
                    <button type="submit" class="btn btn-primary py-3 float-end mx-2 fs-6">Tambah karyawan</button>
                    <button type="reset" class="btn btn-danger py-3 float-end mx-2 fs-6">Batalkan</button>
                  </div>
                </form>
              </div>
            </div>
          </div><!-- End Reports -->

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
                      <th></th>
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