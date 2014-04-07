<?php
  $q = "SELECT * FROM holidays ORDER BY date"; 
  $holidays = mysql_query($q) or die('Query failed: ' . $q . ':' .  mysql_error());
?>
