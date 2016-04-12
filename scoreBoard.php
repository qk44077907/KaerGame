<?php
$dsn = 'mysql:dbname=a0206125148;host=localhost';
$user='a0206125148';
$psw='618c7a23';
try{
	$dbh=new PDO($dsn,$user,$psw);
 }
 catch(PDOException $e){
 echo '数据库连接失败'.$e->getMessage();
 exit;
 }
 $dbh->query('set names utf8');
 $jsms=$dbh->prepare("select * from jsmsrank order by score limit 100");
 $jsms->execute();
 $jsmsRows=$jsms->fetchAll(PDO::FETCH_NUM);
 $jsmsTable="<table>";
 $i=1;
  foreach($jsmsRows as $jsmsRow){
 $jsmsTable.="<tr><td>{$i}</td><td>{$jsmsRow[0]}</td><td>{$jsmsRow[1]}</td><td class='scoreCol'>{$jsmsRow[2]} s</td></tr>";
 $i++;
  }
 $jsmsTable.="</table>";

 $szms=$dbh->prepare("select * from szmsrank order by score limit 100");
 $szms->execute();
 $szmsRows=$szms->fetchAll(PDO::FETCH_NUM);
  $szmsTable="<table style='display: none'>";
  $i=1;
   foreach($szmsRows as $szmsRow){
  $szmsTable.="<tr><td>{$i}</td><td>{$szmsRow[0]}</td><td>{$szmsRow[1]}</td><td class='scoreCol'>{$szmsRow[2]} s</td></tr>";
  $i++;
  }
  $jsmsTable.="</table>";

  $list=array("jsmsTable"=>$jsmsTable,"szmsTable"=>$szmsTable);
  echo json_encode($list);