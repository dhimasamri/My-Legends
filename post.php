<?php 
session_start();

if(isset($_SESSION["login"])) {
  $emailakun = $_SESSION['emailakun'];
}

require 'functions.php';

// ambil data di url
$id = $_GET["id"];

$row = query("SELECT * FROM postingan WHERE id = $id")[0];
// $nyoba = query("SELECT * FROM akun");


$nyoba = "SELECT * FROM akun WHERE email = '$emailakun'";
mysqli_query($conn, $nyoba) or die ('Error');
$result2 = mysqli_query($conn, $nyoba);
$row2 = mysqli_fetch_array($result2);

// $nyoba2 = "SELECT * FROM komentar WHERE idpost = '$id'";
// mysqli_query($conn, $nyoba2) or die ('Error');
// $res = mysqli_query($conn, $nyoba2);
// $row3 = mysqli_fetch_array($res);

$nyoba2 = "SELECT * FROM komentar WHERE idpost = '$id' ORDER BY idkomen ASC";
mysqli_query($conn, $nyoba2) or die ('Error');
$result3 = mysqli_query($conn, $nyoba2);
$rows = [];
while($apa = mysqli_fetch_assoc($result3)){
    $rows[] = $apa;
}

$like = query("SELECT * FROM suka WHERE idposting = $id");

if(isset($_POST["submit"])) {
   

  // cek berhasil ditambahin apa engga
  if(comment($_POST) > 0) {
    echo " 
      <script>
        alert('Komentar Berhasil!');
      </script>
    ";
  } else {
    echo " 
      <script>
        alert('Komentar Gagal!');
      </script>
    ";
  }
}


