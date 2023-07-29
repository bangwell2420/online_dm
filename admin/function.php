<?php

function getDataTopUp($conn) {
    $sql = "SELECT * FROM mn_topup";
    $result = mysqli_query($conn, $sql);

    $topups = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $topups[] = $row;
    }

    return $topups;
}
?>