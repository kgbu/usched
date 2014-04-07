<?php
  include "./include/db_conf.php";

  $q = "select * from person ORDER BY username";
  $res = dbq($q);

  if ($res) {
    $list = array();

    while ($line = mysql_fetch_assoc($res)) {
      $list[] = $line; 
    }

    $i = 1;
    foreach ($list as $l) {
      $aq = "UPDATE person SET rank = " . $i . " WHERE username = '" .
            $l["username"] . "'";
      dbq($aq);
      echo $l["username"] . ":" . $i;
      $i++;
    }
  }
?>
