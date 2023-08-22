<main id="main" class="main">

  <div class="pagetitle">
    <h1>Profile</h1>
  </div><!-- End Page Title -->

  <section class="section profile">
    <div class="row">
      <div class="col-xl-4">

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

            <img src="<?php echo base_url('public/utama/assets/dinamis/profil/' . $user['image']) ?>" alt="Profile" class="rounded-circle">
            <h2 class="text-capitalize"><?php echo $user['name'] ?></h2>
            <h3>Pelanggan</h3>
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

            </ul>
            <div class="tab-content pt-2">

              <div class="tab-pane fade show active profile-overview" id="profile-overview">

                <h5 class="card-title">Profile Details</h5>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Nama Lengkap</div>
                  <div class="col-lg-9 col-md-8"><?php echo $user['name'] ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Saldo Deposit</div>
                  <div class="col-lg-9 col-md-8">Rp <?php echo number_format($user['balance']) ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Surel</div>
                  <div class="col-lg-9 col-md-8"><?php echo $user['email'] ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Nomor Hp</div>
                  <div class="col-lg-9 col-md-8"><?php echo $user['phone'] ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Terdaftar</div>
                  <div class="col-lg-9 col-md-8"><?php echo $user['date_created'] ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Berubah</div>
                  <div class="col-lg-9 col-md-8"><?php echo $user['date_updated'] ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Kode Verifikasi</div>
                  <div class="col-lg-9 col-md-8"><?php echo $user['verify'] ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Status</div>
                  <div class="col-lg-9 col-md-8">
                    <?php if ($user['status'] == 0): ?>
                      <span class="fs-6 rounded-pill badge bg-warning">Butuh Verifikasi</span>
                    <?php endif ?>
                    <?php if ($user['status'] == 1): ?>
                      <span class="fs-6 rounded-pill badge bg-success">Aktif</span>
                    <?php endif ?>
                    <?php if ($user['status'] == 2): ?>
                      <span class="fs-6 rounded-pill badge bg-danger">Terblokir</span>
                    <?php endif ?>
                  </div>
                </div>

              </div>

            </div><!-- End Bordered Tabs -->

          </div>
        </div>

      </div>
    </div>
  </section>

  </main><!-- End #main -->