
<html>
<head>
  <title>Aplikasi CRUD dengan PHP</title>
</head>
<body>
  <h1>Ubah Data Kantin</h1>
  <?php
  // Load file koneksi.php
  include "koneksi.php";
  // Ambil data NIS yang dikirim oleh index.php melalui URL
  $id = $_GET['id'];
  // Query untuk menampilkan data siswa berdasarkan ID yang dikirim
  $sql = $pdo->prepare("SELECT * FROM barang WHERE id=:id");
  $sql->bindParam(':id', $id);
  $sql->execute(); // Eksekusi query insert
  $data = $sql->fetch(); // Ambil semua data dari hasil eksekusi $sql
  ?>
  <form method="post" action="proses_ubah.php?id=<?php echo $id; ?>" enctype="multipart/form-data">
    <table cellpadding="8">
      <tr>
        <td>Nama</td>
        <td><input type="text" name="nama" value="<?php echo $data['nama']; ?>"></td>
      </tr>
      <tr>
        <td>Harga</td>
        <td><input type="number" name="harga" value="<?php echo $data['harga']; ?>"></td>
      </tr>
      <tr>
        <td>Deskripsi</td>
        <td><textarea name="deskripsi"><?php echo $data['deskripsi']; ?></textarea></td>
      </tr>
      <tr>
        <td>Kategori</td>
        <td>
        <?php
        if($data['kategori'] == "Makanan"){
          echo "<input type='radio' name='kategori' value='makanan' checked='checked'> makanan";
          echo "<input type='radio' name='kategori' value='minuman'> minuman";
        }else{
          echo "<input type='radio' name='kategori' value='makanan'> makanan";
          echo "<input type='radio' name='kategori' value='minuman' checked='checked'> minuman";
        }
        ?>
        </td>
      </tr>
      <tr>
        <td>Stok</td>
        <td><input type="number" name="stok" value="<?php echo $data['stok']; ?>"></td>
      </tr>
      <tr>
        <td>Tanggal Input</td>
        <td><input type="datetime-local" name="tanggal_input" value="<?php echo $data['tanggal_input']; ?>"></td>
      </tr>
      <tr>
        <td>Foto</td>
        <td>
          <input type="file" name="foto_url">
        </td>
      </tr>
    </table>
    <hr>
    <input type="submit" value="Ubah">
    <a href="index.php"><input type="button" value="Batal"></a>
  </form>
</body>

