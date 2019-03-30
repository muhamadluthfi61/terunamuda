<?php
  ob_start();
  session_start();

  //Checking Account Status
  if(!isset($_SESSION['akun_status'])){
    header("location: index.php");
  }
  else if($_SESSION['akun_status']=="2"){
    header("location: toko.php");
  }
  
  global $koneksi;
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "terunamuda";
  
  //Create connection
  $koneksi = mysqli_connect($servername, $username, $password, $dbname);
  //Check connection
  if (!$koneksi) {
    die("Database Connection failed: " . mysqli_connect_error());
  }

  if(isset($_GET['id']))
  {
    $id = $_GET['id']; 
    $tanggal = date("Y/m/d");
    $meminjam = "UPDATE meminjam SET kembali='$tanggal' WHERE id=$id AND kembali IS NULL";
    $perpustakaan = "UPDATE perpustakaan SET tersedia=1 WHERE id=$id";
    $hasil = mysqli_query($koneksi,$meminjam);
    if($hasil)
    {
      $update = mysqli_query($koneksi,$perpustakaan);
    }

    header("location:perpustakaan_admin.php");
  }

  /*Proses Pinjam*/
if(isset($_POST['pinjam'])) {
  $nis = $_POST['pinjam_nis'];
  $id = $_POST['pinjam_id'];
  $tanggal = date("Y/m/d");
  $check ="SELECT * FROM perpustakaan WHERE id=$id AND tersedia=1";
  $validasi = mysqli_query($koneksi, $check);

  $query = "INSERT INTO meminjam (nis,id,pinjam) VALUES ('$nis',$id,'$tanggal')" ;
  $query1 = "UPDATE perpustakaan SET tersedia=0 WHERE id=$id";
  if ($validasi->num_rows != 0) {
  $pinjambuku = mysqli_query($koneksi, $query);
  if($pinjambuku)
  {
    $perpustakaan = mysqli_query($koneksi, $query1);
  }}

  header("location:perpustakaan_admin.php");
}

  /*Proses Tambah*/
  if(isset($_POST['tambah'])) {
    $id = $_POST['tambah_id'];
    $nama = $_POST['tambah_nama'];
    $pengarang = $_POST['tambah_pengarang'];
    if($pengarang=="")
    {
      $query = "INSERT INTO perpustakaan VALUES ($id,'$nama',NULL,1)" ;
    }else
    {
      $query = "INSERT INTO perpustakaan VALUES ($id,'$nama','$pengarang',1)" ;
    }
    $tambah = mysqli_query($koneksi, $query);
  
    header("location:perpustakaan_admin.php");
  }

  /*Proses Hapus*/
  if(isset($_POST['hapus'])) {
    $id = $_POST['hapus_id'];
    $query = "DELETE FROM perpustakaan WHERE id=$id" ;
    $hapus = mysqli_query($koneksi, $query);
  
    header("location:perpustakaan_admin.php");
  }
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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="img/teruna.jpg">
    <title>Teruna Muda
    </title>
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/blog-home.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.css" rel="stylesheet">
    <!-- MDBootstrap Datatables  -->
    <link href="css/addons/datatables.min.css" rel="stylesheet">
    <style>
      table.dataTable thead .sorting:after,
      table.dataTable thead .sorting:before,
      table.dataTable thead .sorting_asc:after,
      table.dataTable thead .sorting_asc:before,
      table.dataTable thead .sorting_asc_disabled:after,
      table.dataTable thead .sorting_asc_disabled:before,
      table.dataTable thead .sorting_desc:after,
      table.dataTable thead .sorting_desc:before,
      table.dataTable thead .sorting_desc_disabled:after,
      table.dataTable thead .sorting_desc_disabled:before {
        bottom: .5em;
      }
    </style>
  </head>
  <body style="background-color: rgb(136, 208, 250)">
    
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="index.php">
          <img src="img/teruna.jpg" width="50" class="rounded-circle">&nbsp; Teruna Muda
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon">
          </span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
          <?php
            if($_SESSION['akun_status']=="0") {?>
            <li class="nav-item">
              <a class="nav-link" href="index.php">Beranda</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="toko.php">Admin Toko</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="perpustakaan.php">Perpustakaan</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="perpustakaan_admin.php">Admin Perpustakaan</a>
            </li>
            <!--<li class="nav-item">
              <a class="nav-link" href="contactus.php">Contact Us</a>
            </li>-->
            <li class="nav-item active">
              <a class="nav-link" href="logout.php">Logout
              </a>
            <?php }
            else{?>
            <li class="nav-item active">
              <a class="nav-link" href="logout.php">Logout
              </a>
            <?php }?>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <div class="card my-5">
            <h5 class="card-header">PERPUSTAKAAN TERUNA MUDA
            </h5>
            <div class="card-body">
              <div class="container">

                <!--Start of Table-->
                <table id="perpusAdminTable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th class="th-sm">Nama Buku
                      </th>
                      <th class="th-sm">Nama Siswa
                      </th>
                      <th class="th-sm">Pinjam
                      </th>
                      <th class="th-sm">Kembali
                      </th>
                      <th class="th-sm">Action
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $sql = "SELECT meminjam.id,perpustakaan.nama AS namabuku,siswa.nama AS namasiswa,pinjam,kembali FROM meminjam inner join siswa on siswa.nis=meminjam.nis inner join perpustakaan on perpustakaan.id=meminjam.id ORDER BY kembali";
                      $result = $koneksi->query($sql);
                      
                      if ($result->num_rows > 0) {
                        //output data of each row
                        while($row = $result->fetch_assoc()) {
                          echo "<tr>";
                          echo "<td>". $row["namabuku"]. "</td>";
                          echo "<td>". $row["namasiswa"]. "</td>";
                          echo "<td>". $row["pinjam"]. "</td>";
                          echo "<td>". $row["kembali"]. "</td>";
                          echo "<td>";if($row["kembali"]==NULL){?>
                          <button onclick="location.href='perpustakaan_admin.php?id=<?php echo $row['id'];?>'" button class='btn btn-primary btn-success'>Kembalikan</button>
                          <!--<button onclick="warning();location.href='delete.php?id=<?php echo $row['id'];?>'" class='btn btn-primary btn-danger'>Hilang</button>-->
                          <?php }else echo "</td>";
                        }
                      }
                      else {
                        echo "<tr><td>There is No Data</tr></td>";
                      }
                      
                      $koneksi->close();
                    ?>
                  </tbody>
                </table>
                
                <!--End of Table-->

              </div>
            </div>     
          </div>
        </div>
        
        <!-- Sidebar Column -->
        <div class="col-md-4">
          <div class="card my-5">
            <div class="card-body">
              <button style="width:310px" class="btn btn-primary" type="button" data-toggle="modal" data-target="#pinjamBukuModal">Pinjam Buku
              </button>
              <br>
              <br>
              <button style="width:310px" class="btn btn-primary btn-success" type="button" data-toggle="modal" data-target="#tambahBukuModal">Tambah Buku
              </button>
              <!--<br>
              <br>
              <button style="width:310px" class="btn btn-primary btn-danger" type="button" data-toggle="modal" data-target="#buangBukuModal">Buang Buku
              </button>-->
            </div>
          </div>
        </div>
        <!-- End of Sidebar Column -->
        
        <!-- MODAL -->
        
        <!-- Start of pinjamBukuModal -->
        <div class="modal fade" id="pinjamBukuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <!-- pinjamBukuModal Header -->
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pinjam Buku
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;
                  </span>
                </button>
              </div>
              <!-- pinjamBukuModal Body -->
              <div class="modal-body">
                <div class="container">	
                  <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                      <!-- Start form -->
                      <form method="post">
                        <div class="form-group">
                          <label>NIS Siswa
                          </label>
                          <input required max-length="11" type="text" class="form-control" name="pinjam_nis" placeholder="Masukan Nomor Induk Siswa">
                        </div>
                        <div class="form-group">
                          <label>ID Buku
                          </label>
                          <input required min="1" type="number" class="form-control" name="pinjam_id" placeholder="Masukan ID Buku">
                        </div>
                        <div>
                          <button type="submit" class="btn btn-primary" name="pinjam">Pinjam
                          </button>    
                        </div>
                      </form>
                      <!-- End form -->
                    </div>
                  </div>
                </div>
              </div>
              <!-- pinjamBukuModal Footer -->
              <div class="modal-footer">
                <!-- Footer -->
              </div>
            </div>
          </div>
        </div>
        <!-- End of pinjamBukuModal -->
        
        <!-- Start of tambahBukuModal -->
        <div class="modal fade" id="tambahBukuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <!-- tambahBukuModal Header -->
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Buku Baru
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;
                  </span>
                </button>
              </div>
              <!-- tambahBukuModal Body -->
              <div class="modal-body">
                <div class="container">	
                  <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                      <!-- Start form -->
                      <form method="post">
                        <div class="form-group">
                          <label>ID Buku
                          </label>
                          <input required min="1" type="number" class="form-control" name="tambah_id" placeholder="Masukan ID Buku">
                        </div>
                        <div class="form-group">
                          <label>Nama Buku
                          </label>
                          <input required type="text" class="form-control" name="tambah_nama" placeholder="Masukan Nama Buku">
                        </div>
                        <div class="form-group">
                          <label>Pengarang
                          </label>
                          <input type="text" class="form-control" name="tambah_pengarang" placeholder="Masukan Pengarang Buku">
                        </div>
                        <div>
                          <button type="submit" class="btn btn-primary" name="tambah">Tambah Buku
                          </button>    
                        </div>
                      </form>
                      <!-- End form -->
                    </div>
                  </div>
                </div>
              </div>
              <!-- tambahBukuModal Footer -->
              <div class="modal-footer">
                <!-- Footer -->
              </div>
            </div>
          </div>
        </div>
        <!-- End of tambahBukuModal -->
        
        <!-- Start of buangBukuModal -->
        <div class="modal fade" id="buangBukuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <!-- buangBukuModal Header -->
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Buang Buku
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;
                  </span>
                </button>
              </div>
              <!-- buangBukuModal Body -->
              <div class="modal-body">
                <div class="container">	
                  <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                      <!-- Start form -->
                      <form method="post">
                        <div class="form-group">
                          <label>ID Buku
                          </label>
                          <input required min="1" type="number" class="form-control" name="hapus_id" placeholder="Masukan ID Buku">
                        </div>
                        <div>
                          <button type="submit" class="btn btn-primary" name="hapus">Submit
                          </button>    
                        </div>
                      </form>
                      <!-- End form -->
                    </div>
                  </div>
                </div>
              </div>
              <!-- buangBukuModal Footer -->
              <div class="modal-footer">
                <!-- Footer -->
              </div>
            </div>
          </div>
        </div>
        <!-- End of buangBukuModal -->
      
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container -->
    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Teruna Muda 2018
        </p>
      </div>
      <!-- /.container -->
    </footer>
    
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js">
    </script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js">
    </script>

    <!-- SCRIPTS -->
    
    <!-- JQuery -->
    <script type="text/javascript" src="js/jquery-3.3.1.min.js">
    </script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/popper.min.js">
    </script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js">
    </script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js">
    </script>
    <!-- MDBootstrap Datatables  -->
    <script type="text/javascript" src="js/addons/datatables.min.js">
    </script>
    <script>
      $(document).ready(function () {
        $('#perpusAdminTable').DataTable({
          "scrollY": "40vh",
          "scrollCollapse": true,
          "order": [[ 4, "desc" ]],
        });
        $('.dataTables_length').addClass('bs-select');
      });
    </script>
  </body>
</html>