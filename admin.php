
<?php
// Muhammad Nor Hanafi 202251069 B
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

// Memeriksa apakah pengguna adalah admin
if ($_SESSION['role'] !== 'admin') {
  header("Location: user.php");
  exit();
}

// Memeriksa apakah ada data yang dikirim melalui metode POST untuk menandai acara sebagai selesai
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["selesai"])) {
  $idAcara = escapeString($_POST["selesai"]);
  $sql = "UPDATE event_social SET selesai = 1 WHERE id = '$idAcara'";
  $conn->query($sql);
}

// Menampilkan daftar acara yang belum selesai
$sqlBelumSelesai = "SELECT * FROM event_social WHERE selesai = 0";
$resultBelumSelesai = $conn->query($sqlBelumSelesai);

// Menampilkan daftar acara yang sudah selesai
$sqlSudahSelesai = "SELECT * FROM event_social WHERE selesai = 1";
$resultSudahSelesai = $conn->query($sqlSudahSelesai);
?>

<!DOCTYPE html>
<html>

<head>
  <title>Peta Kegiatan Sosial - Admin</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
  <div class="container">
    <h1 class="mt-4">Peta Kegiatan Sosial - Admin</h1>

    <h2 class="mt-4">Halo, <?php echo $_SESSION['username']; ?>!</h2>

    <p><a href="logout.php">Logout</a></p>

    <!-- Button untuk menambah acara -->
    <a href="tambah_acara.php" class="btn btn-primary mt-4">Tambah Acara</a>

    <!-- Menampilkan daftar acara yang belum selesai -->
    <h2 class="mt-4">Daftar Acara yang Belum Selesai</h2>
    <?php
    if ($resultBelumSelesai->num_rows > 0) {
      while ($row = $resultBelumSelesai->fetch_assoc()) {
        echo "<div class='card mt-4'>";
        echo "<div class='card-body'>";
        echo "<h5 class='card-title'>" . $row['nama_acara'] . "</h5>";
        echo "<p class='card-text'>Deskripsi: " . $row['deskripsi'] . "</p>";
        echo "<p class='card-text'>Tanggal: " . $row['date'] . "</p>";
        echo "<p class='card-text'>Lokasi: " . $row['lokasi'] . "</p>";
        echo "<p class='card-text'>Jumlah Pengikut: " . $row['jumlah_pengikut'] . "</p>";

        // Tombol untuk menandai acara sebagai selesai
        echo "<form action='' method='POST' class='d-inline-block'>";
        echo "<input type='hidden' name='selesai' value='" . $row['id'] . "'>";
        echo "<button type='submit' class='btn btn-success'>Selesai</button>";
        echo "</form>";

        // Tombol untuk mengedit acara
        echo "<a href='edit_acara.php?id=" . $row['id'] . "' class='btn btn-primary'>Edit</a>";

        // Tombol untuk menghapus acara
        echo "<form action='' method='POST' class='d-inline-block'>";
        echo "<input type='hidden' name='hapus' value='" . $row['id'] . "'>";
        echo "<button type='submit' class='btn btn-danger'>Hapus</button>";
        echo "</form>";

        echo "</div>";
        echo "</div>";
      }
    } else {
      echo "<p class='mt-4'>Tidak ada acara yang belum selesai.</p>";
    }
    ?>

    <!-- Menampilkan daftar acara yang sudah selesai -->
    <h2 class="mt-4">Daftar Acara yang Sudah Selesai</h2>
    <?php
    if ($resultSudahSelesai->num_rows > 0) {
      while ($row = $resultSudahSelesai->fetch_assoc()) {
        echo "<div class='card mt-4'>";
        echo "<div class='card-body'>";
        echo "<h5 class='card-title'>" . $row['nama_acara'] . "</h5>";
        echo "<p class='card-text'>Deskripsi: " . $row['deskripsi'] . "</p>";
        echo "<p class='card-text'>Tanggal: " . $row['date'] . "</p>";
        echo "<p class='card-text'>Lokasi: " . $row['lokasi'] . "</p>";
        echo "<p class='card-text'>Jumlah Pengikut: " . $row['jumlah_pengikut'] . "</p>";

        echo "<p class='mt-4'><strong class='text-success'> acara yang sudah selesai.</strong></p>";

        echo "</div>";
        echo "</div>";
      }
    } else {
      echo "<p class='mt-4'>Tidak ada acara yang sudah selesai.</p>";
    }
    ?>
  </div>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>