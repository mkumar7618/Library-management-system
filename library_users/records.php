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
		
			$conn = mysqli_connect('localhost','root','','library');
			$user=$_SESSION['user'];
			$query = "select distinct * from user_login where user_name='$user'";
			$results = mysqli_query($conn,$query);
			$row = mysqli_fetch_assoc($results);
			$user_id=$row['user_id'];
			$query = "select distinct * from members where id='$user_id'";
			$results = mysqli_query($conn,$query);
			$row = mysqli_fetch_assoc($results);
			$user_name=$row['name'];
			$query = "select * from book_loans where loan_id='$user_id'";
			$result = mysqli_query($conn,$query);
			
				foreach ($result as $value) {
					$out_date=date_create($value['out_date']);
					$due_date=date_create($value['due_date']);
					$in_date=date_create($value['in_date']);
					
					echo "<tr>";
					echo "<td class='info'>" .$user_id. "</td>";
					echo "<td class='info' style='text-transform:uppercase' >" .$user_name. "</td>";
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