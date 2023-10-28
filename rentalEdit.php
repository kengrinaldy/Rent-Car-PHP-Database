<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>DB ADMIN - Rental Mobil</title>
</head>

<?php 
include "includes/config.php"; //tambahin ini
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
		header("location:rental.php");
	}

  if(isset($_POST['Edit'])) {
  	if (isset($_REQUEST['inputKode'])) {
  		$platKode = $_REQUEST['inputKode'];
  	}

  	if (!empty($platKode)) {
  		$platKode = $_POST['inputKode'];
  	}
  	else {
  		die("Plat Nomor belum dimasukan !!!");
  	}

  	$merkMobil = $_POST['inputMerk'];
  	$typeMobil = $_POST['inputType'];
  	$kodeArea = $_POST['kodeArea'];

  	mysqli_query($connection, "UPDATE rentalmobil SET merkMobil = '$merkMobil', typeMobil = '$typeMobil', areaID = '$kodeArea'
  		WHERE platID = '$platKode'");
  	header("location:rental.php");
  }

  $dataArea = mysqli_query($connection, "SELECT * FROM area");

  // Untuk menampilkan data pada form edit
  $kodeRental = $_GET["ubah"];
  $editRental = mysqli_query($connection, "SELECT * FROM rentalmobil
  	WHERE platID = '$kodeRental'");
  $rowEdit = mysqli_fetch_array($editRental);

  $editArea = mysqli_query($connection, "SELECT * FROM rentalmobil, area
  	WHERE platID = '$kodeRental' AND rentalmobil.areaID = area.areaID");
  $rowEdit2 = mysqli_fetch_array($editArea);
?>

<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Rental Mobil</title>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>

	<div class="row">
		<div class="col-sm-1"></div>

	    <div class="col-sm-10">
	    	<div class="jumbotron jumbotron-fluid">
				<div class="container">
					<h1 class="display-4">Edit Rental Mobil</h1>
				</div>
			</div> <!-- Penutup Jumbotron -->

	      	<form method="POST">
	        	<div class="form-group row">
	          		<label for="kodeMobil" class="col-sm-2 col-form-label">Plat Nomor</label>
	          		<div class="col-sm-10">
	            		<input type="text" class="form-control" id="kodeMobil" name="inputKode" value="<?php echo $rowEdit["platID"] ?>" readonly>
	          		</div>
	        	</div>

		        <div class="form-group row">
		          	<label for="merkMobil" class="col-sm-2 col-form-label">Merk Mobil</label>
		          	<div class="col-sm-10">
		            	<input type="text" class="form-control" id="merkMobil" name="inputMerk" value="<?php echo $rowEdit["merkMobil"] ?>">
		          	</div>
		        </div>

		        <div class="form-group row">
		          	<label for="typeMobil" class="col-sm-2 col-form-label">Type Mobil</label>
		         	<div class="col-sm-10">
		            	<input type="text" class="form-control" id="typeMobil" name="inputType" value="<?php echo $rowEdit["typeMobil"] ?>">
		          	</div>
		        </div>

		        <div class="form-group row">
		          	<label for="kodeArea" class="col-sm-2 col-form-label">Area Wisata</label>
		          	
		          	<div class="col-sm-10">
			          	<select class="form-control" id="kodeArea" name="kodeArea">
			          		<option value="<?php echo $rowEdit["areaID"] ?>">
			          			<?php echo $rowEdit['areaID'] ?>
			          			<?php echo $rowEdit2['areanama'] ?>
			          		</option>
				          	<?php
				          		while($row = mysqli_fetch_array($dataArea)) {
				          	?>

				          			<option value="<?php echo $row["areaID"] ?>">
				          				<?php echo $row["areaID"]; ?>
				          				<?php echo $row["areanama"]; ?>
				          			</option>
				          		
				          	<?php
				          		}
				          	?>
			          	</select>
			        </div>
		        </div>

		        <div class="form-group row">
		          	<div class="col-sm-2">
		          	</div>
		          	<div class="col-sm-10">
		            	<input type="submit" class="btn btn-primary" value="Edit" name="Edit">
		            	<input type="submit" class="btn btn-secondary" value="Batal" name="Batal">
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
					<h1 class="display-4">Daftar Rental Mobil</h1>
					<h2>Hasil entri data pada Tabel Rental Mobil</h2>
				</div>
			</div> <!-- Penutup Jumbotron -->

			<form method="POST">
				<div class="form-group row mb-2">
					<label for="search" class="col-sm-3">Type Mobil</label>
					<div class="col-sm-6">
						<input type="text" name="search" class="form-control" id="search" value="<?php if (isset($_POST['search'])) {echo $_POST['search'];} ?>" placeholder="Cari Type Mobil">
					</div>
					<input type="submit" name="kirim" class="col-sm-1 btn btn-primary" value="Search">
				</div>
			</form>

			<table class="table table-hover table-danger">
				<thead class="thead-dark">
					<tr>
						<th>No.</th>
						<th>Plat Nomor</th>
						<th>Merk Mobil</th>
						<th>Type Mobil</th>
						<th>Kode Area</th>
						<th>Nama Area</th>
						<th colspan="2" style="text-align: center">Action</th>
					</tr>
				</thead>

				<tbody>
					<?php
						if (isset($_POST["kirim"])) {
							$search = $_POST['search'];
							$query = mysqli_query($connection, "SELECT rentalmobil.*, area.areaID, area.areaNama
								FROM rentalmobil, area
								WHERE TypeMobil LIKE '%".$search."%'
								AND rentalmobil.areaID = area.areaID");
						} 

						else {
							$query = mysqli_query($connection, "SELECT rentalmobil.*, area.areaID, area.areaNama
								FROM rentalmobil, area
								WHERE rentalmobil.areaID = area.areaID");
						}

						$nomor = 1;
						while ($row = mysqli_fetch_array($query)) {
					?>
							<tr>
								<td><?php echo $nomor; ?></td>
								<td><?php echo $row['platID']; ?></td>
								<td><?php echo $row['merkMobil']; ?></td>
								<td><?php echo $row['typeMobil']; ?></td>
								<td><?php echo $row['areaID']; ?></td>
								<td><?php echo $row['areaNama']; ?></td>

								<!-- Untuk icon Edit dan Delete -->
								<td>
									<a href="rentalEdit.php?ubah=<?php echo $row["platID"] ?>" class="btn btn-success btn-sm" title="EDIT">
										<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
	  										<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
	  										<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
										</svg>
									</a>
								</td>

								<td>
									<a href="rentalHapus.php?hapus=<?php echo $row["platID"] ?>" class="btn btn-danger btn-sm" title="DELETE">
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

<script type="text/javascript">
	$(document).ready(function() {
		$('#kodeArea').select2( {
			allowClear: true,
			placeholder: "Pilih Area Wisata"
		});
	});
</script>

</div>
</div> <!-- Penutup container-fluid -->
<?php include "footer.php"; ?>

<?php
    mysqli_close($connection);
    ob_end_flush();
?>

</html>