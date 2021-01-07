<?php 
session_start();

if(!isset($_SESSION["login"])) {
	header("Location: login.php");
	exit;
}

require 'functions.php';

// ambil data di url
$id = $_GET["id"];

// query data mahasiswa berdasarkan id
$mhs = query("SELECT * FROM postingan WHERE id = $id")[0];

// cek tombol submit nya dh diteken blm
if(isset($_POST["submit"])) {
	 

	// cek berhasil diubah apa engga
	if(ubah($_POST) > 0) {
		echo " 
			<script>
				alert('Postingan Berhasil Diubah!');
				document.location.href = 'index.php';
			</script>
		";
	} else {
		echo " 
			<script>
				alert('Postingan Gagal Diubah!');
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
    <title>Edit Post</title>
    <link rel="stylesheet" href="fontawesome-free-5.15.1-web/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
	<form action="" method="post" enctype="multipart/form-data">
	<input type="hidden" name="id" value="<?= $mhs["id"]; ?>">
	<input type="hidden" name="gambarLama" value="<?= $mhs["gambar"]; ?>">
	
    <div class="container">
    			<a href="post.php?id=<?= $mhs["id"]; ?>">
                <button type="button" class="btn"><i class="fas fa-arrow-left"></i></button>
                </a>
        <div class="container d-flex justify-content-center p-4">
            
                <!-- bagian card -->
            <div class="card border-secondary" style="max-width: 36rem; max-height: 56rem;">

            <!-- bagian atas card -->
            <div class="card-body">
            <div class="form">
                <!-- <textarea class="form-control" id="exampleFormControlTextarea1" rows="1" placeholder="Add title"></textarea> -->
                <!-- <label for="title">title :</label> -->
				<input type="text" name="judul" id="title" size="40" required value="<?= $mhs["judul"]; ?>">
        </div>
            </div>

            <!-- gambar post -->
            <!-- <img class="card-img-top" src="haya.jpeg" alt="Card image cap"> -->
            <!-- <label for="gambar">Gambar :</label> -->
            <img src="img/<?= $mhs["gambar"]; ?>" width="50"> <br>
			<input type="file" name="gambar" id="gambar">

            <!-- bagian bawah card -->
            <div class="card-body">


            <!-- deskripsi post -->
            <div class="form pb-2">
                <!-- <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Add Description"></textarea> -->
                <!-- <label for="caption">Caption :</label> -->
				<input type="text" name="caption" size="40" id="caption" required value="<?= $mhs["caption"]; ?>">
            </div>
            
            <!-- tags post -->
            <div class="form">
               <!--  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Add Tags, separate with space"></textarea> -->
                <!-- <label for="tag">Tag :</label> -->
				<input type="text" name="tag" id="tag" size="40" required value="<?= $mhs["tag"]; ?>">
            </div>

            </div>

            <!-- tombol publish -->
            <div class="pl-3 pr-3 pb-3">
            <button type="submit" name="submit" class="btn btn-primary btn-block" style="border-radius: 20px;">Edit Post</button>
        </div>
        </div>
        </div>
    </div>
	</form>
</body>
</html>