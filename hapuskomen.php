<?php 
session_start();

if(!isset($_SESSION["login"])) {
	header("Location: login.php");
	exit;
}

require 'functions.php';

$id = $_GET["idkomen"];

if(hapuskomen($id) > 0) {
	echo " 
			<script>
				alert('Komentar Berhasil Dihapus!');
				document.location.href = 'index.php';
			</script>
		";
} else {
		echo " 
			<script>
				alert('Komentar Gagal Dihapus!');
				document.location.href = 'index.php';
			</script>
		";
}

?>