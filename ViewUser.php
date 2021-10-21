<?php

session_start();
	
$Conn= mysqli_connect('localhost','root','','BuzzMe');

$VuserID = $_SESSION['VUID'];
$LogggedUserID = $_SESSION['UID'];

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

.Del_Comm{
	padding:1px;
}

input[type=submit] {
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

.ViewingProfile{
  display: flex;                  /* establish flex container */
  flex-direction: row;            /* default value; can be omitted */
  flex-wrap: nowrap;              /* default value; can be omitted */
  justify-content: space-between; /* switched from default (flex-start, see below) */
}

.ViewingProfile > div{
  width: 350px;
  height: 350px;
  border: 1px solid #f1f1f1;
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

.unlike{
	background-color:white;
	border:0px;
	color:red;
	font-size:25px;
}


.like{
	background-color:white;
	border:0px;
	color:black;
	font-size:25px;
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
  <center><h4>User Profile</h4></center>
</div>

<br><br><br><br><br><br><br><br><br>

<body>
<center>
<div class="ViewingProfile" style="border:3px solid #f1f1f1; width:100%; height:350px;">


		<div class="DiplayProfilePicture">
			<img id="myImg" src="<?php echo $_SESSION['VProPic']?>" style="width:350px; height:350px;"/>
		</div>

		<div class="DisplayDetails">
			
			<h1>
			<?php echo $_SESSION['VUName'];?>
			</h1>
			
			<h3>
			<?php echo $_SESSION['VFName']." ".$_SESSION['LName'];?>
			</h3>
			
			<br><br>
			
			<?php echo $_SESSION['VGender'];?>
			
			<br><br>
			
			<?php echo $_SESSION['VNationality'];?>
			
			<br><br>
			
			<?php echo $_SESSION['VDoB'];?>
			
			<br><br>
			
			<?php echo $_SESSION['VBio'];?>
		
		</div><!--DisplayDetails-->


	<div class="Opts">
	<br><br><br><br><br><br><br>
	
		<?php
			
			$CheckFriend = mysqli_query($Conn, "SELECT * FROM friends WHERE (UserOne='$VuserID' AND UserTwo='$LogggedUserID')
			OR (UserOne='$LogggedUserID' AND UserTwo='$VuserID')");
			
			$checked = mysqli_num_rows($CheckFriend);
			
			//echo "<script>alert('$ch');</script>";
			
				if(isset($_POST['Unfriends'])){
					$UnfriendedUser = $_POST['Unfriended'];
					$UnfriendedUserQuery = mysqli_query($Conn, "SELECT * FROM friends WHERE UserOne OR UserTwo ='$UnfriendedUser' ");
				}
				
			if($checked>0){
				

				echo "<input type='submit' name='Unfriend' class='Unfriend' id='$VuserID' value='Unfriend'></input>
				<br><br><br><br><br><br>";

						if(isset($_POST['UnFriends'])){
							$RequestingUser = $_POST['Unfriended'];

							$DeleteFriendQuery = mysqli_query($Conn, "DELETE FROM friends WHERE
							(UserOne='$RequestingUser' AND UserTwo='$LogggedUserID')
							OR (UserOne='$LogggedUserID' AND UserTwo='$RequestingUser')");
							
							}			
				
			}else{
				
				$sqlReqQuery = mysqli_query($Conn, "SELECT * FROM requests WHERE (UserID_One='$VuserID' AND UserID_Two='$LogggedUserID') OR (UserID_One='$LogggedUserID' AND UserID_Two='$VuserID')");
				
				$checkRequestExists = mysqli_num_rows($sqlReqQuery);
				
				if($checkRequestExists>0){
					echo "<input type='submit' name='Cancel_Friend' class='Cancel_Friend' id='$VuserID' value='Cancel Request'></input>
					<br><br><br><br><br><br>";
					
						if(isset($_POST['Cancel'])){
							$RequestingUser = $_POST['Cancelled'];

							$CancelQuery = mysqli_query($Conn, "DELETE FROM requests WHERE
							(UserID_One='$RequestingUser' AND UserID_Two='$LogggedUserID')
							OR (UserID_One='$LogggedUserID' AND UserID_Two='$RequestingUser')");
							
							}
					
				}else{
					echo "<input type='submit' name='Add_Friend' class='Add_Friend' id='$VuserID' value='Add Friend'></input>
					<br><br><br><br><br><br>";
					
						if(isset($_POST['Friends'])){
							$RequestingUser = $_POST['friended'];
							
							$Condate = date("Y-m-d H:i:s");

							$RequestQuery = mysqli_query($Conn, "INSERT INTO requests (UserID_One, UserID_Two, Confirmation, ConfirmationDate) 
							VALUES ('$LogggedUserID', '$RequestingUser', '', '$Condate')");
							}
				
				}
			}	
		?>


	</div>

</div><!-- ViewingProfile -->
</center>

<br><br>

<center>
<div class="ViewingPosts" style="border:3px solid #f1f1f1; width:100%;">

<br>

<?php

$sqlDisplayPosts = mysqli_query($Conn,"SELECT * FROM posts WHERE UserID = $VuserID ORDER BY PostID DESC");
//$CheckingForPost=mysqli_num_rows($sqlDisplayPosts);

	//echo "<script>alert('$CheckingForPost');</script>";

while ($row = $sqlDisplayPosts->fetch_assoc()){	
	
?>

<div class="Post" style="width:98%; text-align:left;">

	<div class="PostPicUser"><img class="DisPic" src="<?php echo $_SESSION['VProPic']?>"> <?php echo $_SESSION['VUName']; ?></div>
	
	<div class="PostDTImg" style="padding:5px; color:grey; font-size:12px; border:1px solid #f1f1f1;"><?php echo $row['PostDate']; ?>
	
	<?php
	
		if($row['PostImage']==""){
			echo "";
		}else{
			echo "<center><img class='disPostImg' src='" .$row['PostImage']. "' style='width:200px; height:200px;'></img></center>";
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

		mysqli_query($Conn, "INSERT INTO likes (UserID, PostID) VALUES ($VuserID, $postid)");
		mysqli_query($Conn, "UPDATE posts SET NumLikes=$n+1 WHERE PostID=$postid");

		echo $n+1;
		exit();

		}else if (isset($_POST['unliked'])) {

		$postid = $_POST['postid'];

		$result = mysqli_query($Conn, "SELECT * FROM posts WHERE PostID=$postid");
		$row = mysqli_fetch_array($result);
		$n = $row['NumLikes'];

		mysqli_query($Conn, "DELETE FROM likes WHERE UserID='$VuserID' AND PostID='$postid'");
		mysqli_query($Conn, "UPDATE posts SET NumLikes=$n-1 WHERE PostID=$postid");

		echo $n-1;
		exit();

		}

	
	?>
	
	
		<?php
			$queryLike = mysqli_query($Conn, "SELECT * FROM likes WHERE UserID='$VuserID' AND PostID=". $row['PostID'] ."");
			
			if(mysqli_num_rows($queryLike)==1){ ?>
				<button type="submit" name="unlike" class="unlike" id="<?php echo $row['PostID']; ?>"><i class='fas fa-heart'></i></button>
			<?php }else{ ?>
				<button type="submit" name="like" class="like" id="<?php echo $row['PostID']; ?>" style="color:black; border:0px; background-color:white;"><i class='far fa-heart'></i></button>
			<?php } 
			
			
			$sqlDisNumLikes = mysqli_query($Conn, "SELECT * FROM posts WHERE PostID='".$row['PostID']."'");
			
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
	
	
		<?php
		
		if (isset($_POST['myComm'])){

			$postid = $_POST['postid'];
			
			echo "<script>alert($postid)</script>";
			
			$ComContent = $_POST['Content'];
			
			$PostedDate = date("Y-m-d H:i:s");

			$result = mysqli_query($Conn, "SELECT * FROM posts WHERE PostID=$postid");
			$row = mysqli_fetch_array($result);
			$n = $row['NumComments'];

			mysqli_query($Conn, "INSERT INTO comments (UserID, PostID, CommentContent, CommentDate) VALUES ('$VuserID', '$postid', '$ComContent', '$PostedDate')");
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
						<input type='submit' name='Del_Comm' class='Del_Comm' id=". $retriveComData['CommentID'] ." value='Delete comment' style='background-color:white; color:#969090;  font-weight: bold; border:0px; cursor:pointer; font-size:10px; width:100px;'></input>
					<br></div>";
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
		<button type="submit" name="myComm" class="myComm" id="<?php echo $row["PostID"]; ?>">Post</button>
	</div> <!-- AddComment -->


</div>

<br><br>



<?php

}//while loop

?>

</div>
</center>

<br><br><br>







<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
$(document).ready(function(){ 
 
  $("button.like").click(function(){
 
 var postid = $(this).attr('id');
$post = $(this);

$.ajax({
url: 'ViewUser.php',
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
url: 'ViewUser.php',
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
  
 




   $("button.myComm").click(function(){
 
 var postid = $(this).attr('id');
 $post = $(this);

	var myComment = $(this).parents('.Post');
	
$.ajax({
url: 'ViewUser.php',
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
url: 'ViewUser.php',
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
 

 
 
 
 
 
     $("input.Add_Friend").click(function(){
 
 var Friending = $(this).attr('id');
$post = $(this);

$.ajax({
url: 'ViewUser.php',
type: 'post',
data: {
'Friends': 1,
'friended': Friending
},
success: function(response){
alert('FRRIEND REQUEST SENT.');
location.reload();
}

});
  });
 
 
 
 
 
 
 
 
 
 
 
    $("input.Cancel_Friend").click(function(){
 
 var Cancelling = $(this).attr('id');
$post = $(this);

$.ajax({
url: 'ViewUser.php',
type: 'post',
data: {
'Cancel': 1,
'Cancelled': Cancelling
},
success: function(response){
alert('REQUEST CANCELLED');
location.reload();
}

});
  });
 
 
 
 
 
 
 
 
 
 
 
 
 
    $("input.Unfriend").click(function(){
 
 var Unfriending = $(this).attr('id');
$post = $(this);

$.ajax({
url: 'ViewUser.php',
type: 'post',
data: {
'UnFriends': 1,
'Unfriended': Unfriending
},
success: function(response){
alert('USER UNFRIENDED');
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