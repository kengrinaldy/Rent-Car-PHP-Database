<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>KABUPATEN</title>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudfare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    </head>
    <?php 
        include "includes/config.php";

        ob_start();
        session_start();
        if(!isset($_SESSION['emailuser'])) //is the email user active or not, if not then they cant enter unless they login first
        {
        header("location:login.php");
        }

        if(isset($_POST['Simpan'])){
            $kabupatenKODE = $_POST['inputkode'];
            $kabupatenNAMA = $_POST['inputnama'];
            $kabupatenALAMAT = $_POST['inputalamat'];
            $kabupatenKET = $_POST['inputketerangan'];
            $kabupatenFOTOICONKET = $_POST['inputfoto'];


            $nama = $_FILES['file']['name'];
            $file_tmp = $_FILES["file"]["tmp_name"];

            $ekstensifile = pathinfo($nama, PATHINFO_EXTENSION);

            //Periksa Ekstensi File Harus JPG atau jpg
            if(($ekstensifile == "png") or ($ekstensifile == "PNG")){
                move_uploaded_file($file_tmp, 'images/'.$nama); //unggah file ke foler images
                mysqli_query($connection, "insert into kabupaten value ('$kabupatenKODE', '$kabupatenNAMA', '$kabupatenALAMAT', '$kabupatenKET', '$nama', '$kabupatenFOTOICONKET')");
                header("location:kabupaten.php");
            }
        }
        $datadestinasi = mysqli_query($connection, "select * from destinasi");
    ?>

<?php include "header.php"; ?>

<div class="container-fluid">
<div class="card shadow mb-4">

    <body>
        <div class="row">
            <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <h1 class="display-4">Input Kabupaten</h1>
                        </div>
                    </div>
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="kabupatenKODE" class="col-sm-2 col-form-label">Kode Kabupaten</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="kabupatenKODE" name="inputkode" placeholder="Kode Kabupaten" maxlength="4">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kabupatenNAMA" class="col-sm-2 col-form-label">Nama Kabupaten</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="kabupatenNAMA" name="inputnama" placeholder="Nama Kabupaten">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="kabupatenALAMAT" class="col-sm-2 col-form-label">Alamat Kabupaten</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="kabupatenALAMAT" name="inputalamat" placeholder="Alamat Kabupaten">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="kabupatenKET" class="col-sm-2 col-form-label">Keterangan Kabupaten</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="kabupatenKET" name="inputketerangan" placeholder="Keterangan Kabupaten">
                            </div>
                        </div>

                      
                        <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">Icon Kabupaten</label>
                            <div class="col-sm-10">
                                <input type="file" id="file" name="file">
                                <p class="help-block">Field ini digunakan untuk unggah file</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="kabupatenFOTOICONKET" class="col-sm-2 col-form-label">Keterangan Icon</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="kabupatenFOTOICONKET" name="inputfoto" placeholder="Keterangan Icon">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-10">
                                <input type="submit" name="Simpan" class="btn btn-primary" value="Simpan">
                                <input type="submit" name="Batal" class="btn btn-secondary" value="Batal">
                            </div>
                        </div>
                    </form>
                </div>
            <div class="col-sm-1"></div>
        </div>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <h1 class="display-4">Daftar Kabupaten</h1>
                    </div>
                </div>
                <table class="table table-hover table-danger">
                    <thead class="thead-dark">
                        <tr>
                            <th>Nomor</th>
                            <th>Kode Kabupaten</th>
                            <th>Nama Kabupaten</th>
                            <th>Alamat Kabupaten</th>
                            <th>Keterangan Kabupaten</th>
                            <th>Icon Kabupaten</th>
                            <th>Keterangan Icon Kabupaten</th>
                            <th colspan="2" style="text-align: center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $query = mysqli_query($connection, "select * from kabupaten");
                            $nomor = 1;
                            while($row = mysqli_fetch_array($query)){ ?>
                                <tr>
                                    <td><?php echo $nomor; ?></td>
                                    <td><?php echo $row['kabupatenKODE']; ?></td>
                                    <td><?php echo $row['kabupatenNAMA']; ?></td>
                                    <td><?php echo $row['kabupatenALAMAT']; ?></td>
                                    <td><?php echo $row['kabupatenKET']; ?></td>
                                    <td><?php 
                                        if(is_file("images/".$row['kabupatenFOTOICON'])){ ?>
                                            <img src="images/<?php echo $row['kabupatenFOTOICON'] ?>" width="80">
                                        <?php }
                                        else{
                                            echo "<img src='images/noimage.png' width='80'>";
                                        }
                                    ?></td>
                                    <td><?php echo $row['kabupatenFOTOICONKET']; ?></td>
                                    <td>
                                        <a href="kabupatenedit.php?ubah=<?php echo $row['kabupatenKODE'] ?>" class="btn btn-success btn-sm" title="EDIT">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                            </svg>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="kabupatenhapus.php?hapuskabupaten=<?php echo $row['kabupatenKODE'] ?>" class="btn btn-danger btn-sm" title="HAPUS">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>

                            <?php $nomor = $nomor + 1; }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-sm-1"></div>
        </div>
    </body>

    <?php include "footer.php"; ?>

<?php 
            mysqli_close($connection);
            ob_end_flush();
        ?>

    <script type="text/javascript" src="js/bootstraps.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudfare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
</html>