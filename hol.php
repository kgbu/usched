<?php
include "./include/db_conf.php"; 
$thisyear = date('Y');
$url = 'http://www.google.com/calendar/feeds/japanese__ja%40holiday.calendar.google.com/public/full';
// 日付指定　「tart-min=始まり日」「start-max=終わり日」
$option = '?start-min=' . $thisyear . '-01-01&start-max=' . $thisyear . '-12-31';
// XMLファイルの読込み
$content=file_get_contents($url.$option);
// XMLデータを配列に格納
$xml_parser=xml_parser_create();
xml_parse_into_struct($xml_parser,$content,$vals);
xml_parser_free($xml_parser);

foreach( $vals as $key => $value )
{
	if(isset($value['attributes']) && isset($value['attributes']['STARTTIME']))
	{
		$v = $value['attributes']['STARTTIME'];
		echo $v . "\n";
                $q = "INSERT holidays (date) VALUES ('" . $v . "')";
                dbq($q);
	}
}
?>
