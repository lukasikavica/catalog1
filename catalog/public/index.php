<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Product Catalog</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <header>
    <h1>Product Catalog</h1>
    <header>
      <div class="login-form">
        <form action="login_subbmite.php" method="post">
          <input type="text" name="username" placeholder="Username" required>
          <input type="password" name="password" placeholder="Password" required>
          <button type="submit">Login</button>
        </form>
      </div>
    </header>

  </header>

  <section class="products">
    <?php
    include '../config/database.php';
    include '../src/Product.php';

    $product = new Product($conn);
    $result = $product->readAll();

    echo '<div class="product-grid">';
    while ($row = $result->fetch_assoc()) {
      echo "<div class='product'>";
      echo "<img src='./images/" . $row["image_url"] . "' alt='Product Image'>";
      echo "<h3>" . $row["title"] . "</h3>";
      echo "<p>" . $row["description"] . "</p>";
      echo "</div>";
    }
    echo '</div>';
    ?>
  </section>

  <section class="comments">
    <?php
    include '../src/Comment.php';

    $comment = new Comment($conn);
    $result = $comment->readApproved();

    while ($row = $result->fetch_assoc()) {
      echo "<div class='comment'>";
      echo "<p>" . $row["comment"] . " - <strong>" . $row["user_name"] . "</strong></p>";
      echo "</div>";
    }
    ?>
  </section>

  <section class="comment-form">
    <form action="../admin/submite_comment.php" method="post">
      <input type="text" name="name" placeholder="Your name" required>
      <input type="email" name="email" placeholder="Your email" required>
      <textarea name="comment" placeholder="Your comment" required></textarea>
      <button type="submit">Submit Comment</button>
    </form>
  </section>

  <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
    <p>Comment submitted successfully and is pending approval.</p>
  <?php elseif (isset($_GET['status']) && $_GET['status'] == 'error'): ?>
    <p>Error submitting comment. Please try again.</p>
  <?php endif; ?>

  <footer>
    <p>Catalog PHP test</p>
  </footer>
</body>

</html>