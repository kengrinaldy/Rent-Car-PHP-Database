<!DOCTYPE html>

<?php
include "includes/config.php";

if (isset($_POST['Edit'])) {
    if (isset($_REQUEST['inputkode'])) {
        $destinasikode = $_REQUEST['inputkode'];
    }
    if (!empty($destinasikode)) {
        $destinasikode = $_REQUEST['inputkode'];
    } else {
        die("Anda harus memasukkan kodenya!");
    }

    $destinasinama = $_POST['inputnama'];
    $alamat = $_POST['inputAddressD'];
    $kodekategori = $_POST['kodekategori'];
    $kodearea = $_POST['kodearea'];

    mysqli_query($connection, "update destinasi set 
    destinasiNama='$destinasinama', 
    destinasiAlamat='$alamat',
    kategoriID='$kodekategori',
    areaID='$kodearea'
    where destinasiID = '$destinasikode'");
    header("location:destinasi.php");
}

$datakategori = mysqli_query($connection, "select * from kategori");
$dataarea = mysqli_query($connection, "select * from area");

// untuk menampilkan data p ada form edit
$kodedestinasi = $_GET["ubah"];
$editdestinasi = mysqli_query($connection, "select * from destinasi
        where destinasiID = '$kodedestinasi'");
$rowedit = mysqli_fetch_array($editdestinasi);

$editkategori = mysqli_query($connection, "select * 
        from destinasi, kategori
     where destinasiID = '$kodedestinasi' and destinasi.kategoriID = kategori.kategoriID");
$rowedit2 = mysqli_fetch_array($editkategori);

$editarea = mysqli_query($connection, "select * 
      from destinasi, area
      where destinasiID = '$kodedestinasi' and destinasi.areaID = area.areaID");
$rowedit3 = mysqli_fetch_array($editarea);
?>



<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Destinasi </title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>

<?php
include "includes/config.php";
ob_start();
session_start();
if (!isset($_SESSION['emailuser'])) //is the email user active or not, if not then they cant enter unless they login first
{
    header("location:login.php");
}
?>

<?php include "header.php"; ?>
<div class="container-fluid">
    <div class="card shadow mb-4">

        <body>

            <div class="row">
                <div class="col-sm-1">
                </div>

                <div class="col-sm-10">

                    <div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <h1 class="display-4">Edit Destinasi wisata</h1>
                        </div>
                    </div>
                    <!--penutup jumbotron-->

                    <form method="POST">
                        <div class="form-group row">
                            <label for="kodedestinasi" class="col-sm-2 col-form-label">Destination ID</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="kodedestinasi" name="inputkode" value="<?php echo $rowedit["destinasiID"] ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nameDestinasi" class="col-sm-2 col-form-label"> Destination Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nameDestinasi" name="inputnama" value="<?php echo $rowedit["destinasinama"] ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="addressDestinasi" class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="addressDestinasi" name="inputAddressD" value="<?php echo $rowedit["destinasialamat"] ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="refkategori" class="col-sm-2 col-form-label">Code Category</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="kodekategori" name="kodekategori">
                                    <option value="<?php echo $rowedit["kategoriID"] ?>">
                                        <?php echo $rowedit['kategoriID'] ?>
                                        <?php echo $rowedit2['kategorinama'] ?>
                                    </option>

                                    <?php while ($row = mysqli_fetch_array($datakategori)) { ?>
                                        <option value="<?php echo $row["kategoriID"] ?>">
                                            <?php echo $row["kategoriID"] ?>
                                            <?php echo $row["kategorinama"] ?>
                                        </option>
                                    <?php } ?>

                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="refkategori" class="col-sm-2 col-form-label">Area Wisata</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="kodearea" name="kodearea">

                                    <option value="<?php echo $rowedit["areaID"] ?>">
                                        <?php echo $rowedit['areaID'] ?>
                                        <?php echo $rowedit3['areanama'] ?>
                                    </option>
                                    <?php while ($row = mysqli_fetch_array($dataarea)) { ?>
                                        <option value="<?php echo $row["areaID"] ?>">
                                            <?php echo $row["areaID"] ?>
                                            <?php echo $row["areanama"] ?>
                                        </option>
                                    <?php } ?>

                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-2">
                            </div>
                            <div class="col-sm-10">
                                <input type="submit" class="btn btn-primary" value="Edit" name="Edit">
                                <input type="reset" class="btn btn-secondary" value="Batal" name="Batal">
                            </div>
                        </div>

                    </form>
                </div>

                <div class="col-sm-1">
                </div>
            </div>
            <!--penutup class row-->

            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <!--judu;-->
                    <div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <h1 class="display-4">Daftar Destinasi Wisata</h1>
                        </div>
                    </div>
                    <!--penutup jumbotron-->

                    <form method="POST">
                        <div class="form-group row mb-2">
                            <label for="search" class="col-sm-3">Nama Destinasi</label>
                            <div class="col-sm-6">
                                <input type="text" name="search" class="form-control" id="search" value="<?php if (isset($_POST['search'])) {
                                                                                                                echo $_POST['search'];
                                                                                                            } ?>" placeholder="Cari nama destinasi">
                            </div>
                            <input type="submit" name="kirim" class="col-sm-1 btn btn-primary" value="Search">
                        </div>
                    </form>

                    <table class="table table-hover table-danger">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Destination ID</th>
                                <th>Destination Name</th>
                                <th>Address Destination</th>
                                <th>Category ID</th>
                                <th>Category Name</th>
                                <th>Area ID</th>
                                <th>Area Name</th>

                                <th colspan="2" style="text-align: center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            if (isset($_POST["kirim"])) {
                                $search =  $_POST['search'];
                                $query = mysqli_query($connection, "select destinasi.*, kategori.kategoriID, kategori.kategoriNama, area.areaID, area.areaNama
                    from destinasi, kategori, area
                    where destinasiNama like '%" . $search . "%'
                    and destinasi.kategoriID = kategori.kategoriID
                    and destinasi.areaID = area.areaID");
                                /*'$search%'"  for not start with*/
                            } else {
                                $query = mysqli_query($connection, "select destinasi.*, kategori.kategoriID, kategori.kategorinama, area.areaID, area.areanama
                    from destinasi, kategori, area
                    where destinasi.kategoriID = kategori.kategoriID
                    and destinasi.areaID = area.areaID");
                            }
                            $nomor = 1;
                            while ($row = mysqli_fetch_array($query)) { ?>
                                <tr>
                                    <td><?php echo $nomor; ?></td>
                                    <td><?php echo $row['destinasiID']; ?></td>
                                    <td><?php echo $row['destinasinama']; ?></td>
                                    <td><?php echo $row['destinasialamat']; ?></td>
                                    <td><?php echo $row['kategoriID']; ?></td>
                                    <td><?php echo $row['kategorinama']; ?></td>
                                    <td><?php echo $row['areaID']; ?></td>
                                    <td><?php echo $row['areanama']; ?></td>

                                    <!--edit icon-->
                                    <td>

                                        <a href="destinasiedit.php?ubah=<?php echo $row['destinasiID'] ?>" class="btn btn-success btn-sm" title="EDIT">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                            </svg>
                                        </a>
                                    </td>
                                    <!--trash icon-->
                                    <td>
                                        <a href="destinasihapus.php?hapus=<?php echo $row['destinasiID'] ?>" class="btn btn-danger btn-sm" title="DELETE">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                                <?php $nomor = $nomor + 1; ?>
                            <?php }
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
                    $('#kodekategori').select2({
                        allowClear: true,
                        placeholder: "Choose the travel category"
                    });
                });
            </script>
            <script type="text/javascript">
                $(document).ready(function() {
                    $('#kodearea').select2({
                        allowClear: true,
                        placeholder: "Choose the travel area"
                    });
                });
            </script>
            <?php include "footer.php"; ?>
        </body>

        <?php
        mysqli_close($connection);
        ob_end_flush();
        ?>

</html>