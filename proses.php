
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
        redirectAfterLogin();
    } else {
        echo "<script>alert('Username atau Password salah.');</script>";
        // Arahkan kembali ke halaman login jika login gagal
        header('Location: login.php');
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $namaGame = $_POST['nama_game'];
    $totalDM = $_POST['total_dm'];
    $harga = $_POST['harga'];

    $result = tambahDataTopUp($conn, $namaGame, $totalDM, $harga);

    if ($result) {
        echo "<script>alert('Data Top Up berhasil ditambahkan!');</script>";
    } else {
        echo "<script>alert('Gagal menambahkan Data Top Up. Silakan coba lagi.');</script>";
    }

    // Arahkan kembali ke halaman tambah_data_topup.php setelah proses penambahan data
    header('Location: admin/admin.php');
}


session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $gameName = $_POST['game_name'];

    // Lakukan proses pemesanan sesuai kebutuhan, misalnya menyimpan data ke database
    // ...

    echo "<script>alert('Pemesanan untuk $gameName berhasil!');</script>";
    header('Location: user_dashboard.php');
    exit();
} else {
    // Redirect jika tidak ada data pemesanan yang diterima
    header('Location: user_dashboard.php');
    exit();
}

?>
