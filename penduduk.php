<?php
// Menghubungkan ke file koneksi.php
require 'koneksi.php';

// Memeriksa apakah pengguna sudah login atau belum
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit();
}

// Memeriksa apakah pengguna adalah admin
if ($_SESSION['role'] !== 'admin') {
  header("Location: user.php");
  exit();
}

// Mendapatkan data penduduk dari database
$sql = "SELECT * FROM penduduk";
$result = $conn->query($sql);

// Proses Tambah Data Penduduk
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["tambah"])) {
  $nama = $_POST["nama"];
  $alamat = $_POST["alamat"];
  $pekerjaan = $_POST["pekerjaan"];

  $sqlTambah = "INSERT INTO penduduk (nama, alamat, pekerjaan) VALUES ('$nama', '$alamat', '$pekerjaan')";
  $conn->query($sqlTambah);
  header("Location: penduduk.php");
  exit();
}

// Proses Edit Data Penduduk
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit"])) {
  $id = $_POST["edit_id"];
  $nama = $_POST["edit_nama"];
  $alamat = $_POST["edit_alamat"];
  $pekerjaan = $_POST["edit_pekerjaan"];

  $sqlEdit = "UPDATE penduduk SET nama='$nama', alamat='$alamat', pekerjaan='$pekerjaan' WHERE id='$id'";
  $conn->query($sqlEdit);
  header("Location: penduduk.php");
  exit();
}

// Proses Hapus Data Penduduk
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["hapus"])) {
  $id = $_POST["hapus"];
  $sqlHapus = "DELETE FROM penduduk WHERE id='$id'";
  $conn->query($sqlHapus);
  header("Location: penduduk.php");
  exit();
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Monitoring Desa Hadipolo - Admin</title>
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
          <a class="nav-link active" href="penduduk.php">Penduduk</a>
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



  <div class="container-fluid" style="margin-top: 20px;">
    <h1 class="mt-4">Monitoring Desa Hadipolo - Admin</h1>

    <!-- ... -->

    <!-- Menambahkan tabel untuk data penduduk -->
    <h2 class="mt-4">Data Penduduk</h2>
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Nama</th>
          <th scope="col">Alamat</th>
          <th scope="col">Pekerjaan</th>
          <th scope="col">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if ($result->num_rows > 0) {
          $no = 1;
          while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<th scope='row'>" . $no . "</th>";
            echo "<td>" . $row['nama'] . "</td>";
            echo "<td>" . $row['alamat'] . "</td>";
            echo "<td>" . $row['pekerjaan'] . "</td>";
            echo "<td>";
            echo "<button type='button' class='btn btn-primary btn-sm' data-toggle='modal' data-target='#editModal" . $row['id'] . "'>Edit</button> ";
            echo "<form method='POST' style='display: inline-block;'>
                    <input type='hidden' name='hapus' value='" . $row['id'] . "'>
                    <button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Hapus</button>
                  </form>";
            echo "</td>";
            echo "</tr>";
            $no++;
          }
        } else {
          echo "<tr>";
          echo "<td colspan='5'>Tidak ada data penduduk.</td>";
          echo "</tr>";
        }
        ?>
      </tbody>
    </table>

    <!-- Modal Edit Penduduk -->
    <?php
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo "<div class='modal fade' id='editModal" . $row['id'] . "' tabindex='-1' role='dialog' aria-labelledby='editModalLabel" . $row['id'] . "' aria-hidden='true'>
                <div class='modal-dialog' role='document'>
                  <div class='modal-content'>
                    <div class='modal-header'>
                      <h5 class='modal-title' id='editModalLabel" . $row['id'] . "'>Edit Penduduk</h5>
                      <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                      </button>
                    </div>
                    <div class='modal-body'>
                      <form method='POST'>
                        <div class='form-group'>
                          <label for='edit_nama'>Nama</label>
                          <input type='text' class='form-control' id='edit_nama' name='edit_nama' value='" . $row['nama'] . "' required>
                        </div>
                        <div class='form-group'>
                          <label for='edit_alamat'>Alamat</label>
                          <input type='text' class='form-control' id='edit_alamat' name='edit_alamat' value='" . $row['alamat'] . "' required>
                        </div>
                        <div class='form-group'>
                          <label for='edit_pekerjaan'>Pekerjaan</label>
                          <input type='text' class='form-control' id='edit_pekerjaan' name='edit_pekerjaan' value='" . $row['pekerjaan'] . "' required>
                        </div>
                        <input type='hidden' name='edit_id' value='" . $row['id'] . "'>
                        <button type='submit' name='edit' class='btn btn-primary'>Simpan Perubahan</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>";
      }
    }
    ?>

    <!-- Form Tambah Penduduk -->
    <h2 class="mt-4">Tambah Penduduk</h2>
    <form method="POST">
      <div class="form-group">
        <label for="nama">Nama</label>
        <input type="text" class="form-control" id="nama" name="nama" required>
      </div>
      <div class="form-group">
        <label for="alamat">Alamat</label>
        <input type="text" class="form-control" id="alamat" name="alamat" required>
      </div>
      <div class="form-group">
        <label for="pekerjaan">Pekerjaan</label>
        <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" required>
      </div>
      <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
    </form>

    <!-- ... -->

  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>