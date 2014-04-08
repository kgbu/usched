<?php
  include "include/header.php";
  include "include/date.php";
  include "include/db_conf.php";
  include "include/gen_schedule.php";
  include "include/gen_member.php";
  include "include/gen_holiday.php";

  $baseyr = date("Y", $this_monday);
  $basem = date("m", $this_monday);
  $based = date("d", $this_monday);

  $hol = array();
  while ($ahol = mysql_fetch_assoc($holidays)) {
    $hol[] = $ahol;
  }

  $tablethstr = "";
  $tabletdstr = "";
  for ($i = 0; $i < 14; $i++) {
    $y = $youbi[$i];
    $mday = date("j", mktime(0,0,0, $basem, $based + $i, $baseyr));
    $mholday = date("Y-m-d", mktime(0,0,0, $basem, $based + $i, $baseyr));
    $shukujitsu = FALSE;
    $shukujitsutype = "";
    foreach ($hol as $ahol) {
      if ($mholday == $ahol["date"]) {
        $shukujitsu = TRUE;
        if (! mb_check_encoding($ahol["description"], "UTF-8")) {
          $shukujitsutype = mb_convert_encoding($ahol["description"], "UTF-8", "EUC-JP");
        } else {
          $shukujitsutype = $ahol["description"];
        }
      }
    } 
    if ($shukujitsu) {
      $tablethstr = $tablethstr . "<th class=\"tablethshukujitsu\">" . $mday . "(" . $y . $shukujitsutype . ")</th>\n";
      $tabletdstr = $tabletdstr . "<td class=\"tablethshukujitsu\">" . $mday . "(" . $y . $shukujitsutype . ")</td>\n";
    } else {
      $tablethstr = $tablethstr . "<th>" . $mday . "(" . $y . ")</th>\n";
      $tabletdstr = $tabletdstr . "<td>" . $mday . "(" . $y . ")</td>\n";
    }
  }
  $firsttablestr = "<tr>\n<th>メンバー名</th>\n" . $tablethstr . "</tr>"; 
  $middletablestr = "<tr>\n<td></td>\n" . $tabletdstr . "</tr>"; 

  if (isset($_REQUEST["offset"])) {
    $beforeoffset = $_REQUEST["offset"] - 1;
    $afteroffset = $_REQUEST["offset"] + 1;
  } else {
    $beforeoffset = - 1;
    $afteroffset = 1;
  }
?>
<h1 class="menuLineDouble">mocoスケジュール</h1>
<p>
<?php echo $thismondaystr; ?>から
<!-- 
lastmondaystr <?php echo $lastmondaystr; ?> 
strtotime today<?php echo date("Y-m-d", strtotime("today")); ?> 
strtotime monday<?php echo date("Y-m-d", strtotime("monday")); ?> 
strtotime last monday<?php echo date("Y-m-d", strtotime("last monday")); ?> 
<?php 
  $lm = (strtotime('monday') == strtotime('today'))? strtotime('monday'):strtotime('last monday');
  echo date("Y-m-d",$lm);
  if ( date("Y-m-d",strtotime('monday')) == date("Y-m-d",strtotime('today'))) {
    echo "same";
  } else {
    echo "diff";
  }
?>
-->
<?php echo $thisnext2sundaystr; ?>まで
| <a href="./?offset=<?php echo $beforeoffset; ?>">＜以前のスケジュール</a>
| <a href="./">[今日:<?php echo (date("Y年m月d日")); ?>へ戻る]</a>
| <a href="./?offset=<?php echo $afteroffset; ?>">以後のスケジュール＞</a>
</p>
<table>
<?php echo $firsttablestr; ?>
<?php
  $lines = array();
  while ($aline = mysql_fetch_assoc($schedules)) {
    $lines[] = $aline;
  }
  $rowcounter = -1;
  while ($row = mysql_fetch_assoc($members)) {
    $rowcounter++;
    if ($rowcounter == 3) {
      $rowcounter = 0;
      echo $middletablestr; 
    }
    
    echo "\t<tr>\n";
    echo "\t\t<td bgcolor=\"#E0FFE0\">" . $row["username"] . "</td>\n";

    for ($i = 0; $i < 14; $i++) {
      $mday = date("Y-m-d", mktime(0,0,0, $basem, $based + $i, $baseyr));
      $contents = "";
      $hit = FALSE;
      $yasumi = FALSE;
      foreach ($lines as $line) {
        if (($line["date"] == $mday) &&
            ($line["username"] == $row["username"])) {
          if ($hit) {
            $contents = $contents . "<hr>\n";
          }
          $hit = TRUE;
          if ($line["content"] == "休み") {
            $yasumi = TRUE;
          }
          $contents = $contents . $line["content"] .
              "<a href=\"./edit.php?taskid=" .
              $line["id"] . "\">✎</a>\n" .
              "<a href=\"./deleteconfirm.php?taskid=" .
              $line["id"] . "\">X</a>\n";
        }
      }
      if ($hit) {
        if ($yasumi) {
          $contents = "<td class=\"tdyasumi\">" . $contents . "|\n";
        } else {
          $contents = "<td class=\"tdbusy\">" . $contents . "|\n";
        }
      } else {
         $contents = "<td>";
      }
      echo $contents . "<a href=\"./new.php?username=" .
              $row["username"] . "&date=" .
              $mday . "\">+</a></td>\n";
    }
    echo "\t</tr>\n";
  }
?>


</table>
<hr>
<a href="../">閲覧画面へ</a>
<?php
  include "include/footer.php";
?>
