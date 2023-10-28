<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BERITA</title>
</head>

<?php 
    include "includes/config.php";
    ob_start();
    session_start();
    if(!isset($_SESSION['emailuser'])) 
    {
        header("location:login.php");
    }
?>

<?php include "header.php"; ?>

<div class="container-fluid">
<div class="card shadow mb-4">

<?php
    include "includes/config.php";

    if(isset ($_POST['Simpan']))
    {
    if (isset($_REQUEST['inputcodeB']))
    {
      $beritaID = $_REQUEST['inputcodeB'];
    }
    if (!empty ($beritaID))
    {
      $beritaID = $_REQUEST ['inputcodeB'];
    }
    else{
      die ("Anda harus memasukkan kodenya!");
    }
    
      $beritajudul = $_POST['beritajudul'];
      $beritainti = $_POST['beritainti'];
      $penulis = $_POST['penulis'];
      $penerbit = $_POST['penerbit'];
      $tanggalterbit = $_POST['tanggalterbit'];
      $bDestinasiKode = $_POST['inputDesCode'];

      mysqli_query($connection, "insert into berita value ('$beritaID','$beritajudul', '$beritainti', 
      '$penulis','$penerbit','$tanggalterbit','$bDestinasiKode')");
      header("location:berita.php");
    }

    $datadestinasi = mysqli_query($connection, "SELECT * FROM destinasi");
  ?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Berita  </title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<!--body dihapus-->

<div class="row">
<div class="col-sm-1">
</div>

<div class="col-sm-10">

<div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h1 class="display-4">Input Berita</h1>
                </div>
            </div> <!--penutup jumbotron-->

