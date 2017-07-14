<?php
   // define database related variables
   $database = 'businesscard';
   $host = 'localhost';
   $user = 'root';
   $pass = '';

   // try to conncet to database
   $dbh = new PDO("mysql:dbname={$database};host={$host};port={3306}", $user, $pass);

   if(!$dbh){

      echo "unable to connect to database";
   }
   
?>
<?php 
	session_start();

	$email = "";
	$password = "";
	
	if(isset($_POST['email'])){
		$email = $_POST['email'];
	}
	if (isset($_POST['password'])) {
		$password = $_POST['password'];

	}
	

	$q = 'SELECT * FROM registered_users WHERE email=:email AND password=:password';

	$query = $dbh->prepare($q);

	$query->execute(array(':email' => $email, ':password' => $password));


	

		$row = $query->fetch(PDO::FETCH_ASSOC);

		session_regenerate_id();
		$_SESSION['sess_user_id'] = $row['id'];
		$_SESSION['sess_username'] = $row['username'];
        $_SESSION['sess_userrole'] = $row['role'];

        echo $_SESSION['sess_userrole'];
		session_write_close();

		if( $_SESSION['sess_userrole'] == "member"){
			header('Location: member/index.html');
		}
		
		



?>