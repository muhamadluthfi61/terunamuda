<?php
  ob_start();
  session_start();
  if(!isset($_SESSION['akun_status'])) header("location: index.php");
  elseif($_SESSION['akun_status']=="1"){
    header("location: perpustakaan.php");
  }

  global $koneksi;
  $nameserver = "localhost";
  $username = "root";
  $password = "";
  $namedb = "terunamuda";

$koneksi = mysqli_connect($nameserver,$username,$password,$namedb);
if(!$koneksi) {
  die("Koneksi gagal".mysqli_connect_error());
}

$querytoko = mysqli_query($koneksi,"SELECT tanggal,perlengkapan.nama AS namabarang,ukuran,masuk,keluar FROM riwayat_perlengkapan NATURAL JOIN perlengkapan");
$querybuku = mysqli_query($koneksi,"SELECT tanggal,buku.nama AS namabuku,buku.tingkat AS tingkatbuku,masuk,keluar FROM riwayat_buku NATURAL JOIN buku");
        
?>
<!--Warning Notification-->
<script>
  function warning() {
	return confirm('Apakah Anda Yakin Ingin Menghapusnya?');
}
</script>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="img/teruna.jpg">
    <title>Teruna Muda</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/blog-home.css" rel="stylesheet">

  </head>

  <body style="background-color: rgb(136, 208, 250)">
    
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="index.php"><img src="img/teruna.jpg" width="50" class="rounded-circle">&nbsp; Teruna Muda</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="laporan.php">Laporan
              </a>
            <li class="nav-item active">
              <a class="nav-link" href="toko.php">Kembali
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Page Content -->
    <div class="container">

      <div class="row">
        <div class="col-md-12">
          <div class="card my-5">
            <h5 class="card-header">TOKO</h5>
            <div class="card-body">

                    <div class="container">
                            <table class="table">
                              <thead class="thead-dark">
                                <tr>
                                  <th>Tanggal</th>
                                  <th>Nama Barang</th>
                                  <th>Ukuran</th>
                                  <th>Masuk</th>
                                  <th>Keluar</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php if(mysqli_num_rows($querytoko)>0){
                              while($datatoko = mysqli_fetch_array($querytoko)){
                              ?> 
                              <tr>               
                              <td><?php echo $datatoko["tanggal"];?></td>
                              <td><?php echo $datatoko["namabarang"];?></td>
                              <td><?php echo $datatoko["ukuran"];?></td>
                              <td><?php echo $datatoko["masuk"];?></td>
                              <td><?php echo $datatoko["keluar"];?></td>  
                              <?php }?>
                              </tr>
                              <?php }?>
                              </tbody>
                            </table>
                          </div>
             
            </div>     
                  
          </div>
          <div class="card my-5">
            <h5 class="card-header">BUKU</h5>
            <div class="card-body">
              <div class="class">
</div>
                    <div class="container">
                            <table class="table">
                              <thead class="thead-dark">
                                <tr>
                                  <th>Tanggal</th>
                                  <th>Nama Buku</th>
                                  <th>Tingkat</th>
                                  <th>Masuk</th>
                                  <th>Keluar</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php if(mysqli_num_rows($querybuku)>0){ ?>
                              <?php
                              while($databuku = mysqli_fetch_array($querybuku)){
                              ?> 
                              <tr>               
                              <td><?php echo $databuku["tanggal"];?></td>
                              <td><?php echo $databuku["namabuku"];?></td>
                              <td><?php echo $databuku["tingkatbuku"];?></td>
                              <td><?php echo $databuku["masuk"];?></td>
                              <td><?php echo $databuku["keluar"];?></td>  
                              <?php }?>
                              <td></td>
                              </tr>
                              <?php }?>                     
                              </tbody>
                            </table>
                          </div>
             
            </div>     
                
        
          </div>

          


          
    
        </div>
        



        <!-- Sidebar  Column 
        <div class="col-md-4">
          <div class="card my-5">
                <div class="card-body">
                  <h2 class="card-title">Cari Buku</h2>
                    <form class="form-inline my-4">
                         <input class="form-control mr-sm-2 my-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success my-4 my-sm-0" type="submit">Cari Buku</button>
                    </form>
                </div>
               
              </div>


        </div> -->


      <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Teruna Muda 2018</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>