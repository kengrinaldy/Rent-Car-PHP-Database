<?php
	include "includes/config.php";
	
	if(isset($_GET['hapusFoto'])) {
		$MakananKode = $_GET['hapusFoto'];
		$hapusFoto = mysqli_query($connection, "SELECT * FROM makanan
			WHERE makananID = '$MakananKode'");
		$hapus = mysqli_fetch_array($hapusFoto);
		$namaFile = $hapus['fotoFile'];

		mysqli_query($connection, "DELETE FROM makanan
			WHERE makananID = '$MakananKode'");
		unlink('images/'.$namaFile);

		echo "<script>alert('Data Berhasil Dihapus !!!');
		document.location='makanan.php'</script>";
	}
?>