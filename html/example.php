<?php
session_start();
$servername = "Cpsc336-final.cimurtpxm8gn.us-east-1.rds.amazonaws.com";
$username = "admin";
$password = "Welcome1";
$dbname = "cpsc336";
$conn = new mysqli($servername, $username, $password, $dbname);
$limit = 99; // Total limit for sign-ups
$counterFile = 'registration_counter.txt';
if($conn->connect_error) {
	die("Connection failed: :".$conn->connect_error);
}
// Check if the counter file exists, and create it if it doesn't
if (!file_exists($counterFile)) {
    file_put_contents($counterFile, "0");
}

// Get the current count from the counter file
$currentCount = (int)file_get_contents($counterFile);
//echo "hello";
if (isset($_POST['register'])) {
	echo "hello";
    // Register a new user
    if ($currentCount < $limit) {
        //$add = INSERT INTO users (.$_POST["user"].);
	$currentCount++;
	$sql = "SELECT * FROM 336users";
	//$result = $conn->query($sql);
	//echo "$result";
        file_put_contents($counterFile, $currentCount);
        echo "You have successfully added a person. Current count: $currentCount";
    } else {
        echo "Sorry, the store is full. Total limit reached.";
    }

}

if (isset($_POST['unregister'])) {
    // Unregister a user
    if ($currentCount > 0) {
        $currentCount--;
        file_put_contents($counterFile, $currentCount);
        echo "You have successfully unadded a person. Current count: $currentCount";
    } else {
        echo "No one is currently in the store.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add and Subtract Customers</title>
</head>
<body>
    <h1>Add and Subtract Customers</h1>
    <p>Limit in store: <?php echo $limit; ?></p>
    <p>Current count: <?php echo $currentCount; ?></p>

    <form method="post">
        <input type="submit" name="register" value="Add">
        <input type="submit" name="unregister" value="Subtract">
    </form>
</body>
</html>
