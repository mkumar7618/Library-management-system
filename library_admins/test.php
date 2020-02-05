<?php
session_start();
if(!$_SESSION['user']){
	echo "
		<script>
		window.location.href='http://localhost/library.com/login.php';
		</script>
	";
}
?>

<!DOCTYPE html>
<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!--import head.html file -->
<?php include('head.html'); ?>


</head>
<body>

<?php include('nav.php'); ?>
<br>
<div class = "container">

<h1>Enter Details For Add A Member</h1>

<form id="regForm" action="test.php" method="post" enctype="multipart/form-data">
  <div class="tab">	
	<div class="form-group">
		<h4>Photo :</h4>
		<input class="form-control" type="file" name="image" placeholder="Enter Your Image" required /><br>
		<input class="btn btn-secondary" name="sub" type="submit" value="add image"/>

	</div>
  </div>
</form>

<!-- $nome = $_FILES['userfile']['name'];
$tipo = $_FILES['userfile']['type'];
$dimensione = $_FILES['userfile']['size'];
$tmp = $_FILES['userfile']['tmp_name'];
$url_destinazione = "http://localhost/PHP/Giornale/" . $nome;
$r = move_uploaded_file($tmp, $url_destinazione);-->

<?php
	if(isset($_POST['sub'])){
		$image = $_FILES['image']['name'];
		$temp = $_FILES['image']['tmp_name'];
		$url_destinazione = "http://localhost/library.com/library_admins/image/users_image/" . $image;

		move_uploaded_file($temp,$url_destinazione);
	}
		?>
	
	<!--footer-->
	<div class="footer">
		<?php include('footer.php'); ?>
	</div>

</div>



<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>