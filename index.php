<?php
session_start();
?>

<!doctype html>
<html lang="en">
<head>

<!--import head.html file -->
<?php include('head.html'); ?>

</head>
<body>


<!--Login Form Validation-->

		<?php
			if(isset($_POST['Submit'])){
				$user = $_POST['User'];
				$password = $_POST['Password'];	
				$con = mysqli_connect('localhost','root','','library');
				if($con){
					$query = "select * from library_admins where admin_id='$user' AND admin_pass='$password'";
					$result = mysqli_query($con,$query);
					if(mysqli_num_rows($result)>0){
						$_SESSION['user'] = $user;
						$_SESSION['pass'] = $password;
						echo "
						<script>
							window.location.href='http://localhost/library.com/library_admins/index.php';
							</script>";

					}
					else{
						$query = "select * from user_login where user_name='$user' AND user_pass='$password'";
						$result = mysqli_query($con,$query);
						if(mysqli_num_rows($result)>0){
							$_SESSION['user'] = $user;
							$_SESSION['pass'] = $password;
							echo "
							<script>
								window.location.href='http://localhost/library.com/library_users/index.php';
							</script>";

						}
						else{
							echo "<script>
								alert('You are not authenticated!');
								</script>";
						}
					}
				}

			}

		?>


<?php include('nav.php'); ?>
<br>

<div class="container-fluid">
<!--banner-->
<div class="row">
	<div class="col-sm-5">
	<img class="banner img-responsive" src="image/library.jpg" width='85%' />
	</div>
	
	<div class="col-sm-7">
	<div class="wrapper">
		<form action="index.php" method="post" name="Login_Form" class="form-signin" enctype="multipart/form-data">       
		    <h3 class="form-signin-heading">Library<br>Sign In Here</h3>
			  <hr class="colorgraph">
			<div class="form-group">
			<input type="text" class="form-control" name="User" placeholder="Username" required autofocus="" />
			</div>
			<div class="form-group">
			<input type="password" class="form-control" name="Password" placeholder="Password" required />     		  
			</div>
			<div class="form-group">
			<button type="Submit" class="btn btn-lg btn-primary btn-block"  name="Submit" value="Login" >Login</button>
			</div>
		</form>		
	</div>
	</div>
</div>
<br/>
<!---->
<div class="row">
	<div class="col-sm-12">
		<h1>Some Books</h1>
	</div>
</div>

<div>
	<?php
		$con = mysqli_connect('localhost','root','','library');
		$query = "select * from book_store";
		$result = mysqli_query($con,$query);
		static $i=0;
		foreach ($result as $value) {
			$id = $value['isbn'];
			$title = $value['title'];
			$image = $value['img'];
			echo "
				<div class='row' style='margin-top:20px'>
					<div class='col-md-2'>
						<img class='banner img-responsive' src='image/books_front/$image' width='100%' />
					</div>
					<div class='col-md-10'>
						<br>
						<h4>ISBN Number : $id</h4>
						<h4>Book Author : Update</h4>
						<h4>Book Title : $title</h4>
					</div>
				</div>
			";
			$i++;
			if($i>9)
			{ break; }
		}
	?>
</div>

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