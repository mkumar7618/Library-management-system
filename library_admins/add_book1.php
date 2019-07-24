
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

	<br><h1>Enter Details For Add A Book</h1><br>
	<form action="add_book.php" method="post" enctype="multipart/form-data">
		<div class="form-group">
		<label><h4>Book Title :</h4></label>
		<input class="form-control" name="title" type="text" placeholder="Enter Book Title" required />
		</div>
		<div class="form-group">
		<label><h4>Book ISBN Number :</h4></label>
		<input class="form-control" name="isbn" type="text" placeholder="Enter ISBN Number" required />
		</div>
		<div class="form-group">
		<label><h4>Book Author :</h4></label>
		<input class="form-control" name="isbn" type="text" placeholder="Enter Author Name" required />
		</div>
		<div class="form-group">
		<label><h4>Book Image :</h4></label>
		<input class="form-control" name="image" type="file" value="Enter an image" required />
		</div>

		<input type="submit" name="sub" class="btn btn-danger"/>
	</form>
	
	<?php
		if(isset($_POST['sub'])){
			$title = $_POST['title'];
			$isbn = $_POST['isbn'];
			$image = $_FILES['image']['name'];
			$temp = $_FILES['image']['tmp_name'];
			move_uploaded_file($temp, "image/books_front/$image");

			$con = mysqli_connect('localhost','root','','library');
			$query="insert into book_store(isbn,title,img) values('$isbn','$title','$image')";
			$result = mysqli_query($con,$query);
			if($result == true){
				echo "
					<script>
					alert('Book has been entered !');
					</script>
				";
			}
			else{
				echo "<script>alert('Something went wrong!');</script>";	
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
