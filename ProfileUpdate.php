<?php
error_reporting(0);
?>
<?php

session_start();
$Conn = mysqli_connect("localhost", "root", "", "buzzme");

$msg = "";  

	$EmailA = $_SESSION['Email'];
	
	$updateUsername = $_SESSION['UName'];
	
	$SelectedGender = $_SESSION['Gender'];
	
	

// If upload button is clicked ... 
if (isset($_POST['Updated'])) { 





//**************************************** ProfilePicture **********************************************************
	if (($_FILES['uploadfile']['error']) == 0)	{
		
		$filename = $_FILES["uploadfile"]["name"]; 
		$tempname = $_FILES["uploadfile"]["tmp_name"];	 
		$folder = "BuzzMe/ProfilePictures/".$filename;
		
			// Get all the submitted data from the form 
			$sqlUpdateProPic = "UPDATE users SET ProfilePicture = '$filename' WHERE EmailAddress='$EmailA'"; 

			// Execute query 
			mysqli_query($Conn, $sqlUpdateProPic); 
			
			// Now let's move the uploaded image into the folder: image 
			if (move_uploaded_file($tempname, $folder)) { 
				$msg = "Image uploaded successfully"; 
				echo $msg;
			}else{ 
				$msg = "Failed to upload image";
				echo $msg;			
			} //if...else move_uploaded_file
		
	}// if ['error']
	
	$getImg = mysqli_query($Conn,"SELECT ProfilePicture FROM users WHERE EmailAddress='$EmailA'");
    $rows=mysqli_fetch_array($getImg);
    $img = $rows['ProfilePicture'];
	
	$_SESSION['ProPic']=$img;
	
	
	
	


//**************************************** Update All **********************************************************

	$retrivedUsername = $_POST['tbxUsername'];
	
	$sqlCheckUsernameExistence = mysqli_query($Conn, "SELECT * FROM users WHERE Username='$retrivedUsername'");
	$CheckingUname=mysqli_num_rows($sqlCheckUsernameExistence);

	if(($CheckingUname>0) && ($retrivedUsername!=$_SESSION['UName'])){
			
		$UNameMsg= "Account with that username already exists.";
			
	}else{

		$retrivedFirstName = $_POST['tbxFName'];
		$retrivedLastName = $_POST['tbxLName'];
		$retrivedGender = $_POST['rdGender'];
		$retrivedNationality = $_POST['tbxNationality'];
		$retrivedBiography = $_POST['tbxBiography'];
		
		
		$retrivedDay = $_POST['optDayNum'];
		$retrivedMonth = $_POST['optMonthNum'];
		$retrivedYear = $_POST['optYear'];
		
		$retrivedDoB = $retrivedYear ."-". $retrivedMonth ."-". $retrivedDay;
		
		$sqlUpdate= "UPDATE users SET
		Username = '$retrivedUsername',
		Name = '$retrivedFirstName',
		Surname = '$retrivedLastName',
		Gender = '$retrivedGender',
		Nationality = '$retrivedNationality', 
		Biography = '$retrivedBiography',
		DateOfBirth = '$retrivedDoB'
		WHERE EmailAddress='$EmailA'";
		
		$sqlQuery= mysqli_query($Conn, $sqlUpdate)or die( mysqli_error($Conn));
		
		$getUpdate = mysqli_query($Conn,"SELECT * FROM users WHERE EmailAddress='$EmailA'");
		$rows=mysqli_fetch_array($getUpdate);
		
		
		$_SESSION['UName']= $rows['Username'];
		$_SESSION['FName']= $rows['Name'];
		$_SESSION['LName']= $rows['Surname'];
		$_SESSION['Gender']= $rows['Gender'];
		$_SESSION['Nationality']= $rows['Nationality'];
		$_SESSION['Bio']= $rows['Biography'];		
		$_SESSION['DoB']= $rows['DateOfBirth'];	
		
		
		header("location: Profile.php");
	}
	
}// if isset Updated

