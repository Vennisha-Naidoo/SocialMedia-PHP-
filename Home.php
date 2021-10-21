<?php

$Conn = mysqli_connect("localhost", "root", "", "buzzme");

session_start();

$uID = $_SESSION['UID'];

if (isset($_POST['btnPost'])){
	$myTextConent = $_POST['txtContent'];
	
	$PostedDate = date("Y-m-d H:i:s");
	
	$sqlInsert = "INSERT INTO
	posts (PostContent, PostImage, UserID, PostDate, NumLikes)
	VALUES ('$myTextConent','','$uID','$PostedDate', '0')";
	
	//echo mysqli_error($Conn);
	
		if ($Conn->query($sqlInsert) === TRUE) {
			$Msg= "Posted successfully.";
			echo "<script type='text/javascript'>alert('$Msg');</script>";
			//header("location:Login.php");
		} else {
			echo "Error: " . $sql . "<br>" . $Conn->error;
		}//$Conn->query	
	
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

form{
	border: 3px solid #f1f1f1;
	//height: 400px;
	padding:10px;
}

.UploadingData{
	background-color: white;
	position: fixed; 
    bottom: 45px; 
	width:80%;
	left:8.5%
}

.imginputfile {
	width: 0.1px;
	height: 0.1px;
	opacity: 0;
	overflow: hidden;
	position: absolute;
	z-index: -1;
}

.imginputfile + label {
	background-color: white;
	color: black;
	padding: 4px 8px;
	text-align: center;
	text-decoration: none;
	display: inline-block;
	font-size: 10px;
	cursor: pointer;
	width:25px;
	height:25px;
	float: auto;
}

.imginputfile:focus + label,
.imginputfile + label:hover {
    background-color: grey;
}


.txtContent, select {
  width: 80%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

.SelectImg{
  background-color: silver;
  border: 1px solid black;
  color: black;
  padding: 3px 18px;
  text-align: center;
  text-decoration: none;
  font-size: 10px;
  cursor: pointer;
  width:4px;
}

.PostPicUser{
	border:2px solid #f1f1f1;
	font-size:20px;
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


.PostBtn {
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


.PostBtn:hover {background-color: grey}

.PostBtn:active {
  background-color: blue;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}

 
.like{
	border:0px;
	background-color:white;
	font-size:25px;
	outline:0;
}

.unlike{
	color:red;
	border:0px;
	background-color:white;
	font-size:25px;
	outline:0;
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
  <center><h4>Home</h4></center>
</div>


<br><br><br><br><br><br><br><br><br>

<body>
<form method="post" enctype="multipart/form-data"> 


<div class="DisplayFriendsPosts">

<?php
		
	$arrFriends = array();
	
	$sqlDisplayFriendsPosts = mysqli_query($Conn,"SELECT * FROM friends WHERE UserOne = $uID");
	
		if($sqlDisplayFriendsPosts->fetch_assoc()==false){
			echo "<div>
				No posts available
			</div>";
		}else{
			
			$sqlDisplayFriendsPosts = mysqli_query($Conn,"SELECT * FROM friends WHERE UserOne = $uID");
	
			while ($row = $sqlDisplayFriendsPosts->fetch_assoc()){	
			$FriendID = $row['UserTwo'];
			
				array_push($arrFriends,$FriendID);
			}
			
			array_push($arrFriends,$uID);
			
			$sqlFriendPosts = mysqli_query($Conn, "SELECT * FROM posts WHERE UserID IN (".implode(",",$arrFriends).") ORDER BY PostID DESC");
			
				while($FriendPost = $sqlFriendPosts->fetch_assoc()){
					
					$FriendUserID = $FriendPost['UserID'];
					$FriendPostID = $FriendPost['PostID'];
					$FriendPostContent = $FriendPost['PostContent'];
					$FriendPostImage = $FriendPost['PostImage'];
					$FriendPostDate = $FriendPost['PostDate'];
					$FriendPostNumLikes = $FriendPost['NumLikes'];
			
					$FriendDet = mysqli_query($Conn, "SELECT * FROM users WHERE UserID ='$FriendUserID'");
					
					while($userDet = $FriendDet->fetch_assoc()){
						
						$me = mysqli_query($Conn, "SELECT * FROM users WHERE UserID='$uID'");
						while($myDet = $me->fetch_assoc()){
						
					//echo "<script>alert('$FriendPostID');</script>";
?>

	<div class="PostPicUser"><img class="DisPic" src="<?php echo $userDet['ProfilePicture']?>" style="width:50px; height:50px; border-radius:100%;"> <?php echo $userDet['Username']; ?></div>
	
	<div class="PostDTImg" style="padding:5px; color:grey; font-size:12px; border:1px solid #f1f1f1;"><?php echo $FriendPostDate; ?>
	
	<?php
	
		if($FriendPostImage==""){
			echo "";
		}else{
			echo "<center><img class='disPostImg' src='" .$FriendPostImage. "' style='width:200px; height:200px;'></img></center>";
		}
	
	?>

	</div>
	
	<?php 
		if($FriendPostContent==""){
			echo "";
		}else{
			echo "<div class='PostCaption' style='padding:5px; border:1px solid #f1f1f1;'>'" .$FriendPostContent. "'</div>";
		}
			
	?>

<div class="PostsOpt" style="padding:5px; color:grey; border:1px solid #f1f1f1;">
	
	<?php
	
		if (isset($_POST['liked'])) {

			$postid = $_POST['postid'];

			$result = mysqli_query($Conn, "SELECT * FROM posts WHERE PostID=$postid");
			$row = mysqli_fetch_array($result);
			$n = $row['NumLikes'];

			mysqli_query($Conn, "INSERT INTO likes (UserID, PostID) VALUES ($uID, $postid)");
			mysqli_query($Conn, "UPDATE posts SET NumLikes=$n+1 WHERE PostID=$postid");

			echo $n+1;
			exit();

		}else if (isset($_POST['unliked'])) {

			$postid = $_POST['postid'];

			$result = mysqli_query($Conn, "SELECT * FROM posts WHERE PostID=$postid");
			$row = mysqli_fetch_array($result);
			$n = $row['NumLikes'];

			mysqli_query($Conn, "DELETE FROM likes WHERE UserID='$uID' AND PostID='$postid'");
			mysqli_query($Conn, "UPDATE posts SET NumLikes=$n-1 WHERE PostID=$postid");

			echo $n-1;
			exit();

		}

	
	?>
	
	
		<?php
			$queryLike = mysqli_query($Conn, "SELECT * FROM likes WHERE UserID='$uID' AND PostID=". $FriendPostID ."");
			
			if(mysqli_num_rows($queryLike)==1){ ?>
				<button type="submit" name="unlike" class="unlike" id="<?php echo $FriendPostID; ?>"><i class='fas fa-heart' style="background-color:white; color:red; font-size:28px; border:0px;"></i></button>
			<?php }else{ ?>
				<button type="submit" name="like" class="like" id="<?php echo $FriendPostID; ?>"><i class='far fa-heart'></i></button>
			<?php } 
			
			$sqlDisNumLikes = mysqli_query($Conn, "SELECT * FROM posts WHERE PostID='$FriendPostID'");
			
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
	
	
</div><!-- PostsOpt -->
	
	
<div class="DisplayPostComments" style="border:1px solid #f1f1f1; width:99.85%;">
		
		<?php
			
			$MyFriendPostID = $FriendPostID;
			
			$sqlDisplayComments= mysqli_query($Conn,"SELECT * FROM comments WHERE PostID = $MyFriendPostID");
				
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
		<input type="text" name="GetCom" class="GetCom" id="<?php echo $FriendPostID ; ?>" placeholder="Add a comment..." style="border:1px solid white; width:95%;"></input>
		<input type="submit" name="myComm" class="myComm" id="<?php echo $FriendPostID ; ?>" value="Post"></input>



	</div> <!-- AddComment -->	
	
<br><br><br>

<?php

		if (isset($_POST['myCom'])){

			$postid = $_POST['postCom'];
			
			//echo "<script>alert($postid)</script>";
			
			$ComContent = $_POST['Content'];
			
			$PostedDate = date("Y-m-d H:i:s");

			$result = mysqli_query($Conn, "SELECT * FROM posts WHERE PostID='$postid'");
			$row = mysqli_fetch_array($result);
			$n = $FriendPostNumComments;
			
			echo mysqli_error($Conn);

			mysqli_query($Conn, "INSERT INTO comments (UserID, PostID, CommentContent, CommentDate) VALUES ('$uID', '$postid', '$ComContent', '$PostedDate')");
			mysqli_query($Conn, "UPDATE posts SET NumComments=$n+1 WHERE PostID=$postid");

			echo $n-1;
			exit();
		}
						}
					}//$FriendDet->fetch_assoc
				}//$sqlFriendPosts->fetch_assoc
		}//if...else

?>

 <!-- DisplayMyPosts -->
</div>




<br>



	<center>
	<div class="UploadingData">
	<br>
	
	<a class="SelectImg" style='font-size:24px' href = "Upload.php"><i class='far fa-image'></i></a>

	<input type="text" name="txtContent" class="txtContent" placeholder="Type text here..."/>
	<input type="submit" value="Post" name="btnPost" id="submit" class="PostBtn"/>

	</div> <!--UploadingData-->
	</center>
	
<br><br><br><br><br><br>
	
</form> <!--Home.php-->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>

<script>
$(document).ready(function(){ 
 
  $("button.like").click(function(){
 
 var postid = $(this).attr('id');
$post = $(this);

$.ajax({
url: 'Home.php',
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
url: 'Home.php',
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
  
 




   $("input.myComm").click(function(){
 
 var postComm = $(this).attr('id');
alert(postComm);

 $post = $(this);

	var myComment = $(this).parents('.AddComment');
	alert(myComment);
	
$.ajax({
url: 'Home.php',
type: 'POST',
data: {
'myCom': 1,
'postCom': postComm,
'Content': $(".GetCom", myComment).val()
},
success: function(response){
alert(Content);
alert('COMMENT POSTED');

}

});
  });

 
 
 
 
 
 
   $("input.Del_Comm").click(function(){
 
 var DeletedCom = $(this).attr('id');
$post = $(this);

$.ajax({
url: 'Home.php',
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