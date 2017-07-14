<?php
if(!empty($_POST["register-user"])) {
	/* Form Required Field Validation */
	foreach($_POST as $key=>$value) {
		if(empty($_POST[$key])) {
		$error_message = "All Fields are required";
		break;
		}
	}
	/* Password Matching Validation */
	if($_POST['password'] != $_POST['confirm_password']){ 
	$error_message = 'Passwords should be same<br>'; 
	}

	/* Email Validation */
	if(!isset($error_message)) {
		if (!filter_var($_POST["userEmail"], FILTER_VALIDATE_EMAIL)) {
		$error_message = "Invalid Email Address";
		}
	}

	/* Validation to check if gender is selected */
	if(!isset($error_message)) {
	if(!isset($_POST["gender"])) {
	$error_message = " All Fields are required";
	}
	}

	/* Validation to check if Terms and Conditions are accepted */
	if(!isset($error_message)) {
		if(!isset($_POST["terms"])) {
		$error_message = "Accept Terms and Conditions to Register";
		}
	}

	if(!isset($error_message)) {
		require_once("db/dbconnect.php");
		$db_handle = new DBController();
		$query = "INSERT INTO registered_users (user_name, first_name, last_name, password, email, gender) VALUES
		('" . $_POST["userName"] . "', '" . $_POST["firstName"] . "', '" . $_POST["lastName"] . "', '" . md5($_POST["password"]) . "', '" . $_POST["userEmail"] . "', '" . $_POST["gender"] . "')";
		$result = $db_handle->insertQuery($query);
		if(!empty($result)) {
			$error_message = "";
			$success_message = "You have registered successfully!";	
			unset($_POST);
		} else {
			$error_message = "Problem in registration. Try Again!";	
		}
	}
}
?>

