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

<?php include('nav.php'); ?>
<br>

<div class = "container">
	<div class="row">
		<div class="col-md-5">
			<img class="banner img-responsive" src="image/library.jpg"/ width='85%'>
		</div>
		<div class="col-md-7">
		<h1>Welcome To Members Area</h1><br>
			<form action="book_store.php" method="post" enctype="multipart/form-data">
				<div class="form-group">
				<label><h4>Search Member :</h4></label>
				<input class="form-control" type="text" name="search" placeholder="Enter Member ID Here" />
				</div>
				<div class="form-group">
				<input type="submit" class="btn btn-success" name="submit" value="Search"/>
				</div>
			</form>
		</div>
	</div>

	  <h1>Member Records</h1>                                                                       
	<div class="table-responsive">          
		<table class="table table-striped">
		<thead>
		<tr class="table-info">
		<th>Member ID</th>
		<th>Member Name</th>
		<th>Books Issued</th>
		</tr>
		</thead>
		<tbody>
		<?php
			$conn = mysqli_connect('localhost','root','','library');
			$query = "select * from members";
			$results = mysqli_query($conn,$query);

			foreach ($results as $value) {
				$id = $value['id'];
				$name=$value['name'];
			
				$query = "select * from book_issued where issue_id='$id'";
				$result = mysqli_query($conn,$query);
				
				foreach ($result as $value) {
					echo "<tr>";
					echo "<td class='info'>".$id. "</td>";
					echo "<td class='info' style='text-transform:uppercase' >".$name. "</td>";
					echo "<td class='info'>" .$value['isbn']. "</br>" . "</td>";
					echo "</tr>";
				}
		}
		?>
		</tbody>
		</table>
	</div>
	
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

