<?php
include "config/db.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "UPDATE pesanan SET status='approved' WHERE id=$id";
    if (mysqli_query($koneksi, $sql)) {
        header("Location: admin.php?msg=approved");
        exit();
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
} else {
    header("Location: admin.php");
    exit();
}
?>
