<?php

session_start();
	
	$Conn= mysqli_connect('localhost','root','','BuzzMe');

$uID = $_SESSION['UID'];

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

input[type=text] {
  width: 40%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

#btnsearch{
  display: inline-block;
  padding: 5px 10px;
  font-size: 24px;
  cursor: pointer;
  text-align: center;
  text-decoration: none;
  outline: none;
  color: #fff;
  background-color: lightgrey;
  border: none;
  border-radius: 15px;
  box-shadow: 0 9px #999;
}

#btnsearch:hover {background-color: grey}

#btnsearch:active {
  background-color: blue;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}

.MyFriends{
	border: 1px solid #f1f1f1;
	width:80%;
	box-shadow:0 0 8px #999;
	border-radius:10%;
}

.View_Profile, .Send_Message{
  padding: 5px 5px;
  width:250px;
  font-size: 24px;
  cursor: pointer;
  text-align: center;
  text-decoration: none;
  outline: none;
  background-color: #3e4b78;
  color:white;
  border: none;
  border-radius: 15px;
}


.btn-group .button {
  background-color: silver;
  border: 1px solid black;
  color: black;
  padding: 10px 30px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  cursor: pointer;
  width:20.45%;
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
  <center><h4>Friends and Chats</h4></center>
</div>

<br><br><br><br><br><br><br><br><br>

<body>
<center>
<form method="post" action="Friends.php">
<div class="SearchUser">
   <input type="text" name="txtSearch" id="search" placeholder="Search Username..." />
   <input type="submit" name="mySearch" id="btnsearch" value="Search" />
   <?php
	if (isset($_POST['mySearch'])){
		$SearchStr = $_POST['txtSearch'];
		
		$sqlSearch = mysqli_query($Conn, "SELECT * FROM users WHERE Username = '$SearchStr'");
		
                   if ($sqlSearch->fetch_assoc()==false){
					   
					   	$NotFound = "User Not Fount.";
							echo "<script>alert('$NotFound');</script>";
					   
				   }else if($SearchStr==$_SESSION['UName']){   
						
						header("location: Profile.php");
						
				   } else {
					   
					   $sqlSearch = mysqli_query($Conn, "SELECT * FROM users WHERE Username = '$SearchStr'");
					   
					   while ($vrow = $sqlSearch->fetch_assoc()){
						   
						   
						   session_start();
						   $_SESSION['VUID']=$vrow['UserID'];
						   $_SESSION['VUName']=$vrow['Username'];
						   $_SESSION['VFName']=$vrow['Name'];
						   $_SESSION['VLName']=$vrow['Surname'];
						   $_SESSION['VProPic']=$vrow['ProfilePicture'];
						   $_SESSION['VGender']=$vrow['Gender'];
						   $_SESSION['VNationality']=$vrow['Nationality'];
						   $_SESSION['VBio']=$vrow['Biography'];
						   $_SESSION['VDoB']=$vrow['DateOfBirth'];	
						
							header("location:ViewUser.php");
					   }
					   
					   
					   
					   
				   }
	}
   ?>

</div>	

<br>

<div class="MyFriends">
<br>

	<?php
	
		$sqlRelation = mysqli_query($Conn, "SELECT * FROM friends WHERE UserOne='$uID'");
	
			while($Friend = $sqlRelation->fetch_assoc()){
				$myFriend = $Friend['UserTwo'];
				
				$sqlFriendDet = mysqli_query($Conn, "SELECT * FROM users WHERE UserID='$myFriend'");
				
				while($FriendDet = $sqlFriendDet->fetch_assoc()){
					$ThisFriendDet = $FriendDet['Username'];
					
					echo "<div style='border:3px solid #f1f1f1; width:70%; height:200px;'>
						<div style='border:1px solid #f1f1f1; width:200px; height:200px; float:left;'>
							<img style='width:200px; height:200px;' src='".$FriendDet['ProfilePicture']."'>
						</div>
						
						<div style='border:1px solid #f1f1f1; width:536px; height:200px; float:right;'>
							<div style='border:1px solid #f1f1f1; width:536px; height:70px; float:right; font-size:35px;'>
								".$FriendDet['Name']." ".$FriendDet['Surname']."
							</div>
							
							<div style='border:1px solid #f1f1f1; width:536px; height:125px; float:right;'><br><br>
								<input type='submit' name='SendMessage' class='Send_Message' id='".$myFriend."' value='Send Message'></input>
							</div>
						</div>
						
					</div>";
					
					
				
					
					
				}//$sqlFriendDet->fetch_assoc
				echo "<br><br>";
				
			}//$sqlRelation->fetch_assoc()	
	?>
</div> <!-- MyFriends -->

<br><br><br>

</form>


</center>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
$(document).ready(function(){ 
 
  $("input.Send_Message").click(function(){
 
 var Fid = $(this).attr('id');
$ID_Friend = $(this);

window.location.replace("http://localhost/BuzzMe/Messages.php?id=<?php echo $uID;?>&friendid="+Fid);

  return false
  
  });
  
  

 });//ready
  
</script>



</body>

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