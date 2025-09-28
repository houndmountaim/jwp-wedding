<?php
// Koneksi database
$conn = new mysqli("localhost", "root", "", "jewepe_wo");

// Error handling
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Proses Approve
if (isset($_GET['approve'])) {
    $id = intval($_GET['approve']);
    $conn->query("UPDATE pesanan SET status='approved' WHERE id=$id");
    header("Location: index.php");
    exit;
}

// Proses Delete
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM pesanan WHERE id=$id");
    header("Location: index.php");
    exit;
}

// Filter status + join ke tabel katalog
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';

if ($filter == 'approved') {
    $result = $conn->query("
        SELECT p.*, k.nama_paket 
        FROM pesanan p
        JOIN katalog k ON p.paket_id = k.id
        WHERE p.status='approved'
        ORDER BY p.id DESC
    ");
} elseif ($filter == 'request') {
    $result = $conn->query("
        SELECT p.*, k.nama_paket 
        FROM pesanan p
        JOIN katalog k ON p.paket_id = k.id
        WHERE p.status='request'
        ORDER BY p.id DESC
    ");
} else {
    $result = $conn->query("
        SELECT p.*, k.nama_paket 
        FROM pesanan p
        JOIN katalog k ON p.paket_id = k.id
        ORDER BY p.id DESC
    ");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Jewepe Wedding Organizer</title>
  <style>
    /* ====== Global Style ====== */
    body {
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      padding: 0;
      background: linear-gradient(135deg, #fff0f6, #ffe0ec, #fff5f7);
      color: #333;
    }

    h1 {
      text-align: center;
      font-size: 2.5rem;
      color: #b03060;
      margin-top: 20px;
    }

    h1 i { margin-right: 10px; }

    p {
      text-align: center;
      font-size: 1.1rem;
      margin-bottom: 30px;
    }

    a.btn {
      display: inline-block;
      margin: 10px auto;
      padding: 10px 20px;
      background: #ff69b4;
      color: white;
      text-decoration: none;
      border-radius: 25px;
      font-weight: bold;
      transition: 0.3s;
    }

    a.btn:hover { background: #d14791; }

    /* ====== Grid Paket ====== */
    .paket-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 20px;
      width: 90%;
      margin: 20px auto;
    }

    .paket {
      background: white;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      padding: 15px;
      text-align: center;
      transition: transform 0.2s;
    }

    .paket:hover { transform: translateY(-5px); }

    .paket img {
      width: 100%;
      border-radius: 10px;
    }

    .paket h3 {
      margin: 15px 0 5px;
      color: #b03060;
    }

    /* ====== Tabel Pesanan ====== */
    .tabel-container {
      width: 95%;
      margin: 40px auto;
      background: white;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      padding: 20px;
    }

    .tabel-container h2 {
      margin-bottom: 15px;
      color: #b03060;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      font-size: 0.95rem;
    }

    table th, table td {
      border: 1px solid #f3c1d3;
      padding: 10px;
      text-align: center;
    }

    table th {
      background: #ffe6f0;
      color: #b03060;
    }

    table tr:nth-child(even) { background: #fff5fa; }

    table tr:hover { background: #ffe0ec; transition: 0.3s; }

    /* ====== Badge ====== */
    .badge {
      padding: 5px 10px;
      border-radius: 6px;
      font-weight: bold;
      font-size: 0.85rem;
    }
    .approved { background: #28a745; color: #fff; }
    .request { background: #ffc107; color: #000; }

    /* ====== Tombol Aksi ====== */
    .btn-action {
      padding: 5px 10px;
      border-radius: 6px;
      text-decoration: none;
      font-size: 0.85rem;
      margin: 2px;
      display: inline-block;
    }
    .btn-approve { background: #28a745; color: #fff; }
    .btn-delete { background: #dc3545; color: #fff; }
    .btn-approve:hover { background: #1e7e34; }
    .btn-delete:hover { background: #a71d2a; }

    /* ====== Filter ====== */
    .filter {
      margin-bottom: 15px;
    }
    .filter select {
      padding: 6px 10px;
      border-radius: 8px;
      border: 1px solid #ccc;
    }
  </style>
</head>
<body>

  <h1><i>💍</i> Jewepe Wedding Organizer</h1>
  <p>Bikin momen spesial kamu jadi tak terlupakan ✨</p>
  <div style="text-align:center;">
    <!-- <a href="home.php" class="btn">Halaman User</a> -->
  </div>

  <!-- Paket Grid -->
  <div class="paket-container">
    <div class="paket">
      <img src="assets/silver.jpg" alt="Paket Silver">
      <h3>Paket Silver</h3>
      <p>Dekorasi sederhana + dokumentasi</p>
      <p><b>Rp 9.500.000</b></p>
    </div>

    <div class="paket">
      <img src="assets/silver.jpg" alt="Paket Gold">
      <h3>Paket Gold</h3>
      <p>Dekorasi mewah + dokumentasi + MC</p>
      <p><b>Rp 15.000.000</b></p>
    </div>

    <div class="paket">
      <img src="assets/silver.jpg" alt="Paket Platinum">
      <h3>Paket Platinum</h3>
      <p>Dekorasi premium + dokumentasi + MC + hiburan</p>
      <p><b>Rp 25.000.000</b></p>
    </div>
  </div>

  <!-- Tabel Pesanan -->
  <div class="tabel-container">
    <h2>📋 Daftar Pesanan Terbaru</h2>

    <!-- Filter -->
    <form method="get" class="filter">
      <label for="filter">Filter Status: </label>
      <select name="filter" id="filter" onchange="this.form.submit()">
        <option value="all" <?php if($filter=='all') echo 'selected'; ?>>Semua</option>
        <option value="request" <?php if($filter=='request') echo 'selected'; ?>>Request</option>
        <option value="approved" <?php if($filter=='approved') echo 'selected'; ?>>Approved</option>
      </select>
    </form>

    <table>
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
      <?php
      $no = 1;
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<tr>
                  <td>".$no++."</td>
                  <td>".htmlspecialchars($row['nama'])."</td>
                  <td>".htmlspecialchars($row['email'])."</td>
                  <td>".htmlspecialchars($row['telepon'])."</td>
                  <td>".htmlspecialchars($row['nama_paket'])."</td>
                  <td>";
                    if ($row['status'] == 'approved') {
                      echo "<span class='badge approved'>Approved</span>";
                    } else {
                      echo "<span class='badge request'>Request</span>";
                    }
          echo     "</td>
                  <td>".$row['tanggal']."</td>
                  <td>";
                    if ($row['status'] != 'approved') {
                      echo "<a href='?approve=".$row['id']."' class='btn-action btn-approve'>Approve</a>";
                    }
                    echo "<a href='?delete=".$row['id']."' class='btn-action btn-delete' onclick=\"return confirm('Yakin hapus pesanan ini?')\">Delete</a>";
          echo     "</td>
                </tr>";
        }
      } else {
        echo "<tr><td colspan='8'>Belum ada pesanan</td></tr>";
      }
      ?>
    </table>
  </div>

</body>
</html>
