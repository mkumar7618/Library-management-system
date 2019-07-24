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

<?php
		if(isset($_POST['isbn'])){
			$title = $_POST['title'];
			$isbn = $_POST['isbn'];
			$name = $_POST['author_name'];
			$image = $_FILES['image']['name'];
			$temp = $_FILES['image']['tmp_name'];
			move_uploaded_file($temp, "home/image/books_front/$image");

			$con = mysqli_connect('localhost','root','','library');
			
			$result = mysqli_query($con,"select author_id from authors where name='$name'");

			if(mysqli_num_rows($results) == 0){
				echo "
					<script>
						alert('Author not available!');
					</script>
				";
				die();	
			}
			else{
				$row = mysqli_fetch_assoc($result);
				$author_id = $row["author_id"];
			}
			
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