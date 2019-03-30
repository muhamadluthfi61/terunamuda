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

$querytoko = mysqli_query($koneksi,"SELECT * FROM perlengkapan ORDER BY nama");
$querybuku = mysqli_query($koneksi,"SELECT * FROM buku ORDER BY tingkat,kurikulum,jurusan,nama");
$no1=1;
$no2=1;

/*Proses Beli TOKO*/
if(isset($_POST['beli_toko'])) {
  $beli_id_toko = $_POST['beli_id_toko'];
  $beli_jumlah_toko = $_POST['beli_jumlah_toko'];
  $tanggal = date("Y/m/d");

  $tahun = date('Y');
  $bulan = date('m');
  $querycheck = mysqli_query($koneksi,"SELECT * FROM awalperlengkapan WHERE id=$beli_id_toko");
  $queryawal = mysqli_query($koneksi,"SELECT * FROM awalperlengkapan WHERE id=$beli_id_toko AND tahun=$tahun AND bulan=$bulan");

  if(mysqli_num_rows($querycheck)==0)
  {
    /*$queryupdatetoko = "UPDATE perlengkapan SET jumlah = jumlah+$update_jumlah_toko WHERE id = $update_id_toko";
    $querybaru ="INSERT INTO awalperlengkapan VALUES ($update_id_toko,$update_jumlah_toko,$tahun,$bulan)";
    $updatetoko = mysqli_query($koneksi, $queryupdatetoko);
    if($updatetoko)
      {
      $historytoko = mysqli_query($koneksi, $querybaru);
      }*/
  }else
  {
    $querybelitoko = "UPDATE perlengkapan SET jumlah = jumlah-$beli_jumlah_toko WHERE id = $beli_id_toko" ;
    $queryhistory = "INSERT INTO riwayat_perlengkapan VALUES ($beli_id_toko, 0, $beli_jumlah_toko, '$tanggal')";
    
    if(mysqli_num_rows($queryawal)==0)
    {
      $query = "SELECT * FROM perlengkapan WHERE id = $beli_id_toko"; 
      $hasil = mysqli_query($koneksi,$query);
      $data  = mysqli_fetch_array($hasil);
      $id=$data['id'];
      $jumlah=$data['jumlah'];
      $awalperlengkapan = "INSERT INTO awalperlengkapan VALUES ($id,-$jumlah,$tahun,$bulan)";
      $queryawalperlengkapan = mysqli_query($koneksi,$awalperlengkapan);

      $belitoko = mysqli_query($koneksi, $querybelitoko);
      if($belitoko)
        {
          $historytoko = mysqli_query($koneksi, $queryhistory);
        }
    }
    else
    {
      $belitoko = mysqli_query($koneksi, $querybelitoko);
      if($belitoko)
        {
          $historytoko = mysqli_query($koneksi, $queryhistory);
        }
    }
  }

  /*$querybelitoko = "UPDATE perlengkapan SET jumlah = jumlah-$beli_jumlah_toko WHERE id = $beli_id_toko" ;
  $queryhistorytoko = "INSERT INTO riwayat_perlengkapan VALUES ($beli_id_toko, 0, $beli_jumlah_toko, '$tanggal')";
  $belitoko = mysqli_query($koneksi, $querybelitoko);
  if($belitoko)
  {
    $historytoko = mysqli_query($koneksi, $queryhistorytoko);
  }*/

  header("location:toko.php");
}

/*Proses Beli Buku*/
if(isset($_POST['beli_buku'])) {
  $beli_id_buku = $_POST['update_id_buku'];
  $beli_jumlah_buku = $_POST['update_jumlah_buku'];
  $tanggal = date("Y/m/d");

  $tahun = date('Y');
  $bulan = date('m');
  $querycheck = mysqli_query($koneksi,"SELECT * FROM awalbuku WHERE id=$beli_id_buku");
  $queryawal = mysqli_query($koneksi,"SELECT * FROM awalbuku WHERE id=$beli_id_buku AND tahun=$tahun AND bulan=$bulan");

  if(mysqli_num_rows($querycheck)==0)
  {
    /*$queryupdatetoko = "UPDATE perlengkapan SET jumlah = jumlah+$update_jumlah_toko WHERE id = $update_id_toko";
    $querybaru ="INSERT INTO awalperlengkapan VALUES ($update_id_toko,$update_jumlah_toko,$tahun,$bulan)";
    $updatetoko = mysqli_query($koneksi, $queryupdatetoko);
    if($updatetoko)
      {
      $historytoko = mysqli_query($koneksi, $querybaru);
      }*/
  }else
  {
    $querybelibuku = "UPDATE buku SET jumlah = jumlah-$beli_jumlah_buku WHERE id = $beli_id_buku" ;
    $queryhistory = "INSERT INTO riwayat_buku VALUES ($beli_id_buku, 0, $beli_jumlah_buku, '$tanggal')";
    
    if(mysqli_num_rows($queryawal)==0)
    {
      $query = "SELECT * FROM buku WHERE id = $beli_id_buku"; 
      $hasil = mysqli_query($koneksi,$query);
      $data  = mysqli_fetch_array($hasil);
      $id=$data['id'];
      $jumlah=$data['jumlah'];
      $awalbuku = "INSERT INTO awalbuku VALUES ($id,-$jumlah,$tahun,$bulan)";
      $queryawalbuku = mysqli_query($koneksi,$awalbuku);

      $belibuku = mysqli_query($koneksi, $querybelibuku);
      if($belibuku)
        {
          $historybuku = mysqli_query($koneksi, $queryhistory);
        }
    }
    else
    {
      $belibuku = mysqli_query($koneksi, $querybelibuku);
      if($belibuku)
        {
          $historybuku = mysqli_query($koneksi, $queryhistory);
        }
    }
  }

  /*$querybelibuku = "UPDATE buku SET jumlah = jumlah-$beli_jumlah_buku WHERE id = $beli_id_buku" ;
  $queryhistorybuku = "INSERT INTO riwayat_buku VALUES ($beli_id_buku, 0, $beli_jumlah_buku, '$tanggal')";
  $belibuku = mysqli_query($koneksi, $querybelibuku);
  if($belibuku)
  {
    $historybuku = mysqli_query($koneksi, $queryhistorybuku);
  }*/

  header("location:toko.php");
}

