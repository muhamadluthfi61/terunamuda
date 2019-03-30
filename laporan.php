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

  /*Proses Laporan Toko*/
  if(isset($_POST['toko'])) {
    $tahun = $_POST['tahun'];
    $bulan = $_POST['bulan'];
    $querytoko = mysqli_query($koneksi,"SELECT nama, ukuran, awalperlengkapan.jumlah as awal, masuk, keluar, akhirperlengkapan.jumlah as akhir FROM laporanperlengkapan NATURAL JOIN perlengkapan INNER JOIN awalperlengkapan ON awalperlengkapan.id=perlengkapan.id INNER JOIN akhirperlengkapan ON akhirperlengkapan.id=awalperlengkapan.id WHERE laporanperlengkapan.tahun=$tahun and laporanperlengkapan.bulan=$bulan");
  }

  /*Proses Laporan Buku*/
  if(isset($_POST['buku'])) {
    $tahun = $_POST['tahun'];
    $bulan = $_POST['bulan'];
    $querybuku = mysqli_query($koneksi,"SELECT nama, tingkat, awalbuku.jumlah as awal, masuk, keluar, akhirbuku.jumlah as akhir FROM laporanbuku NATURAL JOIN buku INNER JOIN awalbuku ON awalbuku.id=buku.id INNER JOIN akhirbuku ON akhirbuku.id=awalbuku.id WHERE laporanbuku.tahun=$tahun and laporanbuku.bulan=$bulan");
  }

//$querytoko = mysqli_query($koneksi,"SELECT tanggal,perlengkapan.nama AS namabarang,ukuran,masuk,keluar FROM riwayat_perlengkapan NATURAL JOIN perlengkapan");
//$querybuku = mysqli_query($koneksi,"SELECT tanggal,buku.nama AS namabuku,buku.tingkat AS tingkatbuku,masuk,keluar FROM riwayat_buku NATURAL JOIN buku");
        
?>
<!--Warning Notification-->
<script>
  function warning() {
	return confirm('Apakah Anda Yakin Ingin Menghapusnya?');
}

function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
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
              <a class="nav-link" href="history.php">History
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
            <button style="width:150px" class="btn btn-primary" type="button" data-toggle="modal" data-target="#laporanTokoModal">Pilih Bulan
              </button>
            <br><br>

                    <div class="container">
                    
                            <table id="toko" border="0" class="table">
                            <thead class="thead-dark">
                                  <th>Nama Barang</th>
                                  <th>Ukuran</th>
                                  <th>Awal</th>
                                  <th>Masuk</th>
                                  <th>Keluar</th>
                                  <th>Akhir</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php if(isset($_POST['toko'])) {
                              if(mysqli_num_rows($querytoko)>0){
                              while($datatoko = mysqli_fetch_array($querytoko)){
                              ?> 
                              <tr>
                              <td><?php echo $datatoko["nama"];?></td>
                              <td><?php echo $datatoko["ukuran"];?></td>
                              <td><?php echo $datatoko["awal"];?></td>
                              <td><?php echo $datatoko["masuk"];?></td>
                              <td><?php echo $datatoko["keluar"];?></td>  
                              <td><?php echo $datatoko["akhir"];?></td>  
                              <?php }?>
                              </tr>
                              <?php }}?>
                              </tbody>
                            </table>
                          </div>
                          <button style="width:200px" class="btn btn-primary btn-success" type="button"  onclick="exportTableToExcel('toko', 'laporan toko <?php echo $bulan?>/<?php echo $tahun?>')">Download Laporan
              </button>
             
            </div>     
                  
          </div>
          <div class="card my-5">
            <h5 class="card-header">BUKU</h5>
            <div class="card-body">
            <button style="width:150px" class="btn btn-primary" type="button" data-toggle="modal" data-target="#laporanBukuModal">Pilih Bulan
              </button>
            <br><br>

                    <div class="container">
                            <table id="buku" border="0" class="table">
                              <thead class="thead-dark">
                                <tr>
                                  <th>Nama Buku</th>
                                  <th>Tingkat</th>
                                  <th>Awal</th>
                                  <th>Masuk</th>
                                  <th>Keluar</th>
                                  <th>Akhir</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php if(isset($_POST['buku'])) {
                              if(mysqli_num_rows($querybuku)>0){
                              while($databuku = mysqli_fetch_array($querybuku)){
                              ?> 
                              <tr>
                              <td><?php echo $databuku["nama"];?></td>
                              <td><?php echo $databuku["tingkat"];?></td>
                              <td><?php echo $databuku["awal"];?></td>
                              <td><?php echo $databuku["masuk"];?></td>
                              <td><?php echo $databuku["keluar"];?></td>  
                              <td><?php echo $databuku["akhir"];?></td>
                              <?php }?>
                              <td></td>
                              </tr>
                              <?php }}?>                     
                              </tbody>
                            </table>
                          </div>
                          <button style="width:200px" class="btn btn-primary btn-success" type="button"  onclick="exportTableToExcel('buku', 'laporan buku <?php echo $bulan?>/<?php echo $tahun?>')">Download Laporan
                          <!--<button style="width:200px" class="btn btn-primary btn-success" type="button"  onclick="exportTableToExcel('buku', 'laporan buku')">Download Laporan-->
              </button>
             
            </div>     
                
        
          </div>

          


          
    
        </div>

        <!-- Start of laporanTokoModal -->
        <div class="modal fade" id="laporanTokoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <!-- laporanTokoModal Header -->
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Laporan Buku
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;
                  </span>
                </button>
              </div>
              <!-- laporanTokoModal Body -->
              <div class="modal-body">
                <div class="container">	
                  <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                      <!-- Start form -->
                      <form method="post">
                        <div class="form-group">
                          <label>Tahun
                          </label>
                          <input required min="1" type="number" class="form-control" name="tahun" placeholder="Masukan Tahun">
                        </div>
                        <div class="form-group">
                          <label>Bulan
                          </label>
                          <input required min="1" max ="12" type="number" class="form-control" name="bulan" placeholder="Masukan Bulan">
                        </div>
                        <div>
                          <button type="submit" class="btn btn-primary" name="toko">Pilih
                          </button>    
                        </div>
                      </form>
                      <!-- End form -->
                    </div>
                  </div>
                </div>
              </div>
              <!-- laporanTokoModal Footer -->
              <div class="modal-footer">
                <!-- Footer -->
              </div>
            </div>
          </div>
        </div>
        <!-- End of laporanTokoModall -->

        <!-- Start of laporanBukuModal -->
        <div class="modal fade" id="laporanBukuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <!-- laporanBukuModal Header -->
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Laporan Buku
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;
                  </span>
                </button>
              </div>
              <!-- laporanBukuModal Body -->
              <div class="modal-body">
                <div class="container">	
                  <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                      <!-- Start form -->
                      <form method="post">
                        <div class="form-group">
                          <label>Tahun
                          </label>
                          <input required min="1" type="number" class="form-control" name="tahun" placeholder="Masukan Tahun">
                        </div>
                        <div class="form-group">
                          <label>Bulan
                          </label>
                          <input required min="1" max ="12" type="number" class="form-control" name="bulan" placeholder="Masukan Bulan">
                        </div>
                        <div>
                          <button type="submit" class="btn btn-primary" name="buku">Pilih
                          </button>    
                        </div>
                      </form>
                      <!-- End form -->
                    </div>
                  </div>
                </div>
              </div>
              <!-- laporanBukuModal Footer -->
              <div class="modal-footer">
                <!-- Footer -->
              </div>
            </div>
          </div>
        </div>
        <!-- End of laporanBukuModall -->
        



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