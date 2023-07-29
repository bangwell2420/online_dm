
<?php
session_start();

// Koneksi ke database
require_once 'koneksi.php';
require_once 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $userData = loginUser($conn, $username, $password);

    if ($userData !== null) {
        // Login berhasil
        $_SESSION['username'] = $userData['username'];
        $_SESSION['role'] = $userData['role'];

        // Arahkan ke halaman role masing-masing
        redirectAfterLogin($_SESSION['role']);
    } else {
        echo "<script>alert('Username atau Password salah.');</script>";
        // Arahkan kembali ke halaman login jika login gagal
        header('Location: login.php');
    }
}
?>
