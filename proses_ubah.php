<?php
// Load file koneksi.php
include "koneksi.php";
// Ambil data ID yang dikirim oleh form_ubah.php melalui URL
$id = $_GET['id'];
// Ambil Data yang Dikirim dari Form
$nama = $_POST['nama'];
$harga = $_POST['harga'];
$deskripsi = $_POST['deskripsi'];
$stok = $_POST['stok'];
$tanggal_input = $_POST['tanggal_input'];
$kategori = $_POST['kategori'];
// Ambil data foto yang dipilih dari form
$foto = $_FILES['foto_url']['name'];
$tmp = $_FILES['foto_url']['tmp_name'];
// Cek apakah user ingin mengubah fotonya atau tidak
if(empty($foto)){ // Jika user tidak memilih file foto pada form
  // Lakukan proses update tanpa mengubah fotonya
  // Proses ubah data ke Database
  $sql = $pdo->prepare("UPDATE siswa SET nama=:nama, harga=:harga, deskripsi=:deskripsi, stok=:stok, tanggal_input=:tanggal_input, kategori=:kategori, foto_url=:foto_url WHERE id=:id"); 
  $sql->bindParam(':nama', $nama);
  $sql->bindParam(':harga', $harga);
  $sql->bindParam(':deskripsi', $deskripsi);
  $sql->bindParam(':stok', $stok);
  $sql->bindParam(':tanggal_input', $tanggal_input);
  $sql->bindParam(':kategori', $kategori);
  $sql->bindParam(':id', $id);
  $execute = $sql->execute(); // Eksekusi / Jalankan query
  if($sql){ // Cek jika proses simpan ke database sukses atau tidak
    // Jika Sukses, Lakukan :
    header("location: index.php"); // Redirect ke halaman index.php
  }else{
    // Jika Gagal, Lakukan :
    echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
    echo "<br><a href='form_ubah.php'>Kembali Ke Form</a>";
  }
}else{ // Jika user memilih foto / mengisi input file foto pada form
  // Lakukan proses update termasuk mengganti foto sebelumnya
  // Rename nama fotonya dengan menambahkan tanggal dan jam upload
  $fotobaru = date('dmYHis').$foto;
  // Set path folder tempat menyimpan fotonya
  $path = "images/".$fotobaru;
  // Proses upload
  if(move_uploaded_file($tmp, $path)){ // Cek apakah gambar berhasil diupload atau tidak
    // Query untuk menampilkan data siswa berdasarkan ID yang dikirim
    $sql = $pdo->prepare("SELECT foto_url FROM barang WHERE id=:id");
    $sql->bindParam(':id', $id);
    $sql->execute(); // Eksekusi query insert
    $data = $sql->fetch(); // Ambil semua data dari hasil eksekusi $sql
    // Cek apakah file foto sebelumnya ada di folder images
    if(is_file("images/".$data['foto_url'])) // Jika foto ada
      unlink("images/".$data['foto_url']); // Hapus file foto sebelumnya yang ada di folder images
    // Proses ubah data ke Database
    $sql = $pdo->prepare("UPDATE barang SET nama=:nama, harga=:harga, deskripsi=:deskripsi, stok=:stok, tanggal_input=:tanggal_input, kategori=:kategori, foto_url=:foto_url WHERE id=:id");
    $sql->bindParam(':nama', $nama);
    $sql->bindParam(':harga', $harga);
    $sql->bindParam(':deskripsi', $deskripsi);
    $sql->bindParam(':stok', $stok);
    $sql->bindParam(':tanggal_input', $tanggal_input);
    $sql->bindParam(':kategori', $kategori);
    $sql->bindParam(':foto_url', $fotobaru);
    $sql->bindParam(':id', $id);
    $execute = $sql->execute(); // Eksekusi / Jalankan query
    if($sql){ // Cek jika proses simpan ke database sukses atau tidak
      // Jika Sukses, Lakukan :
      header("location: index.php"); // Redirect ke halaman index.php
    }else{
      // Jika Gagal, Lakukan :
      echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
      echo "<br><a href='form_ubah.php'>Kembali Ke Form</a>";
    }
  }else{
    // Jika gambar gagal diupload, Lakukan :
    echo "Maaf, Gambar gagal untuk diupload.";
    echo "<br><a href='form_ubah.php'>Kembali Ke Form</a>";
  }
}
?>







