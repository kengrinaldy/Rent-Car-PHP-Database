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
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">Destinasi Wisata</a>
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
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">Area</a>
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
    <h1 style=" font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; font-size: 50px; color: black">
      Rental Mobil</h1>
  </div>
  <!-- Penutup Jumbotron-->

  <!-- Tampilan Objek -->
  <div class="container-fluid">
			<div class="row" style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; padding: 0 0 20px 10px;">
				<div class="col-sm-1"></div>
				<div class="col-sm-10">
					<img src="images/Supra4.jpg" style="width: 100%">
					<p style="text-align: center; padding: 20px 0 0 0"><b>Toyota Supra MK4 Paul Walker</b></p>
					<p style="text-align: center;">Di antara model-model yang pernah lahir, Supra MK4 memiliki sejarahnya sendiri terkhusus di dunia pop culture.</p>
					<p style="background-color:#00a8ff; border-radius: 10px; text-align: justify;  padding: 20px;">Mobil ini muncul dalam franchise Fast and Furious sebagai tunggangan sang pemeran utama Brian O’Conner yang diperankan mendiang Paul Walker.Hal itu diduga makin melambungkan nama Supra MK4 sehingga bukan cuma dikenal para petrolhead, tapi juga khalayak lebih luas. Pada tahun 2022 ini usia Supra MK4 paling tidak sudah dua puluh tahun karena terakhir dipasarkan pada 2002Namun, jangan harap bisa menemukan mobil ini dijual dengan harga murah. Situs web database mobil-mobil lawas bernama Classic.com menaksir harga mobil Supra MK4 saat ini rata-rata adalah 77.702 dolar AS atau sekitar Rp1,2 miliarSebagai perbandingan, PT TAM kini memasarkan GR Supra terbaru di Indonesia dengan harga Rp2,051 miliar.</p>
					<p style="background-color: orange; border-radius: 10px; text-align: center;  padding: 20px;"><b>Spesifikasi Supra MK4 KELAZZ</b></p>
					<p style="background-color:#00a8ff; border-radius: 10px; text-align: justify;  padding: 20px;">1. Tingginya pamor Supra MK4 tentu juga berkat performanya yang mumpuni sebagai sebuah mobil sport. Toyota merancang mobil ini dengan filosofi Less is More. Salah satu contoh penerapannya ialah upaya pemangkasan bobot dibandingkan dengan generasi sebelumnya.</p>
					<p style="background-color:#00a8ff; border-radius: 10px; text-align: justify;  padding: 20px;">2. Beberapa sumber menyebutkan Supra MK4 sukses diet sampai 100 kg dibandingkan Supra MK3. Hal tersebut dilakukan melalui penggunaan bahan aluminium dalam porsi yang cukup besar pada mobil dengan kode rangka A80 ini.</p>
					<p style="background-color:#00a8ff; border-radius: 10px; text-align: justify;  padding: 20px;">3. Sementara itu untuk sumber tenaganya, Toyota menyematkan mesin 3.000 cc JZ Series yang mampu menghadirkan tenaga puncak 320 hp dan torsi maksimum 427 Nm. Mobil ini juga mendapatkan tambahan fitur modern seperti halnya kontrol traksi. Ditambah lagi desain bodi yang ciamik, Supra MK4 sukses menjadi mobil impian para penggemarnya.</p>
				</div>
				<div class="col-sm-1"></div>
			</div>
		</div>
  <!-- Akhir Tampilan Objek -->

  <!-- Footer -->
  <footer class="footer"
  style="border-top: 1px solid black;border-bottom: 1px solid black; background-color: white">
      <div class="copyright text-center my-auto" style="font-family:Georgia, 'Times New Roman', Times, serif; color: black; font-size: 10px">
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