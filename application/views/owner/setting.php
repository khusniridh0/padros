<main id="main" class="main">

  <div class="pagetitle">
    <h1>Profile</h1>
  </div><!-- End Page Title -->

  <section class="section profile">
    <div class="row">
      <div class="col-xl-4">

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

            <img src="<?php echo base_url('public/utama/assets/dinamis/profil/' . $this->session->userdata('image')) ?>" alt="Profile" class="rounded-circle">
            <h2 class="text-capitalize"><?php echo $this->session->userdata('name'); ?></h2>
            <?php if ($this->session->userdata('role') == 1): ?>
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

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Keamanan</button>
              </li>

            </ul>
            <div class="tab-content pt-2">
              <?php echo $this->session->flashdata('warning'); ?>
              <div class="tab-pane fade active show profile-overview" id="profile-overview">

                <h5 class="card-title">Profile Details</h5>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Nama Lengkap</div>
                  <div class="col-lg-9 col-md-8"><?php echo $user['name'] ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">UUID</div>
                  <div class="col-lg-9 col-md-8"><?php echo $user['uuid'] ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Jenis Kelamin</div>
                  <div class="col-lg-9 col-md-8"><?php echo $user['gender'] ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Perusahaan</div>
                  <div class="col-lg-9 col-md-8"><?php echo $user['company'] ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Tugas</div>
                  <div class="col-lg-9 col-md-8"><?php echo $user['task'] ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Kota</div>
                  <div class="col-lg-9 col-md-8"><?php echo $user['city'] ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Alamat Lengkap</div>
                  <div class="col-lg-9 col-md-8"><?php echo $user['address'] ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Nomor HP</div>
                  <div class="col-lg-9 col-md-8"><?php echo $user['phone'] ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Email</div>
                  <div class="col-lg-9 col-md-8"><?php echo $user['email'] ?></div>
                </div>

              </div>

              <div class="tab-pane fade show profile-edit pt-3" id="profile-edit">

                <!-- Profile Edit Form -->
                <form action="<?php echo base_url('setting/validated/profile/' . $this->session->userdata('user')) ?>" method="post" enctype="multipart/form-data" id="updateProfileForm">
                  <div class="row mb-3">
                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Foto Profil</label>
                    <div class="col-md-8 col-lg-9">
                      <img src="<?php echo base_url('public/utama/assets/dinamis/profil/' . $this->session->userdata('image')) ?>" alt="<?php echo $this->session->userdata('image') ?>" id="load-image" >
                      <div class="pt-2">
                        <label for="upload_image" class="btn btn-primary btn-sm text-light" title="Unggah foto profil baru"><i class="bi bi-upload"></i></label>
                        <input type="file" name="image" class="d-none" id="upload_image" accept="image/jpg, image/png, image/jpeg">
                        <button type="button" class="btn btn-danger btn-sm" title="Atur ulang foto" id="reset_picture"><i class="bi bi-trash"></i></button>
                      </div>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="name" class="col-md-4 col-lg-3 col-form-label">Nama lengkap</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="name" type="text" class="form-control" id="name" value="<?php echo $user['name'] ?>">
                      <?php echo form_error('name') ?>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="city" class="col-md-4 col-lg-3 col-form-label">Kota</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="city" type="text" class="form-control" id="city" value="<?php echo $user['city'] ?>">
                      <?php echo form_error('city') ?>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="address" class="col-md-4 col-lg-3 col-form-label">Alamat Lengkap</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="address" type="text" class="form-control" id="address" value="<?php echo $user['address'] ?>">
                      <?php echo form_error('address') ?>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="no-hp" class="col-md-4 col-lg-3 col-form-label">Nomor HP</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="phone" type="text" class="form-control" id="no-hp" value="<?php echo $user['phone'] ?>">
                      <?php echo form_error('phone') ?>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="email" class="col-md-4 col-lg-3 col-form-label">Alamat Email</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="email" type="email" class="form-control" id="Email" value="<?php echo $user['email'] ?>">
                      <?php echo form_error('email') ?>
                    </div>
                  </div>

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary disabled" id="saveForm">Simpan perubahan</button>
                  </div>
                </form><!-- End Profile Edit Form -->

              </div>

              <div class="tab-pane show fade pt-3" id="profile-change-password">
                <!-- Change Password Form -->
                <form action="<?php echo base_url('setting/validated/security') ?>" method="post">

                  <div class="row mb-3">
                    <label for="now-password" class="col-md-4 col-lg-3 col-form-label">Kata Sandi Sekarang</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="now-password" type="password" class="form-control" id="now-password">
                      <?php echo form_error('now-password') ?>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="new-password" class="col-md-4 col-lg-3 col-form-label">Kata Sandi Baru</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="new-password" type="password" class="form-control" id="new-password">
                      <?php echo form_error('new-password') ?>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="confirm-new-password" class="col-md-4 col-lg-3 col-form-label">Konfirmasi Kata Sandi</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="confirm-new-password" type="password" class="form-control" id="confirm-new-password">
                      <?php echo form_error('confirm-new-password') ?>
                    </div>
                  </div>

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Change Password</button>
                  </div>
                </form><!-- End Change Password Form -->

              </div>

            </div><!-- End Bordered Tabs -->

          </div>
        </div>

      </div>
    </div>
  </section>

  </main><!-- End #main -->