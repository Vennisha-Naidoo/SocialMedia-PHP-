<?php

$Conn = mysqli_connect("localhost", "root", "", "buzzme");

session_start();

$uID = $_SESSION['UID'];

if (isset($_POST['btnImgCapPost'])){
	
	
	if (($_FILES['ImgUpload']['error']) == 0)	{
		
		$filename = $_FILES["ImgUpload"]["name"]; 
		$tempname = $_FILES["ImgUpload"]["tmp_name"];	 
		$folder = "image/".$filename;
		
		$myTextCaption = $_POST['txtCaption'];
	
		$PostedDate = date("Y-m-d H:i:s");
		
		$sqlInsert = "INSERT INTO
		posts (PostContent, PostImage, UserID, PostDate, NumLike)
		VALUES ('$myTextCaption','$filename','$uID','$PostedDate', '0')";
		
			if ($Conn->query($sqlInsert) === TRUE) {
				$Msg= "Posted successfully.";
				echo "<script type='text/javascript'>alert('$Msg');</script>";
				//header("location:Login.php");
			} else {
				echo "Error: " . $sql . "<br>" . $Conn->error;
			}//$Conn->query	
				
			// Now let's move the uploaded image into the folder: image 
			if (move_uploaded_file($tempname, $folder)) { 
				$msg = "Image uploaded successfully"; 
				echo $msg;
			}else{ 
				$msg = "Failed to upload image";
				echo $msg;			
			} //if...else move_uploaded_file
			
		}// if ['error']
	
	header("location:Home.php");
}


?>

<html>

<head>
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

/* Center the image and position the close button */
.imgcontainer {
  text-align: center;
  margin: 10px 0 10px 0;
  position: relative;
}

.container {
  padding: 1px;
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 0.1% auto 5% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 98%; /* Could be more or less, depending on screen size */
}

body {font-family: Arial, Helvetica, sans-serif;}

/* Full-width input fields */
#Caption{
  width: 100%;
  padding: 12px 20px;
  margin: 5px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

label{
	color:grey;
	font-family:calibri;
}


/* Set a style for all buttons */
button {
  background-color: lightgrey;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 10s;
}

.NewImg{
	width:250px;
	height:250px;
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
  padding: 10px 34.53px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  cursor: pointer;
  width:19.75%;
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
  <center><h4>Upload</h4></center>
</div>

<br><br><br><br><br><br><br><br><br>
  
  <form class="modal-content" action="Upload.php" method="post"  enctype="multipart/form-data">
    <div class="imgcontainer">
	  
	  
	<input type="file" id="imgupload" name="ImgUpload" style="display:none" accept=".png, .jpg, .jpeg" onchange="loadFile(event)" />
	<label for='imgupload'><img src="AddImage.png" name="disUpload" id="NewImgUpload" class="NewImg"></label>
	
	<script>
		var loadFile = function(event) {
		var image = document.getElementById('NewImgUpload');
		image.src = URL.createObjectURL(event.target.files[0]);
		};
	</script>
	 
    </div>

    <div class="container">
      <label for="txtContent"><b>Caption</b></label>
      <input type="text" placeholder="Type text here..." id="Caption" name="txtCaption"/>
        
      <button type="submit" name="btnImgCapPost">Post</button>

    </div>

  </form>

<footer>
<center>
<script src='https://kit.fontawesome.com/a076d05399.js'></script>

  <div class="btn-group">
  <a class="button" style='font-size:24px' href = "Home.php"><i class='fas fa-home'> </i></a>
  <a class="button" style='font-size:24px' href = "Friends.php"><i class='fas fa-user-friends'></i></a>
  <a class="button" style='font-size:24px' href = "Notifications.php"><i class='far fa-bell'></i></a>
  <a class="button" style='font-size:24px' href = "Profile.php"><i class='far fa-user-circle'></i></a>
</div>

</center>
</footer>

</html>