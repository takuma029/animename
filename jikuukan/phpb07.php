<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<title>phpb07</title>
</head>
<body>
<form action="./phpb07.php" method="POST">
name:<input type="text" name="pname" size="20">
<input type="submit" value="send!">
</form>
<?php
if (isset($_POST["pname"])){$pname=$_POST["pname"];}
if (isset($pname)){
$query="select * from anime where name like '%" . $pname . "%';";
$dbconn = pg_connect("host=localhost dbname=s2122090
user=s2122090 password=D8sxVHV5")
or die("Could not connect: " . pg_last_error());
$result = pg_query($query) or die("Query failed: " . pg_last_error());
echo "<table>\n";
while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
echo "\t<tr>\n";
foreach ($line as $col_value) {
echo "\t\t<td>$col_value</td>\n";
}
echo "\t</tr>\n";
}
echo "</table>\n";
}
else{
echo "<p>no data.</p>";
}
?>
</body>
</html>