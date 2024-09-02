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
            <h3>Tambah Data Foto</h3>
            <div class="box">
             
               <form action="" method="POST" enctype="multipart/form-data">

                   <input type="hidden" name="userid" value="<?php echo $_SESSION['a_global']->user_id ?>">
                   <input type="text" name="namauser" class="input-control" value="<?php echo $_SESSION['a_global']->nama_lengkap ?>" readonly="readonly">
                   <input type="text" name="nama" class="input-control" placeholder="Judul Foto" required>
                   <textarea class="input-control" name="deskripsi" placeholder="Deskripsi Foto"></textarea><br />
                   <input type="file" name="gambar" class="input-control" required>
                   <input type="submit" name="submit" value="Submit" class="btn" style="background-color: #518df5; color: #fff;">
               </form>
               <?php
                   if(isset($_POST['submit'])){
					   
					   // menampung inputan dari form
					   $idu       = $_POST['userid'];
					   $user      = $_POST['namauser'];
					   $nama      = $_POST['nama'];
					   $deskripsi = $_POST['deskripsi'];
					   
					   // menampung data file yang diupload
					   $filename = $_FILES['gambar']['name'];
					   $tmp_name = $_FILES['gambar']['tmp_name'];
					   
					   $type1 = explode('.', $filename);
					   $type2 = $type1[1];

                       $newname = 'foto'.time().'.'.$type2; 
						
					   // menampung data format file yang diizinkan
					   $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif');
					   
					   // validasi format file
					   if(!in_array($type2, $tipe_diizinkan)){
						  // jika format file tidak ada di dalam tipe diizinkan
						  echo '<script>alert("Format file tidak diizinkan")</script>';
						
					   }else{
						   // jika format file sesuai dengan yang ada di dalam array tipe diizinkan
						   // proses upload file sekaligus insert ke database
						   move_uploaded_file($tmp_name, './foto/'.$newname);
						   
						   // mendapatkan waktu unggah
						   $tanggal_unggah = date('Y-m-d H:i:s', time());

						   $insert = mysqli_query($conn, "INSERT INTO foto VALUES (
						               null,
									   '".$idu."',
									   '".$user."',
									   '".$nama."',
									   '".$deskripsi."',
									   '".$newname."',
									   '".$tanggal_unggah."'
						                   ) ");
										   
				           if($insert){
							   echo '<script>alert("Tambah Foto berhasil")</script>';
							   echo '<script>window.location="data-image.php"</script>';
						   }else{
							   echo 'gagal'.mysqli_error($conn);
							   
						   }
					   }
					}
			   ?>
        </div>
        </div>
    </div>
    
    <!-- footer -->
    <footer>
        <div class="container">
            <small>Copyright &copy; 2024 - Web Galeri Foto</small>
        </div>
    </footer>
    <script>
            CKEDITOR.replace( 'deskripsi' );
    </script>
    <script type="text/javascript"><?php echo $jsArray; ?></script>
</body>
</html>
