<?php
  $page_title = "メンバー管理";
  include "../include/memberheader.php";
  include "../include/date.php";
  include "../include/db_conf.php";
  include "../include/gen_member.php";

  $key = str_replace(array('+', '/', '='), array('_', '-', '.'), (base64_encode($lastmondaystr)));
?>
<h1 class="menuLine">mocoメンバー管理</h1>
<p>
メンバー一覧です。追加する場合は下端の「メンバー追加」のリンクをクリックしてください。
</p>
<table>
  <tr>
  <th>メンバー名</th><th>▲ </th><th>▼</th><th>削除</th>
  </tr>
<?php

  $num = mysql_num_rows($members);
  while ($row = mysql_fetch_assoc($members)) {
    $n = $row["username"];
    $r = $row["rank"];
    $str = "<tr>\n\t\t<td>$n</td>";
    if ($r > 1) {
      $str = $str . "<td><a href=\"./up.php?member=$n&r=$r\">↑</a></td> ";
    } else {
      $str = $str . "<td></td> ";
    }
    if ($r < $num) {
      $str = $str . "<td><a href=\"./down.php?member=$n&r=$r\">↓</a></td> ";
    } else {
      $str = $str . "<td></td> ";
    }
    $str = $str . "<td><a href=\"./removeconfirm.php?member=$n&key=$key\">削除</a></td>";
    echo $str . "</td>\n";
  }
?>
</table>
<hr>
<a href="./regist.php?key=<?php echo $key; ?>">メンバー追加</a> | <a href="../" >スケジュール一覧へ戻る</a>
<?php
  include "../include/footer.php";
?>
