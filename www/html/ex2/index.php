<?php
require 'paging.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/style.css">
  <title>Ex2</title>
</head>

<body>
  <h1>コメント一覧</h1>
  <p>全<?= $item_count ?>件中、<?= $start_index + 1 ?>件から<?= $last_index + 1 ?>件を表示しています。</p>

  <ul>
    <?php foreach ($display_data as $data) { ?>
      <li><?= $data['comment'] ?></li>
    <?php } ?>
  </ul>

  <form action="paging.php" method="get">
    <div id='links'>

      <?php if ($current_page_index > 0) { ?>
        <a class='link' type='text' href='./?current_page=<?= prev_page($current_page_index); ?>'>前</a>
      <?php } ?>
      <?php for ($i = 0; $i < $count_of_pages; $i++) { ?>
        <a class='link' type='text' href='./?current_page=<?= $i ?>'><?= $i + 1 ?></a>
      <?php } ?>
      <?php if ($current_page_index < $count_of_pages - 1) { ?>
        <a class='link' type='text' href='./?current_page=<?= next_page($current_page_index); ?>'>次</a>
      <?php } ?>
    </div>
  </form>

</body>

</html>