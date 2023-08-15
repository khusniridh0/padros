  <main id="main" class="main">

  <div class="pagetitle">
    <h1>Profile</h1>
  </div><!-- End Page Title -->

  <section class="section profile">
    <div class="row">
      <div class="col-xl-4">

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

            <img src="<?php echo base_url('public/utama/assets/dinamis/profil/' . $employee['image']) ?>" alt="Profile" class="rounded-circle">
            <h2 class="text-capitalize"><?php echo $employee['name']; ?></h2>
            <?php if ($employee['role'] == 1): ?>
              <h3>Admin</h3>
            <?php else: ?>
              <h3>Karyawan</h3>
            <?php endif ?>
          </div>
        </div>

      </div>

      <div class="col-xl-8">

        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">

              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Umum</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Ubah Profil</button>
              </li>

            </ul>
            <div class="tab-content pt-2">
              <?php echo $this->session->flashdata('warning'); ?>
              <div class="tab-pane fade active show profile-overview" id="profile-overview">

                <h5 class="card-title">Profile Details</h5>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Nama Lengkap</div>
                  <div class="col-lg-9 col-md-8"><?php echo $employee['name'] ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">UUID</div>
                  <div class="col-lg-9 col-md-8"><?php echo $employee['uuid'] ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Jenis Kelamin</div>
                  <div class="col-lg-9 col-md-8"><?php echo $employee['gender'] ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Perusahaan</div>
                  <div class="col-lg-9 col-md-8"><?php echo $employee['company'] ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Jabatan</div>
                  <div class="col-lg-9 col-md-8"><?php echo $employee['position'] ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Tugas</div>
                  <div class="col-lg-9 col-md-8"><?php echo $employee['task'] ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Kota</div>
                  <div class="col-lg-9 col-md-8"><?php echo $employee['city'] ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Alamat Lengkap</div>
                  <div class="col-lg-9 col-md-8"><?php echo $employee['address'] ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Email</div>
                  <div class="col-lg-9 col-md-8"><?php echo $employee['email'] ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Nomor Hp</div>
                  <div class="col-lg-9 col-md-8"><?php echo $employee['phone'] ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Terdaftar Mulai</div>
                  <div class="col-lg-9 col-md-8"><?php echo $employee['date_updated'] ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Status</div>
                  <div class="col-lg-9 col-md-8">
                    <?php if ($employee['status'] == 0): ?>
                      <span class="fs-6 rounded-pill badge bg-warning">Butuh Verifikasi</span>
                    <?php endif ?>
                    <?php if ($employee['status'] == 1): ?>
                      <span class="fs-6 rounded-pill badge bg-success">Aktif</span>
                    <?php endif ?>
                    <?php if ($employee['status'] == 2): ?>
                      <span class="fs-6 rounded-pill badge bg-danger">Terblokir</span>
                    <?php endif ?>
                  </div>
                </div>

              </div>

              <div class="tab-pane fade show profile-edit pt-3" id="profile-edit">

                <!-- Profile Edit Form -->
                <form action="<?php echo base_url('employee/validated/update/' . $employee['uuid']) ?>" method="post" enctype="multipart/form-data" id="updateProfileForm">

                  <div class="row mb-3">
                    <label for="name" class="col-md-4 col-lg-3 col-form-label">Nama lengkap</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="name" type="text" class="form-control" id="name" value="<?php echo $employee['name'] ?>">
                      <?php echo form_error('name') ?>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="task" class="col-md-4 col-lg-3 col-form-label">Tugas</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="task" type="text" class="form-control" id="task" value="<?php echo $employee['task'] ?>">
                      <?php echo form_error('task') ?>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="no-hp" class="col-md-4 col-lg-3 col-form-label">Nomor HP</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="phone" type="text" class="form-control" id="no-hp" value="<?php echo $employee['phone'] ?>">
                      <?php echo form_error('phone') ?>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="evaluation" class="col-md-4 col-lg-3 col-form-label">Penilaian</label>
                    <div class="col-md-8 col-lg-9">
                      <select class="form-control" name="evaluation" id="evaluation">
                        <option value="1" <?php echo set_select('evaluation', 1) ?>>Baik</option>
                        <option value="2" <?php echo set_select('evaluation', 2) ?>>Cukup</option>
                        <option value="3" <?php echo set_select('evaluation', 3) ?>>Buruk</option>
                      </select>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="address" class="col-md-4 col-lg-3 col-form-label">Alamat Lengkap</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="address" type="text" class="form-control" id="address" value="<?php echo $employee['address'] ?>">
                      <?php echo form_error('address') ?>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="city" class="col-md-4 col-lg-3 col-form-label">Kota</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="city" type="city" class="form-control" id="city" value="<?php echo $employee['city'] ?>">
                      <?php echo form_error('city') ?>
                    </div>
                  </div>

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary disabled" id="saveForm">Simpan perubahan</button>
                  </div>
                </form><!-- End Profile Edit Form -->

              </div>

            </div><!-- End Bordered Tabs -->

          </div>
        </div>

      </div>
    </div>
  </section>

  </main><!-- End #main -->