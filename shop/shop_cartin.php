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

if(isset($_SESSION['cart'])==true)
{
	
	$cart=$_SESSION['cart'];
	$kazu=$_SESSION['kazu'];
	if(in_array($pro_code,$cart)==true)
	{
		print'その商品はすでにカートに入っています<br/>';
		print'<a href="shop_list.php">商品一覧に戻る</a>';
		exit();
	}
}

$cart[]=$pro_code;
$kazu[]=1;
$_SESSION['cart']=$cart;
$_SESSION['kazu']=$kazu;

//もう動作確認は済んだので悪女p177、だが追加されたコードが表示されなくなる
foreach($cart as $key=>$val)
{
	print $val;
	print'<br/>';

}


}
catch(Exception $e)
{
	print'ただいま障害により大変ご迷惑を置け消しています';
	exit();
}
?>
カートに追加しました<br/>
<br/>
<a href="shop_list.php">商品一覧に戻る</a>
</body>
</html>