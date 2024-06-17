<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/
xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="./niku4.php" method="POST">
<select name="pm">
    <option value="plus">収入</option>
    <option value="minus">支出</option>
</select>
<input type="text" name="no" size="20">
<br />
用途:<input type="text" name="name" size="20">
<input type="submit" value="send!">
</form>

<?php
if(isset($_POST['pm'])){
    $b = $_POST['pm'];
    $n = $_POST['no'];
    $p = $_POST['name'];
    $fp = fopen("niku.dat", "a");
    fwrite($fp, $p.$b.$n. "\n");
    fclose($fp);
}

if(file_exists('./niku.dat')){
    $fp = fopen("niku.dat", "r");
    while ($line = fgets($fp)) {
        echo "$line<br />";
    }
    fclose($fp);
}
else{
    echo 'File not found.';
}


?>
    
</body>
</html>