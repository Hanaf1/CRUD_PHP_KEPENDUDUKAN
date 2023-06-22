<?php
// signup.php

// Menghubungkan ke file koneksi.php
require_once 'koneksi.php';

// Define variables for error handling
$usernameErr = $passwordErr = "";
$hasError = false;

// Define success message
$successMsg = "";

// Memeriksa apakah ada data yang dikirim melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST["username"];
  $password = $_POST["password"];
  $role = "user"; // Set role sebagai "user" untuk pendaftaran pengguna

  // Validate username
  if (empty($username)) {
    $usernameErr = "Username is required";
    $hasError = true;
  }

  // Validate password
  if (empty($password)) {
    $passwordErr = "Password is required";
    $hasError = true;
  }

  // If there are no errors, proceed with registration
  if (!$hasError) {
    // Prepare statement
    $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $password, $role);

    if ($stmt->execute()) {
      $successMsg = "Registration successful!";
      $stmt->close();
      $conn->close();
    } else {
      echo "Error: " . $stmt->error;
    }
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Pendaftaran Pengguna</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
  <div class="container">
    <h1 class="mt-4">Pendaftaran Pengguna</h1>

    <?php if (!empty($successMsg)) : ?>
      <div class="alert alert-success mt-4"><?php echo $successMsg; ?></div>
    <?php else : ?>
      <form action="signup.php" method="POST">
        <div class="form-group">
          <label for="username">Username:</label>
          <input type="text" name="username" class="form-control" required>
          <?php if (!empty($usernameErr)) : ?>
            <div class="alert alert-danger mt-1"><?php echo $usernameErr; ?></div>
          <?php endif; ?>
        </div>

        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" name="password" class="form-control" required>
          <?php if (!empty($passwordErr)) : ?>
            <div class="alert alert-danger mt-1"><?php echo $passwordErr; ?></div>
          <?php endif; ?>
        </div>

        <button type="submit" class="btn btn-primary">Daftar</button>
      </form>
    <?php endif; ?>

    <p class="mt-2">Sudah punya akun? <a href="login.php">Login</a></p>
  </div>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>