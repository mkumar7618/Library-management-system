<!doctype html>
<html lang="en">
<head>

<!--import head.html file -->
<?php include('head.html'); ?>

<link rel="stylesheet" href="loginstyle.css" />

</head>
<body>

<?php include('nav.php'); ?>
<br>

<div class="container-fluid">
<!--banner-->
<div class="row">
		<div class="col-md-5">
			<img class="banner img-responsive" src="image/library.jpg"/ width='85%'>
		</div>
		<div class="col-md-7">
		<h1>Welcome To Book Store</h1><br>
			<form action="search.php" method="post" enctype="multipart/form-data">
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
<!--Book details-->
<br>
<div class="row">
	<div class="col-md-12">
		<h1>Books</h1>
	</div>
</div>

	<?php
	if(isset($_POST['submit']) && $_POST['search']!== ''){
		$con = mysqli_connect('localhost','root','','library');
		$search_query = $_POST['search'];
		$query = "select * from book_store where title like '%$search_query%'";
		$result = mysqli_query($con,$query);
		foreach ($result as $value){
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
						<h4>$title</h4>
					</div>
				</div>
			";
		}
	}
	else{
		$con = mysqli_connect('localhost','root','','library');
		$query = "select * from book_store";
		$result = mysqli_query($con,$query);
		static $i=0;
		foreach ($result as $value){
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
						<h4>$title</h4>
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
