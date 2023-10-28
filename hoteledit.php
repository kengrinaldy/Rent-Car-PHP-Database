<!DOCTYPE html>
<?php 
ob_start();
session_start();
if(!isset($_SESSION['emailuser']))
    header("location:login.php")
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

</head>

<?php include "header.php"; ?>

<div class="container-fluid">
<div class="card shadow mb-4"> 

<?php
    include "includes/config.php";
    if(isset($_POST["Batal"])){
    header("location:hotel.php");
  }

    if(isset($_POST['Ubah']))
    {

        if (isset($_REQUEST['inputidhtl']))
        {
            $idhtl = $_REQUEST['inputidhtl'];
        }

        if (!empty($idhtl))
        {
            $idhtl = $_REQUEST['inputidhtl'];
        }
        else {
            die ("Anda harus memasukkan kodenya");
        }

        $idhtl = $_POST['inputidhtl'];
        $namahtl = $_POST['inputnamahtl'];
        $alamathtl = $_POST['inputalamathtl'];
        $kethtl = $_POST['inputkethtl'];
        $areakode = $_POST['inputkodearea'];

        $nama = $_FILES['inputphotohtl']['name'];
        $file_tmp = $_FILES["inputphotohtl"]["tmp_name"];

        $ekstensifile = pathinfo($nama,PATHINFO_EXTENSION);

        if(($ekstensifile == "JPG") or ($ekstensifile == "jpg") or ($ekstensifile == "png"))
        {
            move_uploaded_file($file_tmp, 'images/'.$nama);
            mysqli_query($connection, "INSERT INTO hotel value ('$idhtl', '$namahtl', '$alamathtl', '$kethtl', '$nama', '$areakode')");
            header("location:hotel.php");
      } else
        $ekstensifile = pathinfo($nama, PATHINFO_EXTENSION);
        
        if(($ekstensifile == "JPG") or ($ekstensifile == "jpg") or ($ekstensifile == "png")) {
            if(($ekstensifile1 == "JPG") or ($ekstensifile1 == "jpg") or ($ekstensifile1 == "png")){
            move_uploaded_file($file_tmp, 'images/'.$nama); 
            mysqli_query($connection, "UPDATE kabupaten SET hotelnama ='$namahtl', hotelalamat ='$alamathtl', hotelketerangan ='$kethtl', hotelfoto ='$nama', areaID ='$areakode'
            WHERE hotelID = '$idhtl'");
            header("location:hotel.php");
        }
    }
}
    $dataarea = mysqli_query($connection, "select * from area");



    $idhtl = $_GET["ubahHotel"];
       $edithtl = mysqli_query($connection, "SELECT * FROM hotel WHERE hotelID = '$idhtl'" );
       $rowedit = mysqli_fetch_array($edithtl);

       $edithtl = mysqli_query ($connection, "SELECT * from hotel, area
       where hotelID = '$idhtl' and hotel.areaID = area.areaID");
       $rowedit2 = mysqli_fetch_array($edithtl);

?>

<body>
<div class="row">
    <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h1 class="display-4">Edit Hotel Wisata </h1>
                </div>
            </div>



    <form method="POST" enctype="multipart/form-data">
        <div class="form-group row">
            <label for="idhtl" class="col-sm-2 col-form-label">Hotel ID</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="idhtl" name="inputidhtl"
                value="<?php echo $rowedit["hotelID"]?>">
            </div>
        </div>

        <div class="form-group row">
            <label for="namahtl" class="col-sm-2 col-form-label">Nama Hotel</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="namahtl" name="inputnamahtl"
                value="<?php echo $rowedit["hotelnama"]?>">
            </div>
        </div>

        <div class="form-group row">
            <label for="alamathtl" class="col-sm-2 col-form-label">Alamat Hotel</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="alamathtl" name="inputalamathtl"
                value="<?php echo $rowedit["hotelalamat"]?>">
            </div>
        </div>

        <div class="form-group row">
            <label for="kethtl" class="col-sm-2 col-form-label">Keterangan Hotel</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="kethtl" name="inputkethtl"
                value="<?php echo $rowedit["hotelketerangan"]?>">
            </div>
        </div>


        <div class="form-group row">
            <label for="photohtl" class="col-sm-2 col-form-label">Photo Hotel</label>
            <div class="col-sm-10">
                <input type="file" id="photohtl" name="inputphotohtl" value="<?php echo $rowedit["hotelfoto"]?>">

                <p class="help-block">Unggah File</p>
            </div>
        </div>

        <div class="form-group row">
            <label for="kodearea" class="col-sm-2 col-form-label">Area ID</label>
            <div class="col-sm-10">
                <select class="form-control" id="kodearea" name="inputkodearea"
                placeholder="Area ID">

                <?php
                            while ($row = mysqli_fetch_array($dataarea)) {
                        ?>
                        <option  value="<?php echo $row ["areaID"]?>">
                            <?php echo $row["areaID"]?>
                        </option>
                        <?php } ?> 
                        
                </select>
            </div>
        </div>

        <div class="form-group now">
            <div class="col-sm-2"></div>
            <div class="col-sm-10">
                <input type="submit" name="Ubah" class="btn btn-primary" value="Ubah">
                <input type="submit" name="Batal" class="btn btn-secondary" value="Batal">
            </div>
        </div>

    </form>

    <div class="col-sm-1"></div>
</div>
</div>
                

<div class="row">
    <div class="col-sm-1"></div>
    <div class="col-sm-10">
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4">Daftar Hotel Wisata</h1>
            </div>
        </div>

    <table class="table table-hover table-danger">
        <thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>Hotel ID</th>
                <th>Hotel Nama</th>
                <th>Hotel Alamat</th>
                <th>Hotel Keterangan</th>
                <th>Hotel Photo</th>
                <th>Area ID</th>
                <th colspan="2" style="text-align: center">Action</th>
            </tr>
        </thead>

        <tbody>
            <?php $query = mysqli_query($connection, "select * from hotel");
            $nomor =1;
            while ($row = mysqli_fetch_array($query))
            { ?>
                <tr>
                    <td><?php echo $nomor;?></td>
                    <td><?php echo $row['hotelID'];?></td>
                    <td><?php echo $row['hotelnama'];?></td>
                    <td><?php echo $row['hotelalamat'];?></td>
                    <td><?php echo $row['hotelketerangan'];?></td>
                    <td>
                        <?php if(is_file("images/".$row['hotelfoto']))
                        { ?>
                            <img src="images/<?php echo $row['hotelfoto']?>" width="80">
                        <?php }  else
                            echo "<img src='images/noimage.png' width = '80'>"
                        ?>
                    </td>
                    <td><?php echo $row['areaID'];?></td>
                    <td>

                    <a href="hoteledit.php?ubahHotel=<?php echo $row['hotelID']?>" class="btn btn-success btn-sm" title="EDIT">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                    </svg>
                    
                    </a>
                    </td>
                    
                    <td>
                        
                        <a href="hotelhapus.php?hapushotel=<?php echo $row['hotelID']?>"
                        class="btn btn-danger btn-sm" title="DELETE">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                        </svg>
                        
                        </a>
                    </td>

                </tr>

                <?php $nomor = $nomor + 1;?>

            <?php }?>
            
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
<?php mysqli_close($connection);
ob_end_flush();
?>

</html>