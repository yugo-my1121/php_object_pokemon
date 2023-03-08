<?php
session_start();//セッションを使用する

$characterFlg=false;//キャラクター選択したかの判定フラグ

//キャラクター選択された場合はtrueに変える
if($_POST['pika'] or $_POST['hito']){
  $characterFlg=true;
}
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
    <?php if($_POST['start'] and !$characterFlg){?>
      <div class="button-container">
        <form method="post">
          <input type="submit" name="pika" class="start" value="▶︎ピカチュウ">
          <input type="submit" name="hito" class="start" value="▶︎ヒトカゲ">
        </form>
      </div>
    <?php }else{?>
      <h1><?php echo 'キャラクターが選択されました。';?></h1>
    <?php }?>
</body>
</html>
