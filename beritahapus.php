<?php 
    include "includes/config.php";
    if(isset($_GET['hapus'])){
        $beritaID = $_GET['hapus'];
        $hapus = mysqli_query($connection, "SELECT * FROM berita WHERE beritaID = '$beritaID'");
        $hapus = mysqli_fetch_array($hapus);
        $namafile = $hapus['fotofile'];

        mysqli_query($connection, "DELETE FROM berita WHERE beritaID = '$beritaID'");
        unlink('images/'.$namafile);

        echo "<script>alert('DATA TELAH DIHAPUS'); document.location='berita.php'</script>";
    }
?>