<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>Her Designs</title>
		<link rel="stylesheet" href="css/style.css" type="text/css" />
		<!--[if IE 6]>
			<link rel="stylesheet" href="css/ie6.css" type="text/css" />
		<![endif]-->
		<!--[if IE 7]>
			<link rel="stylesheet" href="css/ie7.css" type="text/css" />
		<![endif]-->
		<!--login js-->
		 <script src='js/jquery.min.js'></script>

    	  <script src="js/index.js"></script>
	</head>
	<body>
		<div class="header">
			<div>
				<a href="index.html" id="logo"><img src="images/logo.gif" alt="logo"/></a>
				<div class="navigation">
					<ul class="first">
						<li class="first"><a href="jewelry.html">ON SALE</a></li>
						<li><a href="accessories.html">BEST SELLERS</a></li>
						<li><a href="blog.html">THE BLOG</a></li>
					</ul>
					<ul>
						<li><a href="about.html">About us</a></li>
						<li><a href="#" id="loginform">Login</a></li>
						<li><a href="register.php">Registration</a></li>
					</ul>
				</div>
				<form action="" class="search">
					<input type="text" value="search" onblur="this.value=!this.value?'search':this.value;" onfocus="this.select()" onclick="this.value='';"/>
					<input type="submit" id="submit" value=""/>
				</form>
			</div>
			<div id="navigation">
				<ul>
					<li><a href="index.html">Home</a></li>
					<li><a href="list.html">List of Card Design</a></li>
					<li><a href="inquire.html">Inquire</a></li>
					<li><a href="guide.html">Guide</a></li>
					<li><a href="contact.html">Contact</a></li>
					<li><a href="help.html">Help</a></li>
				</ul>
			</div>
		</div> 
		<div class="body">
			<div class="sidebar">
				<div class="first">
					<h2><a href="#">Categories</a></h2>
					<ul>
						<li><a href="#">Tees / T-Shirts</a></li>
						<li><a href="#">Casual Tops</a></li>
						<li><a href="#">Blouses &amp; Shirts</a></li>
						<li><a href="#">Dresses</a></li>
						<li><a href="#">Knits</a></li>
						<li><a href="#">Denims &amp; Jeans</a></li>
						<li><a href="#">Pants</a></li>
						<li><a href="#">Skirts</a></li>
						<li><a href="#">Shorts</a></li>
						<li><a href="#">Sets</a></li>
						<li><a href="#">Swimwear</a></li>
						<li><a href="#">Hoddies</a></li>
						<li><a href="#">Sweaters</a></li>
						<li><a href="#">Jackets &amp; Blazers</a></li>
						<li><a href="#">Outerwear</a></li>
						<li><a href="#">Belts</a></li>
						<li><a href="#">Hats &amp; Scarves</a></li>
						<li><a href="#">Hosiery</a></li>
						<li><a href="#">Innerwear</a></li>
						<li><a href="#">Plus-size</a></li>
						<li><a href="#">Maternity</a></li>
					</ul>
				</div>
				<div>
					<h2><a href="#">Recommended</a></h2>
				</div>
				<div>
					<h2><a href="#">Famous Brands</a></h2>
				</div>
				<div>
					<h2><a href="#">Women's Style</a></h2>
				</div>
			</div>
			<div class="content">
			<!--registration form-->
			<form name="frmRegistration" method="post" action="" class="rg_form">
				<table border="0" width="500" align="center" class="demo-table">
				<?php if(!empty($success_message)) { ?>	
				<div class="success-message"><?php if(isset($success_message)) echo $success_message; ?></div>
				<?php } ?>
				<?php if(!empty($error_message)) { ?>	
				<div class="error-message"><?php if(isset($error_message)) echo $error_message; ?></div>
				<?php } ?>
				<tr>
				<td>User Name</td>
				<td><input type="text" class="demoInputBox" name="userName" value="<?php if(isset($_POST['userName'])) echo $_POST['userName']; ?>"></td>
				</tr>
				<tr>
				<td>First Name</td>
				<td><input type="text" class="demoInputBox" name="firstName" value="<?php if(isset($_POST['firstName'])) echo $_POST['firstName']; ?>"></td>
				</tr>
				<tr>
				<td>Last Name</td>
				<td><input type="text" class="demoInputBox" name="lastName" value="<?php if(isset($_POST['lastName'])) echo $_POST['lastName']; ?>"></td>
				</tr>
				<tr>
				<td>Password</td>
				<td><input type="password" class="demoInputBox" name="password" value=""></td>
				</tr>
				<tr>
				<td>Confirm Password</td>
				<td><input type="password" class="demoInputBox" name="confirm_password" value=""></td>
				</tr>
				<tr>
				<td>Email</td>
				<td><input type="text" class="demoInputBox" name="userEmail" value="<?php if(isset($_POST['userEmail'])) echo $_POST['userEmail']; ?>"></td>
				</tr>
				<tr>
				<td>Gender</td>
				<td><input type="radio" name="gender" value="Male" <?php if(isset($_POST['gender']) && $_POST['gender']=="Male") { ?>checked<?php  } ?>> Male
				<input type="radio" name="gender" value="Female" <?php if(isset($_POST['gender']) && $_POST['gender']=="Female") { ?>checked<?php  } ?>> Female
				</td>
				</tr>
				<tr>
				<td colspan=2>
				<input type="checkbox" name="terms"> I accept Terms and Conditions <input type="submit" name="register-user" value="Register" class="btnRegister"></td>
				</tr>
				</table>
			</form>

			<!--end form-->
			</div>
			
			<div class="article">
				<div class="first">
					<h3>Please Read</h3>
					<p>This website template has been designed by <a href="http://www.freewebsitetemplates.com/">Free Website Templates</a> for you, for free. You can replace all this text with your own text.
					You can remove any link to our website from this website template, you're free to use this website template without linking back to us.
					If you're having problems editing this website template, then don't hesitate to ask for help on the <a href="http://www.freewebsitetemplates.com/forums/">Forum</a>.</p>
					<h4>Address</h4>
					<p>18th Floor, Lorem ipsum dolor</br>
					Adipiscing Bldg., Quesqui vestibulum Avenue</br>
					Samar Loop St., Business Park</br>
					Quisque vestibulum, 6029</br>
					+32-819-4560</p>
				</div>
				<div>
					<h3>Sed Elementum</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vestibulum nibh eget justo dapibus eu porttitor purus hendrerit.</p>
					<a href="#">Lorem ipsum dolor sit amet</a>
					<a href="#">Consectetur adipiscing elituisque</a>
				</div>
				<div class="connect">
					<h2>Follow us</h2>
					<a href="http://facebook.com/freewebsitetemplates" id="facebook">Facebook</a>
					<a href="http://twitter.com/fwtemplates" id="twitter">Twitter</a>
					<a href="#" id="comments">Comments</a>
					<a href="http://www.flickr.com/freewebsitetemplates/" id="flickr">Flickr</a>
				</div>
			</div>
		</div>
		<div class="footer">
			<p>&#169; 2011 Herdesigns. All Rights Reserved.</p>
		</div>

	</body>
</html>