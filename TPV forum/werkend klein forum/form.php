<?php
$mysqli = new mysqli("localhost", "root", "", "form");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

if (isset($_GET['message'])) {

    $user=$mysqli->real_escape_string($_GET['gebruiker']);
    $message=$mysqli->real_escape_string($_GET['message']);
    $date=date('Y-m-d H:i:s');

    $sql="INSERT INTO forum(id, gebruiker, message, datum) VALUES(0,'$user','$message','$date')";
    $mysqli->query($sql);
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>PHP and MySql</title>
</head>

<body>
<h2>Forum</h2>

<?php
$sql = "SELECT * FROM forum";
$result = $mysqli->query($sql);

while($row = $result->fetch_assoc()) {
    echo $row['gebruiker'].',  '.$row['datum'].' <br />';
    echo $row['message'].'<br />';
    echo '------------------------ <br />';
}
?>

<form method="get" action="form.php">
    <p>User:
        <label for="gebruiker"></label>
        <input type="text" name="gebruiker" id="gebruiker" />
        <br />
    </p>
    <p>Message: <br />
        <label for="message"></label>
        <textarea name="message" id="message" cols="45" rows="5"></textarea>
    </p>
    <p>
        <input type="submit" name="submit" id="submit" value="Post message" />
    </p>
</form>

</body>
</html>