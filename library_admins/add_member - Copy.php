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
	
	<div class="wrapper">
		<br/><h1>Enter Details For Add A Member</h1><br/>
		<form action="add_member.php" method="post" name="add_memder_form">
			<div class="form-group">
				<h4>Member Name :</h4>
				<input class="form-control" type="text" name="name" required /><br/>
				<h4>Mobile Number :</h4>
				<input class="form-control" type="number" name="number"/><br/>
				<h4>Address :</h4>
				<textarea name="address" placeholder="Your address" required ></textarea><br/>
				<h4>User Name :</h4>
				<input class="form-control" type="text" name="user_name" required /><br/>
				<h4>Password :</h4>
				<input class="form-control" type="password" name="pass1" minlength="7" maxlength="20" placeholder='Enter Password' required /><br/>
				<input class="form-control" type="password" name="pass2" minlength="7" maxlength="20" placeholder='Re-Enter Password' required />
			</div>
			<input type="submit" name="submit" class="btn btn-primary" value="Add Member"/>
		</form>
		<?php
			if(isset($_POST['submit'])){
				$name = $_POST['name'];
				$number=$_POST['number'];
				$address=$_POST['address'];
				$user_name = $_POST['user_name'];
				$pass1 = $_POST['pass1'];
				$pass2 = $_POST['pass2'];
				
				if($pass1!==$pass2){
					echo "
							<script>
							alert('Passwords are not same!');
							</script>
						";	
				}
				else{
					$con = mysqli_connect('localhost','root','','library');
					$query="insert into members(name,number,address) values('$name','$number','$address');";
					$query .="insert into admin_login(admin_name,admin_pass) values('$user_name','$pass1')";
					$result = mysqli_multi_query($con,$query);
					if($result == true){
						echo "
							<script>
							alert('Member has been added');
							</script>
						";
					}
					else{
						echo "
							<script>
							alert('Something went wrong !');
							</script>
						";	
					}
					
				}
			}
		?>
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