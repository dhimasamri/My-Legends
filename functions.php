<?php 
// koneksiin ke database
$conn = mysqli_connect("localhost", "root", "", "phpdasar");


function query($query) {
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while($row = mysqli_fetch_assoc($result)){
		$rows[] = $row;
	}
	return $rows;
}

function tambah($data) {
	global $conn;
	// upload gambar
	$gambar = upload();
	if(!$gambar) {
		return false;
	}

	// ambil data tiap elemen
	$caption = htmlspecialchars($data["caption"]);
	$tag = htmlspecialchars($data["tag"]);


	// query insert data
	$query = "INSERT INTO mylegend VALUES
			('', '$gambar', '$caption', '$tag')";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}


function upload(){

	$namaFile = $_FILES['gambar']['name'];
	$ukuranFile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpName = $_FILES['gambar']['tmp_name'];

	// cek ada gambar yg diupload apa engga
	if($error === 4) {
		echo "	<script>
					alert('Upload gambar terlebih dahulu!');
				</script>";
		return false;
	}

	// cek yg di upload gambar atau bukan
	$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if( !in_array($ekstensiGambar, $ekstensiGambarValid)) {
		echo "	<script>
					alert('yang anda upload bukan gambar!');
				</script>";
		return false;
	}

	// cek ukuran gambar
	if($ukuranFile > 2000000) {
		echo "	<script>
					alert('ukuran gambar terlalu besar!');
				</script>";
		return false;
	}

	// lolos pengecekan, lgsg upload
	// generate nama gambar baru
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;

	move_uploaded_file($tmpName, 'img/' . $namaFileBaru);
	return $namaFileBaru;

}



function hapus($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM mylegend WHERE id = $id");
	return mysqli_affected_rows($conn);
}


function ubah($data) {
	global $conn;
	// ambil data tiap elemen
	$id = $data["id"];
	$gambarLama = htmlspecialchars($data["gambarLama"]);
	$caption = htmlspecialchars($data["caption"]);
	$tag = htmlspecialchars($data["tag"]);

	// cek apakah user upload gambar baru apa engga
	if($_FILES['gambar']['error'] === 4){
		$gambar = $gambarLama;
	} else {
		$gambar = upload();
	}
	

	// query insert data
	$query = "UPDATE mylegend SET
			gambar = '$gambar',
			caption = '$caption',
			tag = '$tag'
		WHERE id = $id
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}



function cari($keyword) {
	global $conn;
	$query = "SELECT * FROM mylegend WHERE 
		caption LIKE '%$keyword%' OR
		tag LIKE '%$keyword%'
		";
	return query($query);
}


function registrasi($data) {
	global $conn;

	$username = strtolower(stripslashes($data["username"]));
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$password2 = mysqli_real_escape_string($conn, $data["password2"]);

	// cek username udh dipake apa blm
	$result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

	if (mysqli_fetch_assoc($result)) {
		echo " 
			<script>
				alert('username sudah terdaftar!');
			</script>";
		return false;
	}


	// cek konfirmasi password
	if($password !== $password2) {
		echo " 
			<script>
				alert('konfirmasi password tidak sesuai!');
			</script>";
		return false;
	}

	// enkripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);

	// masukkan ke database
	$query = "INSERT INTO user VALUES
			('', '$username', '$password')";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}


?>