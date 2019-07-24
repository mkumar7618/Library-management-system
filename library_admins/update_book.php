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
	</div>

	<br><h1>Update A Book</h1><br>
	<form action="update_book.php" method="post" enctype="multipart/form-data">
		<div class="form-group">
		<label><h4>ISBN Number :</h4></label>
		<input class="form-control" name="isbn" type="text" placeholder="Enter Book ID For The Book To Be Updated" />
		</div>		
		<div class="form-group">
		<label><h4>Book Name :</h4></label>
		<input class="form-control" name="name" type="text" placeholder="Enter Book Name" />
		</div>
		<div class="form-group">
		<label><h4>Book Category :</h4></label>
		<input class="form-control" name="cat" type="text" placeholder="Enter Book Category" />
		</div>
		<div class="form-group">
		<label><h4>Book image :</h4></label>
		<input class="form-control" name="image" type="file"/>
		</div>
		<input type="submit" name="sub" class="btn btn-danger"/>
	</form>
	<?php
		if(isset($_POST['sub'])){
			$bookname = $_POST['name'];
			$book_id = $_POST['id'];
			$isbn = $_POST['isbn'];
			$cat = $_POST['cat'];
			$image = $_FILES['image']['name'];
			$temp = $_FILES['image']['tmp_name'];
			move_uploaded_file($temp, "product_images/$image");

			$con = mysqli_connect('localhost','root','','library');
			$query="update book_store
			set book_name = '$bookname',
			book_image = '$image',
			book_isbn = '$isbn',
			category = '$cat'
			where bood_id = '$book_id'
			";
			$result = mysqli_query($con,$query);
			if($result == true){
				echo "
					<script>
					alert('Book has been updated!');
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