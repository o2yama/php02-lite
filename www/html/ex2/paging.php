<?php
define('NUM_PER_PAGE', 5);

try {
  $pdo = new PDO('mysql:charset=utf8mb4;dbname=posts_db;host=db', 'root', 'php02-lite');
} catch (PDOException $e) {
  echo "Error:" . $e->getMessage();
}

try {
  $stmt = $pdo->query("SELECT * FROM comments");
  $comments = $stmt->fetchAll();
} catch (PDOException $e) {
  print('Error:' . $e->getMessage());
}

$item_count = count($comments);
$count_of_pages = ceil($item_count / NUM_PER_PAGE);

if (!isset($_GET['current_page'])) {
  $current_page_index = 0;
} else {
  $current_page_index = $_GET['current_page'];
}

$start_index = $current_page_index * NUM_PER_PAGE;
$display_data = array_slice($comments, $start_index, NUM_PER_PAGE);
$last_index = $start_index + count($display_data) - 1;

function prev_page($page)
{
  return $page - 1;
}

function next_page($page)
{
  return $page + 1;
}
