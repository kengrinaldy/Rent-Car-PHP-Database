<?php 
    include "includes/config.php";
    if(isset($_GET['hapus'])){
        $areaID = $_GET['hapus'];
        $hapus = mysqli_query($connection, "SELECT * FROM area WHERE areaID = '$areaID'");
        $hapus = mysqli_fetch_array($hapus);
        $namafile = $hapus['fotofile'];

        mysqli_query($connection, "DELETE FROM area WHERE areaID = '$areaID'");
        unlink('images/'.$namafile);

        echo "<script>alert('DATA TELAH DIHAPUS'); document.location='area.php'</script>";
    }
?>