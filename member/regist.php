<?php
  $page_title = "new member";
  include "../include/date.php";
  if ($_REQUEST["key"] == str_replace(array('+', '/', '='), array('_', '-', '.'), (base64_encode($lastmondaystr))))
{
    include "../include/memberheader.php";
    include "../include/db_conf.php";
    include "../include/gen_member.php";

?>
<h1 class="menuLine">メンバー登録</h1>

<form method="post" action="./post.php">
  <p>
    <input type="hidden" name="key" value="<?php echo str_replace(array('+', '/', '='), array('_', '-', '.'), (base64_encode($lastmondaystr))); ?>">
    <label for="username">ユーザー名</label><br>
    <input id="username" name="username" type="text">
  </p>

  <p>
    <input id="iconpath" name="iconpath" type="hidden" value="default.jpg"/>
  </p>

  <p>
    <input name="commit" type="submit" value="保存" />
  </p>
</form>
<hr>
<a href="../">スケジュール一覧に戻る</a> | <a href="./">メンバー一覧に戻る</a>
<?php
    include "../include/footer.php";
  }
?>
