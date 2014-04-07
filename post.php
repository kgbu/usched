<?php
  include "include/header.php";
  include "include/date.php";
  include "include/db_conf.php";
  include "include/gen_member.php";

  $ok = FALSE;

  if (!($_REQUEST["username"] === "")) {
    while($row = mysql_fetch_assoc($members)) {
      if ($row["username"] === $_REQUEST["username"]) {
        $ok = TRUE;
      }
    }
  }
  if (isset($_REQUEST["selectcontent"]) &&
      ($_REQUEST["content"] == "")) {
    $contentstr = $_REQUEST["selectcontent"];
  } else {
    $contentstr = $_REQUEST["content"];
  }

  if ($ok && ($contentstr != "")) {
    $qpost = "INSERT task (personid, date, content) VALUES ('" . 
             $_REQUEST["username"] . "', '" .
             $_REQUEST["date"] . "', '" .
             $contentstr . "')";
    dbq($qpost);
?>
<h1 class="menuLine">スケジュールが登録されました</h1>
<dl>
<dt>ユーザー名</dt><dd><?php echo $_REQUEST["username"]; ?></dd>
<dt>日時</dt><dd><?php echo $_REQUEST["date"]; ?></dd>
<dt>スケジュール内容</dt><dd><?php echo $contentstr; ?></dd>
</dl>

<a href="./">スケジュール一覧に戻る</a>
<?php } else { ?>
<h1 class="menuWarning">スケジュールが登録できませんでした</h1>
<a href="./">スケジュール一覧に戻る</a>
<?php 
  }
  include "include/footer.php"; 
?>
