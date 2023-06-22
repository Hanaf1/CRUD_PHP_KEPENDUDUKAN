<?php
// Muhammad Nor Hanafi 202251069 B
session_start();
?>

<!DOCTYPE html>
<html>

<head>
  <title>Peta Kegiatan Sosial</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
  <div class="container">
    <h1 class="mt-4">Peta Kegiatan Sosial</h1>

    <h2 class="mt-4">Halo, <?php echo $_SESSION['username']; ?>!</h2>

    <p><a href="logout.php">Logout</a></p>

    <!-- Form untuk membuat acara baru -->
    <?php if ($_SESSION['role'] === 'admin') { ?>
      <h2 class="mt-4">Buat Acara Baru</h2>
      <form action="tambah_acara.php" method="POST">
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
        <button type="submit" class="btn btn-primary">Tambah Acara</button>
      </form>
    <?php } ?>

    <!-- Menampilkan daftar acara yang belum selesai -->
    <h2 class="mt-4">Daftar Acara yang Belum Selesai</h2>
    <?php
    require 'koneksi.php'; // Include the database connection file

    // Perform the database query to retrieve event data
    $sql = "SELECT * FROM event_social WHERE selesai = 0"; // Assuming 'selesai' column represents the completion status
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo "<div class='card mt-4'>";
        echo "<div class='card-body'>";
        echo "<h5 class='card-title'>" . $row['nama_acara'] . "</h5>";
        echo "<p class='card-text'>Deskripsi: " . $row['deskripsi'] . "</p>";
        echo "<p class='card-text'>Tanggal: " . $row['date'] . "</p>";
        echo "<p class='card-text'>Lokasi: " . $row['lokasi'] . "</p>";

        // Tombol untuk menandai acara sebagai selesai
        echo "<form action='' method='POST' class='d-inline-block'>";
        echo "<input type='hidden' name='selesai' value='" . $row['id'] . "'>";
        echo "<button type='submit' class='btn btn-success'>Selesai</button>";
        echo "</form>";

        // Tombol untuk mengedit acara
        if ($_SESSION['role'] === 'admin') {
          echo "<a href='edit_acara.php?id=" . $row['id'] . "' class='btn btn-primary'>Edit</a>";
        }

        // Tombol untuk menghapus acara
        if ($_SESSION['role'] === 'admin') {
          echo "<form action='' method='POST' class='d-inline-block'>";
          echo "<input type='hidden' name='hapus' value='" . $row['id'] . "'>";
          echo "<button type='submit' class='btn btn-danger'>Hapus</button>";
          echo "</form>";
        }

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
    $sql = "SELECT * FROM event_social WHERE selesai = 1"; // Assuming 'selesai' column represents the completion status
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo "<div class='card mt-4'>";
        echo "<div class='card-body'>";
        echo "<h5 class='card-title'>" . $row['nama_acara'] . "</h5>";
        echo "<p class='card-text'>Deskripsi: " . $row['deskripsi'] . "</p>";
        echo "<p class='card-text'>Tanggal: " . $row['date'] . "</p>";
        echo "<p class='card-text'>Lokasi: " . $row['lokasi'] . "</p>";
        echo "<p class='text-success'>Acara Selesai</p>";
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