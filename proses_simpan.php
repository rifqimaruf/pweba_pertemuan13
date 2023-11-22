<?php
// Load file koneksi.php
include "koneksi.php";
// Ambil Data yang Dikirim dari Form
$nama = $_POST['nama'];
$harga = $_POST['harga'];
$deskripsi = $_POST['deskripsi'];
$stok = $_POST['stok'];
$tanggal_input = $_POST['tanggal_input'];
$kategori = $_POST['kategori'];
$foto = $_FILES['foto_url']['name'];
$tmp = $_FILES['foto_url']['tmp_name'];
// Rename nama fotonya dengan menambahkan tanggal dan jam upload
$fotobaru = date('dmYHis').$foto;
// Set path folder tempat menyimpan fotonya
$path = "images/".$fotobaru;
// Proses upload
if(move_uploaded_file($tmp, $path)){ // Cek apakah gambar berhasil diupload atau tidak
  // Proses simpan ke Database
  $sql = $pdo->prepare("INSERT INTO barang(nama, harga, deskripsi, stok, tanggal_input, kategori, foto_url) VALUES(:nama,:harga,:deskripsi,:stok,:tanggal_input, :kategori, :foto_url)");
  $sql->bindParam(':nama', $nama);
  $sql->bindParam(':harga', $harga);
  $sql->bindParam(':deskripsi', $deskripsi);
  $sql->bindParam(':stok', $stok);
  $sql->bindParam(':tanggal_input', $tanggal_input);
  $sql->bindParam(':kategori', $kategori);
  $sql->bindParam(':foto_url', $fotobaru);
  $sql->execute(); // Eksekusi query insert
  if($sql){ // Cek jika proses simpan ke database sukses atau tidak
    // Jika Sukses, Lakukan :
    header("location: index.php"); // Redirect ke halaman index.php
  }else{
    // Jika Gagal, Lakukan :
    echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
    echo "<br><a href='form_simpan.php'>Kembali Ke Form</a>";
  }
} else {
  // Jika gambar gagal diupload, Lakukan :
  echo "Maaf, Gambar gagal untuk diupload. Error: " . $_FILES['foto_url']['error'];
  echo "<br><a href='form_simpan.php'>Kembali Ke Form</a>";
}
?>





