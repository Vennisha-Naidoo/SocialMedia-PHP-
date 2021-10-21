<?php
$Server="localhost";
	$Name="root";
	$Pass="";
	$myDB="BuzzMe";
	
	$Conn= mysqli_connect($Server,$Name,$Pass,$myDB);

if (!$Conn){
	echo "Database didn't connect ". mysql_connect_error();
}
    
    /*
    if($Conn){
        echo "Connected";
    }else{
        echo"Not Connected".mysql_connect_error();
    }
    */
    
    $Email="";
    $Password="";
    
    if(isset($_POST['Submit'])){
        
        $Email = $_POST['Email'];
 
        $Password = $_POST['Password'];
        
            $sqlEnP = "SELECT * FROM users WHERE EmailAddress='$Email' AND Password='$Password'";
            
            $sqlLogin = mysqli_query($Conn, $sqlEnP)or die( mysqli_error($Conn));
    
            if ($sqlLogin->fetch_assoc() == ""){
				$Msg= "Login failed.";
                echo "<script type='text/javascript'>alert('$Msg');</script>";
        
            }else{
        
                $sqlEnP= "SELECT * FROM users WHERE EmailAddress='$Email' AND Password='$Password'";
                $sqlLogin= mysqli_query($Conn, $sqlEnP)or die( mysqli_error($Conn));
    
                    if ($row=mysqli_fetch_array($sqlLogin)){
                        if(($Email==$row['EmailAddress']) && ($Password==$row['Password'])){
							
						   session_start();
						   $_SESSION['UID']=$row['UserID'];
						   $_SESSION['UName']=$row['Username'];
						   $_SESSION['FName']=$row['Name'];
						   $_SESSION['LName']=$row['Surname'];
						   $_SESSION['Email']=$row['EmailAddress'];
						   $_SESSION['Passw']=$row['Password'];
						   $_SESSION['PhoneNum']=$row['PhoneNumber'];
						   $_SESSION['ProPic']=$row['ProfilePicture'];
						   $_SESSION['Gender']=$row['Gender'];
						   $_SESSION['Nationality']=$row['Nationality'];
						   $_SESSION['Bio']=$row['Biography'];
						   $_SESSION['DoB']=$row['DateOfBirth'];
						   
                           header("location: Profile.php");
                            //exit();
							
                        }//password==row
                
                    }//mysqli_fetch_array
            }
        
    }//if isset submit
    
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

fieldset {
	width:500px;
	border:1px solid lightgrey;
	border-radius:8px;
	box-shadow:0 0 8px #999;
	padding:60px;
}

input[type=email],input[type=password], select {
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
  <center><h1>BuzzMe</h1></center>
</div>

<br>
<body>
<br><br><br><br>
<form method="POST" action="Login.php">
 
<br><br>
 
<center>
<fieldset>
  
    <input type="email" placeholder="Enter Email" name="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"/>
        <br><br>
        
    <input type="password" placeholder="Enter Password" name="Password" pattern="[a-zA-Z0-9].{8,}"/>    
        <br>
	
	<a name="ForgotPass" class="ForgotPass" href="ForgotEmailPassword.php">Forgot password?</a>
	
        <br><br>
    <input type="submit" name="Submit" value="Login"/>
        <br><br>        
        
<p>
Do not have an account?
<a href="SignUp.php">Create account.</a>
</p>
 
</fieldset>
</center>
 
</form>


</body>
 
<footer>
  <center><p>by Vennisha Naidoo (146582)</p></center>
</footer>
 
</html>
