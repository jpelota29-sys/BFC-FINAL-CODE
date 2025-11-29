<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user_id'])) {
    echo "<script>alert('Please login first.'); window.location='index.php';</script>";
    exit;
}

$user_id = $_SESSION['user_id'];
$username = $_POST['username'];
$contact = $_POST['contact'];
$address = $_POST['address'];
$password = $_POST['password'];

// If password is filled, hash it; otherwise, skip update
if(!empty($password)) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "UPDATE users SET username='$username', contact='$contact', address='$address', password='$hashed_password' WHERE id='$user_id'";
} else {
    $sql = "UPDATE users SET username='$username', contact='$contact', address='$address' WHERE id='$user_id'";
}

if($conn->query($sql) === TRUE) {
    $_SESSION['username'] = $username; // Update session username
    echo "<script>alert('Profile updated successfully!'); window.location='profile.php';</script>";
} else {
    echo "<script>alert('Error: ".$conn->error."'); window.history.back();</script>";
}
?>
