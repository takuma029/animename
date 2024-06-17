<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/
xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz2</title>
</head>
<body>
<form action="./niku2.php" method="POST">
割られる数字:<input type="text" name="month" size="20"><br />
割る数字:<input type="text" name="day" size="20"><br />
<input type="submit" value="send!">
</form>

<?php
$m = (int)$_POST["month"];
$d = (int)$_POST['day'];
$amari = $m % $d;
echo $m."を".$d.'で割った余りは';
if($amari == 0){
    echo '<font color="red"> 0 </font>';
}
else{
    echo $amari;
}

?>
    
</body>
</html>