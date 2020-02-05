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
<!doctype html>
<html lang="en">
<head>

<!--import head.html file -->
<?php include('head.html'); ?>

</head>
<body>

<?php include('nav.php'); ?>
<br>

<div class = "container">
	<div class="row">
		<div class="col-md-3">
			<img class="banner img-responsive" src="image/profile1.png" height="auto" width="100%" style="background-color: #f2f4f5;" />
		</div>
		<div class="col-md-9" style="padding:0 5%;" >
			
			<?php
			$conn = mysqli_connect('localhost','root','','library');
			$user=$_SESSION['user'];
			$query = "select distinct * from user_login where user_name='$user'";
			$results = mysqli_query($conn,$query);
			$row = mysqli_fetch_assoc($results);
			$user_id=$row['user_id'];
			$query = "select distinct * from members where id='$user_id'";
			$results = mysqli_query($conn,$query);
			$row = mysqli_fetch_assoc($results);
			$user_name=$row['name'];
			$user_number=$row['number'];
			$user_address=$row['address'];
				echo "<h5 class='info' style='text-transform:uppercase' >NAME : ".$user_name. "</h5>";
				echo "<h5 class='info'>USER ID : ".$user_id. "</h5>";
				echo "<h5 class='info'>NUMBER : " .$user_number."</h5>";
				echo "<h5 class='info' style='text-transform:uppercase' >ADDRESS : " .$user_address."</h5>";
		?>
		
		</div>
	</div>
	
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