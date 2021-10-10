<?php
function h($s)
{
  return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

$posts = array();
$pdo = null;
try {
  $pdo = new PDO('mysql:charset=utf8mb4;dbname=posts_db;host=db', 'root', 'php02-lite');
} catch (PDOException $e) {
  print('Error:' . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $message = h($_POST['message']);
  $user = h($_POST['user']);
  $now = date("Y-m-d H:i:s");

  try {
    if (!empty($message) && !empty($user)) {
      $sql = "INSERT INTO `text_posts` (`message`, `user`, `createdAt`) VALUES ('$message', '$user', '$now');";
      $stmt = $pdo->prepare($sql);
      $stmt->execute();
    }
  } catch (\Exception $e) {
    echo 'Error:' . $e->getMessage();
  }

  header('Location: ./');
  exit;
}

if (!empty($pdo)) {
  $stmt = $pdo->query("SELECT * FROM text_posts");
  $result = $stmt->fetchAll();
  foreach ($result as $row) {
    $message = $row['message'];
    $user = $row['user'];
    $createdAt = $row['createdAt'];
    $posts[] = "$message ($user) - $createdAt";
  }
}

$pdo = null;
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ex0</title>
  <link rel="stylesheet" href="./css/style.css">
</head>

<body>
  <h1>簡易掲示板</h1>
  <form method="POST" class='form'>
    <label for="message">message :</label>
    <input type="text" name="message" id="message">
    <label for="user">user :</label>
    <input type="text" name="user" id="user">
    <input type="submit" value="投稿">
  </form>

  <h2>投稿一覧 (<?php echo count($posts) ?>件)</h2>
  <ul>
    <?php
    if (empty(count($posts))) {
      echo '<li>投稿はありません。</li>';
    } else {
      foreach ($posts as $post) {
        echo '<li>' . $post;
      }
    }
    ?>
  </ul>

</body>

</html>