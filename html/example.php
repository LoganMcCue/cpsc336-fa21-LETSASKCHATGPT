<?php
$limit = 99; // Total limit for sign-ups
$counterFile = 'registration_counter.txt';

// Check if the counter file exists, and create it if it doesn't
if (!file_exists($counterFile)) {
    file_put_contents($counterFile, "0");
}

// Get the current count from the counter file
$currentCount = (int)file_get_contents($counterFile);

if (isset($_POST['register'])) {
    // Register a new user
    if ($currentCount < $limit) {
        $currentCount++;
        file_put_contents($counterFile, $currentCount);
        echo "You have successfully registered. Current count: $currentCount";
    } else {
        echo "Sorry, registration is full. Total limit reached.";
    }
}

if (isset($_POST['unregister'])) {
    // Unregister a user
    if ($currentCount > 0) {
        $currentCount--;
        file_put_contents($counterFile, $currentCount);
        echo "You have successfully unregistered. Current count: $currentCount";
    } else {
        echo "No one is currently registered.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign Up / Unregister</title>
</head>
<body>
    <h1>Sign Up / Unregister</h1>
    <p>Total limit: <?php echo $limit; ?></p>
    <p>Current count: <?php echo $currentCount; ?></p>

    <form method="post">
        <input type="submit" name="register" value="Register">
        <input type="submit" name="unregister" value="Unregister">
    </form>
</body>
</html>
