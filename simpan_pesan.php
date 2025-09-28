<?php
include "config/db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama     = $_POST['nama'];
    $email    = $_POST['email'];
    $telepon  = $_POST['telepon'];
    $paket    = $_POST['paket_id']; // ini kita anggap langsung nama paket

    $sql = "INSERT INTO pesanan (nama, email, telepon, paket_id, status, tanggal)
            VALUES ('$nama', '$email', '$telepon', '$paket', 'request', NOW())";

    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        http_response_code(500);
        echo "error: " . $conn->error;
    }
}
?>
