<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Film</title>
</head>

<?php 
include "includes/config.php";
ob_start();
session_start();
if(!isset($_SESSION['emailuser']))
    header("location:login.php")
?>

<?php include "header.php"; ?>

<div class="container-fluid">
<div class="card shadow mb-4">

<?php
  include "includes/config.php";

  if(isset($_POST['Batal'])) {
    header("location:movie.php");
}

  if(isset($_POST['Simpan'])) {
  	if (isset($_REQUEST['inputKode'])) {
  		$movieID = $_REQUEST['inputKode'];
  	}

  	if (!empty($movieID)) {
  		$movieID = $_POST['inputKode'];
  	}
  	else {
  		die("Masukkan Data dengan benar!");
  	}

  	$namamovie = $_POST['inputMerk'];
  	$genremovie = $_POST['inputType'];

	$nama = $_FILES['file']['name'];
	$file_tmp = $_FILES["file"]["tmp_name"];

	if (empty($nama)) {
		mysqli_query($connection, "UPDATE movie SET namamovie = '$movieID', '$namamovie', '$genremovie', 'no_images.png'");
		header("location:movie.php");
	}
	else {
		$ekstensiFile = pathinfo($nama, PATHINFO_EXTENSION);

		// PERIKSA EKSTENSI FILE
		if(($ekstensiFile == "png") or ($ekstensiFile == "PNG")) {
			move_uploaded_file($file_tmp, 'images/'.$nama); // Unggah File Ke Folder images
			mysqli_query($connection, "UPDATE movie SET namamovie = '$movieID', '$namamovie', '$genremovie', '$nama'");
			header("location:movie.php");
		}
	}
  }


  $kodeFoto = $_GET["ubah"];
  $editFoto = mysqli_query($connection, "SELECT * FROM movie
      WHERE movieID = '$kodeFoto'");
  $rowEdit = mysqli_fetch_array($editFoto);

  $editArea = mysqli_query($connection, "SELECT * FROM movie");
  $rowEdit2 = mysqli_fetch_array($editArea);

?>

<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Film</title>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>

	<div class="row">
		<div class="col-sm-1"></div>

	    <div class="col-sm-10">
	    	<div class="jumbotron jumbotron-fluid">
				<div class="container">
					<h1 class="display-4">Input Film</h1>
				</div>
			</div> <!-- Penutup Jumbotron -->

	      	<form method="POST">
	        	<div class="form-group row">
	          		<label for="movieID" class="col-sm-2 col-form-label">ID Film</label>
	          		<div class="col-sm-10">
	            		<input type="text" class="form-control" id="movieID" name="inputKode" placeholder="Input ID Film" maxlength="4">
	          		</div>
	        	</div>

		        <div class="form-group row">
		          	<label for="namamovie" class="col-sm-2 col-form-label">Nama Film</label>
		          	<div class="col-sm-10">
		            	<input type="text" class="form-control" id="namamovie" name="inputMerk" placeholder="Input Nama Film" maxlength="35">
		          	</div>
		        </div>

		        <div class="form-group row">
		          	<label for="genremovie" class="col-sm-2 col-form-label">Genre</label>
		         	<div class="col-sm-10">
		            	<input type="text" class="form-control" id="genremovie" name="inputType" placeholder="Input Genre Film" maxlength="35">
		          	</div>
		        </div>

				<div class="form-group row">
					<label for="file" class="col-sm-2 col-form-label">Foto Film</label>
					<div class="col-sm-10">
						<input type="file" id="file" name="file">
						<p class="help-block">Field ini digunakan untuk mengunggah file</p>
					</div>
				</div>

		        <div class="form-group row">
		          	<div class="col-sm-2">
		          	</div>
		          	<div class="col-sm-10">
		            	<input type="submit" class="btn btn-primary" value="Simpan" name="Simpan">
		          	</div>
		        </div>
	      	</form>
	    </div>

	    <div class="col-sm-1"></div>
	</div> <!-- Penutup Class row -->

	<!-- Memulai dengan menampilkan data -->
	<div class="row">
		<div class="col-sm-1"></div>
		<div class="col-sm-10">
			<div class="jumbotron jumbotron-fluid">
				<div class="container">
					<h1 class="display-4">Daftar Film</h1>
				</div>
			</div> <!-- Penutup Jumbotron -->

			<form method="POST">
				<div class="form-group row mb-2">
					<label for="search" class="col-sm-3">Cari Film</label>
					<div class="col-sm-6">
						<input type="text" name="search" class="form-control" id="search" value="<?php if (isset($_POST['search'])) {echo $_POST['search'];} ?>" placeholder="Cari Film">
					</div>
					<input type="submit" name="kirim" class="col-sm-1 btn btn-primary" value="Search">
				</div>
			</form>

			<table class="table table-hover table-danger">
				<thead class="thead-dark">
					<tr>
						<th>Nomor</th>
						<th>ID Film</th>
						<th>Nama Film</th>
						<th>Genre Film</th>
						<th>Foto Film</th>
						<th colspan="2" style="text-align: center">Action</th>
					</tr>
				</thead>

				<tbody>
					<?php
							$query = mysqli_query($connection, "SELECT * from movie WHERE movieID = movieID");
						

						$nomor = 1;
						while ($row = mysqli_fetch_array($query)) {?>
							<tr>
								<td><?php echo $nomor; ?></td>
								<td><?php echo $row['movieID']; ?></td>
								<td><?php echo $row['namamovie']; ?></td>
								<td><?php echo $row['genremovie']; ?></td>

								<td>
									<?php
										if(is_file("images/".$row['fotoFile'])) { ?>
											<img src="images/<?php echo $row['fotoFile'] ?>" width="80">
									<?php
										}

										else {
											echo "<img src='images/no_images.png' width='80'>";
										}
									?>
								</td>


								<!-- Untuk icon Edit dan Delete -->
								<td>
								<a href="movieedit.php?ubah=<?php echo $row['movieID']?>"
                                class="btn btn-success btn-sm" title="EDIT">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path
                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd"
                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                </svg>
                            </a>
								</td>

								<td>
									<a href="moviehapus.php?hapus=<?php echo $row["movieID"] ?>" class="btn btn-danger btn-sm" title="DELETE">
										<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
	  										<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
	  										<path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
										</svg>
									</a>
								</td>
								<!-- Akhir icon Edit dan Delete -->
							</tr>
						<?php
						$nomor = $nomor + 1;
						}
						?>
				</tbody>
			</table>
		</div>
		<div class="col-sm-1"></div>
	</div>

<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>


</div>
</div> <!-- Penutup container-fluid -->
<?php include "footer.php"; ?>

<?php
    mysqli_close($connection);
    ob_end_flush();
?>

</html>