/*Proses Edit TOKO*/
if(isset($_POST['edit_toko'])) {
  $update_id_toko = $_POST['edit_id_toko'];
  $update_nama_toko = $_POST['edit_nama_toko'];
  $update_ukuran_toko = $_POST['edit_ukuran_toko'];
  $update_jumlah_toko = $_POST['edit_jumlah_toko'];
  if($update_ukuran_toko=="")
  {
  $queryupdatetoko = "UPDATE perlengkapan SET nama = '$update_nama_toko', ukuran = NULL, jumlah = $update_jumlah_toko WHERE id = $update_id_toko" ;
  }else
  {
  $queryupdatetoko = "UPDATE perlengkapan SET nama = '$update_nama_toko', ukuran = '$update_ukuran_toko', jumlah = $update_jumlah_toko WHERE id = $update_id_toko" ;
  }
  $updatetoko = mysqli_query($koneksi, $queryupdatetoko);

  header("location:toko.php");
}

/*Proses Tambah TOKO*/
if(isset($_POST['update_toko'])) {
  $update_id_toko = $_POST['update_id_toko'];
  $update_jumlah_toko = $_POST['update_jumlah_toko'];
  $tanggal = date("Y/m/d");
  $tahun = date('Y');
  $bulan = date('m');
  $querycheck = mysqli_query($koneksi,"SELECT * FROM awalperlengkapan WHERE id=$update_id_toko");
  $queryawal = mysqli_query($koneksi,"SELECT * FROM awalperlengkapan WHERE id=$update_id_toko AND tahun=$tahun AND bulan=$bulan");

  if(mysqli_num_rows($querycheck)==0)
  {
    $queryupdatetoko = "UPDATE perlengkapan SET jumlah = jumlah+$update_jumlah_toko WHERE id = $update_id_toko";
    $querybaru ="INSERT INTO awalperlengkapan VALUES ($update_id_toko,$update_jumlah_toko,$tahun,$bulan)";
    $updatetoko = mysqli_query($koneksi, $queryupdatetoko);
    if($updatetoko)
      {
      $historytoko = mysqli_query($koneksi, $querybaru);
      }
  }else
  {
    $queryupdatetoko = "UPDATE perlengkapan SET jumlah = jumlah+$update_jumlah_toko WHERE id = $update_id_toko" ;
    $queryhistory = "INSERT INTO riwayat_perlengkapan VALUES ($update_id_toko, $update_jumlah_toko, 0, '$tanggal')";
    
    if(mysqli_num_rows($queryawal)==0)
    {
      $query = "SELECT * FROM perlengkapan WHERE id = $update_id_toko"; 
      $hasil = mysqli_query($koneksi,$query);
      $data  = mysqli_fetch_array($hasil);
      $id=$data['id'];
      $jumlah=$data['jumlah'];
      $awalperlengkapan = "INSERT INTO awalperlengkapan VALUES ($id,$jumlah,$tahun,$bulan)";
      $queryawalperlengkapan = mysqli_query($koneksi,$awalperlengkapan);

      $updatetoko = mysqli_query($koneksi, $queryupdatetoko);
      if($updatetoko)
        {
          $historytoko = mysqli_query($koneksi, $queryhistory);
        }
    }
    else
    {
      $updatetoko = mysqli_query($koneksi, $queryupdatetoko);
      if($updatetoko)
        {
          $historytoko = mysqli_query($koneksi, $queryhistory);
        }
    }
  }
  
  header("location:toko.php");
}

/*Proses BUKU*/
if(isset($_POST['buku'])) {
  $update_id_buku = $_POST['update_id_buku'];
  $update_jumlah_buku = $_POST['update_jumlah_buku'];
  $tanggal = date("Y/m/d");

  $tahun = date('Y');
  $bulan = date('m');
  $querycheck = mysqli_query($koneksi,"SELECT * FROM awalbuku WHERE id=$update_id_buku");
  $queryawal = mysqli_query($koneksi,"SELECT * FROM awalbuku WHERE id=$update_id_buku AND tahun=$tahun AND bulan=$bulan");

  if(mysqli_num_rows($querycheck)==0)
  {
    $queryupdatebuku = "UPDATE buku SET jumlah = jumlah+$update_jumlah_buku WHERE id = $update_id_buku";
    $querybaru ="INSERT INTO awalbuku VALUES ($update_id_buku,$update_jumlah_buku,$tahun,$bulan)";
    $updatebuku = mysqli_query($koneksi, $queryupdatebuku);
    if($updatebuku)
      {
      $historybuku = mysqli_query($koneksi, $querybaru);
      }
  }else
  {
    $queryupdatebuku = "UPDATE buku SET jumlah = jumlah+$update_jumlah_buku WHERE id = $update_id_buku" ;
    $queryhistory = "INSERT INTO riwayat_buku VALUES ($update_id_buku, $update_jumlah_buku, 0, '$tanggal')";
    
    if(mysqli_num_rows($queryawal)==0)
    {
      $query = "SELECT * FROM buku WHERE id = $update_id_buku"; 
      $hasil = mysqli_query($koneksi,$query);
      $data  = mysqli_fetch_array($hasil);
      $id=$data['id'];
      $jumlah=$data['jumlah'];
      $awalbuku = "INSERT INTO awalbuku VALUES ($id,$jumlah,$tahun,$bulan)";
      $queryawalbuku = mysqli_query($koneksi,$awalbuku);

      $updatebuku = mysqli_query($koneksi, $queryupdatebuku);
      if($updatebuku)
        {
          $historybuku = mysqli_query($koneksi, $queryhistory);
        }
    }
    else
    {
      $updatebuku = mysqli_query($koneksi, $queryupdatebuku);
      if($updatebuku)
        {
          $historybuku = mysqli_query($koneksi, $queryhistory);
        }
    }
  }

  /*$queryupdatebuku = "UPDATE buku SET jumlah = jumlah+$update_jumlah_buku WHERE id = $update_id_buku" ;
  $queryhistory = "INSERT INTO riwayat_buku VALUES ($update_id_buku, $update_jumlah_buku, 0, '$tanggal')";
  $updatebuku = mysqli_query($koneksi, $queryupdatebuku);
  if($updatebuku)
  {
    $historytoko = mysqli_query($koneksi, $queryhistory);
  }*/

  header("location:toko.php");
}

