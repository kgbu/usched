<?php
  include "conf.php";
  $link = mysql_connect($dbhost, $dbuser, $dbpass);

  if (!$link) {
    die('接続できませんでした: ' . mysql_error());
  }

  if (!mysql_select_db($dbname, $link)) {
    die('Could not select database:' . mysql_error());
  }


  function dbq($querystring) {
    $res = mysql_query($querystring);
    if (!$res){
      die ('query error: ' . $querystring . '; ' . mysql_error());
    }
    return $res;
  }
?>
