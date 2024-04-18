<?php
include '../config/database.php';
include '../src/Comment.php';

$user_name = $_POST['name'];
$email = $_POST['email'];
$comment_text = $_POST['comment'];

$comment = new Comment($conn);
if ($comment->create($user_name, $email, $comment_text)) {
    header('Location: ../public/index.php');
} else {
    die("Error: The file does not exist.");
}
?>