/*Proses Edit BUKU*/
if(isset($_POST['update_buku'])) {
  $update_id_buku = $_POST['update_id_buku'];
  $update_nama_buku = $_POST['update_nama_buku'];
  $update_penerbit_buku = $_POST['update_penerbit_buku'];
  $update_kurikulum_buku = $_POST['update_kurikulum_buku'];
  $update_tingkat_buku = $_POST['update_tingkat_buku'];
  $update_jurusan_buku = $_POST['update_jurusan_buku'];
  $update_jumlah_buku = $_POST['update_jumlah_buku'];
  if($update_penerbit_buku=="")
  {if($update_kurikulum_buku=="")
    {if($update_tingkat_buku=="")
      {if($update_jurusan_buku=="")
        {
          $queryupdatebuku = "UPDATE buku SET nama = '$update_nama_buku', penerbit = NULL, kurikulum = NULL, tingkat = NULL, jurusan = NULL, jumlah = $update_jumlah_buku WHERE id = $update_id_buku" ;
        }else $queryupdatebuku = "UPDATE buku SET nama = '$update_nama_buku', penerbit = NULL, kurikulum = NULL, tingkat = NULL, jurusan = '$update_jurusan_buku', jumlah = $update_jumlah_buku WHERE id = $update_id_buku" ; 
      }else
      {
        if($update_jurusan_buku=="")
        {
          $queryupdatebuku = "UPDATE buku SET nama = '$update_nama_buku', penerbit = NULL, kurikulum = NULL, tingkat = $update_tingkat_buku, jurusan = NULL, jumlah = $update_jumlah_buku WHERE id = $update_id_buku" ;
        }else $queryupdatebuku = "UPDATE buku SET nama = '$update_nama_buku', penerbit = NULL, kurikulum = NULL, tingkat = $update_tingkat_buku, jurusan = '$update_jurusan_buku', jumlah = $update_jumlah_buku WHERE id = $update_id_buku" ;
      }
    }else
    {if($update_tingkat_buku=="")
      {if($update_jurusan_buku=="")
        {
          $queryupdatebuku = "UPDATE buku SET nama = '$update_nama_buku', penerbit = NULL, kurikulum = '$update_kurikulum_buku', tingkat = NULL, jurusan = NULL, jumlah = $update_jumlah_buku WHERE id = $update_id_buku" ;
        }else $queryupdatebuku = "UPDATE buku SET nama = '$update_nama_buku', penerbit = NULL, kurikulum = '$update_kurikulum_buku', tingkat = NULL, jurusan = '$update_jurusan_buku', jumlah = $update_jumlah_buku WHERE id = $update_id_buku" ;
      }else
      {
        if($update_jurusan_buku=="")
        {
          $queryupdatebuku = "UPDATE buku SET nama = '$update_nama_buku', penerbit = NULL, kurikulum = '$update_kurikulum_buku', tingkat = $update_tingkat_buku, jurusan = NULL, jumlah = $update_jumlah_buku WHERE id = $update_id_buku" ;
        }else $queryupdatebuku = "UPDATE buku SET nama = '$update_nama_buku', penerbit = NULL, kurikulum = '$update_kurikulum_buku', tingkat = $update_tingkat_buku, jurusan = '$update_jurusan_buku', jumlah = $update_jumlah_buku WHERE id = $update_id_buku" ;
      }
    }
    }else
    {
    if($update_kurikulum_buku=="")
    {if($update_tingkat_buku=="")
      {if($update_jurusan_buku=="")
        {
          $queryupdatebuku = "UPDATE buku SET nama = '$update_nama_buku', penerbit = '$update_penerbit_buku', kurikulum = NULL, tingkat = NULL, jurusan = NULL, jumlah = $update_jumlah_buku WHERE id = $update_id_buku" ;
        }else $queryupdatebuku = "UPDATE buku SET nama = '$update_nama_buku', penerbit = '$update_penerbit_buku', kurikulum = NULL, tingkat = NULL, jurusan = '$update_jurusan_buku', jumlah = $update_jumlah_buku WHERE id = $update_id_buku" ;
      }else
      {
        if($update_jurusan_buku=="")
        {
          $queryupdatebuku = "UPDATE buku SET nama = '$update_nama_buku', penerbit = '$update_penerbit_buku', kurikulum = NULL, tingkat = $update_tingkat_buku, jurusan = NULL, jumlah = $update_jumlah_buku WHERE id = $update_id_buku" ;
        }else $queryupdatebuku = "UPDATE buku SET nama = '$update_nama_buku', penerbit = '$update_penerbit_buku', kurikulum = NULL, tingkat = $update_tingkat_buku, jurusan = '$update_jurusan_buku', jumlah = $update_jumlah_buku WHERE id = $update_id_buku" ;
      }
    }else
    {if($update_tingkat_buku=="")
      {if($update_jurusan_buku=="")
        {
          $queryupdatebuku = "UPDATE buku SET nama = '$update_nama_buku', penerbit = '$update_penerbit_buku', kurikulum = '$update_kurikulum_buku', tingkat = NULL, jurusan = NULL, jumlah = $update_jumlah_buku WHERE id = $update_id_buku" ;
        }else $queryupdatebuku = "UPDATE buku SET nama = '$update_nama_buku', penerbit = '$update_penerbit_buku', kurikulum = '$update_kurikulum_buku', tingkat = NULL, jurusan = '$update_jurusan_buku', jumlah = $update_jumlah_buku WHERE id = $update_id_buku" ;
      }else
      {
        if($update_jurusan_buku=="")
        {
          $queryupdatebuku = "UPDATE buku SET nama = '$update_nama_buku', penerbit = '$update_penerbit_buku', kurikulum = '$update_kurikulum_buku', tingkat = $update_tingkat_buku, jurusan = NULL, jumlah = $update_jumlah_buku WHERE id = $update_id_buku" ;
        }else $queryupdatebuku = "UPDATE buku SET nama = '$update_nama_buku', penerbit = '$update_penerbit_buku', kurikulum = '$update_kurikulum_buku', tingkat = $update_tingkat_buku, jurusan = '$update_jurusan_buku', jumlah = $update_jumlah_buku WHERE id = $update_id_buku" ;
      }
    }
    }
  $updatebuku = mysqli_query($koneksi, $queryupdatebuku);

  header("location:toko.php");
}

