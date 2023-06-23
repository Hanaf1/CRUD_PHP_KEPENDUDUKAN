<!-- Muhammad Nor Hanafi  202251069 B-->

<!DOCTYPE html>
<html>

<head>
  <title>Pengajuan Surat Pindah Domisili</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Monitoring Desa Hadipolo - Admin</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="penduduk.php">Penduduk</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="surat_keterangan_miskin.php">Pengajuan Keterangan Miskin</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="proses_pengajuan.php">Pengajuan Pindah</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="data_bansos.php">Data Bansos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin.php">Acara Desa</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-danger" href="logout.php">LOG OUT</a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container">
    <h1 class="mt-4">Pengajuan Surat Pindah Domisili</h1>

    <?php
    // Cek apakah form telah disubmit
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Ambil nilai input dari form
      $nama = $_POST['nama'];
      $alamatLama = $_POST['alamat_lama'];
      $alamatBaru = $_POST['alamat_baru'];
      $alasan = $_POST['alasan'];

      // Simpan pengajuan surat pindah domisili ke database (Disini menggunakan contoh koneksi.php yang Anda berikan sebelumnya)
      include 'koneksi.php';
      $query = "INSERT INTO pengajuan_surat_domisili (nama, alamat_lama, alamat_baru, alasan) VALUES ('$nama', '$alamatLama', '$alamatBaru', '$alasan')";
      $result = mysqli_query($conn, $query);

      // Tampilkan pesan alert jika pengajuan berhasil disimpan
      if ($result) {
        echo '<div class="alert alert-success mt-4">Pengajuan surat pindah domisili berhasil diajukan!</div>';
      } else {
        echo '<div class="alert alert-danger mt-4">Terjadi kesalahan. Gagal mengajukan surat pindah domisili.</div>';
      }
    }
    ?>

    <form action="" method="POST">
      <div class="form-group">
        <label for="nama">Nama</label>
        <input type="text" class="form-control" id="nama" name="nama" required>
      </div>
      <div class="form-group">
        <label for="alamat_lama">Alamat Lama</label>
        <input type="text" class="form-control" id="alamat_lama" name="alamat_lama" required>
      </div>
      <div class="form-group">
        <label for="alamat_baru">Alamat Baru</label>
        <input type="text" class="form-control" id="alamat_baru" name="alamat_baru" required>
      </div>
      <div class="form-group">
        <label for="alasan">Alasan Pindah</label>
        <textarea class="form-control" id="alasan" name="alasan" rows="3" required></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Ajukan</button>
    </form>

  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>