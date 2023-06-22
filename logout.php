<?php
// Muhammad Nor Hanafi 202251069 B
// Mulai session
session_start();

// Menghapus semua data session
session_destroy();

// Redirect ke halaman login
header("Location: login.php");
exit();
