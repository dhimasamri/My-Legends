<?php 
session_start();

require 'functions.php';

// cek tombol submit nya dh diteken blm
if(isset($_POST["submit"])) {
     

    // cek berhasil ditambahin apa engga
    if(forgot($_POST) > 0) {
        echo " 
            <script>
                alert('kami akan mengirim email ke alamat email anda');
                document.location.href = 'login.php';
            </script>
        ";
    } else {
        echo " 
            <script>
                alert('email yang anda masukkan tidak ada');
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
    <title>Forgot Password</title>
    <link rel="stylesheet" href="fontawesome-free-5.15.1-web/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>

    <nav class="navbar">
    <div class="container d-flex justify-content-between">
      <a href="login.php">
      <button type="button" class="btn"><i class="fas fa-arrow-left"></i></button>
      </a>
    </div>
  </nav>

        <div class="container py-5" style="max-width: 20rem;">

        <h2>Forgot Password?</h2>
        <br>
        <p>Enter the email address you used when you joined and we'll send you instruction to reset your password</p>
        <p>For security reason, we do NOT store your password. So rest assured that we will never send your password via email</p>

        <!-- bagian form -->
        <form class="py-4" action="" method="post">

            <!-- bagian email address -->
            <div class="form-group">
                
                <label for="email">Email Address</label>
                <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
            </div>

            
            <!-- tombol Send -->
            <button type="submit" name="submit" class="btn btn-primary btn-block" style="border-radius: 20px;">Send Reset Instruction</button>

            </form>
    </div>
</body>
</html>