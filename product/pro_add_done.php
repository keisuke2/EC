<?php

session_start();
session_regenerate_id(true);
if(isset($_SESSION['login'])==false)
{
	print'ログインされていません<br/>';
	print'<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
	exit();
}
else
{
	print $_SESSION['staff_name'];
	print'さんログイン中<br/>';
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

     require_once('../common/common.php');

    $post=sanitize($_POST);

    $pro_name=$post['name'];
    $pro_price=$post['price'];
    $pro_gazou_name=$_POST['gazou_name'];

/*
$pro_name=$_POST['name'];
$pro_price=$_POST['price'];
$pro_gazou_name=$_POST['gazou_name'];


$pro_name=htmlspecialchars($pro_name);
$pro_price=htmlspecialchars($pro_price);
*/

$dsn='mysql:dbname=shop;host=localhost';
$user='root';
$password='root';
$dbh=new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');

$sql='INSERT INTO mst_product (name,price,gazou) VALUES(?,?,?)';
$stmt= $dbh->prepare($sql);
$data[]=$pro_name;
$data[]=$pro_price;
$data[]=$pro_gazou_name;
$stmt->execute($data);

$dbh = null;

print $pro_name;
print'を追加しました<br/>';

}
catch(Exception $e)
{
	print'ただいま障害により大変ご迷惑をお掛けしております';
	exit();
}
?>

<a href="pro_list.php">戻る</a>
</body>
</html>