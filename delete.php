<?php
include "config/db.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM pesanan WHERE id=$id";
    if (mysqli_query($koneksi, $sql)) {
        header("Location: admin.php?msg=deleted");
        exit();
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
} else {
    header("Location: admin.php");
    exit();
}
?>
