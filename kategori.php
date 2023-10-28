<!DOCTYPE html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Kategori</title>
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

    if(isset($_POST['Simpan'])){
        if (isset($_REQUEST['inputKode'])){
            $kategoriKode = $_REQUEST['inputKode'];
        }
        if (!empty($kategoriKode)){
            $kategoriKode = $_REQUEST['inputKode'];
        }
        else {
            ?> <h1>Anda Harus Mengisi Data<h1> <?php
            die ("Anda Harus Memasukkan Datanya");
        }

        $kategoriNama = $_POST['inputNama'];
        $kategoriKeterangan = $_POST['inputKeterangan'];
        $kategoriReferensi = $_POST['inputReferensi'];

        mysqli_query($connection, "insert into kategori values ('$kategoriKode', '$kategoriNama', '$kategoriKeterangan', '$kategoriReferensi')");
        header("location:kategori.php");
    }
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Output Kategori Wisata</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    </head>
    <body>
        <div class="row">
            <div class="col-sm-1">

            </div>
            <div class="col-sm-10">
                <div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <h1 class="display-4">Input Kategori Wisata</h1>
                    </div>
                </div>
                <form method="POST">
                    <div class="form-group row">
                        <label for="kategoriID" class="col-sm-2 col-form-label">Kode</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="kategoriID" placeholder="Kode Kategori" name="inputKode" maxlength="4">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kategoriNama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="kategoriNama" placeholder="Nama Kategori" name="inputNama">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kategoriKeterangan" class="col-sm-2 col-form-label">Keterangan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="kategoriKeterangan" placeholder="Keterangan Kategori" name="inputKeterangan">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kategoriReferensi" class="col-sm-2 col-form-label">Referensi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="kategoriReferensi" placeholder="Referensi Kategori" name="inputReferensi">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2">
                            
                        </div> 
                        <div class="col-sm-10">
                            <input type="submit" class="btn btn-primary" value="Simpan" name="Simpan">
                            <input type="reset" class="btn btn-secondary" value="Batal" name="Batal">
                        </div>         
                    </div>
                </form>
            </div>       
            <div class="col-sm-1">

            </div>
        </div>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <h1 class="display-4">Daftar Kategori Wisata</h1>
                        <h2>Hasil Entri Data pada Tabel Kategori</h2>
                    </div>
                </div>
                <form method="POST">
                    <div class="form-group row mb-2">
                        <label for="search" class="col-sm-3">Nama Kategori</label>
                        <div class="col-sm-6">
                            <input type="text" name="Search" class="form-control" id="search" placeholder="Cari Nama Kategori" 
                            value="<?php 
                                if(isset($_POST['Search'])){ 
                                    echo $_POST['Search']; 
                                } 
                            ?>">
                        </div>
                        <input type="submit" name="Kirim" class="col-sm-1 btn-primary" value="Search">
                    </div>
                </form>
                <table class="table table-hover table-danger">
                    <thead class="thead-dark">
                        <tr>
                            <th>Nomor</th>
                            <th>Kode Kategori</th>
                            <th>Nama Kategori</th>
                            <th>Keterangan Kategori</th>
                            <th>Referensi Kategori</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if(isset($_POST["Kirim"])){
                                $search = $_POST['Search'];
                                $query = mysqli_query($connection, "select * from kategori where kategoriNama like '%".$search."%' 
                                or kategoriReferensi like '%".$search."%'
                                or kategoriKeterangan like '%".$search."%' ");
                            }
                            else{
                                $query = mysqli_query($connection, "select * from kategori");
                            }

                            $nomor = 1;
                            while ($row = mysqli_fetch_array($query)){ ?>
                                <tr>
                                    <td><?php echo $nomor;?></td>
                                    <td><?php echo $row['kategoriID'];?></td>
                                    <td><?php echo $row['kategorinama'];?></td>
                                    <td><?php echo $row['kategoriketerangan'];?></td>
                                    <td><?php echo $row['kategorireferensi'];?></td>
                                </tr>
                                <?php $nomor = $nomor + 1;?>
                            <?php } 
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-sm-1">
                
            </div>
        </div>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
    </body>
    <?php include "footer.php"; ?>
    <?php
    mysqli_close($connection);
    ob_end_flush();
?>
</html>