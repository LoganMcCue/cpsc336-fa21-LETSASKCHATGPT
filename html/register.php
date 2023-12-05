<?php
session_start();
$servername = "Cpsc336-final.cimurtpxm8gn.us-east-1.rds.amazonaws.com";
$username = "admin";
$password = "Welcome1";
$dbname = "cpsc336";
$conn = new mysqli($servername, $username, $password, $dbname);
$max_limit = 99; // Total limit for sign-ups
$low_limit = 0; // lower limit
if($conn->connect_error) {
	die("Connection failed: :".$conn->connect_error);
}
if (isset($_POST['register'])) {
    $updateQuery = "UPDATE 336users SET count = count + 1";
    $result = $conn->query($updateQuery);
    if (!$result) {
        echo "Error updating count: " . $conn->error;
    }
}
$countQuery = "SELECT count FROM 336users";
$countResult = $conn->query($countQuery);

if ($countResult->num_rows > 0) {
    $row = $countResult->fetch_assoc();
    $count = $row["count"];
   // echo "Total registered users: " . $count;
}
 else {
    echo "0 results";
}

//$conn->close();

if (isset($_POST['unregister'])) {
    $updateQuery = "UPDATE 336users SET count = count - 1";
    $result = $conn->query($updateQuery);

    if (!$result) {
        echo "Error updating count: " . $conn->error;
    }
}

// Retrieve the updated count from the database
$countQuery = "SELECT count FROM 336users";
$countResult = $conn->query($countQuery);

if ($countResult->num_rows > 0) {
    $row = $countResult->fetch_assoc();
    $count = $row["count"];
    //echo "Total registered users: " . $count;
} else {
    echo "0 results";
}
if(isset($_POST['clear'])) {
    // Update the count in the database
    $updateQuery = "UPDATE 336users SET count = 0";
    $result = $conn->query($updateQuery);

    if (!$result) {
        echo "Error updating count: " . $conn->error;
    }
}

// Retrieve the updated count from the database
$countQuery = "SELECT count FROM 336users";
$countResult = $conn->query($countQuery);

if ($countResult->num_rows > 0) {
    $row = $countResult->fetch_assoc();
    $count = $row["count"];
    //echo "Total registered users: " . $count;
} else {
    echo "0 results";
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add and Subtract Customers</title>
</head>
<body>
    <h1>Add and Subtract Customers</h1>
    <p>Current count: <?php echo $count; ?></p>

    <form method="post">
        <input type="submit" name="register" value="Add">
        <input type="submit" name="unregister" value="Subtract">
	<input type="submit" name="clear" value="Clear">
    </form>
</body>
</html>