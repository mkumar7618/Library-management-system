<?php
session_start();
if(!isset($_SESSION['user'])){
	echo "
		<script>
		window.location.href='login.php';
		</script>
	";
}
?>

<!DOCTYPE html>
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
		
		<h2>Please enter details to issue book :</h2>
		
		<form action="issue.php" method="post">
			<div class="form-group">
			<label>Enter Member ID:</label>
			<input class="form-control" name="card_id" type="text" value="" required />
			</div>
			<?php
					$con = mysqli_connect('localhost','root','','library');
					if(isset($_GET['id'])){
					$id = $_GET['id'];
					$result = mysqli_query($con,"select title from book_store where isbn='$id'");
						
						foreach ($result as $value) {
							$book = $value['title'];
								echo "
								<div class='form-group'>
								<label>Book Title :</label>
								<input class='form-control' name='title' type='text' value='$book' required />
								</div>
								<div class='form-group'>
								<label>ISBN Number :</label>
								<input class='form-control' name='isbn' type='text' value='$id' required />
								</div>
								";
							}
					}	
					else{
						echo "
							<div class='form-group'>
								<label>Enter Book Title :</label>
								<input class='form-control' name='title' type='text' placeholder='Enter Book Title ...' required />
							</div>
							<div class='form-group'>
								<label>Enter ISBN Number :</label>
								<input class='form-control' name='isbn' type='text' placeholder='Enter ISBN Number ...' required />
							</div>
						";
					}
			?>
			<br><input type="submit" class="btn btn-danger" name="submit" value="Issue Book" />
		</form>
		</div>
	</div><br>
	
	
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
	if(isset($_POST['isbn']) && isset($_POST['submit'])){

		$con = mysqli_connect('localhost','root','','library');
		$isbn = $_POST['isbn'];
		$results = mysqli_query($con,"select * from book_store where isbn='$isbn'");
		$rows = mysqli_num_rows($results);
		if($rows == 0){
			echo "
				<script>
					alert('Book not available!');
				</script>
			";
			die();	
		}
		else{
			$query = "select * from book_issued where isbn = '$isbn'";
			$q = mysqli_query($con,$query);
			$r = mysqli_num_rows($q);
			if($r>0){
				echo "
					<script>
						alert('Book already issued!');
					</script>
				";
				die();
			}
			else{
				$card_id = $_POST['card_id'];
				$isbn = $_POST['isbn'];
				
				$date=date_create("",timezone_open("Indian/Kerguelen"));
				$out_date=date_format($date,"Y-m-d h:i:s");
				date_add($date,date_interval_create_from_date_string("120 days"));
				$due_date=date_format($date,"Y-m-d h:i:s");
				
				$query="insert into book_issued(isbn,issue_id,out_date) values('$isbn','$card_id','$out_date');";
				$query .="insert into fines(isbn,issue_id,out_date,due_date) values('$isbn','$card_id','$out_date','$due_date')";
				
				$result = mysqli_multi_query($con,$query);
				
				if($result==false){
					echo "<script> 
					alert('Something Went Wrong!)
					</script>";
				}
				else{
					echo "<script> 
						alert('Book issue!')
						</script>;";
				}
			}
		}
	}
	else{
		echo "<br/>";
	}

?>
</html>