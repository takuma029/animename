<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/
xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz3</title>
</head>
<body>
<form action="./niku3.php" method="POST">
表示する桁数<input type="text" name="num" size="20">
<input type="submit" value="send!">
</form>

<?php
$d = (int)$_POST['num'];
$f = 1;
$n = 0;
for($i = 0; $i < $d; $i++){

    echo $f."$line<br />";
    $r = $f;
    $f = $f + $n;
    $n = $r;
}
?>
    
</body>
</html>