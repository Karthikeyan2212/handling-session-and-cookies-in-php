<?php
	require_once "pdo.php";
// p' OR '1' = '1
	session_start();
	if(isset($_POST['email'])){
$ar=$_POST['email'];
$len=strlen($ar);
$f=0;
for($r=0;$r<$len;$r++){
	if($ar[$r]=='@' || $ar[$r]=='.')
		$f=1;
}
}	
if(isset($_POST['email']) && isset($_POST['password'])){
		
		
	
	}
if ( isset($_POST['email']) && isset($_POST['password']) ) {
	unset($_SESSION['email']);
	if($_POST['email']=="" && $_POST['password']==""){
       	$_SESSION["error"] = "Email and Password is empty.";
       	header( 'Location: login.php' ); 
      	error_log("Login fail ".$_POST['password']);
      	return;
		}
		if($_POST['email']==""){
	 	$_SESSION["error"] = "Email is empty.";
       	header( 'Location: login.php' ); 
      	error_log("Login fail ".$_POST['password']);
      	return;
		}
		if($_POST['password']==""){
		 $_SESSION["error"] = "Password is empty.";
	     header( 'Location: login.php' ); 
    	 error_log("Login fail ".$_POST['password']);
      	return;
		}
		if($_POST['email']!="" && $_POST['password']!=""){
		if($f==0){
	     $_SESSION["error"] = "Email must have an @(at sign)";
	     header( 'Location: login.php' ); 
    	 error_log("Login fail ".$_POST['password']);
      	return;
			}
	}
	$var_value=$_POST['email'];
    $sql = "SELECT * FROM users 
        WHERE email = :em AND password = :pw";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':em' => $_POST['email'], 
        ':pw' => $_POST['password']));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // var_dump($row);
   if ($row === FALSE ) {
       $_SESSION["error"] = "Login incorrect.";
       header( 'Location: login.php' ); 
      error_log("Login fail ".$_POST['password']);
      return;
   } else { 
      $_SESSION['email'] = $_POST['email'];
      $_SESSION["success"] = "Logged in.";
      error_log("Login success ".$_POST['email']);
      header( 'Location: view.php' ) ;
      return;
      }
}
?>
<html>
<head>
	<title>Karthikeyan A login page</title>
</head>
<body>
	<div>
		<h1>Please Login</h1>
		<?php
    if ( isset($_SESSION["error"]) ) {
        echo('<p style="color:red">'.$_SESSION["error"]."</p>\n");
        unset($_SESSION["error"]);
    }
?>
		<form method="POST">
			email:<input type="text" name="email" ><br>
			<!-- asd@gmail.com -->
			Password:<input type="password" name="password"><br>
			<!-- asd -->
			<input type="submit" value="login">
			<button><a href="index.php">cancel</a></button>
		</form>
		<p>Hint : for email and password, view the source code html comments.</p>
	</div>
</body>
</html>