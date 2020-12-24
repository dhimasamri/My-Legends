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
$mhs = query("SELECT * FROM mylegend WHERE id = $id")[0];

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
				alert('Postinga Gagal Diubah!');
				document.location.href = 'index.php';
			</script>
		";
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>EDIT</title>
</head>
<body>

<h1>Edit Postingan</h1>



<form action="" method="post" enctype="multipart/form-data">
	<input type="hidden" name="id" value="<?= $mhs["id"]; ?>">
	<input type="hidden" name="gambarLama" value="<?= $mhs["gambar"]; ?>">
	<ul>
		<li>
			<label for="gambar">Gambar :</label> <br>
			<img src="img/<?= $mhs["gambar"]; ?>" width="50"> <br>
			<input type="file" name="gambar" id="gambar">
		</li>
		<li>
			<label for="caption">Caption :</label>
			<input type="text" name="caption" id="caption" required value="<?= $mhs["caption"]; ?>">
		</li>
		<li>
			<label for="tag">Tag :</label>
			<input type="text" name="tag" id="tag" required value="<?= $mhs["tag"]; ?>">
		</li>
		
		<li>
			<button type="submit" name="submit">Edit</button>
		</li>
	</ul>
</form>


</body>
</html>