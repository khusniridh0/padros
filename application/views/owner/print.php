<?php if (empty($traffic)): ?>
    <script type="text/javascript">window.close()</script>
<?php endif ?>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Keuangan - Padros Studio</title>
    <!-- Favicons -->
    <link href="<?php echo base_url('public/utama/assets/static/padros.png') ?>" rel="icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?php echo base_url('public/owner/assets/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('public/owner/assets/css/print.css') ?>" rel="stylesheet">
</head>
<body>
    <div class="print-contrainer">

        <h1 class="heading">Rekap Laporan Padros Studio</h1>
        <div class="additional">
            <small>
                <span class="additional-heading">Petugas</span>
                <span class="separator">:</span>
                <span class="value text-capitalize"><?php echo $this->session->userdata('name'); ?></span>
            </small>
            <small>
                <span class="additional-heading">Tanggal Cetak</span>
                <span class="separator">:</span>
                <span class="value"><?php echo date_now() ?></span>
            </small>
            <small>
                <span class="additional-heading">Mulai Tanggal</span>
                <span class="separator">:</span>
                <span class="value"><?php echo $this->session->userdata('start'); ?></span>
            </small>
            <small>
                <span class="additional-heading">Hingga Tanggal</span>
                <span class="separator">:</span>
                <span class="value"><?php echo $this->session->userdata('end'); ?></span>
            </small>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th><center>No</center></th>
                    <th>Keterangan</th>
                    <th>Tanggal</th>
                    <th>Jenis</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($traffic as $number => $item): ?>
                <tr>
                    <td><center><?php echo $number+1 ?></center></td>
                    <td><?php echo $item['keterangan'] ?></td>
                    <td><?php echo $item['tanggal'] ?></td>
                    <td><?php echo $item['tipe'] ?></td>
                    <td>Rp <?php echo number_format($item['jumlah']) ?></td>
                </tr>
                <?php endforeach ?>

            </tbody>
        </table>
    </div>

    <script src="<?php echo base_url('public/owner/assets/js/print.js') ?>"></script>
</body>
</html>