<?php
session_start();


//New Remote Database Connection//
$host = 'remotemysql.com';
$db = 'OOpAJs8VPh';
$user = 'OOpAJs8VPh';
$pass = 'A8xV3UYbOB';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

    try{
        $pdo = new PDO($dsn, $user, $pass);
        //echo 'Hi there Database';
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }catch(PDOException $e) {
        throw new PDOException($e->getMessage());
        //echo "<h1 class='text-danger'>No Database detected</h1>";
    }
       
   

        //Development Connection

        /*$DATABASE_HOST = 'localhost';
        $DATABASE_NAME = 'Productdb';
        $DATABASE_USER = 'root';
        $DATABASE_PASS= '';
        $charset = 'utf8mb4';*/

// Online connection 1st tried
/*$DATABASE_HOST = 'us-cdbr-east-02.cleardb.com';
$DATABASE_USER = 'bc2410c0c6701a';
$DATABASE_PASS = 'cde9877c';
$DATABASE_NAME = 'heroku_7bb4c93e415ee60';*/

//Online connection 2nd tried
/*$DATABASE_HOST = 'sql10.freemysqlhosting.net';
$DATABASE_USER = 'sql10383257';
$DATABASE_PASS = 'j9c76VcLkH';
$DATABASE_NAME = 'sql10383257';*/

// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
//$con = "mysql:host=$DATABASE_HOST;dbname=$DATABASE_NAME;charset=$charset";

if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

//Check if the data from the login form was submitted, isset() will check if the data exists.
if ( !isset($_POST['username'], $_POST['password']) ) {
	// Could not get the data that should have been sent.
	exit('Please fill both the username and password fields!');
}

// Preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password);
        $stmt->fetch();
        // Account exists, now we verify the password.
        // Note: remember to use password_hash in your registration file to store the hashed passwords.
        if (password_verify($_POST['password'], $password)) {
            // Verification success! User has loggedin!
            // Create sessions so we know the user is logged in, they basically act like cookies but remember the data on the server.
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $id;
            
            header('Location: home.php');
        } else {
            // Incorrect password
            echo 'Incorrect username and/or password!';
        }
    } else {
        // Incorrect username
        echo 'Incorrect username and/or password!';
    }

	$stmt->close();
}

?>