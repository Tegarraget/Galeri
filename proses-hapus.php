<?php
    include 'db.php';
      
    if(isset($_GET['idp'])){
        $foto_id = $_GET['idp'];
        
        // Hapus terlebih dahulu semua komentar yang terkait dengan foto ini
        $delete_komentar = mysqli_query($conn, "DELETE FROM komentar_foto WHERE foto_id = '".$foto_id."'");
        
        // Hapus semua like terkait dengan foto ini
        $delete_like = mysqli_query($conn, "DELETE FROM like_foto WHERE foto_id = '".$foto_id."'");
        
        if($delete_komentar && $delete_like){
            // Mengambil lokasi file foto yang akan dihapus
            $foto = mysqli_query($conn, "SELECT lokasi_file FROM foto WHERE foto_id = '".$foto_id."' ");
            $p = mysqli_fetch_object($foto);
            
            // Menghapus file foto dari folder
            $file_path = './foto/'.$p->lokasi_file;
            if(file_exists($file_path)) {
                unlink($file_path); // Hapus file foto dari folder
            }
            
            // Menghapus data dari tabel foto setelah semua komentar terkait dihapus
            $delete_foto = mysqli_query($conn, "DELETE FROM foto WHERE foto_id = '".$foto_id."'");
            
            if($delete_foto){
                echo '<script>alert("Postingan telah dihapus.");window.location="data-image.php"</script>';
            } else {
                echo '<script>alert("Gagal menghapus postingan.");window.location="data-image.php"</script>';
            }
        } else {
            echo '<script>alert("Gagal menghapus like atau komentar terkait.");window.location="data-image.php"</script>';
        }
    }
?>
