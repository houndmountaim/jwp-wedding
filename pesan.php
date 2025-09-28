<?php include "config/db.php"; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Pesan Paket - Jewepe WO</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(135deg, #fff0f6, #ffe0ec, #fff5f7);
      margin: 0; padding: 0;
    }
    .container {
      width: 90%; max-width: 500px;
      margin: 60px auto;
      background: #fff;
      padding: 25px;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    h2 { text-align: center; color: #b03060; margin-bottom: 20px; }
    label { display: block; margin-top: 12px; font-weight: bold; }
    input, select {
      width: 100%; padding: 10px;
      border: 1px solid #ccc; border-radius: 8px;
      margin-top: 5px;
    }
    button {
      margin-top: 20px;
      width: 100%;
      padding: 12px;
      background: #ff69b4; border: none;
      border-radius: 25px; color: #fff;
      font-size: 1rem; font-weight: bold;
      cursor: pointer;
      transition: 0.3s;
    }
    button:hover { background: #d14791; }
  </style>
</head>
<body>
  <div class="container">
    <h2>Pesan Paket</h2>
    <form id="formPesan">
      <label>Nama Lengkap</label>
      <input type="text" name="nama" required>

      <label>Email</label>
      <input type="email" name="email" required>

      <label>No. Telepon</label>
      <input type="text" name="telepon" required>

      <label>Pilih Paket</label>
<select name="paket_id" required>
    <option value="1">Paket Silver</option>
    <option value="2">Paket Gold</option>
    <option value="3">Paket Platinum</option>
</select>


      <button type="submit">Pesan Sekarang</button>
    </form>
  </div>

  <script>
    $(document).ready(function(){
      $("#formPesan").on("submit", function(e){
        e.preventDefault();
        $.ajax({
          url: "simpan_pesan.php",
          type: "POST",
          data: $(this).serialize(),
          success: function(response){
            Swal.fire({
              icon: "success",
              title: "Pesanan Berhasil!",
              text: "Admin akan segera menghubungi kamu.",
              confirmButtonColor: "#ff69b4"
            });
            $("#formPesan")[0].reset(); // reset form setelah submit
          },
          error: function(){
            Swal.fire({
              icon: "error",
              title: "Oops...",
              text: "Terjadi kesalahan, coba lagi nanti!"
            });
          }
        });
      });
    });
  </script>
</body>
</html>