if(isset($_POST["like"])) {
   

  // cek berhasil ditambahin apa engga
  if(heart($_POST) > 0) {
    echo " 
      <script>
        alert('Like Berhasil!');
      </script>
    ";
  } else {
    echo " 
      <script>
        alert('Like Gagal!');
      </script>
    ";
  }
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
  </head>
<body>


  <!-- bagian navbar -->
    <?php if($row['nama'] == $row2['username']) { ?>
    <!-- postingan sendiri -->
    <nav class="navbar navbar-dark bg-primary sticky-top">
        <div class="container d-flex justify-content-between">
            <a href="index.php">
            <button type="button" class="btn btn-primary"><i class="fas fa-arrow-left"></i></button></a>
            <div class="dropdown dropleft">
              <button class="btn btn-primary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v"></i>
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="ubah.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin ingin mengubah?')">Edit Post</a>
                <a class="dropdown-item" href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin ingin menghapus?')">Delete Post</a>
              </div>
            </div>
        </div>
    </nav>

    <?php } else { ?>
    <!-- postingan orang -->
    <nav class="navbar navbar-dark bg-primary sticky-top">
        <div class="container d-flex justify-content-between">
            <a href="index.php">
            <button type="button" class="btn btn-primary"><i class="fas fa-arrow-left"></i></button></a>
            <div class="dropdown dropleft">
              <button class="btn btn-primary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v"></i>
              </button>
              <div class="dropdown-menu">
                <h6 class="dropdown-header">Why are you reporting this post?</h6>
                <a class="dropdown-item" href="index.php" onclick="return confirm('Are you sure want to report?')">It's spam</a>
                <a class="dropdown-item" href="index.php" onclick="return confirm('Are you sure want to report?')">It's inappropriate</a>
              </div>
            </div>
        </div>
    </nav>
    <?php } ?>

    <!-- bagian container -->
    <div class="container d-flex justify-content-center p-4">
        <div class="d-flex flex-column">

          <!-- bagian card -->
        <div class="card border-secondary" style="max-width: 36rem; max-height: 56rem;">
        <!-- <input type="hidden" name="id" value="<?= $row["id"]; ?>"> -->

          <!-- bagian atas card -->
          <div class="card-body">
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
          </div>

          <!-- gambar post -->
          <div class="d-flex justify-content-center">
            <div class="d-flex align-items-center">
          <img class="card-img-top p-1" src="img/<?= $row['gambar']; ?>" alt="Card image cap" style="max-width: 580px; max-height: 326px; object-fit: cover;">
      </div>
      </div>

        <!-- bagian bawah card -->
        <div class="card-body">

        <!-- like dan comment post -->
        <form action="" method="post">
        <div class="d-flex">
        <div class="align-self-center">
       

            <!-- kalo udah like -->
              <?php  
              $result5 = mysqli_query($conn, "SELECT email2 FROM suka WHERE email2 = '$emailakun' AND idposting ='$id'");
              if (mysqli_fetch_assoc($result5)) { ?>
              
              <?php // if(isset($_POST["like"])) { ?>
              <i class="fas fa-heart pr-2" style="color:red;"></i>
              <small class="pr-3"><?= count($like); ?></small>
              <i class="fas fa-comment pr-2" style="color:grey;"></i>
              <small><?= count($rows); ?></small>

              <!-- kalo belom like -->
              <?php } else { ?>
              <input type="hidden" name="idposting" value="<?= $id; ?>">
              <input type="hidden" name="email2" value="<?= $emailakun; ?>">
              <button class="btn" type="submit" name="like">  
              <i class="far fa-heart pr-2" style="color:grey;"></i></button>
              <small class="pr-3"><?= count($like); ?></small>
              <a href="">
              <button class="btn">
              <i class="fas fa-comment pr-2" style="color:grey;"></i></button></a>
              <small><?= count($rows); ?></small>
            <?php } ?>

       
        </div>
          <button type="button" class="btn ml-auto" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-share-alt" style="color:grey !important;"></i></button> 
        </div>
        </form>

        <!-- Modal Share button -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Share link to</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <!-- AddToAny BEGIN -->
          <?php if(isset($_SESSION["login"])) { ?>
            <div class="a2a_kit a2a_kit_size_32 a2a_default_style" data-a2a-url="http://www.mylegends.ml/post.php?id=<?= $row["id"]; ?>" data-a2a-title="<?= $row["judul"]; ?>">
              <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
              <a class="a2a_button_whatsapp"></a>
              <a class="a2a_button_facebook"></a>
              <a class="a2a_button_twitter"></a>
              <a class="a2a_button_email"></a>
              <a class="a2a_button_sms"></a>
            </div>
          <?php } else { ?>
            <div class="a2a_kit a2a_kit_size_32 a2a_default_style" data-a2a-url="http://www.mylegends.ml/postguest.php?id=<?= $row["id"]; ?>" data-a2a-title="<?= $row["judul"]; ?>">
              <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
              <a class="a2a_button_whatsapp"></a>
              <a class="a2a_button_facebook"></a>
              <a class="a2a_button_twitter"></a>
              <a class="a2a_button_email"></a>
              <a class="a2a_button_sms"></a>
            </div>
          <?php } ?>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

          </div>
        </div>
      </div>
    </div>
    
    <!-- Javascript -->
  <script>
    var a2a_config = a2a_config || {};
    a2a_config.locale = "id";
  </script>
  <script async src="https://static.addtoany.com/menu/page.js"></script>

        <!-- deskribsi post -->
          <p><h5>Caption</h5></p>
          <!-- class="py-4" -->
          <p><?= $row["caption"]; ?></p>
        
        <!-- tags post -->
          <p><h5>tags</h5></p>
          <p><?= $row["tag"]; ?></p>
        </div>
        </div>
        <br>

        <!-- bagian komen -->
<div class="container d-flex justify-content-center">
<h3>Comments</h3></div>
<br>
<div class="container d-flex justify-content-center">
  <form class="form" action="" method="post">
    <div class="d-flex">
      <input type="hidden" name="idpost" value="<?= $row["id"]; ?>">
      <input type="hidden" name="nama" value="<?= $row2["username"]; ?>">
      <textarea class="form-control mr-2" rows="1" name="komen" placeholder="Comment.."></textarea>
    <button class="btn btn-primary my-sm-0" type="submit" name="submit">Send</button>
  </div>
  </form>
  </div>
  <br>

<?php if(count($rows) !== 0) { ?>
<div class="container" style="max-width: 580px; background-color: #e9eceb; padding-top: 20px; border-radius: 20px;">
    <?php foreach($rows as $mhs) { ?>
    <div class="d-flex justify-content-between">
      <a href="profil.php?nama=<?= $mhs["nama"]; ?>">
      <h5><?= $mhs["nama"]; ?></h5></a>

      <?php if($mhs['nama'] == $row2['username']) { ?>
      <a href="hapuskomen.php?idkomen=<?= $mhs["idkomen"]; ?>" onclick="return confirm('yakin ingin menghapus?')">
      <button class="btn" type="button"><i class="fas fa-trash"></i></button></a>
      <?php } ?>
    
    </div>
    <p><?= $mhs["komen"]; ?><br></p>
    
    <?php } ?>
    </div>
  <?php } ?>
</div>
</div>
</body>
</html>

<!-- <button type="button" class="btn btn-primary"><i class="fas fa-pen"></i></button> -->


<!-- <div class="dropdown dropleft">
  <button class="btn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-ellipsis-v"></i>
  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="#">Edit</a>
    <a class="dropdown-item" href="#">Delete</a>
  </div>
</div> -->