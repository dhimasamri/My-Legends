<?php 
session_start();

if(isset($_SESSION["login"])) {
	header("Location: index.php");
	exit;
}

require 'functions.php';

if(isset($_POST["login"])) {

	$username = $_POST["username"];
	$password = $_POST["password"];

	$result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

	// cek username
	if(mysqli_num_rows($result) === 1 ) {

		// cek password
		$row = mysqli_fetch_assoc($result);
		if( password_verify($password, $row['password'])) {
			// set session
			$_SESSION["login"] = true;

			header("Location: index.php");
			exit;
		}
	}

	$error = true;

}
?>

<!-- =================================== HTML below here ============================== -->

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="fontawesome-free-5.15.1-web/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>

  <nav class="navbar">
    <div class="container d-flex justify-content-between">
      <button type="button" class="btn"><i class="fas fa-arrow-left"></i></button>
    </div>
  </nav>

  <div class="container" style="max-width: 20rem;">

    <!-- title form -->
    <div class="container d-flex justify-content-center py-4">
      <h1>Sign-in</h1>
    </div>

    <!-- bagian form -->
    <form class="py-3">
      <div class="d-flex flex-column">

        <!-- bagian email form -->
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="username" class="form-control" id="email" aria-describedby="emailHelp">
        </div>

        <!-- bagian password form -->
        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input type="text" name="password" class="form-control" id="exampleInputPassword1">
        </div>
        <?php if(isset($error)) { ?>
          <p style="color: red; font-style: italic;">Username atau Password salah!</p>
        <?php } ?>

        <!-- lupa password -->
        <div class="d-flex justify-content-end pb-3">
          <a href="#" style="color: grey;">Forgot Password?</a>
        </div>

        <!-- tombol sign-in -->
        <button type="submit" class="btn btn-primary" style="border-radius: 20px;">Sign-in</button>
          <div class="align-self-center p-2">
          <p style="color: grey;">Or Sign-up with</p>
        </div>

        <!-- sign in google -->
        <button type="submit" class="btn btn-primary" style="border-radius: 20px;"><i class="fab fa-google"></i> Sign-in with Google</button>

        <!-- sign up -->
        <div class="align-self-center p-2">
          <a href="registrasi.php" style="color: grey;"><p>Not a member? Sign-up now</p> </a>
        </div>
      </div>
    </form>
  </div>

  <!-- Javascript -->


</body>
</html>