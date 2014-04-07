<?php
  $q = "SELECT person.username as username, task.id as id, task.content as content, task.date as date FROM person, task " .
    "WHERE person.username = task.personid " .
    " AND task.date <= '" . $thisnext2sundaystr . "'" .
    " AND task.date >= '" . $thismondaystr . "'" . 
    " ORDER BY task.id";

  $schedules = dbq($q);
?>
