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

<!DOCTYPE html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="./styles/style.css"/>
</head>
<body>

<nav class="navbar navbar-default">
	<div class="container-fluid">
		 <div class="navbar-header">
			  <a class="navbar-brand" href="index.php">Library</a>
		 </div>
			<ul class="nav navbar-nav">
				<li class="active"><a href="home.php">Home</a></li>
				<li><a href="add_book.php">Add Book</a></li>
				<li><a href="delete_book.php">Delete Book</a></li>
				<li><a href="update_book.php">Update Book</a></li>
				<li><a href="add_member.php">Add Member</a></li>
				<li><a href="delete_member.php">Delete Member</a></li>
				<li><a href="update_member.php">Update Member</a></li>
				<li><a href="book_store.php">Book Details</a></li>
				<li><a href="members.php">Member Details</a></li>
				<li><a href="issue.php">Issue Book</a></li>
			</ul>	
			<ul class="nav navbar-nav navbar-right">
				<li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
			</ul>
	</div>
</nav>

<div class = "container">
	<!--banner-->
	<div class="row">
		<div class="col-md-5">
			<img class="banner img-responsive" src="image/library.jpg"/ width='85%'>
		</div>
	</div>
	<h1>Please enter details to issue book :</h1>

	<div class="row">
	<div class="col-md-12">
		<form action="issue.php" method="post">
			<div class="form-group">
			<label>Enter Your Name:</label>
			<input class="form-control" name="name" type="text" value=""/>
			</div>
			<div class="form-group">
			<?php
				$con = mysqli_connect('localhost','root','','library');
				$id = $_GET['id'];
				$result = mysqli_query($con,"select title from book_store where isbn='$id'");
					
					foreach ($result as $value) {
						$book = $value['title'];
							echo "
							<label>Enter Book Title :</label>
							<input class='form-control' name='title' type='text' value='$book'/>
							</div>
							";
						}
					
						if(!$id){
							echo "
								<label>Enter Book Name :</label>
									<input class='form-control' name='book' type='text' value=''/>
								</div>

							";
						}
						
			
		?>
			<input type="submit" class="btn btn-danger" name="submit"/>
		</form>
	</div>
	</div>


	<div class="footer">
		<div class="row">
			<div class="col-md-12">
				<h2 class="footer-head">&copy; 2017 Library Mangement System</h2>
			</div>
		</div>
	</div>
</div>
</body>
<?php
	if($_POST['name']!=='a' && isset($_POST['submit'])){

		$con = mysqli_connect('localhost','root','','library');
			 	$user_book = $_POST['book'];
			 	$results = mysqli_query($con,"select * from book_store where book_name='$user_book'");
			 	$rows = mysqli_num_rows($results);
			 	if($rows == 0){
			 		echo "
						<script>
							alert('Book not available!');
						</script>
			 		";
			 		die();	
			 	}
			 	$query = "select * from issue_table where book_name = '$user_book'";
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

		$user = $_POST['name'];
		$book_name = $_POST['book'];
		$result = mysqli_query($con,"insert into issue_table(person_name,book_name) values('$user','$book_name') ");
		
		if($result == false){
			echo "<script> 
			alert('Something Went Wrong!')
			</script>";
		}
	}
	else{
		echo "";
	}

?>
</html>