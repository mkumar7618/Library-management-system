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

<style>
h1 {
	margin-bottom: 40px;
}
</style>
</head>
<body>

<?php include('nav.php'); ?>
<br>

<div class = "container">
	<div class="row">
		<div class="col-md-4">
			<img class="banner img-responsive" src="image/library.jpg"/ width='100%'>
		</div>
		<div class="col-md-8" style="padding:0 10%;" >
		<h1>Enter Details To Search Book</h1>
			<form action="book_store.php" method="post" enctype="multipart/form-data">
				<div class="form-group">
				<label><h4>Search Book :</h4></label>
				<input class="form-control" type="text" name="search" placeholder="Search Books Here" />
				</div>
				<div class="form-group">
				<input type="submit" class="btn btn-success" name="submit" value="Search"/>
				</div>
			</form>
		</div>
	</div>
	
	<br><br><h1>Books</h1>
	
	<?php
	if(isset($_POST['submit']) && $_POST['search']!== ''){
		$con = mysqli_connect('localhost','root','','library');
		$search_query = $_POST['search'];
		$query = "select * from book_store where title like '%$search_query%'";
		$result = mysqli_query($con,$query);
		if(mysqli_num_rows($result)>0){
			foreach ($result as $value) {
				$id = $value['isbn'];
				$title = $value['title'];
				$image = $value['img'];
				echo "
					<div class='row' style='margin-top:20px;'>
						<div class='col-md-2'>
							<img class='banner img-responsive' src='image/books_front/$image' width='100%' />
						</div>
						<div class='col-md-10'>
							<h4>$title</h4><br><br>
							<a class='btn btn-secondary' href='issue.php?id=$id' role='button'>Issue Book</a>
						</div>
					</div>
				";
			}
		}
		else{
			echo "
				<h2>Book Not Available !</h2>
			";	
		}
	}
	else{
		$con = mysqli_connect('localhost','root','','library');
		$query = "select * from book_store";
		$result = mysqli_query($con,$query);
		static $i=0;
		foreach ($result as $value){
			$title = $value['title'];
			$id = $value['isbn'];
			$image = $value['img'];
			echo "
				<div class='row' style='margin-top:20px;' >
					<div class='col-md-2'>
						<img class='banner img-responsive' src='image/books_front/$image' width='100%' />
					</div>
					<div class='col-md-10'>
						<h4>$title</h4><br><br>
						<a class='btn btn-secondary' href='issue.php?id=$id' role='button'>Issue Book</a>
					</div>
				</div>
			";
			$i++;
			if($i>5)
			{ break; }
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