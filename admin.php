<?php
include "config/db.php";
$result = mysqli_query($koneksi, "SELECT * FROM pesanan ORDER BY tanggal DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Admin Panel - Pesanan</title>
  <style>
    body { font-family: Arial, sans-serif; background: #f8f8f8; }
    .container { width: 90%; margin: 20px auto; background: #fff; padding: 20px; border-radius: 10px; }
    h2 { color: #a83279; }
    table { width: 100%; border-collapse: collapse; margin-top: 15px; }
    th, td { border: 1px solid #ddd; padding: 10px; text-align: center; }
    th { background: #f3d6e5; }
    .btn { padding: 5px 12px; border-radius: 5px; text-decoration: none; font-size: 14px; }
    .btn-approve { background: #28a745; color: #fff; }
    .btn-approve:hover { background: #218838; }
    .btn-delete { background: #dc3545; color: #fff; }
    .btn-delete:hover { background: #c82333; }
    .badge { padding: 5px 8px; border-radius: 4px; font-size: 13px; }
    .approved { background: #28a745; color: #fff; }
    .request { background: #ffc107; color: #000; }
  </style>
</head>
<body>
  <div class="container">
    <h2>📋 Panel Admin - Daftar Pesanan</h2>
    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>Email</th>
          <th>Telepon</th>
          <th>Paket</th>
          <th>Status</th>
          <th>Tanggal</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $no = 1;
        while ($row = mysqli_fetch_assoc($result)) { ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= htmlspecialchars($row['nama']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= htmlspecialchars($row['telepon']) ?></td>
            <td><?= htmlspecialchars($row['paket_id']) ?></td>
            <td>
              <?php if ($row['status'] == 'approved') { ?>
                <span class="badge approved">Approved</span>
              <?php } else { ?>
                <span class="badge request">Request</span>
              <?php } ?>
            </td>
            <td><?= $row['tanggal'] ?></td>
            <td>
              <?php if ($row['status'] == 'request') { ?>
                <a href="approve.php?id=<?= $row['id'] ?>" 
                   onclick="return confirm('Yakin approve pesanan ini?')" 
                   class="btn btn-approve">Approve</a>
              <?php } ?>
              <a href="delete.php?id=<?= $row['id'] ?>" 
                 onclick="return confirm('Yakin hapus pesanan ini?')" 
                 class="btn btn-delete">Delete</a>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</body>
</html>
