<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<title>phpb09</title>
</head>
<body>
<form action="./phpb09.php" method="POST">
<?php
$query="select id,name from anime order by id;";
$dbconn = pg_connect("host=localhost dbname=s2122090
user=s2122090 password=D8sxVHV5")
or die("Could not connect: " . pg_last_error());
$result = pg_query($query) or die("Query failed: " . pg_last_error());
echo "<select name=\"id\">";
while ($line = pg_fetch_array($result)) {
echo "<option value=\"$line[0]\">$line[1]</option>";
}
echo "</select>";
?>
<input type="submit" value="send!">
</form>
<?php
if (isset($_POST['id'])){$id=$_POST['id'];}
if (isset($id)){
$query="select * from anime where id = '" .$id . "';";
$result = pg_query($query) or die("Query failed: " . pg_last_error());
echo "<table>\n";
while ($line = pg_fetch_array($result)) {
$point=$line[2];
$point=str_replace("(","",$point);
$point=str_replace(")","",$point);
$outp=preg_split("/[,\s]/",$point);
echo "\t<tr>\n";
echo "\t\t<td>$line[0]</td>\n";
echo "\t\t<td>$line[1]</td>\n";
echo "\t\t<td>$line[3]</td>\n";
echo "\t\t<td><button type=\"button\" " .
"onclick=\"location.href='http://maps.apple.com/maps?q=$outp[1],$outp[0]'\">ナビ起動</button></td>\n";
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