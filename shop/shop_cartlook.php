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

if(isset($_SESSION['cart'])==true)
{
	$cart=$_SESSION['cart'];
	$kazu=$_SESSION['kazu'];
	$max=count($cart);
}
else
{
	$max=0;
}

if($max==0)
{
	print 'カートに商品が入っていません<br/>';
	print'<br/>';
	print'<a href="shop_list.php">商品一覧に戻る</a>';
	exit();
}

/*p183確認できたため削除
var_dump($cart);
exit();
*/

$dsn='mysql:dbname=shop;host=localhost';
$user='root';
$password='root';
$dbh=new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');
//途中p184

foreach($cart as $key=>$val)
{
	$sql='SELECT code,name,price,gazou FROM mst_product WHERE code=?';
	$stmt=$dbh->prepare($sql);
	$data[0]=$val;
	$stmt->execute($data);

	$rec=$stmt->fetch(PDO::FETCH_ASSOC);

	$pro_name[]=$rec['name'];
	$pro_price[]=$rec['price'];
	if($rec['gazou']=='')
	{
		$pro_gazou[]='';
	}
	else
	{
		$pro_gazou[]='<img src="../product/gazou/'.$rec['gazou'].'">';
	}

}
$dbh = null;



}
catch(Exception $e)
{
	print'ただいま障害により大変ご迷惑を置け消しています';
	exit();
}
?>
カートの中身<br/>
<br/>
<table border="1">
<tr>
<td>商品</td>
<td>商品画像</td>
<td>価格</td>
<td>数量</td>
<td>小計</td>
<td>削除</td>
</tr>

<form method="post" action="kazu_change.php">
<?php for($i=0;$i<$max;$i++)
{
?>
<tr>
	<td><?php print $pro_name[$i];?></td>
	<td><?php print $pro_gazou[$i];?></td>
	<td><?php print $pro_price[$i];?>円</td>
	<td><input type="text"name="kazu<?php print $i;?>"value="<?php print $kazu[$i];?>"></td>
	<td><?php print $pro_price[$i]*$kazu[$i];?>円</td>
	<td><input type="checkbox" name="sakujo<?php print $i;?>"></td>
</tr>
<?php	
	}
?>
</table>

<input type="hidden" name="max"value="<?php print $max;?>">
<input type="submit" value="数量変更"><br/>
<input type="button" onclick="history.back()"value="戻る">

</form>
<br/>
<a href="shop_form.html">ご購入手続きへ進む</a><br/>
<?php
 	if(isset($_SESSION["member_login"])==true)
 	{
 		print'<a href="shop_kantan_check.php">会員簡単注文へ進む</a><br/>';
 		
 	}
?>


</body>
</html>