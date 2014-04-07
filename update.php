<?php
  include "include/header.php";
  include "include/date.php";
  include "include/db_conf.php";
  include "include/gen_member.php";
  include "include/gen_schedule.php";

  $memberok = FALSE;
  $taskidok = FALSE;

  if (!($_REQUEST["username"] === "")) {
    while($row = mysql_fetch_assoc($members)) {
      if ($row["username"] === $_REQUEST["username"]) {
        $memberok = TRUE;
      }
    }
  }

  if (!($_REQUEST["taskid"] === "")) {
    while($row = mysql_fetch_assoc($schedules)) {
      if ($row["id"] === $_REQUEST["taskid"]) {
        $taskidok = TRUE;
        $username = $row["personid"];
        $date = $row["date"];
      }
    }
  }

  if ($memberok && $taskidok) {
    $qpost = "UPDATE task SET content = '" .
             $_REQUEST["content"] . "' WHERE id = " .
             $_REQUEST["taskid"];
    dbq($qpost);
?>
<h1 class="menuLine">スケジュールが更新されました</h1>
<dl>
<dt>ユーザー名</dt><dd><?php echo $username; ?></dd>
<dt>日時</dt><dd><?php echo $date; ?></dd>
<dt>スケジュール内容</dt><dd><?php echo $_REQUEST["content"]; ?></dd>
</dl>
<?php
  } else {
?>
<h1 class="menuWarning">該当するスケジュールが存在しません</h1>
<?php 
  }
?>
<a href="./">スケジュール一覧に戻る</a>
<?php
  include "include/footer.php"; 
?>
