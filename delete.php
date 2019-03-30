<?php
$koneksi;
$nameserver = "localhost";
$username = "root";
$password = "";
$namedb = "terunamuda";

$koneksi = mysqli_connect($nameserver,$username,$password,$namedb);
if(!$koneksi) {
  die("Koneksi gagal".mysqli_connect_error());  
}
if(isset($_GET['toko'])){
  $no = $_GET['toko'];
  $query = "DELETE from perlengkapan WHERE id = $no";
  $hasil = mysqli_query($koneksi,$query);
  header("location:toko.php");
}

if(isset($_GET['buku'])){
    $no = $_GET['buku'];
    $query = "DELETE from buku WHERE id = $no";
    $hasil = mysqli_query($koneksi,$query);
    header("location:toko.php");
  }

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = "DELETE from meminjam WHERE id = $id";
    $query1 = "DELETE from perpustakaan WHERE id = $id";
    $hasil = mysqli_query($koneksi,$query);
    if($hasil)
    {
      $hasil1 = mysqli_query($koneksi,$query1);
    }
    header("location:perpustakaan_admin.php");
  }  

mysqli_close($koneksi);
ob_end_flush();
?>
