<?php
// Muhammad Nor Hanafi 202251069 B
session_start();

require 'koneksi.php'; // Menggunakan file koneksi.php

// Periksa apakah pengguna telah submit form
if (isset($_POST['submit'])) {
  // Mengambil nilai yang diinputkan dari form
  $nama = $_POST['nama'];
  $deskripsi = $_POST['deskripsi'];
  $tanggal = $_POST['tanggal'];
  $lokasi = $_POST['lokasi'];

  // Persiapkan query INSERT
  $query = "INSERT INTO  event_social(nama_acara, deskripsi, date, lokasi) VALUES ('$nama', '$deskripsi', '$tanggal', '$lokasi')";

  // Eksekusi query
  if ($conn->query($query) === TRUE) {
    // Redirect ke halaman admin.php atau halaman lain yang Anda inginkan
    header("Location: admin.php");
    exit();
  } else {
    // Tangani kesalahan jika terjadi kesalahan koneksi atau query
    echo "Error: " . $conn->error;
  }
}

?>
<!DOCTYPE html>
<html>

<head>
  <title>Tambah Acara</title>
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
          <a class="nav-link" href="proses_pengajuan.php">Pengajuan Pindah</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="data_bansos.php">Data Bansos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="admin.php">Acara Desa</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-danger" href="logout.php">LOG OUT</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="container">
    <h1 class="mt-4">Tambah Acara</h1>

    <h2 class="mt-4">Halo, <?php echo $_SESSION['username']; ?>!</h2>
    <p><a href="admin.php">kembali</a></p>

    <!-- Form untuk membuat acara baru -->
    <?php if ($_SESSION['role'] === 'admin') { ?>
      <h2 class="mt-4">Buat Acara Baru</h2>
      <form action="" method="POST">
        <div class="form-group">
          <label for="nama">Nama Acara</label>
          <input type="text" class="form-control" id="nama" name="nama" required>
        </div>
        <div class="form-group">
          <label for="deskripsi">Deskripsi</label>
          <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
        </div>
        <div class="form-group">
          <label for="tanggal">Tanggal</label>
          <input type="date" class="form-control" id="tanggal" name="tanggal" required>
        </div>
        <div class="form-group">
          <label for="lokasi">Lokasi</label>
          <input type="text" class="form-control" id="lokasi" name="lokasi" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Tambah Acara</button>
      </form>
    <?php } ?>

  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>