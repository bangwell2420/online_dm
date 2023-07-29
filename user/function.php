
<?php
// ... Kode fungsi-fungsi sebelumnya ...

function getGameDetail($conn, $gameName) {
    $gameName = mysqli_real_escape_string($conn, $gameName);
    $sql = "SELECT total_dm, harga FROM mn_topup WHERE nama_game = '$gameName' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    } else {
        return null;
    }
}
function getGames($conn) {
    $sql = "SELECT DISTINCT nama_game FROM mn_topup";
    $result = mysqli_query($conn, $sql);

    $games = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $games[] = $row;
    }

    return $games;
}
function createOrderButton($gameName) {
    return "<form method='post' action='proses_pemesanan.php'>
                <input type='hidden' name='game_name' value='$gameName'>
                <input type='submit' value='Pesan'>
            </form>";
}
?>
