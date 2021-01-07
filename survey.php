<?php 
session_start();

if(isset($_SESSION["login"])) {
  $emailakun = $_SESSION['emailakun'];
}
  
require 'functions.php';

$mahasiswa = query("SELECT * FROM postingan ORDER BY id DESC");

if(isset($_POST["submit"])) {
   

  // cek berhasil ditambahin apa engga
  if(about($_POST) > 0) {
    echo " 
      <script>
        alert('Terimakasih telah mengisi survey apps kami!');
        document.location.href = 'index.php';
      </script>
    ";
  } else {
    echo " 
      <script>
        alert('Gagal mengisi survey!');
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
  <title>Survey kepuasan pengguna</title>
  <link rel="stylesheet" href="fontawesome-free-5.15.1-web/css/all.min.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  </head>


<body>
  <a href="index.php">
    <button type="button" class="btn"><i class="fas fa-arrow-left" style="font-size: 25px;"></i></button>
  </a>
  <div class="container">
    <div class="row">
      <div class="col"></div>
      <div class="col-6">
        <br><br>
      <h1>Survey Kepuasan Pengguna</h1>
      <br>
      <form action="" method="post">
        <br>
        <div class="mb-3"> 
          <input type="hidden" name="email" value="<?= $emailakun; ?>">
        </div>
        <br>
        <div class="mb-3">
          <label>1. Bagaimana pendapat anda terhadap tampilan web kami?</label> 
          <div>
            <div class="form-check">
              <input name="Q1" id="Q1_0" type="radio" required class="form-check-input" value="Bagus"> 
              <label for="Q1_0" class="form-check-label">Bagus</label>
            </div>
            <div class="form-check">
              <input name="Q1" id="Q1_1" type="radio" required class="form-check-input" value="Cukup bagus"> 
              <label for="Q1_1" class="form-check-label">Cukup bagus</label>
            </div>
            <div class="form-check">
              <input name="Q1" id="Q1_2" type="radio" required class="form-check-input" value="Kurang bagus">
              <label for="Q1_2" class="form-check-label">Kurang bagus</label>
            </div>
            <div class="form-check">
              <input name="Q1" id="Q1_3" type="radio" required class="form-check-input" value="Sangat tidak bagus"> 
              <label for="Q1_3" class="form-check-label">Sangat tidak bagus</label>
            </div>
          </div>
        </div>
        <br>
        <div class="mb-3">
          <label for="Q2">2. Apakah ada masalah pada aspek tampilan saat anda menggunakan web ini pada device anda?</label> 
          <input id="Q2" name="Q2" type="text" class="form-control" aria-describedby="Q2HelpBlock" required> 
          <span id="Q2HelpBlock" class="form-text text-muted">Jika tidak ada mohon isikan strip "-"</span>
        </div>
        <br>
        <div class="mb-3">
          <label for="Q3">3. Apakah anda memiliki kesulitan dalam memahami cara kerja atau kesulitan dalam menggunakan web ini?</label> 
          <input id="Q3" name="Q3" type="text" class="form-control" required aria-describedby="Q3HelpBlock"> 
          <span id="Q3HelpBlock" class="form-text text-muted">Jika tidak ada mohon isikan strip "-"</span>
        </div>
        <br>
        <div class="mb-3">
          <label>4. Pada fitur yang tersedia saat ini, apakah cukup untuk memenuhi keperluan anda dalam berbagi atau mencari info tentang game mobile legends?</label> 
          <div>
            <div class="form-check">
              <input name="Q4" id="Q4_0" type="radio" class="form-check-input" value="Cukup" required> 
              <label for="Q4_0" class="form-check-label">Cukup</label>
            </div>
            <div class="form-check">
              <input name="Q4" id="Q4_1" type="radio" class="form-check-input" value="Masih kurang" required> 
              <label for="Q4_1" class="form-check-label">Masih kurang</label>
            </div>
          </div>
        </div>
        <br>
        <div class="mb-3">
          <label for="Q5">5. Menurut anda, adakah tampilan atau fitur yang perlu ditambahkan atau diperbaiki pada web ini untuk kedepannya?</label> 
          <input id="Q5" name="Q5" type="text" class="form-control" required aria-describedby="Q5HelpBlock"> 
          <span id="Q5HelpBlock" class="form-text text-muted">Jika tidak ada mohon isikan strip "-"</span>
        </div>
        <br>
        <div class="mb-3">
          <label for="Q6">6. Dalam skala 1-10, berapakah penilaian anda untuk kepuasan dalam menggunakan web ini?</label> 
          <select id="Q6" name="Q6" class="form-select" required>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
          </select>
        </div>
        <br>
        <div class="mb-3">
          <label>7. Apakah anda tertarik untuk terus menggunakan web ini?</label> 
          <div>
            <div class="form-check">
              <input name="Q7" id="Q7_0" type="radio" class="form-check-input" value="Saya akan terus menggunakan web ini" required> 
              <label for="Q7_0" class="form-check-label">Saya akan terus menggunakan web ini</label>
            </div>
            <div class="form-check">
              <input name="Q7" id="Q7_1" type="radio" class="form-check-input" value="Saya masih ingin coba-coba dahulu" required> 
              <label for="Q7_1" class="form-check-label">Saya masih ingin coba-coba dahulu</label>
            </div>
            <div class="form-check">
              <input name="Q7" id="Q7_2" type="radio" class="form-check-input" value="Saya akan tetap menggunakan web ini jika sudah diupdate kekurangannya" required> 
              <label for="Q7_2" class="form-check-label">Saya akan tetap menggunakan web ini jika sudah diupdate kekurangannya</label>
            </div>
            <div class="form-check">
              <input name="Q7" id="Q7_3" type="radio" class="form-check-input" value="Saya akan mencari alternatif lain" required> 
              <label for="Q7_3" class="form-check-label">Saya akan mencari alternatif lain</label>
            </div>
          </div>
        </div>
        <br>
        <div class="mb-3">
          <button name="submit" type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
      </div>
      <div class="col"></div>
    </div>
  </div>
</body>