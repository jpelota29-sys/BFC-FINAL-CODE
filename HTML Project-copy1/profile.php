<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user_id'])) {
    echo "<script>alert('Please login first.'); window.location='index.php';</script>";
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch user info
$result = $conn->query("SELECT username, email, contact, address FROM users WHERE id='$user_id'");
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Profile</title>
<link rel="stylesheet" href="profile.css">
</head>
<body>

<div class="profile-container">
    <h1>Welcome, <?= htmlspecialchars($user['username']) ?></h1>

    <form action="update_profile.php" method="POST" class="profile-form">
        <label>Username:</label>
        <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>

        <label>Contact:</label>
        <input type="text" name="contact" value="<?= htmlspecialchars($user['contact']) ?>" required>

        <label>Address:</label>
        <input type="text" name="address" value="<?= htmlspecialchars($user['address']) ?>" required>

        <label>Password (leave blank if not changing):</label>
        <input type="password" name="password">

        <button type="submit" class="update-btn">Update Profile</button>
    </form>

    <a href="index.php" class="back-home">← Back to Home</a>
</div>

</body>
</html>
