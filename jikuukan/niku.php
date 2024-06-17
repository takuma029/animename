<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/
xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Qiuz1</title>
</head>
<body>
<form action="./niku.php" method="POST">
誕生月:<input type="text" name="month" size="20"><br />
誕生日;<input type="text" name="day" size="20">
<input type="submit" value="send!">
</form>

<?php
$m = (int)$_POST["month"];
$d = (int)$_POST['day'];
if($m == 3 && $d >= 21 || $m == 4 && $d <=19){
    echo "牡羊座";
}
if($m == 4 && $d >= 20 || $m == 5 && $d <=20){
    echo "牡牛座";
}
if($m == 5 && $d >= 21 || $m == 6 && $d <=21){
    echo "双子座";
}
if($m == 6 && $d >= 22 || $m == 7 && $d <=22){
    echo "蟹座";
}
if($m == 7 && $d >= 23 || $m == 8 && $d <=22){
    echo "獅子座";
}
if($m == 8 && $d >= 23 || $m == 9 && $d <=22){
    echo "乙女座";
}
if($m == 9 && $d >= 23 || $m == 10 && $d <=23){
    echo "天秤座";
}
if($m == 10 && $d >= 24 || $m == 11 && $d <=22){
    echo "蠍座";
}
if($m == 11 && $d >= 23 || $m == 12 && $d <=21){
    echo "射手座";
}
if($m == 12 && $d >= 22 || $m == 1 && $d <=19){
    echo "山羊座";
}
if($m == 1 && $d >= 20 || $m == 2 && $d <=18){
    echo "水瓶座";
}
if($m == 2 && $d >= 19 || $m == 3 && $d <=20){
    echo "魚座";
}

?>
    
</body>
</html>