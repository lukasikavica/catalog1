<?php
session_start();
include '../config/database.php'; 

$username = $_POST['username'] ?? null;
$password = $_POST['password'] ?? null;

if ($username && $password) {
    $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if ($password == $user['password']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['logged_in'] = true;

            header('Location: ../admin/dashboard.php');
            exit;
        } else {
            $error = 'Invalid login credentials.';
        }
    } else {
        $error = 'User not found.';
    }
} else {
    $error = 'Please enter username and password.';
}

header('Location: index.php?error=' . urlencode($error));
exit;
?>
