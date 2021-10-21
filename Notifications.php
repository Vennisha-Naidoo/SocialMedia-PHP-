<?php

session_start();

$Conn= mysqli_connect('localhost','root','','BuzzMe');

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

.AllNotifications{
	border:3px solid #f1f1f1;
	width:90%;
}


.Notification{
  display: flex;                  /* establish flex container */
  flex-direction: row;            /* default value; can be omitted */
  flex-wrap: nowrap;              /* default value; can be omitted */
  justify-content: space-between; /* switched from default (flex-start, see below) */
}

.Notification > div{
  width: 500px;
  height: 200px;
  border: 1px solid #f1f1f1;
}

.Accept_Req, .Decline_Req {
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
  <center><h4>Notifications</h4></center>
</div>

<br><br><br><br><br><br><br><br><br>
<body>

<?php	
			
				if(isset($_POST['Acceptted'])){
					
					$Accecptance = $_POST['Accepting'];
					
					echo "<script>alert($Accecptance)</script>";
	
					$AcceptReqQuery = mysqli_query($Conn, "UPDATE requests SET Confirmation='1' WHERE UserID_One='$Accecptance' AND UserID_Two='$LogggedUserID'");
					$NowFriendsQuery1 = mysqli_query($Conn, "INSERT INTO friends (UserOne, UserTwo) VALUES ('$Accecptance', '$LogggedUserID')");
					$NowFriendsQuery2 = mysqli_query($Conn, "INSERT INTO friends (UserOne, UserTwo) VALUES ('$LogggedUserID', '$Accecptance')");
					
					
					$DeleteReqQuery = mysqli_query($Conn, "DELETE FROM requests WHERE UserID_One='$Accecptance' AND UserID_Two='$LogggedUserID'");
				}
				
				if(isset($_POST['Declined'])){
					
					$ReqDeclined = $_POST['Declining'];
					
					$ReqID = mysqli_query($Conn, "SELECT * FROM requests WHERE UserID_One='$UserRequest' AND UserID_Two='$LogggedUserID'");
					
					$DeclineReqQuery = mysqli_query($Conn, "UPDATE requests SET Confirmation='0' WHERE UserID_One='$ReqDeclined' AND UserID_Two='$LogggedUserID'");
					$DeleteReqQuery = mysqli_query($Conn, "DELETE FROM requests WHERE UserID_One='$ReqDeclined' AND UserID_Two='$LogggedUserID'");
				}		

?>


<form method="post" action="Notifications.php">

<center>
<div class="AllNotifications">
<br>

<?php
		
			$sqlConfirm = mysqli_query($Conn, "SELECT * FROM requests WHERE UserID_Two='$LogggedUserID'");
			//$NumReq = mysqli_num_rows($sqlConfirm);
			
			if(($sqlConfirm->fetch_assoc()) == false ){
				
				echo "<div style='background-color:#f1f1f1; width:300px; height:25px; font-size:20px; font-weight:bold;'>No New Friend Requests.</div>";
				
			} else {
				
			$sqlConfirm = mysqli_query($Conn, "SELECT * FROM requests WHERE UserID_Two='$LogggedUserID'");
			
			while($retrieveNoti = $sqlConfirm->fetch_assoc()){
				$UserRequest = $retrieveNoti['UserID_One'];
				
				//echo "<script>alert('$UserRequest');</script>";
				
					$sqlReqUDetails = mysqli_query($Conn, "SELECT * FROM users WHERE UserID='$UserRequest'");
				
					while($UDet=$sqlReqUDetails->fetch_assoc()){
?>
<br>
	<div class="Notification" style='border:1px solid grey; width:800px;'>
	
		<?php			
	
						//echo "<br><br>";
						echo "<div style='border:1px solid #f1f1f1; 'width:200px; height:200px;'> <img src='".$UDet['ProfilePicture']."' style='width:200px; height:200px;'/> </div>";
						echo "<div> <br><br><br>".$UDet['Name']." ".$UDet['Surname'];
						echo "<br><br><br>";
						echo $UDet['Username']."</div>";
						
						$otherid = $UDet['UserID'];
						
						echo "<div><br>". $UDet['Username'] . "<br> wants add you as a friend.<br><br>
						<input type='submit' name='AcceptReq' class='Accept_Req' id='$otherid' style='width:150px; height:50px;' value='Accept'></input> <br><br>";
						echo "<input type='submit' name='DeclineReq' class='Decline_Req' id='$otherid' style='width:150px; height:50px;' value='Decline'></input> </div>";
		
						
		
		?>
		
	</div><!-- Notification -->
	
	<?php
					}		
			}
			}
	?>
	
<br><br><br>

</div><!-- AllNotifications -->
</center>
</form>











<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
$(document).ready(function(){ 
 
  $("input.Accept_Req").click(function(){
 
 var Accept = $(this).attr('id');
$post = $(this);

alert(Accept);

$.ajax({
url: 'Notifications.php',
type: 'post',
data: {
'Acceptted': 1,
Accepting: Accept
},
success: function(response){
	
alert('FRIEND REQUEST ACCEPTED');
location.reload();
}

});
  });
  
  
  
  

$(document).ready(function(){ 
 
  $("input.Decline_Req").click(function(){
 
 var Decline = $(this).attr('id');
$post = $(this);

$.ajax({
url: 'Notifications.php',
type: 'post',
data: {
'Declined': 1,
'Declining': Decline
},

success: function(response){
alert('FRIEND REQUEST DECLINED.');
location.reload();
}

});
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
  <!--<a class="button" style='font-size:24px' href = "Upload.php"><i class='fas fa-upload'></i></a>-->
  <a class="button" style='font-size:24px' href = "Notifications.php"><i class='far fa-bell'></i></a>
  <a class="button" style='font-size:24px' href = "Profile.php"><i class='far fa-user-circle'></i></a>
</div>

</center>
</footer>

</html>