<?php
session_start();
$_SESSION["etime"]=time();
$backScore=$_SESSION["etime"]-$_SESSION["stime"];
$gameType=$_POST['gameType']."Rank";
$score=$_POST['score'];
if(abs($backScore-$score)>2){
   exit;
}
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
 $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
 $dbh->query('set names utf8');
if(isset($_SESSION['isLogin'])&&$_SESSION['isLogin']===1){
}
else{
 $stmt=$dbh->prepare("select * from {$gameType} order by score limit 100");
 $stmt->execute();
 $total=$dbh->prepare("select * from {$gameType}");
 $total->execute();
 $totalNum=$total->rowCount();
 $totalRows=$stmt->fetchAll(PDO::FETCH_NUM);
 $table="<div class='scoreBoard'><div id='caption'>排行榜</div><table>";
 $i=1;
 foreach($totalRows as $row){
$table.="<tr><td>{$i}</td><td>{$row[0]}</td><td>{$row[1]}</td><td class='scoreCol'>{$row[2]}  s</td></tr>";
$i++;
 }
 $table.="</table></div>";
 $count=$dbh->prepare("select * from {$gameType} where score<?");
 $count->execute(array($score));
 $countNum=$count->rowCount();
 $beatRate=100.0-$countNum*100.0/$totalNum;

 $list=array("table"=>$table,"count"=>$countNum,"score"=>$score,"total"=>$totalNum,"backScore"=>$backScore,"rate"=>$beatRate,gameType=>$gameType);
 echo json_encode($list);
unset($_SESSION["etime"]);
unset($_SESSION["stime"]);
}

/*$dbh->exec("delete from scoreRank");
$insert="insert into scoreRank(name, score) VALUES
('我是钱堃','10'),
('竹青','15'),
('用笔','20')";
$affected=$dbh->exec($insert);

if($affected){
	echo '数据表中受影响的行数为:'.$affected."<br/>";
}else{
	print_r($dbh->errorInfo());
}

$select="select*from scoreRank";
$count="select*from scoreRank where score<'15'";
$sta=$dbh->query($count);
echo "排在你前面的有".$sta->rowCount()."位选手<br/>";
try{
 $pdostatement=$dbh->query($select);
 echo "一共从表中获取到".$pdostatement->rowCount()."条记录:<br/>";
 foreach($pdostatement as $row){
  echo $row['name']."&nbsp";
  echo $row['score']."<br/>";
  }

}catch(PDOException $e){
echo $e->getMessage();
}*/
