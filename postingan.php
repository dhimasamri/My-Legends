<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="fontawesome-free-5.15.1-web/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
  
  <!-- bagian navbar -->
  <!-- Navbar ketika belum login -->
  <!-- <div class="sticky-top">
  <nav class="navbar navbar-dark bg-primary ">
    <div class="container d-flex justify-content-between">
        <a href="login.html">
        <button type="button" class="btn btn-primary my-2 my-sm-0"><i class="fas fa-user pr-2"></i>Login</button>
        </a>
        <a class="navbar-brand">My Legends</a>
        <a href="addpost.html">
        <button type="button" class="btn btn-primary my-2 my-sm-0"><i class="fas fa-plus"></i></button>
      </a>
    </div>
  </nav> -->

  <!-- Navbar ketika telah login -->
  <nav class="navbar navbar-dark bg-primary">
    <div class="container d-flex justify-content-between">
        <div class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <button type="button" class="btn btn-primary my-2 my-sm-0"><i class="fas fa-user pr-2"></i>Username</button>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="profil.html">My Profile</a></li>
            <li><a class="dropdown-item" href="edit_profile.html">Edit profile & password</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Log Out</a></li> 
          </ul>
        </div>
        <a class="navbar-brand">My Legends</a>
        <a href="tambah.php">
        <button type="button" class="btn btn-primary my-2 my-sm-0"><i class="fas fa-plus"></i></button>
      </a>
    </div>
  </nav>

  <!-- bagian container -->
  <div class="container d-flex justify-content-center p-4">
    <div class="d-flex flex-column">

      <!-- bagian card -->
      <div class="card border-secondary" style="max-width: 36rem; max-height: 56rem;">

        <!-- bagian atas card -->
        <div class="card-body">
          <div class="d-flex justify-content-start">

            <!-- gambar akun post -->
            <div class="align-self-center mr-3">
              <a href="profil.html">
                <img src="haya.jpeg" alt="..." class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
              </a>
            </div>

            <!-- nama akun, title, waktu post -->
            <div class="d-flex flex-column">
              <h5 class="card-title">Best Build Haya</h5>
              <div class="d-flex flex-row">
                <a href="profil.html" style="color: black;"><h6 class="pr-2">Fernando,</h6></a>
                <h6 class="text-primary">5h ago</h6>
              </div>
            </div>
          </div>
        </div>

        <!-- gambar post -->
        <div class="d-flex justify-content-center">
          <div class="d-flex align-items-center">
            <a href="post.html">
              <img class="card-img-top p-1" src="haya.jpeg" alt="Card image cap" style="max-width: 800px; max-height: 328px; object-fit: cover;">
            </a>
          </div>
        </div>

        <!-- bagian bawah card -->
        <div class="card-body">

          <!-- like dan comment post -->
          <div class="d-flex">
            <div class="align-self-center">
              <div class="d-flex justify-content-between" style="width: 8rem;">
                <i class="fas fa-heart" style="color:grey;"></i>
                <small>123</small>
                <i class="fas fa-comment" style="color:grey;"></i>
                <small>35</small>
              </div>
            </div>
            <button type="button" class="btn ml-auto"><i class="fas fa-share-alt" style="color:grey;"></i></button> 
          </div>

          <!-- deskribsi post -->
          <p class="py-4">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consectetur, tempore possimus laborum debitis atque ab corrupti omnis libero, quia mollitia voluptatum doloribus quibusdam nisi dignissimos eos! Asperiores reprehenderit est nobis!</p>
        
          <!-- tags post -->
          <p><h5>tags</h5></p>
          <p>assasin mage mm</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Javascript -->
</body>
</html>