<?php 
session_start();

if(!isset($_SESSION["login"])) {
	header("Location: login.php");
	exit;
}

require 'functions.php';
$nyoba = query("SELECT * FROM akun");

// pas tombol cari dipencet
if(isset($_POST["cari"])){
	$nyoba = cariakun($_POST["keyword"]);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="fontawesome-free-5.15.1-web/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="css/sidebar.css" rel="stylesheet">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
  <!-- bagian navbar -->
  <nav class="navbar navbar-dark bg-primary">
    <div class="container d-flex justify-content-between">
          <div class="form">
        <button type="button" class="btn btn-primary my-2 my-sm-0">Login</button>
        </div>
      <a class="navbar-brand">My Legends</a>
      <div class="form">
        <a href="tambah.php" button type="button" name="ngepost" class="btn btn-primary my-2 my-sm-0"><i class="fas fa-plus"></i></a>
        </div>
    </div>
  </nav>
<br>
<a href="logout.php">Logout</a> <br>
<a href="registrasi.php">Registrasi</a>


  <!-- bagian search bar -->
  <div class="form d-flex justify-content-center p-2">
    <form class="form-inline" action="" method="post">
      <div class="d-flex">
      <input class="form-control mr-2" type="search" name="keyword" placeholder="Search.." aria-label="Search">
      <button class="btn btn-light my-sm-0" type="submit" name="cari"><i class="fas fa-search"></i></button>
    </div>
    </form>
  </div>

<table border="1" cellspacing="0" cellpadding="10">
	
	<tr>
		<th>No.</th>
		<th>Aksi</th>
		<th>username</th>
		<th>email</th>
		<th>password</th>
		<th>gambar</th>
	</tr>

	<?php $i = 1; ?>
	<?php foreach($nyoba as $default) { ?>
	<tr>
		<td><?= $i; ?></td>
		<td>
			<a href="ubahakun.php?id=<?= $default["idakun"]; ?>" onclick="return confirm('yakin ingin mengubah?');">Edit</a> |
			<a href="hapusakun.php?id=<?= $default["idakun"]; ?>" onclick="return confirm('yakin ingin menghapus?');">Delete</a>
		</td>
		<td><?= $default["username"]; ?></td>
		<td><?= $default["email"]; ?></td>
		<td><?= $default["password"]; ?></td>
		<td><img src="img/<?= $default["gambar"]; ?>" width="50"></td>
	</tr>
	<?php $i++; ?>
	<?php } ?>

</table>

</body>
</html>