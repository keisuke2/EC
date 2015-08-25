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

    $staff_name=$post['name'];
    $staff_pass=$post['pass'];
   
/*
$staff_name=$_POST['name'];
$staff_pass=$_POST['pass'];

$staff_name=htmlspecialchars($staff_name);
$staff_pass=htmlspecialchars($staff_pass);
*/


$dsn='mysql:dbname=shop;host=localhost';
$user='root';
$password='root';
$dbh=new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');

$sql='INSERT INTO mst_staff(name,password) VALUES(?,?)';
$stmt= $dbh->prepare($sql);
$data[]=$staff_name;
$data[]=$staff_pass;
$stmt->execute($data);

$dbh = null;

print $staff_name;
print'さんを追加しました<br/>';

}
catch(Exception $e)
{
	print'ただいま障害により大変ご迷惑をお掛けしております';
	exit();
}
?>

<a href="staff_list.php">戻る</a>
</body>
</html>