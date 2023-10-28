<?php
	include "includes/config.php";
	if(isset($_GET['hapus'])) {
		$movieID = $_GET["hapus"];
		mysqli_query($connection, "DELETE FROM movie
			WHERE movieID = '$movieID'");
		echo "<script>alert('Data Berhasil Dihapus !!!');
		document.location = 'movie.php'</script>";
	}
?>