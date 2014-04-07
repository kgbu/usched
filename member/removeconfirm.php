<?php
  $page_title = "member removal confirmation";
  include "../include/date.php";
  $key = str_replace(array('+', '/', '='), array('_', '-', '.'), (base64_encode($lastmondaystr)));
  if ($_REQUEST["key"] == $key)
{
    include "../include/memberheader.php";
    include "../include/db_conf.php";
    include "../include/gen_member.php";

?>
<h1 class="menuWarning">メンバー削除</h1>
<form method="post" action="./remove.php">
  <p>
このメンバーを削除しますか？: <?php echo $_REQUEST["member"]; ?>
    <input type="hidden" name="key" value="<?php echo $key; ?>">
    <input type="hidden" name="username" value="<?php echo $_REQUEST["member"]; ?>">
  </p>
  <p>
    <input name="commit" type="submit" value="削除" />
  </p>
</form>
<hr>
<a href="../">スケジュール一覧に戻る</a> | <a href="./">メンバー一覧に戻る</a>
<?php
    include "../include/footer.php";
  }
?>
