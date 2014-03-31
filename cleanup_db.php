<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<html>
<body>


<?php
$config = parse_ini_file("app.ini", true);
$db = $config['db'];

$mysqli = new mysqli($db['host'], $db['user'], $db['pass']);
if (mysqli_connect_errno()) {
    die('Ошибка соединения: ' . mysqli_connect_error());
}
else{
echo "Успешно соединились<br>";}

$sql="DROP DATABASE " . $db['db'];

if ($mysqli->query($sql))
  {
  echo "Database " . $db['db'] . " dropped successfully<br>";
  }
else
  {
  echo "Error dropping database: " . $mysqli->error . "<br>";
  }

$mysql->close();
?>

</body>
</html>
