<?php
  $page_title = "new schedule";
  include "include/header.php";
  include "include/date.php";
  include "include/db_conf.php";
  include "include/gen_member.php";
  include "include/gen_schedule.php";

  if ((isset($_REQUEST["taskid"])) && 
      (isset($_REQUEST["username"])) &&
      (isset($_REQUEST["date"]))) {
    $q = "SELECT personid, date, content FROM task WHERE " .
       " id = '" . $_REQUEST["taskid"] . "'";
    $res = dbq($q);

    if (mysql_num_rows($res) > 0) {
      $content = mysql_fetch_assoc($res);

      if (($content["personid"] == $_REQUEST["username"]) &&
          ($content["date"] == $_REQUEST["date"])) { 
      
        $qd = "DELETE FROM task WHERE id = " . $_REQUEST["taskid"] .
            " AND personid = '" . $_REQUEST["username"] . "' " .
            " AND date = '" . $_REQUEST["date"] . "'";
        $resd = dbq($qd);
?>
<h1 class="menuWarning">スケジュールを削除しました</h1>
  <p>
    ユーザー名<?php echo $content["personid"]; ?>
  </p>

  <p>
    日付 <?php echo $_REQUEST["date"]; ?>
  </p>

  <p>
    スケジュール内容 <?php echo $content["content"]; ?>
  </p>
<?php
      } else {
?>
<h1 class="menuWarning">スケジュールが存在しません</h1>
<?php
      }
    } else {
?>
<h1 class="menuWarning">スケジュールが存在しません</h1>
<?php
    }
  } else {
?>
<h1 class="menuWarning">スケジュールが存在しません</h1>
<?php
  }
?>
<a href="./">スケジュール一覧に戻る</a>
<?php include "include/footer.php"; ?>
