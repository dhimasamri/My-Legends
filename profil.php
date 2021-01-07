<?php 
session_start();

if(isset($_SESSION["login"])) {
  $emailakun = $_SESSION['emailakun'];
}

require 'functions.php';

$nama = $_GET["nama"];

$nyoba = "SELECT * FROM akun WHERE username = '$nama'";
mysqli_query($conn, $nyoba) or die ('Error');
$result2 = mysqli_query($conn, $nyoba);
$row = mysqli_fetch_array($result2);
// $id = $_GET["id"];
// $nyoba = query("SELECT * FROM akun WHERE id = $id")[0];
// $mahasiswa = query("SELECT * FROM postingan ORDER BY id DESC"); // tambahin ORDER BY id ASC/DESC kalo mo diurut
// $row2 = $row['username'];

$nyoba2 = "SELECT * FROM postingan WHERE nama = '$nama' ORDER BY id DESC";
mysqli_query($conn, $nyoba2) or die ('Error');
$result3 = mysqli_query($conn, $nyoba2);
$rows = [];
while($apa = mysqli_fetch_assoc($result3)){
    $rows[] = $apa;
}

// $id2 = $rows['id'];

// $kommen = "SELECT * FROM komentar WHERE idpost = '$id2'";
// mysqli_query($conn, $kommen) or die ('Error');
// $result4 = mysqli_query($conn, $kommen);
// $rows2 = [];
// while($apa2 = mysqli_fetch_assoc($result4)){
//     $rows2[] = $apa2;
// }
// echo count($rows);
// var_dump($rows);
// $apa = query("SELECT * FROM postingan WHERE nama = '$row2' ORDER BY id DESC");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <form action="" method="post">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $row['username'];?></title>
    <link rel="stylesheet" href="fontawesome-free-5.15.1-web/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    </form>
</head>
<body>
<form action="" method="post">
    <nav class="navbar sticky-top" style="background-color: white;">
        <div class="container d-flex justify-content-between">
          <a href="index.php">
            <button type="button" class="btn"><i class="fas fa-arrow-left" style="font-size: 25px;"></i></button>
          </a>
            <button type="button" class="btn"><i class="fas fa-share-alt" style="font-size: 25px;"></i></button>
        </div>
    </nav>


    <div class="container">
        <div class="d-flex flex-column">

            <!-- bagian gambar profil -->
            <div class="d-flex justify-content-center py-4">
        <img src="img/<?= $row['gambar'];?>" alt="..." class="rounded-circle" style="width: 10rem; height: 10rem; object-fit: cover;">
            </div>

            <!-- bagian username -->
            <div class="d-flex justify-content-center py-1">
        <h4><?= $row['username'];?></h4>
            </div>

    <!-- bagian deskripsi -->
    <div class="d-flex justify-content-center py-2">
        <h6 style="max-width: 15rem; text-align: center; color: grey;"><?= $row['bio'];?></h6>
    </div>

    <div class="container py-5" style="max-width: 30rem;">
        <div class="d-flex justify-content-between">

            <!-- bagian post profil -->
            <div class="d-flex justify-content-start pb-3">
            <i class="fas fa-images fa-2x pr-2"></i>
<h5 class="pr-2"><?= count($rows); ?></h5>
<h5>Post</h5>
        </div>

        <!-- bagian like profil -->
        <div class="d-flex justify-content-start">
            <i class="fas fa-heart fa-2x pr-2"></i>
            <h5 class="pr-2">0</h5>
            <h5>Like</h5>
        </div>
        
    </div>
    </div>

    <!-- tombol edit -->
    <div class="d-flex justify-content-center pb-3">
    <!-- <a href="ubahakun.php?idakun=<?= $row['idakun'];?>"> -->
    <a style="border-radius: 20px; width: 15rem;" class="btn btn-primary" href="#">Like</a>
    <!-- <button type="submit" name="edit" class="btn btn-primary" style="border-radius: 20px; width: 15rem;">Edit</button> -->
    <!-- </a> -->
</div>
</form>


<!-- bagian card -->
<form action="" method="post">
<?php foreach($rows as $mhs) { ?>

<div class="d-flex justify-content-center py-4">
<div class="card border-secondary" style="max-width: 36rem; max-height: 36rem;">

    <!-- bagian atas card-->
    <div class="card-body">
      <div class="d-flex justify-content-start">

        <!-- gambar akun post -->
        <div class="align-self-center mr-3">
          <img src="img/<?= $mhs["ava"]; ?>" alt="..." class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
        </div>

        <!-- nama akun, title, waktu post -->
        <div class="d-flex flex-column">
          <h5 class="card-title"><?= $mhs["judul"]; ?></h5>
          <div class="d-flex flex-row">
            <h6 class="pr-2"><?= $mhs["nama"]; ?>,</h6>
            <h6 class="text-primary"><small class="text-muted"><?= $mhs["date"]; ?></small></h6>
          </div>
          </div>
      </div>
    </div>

    <!-- gambar post -->
    <!-- udah login -->
    <?php if(isset($_SESSION["login"])) { ?>
    <div class="d-flex justify-content-center">
      <div class="d-flex align-items-center">
      <a href="post.php?id=<?= $mhs["id"]; ?>">
      <img class="card-img-top p-1" src="img/<?= $mhs["gambar"]; ?>" alt="Card image cap" style="max-width: 800px; max-height: 328px; object-fit: cover;">
      </a>
      </div>
    </div>

  <!-- belom login -->
  <?php } else { ?>
    <div class="d-flex justify-content-center">
      <div class="d-flex align-items-center">
      <a href="postguest.php?id=<?= $mhs["id"]; ?>">
      <img class="card-img-top p-1" src="img/<?= $mhs["gambar"]; ?>" alt="Card image cap" style="max-width: 800px; max-height: 328px; object-fit: cover;">
      </a>
      </div>
    </div>
  <?php } ?>

    <!-- bagian bawah card -->
    <div class="card-body">

      <!-- like dan comment post -->
      <div class="d-flex">
          <div class="align-self-center">
        <div class="d-flex justify-content-between" style="width: 8rem;">
        <!-- <i class="fas fa-heart" style="color:grey;"></i>
        <small>123</small>
        <i class="fas fa-comment" style="color:grey;"></i>
        <?php  
        $id2 = $mhs['id'];

        $kommen = "SELECT * FROM komentar WHERE idpost = '$id2'";
        mysqli_query($conn, $kommen) or die ('Error');
        $result4 = mysqli_query($conn, $kommen);
        $rows2 = [];
        while($apa2 = mysqli_fetch_assoc($result4)){
            $rows2[] = $apa2;
        }
        ?>
        <small><?= count($rows2); ?></small> -->
      </div>
    </div>
      <!-- <button type="button" class="btn ml-auto"><i class="fas fa-share-alt" style="color:grey;"></i></button> --> 
    </div>

</div>
    </div>
  </div>

    </div>
</div>
<?php } ?>
</form>
</body>
</html>

<!-- <div class="d-flex justify-content-center pb-3">
    <button type="submit" class="btn btn-primary" style="border-radius: 20px; width: 15rem;"><i class="fas fa-heart pr-2"></i>Like</button>
</div>

<div class="d-flex justify-content-center pb-3">
    <button type="submit" class="btn btn-primary" style="border-radius: 20px; width: 15rem;"><i class="far fa-heart pr-2"></i></i>Unlike</button>
</div> -->