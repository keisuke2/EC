<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['member_login'])==false)
{
	print'ようこそゲスト様';
	print'<a href="member_login.html">会員ログイン</a><br/>';
	print'<br/>';
}
else
{   
	print'ようこそ';
	print $_SESSION['member_name'];
	print'様';
	print'<a href="member_logout.php">ログアウト</a><br/>';
	print'<br/>';


}
?>
<!DOCTYPE HTML PUBLIC"-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>PHP基礎</title>
</head>
<body>
<?php

try
{
$pro_code=$_GET['procode'];

$dsn='mysql:dbname=shop;host=localhost';
$user='root';
$password='root';
$dbh=new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');

$sql='SELECT name,price,gazou FROM mst_product WHERE code=?';
$stmt= $dbh->prepare($sql);
$data[]=$pro_code;
$stmt->execute($data);

$rec=$stmt->fetch(PDO::FETCH_ASSOC);
$pro_name=$rec['name'];
$pro_price=$rec['price'];
$pro_gazou_name=$rec['gazou'];

$dbh = null;

if($pro_gazou_name=='')
{
	$disp_gazou='';
}
else
{
	$disp_gazou='<img src="../product/gazou/'.$pro_gazou_name.'">';
}
print'<a href="shop_cartin.php?procode='.$pro_code.'">カートに入れる</a><br/><br/>';




}
catch(Exception $e)
{
	print'ただいま障害により大変ご迷惑を置け消しています';
	exit();
}
?>
商品情報参照<br/>
<br/>
商品コード<br/>
<?php print $pro_name;?>
<br/>
価格<br/>
<?php print $pro_price;?>
<br/>
<?php print $disp_gazou; ?>
<br/>
<form>
<input type="button" onclick="history.back()"value="戻る">

</form>


</body>
</html>