/*Proses Tambah TOKO*/
if(isset($_POST['tambah_toko'])) {
  $tambah_nama_toko = $_POST['tambah_nama_toko'];
  $tambah_ukuran_toko = $_POST['tambah_ukuran_toko'];
  //$tambah_jumlah_toko = $_POST['tambah_jumlah_toko'];
  if($tambah_ukuran_toko=="")
  {
    $querytambahtoko = "INSERT INTO perlengkapan (nama,ukuran) VALUES ('$tambah_nama_toko', NULL)";
  }else
  {
    $querytambahtoko = "INSERT INTO perlengkapan (nama,ukuran) VALUES ('$tambah_nama_toko', '$tambah_ukuran_toko')";
  }
  $tambahtoko = mysqli_query($koneksi, $querytambahtoko);

  header("location:toko.php");
}

/*Proses Tambah BUKU*/
if(isset($_POST['tambah_buku'])) {
  $tambah_nama_buku = $_POST['tambah_nama_buku'];
  $tambah_penerbit_buku = $_POST['tambah_penerbit_buku'];
  $tambah_kurikulum_buku = $_POST['tambah_kurikulum_buku'];
  $tambah_tingkat_buku = $_POST['tambah_tingkat_buku'];
  $tambah_jurusan_buku = $_POST['tambah_jurusan_buku'];
  $tambah_jumlah_buku = $_POST['tambah_jumlah_buku'];
  if($tambah_penerbit_buku=="")
  {if($tambah_kurikulum_buku=="")
    {if($tambah_tingkat_buku=="")
      {if($tambah_jurusan_buku=="")
        {
          $querytambahbuku = "INSERT INTO buku (nama,penerbit,kurikulum,tingkat,jurusan,jumlah) VALUES ('$tambah_nama_buku', NULL, NULL, NULL, NULL, $tambah_jumlah_buku)";
        }else $querytambahbuku = "INSERT INTO buku (nama,penerbit,kurikulum,tingkat,jurusan,jumlah) VALUES ('$tambah_nama_buku', NULL, NULL, NULL, '$tambah_jurusan_buku', $tambah_jumlah_buku)";
      }else
      {
        if($tambah_jurusan_buku=="")
        {
          $querytambahbuku = "INSERT INTO buku (nama,penerbit,kurikulum,tingkat,jurusan,jumlah) VALUES ('$tambah_nama_buku', NULL, NULL, $tambah_tingkat_buku, NULL, $tambah_jumlah_buku)";
        }else $querytambahbuku = "INSERT INTO buku (nama,penerbit,kurikulum,tingkat,jurusan,jumlah) VALUES ('$tambah_nama_buku', NULL, NULL, $tambah_tingkat_buku, '$tambah_jurusan_buku', $tambah_jumlah_buku)";
      }
    }else
    {if($tambah_tingkat_buku=="")
      {if($tambah_jurusan_buku=="")
        {
          $querytambahbuku = "INSERT INTO buku (nama,penerbit,kurikulum,tingkat,jurusan,jumlah) VALUES ('$tambah_nama_buku', NULL, '$tambah_kurikulum_buku', NULL, NULL, $tambah_jumlah_buku)";
        }else $querytambahbuku = "INSERT INTO buku (nama,penerbit,kurikulum,tingkat,jurusan,jumlah) VALUES ('$tambah_nama_buku', NULL, '$tambah_kurikulum_buku', NULL, '$tambah_jurusan_buku', $tambah_jumlah_buku)";
      }else
      {
        if($tambah_jurusan_buku=="")
        {
          $querytambahbuku = "INSERT INTO buku (nama,penerbit,kurikulum,tingkat,jurusan,jumlah) VALUES ('$tambah_nama_buku', NULL, '$tambah_kurikulum_buku', $tambah_tingkat_buku, NULL, $tambah_jumlah_buku)";
        }else $querytambahbuku = "INSERT INTO buku (nama,penerbit,kurikulum,tingkat,jurusan,jumlah) VALUES ('$tambah_nama_buku', NULL, '$tambah_kurikulum_buku', $tambah_tingkat_buku, '$tambah_jurusan_buku', $tambah_jumlah_buku)";
      }
    }
    }else
    {
    if($tambah_kurikulum_buku=="")
    {if($tambah_tingkat_buku=="")
      {if($tambah_jurusan_buku=="")
        {
          $querytambahbuku = "INSERT INTO buku (nama,penerbit,kurikulum,tingkat,jurusan,jumlah) VALUES ('$tambah_nama_buku', '$tambah_penerbit_buku', NULL, NULL, NULL, $tambah_jumlah_buku)";
        }else $querytambahbuku = "INSERT INTO buku (nama,penerbit,kurikulum,tingkat,jurusan,jumlah) VALUES ('$tambah_nama_buku', '$tambah_penerbit_buku', NULL, NULL, '$tambah_jurusan_buku', $tambah_jumlah_buku)";
      }else
      {
        if($tambah_jurusan_buku=="")
        {
          $querytambahbuku = "INSERT INTO buku (nama,penerbit,kurikulum,tingkat,jurusan,jumlah) VALUES ('$tambah_nama_buku', '$tambah_penerbit_buku', NULL, $tambah_tingkat_buku, NULL, $tambah_jumlah_buku)";
        }else $querytambahbuku = "INSERT INTO buku (nama,penerbit,kurikulum,tingkat,jurusan,jumlah) VALUES ('$tambah_nama_buku', '$tambah_penerbit_buku', NULL, $tambah_tingkat_buku, '$tambah_jurusan_buku', $tambah_jumlah_buku)";
      }
    }else
    {if($tambah_tingkat_buku=="")
      {if($tambah_jurusan_buku=="")
        {
          $querytambahbuku = "INSERT INTO buku (nama,penerbit,kurikulum,tingkat,jurusan,jumlah) VALUES ('$tambah_nama_buku', '$tambah_penerbit_buku', '$tambah_kurikulum_buku', NULL, NULL, $tambah_jumlah_buku)";
        }else $querytambahbuku = "INSERT INTO buku (nama,penerbit,kurikulum,tingkat,jurusan,jumlah) VALUES ('$tambah_nama_buku', '$tambah_penerbit_buku', '$tambah_kurikulum_buku', NULL, '$tambah_jurusan_buku', $tambah_jumlah_buku)";
      }else
      {
        if($tambah_jurusan_buku=="")
        {
          $querytambahbuku = "INSERT INTO buku (nama,penerbit,kurikulum,tingkat,jurusan,jumlah) VALUES ('$tambah_nama_buku', '$tambah_penerbit_buku', '$tambah_kurikulum_buku', $tambah_tingkat_buku, NULL, $tambah_jumlah_buku)";
        }else $querytambahbuku = "INSERT INTO buku (nama,penerbit,kurikulum,tingkat,jurusan,jumlah) VALUES ('$tambah_nama_buku', '$tambah_penerbit_buku', '$tambah_kurikulum_buku', $tambah_tingkat_buku, '$tambah_jurusan_buku', $tambah_jumlah_buku)";
      }
    }
    }
  $tambahbuku = mysqli_query($koneksi, $querytambahbuku);

  header("location:toko.php");
}


