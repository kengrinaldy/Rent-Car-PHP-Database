<?php
	include "includes/config.php";
	if(isset($_GET['hapus'])) {
		$kodeProvinsi = $_GET["hapus"];
		mysqli_query($connection, "DELETE FROM provinsi
			WHERE provinsiID = '$kodeProvinsi'");
		echo "<script>alert('Data Berhasil Dihapus !!!');
		document.location = 'provinsi.php'</script>";
	}
?>