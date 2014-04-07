<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="content-style-type" content="text/css" />
<?php
  if (isset($page_redirect) && $page_redirect) {
?>
  <meta http-equiv="refresh" content="1; URL=index.php">
<?php
  }
?>
  <link href="../css/member.css" type="text/css" rel="stylesheet" />

  <title><?php 
    if ($page_title == "") {
      echo "Schedule";
    } else {
      echo $page_title;
    }
?></title>

</head>
<body>
