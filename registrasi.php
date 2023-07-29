
<?php
// Include file koneksi dan functions
require_once 'koneksi.php';
require_once 'functions.php';

// Proses form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $namaLengkap = $_POST['nama_lengkap'];
    $nomorTelepon = $_POST['nomor_telepon'];
    $password = $_POST['password'];
    $konfirmasiPassword = $_POST['konfirmasi_password'];
    $role = $_POST['role'];
    // Validasi jika kata sandi dan konfirmasi kata sandi cocok
    if ($password !== $konfirmasiPassword) {
        echo "<script>alert('Konfirmasi kata sandi tidak cocok.');</script>";
    } else {
        // Periksa apakah email dan username sudah ada di database, jika iya, beri notifikasi.
        if (isEmailExists($conn, $email)) {
            echo "<script>alert('Email sudah terdaftar. Silakan gunakan email lain atau login dengan email tersebut.');</script>";
        } elseif (isUsernameExists($conn, $username)) {
            echo "<script>alert('Username telah digunakan. Silakan gunakan username lain.');</script>";
        } else {
            // Registrasi pengguna
            $result = registerUser($conn, $email, $username, $namaLengkap, $nomorTelepon, $password, $role);

            if ($result) {
                // Registrasi berhasil, arahkan ke halaman login
                echo "<script>alert('Registrasi berhasil!'); window.location.href = 'login.php';</script>";
                exit(); // Hentikan eksekusi lebih lanjut untuk mencegah rendering halaman registrasi lagi.
            } else {
                // Registrasi gagal, kembali ke halaman registrasi
                echo "<script>alert('Registrasi gagal. Silakan coba lagi.');</script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registrasi</title>
</head>
<body>
    <h2>Form Registrasi</h2>
    <form method="post" action="">
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="text" name="nama_lengkap" placeholder="Nama Lengkap" required><br>
        <input type="tel" name="nomor_telepon" placeholder="Nomor Telepon" required><br>
        <input type="password" name="password" placeholder="Kata Sandi" required><br>
        <input type="password" name="konfirmasi_password" placeholder="Konfirmasi Kata Sandi" required><br>
        <select name="role" id="role">
            <option value="admin">Admin</option>
            <option value="user">User</option>
        </select>
        <input type="submit" value="Daftar">
    </form>
</body>
</html>
