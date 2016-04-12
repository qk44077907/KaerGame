<?php
$dsn = 'mysql:dbname=rank;host=localhost';
$user='root';
$psw='44077907';
try{
	$dbh=new PDO($dsn,$user,$psw);
 }
 catch(PDOException $e){
 echo '数据库连接失败'.$e->getMessage();
 }

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
}
