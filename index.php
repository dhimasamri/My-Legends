<?php 
session_start();

if(isset($_SESSION["login"])) {
  $emailakun = $_SESSION['emailakun'];
  
  if($emailakun == 'admin@gmail.com'){
  header('Location: admin.php');
  exit;
  }
}



  
require 'functions.php';

$mahasiswa = query("SELECT * FROM postingan ORDER BY id DESC"); // tambahin ORDER BY id ASC/DESC kalo mo diurut
// $nyoba = "SELECT * FROM akun WHERE email = '$emailakun'";
// mysqli_query($conn, $nyoba) or die ('Error');
// $result2 = mysqli_query($conn, $nyoba);
// $row = mysqli_fetch_array($result2);
// echo $row['username'];

// pas tombol cari dipencet
if(isset($_POST["cari"])){
  $mahasiswa = cari($_POST["keyword"]);
}

// $nyoba = "SELECT * FROM akun WHERE email = '$emailakun'";
// mysqli_query($conn, $nyoba) or die ('Error');
// $result2 = mysqli_query($conn, $nyoba);
// $row2 = mysqli_fetch_array($result2);

// echo date("d M Y");

$survey = query("SELECT * FROM survey");

if(isset($_POST["report"])) {
    echo " 
    <script>
      alert('Terima kasih, report sedang di proses');
    </script>";
}
            

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Legends</title>
    <link rel="stylesheet" href="fontawesome-free-5.15.1-web/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!--     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/main.css"> -->
  </head>
