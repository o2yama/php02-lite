<?php
define('MAX_FILE_SIZE', 10 * 1024 * 1024); //10MB

$pdo = null;
$posts = array();

try {
  $pdo = new PDO('mysql:charset=utf8mb4;dbname=posts_db;host=db', 'root', 'php02-lite');
} catch (PDOException $e) {
  echo "Error:" . $e->getMessage();
}

if (
  $_SERVER['REQUEST_METHOD'] == 'POST'
  && $_FILES['upload']['error'] == 0
  && $_FILES['upload']['size'] < MAX_FILE_SIZE
) {
  $now = time();
  $filename = "$now" . $_FILES['upload_image']['name'];
  $image_path = './images/' . $filename;
  move_uploaded_file($_FILES['upload_image']['tmp_name'], $image_path);
  try {
    $sql = "INSERT INTO `image_posts` (`image_path`, `posted_at`) VALUES ('$image_path', '$now');";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    header('Location: ./');
  } catch (PDOException $e) {
    echo "Error:" . $e->getMessage();
  }
} 

try {
  $stmt = $pdo->query("SELECT * FROM image_posts");
  $posts = $stmt->fetchAll();
} catch (PDOException $e) {
  print('Error:' . $e->getMessage());
}
