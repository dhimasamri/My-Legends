<?php 
require 'functions.php';

if(isset($_POST["register"])) {

	if(registrasi($_POST) > 0) {
		echo " 
			<script>
				alert('Sign Up Berhasil!');
			</script>";
	} else {
		echo mysqli_error($conn);
	}
}

?>

<!-- =================================== HTML below here ============================== -->

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>
  <link rel="stylesheet" href="fontawesome-free-5.15.1-web/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>

  <nav class="navbar">
    <div class="container d-flex justify-content-between">
      <button type="button" class="btn"><i class="fas fa-arrow-left"></i></button>
    </div>
  </nav>

  <div class="container py-2" style="max-width: 20rem;">

    <!-- title form -->
    <h1>Sign-up</h1>

    <!-- bagian form -->
    <form>
      <div class="d-flex flex-column py-3">

        <!-- bagian username -->
        <div class="form-group">
          <label for="username">Username</label>
          <input type="username" class="form-control" id="username">
        </div>

        <!-- bagian email -->
        <div class="d-flex flex-column">
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="username" class="form-control" id="email" aria-describedby="emailHelp">
        </div>

        <!-- bagian password -->
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" class="form-control" id="password">
        </div>

        <!-- bagian konfirmasi password -->
        <div class="form-group">
          <label for="password">Konfirmasi Password</label>
          <input type="password" name="password2" class="form-control" id="password">
        </div>

        <!-- bagian checkbox -->
        <div class="custom-control custom-checkbox pb-3">
          <input type="checkbox" class="custom-control-input" id="customCheck1" required>
          <label class="custom-control-label small" for="customCheck1">Creating an account means your'e okay with our Term of Service, Privacy Policy, and our default Notification Settings.</label> 
        </div>
        <button type="submit" name="register" class="btn btn-primary" style="border-radius: 20px;">Create account</button> 
        <?php 
        if(isset($_POST["register"])){
            header("Location: login.php");
            exit;
          }
        ?>
      </div>
    </form>
        <!-- bagian sign in dengan google -->
        <div class="d-flex justify-content-center py-2">
            <p>Or</p>
  </div>
  <button type="submit" class="btn btn-primary" style="border-radius: 20px;"><i class="fab fa-google"></i> Sign-in with Google</button>

  <!-- Javascript -->
</body>
</html>