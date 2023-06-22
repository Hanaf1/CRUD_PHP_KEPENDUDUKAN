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

// Memeriksa apakah ada data yang dikirim melalui metode POST untuk mengikuti acara
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["ikuti"])) {
  $idAcara = escapeString($_POST["ikuti"]);
  $username = $_SESSION['username'];

  // Memeriksa apakah pengguna telah mengikuti acara sebelumnya
  $sqlCheck = "SELECT * FROM ikuti_acara WHERE id_acara = '$idAcara' AND username = '$username'";
  $resultCheck = $conn->query($sqlCheck);

  if ($resultCheck->num_rows == 0) {
    // Pengguna belum mengikuti acara, tambahkan ke database
    $sqlInsert = "INSERT INTO ikuti_acara (id_acara, username) VALUES ('$idAcara', '$username')";
    $conn->query($sqlInsert);

    // Update jumlah_pengikut di tabel event_social
    $sqlUpdate = "UPDATE event_social SET jumlah_pengikut = jumlah_pengikut + 1 WHERE id = '$idAcara'";
    $conn->query($sqlUpdate);

    // Tampilkan alert
    echo '<div class="alert alert-success" role="alert">Anda berhasil mengikuti acara!</div>';
  } else {
    // Tampilkan alert jika pengguna telah mengikuti acara sebelumnya
    echo '<div class="alert alert-info" role="alert">Anda telah mengikuti acara ini sebelumnya!</div>';
  }
}

// Memeriksa apakah ada data yang dikirim melalui metode POST untuk membatalkan mengikuti acara
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["batalkan"])) {
  $idAcara = escapeString($_POST["batalkan"]);
  $username = $_SESSION['username'];

  // Hapus data dari tabel ikuti_acara
  $sqlDelete = "DELETE FROM ikuti_acara WHERE id_acara = '$idAcara' AND username = '$username'";
  $conn->query($sqlDelete);

  // Kurangi jumlah_pengikut di tabel event_social
  $sqlUpdate = "UPDATE event_social SET jumlah_pengikut = jumlah_pengikut - 1 WHERE id = '$idAcara'";
  $conn->query($sqlUpdate);

  // Tampilkan alert
  echo '<div class="alert alert-danger" role="alert">Anda telah membatalkan mengikuti acara ini.</div>';
}

// Menampilkan daftar acara yang belum selesai
$sqlBelumSelesai = "SELECT * FROM event_social WHERE selesai = 0";
$resultBelumSelesai = $conn->query($sqlBelumSelesai);

// Menampilkan daftar acara yang sudah selesai
$sqlSelesai = "SELECT * FROM event_social WHERE selesai = 1";
$resultSelesai = $conn->query($sqlSelesai);
?>

<!DOCTYPE html>
<html>

<head>
  <title>Peta Kegiatan Sosial - User</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
  <div class="container">
    <h1 class="mt-4">Peta Kegiatan Sosial - User</h1>

    <h2 class="mt-4">Halo, <?php echo $_SESSION['username']; ?>!</h2>

    <p><a href="logout.php">Logout</a></p>

    <!-- Menampilkan daftar acara yang belum selesai -->
    <h2 class="mt-4">Daftar Acara yang Belum Selesai</h2>
    <?php
    if ($resultBelumSelesai->num_rows > 0) {
      while ($row = $resultBelumSelesai->fetch_assoc()) {
        echo '<div class="card mt-4">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $row['nama_acara'] . '</h5>';
        echo '<p class="card-text">' . $row['deskripsi'] . '</p>';
        echo '<p class="card-text">Tanggal: ' . $row['date'] . '</p>';
        echo '<p class="card-text">Lokasi: ' . $row['lokasi'] . '</p>';
        echo '<p class="card-text">Jumlah Pengikut: ' . $row['jumlah_pengikut'] . '</p>';

        // Memeriksa apakah pengguna telah mengikuti acara ini
        $idAcara = $row['id'];
        $username = $_SESSION['username'];
        $sqlCheck = "SELECT * FROM ikuti_acara WHERE id_acara = '$idAcara' AND username = '$username'";
        $resultCheck = $conn->query($sqlCheck);

        if ($resultCheck->num_rows == 0) {
          // Pengguna belum mengikuti acara, tampilkan tombol ikuti
          echo '<form action="" method="post">';
          echo '<input type="hidden" name="ikuti" value="' . $row['id'] . '">';
          echo '<button type="submit" class="btn btn-primary">Ikuti Acara</button>';
          echo '</form>';
        } else {
          // Pengguna telah mengikuti acara, tampilkan tombol batalkan
          echo '<form action="" method="post">';
          echo '<input type="hidden" name="batalkan" value="' . $row['id'] . '">';
          echo '<button type="submit" class="btn btn-danger">Batalkan Ikuti</button>';
          echo '</form>';
        }

        echo '</div>';
        echo '</div>';
      }
    } else {
      echo '<p class="mt-4">Tidak ada acara yang belum selesai.</p>';
    }
    ?>

    <!-- Menampilkan daftar acara yang sudah selesai -->
    <h2 class="mt-4">Daftar Acara yang Sudah Selesai</h2>
    <?php
    if ($resultSelesai->num_rows > 0) {
      while ($row = $resultSelesai->fetch_assoc()) {
        echo '<div class="card mt-4">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $row['nama_acara'] . '</h5>';
        echo '<p class="card-text">' . $row['deskripsi'] . '</p>';
        echo '<p class="card-text">Tanggal: ' . $row['date'] . '</p>';
        echo '<p class="card-text">Lokasi: ' . $row['lokasi'] . '</p>';
        echo '<p class="card-text">Jumlah Pengikut: ' . $row['jumlah_pengikut'] . '</p>';
        echo '<p class="card-text text-success">Status: Sudah Selesai</p>';
        echo '</div>';
        echo '</div>';
      }
    } else {
      echo '<p>Tidak ada acara yang sudah selesai.</p>';
    }
    ?>
  </div>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>