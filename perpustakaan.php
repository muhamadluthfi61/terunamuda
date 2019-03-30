<?php
  ob_start();
  session_start();
  if(isset($_SESSION['akun_status'])){
  if($_SESSION['akun_status']=="1"){
    header("location: perpustakaan_admin.php");
  }
  elseif($_SESSION['akun_status']=="2"){
    header("location: toko.php");
  }
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

  /*Proses Login*/
if(isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $sql_login = mysqli_query($koneksi, "SELECT * FROM akun WHERE username = '$username' AND password ='$password' ");

  if(mysqli_num_rows($sql_login)>0) {
    $row_akun = mysqli_fetch_array($sql_login);
    $_SESSION['akun_username'] = $row_akun['username'];
    $_SESSION['akun_status'] = $row_akun['status'];

    if($_SESSION["akun_status"]=="0") {
      header("location: perpustakaan.php");
    }
    elseif($_SESSION["akun_status"]=="1") {
      header("location: perpustakaan_admin.php");
    }
    elseif($_SESSION["akun_status"]=="2") {
    header("location: toko.php");
    }
  }else {
    header("location: perpustakaan.php?login-gagal");
  }
}

?>

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
            if(!isset($_SESSION['akun_status'])) {?>
            <li class="nav-item">
              <a class="nav-link" href="index.php">Beranda
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="perpustakaan.php">Perpustakaan</a>
            </li>
            <!--<li class="nav-item">
              <a class="nav-link" href="contactus.php">Contact Us</a>
            </li>-->
            <li class="nav-item">
            
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#login_modal">
            Login
            </button>
            <?php }
            else{
              ?>
            <li class="nav-item">
              <a class="nav-link" href="index.php">Beranda</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="toko.php">Admin Toko</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="perpustakaan.php">Perpustakaan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="perpustakaan_admin.php">Admin Perpustakaan</a>
            </li>
            <!--<li class="nav-item">
              <a class="nav-link" href="contactus.php">Contact Us</a>
            </li>-->
            <li class="nav-item active">
              <a class="nav-link" href="logout.php">Logout
              </a>
            <?php }?>    
            </li>
                </ul>
              </div>
            </div>
          </nav>
          <!-- Modal -->
  <div class="modal fade" id="login_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Login</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="container">	
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <!-- Start form -->
                                <form method="post">
                                  <div class="form-group">
                                    <label>Username</label>
                                    <input required type="text" class="form-control" name="username" placeholder="Enter Username">
                                  </div>
                                  <div class="form-group">
                                    <label>Password</label>
                                    <input required type="password" class="form-control" name="password" placeholder="Password">
                                  </div>
                                  <div class="form-group">
                                    <button type="submit" class="btn btn-primary" name="login">Submit</button>
                                  </div>
                                  
                                </form>
            
            
                  <!-- End form -->
                </div>
                
              
                
              </div>
            </div>
          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>
    <!-- End Modal -->

        <!-- Page Content -->
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="card my-5">
                <h5 class="card-header">PERPUSTAKAAN TERUNA MUDA
                </h5>
                <div class="card-body">
                  <div class="container">

                    <!--Start of Table-->
                    <table id="perpustakaanTable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th class="th-sm">ID Buku
                          </th>
                          <th class="th-sm">Nama Buku
                          </th>
                          <th class="th-sm">Pengarang
                          </th>
                          <th class="th-sm">Status
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $sql = "SELECT * FROM perpustakaan ORDER BY id";
                          $result = $koneksi->query($sql);
                          
                          if ($result->num_rows > 0) {
                            //output data of each row
                            while($row = $result->fetch_assoc()) {
                              echo "<tr>";
                              echo "<td>". $row["id"]. "</td>";
                              echo "<td>". $row["nama"]. "</td>";
                              echo "<td>". $row["pengarang"]. "</td>";
                              if($row["tersedia"]){
                              echo "<td>Tersedia</td>";
                              }else echo "<td>Dipinjam</td>";
                              echo "</tr>";
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
              $('#perpustakaanTable').DataTable({
                "scrollY": "40vh",
                "scrollCollapse": true,
              }
                                               );
              $('.dataTables_length').addClass('bs-select');
            }
                             );
          </script>
          </body>
        </html>