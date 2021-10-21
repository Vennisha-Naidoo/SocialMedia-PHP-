<?php

$Conn = mysqli_connect("localhost", "root", "", "buzzme");

session_start();

$userID = $_SESSION['UID'];
	
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

.sidebar {
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  right: 0;
  background-color: grey;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
}

.sidebar a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: black;
  display: block;
  transition: 0.3s;
}

.sidebar a:hover {
  color: white;
}

.sidebar .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

.myMenuDiv{
	float:right;
}

.openMenubtn{
  font-size: 20px;
  cursor: pointer;
  background-color: silver;
  color: black;
  height:35px;
  width:150px;
  padding: 8px 15px;
  border: none;
  right:0px;
  float:right;
}

.DisplayAll {
	border:3px solid #f1f1f1;
	padding:10px;
	height:410px;
}

.EditProfileBtn{
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
	height:350px;	
	width:350px;
	left:0px;
	border-radius:10%;
}

.DisplayDetails{
	border:3px solid #f1f1f1;
	padding:5px;
	height:350px;	
	width:665px;
	float:right;
	position:right;
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

.DisplayMyPosts{
	border: 3px solid #f1f1f1;
	padding: 10px;
}

.Post{
	//border: 3px solid #f1f1f1;
	padding: 5px;
}

.PostPicUser{
	border:2px solid #f1f1f1;
	font-size:20px;
}

.DisPic{
	width:40px;
	height:40px;
	border-radius:100%;
}


.disPostImg{
	width:200px;
	height:200px;
}

.comm + label {
  padding: 5px 5px;
  font-size: 24px;
  color:black;
  cursor: pointer;
  text-align: center;
  text-decoration: none;
  outline: none;
  background-color: white;
  border: none;
  border-radius: 15px;
}

.DeletePost:hover{
	color:red;
}

button[type=submit] {
  padding: 5px 5px;
  font-size: 24px;
  cursor: pointer;
  text-align: center;
  text-decoration: none;
  outline: none;
  background-color: white;
  border: none;
  border-radius: 15px;
}

.myComm{
  padding: 5px 5px;
  font-size: 15px;
  color:turquoise;
  cursor: pointer;
  text-align: center;
  text-decoration: none;
  outline: none;
  background-color: white;
  border: none;
  border-radius: 15px;
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
  width:19.71%;
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
  
  <center><h4>My Profile</h4></center>
</div>

<br><br><br><br>
<br><br><br><br>
<br>

<body>

<div class="DisplayAll" id="DisplayMenuBtn">

  <div id="mySidebar" class="sidebar">
	<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
	<a href="ProfileUpdate.php">Edit Profile</a>
	<a href="UpdatePersonalDetails.php">Personal Details</a>
	<a href="Logout.php">Logout</a>
  </div>

  <div name="myMenuDiv">
  
	 <button class="openMenubtn" onclick="openNav()">☰ Menu</button> 
  
  </div><!-- myMenu -->
  
<script>
function openNav() {
  document.getElementById("mySidebar").style.width = "250px";
    document.getElementById("mySidebar").style.height = "670px";
  document.getElementById("DisplayMenuBtn").style.marginRight = "250px";
}

function closeNav() {
  document.getElementById("mySidebar").style.width = "0";
  document.getElementById("DisplayMenuBtn").style.marginRight= "0";
}
</script>

<br><br>

		<div class="DiplayProfilePicture">
			<img id="myImg" src="<?php echo $_SESSION['ProPic']?>"/>
		</div>

		<div class="DisplayDetails">
			
			<h1>
			<?php echo $_SESSION['UName'];?>
			</h1>
			
			<h3>
			<?php echo $_SESSION['FName']." ".$_SESSION['LName'];?>
			</h3>
			
			<br><br>
			
			<?php echo $_SESSION['Gender'];?>
			
			<br><br>
			
			<?php echo $_SESSION['Nationality'];?>
			
			<br><br>
			
			<?php echo $_SESSION['DoB'];?>
			
			<br><br>
			
			<?php echo $_SESSION['Bio'];?>
		
		</div><!--DisplayDetails-->
		
</div><!--DisplayAll-->

<br>

<div class="DisplayMyPosts">

<?php

$sqlDisplayPosts = mysqli_query($Conn,"SELECT * FROM posts WHERE UserID = $userID ORDER BY PostID DESC");
//$CheckingForPost=mysqli_num_rows($sqlDisplayPosts);

	//echo "<script>alert('$CheckingForPost');</script>";

while ($row = $sqlDisplayPosts->fetch_assoc()){	
	
?>

<br>

<div class="Post">

	<div class="PostPicUser"><img class="DisPic" src="<?php echo $_SESSION['ProPic']?>"> <?php echo $_SESSION['UName']; ?></div>
	
	<div class="PostDTImg" style="padding:5px; color:grey; font-size:12px; border:1px solid #f1f1f1;"><?php echo $row['PostDate']; ?>
	
	<?php
	
		if($row['PostImage']==""){
			echo "";
		}else{
			echo "<center><img class='disPostImg' src='" .$row['PostImage']. "'</img></center>";
		}
	
	?>

	</div>
	
		<?php 
		if($row['PostContent']==""){
			echo "";
		}else{
			echo "<div class='PostCaption' style='padding:5px; border:1px solid #f1f1f1;'>'" .$row['PostContent']. "'</div>";
		}
			
		?>
		
	<div class="PostsOpt" style="padding:5px; color:grey; border:1px solid #f1f1f1;">
	
	<?php
	
		if (isset($_POST['liked'])) {

		$postid = $_POST['postid'];

		$result = mysqli_query($Conn, "SELECT * FROM posts WHERE PostID=$postid");
		$row = mysqli_fetch_array($result);
		$n = $row['NumLikes'];

		mysqli_query($Conn, "INSERT INTO likes (UserID, PostID) VALUES ($userID, $postid)");
		mysqli_query($Conn, "UPDATE posts SET NumLikes=$n+1 WHERE PostID=$postid");

		echo $n+1;
		exit();

		}else if (isset($_POST['unliked'])) {

		$postid = $_POST['postid'];

		$result = mysqli_query($Conn, "SELECT * FROM posts WHERE PostID=$postid");
		$row = mysqli_fetch_array($result);
		$n = $row['NumLikes'];

		mysqli_query($Conn, "DELETE FROM likes WHERE UserID='$userID' AND PostID='$postid'");
		mysqli_query($Conn, "UPDATE posts SET NumLikes=$n-1 WHERE PostID=$postid");

		echo $n-1;
		exit();

		}

	
	?>
	
	
		<?php
			$queryLike = mysqli_query($Conn, "SELECT * FROM likes WHERE UserID='$userID' AND PostID=". $row['PostID'] ."");
			
			if(mysqli_num_rows($queryLike)==1){ ?>
				<button type="submit" name="unlike" class="unlike" id="<?php echo $row['PostID']; ?>"><i class='fas fa-heart' style="color:red;"></i></button>
			<?php }else{ ?>
				<button type="submit" name="like" class="like" id="<?php echo $row['PostID']; ?>"><i class='far fa-heart'></i></button>
			<?php } 
			
			
			$sqlDisNumLikes = mysqli_query($Conn, "SELECT * FROM posts WHERE PostID='". $row['PostID'] ."'");
			
			echo mysqli_error($Conn);
			
			while($NumPostLikes = $sqlDisNumLikes->fetch_assoc()){
				$Likes = $NumPostLikes['NumLikes'];
				
				if($Likes>1){
					echo $Likes ." likes";
				}else{
					echo $Likes ." like";
				}
					
			}//$sqlDisNumLikes->fetch_assoc()
			
			
			
			?>
	
			
		<button type="submit" name="DeletePost" class="DeletePost" id="<?php echo $row['PostID']; ?>"><i class='fas fa-trash-alt'></i></button>
		<?php
		
			if(isset($_POST['deletedPost'])){
				
				$Del_Post = $_POST['DeletePostID'];
				
				mysqli_query($Conn, "DELETE FROM posts WHERE PostID='$Del_Post'");
				mysqli_query($Conn, "DELETE FROM comments WHERE PostID='$Del_Post'");
				
			}//
		
		?>
		
	
		<?php
		
		if (isset($_POST['myComm'])){

			$postid = $_POST['postid'];
			
			echo "<script>alert($postid)</script>";
			
			$ComContent = $_POST['Content'];
			
			$PostedDate = date("Y-m-d H:i:s");

			$result = mysqli_query($Conn, "SELECT * FROM posts WHERE PostID=$postid");
			$row = mysqli_fetch_array($result);
			$n = $row['NumComments'];

			mysqli_query($Conn, "INSERT INTO comments (UserID, PostID, CommentContent, CommentDate) VALUES ('$userID', '$postid', '$ComContent', '$PostedDate')");
			mysqli_query($Conn, "UPDATE posts SET NumComments=$n+1 WHERE PostID=$postid");

			echo $n-1;
			exit();
		}
		?>
	
	</div><!-- PostsOpt -->
	
	<div class="DisplayPostComments" style="border:1px solid #f1f1f1; width:99.85%;">
		
		<?php
			
			$MyPostID = $row['PostID'];
			
			$sqlDisplayComments= mysqli_query($Conn,"SELECT * FROM comments WHERE PostID = $MyPostID");
				
			while ($retriveComData = $sqlDisplayComments->fetch_assoc()){
				
				$person = $retriveComData['UserID'];
				
				$gettinguserdetails = mysqli_query ($Conn, "SELECT* FROM users WHERE UserID = $person ");
				
				while ($result = $gettinguserdetails->fetch_assoc()){
					
					echo "<div class='aComm'>".$result['Username']. " " .$retriveComData['CommentContent']. "<br>
						<input type='submit' name='Del_Comm' class='Del_Comm' id=". $retriveComData['CommentID'] ." value='Delete comment' style='background-color:white; color:#969090;  font-weight: bold; border:0px; cursor:pointer; font-size:10px; '></input>
					<br><br></div>";
				}
			}
			
			
			if (isset($_POST['Del_Comm'])){
			
			$comID = $_POST['Dcomment'];
			
			$selectCom= mysqli_query($Conn, "SELECT * FROM comments WHERE CommentID=$comID");
			$r = mysqli_fetch_array($selectCom);
			$ThisPostID = $r['PostID'];
			
			$result = mysqli_query($Conn, "SELECT * FROM posts WHERE PostID=$ThisPostID");
			$row = mysqli_fetch_array($result);
			$n = $row['NumComments'];

				mysqli_query($Conn, "DELETE FROM comments WHERE CommentID='$comID'");
				mysqli_query($Conn, "UPDATE posts SET NumComments=$n-1 WHERE PostID=$ThisPostID");
			}
			
		?>
		
	</div> <!-- DisplayPostComments -->
	
	<div class="AddComment" style="border:1px solid #f1f1f1; padding:2px;">
		<input type="text" name="GetCom" class="GetCom" id="<?php echo $row["PostID"]; ?>" placeholder="Add a comment..." style="border:1px solid white; width:95%;"></input>
		<input type="submit" name="myComm" class="myComm" id="<?php echo $row["PostID"]; ?>" value="Post"></input>
	</div> <!-- AddComment -->

</div>


<?php

}//while loop

?>
<br>
<br>
<br>
</div><!-- DisplayMyPosts -->



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
$(document).ready(function(){ 
 
  $("button.like").click(function(){
 
 var postid = $(this).attr('id');
$post = $(this);

$.ajax({
url: 'Profile.php',
type: 'post',
data: {
'liked': 1,
'postid': postid
},
success: function(response){
alert('LIKED POST');
location.reload();
}

});
  });
  
  
  
  
  
  
    $("button.unlike").click(function(){
 
 var postid = $(this).attr('id');
$post = $(this);

$.ajax({
url: 'Profile.php',
type: 'post',
data: {
'unliked': 1,
'postid': postid
},
success: function(response){
alert('UNLIKED POST');
location.reload();
}

});
  });
  
  
  
  
  
  
  
  
  
  $("button.DeletePost").click(function(){
 
 var Delpostid = $(this).attr('id');
$post = $(this);

$.ajax({
url: 'Profile.php',
type: 'post',
data: {
'deletedPost': 1,
'DeletePostID': Delpostid
},
success: function(response){
alert('POST DELETED');
location.reload();
}

});
  });  
  
 





   $("input.myComm").click(function(){
 
 var postid = $(this).attr('id');
 $post = $(this);

	var myComment = $(this).parents('.Post');
	
$.ajax({
url: 'Profile.php',
type: 'post',
data: {
'myComm': 1,
'postid': postid,
'Content': $(".GetCom", myComment).val()
},
success: function(response){
alert('COMMENT POSTED');
location.reload();
}

});
  });

 
 
 
 
 
 
   $("input.Del_Comm").click(function(){
 
 var DeletedCom = $(this).attr('id');
$post = $(this);

$.ajax({
url: 'Profile.php',
type: 'post',
data: {
'Del_Comm': 1,
'Dcomment': DeletedCom
},
success: function(response){
alert('DELETED COMMENT');
location.reload();
}

});
  });
 
 
  
  
 });
  
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