<body>

  <!-- bagian navbar -->
  <form action="" method="post" class="sticky-top">
  <!-- <div class="sticky-top"> -->
  <nav class="navbar navbar-dark bg-primary">
    <div class="container d-flex justify-content-between">
    <?php if(isset($_SESSION["login"])) { ?>

      <!-- bagian navbar kalo udah login -->
      <div class="dropdown">
        <button class="btn btn-primary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="img/<?php 
              $nyoba = "SELECT * FROM akun WHERE email = '$emailakun'";
              mysqli_query($conn, $nyoba) or die ('Error');
              $result2 = mysqli_query($conn, $nyoba);
              $row = mysqli_fetch_array($result2);
              echo $row['gambar'];
             ?>" alt="..." class="rounded-circle" style="width: 35px; height: 35px; object-fit: cover;">
        </button>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="ownprofil.php">Profil</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="logout.php">Sign Out</a>
          <?php  
          $result2 = mysqli_query($conn, "SELECT email FROM survey WHERE email = '$emailakun'");
          if (mysqli_fetch_assoc($result2)) { ?>
          <?php } else { ?>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item text-primary" href="survey.php">Survey</a>
          <?php } ?>
        </div>
      </div>

        <a class="navbar-brand" href="index.php">My Legends</a>
        
        <a href="tambah.php">
        <button type="button" name="ngepost" class="btn btn-primary my-2 my-sm-0"><i class="fas fa-plus" style="color: white !important"></i></button>
        </a>

    <?php } else { ?>

      <!-- bagian navbar kalo belom login -->
      <a href="login.php">
      <button type="button" name="login" class="btn btn-primary my-2 my-sm-0"><i class="fas fa-user pr-2" style="color: white !important"></i>Login</button>
      </a>

        <a class="navbar-brand" href="index.php">My Legends</a>
        <a href="login.php">
        <button type="button" name="ngepost" class="btn btn-primary my-2 my-sm-0"><i class="fas fa-plus" onclick="return confirm('harus login terlebih dahulu');" style="color: white;"></i></button>
        </a>
      <?php } ?>
    </div>

  </nav>
  

  <!-- bagian search bar -->
    <nav class="navbar navbar-dark" style="background-color: white;">
      <div class="container d-flex justify-content-center">
        <form class="form-inline" action="" method="post">
          <div class="d-flex">
          <input class="form-control mr-2" type="search" name="keyword" placeholder="Search.." aria-label="Search">
          <button class="btn btn-light my-sm-0" type="submit" name="cari"><i class="fas fa-search"></i></button>
        </div>
        </form>
      </div>
    </nav>
  </form>
      </div>
      
      <!-- bagian container -->
      <div class="container d-flex justify-content-center">
        <div class="d-flex flex-column">
          
      <!-- bagian card -->
    <form action="" method="post">
    <?php foreach($mahasiswa as $row) { ?>
      <?php $idshare = $row['id']; ?>
    <div class="card border-secondary" style="max-width: 36rem; max-height: 36rem;">

      <!-- bagian atas card-->
      <div class="card-body">
        <div class="d-flex justify-content-between">
        <div class="d-flex justify-content-start">

          <!-- gambar akun post -->
          <div class="align-self-center mr-3">
            <a href="profil.php?nama=<?= $row["nama"]; ?>">
            <img src="img/<?= $row["ava"]; ?>" alt="..." class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
          </a>
          </div>

          <!-- nama akun, title, waktu post -->
          <div class="d-flex flex-column">
            <h5 class="card-title"><?= $row["judul"]; ?></h5>
            <div class="d-flex flex-row">
              <a href="profil.php?nama=<?= $row["nama"]; ?>" style="color: black;"><h6 class="pr-2"><?= $row["nama"]; ?>,</h6></a>
              <h6 class="text-primary"><small class="text-muted"><?= $row["date"]; ?></small></h6>
            </div>
            </div>
        </div>
        <div class="dropdown dropleft">
          <button class="btn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v" style="color: grey !important"></i>
          </button>
          <div class="dropdown-menu">
            <a class="a2a_dd dropdown-item" name="shareM" data-a2a-url="http://www.mylegends.ml/post.php?id=<?= $row["id"]; ?>" data-a2a-title="<?= $row["judul"]; ?>" href="https://www.addtoany.com/share">Share</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item text-danger" name="reportM" data-toggle="modal" href="#reportModal">Report</a>
            
          </div>
        </div>
      </div>

      </div>

      <!-- gambar post -->
      <!-- udah login -->
      <?php if(isset($_SESSION["login"])) { ?>
      <div class="d-flex justify-content-center">
        <div class="d-flex align-items-center">
      <a href="post.php?id=<?= $row["id"]; ?>">
      <img class="card-img-top p-1" src="img/<?= $row['gambar']; ?>" alt="Card image cap" style="max-width: 580px; max-height: 326px; object-fit: cover;">
      </a>
      </div>
      </div>

      <!-- belum login -->
      <?php } else { ?>
      <div class="d-flex justify-content-center">
        <div class="d-flex align-items-center">
      <a href="postguest.php?id=<?= $row["id"]; ?>">
      <img class="card-img-top p-1" src="img/<?= $row['gambar']; ?>" alt="Card image cap" style="max-width: 580px; max-height: 326px; object-fit: cover;">
      </a>
      </div>
      </div>

      <?php } ?>

      <!-- bagian bawah card -->
      <div class="card-body">
        <div class="d-flex">
          <div class="align-self-center">
        <div class="d-flex justify-content-between" style="width: 8rem;">
        <!-- like dan comment post -->
          <!-- <a href="post.php?id=<?= $row["id"]; ?>">
          <button class="btn btn-primary my-sm-0" type="button">See Post</button></a> -->
        </div>
          </div>
      <!-- <button type="button" class="btn ml-auto" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-share-alt" style="color:grey !important;"></i></button>  -->
      </div>
      </div>
    </div>
    <br>
    <?php } ?>
    </form>
    <script src="js/scripts.js"></script>

    <!-- Modal Report button -->
    <form action="" method="post">
    <div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Report this post</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <a class="dropdown-item" name="report" href="index.php" onclick="return confirm('Are you sure want to report this post?')">It's spam</a>
            <a class="dropdown-item" name="report" href="index.php" onclick="return confirm('Are you sure want to report this post?')">It's inappropriate</a>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

          </div>
        </div>
      </div>
    </div>
    </form>

    <!-- AddToAny BEGIN -->
    <script async src="https://static.addtoany.com/menu/page.js"></script>

    <!-- Javascript -->
    <script>
      var a2a_config = a2a_config || {};
      a2a_config.locale = "id";
      a2a_config.onclick = 1;
    </script>
    <script async src="https://static.addtoany.com/menu/page.js"></script>
</body>
</html>

<!-- <a href="login.html">
  <button type="button" class="btn btn-primary my-2 my-sm-0"><i class="fas fa-user pr-2"></i>Login</button>
  </a> -->