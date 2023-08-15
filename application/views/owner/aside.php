<!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

      <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
          <a class="nav-link <?php echo $title == 'Dashboard'? '' : 'collapsed' ?>" href="<?php echo base_url('dashboard') ?>">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
          </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
          <a class="nav-link <?php echo $title == 'Pelanggan'? '' : 'collapsed' ?>" href="<?php echo base_url('customer') ?>">
            <i class="bi bi-people"></i>
            <span>Pelanggan</span>
          </a>
        </li><!-- End Profile Page Nav -->

        <li class="nav-item">
          <a class="nav-link <?php echo $title == 'Pesanan'? '' : 'collapsed' ?>" href="<?php echo base_url('order') ?>">
            <i class="bi bi-cart-dash"></i>
            <span>Pesanan</span>
          </a>
        </li><!-- End F.A.Q Page Nav -->

        <li class="nav-item">
          <a class="nav-link <?php echo $title == 'Keuangan'? '' : 'collapsed' ?>" href="<?php echo base_url('finance') ?>">
            <i class="bi bi-cash-coin"></i>
            <span>Keuangan</span>
          </a>
        </li><!-- End Contact Page Nav -->
        <?php if (is_owner()): ?>
        <li class="nav-item">
          <a class="nav-link <?php echo $title == 'Karyawan'? '' : 'collapsed' ?>" href="<?php echo base_url('employee') ?>">
            <i class="bi bi-person-bounding-box"></i>
            <span>Karyawan</span>
          </a>
        </li><!-- End Register Page Nav -->
        <?php endif ?>

      </ul>

    </aside>
<!-- End Sidebar-->