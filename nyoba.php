<?php  

require 'functions.php';
$mahasiswa = query("SELECT * FROM mahasiswa");

?>

<!DOCTYPE html>
<html>
<head>
	<title>My Legends</title>
</head>
<body>

<!-- <div class="card" style="width: 18rem;" style="background-color: blue;">
  <img src="..." class="card-img-top" alt="..." width="40">
  <div class="card-body">
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
  </div>
</div> -->


<?php for($i=0; $i < 20; $i++) { ?>
	<?php echo '
		<div class="card" style="width: 36rem; background-color: blue;">
  			<img src="img/ahmad.png" class="card-img-top"  width="40">
  			<div class="card-body">
    			<p class="card-text"> Selamat Datang </p>
  			</div>
		</div> <br>
		' 
	?>
<?php } ?>



</body>
</html>