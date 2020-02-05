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
	<div class="col-md-4">
		<img class="banner img-responsive" src="image/library.jpg"/ width='100%'>
	</div>
	<div class="col-md-8" style="padding:0 10%;" >
	<h1>Enter Details To Search Members</h1><br>
		<form action="fines.php" method="post" enctype="multipart/form-data">
			<div class="form-group">
			<label><h4>Search Member :</h4></label>
			<input class="form-control" type="text" name="search_id" placeholder="Enter Member ID Here" required />
			</div>
			<div class="form-group">
			<input type="submit" class="btn btn-success" name="submit" value="Search"/>
			</div>
		</form>
	</div>
</div>

</div>

<br>

<div class = "container-fluid">	
		
	<div class="table-responsive">          
	<table class="table table-striped text-center ">
		<thead>
			<tr class="table-info ">
			<th>Member ID</th>
			<th>Name</th>
			<th>Book ISBN</th>
			<th>Issue Date</th>
			<th>Due Date</th>
			<th>Return Date</th>
			<th>Fine</th>
			</tr>
		</thead>
		<tbody>
		<?php
		if(isset($_POST['submit']) && ($_POST['search_id']!== '')){
			$conn = mysqli_connect('localhost','root','','library');
			$search_id=$_POST['search_id'];
			$query = "select * from members where id='$search_id'";
			$results = mysqli_query($conn,$query);

			foreach ($results as $value) {
				$id = $value['id'];
				$name=$value['name'];
			
				$query = "select * from fines where issue_id='$id'";
				$result = mysqli_query($conn,$query);
				
				foreach ($result as $value) {
					$out_date=date_create($value['out_date']);
					$due_date=date_create($value['due_date']);
					$in_date=date_create($value['in_date']);
					
					echo "<tr>";
					echo "<td class='info'>" .$id. "</td>";
					echo "<td class='info' style='text-transform:uppercase' >" .$name. "</td>";
					echo "<td class='info'>" .$value['isbn']. "</br>" . "</td>";
					echo "<td class='info'>" .$value['out_date']. "</td>";
					echo "<td class='info'>" .$value['due_date']. "</td>";
					echo "<td class='info'>" .$value['in_date']. "</td>";
					$diff=date_diff($due_date,$in_date);
					$day=$diff->format("%R%a");
					if($day<1){
						echo "<td class='info'>Zero INR</td>";
						echo "</tr>";
					}
					else{
						$fine=$day*5;
						echo "<td class='info'>$fine INR</td>";
						echo "</tr>";
					}
				}
		}
		}
		else{
			$conn = mysqli_connect('localhost','root','','library');
			$query = "select * from members";
			$results = mysqli_query($conn,$query);

			foreach ($results as $value) {
				$id = $value['id'];
				$name=$value['name'];
			
				$query = "select * from fines where issue_id='$id'";
				$result = mysqli_query($conn,$query);
				
				foreach ($result as $value) {
					$out_date=date_create($value['out_date']);
					$due_date=date_create($value['due_date']);
					$in_date=date_create($value['in_date']);
					
					echo "<tr>";
					echo "<td class='info'>" .$id. "</td>";
					echo "<td class='info' style='text-transform:uppercase' >" .$name. "</td>";
					echo "<td class='info'>" .$value['isbn']. "</br>" . "</td>";
					echo "<td class='info'>" .$value['out_date']. "</td>";
					echo "<td class='info'>" .$value['due_date']. "</td>";
					echo "<td class='info'>" .$value['in_date']. "</td>";
					$diff=date_diff($due_date,$in_date);
					$day=$diff->format("%R%a");
					if($day<1){
						echo "<td class='info'>Zero INR</td>";
						echo "</tr>";
					}
					else{
						$fine=$day*5;
						echo "<td class='info'>$fine INR</td>";
						echo "</tr>";
					}
				}
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