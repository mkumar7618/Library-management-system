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
<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!--import head.html file -->
<?php include('head.html'); ?>

<style>

/*body {
  background-color: #f1f1f1;
}*/

#regForm {
  background-color: #ffffff;
  margin: 50px auto;
  padding: 0px;
  width: 100%;
  max-width: 800px;
  min-width: 300px;
}

h1 {
  margin-top: 20px;
  margin-bottom: 20px;
  text-align: center;  
}


/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

button {
  background-color: #4CAF50;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #4CAF50;
  opacity: 1
}

</style>
</head>
<body>

<?php include('nav.php'); ?>
<br>
<div class = "container">

<h1>Enter Details For Add A Member</h1>

<form id="regForm" action="add_member.php" method="post" enctype="multipart/form-data">

  <!-- One "tab" for each step in the form: -->
  <div class="tab">
	<div class="form-group">
		<h4>Name :</h4>
		<input class="form-control" type="text" name="name"  placeholder="Enter Member Name" required /><br/>
		<h4>Mobile Number :</h4>
		<input class="form-control" type="number" name="number" oninput="this.className += ''" placeholder="Enter Mobile Number" required /><br/>
		<h4>Address :</h4>
		<textarea name="address" oninput="this.className += ''" placeholder="Enter Member Address" style="height:70px;width:100%;" ></textarea><br/>
	</div>
  </div>
  <div class="tab">	
	<div class="form-group">
		<h4>Photo :</h4>
		<input class="form-control" type="file" name="image" placeholder="Enter Your Image" required />
		<h4>User Name :</h4>
		<input class="form-control" type="text" name="user_name" placeholder='Enter User Name' required /><br/>
		<h4>Password :</h4>
		<input class="form-control" type="password" name="pass1" minlength="7" maxlength="20" placeholder='Enter Password' required /><br/>
		<input class="form-control" type="password" name="pass2" minlength="7" maxlength="20" placeholder='Re-Enter Password' required /><br>
    </div>
  </div>
  <!-- Previous and next button -->
  <div style="overflow:auto;margin-top:20px;">
    <div style="float:right;">
      <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous </button>
      <button type="button" id="nextBtn" name="" onclick="nextPrev(1)">Next</button>
    </div>
  </div> 
  
  <!-- Circles which indicates the steps of the form: -->
  <div style="text-align:center;margin-top:40px;">
    <span class="step"></span>&nbsp;&nbsp;
	<span class="step"></span>
  </div>
  <hr style="border:none;height:0px;width:10%;margin:auto;padding:3px;background-color:#4CAF50;border-radius: 25%;">
</form>

<?php
			if(isset($_POST['number'])){
				$name = $_POST['name'];
				$number=$_POST['number'];
				$address=$_POST['address'];
				$image = $_FILES['image']['name'];
				$temp = $_FILES['image']['tmp_name'];
				$user_name = $_POST['user_name'];
				$pass1 = $_POST['pass1'];
				$pass2 = $_POST['pass2'];
				
				if($pass1!==$pass2){
					echo "
							<script>
							alert('Passwords are not same!');
							</script>
						";	
				}
				else{
					$con = mysqli_connect('localhost','root','','library');
					$query="insert into members(name,number,address,image) values('$name','$number','$address','$image');";
					$query .="insert into user_login(user_name,user_pass) values('$user_name','$pass1')";
					$result = mysqli_multi_query($con,$query);
					if($result == true){
						
						move_uploaded_file($temp, "library.com/library_admins/image/users_image");
						move_uploaded_file($temp, "library.com/library_users/image/users_image");

						echo "
							<script>
							alert('Member has been added');
							</script>
						";
					}
					else{
						echo "
							<script>
							alert('Something went wrong !');
							</script>
						";	
					}
					
				}
			}
			else{
				echo "";	
			}
		?>
	
	<!--footer-->
	<div class="footer">
		<?php include('footer.php'); ?>
	</div>

</div>

<script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() { 
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}
</script>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>