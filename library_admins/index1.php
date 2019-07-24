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
<!DOCTYPE html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="../styles/style.css"/>
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
				<li><a href="book_store.php">Books</a></li>
				<li><a href="return.php">return Book</a></li>
				<li><a href="members.php">Member Details</a></li>
				<li><a href="fines.php">Fines</a></li>
			</ul>	
			<ul class="nav navbar-nav navbar-right">
				<li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
			</ul>
	</div>
</nav>

<div class = "container">
	<div class="row">
		<div class="col-md-5">
			<img class="banner img-responsive" src="image/library.jpg"/ width='85%'>
		</div>
	</div>
	<h1>Welcome to admin area</h1>
	
</body>
</html>