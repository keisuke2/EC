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
$staff_code=$_GET['staffcode'];

$dsn='mysql:dbname=shop;host=localhost';
$user='root';
$password='root';
$dbh=new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');

$sql='SELECT name FROM mst_staff WHERE code=?';
$stmt= $dbh->prepare($sql);
$data[]=$staff_code;
$stmt->execute($data);

$rec=$stmt->fetch(PDO::FETCH_ASSOC);
$staff_name=$rec['name'];

$dbh = null;




}
catch(Exception $e)
{
	print'ただいま障害により大変ご迷惑を置け消しています';
	exit();
}
?>
スタッフ修正<br/>
<br/>
スタッフコード<br/>
<?php print $staff_code;?>

<br/>
<br/>
<form method="post" action="staff_edit_check.php">
<input type="hidden" name="code" value="<?php print $staff_code;?>">
スタッフ名<br/>
<input type="text" name="name" style="width:200px" value="<?php print $staff_name;
/*名前が表示されない　どうやら上記のやつが機能してないようだ
回答：executeの()のdataに＄が付いてなかった*/?>"><br/>
パスワードを入力してください<br/>
<input type="password" name="pass" style="width:100px"><br/>
パスワードをもう一度入力してください<br/>
<input type="password" name="pass2" style="width:100px"><br/>
<br/>
<input type="button" onclick="history.back()"value="戻る">
<input type="submit" value="OK">
</form>


</body>
</html>