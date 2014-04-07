<?php
  $page_title = "confirm delete schedule";
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
<h1 class="menuWarning">本当にスケジュールを削除しますか？</h1>

<form method="post" action="./delete.php">
  <input type="hidden" name="taskid" value="<?php echo $_REQUEST["taskid"]; ?>"/>
  <p>
    <label for="username">ユーザー名</label><br>
    <input type="hidden" name="username" value="<?php echo $content["personid"];  ?>"/>
    <?php echo $content["personid"]; ?>
  </p>

  <p>
    <label for="date">日付</label><br>
    <input id="date" name="date" type="hidden" value="<?php echo $content["date"]; ?>"/>
    <?php echo $content["date"]; ?>
  </p>

  <p>
    <label for="content">スケジュール内容</label><br>
    <?php echo $content["content"]; ?>
  </p>

  <p>
    <input name="commit" type="submit" value="はい、削除します" />
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
<a href="./">キャンセルしてスケジュール一覧に戻る</a>
<?php include "include/footer.php"; ?>
