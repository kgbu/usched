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
    <?php echo $_REQUEST["username"]; ?>
    <input id="username" name="username" type="hidden" value="<?php echo $_REQUEST["username"]; ?>" />
  </p>

  <p>
    <label for="date">日付</label><br>
    <?php echo $_REQUEST["date"]; ?>
    <input id="date" name="date" type="hidden" value="<?php echo $_REQUEST["date"]; ?>"/>
  </p>

  <p>
    <label for="content">スケジュール内容</label><br>
    <select id="selectcontent" name="selectcontent">
      <option value="" selected>一覧になければ下欄に記入</option>\n";
    <?php 
      foreach (array ("作業", "打合せ", "会議", "休み", "出張") as $v) {
        echo "<option value=\"$v\">$v</option>\n";
      }
    ?>
    </select><br>
    <textarea id="content" name="content"></textarea>
  </p>

  <p>
    <input name="commit" type="submit" value="保存" />
  </p>
</form>
<a href="./">スケジュール一覧に戻る</a>
<?php include "include/footer.php"; ?>
