<?php
// Koneksi
include 'config/db.php';

// Ambil daftar paket (sementara hardcode, bisa dari tabel paket)
$paket = [
  ["id" => 1, "nama" => "Silver", "deskripsi" => "Dekorasi sederhana + dokumentasi", "harga" => "9.500.000", "gambar" => "assets/silver.jpg"],
  ["id" => 2, "nama" => "Gold", "deskripsi" => "Dekorasi mewah + dokumentasi + MC", "harga" => "15.000.000", "gambar" => "assets/gold.jpg"],
  ["id" => 3, "nama" => "Platinum", "deskripsi" => "Dekorasi premium + dokumentasi + MC + hiburan", "harga" => "25.000.000", "gambar" => "assets/platinum.jpg"],
];
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Jewepe WO - Home</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      padding: 0;
      background: linear-gradient(135deg, #fff0f6, #ffe0ec, #fff5f7);
    }

    header {
      text-align: center;
      padding: 30px 20px;
      background: #b03060;
      color: white;
      border-radius: 0 0 30px 30px;
    }

    header h1 { margin: 0; font-size: 2.2rem; }
    header p { margin-top: 8px; font-size: 1.1rem; }

    .paket-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 20px;
      width: 90%;
      margin: 30px auto;
    }

    .paket {
      background: white;
      border-radius: 15px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      padding: 15px;
      text-align: center;
      transition: transform 0.2s;
    }

    .paket:hover { transform: translateY(-5px); }

    .paket img {
      width: 100%;
      border-radius: 12px;
    }

    .paket h3 { color: #b03060; margin: 10px 0 5px; }
    .paket p { font-size: 0.95rem; margin: 5px 0; }

    .harga { font-weight: bold; color: #d14791; font-size: 1.1rem; }

    .btn {
      display: inline-block;
      margin-top: 10px;
      padding: 10px 18px;
      background: #ff69b4;
      color: white;
      text-decoration: none;
      border-radius: 25px;
      transition: 0.3s;
    }

    .btn:hover { background: #d14791; }
  </style>
</head>
<body>

<header>
  <h1>💍 Jewepe Wedding Organizer</h1>
  <p>Bikin momen spesial kamu jadi tak terlupakan ✨</p>
</header>

<!-- Paket Grid -->
<div class="paket-container">
  <?php foreach ($paket as $p) { ?>
    <div class="paket">
      <img src="<?= $p['gambar']; ?>" alt="Paket <?= $p['nama']; ?>">
      <h3>Paket <?= $p['nama']; ?></h3>
      <p><?= $p['deskripsi']; ?></p>
      <p class="harga">Rp <?= $p['harga']; ?></p>
      <a href="pesan.php?paket=<?= $p['id']; ?>" class="btn">Pesan Sekarang</a>
    </div>
  <?php } ?>
</div>

</body>
</html>
