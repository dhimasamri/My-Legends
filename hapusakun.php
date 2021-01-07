<?php 
session_start();

if(!isset($_SESSION["login"])) {
	header("Location: login.php");
	exit;
}

require 'functions.php';

$id = $_GET["idakun"];

if(hapusakun($id) > 0) {
	echo " 
			<script>
				alert('Akun Berhasil Dihapus!');
				document.location.href = 'dataakun.php';
			</script>
		";
} else {
		echo " 
			<script>
				alert('Akun Gagal Dihapus!');
				document.location.href = 'dataakun.php';
			</script>
		";
}

?>