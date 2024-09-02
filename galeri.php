<?php
    error_reporting(0);
    include 'db.php';
    $kontak = mysqli_query($conn, "SELECT email, alamat FROM user WHERE user_id = 2");
    $a = mysqli_fetch_object($kontak);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
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
            <form action="galeri.php" method="GET">
                <input type="text" name="search" placeholder="Cari Foto" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>" />
                <input type="submit" name="cari" value="Cari Foto" style="background-color: #de5f90; color: #fff;"/>
            </form>
        </div>
    </div>

    <!-- new product -->
    <div class="section">
        <div class="container">
            <h3>Galeri Foto</h3>
            <div class="box">
                <?php
                    $where = '';
                    if(isset($_GET['search']) && $_GET['search'] != ''){
                        $where = "WHERE judul_foto LIKE '%".$_GET['search']."%'";
                    }
                    $foto = mysqli_query($conn, "SELECT * FROM foto $where");
                    if(mysqli_num_rows($foto) > 0){
                        while($p = mysqli_fetch_array($foto)){
                ?>
                <a href="detail-image.php?id=<?php echo $p['foto_id']; ?>">
                    <div class="col-4">
                        <img src="foto/<?php echo $p['lokasi_file']; ?>" height="150px" />
                        <p class="nama"><?php echo substr($p['judul_foto'], 0, 30); ?></p>
                        <p class="admin">Nama User : <?php echo $p['nama_lengkap']; ?></p>
                        <p class="tanggal"><?php echo $p['tanggal_unggah']; ?></p>
                    </div>
                </a>
                <?php 
                        }
                    } else {
                ?>
                <p>Foto tidak ada</p>
                <?php } ?>
            </div>
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