?> 

<html>

<head>
<!--font-family:Brush Script MT, Brush Script Std, cursive;-->
<style>

.header {
	padding: 3px 5px;
	background: #555;
	color: #f1f1f1;
	position:fixed;
	width:100%;
	top:0;
	left:0;
	background-image: linear-gradient(to right, blue , purple);
	font-size:20px;
}


.DisplayAll {
	border:3px solid #f1f1f1;
	padding:10px;
	height:800px;
}

input[type=text]{
  width: 80%;
  padding: 6px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

select{
  width:15%;
  padding: 6px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit]{
	background-color: silver;
	border: 1px solid black;
	color: black;
	padding: 5px 30px;
	text-align: center;
	text-decoration: none;
	display: inline-block;
	font-size: 10px;
	cursor: pointer;
	width:150px;
	float:right;
}

.DiplayProfilePicture{
	border:3px solid #f1f1f1;
	padding:10px;
	height:350px;	
	width:350px;
	float:left;
}

#myImg {
	height:330px;	
	width:345px;
}

.myImg{
	border: 3px solid #f1f1f1;
	height:300px;
	width:345px;
	float:left;
}

.PicAddBtnDiv{
	border:3px solid #f1f1f1;
	height:40px;
	width:345px;
	float:left;
}

.inputfile {
	width: 0.1px;
	height: 0.1px;
	opacity: 0;
	overflow: hidden;
	position: absolute;
	z-index: -1;
}

.inputfile + label {
	background-color: silver;
	border: 1px solid black;
	color: black;
	padding: 5px 30px;
	text-align: center;
	text-decoration: none;
	display: inline-block;
	font-size: 10px;
	cursor: pointer;
	width:283px;
	height:28;
	float: auto;
}

.inputfile:focus + label,
.inputfile + label:hover {
    background-color: blue;
}

fieldset{
	width:200px;
	padding:10px;
	border: 1px solid silver;
	color:grey;
}

.DisplayDetails{
	border:3px solid #f1f1f1;
	padding:10px;
	height:500px;	
	width:800px;
	float:right;
}

.ErrorMessages{
	background-color:#ffebe6;
	border-bottom:1px solid #cc2900;
	border-radius:5px;
}

footer {
  background-color: white;
  border-top:1px solid black;
  padding: 0.2px;
  color: #f1f1f1;
  bottom:0;
  left:0;
  position:fixed;
  width:100%;
}

.btn-group .button {
  background-color: silver;
  border: 1px solid black;
  color: black;
  padding: 10px 35px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  cursor: pointer;
  width:14.72%;
  float:left;
}

.btn-group .button:not(:last-child) {
  border-right: none; /* Prevent double borders */
}

.btn-group .button:hover {
  background-color: linear-gradient(to right, blue , purple);
}

</style>
</head>

<div class="header" id="myHeader">
  <h1>BuzzMe</h1>
  <center><h4>Profile Update</h4></center>
</div>

<br><br><br><br>
<br><br><br><br>
<br>

<body>
<form method="POST" action="ProfileUpdate.php" enctype="multipart/form-data"> 

<div class="DisplayAll">

<input type="submit" name="Updated" style='font-size:20px' value="Save"></button>

