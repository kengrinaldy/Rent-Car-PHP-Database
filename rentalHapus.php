<?php
	include "includes/config.php";
	if(isset($_GET['hapus'])) {
		$kodePlat = $_GET["hapus"];
		mysqli_query($connection, "DELETE FROM rentalmobil
			WHERE PlatID = '$kodePlat'");
		echo "<script>alert('Data Berhasil Dihapus !!!');
		document.location = 'rental.php'</script>";
	}
?>