<?php
require 'upload.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/style.css">
  <title>Ex1</title>
</head>

<body>
  <form action="upload.php" autocomplete=off method="post" enctype="multipart/form-data">
    <div class='upload_btn'>
      Upload!
      <input type="file" name="upload_image" onChange="this.form.submit()">
    </div>
  </form>

  <p class='message'><?php echo $message ?></p>

  <div class="image_list">
    <?php
    if (!empty($posts)) {
      for ($i = 0; $i < count($posts); $i++) {
    ?>
        <img src='<?php echo $posts[$i]['image_path'] ?>' alt='<?php echo $posts[$i]['posted_at'] ?>'>
    <?php  }
    }
    ?>
  </div>
</body>

</html>