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

function registerUser($conn, $email, $username, $namaLengkap, $nomorTelepon, $password) {
    // Konversi kata sandi menjadi hash.
    $hashedPassword = hashPassword($password);

    // Lakukan operasi INSERT ke tabel pengguna di database.
    $email = mysqli_real_escape_string($conn, $email);
    $username = mysqli_real_escape_string($conn, $username);
    $namaLengkap = mysqli_real_escape_string($conn, $namaLengkap);
    $nomorTelepon = mysqli_real_escape_string($conn, $nomorTelepon);
    $sql = "INSERT INTO tabel_pengguna (email, username, nama_lengkap, nomor_telepon, password) VALUES ('$email', '$username', '$namaLengkap', '$nomorTelepon', '$hashedPassword')";

    if (mysqli_query($conn, $sql)) {
        return true; // Registrasi berhasil.
    } else {
        return false; // Registrasi gagal.
    }
}
?>
