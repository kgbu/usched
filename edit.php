<?php
  $page_title = "edit schedule";
  include "include/header.php";
  include "include/date.php";
  include "include/db_conf.php";
  include "include/gen_member.php";

  if (isset($_REQUEST["taskid"]) ) {
    $q = "SELECT personid, date, content FROM task WHERE " . 
       " id = '" . $_REQUEST["taskid"] . "'";
    $res = dbq($q);
    if (mysql_num_rows($res) > 0) {
      $content = mysql_fetch_assoc($res);
?>
<h1 class="menuLine">スケジュール変更</h1>

<form method="post" action="./update.php">
  <input type="hidden" name="taskid" value="<?php echo $_REQUEST["taskid"]; ?>"/>
  <p>
    <label for="username">ユーザー名</label><br>
    <input id="username" name="username" type="hidden" value="<?php echo $content["personid"]; ?>">
    <?php echo $content["personid"]; ?>
  </p>

  <p>
    <label for="date">日付</label><br>
    
    <input id="date" name="date" type="hidden" value="<?php echo $content["date"]; ?>"/>
    <?php echo $content["date"]; ?>
  </p>

  <p>
    <label for="content">スケジュール内容</label><br>
    <textarea id="content" name="content"><?php echo $content["content"]; ?></textarea>
  </p>

  <p>
    <input name="commit" type="submit" value="保存" />
  </p>
</form>
<?php 
    } else {
?>
  <h1 class="menuLine">スケジュールが登録されていません</h1>
<?php
    } 
  } else {
?>
  <h1 class="menuLine">スケジュールが登録されていません</h1>
<?php 
  }
?>
<a href="./">スケジュール一覧に戻る</a>
<?php include "include/footer.php"; ?>