/*Proses Tambah Penjual*/
if(isset($_POST['tambah_penjual'])) {
  $nama = $_POST['nama_penjual'];
  $alamat = $_POST['alamat_penjual'];
  $telp = $_POST['telp_penjual'];
  $query = "INSERT INTO toko (nama,alamat,no_telp) VALUES ('$nama', '$alamat', '$telp')";

  $tambahpenjual = mysqli_query($koneksi, $query);

  header("location:toko.php");
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

    

<?php if(isset($_GET['toko'])){?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        $("#update_toko_modal").modal('show');
    });
</script>
<?php }?>

<?php if(isset($_GET['belitoko'])){?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        $("#beli_toko_modal").modal('show');
    });
</script>
<?php }?>

<?php if(isset($_GET['edittoko'])){?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        $("#edit_toko_modal").modal('show');
    });
</script>
<?php }?>

<?php if(isset($_GET['buku'])){?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        $("#update_buku_modal").modal('show');
    });
</script>
<?php }?>

<?php if(isset($_GET['tambahbuku'])){?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        $("#buku_modal").modal('show');
    });
</script>
<?php }?>

<?php if(isset($_GET['belibuku'])){?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        $("#beli_buku_modal").modal('show');
    });
</script>
<?php }?>

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
            if($_SESSION['akun_status']=="0") {?>
            <li class="nav-item">
              <a class="nav-link" href="index.php">Beranda
              </a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="toko.php">Admin Toko</a>
              <span class="sr-only">(current)</span>
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
            <h5 class="card-header">TOKO</h5>
            <div class="card-body">
              <div class="container">
                <table id="tokoTable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th class="th-sm">No
                        </th>
                        <th class="th-sm">Nama Barang
                        </th>
                        <th class="th-sm">Ukuran
                        </th>
                        <th class="th-sm">Jumlah
                        </th>
                        <th class="th-sm">Action
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if(mysqli_num_rows($querytoko)>0){
                      while($datatoko = mysqli_fetch_array($querytoko)){
                      ?> 
                      <tr>               
                      <td><?php echo $no1;?></td>
                      <td><?php echo $datatoko["nama"];?></td>
                      <td><?php echo $datatoko["ukuran"];?></td>
                      <td><?php echo $datatoko["jumlah"];?></td>
                      <td>
                      <button onclick="location.href='toko.php?toko=<?php echo $datatoko['id'];?>'"class="btn btn-primary btn-success">Tambah</button>
                      <button onclick="location.href='toko.php?belitoko=<?php echo $datatoko['id'];?>'"class="btn btn-primary btn-primary">Beli</button>
                      <button onclick="location.href='toko.php?edittoko=<?php echo $datatoko['id'];?>'"class="btn btn-primary btn-warning">Edit</button>
                      <!--<button onclick="warning();location.href='delete.php?toko=<?php echo $datatoko['id'];?>'" class="btn btn-primary btn-danger">Delete</button>-->
                      </td>
                      </tr>
                      <?php 
                      $no1++;
                      }?>
                      <?php }?>
                      </tbody>
                    </table>
              </div>
            </div>     
                <div class="card-footer text-muted">
                <button class="btn btn-primary btn-success" type="button" data-toggle="modal" data-target="#tambah_toko_modal">Tambah Barang</button>
               </div>
               
               <!-- Modal Update Barang Toko -->
               <div class="modal fade" id="update_toko_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Update Barang</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="container">	
                        <div class="row">
                          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <!-- Start form -->
                            <?php
                            if(isset($_GET['toko'])){
                            $no = $_GET['toko']; 
                            $query = "SELECT * FROM perlengkapan WHERE id = $no"; 
                            $hasil = mysqli_query($koneksi,$query);
                            $data  = mysqli_fetch_array($hasil);
                            }
                            ?>
                                          <form method="post">
                                            <div class="form-group">
                                              <label>Nama Barang</label>
                                              <input disabled type="text" class="form-control" name="update_nama_toko" value="<?php echo $data['nama']; ?>">
                                            </div>
                                            <div class="form-group">
                                              <label>Ukuran</label>
                                              <input disabled type="text" class="form-control" name="update_ukuran_toko" value="<?php echo $data['ukuran']; ?>">
                                            </div>
                                            <div class="form-group">
                                              <label>Jumlah</label>
                                              <input required min="0" type="number" class="form-control" name="update_jumlah_toko" placeholder="Masukan Jumlah">
                                            </div>
                                            <input type="hidden" class="form-control" name="update_id_toko" value="<?php echo $data['id']; ?>">
                                            <div class="form-group">
                                            <button type="submit" class="btn btn-primary" name="update_toko">Submit</button>   
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
              <!-- Akhir Modal-->

              <!-- Modal Beli Barang Toko -->
              <div class="modal fade" id="beli_toko_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Beli Barang</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="container">	
                        <div class="row">
                          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <!-- Start form -->
                            <?php
                            if(isset($_GET['belitoko'])){
                            $no = $_GET['belitoko']; 
                            $query = "SELECT * FROM perlengkapan WHERE id = $no"; 
                            $hasil = mysqli_query($koneksi,$query);
                            $data  = mysqli_fetch_array($hasil);
                            }
                            ?>
                                          <form method="post">
                                            <div class="form-group">
                                              <label>Nama Barang</label>
                                              <input disabled type="text" class="form-control" name="beli_nama_toko" value="<?php echo $data['nama']; ?>">
                                            </div>
                                            <div class="form-group">
                                              <label>Ukuran</label>
                                              <input disabled type="text" class="form-control" name="beli_ukuran_toko" value="<?php echo $data['ukuran']; ?>">
                                            </div>
                                            <div class="form-group">
                                              <label>Jumlah</label>
                                              <input required min="0" type="number" class="form-control" name="beli_jumlah_toko" placeholder="Masukan Jumlah Barang">
                                            </div>  
                                            <input type="hidden" class="form-control" name="beli_id_toko" value="<?php echo $data['id']; ?>">
                                            <div class="form-group">
                                            <button type="submit" class="btn btn-primary" name="beli_toko">Submit</button>   
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
              <!-- Akhir Modal-->

              <!-- Modal Edit Barang Toko -->
              <div class="modal fade" id="edit_toko_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Edit Barang</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="container">	
                        <div class="row">
                          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <!-- Start form -->
                            <?php
                            if(isset($_GET['edittoko'])){
                            $no = $_GET['edittoko']; 
                            $query = "SELECT * FROM perlengkapan WHERE id = $no"; 
                            $hasil = mysqli_query($koneksi,$query);
                            $data  = mysqli_fetch_array($hasil);
                            }
                            ?>
                                          <form method="post">
                                            <div class="form-group">
                                              <label>Nama Barang</label>
                                              <input required type="text" class="form-control" name="edit_nama_toko" value="<?php echo $data['nama']; ?>">
                                            </div>
                                            <div class="form-group">
                                              <label>Ukuran</label>
                                              <input type="text" class="form-control" name="edit_ukuran_toko" value="<?php echo $data['ukuran']; ?>">
                                            </div>
                                            <div class="form-group">
                                              <label>Jumlah</label>
                                              <input required min="0" type="number" class="form-control" name="edit_jumlah_toko" value="<?php echo $data['jumlah']; ?>">
                                            </div> 
                                            <input type="hidden" class="form-control" name="edit_id_toko" value="<?php echo $data['id']; ?>">
                                            <div class="form-group">
                                            <button type="submit" class="btn btn-primary" name="edit_toko">Submit</button>   
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
              <!-- Akhir Modal-->

               <!-- Modal Tambah Barang Toko -->
               <div class="modal fade" id="tambah_toko_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="container">	
                        <div class="row">
                          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                          <?php
                            $query = "SELECT * FROM toko"; 
                            $hasil = mysqli_query($koneksi,$query);
                            ?>
                            <!-- Start form -->
                                          <form method="post">
                                            <div class="form-group">
                                              <label>Nama Barang</label>
                                              <input required type="text" class="form-control" name="tambah_nama_toko" placeholder="Nama Barang">
                                            </div>
                                            <div class="form-group">
                                              <label>Ukuran</label>
                                              <input type="text" class="form-control" name="tambah_ukuran_toko" placeholder="Ukuran Barang">
                                            </div>
                                            <!--<div class="form-group">
                                              <label>Jumlah</label>
                                              <input required min="0" type="number" class="form-control" name="tambah_jumlah_toko" placeholder="Jumlah Barang">
                                            </div>-->
                                            <div class="form-group">
                                            <button type="submit" class="btn btn-primary" name="tambah_toko">Submit</button>    
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
              <!-- Akhir Modal-->
                  
          </div>
          <div class="card my-5">
            <h5 class="card-header">BUKU</h5>
            <div class="card-body">
              <div class="class">

</div>
                    <div class="container">                            <table class="table">
                    <table id="bukuTable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th class="th-sm">No
                      </th>
                      <th class="th-sm">Nama Buku
                      </th>
                      <th class="th-sm">Kurikulum
                      </th>
                      <th class="th-sm">Tingkat
                      </th>
                      <th class="th-sm">Jurusan
                      </th>
                      <th class="th-sm">Jumlah
                      </th>
                      <th class="th-sm">Action
                      </th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php if(mysqli_num_rows($querybuku)>0){ ?>
                    <?php
                    while($databuku = mysqli_fetch_array($querybuku)){
                    ?> 
                    <tr>               
                    <td><?php echo $no2;?></td>
                    <td><?php echo $databuku["nama"];?></td>
                    <td><?php echo $databuku["kurikulum"];?></td>
                    <td><?php echo $databuku["tingkat"];?></td>
                    <td><?php echo $databuku["jurusan"];?></td>
                    <td><?php echo $databuku["jumlah"];?></td>
                    <td>
                    <button onclick="location.href='toko.php?tambahbuku=<?php echo $databuku['id'];?>'"class="btn btn-primary btn-success">Tambah</button>
                    <button onclick="location.href='toko.php?belibuku=<?php echo $databuku['id'];?>'"class="btn btn-primary btn-primary">Beli</button>
                    <button onclick="location.href='toko.php?buku=<?php echo $databuku['id'];?>'"class="btn btn-primary btn-warning">Edit</button>
                    <!--<button onclick="warning();location.href='delete.php?buku=<?php echo $databuku['id'];?>'" class="btn btn-primary btn-danger">Delete</button>-->
                    </td>
                    </tr>
                    <?php 
                    $no2++;
                    }?>
                    <?php }?>                     
                    </tbody>
                  </table>
                </div>
             
            </div>     
                <div class="card-footer text-muted">
                <button class="btn btn-primary btn-success" type="button" data-toggle="modal" data-target="#tambah_buku_modal">Tambah Barang</button>
               </div>
               
            <!-- Modal Edit Barang Buku -->
            <div class="modal fade" id="update_buku_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Update Buku</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="container">	
                        <div class="row">
                          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <!-- Start form -->
                            <?php
                            if(isset($_GET['buku'])){
                            $no = $_GET['buku']; 
                            $query = "SELECT * FROM buku WHERE id = $no"; 
                            $hasil = mysqli_query($koneksi,$query);
                            $data  = mysqli_fetch_array($hasil);
                            }
                            ?>
                                          <form method="post">
                                            <div class="form-group">
                                              <label>Nama Buku</label>
                                              <input required type="text" class="form-control" name="update_nama_buku" value="<?php echo $data['nama']; ?>">
                                            </div>
                                            <div class="form-group">
                                              <label>Penerbit</label>
                                              <input type="text" class="form-control" name="update_penerbit_buku" value="<?php echo $data['penerbit']; ?>">
                                            </div>
                                            <div class="form-group">
                                              <label>Kurikulum</label>
                                              <input type="text" class="form-control" name="update_kurikulum_buku" value="<?php echo $data['kurikulum']; ?>">
                                            </div>
                                            <div class="form-group">
                                              <label>Tingkat</label>
                                              <input max="12" type="number" class="form-control" name="update_tingkat_buku" value="<?php echo $data['tingkat']; ?>">
                                            </div>
                                            <div class="form-group">
                                              <label>Jurusan</label>
                                              <input maxlength="3" type="text" class="form-control" name="update_jurusan_buku" value="<?php echo $data['jurusan']; ?>">
                                            </div>
                                            <div class="form-group">
                                              <label>Jumlah</label>
                                              <input required min="0" type="number" class="form-control" name="update_jumlah_buku" value="<?php echo $data['jumlah']; ?>">
                                            </div>
                                            <input type="hidden" class="form-control" name="update_id_buku" value="<?php echo $data['id']; ?>">
                                            <div class="form-group">
                                            <button type="submit" class="btn btn-primary" name="update_buku">Submit</button>   
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
              <!-- Akhir Modal-->  

              <!-- Modal Barang Buku -->
            <div class="modal fade" id="buku_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Tambah Buku</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="container">	
                        <div class="row">
                          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <!-- Start form -->
                            <?php
                            if(isset($_GET['tambahbuku'])){
                            $no = $_GET['tambahbuku']; 
                            $query = "SELECT * FROM buku WHERE id = $no"; 
                            $hasil = mysqli_query($koneksi,$query);
                            $data  = mysqli_fetch_array($hasil);
                            }
                            ?>
                                          <form method="post">
                                            <div class="form-group">
                                              <label>Nama Buku</label>
                                              <input disabled type="text" class="form-control" name="update_nama_buku" value="<?php echo $data['nama']; ?>">
                                            </div>
                                            <div class="form-group">
                                              <label>Penerbit</label>
                                              <input disabled type="text" class="form-control" name="update_penerbit_buku" value="<?php echo $data['penerbit']; ?>">
                                            </div>
                                            <div class="form-group">
                                              <label>Kurikulum</label>
                                              <input disabled type="text" class="form-control" name="update_kurikulum_buku" value="<?php echo $data['kurikulum']; ?>">
                                            </div>
                                            <div class="form-group">
                                              <label>Tingkat</label>
                                              <input disabled max="12" type="number" class="form-control" name="update_tingkat_buku" value="<?php echo $data['tingkat']; ?>">
                                            </div>
                                            <div class="form-group">
                                              <label>Jurusan</label>
                                              <input disabled maxlength="3" type="text" class="form-control" name="update_jurusan_buku" value="<?php echo $data['jurusan']; ?>">
                                            </div>
                                            <div class="form-group">
                                              <label>Jumlah</label>
                                              <input required min="0" type="number" class="form-control" name="update_jumlah_buku" placeholder="Masukan Jumlah">
                                            </div>
                                            <input type="hidden" class="form-control" name="update_id_buku" value="<?php echo $data['id']; ?>">
                                            <div class="form-group">
                                            <button type="submit" class="btn btn-primary" name="buku">Submit</button>   
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
              <!-- Akhir Modal--> 

              <!-- Modal Beli Barang Buku -->
            <div class="modal fade" id="beli_buku_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Tambah Buku</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="container">	
                        <div class="row">
                          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <!-- Start form -->
                            <?php
                            if(isset($_GET['belibuku'])){
                            $no = $_GET['belibuku']; 
                            $query = "SELECT * FROM buku WHERE id = $no"; 
                            $hasil = mysqli_query($koneksi,$query);
                            $data  = mysqli_fetch_array($hasil);
                            }
                            ?>
                                          <form method="post">
                                            <div class="form-group">
                                              <label>Nama Buku</label>
                                              <input disabled type="text" class="form-control" name="update_nama_buku" value="<?php echo $data['nama']; ?>">
                                            </div>
                                            <div class="form-group">
                                              <label>Penerbit</label>
                                              <input disabled type="text" class="form-control" name="update_penerbit_buku" value="<?php echo $data['penerbit']; ?>">
                                            </div>
                                            <div class="form-group">
                                              <label>Kurikulum</label>
                                              <input disabled type="text" class="form-control" name="update_kurikulum_buku" value="<?php echo $data['kurikulum']; ?>">
                                            </div>
                                            <div class="form-group">
                                              <label>Tingkat</label>
                                              <input disabled max="12" type="number" class="form-control" name="update_tingkat_buku" value="<?php echo $data['tingkat']; ?>">
                                            </div>
                                            <div class="form-group">
                                              <label>Jurusan</label>
                                              <input disabled maxlength="3" type="text" class="form-control" name="update_jurusan_buku" value="<?php echo $data['jurusan']; ?>">
                                            </div>
                                            <div class="form-group">
                                              <label>Jumlah</label>
                                              <input required min="0" type="number" class="form-control" name="update_jumlah_buku" placeholder="Masukan Jumlah Buku">
                                            </div>
                                            <input type="hidden" class="form-control" name="update_id_buku" value="<?php echo $data['id']; ?>">
                                            <div class="form-group">
                                            <button type="submit" class="btn btn-primary" name="beli_buku">Submit</button>   
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
              <!-- Akhir Modal-->   
                  
                  <!-- Modal Tambah Barang Buku -->
               <div class="modal fade" id="tambah_buku_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Tambah Buku</h5>
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
                                              <label>Nama Buku</label>
                                              <input required type="text" class="form-control" name="tambah_nama_buku" placeholder="Nama Buku">
                                            </div>
                                            <div class="form-group">
                                              <label>Penerbit</label>
                                              <input type="text" class="form-control" name="tambah_penerbit_buku" placeholder="Nama Penerbit">
                                            </div>
                                            <div class="form-group">
                                              <label>Kurikulum</label>
                                              <input type="text" class="form-control" name="tambah_kurikulum_buku" placeholder="Nama Kurikulum">
                                            </div>
                                            <div class="form-group">
                                              <label>Tingkat</label>
                                              <input max="12" type="number" class="form-control" name="tambah_tingkat_buku" placeholder="Tingkatan Kelas">
                                            </div>
                                            <div class="form-group">
                                              <label>Jurusan</label>
                                              <input maxlength="3" type="text" class="form-control" name="tambah_jurusan_buku" placeholder="IPA/IPS">
                                            </div> 
                                            <!--<div class="form-group">
                                              <label>Jumlah</label>
                                              <input required min="0" type="number" class="form-control" name="tambah_jumlah_buku" placeholder="Jumlah Buku">
                                            </div>-->
                                            <div class="form-group">
                                            <button type="submit" class="btn btn-primary" name="tambah_buku">Submit</button>   
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
              <!-- Akhir Modal-->
          </div>

          


          
    
        </div>
        



        <!-- Sidebar  Column -->
        <div class="col-md-4">
          <div class="card my-5">
                <div class="card-body">
                <button style="width:310px" class="btn btn-primary btn-success" type="button"  onclick="location.href='history.php'">History
              </button>
              <br><br>
                <button style="width:310px" class="btn btn-primary btn-success" type="button"  onclick="location.href='laporan.php'">Laporan
              </button>
              <!--<button style="width:310px" class="btn btn-primary btn-success" type="button" data-toggle="modal" data-target="#tambah_penjual">Tambah Penjual</button>-->
                </div>
               
              </div>


        </div>


      <!-- /.row -->

       <!-- Modal Tambah Penjual -->
       <div class="modal fade" id="tambah_penjual" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Tambah Penjual</h5>
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
                                              <label>Toko Penjual</label>
                                              <input required type="text" class="form-control" name="nama_penjual" placeholder="Toko Penjual">
                                            </div>
                                            <div class="form-group">
                                              <label>Alamat</label>
                                              <input Required type="text" class="form-control" name="alamat_penjual" placeholder="Alamat Toko">
                                            </div>
                                            <div class="form-group">
                                              <label>No Telp</label>
                                              <input required type="telp" class="form-control" name="telp_penjual" placeholder="Nomor Telepon Toko">
                                            </div>
                                            <div class="form-group">
                                            <button type="submit" class="btn btn-primary" name="tambah_penjual">Submit</button>   
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
              <!-- Akhir Modal-->

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
        $('#tokoTable').DataTable({
          "scrollY": "40vh",
          "scrollCollapse": true,
        });
        $('.dataTables_length').addClass('bs-select');
      });
    </script>
    <script>
      $(document).ready(function () {
        $('#bukuTable').DataTable({
          "scrollY": "40vh",
          "scrollCollapse": true,
        });
        $('.dataTables_length').addClass('bs-select');
      });
    </script>
  </body>
</html>