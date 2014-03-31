<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<html>
<body>


<?php
$config = parse_ini_file("app.ini", true);
$db = $config['db'];

$mysqli = new mysqli($db['host'], $db['user'], $db['pass']);

/* check connection */ 
if (mysqli_connect_errno()) {
    exit('Connect failed: ' . mysqli_connect_error());
}

printf("Host information: %s\n", $mysqli->host_info);


//$sql = "CREATE USER 'sec_user'@'localhost' IDENTIFIED BY 'eKcGZr59zAa2BEWU'";
//$sql = "GRANT SELECT ON `blog`.* TO 'sec_user'";
/*if ($mysqli->query($sql) === TRUE) {
   echo "successfully<br>";
}
else
  {
  echo "Error creating database: " . $mysqli->error . "<br>";
  }*/

/*$sql="CREATE DATABASE " . $db['db'];

//Create db 
if ($mysqli->query($sql) === TRUE) {
   echo "Database " . $db['db'] . " created successfully<br>";
}
else
  {
  echo "Error creating database: " . $mysqli->error . "<br>";
  }

// USE db
$sql="USE " . $db['db'] . ";";
// Execute query
if ($mysqli->query($sql) === TRUE)
  {
  echo "Swiched to new db";
  }
else
  {
	echo "Error switching to new db: " . $mysqli->error . "<br>";
  }

// Create table

 /* $sql = "CREATE TABLE `blog`.`login_attempts` (
    `user_id` INT(11) NOT NULL,
    `time` VARCHAR(30) NOT NULL
) ENGINE=InnoDB";*/

  $sql = "CREATE TABLE `blog`.`members` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(30) NOT NULL,
    `email` VARCHAR(50) NOT NULL,
    `password` CHAR(128) NOT NULL,
    `salt` CHAR(128) NOT NULL 
 ) ENGINE = InnoDB";
//$sql="CREATE TABLE articles(id INT AUTO_INCREMENT PRIMARY KEY,
 //title CHAR(100),text TEXT(3000),ts TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";

// Execute query
if ($mysqli->query($sql) === TRUE)
  {
  echo "Table articles created successfully";
  }
else
  {
  echo "Error creating table: " . $mysqli->error;
  }

/* close connection */
$mysqli->close();

?>


</body>
</html>
