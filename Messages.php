<?php

$Conn = mysqli_connect("localhost", "root", "", "buzzme");

session_start();


$myid = $_REQUEST['id'];

$friendid = $_REQUEST['friendid'];

	
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

.DisplayMessges{
	border:1px solid #f1f1f1;
	box-shadow:0 0 5px #999;
	width:80%;
	min-height:400px;
	padding:10px;
}

.SendMessage{
	background-color: white;
	position: fixed; 
    bottom: 75px; 
	width:70%;
	left:15%
}

.txtMessage, select {
  width: 80%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

#btnSendMessage{
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

.userImg{
	width:25px;
	height:25px;
	border-radius:100%;
}

.MsgDiv{
	border:1px solid grey;
	box-shadow:0 0 6px #999;
	border-radius:20%;
	padding:5px;
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
  
  <center><h4>My Profile</h4></center>
</div>

<br><br><br><br>
<br><br><br><br>
<br>

<body>
<?php echo "<form method='post' action='http://localhost/BuzzMe/Messages.php?id=$myid&friendid=$friendid'>";?>

<center>
<div class="DisplayMessges">

<div style="height:40px; border:1px solid #f1f1f1; font-size:30px; font-weight:bold; color:#0b0b8f;">
	
	<?php
	$sqlRetrieveFriendsDetails = mysqli_query($Conn, "SELECT * FROM users WHERE UserID ='$friendid'");
		
	while($FriendDet = $sqlRetrieveFriendsDetails->fetch_assoc()){
		$Username = $FriendDet['Username'];
		$FriendProPic = $FriendDet['ProfilePicture'];
		$FriendName = $FriendDet['Name'];
		$FriendSurname = $FriendDet['Surname'];
		
		echo $FriendName." ".$FriendSurname;
	?>
	
</div>

<br>

<?php

	$retrievemsg = mysqli_query($Conn, "SELECT * 
	FROM messages 
	WHERE UserOne = '$myid' and UserTwo = '$friendid' 
	UNION SELECT * from messages 
	WHERE UserOne = '$friendid' and UserTwo = '$myid' 
	ORDER BY MessageID ASC");
	
	while($DisMessages = $retrievemsg->fetch_assoc()){
		
			if($DisMessages['UserOne']==$myid){
				echo "
				<div class='User' style='float:right;'>".$_SESSION['UName']."<img class='userImg' src='".$_SESSION['ProPic']."'></div><br><br>
				<div class='MsgDiv' style='float:right;  background-color:#dedfe3'>".
					$DisMessages['MessageConent']
				."</div> <br><br>
				";
			}else{#
				echo "
				<div class='User' style='float:left;'><img class='userImg' src='".$FriendProPic."'>".$Username."</div><br><br>
				<div class='MsgDiv' style='float:left; background-color:#93a6f5'>".
					$DisMessages['MessageConent']
				."</div> <br><br>
				";
			}
		}
	}

?>

	<div class="SendMessage">
		<input type="text" name="txtMessage" class="txtMessage" placeholder="Type message here..."/>
		<input type="submit" value="Send" name="btnSend" id="btnSendMessage" class="SendBtn"/>
		
		<?php
		

		
			if(isset($_POST['btnSend'])){
				
				$myMessage = $_POST['txtMessage'];
				$PostedDate = date("Y-m-d H:i:s");
				
				$sqlSendMessage = mysqli_query($Conn, "INSERT INTO messages (UserOne, UserTwo, MessageConent, MessageDate) VALUES ('$myid','$friendid','$myMessage','$PostedDate')");
	               
				   
				   echo "<script> window.location.replace('http://localhost/BuzzMe/Messages.php?id=$myid&friendid=$friendid'); </script>";
				
			}// isset btnSend
		
		?>
		
	</div><!-- SendMessage -->

</div><!-- DisplayMessges -->
</center>

<br><br><br><br><br><br>

<?php echo "</form>";?>

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
