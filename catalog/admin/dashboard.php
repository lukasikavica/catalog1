<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Product Catalog</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION['logged_in'])) {
        header('Location: ../config/login.php');
        exit;
    }

    include '../config/database.php';
    include '../src/Comment.php';

    $comment = new Comment($conn);
    $unapprovedComments = $comment->readAllUnapproved();

    echo "<h1>Admin Dashboard</h1>";
    echo "<h2>Unapproved Comments</h2>";
    echo "<ul>";
    while ($row = $unapprovedComments->fetch_assoc()) {
        echo "<li>{$row['user_name']}: {$row['comment']} <button><a href='approve_comment.php?id={$row['id']}'>Approve</a></button></li>";
    }
    echo "</ul>";

    ?>
    <form action='logout.php' method='post'>
        <button class="bt" type='submit'>Logout</button>
    </form>
    <style>
        .bt {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px 0;
            background-color: #007bff;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }

        .bt:hover {
            background-color: #0056b3;
        }
    </style>
</body>