<!DOCTYPE html>

<?php
include "includes/config.php";
$queryArea = mysqli_query($connection, "SELECT * FROM area");
$queryDestinasi = mysqli_query($connection, "SELECT * FROM destinasi");
$destinasi = mysqli_query($connection, "SELECT * FROM kategori, destinasi, fotodestinasi
					WHERE kategori.kategoriID = destinasi.kategoriID
					AND destinasi.destinasiID = fotodestinasi.destinasiID");
$sqlDestinasi = mysqli_query($connection, "SELECT * FROM destinasi");
$jumlahWisata = mysqli_num_rows($sqlDestinasi);
$sqlHotel = mysqli_query($connection, "SELECT * FROM hotel");
$jumlahPenginapan = mysqli_num_rows($sqlHotel);
$sqlRental = mysqli_query($connection, "SELECT * FROM rentalmobil");
$jumlahMobil = mysqli_num_rows($sqlRental);
$foto = mysqli_query($connection, "SELECT * FROM fotodestinasi");

?>

<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Title</title>
</head>

<body>
    <!-- Membuat Menu -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="#">
            <img src="images/supercar.png" width="30" height="30" class="d-inline-block align-top" alt="">
            MyCarsx
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Destinasi Wisata</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                        <?php
            while ($row = mysqli_fetch_array($queryDestinasi)) {
                if ($row['destinasinama'] == 'Viper') {
            ?>
                        <a class="dropdown-item" href="viper.php">
                            <?php echo $row["destinasinama"] ?>
                        </a>

                        <?php
                } elseif ($row['destinasinama'] == 'Skyline') {
            ?>
                        <a class="dropdown-item" href="skyline.php">
                            <?php echo $row["destinasinama"] ?>
                        </a>

                        <?php
                } elseif ($row['destinasinama'] == 'Supra') {
            ?>
                        <a class="dropdown-item" href="supra.php">
                            <?php echo $row["destinasinama"] ?>
                        </a>

                        <?php
                } elseif ($row['destinasinama'] == 'Gallardo') {
            ?>
                        <a class="dropdown-item" href="gallardo.php">
                            <?php echo $row["destinasinama"] ?>
                        </a>

                        <?php
                } elseif ($row['destinasinama'] == 'Rolls Royce') {
            ?>
                        <a class="dropdown-item" href="rolls.php">
                            <?php echo $row["destinasinama"] ?>
                        </a>

                        <?php
                } else {
            ?>
                        <a class="dropdown-item" href="#">
                            <?php echo $row["destinasinama"] ?>
                        </a>
                        <?php
                }
            }
            ?>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Area</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php
            while ($row = mysqli_fetch_array($queryArea)) {
                if ($row['areanama'] == 'Tokyo') {
            ?>
                        <a class="dropdown-item" href="tokyo.php">
                            <?php echo $row["areanama"] ?>
                        </a>

                        <?php
                } elseif ($row['areanama'] == 'Vegas') {
            ?>
                        <a class="dropdown-item" href="vegas.php">
                            <?php echo $row["areanama"] ?>
                        </a>

                        <?php
                } elseif ($row['areanama'] == 'Grogol') {
            ?>
                        <a class="dropdown-item" href="grogol.php">
                            <?php echo $row["areanama"] ?>
                        </a>

                        <?php
                } elseif ($row['areanama'] == 'Dubai') {
            ?>
                        <a class="dropdown-item" href="dubai.php">
                            <?php echo $row["areanama"] ?>
                        </a>

                        <?php
                } else {
            ?>
                        <a class="dropdown-item" href="#">
                            <?php echo $row["areanama"] ?>
                        </a>
                        <?php
                }
            }
            ?>
                    </div>
                </li>


                <li class="nav-item">
                    <a class="nav-link" href="theater.php">Theater</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="food.php">Food</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="Address.php">Address</a>
                </li>
            </ul>

            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <!-- Akhir Menu -->

    <!-- Slider -->
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
        </ol>

        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="images/Viper5.jpg" alt="First slide" style="height: 800px">
                <div class="carousel-caption d-none d-md-block">
                    <h1>Dodge Viper</h1>
                    <h5>Mobil muscle terkuat dan tercepat sepanjang masa</h5>
                </div>
            </div>

            <div class="carousel-item">
                <img class="d-block w-100" src="images/Skyline3.jpg" alt="Second slide" style="height: 800px">
                <div class="carousel-caption d-none d-md-block">
                    <h1>Nissan Skyline</h1>
                    <h5>Kecantikan alami dengan mesin GTR yang super</h5>
                </div>
            </div>

            <div class="carousel-item">
                <img class="d-block w-100" src="images/Supra4.jpg" alt="Third slide" style="height: 800px">
                <div class="carousel-caption d-none d-md-block">
                    <h1>Toyota Supra</h1>
                    <h5>Salah satu mobil tercepat dengan mesin 2JZ yang sangar </h5>
                </div>
            </div>

            <div class="carousel-item">
                <img class="d-block w-100" src="images/Gallardo1.jpg" alt="Fourth slide" style="height: 800px">
                <div class="carousel-caption d-none d-md-block">
                    <h1>Lamborghini Gallardo</h1>
                    <h5>Supercar generasi lama yang sering dijumpai di game ps2</h5>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>

        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <!-- Akhir Slider -->

    <!-- Jumbotron -->
    <div class="jumbotron text-center"
        style="margin-bottom: 15px; padding: 1rem 1rem; border-top: 4px solid black;border-bottom: 4px solid black; background-color: #00a8ff">
        <h1
            style=" font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; font-size: 50px; color: black">
            D U B A I</h1>
    </div>
    <!-- Penutup Jumbotron-->

    <!-- Tampilan Objek -->
    <div class="container-fluid">
			<div class="row" style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; padding: 0 0 20px 10px;">
				<div class="col-sm-1"></div>
				<div class="col-sm-10">
					<p style="background-color:#00a8ff; border-radius: 10px; text-align: justify; padding: 20px 20px; margin-top: 10px;">Dubai adalah kota terpadat di negara Uni Emirat Arab dan merupakan ibukota Emirat Dubai. Kota ini terletak di sepanjang pantai tenggara Jazirah Arab dan di selatan teluk Persia, Kotamadya Dubai disebut Kota Dubai untuk membedakannya dari Emirat Dubai. Dubai adalah salah satu tujuan pariwisata paling populer di dunia.</p>
					<p style="text-align: center;"><b>Rich and Luxury Places over Town</b></p>
					<p style="text-align: center;">Tempat-tempat luar biasa yang berada di Dubai</p>
					<p style="text-align: justify;"><b>1. Burj Khalifa</b></p>
					<img src="images/burj.jpg" style="width: 600px; padding: 10px; margin-left: 300px; margin-bottom: 10px;">
					<p style="background-color:#00a8ff; border-radius: 10px; text-align: justify; text-align: justify; padding: 20px;">Burj Khalifa, sebelumnya bernama Burj Dubai, adalah sebuah pencakar langit di Dubai, Uni Emirat Arab yang diresmikan pembukaannya pada 4 Januari 2010. Ketinggian pencakar langit ini adalah 828 meter. Burj Khalifa adalah bangunan tertinggi di dunia yang pernah dibuat oleh manusia</p>

					<p style="text-align: justify;"><b>2. Dubai Fountain</b></p>
					<img src="images/dfoun.jpg" style="width: 600px; padding: 10px; margin-left: 300px; margin-bottom: 10px;">
					<p style="background-color:#00a8ff; border-radius: 10px; text-align: justify; text-align: justify; padding: 20px;">Air Mancur Dubai adalah sistem air mancur koreografi yang terletak di Danau Burj Khalifa buatan seluas 12 hektar, di pusat pengembangan Pusat Kota Dubai di Dubai, Uni Emirat Arab.</p>
                    
                    <p style="background-color: black; color: white; border-radius: 10px; text-align: center;"><b>Mobil Umum Di Dubai</b></p>
                    <img src="images/f40.jpg" style="width: 600px; padding: 10px; margin-bottom: 10px;">
                    <img src="images/lancer.jpg" style="width: 600px; padding: 10px; margin-bottom: 10px;">
                    <p style="float: left; background-color: black; margin-left: 250px; color: white; border-radius: 10px;"><b>Ferrari F40</b></p>
                    <p style="float: left; background-color: black; margin-left: 550px; color: white; border-radius: 10px;"><b>Mitsubishi Lancer</b></p>

                </div>
				<div class="col-sm-1"></div>
			</div>
		</div>
    <!-- Akhir Tampilan Objek -->

    <!-- Footer -->
    <footer class="footer" style="border-top: 1px solid black;border-bottom: 1px solid black; background-color: white">
        <div class="copyright text-center my-auto"
            style="font-family:Georgia, 'Times New Roman', Times, serif; color: black; font-size: 10px">
            <span>Copyright &copy; Wisataku 2020</span>
        </div>
        </div>
    </footer>
    <!-- End of Footer -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>

</html>