<form method="POST">
    <div class="form-group row">
        <label for="kodeberita" class="col-sm-2 col-form-label">ID Berita</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="kodeberita" name="inputcodeB"
            placeholder="Masukkan ID">
        </div>
    </div>

    <div class="form-group row">
        <label for="nameNews" class="col-sm-2 col-form-label"> Input Judul</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="nameNews" name="beritajudul"
            placeholder="Masukkan Judul">
        </div>
    </div>

    <div class="form-group row">
        <label for="mainNews" class="col-sm-2 col-form-label">Input Berita</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="mainNews" name="beritainti"
             placeholder="Masukkan Berita">
        </div>
    </div>

    <div class="form-group row">
        <label for="writerNews" class="col-sm-2 col-form-label">Penulis</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="writerNews" name="penulis"
             placeholder="Penulis">
        </div>
    </div>

    <div class="form-group row">
        <label for="pubNews" class="col-sm-2 col-form-label">Penerbit</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="pubNews" name="penerbit"
             placeholder="Penerbit">
        </div>
    </div>

    <div class="form-group row">
        <label for="dateNews" class="col-sm-2 col-form-label">Tanggal Terbit</label>
        <div class="col-sm-10">
            <input type="date" class="form-control" id="dateNews" name="tanggalterbit"
             placeholder="Tanggal Terbit">
        </div>
    </div>

    <div class="form-group row">
        <label for="refkategori" class="col-sm-2 col-form-label">ID Destinasi</label>
        <div class="col-sm-10">
            <select class="form-control" id="refkategori" name="inputDesCode">
            
                <option>
                    Destinasi Wisata
                </option>
        
            <?php while($row = mysqli_fetch_array($datadestinasi))
                { ?>
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
            <input type="submit" class="btn btn-primary" value="Simpan" name="Simpan">
            <input type="reset" class="btn btn-secondary" value="Batal" name="Batal">
        </div>
    </div>

    </form>
</div>

<div class="col-sm-1">
</div>
</div> <!--penutup class row-->

    <div class = "row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h1 class="display-4">Daftar Berita</h1>
                </div>
            </div> <!--penutup jumbotron-->

        <form method="POST">
            <div class="form-group row mb-2">
                <label for="search" class="col-sm-3">Judul Berita</label>
                <div class="col-sm-6">
                    <input type="text" name="search" class="form-control"
                     id="search" value= "<?php if(isset($_POST['search'])) {echo $_POST['search'];} ?>" placeholder="Cari Berita">
                </div>
                <input type="submit" name="kirim" class="col-sm-1 btn btn-primary"
                value="Search">
            </div>
        </form>

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
                    <th colspan="2" style= "text-align: center">Action</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $jumlahtampilan = 3;
                $halaman= (isset($_GET['page']))? $_GET['page'] : 1;
                $mulaitampilan = ($halaman - 1) * $jumlahtampilan;
                if(isset($_POST["kirim"]))
                {
                   $search =  $_POST['search'];
                   $query = mysqli_query($connection, "SELECT berita.*,  destinasi.destinasiID, destinasi.destinasiNama
                    FROM destinasi, berita
                    WHERE beritaJudul like '%".$search."%'
                    AND destinasi.destinasiID = berita.destinasiID limit $mulaitampilan, $jumlahtampilan");
                }
                else
                {
                    $query = mysqli_query($connection, "SELECT berita.*, destinasi.destinasiID, destinasi.destinasiNama
                    FROM destinasi, berita
                    WHERE destinasi.destinasiID = berita.destinasiID limit $mulaitampilan, $jumlahtampilan");
                }
                    $nomor = 1;
                    while ($row = mysqli_fetch_array($query))
                    { ?>
                        <tr>
                            <td><?php echo $mulaitampilan + $nomor; ?></td>
                            <td><?php echo $row['beritaID']; ?></td>
                            <td><?php echo $row['beritajudul']; ?></td>
                            <td><?php echo $row['beritainti']; ?></td>
                            <td><?php echo $row['penulis']; ?></td>
                            <td><?php echo $row['penerbit']; ?></td>
                            <td><?php echo $row['tanggalterbit']; ?></td>
                            <td><?php echo $row['destinasiID']; ?></td>
                            <td><?php echo $row['destinasiNama']; ?></td>

                            <td>  
                                <a href="beritaedit.php?ubah=<?php echo $row['beritaID']?>"
                                   class="btn btn-success btn-sm" title="EDIT">
                                   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                      <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                      <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                  </svg>
                                </a>
                            </td>

                            <td>
                                <a href="beritahapus.php?hapus=<?php echo $row['beritaID']?>"
                                   class="btn btn-danger btn-sm" title="DELETE">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                       <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                    </svg>
                                 </a>
                            </td>
                        </tr>
                        <?php $nomor = $nomor + 1;?>
                    <?php } 
                 ?>
            </tbody>

        </table>
        <?php 
            $query = mysqli_query($connection, "SELECT * FROM berita");
            $jumlahrecord = mysqli_num_rows($query);
            $jumlahpage = ceil($jumlahrecord/$jumlahtampilan);
            ?>

<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item"><a class="page-link" href="?page=<?php $nomorhal=1; echo $nomorhal?>">FIRST</a></li>
    <?php for ($nomorhal=1; $nomorhal<=$jumlahpage; $nomorhal++)
    {?>
    <li class="page-item">
        <?php 
        if($nomorhal!=$halaman)
        {
            ?>
            <a class="page-link" href="?page=<?php echo $nomorhal?>"><?php echo $nomorhal?></a>
            <?php } 
            else { ?>
                <a class="page-link" href="?page=<?php echo $nomorhal?>"><?php echo $nomorhal?></a>
        <?php } ?>
        </li>    
    <?php }?>
    <li class="page-item"><a class="page-link" href="?page=<?php echo $nomorhal-1?>">LAST</a></li>
  </ul>
</nav>
        </div>
    <div class="col-sm-1"></div>
    </div>

<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#inputDesCode').select2({
            allowClear: true,
            placeholder: "Choose the travel category"
        });
    });
</script>
</div><!--closer for container fluid-->
</div><!--closer for container fluid-->
<!--body dihapus-->
<?php include "footer.php"; ?>

<?php 
            mysqli_close($connection);
            ob_end_flush();
        ?>

</html>