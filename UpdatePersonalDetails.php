<?php
session_start();

$Conn = mysqli_connect("localhost", "root", "", "buzzme");

$EmailA = $_SESSION['Email'];

$newPass="";
$newPhone="";
$UNameMsg="";

if(isset($_POST['Submit'])){
	
		$EmailAdd =$_POST['myEmail'];
		$Pass = $_POST['Password'];
		$Phone = $_POST['PhoneNum'];
			
			//$getEmail = mysqli_query($Conn,"SELECT EmailAddress FROM users WHERE EmailAddress='$EmailA'");
			//$rows=mysqli_fetch_array($getEmail);
			//$MyEmail = $rows['EmailAddress'];
			
			//echo "<script type='text/javascript'>alert('$MyEmail');</script>";
			
			$sqlCheckEmailExistence = mysqli_query($Conn, "SELECT * FROM users WHERE EmailAddress='$EmailAdd'");
			$Checking=mysqli_num_rows($sqlCheckEmailExistence);
			
			if(($Checking>0) && ($EmailAdd!=$_SESSION['Email'])){
			
				$UNameMsg= "Account with that Email Address already exists.";
			
			}else{
				
				$sqlUpdateEPP = "UPDATE users SET
				EmailAddress = '$EmailAdd', 
				PhoneNumber = '$Phone', 
				Password = '$Pass' 
				WHERE UserID ='".$_SESSION['UID']."'";
				
				$sqlEPPQuery = mysqli_query($Conn, $sqlUpdateEPP)or die( mysqli_error($Conn));
				
				$getEPP = mysqli_query($Conn,"SELECT EmailAddress, PhoneNumber, Password FROM users WHERE UserID ='".$_SESSION['UID']."'");
				$row=mysqli_fetch_array($getEPP);

				$newEmail = $row['EmailAddress'];
				$_SESSION['Email'] = $newEmail;
				
				$newPhone = $row['PhoneNumber'];
				$_SESSION['PhoneNum'] = $newPhone;
				
				$newPass = $row['Password'];
				$_SESSION['Passw'] = $newPass;
				
				header("location: Profile.php"); 
				
			}
						
}//if isset submit

?>

<html>

<head>
<style>
form {
	border:3px solid #f1f1f1;
	padding:5px;
	height:418px;
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
  padding: 9px;
  color: #f1f1f1;
  bottom:0;
  left:0;
  position:fixed;
  width:100%;
  background-image: linear-gradient(to right, blue , purple);
}

fieldset {
	width:450px;
	height:250px;
	border:1px solid lightgrey;
	border-radius:8px;
	box-shadow:0 0 8px #999;
	padding:65px;
}

input[type=text], input[type=email],input[type=password], select {
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
  padding: 10px 20px;
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
  <h1>BuzzMe</h1>
  <center><h4>Personal Details Update</h4></center>
</div>
 
<br><br><br>
 
<body>
<br><br><br><br><br>
<form method="POST" action="UpdatePersonalDetails.php">
 
<br>
 
<center>
<fieldset>
	
	
    <input type="email" placeholder="Email Address" name="myEmail" pattern="[a-z 0-9._%+-]+@[a-z 0-9.-]+\.[a-z]{2,}$" value="<?php echo $_SESSION['Email']; ?>" required />
        <br>
	<label name="UsernameErrors" class="ErrorMessages"><?php echo $UNameMsg; ?></label>
        
    <input type="password" placeholder="Password" name="Password" pattern="[a-z A-Z 0-9]*.{8,}" value="<?php echo $_SESSION['Passw']; ?>" required />    
        <br><br>
		
	<input type="text" placeholder="Phone Number" name="PhoneNum" pattern="[0-9]*" value="<?php echo $_SESSION['PhoneNum']; ?>"/>    
        <br><br>
        
    <input type="submit" name="Submit" value="Save"/>
        <br><br><br><br>      
 
</fieldset>
</center>
 
</form>
</body>
 
<footer>
  <center><p>by Vennisha Naidoo (146582)</p></center>
</footer>
 
</html>
