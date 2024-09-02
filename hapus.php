<?php
include 'db.php';

if(isset($_GET['dlt'])) {
    $user_id = $_GET['dlt'];

    // Mulai transaksi
    mysqli_begin_transaction($conn);

    // Hapus komentar terlebih dahulu
    $delete_comments = mysqli_query($conn, "DELETE FROM komentar_foto WHERE foto_id IN (SELECT foto_id FROM foto WHERE user_id = '".$user_id."')");

    // Hapus like
    $delete_likes = mysqli_query($conn, "DELETE FROM like_foto WHERE user_id = '".$user_id."'");

    // Mengambil lokasi file foto yang akan dihapus
    $get_photos = mysqli_query($conn, "SELECT foto_id, lokasi_file FROM foto WHERE user_id = '".$user_id."'");
    while($photo = mysqli_fetch_assoc($get_photos)) {
        $foto_id = $photo['foto_id'];
        $file_path = './foto/'.$photo['lokasi_file'];
        // Hapus file foto dari folder
        if(file_exists($file_path)) {
            unlink($file_path);
        }
        // Hapus foto dari database setelah file foto dihapus dari folder
        mysqli_query($conn, "DELETE FROM foto WHERE foto_id = '".$foto_id."'");
    }

    // Hapus pengguna
    $delete_user = mysqli_query($conn, "DELETE FROM user WHERE user_id = '".$user_id."'");

    if($delete_comments && $delete_likes && $delete_user){
        // Commit transaksi
        mysqli_commit($conn);
        echo '<script>alert("Akun, komentar, dan semua like terkait telah dihapus.");window.location="index.php"</script>';
    } else {
        // Rollback transaksi jika terjadi kesalahan
        mysqli_rollback($conn);
        echo '<script>alert("Gagal menghapus data.");window.location="profil.php"</script>';
    }
} else {
    echo '<script>alert("Gagal menghapus akun terkait.");window.location="profil.php"</script>';
}
?>
