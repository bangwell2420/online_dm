<?php
session_start();

// Koneksi ke database
require_once '../koneksi.php';
require_once 'function.php';

// Ambil data game dari database
$games = getGames($conn);
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
</head>
<body>
    <h2>Selamat datang, <?php echo $_SESSION['username']; ?>!</h2>
    <h3>Daftar Game</h3>
    <ul>
        <?php
        foreach ($games as $game) {
            $gameName = $game['nama_game'];
            echo "<li><a href='game_detail.php?game=$gameName'>$gameName</a></li>";
        }
        ?>
    </ul>
</body>
</html>