<?php
    session_start();
	if($_SESSION['status_login'] != true){
		echo '<script>window.location="login.php"</script>';
    }
    include 'db.php';
	$kontak = mysqli_query($conn, "SELECT email, alamat FROM user WHERE user_id = 2");
	$a = mysqli_fetch_object($kontak);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>WEB Galeri Foto</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <!-- header -->
    <header style="background-color: #518df5; color: #fff;">
        <div class="container">
        <h1>WEB GALERI FOTO</h1>
        <ul>
           <li><a href="dashboard.php">Dashboard</a></li>
           <li><a href="profil.php">Profil</a></li>
           <li><a href="data-image.php">Foto</a></li>
           <li><a href="logout.php">Logout</a></li>
        </ul>
        </div>
    </header>
    
    <!-- content -->
    <div class="section">
        <div class="container">
            <h3>Dashboard</h3>
            <div class="box">
                <h4>Selamat Datang <?php echo $_SESSION['a_global']->nama_lengkap ?> di Website Galeri Foto</h4>
                <div class="box">
          <?php
              $foto = mysqli_query($conn, "SELECT * FROM foto");
			  if(mysqli_num_rows($foto) > 0){
				  while($p = mysqli_fetch_array($foto)){
		  ?>
          <a href="detail-image-dashboard.php?id=<?php echo $p['foto_id'] ?>">
          <div class="col-4">
              <img src="foto/<?php echo $p['lokasi_file'] ?>" height="150px" />
              <p class="nama"><?php echo substr($p['judul_foto'], 0, 30)  ?></p>
              <p class="admin">Nama User : <?php echo $p['nama_lengkap'] ?></p>
              <p class="nama"><?php echo $p['tanggal_unggah']  ?></p>
          </div>
          </a>
          <?php }}else{ ?>
              <p>Foto tidak ada</p>
          <?php } ?>
            </div>
        </div>
    </div>

    
    
    <!-- footer -->
    <footer>
        <div class="container">
            <small>Copyright &copy; 2024 - Web Galeri Foto</small>
        </div>
    </footer>
</body>
</html>