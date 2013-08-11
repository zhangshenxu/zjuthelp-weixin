<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

$dbname = 'XOFoiTvffoDvELZeAOjj';//这里填写你BAE数据库的名称
$host = getenv('HTTP_BAE_ENV_ADDR_SQL_IP');
$port = getenv('HTTP_BAE_ENV_ADDR_SQL_PORT');
$user = getenv('HTTP_BAE_ENV_AK');
$pwd = getenv('HTTP_BAE_ENV_SK');
$link = @mysql_connect("{$host}:{$port}",$user,$pwd,true);
if(!$link) {
    die("Connect Server Failed: " . mysql_error($link));
}
if(!mysql_select_db($dbname,$link)) {
    die("Select Database Failed: " . mysql_error($link));
}
                        

$id=mysql_query("select * from `newid`");
$newid=mysql_fetch_array($id);

$result=mysql_query("SELECT * FROM `wxwall` WHERE id=(select max(id) from `wxwall`)"); 
$array = mysql_fetch_array($result);

if($array[id]!=$newid[id])
{
	mysql_query("UPDATE newid SET id = '$array[id]' WHERE 1");

	echo "data: "."<img class='avatar' src=".$array[wxhead]." /><div class='name'>".$array[name].":</div><div class='msg'>".$array[content]."</div>\n\n";
	flush();
}
?>
