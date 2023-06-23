<!-- Muhammad Nor Hanafi 202251069 B -->

<!DOCTYPE html>
<html>

<head>
  <title>Surat Keterangan Miskin</title>
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
          <a class="nav-link" href="admin.php">Acara Desa</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-danger" href="logout.php">LOG OUT</a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container">
    <h1 class="mt-4">Surat Keterangan Miskin</h1>

    <?php
    // Cek apakah form telah disubmit
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Ambil nilai input dari form
      $nama = $_POST['nama'];
      $alamat = $_POST['alamat'];
      $pekerjaan = $_POST['pekerjaan'];

      // Simpan pengajuan surat keterangan miskin ke database (Disini menggunakan contoh koneksi.php yang Anda berikan sebelumnya)
      include 'koneksi.php';
      $query = "INSERT INTO surat_keterangan_miskin (nama, alamat, pekerjaan) VALUES ('$nama', '$alamat', '$pekerjaan')";
      $result = mysqli_query($conn, $query);

      // Tampilkan pesan alert jika pengajuan berhasil disimpan
      if ($result) {
        echo '<div class="alert alert-success mt-4">Pengajuan surat keterangan miskin berhasil diajukan!</div>';
      } else {
        echo '<div class="alert alert-danger mt-4">Terjadi kesalahan. Gagal mengajukan surat keterangan miskin.</div>';
      }
    }
    ?>

    <form action="" method="POST">
      <div class="form-group">
        <label for="nama">Nama</label>
        <input type="text" class="form-control" id="nama" name="nama" required>
      </div>
      <div class="form-group">
        <label for="alamat">Alamat</label>
        <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
      </div>
      <div class="form-group">
        <label for="pekerjaan">Pekerjaan</label>
        <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" required>
      </div>
      <button type="submit" class="btn btn-primary">Ajukan</button>
    </form>

  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>