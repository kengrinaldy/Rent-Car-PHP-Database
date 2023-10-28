<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Area</title>
</head>


<?php include "header.php"; ?>

<div class="container-fluid">
<div class="card shadow mb-4"> 

<?php
     include "includes/config.php";
     if(isset($_POST["Batal"])){
     header("location:area.php");
   }

    if(isset($_POST['Ubah'])) {
        if(isset($_REQUEST['inputkode']))
        {
            $areakode = $_REQUEST['inputkode'];
        }

        if(!empty($areakode))
        {
            $areakode = $_REQUEST['inputkode'];
        }
        else{
            die("anda harus memasukkan kodenya");
        }

        $areanama = $_POST['inputnama'];
        $areawilayah = $_POST['inputwilayah'];
        $keteranganarea = $_POST['inputket'];
        $kodekabupaten = $_POST['kodekabupaten'];

        mysqli_query($connection, "UPDATE area set 
        areanama = '$areanama', 
        areawilayah = '$areawilayah',
        areaketerangan = '$keteranganarea',
        kabupatenKODE = '$kodekabupaten'
        WHERE areaID = '$areakode'");
    }
    $datakabupaten = mysqli_query($connection, "select * from kabupaten");

    // edit 

    $kodearea = $_GET["ubah"];
    $editarea = mysqli_query($connection, "SELECT * FROM area
        where areaID = '$kodearea'");
    $rowedit = mysqli_fetch_array($editarea);

    $editarea = mysqli_query ($connection, "SELECT * from area, kabupaten
    where areaID = '$kodearea' and area.kabupatenKODE = kabupaten.kabupatenKODE");
    $rowedit2 = mysqli_fetch_array($editarea);
    
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Area Wisata</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>

    <div class="row">
            <div class="col-sm-1">
            
            </div>
            <div class="col-sm-10">

            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h1 class="display-4">Edit Area Wisata</h1>
                </div>
            </div>
        
            <form method="POST">
                <div class="form-group row">
                    <label for="kodearea" class="col-sm-2 col-form-label">Kode</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="kodearea" name="inputkode"
                    value="<?php echo $rowedit["areaID"]?>">
                    </div>
                </div>
        
                <div class="form-group row">
                    <label for="namaarea" class="col-sm-2 col-form-label">Nama Area</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="namaarea" name="inputnama"
                    value="<?php echo $rowedit["areanama"]?>">
                    </div>
                </div>
        
                <div class="form-group row">
                    <label for="wilayah" class="col-sm-2 col-form-label">Wilayah Area</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="wilayah" name="inputwilayah"
                    value="<?php echo $rowedit["areawilayah"]?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="keterangan" class="col-sm-2 col-form-label">Keterangan Area</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="keterangan" name="inputket"
                    value="<?php echo $rowedit["areaketerangan"]?>">
                    </div>
                </div>
        
                <div class="form-group row">
                    <label for="kodekabupaten" class="col-sm-2 col-form-label">Kabupaten</label>
                    <div class="col-sm-10">
                    <select  class="form-control" id="kodekabupaten" name ="kodekabupaten">
                        
                        <option  value="<?php echo $rowedit ["kabupatenKODE"]?>">
                            <?php echo $rowedit["kabupatenKODE"]?>
                            
                        </option>

                        <?php
                            while ($row = mysqli_fetch_array($datakabupaten)) {
                        ?>
                        <option  value="<?php echo $row ["kabupatenKODE"]?>">
                            <?php echo $row["kabupatenKODE"]?>
                            
                        </option>
                        <?php } ?> 
                        
                    </select>
                    </div>
                </div>
                

                <div class="form-group row">
                    <div class="col-sm-2"> 
        
                    </div>
                    <div class="col-sm-10">
                    <input type="submit" class="btn btn-primary" value="Ubah"
                    name="Ubah"> 
                    <input type="reset" class="btn btn-secondary" 
                    value="Batal" name="Batal">
                    </div>
                </div>
            </form>
        </div>
        
        <div class="col-sm-1">
            
        </div>
    </div>

    <!-- memulai dengan menampilkan data -->
    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h1 class="display-4">Daftar Area Wisata</h1>
                    <h2>Hasil Entry Data Pada Tabel Area</h2>
                </div>
            </div> <!-- penutup jumbotron -->


        <form method="POST">
            <div class="form-group row mb-2">
                <label for="search" class="col-sm-3">Nama Area </label>
                <div class="col-sm-6">
                    <input type="text" name="search" class="form-control" 
                    id="search" value="<?php if(isset($_POST['search'])){
                        echo $_POST['search'];
                    } ?>" 
                    placeholder="Cari Nama Destinasi">
                    <input type="submit" name="kirim" class="btn btn-primary"
                    value="Search">
                </div>
            </div>
        </form>

        <table class="table table-hover table-danger">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama Area</th>
                    <th>Wilayah Area</th>
                    <th>Area Keterangan</th>
                    <th>Kode Kabupaten</th>
                 
                    <th colspan="2" style="text-align: center;">Action</th>
                </tr>
            </thead>

            <tbody>
            <?php
            if(isset($_POST["kirim"])){
                $search = $_POST['search'];
                $query = mysqli_query($connection, "select area.*, kabupaten.kabupatenKODE  from area, kabupaten
                where areanama like '%".$search."%'
                and area.kabupatenKODE = kabupaten.kabupatenKODE");
                
            }
            else{
                $query = mysqli_query($connection, "select * from area");
            }

                $nomor = 1;
                while ($row = mysqli_fetch_array($query)){ 
            ?>
                    <tr>
                        <td><?php echo $nomor;?></td>
                        <td><?php echo $row['areaID'];?></td>
                        <td><?php echo $row['areanama'];?></td>
                        <td><?php echo $row['areawilayah'];?></td>
                        <td><?php echo $row['areaketerangan'];?></td>
                        <td><?php echo $row['kabupatenKODE'];?></td>
                        

                        <!--edit icon-->
                        <td>

                            <a href="areaedit.php?ubah=<?php echo $row['areaID']?>"
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
                        <!--trash icon-->
                        <td>
                            <a href="areahapus.php?hapus=<?php echo $row['areaID']?>"
                                class="btn btn-danger btn-sm" title="DELETE">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-trash3" viewBox="0 0 16 16">
                                    <path
                                        d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                </svg>
                            </a>
                        </td>
                    </tr>
            <?php   $nomor++;
                    }
            ?>

            </tbody>
        </table>
        </div>
        <div class="col-sm-1">

        </div>

    </div>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type ="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2
/4.0.3/js/select2.min.js"></script>


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