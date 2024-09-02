<?php
    session_start();
	include 'db.php';
	if($_SESSION['status_login'] != true){
		echo '<script>window.location="login.php"</script>';
    }
?>
<!DOCTYPE html >
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
        <h1><a href="dashboard.php">WEB GALERI FOTO</a></h1>
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
            <h3>Data Galeri Foto</h3>
            <div class="box">
                <p><a href="tambah-image.php"><button class="btn"  style="background-color: #518df5; color: #fff;">Tambah Data</button></a></p> <br/>
                <table border="1" cellspacing="0" class="table">
                    <thead>
                        <tr>
                           <th width="60px">No</th>
                           <th>Nama User</th>
                           <th>Nama Foto</th>
                           <th>Deskripsi</th>
                           <th>Gambar</th>
                           <th width="150px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
						    $no = 1;
							$user = $_SESSION['a_global']->user_id;
                            $foto = mysqli_query($conn, "SELECT * FROM foto WHERE user_id = '$user' ");
							if(mysqli_num_rows($foto) >0 ){
							while($row = mysqli_fetch_array($foto)){
						?>
                        <tr>
                           <td><?php echo $no++ ?></td>
                           <td><?php echo $row['nama_lengkap'] ?></td>
                           <td><?php echo $row['judul_foto'] ?></td>
                           <td><?php echo $row['deskripsi_foto']?></td>
                           <td><a href="foto/<?php echo $row['lokasi_file']?>" target="_blank"><img src="foto/<?php echo $row['lokasi_file']?>" width="50px"></a></td>
                           <td>
                              <a href="edit-image.php?id=<?php echo $row['foto_id'] ?>"><button style="padding: 8px 10px; background-color: #f999; color:  #518df5; border: none; cursor: pointer;">Edit</button></a> || 
                              <a href="proses-hapus.php?idp=<?php echo $row['foto_id'] ?>" onclick="return confirm('Yakin Ingin Hapus ?')"><button style="padding: 8px 10px; background-color:  #518df5; color: white; border: none; cursor: pointer;">Hapus</button></a>
                           </td>
                        </tr>
                        <?php }}else{ ?>
                             <tr>
                                <td colspan="8">Tidak ada data</td>
                             </tr>
                        <?php } ?>
                    </tbody>
                </table>
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