<!-- data_bansos.php -->
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

// Mendapatkan data bansos dari database
$sql = "SELECT * FROM data_bansos";
$result = $conn->query($sql);

// Menghandle penambahan data bansos
if (isset($_POST['tambah'])) {
  $nama = $_POST['tambah-nama'];
  $alamat = $_POST['tambah-alamat'];
  $jenis_bansos = $_POST['tambah-jenis-bansos'];
  $total_dana_bansos = $_POST['tambah-total-dana-bansos'];

  // Query untuk menambah data bansos
  $tambah_sql = "INSERT INTO data_bansos (nama, alamat, jenis_bansos, total_dana_bansos) VALUES ('$nama', '$alamat', '$jenis_bansos', '$total_dana_bansos')";
  if ($conn->query($tambah_sql) === TRUE) {
    header("Location: data_bansos.php");
    exit();
  } else {
    echo "Error: " . $tambah_sql . "<br>" . $conn->error;
  }
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
          <a class="nav-link" href="penduduk.php">Penduduk</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="surat_keterangan_miskin.php">Pengajuan Keterangan Miskin</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="proses_pengajuan.php">Pengajuan Pindah</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="data_bansos.php">Data Bansos</a>
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

    <!-- Menambahkan tabel untuk data bansos -->
    <h2 class="mt-4">Data Bansos</h2>
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Nama</th>
          <th scope="col">Alamat</th>
          <th scope="col">Jenis Bansos</th>
          <th scope="col">Total Dana Bansos</th>
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
            echo "<td>" . $row['jenis_bansos'] . "</td>";
            echo "<td>" . $row['total_dana_bansos'] . "</td>";
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
          echo "<td colspan='5'>Tidak ada data bansos.</td>";
          echo "</tr>";
        }
        ?>
      </tbody>
    </table>

    <!-- Modal Edit Bansos -->
    <?php
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo "<div class='modal fade' id='editModal" . $row['id'] . "' tabindex='-1' role='dialog' aria-labelledby='editModalLabel" . $row['id'] . "' aria-hidden='true'>
                <div class='modal-dialog' role='document'>
                  <div class='modal-content'>
                    <div class='modal-header'>
                      <h5 class='modal-title' id='editModalLabel" . $row['id'] . "'>Edit Data Bansos</h5>
                      <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                      </button>
                    </div>
                    <div class='modal-body'>
                      <form method='POST'>
                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                        <div class='form-group'>
                          <label for='edit-nama" . $row['id'] . "'>Nama</label>
                          <input type='text' class='form-control' id='edit-nama" . $row['id'] . "' name='edit-nama" . $row['id'] . "' value='" . $row['nama'] . "' required>
                        </div>
                        <div class='form-group'>
                          <label for='edit-alamat" . $row['id'] . "'>Alamat</label>
                          <input type='text' class='form-control' id='edit-alamat" . $row['id'] . "' name='edit-alamat" . $row['id'] . "' value='" . $row['alamat'] . "' required>
                        </div>
                        <div class='form-group'>
                          <label for='edit-jenis-bansos" . $row['id'] . "'>Jenis Bansos</label>
                          <input type='text' class='form-control' id='edit-jenis-bansos" . $row['id'] . "' name='edit-jenis-bansos" . $row['id'] . "' value='" . $row['jenis_bansos'] . "' required>
                        </div>
                        <div class='form-group'>
                          <label for='edit-total-dana-bansos" . $row['id'] . "'>Total Dana Bansos</label>
                          <input type='text' class='form-control' id='edit-total-dana-bansos" . $row['id'] . "' name='edit-total-dana-bansos" . $row['id'] . "' value='" . $row['total_dana_bansos'] . "' required>
                        </div>
                        <button type='submit' name='edit' class='btn btn-primary'>Simpan Perubahan</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>";
      }
    }
    ?>

    <!-- Modal Tambah Bansos -->
    <!-- Form Tambah Penduduk -->
    <h2 class="mt-4">Tambah Data Bansos</h2>
    <form method="POST">
      <div class="form-group">
        <label for="tambah-nama">Nama</label>
        <input type="text" class="form-control" id="tambah-nama" name="tambah-nama" required>
      </div>
      <div class="form-group">
        <label for="tambah-alamat">Alamat</label>
        <input type="text" class="form-control" id="tambah-alamat" name="tambah-alamat" required>
      </div>
      <div class="form-group">
        <label for="tambah-jenis-bansos">Jenis Bansos</label>
        <input type="text" class="form-control" id="tambah-jenis-bansos" name="tambah-jenis-bansos" required>
      </div>
      <div class="form-group">
        <label for="tambah-total-dana-bansos">Total Dana Bansos</label>
        <input type="text" class="form-control" id="tambah-total-dana-bansos" name="tambah-total-dana-bansos" required>
      </div>
      <button type="submit" name="tambah" class="btn btn-primary">Tambah Data</button>
    </form>

    <!-- ... -->

  </div>
  <!-- ... -->

  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.14.7/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>