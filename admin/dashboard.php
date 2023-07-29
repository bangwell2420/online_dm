<?php

session_start();

if (!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
    // Jika belum login, arahkan ke halaman login
    header('Location: ../login.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Top Up</title>
</head>
<body>
    <h2>Data Top Up</h2>
    <a href="../logout.php">Log Out</a>
    <table border="1">
        <tr>
            <th>No</th>
            <th>Nama Game</th>
            <th>Total DM</th>
            <th>Harga</th>
        </tr>

        <?php
        // Koneksi ke database
        require_once '../koneksi.php';
        require_once 'function.php';


        $topups = getDataTopUp($conn);

        $no = 1;
        foreach ($topups as $topup) {
            echo "<tr>";
            echo "<td>" . $no++ . "</td>";
            echo "<td>" . $topup['nama_game'] . "</td>";
            echo "<td>" . $topup['total_dm'] . "</td>";
            echo "<td>" . $topup['harga'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
    <a href="admin.php">Tambah Data</a>
</body>
</html>
