
<html>
<head>
  <title>Aplikasi CRUD dengan PHP</title>
</head>
<body>
  <h1>Tambah Data Kantin</h1>
  <form method="post" action="proses_simpan.php" enctype="multipart/form-data">
    <table cellpadding="8">
      <tr>
        <td>Nama</td>
        <td><input type="text" name="nama"></td>
      </tr>
      <tr>
        <td>Harga</td>
        <td><input type="number" name="harga"></td>
      </tr>
      <tr>
        <td>Stok</td>
        <td><input type="number" name="stok" ></td>
      </tr>
      <tr>
        <td>Deskripsi</td>
        <td><textarea name="deskripsi"></textarea></td>
      </tr>
      <tr>
        <td>Tanggal Input</td>
        <td><input type="datetime-local" name="tanggal_input" ></td>
      </tr>
      <tr>
        <td>kategori</td>
        <td>
        <input type="radio" name="kategori" value="Makanan"> Makanan
        <input type="radio" name="kategori" value="Minuman"> Minuman
        </td>
      </tr>
      <tr>
        <td>Foto</td>
        <td>
          <input type="file" name="foto_url">
        </td>
      </tr>
    </table>
    <hr>
    <input type="submit" value="Simpan">
  <a href="index.php"><input type="button" value="Batal"></a>
  </form>
</body>
</html>