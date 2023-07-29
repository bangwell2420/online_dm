<?php
session_start();

// Koneksi ke database
require_once '../koneksi.php';
require_once 'function.php';

if (isset($_GET['game'])) {
    $gameName = $_GET['game'];
    $gameData = getGameDetail($conn, $gameName);

    if ($gameData !== null) {
        $totalDM = $gameData['total_dm'];
        $harga = $gameData['harga'];
    } else {
        // Redirect jika nama game tidak valid
        header('Location: user_dashboard.php');
        exit();
    }
} else {
    // Redirect jika tidak ada data game yang dipilih
    header('Location: user_dashboard.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $gameName; ?> Detail</title>
</head>
<body>
    <h2>Detail Game: <?php echo $gameName; ?></h2>
    <table border="1">
        <tr>
            <th>Total DM</th>
            <th>Harga</th>
            <th>Pesan</th>
        </tr>
        <tr>
            <td><?php echo $totalDM; ?></td>
            <td><?php echo $harga; ?></td>
            <td><?php echo createOrderButton($gameName); ?></td>
        </tr>
    </table>
</body>
</html>
