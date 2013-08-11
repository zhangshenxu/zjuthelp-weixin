<?php
//header('Content-Type: text/html; charset=GB18030');
//header('Content-Type: text/html; charset=utf-8');

if(isset($_GET['submit'])){
$username = $_GET['username'];
$password = $_GET['password'];

$arr=file_get_contents("http://210.32.200.89:65001/zjuthelper/classtable/open/api.php?method=json&username=".$username."&password=".$password);
//print_r(json_decode($data));
$arr = json_decode($arr);
/*var_dump($arr);
exit;*/
$arr2=file_get_contents("http://210.32.200.95:8080/CatchExamService/GetService1?user=".$username."&password=".$password."&year=2012%2F2013&number=2&submit=%B2%E9%D5%D2");
$arr2 = json_decode($arr2);
print_r($arr2);
}
?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title></title>
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.0/jquery.mobile-1.3.0.min.css" />
<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
<script src="http://code.jquery.com/mobile/1.3.0/jquery.mobile-1.3.0.min.js"></script>

</head>
<body>
	<div data-role="page" id="classtable">
	    <div data-theme="" data-role="header">
	        <h3>原创查询</h3>
	    </div>
	    <div data-role="content">
	        <div data-role="navbar" data-iconpos="left">
	            <ul>
	                <li><a href="#classtable" data-transition="fade" data-theme="" data-icon="">课表</a></li>

	              </ul>
	                
	                <table  border="2px" id="classtable">
	               <tr>
	               		<th width='150'>星期一</th>
	               		<th width='150'>星期二</th>
	               		<th width='150'>星期三</th>
	               		<th width='150'>星期四</th>
	               		<th width='150'>星期五</th>
	               </tr>
	           
						<?php
							if(isset($_GET['submit']) )
							{

								/*echo "<div class='ui-grid-d' style='text-align: center; border:2px solid #000;'>";
								echo "<div class='ui-block-a'>",$arr->Monday->first,"</div>";
								echo "<div class='ui-block-b'>",$arr->Tuesday->first,"</div>";
								echo "<div class='ui-block-c'>",$arr->Wednesday->first,"</div>";
								echo "<div class='ui-block-d'>",$arr->Thursday->first,"</div>";
								echo "<div class='ui-block-e'>",$arr->Friday->first,"</div>";
								echo "</div>";*/
								echo "<tr>";
								echo "<td width='150'>";
								if(empty($arr->Monday->first))
								{
									echo "&nbsp;&nbsp;&nbsp;";
								}
								else
								{
									echo $arr->Monday->first;
								}
								echo "</td>";
								echo "<td width='150'>",$arr->Tuesday->first,"</td>";
								echo "<td width='150'>",$arr->Wednesday->first,"</td>";
								echo "<td width='150'>",$arr->Thursday->first,"</td>";
								echo "<td width='150'>",$arr->Friday->first,"</td>";
								echo "</tr>";

								echo "<tr>";
								echo "<td width='150'>";
								if(empty($arr->Monday->third))
								{
									echo "&nbsp;&nbsp;&nbsp;";
								}
								else
								{
									echo $arr->Monday->third;
								}
								echo "</td>";
								echo "<td width='150'>",$arr->Tuesday->third,"</td>";
								echo "<td width='150'>",$arr->Wednesday->third,"</td>";
								echo "<td width='150'>",$arr->Thursday->third,"</td>";
								echo "<td width='150'>",$arr->Friday->third,"</td>";
								echo "</tr>";

								echo "<tr>";
								echo "<td width='150'>";
								if(empty($arr->Monday->sixth))
								{
									echo "&nbsp;&nbsp;&nbsp;";
								}
								else
								{
									echo $arr->Monday->sixth;
								}
								echo "</td>";
								echo "<td width='150'>",$arr->Tuesday->sixth,"</td>";
								echo "<td width='150'>",$arr->Wednesday->sixth,"</td>";
								echo "<td width='150'>",$arr->Thursday->sixth,"</td>";
								echo "<td width='150'>",$arr->Friday->sixth,"</td>";
								echo "</tr>";

								echo "<tr>";
								echo "<td width='150'>";
								if(empty($arr->Monday->eighth))
								{
									echo "&nbsp;&nbsp;&nbsp;";
								}
								else
								{
									echo $arr->Monday->eighth;
								}
								echo "</td>";
								echo "<td width='150'>",$arr->Tuesday->eighth,"</td>";
								echo "<td width='150'>",$arr->Wednesday->eighth,"</td>";							
								echo "<td width='150'>",$arr->Thursday->eighth,"</td>";
								echo "<td width='150'>",$arr->Friday->eighth,"</td>";
								echo "</tr>";

								echo "<tr>";
								echo "<td width='150'>";
								if(empty($arr->Monday->tenth))
								{
									echo "&nbsp;&nbsp;&nbsp;";
								}
								else
								{
									echo $arr->Monday->tenth;
								}
								echo "</td>";
								echo "<td width='150'>",$arr->Tuesday->tenth,"</td>";
								echo "<td width='150'>",$arr->Wednesday->tenth,"</td>";
								echo "<td width='150'>",$arr->Thursday->tenth,"</td>";
								echo "<td width='150'>",$arr->Friday->tenth,"</td>";
								echo "</tr>";


							//	var_dump($arr);
							//$q = 1;
						/*	for($n=0;$n<4;$n++)
							{
								$k = $n*8;
								
								echo "<tr>";
									//echo "<td>第".$q.",".++$q."节</td>";
									//$q++;
								for($m=0;$m<8;$m++)
									echo "<td width='100'>".$arr[0][$m+$k]."</td>";	
								echo "</tr>";
							}

							echo "<tr>";
							//echo "<td>第".$q.",".++$q."节</td>";
							for($m=0;$m<8;$m++)
								echo "<td width='100'>".$arr2[0][$m]."</td>";	
							echo "</tr>";*/
							}
						?>
			</table>
	           
	        </div>
	    </div>
	</div>
</body>
</html>
