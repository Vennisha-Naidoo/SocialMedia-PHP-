<?php
	$Server="localhost";
	$Name="root";
	$Pass="";
	$myDB="BuzzMe";
	
	$Conn= mysqli_connect($Server,$Name,$Pass,$myDB);
	
	Session_start();
?>

<html>
 
<head>

<style>
form {
	border:3px solid #f1f1f1;
	padding:10px;
	height:450px;
}


.header {
	padding: 8px 16px;
	background: #555;
	color: #f1f1f1;
	position:fixed;
	width:100%;
	top:0;
	left:0;
	background-image: linear-gradient(to right, blue , purple);
}

footer {
  background-color: white;
  border-top:1px solid black;
  padding: 12px;
  color: #f1f1f1;
  bottom:0;
  left:0;
  position:fixed;
  width:100%;
  background-image: linear-gradient(to right, blue , purple);
}

#QuestAns{
	width:500px;
	border:1px solid lightgrey;
	border-radius:8px;
	box-shadow:0 0 8px #999;
	padding:30px;	
}

input[type=password], select {
  width: 80%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}


input[type=submit] {
  display: inline-block;
  padding: 10px 10px;
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


input[type=submit]:hover {background-color: grey}

input[type=submit]:active {
  background-color: blue;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}

</style>

</head>
 
<div class="header" id="myHeader">
  <center><h1>BuzzMe</h1></center>
</div>

<br>
<body>
<br><br><br><br>
<form method="POST" action="ChangePass.php">
 
<br><br><br><br><br>
 
<center>
<?php
		
		$RecievedEmail = $_SESSION['SearchEmailAcc'];
		
		$FindUser = mysqli_query($Conn, "SELECT * FROM users WHERE EmailAddress='$RecievedEmail'");
		$Found = mysqli_num_rows($FindUser);
		
		//echo "<script>alert('$Found');</script>";

		while($FoundDet = $FindUser->fetch_assoc()){
			echo "<div id='QuestAns'>
				<input type='password' name='New_Password' placeholder='Enter new password' pattern='[a-z A-Z 0-9]*.{8,}' required></input>
				<br>
				<input type='password' name='Confirm_Password' placeholder='Confirm new password' pattern='[a-z A-Z 0-9]*.{8,}' required></input>
				<br>
				<input type='submit' name='SubmitPass' value='Next'></input>
			</div>";
			
			if(isset($_POST['SubmitPass'])){
				
				$NewPass = $_POST['New_Password'];
				$CornfirmPass = $_POST['New_Password'];
				
				if($NewPass==$CornfirmPass){
					$UpdatePass = mysqli_query($Conn, "UPDATE users SET Password='$NewPass' WHERE EmailAddress='$RecievedEmail'");
					echo "<script>alert('You can now login in with your new password.');</script>";
					header("location:Login.php");
				}else{
					echo "<script>alert('Passwords do not match');</script>";
				}
				
			}
		}

?>
	
</center>
 
</form>



</body>
 
<footer>
  <center><p>by Vennisha Naidoo (146582)</p></center>
</footer>
 
</html>


