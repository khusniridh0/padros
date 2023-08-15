  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="<?php echo base_url('public/owner/assets/vendor/apexcharts/apexcharts.min.js') ?>"></script>
  <script src="<?php echo base_url('public/owner/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
  <script src="<?php echo base_url('public/owner/assets/vendor/chart.js/chart.umd.js') ?>"></script>
  <script src="<?php echo base_url('public/owner/assets/vendor/echarts/echarts.min.js') ?>"></script>
  <script src="<?php echo base_url('public/owner/assets/vendor/quill/quill.min.js') ?>"></script>
  <script src="<?php echo base_url('public/owner/assets/vendor/simple-datatables/simple-datatables.js') ?>"></script>
  <script src="<?php echo base_url('public/owner/assets/vendor/tinymce/tinymce.min.js') ?>"></script>
  <script src="<?php echo base_url('public/owner/assets/vendor/php-email-form/validate.js') ?>"></script>

  <!-- Template Main JS File -->
  <script src="<?php echo base_url('public/owner/assets/js/main.js') ?>"></script>
  <?php if (!empty($js)): ?>
    <?php foreach ($js as $j): ?>
      <script src="<?php echo $j ?>" ></script>
    <?php endforeach ?>
  <?php endif ?>

</body>

</html>