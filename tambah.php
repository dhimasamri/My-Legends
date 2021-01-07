<?php 
session_start();

// if(!isset($_SESSION["login"])) {
// 	header("Location: login.php");
// 	exit;
// }

if(isset($_SESSION["login"])) {
  $emailakun = $_SESSION['emailakun'];
}

require 'functions.php';

// cek tombol submit nya dh diteken blm
if(isset($_POST["submit"])) {
	 

	// cek berhasil ditambahin apa engga
	if(tambah($_POST) > 0) {
		echo " 
			<script>
				alert('Posting Berhasil!');
				document.location.href = 'index.php';
			</script>
		";
	} else {
		echo " 
			<script>
				alert('Posting Gagal!');
				document.location.href = 'index.php';
			</script>
		";
	}
}

$nyoba = "SELECT * FROM akun WHERE email = '$emailakun'";
mysqli_query($conn, $nyoba) or die ('Error');
$result2 = mysqli_query($conn, $nyoba);
$row = mysqli_fetch_array($result2);

?>
<!-- <!DOCTYPE html>
<html>
<head>
	<title>Halaman Posting</title>
</head>
<body>

<h1>Posting</h1>



<form action="" method="post" enctype="multipart/form-data">
	<ul>
		<li>
			<label for="gambar">Gambar :</label>
			<input type="file" name="gambar" id="gambar" required>
		</li>
		<li>
			<label for="caption">Caption :</label>
			<input type="text" name="caption" id="caption" required>
		</li>
		<li>
			<label for="tag">Tag :</label>
			<input type="text" name="tag" id="tag" required>
		</li>
		
		<li>
			<button type="submit" name="submit">POST</button>
		</li>
	</ul>
</form>


</body>
</html> -->



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Post</title>
    <link rel="stylesheet" href="fontawesome-free-5.15.1-web/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
	<form action="" method="post" enctype="multipart/form-data">
	<input type="hidden" name="nama" value="<?= $row["username"]; ?>">
	<input type="hidden" name="ava" value="<?= $row["gambar"]; ?>">
    <div class="container">
                <a href="index.php" type="button" class="btn"><i class="fas fa-arrow-left"></i></a>
        <div class="container d-flex justify-content-center p-4">
            
                <!-- bagian card -->
            <div class="card border-secondary" style="max-width: 36rem; max-height: 56rem;">

            <!-- bagian atas card -->
            <div class="card-body">
            <div class="form">
                <textarea class="form-control" name="judul" required rows="1" placeholder="Add title"></textarea>
        </div>
            </div>

            <!-- gambar post -->
			<input type="file" name="gambar" id="gambar" required>

            <!-- bagian bawah card -->
            <div class="card-body">


            <!-- deskripsi post -->
            <div class="form pb-2">
                <textarea class="form-control" name="caption" rows="3" placeholder="Add Description"></textarea>
            </div>
            
            <!-- tags post -->
            <div class="form">
                <textarea class="form-control" name="tag" rows="3" placeholder="Add Tags, separate with space"></textarea>
            </div>

            </div>

            <!-- tombol publish -->
            <div class="pl-3 pr-3 pb-3">
            <button type="submit" name="submit" class="btn btn-primary btn-block" style="border-radius: 20px;">Publish</button>
        </div>
        </div>
        </div>
    </div>
	</form>
</body>
</html>