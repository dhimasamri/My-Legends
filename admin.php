<?php 
session_start();

if(!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

require 'functions.php';
$mahasiswa = query("SELECT * FROM akun");
$mahasiswa2 = query("SELECT * FROM postingan");

// pas tombol cari dipencet
if(isset($_POST["cari"])){
  $mahasiswa = cari($_POST["keyword"]);
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>Halaman Admin</title>
  </head>
  <body>
    
<!-- bagian navbar -->
  
<form class="sticky-top" action="" method="post">

    <nav class="navbar navbar-dark bg-primary">
      <div class="container d-flex justify-content-between">
      <?php if(isset($_SESSION["login"])) { ?>
  
        <!-- bagian dropdown kalo udah login -->
        <div class="dropdown">
          <a href="logout.php">
          <button class="btn btn-primary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">logout
          </button></a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="ownprofil.php">Profil</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="logout.php">Sign Out</a>
          </div>
        </div>
  
          <a class="navbar-brand" href="index.php">My Legends</a>
          <a href="tambah.php">
          <button type="button" name="ngepost" class="btn btn-primary my-2 my-sm-0"><i class="fas fa-plus"></i></button>
          </a>
  
      <?php } else { ?>
  
        <!-- bagian dropdown kalo belom login -->
        <a href="login.php">
        <button type="button" name="login" class="btn btn-primary my-2 my-sm-0"><i class="fas fa-user pr-2"></i>Login</button>
        </a>
          <a class="navbar-brand" href="index.php">My Legends</a>
          <a href="login.php">
          <button type="button" name="ngepost" class="btn btn-primary my-2 my-sm-0"><i class="fas fa-plus" onclick="return confirm('harus login terlebih dahulu');"></i></button>
          </a>
        <?php } ?>
      </div>
     
  
    </nav>

    <div class="container">
      <ul class="nav justify-content-center nav-tabs" id="adminTabs" role="tablist">
        <li class="nav-item" role="presentation">
          <a class="nav-link active" id="about-tab" data-bs-toggle="tab" href="#about" role="tab" aria-controls="about" aria-selected="true">About</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link" id="users-tab" data-bs-toggle="tab" href="#users" role="tab" aria-controls="users" aria-selected="false">Users</a>        
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link" id="posts-tab" data-bs-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="false">Posts</a>
        </li>
      </ul>
      <div class="tab-content" id="adminTabsContents">
        <!-- Isi tab about -->
        <div class="tab-pane fade show active" id="about" role="tabpanel" aria-labelledby="about-tab">
          <br><br><br><br>
          <h2 class="text-center">Welcome to Admin Page</h2><br><br>
          <h4 class="text-center">you can control user's post and user profile from here</h4>
        </div>

        <!-- Isi tab Users -->
        <div class="tab-pane fade" id="users" role="tabpanel" aria-labelledby="users-tab">
          <table border="1" cellspacing="0" cellpadding="10" class="content-center">
            <tr>
              <th>Id User</th>
              <th>Aksi</th>
              <th>Username</th>
              <th>Email</th>
              <th>bio</th>
              <th>Gambar</th>
            </tr>

            <?php $i = 1; ?>
            <?php foreach($mahasiswa as $row) { ?>
            <tr>
              <td><?= $row["idakun"]; ?></td>
              <td>
                <a href="ubahakun.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin ingin mengubah?');">Edit</a> |
                <a href="hapusakun.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin ingin menghapus?');">Delete</a>
              </td>
              <td><?= $row["username"]; ?></td>
              <td><?= $row["email"]; ?></td>
              <td><?= $row["bio"]; ?></td>
              <td><img src="img/<?= $row["gambar"]; ?>" width="50"></td>
            </tr>
            <?php $i++; ?>
            <?php } ?>

          </table>
        </div>

        <!-- Isi tab posts -->
        <div class="tab-pane fade" id="posts" role="tabpanel" aria-labelledby="posts-tab">
          <table border="1" cellspacing="0" cellpadding="10">
            <tr>
              <th>Id Post</th>
              <th>Aksi</th>
              <th>Gambar</th>
              <th>Judul</th>
              <th>Caption</th>
              <th>Tag</th>
              <th>Tanggal Post</th>
            </tr>

            <?php $i = 1; ?>
            <?php foreach($mahasiswa2 as $row2) { ?>
            <tr>
              <td><?= $row2["id"]; ?></td>
              <td>
                <a href="ubah.php?id=<?= $row2["id"]; ?>" onclick="return confirm('yakin ingin mengubah?');">Edit</a> |
                <a href="hapus.php?id=<?= $row2["id"]; ?>" onclick="return confirm('yakin ingin menghapus?');">Delete</a>
              </td>
              <td><img src="img/<?= $row2["gambar"]; ?>" width="50"></td>
              <td><?= $row2["judul"]; ?></td>
              <td><?= $row2["caption"]; ?></td>
              <td><?= $row2["tag"]; ?></td>
              <td><?= $row2["date"]; ?></td>
            </tr>
            <?php $i++; ?>
            <?php } ?>

          </table>
        </div>
      </div>
      
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

  </body>
</html>
