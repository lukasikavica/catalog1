<?php
include '../config/database.php';
include '../src/Comment.php';

$comment_id = $_GET['id'];
$comment = new Comment($conn);

if ($comment->approve($comment_id)) {
    echo "Comment approved successfully.";
    header('Location: dashboard.php'); 
} else {
    echo "Error approving comment.";
}
?>