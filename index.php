<?php
session_start();//セッションを使用する
?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style.css">
  <title>ポケモンゲーム</title>
</head>
<body>
  <?php if(empty($_POST)){?>
    <div class="button-container">
      <form method="post">
        <input type="submit" name="start" class="start" value="▶︎ゲームスタート">
      </form>
    </div>
  <?php }?>
    <?php if($_POST['start']){?>
      <div class="button-container">
        <form method="post">
          <input type="submit" name="pika" class="start" value="▶︎ピカチュウ">
          <input type="submit" name="hito" class="start" value="▶︎ヒトカゲ">
        </form>
      </div>
    <?php }?>
</body>
</html>
