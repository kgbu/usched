<?php
  $page_title = "new schedule";
  include "include/header.php";
  include "include/date.php";
  include "include/db_conf.php";
  include "include/gen_member.php";
?>
<h1 class="menuLine">スケジュール登録</h1>

<form method="post" action="./post.php">
  <p>
    <label for="username">ユーザー名</label><br>
    <select id="username" name="username">
    <?php
      while ($row = mysql_fetch_assoc($members)) {
        $v = $row["username"];
        echo "<option value=$v>$v</option>\n";
      }
    ?>
    </select>
  </p>

  <p>
    <label for="date">日付</label><br>
    <input id="date" name="date" type="text" value="<?php echo $_REQUEST["date"]; ?>"/>
  </p>

  <p>
    <label for="content">スケジュール内容</label><br>
    <textarea id="content" name="content"></textarea>
  </p>

  <p>
    <input name="commit" type="submit" value="保存" />
  </p>
</form>
<a href="./">スケジュール一覧に戻る</a>
<?php include "include/footer.php"; ?>
