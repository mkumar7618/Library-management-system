<?php
session_start();
if(!isset($_SESSION['user'])){
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
	<!--banner-->
	<div class="row">
		<div class="col-md-5">
			<img class="banner img-responsive" src="image/library.jpg"/ width='85%'>
		</div>

		<div class="col-md-7">
		<h1>Enter Details To Return Book :</h1><br>
			<form action="return.php" method="post">
				<div class='form-group'>
					<label><h4>Enter ISBN Number :</h4></label>
					<input class='form-control' name='isbn' type='text' value=''/>
				</div>
				<input type="submit" class="btn btn-success" name="return" value="Return"/>
			</form>
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


<!-- book issue -->

<?php

	if(isset($_POST['isbn']) && isset($_POST['return'])){
		$con = mysqli_connect('localhost','root','','library');
		$isbn = $_POST['isbn'];
		$results = mysqli_query($con,"select * from book_issued where isbn='$isbn'");
		$rows = mysqli_num_rows($results);
		if($rows == 0){
			echo "
				<script>
					alert('Book already in library!');
				</script>
			";
			die();	
		}
		else{
			$date=date_create("",timezone_open("Indian/Kerguelen"));
			$in_date=date_format($date,"Y-m-d h:i:s");
			
			$query="update fines set in_date='$in_date' where (in_date IS NULL AND isbn='$isbn');";
			$query .="delete from book_issued where isbn='$isbn';";
			$result = mysqli_multi_query($con,$query);
			
			echo "
			<script>
				alert('Book Returned!');
			</script>
			";
			die();
		}
	}
?>
</html>