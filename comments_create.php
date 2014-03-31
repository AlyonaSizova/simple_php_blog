<?php
$config = parse_ini_file("app.ini", true);
$db = $config['db'];

$mysqli = new mysqli($db['host'], $db['user'], $db['pass']);

/* check connection */ 
if (mysqli_connect_errno()) {
    exit('Connect failed: ' . mysqli_connect_error());
}

printf("Host information: %s\n", $mysqli->host_info);
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
//$sql = "DROP TABLE comments";
//$sql = "CREATE TABLE IF NOT EXISTS `comments` (id INT AUTO_INCREMENT PRIMARY KEY, post INT,
 //author CHAR(100),comm TEXT(3000),ts TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";
//$sql = "CREATE TABLE IF NOT EXISTS `tags` (id INT AUTO_INCREMENT PRIMARY KEY, post INT,
//tag CHAR(100),ts TIMESTAMP DEFAULT CURRENT_TIMESTAMP)"; 
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