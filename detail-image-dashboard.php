<?php
    error_reporting(0);
    include 'db.php';

    session_start();

    if(isset($_GET['id'])) {
        $produk = mysqli_query($conn, "SELECT * FROM foto WHERE foto_id = '".$_GET['id']."' ");
        $p = mysqli_fetch_object($produk);
    } else {
        echo '<script>alert("ID foto tidak valid")</script>';
        echo '<script>window.location="index.php"</script>';
        exit();
    }

    // Cek apakah user sudah login
    if(isset($_SESSION['status_login']) && $_SESSION['status_login'] == true){
        // Perintah untuk menyukai foto
        if(isset($_POST['suka'])){
            // Mendapatkan id gambar
            $gambar_id = $_POST['gam'];
            // Mendapatkan id admin
            $user_id = $_SESSION['a_global']->user_id;
            // Cek apakah admin sudah melakukan like sebelumnya
            $cek_like = mysqli_query($conn, "SELECT * FROM like_foto WHERE user_id='$user_id' AND foto_id='$gambar_id'");
            if(mysqli_num_rows($cek_like) > 0){
                // Jika sudah melakukan like, hapus like
                $hapus_like = mysqli_query($conn, "DELETE FROM like_foto WHERE user_id='$user_id' AND foto_id='$gambar_id'");
                if($hapus_like){
                    // Redirect kembali ke halaman detail foto
                    echo '<script>window.location="detail-image-dashboard.php?id='.$_GET['id'].'"</script>';
                } else {
                    echo 'gagal'. mysqli_error($conn);
                }
            } else {
                // Jika belum melakukan like, tambahkan like baru
                $tambah_like = mysqli_query($conn, "INSERT INTO like_foto (foto_id, user_id, nama_lengkap, tanggal_like) VALUES ('$gambar_id', '$user_id', '".$_SESSION['a_global']->nama_lengkap."', DATE(CURRENT_TIMESTAMP))");
                if($tambah_like){
                    // Redirect kembali ke halaman detail foto
                    echo '<script>window.location="detail-image-dashboard.php?id='.$_GET['id'].'"</script>';
                } else {
                    echo 'gagal' .mysqli_error($conn);
                }
            }
        }
    } else {
        // Tampilkan pesan bahwa pengguna harus login
        echo 'Anda harus login untuk memberi like';
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WEB Galeri Foto</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <style>
    .icon {
        width: 35px; /* Sesuaikan dengan ukuran yang diinginkan */
        height: auto; /* Tetapkan tinggi otomatis agar gambar tidak terdistorsi */
    }
    .comment {
        margin: 8px;
    }
    </style>
</head>
<body>
    <!-- header -->
    <header style="background-color: #de5f90; color: #fff;">
        <div class="container">
            <h1><a href="dashboard.php">WEB GALERI FOTO</a></h1>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="profil.php">Profil</a></li>
                <li><a href="data-image.php">Data Foto</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </header>
    
    <!-- content -->
    <div class="section">
        <div class="container">
            <h3>Detail Foto</h3>
            <div class="box">
                <div class="col-2">
                   <img src="foto/<?php echo $p->lokasi_file ?>" width="100%" /> 
                </div>
                <div class="col-2">
                   <h3><?php echo $p->judul_foto ?></h3>
                   <h4  style="color: #f55177;">Nama User : <?php echo $p->nama_lengkap ?><br />
                   Upload Pada Tanggal : <?php echo $p->tanggal_unggah  ?></h4>
                   <p>Deskripsi :<br />
                        <?php echo $p->deskripsi_foto ?>
                   </p>
                </div>
                <div class="col-2">
        <!-- Tombol Like -->
        <?php  
            $like = mysqli_query($conn, "SELECT * FROM like_foto WHERE foto_id='".$_GET['id']."' ");
            $jumlah_like = mysqli_num_rows($like);

            // Menampilkan tombol Like atau Unlike berdasarkan apakah pengguna sudah melakukan like atau belum
            if(isset($_SESSION['status_login']) && $_SESSION['status_login'] == true){
                $user_id = $_SESSION['a_global']->user_id;
                $cek_like = mysqli_query($conn, "SELECT * FROM like_foto WHERE user_id='$user_id' AND foto_id='".$_GET['id']."'");
                if(mysqli_num_rows($cek_like) > 0){
                    // Jika sudah melakukan like, tampilkan tombol unlike
                    echo '<form action="" method="post">';
                    echo '<input type="hidden" name="gam" value="'.$p->foto_id.'">';
                    echo '<button type="submit" name="suka" class="like"><img src="img/like2.jpg" alt="Like Icon" class="icon"> ' . $jumlah_like . '</button>';
                    echo '</form>';
                } else {
                    // Jika belum melakukan like, tampilkan tombol like
                    echo '<form action="" method="post">';
                    echo '<input type="hidden" name="gam" value="'.$p->foto_id.'">';
                    echo '<button type="submit" name="suka" class="like"><img src="img/like.png" alt="Like Icon" class="icon"> ' . $jumlah_like . '</button>';
                    echo '</form>';
                }
            } else {
                // Jika belum login, tampilkan pesan untuk login
                echo '<button class="like">Like ' . $jumlah_like . '</button>';
            }
        ?>
    </div>
   <!-- Form Komentar -->
<form action="" method="post">
    <input type="hidden" name="image" value="<?php echo $p->foto_id ?>">
    <input type="hidden" name="userid" value="<?php echo $_SESSION['a_global']->user_id ?>" required>
    <input type="hidden" name="usernm" value="<?php echo $_SESSION['a_global']->nama_lengkap ?>" required>
    <textarea name="komentar" class="input-control" maxlength="80" placeholder="Tulis komentar..." required></textarea>
    <input type="submit" name="submit" value="Kirim" class="btn" style="background-color: #f55177; color: #fff;">
</form>

<?php 
$komentar = mysqli_query($conn, "SELECT * FROM komentar_foto WHERE foto_id = '".$_GET['id']."'");
$kom = mysqli_num_rows($komentar);
if(isset($_POST['submit'])){
    $image = $_POST['image'];
    $userid = $_POST['userid'];
    $usernm = $_POST['usernm'];
    $komen = $_POST['komentar'];
    $insert = mysqli_query($conn, "INSERT INTO komentar_foto VALUES (
        null,
        '".$image."',
        '".$userid."',
        '".$usernm."',
        '".$komen."',
        DATE(CURRENT_TIMESTAMP)
    )");
    if($insert){
        echo '<script>window.location="detail-image-dashboard.php?id='.$_GET['id'].'"</script>';
    }else{
        echo 'gagal'.mysqli_error($conn);
    }
}
?>

<br/>
<div class="">
    <h3>Komentar <?php echo $kom ?></h3>
    <div>
    <div class="comments-container">
    <?php 
    $up = mysqli_query($conn, "SELECT * FROM komentar_foto WHERE foto_id = '".$_GET['id']."' ORDER BY tanggal_komentar DESC ");
    if(mysqli_num_rows($up) > 0){
        while($u = mysqli_fetch_array($up)){
    ?>    

    <div class="comment">
        <h4><?php echo $u['nama_lengkap'] ?></h4>
        <h5><?php echo $u['isi_komentar'] ?></h5>
        <h6><?php echo $u['tanggal_komentar'] ?></h6>
    </div>
        <?php 
        if($_SESSION['id'] == $u['user_id']) {
        ?>       
        <div class="inpu2">
            <form action="" method="post">
                <input type="hidden" name="foto_id" value="<?php echo $p->foto_id ?>">
                <input type="hidden" name="hapus" value="<?php echo $u['komentar_id'] ?>">
                <button style="background-color:#CCC; border:none; cursor:pointer;" name="hapuskomen" onclick="return confirm('Yakin ingin hapus ?')">
                    <img src="img/hapus.png" width="35px" title="Hapus" alt="">
                </button>
            </form>
        </div> 
        <?php 
if(isset($_POST['hapuskomen'])){
    if(isset($_SESSION['a_global']->user_id)){ // Gunakan $_SESSION['a_global']->user_id
        $user_id = $_SESSION['a_global']->user_id;
        $foto_id = $_POST['foto_id'];
        $coment_id = $_POST['hapus']; // Perbaiki penulisan variabel ini
        mysqli_query($conn, "DELETE FROM komentar_foto WHERE foto_id='$foto_id' AND user_id='$user_id' AND komentar_id='$coment_id'"); // Perbaiki penulisan kolom 'komentar_id'
        echo '<script>window.location="detail-image-dashboard.php?id='.$_GET['id'].'"</script>';
    }else{
        echo'gagal' .mysqli_error($conn);
    }
}
?>

        <?php 
        }
        ?>
        <?php 
        }
        }else{?>
        <p>komentar tidak ada</p>
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