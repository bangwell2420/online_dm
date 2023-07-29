<?php
function hashPassword($password) {
    // Menggunakan fungsi password_hash() bawaan PHP untuk mengenkripsi kata sandi.
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    return $hashedPassword;
}

function isEmailExists($conn, $email) {
    $email = mysqli_real_escape_string($conn, $email);
    $sql = "SELECT * FROM tabel_pengguna WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    return mysqli_num_rows($result) > 0;
}

function isUsernameExists($conn, $username) {
    $username = mysqli_real_escape_string($conn, $username);
    $sql = "SELECT * FROM tabel_pengguna WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    return mysqli_num_rows($result) > 0;
}

function generateUniqueEmail($conn, $email) {
    $count = 0;
    $originalEmail = $email;
    while (isEmailExists($conn, $email)) {
        $count++;
        $email = $originalEmail . $count;
    }
    return $email;
}

function generateUniqueUsername($conn, $username) {
    $count = 0;
    $originalUsername = $username;
    while (isUsernameExists($conn, $username)) {
        $count++;
        $username = $originalUsername . $count;
    }
    return $username;
}

function registerUser($conn, $email, $username, $namaLengkap, $nomorTelepon, $password, $role) {
    // Konversi kata sandi menjadi hash.
    $hashedPassword = hashPassword($password);

    // Lakukan operasi INSERT ke tabel pengguna di database.
    $email = mysqli_real_escape_string($conn, $email);
    $username = mysqli_real_escape_string($conn, $username);
    $namaLengkap = mysqli_real_escape_string($conn, $namaLengkap);
    $nomorTelepon = mysqli_real_escape_string($conn, $nomorTelepon);
    $role = mysqli_real_escape_string($conn, $role);
    $sql = "INSERT INTO tabel_pengguna (email, username, nama_lengkap, nomor_telepon, password, role) VALUES ('$email', '$username', '$namaLengkap', '$nomorTelepon', '$hashedPassword', '$role')";

    if (mysqli_query($conn, $sql)) {
        return true; // Registrasi berhasil.
    } else {
        return false; // Registrasi gagal.
    }
}

function loginUser($conn, $username, $password) {
    $username = mysqli_real_escape_string($conn, $username);
    $sql = "SELECT * FROM tabel_pengguna WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        $hashedPassword = $row['password'];

        if (password_verify($password, $hashedPassword)) {
            return $row; // Login berhasil, kembalikan data pengguna
        }
    }

    return null; // Login gagal
}

function redirectAfterLogin() {
    setcookie('user_logged_in', '1', time() + (86400 * 30), "/"); // Cookie berlaku selama 30 hari
    // Tidak perlu menggunakan $userData di sini, karena $_SESSION sudah berisi data pengguna.
    switch ($_SESSION['role']) {
        case 'admin':
            header('Location: admin/dashboard.php');
            break;
        case 'user':
            header('Location: user_dashboard.php');
            break;
        default:
            header('Location: login.php');
            break;
    }

    exit();
}

function tambahDataTopUp($conn, $namaGame, $totalDM, $harga) {
    $namaGame = mysqli_real_escape_string($conn, $namaGame);
    $totalDM = (int) $totalDM;
    $harga = (int) $harga;

    $sql = "INSERT INTO mn_topup (nama_game, total_dm, harga) VALUES ('$namaGame', $totalDM, $harga)";

    return mysqli_query($conn, $sql);
}
?>
