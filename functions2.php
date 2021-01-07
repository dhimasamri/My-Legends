<?php 

// if(isset($_SESSION["login"])) {
//   $emailakun = $_SESSION['emailakun'];
// }

// koneksiin ke database
// $conn = mysqli_connect("localhost", "root", "", "phpdasar");
$conn = mysqli_connect("sql208.epizy.com", "epiz_27543726", "sToHXnpOMJ", "epiz_27543726_phpdasar");

$user_id = 2;

function query($query) {
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while($row = mysqli_fetch_assoc($result)){
		$rows[] = $row;
	}
	return $rows;
}

function query2($query2) {
	global $conn;
	$result2 = mysqli_query($conn, $query2);
	$rows2 = [];
	while($row2 = mysqli_fetch_assoc($result2)){
		$rows2[] = $row2;
	}
	return $rows2;
}

function tambah($data) {
	global $conn;
	// upload gambar
	$gambar = upload();
	if(!$gambar) {
		return false;
	}

	// ambil data tiap elemen
	$judul = htmlspecialchars($data["judul"]);
	$caption = htmlspecialchars($data["caption"]);
	$tag = htmlspecialchars($data["tag"]);

	// $nyoba = "SELECT * FROM akun WHERE email = '$emailakun'";
	// mysqli_query($conn, $nyoba) or die ('Error');
	// $result2 = mysqli_query($conn, $nyoba);
	// $row = mysqli_fetch_array($result2);
	$nama = htmlspecialchars($data["nama"]);
	$ava = htmlspecialchars($data["ava"]);
	$date = date("d M Y");
	// query insert data
	$query = "INSERT INTO postingan VALUES
			('', '$judul', '$gambar', '$caption', '$tag', '$nama', '$ava', '$date')";
	
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
	$ekstensiGambarValid = ['jpg', 'jpeg', 'png', 'bmp', 'gif'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if( !in_array($ekstensiGambar, $ekstensiGambarValid)) {
		echo "	<script>
					alert('yang anda upload bukan gambar!');
				</script>";
		return false;
	}

	// cek ukuran gambar
	if($ukuranFile > 5000000) {
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
	mysqli_query($conn, "DELETE FROM postingan WHERE id = $id");
	return mysqli_affected_rows($conn);
}

function hapusakun($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM akun WHERE idakun = $idakun");
	return mysqli_affected_rows($conn);
}

function hapuskomen($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM komentar WHERE idkomen = $id");
	return mysqli_affected_rows($conn);
}


function hapuslike($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM suka WHERE idlike = $id");
	return mysqli_affected_rows($conn);
}


function ubah($data) {
	global $conn;
	// ambil data tiap elemen
	$id = $data["id"];
	$judul = htmlspecialchars($data["judul"]);
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
	$query = "UPDATE postingan SET
			judul = '$judul',
			gambar = '$gambar',
			caption = '$caption',
			tag = '$tag'
		WHERE id = $id
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function ubahakun($data) {
	global $conn;
	// ambil data tiap elemen
	$idakun = $data["idakun"];
	$username = htmlspecialchars($data["username"]);
	// $password = htmlspecialchars($data["password"]);
	$bio = htmlspecialchars($data["bio"]);
	$gambarLama = htmlspecialchars($data["gambarLama"]);

	// cek apakah user upload gambar baru apa engga
	if($_FILES['gambar']['error'] === 4){
		$gambar = $gambarLama;
	} else {
		$gambar = upload();
	}
	

	// query insert data
	$query = "UPDATE akun SET
			username = '$username',
			gambar = '$gambar',
			bio = '$bio'
		WHERE idakun = $idakun
			";
			
	// $nyoba = "SELECT username FROM akun";
	// $nyoba2 = "SELECT nama FROM postingan";

	// if($nyoba == $nyoba2) {
	// 	$query2 = "UPDATE postingan SET nama = '$username' WHERE $nyoba = $nyoba2";
	// 	mysqli_query($conn, $query2);
	// }

	mysqli_query($conn, $query);
	// mysqli_query($conn, $query2);

	return mysqli_affected_rows($conn);
}


function cari($keyword) {
	global $conn;
	$query = "SELECT * FROM postingan WHERE
		judul LIKE '%$keyword%' OR 
		caption LIKE '%$keyword%' OR
		nama LIKE '%$keyword%' OR
		tag LIKE '%$keyword%'
		ORDER BY id DESC";
	return query($query);
}

function cariakun($keyword) {
	global $conn;
	$query = "SELECT * FROM akun WHERE
		username LIKE '%$keyword%' OR 
		email LIKE '%$keyword%'";
	return query($query);
}



function registrasi($data) {
	global $conn;

	$username = strtolower(stripslashes($data["username"]));
	$email = strtolower(stripslashes($data["email"]));
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$password2 = mysqli_real_escape_string($conn, $data["password2"]);
	$gambar = 'Default.png';
	// $gambar = mysqli_real_escape_string($conn, $data["gambar"]);
	// if(!$gambar) {
	// 	return false;
	// }

	// cek username udh dipake apa blm
	$result = mysqli_query($conn, "SELECT username FROM akun WHERE username = '$username'");

	if (mysqli_fetch_assoc($result)) {
		echo " 
			<script>
				alert('username sudah terdaftar!');
			</script>";
		return false;
	}

	// cek email udh dipake apa blm
	$result2 = mysqli_query($conn, "SELECT email FROM akun WHERE email = '$email'");

	if (mysqli_fetch_assoc($result2)) {
		echo " 
			<script>
				alert('email sudah terdaftar!');
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
	$query = "INSERT INTO akun VALUES
			('', '$username', '$email', '$password', '$gambar', '')";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}


function forgot($data) {
	global $conn;

	// ambil data tiap elemen
	$email = htmlspecialchars($data["email"]);

	// query insert data
	$query = "INSERT INTO forgot VALUES
			('', '$email')";
	
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);

}


function comment($data) {
	global $conn;

	// ambil data tiap elemen
	$idpost = htmlspecialchars($data["idpost"]);
	$nama = htmlspecialchars($data["nama"]);
	$komen = htmlspecialchars($data["komen"]);

	// query insert data
	$query = "INSERT INTO komentar VALUES
			('', '$idpost', '$nama', '$komen')";
	
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);

}


function heart($data) {
	global $conn;

	// ambil data tiap elemen
	$idposting = htmlspecialchars($data["idposting"]);
	$email2 = htmlspecialchars($data["email2"]);

	// query insert data
	$query = "INSERT INTO suka VALUES
			('', '$idposting', '$email2')";
	
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);

}


function about($data) {
	global $conn;

	// ambil data tiap elemen
	$email = htmlspecialchars($data["email"]);
	$Q1 = htmlspecialchars($data["Q1"]);
	$Q2 = htmlspecialchars($data["Q2"]);
	$Q3 = htmlspecialchars($data["Q3"]);
	$Q4 = htmlspecialchars($data["Q4"]);
	$Q5 = htmlspecialchars($data["Q5"]);
	$Q6 = htmlspecialchars($data["Q6"]);
	$Q7 = htmlspecialchars($data["Q7"]);

	// query insert data
	$query = "INSERT INTO survey VALUES
			('', '$email', '$Q1', '$Q2', '$Q3', '$Q4', '$Q5', '$Q6', '$Q7')";
	
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);

}


if (isset($_POST['action'])) {
  $post_id = $_POST['post_id'];
  $action = $_POST['action'];
  switch ($action) {
  	case 'like':
         $sql="INSERT INTO rating_info (user_id, post_id, rating_action) 
         	   VALUES ($user_id, $post_id, 'like') 
         	   ON DUPLICATE KEY UPDATE rating_action='like'";
         break;
  	case 'dislike':
          $sql="INSERT INTO rating_info (user_id, post_id, rating_action) 
               VALUES ($user_id, $post_id, 'dislike') 
         	   ON DUPLICATE KEY UPDATE rating_action='dislike'";
         break;
  	case 'unlike':
	      $sql="DELETE FROM rating_info WHERE user_id=$user_id AND post_id=$post_id";
	      break;
  	case 'undislike':
      	  $sql="DELETE FROM rating_info WHERE user_id=$user_id AND post_id=$post_id";
      break;
  	default:
  		break;
  }

  // execute query to effect changes in the database ...
  mysqli_query($conn, $sql);
  echo getRating($post_id);
  exit(0);
}

// Get total number of likes for a particular post
function getLikes($id)
{
  global $conn;
  $sql = "SELECT COUNT(*) FROM rating_info 
  		  WHERE post_id = $id AND rating_action='like'";
  $rs = mysqli_query($conn, $sql);
  $result = mysqli_fetch_array($rs);
  return $result[0];
}

// Get total number of dislikes for a particular post
function getDislikes($id)
{
  global $conn;
  $sql = "SELECT COUNT(*) FROM rating_info 
  		  WHERE post_id = $id AND rating_action='dislike'";
  $rs = mysqli_query($conn, $sql);
  $result = mysqli_fetch_array($rs);
  return $result[0];
}

// Get total number of likes and dislikes for a particular post
function getRating($id)
{
  global $conn;
  $rating = array();
  $likes_query = "SELECT COUNT(*) FROM rating_info WHERE post_id = $id AND rating_action='like'";
  $dislikes_query = "SELECT COUNT(*) FROM rating_info 
		  			WHERE post_id = $id AND rating_action='dislike'";
  $likes_rs = mysqli_query($conn, $likes_query);
  $dislikes_rs = mysqli_query($conn, $dislikes_query);
  $likes = mysqli_fetch_array($likes_rs);
  $dislikes = mysqli_fetch_array($dislikes_rs);
  $rating = [
  	'likes' => $likes[0],
  	'dislikes' => $dislikes[0]
  ];
  return json_encode($rating);
}

// Check if user already likes post or not
function userLiked($post_id)
{
  global $conn;
  global $user_id;
  $sql = "SELECT * FROM rating_info WHERE user_id=$user_id 
  		  AND post_id=$post_id AND rating_action='like'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
  	return true;
  }else{
  	return false;
  }
}

// Check if user already dislikes post or not
function userDisliked($post_id)
{
  global $conn;
  global $user_id;
  $sql = "SELECT * FROM rating_info WHERE user_id=$user_id 
  		  AND post_id=$post_id AND rating_action='dislike'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
  	return true;
  }else{
  	return false;
  }
}

$sql = "SELECT * FROM postingan";
$result = mysqli_query($conn, $sql);
// fetch all posts from database
// return them as an associative array called $posts
$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>