<br><br>

		<div class="DiplayProfilePicture">

			<div class="myImg">
				<img id="myImg" src="<?php echo $_SESSION['ProPic']?>"/>

			</div><!--myImg-->
				
			<div class="PicAddBtnDiv">
				<input type="file" name="uploadfile" id="file" class="inputfile" accept=".png, .jpg, .jpeg" onchange="loadFile(event)"/>
				<label for="file" style='font-size:17px'>Add Picture</label>
			</div><!--PicAddBtnDiv-->
			
			<script>
				var loadFile = function(event) {
					var image = document.getElementById('myImg');
					image.src = URL.createObjectURL(event.target.files[0]);
				};
			</script>
		
		</div><!--DiplayProfilePicture-->



		<div class="DisplayDetails">
		
			<input type="text" name="tbxUsername" placeholder="Username" value="<?php echo $_SESSION['UName']; ?>" pattern="[a-z 0-9]*" required />
			<br>
			<label name="UsernameErrors" class="ErrorMessages"><?php echo $UNameMsg; ?></label>
			
			<br>
			
			<input type="text" name="tbxFName" placeholder="First Name" value="<?php echo $_SESSION['FName']; ?>" pattern="[a-z A-Z]*"/>
			
			<br><br>
						
			<input type="text" name="tbxLName" placeholder="Last Name" value="<?php echo $_SESSION['LName']; ?>" pattern="[a-z A-Z 0-9]*"/>

			<br><br>
			
			<fieldset>
			<legend>Gender</legend>
			<input type="radio" name="rdGender" value="Male" <?php if($_SESSION['Gender']=="Male") {echo "checked";} ?> >Male</input>
			<br>
			<input type="radio" name="rdGender" value="Female" <?php if($_SESSION['Gender']=="Female") {echo "checked";} ?> >Female</input>
			<br>
			<input type="radio" name="rdGender" value="Other" <?php if($_SESSION['Gender']=="Other") {echo "checked";} ?> >Other</input>
			</fieldset>
			
			<br><br>
			
			<input type="text" name="tbxNationality" placeholder="Nationality" value="<?php echo $_SESSION['Nationality']; ?>" pattern="[a-z A-Z]*"/>

			<br><br>
			
			<input type="text" name="tbxBiography" placeholder="Biography" value="<?php echo $_SESSION['Bio']; ?>"/>
			
			<br><br>
			
			<select name="optDayNum">
			<option value="" disabled selected>Day</option>
			<?php
			
			$getDoB = mysqli_query($Conn,"SELECT DateOfBirth FROM users WHERE EmailAddress='$EmailA'");
			$rows=mysqli_fetch_array($getDoB);
			$NewDoB = $rows['DateOfBirth'];
			
				$parts = explode('-', $NewDoB);
				$dbYear = $parts[0];
				$dbMonth = $parts[1];
				$dbDay= $parts[2];
			
				for($i=1;$i<=31;$i++){
					
					if ($i==$dbDay){
						echo "<option selected>$i</option>";
					}else{
						echo "<option>$i</option>";
					}
				}
			?>
			</select>
			
			<select name="optMonthNum">
			<option value="" disabled selected>Month</option>
			<?php
				for($i=1;$i<=12;$i++){
					
					if ($i==$dbMonth){
						echo "<option selected>$i</option>";
					}else{
						echo "<option>$i</option>";
					}
				}
			?>
			</select>
			
			<select name="optYear">
			<option value="" disabled selected>Year</option>
			<?php
				for($i=1940;$i<=2018;$i++){
					
					if ($i==$dbYear){
						echo "<option selected>$i</option>";
					}else{
						echo "<option>$i</option>";
					}
				}
			?>
			</select>
		
		</div><!--DisplayDetails-->
		
</div><!--DisplayAll-->

<form>
</body>

<footer>
<center>

<script src='https://kit.fontawesome.com/a076d05399.js'></script>

<div class="btn-group">
  <a class="button" style='font-size:24px' href = "Home.php"><i class='fas fa-home'> </i></a>
  <a class="button" style='font-size:24px' href = "Friends.php"><i class='fas fa-user-friends'></i></a>
  <a class="button" style='font-size:24px' href = "Upload.php"><i class='fas fa-upload'></i></a>
  <a class="button" style='font-size:24px' href = "Notifications.php"><i class='far fa-bell'></i></a>
  <a class="button" style='font-size:24px' href = "Profile.php"><i class='far fa-user-circle'></i></a>
</div>

</center>
</footer>

</html>







