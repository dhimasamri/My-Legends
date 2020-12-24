<?php 
session_start();

if(!isset($_SESSION["login"])) {
	header("Location: login.php");
	exit;
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

?>
<!DOCTYPE html>
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
</html>