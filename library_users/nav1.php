<!DOCTYPE html>
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<!-- Font Awesome 5 and 4 Icons -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #f8f8f8;">
	<a class="navbar-brand" href="home.php">Library</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
	<ul class="navbar-nav mr-auto">
		<li class="nav-item active">
			<a class="nav-link" href="home.php">Home</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="add_member.php">Add Member</a>
		</li>
		<li class="nav-item">
		<a class="nav-link" href="add_book.php">Add Books</a>
		</li>
		<li class="nav-item">
		<a class="nav-link" href="book_store.php">Book store</a>
		</li>
		<li class="nav-item">
		<a class="nav-link" href="return.php">Return Book</a>
		</li>
		<li class="nav-item">
		<a class="nav-link" href="members.php">Member Details</a>
		</li>
		<li class="nav-item">
		<a class="nav-link" href="fines.php">Fines</a>
		</li>
		<li class="nav-item dropdown">
		<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		Others
		</a>
		<div class="dropdown-menu" aria-labelledby="navbarDropdown">
			<a class="dropdown-item" href="delete_book.php">Delete Book</a>
			<a class="dropdown-item" href="delete_member.php">Delete Member</a>
			<a class="dropdown-item" href="update_book.php">Update Book</a>
			<a class="dropdown-item" href="update_book.php">Update Member</a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="#">Something else here</a>
		</div>
		</li>
	</ul>
	<ul class="nav navbar-nav navbar-right">
		<li class="nav-item">
		<a class="nav-link" href="logout.php"><span class='fas fa-sign-out-alt'></span> Logout</a>
		</li>
	</ul>
	</div>
</nav>
</body>
</html>