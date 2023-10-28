<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Berita</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>

<?php
ob_start();
session_start();
if(!isset($_SESSION['emailuser']))
	header("location:login.php");
?>

<?php include "header.php";?>

<div class="container-fluid">
<div class="card shadow mb-4">

<?php
    include "includes/config.php";
    if(isset($_POST["Batal"])){
        header("location:berita.php");
      }
    if(isset($_POST['Simpan'])) {
        if(isset($_REQUEST['inputkode']))
        {
            $beritakode = $_REQUEST['inputkode'];
        }

        if(!empty($beritakode))
        {
            $beritakode = $_REQUEST['inputkode'];
        }
        else{
            die("anda harus memasukkan kodenya");
        }

        $judulberita = $_POST['inputjudul'];
        $intiberita = $_POST['inputinti'];
        $penulis = $_POST['inputpenulis'];
        $penerbit = $_POST['inputpenerbit'];
        $tanggal = $_POST['inputtanggal'];
        $kodedestinasi = $_POST['kodedestinasi'];
    
		
		mysqli_query($connection, "UPDATE berita set 
        beritajudul= '$judulberita', beritainti= '$intiberita', penulis= '$penulis', penerbit= '$penerbit', tanggalterbit= '$tanggal', destinasiID= '$kodedestinasi'
		WHERE beritaID= '$beritakode' ");
        header("location:berita.php");

       
    }
    $datadestinasi = mysqli_query($connection, "select * from destinasi");
	
	$beritakode = $_GET["ubah"];
    $editfoto = mysqli_query($connection, "SELECT * FROM berita
                WHERE beritaID = '$beritakode' ");

    $rowedit = mysqli_fetch_array($editfoto);
    $editarea = mysqli_query($connection, "SELECT * FROM destinasi, berita
                WHERE beritaID = '$beritakode' and berita.destinasiID = destinasi.destinasiID" );

    $rowedit2 = mysqli_fetch_array($editarea);
?>

<body>
    


</div>

    <div class="row">
            <div class="col-sm-1">
            
            </div>
            <div class="col-sm-10">

            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h1 class="display-4">Input Berita</h1>
                </div>
            </div>
        
            <form method="POST">
                <div class="form-group row">
                    <label for="kodeberita" class="col-sm-2 col-form-label">ID</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="kodeberita" name="inputkode"
                    value="<?php echo $rowedit["beritaID"]?>" readonly>

                    </div>
                </div>
        
                <div class="form-group row">
                    <label for="judulberita" class="col-sm-2 col-form-label">Input Judul</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="judulberita" name="inputjudul"
                    value="<?php echo $rowedit["beritajudul"]?>">
                    </div>
                </div>
        
                <div class="form-group row">
                    <label for="inti" class="col-sm-2 col-form-label">Input Berita</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="inti" name="inputinti"
                    value="<?php echo $rowedit["beritainti"]?>">

                    </div>
                </div>

                <div class="form-group row">
                    <label for="penulis" class="col-sm-2 col-form-label">Penulis</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="penulis" name="inputpenulis"
                    value="<?php echo $rowedit["penulis"]?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="penerbit" name="inputpenerbit"
                    value="<?php echo $rowedit["penerbit"]?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tanggal" class="col-sm-2 col-form-label">Tanggal Terbit</label>
                    <div class="col-sm-10">
                    <input type="date" class="form-control" id="tanggal" name="inputtanggal"
                    value="<?php echo $rowedit["tanggalterbit"]?>">
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="destinasi" class="col-sm-2 col-form-label">ID Destinasi</label>
                    <div class="col-sm-10">
                    <select class="form-control" id ="kodedestinasi" name ="kodedestinasi">
                    <option value="<?php echo $rowedit['destinasiID']?>">
                        <?php
                            while ($row = mysqli_fetch_array($datadestinasi)) {
                        ?>
                        <option value="<?php echo $row["destinasiID"]?>">
                            <?php echo $row["destinasiID"]?>
                            <?php echo $row["destinasinama"]?>
                        </option>
                        <?php } ?> 
                    </select>
                    </div>
                </div>
        
                

                <div class="form-group row">
                    <div class="col-sm-2"> 
        
                    </div>
                    <div class="col-sm-10">
                    <input type="submit" class="btn btn-primary" value="Simpan"
                    name="Simpan"> 
                    <input type="reset" class="btn btn-secondary" 
                    value="Batal" name="Batal">
                    </div>
                </div>
            </form>
        </div>
        
        <div class="col-sm-1">
            
        </div>
    </div>

    <div class="col-sm-1"></div>
</div>

<div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h1 class="display-4">Daftar Berita</h1>
                    <h2>Hasil Entry Data Pada Tabel Berita</h2>
                </div>
            </div> 
    
    
            <table class="table table-hover table-danger">
            <thead class="thead-dark">
                <tr>
                    <th>Nomor</th>
                    <th>ID Berita</th>
                    <th>Judul Berita</th>
                    <th>Inti Berita</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Tanggal Terbit</th>
                    <th>ID Destinasi</th>
                    <th>Nama Destinasi</th>
                    <th colspan="2" style="text-align: center">Action</th>
                </tr>
            </thead>

            <tbody>
            <?php
            if(isset($_POST["kirim"])){
                $search = $_POST['search'];
                $query = mysqli_query($connection, "select berita.*, destinasi.destinasiID, destinasi.destinasiNama from destinasi, berita
                where beritajudul like '%".$search."%'
                and berita.destinasiID = destinasi.destinasiID");
                
            }
            else{
                $query = mysqli_query($connection, "select berita.*, destinasi.destinasiID, destinasi.destinasiNama from destinasi, berita
                where berita.destinasiID = destinasi.destinasiID");
            }

                $nomor = 1;
                while ($row = mysqli_fetch_array($query)){ 
            ?>
                <tr>
                        <td><?php echo $nomor;?></td>
                        <td><?php echo $row['beritaID'];?></td>
                        <td><?php echo $row['beritajudul'];?></td>
                        <td><?php echo $row['beritainti'];?></td>
                        <td><?php echo $row['penulis'];?></td>
                        <td><?php echo $row['penerbit'];?></td>
                        <td><?php echo $row['tanggalterbit'];?></td>
                        <td><?php echo $row['destinasiID'];?></td>
                        <td><?php echo $row['destinasiNama'];?></td>

                        <!--edit icon-->
                            <td>  
                                <a href="beritaedit.php?ubah=<?php echo $row['beritaID']?>"
                                    class="btn btn-success btn-sm" title="EDIT">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                    </svg>
                                </a>
                            </td>
                            <!--trash icon-->
                            <td>
                                <a href="beritahapus.php?hapus=<?php echo $row['beritaID']?>"
                                    class="btn btn-danger btn-sm" title="DELETE">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                </svg>
                            </a>
                        </td>
                    </tr>
            <?php   $nomor++;}
            ?>

            </tbody>
        </table>
    </div>

    <div class="col-sm-1"></div>

</div>

</body>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#kodekabupaten').select2({
            allowClear: true,
            placeholder:"Pilih Kabupaten Wisata"
        });
    });
</script>

</div>
</div> <!-- penutup container-fluid -->

<?php include "footer.php"; ?>

<?php 
            mysqli_close($connection);
            ob_end_flush();
        ?>

</html>