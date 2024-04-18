<?php
session_start();
include '../config/database.php'; // Ensure this path points to your actual database config file

$username = $_POST['username'] ?? null;
$password = $_POST['password'] ?? null;

if ($username && $password) {
    // Prepare SQL to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        // Assuming password is hashed using password_hash()
        if ($password == $user['password']) {
            // Credentials are correct
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['logged_in'] = true;

            header('Location: ../admin/dashboard.php');
            exit;
        } else {
            // Incorrect password
            $error = 'Invalid login credentials.';
        }
    } else {
        // User not found
        $error = 'User not found.';
    }
} else {
    // Form data missing
    $error = 'Please enter username and password.';
}

// Redirect back to login page or display error
header('Location: index.php?error=' . urlencode($error));
exit;
?>