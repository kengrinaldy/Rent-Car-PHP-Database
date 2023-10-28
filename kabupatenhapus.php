<?php 
    include "includes/config.php";
    if(isset($_GET['hapuskabupaten'])){
        $kabupatenKODE = $_GET['hapuskabupaten'];
        $hapus = mysqli_query($connection, "SELECT * FROM kabupaten WHERE kabupatenKODE = '$kabupatenKODE'");
        $hapus = mysqli_fetch_array($hapus);
        $namafile = $hapus['fotofile'];

        mysqli_query($connection, "DELETE FROM kabupaten WHERE kabupatenKODE = '$kabupatenKODE'");
        unlink('images/'.$namafile);

        echo "<script>alert('DATA TELAH DIHAPUS'); document.location='kabupaten.php'</script>";
    }
?>