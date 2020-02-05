

<nav class="navbar sticky-top navbar-expand-lg navbar-light" style="background-color: #f8f8f8;">
	<a class="navbar-brand" href="index.php">
	<img src="image/library_logo.jpg" width="30" height="30" border="3px" class="d-inline-block align-top" alt="Logo">ibrary
	</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
	<ul class="navbar-nav mr-auto">
		<li class="nav-item active">
			<a class="nav-link" href="index.php">Home</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="add_member.php">Add Member</a>
		</li>
		<li class="nav-item">
		<a class="nav-link" href="add_book.php">Add Books</a>
		</li>
		<li class="nav-item">
		<a class="nav-link" href="book_store.php">Book Store</a>
		</li>
		<li class="nav-item">
		<a class="nav-link" href="return.php">Return Book</a>
		</li>
		<li class="nav-item">
		<a class="nav-link" href="members.php">Members Detail</a>
		</li>
		<li class="nav-item">
		<a class="nav-link" href="fines.php">Fines</a>
		</li>
		<li class="nav-item dropdown">
		<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		Others
		</button>
		<div class="dropdown-menu" aria-labelledby="navbarDropdown">
			<a class="dropdown-item " href="update_book.php">Update Book</a>
			<a class="dropdown-item " href="update_member.php">Update Member</a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item " href="delete_book.php">Delete Book</a>
			<a class="dropdown-item " href="delete_member.php">Delete Member</a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="#">Something else here</a>
		</div>
		</li>
	</ul>
	<ul class="nav navbar-nav navbar-right">
		<li class="nav-item">
		<a class="nav-link bg-secondary text-white" href="logout.php" ><span class='fas fa-sign-out-alt'></span> Logout</a>
		</li>
	</ul>
	</div>
</nav>