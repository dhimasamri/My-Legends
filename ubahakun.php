<?php 
session_start();

// if(isset($_SESSION["login"])) {
//   $emailakun = $_SESSION['emailakun'];
// }

require 'functions.php';

// ambil data di url
$id = $_GET["idakun"];

// query data mahasiswa berdasarkan id
$mhs = query("SELECT * FROM akun WHERE idakun = $id")[0];
// $mhs2 = $mhs['username'];
// $mhs3 = "SELECT nama FROM postingan WHERE nama = $mhs2";

// if ($mhs2 == $mhs3){
//   $username = $_POST['username'];
//   $query = "UPDATE postingan SET nama = '$username' WHERE nama = $username";
//   mysqli_query($conn, $query);

//   return mysqli_affected_rows($conn);
// }

// cek tombol submit nya dh diteken blm
if(isset($_POST["submit"])) {
  // cek berhasil diubah apa engga
  if(ubahakun($_POST) > 0) {
    echo " 
      <script>
        alert('Akun Berhasil Diubah!');
        document.location.href = 'index.php';
      </script>
    ";

  } else {
    echo " 
      <script>
        alert('Akun Gagal Diubah!');
        document.location.href = 'index.php';
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
    <title>Edit Profile</title>
    <link rel="stylesheet" href="fontawesome-free-5.15.1-web/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>

  <!-- Navbar ketika telah login -->
  <!-- <nav class="navbar navbar-dark bg-primary">
    <div class="container d-flex justify-content-between">
        <div class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <button type="button" class="btn btn-primary my-2 my-sm-0"><i class="fas fa-user pr-2"></i>Username</button>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="profil.html">My Profile</a></li>
            <li><a class="dropdown-item" href="edit_profile.html">Edit profile & password</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Log Out</a></li> 
          </ul>
        </div>
        <a class="navbar-brand">My Legends</a>
        <a href="tambah.php">
        <button type="button" class="btn btn-primary my-2 my-sm-0"><i class="fas fa-plus"></i></button>
      </a>
    </div>
  </nav> -->

  <!-- navbar -->
  <nav class="navbar navbar-dark bg-primary">
    <div class="container d-flex justify-content-between">
        <a href="ownprofil.php?idakun=<?= $mhs["idakun"]; ?>">
        <button type="button" class="btn"><i class="fas fa-arrow-left"></i></button></a>
    </div>
  </nav>


  <!-- Gridding -->
  <form action="" method="post" enctype="multipart/form-data">
  <input type="hidden" name="idakun" value="<?= $mhs["idakun"]; ?>">
  <input type="hidden" name="gambarLama" value="<?= $mhs["gambar"]; ?>">
  <div class="container">
    <br>
    <br>
    <div class="row flex-lg-nowrap">
      <div class="col-12 col-lg-auto mb-3" style="width: 200px;"></div>
    
      <!-- Main body -->
      <div class="col">
        <div class="row">
          <div class="col mb-3">
            <div class="card">
              <div class="card-body">
                <div class="e-profile">
                  <div class="row">
                    <div class="col-12 col-sm-auto mb-3">
                      <div class="mx-auto" style="width: 140px;">
                        <img src="img/<?= $mhs["gambar"]; ?>" class="d-flex justify-content-center align-items-center rounded-circle" style=" height: 150px; width: 150px; object-fit: cover; background-color: rgb(233, 236, 239);">
                      </div>
                    </div>
                    <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                      <div class="text-center text-sm-left mb-2 mb-sm-0">
                        <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap"><?= $mhs["username"]; ?></h4>
                        <p class="mb-0"><?= $mhs["email"]; ?></p>
                        <div class="text-muted"><small>Mobile Legend Player</small></div>

                        <!-- Tombol ganti foto -->
                        <div class="mt-2">
                          <!-- <input type="file" name="gambar" id="gambar" required> -->
                            <i class="fa fa-fw fa-camera"></i>
                            <span>Change Photo</span><br>
                            <input class="btn" type="file" name="gambar">
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Form -->
                  <div class="tab-content pt-3">
                    <div class="tab-pane active">
                      <form class="form" novalidate="">
                        <div class="row">
                          <div class="col">

                            <!-- Form Username -->
                            <div class="row">                             
                              <div class="col">
                                <div class="form-group">
                                  <label>Username</label>
                                  <input class="form-control" type="text" name="username" value="<?= $mhs["username"]; ?>" requred>
                                </div>
                              </div>
                            </div>


                            <!-- Form bio -->
                            <div class="row">
                              <div class="col mb-3">
                                <div class="form-group">
                                  <label>Bio</label>
                                  <input class="form-control" type="text" name="bio" value="<?= $mhs["bio"]; ?>"></input>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- Tombol save -->
                        <div class="row">
                          <div class="col d-flex justify-content-end">
                            <button class="btn btn-primary" type="submit" name="submit">Save Changes</button>
                          </div>
                        </div>
                      </form>
    
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
    
          <div class="col-12 col-md-3 mb-3">
          </div>
        </div>
    
      </div>
    </div>
  </div>
</form>
  <!-- Javascript -->
  <script src="js/bootstrap.min.js"></script>
</body>