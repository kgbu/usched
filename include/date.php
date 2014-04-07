<?php
  $last_monday = (date("Y-m-d", strtotime('monday')) == date("Y-m-d",strtotime('today')))? strtotime('monday'):strtotime('last monday');
  $lastmondaystr = date("Y-m-d", $last_monday);
  $next_sunday = strtotime('next sunday');
  $next2_sunday = strtotime('+2 sunday');
  $next2sundaystr = date("Y-m-d", $next2_sunday);
  $youbi = array("月","火","水","木","金","土","日","月","火","水","木","金","土","日");


  if (isset($_REQUEST["offset"])) {
    $this_monday= mktime(0,0,0,date("n",$last_monday),
               date("j", $last_monday) + (14 * $_REQUEST["offset"]),
               date("Y", $last_monday));
    $thismondaystr = date("Y-m-d",$this_monday);
    $this_next2_sunday = mktime(0,0,0,date("m",$next_sunday),
               date("j", $next_sunday) + 7 + ( 14 * $_REQUEST["offset"] ),
               date("Y", $next_sunday));
    $thisnext2sundaystr = date("Y-m-d", $this_next2_sunday);
  } else {
    $this_monday= mktime(0,0,0,date("n",$last_monday),
               date("j", $last_monday),
               date("Y", $last_monday));
    $thismondaystr = date("Y-m-d",$this_monday);
    $this_next2_sunday = mktime(0,0,0,date("m",$next_sunday),
               date("j", $next_sunday) + 7,
               date("Y", $next_sunday));
    $thisnext2sundaystr = date("Y-m-d", $this_next2_sunday);
  } 
?>
