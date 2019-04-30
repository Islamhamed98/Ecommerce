<?php
      session_start();
	  if(isset($_SESSION['Username']))
	  {
		//  header('Location: dashboard.php');
	  }	
	  
	  $navno='';
	  $pageTitle = 'Log In';
	  include "init.php";

	  // To Can't Navbar Pages Can Appear Here
	
      // Check if Comming From HTTP POST Request 
	if($_SERVER['REQUEST_METHOD']  == 'POST') // lw el request metho is post 
	{
		$username = $_POST['user']; // hat elly gaylk mn el username input 7oto fel $username 
		$password  = $_POST['pass'];  // hat elly gaylk mn el Password input 7oto fel $password
		$hashedpassword = sha1($password ); // hashed password da tshfeer ll password 
		
		// Check If The User Exist in Database 
	
		$stmt = $con->prepare("SELECT
									UserID, Username , password 
							   FROM users
							   WHERE Username = ? AND Password = ?  AND GroupID = 1 
							   Limit 1 ");
		$stmt->execute(array($username,$hashedpassword)); 
		$row = $stmt->fetch();
		$counter = $stmt->rowCount();
		
		if( $counter > 0 ) {
			$_SESSION['Username'] = $username; // Regester Session Name
			$_SESSION['ID'] = $row['UserID'];  // Regester Session Id
			header('Location: dashboard.php'); // Redirect To dashboard page
			exit();
		}

	 }
	
	 
?>

    <form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?> " method ="POST" >
        <h4 class="text-center">Admin Login </h4>
        <input class="form-control" type="text" name="user" placeholder="Username" autocomplete="off"/>
        <input class="form-control"  type="password" name="pass" placeholder="Password"autocomplete="off"/>
        <input class="btn btn-primary btn-block" type="submit" name="btn" value="Log In"/>
    </form>

 

<?php
    include "Includes/templates/footer.php" ;
?>