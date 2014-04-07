<?php
  $page_title = "メンバー管理 rank up";
  $page_redirect = TRUE;
  include "../include/memberheader.php";
  include "../include/date.php";
  include "../include/db_conf.php";
  include "../include/gen_member.php";

  $key = str_replace(array('+', '/', '='), array('_', '-', '.'), (base64_encode($lastmondaystr)));

  if (isset($_REQUEST["member"]) && isset($_REQUEST["r"])) {
    $q = "SELECT username, rank FROM person WHERE username = '" .
       $_REQUEST["member"] . "' AND rank = " . $_REQUEST["r"];
    $res = dbq($q);
    $row1 = mysql_fetch_assoc($res);

    if (mysql_num_rows($res) > 0) {
      $q2 = "SELECT username, rank FROM person WHERE " .
         "rank = " . ($_REQUEST["r"] - 1);
      $res2 = dbq($q2);
      $row2 = mysql_fetch_assoc($res2);
  
      if ($res2) {
        $q3 = "UPDATE person SET rank = 99999 WHERE username = '" .
            $row2["username"] . "'";
        dbq($q3);
  
        $q4 = "UPDATE person SET rank = 100000 WHERE username = '" .
            $row1["username"] . "'";
        dbq($q4);
  
        $q5 = "UPDATE person SET rank = " . $_REQUEST["r"] .
            " WHERE username = '" .  $row2["username"] . "'";
        dbq($q5);
       
        $q6 = "UPDATE person SET rank = " . ($_REQUEST["r"] - 1) .
              " WHERE username = '" .  $row1["username"] . "'";
        dbq($q6);
?>
<h1 class="menuLine">順位を更新しました</h1>
<hr>
<a href="./">メンバー一覧に戻る</a>
<?php  
      } else {
?>
<h1 class="menuWarning">順位を更新できませんでした</h1>
<hr>
<a href="./">メンバー一覧に戻る</a>
<?php
      }
    } else {
?>
<h1 class="menuWarning">順位を更新できませんでした</h1>
<hr>
<a href="./">メンバー一覧に戻る</a>
<?php
    }
  } else {
?>
<h1 class="menuWarning">順位を更新できませんでした</h1>
<hr>
<a href="./">メンバー一覧に戻る</a>
<?php
  }
  include "../include/footer.php";
?>
