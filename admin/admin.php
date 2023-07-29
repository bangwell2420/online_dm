<!-- Halaman Tambah Data Top Up (tambah_data_topup.php) -->
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Top Up</title>
</head>
<body>
    <h2>Tambah Data Top Up</h2>
    <form method="post" action="../proses.php">
        <select name="nama_game" id="nama_game">
            <option value="Mobile Legends">Mobile Legends</option>
            <option value="COC">COC</option>
            <option value="FF">FF</option>
        </select><br>
        <input type="number" name="total_dm" placeholder="Total DM" required><br>
        <input type="number" name="harga" placeholder="Harga" required><br>
        <input type="submit" value="Tambah Data"><br>
        <a href="dashboard.php">Kembali</a>
    </form>
</body>
</html>
