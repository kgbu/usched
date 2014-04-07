<?php
  $page_title = "member removed";
  include "../include/date.php";
  $key = str_replace(array('+', '/', '='), array('_', '-', '.'), (base64_encode($lastmondaystr)));

  if ($_REQUEST["key"] == $key) {
    include "../include/memberheader.php";
    include "../include/db_conf.php";
    include "../include/gen_member.php";

    $inmember = FALSE;
    while ($row = mysql_fetch_assoc($members)) {
      if ($row["username"] == $_REQUEST["username"]) {
        $inmember = TRUE;
      } 
    }

    if ($inmember) {
      $u = $_REQUEST["username"];

      $q = "DELETE FROM person WHERE username = '" .  $u . "'";
      dbq($q);
      $qt = "DELETE FROM task WHERE personid = '" .  $u . "'";
      dbq($qt);

      $qr1 = "SELECT * FROM person ORDER BY rank";
      $resr1 = dbq($qr1);

      $ranklist = array();
      $ranknum = 1;
      while ($row1 = mysql_fetch_assoc($resr1)) {
        $qwh = "UPDATE person SET rank = " . $ranknum . 
               " WHERE username = '" . $row1["username"] . "'";
        dbq($qwh);
        $ranknum++;
      }
?>
<h1 class="menuWarning">メンバーが削除されました</h1>
<dl>
<dt>ユーザー名</dt>
<dd><?php echo $_REQUEST["username"]; ?></dd>
</dl>
<?php
    } else {
?>
<p>
<?php echo $_REQUEST["username"]; ?>このメンバーは存在しません。
</p>
<?php
    }
?>
<hr>
<a href="../">スケジュール一覧に戻る</a> | <a href="./">メンバー一覧に戻る</a>
<?php
    include "../include/footer.php";
  }
?>
