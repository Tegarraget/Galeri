<?php
    include 'db.php';
	$kontak = mysqli_query($conn, "SELECT email, alamat FROM user WHERE user_id = 2");
	$a = mysqli_fetch_object($kontak);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>WEB Galeri Foto</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <!-- header -->
    <header style="background-color: #de5f90; color: #fff;">
        <div class="container">
        <h1><a href="index.php">WEB GALERI FOTO</a></h1>
        <ul>
           <li><a href="registrasi.php">Registrasi</a></li>
           <li><a href="login.php">Login</a></li>
        </ul>
        </div>
    </header>
    
    <!-- search -->
    <div class="search">
        <div class="container">
            <form action="galeri.php">
                <input type="text" name="search" placeholder="Cari Foto" />
                <input type="submit" name="cari" value="Cari Foto" style="background-color: #de5f90; color: #fff;"/>
            </form>
        </div>
    </div></br>
    
    <!-- new product -->
    <div class="container">
       <h3>Foto Terbaru</h3>
       <div class="box">
          <?php
              $foto = mysqli_query($conn, "SELECT * FROM foto");
			  if(mysqli_num_rows($foto) > 0){
				  while($p = mysqli_fetch_array($foto)){
		  ?>
          <a href="detail-image.php?id=<?php echo $p['foto_id'] ?>">
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
    
    <!-- footer -->
     <footer>
        <div class="container">
            <small>Ujikom &copy; 2024 - Web Galeri Foto Elisa XII RPL 1.</small>
        </div>
    </footer>
</body>
</html>