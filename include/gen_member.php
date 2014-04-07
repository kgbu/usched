<?php
  $q = "SELECT * FROM person ORDER BY rank"; 
  $members = mysql_query($q) or die('Query failed: ' . $q . ':' .  mysql_error());
?>
