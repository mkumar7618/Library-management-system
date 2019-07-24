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
		<div class="col-md-5">
			<img class="banner img-responsive" src="image/library.jpg"/ width='85%'>
		</div>
		<div class="col-md-7">
		<h1>Update A Member</h1><br>
		<form action="update_member.php" method="post" enctype="multipart/form-data">
			<div class="form-group">
			<label><h4>Enter Member :</h4></label>
			<input class="form-control" name="id" type="text" placeholder="Enter Member ID For The Member To Be Updated" />
			</div>		
			<div class="form-group">
			<label><h4>Member Name :</h4></label>
			<input class="form-control" name="name" type="text" placeholder="Enter Member Name" />
			</div>
			<input type="submit" name="sub" class="btn btn-danger"/>
		</form>
		</div>
	</div>


	<?php
		if(isset($_POST['sub'])){
			$member_name = $_POST['name'];
			$member_id = $_POST['id'];
			
			$con = mysqli_connect('localhost','root','','library');
			$query="update members set member_name = '$member_name' where member_id = '$member_id'";
			
			$result = mysqli_query($con,$query);
			if($result == true){
				echo "
					<script>
					alert('Member has been updated');
					</script>
				";
			}
			else{
				echo "
					<script>
					alert('Something went wrong!');
					</script>
				";	
			}
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