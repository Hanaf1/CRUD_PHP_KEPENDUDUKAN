<?php

// Menghubungkan ke file koneksi.php
require 'koneksi.php';

// Mulai session
session_start();

// Memeriksa apakah ada data yang dikirim melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST["username"];
  $password = $_POST["password"];

  // Melakukan query untuk memeriksa pengguna di database
  $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
  $result = $conn->query($sql);

  if ($result->num_rows == 1) {
    // Pengguna ditemukan, set session username
    $_SESSION['username'] = $username;

    // Memeriksa role pengguna
    $row = $result->fetch_assoc();
    $role = $row['role'];

    // Set session role
    $_SESSION['role'] = $role;

    // Mengarahkan pengguna ke halaman sesuai role
    if ($role == 'admin') {
      header("Location: admin.php");
      exit();
    } else {
      header("Location: user.php");
      exit();
    }
  } else {
    // Pengguna tidak ditemukan
    $error = "Username atau password salah. atau juga anda belum punya akun";
  }
}


?>

<!DOCTYPE html>
<html>

<head>
  <title>Peta Kegiatan Sosial - Login</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
  <div class="container">
    <h1 class="mt-4">Peta Kegiatan Sosial - Login</h1>

    <div class="row">
      <div class="col-md-6">
        <form method="POST">
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
          </div>

          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>

          <?php if (isset($error)) : ?>
            <div class="alert alert-danger" role="alert">
              <?php echo $error; ?>
            </div>
          <?php endif; ?>

          <div class="d-flex justify-content-between align-items-center">
            <button type="submit" class="btn btn-primary">Login</button>
            <a href="signup.php" class="btn btn-secondary">Daftar</a>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>