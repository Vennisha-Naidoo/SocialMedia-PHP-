<?php
	$Server="localhost";
	$Name="root";
	$Pass="";
	$myDB="BuzzMe";
	
	$Conn= mysqli_connect($Server,$Name,$Pass,$myDB);

if (!$Conn){
	echo "Database didn't connect". mysql_connect_error();
}

$FName="";
$LName="";
$EmailAdd="";
$Pass="";

if(isset($_POST['Submit'])){
        
		$FName=$_POST['FirstName'];
		$LName=$_POST['LastName'];
		$EmailAdd=$_POST['Email'];
		$Pass=$_POST['Password'];
		$Quest=$_POST['Question'];
		$Ans=$_POST['Answer'];
		
		$sqlCheckEmailExistence = mysqli_query($Conn, "SELECT * FROM users WHERE EmailAddress='$EmailAdd'");
		$Checking=mysqli_num_rows($sqlCheckEmailExistence);
		
		if ($Checking>0){
			$Msg= "Account With This Email Already Exists.";
			echo "<script type='text/javascript'>alert('$Msg');</script>";
		}else{
			
			$sqlInsert = "INSERT INTO users (Name, Surname, EmailAddress, Password, Question, Answer)
							VALUES ('$FName','$LName','$EmailAdd','$Pass','$Quest','$Ans')";
							
				if ($Conn->query($sqlInsert) === TRUE) {
				  $Msg= "New record created successfully.";
				  echo "<script type='text/javascript'>alert('$Msg');</script>";
				  header("location:Login.php");
				} else {
				  echo "Error: " . $sql . "<br>" . $Conn->error;
				}//$Conn->query			
			
		}//email existence
		
    }//if isset submit

?>

<html>

<head>
<style>
form {
	border:3px solid #f1f1f1;
	padding:5px;
	//height:470px;
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
	//height:305px;
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
  <center><h1>Create BuzzMe Account</h1></center>
</div>
 
<br><br><br><br><br>
 
<body>
<form method="POST" action="SignUp.php">
 
<br>
 
<center>
<fieldset>
	
    <input type="text" placeholder="Name" name="FirstName" pattern="[a-z A-Z]*" required />    
	<br><br>

    <input type="text" placeholder="Last Name" name="LastName" required pattern="[a-z A-Z]*"/>    
	<br><br>
	
    <input type="email" placeholder="Email Address" name="Email" pattern="[a-z 0-9._%+-]+@[a-z 0-9.-]+\.[a-z]{2,}$" required />
        <br><br>
        
    <input type="password" placeholder="Password" name="Password" pattern="[a-z A-Z 0-9]*.{8,}" required />    
        <br><br><br><br>
	
	<div style="width:80%; text-align:justify; color:grey;">For verification purpose, if the user forgets their password,
	this question will be asked and an answer will be required. The
	CORRECT answer should only be known by the user, for account security reasons.</div>
	<input type="text" placeholder="Enter Question Here..." name="VeriQuestion" required pattern="[a-z A-Z 0-9]*"/>
	<br><br>
	<input type="text" placeholder="Enter Answer Here..." name="VeriAnswer" required pattern="[a-z A-Z 0-9]*"/>   
        
	<br><br>
	
    <input type="submit" name="Submit" value="Create"/>
        <br><br>        
 
</fieldset>
</center>
 
</form>
</body>
 
<footer>
  <center><p>by Vennisha Naidoo (146582)</p></center>
</footer>
 
</html>
