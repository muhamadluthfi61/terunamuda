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

$koneksi;
$nameserver = "localhost";
$username = "root";
$password = "";
$namedb = "terunamuda";

$koneksi = mysqli_connect($nameserver,$username,$password,$namedb);
if(!$koneksi) {
  die("Koneksi gagal".mysqli_connect_error());  
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
      header("location: index.php");
    }
    elseif($_SESSION["akun_status"]=="1") {
      header("location: perpustakaan_admin.php");
    }
    elseif($_SESSION["akun_status"]=="2") {
    header("location: toko.php");
    }
  }else {
    header("location: index.php?login-gagal");
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
          <?php
            if(!isset($_SESSION['akun_status'])) {?>
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Beranda
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
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
              if($_SESSION['akun_status']=="1"){
                header("location: perpustakaan_admin.php");
              }
              elseif($_SESSION['akun_status']=="2"){
                header("location: toko.php");
              }
              ?>
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Beranda</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="toko.php">Admin Toko</a>
            </li>
            <li class="nav-item">
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
        
        <div class="col-md-8">

          <!-- slide -->
          <div id="carouselExampleIndicators" class="carousel slide my-5" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img class="d-block w-100" src="img/img.jpg" alt="First slide">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="img/img1.jpg" alt="Second slide">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="img/img2.jpg" alt="Third slide">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>

          <h1 class="my-4">Pengumuman
          </h1>
          <!-- Pengumuman -->

          <div class="card mb-4">
            <img class="card-img-top" src="http://placehold.it/750x300" alt="Card image cap">
            <div class="card-body">
              <h2 class="card-title">Post Title</h2>
              <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis aliquid atque, nulla? Quos cum ex quis soluta, a laboriosam. Dicta expedita corporis animi vero voluptate voluptatibus possimus, veniam magni quis!</p>
              <a href="#" class="btn btn-primary">Read More &rarr;</a>
            </div>
            <div class="card-footer text-muted">
              Posted on January 1, 2017 by
              <a href="#">Start Bootstrap</a>
            </div>
          </div>

          

        </div>

        <!-- Sidebar  Column -->
        <div class="col-md-4">

  
          <!-- LOGIN 
          <div class="card my-5">
            <h5 class="card-header">
              Login
            </h5> -->
            <div class="card-body ">
             
        

          <!-- TOKO -->
          <div class="card my-4">
            <h5 class="card-header">Status Toko</h5>
            <div class="card-body">
              <ul class="list-group">
              <?php
              $querytoko = mysqli_query($koneksi,"SELECT * FROM perlengkapan");
              if(mysqli_num_rows($querytoko)>0){
                while($datatoko = mysqli_fetch_array($querytoko)){  
                ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  <?php echo $datatoko['nama'];?>
                  <?php if($datatoko['jumlah']==0) {?>
                  <span class="badge badge-danger badge-pill">Kosong</span>
                  <?php }elseif($datatoko['jumlah']<10 && $datatoko['jumlah']!=0) {?>
                  <span class="badge badge-warning badge-pill">Terbatas</span>
                  <?php }else{?>
                  <span class="badge badge-primary badge-pill">Tersedia</span>
                  <?php }?>
                </li>
                <?php }} ?>

              </ul>
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
        <p class="m-0 text-center text-white">Copyright &copy; Teruna Muda 2018</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
