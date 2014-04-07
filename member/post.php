<?php
  $page_title = "new member";
  include "../include/date.php";
  if ($_REQUEST["key"] == str_replace(array('+', '/', '='), array('_', '-', '.'), (base64_encode($lastmondaystr)))) {
    include "../include/memberheader.php";
    include "../include/db_conf.php";
    include "../include/gen_member.php";

    $memnum = mysql_num_rows($members);

    $newmember= TRUE;
    while ($row = mysql_fetch_assoc($members)) {
      if ($row["username"] == $_REQUEST["username"]) {
        $newmenber = FALSE;
      } 
    }

    if ($newmember) {
      $u = $_REQUEST["username"];
      $i = $_REQUEST["iconpath"];

      $q = "INSERT person (username, iconpath, rank) VALUES ( '" .  $u . 
           "', '" . $i . "', " . ($memnum + 1) . ")";
      dbq($q);
?>
<h1 class="menuLine">メンバー登録されました</h1>
<dl>
<dt>ユーザー名</dt>
<dd><?php echo $_REQUEST["username"]; ?></dd>
</dl>
<?php
    } else {
?>
<p>
<?php echo $_REQUEST["username"]; ?>このメンバーは登録済みです。
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
