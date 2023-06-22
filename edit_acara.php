<?php
// Menghubungkan ke file koneksi.php
require 'koneksi.php';

// Mulai session
session_start();

// Fungsi untuk menghindari serangan injeksi SQL
function escapeString($string)
{
  global $conn;
  return mysqli_real_escape_string($conn, $string);
}

// Memeriksa apakah pengguna sudah login atau belum
if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit();
}

// Memeriksa apakah pengguna memiliki role admin
if ($_SESSION['role'] !== 'admin') {
  header("Location: user.php");
  exit();
}

// Memeriksa apakah ada parameter ID acara
if (!isset($_GET['id'])) {
  header("Location: index.php");
  exit();
}

// Mendapatkan ID acara dari parameter
$idAcara = escapeString($_GET['id']);

// Memeriksa apakah ada data yang dikirim melalui metode POST untuk menyimpan perubahan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $namaAcara = escapeString($_POST["nama_acara"]);
  $deskripsi = escapeString($_POST["deskripsi"]);
  $tanggal = escapeString($_POST["tanggal"]);
  $lokasi = escapeString($_POST["lokasi"]);

  $sql = "UPDATE event_social SET nama_acara = '$namaAcara', deskripsi = '$deskripsi', date = '$tanggal', lokasi = '$lokasi' WHERE id = '$idAcara'";
  $conn->query($sql);

  header("Location: admin.php");
  exit();
}

// Mengambil data acara dari database berdasarkan ID
$sql = "SELECT * FROM event_social WHERE id = '$idAcara'";
$result = $conn->query($sql);

// Memeriksa apakah data acara ditemukan
if ($result->num_rows == 0) {
  header("Location: index.php");
  exit();
}

$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>

<head>
  <title>Edit Acara</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script>
    function goBack() {
      window.history.back();
    }
  </script>
</head>

<body>
  <div class="container">
    <h1 class="mt-4">Edit Acara</h1>

    <form action="" method="POST">
      <div class="form-group">
        <label for="nama_acara">Nama Acara</label>
        <input type="text" class="form-control" id="nama_acara" name="nama_acara" value="<?php echo $row['nama_acara']; ?>" required>
      </div>
      <div class="form-group">
        <label for="deskripsi">Deskripsi</label>
        <textarea class="form-control" id="deskripsi" name="deskripsi" required><?php echo $row['deskripsi']; ?></textarea>
      </div>
      <div class="form-group">
        <label for="tanggal">Tanggal</label>
        <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo $row['date']; ?>" required>
      </div>
      <div class="form-group">
        <label for="lokasi">Lokasi</label>
        <input type="text" class="form-control" id="lokasi" name="lokasi" value="<?php echo $row['lokasi']; ?>" required>
      </div>
      <button type="submit" class="btn btn-primary">Simpan</button>
      <button type="button" class="btn btn-secondary" onclick="goBack()">Batal</button>
    </form>
  </div>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>